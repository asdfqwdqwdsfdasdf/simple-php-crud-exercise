 
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

- **Lenguajes:** PHP 8.x, HTML5, CSS3, JavaScript
    
- **Base de Datos:** MySQL/MariaDB
    
- **Framework UI:** Bootstrap 5
    
- **Acceso a datos:** PDO para conexiones seguras y parametrizadas
    
- **Servidor Local:** XAMPP, WAMP, o similar
    

---

## Entidades y Base de Datos

|Entidad|Atributos principales|Descripción breve|
|---|---|---|
|**usuarios**|idusuario, usuario, clave, rol|Recepcionistas que administran el sistema (control de acceso)|
|**pacientes**|idpaciente, dni, nombres, apellidos, dirección, teléfono, email|Pacientes registrados en la clínica|
|**medicos**|idmedico, nombres, apellidos, especialidad_id, teléfono, email|Médicos asignados a especialidades|
|**especialidades**|idespecialidad, nombre|Especialidades médicas|
|**citas**|idcita, paciente_id, medico_id, fecha, hora, estado|Citas médicas programadas|
|**historiales**|idhistorial, cita_id, diagnóstico, tratamiento, observaciones|Historial clínico asociado a cita atendida|

### Reglas del negocio reflejadas en la base de datos

- Un paciente puede tener muchas citas; cada cita está vinculada a un único médico y paciente.
    
- Un médico solo tiene una especialidad, y una especialidad puede tener varios médicos.
    
- No se permite la programación de citas duplicadas para un mismo médico en fecha y hora iguales.
    
- Solo se puede generar un historial clínico cuando la cita está marcada como atendida.
    
- Las sesiones de usuario expiran tras 5 minutos de inactividad para seguridad.
    

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

### Diagrama de la base de datos

![[basededatosnormalizada.png]]  

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

- **Inicio de sesión:** Acceder con usuario y contraseña. La sesión expira tras 5 minutos de inactividad para seguridad.
    
- **Gestión de usuarios:** Registrar y administrar recepcionistas para controlar el acceso al sistema.
    
- **Pacientes:** Crear, leer, actualizar y eliminar registros de pacientes.
    
- **Especialidades:** Mantener las especialidades médicas disponibles.
    
- **Médicos:** Registrar médicos asociados a una especialidad.
    
- **Citas:** Programar citas seleccionando paciente, médico, fecha y hora, validando para evitar doble agenda.
    
- **Historiales clínicos:** Crear y actualizar registros de diagnóstico, tratamiento y observaciones solo para citas atendidas.
    
- **Saludo personalizado:** Al iniciar sesión, se muestra un mensaje de bienvenida personalizado usando cookies.
    
- **Interfaz:** Responsive y moderna, optimizada para distintos dispositivos mediante Bootstrap.
    
- **Validaciones:** Formularios con JavaScript para evitar errores comunes antes de enviar datos al servidor.
    

---

## Demo Visual (Ejemplos de pantallas y validaciones)

### Login y Autenticación

![[login.png]]  
_Pantalla de inicio de sesión con campos para usuario y contraseña._

![[login-validacion.png]]  
_Validación de campos en el formulario de inicio de sesión._

![[login-autenticacion.png]]  
_Mensaje de autenticación al iniciar sesión correctamente o con error._

### Gestión de Especialidades

![[especialidades.png]]  
_Listado de especialidades médicas disponibles en el sistema._

![[especialidadactualizada.png]]  
_Mensaje que confirma la actualización exitosa de una especialidad._

![[editarespecialidad.png]]  
_Formulario para editar los datos de una especialidad._

![[manejo de error especialidades No se puede eliminar la especialidad porque está asignada a uno o más médicos. .png]]  
_Mensaje de error al intentar eliminar una especialidad que está asignada a médicos._

### Gestión de Médicos

![[medicos.png]]  
_Listado de médicos registrados en el sistema._

![[agregarmedicos.png]]  
_Formulario para agregar un nuevo médico._

![[agregarmedicos-validacion-campos.png]]  
_Validación de campos al agregar un médico._

![[medico-editar.png]]  
_Pantalla para editar los datos de un médico existente._

![[elminar-medico-nosepuedeeliminarmedicoconcitasasignadas.png]]  
_Error al intentar eliminar un médico con citas asignadas._

![[eliminar-medico-sincitasasignadassepuede.png]]  
_Confirmación para eliminar un médico sin citas asignadas._

### Gestión de Pacientes

![[pacientes.png]]  
_Listado de pacientes registrados._

![[pacientes-ingresar-validacion.png]]  
_Validación de campos para agregar un paciente._

![[pacientes-editar.png]]  
_Formulario para editar un paciente._

![[pacientes-eliminar-mensaje-nosepuedeeliminarpacienteconcitasasignadas.png]]  
_Mensaje que indica que no se puede eliminar un paciente con citas asignadas._

![[pacientes-eliminar-mensaje-sisepuedeeliminarpacientesincitasasignadas.png]]  
_Mensaje que permite eliminar un paciente sin citas asignadas._

![[pacientes-eliminar.png]]  
_Confirmación para eliminar un paciente._

![[pacientes-resultado-editar.png]]  
_Resultado de la edición exitosa de un paciente._

### Gestión de Citas

![[citas.png]]  
_Listado y gestión de citas médicas programadas._

![[agregar cita.png]]  
_Formulario para agregar una nueva cita._

![[agregar cita validacion campos.png]]  
_Validación de campos en el formulario de agregar cita._

![[agregar citas.png]]  
_Vista general de varias citas agregadas._

![[cita insertada.png]]  
_Mensaje de confirmación de cita insertada exitosamente._

![[manejo de error Ya existe una cita para el médico seleccionado en la fecha y hora indicadas. .png]]  
_Mensaje de error cuando se intenta agendar una cita duplicada para un médico._