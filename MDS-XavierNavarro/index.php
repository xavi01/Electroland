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
    display:inline-flexbox;
    width: 10%;
    height: auto;
    margin: 25;
    padding: 10;
    background-color: white;
    border-radius: 8%;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.flex-container {
  display: flex;
  flex-wrap: wrap;

  padding-left: 62;
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



#cat{
    width: 250;
    top: 30;
    left: 200;
    border-radius: 50%;
}

#cat-values{
  font-size: 20;
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  background-color: black;
  color: white;
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
$categoria="";

?>


<header>

<button id="atras" name="recargar"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>


<div id="cat" style="width:500px;">
  <select Id="cat-values" name="categorias">
    <option value="0">CATEGORIAS:</option>
    <option value="Ordenadores">Ordenadors</option>
    <option value="Moviles">Moviles</option>
    <option value="Hogar">Hogar</option>

  </select>
</div>


<input type="submit" name="zona" value="Mi zona" id="zona">
<input type="submit" name="iniciar" value="Inicia sesión o Registrate" id="iniciar">
<input type="submit" name="subirproducto" value="+ Subir producto" id="subirproducto">


<input type="text" name="buscador" id="buscador" placeholder="Que quieres buscar?">

<input type="submit" name="b2" value="" id="b2" >

<?php

if (isset($_REQUEST["recargar"])){   //BOTO RECARGAR
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=index.php'>";
} 

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

    $cat = $_REQUEST["categorias"];
  

      if($cat!="0" && $nom_prod!=""){
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos WHERE nombre LIKE '%$nom_prod%' && Vendido=0 && Categoria='$cat' OR descripcion LIKE '%$nom_prod%' && Vendido=0  && Categoria='$cat' ";
      }else if($cat=="0" && $nom_prod!=""){
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos WHERE nombre LIKE '%$nom_prod%' && Vendido=0 OR descripcion LIKE '%$nom_prod%' && Vendido=0 ";
      }else if($cat!="0" && $nom_prod==""){
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos WHERE Categoria='$cat' && Vendido=0 ";
      }
    


    }else{
    $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos WHERE Vendido=0";
    }
    $resultatstaula= $mysql->query($consulta);
    

    while($fila = $resultatstaula->fetch_array()){
        echo "<div id='prod' height='200' width='200'>";
         
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
<br>
Copyright © 2021 Electroland © de sus respectivos propietarios
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