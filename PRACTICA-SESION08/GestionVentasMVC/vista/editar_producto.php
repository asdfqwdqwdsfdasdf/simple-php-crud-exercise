<?php
// Verificar si el producto fue encontrado
if (!isset($producto)) {
    echo "<p class='text-red-500'>Producto no encontrado.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="text-white text-2xl font-semibold">GestionVentas</a>
            </div>
            <div class="hidden md:flex space-x-4">
                <a href="bienvenida.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Inicio</a>
                <a href="productos.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Productos</a>
                <a href="clientes.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Clientes</a>
                <a href="pedidos.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Pedidos</a>
                <a href="../controlador/cerrarSesion.php" class="text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded-md">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <h1 class="text-3xl font-bold text-blue-600 mt-6">Editar Producto</h1>
    <p class="mt-4">Rellena los campos para editar el producto.</p>

    <!-- Formulario para editar el producto -->
    <form action="productoControlador.php?accion=editar" method="POST" class="mt-6 space-y-4">
        <input type="hidden" name="idproducto" value="<?php echo $producto['idproducto']; ?>">

        <!-- Nombre del producto -->
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Precio -->
        <div>
            <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Stock -->
        <div>
            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
            <input type="number" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Botón de Enviar -->
        <div class="mt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Actualizar Producto</button>
        </div>
    </form>

    <!-- Botón para volver a la lista de productos -->
    <div class="mt-4">
        <a href="productoControlador.php?accion=listar" class="w-full text-center bg-gray-500 text-white py-2 rounded-md hover:bg-gray-600">Volver a la lista de productos</a>
    </div>

</body>
</html>
