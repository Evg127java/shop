<?php

namespace App\Services\Product;

use App\Models\Product;

interface ProductProcessInterface
{
    public function store(array $data);
    public function update(array $data, Product $product);
}
