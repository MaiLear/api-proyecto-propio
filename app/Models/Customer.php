<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Customer extends Authenticatable
{
    use HasFactory;

    protected $guarded = [''];

    protected $hidden = [
        'password',
        'email',
        'create_at',
        'updated_at'
    ];

    public function scopeValues(Builder $query, string $value): void
    {
        if ($value) {
            $query->where('first_name', 'LIKE', '%' . "$value" . '%')
                ->orWhere('second_name', 'LIKE', '%' . "$value" . '%')
                ->orWhere('last_name', 'LIKE', '%' . "$value" . '%');
                // ->orWhere('email', 'LIKE', '%' . "$value" . '%');
        }
    }

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


    protected function lastName(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value)
        );
    }
}
