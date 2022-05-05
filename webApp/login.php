<?php
	require("..\Backend\dataAccess.php");

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!is_null($_SESSION["username"]) && !is_null($_SESSION["uid"])){ //Utente loggato
            //header('location: login.php');
            echo "Loggato";
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["pwd"];
        if(!is_null($username) && !is_null($password)){
            $userID = checkLogin($username,$password);

            if($userID != -1){
                echo "Utente Valido!";
                $_SESSION["username"] = $username;
                $_SESSION["uid"] = $userID;
                setcookie(
                    "UID",
                    $userID,
                    time() + (10 * 365 * 24 * 60 * 60),"/"
                  );
            }else{
                echo "Utente non valido";
            }

        }
    }

?>

<HTML>
    <head>

    </head>
    <body>
        <form action="login.php" method="POST">
            <input type="text" name="username"> Username <br/>
            <input type="password" name="pwd"> Password <br/>

            <input type="submit" value="Accedi">
        </form>
    </body>
</HTML>