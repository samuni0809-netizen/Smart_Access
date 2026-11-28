
CREATE DATABASE IF NOT EXISTS Smart_Access;

USE Smart_Access;

-- roles disponibles en el sistema
CREATE TABLE rol (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- roles iniciales
INSERT IGNORE INTO rol (tipo) VALUES
    ('USUARIO'),
    ('VIGILANTE'),
    ('ADMINISTRADOR');

-- cuentas permanentes de usuarios, vigilantes y administradores
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    documento VARCHAR(20) NOT NULL UNIQUE,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contrasena_hash VARCHAR(255) NOT NULL,
    centro VARCHAR(100) NULL,
    tipo_cuenta ENUM('PERMANENTE, TEMPORAL') NOT NULL DEFAULT 'PERMANENTE',
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('ACTIVO', 'INACTIVO') NOT NULL DEFAULT 'ACTIVO',
    id_rol INT NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
) ENGINE=InnoDB;

-- datos complementarios del personal de vigilancia
CREATE TABLE vigilante (
    id_vigilante INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL UNIQUE,
    telefono VARCHAR(20) NULL,
    turno VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
) ENGINE=InnoDB;

-- personas registradas para un acceso temporal
CREATE TABLE usuario_temporal (
    id_temporal INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    documento VARCHAR(20) NOT NULL UNIQUE,
    tipo_cuenta ENUM('TEMPORAL') NOT NULL DEFAULT 'TEMPORAL',
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_vigilante INT NOT NULL,
    FOREIGN KEY (id_vigilante) REFERENCES vigilante(id_vigilante)
) ENGINE=InnoDB;

-- codigos qr o numericos asignados a usuarios permanentes o temporales
CREATE TABLE codigo_qr (
    id_codigo INT AUTO_INCREMENT PRIMARY KEY,
    codigo_qr VARCHAR(255) NOT NULL UNIQUE,
    codigo_numero VARCHAR(100) NULL UNIQUE,
    estado ENUM('ACTIVO', 'INACTIVO') NOT NULL DEFAULT 'ACTIVO',
    id_usuario INT NULL UNIQUE,
    id_temporal INT NULL UNIQUE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_temporal) REFERENCES usuario_temporal(id_temporal)
) ENGINE=InnoDB;

-- computadores asociados a usuarios permanentes o temporales
CREATE TABLE dispositivo (
    id_dispositivo INT AUTO_INCREMENT PRIMARY KEY,
    codigo_dispositivo VARCHAR(50) NOT NULL UNIQUE,
    id_usuario INT NULL,
    id_temporal INT NULL,
    marca VARCHAR(80) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    serial VARCHAR(100) NOT NULL UNIQUE,
    detalles TEXT NULL,
    tipo_registro ENUM('TEMPORAL', 'PERMANENTE') NOT NULL DEFAULT 'PERMANENTE',
    estado ENUM('ACTIVO', 'INACTIVO') NOT NULL DEFAULT 'ACTIVO',
    permanencia ENUM('DENTRO', 'FUERA') NOT NULL DEFAULT 'FUERA',
    fotografia VARCHAR(255) NULL,
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_temporal) REFERENCES usuario_temporal(id_temporal)
) ENGINE=InnoDB;

-- vehiculos asociados a usuarios permanentes o temporales
CREATE TABLE vehiculo (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NULL,
    id_temporal INT NULL,
    placa VARCHAR(10) NOT NULL UNIQUE,
    tipo VARCHAR(50) NOT NULL,
    marca VARCHAR(80) NULL,
    modelo VARCHAR(100) NULL,
    fotografia VARCHAR(255) NULL,
    observaciones TEXT NULL,
    estado ENUM('ACTIVO', 'INACTIVO') NOT NULL DEFAULT 'ACTIVO',
    tipo_registro ENUM('TEMPORAL', 'PERMANENTE') NOT NULL DEFAULT 'PERMANENTE',
    permanencia ENUM('DENTRO', 'FUERA') NOT NULL DEFAULT 'FUERA',
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_temporal) REFERENCES usuario_temporal(id_temporal)
) ENGINE=InnoDB;

-- movimientos de ingreso y salida
-- los elementos seleccionados y pendientes se guardan en campos json
CREATE TABLE registro_acceso (
    id_registro INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NULL,
    id_temporal INT NULL,
    id_vigilante INT NOT NULL,
    tipo_movimiento ENUM('ENTRADA', 'SALIDA') NOT NULL,
    fecha_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_registro_ingreso INT NULL,
    elementos_seleccionados JSON NULL,
    elementos_pendientes JSON NULL,
    estado_elementos ENUM('COMPLETO', 'PENDIENTE') NOT NULL DEFAULT 'COMPLETO',
    observaciones TEXT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_temporal) REFERENCES usuario_temporal(id_temporal),
    FOREIGN KEY (id_vigilante) REFERENCES vigilante(id_vigilante),
    FOREIGN KEY (id_registro_ingreso) REFERENCES registro_acceso(id_registro)
) ENGINE=InnoDB;

-- auditoria de las acciones realizadas por los usuarios
CREATE TABLE auditoria (
    id_auditoria INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario_actor INT NOT NULL,
    nombre_actor VARCHAR(200) NOT NULL,
    documento_actor VARCHAR(20) NOT NULL,
    rol_actor VARCHAR(50) NOT NULL,
    accion VARCHAR(100) NOT NULL,
    tabla_afectada VARCHAR(100) NOT NULL,
    id_registro_afectado VARCHAR(100) NULL,
    descripcion TEXT NOT NULL,
    datos_anteriores JSON NULL,
    datos_nuevos JSON NULL,
    fecha_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario_actor) REFERENCES usuario(id_usuario)
) ENGINE=InnoDB;