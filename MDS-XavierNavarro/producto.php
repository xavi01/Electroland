<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #cccccc">
<style>

#corazon{
    width: 60px;
    height: 60px;
    background-image: url(assets/img/corazzonn.png);
    background-color: white;
    border: 0;
    border-radius: 15px;
}

#corazonrojo{
    width: 60px;
    height: 60px;
    background-image: url(assets/img/corazzon.png);
    background-color: white;
    border: 0;
    border-radius: 15px;
}
.corazon :focus {
    border: 1px black;
    background-color: yellow;
}

#producto{
    position: relative;
    left: 35%;
    margin-top: 25px;
    padding: 30;
    text-align: center;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 20;
    background-color: white;
    border-radius: 10%;
    width: 400px;
    height: 600px;
}


</style>


<form action="producto.php">
    
    <header style="background-color: #cccccc">
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
           
        echo "<div id='producto'>";

        echo "<img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' name='producto' height='350' width='350'> . <br> ";        
        echo "Usuario: " . $fila["usuario"] . "<br>";
        echo "Nombre: " . $fila["nombre"] . "<br>";
        echo "Descripcion: " . $fila["descripcion"] . "<br>";
        echo "Precio: " . $fila["precio"] . "€ <br>";
        echo "Categoria: " . $fila["categoria"] . "<br>";
        echo "Estado: " . $fila["estado"] . "<br>";
        echo "Data publicacion: " . $fila["data_publicacion"]."<br>";
        
    }

    if(isset($_SESSION["user"])){
        $n_usuario = $_SESSION["nombre_usuario"];
        $query= mysqli_query ($mysql,"SELECT * FROM productos_megusta WHERE n_usuario = '$n_usuario' AND id_prod = '$id_producto' ");
        $row_cnt = $query->num_rows;


        if ($row_cnt > 0) {
            echo "<input type='submit' id='corazonrojo' name='corazonrojo' value=''>";
        } else {
            echo "<input type='submit' id='corazon' name='corazon' value=''>";
        }


    }

    if(isset($_REQUEST['corazon'])){
      echo "<input type='submit' id='corazonrojo' name='corazonrojo' value=''>";
      echo '<BODY onLoad="mostrarCorazonRojo()">';

      $sql = "INSERT INTO productos_megusta (n_usuario, id_prod) VALUES ('$n_usuario', $id_producto) ";
      $mysql->query($sql) or die ($mysql->error);
    }

    if(isset($_REQUEST['corazonrojo'])){
      echo "<input type='submit' id='corazon' name='corazon' value=''>";
      echo '<BODY onLoad="mostrarCorazonNegro()">';

      $sql = "DELETE FROM productos_megusta WHERE n_usuario = '$n_usuario' AND id_prod = '$id_producto' ";
      $mysql->query($sql) or die ($mysql->error);
    }




    $mysql->close();

    ?>
    </div>

<script>

    var corazon_negro = document.getElementById('corazon');
    var corazon_rojo = document.getElementById('corazonrojo');
        
    function mostrarCorazonRojo() {
        corazon_negro.style.display = 'none';
        //corazon_rojo.style.display = 'inline';
    }

    function mostrarCorazonNegro() {
        corazon_rojo.style.display = 'none';
        //corazon_negro.style.display = 'inline';
    }



</script>

</form>
</body>
</html>