<?php
// Arreglo de preguntas y opciones
$preguntas = [
    "¿Cuál es la capital de Francia?" => ["A" => "Madrid", "B" => "París", "C" => "Roma", "D" => "Berlín"],
    "¿Cuánto es 3 x 4?" => ["A" => "7", "B" => "10", "C" => "12", "D" => "14"],
    "¿Cuál es el océano más grande?" => ["A" => "Atlántico", "B" => "Índico", "C" => "Ártico", "D" => "Pacífico"],
    "¿Quién escribió 'Cien años de soledad'?" => ["A" => "Pablo Neruda", "B" => "Gabriel García Márquez", "C" => "Mario Vargas Llosa", "D" => "Jorge Luis Borges"],
    "¿Cuál es el planeta más cercano al sol?" => ["A" => "Marte", "B" => "Venus", "C" => "Mercurio", "D" => "Júpiter"]
];

// Respuestas correctas (clave por índice)
$respuestas_correctas = ["B", "C", "D", "B", "C"];

$resultado = "";
$errores = [];
$mostrar_resultado = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuestas_usuario = $_POST["respuestas"] ?? [];
    $correctas = 0;
    $incorrectas = 0;

    foreach ($respuestas_correctas as $indice => $correcta) {
        if (!isset($respuestas_usuario[$indice])) {
            $errores[] = "Debes responder la pregunta #" . ($indice + 1);
            continue;
        }
        if ($respuestas_usuario[$indice] === $correcta) {
            $correctas++;
        } else {
            $incorrectas++;
        }
    }

    if (empty($errores)) {
        $resultado = "
            <h3>Resultado:</h3>
            <ul>
                <li>Respuestas correctas: $correctas</li>
                <li>Respuestas incorrectas: $incorrectas</li>
            </ul>
        ";
        $mostrar_resultado = true;
    }
}
?>

Se simula una prueba de 5 preguntas. Para cada pregunta, se genera una lista desplegable ( <select>) con 4 opciones. El usuario selecciona una opción por pregunta. Al enviar, el sistema compara las respuestas con un arreglo de respuestas correctas y calcula:
• Total de respuestas correctas
• Total de respuestas incorrectas
<!DOCTYPE html>
<html>
<head>
    <title>Simulador de Prueba</title>
</head>
<body>
    <h2>Simulador de Prueba - 5 Preguntas</h2>

    <?php if (!empty($errores)): ?>
        <div style="color:red;">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!$mostrar_resultado): ?>
        <form method="post">
            <?php $i = 0; ?>
            <?php foreach ($preguntas as $pregunta => $opciones): ?>
                <p><strong><?= ($i + 1) ?>. <?= $pregunta ?></strong></p>
                <select name="respuestas[<?= $i ?>]" required>
                    <option value="">-- Selecciona una opción --</option>
                    <?php foreach ($opciones as $letra => $opcion): ?>
                        <option value="<?= $letra ?>"
                            <?= (isset($_POST["respuestas"][$i]) && $_POST["respuestas"][$i] === $letra) ? "selected" : "" ?>>
                            <?= "$letra) $opcion" ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br><br>
                <?php $i++; ?>
            <?php endforeach; ?>

            <button type="submit">Enviar Respuestas</button>
            <button type="reset">Borrar</button>
        </form>
    <?php endif; ?>

    <?= $resultado ?>
</body>
</html>
