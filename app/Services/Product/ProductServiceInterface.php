<?php

namespace App\Services\Product;

use App\Models\Product;

interface ProductServiceInterface
{
    public function store($data);
    public function update($data, $product);
    public function delete($product);
}
