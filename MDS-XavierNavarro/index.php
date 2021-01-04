<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<form action="index.php">

<?php

session_start();
if(isset($_SESSION["user"])){
    echo '<BODY onLoad="mostrarBoton1()">';
}else{
    echo '<BODY onLoad="mostrarBoton2()">';
}

?>



<header>
<img src="assets/img/1.JPG" alt="" width="120" height="120">

<nav id="cat">
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

<input type="text" name="buscador" id="buscador" placeholder="Que quieres buscar" >

<input type="submit" name="b2" value="" id="b2" >

<?php


if (isset($_REQUEST["zona"])){

    header('Location: mizona.php');

} 

if (isset($_REQUEST["iniciar"])){

    header('Location: iniciar_sesion_reg.php');

} 

?>




</header>




<div>




</div>


<footer id="f1">

<a title="Facebook" href="https://www.facebook.com/electrolandspain"> <img src="assets/img/facebook.png" alt="" width="40" height="40"></a>
<a title="Instagram" href="https://www.instagram.com/electrolandspain/"><img src="assets/img/instagram.png" alt="" width="40" height="40"></a>
<br>
Correo: contactoelectroland@gmail.com

</footer>



    <script>
        var zona = document.getElementById('zona');
        var iniciar = document.getElementById('iniciar');
        
        function mostrarBoton2 () {
            zona.style.display = 'none';
            iniciar.style.display = 'inline';
        }

        function mostrarBoton1 () {
            zona.style.display = 'inline';
            iniciar.style.display = 'none';
        }
    </script>



</form>


</body>
</html>