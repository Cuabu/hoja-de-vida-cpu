CREATE DATABASE IF NOT EXISTS hvcpu;
USE hvcpu;

CREATE TABLE auto_equipos (
    codigo_equipo VARCHAR(50) PRIMARY KEY,
    nombre_sala VARCHAR(50),
    nombre_equipo VARCHAR(50),
    numero_equipo VARCHAR(50),
    campus VARCHAR(50),
    memoria_ram VARCHAR(50),
    cpu_modelo_serial VARCHAR(100),
    disco_duro_modelo_serial VARCHAR(100),
    mac_ethernet_serial VARCHAR(50),
    mac_wifi_serial VARCHAR(50),
    bios_info VARCHAR(100),
    adapter_info VARCHAR(100),
    os_info VARCHAR(100),
    cpu_speed_info VARCHAR(50),
    memory_info_extended VARCHAR(500),
    disk_info_extended VARCHAR(500)
);

CREATE TABLE archivos_sql (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_archivo VARCHAR(255) NOT NULL,
    ruta_archivo VARCHAR(255) NOT NULL,
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE historial (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_equipo VARCHAR(50),
    descripcion TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (codigo_equipo) REFERENCES auto_equipos(codigo_equipo)
);

CREATE TABLE administrador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    NombreAdmin VARCHAR(20) DEFAULT NULL,
    PasswdAdmin VARCHAR(20) DEFAULT NULL
);

CREATE TABLE alertas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mensaje TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reporte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(50),
    falla TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    codigo_equipo VARCHAR(50),
    FOREIGN KEY (codigo_equipo) REFERENCES auto_equipos(codigo_equipo)
);

CREATE TABLE ports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_equipo VARCHAR(50),
    puerto INT,
    FOREIGN KEY (codigo_equipo) REFERENCES auto_equipos(codigo_equipo)
);

CREATE TABLE cambios_hardware (
    id INT AUTO_INCREMENT PRIMARY KEY,
    componente VARCHAR(255) NOT NULL,
    cambio TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear usuario administrador con todos los permisos
CREATE USER 'administrador'@'localhost' IDENTIFIED BY 'contraseña';
GRANT ALL PRIVILEGES ON hvcpu.* TO 'administrador'@'localhost';

-- Crear usuario usuario con permisos de solo lectura
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'contraseña';
GRANT SELECT ON hvcpu.* TO 'usuario'@'localhost';
