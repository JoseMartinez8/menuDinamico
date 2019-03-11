<?php
include 'conexion/Config.php';
include 'seguridad.php';
include 'style.html';

/**
 * pagina que muestra menu dinamico consultado por rol 
 */

/**
 * codigo del rol que posee el usuario que ha iniciado session
 */
$_SESSION['rol'];
try {
    $sql = "SELECT nombre "
         . "FROM acciones a "
         . "INNER JOIN permisos p ON a.codigo = p.codigo_accion "
         . "WHERE p.codigo_rol = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($_SESSION['rol']));
    $data = $stmt->fetchAll();
    $resu  = count($data);
    
    if($resu == 0) {
        echo "El usuario no tiene permisos para ninguna acción";
    }
        echo "<br><br>";
        echo "<p align='right'>".$_SESSION["user"]."&nbsp&nbsp&nbsp"."<br>"
                . "<button>"
                . "<a href='salir.php'>Salir&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>"
                . "</button>"
            ."</p>";
        
    echo "<center>";
    echo "<br><br>";
        foreach ($data as $row) {         
         echo "<button class='btn btn-default'>";
            echo "<a href='{$row['nombre']}.php'>{$row['nombre']} </a>";           
         echo "</button>";
         echo "&nbsp";
         echo "&nbsp";  
        }
    echo "</center>";

} catch (PDOException $ex) {
    echo "Error SQL: " .$ex->getMessage()."<br>";
}
$conn = null;