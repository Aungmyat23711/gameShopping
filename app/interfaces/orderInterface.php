<?php

namespace App\interfaces;

interface orderInterface
{
    public function insertOrder($orders);
    public function readByUid($uid);
    public function gettingAllPendingOrders();
    public function updatingStatus($oid);
}
