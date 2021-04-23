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

#buttonfavs{
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
    right: 14%;
    top: 30;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 20;
    border-radius: 10px;
}


</style>
<form action="misproductos.php">

<header>
<button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button> 
<h1 id="misprod">MIS PRODUCTOS</h1>
<input type="submit" name="mensajes" value="Mensajes" id="buttonmensajes">
<input type="submit" name="favoritos" value="Favoritos" id="buttonfavs">
<input type="submit" name="zona" value="Mi zona" id="zona">
</header>

<?php
   session_start();
   $n_usuario = $_SESSION["nombre_usuario"];

    if (isset($_REQUEST["atras"])){  //BOTO TIRAR ATRAS
       header('Location: index.php'); 
    }

    if (isset($_REQUEST["favoritos"])){

      header('Location: favoritos.php');
    }
    
    if (isset($_REQUEST["mensajes"])){
    
      header('Location: chat.php');
    }

    
if (isset($_REQUEST["zona"])){   //BOTO PARA IR A MI ZONA
  header('Location: mizona.php');
} 

    if (isset($_REQUEST["venderproducto"])){    //BOTON PARA VENDER PRODUCTO

      $id_prod = $_REQUEST["venderproducto"];
     
      $mysql = new mysqli ("localhost","root","","electroland");

      if($mysql->connect_error){
        die("Conexio fallida");
      }

      $sql= "UPDATE productos SET Vendido=1 WHERE id=" . $id_prod;
      
      $mysql->query($sql) or die ($mysql->error);

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

        echo '<BODY onLoad="Eliminar()">';
    }

    if (isset($_REQUEST["editarproducto"])){    //BOTON PARA EDITAR PRODUCTO
      $_SESSION["producto_editar"]= $_REQUEST["editarproducto"];
      
      $mysql = new mysqli ("localhost","root","","electroland");
  
      if($mysql->connect_error){
        die("Conexio fallida");
      }

      $sql= "SELECT * FROM productos WHERE id=" . $_SESSION["producto_editar"];
      
      $resultatstaula= $mysql->query($sql);

      while($fila = $resultatstaula->fetch_array()){

        echo "<div id='producto'>";
        echo "<b>PRODUCTO A EDITAR</b><br><br>";
        echo "<b>IMAGEN: </b>";
        echo"<input type='file'  name='fotoproducto'/>";
        echo "<b>Nombre:</b> <input type='text' name='nombre' value='" . $fila["nombre"] ."' id=''><br>";
        echo "<b>Descripcion:</b><br>  <input type='text' name='descripcion' value='" . $fila["descripcion"] ."' id=''><br>";
        echo "<b>Precio:</b>  <input type='text' name='precio' value='" . $fila["precio"] ."' id=''><br>";
        echo "<b>Categorias:</b><br>";
        ?>
        <select  name="categorias">
        <option value="Informática">Informática</option>
        <option value="Gaming">Gaming</option>
        <option value="Accesorios de informática">Accesorios de informática</option>
        <option value="Telefonía">Telefonía</option>
        <option value="Televisión">Televisión</option>
        <option value="Audio y Hifi">Audio y Hifi</option>
        <option value="Smart Home">Smart Home</option>
        <option value="Consolas y Videojuegos">Consolas y Videojuegos</option>
        <option value="Electrodomésticos">Electrodomésticos</option>
        <option value="Belleza y Salud">Belleza y Salud</option>
        <option value="Climatización y Calefacción">Climatización y Calefacción</option>
        <option value="Deporte">Deporte</option>
        <option value="Fotografía">Fotografía</option>
        <option value="Cine, musica y libros">Cine, musica y libros</option>
        </select><br>
        <?php
        echo "<b>Estado:</b><br>";
        ?>
        <select name="estado" >
        <option value="Nuevo">Nuevo</option> 
        <option value="Como nuevo">Como nuevo</option> 
        <option value="Bueno">Bueno</option>
        <option value="Aceptable">Aceptable</option> 
        <option value="Dañado">Dañado</option> 
        </select><br><br>
        <input type="submit" name="buttoneditarproducto" class='botons' value="ACTUALIZAR">

       <?php


        echo "</div>";
    }
   


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

<?php

if(isset($_REQUEST["buttoneditarproducto"])){
  $nombre=$_REQUEST["nombre"];
  $descripcion=$_REQUEST["descripcion"];
  $precio=$_REQUEST["precio"];
  $categoria=$_REQUEST["categorias"];
  $estado=$_REQUEST["estado"];

  $mysql = new mysqli ("localhost","root","","electroland");

  if($mysql->connect_error){
    die("Conexio fallida");
  }

  $sql= "UPDATE productos SET nombre='" . $nombre . "', descripcion='" . $descripcion . "',  precio=" . $precio . ", categoria='" . $categoria . "',  estado='" . $estado . "'  WHERE id=" . $_SESSION["producto_editar"];
  $mysql->query($sql) or die ($mysql->error);
  
  echo '<BODY onLoad="Editar()">';
  
  echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=misproductos.php'>";
}


?>
   

<script>
function Vender() {
  alert("El producto se ha marcado como vendido.");   
}

function Eliminar() {
  alert("El producto se ha eliminado correctamente.");   
}

function Editar() {
  alert("El producto se ha actualizado correctamente.");   
}


</script>


</form>
</body>
</html>