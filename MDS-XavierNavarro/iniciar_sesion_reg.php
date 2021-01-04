<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<form action="iniciar_sesion_reg.php">

<header id="headins">
    
 <input type="submit" name="atras" value="Atras" id="atras">

 <img src="assets/img/1.JPG" alt="" width="150" height="150">

</header>


<?php
if (isset($_REQUEST["atras"])){
    header('Location: index.php'); 
}
?>


<div id="ins">    <!--INICIAR SESION-->
<h1>Inicia Sesión</h1> <br>
Email: <br>
<input type="email" name="email1" id="" class="bordeRodo"> <br><br>
Contraseña: <br>
<input type="password" name="contraseña1" id="" class="bordeRodo"><br><br>
<input type="submit" name="iniciar" value="Iniciar sesión" class="botons"><br><br>
<input type="submit" name="olvi" value="¿Has olvidado la contraseña?" id="olvidarcontraseña">

</div>


<div id="olv" style="display: none;">     <!--RECUPERAR CONTRASEÑA-->
<h1>Recuperar Acceso</h1> <br>
Email: <br>
<input type="email" name="recupemail" id="" class="bordeRodo"> <br><br>
Usuario: <br>
<input type="text" name="recupuser" id="" class="bordeRodo"><br><br>
Contraseña nueva: <br>
<input type="password" name="recuppass1" id="" class="bordeRodo"><br><br>
Contraseña nueva: <br>
<input type="password" name="recuppass2" id="" class="bordeRodo"><br><br>

<input type="submit" name="recupiniciar" value="Iniciar sesión" class="botons"><br><br>
</div>



<?php
if(isset($_REQUEST['olvi'])){   
    echo '<BODY onLoad="showContent()">';
}

if(isset($_REQUEST['recupiniciar'])){  

$recupemail = $_REQUEST["recupemail"];
$recupuser = $_REQUEST["recupuser"];
$newpass1 = $_REQUEST["recuppass1"];
$newpass2 = $_REQUEST["recuppass2"];


  $mysql = new mysqli ("localhost","root","","electroland");
 
    if($mysql->connect_error){
        die("Conexio fallida");
    }else{
     
    }

    $query = mysqli_query($mysql,"SELECT * FROM usuarios WHERE email= '$recupemail' AND n_usuario= '$recupuser'");
    $nr = mysqli_num_rows($query);

    
    if(isset($_REQUEST["recupiniciar"])){
      if($nr == 1){
 
        if($newpass1 == $newpass2){

          $hashrecuperar=password_hash($newpass1, PASSWORD_DEFAULT);

         $consulta= "UPDATE usuarios SET contraseña='$hashrecuperar' WHERE email = '$recupemail' AND n_usuario= '$recupuser'";
    
            if ($mysql->query($consulta) === TRUE) {
                session_start();
                $_SESSION["user"]=$recupemail;
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
  
    $mysql->close();
}
?>


<div id="reg">  <!--REGISTRAR-SE-->
<h1>Registrate</h1> <br>
Nombre: <br>
<input type="text" name="nombre" id="" class="bordeRodo"><br><br>
Apellidos: <br>
<input type="text" name="apellidos" id="" class="bordeRodo"><br><br>
Data de nacimiento: <br>
<input type="date" name="data" id="" class="bordeRodo"><br><br>
Direccion: <br>
<input type="text" name="direccion" id="" class="bordeRodo"><br><br>
Nombre usuario: <br>
<input type="text" name="usuario" id="" class="bordeRodo"><br><br>
Email: <br>
<input type="email" name="email2" id="" class="bordeRodo"> <br><br>
Contraseña: <br>
<input type="password" name="contraseña2" id="" class="bordeRodo"><br><br>

<input type="submit" name="registrar" value="Registrar-se" class="botons">
</div>


<?php

if (isset($_REQUEST["iniciar"])){ 

    $email1 = $_REQUEST["email1"];
    $contraseña1 = $_REQUEST["contraseña1"];

    $mysql = new mysqli ("localhost","root","","electroland");
 
    if($mysql->connect_error){
        die("Conexio fallida");
    }else{
     
    }

    $consulta = mysqli_query($mysql,"SELECT contraseña FROM usuarios WHERE email = '$email1'");

    while($valores = $consulta->fetch_array()){
      $hashcontraseña = $valores["contraseña"];
      
    }

    if (password_verify($contraseña1, $hashcontraseña)){
   
    session_start();
    $_SESSION["user"]=$email1;
    $_SESSION["contraseña"]=$contraseña1;

    header('Location: mizona.php');
    
  }else{
    echo '<BODY onLoad="myFunction()">';
  }
    
    $mysql->close();

}



if (isset($_REQUEST["registrar"])){

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
    $email2=$_REQUEST["email2"];
    $contraseña2=$_REQUEST["contraseña2"];
    $hash=password_hash("$contraseña2", PASSWORD_DEFAULT);


    $sql = "INSERT INTO usuarios (nombre, apellidos, data_n, direccion, n_usuario, email, contraseña)
     VALUES ('$nombre','$apellidos','$data_n', '$direccion', '$n_usuario', '$email2', '$hash')";
    $mysql->query($sql) or die ($mysql->error);
    $mysql->close();
}

?>


<footer id="f2">

<a title="Facebook" href="https://www.facebook.com/electrolandspain"> <img src="assets/img/facebook.png" alt="" width="40" height="40"></a>
<a title="Instagram" href="https://www.instagram.com/electrolandspain/"><img src="assets/img/instagram.png" alt="" width="40" height="40"></a>
<br>
Correo: contactoelectroland@gmail.com

</footer>

</form>

<script type="text/javascript">
  function showContent() {
    iniciar = document.getElementById("ins");
    registrar = document.getElementById("reg");
    olv = document.getElementById("olv");

   iniciar.style.display='none';
   registrar.style.display='none';
   olv.style.display='inline';        
  }

  function myFunction() {
  alert("El email o la contraseña son incorrectos.");


  function myFunction1() {
  alert("El email y el usuario no coinciden.");
  }

  function myFunction2() {
  alert("Las contraseñas tienes que ser iguales.");
  }

  function myFunction3() {
  alert("La contraseña se ha actualizado correctamente.");
  }

}
</script>

</body>
</html>