<?php
require_once '../modelo/ProductoDAO.php';
$dao = new ProductoDAO();
$productos = $dao->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // JavaScript para el menú móvil
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100 p-6">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <!-- Logo o Nombre de la Empresa -->
                <a href="#" class="text-white text-2xl font-semibold">GestionVentas</a>
            </div>
            <!-- Barra de navegación -->
            <div class="hidden md:flex space-x-4">
                <a href="bienvenida.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Inicio</a>
                <a href="productos.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Productos</a>
                <a href="clientes.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Clientes</a>
                <a href="pedidos.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Pedidos</a>
                <a href="../controlador/cerrarSesion.php" class="text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded-md">Cerrar sesión</a>
            </div>

            <!-- Icono del menú móvil -->
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Menú móvil desplegable -->
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="bg-blue-600 p-4">
            <a href="bienvenida.php" class="block text-white hover:bg-blue-700 px-4 py-2 rounded-md">Inicio</a>
            <a href="productos.php" class="block text-white hover:bg-blue-700 px-4 py-2 rounded-md">Productos</a>
            <a href="clientes.php" class="block text-white hover:bg-blue-700 px-4 py-2 rounded-md">Clientes</a>
            <a href="pedidos.php" class="block text-white hover:bg-blue-700 px-4 py-2 rounded-md">Pedidos</a>
            <a href="../controlador/cerrarSesion.php" class="block text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded-md">Cerrar sesión</a>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-blue-600">Lista de Productos</h1>
        <a href="../vista/agregar_producto.php" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md mt-4 inline-block">Agregar Producto</a>

        <!-- Verificar si hay productos -->
        <?php if (!empty($productos)): ?>
            <table class="min-w-full mt-6 table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">ID Producto</th>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Precio</th>
                        <th class="px-4 py-2 border">Stock</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td class="px-4 py-2 border"><?php echo $producto['idproducto']; ?></td>
                            <td class="px-4 py-2 border"><?php echo $producto['nombre']; ?></td>
                            <td class="px-4 py-2 border"><?php echo $producto['precio']; ?></td>
                            <td class="px-4 py-2 border"><?php echo $producto['stock']; ?></td>
                            <td class="px-4 py-2 border">
                                <a href="../controlador/productoControlador.php?accion=editar&idproducto=<?php echo $producto['idproducto']; ?>" class="text-yellow-500 hover:text-yellow-700">Editar</a>
                                |
                                <a href="../controlador/productoControlador.php?accion=eliminar&idproducto=<?php echo $producto['idproducto']; ?>" class="text-red-500 hover:text-red-700">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-red-500 mt-4">No hay productos disponibles.</p>
        <?php endif; ?>
    </div>
</body>
</html>
