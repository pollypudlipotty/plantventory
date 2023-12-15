<?php



    function flash_msg()
    {
        if(isset($_SESSION['msg']))
            {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }   

    }

