<?php
$errores = [];
$temperaturas = [];
$cantidadDias = 0;
$mostrarFormulario = false;
$maxima = null;
$minima = null;
$promedio = 0;
$diasMaximos = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["generar"])) {
        $cantidadDias = (int)($_POST["cantidadDias"] ?? 0);
        if ($cantidadDias <= 0) {
            $errores[] = "Debe ingresar una cantidad de días mayor que 0.";
        } else {
            $mostrarFormulario = true;
        }
    }

    if (isset($_POST["calcular"])) {
        $cantidadDias = (int)($_POST["cantidadDias"] ?? 0);
        $temperaturas = $_POST["temperatura"] ?? [];

        // Validar temperaturas
        foreach ($temperaturas as $index => $temp) {
            if (!is_numeric($temp) || $temp < -30 || $temp > 60) {
                $errores[] = "La temperatura del día #" . ($index + 1) . " debe estar entre -30°C y 60°C.";
            }
        }

        if (empty($errores)) {
            $maxima = max($temperaturas);
            $minima = min($temperaturas);
            $suma = array_sum($temperaturas);
            $promedio = $cantidadDias > 0 ? $suma / $cantidadDias : 0;

            // Encontrar días con temperatura máxima
            $diasMaximos = [];
            foreach ($temperaturas as $index => $temp) {
                if ($temp == $maxima) {
                    // +1 porque el día 1 es índice 0
                    $diasMaximos[] = $index + 1;
                }
            }
        } else {
            $mostrarFormulario = true;
        }
    }
}
?>

Ejercicio 3: Reporte de temperaturas diarias
Enunciado:
Desarrolle un formulario donde el usuario:
1. Ingrese la cantidad de días que desea registrar.
2. Introduzca la temperatura de cada día (en °C).
3. Al enviar, el sistema debe:
• Mostrar la temperatura mayor, menor y el promedio.
• Indicar qué días (posición) tuvieron la temperatura máxima.
Validación: Permitir solo temperaturas entre -30°C y 60°C.
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Reporte de temperaturas diarias</title>
</head>
<body>
    <h2>Reporte de temperaturas diarias</h2>

    <?php if ($errores): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!$mostrarFormulario && !isset($_POST["calcular"])): ?>
        <form method="post">
            <label>Cantidad de días a registrar:</label>
            <input type="number" name="cantidadDias" min="1" required value="<?= htmlspecialchars($cantidadDias) ?>" />
            <button type="submit" name="generar">Generar campos</button>
        </form>
    <?php endif; ?>

    <?php if ($mostrarFormulario): ?>
        <form method="post">
            <input type="hidden" name="cantidadDias" value="<?= htmlspecialchars($cantidadDias) ?>" />
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr><th>Día</th><th>Temperatura (°C)</th></tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < $cantidadDias; $i++): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <input type="number" step="0.1" min="-30" max="60" name="temperatura[]" required
                                    value="<?= isset($temperaturas[$i]) ? htmlspecialchars($temperaturas[$i]) : '' ?>" />
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <br/>
            <button type="submit" name="calcular">Calcular reporte</button>
        </form>
    <?php endif; ?>

    <?php if (isset($_POST["calcular"]) && empty($errores)): ?>
        <h3>Reporte de Temperaturas</h3>
        <p><strong>Temperatura máxima:</strong> <?= number_format($maxima, 1) ?> °C</p>
        <p><strong>Temperatura mínima:</strong> <?= number_format($minima, 1) ?> °C</p>
        <p><strong>Temperatura promedio:</strong> <?= number_format($promedio, 1) ?> °C</p>
        <p><strong>Días con temperatura máxima:</strong> <?= implode(", ", $diasMaximos) ?></p>
        <p><a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Registrar nuevas temperaturas</a></p>
    <?php endif; ?>
</body>
</html>
