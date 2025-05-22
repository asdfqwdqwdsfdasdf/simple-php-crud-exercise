<?php
$errores = [];
$resultados = [];
$cantidadProductos = 0;
$totalGeneral = 0;
$productosMas100 = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si viene la cantidad para generar campos
    if (isset($_POST["generar"])) {
        $cantidadProductos = (int)($_POST["cantidadProductos"] ?? 0);
        if ($cantidadProductos <= 0) {
            $errores[] = "Debe ingresar una cantidad válida mayor que 0.";
        }
    }

    // Si vienen los datos de productos para procesar
    if (isset($_POST["procesar"])) {
        $cantidadProductos = (int)($_POST["cantidadProductos"] ?? 0);

        $nombres = $_POST["nombre"] ?? [];
        $cantidades = $_POST["cantidad"] ?? [];
        $precios = $_POST["precio"] ?? [];

        for ($i = 0; $i < $cantidadProductos; $i++) {
            $nombre = trim($nombres[$i] ?? "");
            $cant = $cantidades[$i] ?? "";
            $precio = $precios[$i] ?? "";

            // Validaciones
            if ($nombre === "") {
                $errores[] = "El nombre del producto #" . ($i + 1) . " no puede estar vacío.";
            }

            if (!is_numeric($cant) || $cant <= 0) {
                $errores[] = "La cantidad del producto #" . ($i + 1) . " debe ser un número mayor que 0.";
            }

            if (!is_numeric($precio) || $precio <= 0) {
                $errores[] = "El precio unitario del producto #" . ($i + 1) . " debe ser un número mayor que 0.";
            }

            if (empty($errores)) {
                $cant = (float)$cant;
                $precio = (float)$precio;
                $totalProducto = $cant * $precio;
                $resultados[] = [
                    "nombre" => $nombre,
                    "cantidad" => $cant,
                    "precio" => $precio,
                    "total" => $totalProducto,
                ];

                $totalGeneral += $totalProducto;
                if ($totalProducto > 100) {
                    $productosMas100++;
                }
            }
        }
    }
}
?>

Enunciado:
El usuario indica cuántos productos va a comprar. Luego se generan dinámicamente los siguientes campos por cada producto:
• Nombre del producto
• Cantidad
• Precio unitario
El sistema debe:
• Validar que cantidad > 0 y precio > 0
• Calcular el total por producto
• Calcular el total general de la compra
Contar cuántos productos superan S/.100 en total
Usar bucle for, validaciones y mostrar una tabla con resultados por producto.
<!DOCTYPE html>
<html>
<head>
    <title>Compra de Productos</title>
</head>
<body>
    <h2>Compra de Productos</h2>

    <?php if (!empty($errores)): ?>
        <div style="color:red;">
            <ul>
                <?php foreach($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulario para ingresar cantidad de productos -->
    <?php if (empty($resultados) && !isset($_POST["procesar"])): ?>
        <form method="post">
            <label>Cantidad de productos a comprar:</label>
            <input type="number" name="cantidadProductos" min="1" required value="<?= htmlspecialchars($cantidadProductos) ?>">
            <button type="submit" name="generar">Generar Campos</button>
            <button type="reset">Borrar</button>
        </form>
    <?php endif; ?>

    <!-- Formulario para ingresar productos -->
    <?php if (isset($_POST["generar"]) || isset($_POST["procesar"])): ?>
        <form method="post">
            <input type="hidden" name="cantidadProductos" value="<?= htmlspecialchars($cantidadProductos) ?>">
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre del producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario (S/.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < $cantidadProductos; $i++): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td>
                            <input type="text" name="nombre[]" required
                            value="<?= isset($_POST["nombre"][$i]) ? htmlspecialchars($_POST["nombre"][$i]) : '' ?>">
                        </td>
                        <td>
                            <input type="number" name="cantidad[]" min="0.01" step="0.01" required
                            value="<?= isset($_POST["cantidad"][$i]) ? htmlspecialchars($_POST["cantidad"][$i]) : '' ?>">
                        </td>
                        <td>
                            <input type="number" name="precio[]" min="0.01" step="0.01" required
                            value="<?= isset($_POST["precio"][$i]) ? htmlspecialchars($_POST["precio"][$i]) : '' ?>">
                        </td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <br>
            <button type="submit" name="procesar">Calcular Totales</button>
            <button type="reset">Borrar</button>
        </form>
    <?php endif; ?>

    <!-- Mostrar resultados -->
    <?php if (!empty($resultados)): ?>
        <h3>Resultados:</h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario (S/.)</th>
                    <th>Total (S/.)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resultados as $idx => $prod): ?>
                <tr>
                    <td><?= $idx + 1 ?></td>
                    <td><?= htmlspecialchars($prod["nombre"]) ?></td>
                    <td><?= $prod["cantidad"] ?></td>
                    <td><?= number_format($prod["precio"], 2) ?></td>
                    <td><?= number_format($prod["total"], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p><strong>Total General de la compra: S/. <?= number_format($totalGeneral, 2) ?></strong></p>
        <p><strong>Cantidad de productos con total > S/. 100: <?= $productosMas100 ?></strong></p>
    <?php endif; ?>
</body>
</html>
