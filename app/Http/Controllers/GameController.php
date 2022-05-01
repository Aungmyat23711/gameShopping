<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\interfaces\gameInterface;
use Illuminate\Http\Request;

class GameController extends Controller
{
   protected gameInterface $gameInterface;
   public function __construct(gameInterface $gameInterface)
   {
       $this->gameInterface=$gameInterface;
   }
   public function create(Request $req){
       return $this->gameInterface->add($req);
    
   }
   public function read()
   {
       return $this->gameInterface->get();
   }
   public function update($id,Request $req)
   {
       return $this->gameInterface->put($id,$req);
   }
   public function readById($id)
   {
       return $this->gameInterface->getById($id);
   
   }
   public function deleteItem($id)
   {
       return $this->gameInterface->delete($id);
   }
   public function getGamesCategory()
   {
       return $this->gameInterface->getGamesCategory();
   }
   public function getTplatformData()
   {
       return $this->gameInterface->getTotalPlatformData();
   }
   public function getPlatformById($id)
   {
       return $this->gameInterface->gotPlatformById($id);
   }
   public function getAllProducts($platform){
       return $this->gameInterface->getProductsPaginate($platform);
   }
   public function getGamesByCatId(Request $req,$id){
       return $this->gameInterface->getAllGamesByCatId($req, $id);
    
   }
   public function getCartGames($id){
       return $this->gameInterface->getCartGamesById($id);
   }
   public function getDataByUserId($uid){
       return $this->gameInterface->getDatasByUserId($uid);
   }
   public function getManyProducts($platform){
       return $this->gameInterface->getTooManyProducts($platform);
   }
  
}
