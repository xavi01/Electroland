<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #cccccc">

<style>


    
#prod{
    margin: 25;
    padding: 10;
    background-color: white;
    border-radius: 8%;
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

.prodid{
    position: absolute;
    width: 180;
    height: 180;
    background: transparent;
    border: 0;
    color: transparent;
}


/* Responsive layout - makes a one column layout instead of a two-column layout */
@media (max-width: 800px) {
  .flex-container {
    flex-direction: column;
  }
}

</style>
<form action="index.php">

<?php

session_start();
if(isset($_SESSION["user"])){
    echo '<BODY onLoad="mostrarBoton1()">'; //MI ZONA - SUBIR PRODUCTOS
}else{
    echo '<BODY onLoad="mostrarBoton2()">';  //INICIAR SESION
}

?>


<header>
<img src="assets/img/1.JPG" alt="" width="95" height="95">

<nav id="cat" >
<ul>
    <li><a href="#">Categorias</a>
        <ul>
        <li><a href="">Moviles</a></li>
        <li><a href="">Videojuegos</a></li>
        <li><a href="">Ordenadores</a></li>
        <li><a href="">Hogar</a></li>
        </ul>
    </li>
</ul>
</nav>

<input type="submit" name="zona" value="Mi zona" id="zona">
<input type="submit" name="iniciar" value="Inicia sesión o Registrate" id="iniciar">
<input type="submit" name="subirproducto" value="+ Subir producto" id="subirproducto">

<input type="text" name="buscador" id="buscador" placeholder="Que quieres buscar" >

<input type="submit" name="b2" value="" id="b2" >

<?php


if (isset($_REQUEST["zona"])){   //BOTO PARA IR A MI ZONA
    header('Location: mizona.php');
} 

if (isset($_REQUEST["iniciar"])){   //BOTO PARA INICIAR SESION O REGISTRAR-SE

    header('Location: iniciar_sesion_reg.php');
} 

if (isset($_REQUEST["subirproducto"])){   //BOTO PARA INICIAR SESION O REGISTRAR-SE

    header('Location: subirproducto.php');
} 

if (isset($_REQUEST["producto"])){   //BOTO PARA ABRIR PRODUCTO
    $_SESSION["producto"]=$_REQUEST["producto"];
    
    header('Location: producto.php');
} 

/*function mostrarProducto(){
    $_SESSION["producto"]=$_REQUEST["producto"];
    header('Location: producto.php');
}*/

?>

</header>



<div class="flex-container">

<?php

$mysql = new mysqli ("localhost","root","","electroland");

    if($mysql->connect_error){
        die("Conexio fallida");
    }

    if(isset($_REQUEST["b2"])){
    $nom_prod=$_REQUEST["buscador"];
    $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos WHERE nombre LIKE '%$nom_prod%' OR descripcion LIKE '%$nom_prod%' ";
    }else{
    $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos";
    }
    $resultatstaula= $mysql->query($consulta);

    

    while($fila = $resultatstaula->fetch_array()){
        echo "<div id='prod'>";
         
        echo "<input type='submit' name='producto' value='" . $fila["id"] . "' height='180' width='180' class='prodid'>"; 
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' name='producto' height='180' width='180'>";
        echo $fila["nombre"];
     
        echo "</div>";
    }
   
    $mysql->close();

?>

</div>


<footer id="f1">

<a title="Facebook" href="https://www.facebook.com/electrolandspain"> <img src="assets/img/facebook.png" alt="" width="40" height="40"></a>
<a title="Instagram" href="https://www.instagram.com/electrolandspain/"><img src="assets/img/instagram.png" alt="" width="40" height="40"></a>
<br>
Correo: contactoelectroland@gmail.com

</footer>

</form>

<script>
        var zona = document.getElementById('zona');
        var iniciar = document.getElementById('iniciar');
        var subirproducto = document.getElementById('subirproducto');
        
        function mostrarBoton2 () {
            zona.style.display = 'none';
            subirproducto.style.display = 'none';
            iniciar.style.display = 'inline';
        }

        function mostrarBoton1 () {
            zona.style.display = 'inline';
            subirproducto.style.display = 'inline';
            iniciar.style.display = 'none';
        }

</script>

</body>
</html>