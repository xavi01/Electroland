<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<style>
.flex-container {
  display: flex;
  flex-wrap: nowrap;
  /*background-color: DodgerBlue;*/
}

.flex-container > div {
  background-color: #f1f1f1;
  width: 35%;
  margin: 10px;
  text-align: center;
  line-height: 40px;
  font-size: 20px;
}

#misprod{

position: absolute;
left: 8%;
top: 2%;
font-size: 30px;
font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

}

</style>
<form action="misproductos.php">

<header>
<button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button> 
<h1 id="misprod">MIS PRODUCTOS</h1>
</header>

<?php
   session_start();
   $n_usuario = $_SESSION["nombre_usuario"];

   if (isset($_REQUEST["atras"])){
       header('Location: index.php'); 
   }
?>

<div class="flex-container">

<?php

$mysql = new mysqli ("localhost","root","","electroland");

    if($mysql->connect_error){
        die("Conexio fallida");
    }

    $consulta= "SELECT nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos WHERE usuario = '$n_usuario'";
    $resultatstaula= $mysql->query($consulta);

    while($fila = $resultatstaula->fetch_array()){

        echo "<div>";
        echo "Nombre: " . $fila["nombre"] . "<br>";
        echo "Descripcion: " . $fila["descripcion"] . "<br>";
        echo "Precio: " . $fila["precio"] . "<br>";
        echo "Categoria: " . $fila["categoria"] . "<br>";
        echo "Estado: " . $fila["estado"] . "<br>";
        echo "Data publicacion: " . $fila["data_publicacion"]."<br>";
      
        
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' height='250' width='250'>";
 
        echo "</div>";
    }
   

    $mysql->close();

?>

</div>
   




</form>
</body>
</html>