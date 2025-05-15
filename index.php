<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Empleados</h2>
                        <a href="create.php" class="btn btn-success pull-right">Agregar nuevo empleado</a>
                    </div>
                    <?php
                    // Se incluye el config.php que proporciona la conexion con mysql
                    require_once "config.php";
                    
                    // consulta select a la tabla employees
                    $sql = "SELECT * FROM employees";
                    //se almacena el conjunto resultado de la consulta sql (result set) en la variable $result
                    // resultset = estructura de datos que almacena el restulado (los registros) de la consulta sql
                    if($result = mysqli_query($link, $sql)){
                        //si el numero de filas de $result es mayor a 0 significa que contiene registros, entonces se crea una tabla mediante multiples echo
                        if(mysqli_num_rows($result) > 0){
                            // INICIO TABLA
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Dirección</th>";
                                        echo "<th>Sueldo</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                // iteracion de cada registro e inicializacion de $row con mysql_fetch_array que toma el $result (resultset) y lo convierte en un array
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    // se accede a cada valor correspondiente de la columna y se muestra como una fila en la tabla
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['salary'] . "</td>";
                                        echo "<td>";
                                        // cada fila tiene las mismas 3 opciones: read, update, delete mostradas con icono mediante el atributo class
                                        // asimismo read, update, delete reciben como parametro de la url concatenada el id correspondiente para mostrar segun corresponda.
                                        // ejemplo : registro id = 3 -> read.php?id=3
                                            echo "<a href='read.php?id=". $row['id'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Borrar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            //FIN TABLA 
                            // se libera la variable $result
                            mysqli_free_result($result);
                        } else{
                            // Significa que la tabla no contiene ningun registro, por lo que se imprime una cadena de error
                            echo "<p class='lead'><em>No records were found.</em></p>";
                      }
                    } else{
                        // De lo contrario se imprime una cadena de error: no se pudo ejecutar la consulta sql
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Se cierra la conexion myqsl
                    mysqli_close($link);
                    ?>

                </div>
            </div>        
        </div>
    </div>
</body>
</html>