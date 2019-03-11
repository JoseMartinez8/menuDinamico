<?php
require 'conexion/Config.php';



/**
 * Registramos la nota 
 */

$nom     = $_POST['nom'];
$nomUser = $_POST['user'];
$pass    = md5($_POST['psw']);
$codRol  = $_POST['rolId'];

try {
    $sql = "INSERT INTO usuarios (nombre,user,password,codigo_rol) "
         . "VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql); 
    $stmt->execute([$nom,$nomUser,md5($_POST['psw']),$codRol]);
    header('Location: index.php');
  
} catch (PDOException $ex) {
    echo "Error SQL insert: " . $ex->getMessage() . "<br>";
}
$conn = null;



