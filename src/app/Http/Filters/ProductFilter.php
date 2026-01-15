<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class ProductFilter
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

    /**
     * Сортировка по указанному значению
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function sort(Builder $builder, $value): void
    {
        if (preg_match('/^(.+)_(asc|desc)$/i', $value, $matches)) {
            $builder->orderBy($matches[1], $matches[2]);
        } else if ($value === "newest") {
            $builder->orderBy("id", "desc");
        }
    }
}
