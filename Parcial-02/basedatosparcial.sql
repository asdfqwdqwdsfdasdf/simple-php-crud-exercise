CREATE DATABASE IF NOT EXISTS clinica;
USE clinica;

-- Tabla usuarios (regla 8)
CREATE TABLE usuarios (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,  -- Nombre usuario para saludo (regla 9)
    clave VARCHAR(255) NOT NULL 
);

-- Tabla especialidades (reglas 3 y 4)
CREATE TABLE especialidades (
    idespecialidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
);

-- Tabla medicos (reglas 3 y 4)
CREATE TABLE medicos (
    idmedico INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    especialidad_id INT NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    FOREIGN KEY (especialidad_id) REFERENCES especialidades(idespecialidad)
);

-- Tabla pacientes (regla 1)
CREATE TABLE pacientes (
    idpaciente INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(15) NOT NULL UNIQUE,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    direccion VARCHAR(200),
    telefono VARCHAR(20),
    email VARCHAR(100)
);

-- Tabla citas (reglas 1, 2, 5, 7)
CREATE TABLE citas (
    idcita INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    medico_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado ENUM('pendiente', 'atendida', 'cancelada') NOT NULL DEFAULT 'pendiente',
    FOREIGN KEY (paciente_id) REFERENCES pacientes(idpaciente),
    FOREIGN KEY (medico_id) REFERENCES medicos(idmedico),
    -- Índice único para evitar citas duplicadas para un médico en la misma fecha y hora (regla 7)
    UNIQUE KEY unico_cita_medico_fecha_hora (medico_id, fecha, hora)
);

-- Tabla historiales (regla 6)
CREATE TABLE historiales (
    idhistorial INT AUTO_INCREMENT PRIMARY KEY,
    cita_id INT NOT NULL UNIQUE,
    diagnostico TEXT,
    tratamiento TEXT,
    observaciones TEXT,
    FOREIGN KEY (cita_id) REFERENCES citas(idcita)
);

 
DELIMITER //

CREATE TRIGGER trg_before_insert_historial
BEFORE INSERT ON historiales
FOR EACH ROW
BEGIN
    DECLARE estado_cita VARCHAR(20);

    SELECT estado INTO estado_cita FROM citas WHERE idcita = NEW.cita_id;

    IF estado_cita <> 'atendida' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se puede generar historial si la cita no está atendida';
    END IF;
END;
//

DELIMITER ;

 
