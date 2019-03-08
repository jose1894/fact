-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2019 a las 23:25:19
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fact`
--
DROP DATABASE IF EXISTS `fact`;
CREATE DATABASE IF NOT EXISTS `fact` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fact`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id_clte` int(11) NOT NULL COMMENT 'ID UNICO',
  `dni_clte` varchar(20) NOT NULL COMMENT 'DNI CLIENTE',
  `ruc_clte` varchar(20) NOT NULL COMMENT 'RUC CLIENTE',
  `nombre_clte` varchar(150) NOT NULL COMMENT 'NOMBRE CLIENTE',
  `direcc_clte` text NOT NULL COMMENT 'DIRECCION CLIENTE',
  `depto_cte` int(11) NOT NULL COMMENT 'DEPARTAMENTO CLIENTE',
  `provi_cte` int(11) NOT NULL COMMENT 'PROVINCIA CLIENTE',
  `dtto_clte` int(11) NOT NULL COMMENT 'DISTRITO CLIENTE',
  `tlf_ctle` varchar(100) NOT NULL COMMENT 'TELEFONO CLIENTE',
  `vendedor_clte` int(11) NOT NULL COMMENT 'VENDEDOR CLIENTE',
  `estatus_ctle` int(11) NOT NULL COMMENT 'ESTATUS CLIENTE',
  `condp_clte` int(11) NOT NULL COMMENT 'CONDICION DE PAGO',
  `sucursal_clte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE CLIENTES';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL COMMENT 'ID UNICO',
  `nombre_empresa` varchar(150) NOT NULL COMMENT 'NOMBRE EMPRESA',
  `estatus_empresa` int(11) NOT NULL COMMENT 'ESTATUS EMPRESA',
  `dni_empresa` varchar(20) NOT NULL COMMENT 'DNI EMPRESA',
  `ruc_empresa` varchar(11) NOT NULL COMMENT 'RUC EMPRESA',
  `tipopers_empresa` int(11) NOT NULL COMMENT 'TIPO PERSONA',
  `tlf_empresa` varchar(150) NOT NULL COMMENT 'TELEFONO EMPRESA',
  `direcc_empresa` text NOT NULL COMMENT 'DIRECCION EMPRESA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nombre_empresa`, `estatus_empresa`, `dni_empresa`, `ruc_empresa`, `tipopers_empresa`, `tlf_empresa`, `direcc_empresa`) VALUES
(1, 'MARVIG', 1, '', '20517053270', 1, '', 'scasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `id_pdcto` int(11) NOT NULL COMMENT 'ID UNICO',
  `cod_pdcto` varchar(30) NOT NULL COMMENT 'CODIGO PRODUCTO',
  `des_pdcto` varchar(255) NOT NULL COMMENT 'DESCIPCION DE PRODUCTO',
  `tipo_pdcto` int(11) NOT NULL COMMENT 'TIPO PRODUCTO',
  `umed_pdcto` int(11) NOT NULL COMMENT 'UNIDAD MEDIDA PRODUCTO',
  `status_pdcto` int(11) NOT NULL COMMENT 'ESTATUS PRODUCTO',
  `sucursal_pdcto` int(11) NOT NULL COMMENT 'SUCURSAL PRODUCTO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE PRODUCTOS';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE `sucursal` (
  `id_suc` int(11) NOT NULL COMMENT 'ID UNICO',
  `nombre_suc` varchar(50) NOT NULL COMMENT 'NOMBRE SUCURSAL',
  `estatus_suc` int(11) NOT NULL COMMENT 'ESTATUS SUCURSAL',
  `empresa_suc` int(11) NOT NULL COMMENT 'EMPRESA  DE LA SUCURSAL'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE SUCURSALES';

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id_suc`, `nombre_suc`, `estatus_suc`, `empresa_suc`) VALUES
(12, 'PRINCIPAL', 1, 1),
(13, 'SECUNDARIA', 1, 1),
(14, 'TERCERA', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

DROP TABLE IF EXISTS `tipo_producto`;
CREATE TABLE `tipo_producto` (
  `id_tpdcto` int(11) NOT NULL COMMENT 'ID UNICO',
  `desc_tpdcto` varchar(255) NOT NULL COMMENT 'DESCRIP TIPO PRODUCTO',
  `status_tpdcto` int(11) NOT NULL COMMENT 'ESTATUS TIPO PRODUCTO',
  `sucursal_tpdcto` int(11) NOT NULL COMMENT 'SUCURSAL TIPO PRODUCTO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE TIPO PRODUCTOS';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE `vendedor` (
  `id_vendedor` int(11) NOT NULL COMMENT 'ID UNICO',
  `dni_vend` int(11) NOT NULL COMMENT 'DNI VENDEDOR',
  `nombre_vend` int(11) NOT NULL COMMENT 'NOMBRE VENDEDOR',
  `tlf_vend` int(11) NOT NULL COMMENT 'TELEFONO VENDEDOR',
  `estatus_vend` int(11) NOT NULL COMMENT 'ESTATUS VENDEDOR',
  `sucursal_vend` int(11) NOT NULL COMMENT 'SUCURSAL VENDEDOR',
  `zona_vend` int(11) NOT NULL COMMENT 'ZONA VENDEDOR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE VENDEDORES';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

DROP TABLE IF EXISTS `zona`;
CREATE TABLE `zona` (
  `id_zona` int(11) NOT NULL COMMENT 'ID UNICO',
  `nombre_zona` varchar(150) NOT NULL COMMENT 'NOMBRE ZONA',
  `desc_zona` text NOT NULL COMMENT 'DESCRIPCION ZONA',
  `estatus_zona` int(11) NOT NULL COMMENT 'ESTATUS ZONA',
  `sucursal_zona` int(11) NOT NULL COMMENT 'SUCURSAL ZONA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE ZONAS';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_clte`),
  ADD KEY `sucursal_clte` (`sucursal_clte`),
  ADD KEY `vendedor_clte` (`vendedor_clte`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_pdcto`),
  ADD UNIQUE KEY `cod_producto` (`cod_pdcto`),
  ADD KEY `tipo_producto` (`tipo_pdcto`),
  ADD KEY `sucursal_pdcto` (`sucursal_pdcto`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id_suc`),
  ADD KEY `EMPRESA_SUC` (`empresa_suc`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tpdcto`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id_vendedor`),
  ADD KEY `zona_vend` (`zona_vend`),
  ADD KEY `sucursal_vend` (`sucursal_vend`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id_zona`),
  ADD KEY `sucursal_zona` (`sucursal_zona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_clte` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO';

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_pdcto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO';

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id_suc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tpdcto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO';

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`vendedor_clte`) REFERENCES `vendedor` (`id_vendedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo_pdcto`) REFERENCES `tipo_producto` (`id_tpdcto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`empresa_suc`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD CONSTRAINT `vendedor_ibfk_1` FOREIGN KEY (`zona_vend`) REFERENCES `zona` (`id_zona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
