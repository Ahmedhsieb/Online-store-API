<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    use ApiResponseTrait;
    public function getProducts()
    {
        $products = Product::get();

        if ($products){
            return $this->apiResponse(200, 'Get Products Successfully', null, $products);
        }

        return $this->apiResponse(200, 'No Products found');

    }
}
