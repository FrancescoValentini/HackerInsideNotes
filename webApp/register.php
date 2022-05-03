<?php
	require("..\Backend\dataAccess.php");

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(!is_null($_SESSION["username"]) && !is_null($_SESSION["uid"])){ //Utente loggato
            echo ("Loggato");
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["pwd"];
        $email = $_POST["email"];
        if(!is_null($username) && !is_null($password) && !is_null($email)){
            $risultato = register($username,$password,$email);
            
            if($risultato != -1){
                echo "Utente registrato!";
                $_SESSION["username"] = $username;
                $_SESSION["uid"] = checkLogin($username,$password);
            }else{
                echo "Username già utilizzato";
            }

        }
    }

?>

<HTML>
    <head>

    </head>
    <body>
        <form action="register.php" method="POST">
            <input type="text" name="username"> Username <br/>
            <input type="password" name="pwd"> Password <br/>
            <input type="email" name="email"> email <br/>

            
            <input type="submit" value="Registrati">
        </form>
    </body>
</HTML>