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

#novender{
    width: 50;
    height: 50;
    color: transparent;
    background-color: transparent;
    background-image: url(assets/img/novender.png);
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

#fotocomprador{
  border-radius: 50px;
}

#titulovender{
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 30;
}

#linkusers{
  color: grey;
  background-color: transparent;
  border: none;
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 20;
}



/* Responsive layout - makes a one column layout instead of a two-column layout */
@media (max-width: 800px) {

  header{
     width: 100%;
     height: 20%;
   }

  #misprod{
    top:0%;
    left: 35%;
    font-size: 25px;
  }

  #buttonfavs{
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
  }


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

<div id="sotaheader">

<?php
   
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

    if (isset($_REQUEST["repartidor"])){

      $repartidor=$_REQUEST["repartidor"];
      $_SESSION["repartidor"] = $repartidor;
    
      header('Location: repartidor.php');
    }

    if (isset($_REQUEST["usuario_compra"])){
      $user_compra=$_REQUEST["usuario_compra"];
      $_SESSION["usuario_elegido"] = $user_compra;
      header('Location: usuario.php');
    }

    if (isset($_REQUEST["novender"])){

      $idprodnovender= $_REQUEST["novender"];

      $mysql = new mysqli ("localhost","root","","electroland");
 
      if($mysql->connect_error){
          die("Conexio fallida");
      }else{
       
      }

      $sql1 = "UPDATE productos SET Vendido=0 WHERE id=$idprodnovender";
      $mysql->query($sql1) or die ($mysql->error);

      $sql = "DELETE FROM ventas WHERE id_producto=$idprodnovender";
      $mysql->query($sql) or die ($mysql->error);

      $mysql->close();

      echo '<BODY onLoad="NoVender()">';
      echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=misproductos.php'>";
    }

    if (isset($_REQUEST["escogercomprador"])){


      $telefono = $_SESSION["telefono"];
      $localidad = $_SESSION["direccion"];
      $comprador = $_REQUEST["escogercomprador"];
      $prod_vender = $_SESSION["producto_vender"];
    
      $mysql = new mysqli ("localhost","root","","electroland");
 
      if($mysql->connect_error){
          die("Conexio fallida");
      }else{
       
      }

      $consulta2= "SELECT * FROM usuarios WHERE n_usuario = '$comprador'";
      $resultats= $mysql->query($consulta2);
    
      while($fila1 = $resultats->fetch_array()){
          $telefonocomprador= $fila1["telefono"];
          $localidadcomprador = $fila1["direccion"];
      }



  
      $sql = "INSERT INTO ventas (usuario_vende, telefono_vende, vende_localidad, usuario_compra, telefono_compra, compra_localidad, id_producto, completado)
       VALUES ('$n_usuario', '$telefono' , '$localidad','$comprador', '$telefonocomprador', '$localidadcomprador', '$prod_vender', 0)";
      $mysql->query($sql) or die ($mysql->error);


      $sql1 = "UPDATE productos SET Vendido=2 WHERE id=$prod_vender";
      $mysql->query($sql1) or die ($mysql->error);

      $mysql->close();

      echo '<BODY onLoad="Vender()">';
    }


    
