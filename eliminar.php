<?php
require 'conexion/Config.php';
include 'aplicacion.php';
/**
 * Consultamos las notas que podemos eliminar
 */
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id,texto FROM notas";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
} catch (PDOException $ex) {
    echo "Erro SQL: " . $ex->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>      
    </head>
    <body>
        <div class="container">
            <form action="" method="post">
                <div class="form-group">                
                    <label for="sel1">Select nota a eliminar:</label>
                    <select class="form-control" id="sel1" name="notaId">
                        <option value="">Seleccione...</option>
                        <?php
                        foreach ($data as $row) {
                            echo "<option value='{$row['id']}'>{$row['texto']}</option>";
                        }
                        ?>
                    </select>                
                </div>    
                <button type="submit" class="btn btn-danger" onclick=" return confirm('Realmente desea eliminar la nota?');">Delete</button>
            </form>
        </div>     
    </body>
</html>
<?php
/**
 * Eliminamos notas
 */
    if($_POST){
        /**
         * recuperamos el id de la nota que deseamos eliminar.
         */
        $id = $_POST['notaId'];         
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM notas WHERE id = ?";
            $stmt = $conn->prepare($sql);        

            if ($id != null) {
                $stmt->execute([$id]);
                header('Location: listar.php');
            }
                          
        } catch (PDOException $ex) {
            echo "Error al eliminar: " . $ex->getMessage();
        }
        $conn = null;
    }
    
    if(isset($_GET['idNota'])){
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM notas WHERE id = ?";
            $stmt = $conn->prepare($sql);                    
            $stmt->execute([$_GET['idNota']]);
            header('Location: listar.php');            
                          
        } catch (PDOException $ex) {
            echo "Error al eliminar: $sql " . $ex->getMessage();
        }
        $conn = null;        
    }
