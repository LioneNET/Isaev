<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Filterable
{
    /**
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function scopeFilter(Builder $query, Request $request): Builder
    {
        $filterClass = $this->resolveFilterClass();

        foreach ($request->all() as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (class_exists($filterClass)) {
                $filter = new $filterClass();

                if (method_exists($filter, $key)) {
                    $filter->$key($query, $value);
                }
            }
        }

        return $query;
    }

    /**
     * @return string
     */
    protected function resolveFilterClass(): string
    {
        $className = class_basename(static::class) . 'Filter';
        return "App\\Http\\Filters\\{$className}";
    }
}
