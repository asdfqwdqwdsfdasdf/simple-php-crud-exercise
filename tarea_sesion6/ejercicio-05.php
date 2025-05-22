<?php
$errores = [];
$resultados = [];
$cantidadEmpleados = 0;
$mostrarFormEmpleados = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cuando se envía la cantidad de empleados
    if (isset($_POST["generar"])) {
        $cantidadEmpleados = (int)($_POST["cantidadEmpleados"] ?? 0);
        if ($cantidadEmpleados <= 0) {
            $errores[] = "Debe ingresar una cantidad válida mayor que 0.";
        } else {
            $mostrarFormEmpleados = true;
        }
    }

    // Cuando se envían los datos de empleados para procesar
    if (isset($_POST["procesar"])) {
        $cantidadEmpleados = (int)($_POST["cantidadEmpleados"] ?? 0);
        $nombres = $_POST["nombre"] ?? [];
        $puntajeCumplimiento = $_POST["cumplimiento"] ?? [];
        $puntajeActitud = $_POST["actitud"] ?? [];

        $valid = true;

        for ($i = 0; $i < $cantidadEmpleados; $i++) {
            $nombre = trim($nombres[$i] ?? "");
            $cumpl = $puntajeCumplimiento[$i] ?? "";
            $act = $puntajeActitud[$i] ?? "";

            // Validaciones
            if ($nombre === "") {
                $errores[] = "El nombre del empleado #" . ($i + 1) . " no puede estar vacío.";
                $valid = false;
            }
            if (!is_numeric($cumpl) || $cumpl < 0 || $cumpl > 100) {
                $errores[] = "El puntaje en cumplimiento del empleado #" . ($i + 1) . " debe estar entre 0 y 100.";
                $valid = false;
            }
            if (!is_numeric($act) || $act < 0 || $act > 100) {
                $errores[] = "El puntaje en actitud del empleado #" . ($i + 1) . " debe estar entre 0 y 100.";
                $valid = false;
            }
        }

        if ($valid) {
            for ($i = 0; $i < $cantidadEmpleados; $i++) {
                $nombre = trim($nombres[$i]);
                $cumpl = (float)$puntajeCumplimiento[$i];
                $act = (float)$puntajeActitud[$i];
                $promedio = ($cumpl + $act) / 2;

                if ($promedio >= 90) {
                    $clasificacion = "Excelente";
                } elseif ($promedio >= 70) {
                    $clasificacion = "Bueno";
                } elseif ($promedio >= 50) {
                    $clasificacion = "Regular";
                } else {
                    $clasificacion = "Deficiente";
                }

                $resultados[] = [
                    "nombre" => $nombre,
                    "cumplimiento" => $cumpl,
                    "actitud" => $act,
                    "promedio" => $promedio,
                    "clasificacion" => $clasificacion,
                ];
            }
        } else {
            $mostrarFormEmpleados = true;
        }
    }
}
?>

Enunciado:
El jefe de área indica cuántos empleados va a evaluar. Por cada uno se ingresa:
• Nombre
Puntaje en cumplimiento (0 a 100)
Puntaje en actitud (0 a 100)
El sistema debe:
• Calcular el puntaje promedio de cada empleado
• Clasificar al empleado según su puntaje:
• 90-100: Excelente
·
70-89: Bueno
·
50-69: Regular
<50: Deficiente
Mostrar los resultados en una tabla. Validar los rangos y usar bucle for .
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Evaluación de Empleados</title>
</head>
<body>
    <h2>Evaluación de Empleados</h2>

    <?php if (!empty($errores)): ?>
        <div style="color:red;">
            <ul>
                <?php foreach($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!$mostrarFormEmpleados && empty($resultados)): ?>
        <form method="post">
            <label>Cantidad de empleados a evaluar:</label>
            <input type="number" name="cantidadEmpleados" min="1" required value="<?= htmlspecialchars($cantidadEmpleados) ?>" />
            <button type="submit" name="generar">Generar formulario</button>
        </form>
    <?php endif; ?>

    <?php if ($mostrarFormEmpleados): ?>
        <form method="post">
            <input type="hidden" name="cantidadEmpleados" value="<?= htmlspecialchars($cantidadEmpleados) ?>" />
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Puntaje Cumplimiento (0-100)</th>
                        <th>Puntaje Actitud (0-100)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < $cantidadEmpleados; $i++): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <input type="text" name="nombre[]" required
                                       value="<?= isset($_POST["nombre"][$i]) ? htmlspecialchars($_POST["nombre"][$i]) : '' ?>" />
                            </td>
                            <td>
                                <input type="number" name="cumplimiento[]" min="0" max="100" step="0.01" required
                                       value="<?= isset($_POST["cumplimiento"][$i]) ? htmlspecialchars($_POST["cumplimiento"][$i]) : '' ?>" />
                            </td>
                            <td>
                                <input type="number" name="actitud[]" min="0" max="100" step="0.01" required
                                       value="<?= isset($_POST["actitud"][$i]) ? htmlspecialchars($_POST["actitud"][$i]) : '' ?>" />
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <br />
            <button type="submit" name="procesar">Calcular resultados</button>
        </form>
    <?php endif; ?>

    <?php if (!empty($resultados)): ?>
        <h3>Resultados de la Evaluación</h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Puntaje Cumplimiento</th>
                    <th>Puntaje Actitud</th>
                    <th>Puntaje Promedio</th>
                    <th>Clasificación</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $index => $empleado): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($empleado["nombre"]) ?></td>
                        <td><?= number_format($empleado["cumplimiento"], 2) ?></td>
                        <td><?= number_format($empleado["actitud"], 2) ?></td>
                        <td><?= number_format($empleado["promedio"], 2) ?></td>
                        <td><?= $empleado["clasificacion"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Evaluar nuevos empleados</a></p>
    <?php endif; ?>
</body>
</html>
