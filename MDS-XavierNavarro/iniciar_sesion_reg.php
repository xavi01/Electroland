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
<body>
<form action="iniciar_sesion_reg.php" method="post" enctype="multipart/form-data">
<style>


/* Responsive layout - makes a one column layout instead of a two-column layout */
@media (max-width: 800px) {


  #ins{
    width: 100%;
    text-align: center;
  }

  #reg{
    width: 100%;
    text-align: center;
  }

}






</style>

<header id="headins">
    
 <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>
</header>

<div id="sotaheader">

<?php
 $registro='users';
 $inicio= 'users';
?>


<?php
if (isset($_REQUEST["atras"])){
    header('Location: index.php'); 
}

if (isset($_REQUEST["regrepartidor"])){
   $registro='repartidores';
}

if (isset($_REQUEST["regusuario"])){
  $registro='users';
}

if (isset($_REQUEST["inusuario"])){
  $inicio='users';
}

if (isset($_REQUEST["inrepartidor"])){
  $inicio='repartidores';
}

if (isset($_REQUEST["olvi"])){
  $inicio='olv';
}

if (isset($_REQUEST["tornariniciar"])){
  $inicio='users';
}
?>



<?php

if($inicio == 'users'){

?>
<div id="ins">    <!--INICIAR SESION USUARIOS-->
<h1>Inicia Sesión Usuario</h1> <br>
Email: <br>
<input type="email" name="email1" id="" class="bordeRodo"> <br><br>
Contraseña: <br>
<input type="password" name="contraseña1" id="" class="bordeRodo"><br><br>
<input type="submit" name="iniciar" value="Iniciar sesión" class="botons"><br><br>
<input type="submit" name="inrepartidor" value="Iniciar sesión como repartidor." id="iniciarUser-Rep"><br><br>
<input type="submit" name="olvi" value="¿Has olvidado la contraseña?" id="olvidarcontraseña">

</div>

<?php

}else if($inicio == 'repartidores'){


?>


<div id="ins">    <!--INICIAR SESION REPARTIDORES-->
<h1>Inicia Sesión Repartidor</h1> <br>
Email: <br>
<input type="email" name="email_repartidor" id="" class="bordeRodo"> <br><br>
Contraseña: <br>
<input type="password" name="contraseña_repartidor" id="" class="bordeRodo"><br><br>
<input type="submit" name="iniciar2" value="Iniciar sesión" class="botons"><br><br>
<input type="submit" name="inusuario" value="Iniciar sesión como usuario." id="iniciarUser-Rep"><br><br>
<input type="submit" name="olvi" value="¿Has olvidado la contraseña?" id="olvidarcontraseña">

</div>



<?php
}else if($inicio == 'olv'){
?>


<div id="ins">     <!--RECUPERAR CONTRASEÑA-->
<h1>Recuperar Acceso</h1> <br>
<select Id="tipousuario" name="tipousuario">
    <option value="0">USUARIO</option>
    <option value="1">REPARTIDOR</option>
</select><br><br>
Email: <br>
<input type="email" name="recupemail" id="" class="bordeRodo"> <br><br>
Nombre Usuario/Repartidor: <br>
<input type="text" name="recupuser" id="" class="bordeRodo"><br><br>
Contraseña nueva: <br>
<input type="password" name="recuppass1" id="" class="bordeRodo"><br><br>
Contraseña nueva: <br>
<input type="password" name="recuppass2" id="" class="bordeRodo"><br><br>

<input type="submit" name="recupiniciar" value="Iniciar sesión" class="botons"><br><br>
<input type="submit" name="tornariniciar" value="Iniciar sesión"  id="olvidarcontraseña">
</div>

<?php
}


?>





<?php


