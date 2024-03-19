<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $OrderInterface;

    public function __construct(OrderInterface $OrderInterface)
    {
        $this->OrderInterface = $OrderInterface;
    }

    public function checkout(Request $request)
    {
        return $this->OrderInterface->checkout($request);
    }


}
