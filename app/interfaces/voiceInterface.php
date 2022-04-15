<?php

namespace App\interfaces;

interface voiceInterface{
    public function add($voice);
    public function get();
    public function del($id);
    public function createdVoice($voice);
    public function getVoice($id);
    public function deletedVoice($id);
}