if (isset($_REQUEST["zona"])){   //BOTO PARA IR A MI ZONA
  header('Location: mizona.php');
} 

    if (isset($_REQUEST["venderproducto"])){    //BOTON PARA VENDER PRODUCTO

      $_SESSION["producto_vender"]= $_REQUEST["venderproducto"];
      
      
      $mysql = new mysqli ("localhost","root","","electroland");
  
      if($mysql->connect_error){
        die("Conexio fallida");
      }

      $sql= "SELECT m.usuario1, u.fotoperfil FROM mensajes m INNER JOIN usuarios u ON u.n_usuario=m.usuario1 WHERE usuario2='".$n_usuario."'";
      
      $resultatstaula= $mysql->query($sql);

      echo "<div id='producto'>";
      echo "<b>SELECCIONA A QUE USUARIO QUIERES VENDER</b><br><br>";

      while($fila = $resultatstaula->fetch_array()){
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["fotoperfil"]) . "' id='fotocomprador' height='50' width='50'>";
        echo "<input type='submit' id='escogercomprador' name='escogercomprador' value='$fila[usuario1]'> <br><br>";
 
      }

      $sql1= "SELECT m.usuario2, u.fotoperfil FROM mensajes m INNER JOIN usuarios u ON u.n_usuario=m.usuario2 WHERE usuario1='".$n_usuario."'";
      
      $resultatstaula= $mysql->query($sql1);

      while($fila = $resultatstaula->fetch_array()){
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["fotoperfil"]) . "' id='fotocomprador' height='50' width='50'>";
        echo "<input type='submit' id='escogercomprador' name='escogercomprador' value='$fila[usuario2]'> <br><br>";
 
      }


      echo "</div>";
      
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
        $idproducto = $fila["id"];
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' height='150' width='150'> . <br>";
        echo "<b>Nombre:</b> " . $fila["nombre"] . "<br>";
        echo "<b>Descripcion:</b><br> " . $fila["descripcion"] . "<br>";
        echo "<b>Precio:</b> " . $fila["precio"] . "€<br>";
        echo "<b>Categoria:</b> " . $fila["categoria"] . "<br>";
        echo "<b>Estado:</b> " . $fila["estado"] . "<br>";
        echo "<b>Fecha publicacion:</b> " . $fila["data_publicacion"]."<br>";
        echo "<input type='submit' id='borrarproducto' name='borrarproducto' value='".  $fila["id"] ."'>";
        echo "<input type='submit' id='venderproducto' name='venderproducto' value='".  $fila["id"] ."'>";
        echo "<input type='submit' id='editarproducto' name='editarproducto' value='".  $fila["id"] ."'><br>";    
        echo "</div>";
    }

    
    $consulta= "SELECT p.id, p.nombre, p.descripcion, p.precio, p.categoria, p.estado, p.imagen, p.data_publicacion, v.repartidor, v.usuario_compra FROM productos p INNER JOIN ventas v ON p.id = v.id_producto WHERE usuario = '$n_usuario' && Vendido=2";
    $resultatstaula= $mysql->query($consulta);

     

    while($fila = $resultatstaula->fetch_array()){
        echo "<div id='producto'>";
        echo "<label id='titulovender'><b>VENDIENDO PRODUCTO...</b></label>";
        $idproducto = $fila["id"];
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' height='150' width='150'> . <br>";
        echo "<b>Nombre:</b> " . $fila["nombre"] . "<br>";
        echo "<b>Descripcion:</b><br> " . $fila["descripcion"] . "<br>";
        echo "<b>Precio:</b> " . $fila["precio"] . "€<br>";
        echo "<b>Categoria:</b> " . $fila["categoria"] . "<br>";
        echo "<b>Estado:</b> " . $fila["estado"] . "<br>";
        echo "<b>Fecha publicacion:</b> " . $fila["data_publicacion"]."<br>";
        echo "<b>Repartidor: </b> <input type='submit' id='linkusers' name='repartidor' value='".  $fila["repartidor"] ."'><br>";
        echo "<b>Comprador: </b> <input type='submit' id='linkusers' name='usuario_compra' value='".  $fila["usuario_compra"] ."'><br>";
        echo "<input type='submit' id='novender' name='novender' value='".  $fila["id"] ."'>";
        echo "<input type='submit' id='editarproducto' name='editarproducto' value='".  $fila["id"] ."'><br>";    
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

<footer id='f4'>

<a title="Facebook" href="https://www.facebook.com/electrolandspain"> <img src="assets/img/facebook.png" alt="" width="40" height="40"></a>
<a title="Instagram" href="https://www.instagram.com/electrolandspain/"><img src="assets/img/instagram.png" alt="" width="40" height="40"></a>
<br>
Correo: contactoelectroland@gmail.com
<br>
Copyright © 2021 Electroland © de sus respectivos propietarios
</footer>
    
</div>
   

<script>
function Vender() {
  alert("En breve se pondra en contacto contigo un repartidor.");   
}

function NoVender() {
  alert("El producto se ha quitado del proceso de venta.");   
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
<?php
ob_end_flush();
?>