<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paid extends Model
{
    use HasFactory;
    protected $table = "customer_orders";
    protected $primary = "orderid";
    protected $filable = [
        'status'
    ];
}
