<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }else{
            Payment::Create([
                'amount' => $request->amount,
                'customer_id' => $request->customer_id,
                'book_id' => $request->book_id,
                'status' => "paid",
    
            ]);
        }


    }

    public function index()
    {

        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }else{
            $total = Payment::sum('amount');
            return response()->json(
                [
                    'balance' => $total,
                ]
            );
        }

    }

}
