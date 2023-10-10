<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $admin = Admin::all();
        return response()->json($admin);
    }

    public function show(Admin $admin){
        return response()->json($admin);
    }

    public function create(){
    }

    public function store(Request $request){
        $admin = Admin::create($request->all());
        $data = ['msg'=>'admin created successfully',
        'admin'=>$admin];
        return response()->json($data);
    }

    public function updated(Request $request, Admin $admin){
        $admin->first_name = $request->first_name ?? $admin->first_name;
        $admin->second_name = $request->second_name ?? $admin->second_name;
        $admin->email = $request->email ?? $admin->email;
        $admin->password = $request->password ?? $admin->password;
        $admin->save();
        $data = ['msg'=>'admin updated successfully',
        'admin'=>$admin];
        return response()->json($data);
    }

    public function destroy(Admin $admin){
            $admin->delete();
            $data = ['msg'=>'admin deleted successfully',
            'admin'=>$admin];
            return response()->json($data);
    }
}
