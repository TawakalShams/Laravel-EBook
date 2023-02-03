<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;

class ShoppingCartController extends Controller
{
    public function store(Request $request)
    {
        User::Create([
            'date' => $request->date,
        ]);
    }
}
