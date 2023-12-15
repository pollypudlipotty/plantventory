<?php
  session_start();
    require_once "pdo.php";
    include "util.php";

    //getting the data of friends pf the user
    $sql = "SELECT * FROM friends WHERE (friend1_id = ? OR friend2_id = ?)";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([$_SESSION['usr_id'],$_SESSION['usr_id']]);
    $friend_list = $stmt ->fetchAll(PDO::FETCH_ASSOC);


    $nofriend_message = "";
   

    //if user has no friends
    if(!$friend_list)
    {
       $nofriend_message = "You do not have friends yet.";
    }
    else
    { 
        $pending_card_str = "";
        
        //checking if user has pending friends (status = 0)
        for($i = 0; $i < count($friend_list); $i++)
        {
            if($friend_list[$i]['status'] == 0)
            {
                //if user requested friendship
                if($friend_list[$i]['friend1_id'] == $_SESSION['usr_id'])
                {
                    
                }
                $pending_card_str = $pending_card_str.'<div class="col-sm-4 my-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Special title treatment</h5>
                                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>';
            }
        }
    }


?>

<?php include "views/head.php"; ?>
<body>
<?php include "views/nav2.php"; ?>
<div class="container-fluid bg-dark text-light p-3">
    <div class="container mt-3">
        <h4><?php echo $nofriend_message; ?></h4>
    </div>

    <div class="row">
        <?php echo $pending_card_str; ?>
    </div>





</div>  
  


<?php include "views/footer.php"; ?>

</body>
</html> 