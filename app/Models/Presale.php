<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presale extends Model
{
    use HasFactory;


    protected $fillable = [
        'quantity',
        'sub_total',
        'customer_id',
        'sale_id'
    ];
}
