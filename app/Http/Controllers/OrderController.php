<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\interfaces\orderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected orderInterface $orderInterface;
    public function __construct(orderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }
    public function insert(Request $req)
    {
        return $this->orderInterface->insertOrder($req);
    }
    public function readByUserId($uid)
    {
        return $this->orderInterface->readByUid($uid);
    }
    public function getAllPendingOrders()
    {
        return $this->orderInterface->gettingAllPendingOrders();
    }
    public function updateStatus($oid)
    {
        return $this->orderInterface->updatingStatus($oid);
    }
}
