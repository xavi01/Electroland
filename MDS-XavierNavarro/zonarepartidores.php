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

<style>

#sotaheader{
  text-align: center;
}
/* Responsive layout - makes a one column layout instead of a two-column layout */
@media (max-width: 800px) {

  #f7{
    top: auto;
  }
 

 #f3{
   top:auto;
 }
 
 
 #frame{
   width: 350;
   height: 200;
 }

 #edit1{
    width: 100%;
    text-align: center;
  }
 

  #edit2{
    width: 100%;
    text-align: center;
  }

  #edit3{
    width: 100%;
    text-align: center;
  }

  #edit4{
    width: 100%;
    text-align: center;
  }

 #fotoperfil{
   display: none;
 }

 
 #bienvenido{
   display: none;
 }

 #buttonedit{
   top: 10%;
 }


 #guardar{
   top: 10%;
   left: 80%;
 }


 #repartos{
   top: 15%;
   left: 32%;
 }
 

 #cerrar{
  top: 15%;
   left: 60%;
 }


 
 }



</style>

<body>
    <form action="zonarepartidores.php" method="post" enctype="multipart/form-data">

    <header id="headins">
            <button id="atras" name="atras"><img src="assets/img/logosinfondo.png" / width="95" height="95"></button>
            <input type="submit" name="repartos" value="Repartos" id="repartos">
            <input type="submit" name="cerrar" value="Cerrar sesión" id="cerrar">
        </header>

        <div id="sotaheader">

    <?php

        $repartidoractivo =  $_SESSION["repartidor"];

        $mysql = new mysqli ("b7lgw1cojiripwuqndeg-mysql.services.clever-cloud.com","uwblcfhdgmvbfeos","lmNPuWe4qfOaYyeAyb7c","b7lgw1cojiripwuqndeg");

        if($mysql->connect_error){
            die("Conexio fallida");
        }
    
        $consulta= "SELECT * FROM repartidores WHERE correo = '$repartidoractivo'";
        $resultatstaula= $mysql->query($consulta);
    
        while($valores = $resultatstaula->fetch_array()){
            $nombre = $valores["nombre"];
            $apellidos = $valores["apellidos"];
            $fecha_n = $valores["fecha_nacimiento"];
            $provincia = $valores["provincia"];
            $n_repartidor = $valores["n_repartidor"];
            $email = $valores["correo"];
            $contraseña = $valores["contraseña"];
            $fotoperfil = $valores["fotoperfil"];
            
        }
        $mysql->close();
    

        if($fotoperfil != null){
            echo "<img src='data:image/jpeg; base64," . base64_encode($fotoperfil) . "' height='150' width='150' id='fotoperfil'>";
          }
      
    
      
    echo "<h1 id='bienvenido'>    Bienvenido " . $n_repartidor. ".</h1>" . "<br><br><br>";
    
    

        if (isset($_REQUEST["atras"])){
           header('Location: index.php');
        }

        if (isset($_REQUEST["cerrar"])){
            session_destroy();
            header('Location: index.php');
        }

        if (isset($_REQUEST["repartos"])){
            header('Location: repartos.php');
        }
    ?>




        <input type="submit" value="Editar" name="edit" id="buttonedit" class="botons"><br><br>



<div class="editar" id="edit1" style="display:none" >
<b>Nombre:</b> <br>
<input type="text" name="nombre" value="<?php echo $nombre; ?>" id="" class="bordeRodo"><br><br>
<b>Apellidos:</b> <br>
<input type="text" name="apellidos"value="<?php echo $apellidos; ?>"  id="" class="bordeRodo"><br><br>
<b>Provincia:</b> <br>
<select  name="provincia" class="bordeRodo">
    <option value="Álava/Araba">Álava/Araba</option>
    <option value="Albacete">Albacete</option>
    <option value="Alicante">Alicante</option>
    <option value="Almería">Almería</option>
    <option value="Asturias">Asturias</option>
    <option value="Ávila">Ávila</option>
    <option value="Badajoz">Badajoz</option>
    <option value="Baleares">Baleares</option>
    <option value="Barcelona">Barcelona</option>
    <option value="Burgos">Burgos</option>
    <option value="Cáceres">Cáceres</option>
    <option value="Cádiz">Cádiz</option>
    <option value="Cantabria">Cantabria</option>
    <option value="Castellón">Castellón</option>
    <option value="Ceuta">Ceuta</option>
    <option value="Ciudad Real">Ciudad Real</option>
    <option value="Córdoba">Córdoba</option>
    <option value="Cuenca">Cuenca</option>
    <option value="Gerona/Girona">Gerona/Girona</option>
    <option value="Granada">Granada</option>
    <option value="Guadalajara">Guadalajara</option>
    <option value="Guipúzcoa/Gipuzkoa">Guipúzcoa/Gipuzkoa</option>
    <option value="Huelva">Huelva</option>
    <option value="Huesca">Huesca</option>
    <option value="Jaén">Jaén</option>
    <option value="La Coruña/A Coruña">La Coruña/A Coruña</option>
    <option value="La Rioja">La Rioja</option>
    <option value="Las Palmas">Las Palmas</option>
    <option value="León">León</option>
    <option value="Lérida/Lleida">Lérida/Lleida</option>
    <option value="Lugo">Lugo</option>
    <option value="Madrid">Madrid</option>
    <option value="Málaga">Málaga</option>
    <option value="Melilla">Melilla</option>
    <option value="Murcia">Murcia</option>
    <option value="Navarra">Navarra</option>
    <option value="Orense/Ourense">Orense/Ourense</option>
    <option value="Palencia">Palencia</option>
    <option value="Pontevedra">Pontevedra</option>
    <option value="Salamanca">Salamanca</option>
    <option value="Segovia">Segovia</option>
    <option value="Sevilla">Sevilla</option>
    <option value="Soria">Soria</option>
    <option value="Tarragona">Tarragona</option>
    <option value="Tenerife">Tenerife</option>
    <option value="Teruel">Teruel</option>
    <option value="Toledo">Toledo</option>
    <option value="Valencia">Valencia</option>
    <option value="Valladolid">Valladolid</option>
    <option value="Vizcaya/Bizkaia">Vizcaya/Bizkaia</option>
    <option value="Zamora">Zamora</option>
    <option value="Zaragoza">Zaragoza</option>
  </select><br><br>
