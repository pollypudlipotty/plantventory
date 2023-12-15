<?php
  session_start();
    require_once "pdo.php";
    include "util.php";


  //manking sure that only that plant can be updated which was clicked Edit
  if(!isset($_SESSION['plant_id']))
  {
    $_SESSION['plant_id'] = $_GET['plant_id'];
  }

  //getting all data for the plant including the type name from plant_types table
  $stmt = $pdo->prepare("SELECT plants.id, plants.user_id, plants.since, plants.name, plants.notes, plant_types.name AS type_name
                          from plants inner join plant_types on plants.type_id=plant_types.id where plants.id = ?");
  $stmt->execute([$_SESSION['plant_id']]);
  $plantinfo = $stmt->fetch(PDO::FETCH_ASSOC);  

  //setting species name session data for flash messages when delete and update
  $_SESSION['sp_name'] = $plantinfo['type_name'];

  //putting the species id into a session variable for update
  $_SESSION['type_id'] = $plantinfo['type_id'];

?>

  
<?php include "views/head.php"; ?>
<body>
<?php include "views/nav2.php"; ?>
<div class="container-fluid bg-dark text-light p-3 d-flex justify-content-center align-items-center">

<div class="new text-dark m-md-5" id="editplantform">
  <p id="edit_msg" class="err_msg text-center my-5"></p>
  
<form class="m-1" id="edit" method="post" action="edit_plant.php">
        <div class="form-group row">
          <label for="e-species" class="col-lg-4 col-form-label">Species</label>
          <div class="col-lg-7">
            <input type="text" class="form-control" id="e-species" name="e-species" value="<?php echo $_SESSION['sp_name']; ?>" disabled>
          </div>
        </div><br>

        <div class="form-group row">
          <label for="e-pname" class="col-lg-4 col-form-label">Name</label>
          <div class="col-lg-7">
            <input type="text" class="form-control" id="e-pname" name="e-pname" value="<?php echo htmlentities($plantinfo['name']);?>">
            <small>Required.</small><br>
            <small>The name of the species in your language or a unique name of your choice.</small>
          </div>
          <div class="col-lg-1">
            <span id="e-pname_err" class="err_msg"></span>
          </div>
         </div><br>
          
        <div class="form-group row">
          <label for="e-since" class="col-lg-4 col-form-label">Since when you have it</label>
          <div class="col-lg-7">
            <input type="date" class="form-control" id="e-since" name="e-since" value="<?php echo $plantinfo['since']; ?>">
            <small>Required.</small><br>
          </div>
          <div class="col-lg-1">
            <span id="e-since_err" class="err_msg"></span>
          </div>
        </div><br>

        <div class="form-group row">
          <label for="e-note" class="col-lg-4 col-form-label">Notes</label>
          <div class="col-lg-8">
            <textarea type="text" class="form-control" id="e-note" name="e-note"><?php echo htmlentities($plantinfo['notes']); ?></textarea>
            <small>Optional.</small><br>
            <small>From where did you get it. Where you keep it.</small><br>
            <small>Any emotional link to the plant.</small>
          </div>
        </div><br>

        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-12 col-lg-4 justify-content-center align-items-center my-1 d-flex">
            <a href="myplants.php"><button class="btn" type="button">Go back</button></a>
          </div>
          <div class="col-12 col-lg-4 justify-content-center align-items-center my-2 d-flex">
            <a href="delete_plant.php"><button type="button" class="btn delbtn">Delete plant</button></a>
          </div>
          <div class="form-group col-12 col-lg-4 justify-content-center align-items-center my-1 d-flex">
            <button type="submit" class="btn" form="edit" value="submit" name="submit" onclick="return validateEdit();">Update</button>
          </div>
        </div>

      </form>
    
</div>
</div> 
  


<?php include "views/footer.php"; ?>

</body>
</html>