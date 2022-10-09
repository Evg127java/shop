<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Filter\ProductFilter;
use App\Http\Resources\Product\IndexProductResource;
use App\Models\Product;
use App\Http\Requests\API\Product\IndexRequest;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        $filter = App::make(ProductFilter::class, ['queryParams' => array_filter($data)]);
        $products = Product::filter($filter)->get();
        return IndexProductResource::collection($products);
    }
}