<b>Fecha de nacimiento:</b> <br> 
<input type="date" name="data"  value="<?php echo $fecha_n; ?>" class="bordeRodo"><br><br>
</div>



<div class="editar" id="edit2" style="display:none">
<b>Usuario:</b> <br>
<?php echo $n_repartidor; ?> <br><br>
<b>Email:</b> <br>
<?php echo $email; ?> <br><br>
<b>Contraseña:</b> <br>
<input type="password" name="contraseña"  value="<?php echo $_SESSION["contraseña"]; ?>"  class="bordeRodo"><br><br>
<b>Foto DNI:</b> <br>
<input type="file"  name="imageDNI"/><br><br>
<b>Foto de perfil:</b> <br>
<input type="file"  name="imageperfil"/><br><br>
<input type="submit" name="guardar" value="Guardar" class="botons" id="guardar">
</div>


<div class="editar" id ="edit3" style="display:inline-block">
<b>Nombre:</b> <br>
<?php echo $nombre; ?> <br><br>
<b>Apellidos:</b> <br>
<?php echo $apellidos; ?> <br><br>
<b>Provincia:</b> <br>
<?php echo $provincia; ?> <br><br>
<div>

<iframe id="frame" width="500" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=<?php echo $provincia; ?>
+(Mi%20nombre%20de%20egocios)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
</iframe>

</div>
</div>

<div class="editar" id ="edit4" style="display:inline-block">
<b>Fecha de nacimiento:</b> <br>
<?php echo $fecha_n; ?> <br><br>
<b>Repartidor:</b> <br>
<?php echo $n_repartidor; ?> <br><br>
<b>Email:</b> <br>
<?php echo $email; ?> <br><br>
</div>

<footer id='f7'>


<a title="Facebook" href="https://www.facebook.com/electrolandspain"> <img src="assets/img/facebook.png" alt="" width="40" height="40"></a>
<a title="Instagram" href="https://www.instagram.com/electrolandspain/"><img src="assets/img/instagram.png" alt="" width="40" height="40"></a>
<br>
Correo: contactoelectroland@gmail.com
<br>
Copyright © 2021 Electroland © de sus respectivos propietarios
</footer>
    
</div>



<?php

  if (isset($_REQUEST["edit"])){
    echo '<BODY onLoad="ActivarCampoOtroTema()">';
  }

  if (isset($_REQUEST["guardar"])){

    $nombre = $_REQUEST["nombre"];
    $apellidos = $_REQUEST["apellidos"];
    $provincia = $_REQUEST["provincia"];
    $fecha = $_REQUEST["data"];
    $contraseña = $_REQUEST["contraseña"];

    $hashcontraseñanova=password_hash($contraseña, PASSWORD_DEFAULT);

 
    $check = getimagesize($_FILES["imageDNI"]["tmp_name"]);

    if($check !== false){
        $image = $_FILES['imageDNI']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    }

    $check1 = getimagesize($_FILES["imageperfil"]["tmp_name"]);

    if($check !== false){
        $image1 = $_FILES['imageperfil']['tmp_name'];
        $imgContent1 = addslashes(file_get_contents($image));
    }

    $mysql = new mysqli ("b7lgw1cojiripwuqndeg-mysql.services.clever-cloud.com","uwblcfhdgmvbfeos","lmNPuWe4qfOaYyeAyb7c","b7lgw1cojiripwuqndeg");
    
    if($mysql->connect_error){
        die("Conexio fallida");
    }

    $consulta= "UPDATE repartidores SET nombre='$nombre',  apellidos='$apellidos', fecha_nacimiento='$fecha',  contraseña='$hashcontraseñanova', foto_dni = '$imgContent' , provincia = '$provincia', fotoperfil='$imgContent1' WHERE correo = '$repartidoractivo'";

    if ($mysql->query($consulta) === TRUE) {
      
    } else {
      
    }
 


   $mysql->close();

   echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=zonarepartidores.php'>";

  }


?>



</form>


<script type="text/javascript">

	function ActivarCampoOtroTema(){
    var contenedor1 = document.getElementById("edit1");	
    var contenedor2 = document.getElementById("edit2");	
    var contenedor3 = document.getElementById("edit3");	
    var contenedor4 = document.getElementById("edit4");

    contenedor1.style.display = "inline-block";		
    contenedor2.style.display = "inline-block";	

    contenedor3.style.display = "none";		
    contenedor4.style.display = "none";	
  } 






</script>



</body>
</html>

<?php
ob_end_flush();
?>
