<?php 
    include 'aplicacion.php';            
    $var = "";
    if($_SESSION['rol'] != 1) {
        $var = "onclick ='return false;'";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listar notas</title>        
    </head>
    <body>
        
        <div class="container">
            <h2>Lista de todas las notas creados por usuario</h2>
            <p>The .table-hover class adds a hover effect (grey background color) on table rows:</p>            
            <table class="table table-bordered">
              <thead>
                  <tr class="warning">
                  <th>Id</th>
                  <th>Texto</th>
                  <th>Fecha</th>
                  <th>Priorida</th>
                  <th>Nombre usuario</th>
                  <th>Actualizar</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody>
            <?php
                try { 
                    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT id,texto,fecha,prioridad,nombre "
                         . "FROM notas n "
                         . "INNER JOIN usuarios u ON n.usuario = u.codigo";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $data = $stmt->fetchAll();
                    $resu  = count($data);

                    foreach ($data as $row) {
                        echo "<tr>";			
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".trim($row['texto'])."</td>";
                            echo "<td>".$row['fecha']."</td>";
                            echo "<td>".$row['prioridad']."</td>";
                            echo "<td>".$row['nombre']."</td>";
                            echo "<td>" .
                                    "<button class='btn btn-warning' disable>" .
                                        "<a href='actualizar.php?notaId={$row['id']}' $var><p style='color:white;'>Editar</p></a>" .
                                    "</button>" .            
                                 "</td>";  
                             echo "<td>" .                                   
                                    "<button class='btn  btn-danger' onclick=\" return confirm('Realmente desea eliminar la nota?'); \" >" .
                                        "<a href='eliminar.php?idNota={$row['id']}' $var ><p style='color:white;'>Eliminar</p></a>" .
                                    "</button>" .            
                                 "</td>";
                        echo "</tr>";
                    }

                } catch (PDOException $ex) {
                    echo "Erro SQL: " . $ex->getMessage();
                }
                $conn = null;
            ?>             
              </tbody>
            </table>            
        </div>             
    </body>
</html>


