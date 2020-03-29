
CREATE SCHEMA BD_COMPDES_4_V3;

USE BD_COMPDES_4_V3;

CREATE TABLE ACTIVIDAD (
  ID_Actividad INT NOT NULL AUTO_INCREMENT,
  Nombre VARCHAR(50) NOT NULL,
  Tipo_Actividad ENUM('Taller','Inscripcion','Deportiva','Cultural','Particular'),
  Lugar VARCHAR(50) NOT NULL,
  Fecha_Realizacion TIMESTAMP(2) NOT NULL,
  Precio FLOAT NOT NULL,
  Descripcion VARCHAR(200),
  Modalidad ENUM('Presencial','Online') NOT NULL,
  Cupo_Limite INT NOT NULL,
  CONSTRAINT PK_ACTIVIDAD PRIMARY KEY(ID_Actividad)
  );


CREATE TABLE PARTICIPANTE (
  CUI_Pasaporte VARCHAR(15) NOT NULL,
  No_Pago VARCHAR(25) NOT NULL,
  Nombre VARCHAR(50) NOT NULL,
  Pais ENUM('Guatemala','El Salvador','Nicaragua','Costa Rica','Panama','Honduras','Espania') NOT NULL,
  Centro_Educativo ENUM('USAC','UES','UNAH','UNAN','UCR','UP','OTRA'),
  Talla_Playera ENUM('M','S','L','XL','XXL'),
  Profesion ENUM('Docente','Estudiante','Tecnico','Particular','Empleado','Profesional'),
  Fecha_Registro TIMESTAMP(2),  
	
  Correo VARCHAR(50) NOT NULL,  
  No_Telefono VARCHAR(12),
  Expectativas VARCHAR(200),
  Pago_Revisado INT(1),
  Participante_Registrado INT(1),
  Pin_Pago VARCHAR(10),
  
  CONSTRAINT UNIQUE_PIN_PAGO UNIQUE KEY(Pin_Pago),
  CONSTRAINT UNIQUE_NO_PAGO UNIQUE KEY(No_Pago),
  CONSTRAINT PK_PARTICIPANTE PRIMARY KEY(CUI_Pasaporte)
  );

CREATE TABLE REGISTRO_PAGO (
  ID_Pago VARCHAR(25) NOT NULL,
  P_CUI_Pasaporte VARCHAR(15) NOT NULL,
  A_ID_Actividad INT NOT NULL,
  Lugar VARCHAR(50) NOT NULL,
  Fecha_Pago TIMESTAMP(2) NOT NULL,
  Monto FLOAT NOT NULL,
  Concepto_Pago VARCHAR(50) NOT NULL,
  Tipo_Rol ENUM('Ponente','Conferensista','Seguridad','Participante'),

  CONSTRAINT PK_REGISTRO_PAGO PRIMARY KEY(ID_Pago),
  CONSTRAINT FK_REGISTRO_PAGO_ACTIVIDAD1 FOREIGN KEY(A_ID_Actividad) REFERENCES ACTIVIDAD(ID_Actividad),
  CONSTRAINT FK_REGISTRO_PAGO_PARTICIPANTE FOREIGN KEY(P_CUI_Pasaporte) REFERENCES PARTICIPANTE (CUI_Pasaporte)
  );
