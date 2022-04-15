<?php
namespace App\interfaces;
interface editionInterface{
    public function add($edition);
    public function get();
    public function del($id);
    public function createdEdition($edition);
    public function getEdition($id);
    public function deletedEdition($id);
}