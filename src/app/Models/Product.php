<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use Filterable;
    use HasFactory;

    protected $fillable = [
        "name",
        "price",
        "category_id",
        "in_stock",
        "rating",
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
