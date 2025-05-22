<?php
$errores = [];
$notas = [];
$cantidadNotas = 0;
$suma = 0;
$promedio = 0;
$mostrarFormularioNotas = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Paso 1: se recibe la cantidad de notas para generar campos
    if (isset($_POST["generar"])) {
        $cantidadNotas = (int)($_POST["cantidadNotas"] ?? 0);
        if ($cantidadNotas <= 0) {
            $errores[] = "Debe ingresar una cantidad mayor que 0.";
        } else {
            $mostrarFormularioNotas = true;
        }
    }

    // Paso 2: se reciben las notas para calcular promedio
    if (isset($_POST["calcular"])) {
        $cantidadNotas = (int)($_POST["cantidadNotas"] ?? 0);
        $notas = $_POST["nota"] ?? [];

        // Validar cada nota
        foreach ($notas as $index => $nota) {
            if (!is_numeric($nota) || $nota < 0 || $nota > 20) {
                $errores[] = "La nota #" . ($index + 1) . " debe ser un número entre 0 y 20.";
            }
        }

        if (empty($errores)) {
            $suma = 0;
            foreach ($notas as $nota) {
                $suma += (float)$nota;
            }
            $promedio = $cantidadNotas > 0 ? $suma / $cantidadNotas : 0;
        } else {
            $mostrarFormularioNotas = true;
        }
    }
}
?>

Ejercicio 1: Calcular el promedio de N notas
Enunciado:
Cree una aplicación en PHP que permita al usuario:
1. Ingresar cuántas notas desea promediar.
2. Ingresar cada nota en campos generados dinámicamente (entre 0 y 20).
3. Calcular la suma y el promedio de las notas ingresadas.
Validación: No se deben aceptar notas fuera del rango de 0 a 20.
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Promedio de Notas</title>
</head>
<body>
    <h2>Calcular Promedio de Notas</h2>

    <?php if ($errores): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Paso 1: formulario para cantidad de notas -->
    <?php if (!$mostrarFormularioNotas && !isset($_POST["calcular"])): ?>
        <form method="post">
            <label>Cantidad de notas a ingresar:</label>
            <input type="number" name="cantidadNotas" min="1" required value="<?= htmlspecialchars($cantidadNotas) ?>" />
            <button type="submit" name="generar">Generar campos</button>
        </form>
    <?php endif; ?>

    <!-- Paso 2: formulario para ingresar notas -->
    <?php if ($mostrarFormularioNotas): ?>
        <form method="post">
            <input type="hidden" name="cantidadNotas" value="<?= htmlspecialchars($cantidadNotas) ?>" />
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr><th>#</th><th>Nota (0 - 20)</th></tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < $cantidadNotas; $i++): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <input type="number" step="0.01" min="0" max="20" name="nota[]" required
                                    value="<?= isset($notas[$i]) ? htmlspecialchars($notas[$i]) : '' ?>" />
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <br />
            <button type="submit" name="calcular">Calcular promedio</button>
        </form>
    <?php endif; ?>

    <!-- Mostrar resultados -->
    <?php if (isset($_POST["calcular"]) && empty($errores)): ?>
        <h3>Resultados</h3>
        <p><strong>Suma de notas:</strong> <?= number_format($suma, 2) ?></p>
        <p><strong>Promedio:</strong> <?= number_format($promedio, 2) ?></p>
        <p><a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Realizar nuevo cálculo</a></p>
    <?php endif; ?>
</body>
</html>
