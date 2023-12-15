<?php
  session_start();
    require_once "pdo.php";
    include "util.php";


  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    //check if species name is from the db in lowercase
    $stmt = $pdo->prepare("SELECT id FROM plant_types WHERE LOWER(name)=?");
    $stmt->execute([strtolower($_POST['species'])]); 
    $row = $stmt->fetch();

      if($row == null) //if not redirect and error message
      {
        $_SESSION['msg'] = "You can only choose from the given species.";
        header('Location:add_new.php');
        return;        
      }
      else
      {
        $tid = $row['id']; //else we store the id of the species in a variable
      }      


    $sql = "INSERT INTO plants (user_id,type_id,since,name,notes) VALUES (:uid,:tid,:since,:name,:notes);";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':uid', $_SESSION['usr_id']);
    $stmt->bindParam(':tid', $tid);
    $stmt->bindParam(':since', $_POST['since']);
    $stmt->bindParam(':name', $_POST['pname']);
    $stmt->bindParam(':notes', $_POST['note']);
    $stmt->execute();   
          

    $_SESSION['msg'] = "New <span class='green'>".$_POST['species']."</span> added.";
    header('Location:myplants.php');
    return;  

  } 


?>


<?php include "views/head.php"; ?>
<body>
<?php include "views/nav2.php"; ?>
<div class="container-fluid bg-dark text-light p-3 justify-content-center d-flex">

<div class="new text-dark p-5" id="addformdiv">
  <p id="new_msg" class="err_msg text-center my-5"><?php flash_msg();?></p>
<form class="" id="add_new" method="post" action="add_new.php">
        <div class="form-group row">
          <label for="species" class="col-lg-4 col-form-label">Species</label>
          <div class="col-lg-7">
            <input type="text" class="form-control" id="species" name="species">            
            <small>Required.</small><br>
            <small>You can only choose from the given names. Start typing.</small>
          </div>
          <div class="col-lg-1">
            <span id="spc_err" class="err_msg"></span>
          </div>
        </div><br>

        <div class="form-group row">
          <label for="pname" class="col-lg-4 col-form-label">Name</label>
          <div class="col-lg-7">
            <input type="text" class="form-control" id="pname" name="pname">
            <small>Required.</small><br>
            <small>The name of the species in your language or a unique name of your choice.</small>
          </div>
          <div class="col-lg-1">
            <span id="pname_err" class="err_msg"></span>
          </div>
         </div><br>
          
        <div class="form-group row">
          <label for="since" class="col-lg-4 col-form-label">Since when you have it</label>
          <div class="col-lg-7">
            <input type="date" class="form-control" id="since" name="since">
            <small>Required.</small><br>
          </div>
          <div class="col-lg-1">
            <span id="since_err" class="err_msg"></span>
          </div>
        </div><br>

        <div class="form-group row">
          <label for="note" class="col-lg-4 col-form-label mt-3">Notes</label>
          <div class="col-lg-8">
            <textarea type="text" class="form-control" id="note" name="note" rows="3"></textarea>
            <small>Optional.</small><br>
            <small>From where did you get it. Where you keep it.</small><br>
            <small>Any emotional link to the plant.</small>
          </div>
        </div><br>

        <div class="form-group row">
          <div class="row col-lg-4 p-0">
            <a href="myplants.php"><button class="btn" type="button">Go back</button></a>
          </div>
          <div class="row col-lg-4"><p></p></div>
          <div class="row col-lg-4">
            <button type="submit" class="btn" form="add_new" value="submit" name="submit" onclick="return validateNew();">Add</button>
          </div>
        </div>

      </form>
    
</div>
</div>

  
  


<?php include "views/footer.php"; ?>

</body>
</html> 