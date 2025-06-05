 Examen Parcial 2 – Ingeniería Web
ESCUELA PROFESIONAL:
INGENIERIA DE SISTEMAS Semestre: 2025 - 1
Experiencia Curricular: Ingeniería Web Ciclo/Sección: VI – B1T1
Apellidos y Nombres: Docente: Marcelino Torres Villanueva
Fecha: 05/06/2025
🏥 CASO: Clínica “Vida Sana”
La clínica Vida Sana necesita desarrollar un sistema web que le permita gestionar a sus pacientes,
médicos, citas, historial médico y la administración de sus usuarios (recepcionistas). El sitio debe estar
desarrollado utilizando HTML, CSS, Bootstrap, JavaScript, PHP, sesiones, cookies y base de datos
MySQL, bajo el patrón de diseño Modelo-Vista-Controlador (MVC).


📌FUNCIONALIDADES OBLIGATORIAS
1. Registro e inicio de sesión de recepcionistas (usuarios del sistema) con control de acceso y uso
de sesiones.
2. Registro de pacientes y mantenimiento (CRUD).
3. Registro de médicos con su especialidad.
4. Registro de especialidades.
5. Programación de citas médicas para pacientes, con selección de médico, fecha y hora.
6. Validación para evitar doble programación del mismo médico.
7. Registro del historial clínico de cada cita atendida.   [✅]
8. Expiración de sesión tras 5 minutos de inactividad.
9. Mostrar saludo personalizado con cookies.
10. Interfaz moderna y responsive con Bootstrap.
11. Validaciones de formularios con JavaScript.


⚖️REGLAS DEL NEGOCIO
Estas reglas deben guiar el diseño de la lógica del sistema:
1. Un paciente puede tener muchas citas médicas.   [✅]
2. Una cita solo puede ser asignada a un médico.   [✅]
3. Un médico pertenece a una única especialidad.   [✅]
4. Una especialidad puede tener varios médicos.   [✅]
5. Una cita debe estar asociada a un paciente y a un médico.   [✅]
6. Una vez atendida la cita, se debe generar el historial clínico correspondiente.   [✅] ('pendiente', 'atendida', 'cancelada')
7. No puede registrarse una cita en el mismo día y hora para un médico que ya tiene una cita
asignada.   [✅] UNIQUE KEY unico_cita_medico_fecha_hora (medico_id, fecha, hora)
8. El sistema es administrado por recepcionistas, quienes deben iniciar sesión para poder realizar
todas las operaciones.   [✅]
9. Se debe mostrar un mensaje de bienvenida personalizado al usuario que inicia sesión utilizando
cookies.
10. Si el usuario está inactivo por más de 5 minutos, la sesión debe cerrarse automáticamente.
 


🧱ENTIDADES DEL SISTEMA (relaciones a deducir por el estudiante)
A continuación, se listan las entidades con sus atributos. Los estudiantes deben determinar las relaciones
entre ellas y representarlas en el modelo entidad-relación.
usuarios
• idusuario
• usuario
• clave
• rol (ej. "recepcionista")
pacientes
• idpaciente
• dni
• nombres
• apellidos
• direccion
• telefono
• email
medicos
• idmedico
• nombres
• apellidos
• especialidad_id
• telefono
• email
especialidades
• idespecialidad
• nombre
citas
• idcita
• paciente_id
• medico_id
• fecha
• hora
• estado (pendiente, atendida, cancelada)
historiales
• idhistorial
• cita_id
• diagnostico
• tratamiento
• observaciones
 Examen Parcial 2 – Ingeniería Web
📊RÚBRICA DE EVALUACIÓN (20 PUNTOS)
Criterio Puntaje
Implementación correcta del patrón Modelo-Vista-Controlador 3 pts
Funcionalidad completa de login, sesiones, cookies y cierre automático 2 pts
Módulo CRUD de pacientes, médicos y especialidades 3 pts
Registro y gestión de citas con validación de conflictos 3 pts
Registro y edición del historial clínico asociado a la cita 2 pts
Interfaz moderna con Bootstrap y validaciones en JavaScript 3 pts
Documentación del proyecto (base de datos, manual básico de uso, demo) 2 pts
Funcionamiento general correcto, sin errores, navegación clara 2 pts
TOTAL 20 pts