-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-08-2024 a las 08:19:42
-- Versión del servidor: 10.6.18-MariaDB-cll-lve
-- Versión de PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `unamaded_simulacro`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `actualizar_registro` (IN `nombre_` VARCHAR(100), IN `apellido_p_` VARCHAR(100), IN `apellido_m_` VARCHAR(100), IN `documento_` VARCHAR(9), IN `carrera_` VARCHAR(300), IN `cel_` INT(11), IN `codigo_` BIGINT, IN `tema_` VARCHAR(1))   BEGIN
	set @id_ = (select id from postulante where cod_postulante = codigo_);
    update postulante set nombre = upper(nombre_), apellido_p = upper(apellido_p_), apellido_m = upper(apellido_m_), documento = documento_, phone = cel_ where id = @id_;
    update carrera set n_carrera = upper(carrera_), tema = upper(tema_) where id_postulante = @id_;
    select 'exito';
END$$

CREATE PROCEDURE `eliminar_registro` (IN `cod` BIGINT)   BEGIN
	set @id_ = (select id from postulante where cod_postulante = cod);
	delete from carrera where id_postulante = @id_;
    delete from grado where id_postulante = @id_;
    delete from ie where id_postulante = @id_;
    delete from nivel where id_postulante = @id_;
    delete from provincia_registro where id_postulante = @id_;
    delete from region_registro where id_postulante = @id_;
    delete from postulante where id = @id_;
END$$

CREATE PROCEDURE `inscripcion` (IN `nombre_` VARCHAR(200), IN `apellido_p_` VARCHAR(200), IN `apellido_m_` VARCHAR(200), IN `documento_` VARCHAR(9), IN `carrera_` VARCHAR(100), IN `cel_` INT(9), IN `nivel_` VARCHAR(100), IN `grado_` VARCHAR(100), IN `region_` VARCHAR(100), IN `provincia_` VARCHAR(100), IN `ie_select` VARCHAR(200), IN `f_registro_` TIMESTAMP, IN `flag_` INT(1), IN `tema_` VARCHAR(1))   BEGIN
insert into postulante(nombre, apellido_p, apellido_m, documento, phone, cod_postulante, f_registro)
values(upper(nombre_), upper(apellido_p_), upper(apellido_m_), documento_, cel_, "", f_registro_);
SET @id_ = LAST_INSERT_ID();
update postulante set cod_postulante = (8000000 + @id_) where id = @id_;
insert into carrera(n_carrera, id_postulante, tema) values(upper(carrera_), @id_, upper(tema_));
insert into nivel(nivel, id_postulante) values(upper(nivel_), @id_);
insert into grado(n_grado, id_postulante) values(upper(grado_), @id_);
insert into region_registro(n_region, id_postulante) values(upper(region_), @id_);
insert into provincia_registro(n_provincia, id_postulante) values(upper(provincia_), @id_);
insert into ie (n_ie, id_postulante) values(upper(ie_select), @id_);
select "exito";
END$$

CREATE PROCEDURE `registrar_recepcion` (IN `codigo_` BIGINT, `date_st` TIMESTAMP)   BEGIN
set @id_ = (select id from postulante where cod_postulante = codigo_);
insert into status_regis(status_, date_status, id_postulante) values("ENTREGADO", date_st, @id_);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `n_carrera` varchar(300) NOT NULL,
  `id_postulante` int(11) NOT NULL,
  `tema` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `carrera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id` int(11) NOT NULL,
  `n_grado` varchar(100) NOT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `grado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ie`
--

