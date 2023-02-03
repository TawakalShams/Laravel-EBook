<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User ;
use App\Models\AddBook ;
class CustomerOrder extends Model
{
    use HasFactory;
    protected $table = "customer_orders";
    protected $fillable = [
        'customer_id',
        'book_id',
        'status'
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function books(){
        return $this->hasMany(AddBook::class, 'id', 'book_id');
    }
}
