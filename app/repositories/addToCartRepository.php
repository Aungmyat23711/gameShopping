<?php

namespace App\repositories;

use App\interfaces\addToCartInterface;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class addToCartRepository implements addToCartInterface
{
    public function insertCart($cart)
    {
        $data = new Cart();
        $data->user_id = $cart->user_id;
        $data->game_id = $cart->game_id;
        $data->qty = $cart->qty;
        $data->save();
    }
    public function updateCartGame($cart, $id)
    {
        $data = Cart::find($id);
        $data->update([
            'user_id' => $cart->user_id,
            'game_id' => $cart->game_id,
            'qty' => $cart->qty
        ]);
    }
    public function checkInCartCount($gid, $uid)
    {
        $data = Cart::where('game_id', $gid)->where('user_id', $uid)->count();
        $qty = Cart::where('game_id', $gid)->where('user_id', $uid)->pluck('qty')->toArray();
        return response()->json(['count' => $data, 'qty' => $qty]);
    }
    public function getCartListCount($uid)
    {
        $data = Cart::where('user_id', $uid)->count();
        return $data;
    }
    public function deletingCartGame($id)
    {
        $data = Cart::find($id);
        $data->delete();
    }
}