CREATE TABLE `ie` (
  `id` int(11) NOT NULL,
  `n_ie` varchar(300) NOT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `ie`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listar_registro`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `listar_registro` (
`nombre` varchar(100)
,`apellido_p` varchar(100)
,`apellido_m` varchar(100)
,`documento` varchar(9)
,`phone` int(11)
,`cod_postulante` bigint(20)
,`f_registro` timestamp
,`n_carrera` varchar(300)
,`tema` varchar(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listar_registro_general`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `listar_registro_general` (
`nombre` varchar(100)
,`apellido_p` varchar(100)
,`apellido_m` varchar(100)
,`documento` varchar(9)
,`phone` int(11)
,`cod_postulante` bigint(20)
,`f_registro` timestamp
,`n_carrera` varchar(300)
,`tema` varchar(1)
,`nivel` varchar(100)
,`n_grado` varchar(100)
,`n_region` varchar(100)
,`n_provincia` varchar(100)
,`n_ie` varchar(300)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `list_registry_accepted`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `list_registry_accepted` (
`nombre` varchar(100)
,`apellido_p` varchar(100)
,`apellido_m` varchar(100)
,`documento` varchar(9)
,`phone` int(11)
,`cod_postulante` bigint(20)
,`status_` varchar(10)
,`date_status` timestamp
,`n_carrera` varchar(300)
,`tema` varchar(1)
,`nivel` varchar(100)
,`n_grado` varchar(100)
,`n_region` varchar(100)
,`n_provincia` varchar(100)
,`n_ie` varchar(300)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `id` int(11) NOT NULL,
  `nivel` varchar(100) NOT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `nivel`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulante`
--

CREATE TABLE `postulante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_p` varchar(100) NOT NULL,
  `apellido_m` varchar(100) NOT NULL,
  `documento` varchar(9) NOT NULL,
  `phone` int(11) NOT NULL,
  `cod_postulante` bigint(20) DEFAULT NULL,
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `postulante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia_registro`
--

CREATE TABLE `provincia_registro` (
  `id` int(11) NOT NULL,
  `n_provincia` varchar(100) NOT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `provincia_registro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region_registro`
--

CREATE TABLE `region_registro` (
  `id` int(11) NOT NULL,
  `n_region` varchar(100) DEFAULT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `region_registro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_regis`
--

CREATE TABLE `status_regis` (
  `id` int(11) NOT NULL,
  `status_` varchar(10) DEFAULT NULL,
  `date_status` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_postulante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `status_regis`
--

-- --------------------------------------------------------

--
-- Estructura para la vista `listar_registro`
--
DROP TABLE IF EXISTS `listar_registro`;

CREATE VIEW `listar_registro`  AS SELECT `postulante`.`nombre` AS `nombre`, `postulante`.`apellido_p` AS `apellido_p`, `postulante`.`apellido_m` AS `apellido_m`, `postulante`.`documento` AS `documento`, `postulante`.`phone` AS `phone`, `postulante`.`cod_postulante` AS `cod_postulante`, `postulante`.`f_registro` AS `f_registro`, `carrera`.`n_carrera` AS `n_carrera`, `carrera`.`tema` AS `tema` FROM (`postulante` join `carrera`) WHERE `carrera`.`id_postulante` = `postulante`.`id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listar_registro_general`
--
DROP TABLE IF EXISTS `listar_registro_general`;

CREATE VIEW `listar_registro_general`  AS SELECT `postulante`.`nombre` AS `nombre`, `postulante`.`apellido_p` AS `apellido_p`, `postulante`.`apellido_m` AS `apellido_m`, `postulante`.`documento` AS `documento`, `postulante`.`phone` AS `phone`, `postulante`.`cod_postulante` AS `cod_postulante`, `postulante`.`f_registro` AS `f_registro`, `carrera`.`n_carrera` AS `n_carrera`, `carrera`.`tema` AS `tema`, `nivel`.`nivel` AS `nivel`, `grado`.`n_grado` AS `n_grado`, `region_registro`.`n_region` AS `n_region`, `provincia_registro`.`n_provincia` AS `n_provincia`, `ie`.`n_ie` AS `n_ie` FROM ((((((`postulante` join `carrera`) join `nivel`) join `grado`) join `region_registro`) join `provincia_registro`) join `ie`) WHERE `carrera`.`id_postulante` = `postulante`.`id` AND `nivel`.`id_postulante` = `postulante`.`id` AND `grado`.`id_postulante` = `postulante`.`id` AND `region_registro`.`id_postulante` = `postulante`.`id` AND `provincia_registro`.`id_postulante` = `postulante`.`id` AND `ie`.`id_postulante` = `postulante`.`id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `list_registry_accepted`
--
DROP TABLE IF EXISTS `list_registry_accepted`;

CREATE VIEW `list_registry_accepted`  AS SELECT `postulante`.`nombre` AS `nombre`, `postulante`.`apellido_p` AS `apellido_p`, `postulante`.`apellido_m` AS `apellido_m`, `postulante`.`documento` AS `documento`, `postulante`.`phone` AS `phone`, `postulante`.`cod_postulante` AS `cod_postulante`, `status_regis`.`status_` AS `status_`, `status_regis`.`date_status` AS `date_status`, `carrera`.`n_carrera` AS `n_carrera`, `carrera`.`tema` AS `tema`, `nivel`.`nivel` AS `nivel`, `grado`.`n_grado` AS `n_grado`, `region_registro`.`n_region` AS `n_region`, `provincia_registro`.`n_provincia` AS `n_provincia`, `ie`.`n_ie` AS `n_ie` FROM (((((((`postulante` join `carrera`) join `nivel`) join `grado`) join `region_registro`) join `provincia_registro`) join `ie`) join `status_regis`) WHERE `carrera`.`id_postulante` = `postulante`.`id` AND `nivel`.`id_postulante` = `postulante`.`id` AND `grado`.`id_postulante` = `postulante`.`id` AND `region_registro`.`id_postulante` = `postulante`.`id` AND `provincia_registro`.`id_postulante` = `postulante`.`id` AND `ie`.`id_postulante` = `postulante`.`id` AND `status_regis`.`id_postulante` = `postulante`.`id` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postulante` (`id_postulante`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postulante` (`id_postulante`);

--
-- Indices de la tabla `ie`
--
ALTER TABLE `ie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postulante` (`id_postulante`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postulante` (`id_postulante`);

--
-- Indices de la tabla `postulante`
--
ALTER TABLE `postulante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincia_registro`
--
ALTER TABLE `provincia_registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postulante` (`id_postulante`);

--
-- Indices de la tabla `region_registro`
--
ALTER TABLE `region_registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postulante` (`id_postulante`);

--
-- Indices de la tabla `status_regis`
--
ALTER TABLE `status_regis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postulante` (`id_postulante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ie`
--
ALTER TABLE `ie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `postulante`
--
ALTER TABLE `postulante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provincia_registro`
--
ALTER TABLE `provincia_registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `region_registro`
--
ALTER TABLE `region_registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status_regis`
--
ALTER TABLE `status_regis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD CONSTRAINT `carrera_ibfk_1` FOREIGN KEY (`id_postulante`) REFERENCES `postulante` (`id`);

--
-- Filtros para la tabla `grado`
--
ALTER TABLE `grado`
  ADD CONSTRAINT `grado_ibfk_1` FOREIGN KEY (`id_postulante`) REFERENCES `postulante` (`id`);

--
-- Filtros para la tabla `ie`
--
ALTER TABLE `ie`
  ADD CONSTRAINT `ie_ibfk_1` FOREIGN KEY (`id_postulante`) REFERENCES `postulante` (`id`);

--
-- Filtros para la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD CONSTRAINT `nivel_ibfk_1` FOREIGN KEY (`id_postulante`) REFERENCES `postulante` (`id`);

--
-- Filtros para la tabla `provincia_registro`
--
ALTER TABLE `provincia_registro`
  ADD CONSTRAINT `provincia_registro_ibfk_1` FOREIGN KEY (`id_postulante`) REFERENCES `postulante` (`id`);

--
-- Filtros para la tabla `region_registro`
--
ALTER TABLE `region_registro`
  ADD CONSTRAINT `region_registro_ibfk_1` FOREIGN KEY (`id_postulante`) REFERENCES `postulante` (`id`);

--
-- Filtros para la tabla `status_regis`
--
ALTER TABLE `status_regis`
  ADD CONSTRAINT `status_regis_ibfk_1` FOREIGN KEY (`id_postulante`) REFERENCES `postulante` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
