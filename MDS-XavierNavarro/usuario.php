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
<form action="usuario.php">
<style>

#botons{
  padding-left: 40;
}

input[type="radio"] {
  display: none;
}

#stars {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
  font-size: 50px;
}

#stars:hover,
#stars:hover ~ #stars {
  color: orange;
}

input[type="radio"]:checked ~ #stars {
  color: orange;
}


#textcoment{
  height: 50;
  width: 500;
  font-size: 20;
}

#starsvaloracio{
  color: orange;
  position: absolute;
  left: 2%;
}

#estrelles{
  color: orange;
}

#fotoenvia{
  border-radius: 50px;
}

.userid{
  position: absolute;
  width: 50;
  height: 50;
  background: transparent;
  border: 0;
  color: transparent;
}


#ops{
  display:inline-flexbox;
  text-align: center;
  width: auto;
  height: auto;
  margin: 25;
  padding: 10;
  background-color: white;
  font-size: 17;
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}


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
  padding-left: 40;
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



#debajoheader{
  
  text-align: left;
  font-size: 25px;
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  padding-left:40;


}

#fotoperf{
  border-radius: 50%;
  position: relative;
  top: -45;
}

#textonombreusuario{
  position: relative;
  top: -35;
} 

#enviarmensaje{
  position: absolute;
  right: 5%;
}

.buttons{
  background-color: rgb(0, 0, 0);
  color: rgb(255, 255, 255);
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 20;
  border-radius: 10px;
 
}

#novendido{
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 20;
  padding-left: 40;
}


#maps{
  padding-left: 50;
  padding-top: 20;
}

#ooopinar{
  margin-bottom: 20;
  padding-left: 40;
  text-align: left;
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 20;
}

#opinar1{
  position: relative;
  right: 1740;
  top:200;
  width: auto;
  height: 35;
}


/* Responsive layout - makes a one column layout instead of a two-column layout */
@media (max-width: 800px) {
#sotaheader{
  top: 22%;
}

header{
  width:100%;
  height: 100;
}

#fotoperf{
  width: 130;
  height: 130;
   margin-top: 40;  
}


.flex-container {
    
    padding:5;
    text-align: center;
   
  }
  #maps{
    width: 300;
    height: 150;
    position: relative;
    right: 15%;

  }

  #zona{
    left:75%;
  }

  #subirproducto{
    left:30%;
  }


  #enviarmensaje{
    left:55%;
    top:0%; 
  }

  #textonombreusuario{
    left:25%;
    top:0%; 
  }


  #iniciar{
    left: 40%;
    top:20%
  }

  #zonarepartidores{
    top: 20%;
    left: 55%;
  }

  #textcoment{
    width: 300;
  }

  #starsvaloracio{
    position: absolute;
    top: 80;
    left: 50%;
  }

  #textonombreusuario{
    position: absolute;
    top: 50;
    left: 50%;
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

<?php
$prod = "todos";

$usuario=$_SESSION["usuario_elegido"];

