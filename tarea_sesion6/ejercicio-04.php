<?php
$errores = [];
$resultados = [];
$cantidadPersonas = 0;
$mostrarFormPersonas = false;
$promedioValoracion = 0;
$satisfechos = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cuando se envía la cantidad de personas
    if (isset($_POST["generar"])) {
        $cantidadPersonas = (int)($_POST["cantidadPersonas"] ?? 0);
        if ($cantidadPersonas <= 0) {
            $errores[] = "Debes ingresar una cantidad válida mayor que 0.";
        } else {
            $mostrarFormPersonas = true;
        }
    }

    // Cuando se envía el formulario con datos de personas
    if (isset($_POST["procesar"])) {
        $cantidadPersonas = (int)($_POST["cantidadPersonas"] ?? 0);
        $nombres = $_POST["nombre"] ?? [];
        $valoraciones = $_POST["valoracion"] ?? [];
        $comentarios = $_POST["comentario"] ?? [];

        $sumValoracion = 0;
        $comentariosValidos = [];
        $satisfechos = 0;
        $valid = true;

        for ($i = 0; $i < $cantidadPersonas; $i++) {
            $nombre = trim($nombres[$i] ?? "");
            $valoracion = $valoraciones[$i] ?? null;
            $comentario = trim($comentarios[$i] ?? "");

            if ($nombre === "") {
                $errores[] = "El nombre de la persona #" . ($i + 1) . " no puede estar vacío.";
                $valid = false;
            }

            if (!in_array($valoracion, ["1","2","3","4","5"])) {
                $errores[] = "La valoración de la persona #" . ($i + 1) . " debe estar entre 1 y 5.";
                $valid = false;
            }

            if ($valid) {
                $sumValoracion += (int)$valoracion;
                if ((int)$valoracion >= 4) {
                    $satisfechos++;
                }
                $comentariosValidos[] = [
                    "nombre" => $nombre,
                    "valoracion" => (int)$valoracion,
                    "comentario" => $comentario,
                ];
            }
        }

        if ($valid) {
            $promedioValoracion = $cantidadPersonas > 0 ? $sumValoracion / $cantidadPersonas : 0;
            $resultados = $comentariosValidos;
        } else {
            $mostrarFormPersonas = true; // Volver a mostrar el formulario con errores
        }
    }
}
?>

Enunciado:
El usuario elige cuántas personas participarán en una encuesta. Se generan formularios para cada una con:
• Nombre de la persona
Valoración del servicio (1 a 5 usando radio)
• Comentario
El sistema debe:
• Calcular el promedio de valoración
• Mostrar todos los comentarios
• Indicar cuántos usuarios calificaron con 4 o 5 (satisfechos)
Usar for o foreach para procesar los datos.
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Encuesta de Valoración</title>
</head>
<body>
    <h2>Encuesta de Valoración del Servicio</h2>

    <?php if (!empty($errores)): ?>
        <div style="color:red;">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulario para ingresar cantidad de personas -->
    <?php if (!$mostrarFormPersonas && empty($resultados)): ?>
        <form method="post">
            <label>¿Cuántas personas participarán en la encuesta?</label>
            <input type="number" name="cantidadPersonas" min="1" required value="<?= htmlspecialchars($cantidadPersonas) ?>">
            <button type="submit" name="generar">Generar Formulario</button>
        </form>
    <?php endif; ?>

    <!-- Formulario para las personas -->
    <?php if ($mostrarFormPersonas): ?>
        <form method="post">
            <input type="hidden" name="cantidadPersonas" value="<?= htmlspecialchars($cantidadPersonas) ?>">
            <?php for ($i = 0; $i < $cantidadPersonas; $i++): ?>
                <fieldset style="margin-bottom: 15px;">
                    <legend>Persona #<?= $i + 1 ?></legend>
                    <label>Nombre:
                        <input type="text" name="nombre[]" required
                               value="<?= isset($_POST["nombre"][$i]) ? htmlspecialchars($_POST["nombre"][$i]) : '' ?>">
                    </label>
                    <br><br>
                    <label>Valoración del servicio:</label><br>
                    <?php for ($v = 1; $v <= 5; $v++): ?>
                        <label>
                            <input type="radio" name="valoracion[<?= $i ?>]" value="<?= $v ?>" required
                                <?= (isset($_POST["valoracion"][$i]) && $_POST["valoracion"][$i] == $v) ? "checked" : "" ?>>
                            <?= $v ?>
                        </label>
                    <?php endfor; ?>
                    <br><br>
                    <label>Comentario:<br>
                        <textarea name="comentario[]" rows="3" cols="40"><?= isset($_POST["comentario"][$i]) ? htmlspecialchars($_POST["comentario"][$i]) : '' ?></textarea>
                    </label>
                </fieldset>
            <?php endfor; ?>
            <button type="submit" name="procesar">Enviar Encuesta</button>
        </form>
    <?php endif; ?>

    <!-- Mostrar resultados -->
    <?php if (!empty($resultados)): ?>
        <h3>Resultados de la Encuesta</h3>
        <p><strong>Promedio de valoración:</strong> <?= round($promedioValoracion, 2) ?></p>
        <p><strong>Cantidad de personas satisfechas (valoración 4 o 5):</strong> <?= $satisfechos ?></p>
        <h4>Comentarios:</h4>
        <ul>
            <?php foreach ($resultados as $res): ?>
                <li><strong><?= htmlspecialchars($res["nombre"]) ?>:</strong> <?= htmlspecialchars($res["comentario"]) ?: "<em>Sin comentario</em>" ?></li>
            <?php endforeach; ?>
        </ul>
        <p><a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Realizar otra encuesta</a></p>
    <?php endif; ?>
</body>
</html>
