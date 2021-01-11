<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <form action="misproductos.php">

<header>
<button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="120" height="120"></button>
</header>

<?php
   session_start();
   $n_usuario = $_SESSION["nombre_usuario"];

   if (isset($_REQUEST["atras"])){
       header('Location: index.php'); 
   }
   ?>
   




</form>
</body>
</html>