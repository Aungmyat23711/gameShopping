<?php

namespace App\repositories;

use App\interfaces\voiceInterface;
use App\Models\Game;
use App\Models\Totalvoice;
use App\Models\Voice;

class voiceRepository implements voiceInterface{
    public function add($voice){
        $data=new Voice();
        $data->voice=$voice->voice;
        $data->save();
    }
    public function get()
    {
        $data=Voice::all();
        return $data;
    }
    public function del($id){
        $data=Voice::find($id);
        $data->delete();
    }
    public function createdVoice($voice)
    {

        foreach($voice->voices as $vic)
        {
            if(Game::find($voice->game_id) && Totalvoice::find($vic)){
            return response()->json(['msg'=>'Already Inserted']);   
            }else{
            $data=new Totalvoice();
            $data->game_id=$voice->game_id;
            $data->voice_id=$vic;
            $data->save();
            }
           
        }
    }
    public function getVoice($id)
    {
        $data=Totalvoice::where('game_id',$id)->get();
        return $data;
    }
    public function deletedVoice($id)
    {
        $data=Totalvoice::find($id);
        $data->delete();
    }
}