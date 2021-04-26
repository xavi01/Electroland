<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <form action="zonarepartidores.php">


    <?php

        session_start();
        $repartidoractivo =  $_SESSION["repartidor"];

        if (isset($_REQUEST["atras"])){
           header('Location: index.php');
        }

        if (isset($_REQUEST["cerrar"])){
            session_destroy();
            header('Location: index.php');
        }
    ?>


        <header id="headins">
            <button id="atras" name="atras"><img src="assets/img/logosinfondo.png" / width="95" height="95"></button>
            <input type="submit" name="cerrar" value="Cerrar sesión" id="cerrar">
        </header>











    </form>
</body>

</html>