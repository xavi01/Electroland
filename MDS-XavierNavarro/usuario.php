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
  position: relative;
  left: -250;
}

#stars:hover,
#stars:hover ~ #stars {
  color: orange;
}

input[type="radio"]:checked ~ #stars {
  color: orange;
}


#textcoment{
  position: relative;
  top:150;
  left: -600;
  height: 50;
  width: 500;
  font-size: 20;

}


#enviaropinion{
  position: relative;
  top:220;
  left: -950;
  height: 30;
}


#ops{
  background-color: white;
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 20;
  position: relative;
  top: 80;
  left: -450;
  width: auto;
  text-align: left;
  
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
  right: 4%;
}

.buttons{
  background-color: rgb(0, 0, 0);
  color: rgb(255, 255, 255);
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 20;
  border-radius: 10px;
 
}


#maps{
  padding-left: 50;
  padding-top: 20;
}

#novendido{
  font-size: 25px;
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  position: relative;
  right: -40;
}

#opinar{
  position: relative;
  right: 530;
  top:50;
}

</style>

<?php
$prod = "todos";
session_start();
$usuario=$_SESSION["usuario_elegido"];

if(isset($_SESSION["nombre_usuario"])){
$usuario_activo = $_SESSION["nombre_usuario"];

}


?>


  <header>
    <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>
    
  </header>

    
  <?php

    $mysql = new mysqli ("localhost","root","","electroland");

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

    ?>
  
  <br>

    <input type="submit" name="productos" value="Productos" class="buttons">
    <input type="submit" name="vendidos" value="Vendidos" class="buttons">
    <input type="submit" name="opiniones" value="Opiniones" class="buttons">

    <?php
      if(isset($_SESSION["nombre_usuario"])){
         echo"<input type='submit' id='enviarmensaje' name='enviarmensaje' value='Enviar mensaje' class='buttons'>";
      }

    ?>

    <br><br>

  </div>
  


  <div class="flex-container">
  



  <?php

  if($prod == "todos"){
  
      $consulta2= "SELECT id, imagen, nombre FROM productos WHERE usuario = '$usuario' && Vendido=0";
      $resultats= $mysql->query($consulta2);


    
      while($fila1 = $resultats->fetch_array()){
        echo "<div id='prod'>";
     
        echo "<input type='submit' name='producto1' value='" . $fila1["id"] . "' class='prodid'>"; 
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila1["imagen"]) . "' name='producto' height='180' width='180'> <br>";
        echo $fila1["nombre"];
 
        echo "</div>";
      }
    

     $mysql->close();
  }




  if($prod == "vendidos"){
  
    $consulta2= "SELECT id, imagen, nombre FROM productos WHERE usuario = '$usuario' && Vendido=1";
    $resultats= $mysql->query($consulta2);

  if(mysqli_num_rows($resultats)>0){
    while($fila1 = $resultats->fetch_array()){
      echo "<div id='prod'>";
   
      echo "<input type='submit' name='producto1' value='" . $fila1["id"] . "' class='prodid'>"; 
      echo "<img src='data:image/jpeg; base64," . base64_encode($fila1["imagen"]) . "' name='producto' height='180' width='180'> <br>";
      echo $fila1["nombre"];

      echo "</div>";
    }
  }else{
     echo"<label id='novendido'><b>Este usuario aún no ha vendido ningun producto.</b></label>";
  }

   $mysql->close();
}




if($prod == "opiniones"){
  $consulta3= "SELECT v.usuario_envia, v.estrellas, v.comentario, v.fecha, u.fotoperfil FROM valoracion v INNER JOIN usuarios u ON v.usuario_envia = u.n_usuario WHERE usuario_recibe = '$usuario'";
  $resultats= $mysql->query($consulta3);

if(mysqli_num_rows($resultats)>0){
  echo"<label id='novendido'><b>Estas son las opiniones sobre este usuario.</b></label>";
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
}else{
   echo"<label id='novendido'><b>Este usuario aún no ha recibido ninguna opinion.</b></label>";
   if(isset($_SESSION["user"])){
   echo"<input type='submit' class='buttons' id='opinar' name='opinar' value='Opinar'>";
   }
}

 $mysql->close();
}



if($prod == "opinar"){

  echo"<label id='novendido'><b>Deja tu opinion sobre este usuario.</b></label>";
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

 
  
 <input id="textcoment" type="text" name="comentario" id="" placeholder="Añade un comentario."><br>
 <input type="submit" class="buttons" name="enviaropinion" id="enviaropinion" value="Enviar opinion">

<?php
}
  ?>



    
    
  </form>
</body>
</html>