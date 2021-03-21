<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<style>
#prod{
    margin: 25;
    padding: 10;
    background-color: white;
    border-radius: 8%;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}
</style>

  <form action="usuario.php">

  <header>
    <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>
  </header>
    
  <?php

    if (isset($_REQUEST["atras"])){   //BOTO PARA IR ATRAS
      header('Location: index.php');
    } 

    session_start();
    $usuario=$_SESSION["usuario_elegido"];

    echo $usuario;

    $mysql = new mysqli ("localhost","root","","electroland");

    if($mysql->connect_error){
        die("Conexio fallida");
    }

    $consulta= "SELECT fotoperfil, direccion FROM usuarios WHERE n_usuario = $usuario";
    $resultatstaula= $mysql->query($consulta);

    while($fila = $resultatstaula->fetch_array()){

      $n_usuario = $fila["n_usuario"];
      echo $n_usuario;
      $fotoperfil = $fila["fotoperfil"];
      $direccion = $fila["direccion"];

    }

    if($fotoperfil != null){
      echo "<img src='data:image/jpeg; base64," . base64_encode($fotoperfil) . "' height='150' width='150'>";
    }

    ?>
    <iframe width="400" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=<?php echo $direccion; ?>
      +(Mi%20nombre%20de%20egocios)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">";
    </iframe> <br><br>

  <?php
  
  $consulta= "SELECT id, imagen FROM productos WHERE usuario = $usuario";
  $resultatstaula= $mysql->query($consulta);

  while($fila = $resultatstaula->fetch_array()){
    echo "<div id='prod'>";
     
    echo "<input type='submit' name='producto' value='" . $fila["id"] . "' height='180' width='180' class='prodid'>"; 
    echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' name='producto' height='180' width='180'>";
    echo $fila["nombre"];
 
    echo "</div>";
}





    $mysql->close();
  ?>

    
    
  </form>
</body>
</html>