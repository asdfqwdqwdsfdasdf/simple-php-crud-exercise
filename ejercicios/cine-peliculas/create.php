<?php
// Incluir archivo de configuración
require_once "config.php";

// Inicializar variables
$title = $genre = $release_year = $rating = "";
$title_err = $genre_err = $release_year_err = $rating_err = "";

// Procesar datos del formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validar título
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Por favor ingrese el título de la película.";
    } else{
        $title = $input_title;
    }

    // Validar género
    $input_genre = trim($_POST["genre"]);
    if(empty($input_genre)){
        $genre_err = "Por favor ingrese el género.";
    } else{
        $genre = $input_genre;
    }

    // Validar año de estreno
    $input_release_year = trim($_POST["release_year"]);
    if(empty($input_release_year)){
        $release_year_err = "Por favor ingrese el año de estreno.";
    } elseif(!ctype_digit($input_release_year)){
        $release_year_err = "Por favor ingrese un año válido.";
    } else{
        $release_year = $input_release_year;
    }

    // Validar calificación
    $input_rating = trim($_POST["rating"]);
    if(empty($input_rating)){
        $rating_err = "Por favor ingrese una calificación.";
    } elseif(!is_numeric($input_rating) || $input_rating < 0 || $input_rating > 10){
        $rating_err = "Por favor ingrese un número entre 0 y 10.";
    } else{
        $rating = $input_rating;
    }

    // Verificar errores antes de insertar
    if(empty($title_err) && empty($genre_err) && empty($release_year_err) && empty($rating_err)){
        $sql = "INSERT INTO movies (title, genre, release_year, rating) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssii", $param_title, $param_genre, $param_release_year, $param_rating);

            $param_title = $title;
            $param_genre = $genre;
            $param_release_year = $release_year;
            $param_rating = $rating;

            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Algo salió mal. Inténtelo de nuevo más tarde.";
            }
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Película</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .wrapper{
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
                    <h2>Agregar Película</h2>
                </div>
                <p>Complete este formulario para agregar una nueva película.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                        <label>Título</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                        <span class="help-block"><?php echo $title_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($genre_err)) ? 'has-error' : ''; ?>">
                        <label>Género</label>
                        <input type="text" name="genre" class="form-control" value="<?php echo $genre; ?>">
                        <span class="help-block"><?php echo $genre_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($release_year_err)) ? 'has-error' : ''; ?>">
                        <label>Año de Estreno</label>
                        <input type="text" name="release_year" class="form-control" value="<?php echo $release_year; ?>">
                        <span class="help-block"><?php echo $release_year_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                        <label>Calificación</label>
                        <input type="text" name="rating" class="form-control" value="<?php echo $rating; ?>">
                        <span class="help-block"><?php echo $rating_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Guardar">
                    <a href="index.php" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>        
    </div>
</div>
</body>
</html>
