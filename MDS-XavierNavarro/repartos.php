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
<body>
<style>


#misrepartos{
    margin: 0;
    width: 100%;
    height: auto;
    text-align: center;
    padding: 20;
}

#repartospendientes{
    padding: 20;
    margin-top: 50;
    position:relative;
    width: 100%;
    height: auto;
    left: 0;

    text-align: center;
}

#labelrepartos{
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 27;
}


.fotoprod{
    position: absolute;
    width: 50;
    height: 50;
    background: transparent;
    border: 0;
    color: transparent;
}

#botonusuario{
    background-color: transparent;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 20;
    border: 0;
}



#tablapendientes {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 98%;
}

#tablapendientes td, #tablapendientes th {
  border: 1px solid #ddd;
  padding: 8px;
}

#tablapendientes tr:nth-child(even){background-color: #f2f2f2;}

#tablapendientes tr:hover {background-color: #ddd;}

#tablapendientes th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
    <form action="repartos.php" method="post" enctype="multipart/form-data">
    
    <?php

        $repartidoractivo =  $_SESSION["repartidor"];
        $repartidornombre =  $_SESSION["nombre_repatidor"];

        if (isset($_REQUEST["atras"])){
            header('Location: index.php');
        }

        if (isset($_REQUEST["zonarepartidores"])){   //BOTO PARA IR A ZONA REPARTIDORES
            header('Location: zonarepartidores.php');
        } 

        if (isset($_REQUEST["producto"])){   //BOTO PARA IR A ZONA REPARTIDORES
            $_SESSION["producto"]=$_REQUEST["producto"];
            header('Location: producto.php');
        } 

        if (isset($_REQUEST["usuario"])){   //BOTO PARA IR USUARIO
            $_SESSION["usuario_elegido"] = $_REQUEST["usuario"];   
            header('Location: usuario.php'); 
        }

        if (isset($_REQUEST["aceptar"])){   //BOTO PARA aceptar
            
            $aceptar = $_REQUEST["aceptar"];
            $mysql = new mysqli ("localhost","root","","electroland");

            if($mysql->connect_error){
              die("Conexio fallida");
            }
          
            $sql= "UPDATE ventas SET repartidor='" . $repartidornombre . "'  WHERE id_producto=" . $aceptar;
            $mysql->query($sql) or die ($mysql->error);
            
            
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=repartos.php'>";






        }

    ?>

    <header id="headins">
        <button id="atras" name="atras"><img src="assets/img/logosinfondo.png" / width="95" height="95"></button>
        <input type="submit" name="zonarepartidores" value="Zona repartidores" id="zonarepartidores">
    </header>
    
    <?php

       $mysql = new mysqli ("localhost","root","","electroland");

        if($mysql->connect_error){
           die("Conexio fallida");
        }

        $consulta= "SELECT * FROM repartidores WHERE correo = '$repartidoractivo'";
        $resultatstaula= $mysql->query($consulta);
    
        while($valores = $resultatstaula->fetch_array()){
            $provincia = $valores["provincia"];
        }
  

     echo"<div id='misrepartos'>";
     echo" <label id='labelrepartos'><b>MIS REPARTOS</b></label><br><br><br>";

     echo " <table id='tablapendientes'>
     <tr>
   
     <td><b>USUARIO VENDE</b></td>
 
     <td><b>TELEFONO</b></td>
 
     <td><b>LOCALIDAD</b></td>

     <td><b>USUARIO COMPRA</b></td>
 
     <td><b>TELEFONO</b></td>
 
     <td><b>LOCALIDAD</b></td>

     <td><b>PRODUCTO</b></td>

     <td><b>ACCIONES</b></td>
 
   </tr>";

     $consulta1= "SELECT * FROM ventas v INNER JOIN usuarios u ON v.usuario_vende = u.n_usuario INNER JOIN productos p ON v.id_producto = p.id WHERE repartidor='$repartidornombre'";
     $resultatstaula= $mysql->query($consulta1);
 
     
       while($fila = $resultatstaula->fetch_array()){
           echo "<tr>";
         echo "<td><input type='submit' name='usuario' value='". $fila["usuario_vende"] ."' id='botonusuario'></td>";
         echo "<td>" . $fila["telefono_vende"] . "</td>";
         echo "<td>" .$fila["vende_localidad"] . "</td>";
         echo "<td><input type='submit' name='usuario' value='". $fila["usuario_compra"] ."' id='botonusuario'></td>";
         echo "<td>".$fila["telefono_compra"]. "</td>";
         echo "<td>".$fila["compra_localidad"]. "</td>";
         echo "<td><input type='submit' name='producto' value='" . $fila["id_producto"] . "'class='fotoprod'> <img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' name='producto' height='50' width='50'></td>"; 
         echo "<td><input type='submit' value='RECHAZAR'><input type='submit' value='MARCAR COMO ENTREGADO'></td>";
         echo "</tr>";
 
       }

     echo "</table>";
     




     echo"</div>";

     echo"<div id='repartospendientes'>";

     echo" <label id='labelrepartos'><b>REPARTOS PENDIENTES EN MI PROVINCIA</b></label><br><br><br>";

     echo " <table id='tablapendientes'>
     <tr>
   
     <td><b>USUARIO VENDE</b></td>
 
     <td><b>TELEFONO</b></td>
 
     <td><b>LOCALIDAD</b></td>

     <td><b>USUARIO COMPRA</b></td>
 
     <td><b>TELEFONO</b></td>
 
     <td><b>LOCALIDAD</b></td>

     <td><b>PRODUCTO</b></td>

     <td><b>ACCIONES</b></td>
 
   </tr>";

     $consulta1= "SELECT * FROM ventas v INNER JOIN usuarios u ON v.usuario_vende = u.n_usuario INNER JOIN productos p ON v.id_producto = p.id WHERE u.provincia = '$provincia' && repartidor IS NULL";
     $resultatstaula= $mysql->query($consulta1);
 
     
       while($fila = $resultatstaula->fetch_array()){
           echo "<tr>";
         echo "<td><input type='submit' name='usuario' value='". $fila["usuario_vende"] ."' id='botonusuario'></td>";
         echo "<td>" . $fila["telefono_vende"] . "</td>";
         echo "<td>" .$fila["vende_localidad"] . "</td>";
         echo "<td><input type='submit' name='usuario' value='". $fila["usuario_compra"] ."' id='botonusuario'></td>";
         echo "<td>".$fila["telefono_compra"]. "</td>";
         echo "<td>".$fila["compra_localidad"]. "</td>";
         echo "<td><input type='submit' name='producto' value='" . $fila["id_producto"] . "'class='fotoprod'> <img src='data:image/jpeg; base64," . base64_encode($fila["imagen"]) . "' name='producto' height='50' width='50'></td>"; 
         echo "<td><input type='submit'name='aceptar' value='" . $fila["id_producto"] . "'></td>";
         echo "</tr>";
 
       }

     echo "</table>";
     echo"</div>";

    ?>
    
    </form>
</body>
</html>
<?php
ob_end_flush();
?>
