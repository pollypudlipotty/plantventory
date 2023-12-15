



<?php
  session_start();

  $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $redirectURL = "http://localhost/plantventory/index.php";

  if($currentURL != $redirectURL)
  {
    header("Location:".$redirectURL);
    exit();
  }
  
 
  include "main.php";
  

    
?>



