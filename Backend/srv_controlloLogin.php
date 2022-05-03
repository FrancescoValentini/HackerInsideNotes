<?php
	require("..\Backend\dataAccess.php");

    session_start();
    header("Content-Type: application/json; charset=UTF-8");
    if($_SERVER["REQUEST_METHOD"] == "GET"){

        if(!is_null($_SESSION["username"]) && !is_null($_SESSION["uid"])){ //Utente loggato
            //header('location: login.php');
            echo json_encode(['uid' => $_SESSION["uid"]]);
        }else{
            echo json_encode(['uid' => -1]);
        }

    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $username = $_POST["username"];
        $password = $_POST["pwd"];
        if(!is_null($username) && !is_null($password)){
            $userID = checkLogin($username,$password);
            if($userID != -1){
                
                $_SESSION["username"] = $username;
                $_SESSION["uid"] = $userID;
                
            }
            echo json_encode(['uid' => $_SESSION["uid"]]);

        }
    }

?>