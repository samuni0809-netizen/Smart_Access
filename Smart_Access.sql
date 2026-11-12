DROP DATABASE IF EXISTS Smart;
CREATE DATABASE Smart;
USE Smart;

-- Roles
CREATE TABLE rol (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL UNIQUE
);

-- QR
CREATE TABLE codigo_qr (
    id_codigo INT AUTO_INCREMENT PRIMARY KEY,
    codigo_qr VARCHAR(255) NOT NULL UNIQUE,
    codigo_numero VARCHAR(100) NULL UNIQUE,
    estado ENUM('ACTIVO', 'INACTIVO')
        NOT NULL DEFAULT 'ACTIVO'
);

-- Usuarios
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    documento VARCHAR(20) NOT NULL UNIQUE,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contrasena_hash VARCHAR(255) NOT NULL,
    centro VARCHAR(100) NULL,
    tipo_cuenta ENUM('PERMANENTE', 'TEMPORAL')
        NOT NULL DEFAULT 'PERMANENTE',
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('ACTIVO', 'INACTIVO')
        NOT NULL DEFAULT 'ACTIVO',
    id_rol INT NOT NULL DEFAULT 1,
    id_codigo INT NULL DEFAULT 1,
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol),
	FOREIGN KEY (id_codigo) REFERENCES codigo_qr(id_codigo)
);

-- Porteros
CREATE TABLE portero (
    id_portero INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL UNIQUE,
    telefono VARCHAR(20) NULL,
	FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

-- Usuarios temporales
CREATE TABLE usuario_temporal (
    id_temporal INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    documento VARCHAR(20) NOT NULL UNIQUE,
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_portero INT NOT NULL,
    FOREIGN KEY (id_portero) REFERENCES portero(id_portero)
);

-- Accesos
CREATE TABLE registro_acceso (
    id_registro INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NULL,
    id_temporal INT NULL,
    id_portero INT NOT NULL,
    tipo_movimiento ENUM('ENTRADA', 'SALIDA') NOT NULL,
    fecha_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    observaciones TEXT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_temporal) REFERENCES usuario_temporal(id_temporal),
    FOREIGN KEY (id_portero) REFERENCES portero(id_portero)
);

-- Dispositivos
CREATE TABLE dispositivo (
    id_dispositivo INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    marca VARCHAR(80) NOT NULL,
    modelo VARCHAR(100) NULL,
    tipo_dispositivo VARCHAR(50) NOT NULL,
    serial VARCHAR(100) NOT NULL UNIQUE,
    detalles TEXT NULL,
    tipo_registro ENUM('TEMPORAL', 'PERMANENTE')
        NOT NULL DEFAULT 'PERMANENTE',
    estado ENUM('ACTIVO', 'INACTIVO')
        NOT NULL DEFAULT 'ACTIVO',
    permanencia ENUM('DENTRO', 'FUERA')
        NOT NULL DEFAULT 'FUERA',
    fotografia VARCHAR(255) NULL,
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

-- Vehículos
CREATE TABLE vehiculo (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    placa VARCHAR(10) NOT NULL UNIQUE,
    tipo VARCHAR(50) NOT NULL,
    marca VARCHAR(80) NULL,
    modelo VARCHAR(100) NULL,
    fotografia VARCHAR(255) NULL,
    observaciones TEXT NULL,
    tipo_registro ENUM('TEMPORAL', 'PERMANENTE')
        NOT NULL DEFAULT 'PERMANENTE',
    permanencia ENUM('DENTRO', 'FUERA')
        NOT NULL DEFAULT 'FUERA',
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

-- Auditoría
CREATE TABLE auditoria (
    id_auditoria INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario_actor INT NULL,
    accion VARCHAR(100) NOT NULL,
    tabla_afectada VARCHAR(100) NOT NULL,
    id_registro_afectado VARCHAR(100) NULL,
    descripcion TEXT NOT NULL,
    datos_anteriores JSON NULL,
    datos_nuevos JSON NULL,
    fecha_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario_actor) REFERENCES usuario(id_usuario)
);

-- Inserts para definir cada rol

INSERT INTO rol (id_rol, tipo) VALUES 
(1, 'usuario'),
(2, 'vigilante'),
(3, 'admin');

INSERT INTO codigo_qr (codigo_qr, codigo_numero) values ('QR-123', 'QRE-321');