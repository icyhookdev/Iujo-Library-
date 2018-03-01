<?php 
  session_start();
  
  function logInSession($sessionName){
    if(!isset($sessionName)){
      redirect('users/login');
    }
  }

  function logout(){
    unset($_SESSION['userId']);
    unset($_SESSION['userName']);
    unset($_SESSION['userEmail']);
    unset($_SESSION['userIdPerson']);
    session_destroy();
    redirect('users/login');
  }
