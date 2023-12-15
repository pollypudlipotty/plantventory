<?php
  session_start();
    require_once "pdo.php";
    include "util.php";

  //getting the pic_id and caption from previous page
  //manking sure which pic gets updated
  if(!isset($_SESSION['pic_id']))
  {
    $_SESSION['pic_id'] = $_GET['pic_id'];
  } 
  if(!isset($_SESSION['caption']))
  {
    $_SESSION['caption'] = $_GET['caption'];
  }
  if(!isset($_SESSION['main']))
  {
    $_SESSION['main'] = $_GET['main'];
  }
  if(!isset($_SESSION['plant_id']))
  {
    $_SESSION['plant_id'] = $_GET['plant_id'];
  }
  if(!isset($_SESSION['name']))
  {
    $_SESSION['name'] = $_GET['name'];
  }

  //variable to test at the checkbox to check it or not according to db data
  if($_SESSION['main'] == 1)
  {
    $is_checked = true;
  }
  else
  {
    $is_checked = false;
  }


  if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      //when it gets checked from unchecked
      if(isset($_POST['maincheck']) && $is_checked == false)
      {
        //unset the previous main pic of that specific plant
        $sql = "UPDATE picture_data SET main=0 WHERE main=1 AND plant_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['plant_id']]);

        //set the new main and change caption
        $sql = "UPDATE picture_data SET main=1, caption=:caption WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['caption' => htmlentities($_POST["e-cap"]), 'id' =>  $_SESSION["pic_id"]]);
      }
      else if(!isset($_POST['maincheck']) && $is_checked == true) //when it gets unchecked from checked
      {
        //set the new main and change caption
        $sql = "UPDATE picture_data SET main=0, caption=:caption WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['caption' => htmlentities($_POST["e-cap"]), 'id' =>  $_SESSION["pic_id"]]);
      }
      else //other cases when main data doesn't change, just caption update
      {
        $sql = "UPDATE picture_data SET caption=:caption WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['caption' => $_POST["e-cap"], 'id' =>  $_SESSION["pic_id"]]);
      }            
            
        $_SESSION['msg'] = "Picture is edited successfully.";
        header('Location:plant_gallery.php');
        return;  
    }  

?>

  
<?php include "views/head.php"; ?>
<body>
<?php include "views/nav2.php"; ?>
<div class="container-fluid bg-dark text-light p-3 d-flex justify-content-center align-items-center">

<div class="new text-dark d-flex row justify-content-center align-items-center py-3 mx-lg-5 mx-md-3" id="piceditformdiv">
  <p id="edit_pic_msg" class="err_msg text-center"></p>
  
<form id="editpic" method="post" action="edit_pic.php">
        <div class="form-group row justify-content-center align-items-center">
          <label for="e-cap" class="col-lg-3 col-form-label">Caption</label>
          <div class="col-lg-9">
            <textarea type="text" class="form-control" id="e-cap" name="e-cap" rows="5"><?php echo htmlentities($_SESSION['caption']); ?></textarea>
          </div>
        </div><br>
        
        <div class="form-check form-group row d-flex mb-3 mx-2">
          <div class="col-md-3"></div>
          <div class="col-md-9">
            <input class="form-check-input" type="checkbox" name="maincheck" id="maincheck" <?php echo ($is_checked) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="maincheck">
              Set as main picture for the plant
            </label>
          </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-12 col-lg-4 justify-content-center align-items-center my-1 d-flex">
            <a href="plant_gallery.php"><button class="btn" type="button">Go back</button></a>
          </div>
          <div class="col-12 col-lg-4 justify-content-center align-items-center my-2 d-flex">
            <a href="delete_pic.php"><button type="button" class="btn delbtn">Delete picture</button></a>
          </div>
          <div class="form-group col-12 col-lg-4 justify-content-center align-items-center my-1 d-flex">
            <button type="submit" class="btn" form="editpic" value="submit" name="submit" onclick="return validEditPic();">Update</button>
          </div>
        </div>

      </form>
    
</div>
</div> 

<?php include "views/footer.php"; ?>

</body>
</html>