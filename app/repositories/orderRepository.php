<?php

namespace App\repositories;

use App\Events\OrderPlaced;
use App\interfaces\orderInterface;
use App\Models\Game;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class orderRepository implements orderInterface
{
    public function insertOrder($orders)
    {
        foreach ($orders->all() as $order) {
            $data = new Order;
            $data->user_id = $order['user_id'];
            $data->game_id = $order['id'];
            $data->qty = $order['cartqty'];
            $data->price = $order['discountPrice'];
            $data->payment_method = $order['payment_method'];
            $data->user_name = $order['user_name'];
            $data->discount = $order['discount'];
            $data->status = "pending";
            $data->address = $order['address'];
            $data->phone = $order['phone'];
            $data->save();
            event(new OrderPlaced($order));
        }
    }
    public function readByUid($uid)
    {
        $data = DB::table('orders')
            ->join('games', 'orders.game_id', 'games.id')
            ->select('games.name', 'games.image_item', 'games.platform', 'orders.*')
            ->where('orders.user_id', $uid)
            ->orderBy('created_at', 'desc')
            ->get();
        return $data;
    }
    public function gettingAllPendingOrders()
    {
        $data = DB::table('orders')
            ->join('games', 'orders.game_id', 'games.id')
            ->select('games.name', 'games.image_item', 'games.platform', 'orders.*')
            ->orderBy('created_at', 'desc')
            ->get();
        return $data;
    }
    public function updatingStatus($oid)
    {
        $data = Order::find($oid);
        $data->status = "success";
        $data->save();
    }
}
