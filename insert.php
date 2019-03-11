<?php
require 'conexion/Config.php';
include 'seguridad.php';


/**
 * Registramos la nota 
 */
$user = $_SESSION['id'];

$nota  = trim($_POST['not']);
$fecha = $_POST['fec'];
$prio = $_POST['pri'];

try {
    $sql = "INSERT INTO notas (texto,fecha,prioridad,usuario) "
         . "VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql); 
    if($nota != "" && $fecha != "" && $prio != "" && $user != ""){
        $stmt->execute([$nota,$fecha,$prio,$user]);
        header('Location: listar.php');
    }
} catch (PDOException $ex) {
    echo "Error SQL insert: " . $ex->getMessage() . "<br>";
}
$conn = null;


