<?php
namespace App\repositories;

use App\interfaces\orderInterface;
use App\Models\Game;
use App\Models\Order;

class orderRepository implements orderInterface{
    public function insertOrder($orders){
        foreach($orders->all() as $order){
             $data=new Order;
        $data->user_id=$order['user_id'];
        $data->game_id=$order['id'];
        $data->qty=$order['cartqty'];
        $data->price=$order['discountPrice'];
        $data->payment_method=$order['payment_method'];
        $data->user_name=$order['user_name'];
        $data->discount=$order['discount'];
        $data->status="pending";
        $data->address=$order['address'];
        $data->phone=$order['phone'];
        $data->save();
        $game=Game::where('id',$order['id']);
        $game->update(['qty'=>$order['qoh']]);
        
        }
       
    }
}