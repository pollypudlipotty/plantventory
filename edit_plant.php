<?php
    session_start();
    require_once "pdo.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //first deleting the row of the plant
        $sql = "DELETE FROM plants WHERE id=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$_SESSION['plant_id']]);

        //than insert the plant again with the new data from the form
        $sql = "INSERT INTO plants (user_id,type_id,since,name,notes) VALUES (:uid,:tid,:since,:name,:notes);";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':uid', $_SESSION['usr_id']);
        $stmt->bindParam(':tid', $_SESSION['type_id']);
        $stmt->bindParam(':since', $_POST['e-since']);
        $stmt->bindParam(':name', $_POST['e-pname']);
        $stmt->bindParam(':notes', $_POST['e-note']);
        $stmt->execute();      
    
            
        $_SESSION['msg'] = "Your <span class='green'>".$_SESSION['sp_name']."</span> is updated.";
        header('Location:myplants.php');
        return;  

    }
  

?>