if(isset($_SESSION["nombre_usuario"])){
$usuario_activo = $_SESSION["nombre_usuario"];

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
    
  <?php

$mysql = new mysqli ("b7lgw1cojiripwuqndeg-mysql.services.clever-cloud.com","uwblcfhdgmvbfeos","lmNPuWe4qfOaYyeAyb7c","b7lgw1cojiripwuqndeg");

    if($mysql->connect_error){
      die("Conexio fallida");
    }
      
    if (isset($_REQUEST["atras"])){   //BOTO PARA IR ATRAS
      header('Location: index.php');
    } 

    if (isset($_REQUEST["producto1"])){   //BOTO PARA ABRIR PRODUCTO
      $productoelegido = $_REQUEST["producto1"];
     
      $_SESSION["producto"]=$_REQUEST["producto1"];
      
      header('Location: producto.php');
    } 

    if (isset($_REQUEST["vendidos"])){   //BOTO PARA MOSTRAR VENDIDOS
      $prod="vendidos";
    } 

    if (isset($_REQUEST["productos"])){   //BOTO PARA MOSTRAR productos
      $prod="todos";
    } 

    if (isset($_REQUEST["opiniones"])){   //BOTO PARA MOSTRAR opiniones
      $prod="opiniones";
    } 

    if (isset($_REQUEST["opinar"])){   //BOTO PARA MOSTRAR opinar
      $prod="opinar";
    } 


    if (isset($_REQUEST["perfilenvia"])){   //BOTO PARA MOSTRAR perfil de opinion
      $_SESSION["usuario_elegido"] = $_REQUEST["perfilenvia"];   
      header('Location: usuario.php'); 
    }

    if (isset($_REQUEST["enviaropinion"])){   //BOTO PARA MOSTRAR opinar
      $estrellas = $_REQUEST["estrellas"];
      $comentario = $_REQUEST["comentario"];
      $data= date("Y-m-d");
      
      $sql= "INSERT INTO `valoracion`(`usuario_envia`, `usuario_recibe`, `estrellas`, `comentario`, `fecha`) VALUES ('" . $usuario_activo ."','" . $usuario . "'," . $estrellas . ",'". $comentario . "','". $data . "')";
      $mysql->query($sql) or die ($mysql->error);
      $prod="opiniones";

    } 


    if (isset($_REQUEST["enviarmensaje"])){   //BOTO PARA ENVIAR MENSAJE

      $query= mysqli_query ($mysql,"SELECT * FROM mensajes WHERE (usuario1 = '$usuario_activo' AND usuario2 = '$usuario')  OR  (usuario2 = '$usuario_activo' AND usuario1 = '$usuario')");
      $row_cnt = $query->num_rows;

      if ($row_cnt > 0) {
        $_SESSION["chat"]=$usuario;
        header('Location: chat.php');
      } else {
        $sql= "INSERT INTO mensajes (usuario1, usuario2) VALUES ('$usuario_activo','$usuario')";
        $mysql->query($sql) or die ($mysql->error);
        $_SESSION["chat"]=$usuario;      
        header('Location: chat.php');
      }

    }
  
  ?>



  <?php

    echo "<div id='debajoheader'>";


    $consulta1= "SELECT n_usuario, fotoperfil, direccion FROM usuarios WHERE n_usuario = '$usuario'";
    $resultatstaula= $mysql->query($consulta1);

    
      while($fila = $resultatstaula->fetch_array()){
        $n_usuario = $fila["n_usuario"];
        $fotoperfil = $fila["fotoperfil"];
        $direccion = $fila["direccion"];
      }
    

    
    if($fotoperfil != null){
      echo "<img src='data:image/jpeg; base64," . base64_encode($fotoperfil) . "' height='150' width='150' id='fotoperf'>";
    }

    ?>

    <iframe id="maps" width="900" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=<?php echo $direccion; ?>
      +(Mi%20nombre%20de%20egocios)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">";

    </iframe> 

    <?php
    echo"<br>";
    echo "<label id='textonombreusuario' for=''><b>". $n_usuario."</b></label>";


    $consulta1= "SELECT AVG(estrellas) FROM valoracion WHERE usuario_recibe = '$usuario'";
    $resultatstaula= $mysql->query($consulta1);

    
      while($fila = $resultatstaula->fetch_array()){
        $n_estrellas = $fila["AVG(estrellas)"];
       
        $n_stars=(int)$n_estrellas;
        
        if($n_stars==1){
          echo "<label id='starsvaloracio' for=''>★</label>";
        }
        else if($n_stars==2){
          echo "<label id='starsvaloracio' for=''>★★</label>";
        }
        else if($n_stars==3){
          echo "<label id='starsvaloracio' for=''>★★★</label>";
        }
        else if($n_stars==4){
          echo "<label id='starsvaloracio' for=''>★★★★</label>";
        }
        else if($n_stars==5){
          echo "<label id='starsvaloracio' for=''>★★★★★</label>";
        }

      }






    ?>
  
  </div>
  <br>


   <div id='botons'>
     <br>
    <input type="submit" name="productos" value="Productos" class="buttons">
    <input type="submit" name="vendidos" value="Vendidos" class="buttons">
    <input type="submit" name="opiniones" value="Opiniones" class="buttons">

    <?php
      if(isset($_SESSION["nombre_usuario"])){
        if($_SESSION["usuario_elegido"] !=  $_SESSION["nombre_usuario"]){
         echo"<input type='submit' id='enviarmensaje' name='enviarmensaje' value='Enviar mensaje' class='buttons'>";
        }
      }

    ?>

    <br><br><br>

  </div>
  


  <div class="flex-container">
  
  <?php

  if($prod == "todos"){
  
      $consulta2= "SELECT id, imagen, nombre FROM productos WHERE usuario = '$usuario' && Vendido=0";
      $resultats= $mysql->query($consulta2);


    
      while($fila1 = $resultats->fetch_array()){
        echo "<div id='prod'>";
     
        echo "<input type='submit' name='producto1' value='" . $fila1["id"] . "' class='prodid' id='fotoprod'>"; 
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila1["imagen"]) . "' name='producto' height='180' width='180' id='fotoprod'> <br>";
        echo $fila1["nombre"];
 
        echo "</div>";
      }
    

     $mysql->close();
  }

  echo "</div>";


  echo "<div class='flex-container'>";
  if($prod == "vendidos"){
  
    $consulta2= "SELECT id, imagen, nombre FROM productos WHERE usuario = '$usuario' && Vendido=1";
    $resultats= $mysql->query($consulta2);

  if(mysqli_num_rows($resultats)>0){
    while($fila1 = $resultats->fetch_array()){
      echo "<div id='prod'>";
   
      echo "<input type='submit' name='producto1' value='" . $fila1["id"] . "' class='prodid' id='fotoprod'>"; 
      echo "<img src='data:image/jpeg; base64," . base64_encode($fila1["imagen"]) . "' name='producto' height='180' width='180' id='fotoprod'> <br>";
      echo $fila1["nombre"];

      echo "</div>";
    }
  }else{
     echo"<label id='novendido'><b>Este usuario aún no ha vendido ningun producto.</b></label>";
  }

   $mysql->close();
}

