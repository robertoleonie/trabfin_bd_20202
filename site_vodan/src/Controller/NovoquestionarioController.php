<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * 
 */
class NovoquestionarioController extends AppController{
    public function index(){
       
        //
        $this->set(['testandoquestionario' => $questionario]);
        //$questionario = $this->TbQuestion;
    }
}