if(isset($_REQUEST['recupiniciar'])){  

$recupemail = $_REQUEST["recupemail"];
$recupuser = $_REQUEST["recupuser"];
$newpass1 = $_REQUEST["recuppass1"];
$newpass2 = $_REQUEST["recuppass2"];

$tipouser = $_REQUEST["tipousuario"];


  $mysql = new mysqli ("localhost","root","","electroland");
 
    if($mysql->connect_error){
        die("Conexio fallida");
    }else{
     
    }


    if($tipouser==0){ //SI ETS USUARI
    $query = mysqli_query($mysql,"SELECT * FROM usuarios WHERE email= '$recupemail' AND n_usuario= '$recupuser'");
    $nr = mysqli_num_rows($query);

    
    if(isset($_REQUEST["recupiniciar"])){
      if($nr == 1){
 
        if($newpass1 == $newpass2){

          $hashrecuperar=password_hash($newpass1, PASSWORD_DEFAULT);

         $consulta= "UPDATE usuarios SET contraseña='$hashrecuperar' WHERE email = '$recupemail' AND n_usuario= '$recupuser'";
    
            if ($mysql->query($consulta) === TRUE) {

              $consulta= "SELECT direccion, telefono, contraseña FROM usuarios WHERE n_usuario= '$recupuser'";
              $resultatstaula= $mysql->query($consulta);

              while($valores = $resultatstaula->fetch_array()){
                $tlf= $valores["telefono"];
                $direcc= $valores["direccion"];
                $contra= $valores["contraseña"];
              }
                session_start();
                $_SESSION["user"]=$recupemail;
                $_SESSION["nombre_usuario"]=$recupuser;
                $_SESSION["contraseña"]=$newpass1;
                $_SESSION["telefono"]=$tlf;
                $_SESSION["direccion"]= $direcc;
                header('Location: mizona.php');
                echo '<BODY onLoad="myFunction3()">';
            } else {
              echo "Error updating record: " . $mysql->error;
            }

        }else{
            echo '<BODY onLoad="myFunction2()">'; 
        }
    
      }else if($nr == 0) {
        echo '<BODY onLoad="myFunction1()">'; 
      }
    } 

  }else if($tipouser==1){  //SI ETS REPARTIDOR
    $query = mysqli_query($mysql,"SELECT * FROM repartidores WHERE correo= '$recupemail' AND n_repartidor= '$recupuser'");
    $nr = mysqli_num_rows($query);

    
    if(isset($_REQUEST["recupiniciar"])){
      if($nr == 1){
 
        if($newpass1 == $newpass2){

          $hashrecuperar=password_hash($newpass1, PASSWORD_DEFAULT);

         $consulta= "UPDATE repartidores SET contraseña='$hashrecuperar' WHERE correo = '$recupemail' AND n_repartidor= '$recupuser'";
    
            if ($mysql->query($consulta) === TRUE) {
                session_start();
                $_SESSION["repartidor"]=$recupemail;
                header('Location: zonarepartidores.php');
                echo '<BODY onLoad="myFunction3()">';
            } else {
              echo "Error updating record: " . $mysql->error;
            }

        }else{
            echo '<BODY onLoad="myFunction2()">'; 
        }
    
      }else if($nr == 0) {
        echo '<BODY onLoad="myFunction1()">'; 
      }
    } 
  }
  
    $mysql->close();

}
?>

<?php

