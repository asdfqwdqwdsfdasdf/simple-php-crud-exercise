<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Películas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper {
            width: 750px;
            margin: 0 auto;
        }
        .page-header h2 {
            margin-top: 0;
        }
        table tr td:last-child a {
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
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
                        <h2 class="pull-left">Películas</h2>
                        <a href="create.php" class="btn btn-success pull-right">Agregar nueva película</a>
                    </div>
                    <?php
                    // Conexión a la base de datos
                    require_once "config.php";

                    // Consulta SQL para obtener películas
                    $sql = "SELECT * FROM movies";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Título</th>";
                                        echo "<th>Género</th>";
                                        echo "<th>Año</th>";
                                        echo "<th>Calificación</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
                                        echo "<td>" . $row['release_year'] . "</td>";
                                        echo "<td>" . $row['rating'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Borrar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else {
                            echo "<p class='lead'><em>No se encontraron películas.</em></p>";
                        }
                    } else {
                        echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($link);
                    }

                    // Cierre de conexión
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
