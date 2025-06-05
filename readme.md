
# Actualizar puerto en xampp php mysql

🔧 1. config.inc.php
Cambio:

php
Copiar
Editar
$cfg['Servers'][$i]['port'] = '3307';
¿Por qué?
phpMyAdmin necesita saber en qué puerto está escuchando MySQL para poder conectarse correctamente.
Por defecto, se conecta al puerto 3306, pero si tu MySQL está configurado para usar 3307, debes indicarlo explícitamente aquí.

⚙️ 2. php.ini
Cambios:

ini
Copiar
Editar
mysqli.default_port=3307
mysqli.default_socket=3306  ; ⚠️ No debe ser cambiado a 3307
¿Por qué?

mysqli.default_port=3307: Asegura que todas las conexiones MySQLi desde PHP usen el puerto 3307, que es el que usa tu servidor MySQL.

mysqli.default_socket=3306: Este campo no representa un número de puerto, sino la ruta al archivo de socket UNIX (por ejemplo: /var/run/mysqld/mysqld.sock).
Poner 3307 aquí causaría errores, porque PHP intentaría conectar a un archivo llamado "3307", lo cual es incorrecto.

🛠️ 3. my.ini (configuración de MySQL Server)
Cambio:

ini
Copiar
Editar
[mysqld]
port=3307
¿Por qué?
Este archivo le dice al servidor MySQL en qué puerto debe escuchar conexiones.
Cambiarlo a 3307 es lo que origina que todos los clientes (phpMyAdmin, PHP, etc.) también deban saber que deben conectarse a ese puerto, no al predeterminado (3306).
 
🧩 Conclusión:
Estos tres cambios deben estar alineados entre sí para que todas las partes (MySQL, PHP y phpMyAdmin) trabajen correctamente en el mismo puerto (3307).
Si alguno queda mal configurado, obtendrás errores de conexión o acceso denegado.

¿Quieres que te genere una guía paso a paso con comandos para verificar que todo está funcionando?