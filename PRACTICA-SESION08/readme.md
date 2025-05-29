Sistema de Gestión de Ventas para una Empresa Comercial
Descripción:
Construir una aplicación web en PHP con acceso a MySQL que permita a un usuario
(previo login) gestionar clientes, productos, y pedidos. La aplicación debe seguir el
patrón Modelo-Vista-Controlador (MVC) y utilizar DAO para la persistencia.
Tablas Relacionadas:
1. usuario
o idusuario (INT, PK, AI)
o usuario (VARCHAR)
o clave (VARCHAR)
2. cliente
o idcliente (VARCHAR(8), PK)
o apellidos (VARCHAR)
o nombres (VARCHAR)
o direccion (VARCHAR)
o telefono (VARCHAR)
o email (VARCHAR)
3. producto
o idproducto (VARCHAR(6), PK)
o nombre (VARCHAR)
o precio (DECIMAL)
o stock (INT)
4. pedido
o idpedido (VARCHAR(6), PK)
o fecha (DATE)
o idcliente (FK → cliente.idcliente)
5. detalle_pedido
o iddetalle (INT, PK, AI)
o idpedido (FK → pedido.idpedido)
o idproducto (FK → producto.idproducto)
o cantidad (INT)
o subtotal (DECIMAL)


Requisitos del Sistema
• Login y logout con sesiones.
• Solo usuarios autenticados pueden gestionar pedidos.
• CRUD completo de:
o Clientes
o Productos
o Pedidos (con múltiples productos por pedido)
• Visualización de pedidos por cliente.
• Validaciones de formularios.
• Evitar que se vendan productos sin stock suficiente.
Estructura Sugerida del Proyecto
markdown
CopiarEditar
GestionVentasMVC/
├── conexion/
│ └── Conexion.php
├── modelo/
│ ├── Usuario.php / UsuarioDAO.php
│ ├── Cliente.php / ClienteDAO.php
│ ├── Producto.php / ProductoDAO.php
│ ├── Pedido.php / PedidoDAO.php
│ └── DetallePedido.php / DetallePedidoDAO.php
├── controlador/
│ ├── loginControlador.php
│ ├── clienteControlador.php
│ ├── productoControlador.php
│ ├── pedidoControlador.php
│ └── cerrarSesion.php
└── vista/
├── login.php
├── registro.php
├── clientes.php
├── productos.php
├── pedidos.php
├── nuevo_pedido.php
└── bienvenida.php
Reglas del Negocio
• Un cliente puede tener muchos pedidos.
• Un pedido pertenece a un cliente.
• Un pedido puede tener muchos productos.
• Un producto puede estar en muchos pedidos.
• La suma de subtotales del detalle debe dar el total del pedido.
• Validar stock al registrar un pedido