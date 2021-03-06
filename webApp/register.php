<?php
	require("..\Backend\dataAccess.php");

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(@!is_null($_SESSION["username"]) && @!is_null($_SESSION["uid"])){ //Utente loggato
          header("location: notes.php");
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
                setcookie(
                  "UID",
                  checkLogin($username,$password),
                  time() + (10 * 365 * 24 * 60 * 60),"/"
                );
               header("location: notes.php");
            }else{
                echo "Username già utilizzato";
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
    <form action="register.php" method="post">
        <div class="imgcontainer">
            <h1>HackerInside Notes</h1>
        </div>
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pwd" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Email" name="email" required>

            <button type="submit">Registrati</button>
        </div>
    </form>
    </body>
</HTML>