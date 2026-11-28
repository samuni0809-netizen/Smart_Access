<?php

require_once __DIR__ . '/../../src/Controllers/UsuarioController.php';

$usuarioController = new UsuarioController();

$usuarios = $usuarioController->obtenerUsuarios();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Usuario | Panel Administrativo - SENA</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- css compartido -->
    <link rel="stylesheet" href="../../public/assets/css/nav.css">

    <!-- estilos reutilizados del dashboard -->
    <link rel="stylesheet" href="../../public/assets/css/dashboard.css">

    <!-- estilos exclusivos del historial -->
    <link rel="stylesheet" href="../../public/assets/css/tablas.css">

</head>

<body>

    <!-- estructura general de la aplicación -->
    <div class="estructura-administrativa d-flex min-vh-100">

        <!-- navegación lateral compartida -->
        <aside id="navegacion-header" class="contenedor-navegacion sticky-top vh-100">
        </aside>

        <!-- fondo oscuro para celulares -->
        <div id="fondo-menu" class="fondo-menu"></div>


        <!-- contenido derecho -->
        <div class="contenido-aplicacion flex-grow-1">

            <!-- encabezado superior -->
            <header class="encabezado-pagina d-flex align-items-center px-3 px-md-4 py-3">

                <!-- botón del menú para celulares -->
                <button id="boton-menu"
                    class="boton-menu d-flex align-items-center justify-content-center d-md-none me-3" type="button">

                    <i class="bi bi-list"></i>

                </button>

                <!-- información de la página -->
                <div class="informacion-pagina">

                    <h1 id="titulo-registros-usuarios" class="mb-1">Usuarios</h1>

                    <p class="mb-0">Panel Administrativo</p>

                </div>

            </header>


            <!-- contenido principal -->
            <main class="contenido-dashboard container-fluid px-3 px-md-4 py-4">

                <!-- panel general -->
                <section class="panel-registros bg-white border rounded-4 p-3 p-md-4">


                    <!-- encabezado y filtros -->
                    <div class="encabezado-registros d-flex flex-column gap-3">


                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

                            <!-- filtros de movimiento -->
                            <div class="filtros-registros d-flex flex-wrap gap-2">

                                <div>
                                    <select class="form-select">
                                        <option value="" selected>Todos</option>
                                        <option value="">Usuario</option>
                                        <option value="">Vigilante</option>
                                        <option value="">Administrador</option>
                                    </select>
                                </div>
                                <div>
                                    <select class="form-select">
                                        <option value="">Activos</option>
                                        <option value="">Inactivos</option>
                                    </select>
                                </div>
                                <div>
                                    <select class="form-select">
                                        <option value="" select>Permanentes</option>
                                        <option value="">Temporales</option>
                                    </select>
                                </div>
                                <div>
                                    <select class="form-select">
                                        <option value="" selected>CTGI</option>
                                        <option value="">-</option>
                                        <option value="">-</option>
                                    </select>
                                </div>

                            </div>

                            <!-- acciones del historial -->
                            <div class="acciones-registros d-flex flex-wrap gap-2">

                                <button id="btn-filtrar-fecha" class="btn btn-outline-secondary filtrar-fecha"
                                    type="button">

                                    <i class="bi bi-calendar3 me-2"></i>

                                    Filtrar por fecha

                                </button>

                                <button id="btn-generar-reporte" class="btn btn-success" type="button">

                                    <i class="bi bi-file-earmark-arrow-down"></i>

                                    Generar reporte

                                </button>

                            </div>

                        </div>

                    </div>

                    <!-- formulario de búsqueda -->
                    <div
                        class="busqueda-registros d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-3">

                        <form id="formulario-busqueda" class="flex-grow-1" action="#" method="GET">

                            <div class="input-group pt-3">

                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>

                                <input id="busqueda" class="form-control campo-busqueda" name="busqueda" type="search"
                                    placeholder="Buscar por usuario, documento, vigilante o centro">

                            </div>

                        </form>

                        <!-- cantidad de resultados -->
                        <div>

                            <p id="total-resultados" class="cantidad-resultados mb-0">
                                Cargando usuarios
                            </p>

                        </div>

                    </div>


                    <!-- tabla del historial -->
                    <div class="contenedor-tabla-registros table-responsive">

                        <table class="tabla-registros table table-hover align-middle mb-0">

                            <thead class="table-light text-center">

                                <tr>

                                    <th class="text-nowrap" scope="col">Nombres</th>

                                    <th class="text-nowrap" scope="col">Apellidos</th>

                                    <th class="text-nowrap" scope="col">Número de documento</th>

                                    <!-- columna replicada para mostrar el computador asociado -->
                                    <th class="text-nowrap" scope="col">Computador</th>

                                    <!-- columna replicada para mostrar el vehículo asociado -->
                                    <th class="text-nowrap" scope="col">Vehículo</th>

                                    <th class="text-nowrap" scope="col">Estado</th>

                                    <th class="text-nowrap" scope="col">Tipo de registro</th>

                                    <th class="text-nowrap" scope="col">Fecha de registro</th>

                                    <th class="text-nowrap" scope="col">Acción</th>

                                </tr>

                            </thead>


                            <tbody id="tabla-usuarios" class="text-center">

                                <?php if (empty($usuarios)): ?>

                                    <tr>
                                        <td colspan="9" class="text-center">
                                            No hay usuarios registrados
                                        </td>
                                    </tr>

                                <?php else: ?>

                                    <?php foreach ($usuarios as $usuario):

                                        $nombres = $usuario['nombres'] ?? '-';
                                        $apellidos = $usuario['apellidos'] ?? '-';

                                        $iniciales = mb_strtoupper(
                                            mb_substr($nombres, 0, 1, 'UTF-8') .
                                                mb_substr($apellidos, 0, 1, 'UTF-8'),
                                            'UTF-8'
                                        );

                                        $documento = $usuario['documento'] ?? '-';
                                        $estado = $usuario['estado'] ?? '-';
                                        $tipoCuenta = $usuario['tipo_cuenta'] ?? '-';
                                        $fechaRegistro = $usuario['fecha_registro'] ?? '-';
                                    ?>

                                        <tr>
                                            <!-- nombres -->
                                            <td>
                                                <div class="datos-usuario d-flex align-items-center gap-2">

                                                    <div class="iniciales-usuario rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                                                        <?= htmlspecialchars($iniciales, ENT_QUOTES, 'UTF-8') ?>
                                                    </div>

                                                    <div>
                                                        <span>
                                                            <?= htmlspecialchars($nombres, ENT_QUOTES, 'UTF-8') ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Apellidos -->
                                            <td>
                                                <?= htmlspecialchars($apellidos, ENT_QUOTES, 'UTF-8') ?>
                                            </td>

                                            <!-- Documento -->
                                            <td>
                                                <?= htmlspecialchars($documento, ENT_QUOTES, 'UTF-8') ?>
                                            </td>

                                            <!-- Computador -->
                                            <td>
                                                —
                                            </td>

                                            <!-- Vehículo -->
                                            <td>
                                                —
                                            </td>

                                            <!-- Estado -->
                                            <td class="text-center">
                                                <span class="movimiento badge rounded-pill ingreso">
                                                    <?= htmlspecialchars($estado, ENT_QUOTES, 'UTF-8') ?>
                                                </span>
                                            </td>

                                            <!-- Tipo de registro -->
                                            <td>
                                                <span class="estado-elementos badge rounded-pill completo">
                                                    <?= htmlspecialchars($tipoCuenta, ENT_QUOTES, 'UTF-8') ?>
                                                </span>
                                            </td>

                                            <!-- Fecha de registro -->
                                            <td>
                                                <?= htmlspecialchars((string) $fechaRegistro, ENT_QUOTES, 'UTF-8') ?>
                                            </td>

                                            <!-- Acciones -->
                                            <td class="text-center">

                                                <div class="d-flex justify-content-center gap-2">

                                                    <!-- botón ver -->
                                                    <button class="boton-ver-registro btn btn-outline-secondary"
                                                        type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-detalle-usuario">

                                                        <i class="bi bi-eye"></i>

                                                    </button>

                                                    <!-- botón editar -->
                                                    <button class="boton-editar-registro btn btn-outline-secondary"
                                                        type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-editar-usuario"

                                                        data-id="
                                                        <?= htmlspecialchars((string) $usuario['id_usuario'], ENT_QUOTES, 'UTF-8') ?>"
                                                        data-nombres="<?= htmlspecialchars($usuario['nombres'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                        data-apellidos="<?= htmlspecialchars($usuario['apellidos'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                        data-documento="<?= htmlspecialchars($usuario['documento'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                        data-correo="<?= htmlspecialchars($usuario['correo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                        data-estado="<?= htmlspecialchars($usuario['estado'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                        data-centro="<?= htmlspecialchars($usuario['centro'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                        data-tipo-cuenta="<?= htmlspecialchars($usuario['tipo_cuenta'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                        data-id-rol="<?= htmlspecialchars((string) ($usuario['id_rol'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">

                                                        <i class="bi bi-pencil"></i>

                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>

                        </table>

                    </div>


                    <div id="modal-detalle-usuario" class="modal fade" tabindex="-1">

                        <div class="modal-dialog modal-dialog-centered modal-lg">

                            <div class="modal-content modal-detalle-contenido">

                                <!-- encabezado -->
                                <div class="modal-header modal-detalle-encabezado">

                                    <h2 id="titulo-detalle-usuario" class="modal-title fs-5">
                                        Detalle de Usuario
                                    </h2>

                                    <button class="btn-close" type="button" data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <!-- cuerpo -->
                                <div class="modal-body modal-detalle-cuerpo">

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <p class="fw-bold mb-1">Nombre completo</p>
                                            <p>Cristian Camilo Duque Orozco</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="fw-bold mb-1">Número de documento</p>
                                            <p>1065544332</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="fw-bold mb-1">Correo electrónico</p>
                                            <p>samuel@gmail.com</p>
                                        </div>

                                        <!-- dato replicado para mostrar el rol del usuario -->
                                        <div class="col-md-6">
                                            <p class="fw-bold mb-1">Rol</p>
                                            <p>Usuario</p>
                                        </div>

                                        <!-- dato replicado para mostrar el teléfono de vigilantes -->
                                        <div class="col-md-6">
                                            <p class="fw-bold mb-1">Teléfono (para vigilantes)</p>
                                            <p>No aplica</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="fw-bold mb-1">Estado</p>
                                            <p>Activo</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="fw-bold mb-1">Centro</p>
                                            <p>CTGI</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="fw-bold mb-1">Tipo de registro</p>
                                            <p>Permanente</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="fw-bold mb-1">Fecha de registro</p>
                                            <p>11/11/2026 - 19:56</p>
                                        </div>

                                    </div>


                                    <!-- dispositivos registrados -->
                                    <div class="detalle-dispositivos">

                                        <h3 class="titulo-dispositivos">
                                            Dispositivos registrados (1)
                                        </h3>

                                        <!-- dispositivo 1 -->
                                        <div class="detalle-dispositivo">

                                            <div class="detalle-dispositivo-fila">
                                                <span>Equipo</span>
                                                <strong>Lenovo ThinkPad E14</strong>
                                            </div>

                                            <div class="detalle-dispositivo-fila">
                                                <span>Serial</span>
                                                <strong>LNV-2024-0001</strong>
                                            </div>

                                            <div class="detalle-dispositivo-fila">
                                                <span>Tipo de registro</span>
                                                <strong>Permanente</strong>
                                            </div>

                                            <div class="detalle-dispositivo-fila">
                                                <span>Ubicación actual</span>
                                                <strong>En instalaciones</strong>
                                            </div>

                                            <div class="detalle-dispositivo-fila">
                                                <span>Estado</span>
                                                <strong>Activo</strong>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- dispositivos registrados -->
                                    <div class="detalle-dispositivos">

                                        <h3 class="titulo-dispositivos">
                                            Vehículos registrados (0)
                                        </h3>
                                    </div>


                                </div>

                                <!-- pie -->
                                <div class="modal-footer modal-detalle-pie">

                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                        Cerrar
                                    </button>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="modal-editar-usuario" class="modal fade" tabindex="-1">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content modal-editar-contenido">

                                <!-- encabezado -->
                                <div class="modal-header modal-editar-encabezado">

                                    <h2 id="titulo-editar-usuario" class="modal-title fs-5">
                                        Editar Usuario
                                    </h2>

                                    <button class="btn-close" type="button" data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <!-- cuerpo -->
                                <div class="modal-body modal-editar-cuerpo">

                                    <form id="formulario-editar-usuario" method="POST" action="../../public/procesos/actualizar_usuario.php">

                                        <input type="hidden" id="editar-id-usuario" name="id_usuario">

                                        <div class="row g-3">

                                            <div class="col-12">
                                                <label class="form-label" for="editar-nombre">
                                                    Nombre completo
                                                </label>
                                                <input id="editar-nombre" class="form-control" type="text"
                                                    name="nombres">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label" for="editar-apellido">
                                                    Apellido
                                                </label>
                                                <input id="editar-apellido" class="form-control" type="text"
                                                    name="apellidos">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="editar-documento">
                                                    Número de documento
                                                </label>
                                                <input id="editar-documento" class="form-control" type="text"
                                                    name="documento">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label" for="editar-correo">
                                                    Correo electrónico
                                                </label>
                                                <input id="editar-correo" class="form-control" type="email" name="correo">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="editar-estado">
                                                    Estado
                                                </label>
                                                <select id="editar-estado" class="form-select" name="estado">
                                                    <option value="ACTIVO">ACTIVO</option>
                                                    <option value="INACTIVO">INACTIVO</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="editar-centro">
                                                    Centro
                                                </label>
                                                <select id="editar-centro" class="form-select" name="centro">
                                                    <option value="" disabled selected>Selecciona una opción</option>
                                                    <option value="CTGI">CTGI</option>
                                                    <option value="CTMA">CTMA</option>
                                                    <option value="CDHC">CDHC</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="editar-tipo">
                                                    Tipo de registro
                                                </label>
                                                <select id="editar-tipo" class="form-select" name="tipo_cuenta">
                                                    <option value="PERMANENTE">Permanente</option>
                                                    <option value="TEMPORAL">Temporal</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="editar-rol">
                                                    Rol
                                                </label>
                                                <select id="editar-rol" class="form-select" name="id_rol">
                                                    <option value="1">Usuario</option>
                                                    <option value="2">Vigilante</option>
                                                    <option value="3">Administrador</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="editar-contrasena">
                                                    Contraseña
                                                </label>
                                                <input id="editar-contrasena"
                                                    class="form-control"
                                                    type="password"
                                                    placeholder="Nueva contraseña"
                                                    minlength="8"
                                                    autocomplete="new-password"
                                                    name="contrasena">
                                            </div>

                                            <!-- campo replicado del registro permanente para confirmar la contraseña -->
                                            <div class="col-12 col-md-6">
                                                <label class="form-label" for="editar-confirmar-contrasena">
                                                    Confirmar contraseña
                                                </label>
                                                <input id="editar-confirmar-contrasena"
                                                    class="form-control"
                                                    type="password"
                                                    placeholder="Confirmar contraseña"
                                                    minlength="8"
                                                    autocomplete="new-password"
                                                    name="confirmar_contrasena">
                                            </div>

                                        </div>
                                    </form>

                                </div>

                                <!-- pie -->
                                <div class="modal-footer modal-editar-pie">

                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <button class="btn btn-success" type="submit" form="formulario-editar-usuario">
                                        Guardar cambios
                                    </button>

                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <!-- pie de página -->
            <footer class="pie-dashboard bg-white">

                <p>Sistema de Control de Acceso - SENA</p>

            </footer>
        </div>
    </div>

    <!-- archivos javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../../public/assets/js/nav.js"></script>
    <script src="../../public/assets/js/barra.js"></script>
    <script src="../../public/assets/js/usuarios.js"></script>

</body>

</html>