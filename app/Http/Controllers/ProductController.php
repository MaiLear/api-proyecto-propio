<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json($products);
    }

    public function show(Product $product){
        return response()->json($product);
    }

    public function store(Request $request){
        $products = new Product();
        $products->name = $request->name;
        $products->unit_price = $request->unit_price;
        $products->stock = $request->stock;
        $products->img = $request->img;
        $products->save();
        $data = ['msg' => 'product created succesfull', 'product'=>$products];
        return response()->json($data);
    }

    public function updated(Request $request,Product $product){
        $product->name = $request->name ?? $product->name;
        $product->unit_price = $request->unit_price ?? $product->unit_price;
        $product->stock = $request->stock ?? $product->stock;
        $product->img = $request->img ?? $product->img;
        $product->save();
        $data = ['msg' => 'product updated succesfull', 'product' => $product];
        return response()->json($data);
    }

    public function destroy(Product $product){
        $product->delete();
        $data = ['msg' => 'product deleted succesfull', 'product' => $product];
        return response()->json($data);
    }
}
