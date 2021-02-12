<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <form action="producto.php">
    
    <header>
          <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>
    </header>


    <?php

        if (isset($_REQUEST["atras"])){   //BOTO PARA IR A MI ZONA
           header('Location: index.php');
        } 

    session_start();
    $id_producto = $_SESSION["producto"];

    echo $id_producto;



    
    ?>
    
    </form>
</body>
</html>