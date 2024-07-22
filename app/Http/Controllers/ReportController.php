<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use App\Models\Purchase;
use App\Models\Sales;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\SalesDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReportController extends Controller implements HasMiddleware
{
    protected $branches, $products;

    public function __construct()
    {
        $this->branches = Sales::select('branch')->get()->unique('branch')->pluck('branch', 'branch');
        $this->products = Product::leftJoin('coatings AS c', 'products.coating_id', 'c.id')->selectRaw("CONCAT_WS(' ', products.code, products.name, c.name, CONCAT(products.sph, ' ', products.cyl, ' ', products.axis, ' ', products.add)) AS name, products.id AS id")->pluck('name', 'id');
    }
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('report-sales'), only: ['sales', 'salesFetch']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('report-sales-product-wise'), only: ['salesProduct', 'salesProductFetch']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('report-purchase'), only: ['purchase', 'purchaseFetch']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('report-damage'), only: ['damage', 'damageFetch']),
        ];
    }

    public function sales()
    {
        $inputs = array(date('Y-m-d'), date('Y-m-d'), '');
        $data = collect();
        $branches = $this->branches;
        return view('report.sales', compact('data', 'inputs', 'branches'));
    }

    public function salesFetch(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $inputs = array($request->from_date, $request->to_date, $request->branch);
        $branches = $this->branches;
        $data = Sales::whereBetween('created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->to_date)->endOfDay()])->when($request->branch, function ($q) use ($request) {
            return $q->where('branch', $request->branch);
        })->get();
        return view('report.sales', compact('data', 'inputs', 'branches'));
    }

    public function salesProduct()
    {
        $inputs = array(date('Y-m-d'), date('Y-m-d'), '', '');
        $data = collect();
        $branches = $this->branches;
        $products = $this->products;
        return view('report.sales-product', compact('data', 'inputs', 'branches', 'products'));
    }

    public function salesProductFetch(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $inputs = array($request->from_date, $request->to_date, $request->branch, $request->product);
        $branches = $this->branches;
        $products = $this->products;
        /*$data = SalesDetail::leftJoin('sales as s', 's.id', 'sales_details.sales_id')->selectRaw("sales_details.id, sales_details.product_id, s.order_id, s.customer_name, s.branch, s.notes, sales_details.created_at")->whereBetween('sales_details.created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->to_date)->endOfDay()])->when($request->branch, function ($q) use ($request) {
            return $q->where('s.branch', $request->branch);
        })->when($request->product, function ($q) use ($request) {
            return $q->where('sales_details.product_id', $request->product);
        })->get();*/
        $data = SalesDetail::leftJoin('sales as s', 's.id', 'sales_details.sales_id')->selectRaw("SUM(sales_details.qty) AS qty, sales_details.product_id, s.branch")->whereBetween('sales_details.created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->to_date)->endOfDay()])->when($request->branch, function ($q) use ($request) {
            return $q->where('s.branch', $request->branch);
        })->when($request->product, function ($q) use ($request) {
            return $q->where('sales_details.product_id', $request->product);
        })->groupBy('sales_details.product_id', 's.branch')->get();
        return view('report.sales-product', compact('data', 'inputs', 'branches', 'products'));
    }

    public function salesProductDetail(Request $request){
        $data = SalesDetail::leftJoin('sales as s', 's.id', 'sales_details.sales_id')->selectRaw("sales_details.id, sales_details.product_id, sales_details.qty, s.order_id, s.customer_name, s.branch, s.notes, sales_details.created_at")->whereBetween('sales_details.created_at', [Carbon::parse($request->fdate)->startOfDay(), Carbon::parse($request->tdate)->endOfDay()])->when($request->branch, function ($q) use ($request) {
            return $q->where('s.branch', $request->branch);
        })->when($request->product, function ($q) use ($request) {
            return $q->where('sales_details.product_id', $request->product);
        })->get();
        return view('report.sales-product-detail', compact('data'));
    }

    public function purchase()
    {
        $inputs = array(date('Y-m-d'), date('Y-m-d'), '');
        $data = collect();
        $suppliers = Supplier::pluck('name', 'id');
        return view('report.purchase', compact('data', 'inputs', 'suppliers'));
    }

    public function purchaseFetch(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $suppliers = Supplier::pluck('name', 'id');
        $inputs = array($request->from_date, $request->to_date, $request->supplier_id);
        $data = Purchase::whereBetween('created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->to_date)->endOfDay()])->when($request->supplier_id, function ($q) use ($request) {
            return $q->where('supplier_id', $request->supplier_id);
        })->get();
        return view('report.purchase', compact('data', 'inputs', 'suppliers'));
    }

    public function damage()
    {
        $inputs = array(date('Y-m-d'), date('Y-m-d'));
        $data = collect();
        return view('report.damage', compact('data', 'inputs'));
    }

    public function damageFetch(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $inputs = array($request->from_date, $request->to_date);
        $data = Damage::whereBetween('created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->to_date)->endOfDay()])->get();
        return view('report.damage', compact('data', 'inputs'));
    }
}
