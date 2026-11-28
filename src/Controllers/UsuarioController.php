<?php

require_once __DIR__ . '/../Repositories/UsuarioRepository.php';

class UsuarioController
{
    private $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new UsuarioRepository();
    }

    public function validarFormulario()
    {
        /* validar que la informacion se envie por METHOD POST */

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return false;
        }

        /* ?? significa que si el dato exite y no es null lo usara, de lo contrario utilizara el valor de la derecha o sea ''. y trim elimina espacios vacios*/

        $nombres = trim($_POST['nombres'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $documento = trim($_POST['documento'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $centro = trim($_POST['centro'] ?? '');

        $contrasena = $_POST['contrasena'] ?? '';
        $confirmarContrasena = $_POST['confirmar-contrasena'] ?? '';

        if (
            $nombres === '' ||
            $apellidos === '' ||
            $documento === '' ||
            $correo === '' ||
            $centro === '' ||
            $contrasena === '' ||
            $confirmarContrasena === ''
        ) {
            return false;
        }

        if ($contrasena !== $confirmarContrasena) {
            return false;
        }

        /* arreglo asociativo, cada dato tiene un dato y valor */
        return [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'documento' => $documento,
            'correo' => $correo,
            'centro' => $centro,
            'contrasena' => $contrasena
        ];
    }

    public function registrarUsuario()
    {
        $datos = $this->validarFormulario();

        if ($datos === false) {
            return 'datos_invalidos';
        }

        if (filter_var($datos['correo'], FILTER_VALIDATE_EMAIL) === false) {
            return 'correo_invalido';
        }

        $idRol = $this->usuarioRepository->obtenerIdRolUsuario();

        /* Validar longitud de la contraseña */
        if (strlen($datos['contrasena']) < 8) {
            return 'contrasena_corta';
        }

        /* Crear hash de la contraseña */
        $contrasenaHash = password_hash(
            $datos['contrasena'],
            PASSWORD_DEFAULT
        );

        if ($this->usuarioRepository->existeDocumentoOCorreo(
            $datos['documento'],
            $datos['correo']
        )) {
            return 'duplicado';
        }

        return $this->usuarioRepository->registrar(
            $datos['nombres'],
            $datos['apellidos'],
            $datos['documento'],
            $datos['correo'],
            $datos['centro'],
            $contrasenaHash,
            $idRol
        );
    }

    public function obtenerUsuarios()
    {
        return $this->usuarioRepository->obtenerTodos();
    }

    public function actualizarUsuario(array $datos): bool
    {
        return $this->usuarioRepository->actualizar($datos);
    }
}