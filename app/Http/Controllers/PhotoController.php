<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\interfaces\photoInterface;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PhotoController extends Controller
{
   protected photoInterface $photoInterface;
   public function __construct(photoInterface $photoInterface)
   {
       $this->photoInterface=$photoInterface;
   }
   public function create($id,$index,Request $req)
   {
     return $this->photoInterface->addPhotos($id,$index,$req);  
   }
   public function readPhotoById($id)
   {
       return $this->photoInterface->getPhotoById($id);
   }
   public function deletePhoto($id,$gid,Request $req)
   {
       return $this->photoInterface->deletePhotoById($id,$gid,$req);
   }
}
