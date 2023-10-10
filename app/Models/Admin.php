<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected function firstName(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value)
        );
    }


    protected function secondName(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value)
        );
    }

}
