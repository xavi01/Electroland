<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="text-align: center;">

<style>


#divmensajes{
    display: inline-block;
    width: 28%;
    padding: 10;
    background-color: red;
}

#divchat{
    display: inline-block;
    width: 67%;
    padding: 10;
    background-color: yellow;
    text-align: center;
}




</style>
    <form action="chat.php">
    
    <?php
        session_start();
        $usuario_activo = $_SESSION["nombre_usuario"];

        if (isset($_REQUEST["atras"])){   //BOTO PARA IR ATRAS
            header('Location: index.php');
        } 

        if(isset($_REQUEST["escogerchat"])){ //BOTON PARA ESCOGER CHAT
            $_SESSION["chat"] = $_REQUEST["escogerchat"];          
        }

        if(isset($_REQUEST["enviar"])){ //BOTON PARA ENVIAR MENSAJE
            $chatcon = $_SESSION["chat"];
            $texto = $_REQUEST["textoenviar"];
            $fecha = $data= date("Y-m-d H:i:s");

            $mysql = new mysqli ("localhost","root","","electroland");
 
            if($mysql->connect_error){
                die("Conexio fallida");
            }else{
             
            }
        
            $sql = "INSERT INTO chat (id_de, id_para, mensaje, fecha) VALUES ('$usuario_activo','$chatcon', '$texto', '$fecha')";
            $mysql->query($sql) or die ($mysql->error);
            $mysql->close();

        }


    ?>

    <header>
    <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button> 
    </header>



    <div id="divmensajes">    

        <?php

            $mysql = new mysqli ("localhost","root","","electroland");

            if($mysql->connect_error){
              die("Conexio fallida");
            }  

            $consulta= "SELECT usuario2 FROM mensajes WHERE usuario1 = '$usuario_activo'";
            $resultatstaula= $mysql->query($consulta);
        
            while($fila = $resultatstaula->fetch_array()){
        
              echo "<input type='submit' name='escogerchat' value='$fila[usuario2]'> <br><br>";
              
            }

            $consulta2= "SELECT usuario1 FROM mensajes WHERE usuario2 = '$usuario_activo'";
            $resultatstaula= $mysql->query($consulta2);
        
            while($fila = $resultatstaula->fetch_array()){
        
              echo "<input type='submit' name='escogerchat' value='$fila[usuario1]'> <br><br>";
              
            }

            $mysql->close();
        
        ?>




    </div>


    <div id="divchat">
        <?php
        if(!isset($_SESSION["chat"])){
           echo "<label for=''>Selecciona un chat para poder hablar.</label>";
        }else{
            $chat= $_SESSION["chat"];
            echo "Este es el chat con " . $chat ."<br><br>";

            $mysql = new mysqli ("localhost","root","","electroland");

            if($mysql->connect_error){
              die("Conexio fallida");
            }  

            $consulta= "SELECT * FROM chat WHERE (id_de = '$usuario_activo' AND id_para = '$chat')  OR  (id_para = '$usuario_activo' AND id_de = '$chat')";
            $resultatstaula= $mysql->query($consulta);
        
            while($fila = $resultatstaula->fetch_array()){
        
              echo $fila['id_de'] .": " . $fila['mensaje'] . ", " . $fila['fecha'] . "<br><br>";
              
            }

            $mysql->close();
            
            echo"<input type='text' name='textoenviar' id=''>";
            echo "<input type='submit' name='enviar' value='ENVIAR' id=''>";
        }

       ?>   
    </div>

    
    
    
    
    
 
    
    
    
    
    
    </form>
</body>
</html>