<?php

require_once __DIR__ . '/../../src/Controllers/UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Método no permitido.');
}

$datos = [
    'id_usuario' => $_POST['id_usuario'] ?? '',
    'nombres' => trim($_POST['nombres'] ?? ''),
    'apellidos' => trim($_POST['apellidos'] ?? ''),
    'documento' => trim($_POST['documento'] ?? ''),
    'correo' => trim($_POST['correo'] ?? ''),
    'estado' => $_POST['estado'] ?? '',
    'centro' => $_POST['centro'] ?? '',
    'tipo_cuenta' => $_POST['tipo_cuenta'] ?? '',
    'id_rol' => $_POST['id_rol'] ?? ''
];

$contrasena = $_POST['contrasena'] ?? '';
$confirmarContrasena = $_POST['confirmar_contrasena'] ?? '';

if (
    $datos['id_usuario'] === '' ||
    $datos['nombres'] === '' ||
    $datos['apellidos'] === '' ||
    $datos['documento'] === '' ||
    $datos['correo'] === ''
) {
    exit('Completa todos los campos obligatorios.');
}

if (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
    exit('El correo electrónico no es válido.');
}

if (!in_array($datos['estado'], ['ACTIVO', 'INACTIVO'], true)) {
    exit('El estado seleccionado no es válido.');
}

if (!in_array($datos['centro'], ['CTGI', 'CTMA', 'CDHC'], true)) {
    exit('El centro seleccionado no es válido.');
}

if (!in_array($datos['tipo_cuenta'], ['PERMANENTE', 'TEMPORAL'], true)) {
    exit('El tipo de registro no es válido.');
}

if (!in_array($datos['id_rol'], ['1', '2', '3'], true)) {
    exit('El rol seleccionado no es válido.');
}

if ($contrasena !== '' || $confirmarContrasena !== '') {

    if ($contrasena !== $confirmarContrasena) {
        exit('Las contraseñas no coinciden.');
    }

    if (strlen($contrasena) < 8) {
        exit('La contraseña debe tener mínimo 8 caracteres.');
    }

    $datos['contrasena_hash'] = password_hash(
        $contrasena,
        PASSWORD_DEFAULT
    );
}

try {
    $usuarioController = new UsuarioController();

    $actualizado = $usuarioController->actualizarUsuario($datos);

    if ($actualizado) {
        header('Location: ../../views/admin/usuarios.php?actualizado=1');
        exit;
    }

    exit('No se pudo actualizar el usuario.');
} catch (PDOException $error) {
    exit('Ocurrió un error al actualizar el usuario.');
}
