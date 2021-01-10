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

    <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="120" height="120"></button>
    <!--<input type="submit" name="atras" value="Atras" id="atras">-->
    <!--<img src="assets/img/logosinfondo.png" alt="" width="180" height="180">-->
   
 </header>
   
   
   <?php
   session_start();
   $n_usuario = $_SESSION["nombre_usuario"];

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
   <option value="Moviles">Moviles</option> 
   <option value="Videojuegos">Videojuegos</option> 
   <option value="Ordenadores">Ordenadores</option>
   <option value="Hogar">Hogar</option> 

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
    $data= date("Y-m-d H:i:s");


    $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, estado, imagen, usuario, data_publicacion)
     VALUES ('$nombre','$descripcion','$precio', '$categoria', '$estado', '$imagen', '$n_usuario', '$data')";
    $mysql->query($sql) or die ($mysql->error);
    $mysql->close();
}

?>

<footer id="f1">

<a title="Facebook" href="https://www.facebook.com/electrolandspain"> <img src="assets/img/facebook.png" alt="" width="40" height="40"></a>
<a title="Instagram" href="https://www.instagram.com/electrolandspain/"><img src="assets/img/instagram.png" alt="" width="40" height="40"></a>
<br>
Correo: contactoelectroland@gmail.com

</footer>






</form>
</body>
</html>