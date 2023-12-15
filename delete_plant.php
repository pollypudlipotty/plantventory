<?php
    session_start();
    require_once "pdo.php";


    if(isset($_SESSION['plant_id']))
    {
        //delete pic on server
        //select statement to create the files name
        $stmt = $pdo->prepare("SELECT picture_data.id, extensions.name FROM picture_data INNER JOIN extensions ON picture_data.extension_id = extensions.id WHERE plant_id=?");
        $stmt->execute([$_SESSION['plant_id']]); 
        $del_plant_data = $stmt->fetchAll(PDO::FETCH_ASSOC);  //contains the id and extension name => filename

        //deleting the files
        if($del_plant_data != null)
        {
            for($i = 0; $i < count($del_plant_data); $i++)
            {
                $file_path = "/opt/lampp/htdocs/plantventory5/uploads/".$_SESSION['usr_id']."/".$del_plant_data[$i]['id'].$del_plant_data[$i]['name'];
                unlink($file_path);
            }
        }

        //delete from picture_data table, if there is no picture it is not an error
        $sql = "DELETE FROM picture_data WHERE plant_id=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$_SESSION['plant_id']]);

        //delete from plants table
        $sql = "DELETE FROM plants WHERE id=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$_SESSION['plant_id']]);       

        $_SESSION['msg'] = "Your <span class='green'>".$_SESSION['sp_name']."</span> is deleted";
        header("Location:myplants.php");
        return;
       
    }
    else
    {
        header("Location:index.php");
        return;
    }
     
?>