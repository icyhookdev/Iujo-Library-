<?php 
  function redirect($page){
    header('Location:' . URLROOT . '/' . $page);
  }

  function age($date){
      $birthdate = explode('-', $date);
      if(date('m') < $birthdate[1]){
        echo date('Y') - $birthdate[0] -1;
      }else{
        if(date('d') < $birthdate[2]){
          echo date('Y') - $birthdate[0] -1;
        }else{
          echo date('Y') - $birthdate[0];
        }  
      }
  }

  function message($url){
    $url = explode('/', $url);
    switch($url){
      case in_array('1', $url) :   
        echo '<div class="alert green white-text center-align">Los datos fueron Registrados Exitosamente</div>';
        break;
      case in_array('2', $url) : 
        echo '<div class="alert blue white-text center-align">Los datos fueron Actualizados Exitosamente</div>';
        break;
      case in_array('3', $url) :
        echo '<div class="alert red white-text center-align">Los datos fueron Eliminados Exitosamente</div>';
        break;    
    }
  }