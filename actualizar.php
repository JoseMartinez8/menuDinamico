<?php
require 'conexion/Config.php';
include 'aplicacion.php';
/**
 * Consultamos las notas cuando inicie la pagina
 */
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
//     set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id, texto "
         . "FROM notas n ";
        
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $datas = $stmt->fetchAll();
} catch (PDOException $ex) {
    echo "Erro SQL: " . $ex->getMessage();
}
$conn = null;

/**
 * Se recibe el id de la nota por metodo get
 */
if(isset($_GET['notaId']) && $_GET['notaId'] != "" && $_GET['notaId'] != null) {
    try {
    $id = $_GET['notaId'];    
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id,texto,fecha,prioridad,nombre "
         . "FROM notas n "
         . "INNER JOIN usuarios u ON n.usuario = u.codigo "
         . "WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetchAll();
    foreach ($data as $row) {
        $nota = $row;        
        $fecha = date("d-m-y", strtotime($nota['fecha']) );
    }

    } catch (PDOException $ex) {
        echo "Erro SQL: " . $ex->getMessage();
    }
    $conn = null;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">            
            <form action="" method="get">
                <div class="form-group">                
                    <label for="sel1">Select nota para actualizar:</label>
                    <select class="form-control" id="notaId" name="notaId">
                        <option value="">Seleccione...</option>
                        <?php
                        foreach ($datas as $row) {
                            echo "<option value='{$row['id']}'>{$row['texto']}</option>";
                        }
                        ?>
                    </select>                
                </div>    
                <button type="submit" class="btn btn-primary" onclick="myFunction()">Submit</button>
            </form>
            <hr>
            <h3>Form Actualizar notas.</h3>
           <?php if (isset($nota)) { ?>
            <form action="update.php" method="post">
                <div class="form-group">
                    <label for="nota">Nota:</label>                  
                    <textarea class="form-control" name="not" rows="4" cols="30" placeholder="Nota" required>  
                        <?php if (isset($nota)){ echo $nota['texto']; } ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="fec">Fecha:</label>
                    <input type="date" class="form-control" id="fec" name="fec" 
                           value="<?php echo date('Y-m-d', strtotime($nota['fecha'])) ?>" required>
                </div>
                <div class="form-group">
                    <label for="pri">Priorida:</label>
                    <input type="number" class="form-control" id="pri" name="pri" placeholder="Prioridad" 
                           value="<?php echo $nota['prioridad'] ?>" required>
                </div>           
                <div class="form-group">
                    <label for="user">Usuario:</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" 
                           value="<?php echo $nota['nombre'] ?>" required readonly>
                </div> 
                <input type="hidden" class="form-control" id="user" name="id" placeholder="Id" 
                           value="<?php echo $nota['id'] ?>" required readonly>
                <button type="submit" class="btn btn-warning">Editar</button>
            </form>            
           <?php } ?>
            <hr>
        </div>     
    </body>
</html>

