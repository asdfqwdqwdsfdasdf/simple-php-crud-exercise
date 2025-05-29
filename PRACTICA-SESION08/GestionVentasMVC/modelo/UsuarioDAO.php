<?php
// Llamada de archivos necesarios
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Usuario.php';

class UsuarioDAO {

    // CREATE: Insertar un nuevo usuario
    public function insertar($u) {
        $sql = "INSERT INTO usuario (idusuario, usuario, clave) VALUES (?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $u->idusuario, $u->usuario, password_hash($u->clave, PASSWORD_DEFAULT)
        ]);
    }

    // READ: Listar todos los usuarios
    public function listar() {
        $sql = "SELECT * FROM usuario";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ con filtro: Buscar un usuario por su ID
    public function buscar($idusuario) {
        $sql = "SELECT * FROM usuario WHERE idusuario = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // READ con filtro: Buscar un usuario por su nombre de usuario (usuario/email)
    public function buscarPorUsuario($usuario) {
        $sql = "SELECT * FROM usuario WHERE usuario = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los datos de un usuario
    public function actualizar($u) {
        $sql = "UPDATE usuario SET usuario = ?, clave = ? WHERE idusuario = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $u->usuario, password_hash($u->clave, PASSWORD_DEFAULT), $u->idusuario
        ]);
    }

    // DELETE: Eliminar un usuario por su ID
    public function eliminar($idusuario) {
        $sql = "DELETE FROM usuario WHERE idusuario = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$idusuario]);
    }

    // Validar la contraseña de un usuario al momento de iniciar sesión
    public function validarClave($usuario, $clave) {
        $sql = "SELECT * FROM usuario WHERE usuario = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$usuario]);
        $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioEncontrado) {
            // Verificar si la contraseña coincide con el hash almacenado
            if (password_verify($clave, $usuarioEncontrado['clave'])) {
                return true;
            }
        }
        return false; // Si no se encuentra el usuario o la contraseña no es correcta
    }
}
?>
