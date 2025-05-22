<?php
$errores = [];
$numeros = [];
$cantidadNumeros = 0;
$mostrarFormularioNumeros = false;
$pares = 0;
$impares = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["generar"])) {
        $cantidadNumeros = (int)($_POST["cantidadNumeros"] ?? 0);
        if ($cantidadNumeros <= 0) {
            $errores[] = "Debe ingresar una cantidad válida mayor que 0.";
        } else {
            $mostrarFormularioNumeros = true;
        }
    }

    if (isset($_POST["evaluar"])) {
        $cantidadNumeros = (int)($_POST["cantidadNumeros"] ?? 0);
        $numeros = $_POST["numero"] ?? [];
        
        // Validar que cada número sea numérico
        foreach ($numeros as $index => $num) {
            if (!is_numeric($num)) {
                $errores[] = "El valor #" . ($index + 1) . " no es un número válido.";
            }
        }

        if (empty($errores)) {
            $pares = 0;
            $impares = 0;
            foreach ($numeros as $num) {
                if (((int)$num) % 2 === 0) {
                    $pares++;
                } else {
                    $impares++;
                }
            }
        } else {
            $mostrarFormularioNumeros = true;
        }
    }
}
?>

Ejercicio 2: Determinar cuántos números son pares e impares
Enunciado:
Cree un formulario donde el usuario:
1. Ingrese la cantidad de números que desea evaluar.
2. Ingrese los valores de los números.
3. Al enviar, el programa debe:
· Mostrar todos los números ingresados.
·
Indicar cuántos son pares y cuántos impares.
Sugerencia: Usar mod para evaluar paridad.
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Conteo de números pares e impares</title>
</head>
<body>
    <h2>Determinar cantidad de números pares e impares</h2>

    <?php if ($errores): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Paso 1: pedir cantidad de números -->
    <?php if (!$mostrarFormularioNumeros && !isset($_POST["evaluar"])): ?>
        <form method="post">
            <label>Cantidad de números a evaluar:</label>
            <input type="number" name="cantidadNumeros" min="1" required value="<?= htmlspecialchars($cantidadNumeros) ?>" />
            <button type="submit" name="generar">Generar campos</button>
        </form>
    <?php endif; ?>

    <!-- Paso 2: formulario para ingresar números -->
    <?php if ($mostrarFormularioNumeros): ?>
        <form method="post">
            <input type="hidden" name="cantidadNumeros" value="<?= htmlspecialchars($cantidadNumeros) ?>" />
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Número</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < $cantidadNumeros; $i++): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <input type="number" name="numero[]" required
                                    value="<?= isset($numeros[$i]) ? htmlspecialchars($numeros[$i]) : '' ?>" />
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <br />
            <button type="submit" name="evaluar">Evaluar números</button>
        </form>
    <?php endif; ?>

    <!-- Mostrar resultados -->
    <?php if (isset($_POST["evaluar"]) && empty($errores)): ?>
        <h3>Resultados</h3>
        <p><strong>Números ingresados:</strong> <?= implode(", ", array_map('htmlspecialchars', $numeros)) ?></p>
        <p><strong>Cantidad de números pares:</strong> <?= $pares ?></p>
        <p><strong>Cantidad de números impares:</strong> <?= $impares ?></p>
        <p><a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Realizar otra evaluación</a></p>
    <?php endif; ?>
</body>
</html>
