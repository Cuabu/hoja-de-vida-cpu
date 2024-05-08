-- Crear base de datos
CREATE DATABASE IF NOT EXISTS hvcpu;
USE hvcpu;

-- Crear tabla de equipos
CREATE TABLE equipos (
  Id int(11) NOT NULL AUTO_INCREMENT,
  CodigoEquipo varchar(20) DEFAULT NULL,
  NombreSala varchar(50) DEFAULT NULL,
  NombreEquipo varchar(90) DEFAULT NULL,
  NumeroEquipo varchar (10) DEFAULT NULL,
  Campus varchar (20) DEFAULT NULL,
  
  MarcaManufactura varchar(50) DEFAULT NULL,
  TecladoMarcaModeloSerial varchar(50) DEFAULT NULL,
  ReguladorVoltajeSerial varchar(50) DEFAULT NULL,
  MonitorMarcaModeloSerial varchar(50) DEFAULT NULL,
  MouseMarcaModeloSerial varchar(50) DEFAULT NULL,
  CPUModeloSerial varchar(50) DEFAULT NULL,
  DiscoDuroModeloSerial varchar(50) DEFAULT NULL,
  MacEthernetSerial varchar(25) DEFAULT NULL,
  MacWIFISerial varchar(25) DEFAULT NULL,
    
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

-- Crear usuario administrador con todos los permisos
CREATE USER 'administrador'@'localhost' IDENTIFIED BY 'contraseña';
GRANT ALL PRIVILEGES ON hvcpu.* TO 'administrador'@'localhost';

-- Crear usuario usuario con permisos de solo lectura
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'contraseña';
GRANT SELECT ON hvcpu.* TO 'usuario'@'localhost';
