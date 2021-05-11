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
<body  background="assets/img/fondo.png">
<style>


#f8{
    text-align: center;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 15px;
    background-color: #000;
    color: white;
    padding: 10;
    margin: 0;
    width: 98.97%;
    position: absolute;
    top: 88.9%;
    left: 0;
}


#subirproducto1{
    background-color: red;
    height: 700;
}




</style>
<form action="subirproducto.php" method="post" enctype="multipart/form-data">

<header id="headsubir">
    <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>
    <!--<input type="submit" name="atras" value="Atras" id="atras">-->
    <!--<img src="assets/img/logosinfondo.png" alt="" width="180" height="180">-->
    <input type="submit" name="zona" value="Mi zona" id="zona">
</header>


<div id="sotaheader">
     
   <?php
   
   $n_usuario = $_SESSION["nombre_usuario"];

   if (isset($_REQUEST["atras"])){
       header('Location: index.php'); 
   }

       
if (isset($_REQUEST["zona"])){   //BOTO PARA IR A MI ZONA
    header('Location: mizona.php');
} 

   ?>
   

<div  id="subirproducto1">

<b>Que vas a vender?</b> <br>
<input type="text" name="nombre" id="" class="borderodo"><br><br>
<b>Precio:</b> <br>
<input type="number" name="precio" id="" class="borderodo" width="10"><br><br>
<b>Categoria:</b> <br>
<select name="categorias" class="borderodo">
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

</select> <br><br>
<b>Estado:</b> <br>
<select name="estado" class="borderodo" >
   <option value="Nuevo">Nuevo</option> 
   <option value="Como nuevo">Como nuevo</option> 
   <option value="Bueno">Bueno</option>
   <option value="Aceptable">Aceptable</option> 
   <option value="Dañado">Dañado</option> 
</select> <br><br>
<b>Descripcion:</b> <br>
<input type="text" name="descripcion" id="" class="borderodo"><br><br>
<b>Imagen:</b> <br>
<input type="file"  name="imageperfil"/>  <br><br><br>
<input type="submit" name="botonsubirprod" id="botonsubirprod" value="Subir producto" class="botons">

</div>

<?php
    
if (isset($_REQUEST["botonsubirprod"])){
    
    $mysql = new mysqli ("localhost","root","","electroland");
 
    if($mysql->connect_error){
        die("Conexio fallida");
    }else{
     
    }

    $nombre= $_REQUEST["nombre"];
    $descripcion=$_REQUEST["descripcion"];
    $precio=$_REQUEST["precio"];
    $categoria=$_REQUEST["categorias"];
    $estado=$_REQUEST["estado"];
    $data= date("Y-m-d H:i:s");

    $check = getimagesize($_FILES["imageperfil"]["tmp_name"]);

    if($check !== false){
        $image = $_FILES['imageperfil']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));         
    }


    $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, estado, imagen, usuario, data_publicacion, Vendido)
     VALUES ('$nombre','$descripcion','$precio', '$categoria', '$estado', '$imgContent', '$n_usuario', '$data', 0)";
    $mysql->query($sql) or die ($mysql->error);
    $mysql->close();
    echo '<BODY onLoad="SubidoCorrectamente()">';
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


</form>


<script type="text/javascript">

  function SubidoCorrectamente() {
  alert("El producto se ha subido correctamente.");
  }

  function SubidoError() {
  alert("Ha ocurrido un error con la imagen.");
  }

</script>






</body>
</html>
<?php
ob_end_flush();
?>
