-- Crear base de datos
CREATE DATABASE IF NOT EXISTS hvcpu;
USE hvcpu;

-- Crear tabla de equipos
CREATE TABLE equipos (
  Id int(11) NOT NULL AUTO_INCREMENT,
  CodigoEquipo varchar(50) DEFAULT NULL,
  NombreSala varchar(50) DEFAULT NULL,
  NombreEquipo varchar(90) DEFAULT NULL,
  NumeroEquipo varchar (50) DEFAULT NULL,
  Campus varchar (50) DEFAULT NULL,
  
  MemoriaRam varchar(100) DEFAULT NULL,
  MarcaManufactura varchar(150) DEFAULT NULL,
  TecladoMarcaModeloSerial varchar(150) DEFAULT NULL,
  ReguladorVoltajeSerial varchar(150) DEFAULT NULL,
  MonitorMarcaModeloSerial varchar(150) DEFAULT NULL,
  MouseMarcaModeloSerial varchar(150) DEFAULT NULL,
  CPUModeloSerial varchar(150) DEFAULT NULL,
  DiscoDuroModeloSerial varchar(150) DEFAULT NULL,
  MacEthernetSerial varchar(55) DEFAULT NULL,
  MacWIFISerial varchar(55) DEFAULT NULL,
    
  Observaciones text DEFAULT NULL,
  ResponsableEquipo varchar(50) DEFAULT NULL,
  FechaIngreso date DEFAULT NULL,
  VelocidadHash varchar(15) DEFAULT NULL,
  DescripcionProducto varchar(550) DEFAULT NULL,
  HistorialMantenimientos text DEFAULT NULL,
  DetallesReparacion text DEFAULT NULL,
  InformacionCompleta text DEFAULT NULL,
  PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE administrador (
  Id int(11) NOT NULL AUTO_INCREMENT,
  NombreAdmin varchar(20) DEFAULT NULL,
  PasswdAdmin varchar(20) DEFAULT NULL,
  PRIMARY KEY (Id)
);

CREATE TABLE usuario (
  Id int(10) NOT NULL AUTO_INCREMENT,
  NombreUsuario varchar(20) DEFAULT NULL,
  PasswdUsuario varchar(20) DEFAULT NULL,
  emailUsuario varchar(20) DEFAULT NULL,
  PRIMARY KEY (Id)
);

CREATE TABLE auto_equipos (
    codigo_equipo VARCHAR(50),
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

CREATE TABLE archivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    tamaño INT NOT NULL,
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear usuario administrador con todos los permisos
CREATE USER 'administrador'@'localhost' IDENTIFIED BY 'contraseña';
GRANT ALL PRIVILEGES ON hvcpu.* TO 'administrador'@'localhost';

-- Crear usuario usuario con permisos de solo lectura
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'contraseña';
GRANT SELECT ON hvcpu.* TO 'usuario'@'localhost';
