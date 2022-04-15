<?php

namespace App\repositories;

use App\interfaces\photoInterface;
use App\Models\Photo;
use Illuminate\Support\Facades\File;

class photoRepository implements photoInterface{
    public function addPhotos($id,$index,$photo)
    {
        if(!File::exists("resources/$id"))
        {
           File::makeDirectory("resources/$id");
        }
        $data=new Photo();
       for($i=0;$i<=$index;$i++)
       {
            $data->game_id=$id;
       }
       $image=$photo->file('file')->getClientOriginalName();
       $path=$photo->file('file')->move("resources/$id",$image);
       $data->photo=$image;
       $data->save();      
    }
    public function getPhotoById($id)
    {
        $data=Photo::where('game_id',$id)->get();
        return $data;
    }
    public function deletePhotoById($id,$gid,$photo)
    {
        File::delete("resources/$gid/$photo->current");
        $data=Photo::find($id);
        $data->delete();  
     
    }
}