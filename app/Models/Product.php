<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //Query scope

    public function scopeValues(Builder $query, string $value): void
    {
        if ($value) {
            $query->where('name', 'LIKE', '%' . "$value" . '%')
                ->orWhere('unit_price', 'LIKE', '%' . "$value" . '%')
                ->orWhere('stock', 'LIKE', '%' . "$value" . '%');
        }
    }

    public function scopeNews(Builder $query): void
    {
        $query->where('new_product', 1);
    }
}
