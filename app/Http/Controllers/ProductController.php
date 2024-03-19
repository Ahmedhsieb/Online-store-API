<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $ProductInterface;

    public function __construct(ProductInterface $ProductInterface)
    {
        $this->ProductInterface = $ProductInterface;
    }

    public function getProducts()
    {
        return $this->ProductInterface->getProducts();
    }
}
