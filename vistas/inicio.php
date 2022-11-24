<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if(isset($_SESSION['usuario'])){
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inicio</title>
    <?php require_once "menu.php";?>
</head>
<body>
    
</body>
</html>

<?php

    }else {
        header("location:../index.php");
    }

?>