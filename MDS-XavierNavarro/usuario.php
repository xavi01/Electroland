<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #cccccc">
<form action="usuario.php">
<style>


#prod{
    text-align: center;
    width: 190;
    margin: 25;
    padding: 10;
    background-color: white;
    border-radius: 8%;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.prodid{
    position: absolute;
    width: 180;
    height: 180;
    background: transparent;
    border: 0;
    color: transparent;
}

.flex-container {
  display: flex;
}

.flex-container > div {
  padding: 20;
  width: 10%;
  margin-right: 40px;
  text-align: center;
  line-height: 40px;
  font-size: 20px; 
  position: relative;
  display: inline-block;

}


</style>


  <header>
    <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>
    
  </header>

    
  <?php
      session_start();
      $usuario=$_SESSION["usuario_elegido"];

    if (isset($_REQUEST["atras"])){   //BOTO PARA IR ATRAS
      header('Location: index.php');
    } 

    $mysql = new mysqli ("localhost","root","","electroland");

    if($mysql->connect_error){
        die("Conexio fallida");
    }

    $consulta1= "SELECT n_usuario, fotoperfil, direccion FROM usuarios WHERE n_usuario = '$usuario'";
    $resultatstaula= $mysql->query($consulta1);

    while($fila = $resultatstaula->fetch_array()){

      $n_usuario = $fila["n_usuario"];
      $fotoperfil = $fila["fotoperfil"];
      $direccion = $fila["direccion"];

    }

    
    if($fotoperfil != null){
      echo "<img src='data:image/jpeg; base64," . base64_encode($fotoperfil) . "' height='150' width='150'>";
    }

echo "<b2>". $n_usuario ."</b2>";

    ?>
    <iframe width="400" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=<?php echo $direccion; ?>
      +(Mi%20nombre%20de%20egocios)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">";

    </iframe> <br><br>


    <div class="flex-container">
  

  <?php
  
  $consulta2= "SELECT id, imagen, nombre FROM productos WHERE usuario = '$usuario'";
  $resultats= $mysql->query($consulta2);

  while($fila1 = $resultats->fetch_array()){
    echo "<div id='prod'>";
     
    echo "<input type='submit' name='producto1' value='" . $fila1["id"] . "' class='prodid'>"; 
    echo "<img src='data:image/jpeg; base64," . base64_encode($fila1["imagen"]) . "' name='producto' height='180' width='180'> <br>";
    echo $fila1["nombre"];
 
    echo "</div>";
}

    $mysql->close();
  ?>

  <div>

  <?php
    if (isset($_REQUEST["producto"])){   //BOTO PARA ABRIR PRODUCTO
      $_SESSION["producto"]=$_REQUEST["producto1"];
      header('Location: producto.php');
    } 

  ?>

    
    
  </form>
</body>
</html>