<?php

namespace App\Http\Controllers;

use App\Models\Voice;
use App\Http\Requests\StoreVoiceRequest;
use App\Http\Requests\UpdateVoiceRequest;
use App\interfaces\voiceInterface;
use Illuminate\Http\Request;

class VoiceController extends Controller
{
  protected voiceInterface $voiceInterface;
  public function __construct(voiceInterface $voiceInterface)
  {
      $this->voiceInterface=$voiceInterface;
  }
  public function create(Request $req)
  {
      return $this->voiceInterface->add($req);
   
  }
  public function read(){
      return $this->voiceInterface->get();
  }
  public function delete($id){
      return $this->voiceInterface->del($id);
  }
  public function createVoice(Request $req)
  {
      return $this->voiceInterface->createdVoice($req);
  }
  public function gotVoice($id)
  {
      return $this->voiceInterface->getVoice($id);
  }
  public function deleteVoice($id)
  {
      return $this->voiceInterface->deletedVoice($id);
  }
}
