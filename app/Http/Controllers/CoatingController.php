<?php

namespace App\Http\Controllers;

use App\Models\Coating;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CoatingController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('coating-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('coating-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('coating-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('coating-delete'), only: ['destroy']),
        ];
    }

    public function index()
    {
        $coatings = Coating::withTrashed()->get();
        return view('coating.index', compact('coatings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coating.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:coatings,name',
        ]);
        try {
            $input = $request->all();
            Coating::create($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('coating.register')->with("success", "Coating created successfully");
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
        $coating = Coating::findOrFail(decrypt($id));
        return view('coating.edit', compact('coating'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:coatings,name,' . $id,
        ]);
        try {
            $coating = Coating::findOrFail($id);
            $input = $request->all();
            $coating->update($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('coating.register')->with("success", "Coating updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coating::findOrFail(decrypt($id))->delete();
        return redirect()->route('coating.register')->with("success", "Coating deleted successfully");
    }
}
