<?php
	require("..\Backend\dataAccess.php");

    session_start();
    header("Content-Type: application/json; charset=UTF-8");
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(!is_null($_SESSION["username"]) && !is_null($_SESSION["uid"])){ //Utente loggato

            $uid = $_POST["uid"];

            if(!is_null($uid)){
                echo json_encode(getNotes($uid));
    
            }
            //header('location: login.php');
        }else{
            echo "Authentication Error";
        }


    }

?>