echo "</div>";





if($prod == "opiniones"){
  $consulta3= "SELECT v.usuario_envia, v.estrellas, v.comentario, v.fecha, u.fotoperfil FROM valoracion v INNER JOIN usuarios u ON v.usuario_envia = u.n_usuario WHERE usuario_recibe = '$usuario'";
  $resultats= $mysql->query($consulta3);

if(mysqli_num_rows($resultats)>0){

  echo"<label id='novendido'><b>Estas son las opiniones sobre este usuario.                     </b></label>";
  if(isset($_SESSION["user"])){
    echo"<input type='submit' class='buttons' id='' name='opinar' value='Opinar'>";
  }

  echo "<div class='flex-container'>";


  while($fila1 = $resultats->fetch_array()){
    
    echo "<div id='ops'>";


    echo "<input type='submit' name='perfilenvia' value='" . $fila1["usuario_envia"] . "' height='50' width='50' class='userid'>"; 
    echo "<img src='data:image/jpeg; base64," . base64_encode($fila1["fotoperfil"]) . "' id='fotoenvia' name='fotoenvia' height='50' width='50'>" . "     ";
    

    $stars = $fila1["estrellas"];
    if($stars==1){
      echo"<label id='estrelles'>★</label>";
    }
    if($stars==2){
      echo"<label id='estrelles'>★★</label>";
    }
    if($stars==3){
      echo"<label id='estrelles'>★★★</label>";
    }
    if($stars==4){
      echo"<label id='estrelles'>★★★★</label>";
    }
    if($stars==5){
      echo"<label id='estrelles'>★★★★★</label>";
    }


    echo "    " . $fila1['comentario'];
    echo "    " . $fila1['fecha'];
    echo "</div>";

  }
  echo "</div> <br>";


}else{
   echo"<label id='novendido'><b>Este usuario aún no ha recibido ninguna opinion.       </b></label>";
   if(isset($_SESSION["user"])){
      if($_SESSION["usuario_elegido"] !=  $_SESSION["nombre_usuario"]){
        echo"<input type='submit' class='buttons'  name='opinar' value='Opinar'>";
      }
    }
}

 $mysql->close();
}




if($prod == "opinar"){

  echo "<div id='ooopinar'>";

  echo"<label ><b>Deja tu opinion sobre este usuario.</b></label>";
  ?>

  <p class="clasificacion">
  <input id="radio1" type="radio" name="estrellas" value="5"><!--
  -->    <label id="stars" for="radio1">★</label><!--
  --><input  id="radio2" type="radio" name="estrellas" value="4"><!--
  -->    <label id="stars" for="radio2">★</label><!--
  --><input  id="radio3" type="radio" name="estrellas" value="3"><!--
  -->    <label id="stars" for="radio3">★</label><!--
  --><input id="radio4" type="radio" name="estrellas" value="2"><!--
  -->    <label id="stars" for="radio4">★</label><!--
  --><input id="radio5" type="radio" name="estrellas" value="1"><!--
  -->    <label id="stars" for="radio5">★</label>
  </p>

 
  
 <input type="text" name="comentario" id="textcoment" placeholder="Añade un comentario."><br><br>
 <input type="submit" class="buttons" name="enviaropinion" value="Enviar opinion">

</div>


<?php
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
</body>
</html>
<?php
ob_end_flush();
?>
