<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    public function getNewProducts(string $quantity, Request $request)
    {
        $offset = $quantity == 10 ? 0 : $quantity - 10;
        $newProducts =  Product::news()->skip($offset)->take(5)->get();
        return response()->json($newProducts);
    }


    public function getProducts(int $quantity)
    {
        $offset = $quantity == 10 ? 0 : $quantity - 10;
        $products =  Product::skip($offset)->take(10)->get();
        return response()->json($products);
    }

    public function getFilterProducts(Request $request)
    {
        $products = Product::values($request->value)->get();
        return response()->json($products);
    }

    public function getAllProducts()
    {
        return response()->json(Product::all());
    }

    public function getPaginateProducts()
    {
        $products = Product::paginate(2);

        return response()->json($products);
    }






    public function show($idProduct)
    {
        $product = Product::find($idProduct);
        $category = Category::find($product->categories_id);
        $data = ['product' => $product, 'category' => $category];
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $category = Category::where('name', $request->category)->first();
        $data = $request->all();
        $data['categories_id'] = $category->id ?? null;
        $product = Product::create($data);
        $data = ['msg' => 'product created succesfull', 'product' => $product, 'categories' => $category];
        return response()->json($data);
    }

    public function update(Request $request, Product $product)
    {
        $category = Category::where('name', $request->category)->first();
        $product->name = $request->name ?? $product->name;
        $product->unit_price = $request->unit_price ?? $product->unit_price;
        $product->stock = $request->stock ?? $product->stock;
        $product->img = $request->img ?? $product->img;
        $product->new_product = isset($request->new_product) ? true : false;
        $product->category_id = $category->id ?? $product->category_id;
        $product->save();
        $data = ['msg' => 'product updated succesfull', 'product' => $product];
        return response()->json($data);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        $data = ['msg' => 'product deleted succesfull', 'product' => $product];
        return response()->json($data);
    }


    public function active($idProduct)
    {
        $product = Product::find($idProduct);
        $product->status = true;
        $product->save();
        $data = ['msg' => 'product actived'];
        return response()->json($data);
    }

    public function inactive($idProduct)
    {
        $product = Product::find($idProduct);
        $product->status = false;
        $product->save();
        $data = ['msg' => 'Product sucess desactive', 'product' => $product];
        return response()->json($data);
    }
}
