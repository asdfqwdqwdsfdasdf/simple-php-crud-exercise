<?php
// Inicia la sesión o continúa la sesión actual.
session_start();
// Si no existe $_SESSION['usuario'], redirige a login.php
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
    <title>Bienvenido</title>
    <!-- Vincular Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <!-- Logo o Nombre de la Empresa -->
                <a href="#" class="text-white text-2xl font-semibold">GestionVentas</a>
            </div>
            <!-- Barra de navegación -->
            <div class="hidden md:flex space-x-4">
                <a href="#" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Inicio</a>
                <a href="productos.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Productos</a>
                <a href="clientes.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Clientes</a>
                <a href="pedidos.php" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Pedidos</a>
                <!-- Mostrar el nombre del usuario -->
                <span class="text-white px-4 py-2">Hola, <?php echo $_SESSION['usuario']; ?>!</span>
                <a href="../controlador/cerrarSesion.php" class="text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded-md">Cerrar sesión</a>
            </div>

            <!-- Menu desplegable en móvil -->
            <div class="md:hidden">
                <button id="navbar-toggler" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Menú desplegable -->
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="bg-blue-600 p-4">
            <a href="#" class="block text-white hover:bg-blue-700 px-4 py-2 rounded-md">Inicio</a>
            <a href="productos.php" class="block text-white hover:bg-blue-700 px-4 py-2 rounded-md">Productos</a>
            <a href="clientes.php" class="block text-white hover:bg-blue-700 px-4 py-2 rounded-md">Clientes</a>
            <a href="pedidos.php" class="block text-white hover:bg-blue-700 px-4 py-2 rounded-md">Pedidos</a>
            <a href="../controlador/cerrarSesion.php" class="block text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded-md">Cerrar sesión</a>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="p-6">
        <h1 class="text-4xl font-bold text-center text-blue-600">¡Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h1>
        <p class="mt-4 text-center text-gray-600">Navega por las opciones en el menú para gestionar ventas, productos, clientes y pedidos.</p>
    </div>

    <!-- Script para el toggle del menú en móvil -->
    <script>
        const toggler = document.getElementById('navbar-toggler');
        const menu = document.getElementById('mobile-menu');

        toggler.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
