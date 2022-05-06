<?php
	require("..\Backend\dataAccess.php");

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(@!is_null($_SESSION["username"]) && @!is_null($_SESSION["uid"])){ //Utente loggato
            header('location: notes.php');
            echo "Loggato";
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["pwd"];
        if(!is_null($username) && !is_null($password)){
            $userID = checkLogin($username,$password);

            if($userID != -1){
                header('location: notes.php');
                $_SESSION["username"] = $username;
                $_SESSION["uid"] = $userID;
                setcookie(
                    "UID",
                    $userID,
                    time() + (10 * 365 * 24 * 60 * 60),"/"
                  );
            }else{
                echo "<center><b>Username o password non validi!</b></center>";
            }

        }
    }

?>

<HTML>
    <head>
    <style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
    </head>
    <body>
    <form action="login.php" method="post">
        <div class="imgcontainer">
            <h1>HackerInside Notes</h1>
        </div>
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pwd" required>

            <button type="submit">Login</button>
        </div>
    </form>
    </body>
</HTML>