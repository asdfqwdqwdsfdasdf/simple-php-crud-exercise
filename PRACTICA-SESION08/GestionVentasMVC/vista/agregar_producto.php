<?php
// Asegúrate de que la sesión esté iniciada
session_start();

// Redirigir al login si no hay sesión activa
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
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
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-blue-600">Agregar Nuevo Producto</h1>

        <!-- Formulario para agregar producto -->
        <form action="../controlador/productoControlador.php?accion=agregar" method="POST" class="mt-6">
            <div class="mb-4">
                <label for="idproducto" class="block text-sm font-medium text-gray-700">ID Producto</label>
                <input type="text" id="idproducto" name="idproducto" class="mt-2 p-3 w-full border border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="mt-2 p-3 w-full border border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                <input type="number" id="precio" name="precio" step="0.01" class="mt-2 p-3 w-full border border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" id="stock" name="stock" class="mt-2 p-3 w-full border border-gray-300 rounded-md" required>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-6 py-2 rounded-md">Guardar Producto</button>
                <a href="productos.php" class="text-blue-600 hover:text-blue-800 px-6 py-2 border border-blue-600 rounded-md">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        // Función para el menú móvil
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>

</body>
</html>
