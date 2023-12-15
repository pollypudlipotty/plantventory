<?php
  session_start();
  require_once "pdo.php";
  include "util.php";

    
  if(!isset($_SESSION['usr_id']))
  {
    header("Location:index.php");
    return;
  }

  //deleting session data from update, delete, or go back
  

    if(isset($_SESSION['plant_id']))
    {
        unset($_SESSION['plant_id']);
    }
    if(isset($_SESSION['type_id']))
    {
        unset($_SESSION['type_id']);
    }
    if(isset($_SESSION['sp_name']))
    {
        unset($_SESSION['sp_name']);
    }

    //selecting all the plants of the user
    $stmt = $pdo->prepare("SELECT plants.id, plants.name, plants.notes, plants.since, plant_types.difficulty,
                            plant_types.light, plant_types.water, plant_types.name AS type_name
                            FROM plants INNER JOIN plant_types ON plants.type_id = plant_types.id
                            WHERE plants.user_id = ? ORDER BY type_name");
    $stmt->execute([$_SESSION['usr_id']]);
    $plants_of_usr = $stmt->fetchAll(PDO::FETCH_ASSOC); 


  if($plants_of_usr == null) //the user has no plants, no need to other db queries
  //in case of two session messages -delete cases when there is no plant left- making sure both are visible
  {
    if(isset($_SESSION['msg']))
    {
      $_SESSION['msg'] = $_SESSION['msg']."<br><br>You don't have any plants.";
    }
    else
    {
      $_SESSION['msg'] = "You don't have any plants.";
    }
  }
  else
  {
        //select the picture data for the user to find the main pictures to display
        $stmt = $pdo->prepare("SELECT  picture_data.id, picture_data.main, extensions.name, picture_data.plant_id from picture_data
                                inner join extensions on picture_data.extension_id=extensions.id    
                                inner join plants on plants.id=picture_data.plant_id    
                                where plants.user_id = ?");
        $stmt->execute([$_SESSION['usr_id']]);
        //the array will be checked in the function iteration
        $pics_of_usr = $stmt->fetchAll(PDO::FETCH_ASSOC);

   
  }
  
  function loadPlantstoCard(array $plant_arr, array $pics, $usr_id)
  {
    if($plant_arr == null) //if there is no plant yet don't bother to load the cards
    {
      return;
    }  

    $main_img_path = "";

    $species_name = "";
    $water = 0;
    $light = 0;
    $diffic = 0;

    $w_img = "";
    $s_img = "";
    $d_img = "";

    $note_txt = "";

    //go through the plant data for the specific user id
    for($i = 0; $i < count($plant_arr); $i++ )
    {
        // for every plant the user have , inicialize the $species_name, ....$diffic, so we can echo it in the html card
        $species_name = $plant_arr[$i]['type_name'];
        $water = $plant_arr[$i]['water'];
        $light = $plant_arr[$i]['light'];
        $diffic = $plant_arr[$i]['difficulty'];

        //setting the pictogram src string according to data from db
        if($water == 3)
        {
            $w_img = "water3.jpeg";
        }
        else if($water == 2)
        {
            $w_img = "water2.jpeg";
        }
        else
        {
            $w_img = "water1.jpeg";
        }

        if($light == 3)
        {
            $s_img = "sun3.jpg";
        }
        else if($light == 2)
        {
            $s_img = "sun2.jpg";
        }
        else
        {
            $s_img = "sun1.jpg";
        }

        if($diffic == 3)
        {
            $d_img = "dif3.jpg";
        }
        else if($diffic == 2)
        {
            $d_img = "dif2.jpg";
        }
        else
        {
            $d_img = "dif1.jpg";
        }
         
        
        //setting the main image
        //looping through the image data , all the images of the user and find the ones, where main is 1 -> setting as main image and leave the loop
        //if there is no main 1 -> the deafult image stays the main
        for($k = 0; $k < count($pics); $k++)
        {  
           if(($pics[$k]['plant_id'] == $plant_arr[$i]['id']) && $pics[$k]['main'] == 1)
           {
                $main_img_path = "uploads/{$usr_id}/{$pics[$k]['id']}{$pics[$k]['name']}";
                break;
           }

           $main_img_path = "images/gallery_icon.jpg";    //when didn't find any main      
        }  
        
        //calculating the months for each plant
        $date_from_db = new DateTime($plant_arr[$i]["since"]);
        $date_now = new DateTime("now");
        $interval = $date_from_db->diff($date_now);
        $months = ($interval->y * 12) + $interval->m;

        if($months == 0)
        {
            $months_txt = "less than a month";
        }
        else if($months == 1)
        {
            $months_txt = $months." month";
        }
        else
        {
            $months_txt = $months." months";
        }        

        //iniz. the note text for the card
        if($plant_arr[$i]["notes"] == "")
        {
            $note_txt = "There is no note for this plant.";
        }
        else
        {
            $note_txt = htmlentities($plant_arr[$i]["notes"]);
        }

        //creating a card with echo, put in the data with php variables
        echo '
        
            <div class="card card-main col-lg-3 col-md-4 col-sm-6 col-xs-6 m-2 mx-lg-3" >
               <div class="cardimg container-fluid row d-flex justify-content-center align-items-center m-0">
                    <div class="container d-flex justify-content-center align-items-center text-center my-2" id="plant_main_div">
                      <a href="plant_gallery.php?plant_id='.$plant_arr[$i]["id"].'">
                        <img id="plant_main" class="card-img-top ml-2 my-2" src='.$main_img_path.' alt="No picture yet.">
                      </a>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="card-txt pb-3 text-center">
                        <h3 class="card-title">'.htmlentities($plant_arr[$i]["name"]).'</h3>
                        <p class="card-text">
                            <small>'.$species_name.'</small><br>
                            <small>since: '.$months_txt.'</small>
                        </p>
                    </div>
                    <div class="row">
                        <div class="card-body container-fluid col-6">
                            <div class="row pictodiv d-flex justify-content-center"><img class="mx-auto card-picto" src="images/'.$w_img.'"></div>               
                            <div class="row pictodiv d-flex justify-content-center"><img class="mx-auto card-picto" src="images/'.$s_img.'"></div>
                        </div>
                        <div class="container-flud card-body col-6">
                            <div class="row pictodiv d-felx justify-content-center"><img class="card-picto2" src="images/'.$d_img.'"></div>                                         
                        </div>
                    </div>
                    <div class="justify-content-center align-items-center mt-2 d-flex row">
                            <div class="d-flex justify-content-center align-items-center col-12 col-lg-6 my-2">
                                <button class="btn" id="infobtn-'.$i.'" onclick="return cardInfo('.$i.');">Info</button>
                                
                            </div>                        
                            <div class="d-flex justify-content-center align-items-center col-12 col-lg-6 my-2">
                                <a href="edit_form.php?plant_id='.$plant_arr[$i]["id"].'"><button class="btn">Edit</button></a>
                            </div>
                            <div class="card card-note" id="card-note-'.$i.'">
                                    <div class="d-flex justify-content-center align-items-center d-flex card-body"><small>'.$note_txt.'</small></div>
                            </div>                         
                    </div>                
                </div>
            </div>
            
       
        ';
    }
  }

?>


<?php include "views/head.php"; ?>
<body>
<?php include "views/nav2.php"; ?>
<div class="container-fluid bg-dark text-light p-3">

<div class="container row mx-md-2 mx-lg-5">
  <h4 class="col-6 mx-4 pt-4" id="noplant_msg"><?php flash_msg(); ?></h4>
</div><br>

<div class="container row mb-3 mx-md-2 mx-lg-5">
  <a href="add_new.php"><button class="btn col-4 mx-4" id="addbtn">Add new plant</button></a>
</div>


<div class="card-deck row p-2 mx-md-2 mx-lg-5 d-flex justify-content-center align-items-center" id="plantcarddiv">

  <?php loadPlantstoCard($plants_of_usr, $pics_of_usr, $_SESSION['usr_id']); ?>
 
</div>

</div>  

<?php include "views/footer.php"; ?>

</body>
</html> 






