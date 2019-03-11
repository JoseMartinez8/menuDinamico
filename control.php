<?php
session_start();
require 'conexion/config.php';

if ($_POST){
    $psw = md5($_POST['pwd']);
    $psw = substr($psw,0,20);
    try {
        $sql = "SELECT * FROM usuarios WHERE user = ? AND PASSWORD = ?";
        $stmt = $conn->prepare($sql); 
        $stmt->execute(array($_POST['user'],$psw));
        $data = $stmt->fetchAll();     
//        $resu  = count($data);
        $resu = $stmt->rowCount();
//        die($resu);
        if($resu == 0){
            header('Location: index.php?errorUsusario=si');
        }
     
        foreach ($data as $row) {            
            if($_POST['user'] == $row['user'] && substr(md5($_POST['pwd']), 0,20) == $row['password']){
                echo "Dentro condicion foreach";
                $_SESSION['auntenticado'] = "SI";            
                $_SESSION['user']  = $_POST['user'];
                $_SESSION['pass']  = $_POST['pwd'];
                $_SESSION['rol']   = $row['codigo_rol'];
                $_SESSION['id']    = $row['codigo'];
                header('Location: aplicacion.php');
            }
        }

    } catch (Exception $ex) {
        echo "Consulta error: " . $ex->getMessage() . "<br>";
        die();
    }
    $conn = null;
} 
else {   
    header('Location: aplicacion.php');
}

