<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class IndexController extends Controller
{
    public function __invoke()
    {
        /*dd((Product::find(1))->ImageUrl);*/
        $products = Product::all();
        return ProductResource::collection($products);
    }
}
