<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        if($request->value){
            $products = Product::values($request->value)->get();
            return response()->json($products);
        }
        else{
            $products = Product::all();
            $newProducts = Product::news()->get();
            $data = ['products'=> $products, 'newProducts' => $newProducts];
            return response()->json($data);
        }
    }

    public function show($idProduct){
        $product = Product::find($idProduct);
        $category= Category::find($product->categories_id);
        $data = ['product' => $product, 'category'=>$category];
        return response()->json($data);
    }

    public function store(Request $request){
        $category = Category::where('name', $request->category)->first();
        $data = $request->all();
        $data['categories_id'] = $category->id ?? null;
        $product = Product::create($data);
        $data = ['msg' => 'product created succesfull', 'product'=>$product, 'categories'=>$category];
        return response()->json($data);
    }

    public function updated(Request $request,Product $product){
        $category = Category::where('name', $request->category)->first();
        $product->name = $request->name ?? $product->name;
        $product->unit_price = $request->unit_price ?? $product->unit_price;
        $product->stock = $request->stock ?? $product->stock;
        $product->img = $request->img ?? $product->img;
        $product->categories_id = $category->id ?? $product->categories_id;
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