if($registro == 'users'){

?>
<div id="reg">  <!--REGISTRAR-SE COMO USUARIO-->
<h1>Registrate como Usuario</h1> <br>
Nombre: <br>
<input type="text" name="nombre" id="" class="bordeRodo"><br><br>
Apellidos: <br>
<input type="text" name="apellidos" id="" class="bordeRodo"><br><br>
Fecha de nacimiento: <br>
<input type="date" name="data" id="" class="bordeRodo"><br><br>
Direccion: <br>
<input type="text" name="direccion" id="" class="bordeRodo"><br><br>
Provincia: <br>
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

  Nombre usuario: <br>
<input type="text" name="usuario" id="" class="bordeRodo"><br><br>
Teléfono: <br>
<input type="number" name="telefono" id="" class="bordeRodo"><br><br>
Email: <br>
<input type="email" name="email2" id="" class="bordeRodo"> <br><br>
Contraseña: <br>
<input type="password" name="contraseña2" id="" class="bordeRodo"><br><br>

<input type="submit" name="registrar" value="Registrar-se" class="botons"><br><br>
<input type="submit" name="regrepartidor" value="Registrar-se como repartidor." id="registrarserepartidor">

</div>

<?php
}else if($registro == 'repartidores'){

?>

<div id="reg">  <!--REGISTRAR-SE COMO REPARTIDOR-->
<h1>Registrate como Repartidor</h1> <br>
Nombre: <br>
<input type="text" name="nombre2" id="" class="bordeRodo"><br><br>
Apellidos: <br>
<input type="text" name="apellidos2" id="" class="bordeRodo"><br><br>
Foto DNI: <br>
<input type="file"  name="fotodni"/><br><br>
Fecha de nacimiento: <br>
<input type="date" name="data2" id="" class="bordeRodo"><br><br>
Provincia: <br>
<select  name="provincia2" class="bordeRodo">

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
Nombre repartidor: <br>
<input type="text" name="n_repartidor" id="" class="bordeRodo"><br><br>
Email: <br>
<input type="email" name="email3" id="" class="bordeRodo"> <br><br>
Contraseña: <br>
<input type="password" name="contraseña3" id="" class="bordeRodo"><br><br>

<input type="submit" name="registrar2" value="Registrar-se" class="botons"><br><br>
<input type="submit" name="regusuario" value="Registrar-se como usuario." id="registrarseusuario">

</div>

<?php
}
?>

 
<?php
if (isset($_REQUEST["iniciar"])){   //INICIAR USUARIO

    $email1 = $_REQUEST["email1"];
    $contraseña1 = $_REQUEST["contraseña1"];

    $mysql = new mysqli ("localhost","root","","electroland");
 
    if($mysql->connect_error){
        die("Conexio fallida");
    }else{
     
    }

    $sql1 = "SELECT contraseña, n_usuario, telefono, direccion FROM usuarios WHERE email = '$email1'";
    $consulta = mysqli_query($mysql, $sql1);

    while($valores = $consulta->fetch_array()){
      $hashcontraseña = $valores["contraseña"];
      $nombr_usuario = $valores["n_usuario"];
      $telefono = $valores["telefono"];
      $direccion= $valores["direccion"];
    }

    if (password_verify($contraseña1, $hashcontraseña)){
   
    
    $_SESSION["user"]=$email1;
    $_SESSION["nombre_usuario"]=$nombr_usuario;
    $_SESSION["contraseña"]=$contraseña1;
    $_SESSION["telefono"]=$telefono;
    $_SESSION["direccion"]= $direccion;
    

    header('Location: mizona.php');
    
  }else{
    echo '<BODY onLoad="myFunction()">';
  }
    
    $mysql->close();

}

 
if (isset($_REQUEST["iniciar2"])){   //INICIAR REPARTIDOR

    $email2 = $_REQUEST["email_repartidor"];
    $contraseña2 = $_REQUEST["contraseña_repartidor"];

    $mysql = new mysqli ("localhost","root","","electroland");
 
    if($mysql->connect_error){
        die("Conexio fallida");
    }else{
     
    }

    $sql1 = "SELECT contraseña, n_repartidor FROM repartidores WHERE correo = '$email2'";
    $consulta = mysqli_query($mysql, $sql1);

    while($valores = $consulta->fetch_array()){
      $hashcontraseña = $valores["contraseña"];

      $nombr_usuario = $valores["n_repartidor"];
   
    }

  if (password_verify($contraseña2, $hashcontraseña)){
   
    
    $_SESSION["repartidor"]=$email2;
    $_SESSION["nombre_repatidor"]=$nombr_usuario;
    $_SESSION["contraseña"]=$contraseña2;

    header('Location: zonarepartidores.php');
    
  }else{
    echo '<BODY onLoad="myFunction()">';
  }
    
    $mysql->close();

}




