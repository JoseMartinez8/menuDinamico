<!DOCTYPE html>
<?php
include 'aplicacion.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear nota</title>
    </head>
    <body>
        <div class="container">
            <h2>Form crear notas.</h2>
            <!--Form login-->
            <form action="insert.php" method="post">
                <div class="form-group">
                    <label for="nota">Nota:</label>                  
                    <textarea class="form-control" name="not" rows="4" cols="30" placeholder="Nota." required>  
                      Nota.
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="fec">Fecha:</label>
                    <input type="date" class="form-control" id="fec" name="fec" required>
                </div>
                <div class="form-group">
                    <label for="pri">Priorida:</label>
                    <input type="number" class="form-control" id="pri" name="pri" required>
                </div>                
                <button type="submit" class="btn btn-default">Submit</button>
            </form>             
        </div>
        
    </body>
</html>
