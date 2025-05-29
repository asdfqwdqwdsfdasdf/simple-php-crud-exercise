<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Incluir las clases necesarias
require_once __DIR__ . '/../modelo/Producto.php';
require_once __DIR__ . '/../modelo/ProductoDAO.php';

// Crear una instancia del DAO para manejar los productos
$productoDAO = new ProductoDAO();

// Acción a ejecutar
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';

switch ($accion) {
    case 'listar':
        // Listar todos los productos
        $productos = $productoDAO->listar();
        require_once __DIR__ . '/../vista/productos.php'; // Mostrar vista con productos
        break;

    case 'agregar':
        // Agregar un nuevo producto
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar los datos del formulario
            $idproducto = $_POST['idproducto'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];

            // Crear un nuevo objeto Producto
            $producto = new Producto($idproducto, $nombre, $precio, $stock);

            // Insertar el producto en la base de datos
            if ($productoDAO->insertar($producto)) {
                header("Location: productoControlador.php?accion=listar"); // Redirigir a la lista de productos
                exit();
            } else {
                echo "Error al agregar el producto.";
            }
        }
        require_once __DIR__ . '/../vista/agregar_producto.php'; // Mostrar vista para agregar producto
        break;

    case 'editar':
        // Editar un producto existente
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar los datos del formulario
            $idproducto = $_POST['idproducto'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];

            // Crear un nuevo objeto Producto
            $producto = new Producto($idproducto, $nombre, $precio, $stock);

            // Actualizar el producto en la base de datos
            if ($productoDAO->actualizar($producto)) {
                header("Location: productoControlador.php?accion=listar"); // Redirigir a la lista de productos
                exit();
            } else {
                echo "Error al actualizar el producto.";
            }
        } else {
            // Obtener el producto para editarlo
            $idproducto = $_GET['idproducto'];
            $producto = $productoDAO->buscar($idproducto);
            require_once __DIR__ . '/../vista/editar_producto.php'; // Mostrar vista para editar producto
        }
        break;

    case 'eliminar':
        // Eliminar un producto
        if (isset($_GET['idproducto'])) {
            $idproducto = $_GET['idproducto'];
            if ($productoDAO->eliminar($idproducto)) {
                header("Location: productoControlador.php?accion=listar"); // Redirigir a la lista de productos
                exit();
            } else {
                echo "Error al eliminar el producto.";
            }
        }
        break;

    default:
        // Acción por defecto (listar)
        $productos = $productoDAO->listar();
        require_once __DIR__ . '/../vista/productos.php'; // Mostrar vista con productos
        break;
}
?>
