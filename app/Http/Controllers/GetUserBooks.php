<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddBook;

class GetUserBooks extends Controller
{
    
        public function index()
        {
            // $user = auth()->user();
            // if ($user->role->name != 'user') {
            //     return response(['message' => 'Unauthorized'], 401);
            // }
            return response()->json(AddBook::all());
        }
    
        // public function show($id)
        // {
        //     return response()->json(AddBook::find($id));
    
        // }
  
 
    }
    