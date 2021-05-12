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
#prod{
    text-align: center;
    width: 190;
    margin: 25;
    padding: 10;
    background-color: white;
    border-radius: 8%;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.prodid{
    position: absolute;
    width: 180;
    height: 180;
    background: transparent;
    border: 0;
    color: transparent;
}

.flex-container {
  display: flex;
  flex-wrap: wrap;

  padding-left: 62;
}

.flex-container > div {
  position: relative;
  top: auto;
  padding: 20;
  width: 10%;
  margin-right: 40px;
  text-align: center;
  line-height: 40px;
  font-size: 20px; 
  position: relative;
  display: inline-block;
}



#cat{
    width: 250;
    top: 30;
    left: 150;
  
}

#cat-values{
  font-size: 20;
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  background-color: black;
  color: white;
  border-radius: 10px;
}

/* Responsive layout - makes a one column layout instead of a two-column layout */
@media (max-width: 800px) {
  .flex-container {
    
    padding:5;
    text-align: center;
   
  }

  header{
    height: 30%;
    width: 100%;
  }

  #sotaheader{
    top: 30%;
  }


  #buscador{
    top:70%;
    left: 5%;
    width: 250;

  }

  #b2{
    top:70%;
    left:75%;

  }

  #zona{
    left: 30%;
    top:10%
  }

  #zonarepartidores{
    left: 30%;
    top:10%
  }

  #cat{
    top: 40%;
    left: 30%;
  }

  #cat-values {
    font-size: 18;
  }

  #subirproducto{
    left: 55%;
    top:10%
  }

  #iniciar{
    left: 38%;
    top:10%
  }

  #prod{
    margin:5;
    width: 150;
    height: auto;
    font-size: 15;
  }

  #fotoprod{
    width: 130;
    height: 130;
  }

}


</style>
<form action="index.php">

<?php

if(isset($_SESSION["nombre_usuario"])){
$nombreusuario= $_SESSION["nombre_usuario"];
}
//$_SESSION["repartidor"]="hola";

if(isset($_SESSION["user"])){
    echo '<BODY onLoad="mostrarBoton1()">'; //MI ZONA - SUBIR PRODUCTOS
}else if(isset($_SESSION["repartidor"])){
  echo '<BODY onLoad="mostrarBoton3()">'; // ZONA REPARTIDOR
}else{
    echo '<BODY onLoad="mostrarBoton2()">';  //INICIAR SESION
}
$categoria="";

?>


<header>



<button id="atras" name="recargar"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>


<div id="cat" style="width:500px;" class="divss">
  <select Id="cat-values" name="categorias">
    <option value="0">CATEGORIAS:</option>
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
  </select>
</div>


<input type="submit" name="zona" value="Mi zona" id="zona">



<input type="submit" name="zonarepartidores" value="Zona repartidores" id="zonarepartidores">



<input type="submit" name="iniciar" value="Inicia sesión o Registrate" id="iniciar">



<input type="submit" name="subirproducto" value="+ Subir producto" id="subirproducto">



<input type="text" name="buscador" id="buscador" placeholder="Que quieres buscar?">


<input type="submit" name="b2" value="" id="b2" >


</header>

<?php

if (isset($_REQUEST["recargar"])){   //BOTO RECARGAR
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=index.php'>";
} 

if (isset($_REQUEST["zona"])){   //BOTO PARA IR A MI ZONA
    header('Location: mizona.php');
} 

