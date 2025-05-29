CREATE DATABASE bdsesion08 
use bdsesion08

-- Tabla de usuario
CREATE TABLE usuario (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    clave VARCHAR(255) NOT NULL
);

-- Tabla de cliente
CREATE TABLE cliente (
    idcliente VARCHAR(8) PRIMARY KEY,
    apellidos VARCHAR(255) NOT NULL,
    nombres VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    email VARCHAR(100)
);

-- Tabla de producto
CREATE TABLE producto (
    idproducto VARCHAR(6) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
);

-- Tabla de pedido
CREATE TABLE pedido (
    idpedido VARCHAR(6) PRIMARY KEY,
    fecha DATE NOT NULL,
    idcliente VARCHAR(8),
    FOREIGN KEY (idcliente) REFERENCES cliente(idcliente)
);

-- Tabla de detalle_pedido
CREATE TABLE detalle_pedido (
    iddetalle INT AUTO_INCREMENT PRIMARY KEY,
    idpedido VARCHAR(6),
    idproducto VARCHAR(6),
    cantidad INT NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idpedido) REFERENCES pedido(idpedido),
    FOREIGN KEY (idproducto) REFERENCES producto(idproducto)
);





-- Insertar datos en la tabla usuario
INSERT INTO usuario (usuario, clave)
VALUES
('juanperez', 'clave123'),
('maria_lopez', 'clave456'),
('carlos_juan', 'clave789');

-- Insertar datos en la tabla cliente
INSERT INTO cliente (idcliente, apellidos, nombres, direccion, telefono, email)
VALUES
('C001', 'Pérez', 'Juan', 'Calle Ficticia 123', '123456789', 'juanperez@example.com'),
('C002', 'López', 'María', 'Avenida Siempre Viva 456', '987654321', 'maria.lopez@example.com'),
('C003', 'González', 'Carlos', 'Calle Real 789', '555123456', 'carlos.gonzalez@example.com');

-- Insertar datos en la tabla producto
INSERT INTO producto (idproducto, nombre, precio, stock)
VALUES
('P001', 'Laptop Dell', 1200.50, 10),
('P002', 'Smartphone Samsung', 800.00, 20),
('P003', 'Teclado Logitech', 45.99, 50);

-- Insertar datos en la tabla pedido
INSERT INTO pedido (idpedido, fecha, idcliente)
VALUES
('PD001', '2025-05-01', 'C001'),
('PD002', '2025-05-10', 'C002'),
('PD003', '2025-05-15', 'C003');

-- Insertar datos en la tabla detalle_pedido
INSERT INTO detalle_pedido (idpedido, idproducto, cantidad, subtotal)
VALUES
('PD001', 'P001', 1, 1200.50),
('PD001', 'P003', 2, 91.98),
('PD002', 'P002', 1, 800.00),
('PD003', 'P003', 3, 137.97);