<?php
// Inicializar variables
$errores = [];
$resultado = "";
$mostrarFormularioNotas = false;
$notas = [];
$cantidad = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si el usuario quiere generar los campos
    if (isset($_POST["generar"])) {
        $cantidad = isset($_POST["cantidad"]) ? (int)$_POST["cantidad"] : 0;
        if ($cantidad <= 0) {
            $errores[] = "Debe ingresar una cantidad válida mayor que 0.";
        } else {
            $mostrarFormularioNotas = true;
        }
    }

    // Si el usuario envía las notas
    if (isset($_POST["procesar"])) {
        $cantidad = isset($_POST["cantidad"]) ? (int)$_POST["cantidad"] : 0;
        $notas = isset($_POST["notas"]) ? $_POST["notas"] : [];
        $validadas = [];
        $suma = 0;
        $aprobadas = 0;
        $desaprobadas = 0;
        $max = -1;
        $min = 21;

        // Validar cada nota
        for ($i = 0; $i < $cantidad; $i++) {
            $nota = isset($notas[$i]) ? trim($notas[$i]) : "";

            if ($nota === "") {
                $errores[] = "La nota #" . ($i + 1) . " está vacía.";
                continue;
            }

            if (!is_numeric($nota) || $nota < 0 || $nota > 20) {
                $errores[] = "La nota #" . ($i + 1) . " debe ser un número entre 0 y 20.";
                continue;
            }

            $nota = floatval($nota);
            $validadas[] = $nota;
            $suma += $nota;
            if ($nota >= 11) {
                $aprobadas++;
            } else {
                $desaprobadas++;
            }
            if ($nota > $max) $max = $nota;
            if ($nota < $min) $min = $nota;
        }

        if (empty($errores)) {
            $promedio = $suma / count($validadas);
            $resultado = "
                <h3>Resultados:</h3>
                <ul>
                    <li>Promedio: " . round($promedio, 2) . "</li>
                    <li>Nota más alta: $max</li>
                    <li>Nota más baja: $min</li>
                    <li>Notas aprobadas (≥11): $aprobadas</li>
                    <li>Notas desaprobadas (<11): $desaprobadas</li>
                </ul>
            ";
        } else {
            $mostrarFormularioNotas = true; // Volver a mostrar campos con errores
        }
    }
}
?>
El usuario ingresa la cantidad de notas a procesar. luego se generan dinamicamente
los campos para que el usuario ingrese las calificaciones del 0 al  20.
luego el programa debe recorrer las noats ingresadas mediante for y mostrar:
    el promedio, la nota mas alta, la mas baja. cantidad de notas aprobadas >=11 y desaprobadas <11
    incluir validacion de notas, noton de borrar y envio. realizalo en php
<!DOCTYPE html>
<html>
<head>
    <title>Ingreso de Notas</title>
</head>
<body>
    <h2>Procesador de Notas en PHP</h2>

    <!-- Mostrar errores -->
    <?php if (!empty($errores)): ?>
        <div style="color:red;">
            <ul>
                <?php foreach ($errores as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulario para ingresar cantidad -->
    <form method="post">
        <label>Cantidad de notas a procesar:</label>
        <input type="number" name="cantidad" min="1" value="<?= htmlspecialchars($cantidad) ?>" required>
        <button type="submit" name="generar">Generar Campos</button>
        <button type="reset">Borrar</button>
    </form>

    <!-- Formulario para ingresar notas -->
    <?php if ($mostrarFormularioNotas): ?>
        <form method="post">
            <input type="hidden" name="cantidad" value="<?= htmlspecialchars($cantidad) ?>">
            <h3>Ingrese las notas (0 - 20):</h3>
            <?php for ($i = 0; $i < $cantidad; $i++): ?>
                Nota #<?= ($i + 1) ?>:
                <input type="number" name="notas[]" min="0" max="20" step="0.01"
                    value="<?= isset($notas[$i]) ? htmlspecialchars($notas[$i]) : '' ?>" required><br>
            <?php endfor; ?>
            <br>
            <button type="submit" name="procesar">Procesar Notas</button>
            <button type="reset">Borrar</button>
        </form>
    <?php endif; ?>

    <!-- Mostrar resultados si hay -->
    <?= $resultado ?>
</body>
</html>
