<?php
require_once '../modelo/PersonaDAO.php';
$dao = new PersonaDAO();
$dao->eliminar($_GET['id']);
header("Location: ../vista/personas.php");
?>