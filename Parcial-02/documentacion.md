Claro, aquí tienes la documentación mejorada, formal y adaptada al contexto del examen y requisitos del caso clínico “Vida Sana”:

---

# Proyecto: Sistema Web para Clínica "Vida Sana"

**Examen Parcial 2 – Ingeniería Web**
**Escuela Profesional:** Ingeniería de Sistemas
**Semestre:** 2025 - 1
**Experiencia Curricular:** Ingeniería Web Ciclo VI – B1T1
**Docente:** Marcelino Torres Villanueva
**Fecha:** 05/06/2025

---

## Descripción General

El sistema web desarrollado para la Clínica **Vida Sana** tiene como objetivo la gestión integral de recepcionistas, pacientes, médicos, especialidades, citas médicas e historiales clínicos. El proyecto está implementado con tecnologías web modernas bajo el patrón de diseño **Modelo-Vista-Controlador (MVC)**, garantizando una estructura modular, escalable y mantenible.

La aplicación cubre funcionalidades esenciales para la clínica, tales como registro e inicio de sesión de usuarios (recepcionistas), programación y gestión de citas con validación para evitar conflictos de horario, registro de historiales clínicos y expiración automática de sesiones tras 5 minutos de inactividad. Además, se utiliza **Bootstrap** para una interfaz responsive y moderna, y validaciones de formulario con JavaScript para mejorar la experiencia de usuario.

---

## Tecnologías Utilizadas

* **Lenguajes:** PHP 8.x, HTML5, CSS3, JavaScript
* **Base de Datos:** MySQL/MariaDB
* **Framework UI:** Bootstrap 5
* **Acceso a datos:** PDO para conexiones seguras y parametrizadas
* **Servidor Local:** XAMPP, WAMP, o similar

---

## Entidades y Base de Datos

### Entidades Principales

| Entidad            | Atributos principales                                           | Descripción breve                                             |
| ------------------ | --------------------------------------------------------------- | ------------------------------------------------------------- |
| **usuarios**       | idusuario, usuario, clave, rol                                  | Recepcionistas que administran el sistema (control de acceso) |
| **pacientes**      | idpaciente, dni, nombres, apellidos, dirección, teléfono, email | Pacientes registrados en la clínica                           |
| **medicos**        | idmedico, nombres, apellidos, especialidad\_id, teléfono, email | Médicos asignados a especialidades                            |
| **especialidades** | idespecialidad, nombre                                          | Especialidades médicas                                        |
| **citas**          | idcita, paciente\_id, medico\_id, fecha, hora, estado           | Citas médicas programadas                                     |
| **historiales**    | idhistorial, cita\_id, diagnóstico, tratamiento, observaciones  | Historial clínico asociado a cita atendida                    |

### Reglas del negocio reflejadas en la base de datos

* Un paciente puede tener muchas citas; cada cita está vinculada a un único médico y paciente.
* Un médico solo tiene una especialidad, y una especialidad puede tener varios médicos.
* No se permite la programación de citas duplicadas para un mismo médico en fecha y hora iguales.
* Solo se puede generar un historial clínico cuando la cita está marcada como atendida.
* Las sesiones de usuario expiran tras 5 minutos de inactividad para seguridad.

---

### Script Simplificado para Creación de Base de Datos

```sql
CREATE DATABASE IF NOT EXISTS clinica;
USE clinica;

CREATE TABLE usuarios (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL,
    rol VARCHAR(20) DEFAULT 'recepcionista'
);

CREATE TABLE especialidades (
    idespecialidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE medicos (
    idmedico INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    especialidad_id INT NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    FOREIGN KEY (especialidad_id) REFERENCES especialidades(idespecialidad)
);

CREATE TABLE pacientes (
    idpaciente INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(15) NOT NULL UNIQUE,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    direccion VARCHAR(200),
    telefono VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE citas (
    idcita INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    medico_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado ENUM('pendiente', 'atendida', 'cancelada') NOT NULL DEFAULT 'pendiente',
    FOREIGN KEY (paciente_id) REFERENCES pacientes(idpaciente),
    FOREIGN KEY (medico_id) REFERENCES medicos(idmedico),
    UNIQUE KEY unico_cita_medico_fecha_hora (medico_id, fecha, hora)
);

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
```

---

## Instalación y Configuración

1. Clonar el repositorio en el directorio raíz del servidor local (ej. `htdocs` en XAMPP).
2. Importar la base de datos ejecutando el script SQL provisto.
3. Configurar los parámetros de conexión a la base de datos en `conexion/Conexion.php` (host, usuario, clave, nombre de BD).
4. Abrir en navegador la URL apuntando a la carpeta `vista`, por ejemplo:
   `http://localhost/clinica/vista/login.php`
5. Registrar un usuario recepcionista o utilizar el ya creado para iniciar sesión.

---

## Manual Básico de Uso

* **Inicio de sesión:** Acceder con usuario y contraseña. La sesión expira tras 5 minutos de inactividad para seguridad.
* **Gestión de usuarios:** Registrar y administrar recepcionistas para controlar el acceso al sistema.
* **Pacientes:** Crear, leer, actualizar y eliminar registros de pacientes.
* **Especialidades:** Mantener las especialidades médicas disponibles.
* **Médicos:** Registrar médicos asociados a una especialidad.
* **Citas:** Programar citas seleccionando paciente, médico, fecha y hora, validando para evitar doble agenda.
* **Historiales clínicos:** Crear y actualizar registros de diagnóstico, tratamiento y observaciones solo para citas atendidas.
* **Saludo personalizado:** Al iniciar sesión, se muestra un mensaje de bienvenida personalizado usando cookies.
* **Interfaz:** Responsive y moderna, optimizada para distintos dispositivos mediante Bootstrap.
* **Validaciones:** Formularios con JavaScript para evitar errores comunes antes de enviar datos al servidor.

---

## Demo Visual (Ejemplos de pantallas)

* **Pantalla de Login**
  ![Login](./docs/login.png)

* **Listado de Médicos**
  ![Medicos](./docs/medicos.png)

* **Agenda de Citas**
  ![Citas](./docs/citas.png)

---

## Consideraciones y Buenas Prácticas

* **Seguridad:** Contraseñas almacenadas con hash (bcrypt).
* **Validación:** Se realiza tanto en frontend (JavaScript) como backend (PHP).
* **Sesiones:** Implementación de expiración automática por inactividad para proteger acceso.
* **Integridad:** Uso de claves foráneas y triggers para mantener consistencia en datos.
* **UX/UI:** Interfaz clara, moderna y amigable para usuarios no técnicos.
* **MVC:** Código organizado bajo Modelo-Vista-Controlador para facilitar mantenimiento y escalabilidad.

---

## Contacto

Para dudas, sugerencias o mejoras, contactar con el desarrollador:
**Email:** [tu-email@dominio.com](mailto:tu-email@dominio.com)

---

## Agradecimientos

Proyecto desarrollado como parte del Examen Parcial 2 de la asignatura Ingeniería Web, ciclo 2025-1.
 