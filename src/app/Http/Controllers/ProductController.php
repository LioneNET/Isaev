<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * @param ProductRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(ProductRequest $request): AnonymousResourceCollection
    {
        return ProductResource::collection(
            Product::filter($request)->paginate($request->input('limit') ?? 10)
        );
    }
}
