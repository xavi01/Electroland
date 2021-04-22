<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #cccccc">
<style>
.flex-container {
  display: flex;
  flex-wrap: wrap;
}

.flex-container > div {
  background-color: #f1f1f1;
  width: 35%;
  margin: 10px;
  text-align: center;
  line-height: 40px;
  font-size: 20px;
  display: inline-block;
  position: relative;

}

#misprod{
position: absolute;
left: 8%;
top: 2%;
font-size: 30px;
font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

#producto{
    display:inline-flexbox;
    padding: 15px;
    margin: 20;
    text-align: center;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 20;
    background-color: white;
    border-radius: 10%;
    width: 300;
    height: auto;
    margin-left: 25;
}

#borrarproducto{
    width: 50;
    height: 50;
    color: transparent;
    background-image: url(assets/img/borrar.png);
    background-color: transparent;
    margin-right: 10;
    border: none;
}


#venderproducto{
    width: 50;
    height: 50;
    color: transparent;
    background-color: transparent;
    background-image: url(assets/img/vender.png);
    border: none;
    margin-right: 10;
}


#editarproducto{
    width: 50;
    height: 50;
    color: transparent;
    background-image: url(assets/img/editar.png);
    background-color: transparent;
    border: none;
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

    if (isset($_REQUEST["atras"])){  //BOTO TIRAR ATRAS
       header('Location: index.php'); 
    }

    if (isset($_REQUEST["venderproducto"])){    //BOTON PARA VENDER PRODUCTO
      echo '<BODY onLoad="Vender()">';
    }

    if (isset($_REQUEST["borrarproducto"])){    //BOTON PARA BORRAR PRODUCTO
        $id_prod = $_REQUEST["borrarproducto"];
        
        $mysql = new mysqli ("localhost","root","","electroland");
  
        if($mysql->connect_error){
          die("Conexio fallida");
        }
  
        $sql= "DELETE FROM productos WHERE id=" . $id_prod;
        
        $mysql->query($sql) or die ($mysql->error);
    }

    if (isset($_REQUEST["editarproducto"])){    //BOTON PARA EDITAR PRODUCTO

      

      
          $id_prod = $_REQUEST["venderproducto"];
     
          $mysql = new mysqli ("localhost","root","","electroland");
    
          if($mysql->connect_error){
            die("Conexio fallida");
          }
    
          $sql= "UPDATE productos SET Vendido=1 WHERE id=" . $id_prod;
          
          $mysql->query($sql) or die ($mysql->error);

      }


?>

<div class="flex-container">

<?php

$mysql = new mysqli ("localhost","root","","electroland");

    if($mysql->connect_error){
        die("Conexio fallida");
    }

    $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos WHERE usuario = '$n_usuario' && Vendido=0";
    $resultatstaula= $mysql->query($consulta);

    while($fila = $resultatstaula->fetch_array()){

        echo "<div id='producto'>";

        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' height='150' width='150'> . <br>";
        echo "<b>Nombre:</b> " . $fila["nombre"] . "<br>";
        echo "<b>Descripcion:</b><br> " . $fila["descripcion"] . "<br>";
        echo "<b>Precio:</b> " . $fila["precio"] . "€<br>";
        echo "<b>Categoria:</b> " . $fila["categoria"] . "<br>";
        echo "<b>Estado:</b> " . $fila["estado"] . "<br>";
        echo "<b>Fecha publicacion:</b> " . $fila["data_publicacion"]."<br>";
        echo "<input type='submit' id='borrarproducto' name='borrarproducto' value='".  $fila["id"] ."'>";
        echo "<input type='submit' id='venderproducto' name='venderproducto' value='".  $fila["id"] ."'>";
        echo "<input type='submit' id='editarproducto' name='editarproducto' value='".  $fila["id"] ."'>";
        echo "</div>";
    }
   

    $mysql->close();

?>

</div>
   

<script>
function Vender() {
     if (confirm('Estas seguro que quieres vender este producto?')){

      header("Location: misproductos.php");
          
        
      } 

    
}
</script>


</form>
</body>
</html>