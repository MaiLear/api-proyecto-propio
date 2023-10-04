<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request){
        if($request->value){
            $customer = Customer::values($request->value)->get();
            return response()->json($customer);
        }
        $customer = Customer::all();
        return response()->json($customer);
    }

    public function show(Customer $customer){
        return response()->json($customer);
    }

    public function create(){

    }

    public function store(Request $request){
        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->second_name = $request->second_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->password = $request->password;
        $customer->save();
        $data = ['msg'=>'customer created successfully',
        'admin'=>$customer];
        return response()->json($data);
    }

    public function updated(Request $request, Customer $customer){
        $customer->first_name = $request->first_name ?? $customer->first_name;
        $customer->second_name = $request->second_name ?? $customer->second_name;
        $customer->last_name = $request->last_name ?? $customer->last_name;
        $customer->email = $request->email ?? $customer->email;
        $customer->password = $request->password ?? $customer->password;
        $customer->save();
        $data = ['msg'=>'customer updated successfully',
        'admin'=>$customer];
        return response()->json($data);
    }

    public function destroy(Customer $customer){
            $customer->delete();
            $data = ['msg'=>'customer deleted successfully',
            'admin'=>$customer];
            return response()->json($data);
    }
}
