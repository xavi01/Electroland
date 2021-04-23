<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #cccccc;">
<style>
#prod{
  width: 10%;
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

#misfavs{
position: absolute;
left: 8%;
top: 2%;
font-size: 30px;
font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

#buttonmisprod{
    background-color: rgb(0, 0, 0);
    color: rgb(255, 255, 255);
    position: absolute;
    right: 8%;
    top: 30;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 20;
    border-radius: 10px;
}

#buttonmensajes{
    background-color: rgb(0, 0, 0);
    color: rgb(255, 255, 255);
    position: absolute;
    right: 17%;
    top: 30;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 20;
    border-radius: 10px;
}



</style>
    <form action="">

    <?php
    session_start();
    $usuari = $_SESSION["nombre_usuario"];

    if (isset($_REQUEST["atras"])){   //BOTO PARA IR ATRAS
      header('Location: index.php');
    } 


    if (isset($_REQUEST["misproductos"])){
      header('Location: misproductos.php');
    }
    
    if (isset($_REQUEST["mensajes"])){
    
      header('Location: chat.php');
    }

    
if (isset($_REQUEST["zona"])){   //BOTO PARA IR A MI ZONA
  header('Location: mizona.php');
} 



    if (isset($_REQUEST["producto1"])){   //BOTO PARA ABRIR PRODUCTO
      $productoelegido = $_REQUEST["producto1"];
      echo $productoelegido;
      $_SESSION["producto"]=$_REQUEST["producto1"];
      echo $_SESSION["producto"];
      header('Location: producto.php');
    } 
    ?>


    <header>
       <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>
       <h1 id="misfavs">MIS FAVORITOS</h1>
       <input type="submit" name="misproductos" value="Mis productos" id="buttonmisprod">
       <input type="submit" name="mensajes" value="Mensajes" id="buttonmensajes">
       <input type="submit" name="zona" value="Mi zona" id="zona">
    </header>



    <div class="flex-container">
  

  <?php

    $mysql = new mysqli ("localhost","root","","electroland");

    if($mysql->connect_error){
      die("Conexio fallida");
    }
  
  $consulta2= "SELECT p.id, p.imagen, p.nombre FROM productos p INNER JOIN productos_megusta pm ON p.id = pm.id_prod WHERE pm.n_usuario = '$usuari'";
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









    </form>
</body>
</html>