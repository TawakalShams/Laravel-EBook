<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; //this is a model
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }else{
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
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'address' => $request->address,
                'phone' => $request->phone,
    
            ]);
            $response['status'] = 1;
            $response['message'] = 'User Created Successfully';
            $response['code'] = 200;
           }
        }
 

        return response()->json($response);
    }

    public function index()
    { $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }
        return response()->json(User::all());
    //  return  DB::select('SELECT * FROM users INNER JOIN roles ON users.role_id = roles.id');

    }

    public function show($id)
    {
        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }
        return response()->json(User::find($id));

    }
    public function update(Request $request, $id)
    { 
        $user = auth()->user();
         if ($user->role->name != 'admin') {
        return response(['message' => 'Unauthorized'], 401);
    }else{

    
        $user = User::find($id);
        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->save();

        $response['message'] = 'Updated';
    }
    }


    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }else{
        $user = User::findOrFail($id);
        $user->delete();
        $response['message'] = 'Successfully deleted';
        }
    }
}
