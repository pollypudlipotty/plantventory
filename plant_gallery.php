<?php    
    session_start();
    include "util.php";
    require_once "pdo.php";

    
   //deleting session data from update, delete, or go back

    if(isset($_SESSION['pic_id']))
    {
        unset($_SESSION['pic_id']);
    }
    if(isset($_SESSION['caption']))
    {
        unset($_SESSION['caption']);
    }
    if(isset($_SESSION['main']))
    {
        unset($_SESSION['main']);
    }
    if(isset($_SESSION['name']))
    {
        unset($_SESSION['name']);
    }


    //making sure we will get only the spacific plant pictures, cannot be changed with rewriting get in url
    if(!isset($_SESSION['plant_id']))
    {
        $_SESSION['plant_id'] = $_GET['plant_id'];
    }

    //get all the data to display gallery
    $stmt = $pdo->prepare("SELECT picture_data.id, extensions.name, picture_data.caption, picture_data.uploaded_at,
                            picture_data.main, picture_data.plant_id FROM picture_data
                            INNER JOIN extensions ON picture_data.extension_id = extensions.id
                            where plant_id=? ORDER BY uploaded_at DESC");
    $stmt->execute([$_SESSION['plant_id']]); 
    $gallery_data = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    //a function that echoes all individual images with date and caption and edit button
    function plantGallery(array $result, $usr_id)
    {   
        //if there is no pic uploaded to that plant
        if($result == null)
        {
            echo '
            <div class="text-center">
                <h3>There are no pictures uploaded yet.</h3>
            </div>';
        }
        else //this code doesn't happen
        {


        $length = count($result);

        for($i = 0; $i < $length; $i++)
        {   
            //creating the daycounter for the gallery image
            $date =  $result[$i]['uploaded_at']; //get the datetime format
            $date_arr = explode(' ',$date); //split the string by whitespace

            $ymd = new DateTime($date_arr[0]); //get only the y-m-d part of it and make a new DateTime
            $today = new DateTime("now");

            //calculate the difference in days
            $interval = $today->diff($ymd);
            $days_since = $interval->days;

            //making the proper text to show
            if($days_since == 0)
            {
                $days_txt = "today";
            }
            else if($days_since == 1)
            {
                $days_txt ='yeasterday';
            }
            else
            {
                $days_txt = $days_since.' days ago';
            }

            //checking it it is main to display if yes
            if($result[$i]['main'] == 1)
            {
                $main_msg = "main picture";
                $class = "opacity-100";
            }
            else
            {
                $main_msg = "not main";
                $class = "opacity-0";
            }
            
            $img_path = "uploads/" . $usr_id . "/" . $result[$i]['id'] . $result[$i]['name'];


            echo '
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 m-3 mb-5">
                        <div class="card square-card mb-2">
                            <div class="card-content d-flex align-items-center justify-content-center">
                                <img class="card-img-top img-fluid w-100 m-1" src='.$img_path.' alt="'.htmlentities($result[$i]['caption']).'" onclick="return openPic(\'' . $img_path . '\');">                                
                            </div>                   
                        </div>  
                        <div>
                            <div class="text-center mb-1">
                                <small id="day_show">'.$days_txt.'</small><br>
                                <small id="main_show" class="'.$class.'">'.$main_msg.'</small><hr>
                            </div>
                            <p id="caption-txt">'.htmlentities($result[$i]['caption']).'</p>    
                        </div>
                        <a href="edit_pic.php?pic_id='.$result[$i]['id'].'&caption='.urlencode($result[$i]['caption']).'&main='.$result[$i]['main'].'&plant_id='.$result[$i]['plant_id'].'&name='.$result[$i]['name'].'"><button id="gallery-btn" class="btn">Edit</button></a>
                        <hr>
                        
                    </div>
                    ';

        }
    }
}

?>


<?php include "views/head.php"; ?>
<body>
<?php include "views/nav2.php"; ?>
<div class="container-fluid bg-dark text-light p-3">

<div class="container mx-md-5 p-3">
    <div class="row mb-3">
        <h4 class="col-6 mx-4 pt-4"><?php flash_msg(); ?></h4>
    </div>
    <div class="mx-2 row d-flex">
        <div class="col-lg-2 mb-2"><a href="myplants.php"><button class="btn gallery-btn">Go back</button></a></div>
        <div class="col-lg-2"><a href="add_picture.php"><button class="btn gallery-btn">New picture</button></a></div>
    </div>


<div id="myModal" class="modal">

<div class="modal-content">
    <h3 class="close d-flex justify-content-end m-5" onclick="closePic();">&times;</h3>
    <img class="mb-5 p-2 rounded" id="big_pic" src="" alt="">
</div>

</div>



</div><br>

<div class="container-fluid gallery-con px-2">
    <div class="row d-flex justify-content-center">

      <?php plantGallery($gallery_data,$_SESSION['usr_id']); ?>

    </div>
  </div>


</div>  
  


<?php include "views/footer.php"; ?>

</body>
</html> 
