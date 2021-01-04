<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
<style>

#foto{
  border-radius: 50%;
}
</style>

<?php

$id ='';
$imagenes = '';
$creado='';

    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName     = 'electroland';
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }
    
    //Get image data from database
    $result = $db->query("SELECT * FROM images_tabla");
    
    while($fila=mysqli_fetch_array($result)){
       $id = $fila['id'];
       $imagenes = $fila['imagenes'];
       $creado = $fila['creado'];

       echo "ID: " . $id . "<br>";
       echo "Creado: " . $creado . "<br>";
       echo "<img src='data:image/jpeg; base64," . base64_encode($imagenes) . "' height='300' width='300' id='foto'>" . "<br>";
    }



?>
</body>
</html>