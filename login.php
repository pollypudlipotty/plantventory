<?php
    session_start();
    require_once "pdo.php";
    include "util.php";


    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
      $stmt->execute([$_POST['email']]); 
      $user = $stmt->fetch();

      if($user == null)
      {
        $_SESSION['msg'] = "There is no registration with the address: ".htmlentities($_POST['email'])."!";
        header('Location:login.php');
        return;        
      }
      else
      {
        if($user['password'] != $_POST['pw'])
        {
          $_SESSION['msg'] = "Wrong password!";
          $_SESSION['email'] = $_POST['email'];
          header('Location:login.php');
          return;       
        }
        else
        {
          $_SESSION['usr_id'] = $user['id'];
          $_SESSION['nick'] = $user['nick'];
          header('Location:index.php');
          return;
        }
      }       
        
    }

    function emailFill()
    {
      if(isset($_SESSION['email']))
      {
        echo htmlentities($_SESSION['email']);
        unset($_SESSION['email']);
      }   
    }   

?>


<?php include "views/head.php"; ?>
<body>
<?php include "views/nav1.php"; ?>

  <div id="reg-bg" class="container-fluid bg-dark text-light p-5">
    <div class="d-lg-flex">
      <div class="col-lg-8 text-center">
      <p id="login_err" class="err_msg mb-5 text-center"><?php flash_msg();?></p> 
      
      <form id="in" method="post" action="login.php">

        <div class="form-group row">
          <label for="email" class="col-lg-2 col-form-label">Email</label>
          <div class="col-lg-6">
            <input type="text" class="form-control" id="email" name="email" value= <?php emailFill(); ?> >
          </div>
          <div class="col-lg-4">
            <span id="e_err" class="err_msg"></span>
          </div>
        </div><br>

        <div class="form-group row">
          <label for="pw" class="col-lg-2 col-form-label">Password</label>
          <div class="col-lg-6">
            <input type="password" class="form-control" id="pw" name="pw">
          </div>
          <div class="col-lg-4">
            <span id="p_err" class="err_msg"></span>
          </div>
        </div>
        
        <div class="form-group row mt-5">
          
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn" form="in" value="login" name="login" onclick="return validateLogin();">Login</button>
          </div>
          
        </div>
      </form>
    </div>

    <div class="col-lg-4 p-5 d-flex justify-content-center">
        <img id="reg-img" src="images/wave.jpg" alt="" class="rounded img-fluid  w-75">
    </div>

    </div>

  </div>      

  <?php include "views/footer.php"; ?>

</body>
</html>
