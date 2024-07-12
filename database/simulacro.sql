-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2024 a las 00:40:32
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `simulacro`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_registro` (IN `nombre_` VARCHAR(100), IN `apellido_p_` VARCHAR(100), IN `apellido_m_` VARCHAR(100), IN `documento_` VARCHAR(9), IN `carrera_` VARCHAR(300), IN `cel_` INT(11), IN `codigo_` BIGINT, IN `tema_` VARCHAR(1))   BEGIN
	set @id_ = (select id from postulante where cod_postulante = codigo_);
    update postulante set nombre = upper(nombre_), apellido_p = upper(apellido_p_), apellido_m = upper(apellido_m_), documento = documento_, phone = cel_ where id = @id_;
    update carrera set n_carrera = upper(carrera_), tema = upper(tema_) where id_postulante = @id_;
    select 'exito';
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_registro` (IN `cod` BIGINT)   BEGIN
	set @id_ = (select id from postulante where cod_postulante = cod);
	delete from carrera where id_postulante = @id_;
    delete from grado where id_postulante = @id_;
    delete from ie where id_postulante = @id_;
    delete from nivel where id_postulante = @id_;
    delete from provincia_registro where id_postulante = @id_;
    delete from region_registro where id_postulante = @id_;
    delete from postulante where id = @id_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inscripcion` (IN `nombre_` VARCHAR(200), IN `apellido_p_` VARCHAR(200), IN `apellido_m_` VARCHAR(200), IN `documento_` VARCHAR(9), IN `carrera_` VARCHAR(100), IN `cel_` INT(9), IN `nivel_` VARCHAR(100), IN `grado_` VARCHAR(100), IN `region_` VARCHAR(100), IN `provincia_` VARCHAR(100), IN `ie_select` VARCHAR(200), IN `f_registro_` TIMESTAMP, IN `flag_` INT(1), IN `tema_` VARCHAR(1))   BEGIN

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `n_carrera`, `id_postulante`, `tema`) VALUES
(5, 'ADMINISTRACIÓN Y NEGOCIOS INTERNACIONALES', 5, 'R'),
(6, 'ENFERMERÍA', 6, 'Q'),
(7, 'DERECHO Y CIENCIAS POLÍTICAS', 7, 'R'),
(8, 'CONTABILIDAD Y FINANZAS', 8, 'R'),
(9, 'INGENIERÍA FORESTAL Y MEDIO AMBIENTE', 9, 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id` int(11) NOT NULL,
  `n_grado` varchar(100) NOT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id`, `n_grado`, `id_postulante`) VALUES
(1, '-', 1),
(5, 'CUARTO', 5),
(6, 'QUINTO', 6),
(7, '-', 7),
(8, '-', 8),
(9, '-', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ie`
--

