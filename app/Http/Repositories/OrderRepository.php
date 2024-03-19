<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\OrderInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class OrderRepository implements OrderInterface
{
    use ApiResponseTrait;
    public function checkout($request)
    {
        $cartItems = Cart::where('user_id', 1)->with('product')->get();

        if (count($cartItems) == 0){
            return  $this->apiResponse(400, 'Cart is empty ');
        }

        foreach ($cartItems as $cartItem){
            if ($cartItem->product->stock < $cartItem->count){
                return  $this->apiResponse(400, 'Stock out of range ');
            }
        }

        $total_price = $cartItems->sum(function ($item){
            return $item->count * $item->product->price;
        });


        DB::transaction(function ()use ($cartItems, $total_price){
            $order = Order::create([
                'user_id' => 1,
                'total_price' => $total_price
            ]);

            foreach($cartItems as $cartItem){
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product->id,
                    'count' => $cartItem->count,
                    'unit_price' => $cartItem->product->price,
                    'net_price' => $cartItem->count * $cartItem->product->price,
                ]);

                $product = Product::find($cartItem->product->id);
                $product->update(['stock' => $product->stock - $cartItem->count]);
                $cartItem->delete();
            }
        });



        return $this->apiResponse(200, 'Order Created Successfully');

    }
}
