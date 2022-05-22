<?php
    require("..\Backend\dataAccess.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="css/index.css"> <!-- FOGLIO DI STILE INDEX -->
        <title>HackerInside Notes - Downloads</title>
    </head>
    <body>
        <!-- HEADER -->
        <div class="title">
            <h1 style="font-size: 50px;">HackerInside Notes</h1>
            <!-- <img src="img/logo.bmp" />-->
        </div>
        <!-- Barra di navigazione-->
        <ul class="navBar">
            <li><a  href="index.php">HOME</a></li>
            <li><a href="notes.php">HackerInside Notes</a></li>
            <li><a href="register.php">Registrati!</a></li>
            <li><a class="active" href="downloads.php">Downloads</a></li>
        </ul>
        <!-- Contenuto del sito -->
        <div class="contentBox">
            <p class="articolo">
               <b> Software per windows</b><br />
                <br />
                <a href="downloads/HackerInsideNotes.apk">Download!</a>

            </p>

            <p class="articolo">
                <b>App android</b><br />
                <br />
                <a href="downloads/HackerInsideNotes.exe">Download!</a>

            </p>

        </div>

        
    </body>
</html>