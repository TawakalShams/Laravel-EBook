<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class GetAllPaymentsController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }else {
                // return response()->json(User::all());
      return  DB::select('SELECT * FROM payments INNER JOIN users
      ON users.id = payments.customer_id
      INNER JOIN add_books
      ON add_books.id = payments.book_id
      ');
        }
    

    }
}
