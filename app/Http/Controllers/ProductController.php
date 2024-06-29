<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Category;
use App\Models\Coating;
use App\Models\Material;
use App\Models\Power;
use App\Models\Product;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-create'), only: ['create', 'store', 'new', 'save']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-delete'), only: ['destroy']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-track'), only: ['track', 'trackFetch']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-export-excel'), only: ['exportProductExcel']),
        ];
    }

    public function index()
    {
        $products = Product::withTrashed()->latest()->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'data_file' => 'required|mimes:xlsx',
        ]);
        try {
            $import = new ProductImport($request);
            Excel::import($import, $request->file('data_file')->store('temp'));
            if ($import->data) :
                Session::put('failed_import_data', $import->data);
                return redirect()->route('import.failed')->with("warning", "Some products weren't uploaded. Please check the excel file for more info.");
            endif;
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
        return back()->with("success", "Products Uploaded Successfully");
    }

    public function new()
    {
        $types = Type::all();
        $coatings = Coating::pluck('name', 'id');
        $materials = Material::pluck('name', 'id');
        $powers = Power::all();
        return view('product.new', compact('types', 'coatings', 'materials', 'powers'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'material_id' => 'required',
            'coating_id' => 'required',
        ]);
        try {
            $type = Type::findOrFail($request->type_id);
            $input = $request->all();
            $input['updated_by'] = $request->user()->id;
            $input['created_by'] = $request->user()->id;
            $input['name'] = $type->name;
            $input['category_id'] = $type->category_id;
            $input['code'] = productcode('Lens');
            Product::create($input);
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route("product.register")->with("success", "Product created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function track()
    {
        $types = Type::all();
        $coatings = Coating::pluck('name', 'id');
        $materials = Material::pluck('name', 'id');
        $products = [];
        $powers = Power::all();
        $inputs = array('', '', '', '', '', '', '', '', '');
        return view('product.track', compact('types', 'coatings', 'materials', 'products', 'inputs', 'powers'));
    }

    function trackFetch(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'material_id' => 'required',
            'coating_id' => 'required',
        ]);
        $type = Type::findOrFail($request->type_id);
        if (in_array($type->category_id, [1, 2]) && $request->add == '') :
            return back()->with("error", "Addition value required")->withInput($request->all());
        endif;
        if ($type->category_id == 2 && $request->eye == '') :
            return back()->with("error", "Eye value required")->withInput($request->all());
        endif;
        $axis = $request->axis;
        $spherical = $request->sph;
        $cylinder = $request->cyl;
        $sph = [$request->sph, number_format($request->sph, 2), number_format($request->sph + $request->cyl, 2)];
        $cyl = [$request->cyl, number_format(0 - $request->cyl, 2)];
        $add = [number_format($request->add, 2), number_format($request->add + 0.25, 2), number_format($request->add - 0.25, 2)];
        $powers = Power::all();
        $types = Type::all();
        $coatings = Coating::pluck('name', 'id');
        $materials = Material::pluck('name', 'id');
        $type = Type::findOrFail($request->type_id);
        $inputs = array($request->type_id, $request->material_id, $request->coating_id, $request->sph, $request->cyl, $request->axis, $request->add, $request->eye, $type->category_id);
        try {
            switch ($axis):
                case $axis <= 90:
                    $axis = [$axis, $axis + 90];
                    break;
                case $axis > 90:
                    $axis = [$axis, $axis - 90];
                    break;
                default:
                    $axis = [$axis];
            endswitch;
            $products = Product::withTrashed()->when($request->sph && $request->cyl, function ($q) use ($spherical, $cylinder, $request) {
                return $q->where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->where('add', $request->add ?? '0.00')->whereRaw("IF($spherical, CAST($spherical AS DECIMAL(4,2)) = CAST(sph AS DECIMAL(4,2))+CAST(cyl AS DECIMAL(4,2)), 1)")->whereRaw("IF($cylinder, CAST($cylinder AS DECIMAL(4,2)) = CAST(0-cyl AS DECIMAL(4,2)), 1)")->orWhereRaw("sph=$spherical AND cyl=$cylinder AND `add`=" . ($request->add ?? '0.00'));
            })->when($request->sph != null && $request->cyl == null, function ($q) use ($sph, $request) {
                return $q->where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->whereIn('sph', $sph)->whereNull('cyl');
            })->when($request->sph == null && $request->cyl != null, function ($q) use ($cyl, $request) {
                return $q->where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->whereIn('cyl', $cyl)->whereNull('sph');
            })->when($request->sph == null && $request->cyl == null, function ($q) use ($request) {
                return $q->where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->whereNull('sph')->whereNull('cyl');
            })->when($request->axis != null, function ($q) use ($axis, $request) {
                return $q->where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->whereIn('axis', $axis);
            })->when($request->eye, function ($q) use ($request) {
                return $q->where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->where('eye', $request->eye);
            })->where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->orderByDesc('add')->get();

            if ($products->isNotEmpty()) :
                return view('product.track', compact('types', 'coatings', 'materials', 'products', 'inputs', 'powers'));
            else :
                return back()->with("error", "No products found!")->withInput($request->all());
            endif;
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage())->withInput($request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail(decrypt($id));
        $types = Type::all();
        $coatings = Coating::pluck('name', 'id');
        $materials = Material::pluck('name', 'id');
        $powers = Power::all();
        return view('product.edit', compact('types', 'coatings', 'materials', 'product', 'powers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type_id' => 'required',
            'material_id' => 'required',
            'coating_id' => 'required',
        ]);
        try {
            $type = Type::findOrFail($request->type_id);
            $input = $request->all();
            $input['updated_by'] = $request->user()->id;
            $input['name'] = $type->name;
            $input['category_id'] = $type->category_id;
            Product::findOrFail($id)->update($input);
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route("product.register")->with("success", "Product updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail(decrypt($id))->delete();
        return redirect()->route("product.register")->with("success", "Product deleted successfully");
    }

    public function exportProductExcel()
    {
        return Excel::download(new ProductExport(), 'products.xlsx');
    }

    public function exportProductPdf()
    {
        return Excel::download(new ProductExport(), 'products.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
