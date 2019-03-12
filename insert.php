<?php
require 'conexion/Config.php';
include 'seguridad.php';


/**
 * Registramos la nota 
 */
$user = $_SESSION['id'];

$nota  = trim($_POST['not']);
//$nota  = str_replace('  ', ' ', $nota);
// Elimina espacios repetitivos 
$nota = preg_replace('/( ){2,}/u',' ',$nota); 
$fecha = $_POST['fec'];
$prio  = $_POST['pri'];

try {
    $sql = "INSERT INTO notas (texto,fecha,prioridad,usuario) "
         . "VALUES (trim(?),?,?,?)";
    $stmt = $conn->prepare($sql); 
    if(trim($nota) != "" && $fecha != "" && $prio != "" && $user != ""){
        $stmt->execute([trim($nota),$fecha,$prio,$user]);
        header('Location: listar.php');
    }
} catch (PDOException $ex) {
    echo "Error SQL insert: " . $ex->getMessage() . "<br>";
}
$conn = null;


