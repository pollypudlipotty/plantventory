<?php
        
    $servername="localhost";
    $username="root";
    $password="";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=plantventory", $username, $password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $message = "Connected successfully";
      } catch(PDOException $e) {
        $message = "Connection failed: " . $e->getMessage();
      }
     
?>


