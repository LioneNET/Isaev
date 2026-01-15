<?php

namespace App\Http\Sorters;

use Illuminate\Database\Eloquent\Builder;

class ProductSort
{
    public function name(Builder $builder, $value): void
    {
        $builder->where('name', 'ILIKE', "%{$value}%");
    }

    public function price_from(Builder $builder, $value): void
    {
        $builder->where('price', '>=', $value);
    }

    public function price_to(Builder $builder, $value): void
    {
        $builder->where('price', '<=', $value);
    }

    public function category_id(Builder $builder, $value): void
    {
        $builder->where('category_id', $value);
    }

    public function in_stock(Builder $builder, $value): void
    {
        $builder->where('in_stock', $value);
    }

    public function rating_from(Builder $builder, $value): void
    {
        $builder->where('rating', ">=", $value);
    }
}
