<?php

namespace App\Http\Controllers\Product;

use App\Services\Product\ProductProcessInterface;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public ProductProcessInterface $service;

    /**
     * @param ProductProcessInterface $service
     */
    public function __construct(ProductProcessInterface $service)
    {
        $this->service = $service;
    }
}
