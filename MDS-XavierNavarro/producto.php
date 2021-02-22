<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>

#corazon{
    width: 90;
    height: 90;
    background-image: url(assets/img/facebook.png);
    background-color: white;
    border: 0;
}




</style>
<body>
    <form action="producto.php">
    
    <header>
          <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button>
    </header>


    <?php

        if (isset($_REQUEST["atras"])){   //BOTO PARA IR A MI ZONA
           header('Location: index.php');
           
        } 

    session_start();
    $id_producto = $_SESSION["producto"];


    $mysql = new mysqli ("localhost","root","","electroland");

    if($mysql->connect_error){
        die("Conexio fallida");
    }

    $consulta= "SELECT id, nombre, descripcion, precio, categoria, estado, imagen, usuario, data_publicacion FROM productos where ID = $id_producto";
    $resultatstaula= $mysql->query($consulta);

    while($fila = $resultatstaula->fetch_array()){
    
        
        echo "<div>";
         
        echo "Usuario: " . $fila["usuario"] . "<br>";
        echo "Nombre: " . $fila["nombre"] . "<br>";
        echo "Descripcion: " . $fila["descripcion"] . "<br>";
        echo "Precio: " . $fila["precio"] . "<br>";
        echo "Categoria: " . $fila["categoria"] . "<br>";
        echo "Estado: " . $fila["estado"] . "<br>";
        echo "Data publicacion: " . $fila["data_publicacion"]."<br>";
        
    
        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' name='producto' height='200' width='200'>";
    
     
        //echo "</div>";
    }

    $mysql->close();

    ?>

    <input type="button" name="corazon" value="">

</div>
    
    </form>
</body>
</html>