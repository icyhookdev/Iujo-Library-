<?php
  require_once 'config/config.php';

  require_once 'helper/url.php';
  require_once 'helper/session.php';
  
  spl_autoload_register(function($className){
    require_once 'libs/'. $className . '.php';
  });

 