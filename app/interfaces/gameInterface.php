<?php

namespace App\interfaces;
interface gameInterface{
    public function add($game);
    public function get();
    public function put($id,$game);
    public function getById($id);
    public function delete($id);
    public function getGamesCategory();
    public function getTotalPlatformData();
    public function gotPlatformById($id);
    public function getProductsPaginate($platform);
    public function getAllGamesByCatId($id);
    public function getCartGamesById($id);
    public function getDatasByUserId($uid);

}