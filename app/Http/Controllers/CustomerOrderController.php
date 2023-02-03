<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;

class CustomerOrderController extends Controller
{

    public function index()
    {

        $user = auth()->user();
        if ($user->role->name != 'admin') {
            return response(['message' => 'Unauthorized'], 401);
        }else{

        
        // return response()->json(CustomerOrder::with(['books','customer'])->get());
      return  DB::select('SELECT * FROM customer_orders INNER JOIN add_books
       ON customer_orders.book_id=add_books.id
       INNER JOIN users
       ON customer_orders.customer_id=users.id ');
    //   return  DB::select('SELECT * FROM payments INNER JOIN add_books ON payments.book_id=add_books.id INNER JOIN users ON payments.customer_id=users.id');
    }
}

    public function store(Request $request)
    {

        // $user = auth()->user();
        // if ($user->role->name != 'user') {
        //     return response(['message' => 'Unauthorized'], 401);
        // }else{

        $customer_id =CustomerOrder::where('customer_id',$request['customer_id'] || 'book_id',$request['book_id'])->first();

        if($customer_id ){
            $response['status'] = 0;
            $response['message'] = 'Already have';
            $response['code'] =409;

       }else{
         CustomerOrder::Create([
            'customer_id' => $request->customer_id,
            'book_id' => $request->book_id,
            'status' => "unpaid"
        ]);

           $response['status'] = 1;
           $response['message'] = 'Successfully';
           $response['code'] =200;

       }
       return response()->json($response);


    // }
    }
public function show($id){
    
    // $user = auth()->user();
    // if ($user->role->name != 'user') {
    //     return response(['message' => 'Unauthorized'], 401);
    // }else{
    $response= DB::select('SELECT * FROM customer_orders INNER JOIN add_books
    ON customer_orders.book_id=add_books.id
    INNER JOIN users
    ON customer_orders.customer_id=users.id  WHERE users.id=?',[$id]);
    if($response){
        return response()->json($response);
    }else{
         $response['status']=0;
        return response()->json($response);
    }
}
}
