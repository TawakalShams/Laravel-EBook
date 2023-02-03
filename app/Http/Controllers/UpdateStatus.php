<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paid;
use Illuminate\Support\Facades\DB;

class UpdateStatus extends Controller
{
    public function update(Request $request, $orderid)
    {
        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }
       return DB::update('UPDATE customer_orders SET status = "paid" WHERE orderid=?',[$orderid]);
    }
}
