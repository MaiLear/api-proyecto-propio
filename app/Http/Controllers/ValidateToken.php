<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidateToken{
    public function __construct()
    {
        
    }

    public function validate(Request $request){
        return response()->json($request);
    }

}