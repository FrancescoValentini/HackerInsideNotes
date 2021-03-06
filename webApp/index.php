<?php
    require("..\Backend\dataAccess.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="css/index.css"> <!-- FOGLIO DI STILE INDEX -->
        <title>HackerInside Notes</title>
    </head>
    <body>
        <!-- HEADER -->
        <div class="title">
            <h1 style="font-size: 50px;">HackerInside Notes</h1>
            <!-- <img src="img/logo.bmp" />-->
        </div>
        <!-- Barra di navigazione-->
        <ul class="navBar">
            <li><a class="active" href="index.php">HOME</a></li>
            <li><a href="notes.php">HackerInside Notes</a></li>
            <li><a href="register.php">Registrati!</a></li>
            <li><a href="downloads.php">Downloads</a></li>
        </ul>
        <!-- Contenuto del sito -->
        <div class="contentBox">
            <p class="articolo">
                Benvenuti in <b>HackerInside Notes</b><br />
                <br />
                Questo servizio completamente gratuito consente di prendere appunti e sincronizzarli attraverso il cloud!<br />
                Dalla pagina dei downloads è possibile scaricare il client per android e per windows, per accedere alla web app cliccare su "HackerInside Notes"<br />
            </p>

        </div>
        <div class="contentBox">
            <p class="articolo">
                <b>Statistiche generali</b><br /><br />
                <b>Totale utenti:</b> <?php echo globalCounUsers() ?><br />
                <b>Totale note:</b> <?php echo globalCountNotes() ?><br />
            </p>
        </div>

        
    </body>
</html>