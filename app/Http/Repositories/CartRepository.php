<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\CartInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Cart;
use App\Rules\StockValidation;
use Illuminate\Support\Facades\Validator;

class CartRepository implements CartInterface
{
    use ApiResponseTrait;

    public function addToCart($request)
    {
        $validation = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'count' => ['required', new StockValidation($request->product_id)]
        ]);

        if ($validation->fails()){
            return $this->apiResponse(400, 'validation error', $validation->errors());
        }

        $cart= Cart::where([ ['user_id',1], ['product_id', $request->product_id] ])->first();

        if($cart)
        {
            $cart->update([
                'count' => ($cart->count + $request->count)
            ]);
        }else
        {
            Cart::create([
                'user_id' => 1,
                'product_id' => $request->product_id,
                'count' => $request->count
            ]);
        }

        return $this->apiResponse(200, 'product added to cart successfully');
    }

    public function deleteFromCart($request)
    {
       $cart = Cart::find($request->cart_id);
       if ($cart){
           $cart->delete();
           return $this->apiResponse(200, 'cart deleted successfully');
       }
        return $this->apiResponse(400, 'cart not found');

    }

    public function updateCart($request)
    {
        $validation = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'count' => ['required', new StockValidation($request->product_id)],
        ]);
        if ($validation->fails()){
            return $this->apiResponse(400, 'validation error', $validation->errors());
        }

        $cart = Cart::where([['user_id', 1],['product_id', $request->product_id]])->first();
        if ($cart){
           $cart->update([
               'count' => $request->count
           ]);
           return $this->apiResponse(200, 'cart updated successfully');
        }
        return $this->apiResponse(400, 'cart not found');

    }

    public function userCart()
    {
        $carts = Cart::where('user_id', 1)->with('product')->get();
        foreach ($carts as $cart)
        dd($cart->product->stock);

        return $this->apiResponse(200, 'user cart', null, $carts);
    }
}
