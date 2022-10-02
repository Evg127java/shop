<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DeleteController extends BaseController
{
    public function __invoke(Product $product)
    {
        $this->service->delete($product);
        return redirect()->route('product.index');
    }
}
