<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\interfaces\categoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  protected categoryInterface $categoryInterface;
  public function __construct(categoryInterface $categoryInterface)
  {
      $this->categoryInterface=$categoryInterface;
  }
  public function create(Request $req)
  {
      return $this->categoryInterface->add($req);
   
  }
  public function read(){
      return $this->categoryInterface->get();
  }
  public function delete($id){
      return $this->categoryInterface->del($id);
  }
  public function createCategory(Request $req)
  {
      return $this->categoryInterface->addCategory($req);
  }
  public function gotCategory($id)
  {
      return $this->categoryInterface->getCategory($id);
  }
  public function deleteCategory($id)
  {
      return $this->categoryInterface->deletedCategory($id);
  }
  public function getCategory($id)
  {
      return $this->categoryInterface->getCategoryById($id);
  }
  public function getAllCount($platform)
  {
      return $this->categoryInterface->getAllTCount($platform);
  }
  public function getAllCountPlatform($platform){
      return $this->categoryInterface->getAllCountByPlatform($platform);
  }
}
