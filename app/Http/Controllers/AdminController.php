<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return response()->json($admin);
    }

    public function show(Admin $admin)
    {
        return response()->json($admin);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $admin = Admin::create($request->all());
        $data = [
            'msg' => 'admin created successfully',
            'admin' => $admin
        ];
        return response()->json($data);
    }

    public function update(Request $request, Admin $admin)
    {
        $admin->first_name = $request->first_name ?? $admin->first_name;
        $admin->second_name = $request->second_name ?? $admin->second_name;
        $admin->email = $request->email ?? $admin->email;
        $admin->password = $request->password ?? $admin->password;
        $admin->save();
        $data = [
            'msg' => 'admin updated successfully',
            'admin' => $admin
        ];
        return response()->json($data);
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        $data = [
            'msg' => 'admin deleted successfully',
            'admin' => $admin
        ];
        return response()->json($data);
    }

    public function authenticate(Request $request)
    {
        //Para utilizar Auth::attempt($valor) con un modelo diferene a User
        //  debe crear un guardian en la carpeta App\Config\auth.php
        if (Auth::guard('admin')->attempt($request->only(['email', 'password']))) {
            $payload = [
                "data" => auth("admin")->user()->id,
                "exp" => time() + 3600
            ];

            $jwt = JWT::encode($payload, env("SECRET_KEY"), "HS256");
            $data = ["status" => 200, 'msg' => '', "token" => $jwt, "user" => auth('admin')->user()];
            return response()->json($data);
        } else {
            $data = ["msg" => "Invalid credential", "status" => 500, 'token' => ''];
            return response()->json($data);
        }
    }


    public function logout(Request $request)
    {
        try {
            Auth::guard('admin')->logout();
            $data = ['status' => 200, 'msg' => 'logout successfull'];
            return response()->json($data);
        } catch (Exception $e) {
            $data = ['status' => 500, 'msg' => $e];
            return response()->json($data);
        }
    }
}
