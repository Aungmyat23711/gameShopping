<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Http\Requests\StorePlatformRequest;
use App\Http\Requests\UpdatePlatformRequest;
use App\interfaces\platformInterface;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
   protected platformInterface $platformInterface;
   public function __construct(platformInterface $platformInterface)
   {
       $this->platformInterface=$platformInterface;
   }
   public function create(Request $req)
   {
       return $this->platformInterface->add($req);
    
   }
   public function read(){
       return $this->platformInterface->get();
   }
   public function delete($id){
       return $this->platformInterface->del($id);
   }
   public function createPlatform(Request $req)
   {
       return $this->platformInterface->createdPlatform($req);
   }
   public function gotPlatform($id)
   {
       return $this->platformInterface->getPlatform($id);
   }
   public function deletePlatform($id)
   {
       return $this->platformInterface->deletedPlatform($id);
   }
   public function getPlatformByGameId($id){
       return $this->platformInterface->getPlatformWithGameId($id);
   }
}
