-- Crear base de datos
CREATE DATABASE IF NOT EXISTS hvcpu;
USE hvcpu;

-- Crear tabla de equipos
CREATE TABLE equipos (
  Id int(11) NOT NULL AUTO_INCREMENT,
  CodigoEquipo varchar(20) DEFAULT NULL,
  FechaIngreso date DEFAULT NULL,
  NombreEquipo varchar(20) DEFAULT NULL,
  ResponsableEquipo varchar(50) DEFAULT NULL,
  MarcaManufactura varchar(50) DEFAULT NULL,
  TecladoMarcaModeloSerial varchar(50) DEFAULT NULL,
  ReguladorVoltajeSerial varchar(50) DEFAULT NULL,
  MonitorMarcaModeloSerial varchar(50) DEFAULT NULL,
  MouseMarcaModeloSerial varchar(50) DEFAULT NULL,
  LectorOpticoMarcaModeloSerial varchar(50) DEFAULT NULL,
  CPUModeloSerial varchar(50) DEFAULT NULL,
  DiscoDuroModeloSerial varchar(50) DEFAULT NULL,
  MacEthernetSerial varchar(15) DEFAULT NULL,
  MacWIFISerial varchar(15) DEFAULT NULL,
  VelocidadHash varchar(15) DEFAULT NULL,
  DescripcionProducto varchar(150) DEFAULT NULL,
  HistorialMantenimientos varchar(550) DEFAULT NULL,
  PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear tabla de videobeams
CREATE TABLE vbeam (
  Id int(11) NOT NULL AUTO_INCREMENT,
  EquipoId int(11) DEFAULT NULL,
  MarcaSerial varchar(50) DEFAULT NULL,
  Observaciones text DEFAULT NULL,
  PRIMARY KEY (Id),
  FOREIGN KEY (EquipoId) REFERENCES equipos(Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear tabla de mantenimientos
CREATE TABLE mantenimientos (
  Id int(11) NOT NULL AUTO_INCREMENT,
  EquipoId int(11) DEFAULT NULL,
  TipoMantenimiento varchar(20) DEFAULT NULL,
  CedulaResponsable int(11) DEFAULT NULL,
  FirmaResponsableEquipo varchar(50) DEFAULT NULL,
  NombreResponsable varchar(50) DEFAULT NULL,
  DescripcionMantenimiento text DEFAULT NULL,
  RealizadoPor varchar(50) DEFAULT NULL,
  Observaciones text DEFAULT NULL,
  Capacidad int(11) DEFAULT NULL,
  FirmaSoporteTecnico varchar(50) DEFAULT NULL,
  NombreSoporteTecnico varchar(50) DEFAULT NULL,
  PRIMARY KEY (Id),
  FOREIGN KEY (EquipoId) REFERENCES equipos(Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear tabla de salas
CREATE TABLE salas (
  Id int(11) NOT NULL AUTO_INCREMENT,
  NombreSala varchar(50) DEFAULT NULL,
  EquipoId int(11) DEFAULT NULL,
  VBeamId int(11) DEFAULT NULL,
  Observaciones text DEFAULT NULL,
  Capacidad int(11) DEFAULT NULL,
  VelocidadHash varchar(15) DEFAULT NULL,
  PRIMARY KEY (Id),
  FOREIGN KEY (EquipoId) REFERENCES equipos(Id),
  FOREIGN KEY (VBeamId) REFERENCES vbeam(Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear tabla de dispositivos externos conectados
CREATE TABLE dispext (
  Id int(11) NOT NULL AUTO_INCREMENT,
  NombreDispositivo varchar(50) DEFAULT NULL,
  Conectado tinyint(1) DEFAULT NULL,
  PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear tabla de historial
CREATE TABLE historial (
  Id int(11) NOT NULL AUTO_INCREMENT,
  EquipoId int(11) DEFAULT NULL,
  DetallesReparacion text DEFAULT NULL,
  VidaMaquina int(11) DEFAULT NULL,
  PRIMARY KEY (Id),
  FOREIGN KEY (EquipoId) REFERENCES equipos(Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear usuario administrador con todos los permisos
CREATE USER 'administrador'@'localhost' IDENTIFIED BY 'contraseña';
GRANT ALL PRIVILEGES ON hvcpu.* TO 'administrador'@'localhost';

-- Crear usuario usuario con permisos de solo lectura
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'contraseña';
GRANT SELECT ON hvcpu.* TO 'usuario'@'localhost';
