<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        return response()->json($customer);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->all());
        $data = [
            'msg' => 'customer created successfully',
            'admin' => $customer
        ];
        return response()->json($data);
    }

    public function updated(Request $request, Customer $customer)
    {
        $customer->first_name = $request->first_name ?? $customer->first_name;
        $customer->second_name = $request->second_name ?? $customer->second_name;
        $customer->last_name = $request->last_name ?? $customer->last_name;
        $customer->email = $request->email ?? $customer->email;
        $customer->password = $request->password ?? $customer->password;
        $customer->save();
        $data = [
            'msg' => 'customer updated successfully',
            'admin' => $customer
        ];
        return response()->json($data);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        $data = [
            'msg' => 'customer deleted successfully',
            'admin' => $customer
        ];
        return response()->json($data);
    }


    public function logout(){
        try{
        Auth::guard('customer')->logout();
        $data = ['status' => 200, 'msg' => 'logout successfull'];
        return response()->json($data);
    } catch (Exception $e) {
        $data = ['status' => 500, 'msg' => $e];
        return response()->json($data);
    }
    }

    public function getFilterCustomers(Request $request){
        $customers = Customer::values($request->value)->get();
        return response()->json($customers);
    }



    public function authenticate(Request $request)
    {
        if (Auth::guard('customer')->attempt($request->only(['email', 'password']))) {
            $payload = [
                "data" => auth("customer")->user()->id,
                "exp" => time() + 3600,
            ];

            $jwt = JWT::encode($payload, env("SECRET_KEY"), "HS256");
            $data = ["status" => 200, "token" => $jwt,'user' => auth('customer')->user()];
            return response()->json($data);
        } else {
            $data = ["msg" => "Invalid credential", "status" => 500];
            return response()->json($data);
        }
    }
}
