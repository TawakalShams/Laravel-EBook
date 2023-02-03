<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //this is a model
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterUsersController extends Controller
{
    public function store(Request $request)
    {
        $user =User::where('email',$request['email'])->first();
        if($user){
            //define response
            $response['status'] = 0;
            $response['message'] = 'Email Already Exist';
            $response['code'] = 409;

       }else{
        User::Create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'role_id' => 2,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,

        ]);
        $response['status'] = 1;
        $response['message'] = 'User Created Successfully';
        $response['code'] = 200;
       }

        return response()->json($response);
    }
}
