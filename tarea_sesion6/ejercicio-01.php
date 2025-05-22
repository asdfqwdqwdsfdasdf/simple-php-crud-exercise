<?php
// Inicializar variables
$errores = [];
$resultado = "";
//inicializado en false, cuando la condicion de metodo de request es igual a post, entonces se acutaliza a true
$mostrarFormularioNotas = false;
$notas = [];
$cantidad = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 01: verificar que se hayan asignado los valores necesarios en la post request
    // Si el usuario quiere generar los campos
    // "generar" : viene del atributo "name" en el formulario  
    // "cantidad" : viene del atributo "name" del formulario
    // las 2 anteriores son accedidas mediante $_POST y es comprobado su asignacion mediante la funcion isset()
    if (isset($_POST["generar"])) {
        // condicion ternaria : si se asigno una cantidad, utilizar este, de lo contrario castear mediante (int) 0
        $cantidad = isset($_POST["cantidad"]) ? (int)$_POST["cantidad"] : 0;
        //verificar que no se asignen valores menores a 0
        if ($cantidad <= 0) {
            $errores[] = "Debe ingresar una cantidad válida mayor que 0.";
        } else {
            // actualizar el valor a verdadero para mostrar el formulario
            $mostrarFormularioNotas = true;
        }
    }


    // Si el usuario envía las notas (en el metodo post se encuentra el atributo "procesar" que viene del formulario)
    if (isset($_POST["procesar"])) {
        // variables de utilidad
        $cantidad = isset($_POST["cantidad"]) ? (int)$_POST["cantidad"] : 0;
        $notas = isset($_POST["notas"]) ? $_POST["notas"] : [];
        $validadas = [];
        $suma = 0;
        $aprobadas = 0;
        $desaprobadas = 0;
        $max = -1;
        $min = 21;

        // Validar cada nota : bucle for que itera la variable $cantidad en un paso de 1
        for ($i = 0; $i < $cantidad; $i++) {
            // condicion ternaria que evalua que el campo en la posicion que se encuentre este asignado y si no realiza un llamado a la funcion trim() con el valor ""
            $nota = isset($notas[$i]) ? trim($notas[$i]) : "";

            // mostrar que la nota en la posicion i + 1 esta vacia mediante un mensaje
            if ($nota === "") {
                $errores[] = "La nota #" . ($i + 1) . " está vacía.";
                continue;
            }
            // mostrar que la nota no se encuentra en el rango especificado mediante un mensaje
            if (!is_numeric($nota) || $nota < 0 || $nota > 20) {
                $errores[] = "La nota #" . ($i + 1) . " debe ser un número entre 0 y 20.";
                continue;
            }
            // obtener el valor de tipo float de la variable $nota y reasignar o actualizar dicho valor en $nota
            $nota = floatval($nota);
            // array $validadas[] que almacenara $nota en su formato de float
            $validadas[] = $nota;
            // variable $suma que sera $suma = $suma + $nota (actual) : servira para calcular el promedio y se actualizara con cada iteracion del for
            $suma += $nota;
            // condicional que evalua que $nota sea mayor o igual a 11 y en caso de cumplirse aumentar el contador (variable $aprobadas)
            if ($nota >= 11) {
                $aprobadas++;
            } else {
                //en caso contrario, aumentar $desaprobadas
                $desaprobadas++;
            }
            // condicional one line que actualiza la variable $max y $min evaluando que sea mayor a menor a dichas va riables respectivamente
            if ($nota > $max) $max = $nota;
            if ($nota < $min) $min = $nota;
        }

        // mediante la funcion empty() se verifica que la variable $errores no tenga ningun valor para continuar
        if (empty($errores)) {
            // calculo del promedio, se renderizara con 2 decimales
            $promedio = $suma / count($validadas);
            // renderizado utilizando $resultado
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
            // si empty($errores) contiene valores
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

<!--    prueba mediante curl
    curl -X POST  http://localhost:4430/practica_php/simple-php-crud-exercise/tarea_sesion6/ejercicio-01.php -d "cantidad=2" -d "generar" -d "notas[]=13" -d "notas[]=4" -d "procesar"
-->
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
        <!-- campo de entrada -->
        <button type="submit" name="generar">Generar Campos</button>
        <!-- convierte el button en 0 -->
        <button type="reset">Borrar</button>
    </form>

    <!-- Formulario para ingresar notas -->
    <!-- lo siguiente se renderiza unicamente si la variable $mostrarFormularioNotas tiene el valor true -->
    <?php if ($mostrarFormularioNotas): ?>
        <form method="post">
            <input type="hidden" name="cantidad" value="<?= htmlspecialchars($cantidad) ?>">
            <h3>Ingrese las notas (0 - 20):</h3>
            <!-- bucle for php, itera utilizando la variable $cantidad con paso en 1 -->
            <?php for ($i = 0; $i < $cantidad; $i++): ?>
                <!-- Concatena la cadena Nota# con el valor de la variable de iteracion sumandole 1 para que no inicie en cero -->
                Nota #<?= ($i + 1) ?>:
                <!-- campo de entrada creado con cada iteracion, minimo 0 y maximo 20, de tipo numerico,  -->
                <input type="number" name="notas[]" min="0" max="20" step="0.01"
                    value="<?= isset($notas[$i]) ? htmlspecialchars($notas[$i]) : '' ?>" required>  <br>
            <?php endfor; ?>
            <br>

            <!-- boton para realizar el llamado a la funcion -->
            <button type="submit" name="procesar">Procesar Notas</button>
            <!-- reinicia los valores del campo de entrada submit a 0 cada uno -->
            <button type="reset">Borrar</button>
        </form>
    <?php endif; ?>

    <!-- Mostrar resultados si hay -->
    <!-- esta variable contiene html con extrapolacion de las variables consultadas (promedio, nota mas alta, baja, cantidad de notas aprobadas y desaprobadas-->
    <?= $resultado ?>
</body>
</html>
