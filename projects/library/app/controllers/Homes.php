<?php 
  class Homes extends Controller{
    public function index(){
      $data = [
        'description' => ''
      ];
      $this->view('home/home', $data);
    } 
  }