bdejemplo

CREATE TABLE usuarios (
    idusuario VARCHAR(10) PRIMARY KEY,
    usuario  VARCHAR(50) NOT NULL UNIQUE,
    clave  VARCHAR(100) NOT NULL);

CREATE TABLE producto (
    idproducto VARCHAR(10) PRIMARY KEY,
    nombre  VARCHAR(50)  ,
    precio  DECIMAL(10,2)  ,
stock INT);

INSERT INTO usuarios(idusuario,usuario,clave) VALUES
('U001','admin','1234')