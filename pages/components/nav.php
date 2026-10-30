<!-- Navegación compartida en todos los archivos del administrador, mediante el archivo "nav.js" -->

<!-- NOMBRE Y LOGO -->

<div>
    <img src="#" alt="Logotipo SENA">
    <h1>Smart Access</h1>
</div>

<div>
    <nav>
        <ul>
            <li>
                <a href="dashboard.php">Dashboard</a>
            </li>

            <li>
                <a href="historial_ingresos.php">Historial de ingresos</a>
            </li>

            <li>
                <a href="usuarios.php">Usuarios</a>
            </li>

            <li>
                <a href="computadores.php">Computadores</a>
            </li>

            <li>
                <a href="vehiculos.php">Vehículos</a>
            </li>

            <!-- MENÚ DESPLEGABLE PARA LOS REGISTROS -->

            <li>
                <details open>
                    <summary>Registrar</summary>
                    <ul>
                        <li><a href="reg_usuario.php">Usuario</a>
                        </li>
                        <li><a href="reg_vigilante.php">Vigilante</a>
                        </li>
                        <li><a href="reg_computador.php">Computador</a></li>
                        <li><a href="reg_vehiculo.php">Vehículo</a></li>
                    </ul>
                </details>
            </li>

            <li>
                <a href="auditoria.php">Auditoría</a>
            </li>

            <hr>

            <li>
                <a href="perfil.php">Mi perfil</a>
            </li>

            <li>
                <a href="../login/index.php">Cerrar Sesion</a>
            </li>
        </ul>
    </nav>
</div>