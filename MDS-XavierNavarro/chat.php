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
    <form action="">
    
    <?php
        if (isset($_REQUEST["atras"])){   //BOTO PARA IR ATRAS
            header('Location: index.php');
        } 

        if(isset($_REQUEST["escogerchat"])){
            $chatcon = $_REQUEST["escogerchat"];
            $_SESSION["chat"] = $chatcon;
        }

    ?>

    <header>
    <button id="atras" name="atras"><img src="assets/img/logosinfondo.png"/ width="95" height="95"></button> 
    </header>



    <div id="divmensajes">    
        <input type="submit" name="escogerchat" value="USUARI 1"><br><br>
        <input type="submit" name="escogerchat" value="USUARI 2"><br><br>
        <input type="submit" name="escogerchat" value="USUARI 3"><br><br>
        <input type="submit" name="escogerchat" value="USUARI 4"><br><br>
    </div>


    <div id="divchat">
        <?php
        if(!isset($_SESSION["chat"])){
           echo "<label for=''>Selecciona un chat para poder hablar.</label>";
        }else{
            $chat= $_SESSION["chat"];
            echo "Este es el chat con " . $chat ;
        }
        ?>   
    </div>

    
    
    
    
    
    
    
    
    
    
    
    </form>
</body>
</html>