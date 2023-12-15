<?php
    session_start();
    require_once "pdo.php";
    include "util.php";

    

    //checking if the submit button was clicked
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      //checking if there is a registration with the post email address
      $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
      $stmt->execute([$_POST['email']]); 
      $user = $stmt->fetch();

  
      if(!$user)
      {
        //if not, inserting the new user
        $sql = "INSERT INTO users (email,nick,password) VALUES (:email,:nick,:password);";
            $stmt = $pdo->prepare($sql);
  
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':nick', $_POST['nick']);
            $stmt->bindParam(':password', $_POST['pw1']); 
            $stmt->execute();     
                  

            $_SESSION['msg'] = "Welcome ".htmlentities($_POST['nick'])."!";
            header("Location:welcome.php");
            return;      

      }
      else
      {//error message and redirect

        $_SESSION['msg'] = "There is already an account for ".htmlentities($_POST['email'])." address"; 
        header("Location:register.php");
        return;
      } 
    }    

?>



<?php include "views/head.php"; ?>
<body>
<?php include "views/nav1.php"; ?>

  <div id="reg-bg" class="container-fluid bg-dark text-light p-5">
    <div class="d-lg-flex">
      <div class="col-lg-8">
        <p id="reg_msg" class="err_msg mb-5 text-center"><?php flash_msg();?></p> 
      <form id="regi" method="post" action="register.php">
        <div class="form-group row">
          <label for="email" class="col-lg-2 col-form-label">Email</label>
          <div class="col-lg-6">
            <input type="text" class="form-control" id="email" name="email">
          </div>
          <div class="col-lg-4">
            <span id="email_err" class="err_msg"></span>
          </div>
        </div><br>
        <div class="form-group row">
          <label for="nick" class="col-lg-2 col-form-label">Nickname</label>
          <div class="col-lg-6">
            <input type="text" class="form-control" id="nick" name="nick">
          </div>
          <div class="col-lg-4">
            <span id="nick_err" class="err_msg"></span>
          </div>
        </div><br>
        <div class="form-group row">
          <label for="pw1" class="col-lg-2 col-form-label">Password</label>
          <div class="col-lg-6">
            <input type="password" class="form-control" id="pw1" name="pw1">
          </div>
          <div class="col-lg-4">
            <span class="pw_err" class="err_msg"></span>
          </div>
        </div><br>
        <div class="form-group row">
          <label for="pw2" class="col-lg-2 col-form-label">Password again</label>
          <div class="col-lg-6">
            <input type="password" class="form-control" id="pw2" name="pw2">
            <p class="my-2">6-10 characters.<br>Letters (at least one uppercase and one lower case).<br>At least one number.</p>
          </div>
          <div class="col-lg-4">
            <span class="pw_err" class="err_msg"></span>
            
          </div>
        </div>
        <div class="form-group row">
          <div class="col-lg-5"></div>
          <div class="col-lg-7">
          <div class="col-sm-10">
            <button type="submit" class="btn" form="regi" value="submit" name="submit" onclick="return validateRegi();">Register</button>
          </div>
          </div>
        </div>
      </form>
    </div>

      <div class="col-lg-4 py-5 px-2">
        <img id="reg-img" src="images/long.jpeg" alt="" class="rounded img-fluid h-75">
      </div>
  </div>

  <?php include "views/footer.php"; ?>

</body>
</html>