if (isset($_REQUEST["zonarepartidores"])){   //BOTO PARA IR A ZONA REPARTIDORES
  header('Location: zonarepartidores.php');
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



<div id="sotaheader">

<div class="flex-container">

<?php

$mysql = new mysqli ("b7lgw1cojiripwuqndeg-mysql.services.clever-cloud.com","uwblcfhdgmvbfeos","lmNPuWe4qfOaYyeAyb7c","b7lgw1cojiripwuqndeg");

    if($mysql->connect_error){
        die("Conexio fallida");
    }

    if(isset($_REQUEST["b2"])){
    $nom_prod=$_REQUEST["buscador"];
    $cat = $_REQUEST["categorias"];

      if(isset($_SESSION["nombre_usuario"])){

      if($cat!="0" && $nom_prod!=""){
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, usuario, estado, imagen, data_publicacion FROM productos WHERE nombre LIKE '%$nom_prod%' && Vendido=0 && Categoria='$cat' && usuario!='$nombreusuario' OR descripcion LIKE '%$nom_prod%' && Vendido=0  && Categoria='$cat' && usuario!='$nombreusuario' ";
      }else if($cat=="0" && $nom_prod!=""){
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, usuario, estado, imagen, data_publicacion FROM productos WHERE nombre LIKE '%$nom_prod%' && Vendido=0 && usuario!='$nombreusuario' OR descripcion LIKE '%$nom_prod%' && Vendido=0 && usuario!='$nombreusuario'";
      }else if($cat!="0" && $nom_prod==""){
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, usuario, estado, imagen, data_publicacion FROM productos WHERE Categoria='$cat' && Vendido=0 && usuario!='$nombreusuario'";
      }else{
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, usuario, estado, imagen, data_publicacion FROM productos WHERE Vendido=0 && usuario!='$nombreusuario'";
      }
    }else{
      if($cat!="0" && $nom_prod!=""){
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, usuario, estado, imagen, data_publicacion FROM productos WHERE nombre LIKE '%$nom_prod%' && Vendido=0 && Categoria='$cat' OR descripcion LIKE '%$nom_prod%' && Vendido=0  && Categoria='$cat'";
      }else if($cat=="0" && $nom_prod!=""){
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, usuario, estado, imagen, data_publicacion FROM productos WHERE nombre LIKE '%$nom_prod%' && Vendido=0 OR descripcion LIKE '%$nom_prod%' && Vendido=0 ";
      }else if($cat!="0" && $nom_prod==""){
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, usuario, estado, imagen, data_publicacion FROM productos WHERE Categoria='$cat' && Vendido=0 ";
      }else{
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, usuario, estado, imagen, data_publicacion FROM productos WHERE Vendido=0 ";
      }
    }
  
    }else{
      if(isset($_SESSION["nombre_usuario"])){
      $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos WHERE Vendido=0 && usuario!='$nombreusuario'";
      }else{
        $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, data_publicacion FROM productos WHERE Vendido=0 ";
      }
    }
    $resultatstaula= $mysql->query($consulta);
    

    while($fila = $resultatstaula->fetch_array()){
        echo "<div id='prod' height='200' width='200'>";
         
        echo "<input type='submit' name='producto' value='" . $fila["id"] . "' height='180' width='180' class='prodid' id='fotoprod'>"; 
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' name='producto' id='fotoprod' height='180' width='93%'><br>";
        echo $fila["nombre"];
     
        echo "</div>";
    }
    
    $mysql->close();

?>

</div>



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

<script>
        var zona = document.getElementById('zona');
        var iniciar = document.getElementById('iniciar');
        var subirproducto = document.getElementById('subirproducto');
        var zonarepartidores = document.getElementById('zonarepartidores');
        
        function mostrarBoton2 () {
            zona.style.display = 'none';
            subirproducto.style.display = 'none';
            iniciar.style.display = 'inline';
            zonarepartidores.style.display = 'none';
        }

        function mostrarBoton1 () {
            zona.style.display = 'inline';
            subirproducto.style.display = 'inline';
            iniciar.style.display = 'none';
            zonarepartidores.style.display = 'none';
        }

        function mostrarBoton3 () {
            zona.style.display = 'none';
            subirproducto.style.display = 'none';
            iniciar.style.display = 'none';
            zonarepartidores.style.display = 'inline';
        }

</script>

</body>
</html>
<?php
ob_end_flush();
?>
