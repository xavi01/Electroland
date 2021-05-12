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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #cccccc">
<style>

#tot{
width: 100%;
margin-bottom: 20;
text-align: center;
}


#corazon{
    width: 60px;
    height: 60px;
    background-image: url(assets/img/corazzonn.png);
    background-color: white;
    border: 0;
    border-radius: 15px;
}

#corazonrojo{
    width: 60px;
    height: 60px;
    background-image: url(assets/img/corazzon.png);
    background-color: white;
    border: 0;
    border-radius: 15px;
}
.corazon :focus {
    border: 1px black;
    background-color: yellow;
}

#producto{
    position: relative;
    left: 35%;
    margin-top: 25px;
    padding: 30;
    text-align: center;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 20;
    background-color: white;
    border-radius: 10%;
    width: 400px;
    height: auto;
}

#button_usuario{
    border: 0;
    font-size: 20;
    background-color: transparent;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    color: grey;
}

/* Responsive layout - makes a one column layout instead of a two-column layout */
@media (max-width: 800px) {
#f6{
    top: auto;
  }


#zonarepartidores{
    top: 20%;
    left: 55%;
}

#iniciar{
    top: 20%;
    left: 40%;
}

#subirproducto{
    top: 25%;
    left: 35%;
}

#zona{
    left: 75%;
    top:25%
}


#producto{
    padding-top: 15;

    left: 3%;
    width: 80%;
    font-size: 16;
}

#frame{
    width: 300;
}

#fotoproducto{
    width: 250;
    height: 250;
}

}

</style>


<form action="producto.php">
    
<?php


$id_producto = $_SESSION["producto"];
?>

    <header>
    <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>
    <?php
    if(isset($_SESSION["user"])){
    ?>
    <input type="submit" name="zona" value="Mi zona" id="zona">
    <input type="submit" name="subirproducto" value="+ Subir producto" id="subirproducto">   
    <?php
       }else if(isset($_SESSION["repartidor"])){
    ?>
        <input type="submit" name="zonarepartidores" value="Zona repartidores" id="zonarepartidores">
    <?php
        }else{
    ?>
      <input type="submit" name="iniciar" value="Inicia sesión o Registrate" id="iniciar">
    <?php
        }
    ?>
  </header>

<div id="sotaheader">


  <div id="tot">

    <?php

        if (isset($_REQUEST["atras"])){   //BOTO PARA IR A MI ZONA
           header('Location: index.php');      
        } 

        if (isset($_REQUEST["nombre_usuario"])){      //BUTTON VER USUARIO
            $_SESSION["usuario_elegido"] = $_REQUEST["nombre_usuario"];   
            header('Location: usuario.php');  
        } 

        if (isset($_REQUEST["zona"])){   //BOTO PARA IR A MI ZONA
            header('Location: mizona.php');
          } 
          
          
          if (isset($_REQUEST["subirproducto"])){   //BOTO PARA INICIAR SESION O REGISTRAR-SE
          
            header('Location: subirproducto.php');
          }


          if (isset($_REQUEST["zonarepartidores"])){   //BOTO PARA IR A ZONA REPARTIDORES
            header('Location: zonarepartidores.php');
          } 
          
          if (isset($_REQUEST["iniciar"])){   //BOTO PARA INICIAR SESION O REGISTRAR-SE
          
              header('Location: iniciar_sesion_reg.php');
          } 

          $mysql = new mysqli ("b7lgw1cojiripwuqndeg-mysql.services.clever-cloud.com","uwblcfhdgmvbfeos","lmNPuWe4qfOaYyeAyb7c","b7lgw1cojiripwuqndeg");

    if($mysql->connect_error){
        die("Conexio fallida");
    }

    $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, usuario, data_publicacion, vendido FROM productos where ID = $id_producto";
    $consulta2= "SELECT u.direccion FROM usuarios u INNER JOIN productos p ON u.n_usuario = p.usuario where p.ID = $id_producto";
    $resultatstaula= $mysql->query($consulta);

    $resultatdireccio= $mysql->query($consulta2);

    while($fila = $resultatstaula->fetch_array()){
           
        echo "<div id='producto'>";
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' name='producto' id='fotoproducto' height='350' width='350'>  <br>";   
        echo "<b>Usuario: </b><input type='submit' value='". $fila['usuario'] ."' name='nombre_usuario' id='button_usuario'> <br>";       
        echo "<b>Nombre: </b>" . $fila["nombre"] . "<br>";
        echo "<b>Descripcion: </b>" . $fila["descripcion"] . "<br>";
        echo "<b>Precio: </b>" . $fila["precio"] . "€ <br>";
        echo "<b>Categoria: </b>" . $fila["categoria"] . "<br>";
        echo "<b>Estado: </b>" . $fila["estado"] . "<br>";
        echo "<b>Fecha publicacion: </b>" . $fila["data_publicacion"]."<br>";
        echo "<b>Direccion: </b><br>";
        $dequieneselproducto = $fila["usuario"];
        $vendido = $fila["vendido"];
    } 

    while($fila = $resultatdireccio->fetch_array()){
        $direccio = $fila["direccion"];
      }

    ?>

    
    <iframe id="frame" width="400" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=<?php echo $direccio; ?>
        +(Mi%20nombre%20de%20egocios)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">";
    </iframe> <br><br>
    
    <?php

    if(isset($_SESSION["nombre_usuario"])){
        
        if($_SESSION["nombre_usuario"] != $dequieneselproducto AND $vendido!=1){

        $n_usuario = $_SESSION["nombre_usuario"];
        $query= mysqli_query ($mysql,"SELECT * FROM productos_megusta WHERE n_usuario = '$n_usuario' AND id_prod = '$id_producto' ");
        $row_cnt = $query->num_rows;


        if ($row_cnt > 0) {
            echo "<input type='submit' id='corazonrojo' name='corazonrojo' value=''>";
        } else {
            echo "<input type='submit' id='corazon' name='corazon' value=''>";
        }

       }else{

       }

    }

    if(isset($_REQUEST['corazon'])){
        echo '<BODY onLoad="mostrarCorazonRojo()">';
      echo "<input type='submit' id='corazonrojo' name='corazonrojo' value=''>";
   

      $sql = "INSERT INTO productos_megusta (n_usuario, id_prod) VALUES ('$n_usuario', $id_producto) ";
      $mysql->query($sql) or die ($mysql->error);
    }

    if(isset($_REQUEST['corazonrojo'])){
    echo '<BODY onLoad="mostrarCorazonNegro()">';
      echo "<input type='submit' id='corazon' name='corazon' value=''>";
  

      $sql = "DELETE FROM productos_megusta WHERE n_usuario = '$n_usuario' AND id_prod = '$id_producto' ";
      $mysql->query($sql) or die ($mysql->error);
    }

    echo "</div>";

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

<script>

    var corazon_negro = document.getElementById('corazon');
    var corazon_rojo = document.getElementById('corazonrojo');
        
    function mostrarCorazonRojo() {
        corazon_negro.style.display = 'none';
        //corazon_rojo.style.display = 'inline';
    }

    function mostrarCorazonNegro() {
        corazon_rojo.style.display = 'none';
        //corazon_negro.style.display = 'inline';
    }



</script>

</form>
</body>
</html>
<?php
ob_end_flush();
?>
