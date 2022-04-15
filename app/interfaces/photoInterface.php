<?php
namespace App\interfaces;

interface photoInterface{
    public function addPhotos($id,$index,$photo);
    public function getPhotoById($id);
    public function deletePhotoById($id,$gid,$photo);
}