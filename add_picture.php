<?php
  session_start();
  include "util.php";

?>

  
<?php include "views/head.php"; ?>
<body>
<?php include "views/nav2.php"; ?>
<div class="container-fluid bg-dark text-light p-3 d-flex justify-content-center align-items-center">

<div class="new text-dark" id="addpicform">
  <p id="img_msg" class="err_msg text-center my-5"><?php flash_msg();?></p>
  
<form class="my-5 mx-auto" id="add_img" method="post" action="upload_picture.php" enctype="multipart/form-data">
        <div class="form-group row mx-3">
          <label for="caption" class="col-lg-4 col-form-label">Caption</label>
          <div class="col-lg-7">
            <textarea type="text" class="form-control" id="caption" name="caption"></textarea>
            <small>Max 150 characters.</small>
          </div>
        </div><br>

        <div class="form-group row mx-3">            
            <label class="col-lg-4 col-form-label">Picture</label>
            <div class="col-lg-7 justify-content-center align-items-center d-md-flex">
                <label for="fileInput" class="custom-btn">Browse</label> <!--- making a custom button and file-name field for img upload --->
                <input type="file" class="form-control d-none" id="fileInput" name="uploaded_file" accept=".jpg,.jpeg,.png"/> <!--- hiding the original one --->
                <input type="text" name="f_name_show" id="f_name_show" placeholder="No file selected." class="text-center" disabled>
            </div>
        </div><br>

    
        <div class="form-group row mx-3">
          <div class="col-lg-4 mx-auto">
            <a href="myplants.php"><button class="btn" type="button">Go back</button></a>
          </div>
          <div class="col-lg-4"><p></p></div>
          <div class="col-lg-4 mx-auto">
            <button type="submit" class="btn" form="add_img" value="submit" name="submit" onclick="return validImgForm();">Upload</button>
          </div>
        </div>    
            
      </form>
    
</div>
</div> 

<?php include "views/footer.php"; ?>

</body>
</html>


























