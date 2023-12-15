<?php
  session_start();
  include "util.php";




?>

<?php include "views/head.php"; ?>
<body>
  <?php include "views/nav1.php"; ?>

  <div id="reg-bg" class="container-fluid bg-dark text-light p-5">
    <div class="d-lg-flex">
      <div class="col-lg-4 h-50">
      <img id="welc-img" class="img-fluid " src="images/welcome.gif" alt="">    
      </div>

    <div class="col-lg-8 p-5 text-center">
      <h3 class="green" class="mb-auto p-5"><?php flash_msg(); ?></h3>
      <h3 class="mb-auto p-2">Succesful registration!</h3>
      <h4>You can start your own plant community after <a id="login-link" href="login.php">LOGIN</a></h4>
    </div>

  </div>

  


<?php include "views/footer.php"; ?>

</body>
</html> 




