<?php
    session_start();
    require_once "pdo.php";


    if(isset($_SESSION['pic_id']) && isset($_SESSION['name']) && isset($_SESSION['usr_id']))
    {
        //delete pic on server
        $file_path = "/opt/lampp/htdocs/plantventory5/uploads/".$_SESSION['usr_id']."/".$_SESSION['pic_id'].$_SESSION['name'];
        unlink($file_path);
        
        //delete from picture_data table
        $sql = "DELETE FROM picture_data WHERE id=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$_SESSION['pic_id']]);
        
        $_SESSION['msg'] = "Picture is deleted successfully";
        header("Location:plant_gallery.php");
        return;
       
    }
    else
    {
        header("Location:index.php");
        return;
     }
     
?>