<?php
ob_start();
?>
<?php
if( !headers_sent() && '' == session_id() ) {
session_start();
}
?>
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



/* Responsive layout - makes a one column layout instead of a two-column layout */
@media (max-width: 800px) {
  .flex-container {
    flex-direction: column;
  }

  #f5{
    top: auto;
  }

   header{
     width: 100%;
     height: 20%;
   }

  #misfavs{
    top:0%;
    left: 35%;
    font-size: 25px;
  }

  #buttonmisprod{
    top: 40%;
    left: 35%;
  }

  #buttonmensajes{
    top: 65%;
    left: 35%;
  }

  #zona{
    top: 40%;
    left: 75%;
  }


  #sotaheader{
    text-align: center;
    top: 21%;
    left: 10%;
  }

}







</style>
    <form action="">

    <?php
    
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

    <div id="sotaheader">

    <div class="flex-container">
  

  <?php

$mysql = new mysqli ("b7lgw1cojiripwuqndeg-mysql.services.clever-cloud.com","uwblcfhdgmvbfeos","lmNPuWe4qfOaYyeAyb7c","b7lgw1cojiripwuqndeg");

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

    </div>

  <footer id='f5'>


<a title="Facebook" href="https://www.facebook.com/electrolandspain"> <img src="assets/img/facebook.png" alt="" width="40" height="40"></a>
<a title="Instagram" href="https://www.instagram.com/electrolandspain/"><img src="assets/img/instagram.png" alt="" width="40" height="40"></a>
<br>
Correo: contactoelectroland@gmail.com
<br>
Copyright © 2021 Electroland © de sus respectivos propietarios
</footer>
    
</div>

</form>
</body>
</html>
<?php
ob_end_flush();
?>
