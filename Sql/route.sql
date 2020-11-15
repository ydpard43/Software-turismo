
--
-- Base de datos: Route
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla administrador
--
CREATE SEQUENCE admin_seq;
CREATE TABLE Administrador (
  ID_ADMINISTRADOR numeric(2) DEFAULT nextval('admin_seq') NOT NULL,
  alias varchar(30) NOT NULL,
  prNombre varchar(10) NOT NULL,
  sgNombre varchar(10) NOT NULL,
  prApellido varchar(10) NOT NULL,
  sgApellido varchar(10) NOT NULL,
  contrasena varchar(64) NOT NULL,
  estado boolean NOT NULL,
  FK_ID_ROL numeric(1) NOT NULL
);
ALTER SEQUENCE admin_seq OWNED BY Administrador.ID_ADMINISTRADOR;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla camino
--
CREATE SEQUENCE camino_seq;
CREATE TABLE Camino (
  ID_CAMINO numeric(4) DEFAULT nextval('camino_seq') NOT NULL,
  distancia numeric(3) NOT NULL
);
ALTER SEQUENCE camino_seq OWNED BY Camino.ID_CAMINO;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla correoadministrador
--

CREATE TABLE CorreoAdministrador (
  FK_ID_ADMINISTRADOR numeric(11) NOT NULL,
  ID_CORREOADMINISTRADOR varchar(40)  NOT NULL,
  estado boolean NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla correoturista
--

CREATE TABLE CorreoTurista (
  FK_ID_TURISTA numeric(5) NOT NULL,
  ID_CORREOTURISTA varchar(40)  NOT NULL,
  estado boolean NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla evento
--
CREATE SEQUENCE event_seq;
CREATE TABLE Evento (
  ID_EVENTO numeric(1) DEFAULT nextval('event_seq') NOT NULL,
  nombre numeric(15) NOT NULL
);
ALTER SEQUENCE event_seq OWNED BY Evento.ID_EVENTO;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla formula
--
CREATE SEQUENCE formula_seq;
CREATE TABLE Formula (
  ID_FORMULA numeric(2) DEFAULT nextval('camino_seq') NOT NULL,
  nombre varchar(30)  NOT NULL,
  peso numeric(2) NOT NULL,
  valorMaximo numeric(2) NOT NULL,
  valorMinimo numeric(2) NOT NULL,
  descripcion varchar(70)  NOT NULL,
  estado boolean NOT NULL
) ;
ALTER SEQUENCE formula_seq OWNED BY Formula.ID_FORMULA;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla imagenpoi
--

CREATE TABLE ImagenPoi (
  FK_ID_POI numeric(3) NOT NULL,
  ID_IMAGENPOI varchar(10)  NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla log
--
CREATE SEQUENCE log_seq;
CREATE TABLE Log (
  ID_LOG numeric(7) DEFAULT nextval('log_seq') NOT NULL,
  afectado varchar(15)  NOT NULL,
  tiempo timestamp NOT NULL,
  FK_ID_ADMINISTRADOR numeric(2) NOT NULL,
  FK_ID_EVENTO numeric(1) NOT NULL
) ;
ALTER SEQUENCE log_seq OWNED BY Log.ID_LOG;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla modalidad
--
CREATE SEQUENCE mod_seq;
CREATE TABLE Modalidad (
  ID_MODALIDAD numeric(1) DEFAULT nextval('mod_seq') NOT NULL,
  nombre numeric(9) NOT NULL
) ;
ALTER SEQUENCE mod_seq OWNED BY Modalidad.ID_MODALIDAD;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla modalidad_camino
--

CREATE TABLE MODALIDAD_CAMINO (
  FK_ID_CAMINO numeric(4) NOT NULL,
  FK_ID_MODALIDAD numeric(1) NOT NULL,
  estado boolean NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla municipio
--
CREATE SEQUENCE mun_seq;
CREATE TABLE Municipio (
  ID_MUNICIPIO numeric(2) DEFAULT nextval('mun_seq') NOT NULL,
  nombre varchar(11) NOT NULL
) ;
ALTER SEQUENCE mun_seq OWNED BY Municipio.ID_MUNICIPIO;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla poi
--
CREATE SEQUENCE poi_seq;
CREATE TABLE Poi (
  ID_POI numeric(3) DEFAULT nextval('poi_seq') NOT NULL,
  nombre varchar(25)  NOT NULL,
  coordenadaX varchar(9)  NOT NULL,
  coordenadaY varchar(9)  NOT NULL,
  tiempoEstancia numeric(3) NOT NULL,
  descripcion varchar(100)  NOT NULL,
  estado boolean NOT NULL,
  FK_ID_MUNICIPIO numeric(2) NOT NULL
);
ALTER SEQUENCE poi_seq OWNED BY  Poi.ID_POI;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla poi_camino
--

CREATE TABLE POI_CAMINO (
  FK_ID_POI_INICIO numeric(3) NOT NULL,
  FK_ID_POI_FINAL numeric(3) NOT NULL,
  FK_ID_CAMINO numeric(4) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla poi_formula
--

CREATE TABLE POI_FORMULA (
  FK_ID_POI numeric(3) NOT NULL,
  FK_ID_FORMULA numeric(2) NOT NULL,
  valor numeric(2) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla poi_ruta
--

CREATE TABLE POI_RUTA (
  FK_ID_POI numeric(3) NOT NULL,
  FK_ID_RUTA numeric(5) NOT NULL,
  estado boolean NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla poi_tipologia
--

CREATE TABLE POI_TIPOLOGIA (
  FK_ID_POI numeric(3) NOT NULL,
  FK_ID_TIPOLOGIA numeric(2) NOT NULL,
  estado boolean NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla poi_turista
--

CREATE TABLE POI_TURISTA (
  FK_ID_POI numeric(3) NOT NULL,
  FK_ID_TURISTA numeric(4) NOT NULL,
  opinion varchar(100) NOT NULL,
  estrellas numeric(1) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla rol
--
CREATE SEQUENCE rol_seq;

CREATE TABLE Rol (
  ID_ROL numeric(1) DEFAULT nextval('rol_seq') NOT NULL,
  nombre varchar(10) NOT NULL,
  estado boolean NOT NULL
);
ALTER SEQUENCE rol_seq OWNED BY Rol.ID_ROL;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla ruta
--
CREATE SEQUENCE ruta_seq;

CREATE TABLE Ruta (
  ID_RUTA numeric(5) DEFAULT nextval('ruta_seq') NOT NULL,
  nombre numeric(3) NOT NULL,
  estado boolean NOT NULL,
  tiempo time NOT NULL,
  FK_ID_TURISTA numeric(4) NOT NULL
);
ALTER SEQUENCE ruta_seq OWNED BY Ruta.ID_RUTA;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tipologia
--
CREATE SEQUENCE tipo_seq;

CREATE TABLE Tipologia (
  ID_TIPOLOGIA numeric(2) DEFAULT nextval('tipo_seq') NOT NULL,
  nombre varchar(30)  NOT NULL,
  descripcion varchar(70)  NOT NULL,
  estado boolean NOT NULL
);
ALTER SEQUENCE tipo_seq OWNED BY Tipologia.ID_TIPOLOGIA;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla turista
--
CREATE SEQUENCE turista_seq;

CREATE TABLE Turista (
  ID_TURISTA numeric(5) DEFAULT nextval('turista_seq') NOT NULL,
  alias varchar(30) NOT NULL,
  prNombre varchar(10)  NOT NULL,
  sgNombre varchar(10)  NOT NULL,
  prApellido varchar(10) NOT NULL,
  sgApellido varchar(10) NOT NULL,
  contrasena varchar(64) NOT NULL,
  sexo boolean NOT NULL,
  imagen varchar(9) NOT NULL,
  estado boolean NOT NULL
);
ALTER SEQUENCE turista_seq OWNED BY Turista.ID_TURISTA;
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla administrador
--
ALTER TABLE Administrador
  ADD PRIMARY KEY (ID_ADMINISTRADOR);

--
-- Indices de la tabla camino
--
ALTER TABLE Camino
  ADD PRIMARY KEY (ID_CAMINO);

--
-- Indices de la tabla correoadministrador
--
ALTER TABLE CorreoAdministrador
  ADD PRIMARY KEY (FK_ID_ADMINISTRADOR,ID_CORREOADMINISTRADOR);

--
-- Indices de la tabla correoturista
--
ALTER TABLE Correoturista
  ADD PRIMARY KEY (FK_ID_TURISTA,ID_CORREOTURISTA);

--
-- Indices de la tabla evento
--
ALTER TABLE Evento
  ADD PRIMARY KEY (ID_EVENTO);

--
-- Indices de la tabla formula
--
ALTER TABLE Formula
  ADD PRIMARY KEY (ID_FORMULA);

--
-- Indices de la tabla imagenpoi
--
ALTER TABLE ImagenPoi
  ADD PRIMARY KEY (FK_ID_POI,ID_IMAGENPOI);

--
-- Indices de la tabla log
--
ALTER TABLE Log
  ADD PRIMARY KEY (ID_LOG);

--
-- Indices de la tabla modalidad
--
ALTER TABLE Modalidad
  ADD PRIMARY KEY (ID_MODALIDAD);

--
-- Indices de la tabla modalidad_camino
--
ALTER TABLE MODALIDAD_CAMINO
  ADD PRIMARY KEY (FK_ID_CAMINO,FK_ID_MODALIDAD);

--
-- Indices de la tabla municipio
--
ALTER TABLE Municipio
  ADD PRIMARY KEY (ID_MUNICIPIO);

--
-- Indices de la tabla poi
--
ALTER TABLE Poi
  ADD PRIMARY KEY (ID_POI);

--
-- Indices de la tabla poi_camino
--
ALTER TABLE POI_CAMINO
  ADD PRIMARY KEY (FK_ID_POI_INICIO,FK_ID_POI_FINAL);

--
-- Indices de la tabla poi_formula
--
ALTER TABLE POI_FORMULA
  ADD PRIMARY KEY (FK_ID_POI,FK_ID_FORMULA);

--
-- Indices de la tabla poi_ruta
--
ALTER TABLE POI_RUTA
  ADD PRIMARY KEY (FK_ID_POI,FK_ID_RUTA);

--
-- Indices de la tabla poi_tipologia
--
ALTER TABLE POI_TIPOLOGIA
  ADD PRIMARY KEY (FK_ID_POI,FK_ID_TIPOLOGIA);

--
-- Indices de la tabla poi_turista
--
ALTER TABLE POI_TURISTA
  ADD PRIMARY KEY (FK_ID_POI,FK_ID_TURISTA);

--
-- Indices de la tabla rol
--
ALTER TABLE Rol
  ADD PRIMARY KEY (ID_ROL);

--
-- Indices de la tabla ruta
--
ALTER TABLE Ruta
  ADD PRIMARY KEY (ID_RUTA);

--
-- Indices de la tabla tipologia
--
ALTER TABLE Tipologia
  ADD PRIMARY KEY (ID_TIPOLOGIA);

--
-- Indices de la tabla turista
--
ALTER TABLE Turista
  ADD PRIMARY KEY (ID_TURISTA);

--
-- Filtros para la tabla administrador
--
ALTER TABLE Administrador
  ADD CONSTRAINT administrador_ibfk_1 FOREIGN KEY (FK_ID_ROL) REFERENCES rol (ID_ROL);

--
-- Filtros para la tabla correoadministrador
--
ALTER TABLE CorreoAdministrador
  ADD CONSTRAINT correoadministrador_ibfk_1 FOREIGN KEY (FK_ID_ADMINISTRADOR) REFERENCES administrador (ID_ADMINISTRADOR);

--
-- Filtros para la tabla correoturista
--
ALTER TABLE CorreoTurista
  ADD CONSTRAINT ct_ibfk_1 FOREIGN KEY (FK_ID_TURISTA) REFERENCES turista (ID_TURISTA);

--
-- Filtros para la tabla imagenpoi
--
ALTER TABLE ImagenPoi
  ADD CONSTRAINT ip_ibfk_1 FOREIGN KEY (FK_ID_POI) REFERENCES poi (ID_POI);

--
-- Filtros para la tabla log
--
ALTER TABLE Log
  ADD CONSTRAINT log_ibfk_1 FOREIGN KEY (FK_ID_ADMINISTRADOR) REFERENCES administrador (ID_ADMINISTRADOR),
  ADD CONSTRAINT log_ibfk_2 FOREIGN KEY (FK_ID_EVENTO) REFERENCES evento (ID_EVENTO);

--
-- Filtros para la tabla modalidad_camino
--
ALTER TABLE MODALIDAD_CAMINO
  ADD CONSTRAINT mc_ibfk_1 FOREIGN KEY (FK_ID_MODALIDAD) REFERENCES modalidad (ID_MODALIDAD),
  ADD CONSTRAINT mc_ibfk_2 FOREIGN KEY (FK_ID_CAMINO) REFERENCES camino (ID_CAMINO);

--
-- Filtros para la tabla poi
--
ALTER TABLE Poi
  ADD CONSTRAINT p_ibfk_1 FOREIGN KEY (FK_ID_MUNICIPIO) REFERENCES municipio (ID_MUNICIPIO);

--
-- Filtros para la tabla poi_camino
--
ALTER TABLE POI_CAMINO
  ADD CONSTRAINT pc_ibfk_1 FOREIGN KEY (FK_ID_POI_INICIO) REFERENCES poi (ID_POI),
  ADD CONSTRAINT pc_ibfk_2 FOREIGN KEY (FK_ID_POI_FINAL) REFERENCES poi (ID_POI),
  ADD CONSTRAINT pc_ibfk_3 FOREIGN KEY (FK_ID_CAMINO) REFERENCES camino (ID_CAMINO);

--
-- Filtros para la tabla poi_formula
--
ALTER TABLE POI_FORMULA
  ADD CONSTRAINT pf_ibfk_1 FOREIGN KEY (FK_ID_POI) REFERENCES poi (ID_POI),
  ADD CONSTRAINT pf_ibfk_2 FOREIGN KEY (FK_ID_FORMULA) REFERENCES formula (ID_FORMULA);

--
-- Filtros para la tabla poi_ruta
--
ALTER TABLE POI_RUTA
  ADD CONSTRAINT pr_ibfk_1 FOREIGN KEY (FK_ID_POI) REFERENCES poi (ID_POI),
  ADD CONSTRAINT pr_ibfk_2 FOREIGN KEY (FK_ID_RUTA) REFERENCES ruta (ID_RUTA);

--
-- Filtros para la tabla poi_tipologia
--
ALTER TABLE POI_TIPOLOGIA
  ADD CONSTRAINT tipologia_ibfk_1 FOREIGN KEY (FK_ID_POI) REFERENCES poi (ID_POI),
  ADD CONSTRAINT tipologia_ibfk_2 FOREIGN KEY (FK_ID_TIPOLOGIA) REFERENCES tipologia (ID_TIPOLOGIA);

--
-- Filtros para la tabla poi_turista
--
ALTER TABLE POI_TURISTA
  ADD CONSTRAINT pt_ibfk_1 FOREIGN KEY (FK_ID_POI) REFERENCES poi (ID_POI),
  ADD CONSTRAINT pt_ibfk_2 FOREIGN KEY (FK_ID_TURISTA) REFERENCES turista (ID_TURISTA);

--
-- Filtros para la tabla ruta
--
ALTER TABLE Ruta
  ADD CONSTRAINT r_ibfk_1 FOREIGN KEY (FK_ID_TURISTA) REFERENCES turista (ID_TURISTA);

