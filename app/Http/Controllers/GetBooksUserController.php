<?php

namespace App\Http\Controllers;
use App\Models\GetBooksUser;


use Illuminate\Http\Request;

class GetBooksUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role->name != 'user') {
            return response(['message' => 'Unauthorized!'], 401);
        }
        return response()->json(GetBooksUser::all());
    }
}
