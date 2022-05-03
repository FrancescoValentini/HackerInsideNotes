<?php
	require("..\Backend\dataAccess.php");

    session_start();
    header("Content-Type: application/json; charset=UTF-8");
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(!is_null($_SESSION["username"]) && !is_null($_SESSION["uid"])){ //Utente loggato

            $uid = $_SESSION["uid"];
            $titolo = $_POST["titolo"];
            $nota = $_POST["nota"];

            if(!is_null($uid) && !is_null($titolo) && !is_null($nota)){
                
                echo json_encode(["errorCode" => addNote($uid,$titolo,$nota)]);
            }
            //header('location: login.php');
        }else{
            echo "Authentication Error";
        }
    }
?>