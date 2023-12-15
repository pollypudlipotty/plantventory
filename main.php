<?php
  


  function navbarSet()
  {
      if(!isset($_SESSION['usr_id']))
      {
          include "views/nav1.php";
      }
      else
      {
          include "views/nav2.php";
      }
  }




?>

<?php include "views/head.php"; ?>
<body>
<?php navbarSet(); ?>
<?php
  if(!isset($_SESSION['usr_id']))
  {
    include "views/home.php";
  }
  else
  {
    include "acc.php";
  }
?>

<?php include "views/footer.php"; ?>

</body>
</html> 




