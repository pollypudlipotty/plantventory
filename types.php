<?php

    require_once "pdo.php";

    $term = $_GET['term'];

    $stmt = $pdo -> prepare("SELECT name FROM plant_types WHERE name LIKE :typeahead");
    $stmt -> execute(array(':typeahead' => $term."%"));
    
    $type_name = array();
    while($row = $stmt -> fetch(PDO::FETCH_ASSOC))
    {
        $type_name[] = $row['name'];
    }



    $json = json_encode($type_name,JSON_PRETTY_PRINT);  

    echo $json;

?>