<?php
    session_start();
    require_once "pdo.php";
    include "util.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $file = $_FILES["uploaded_file"];    

        //file details
        $orig_name = $file["name"];
        $fileTmpName = $file["tmp_name"];
        $fileError = $file["error"];

        //server side validation that the upload file is actually one of the allowed types
        $allowedMimeTypes = ["image/jpeg", "image/jpg", "image/png"];

        //get info from the file, precisely, get info of the actual extension type
        $f_info = finfo_open(FILEINFO_MIME_TYPE); 
        $fileMimeType = finfo_file($f_info, $fileTmpName); 
        finfo_close($f_info);
    
        //check if the extension type we got is in the allowed array, if not, redirect with error message
        if (!in_array($fileMimeType, $allowedMimeTypes))
        {
            $_SESSION['msg'] = "You can only upload .jpg, .jpeg, and .png files."; 
            header("Location:add_picture.php");
            return;
        }

        //check if there is a folder with the users id as name in the uploads dierctory
        $base_folder = "/opt/lampp/htdocs/plantventory5/uploads/";
        $folder_name = $_SESSION['usr_id'];
        $full_path = $base_folder.$folder_name;

        //if there is no such directory, make it inside uploads dir and give it permissions
        if (!is_dir($full_path)) 
        {
            $dir_name = "/opt/lampp/htdocs/plantventory5/uploads/".$_SESSION['usr_id'];
            
            mkdir($dir_name, 0777, true);
        }

        //getting the next id from pictures table
        $stmt = $pdo->prepare("SELECT auto_increment FROM INFORMATION_SCHEMA.TABLES
                                WHERE table_name = 'picture_data'");
        $stmt->execute(); 
        $next_id = $stmt->fetchColumn();



        //construct the file name 
        //name without extension - the $next_id from pictures table
        $custom_name = $next_id;

        //construct the new file name with the custom name and the original extension
        $file_name = $custom_name.'.'.pathinfo($orig_name, PATHINFO_EXTENSION);

        // move the file to the specific directory named after the user's id
        $target_dir = "/opt/lampp/htdocs/plantventory5/uploads/".$_SESSION['usr_id']."/";
        $target_path = $target_dir.$file_name;

         //if it is not succesful, redirect end error message
         if (!move_uploaded_file($fileTmpName, $target_path))
         {     
            $_SESSION['msg'] = "Something went wrong, please try again.";
            header("Location:add_picture.php");
            return;
         }
        else
        {
            //set the permission to the uploaded file 
            chmod($target_path, 0777);

            //making a new insert in pictures table           
            $default_main_value = false;   //it will indicate which is the main picture of the plant, which is shown on the card

            //finding out which extension id to insert with the new entry
            if(pathinfo($orig_name, PATHINFO_EXTENSION) == 'jpg')
            {
                $extension_id = 1;
            }
            else if(pathinfo($orig_name, PATHINFO_EXTENSION) == 'jpeg')
            {
                $extension_id = 2;
            }
            else
            {
                $extension_id = 3;
            }

            //use mysql NOW() function to set upload time
            $sql = "INSERT INTO picture_data (plant_id,caption,main,extension_id,uploaded_at) VALUES (:plant_id,:caption,:main,:extension_id,NOW());";
            $stmt = $pdo->prepare($sql);
    
            $stmt->bindParam(':plant_id', $_SESSION['plant_id']);
            $stmt->bindParam(':caption', $_POST['caption']);
            $stmt->bindParam(':main', $default_main_value, PDO::PARAM_BOOL);
            $stmt->bindParam(':extension_id', $extension_id);
            $stmt->execute();


            
            $_SESSION['msg'] = "New picture uploaded successfully!";
            header("Location:plant_gallery.php");
            return;
 
        
 
 
 
             
         }

    
}
  
    
?>
