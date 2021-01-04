<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="prueba.php" method="post" enctype="multipart/form-data">
        Select image to upload: <br>
        <input type="file" name="image"/><br>
        <input type="submit" name="submit" value="UPLOAD"/>
    
<?php
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        /*
         * Insert image data into database
         */
        
        //DB details
        $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'electroland';
        
        //Create connection and select DB
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        
        // Check connection
        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);
        }
        
        $dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
        $insert = $db->query("INSERT into images_tabla (imagenes, creado) VALUES ('$imgContent', '$dataTime')");
        if($insert){
            echo "File uploaded successfully.";
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
}



echo "<br><br>";
echo "PASSWORD CIFRADA";
$hash=password_hash("xavi1234", PASSWORD_DEFAULT); 
echo "<br>";
echo $hash;

echo "<br>";
if (password_verify('xavi1234', $hash)) {
    echo '¡La contraseña es válida!';

} else {
    echo 'La contraseña no es válida.';
}

?>

</form>

</body>
</html>