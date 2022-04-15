<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Http\Requests\StoreEditionRequest;
use App\Http\Requests\UpdateEditionRequest;
use App\interfaces\editionInterface;
use Illuminate\Http\Request;

class EditionController extends Controller
{
  protected editionInterface $editionInterface;
  public function __construct(editionInterface $editionInterface)
  {
      $this->editionInterface=$editionInterface;
  }
  public function create(Request $req)
  {
      return $this->editionInterface->add($req);
   
  }
  public function read(){
      return $this->editionInterface->get();
  }
  public function delete($id){
      return $this->editionInterface->del($id);
  }
  public function createEdition(Request $req)
  {
      return $this->editionInterface->createdEdition($req);
  }
  public function gotEdition($id)
  {
      return $this->editionInterface->getEdition($id);
  }
  public function deleteEdition($id)
  {
      return $this->editionInterface->deletedEdition($id);
  }
}