if (isset($_REQUEST["registrar2"])){   //Registrar repartidor

    $mysql = new mysqli ("localhost","root","","electroland");
 
    if($mysql->connect_error){
        die("Conexio fallida");
    }else{
      
    }

    $nombre= $_REQUEST["nombre2"];
    $apellidos=$_REQUEST["apellidos2"];
    $data_n=$_REQUEST["data2"];
    $n_repartidor=$_REQUEST["n_repartidor"];
    $email3=$_REQUEST["email3"];
    $contraseña3=$_REQUEST["contraseña3"];
    $hash=password_hash("$contraseña3", PASSWORD_DEFAULT);
    $provincia2=$_REQUEST["provincia2"];
    
    $check = getimagesize($_FILES["fotodni"]["tmp_name"]);

    if($check !== false){
        $image = $_FILES['fotodni']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));  
    }


    $sql = "INSERT INTO repartidores (nombre, apellidos, foto_dni, fecha_nacimiento, provincia, n_repartidor, correo, contraseña)
     VALUES ('$nombre','$apellidos','$imgContent', '$data_n', '$provincia2', '$n_repartidor', '$email3', '$hash')";

    $mysql->query($sql) or die ($mysql->error);
    $mysql->close();
    echo '<BODY onLoad="RegistroCorrecto()">';
}




if (isset($_REQUEST["registrar"])){   //Registrar usuario
  
  $mysql = new mysqli ("localhost","root","","electroland");

  if($mysql->connect_error){
      die("Conexio fallida");
  }else{
    
  }

  $nombre= $_REQUEST["nombre"];
  $apellidos=$_REQUEST["apellidos"];
  $data_n=$_REQUEST["data"];
  $direccion=$_REQUEST["direccion"];
  $n_usuario=$_REQUEST["usuario"];
  $telefono=$_REQUEST["telefono"];
  $email2=$_REQUEST["email2"];
  $contraseña2=$_REQUEST["contraseña2"];
  $hash=password_hash("$contraseña2", PASSWORD_DEFAULT);
  $provincia2=$_REQUEST["provincia"];


  $sql = "INSERT INTO usuarios (nombre, apellidos, data_n, direccion,telefono, n_usuario, email, contraseña, provincia)
   VALUES ('$nombre','$apellidos','$data_n', '$direccion', '$telefono' '$n_usuario', '$email2', '$hash' , '$provincia2')";
  $mysql->query($sql) or die ($mysql->error);
  $mysql->close();
  echo '<BODY onLoad="RegistroCorrecto()">';
}








?>


<footer id="f4">

<a title="Facebook" href="https://www.facebook.com/electrolandspain"> <img src="assets/img/facebook.png" alt="" width="40" height="40"></a>
<a title="Instagram" href="https://www.instagram.com/electrolandspain/"><img src="assets/img/instagram.png" alt="" width="40" height="40"></a>
<br>
Correo: contactoelectroland@gmail.com
<br>
Copyright © 2021 Electroland © de sus respectivos propietarios
</footer>

</div>

</form>

<script type="text/javascript">

  function myFunction() {
  alert("El email o la contraseña son incorrectos.");
  }

  function myFunction1() {
  alert("El email y el usuario no coinciden.");
  }

  function myFunction2() {
  alert("Las contraseñas tienes que ser iguales.");
  }

  function myFunction3() {
  alert("La contraseña se ha actualizado correctamente.");
  }

  function RegistroCorrecto() {
  alert("Registro correcto, ya puedes iniciar sesion.");
  }

  function RegistroIncorrecto() {
  alert("Ha ocurrido un error, por favor intenatlo de nuevo.");
  }

</script>



</body>
</html>
<?php
ob_end_flush();
?>
