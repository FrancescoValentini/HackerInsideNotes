<?php
    require("..\Backend\dataAccess.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(is_null($_SESSION["username"]) && is_null($_SESSION["uid"])){ //Utente loggato
            //header('location: login.php');
            header("location: login.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="stylesheet" href="./css/main.css">
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
</head>
<body>
    <div class="notes" id="app">
        <!-- <div class="notes__sidebar">
            <button class="notes__add" type="button">Add Note</button>
            <div class="notes__list">
                <div class="notes__list-item notes__list-item--selected">
                    <div class="notes__small-title">Lecture Notes</div>
                    <div class="notes__small-body">I learnt nothing today.</div>
                    <div class="notes__small-updated">Thursday 3:30pm</div>
                </div>
            </div>
        </div>
        <div class="notes__preview">
            <input class="notes__title" type="text" placeholder="Enter a title...">
            <textarea class="notes__body">I am the notes body...</textarea>
        </div> -->
    </div>
    <script src="./js/main.js" type="module"></script>
    <script>
    /*$.post("http://192.168.1.21/hackerinsidenotes/Backend/srv_controlloLogin.php",
    {
      username: "admin",
      pwd: "admin"
    },
    function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      console.log(data);
    });*/
    
    </script>
</body>
</html>
