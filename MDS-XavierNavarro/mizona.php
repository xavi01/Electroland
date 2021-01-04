<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<form action="mizona.php" method="post" enctype="multipart/form-data">


<?php
if (isset($_REQUEST["atras"])){

  header('Location: index.php');
}


session_start();
$useractivo =  $_SESSION["user"];

if (isset($_REQUEST["cerrar"])){

  session_destroy();
  header('Location: index.php');
}

$mysql = new mysqli ("localhost","root","","electroland");

    if($mysql->connect_error){
        die("Conexio fallida");
    }

    $consulta= "SELECT nombre, apellidos, data_n, direccion, n_usuario, email, contraseña, fotoperfil FROM usuarios WHERE email = '$useractivo'";
    $resultatstaula= $mysql->query($consulta);

    while($valores = $resultatstaula->fetch_array()){
        $nombre = $valores["nombre"];
        $apellidos = $valores["apellidos"];
        $data_n = $valores["data_n"];
        $direccion = $valores["direccion"];
        $n_usuario = $valores["n_usuario"];
        $email = $valores["email"];
        $contraseña = $valores["contraseña"];
        $fotoperfil = $valores["fotoperfil"];
        
    }
    $mysql->close();

    if($fotoperfil != null){
echo "<img src='data:image/jpeg; base64," . base64_encode($fotoperfil) . "' height='150' width='150' id='fotoperfil'>";
    }

  
echo "<h1 id='bienvenido'>    Bienvenido " . $n_usuario. ".</h1>" . "<br><br><br>";

?>



<header id="headins">
    
    <input type="submit" name="atras" value="Atras" id="atras">

    <!--<img src="assets/img/1.JPG" alt="" width="150" height="150">-->
    <input type="submit" name="cerrar" value="Cerrar sesión" id="cerrar">

</header>

<input type="submit" value="Editar" name="edit" id="buttonedit" class="botons"><br><br>



<div class="editar" id="edit1" style="display:none" >
Nombre: <br>
<input type="text" name="nombre" value="<?php echo $nombre; ?>" id="" class="bordeRodo"><br><br>
Apellidos: <br>
<input type="text" name="apellidos"value="<?php echo $apellidos; ?>"  id="" class="bordeRodo"><br><br>
Direccion: <br>
<input type="text" name="direccion" value="<?php echo $direccion; ?>" id="" class="bordeRodo"><br><br>
Data de nacimiento: <br> 
<input type="date" name="data"  value="<?php echo $data_n; ?>" class="bordeRodo"><br><br>
</div>



<div class="editar" id="edit2" style="display:none">
Usuario: <br>
<?php echo $n_usuario; ?> <br><br>
Email: <br>
<?php echo $email; ?> <br><br>
Contraseña: <br>
<input type="password" name="contraseña"  value="<?php echo $_SESSION["contraseña"]; ?>"  class="bordeRodo"><br><br>
Foto de perfil: <br>
<input type="file"  name="imageperfil"/>
<input type="submit" name="guardar" value="Guardar" class="botons" id="guardar">
</div>


<div class="editar" id ="edit3" style="display:inline-block">
Nombre: <br>
<?php echo $nombre; ?> <br><br>
Apellidos: <br>
<?php echo $apellidos; ?> <br><br>
Direccion: <br>
<?php echo $direccion; ?> <br><br>
</div>

<div class="editar" id ="edit4" style="display:inline-block">
Data de nacimiento: <br>
<?php echo $data_n; ?> <br><br>
Usuario: <br>
<?php echo $n_usuario; ?> <br><br>
Email: <br>
<?php echo $email; ?> <br><br>
</div>


<footer id="f1">

<a title="Facebook" href="https://www.facebook.com/electrolandspain"> <img src="assets/img/facebook.png" alt="" width="40" height="40"></a>
<a title="Instagram" href="https://www.instagram.com/electrolandspain/"><img src="assets/img/instagram.png" alt="" width="40" height="40"></a>
<br>
<h id="textcorreo">contactoelectroland@gmail.com</h>

</footer>



<?php

  if (isset($_REQUEST["edit"])){
    echo '<BODY onLoad="ActivarCampoOtroTema()">';
  }



  if (isset($_REQUEST["guardar"])){

    $nombre = $_REQUEST["nombre"];
    $apellidos = $_REQUEST["apellidos"];
    $direccion = $_REQUEST["direccion"];
    $data = $_REQUEST["data"];
    $contraseña = $_REQUEST["contraseña"];

    $hashcontraseñanova=password_hash($contraseña, PASSWORD_DEFAULT);

 
    $check = getimagesize($_FILES["imageperfil"]["tmp_name"]);

    if($check !== false){
        $image = $_FILES['imageperfil']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    }
    
    $mysql = new mysqli ("localhost","root","","electroland");
    
    if($mysql->connect_error){
        die("Conexio fallida");
    }

    $consulta= "UPDATE usuarios SET nombre='$nombre',  apellidos='$apellidos', data_n='$data',   direccion='$direccion', contraseña='$hashcontraseñanova', fotoperfil = '$imgContent' WHERE email = '$useractivo'";

    if ($mysql->query($consulta) === TRUE) {
     
    } else {
      echo "Error updating record: " . $mysql->error;
    }
 

   $mysql->close();

   echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=mizona.php'>";

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