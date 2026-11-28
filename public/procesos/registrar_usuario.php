<?php

require_once __DIR__ . '/../../src/Controllers/UsuarioController.php';

try {
    $usuarioController = new UsuarioController();

    $resultado = $usuarioController->registrarUsuario();
} catch (PDOException $error) {
    error_log($error->getMessage());

    $resultado = 'error';
}

if ($resultado === true) {
    echo "Usuario registrado correctamente.";
} elseif ($resultado === 'datos_invalidos') {
    echo "Verifica que todos los campos estén completos y que las contraseñas coincidan.";
} elseif ($resultado === 'correo_invalido') {
    echo "Ingresa una dirección de correo electrónico válida";
} elseif ($resultado === 'contrasena_corta') {
    echo "La contraseña debe tener al menos 8 caracteres.";
} elseif ($resultado === 'duplicado') {
    echo "El documento o el correo ya están registrados.";
} elseif ($resultado === 'error') {
    echo "Ocurrió un error al registrar el usuario. Inténtalo nuevamente.";
} else {
    echo "No fue posible registrar el usuario.";
}
