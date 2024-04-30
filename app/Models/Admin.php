<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guarded = [''];

    protected $hidden = [
        'password',
        'email'
    ];

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
