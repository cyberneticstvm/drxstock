<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use App\Models\Purchase;
use App\Models\Sales;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReportController extends Controller implements HasMiddleware
{
    protected $branches;

    public function __construct()
    {
        $this->branches = Sales::select('branch')->get()->unique('branch')->toArray();
    }
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('report-sales'), only: ['sales', 'salesFetch']),
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
        //
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
