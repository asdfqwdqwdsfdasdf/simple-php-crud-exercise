<?php
// Verifica si existe el parámetro ID
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Incluir archivo de configuración
    require_once "config.php";
    
    // Preparar consulta
    $sql = "SELECT * FROM movies WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Asignar valor
        $param_id = trim($_GET["id"]);
        
        // Ejecutar
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                // Obtener fila como array asociativo
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Obtener valores
                $title = $row["title"];
                $genre = $row["genre"];
                $release_year = $row["release_year"];
                $rating = $row["rating"];
            } else {
                // ID inválido, redirigir
                header("location: error.php");
                exit();
            }
        } else {
            echo "¡Ups! Algo salió mal. Inténtalo de nuevo más tarde.";
        }
    }
     
    // Cerrar statement y conexión
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    // No hay parámetro id
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Película</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Detalles de la Película</h1>
                    </div>
                    <div class="form-group">
                        <label>Título</label>
                        <p class="form-control-static"><?php echo htmlspecialchars($title); ?></p>
                    </div>
                    <div class="form-group">
                        <label>Género</label>
                        <p class="form-control-static"><?php echo htmlspecialchars($genre); ?></p>
                    </div>
                    <div class="form-group">
                        <label>Año de Estreno</label>
                        <p class="form-control-static"><?php echo $release_year; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Calificación</label>
                        <p class="form-control-static"><?php echo $rating; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
