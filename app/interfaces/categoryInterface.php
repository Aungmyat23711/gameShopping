<?php
namespace App\interfaces;
interface categoryInterface{
    public function add($category);
    public function get();
    public function del($id);
    public function addCategory($category);
    public function getCategory($id);
    public function deletedCategory($id);
    public function getCategoryById($id);
    public function getAllTCount($platform);
}