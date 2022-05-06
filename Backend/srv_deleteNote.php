<?php
	require("..\Backend\dataAccess.php");

    session_start();
    header("Content-Type: application/json; charset=UTF-8");
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!is_null($_SESSION["username"]) && !is_null($_SESSION["uid"])){ //Utente loggato

            $noteID = $_POST["noteID"];

            if(!is_null($noteID) ){
                
                echo json_encode(["errorCode" => deleteNote($noteID)]);
            }
            //header('location: login.php');
        }else{
            echo "Authentication Error";
        }
    }
?>