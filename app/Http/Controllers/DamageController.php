<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DamageController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

    protected $products;

    public function __construct()
    {
        $this->products = Product::leftJoin('coatings AS c', 'products.coating_id', 'c.id')->selectRaw("CONCAT_WS(' ', products.code, products.name, c.name, CONCAT(products.sph, ' ', products.cyl, ' ', products.axis, ' ', products.add)) AS name, products.id AS id")->pluck('name', 'id');
    }

    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('damage-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('damage-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('damage-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('damage-delete'), only: ['destroy']),
        ];
    }

    public function index()
    {
        $damages = Damage::whereDate('created_at', Carbon::today())->withTrashed()->latest()->get();
        return view('damage.index', compact('damages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = $this->products;
        return view('damage.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
            'notes' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        Damage::create($input);
        return redirect()->route('damage.register')->with('success', 'Damage recorded successfullY');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $damage = Damage::findOrFail(decrypt($id));
        $products = $this->products;
        return view('damage.edit', compact('damage', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
            'notes' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        Damage::findOrFail($id)->update($input);
        return redirect()->route('damage.register')->with('success', 'Damage updated successfullY');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Damage::findOrFail(decrypt($id))->delete();
        return redirect()->route('damage.register')->with('success', 'Damage deleted successfullY');
    }
}
