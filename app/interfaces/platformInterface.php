<?php
namespace App\interfaces;

interface platformInterface{
    public function add($platform);
    public function get();
    public function del($id);
    public function createdPlatform($platform);
    public function getPlatform($id);
    public function deletedPlatform($id);
    public function getPlatformWithGameId($id);
}