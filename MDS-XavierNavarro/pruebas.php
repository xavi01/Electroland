
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php
$prod = "todos";
session_start();
$usuario=$_SESSION["usuario_elegido"];

if(isset($_SESSION["nombre_usuario"])){
$usuario_activo = $_SESSION["nombre_usuario"];

}

$mysql = new mysqli ("localhost","root","","electroland");

    if($mysql->connect_error){
      die("Conexio fallida");
    }

  $estrellas = 3;
   
      $comentario = "adeu";
      
      $data= date("Y-m-d");
      
      $sql= "INSERT INTO `valoracion`(`usuario_envia`, `usuario_recibe`, `estrellas`, `comentario`, `fecha`) VALUES ('" . $usuario_activo ."','" . $usuario . "'," . $estrellas . ",'". $comentario . "','". $data . "')";
      echo $sql;
      $mysql->query($sql) or die ($mysql->error);
      $prod="opiniones";
?>


</body>
</html>