CREATE TABLE `ie` (
  `id` int(11) NOT NULL,
  `n_ie` varchar(300) NOT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ie`
--

INSERT INTO `ie` (`id`, `n_ie`, `id_postulante`) VALUES
(1, '-', 1),
(5, '52001 SANTA ROSA', 5),
(6, 'OTRO', 6),
(7, '-', 7),
(8, '-', 8),
(9, '-', 9);

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
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `id` int(11) NOT NULL,
  `nivel` varchar(100) NOT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`id`, `nivel`, `id_postulante`) VALUES
(1, 'PRIMARIA', 1),
(5, 'SECUNDARIA', 5),
(6, 'SECUNDARIA', 6),
(7, 'PRIMARIA', 7),
(8, 'EGRESADO', 8),
(9, 'PRIMARIA', 9);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `postulante`
--

INSERT INTO `postulante` (`id`, `nombre`, `apellido_p`, `apellido_m`, `documento`, `phone`, `cod_postulante`, `f_registro`) VALUES
(1, 'FERNANDO', 'FLORES', 'CONDORI', '07520643', 931119479, 8000001, '2024-07-11 14:12:40'),
(2, 'ESTEFANY', 'QUISPE', 'CHOQQUEHUANCA', '001412139', 987654321, 8000002, '2024-07-11 14:13:32'),
(3, 'VINO', 'TIBURCIO', 'TINTO', '65465456', 151263431, 8000003, '2024-07-11 14:22:18'),
(5, 'ESTEF', 'QUISPE', 'CHOQQUEHUANCA', '74417000', 973121600, 8000005, '2024-07-11 18:00:11'),
(6, 'GLADYS', 'AGUIRR', 'ESCALNTE', '74463805', 983752792, 8000006, '2024-07-11 18:02:43'),
(7, 'LUIS', 'SUARES', 'QUIQO', '074417002', 973121111, 8000007, '2024-07-11 21:27:55'),
(8, 'ÑOÑO', 'SUARES', 'QUIQO', '744170023', 123456789, 8000008, '2024-07-11 21:30:19'),
(9, 'JUAN', 'QUISPE', 'CHOQQUEHUANCA', '74417002', 987654321, 8000009, '2024-07-11 21:38:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia_registro`
--

CREATE TABLE `provincia_registro` (
  `id` int(11) NOT NULL,
  `n_provincia` varchar(100) NOT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provincia_registro`
--

INSERT INTO `provincia_registro` (`id`, `n_provincia`, `id_postulante`) VALUES
(1, '-', 1),
(5, 'TAMBOPATA', 5),
(6, 'TAMBOPATA', 6),
(7, '-', 7),
(8, '-', 8),
(9, '-', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region_registro`
--

CREATE TABLE `region_registro` (
  `id` int(11) NOT NULL,
  `n_region` varchar(100) DEFAULT NULL,
  `id_postulante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `region_registro`
--

INSERT INTO `region_registro` (`id`, `n_region`, `id_postulante`) VALUES
(1, '-', 1),
(5, 'MADRE DE DIOS', 5),
(6, 'MADRE DE DIOS', 6),
(7, '-', 7),
(8, '-', 8),
(9, '-', 9);

-- --------------------------------------------------------

--
-- Estructura para la vista `listar_registro`
--
DROP TABLE IF EXISTS `listar_registro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_registro`  AS SELECT `postulante`.`nombre` AS `nombre`, `postulante`.`apellido_p` AS `apellido_p`, `postulante`.`apellido_m` AS `apellido_m`, `postulante`.`documento` AS `documento`, `postulante`.`phone` AS `phone`, `postulante`.`cod_postulante` AS `cod_postulante`, `postulante`.`f_registro` AS `f_registro`, `carrera`.`n_carrera` AS `n_carrera`, `carrera`.`tema` AS `tema` FROM (`postulante` join `carrera`) WHERE `carrera`.`id_postulante` = `postulante`.`id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listar_registro_general`
--
DROP TABLE IF EXISTS `listar_registro_general`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_registro_general`  AS SELECT `postulante`.`nombre` AS `nombre`, `postulante`.`apellido_p` AS `apellido_p`, `postulante`.`apellido_m` AS `apellido_m`, `postulante`.`documento` AS `documento`, `postulante`.`phone` AS `phone`, `postulante`.`cod_postulante` AS `cod_postulante`, `postulante`.`f_registro` AS `f_registro`, `carrera`.`n_carrera` AS `n_carrera`, `carrera`.`tema` AS `tema`, `nivel`.`nivel` AS `nivel`, `grado`.`n_grado` AS `n_grado`, `region_registro`.`n_region` AS `n_region`, `provincia_registro`.`n_provincia` AS `n_provincia`, `ie`.`n_ie` AS `n_ie` FROM ((((((`postulante` join `carrera`) join `nivel`) join `grado`) join `region_registro`) join `provincia_registro`) join `ie`) WHERE `carrera`.`id_postulante` = `postulante`.`id` AND `nivel`.`id_postulante` = `postulante`.`id` AND `grado`.`id_postulante` = `postulante`.`id` AND `region_registro`.`id_postulante` = `postulante`.`id` AND `provincia_registro`.`id_postulante` = `postulante`.`id` AND `ie`.`id_postulante` = `postulante`.`id` ;

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ie`
--
ALTER TABLE `ie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `postulante`
--
ALTER TABLE `postulante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `provincia_registro`
--
ALTER TABLE `provincia_registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `region_registro`
--
ALTER TABLE `region_registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
