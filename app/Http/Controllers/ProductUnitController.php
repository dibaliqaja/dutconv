<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUnitRequest;
use App\Models\ProductUnit;
use Illuminate\Http\Request;

class ProductUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_units = ProductUnit::latest()->paginate(10);
        $keyword = $request->keyword;
        if ($keyword) $product_units = ProductUnit::where('name', 'LIKE', "%$keyword%")->latest()->paginate(10);        

        return view('product-units.index', compact('product_units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product-units.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ProductUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductUnitRequest $request)
    {
        ProductUnit::create($request->all());

        return redirect()->route('product-units.index')
            ->with('alert', 'Product Unit berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('product-units.edit', [
            'product_unit' => ProductUnit::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ProductUnitRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUnitRequest $request, $id)
    {
        $product_unit = ProductUnit::findOrFail($id);
        $product_unit->update($request->all());

        return redirect()->route('product-units.index')
            ->with('alert', 'Product Unit berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_unit = ProductUnit::findOrFail($id);
        $product_unit->delete();

        return redirect()->route('product-units.index')
            ->with('alert', 'Product Unit berhasil dihapus.');
    }
}
