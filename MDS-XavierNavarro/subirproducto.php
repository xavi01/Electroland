<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body  background="assets/img/fondo.png">
<form action="subirproducto.php">

<header id="headsubir">
    
    <input type="submit" name="atras" value="Atras" id="atras">
    <img src="assets/img/logosinfondo.png" alt="" width="180" height="180">
   
 </header>
   
   
   <?php
   if (isset($_REQUEST["atras"])){
       header('Location: index.php'); 
   }
   ?>
   

<div  id="subirproducto1">

<b>Que vas a vender?</b> <br>
<input type="text" name="nombre" id="" class="borderodo"><br><br>
<b>Precio:</b> <br>
<input type="number" name="precio" id="" class="borderodo" width="10"><br><br>
<b>Categoria:</b> <br>
<select name="categorias" class="borderodo">
   <option value="1">Windows Vista</option> 
   <option value="2">Windows 7</option> 
   <option value="3">Windows XP</option>
   <option value="10">Fedora</option> 
   <option value="11">Debian</option> 
   <option value="12">Suse</option> 
</select> <br><br>
<b>Estado:</b> <br>
<select name="estado" class="borderodo" >
   <option value="1">Nuevo</option> 
   <option value="2">Como nuevo</option> 
   <option value="3">Bueno</option>
   <option value="10">Aceptable</option> 
   <option value="11">Dañado</option> 
</select> <br><br>
<b>Descripcion:</b> <br>
<input type="text" name="descripcion" id="" class="borderodo"><br><br>
<b>Imagen:</b> <br>
<input type="file"  name="imagenproducto"/><br><br><br>
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
    $imagen=$_REQUEST["imagenproducto"];
    $usuario=$_REQUEST["contraseña2"];
    $data= date("Y-m-d H:i:s");


    $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, estado, imagen, usuario, data_publicacion)
     VALUES ('$nombre','$descripcion','$precio', '$categoria', '$estado', '$imagen', '$usuario', '$data')";
    $mysql->query($sql) or die ($mysql->error);
    $mysql->close();
}

?>








</form>
</body>
</html>