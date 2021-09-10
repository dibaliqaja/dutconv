<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('product_units')->latest()->paginate(10);
        $keyword = $request->keyword;
        if ($keyword) $products = Product::with('product_units')->where('name', 'LIKE', "%$keyword%")->latest()->paginate(10);        

        return view('products.index', compact('products'));
    }
}
