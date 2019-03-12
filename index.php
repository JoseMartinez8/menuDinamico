<!DOCTYPE html>
<?php include 'style.html'; 
      require 'conexion/Config.php';  
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT codigo,nombre_rol FROM roles";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
} catch (PDOException $ex) {
    echo "Erro SQL: " . $ex->getMessage();
}
$conn = null;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <div class="container">         
            <?php 
            if ($_GET){
                if($_GET['errorUsusario'] == "si"){
                    echo "<h2><font color='red'>El usuario no existe!</font></h2>";
                }       
            }else{
                   echo "<h2>Inicie sesión</h2>";
                }
            ?>
            <h2>Vertical (basic) form</h2>
            <form action="control.php" method="post">
                <div class="form-group">
                    <label for="email">Usuario:</label>
                    <input type="text" class="form-control" id="user" placeholder="Enter user" 
                           name="user" required="true">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" 
                           name="pwd" required="true">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <hr>
            <h2>Eres nuevo?</h2>
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Registrate</button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>Some text in the modal.</p>
                            <form action="registrarUser.php" method="post">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nom" placeholder="Nombre completo" 
                                           name="nom" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="user">Nombre usuario:</label>
                                    <input type="text" class="form-control" id="user" placeholder="Nombre usuario" 
                                           name="user" required="true">
                                </div>
                                
                                <div class="form-group">
                                    <label for="psw">Password:</label>
                                    <input type="password" class="form-control" id="user" placeholder="Password" 
                                           name="psw" required="true">
                                </div>
                                
                                <div class="form-group">                
                                    <label for="rolId">Rol de usuario:</label>
                                    <select class="form-control" id="rolId" name="rolId">
                                        <option value="">Seleccione...</option>
                                        <?php
                                        foreach ($data as $row) {
                                            echo "<option value='{$row['codigo']}'>{$row['nombre_rol']}</option>";
                                        }
                                        ?>
                                    </select>                
                                </div>
                                
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> Remember me</label>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
    </body>
</html>
