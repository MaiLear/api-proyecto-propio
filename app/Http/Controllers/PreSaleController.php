<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Presale;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

class PreSaleController extends Controller
{
    public function store(Request $request)
    {
        try {
            $presale = new Presale();
            $presale->customer_id = $request->customer_id;
            $presale->price = $request->price;
            $presale->quantity = $request->quantity;
            $presale->product_id = $request->product_id;
            $presale->save();
            $response = ["msg" => "ok", "status" => 200];
            return response()->json($response);
        } catch (ModelNotFoundException $error) {
            $response = ["msg" => $error, "status" => 500];
            return response()->json($response);
        }
    }
}
