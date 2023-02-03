<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBook extends Model
{
    use HasFactory;
    protected $table = "add_books";
    protected $fillable = [
            'title',
            'author',
            'year',
            'selling',
            'description',
            'book',
            'image',
    ];
}
