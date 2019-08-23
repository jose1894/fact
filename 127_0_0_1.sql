-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2019 a las 23:56:39
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

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
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL COMMENT 'ID UNICO',
  `des_almacen` varchar(50) NOT NULL COMMENT 'DESCRIPCION ALMACEN',
  `status_almacen` int(11) NOT NULL COMMENT 'ESTATUS ALMACEN',
  `sucursal_almacen` int(11) NOT NULL COMMENT 'SUCURSAL ALMACEN'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT=' GUARDA DATOS DE ALMACENES';

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `des_almacen`, `status_almacen`, `sucursal_almacen`) VALUES
(1, 'ALMACEN PRINCIPAL', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administradores', '1', 1562778233),
('SuperSU', '2', 1563458506);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/admin/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1562771695, 1562771695),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1562771695, 1562771695),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1562771695, 1562771695),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1562771695, 1562771695),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1562771695, 1562771695),
('/admin/default/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/default/index', 2, NULL, NULL, NULL, 1562771695, 1562771695),
('/admin/menu/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/menu/create', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/menu/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/menu/update', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/menu/view', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/permission/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/permission/create', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/permission/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/permission/update', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/permission/view', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/role/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/role/assign', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/role/create', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/role/delete', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/role/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/role/remove', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/role/update', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/role/view', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/route/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/route/assign', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/route/create', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/route/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/route/remove', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/rule/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/rule/create', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/rule/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/rule/update', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/rule/view', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/activate', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/delete', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/login', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/logout', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/signup', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/admin/user/view', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/almacen/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/almacen/create', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/almacen/delete', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/almacen/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/almacen/update', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/almacen/view', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/cliente/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cliente/cliente-list', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cliente/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cliente/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cliente/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/cliente/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cliente/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cond-pago/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cond-pago/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cond-pago/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cond-pago/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cond-pago/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/cond-pago/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/debug/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/debug/default/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/debug/default/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/debug/default/view', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/debug/user/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/departamento/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/departamento/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/departamento/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/departamento/departamentos', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/departamento/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/departamento/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/departamento/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/distrito/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/distrito/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/distrito/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/distrito/distritos', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/distrito/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/distrito/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/distrito/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/empresa/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/empresa/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/empresa/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/empresa/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/empresa/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/empresa/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/gii/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/gii/default/*', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/gii/default/action', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/gii/default/diff', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/gii/default/index', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/gii/default/preview', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/gii/default/view', 2, NULL, NULL, NULL, 1562771696, 1562771696),
('/gridview/*', 2, NULL, NULL, NULL, 1562771695, 1562771695),
('/gridview/export/*', 2, NULL, NULL, NULL, 1562771695, 1562771695),
('/gridview/export/download', 2, NULL, NULL, NULL, 1562771695, 1562771695),
('/lista-precios/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/lista-precios/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/lista-precios/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/lista-precios/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/lista-precios/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/lista-precios/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/moneda/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/moneda/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/moneda/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/moneda/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/moneda/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/moneda/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pais/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pais/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pais/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pais/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pais/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pais/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido-detalle/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido-detalle/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido-detalle/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido-detalle/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido-detalle/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido-detalle/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido/pedido-rpt', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/pedido/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/producto/*', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/producto/create', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/producto/delete', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/producto/index', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/producto/product-price', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/producto/producto-list', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/producto/update', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/producto/view', 2, NULL, NULL, NULL, 1562771697, 1562771697),
('/proveedor/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/proveedor/create', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/proveedor/delete', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/proveedor/index', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/proveedor/update', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/proveedor/view', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/provincia/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/provincia/create', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/provincia/delete', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/provincia/index', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/provincia/provincias', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/provincia/update', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/provincia/view', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/about', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/add-admin', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/captcha', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/contact', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/error', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/index', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/login', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/logout', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/site/signup', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-listap/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-listap/create', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-listap/delete', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-listap/index', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-listap/update', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-listap/view', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-producto/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-producto/create', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-producto/delete', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-producto/index', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-producto/update', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-producto/view', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-proveedor/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-proveedor/create', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-proveedor/delete', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-proveedor/index', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-proveedor/update', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/tipo-proveedor/view', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/unidad-medida/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/unidad-medida/create', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/unidad-medida/delete', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/unidad-medida/index', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/unidad-medida/update', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/unidad-medida/view', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/vendedor/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/vendedor/create', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/vendedor/delete', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/vendedor/index', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/vendedor/update', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/vendedor/view', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/zona/*', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/zona/create', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/zona/delete', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/zona/index', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/zona/update', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('/zona/view', 2, NULL, NULL, NULL, 1562771698, 1562771698),
('Administradores', 1, NULL, NULL, NULL, 1562771725, 1563458419),
('SuperSU', 1, 'Super Administrador', NULL, NULL, 1563458274, 1563462877),
('Usuarios', 1, NULL, NULL, NULL, 1562772110, 1563458361);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Administradores', '/*'),
('Administradores', '/almacen/*'),
('Administradores', '/almacen/create'),
('Administradores', '/almacen/delete'),
('Administradores', '/almacen/index'),
('Administradores', '/almacen/update'),
('Administradores', '/almacen/view'),
('Administradores', '/cliente/*'),
('Administradores', '/cliente/cliente-list'),
('Administradores', '/cliente/create'),
('Administradores', '/cliente/delete'),
('Administradores', '/cliente/index'),
('Administradores', '/cliente/update'),
('Administradores', '/cliente/view'),
('Administradores', '/cond-pago/*'),
('Administradores', '/cond-pago/create'),
('Administradores', '/cond-pago/delete'),
('Administradores', '/cond-pago/index'),
('Administradores', '/cond-pago/update'),
('Administradores', '/cond-pago/view'),
('Administradores', '/debug/*'),
('Administradores', '/debug/default/*'),
('Administradores', '/debug/default/db-explain'),
('Administradores', '/debug/default/download-mail'),
('Administradores', '/debug/default/index'),
('Administradores', '/debug/default/toolbar'),
('Administradores', '/debug/default/view'),
('Administradores', '/debug/user/*'),
('Administradores', '/debug/user/reset-identity'),
('Administradores', '/debug/user/set-identity'),
('Administradores', '/departamento/*'),
('Administradores', '/departamento/create'),
('Administradores', '/departamento/delete'),
('Administradores', '/departamento/departamentos'),
('Administradores', '/departamento/index'),
('Administradores', '/departamento/update'),
('Administradores', '/departamento/view'),
('Administradores', '/distrito/*'),
('Administradores', '/distrito/create'),
('Administradores', '/distrito/delete'),
('Administradores', '/distrito/distritos'),
('Administradores', '/distrito/index'),
('Administradores', '/distrito/update'),
('Administradores', '/distrito/view'),
('Administradores', '/empresa/*'),
('Administradores', '/empresa/create'),
('Administradores', '/empresa/delete'),
('Administradores', '/empresa/index'),
('Administradores', '/empresa/update'),
('Administradores', '/empresa/view'),
('Administradores', '/gii/*'),
('Administradores', '/gii/default/*'),
('Administradores', '/gii/default/action'),
('Administradores', '/gii/default/diff'),
('Administradores', '/gii/default/index'),
('Administradores', '/gii/default/preview'),
('Administradores', '/gii/default/view'),
('Administradores', '/gridview/*'),
('Administradores', '/gridview/export/*'),
('Administradores', '/gridview/export/download'),
('Administradores', '/lista-precios/*'),
('Administradores', '/lista-precios/create'),
('Administradores', '/lista-precios/delete'),
('Administradores', '/lista-precios/index'),
('Administradores', '/lista-precios/update'),
('Administradores', '/lista-precios/view'),
('Administradores', '/moneda/*'),
('Administradores', '/moneda/create'),
('Administradores', '/moneda/delete'),
('Administradores', '/moneda/index'),
('Administradores', '/moneda/update'),
('Administradores', '/moneda/view'),
('Administradores', '/pais/*'),
('Administradores', '/pais/create'),
('Administradores', '/pais/delete'),
('Administradores', '/pais/index'),
('Administradores', '/pais/update'),
('Administradores', '/pais/view'),
('Administradores', '/pedido-detalle/*'),
('Administradores', '/pedido-detalle/create'),
('Administradores', '/pedido-detalle/delete'),
('Administradores', '/pedido-detalle/index'),
('Administradores', '/pedido-detalle/update'),
('Administradores', '/pedido-detalle/view'),
('Administradores', '/pedido/*'),
('Administradores', '/pedido/create'),
('Administradores', '/pedido/delete'),
('Administradores', '/pedido/index'),
('Administradores', '/pedido/pedido-rpt'),
('Administradores', '/pedido/update'),
('Administradores', '/pedido/view'),
('Administradores', '/producto/*'),
('Administradores', '/producto/create'),
('Administradores', '/producto/delete'),
('Administradores', '/producto/index'),
('Administradores', '/producto/product-price'),
('Administradores', '/producto/producto-list'),
('Administradores', '/producto/update'),
('Administradores', '/producto/view'),
('Administradores', '/proveedor/*'),
('Administradores', '/proveedor/create'),
('Administradores', '/proveedor/delete'),
('Administradores', '/proveedor/index'),
('Administradores', '/proveedor/update'),
('Administradores', '/proveedor/view'),
('Administradores', '/provincia/*'),
('Administradores', '/provincia/create'),
('Administradores', '/provincia/delete'),
('Administradores', '/provincia/index'),
('Administradores', '/provincia/provincias'),
('Administradores', '/provincia/update'),
('Administradores', '/provincia/view'),
('Administradores', '/site/*'),
('Administradores', '/site/about'),
('Administradores', '/site/add-admin'),
('Administradores', '/site/captcha'),
('Administradores', '/site/contact'),
('Administradores', '/site/error'),
('Administradores', '/site/index'),
('Administradores', '/site/login'),
('Administradores', '/site/logout'),
('Administradores', '/site/signup'),
('Administradores', '/tipo-listap/*'),
('Administradores', '/tipo-listap/create'),
('Administradores', '/tipo-listap/delete'),
('Administradores', '/tipo-listap/index'),
('Administradores', '/tipo-listap/update'),
('Administradores', '/tipo-listap/view'),
('Administradores', '/tipo-producto/*'),
('Administradores', '/tipo-producto/create'),
('Administradores', '/tipo-producto/delete'),
('Administradores', '/tipo-producto/index'),
('Administradores', '/tipo-producto/update'),
('Administradores', '/tipo-producto/view'),
('Administradores', '/tipo-proveedor/*'),
('Administradores', '/tipo-proveedor/create'),
('Administradores', '/tipo-proveedor/delete'),
('Administradores', '/tipo-proveedor/index'),
('Administradores', '/tipo-proveedor/update'),
('Administradores', '/tipo-proveedor/view'),
('Administradores', '/unidad-medida/*'),
('Administradores', '/unidad-medida/create'),
('Administradores', '/unidad-medida/delete'),
('Administradores', '/unidad-medida/index'),
('Administradores', '/unidad-medida/update'),
('Administradores', '/unidad-medida/view'),
('Administradores', '/vendedor/*'),
('Administradores', '/vendedor/create'),
('Administradores', '/vendedor/delete'),
('Administradores', '/vendedor/index'),
('Administradores', '/vendedor/update'),
('Administradores', '/vendedor/view'),
('Administradores', '/zona/*'),
('Administradores', '/zona/create'),
('Administradores', '/zona/delete'),
('Administradores', '/zona/index'),
('Administradores', '/zona/update'),
('Administradores', '/zona/view'),
('SuperSU', '/*'),
('SuperSU', '/admin/*'),
('SuperSU', '/admin/assignment/*'),
('SuperSU', '/admin/assignment/assign'),
('SuperSU', '/admin/assignment/index'),
('SuperSU', '/admin/assignment/revoke'),
('SuperSU', '/admin/assignment/view'),
('SuperSU', '/admin/default/*'),
('SuperSU', '/admin/default/index'),
('SuperSU', '/admin/menu/*'),
('SuperSU', '/admin/menu/create'),
('SuperSU', '/admin/menu/delete'),
('SuperSU', '/admin/menu/index'),
('SuperSU', '/admin/menu/update'),
('SuperSU', '/admin/menu/view'),
('SuperSU', '/admin/permission/*'),
('SuperSU', '/admin/permission/assign'),
('SuperSU', '/admin/permission/create'),
('SuperSU', '/admin/permission/delete'),
('SuperSU', '/admin/permission/index'),
('SuperSU', '/admin/permission/remove'),
('SuperSU', '/admin/permission/update'),
('SuperSU', '/admin/permission/view'),
('SuperSU', '/admin/role/*'),
('SuperSU', '/admin/role/assign'),
('SuperSU', '/admin/role/create'),
('SuperSU', '/admin/role/delete'),
('SuperSU', '/admin/role/index'),
('SuperSU', '/admin/role/remove'),
('SuperSU', '/admin/role/update'),
('SuperSU', '/admin/role/view'),
('SuperSU', '/admin/route/*'),
('SuperSU', '/admin/route/assign'),
('SuperSU', '/admin/route/create'),
('SuperSU', '/admin/route/index'),
('SuperSU', '/admin/route/refresh'),
('SuperSU', '/admin/route/remove'),
('SuperSU', '/admin/rule/*'),
('SuperSU', '/admin/rule/create'),
('SuperSU', '/admin/rule/delete'),
('SuperSU', '/admin/rule/index'),
('SuperSU', '/admin/rule/update'),
('SuperSU', '/admin/rule/view'),
('SuperSU', '/admin/user/*'),
('SuperSU', '/admin/user/activate'),
('SuperSU', '/admin/user/change-password'),
('SuperSU', '/admin/user/delete'),
('SuperSU', '/admin/user/index'),
('SuperSU', '/admin/user/login'),
('SuperSU', '/admin/user/logout'),
('SuperSU', '/admin/user/request-password-reset'),
('SuperSU', '/admin/user/reset-password'),
('SuperSU', '/admin/user/signup'),
('SuperSU', '/admin/user/view'),
('SuperSU', 'Administradores'),
('Usuarios', '/pedido/*'),
('Usuarios', '/pedido/create'),
('Usuarios', '/pedido/delete'),
('Usuarios', '/pedido/index'),
('Usuarios', '/pedido/pedido-rpt'),
('Usuarios', '/pedido/update'),
('Usuarios', '/pedido/view');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_clte` int(11) NOT NULL COMMENT 'ID UNICO',
  `dni_clte` varchar(20) NOT NULL COMMENT 'DNI CLIENTE',
  `ruc_clte` varchar(20) NOT NULL COMMENT 'RUC CLIENTE',
  `nombre_clte` varchar(150) NOT NULL COMMENT 'NOMBRE CLIENTE',
  `direcc_clte` text NOT NULL COMMENT 'DIRECCION CLIENTE',
  `pais_cte` int(11) NOT NULL COMMENT 'PAIS CLIENTE',
  `depto_cte` int(11) NOT NULL COMMENT 'DEPARTAMENTO CLIENTE',
  `provi_cte` int(11) NOT NULL COMMENT 'PROVINCIA CLIENTE',
  `dtto_clte` int(11) NOT NULL COMMENT 'DISTRITO CLIENTE',
  `tlf_ctle` varchar(100) NOT NULL COMMENT 'TELEFONO CLIENTE',
  `email_clte` varchar(200) NOT NULL COMMENT 'EMAIL CLIENTE',
  `vendedor_clte` int(11) NOT NULL COMMENT 'VENDEDOR CLIENTE',
  `estatus_ctle` int(11) NOT NULL COMMENT 'ESTATUS CLIENTE',
  `condp_clte` int(11) NOT NULL COMMENT 'CONDICION DE PAGO',
  `sucursal_clte` int(11) NOT NULL,
  `lista_clte` int(11) NOT NULL DEFAULT '0' COMMENT 'LISTA DE PRECIOS CLIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE CLIENTES';

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_clte`, `dni_clte`, `ruc_clte`, `nombre_clte`, `direcc_clte`, `pais_cte`, `depto_cte`, `provi_cte`, `dtto_clte`, `tlf_ctle`, `email_clte`, `vendedor_clte`, `estatus_ctle`, `condp_clte`, `sucursal_clte`, `lista_clte`) VALUES
(2, '', '20486261901', '3H&P IMSEL DIESEL S.A.C.                                    ', 'AV.CARLOS A.PESCHIERA 376   JUNIN - CHANCHAMAYO - CHANCHAMAYO              ', 241, 104, 12, 104, '985043588', '', 5, 1, 1, 1, 1),
(3, '', '20000147812', 'A-1 IMPORTACIONES - EDILBERTO REYNOSO B.                    ', 'JR.LOS PELITRES 2244 SJ.L                                                  ', 241, 216, 29, 217, '3876402//975392836 //*673729       ', '', 1, 1, 0, 1, 1),
(4, '', '20600417712', 'ACCESUR CENTER E.I.R.L.                                     ', 'JR.CARABAYA NRO.226 VICTORIA  PUNO - PUNO - PUNO                           ', 241, 216, 29, 217, '978030032', '', 1, 1, 0, 1, 1),
(5, '', '10225304535', 'ACENCIO CHACON PAULINA                                      ', 'JR. SANTA ISABEL NRO. 1558 URB. MIRAFLORES JUNIN - HUANCAYO - EL TAMBO     ', 241, 216, 29, 217, '933477936', '', 3, 1, 0, 1, 1),
(6, '', '', 'ADELAIDA SOLANO POVIS                                       ', 'PSJ.LOS AROS 149                                                           ', 241, 216, 29, 217, '325-1930/996088499/NEX 826*2104    ', '', 1, 1, 0, 1, 1),
(7, '', '10074859939', 'AGUILAR GONZALO FRANCISCO (PANCHITO)                        ', 'AV.IQUITOS #319-LA VICTORIA                                                ', 241, 216, 29, 217, '\"3307972, 422*4992, 833*0640        \"', '', 1, 1, 0, 1, 1),
(8, '', '10158556290', 'AGUIRRE VELASQUEZ MONICA DEL ROSARIO                        ', 'JR. LIMA NRO. 1290 LIMA - BARRANCA - BARRANCA                              ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(9, '', '10413944215', 'AHMAD ZIA MUNIR                                             ', 'AV.TUPAC AMARU #523 URB.LAS QUINTANAS-TRUJILLO-LA LIBERTAD                 ', 241, 216, 29, 217, '\"044-205672, *299875                \"', '', 1, 1, 0, 1, 1),
(10, '', '', 'AIDE TORRES                                                 ', 'AV.GERARDO UNGER 4533 PSTO 8-4  - SAN MARTIN DE PORRES-LIMA                ', 241, 216, 29, 217, '964553325 - 988324080      ', '', 2, 1, 0, 1, 1),
(11, '', '20600780582', 'AJL AUTOSPORT E.I.R.L.                                      ', 'AV.ATAHUALPA 165 P.J.JOSE OLAYA CAJAMARCA - CAJAMARCA - CAJAMARCA          ', 241, 216, 29, 217, '\"076361339 , # 727569 , 976554504   \"', 'LIDIA_FLOR1@HOTMAIL.COM       ', 1, 1, 0, 1, 1),
(12, '', '', 'AL AUTO LAMPS CENTER SRL                                    ', 'PROLONG.PARINACOCHAS 1499 //AV MEXICO 1311                                 ', 241, 216, 29, 217, '981023268//#948034577//948034577   ', 'VENTAS@ALCENTER.COM.PE//A', 1, 1, 0, 1, 1),
(13, '', '10004473278', 'ALAVE CHAMBILLA ROBERTO                                     ', 'AV.CIRCUNVALACION S/N INT.88 ASOC.MICAELA BASTIDAS TACNA-TACNA             ', 241, 216, 29, 217, '952821249', '', 1, 1, 0, 1, 1),
(14, '', '10279884707', 'ALCANTARA MONSEFU APOLINAR                                  ', 'AV. GERARDO UNGER NRO. 4725 INT.B URB.EL NARANJAL LIMA -INDEPENDENCIA      ', 241, 216, 29, 217, '994065528', '', 1, 1, 0, 1, 1),
(15, '', '10434649515', 'ALCANTARA MONSEFU JUANA BETTY                               ', 'AV.GERARDO UNGER 4513 INT.36 Z.I. URB.IND.NARANJAL-                        ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(16, '', '10230034830', 'ALDABE RIVERA JOEL ERMINIO                                  ', 'AV.JOSE CARLOS MARIATEGUI 317 INT.A JUNIN - HUANCAYO - EL TAMBO            ', 241, 216, 29, 217, '941977670 - 9505001515     ', '', 3, 1, 0, 1, 1),
(17, '               ', '', 'ALDANA CHAMBERGO DANICO RUBEN                               ', 'AV. AUGUSTO B. LEGUIA NRO. 1277-CHICLAYO                    ', 241, 216, 29, 217, '074-235354          ', '                                                  ', 1, 1, 0, 1, 1),
(18, '', '10167354730', 'ALDANA CHAMBERGO DANILO RUBEN                               ', 'AV. AUGUSTO B LEGUIA # 1229 URB.SAN LORENZO LAMBAYEQUE-CHICLAYO            ', 241, 216, 29, 217, '998953934', '', 2, 1, 0, 1, 1),
(19, '               ', '10167016133', 'ALDANA CHAMBERGO WILLE', 'AV. AUGUSTO B LEGUIA NRO. 1199 URB. SAN LORENZO - LAMBAYEQUE', 241, 216, 29, 217, '', '                                                  ', 2, 1, 0, 1, 1),
(20, '', '20131543337', 'ALMACENES SAN CARLOS SRL                                    ', 'AV. GONZALES PRADA #901 URB. EL SOL-TRUJILLO-LA LIBERTAD                   ', 241, 216, 29, 217, '044-243915                         ', '', 1, 1, 0, 1, 1),
(21, '', '20561102679', 'ALMACENES TAIWAN IMPORT E.I.R.L.                            ', 'AV. FRANCISCO CUNEO #1035 URB.PATAZCA LAMBAYEQUE-CHICLAYO                  ', 241, 216, 29, 217, '979114523', '', 2, 1, 0, 1, 1),
(22, '', '10485178401', 'ALVA MENDOZA ANGIE JIANY                                    ', 'AV. OLLANTA HUMALA MZA. C LOTE. 10 A.H. 3 DE MAYO JUNIN - CHANCHAMAYO      ', 241, 216, 29, 217, '924299737', '', 3, 1, 0, 1, 1),
(23, '', '10328289542', 'ALVARADO RIVAS TIMOTEO OSWALDO                              ', 'AV. PARDO NRO. 1727 P.J. MIRAFLORES BAJO-CHIMBOTE                          ', 241, 216, 29, 217, '998392689 /043-341639              ', '', 1, 1, 0, 1, 1),
(24, '', '10225029313', 'ANDRADE MORALES MARIA DEL CARMEN                            ', '\"JR.HERMILIO VALDIZAN #137, HUANUCO - HUANUCO                               \"', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(25, '', '10224728188', 'ANDRADE MORALES PRIMITIVA JULIA                             ', 'JR. MAYRO NRO. 901 HUANUCO - HUANUCO                                       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(26, '', '10321095823', 'ANGELES CIRIACO OLINDA SOLEDAD                              ', 'AV.V.R.HAYA DE LA TORRE #1609 AH.MIRAFLORES BAJO ANCASH-CHIMBOTE           ', 241, 216, 29, 217, '984066800 // 043353612             ', '', 1, 1, 0, 1, 1),
(27, '', '10210729700', 'ANGLAS BARTOLO LORENZA BRIGIDA                              ', 'AV.FRAY JERONIMO JIMENEZ 851 URB.SAN CARLOS JUNIN -CHANCHAMAYO             ', 241, 216, 29, 217, '960996677 - 964480626     ', '', 1, 1, 0, 1, 1),
(28, '', '20551344992', 'ANIBAL ADVIENTO SUAREZ REYNA E.I.R.L.                       ', 'UCV 177 MZA.LT. 4 P.J. HUAYCAN ZONA N LIMA - LIMA - ATE                    ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(29, '', '10421759427', 'ANTARA GONZALES CECILIA MAGDALENA                           ', 'AV.CIRCUNV.TUPAC AMARU #135-CHAUPIMARCA -CERRO DE PASCO                    ', 241, 216, 29, 217, '#999630350                         ', '', 1, 1, 0, 1, 1),
(30, '', '', 'ANTONIA TIPULA TIPULA                                       ', 'AV.SIMON BOLIVAR 1445-BARRIO PORTEÑO                                       ', 241, 216, 29, 217, '962866469', '', 1, 1, 0, 1, 1),
(31, '', '10426675451', 'AÑAMURO BENAVENTE BRAULIO                                   ', 'PAB.B TDA NRO.B5 CC LIBERTAD-ASOC.JEBES PUNO - SAN ROMAN - JULIACA         ', 241, 216, 29, 217, '963970089', '', 1, 1, 0, 1, 1),
(32, '', '10324080070', 'APARICIO MAZA DE ALVA VIOLETA LUZ                           ', 'CAR.CENTRAL S.N BARR.LA ESPERANZA ANCASH- HUAYLAS - CARAZ                  ', 241, 216, 29, 217, '588286 - #901749        ', 'REPUESTOS_JARUMI@HOTMAIL.COM  ', 1, 1, 0, 1, 1),
(33, '', '10472480877', 'APAZA PAREDES YOHNY                                         ', 'JR. CARABAYA NRO. 104 (BARRIO LAS MERCEDES) PUNO - SAN ROMAN - JULIACA     ', 241, 216, 29, 217, '990066430', '', 1, 1, 0, 1, 1),
(34, '', '10091005331', 'ARANDA REYES HILARIO                                        ', 'AV.PROCERES DE LA INDEPENDENCIA 2288 URB.SAN HILARION ETAPA UNO-SJL        ', 241, 216, 29, 217, '01387-2011     ', '', 1, 1, 0, 1, 1),
(35, '', '10178699356', 'ARAUJO CORONEL JOSEFINA TERESA                              ', 'AV. AMERICA SUR NRO. 2156 URB. SANTA MARIA-TRUJILLO                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(36, '', '10414488078', 'ARCA SAL Y ROSAS EMERSON                                    ', 'AV.PACHACUTEC 3417 ZONA HOGAR POLICIAL LIMA -VILLA MARIA DEL TRIUNFO       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(37, '', '10441707911', 'ARCA SAL Y ROSAS ROSANGELA                                  ', 'AV.SEPARAD INDUSTRI MZM\' LTE50 ASOC.FERROVIARIO 4TA ET-LIMA-V.SALVADOR     ', 241, 216, 29, 217, '941399224', '', 1, 1, 0, 1, 1),
(38, '', '10409255944', 'ARENAS PARIONA FOOSTHER                                     ', 'NRO.SN URB.JOSE MARIA ARGUEDAS APURIMAC - ANDAHUAYLAS - ANDAHUAYLAS        ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(39, '', '10012855139', 'ARPASI PUMA WENCESLAO                                       ', 'JR. RICARDO PALMA NRO. 218 BARRIO MAGISTERIAL-PUNO                         ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(40, '', '', 'ASIS GIRALDO CARLOS EMILIO                                  ', 'JR.FRANCISCO DE ARAOS 304 BARR CENT.ESTE ANCASH - HUARAZ-INDEPENDENCIA     ', 241, 216, 29, 217, '9433848414', '', 1, 1, 0, 1, 1),
(41, '', '10457508099', 'ATALAYA LINARES ERIBERTO                                    ', 'AV.AUGUSTO B LEGUIA 1260 URB.SAN LORENZO LAMBAYEQUE-CHICLAYO-JOSE LEONARDO ', 241, 216, 29, 217, '\"*0222771, 975697143                \"', '', 1, 1, 0, 1, 1),
(42, '', '10296050798', 'AUCAHUAQUI CAQUIAYA JAVIER PEDRO                            ', 'VIA VARIANTE DE UCHUMAYOKM. 3 INT.10 P.J.SEMI RURAL PACHACUTEC             ', 241, 216, 29, 217, '977215081', 'JAC.ELECTRICOS@GMAIL.COM ', 1, 1, 0, 1, 1),
(43, '', '10072688266', 'AUCCASI HUARIPAUCAR SERAPIO ULISES                          ', 'MZA.F LT.14 URB.LAS FLORES 78 (ALT PARADERO 12 DE PROCERES) S.J.L          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(44, '21478400', '', 'AUGUSTO                                                     ', 'VILLA                                                                      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(45, '', '20517619362', 'AUTO LAMPS CENTER S.R.L.                                    ', 'AV. IQUITOS NRO. 574 LIMA - LIMA - LA VICTORIA                             ', 241, 216, 29, 217, '4337015-946548578      ', '', 1, 1, 0, 1, 1),
(46, '', '20555173394', 'AUTO PARTES SAGOVA S.R.L.                                   ', 'AV. GERARDO UNGER NRO. 4797 URB. EL NARANJAL - SAN MARTIN DE PORRES        ', 241, 216, 29, 217, '994223130', '', 2, 1, 0, 1, 1),
(47, '', '20492163351', 'AUTO PARTS IMPORT PERU E.I.R.L                              ', 'AV.MANCO CAPAC MZ.BS LT9D COO.JICAMARCA  S.J DE LURIGANCHO                 ', 241, 216, 29, 217, '\"3092179, #941897280                \"', '', 1, 1, 0, 1, 1),
(48, '               ', '20403024849', 'AUTO PART\'S MELIRIS SRL                                     ', 'AV.PARDO 1144 P.J. MIRAMAR BAJO - ANCASH SANTA CHIMBOTE     ', 241, 216, 29, 217, '                    ', '                                                  ', 2, 1, 0, 1, 1),
(49, '', '20406512178', 'AUTOACCESORIOS LOS GEMELOS S.A.C.                           ', 'JR. TUMBES NRO. 1772 MANCO CAPAC PUNO - SAN ROMAN - JULIACA                ', 241, 216, 29, 217, '946403964 - 051328255-951502350    ', '', 1, 1, 0, 1, 1),
(50, '', '20568605501', 'AUTOBOUTIQUE LEO CUETO EIRL                                 ', 'AV.PESCHIERA NRO. S/N URB.LA MERCED JUNIN - CHANCHAMAYO - CHANCHAMAYO      ', 241, 216, 29, 217, '954085886', '', 1, 1, 0, 1, 1),
(51, '', '20565841964', 'AUTOBUS MINIVAN - PARTS E.I.R.L                             ', 'AV. MEXICO NRO. 1329 LIMA - LIMA - LA VICTORIA                             ', 241, 216, 29, 217, '936826260', '', 3, 1, 0, 1, 1),
(52, '', '20570848985', 'AUTOMANIA PERU S.A.C.                                       ', 'JR. SUCRE NRO. 436 BR LA FLORIDA CAJAMARCA - CAJAMARCA - CAJAMARCA         ', 241, 216, 29, 217, '9765744 97    ', '', 2, 1, 0, 1, 1),
(53, '', '20481099936', 'AUTOMOTORES TRUJILLO E.I.R.L.                               ', 'UNION NRO. 1977 URB. CHIMU-TRUJILLO-LA LIBERTAD                            ', 241, 216, 29, 217, '\"044-211839, #664345                \"', '', 1, 1, 0, 1, 1),
(54, '', '20526921217', 'AUTOMOTRIZ DELTA EIRL                                       ', 'MZA. D LOTE. 7 APV. CONSTRUCTORES SAN JERONIMO-CUSCO                       ', 241, 216, 29, 217, '273603', '', 1, 1, 0, 1, 1),
(55, '', '20481339911', 'AUTOMOTRIZ ROYAL E.I.R.L.                                   ', 'AV.PERU #376 BARR LA INTENDENCIA-TRUJILLO-LA LIBERTAD                      ', 241, 216, 29, 217, '\"044-294488, *200013                \"', '', 1, 1, 0, 1, 1),
(56, '', '20602271456', 'AUTOMUNDO REPUESTOS & ACCESORIOS S.A.                       ', 'CAR.CENTRAL NRO.SN BAR.COCHAHUAIN ANCASH - YUNGAY - YUNGAY                 ', 241, 216, 29, 217, '                                   ', 'MULTISERVICIOS YUNGAI     ', 1, 1, 0, 1, 1),
(57, '', '', 'AUTOPARTES & ACCESORIOS GOICO CAR SRL                       ', 'AV.GERARDO UNGER 4729 URB.EL NARANJAL                                      ', 241, 216, 29, 217, '5299742/981141098/981141133        ', '', 1, 1, 0, 1, 1),
(58, '', '20601720761', 'AUTOPARTES & SERVICIOS LIZ S.A.C.                           ', 'JR.LIBERTAD 1029  PUNO-SAN ROMAN-JULIACA                                   ', 241, 216, 29, 217, '995999934', '', 1, 1, 0, 1, 1),
(59, '', '20570503651', 'AUTOPARTES BOLAÑOS E.I.R.L.                                 ', 'JR.SUCRE #401 BR LA FLORIDA CAJAMARCA                                      ', 241, 216, 29, 217, '976100205', '', 2, 1, 0, 1, 1),
(60, '', '', 'AUTOPARTES CHABELITA-ISABEL CCAMA ALANOCA                   ', 'LA ROTONDA NUEVO SUCRE PST 138-TACNA                                       ', 241, 216, 29, 217, '952626813', '', 1, 1, 0, 1, 1),
(61, '', '20521578891', 'AUTOPARTES CUADROS E.I.R.L.                                 ', 'PJ.LOS AROS 181 URB.SAN JACINTO LIMA - LIMA - SAN LUIS                     ', 241, 216, 29, 217, '14736627 - 998176422', 'AUTOPARTESCUADROSEIRL@HOT', 2, 1, 0, 1, 1),
(62, '', '20602251978', 'AUTOPARTES SANTA FE CAR EMPRESA INDIVIDUAL DE RESPONSABILIDA', 'JR. LIBERTAD NRO. 876 PUNO - SAN ROMAN - JULIACA                           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(63, '', '20486849127', 'AUTOPARTES SEÑOR DE MURUHUAY E.I.R.L                        ', 'JR. JUNIN NRO. 747 -JUNIN - CHANCHAMAYO - PICHANAQUI                       ', 241, 216, 29, 217, '064384201-954800023    ', '', 3, 1, 0, 1, 1),
(64, '', '20539716795', 'AUTOPARTES SINDY S.A.C.                                     ', 'AV.PERU #905 URB.LA INTENDENCIA -TRUJILLO-LA LIBERTAD                      ', 241, 216, 29, 217, '*271265                            ', '', 1, 1, 0, 1, 1),
(65, '', '20544475747', 'AUTOPARTES VICTOR HUGO S.A.C.                               ', 'PJ. LOS AROS NRO. 185 URB. SAN JACINTO LIMA - LIMA - SAN LUIS              ', 241, 216, 29, 217, '947058523', '', 1, 1, 0, 1, 1),
(66, '', '20602115667', 'AUTOPARTES VIMED E.I.R.L.                                   ', 'PUENTE ARNAO NRO. 216 AREQUIPA - AREQUIPA - MIRAFLORES                     ', 241, 216, 29, 217, '910492904', '', 3, 1, 0, 1, 1),
(67, '', '20601242886', 'AUTOPARTES Y ACCESORIOS MI VICKY E.I.R.L.                   ', 'JR.SUCRE 473A BAR.LA FLORIDA CAJAMARCA-CAJAMARCA-CAJAMARCA                 ', 241, 216, 29, 217, '995436638', '', 2, 1, 0, 1, 1),
(68, '', '20449373015', 'AUTOPARTES Y LUBRICANTES S.C.R.L                            ', 'MZA.E LT 03 INT.53 AS.CO.MI.CRISTINA VILDOSO TACNA - TACNA - TACNA         ', 241, 216, 29, 217, '976106030', '', 5, 1, 0, 1, 1),
(69, '', '20600260805', 'AUTOPARTES Y SERVICIOS AGUA BLANCA E.I.R.L.                 ', 'JR.SUCRE 395 INT.A BARR.LA FLORIDA CAJAMARCA -CAJAMARCA -CAJAMARCA         ', 241, 216, 29, 217, '965674451', 'JUVER', 2, 1, 0, 1, 1),
(70, '', '20601834660', 'AUTOPARTES Y TRASNPORTES VICPAREDES SCRL                    ', 'CAL.CAMINO REAL NRO.12-1 APV. TINGO CUSCO - CUSCO - SAN JERONIMO           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(71, '', '20481609136', 'AUTOREPUESTOS & FERRETERIA SANTO TOMAS SAC                  ', 'CALLE.GUZMAN BARRON 264.URB.PALERMO-TRUJILLO                               ', 241, 216, 29, 217, '988019288', '', 2, 1, 0, 1, 1),
(72, '', '20555564822', 'AYR HUMBOLT E.I.R.L.                                        ', 'JR. HUMBOLDT NRO. 346 LIMA - LIMA - LA VICTORIA                            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(73, '', '10414281121', 'BACA CARPIO CARMEN LUISA                                    ', 'AV.SESQUICENTENARIO #379 APURIMAC-ANDAHUAYLAS                              ', 241, 216, 29, 217, '*989507                            ', '', 1, 1, 0, 1, 1),
(74, '', '10200365157', '\"BALBIN GALVAN, FREDY HERMOGENES                             \"', 'JR.MIGUEL GRAU #507  JUNIN - SATIPO                                        ', 241, 216, 29, 217, '#484837     ', '', 3, 1, 0, 1, 1),
(75, '', '10035729106', 'BARBA SANCHEZ MARTHA DIDIA                                  ', 'MZA.E LT.09 A.H.15 DE MARZO (AV. EL PORVENIR) PIURA- SULLANA -SULLANA      ', 241, 216, 29, 217, '#951587429     ', '', 1, 1, 0, 1, 1),
(76, '', '10454538817', 'BARZOLA LEYVA GUSTAVO                                       ', 'PRO.JUAN S. ATAHUALPA NRO. 279 SEC. TARMA   JUNIN - TARMA - TARMA          ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(77, '', '10465042481', 'BARZOLA LEYVA LILIANA BEATRIZ                               ', 'PROL.JUAN S.ATAHUALPA 279 JUNIN - TARMA - TARMA                            ', 241, 216, 29, 217, '990434159 - 964091027      ', '', 1, 1, 0, 1, 1),
(78, '', '10074728672', 'BAYES QUINTO LUIS ALBERTO                                   ', 'MEJICO NRO. 1679 LIMA - LIMA - LA VICTORIA                                 ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(79, '10405059', '', 'BEDIA BAZAN IRMA                                            ', 'AV.VENEZUELA MZA.C LT.12 APURIMAC - ABANCAY - ABANCAY                      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(80, '', '10256375147', 'BELLIDO COLOS EMILIA                                        ', 'AV.PROCERES DE LA INDEP.2280 URB. SAN HILARION-LIMA-LIMA-S.J.L             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(81, '', '20600739400', 'BEN 10 REMISSE E.I.R.L.                                     ', 'CAL.CORRIENTES NRO. 121 URB. EL CARMEN LIMA - LIMA - SURQUILLO             ', 241, 216, 29, 217, '949574375-977176346       ', '', 1, 1, 0, 1, 1),
(82, '', '10164365382', 'BENEL VIDAURRE ARMANDO ARIGO                                ', 'AV. AUGUSTO B. LEGUIA NRO. 958-CHICLAYO                                    ', 241, 216, 29, 217, '074-256436                         ', '', 1, 1, 0, 1, 1),
(83, '', '10406627379', 'BERRIOS BERMUDEZ MARISOL                                    ', 'MLC.ALOMIA ROBLES 713 INT.A CENT C.U.HUANUCO-HUANUCO - HUANUCO             ', 241, 216, 29, 217, '987001548-957971582      ', '', 1, 1, 0, 1, 1),
(84, '', '20495843778', 'BETOSCAR SERVIS EIRL                                        ', 'AV San Martin de Porres # 669 - CAJAMARCA                                  ', 241, 216, 29, 217, '\"963719333 , 976862513 , 046343914  \"', '', 1, 1, 0, 1, 1),
(85, '', '10249903677', 'BOLIVAR SICCOS FRANCISCA                                    ', 'AV. MANCO INCA # 300 WANCHAQ- CUSCO                                        ', 241, 216, 29, 217, '\"084784976, 974260627,976300291     \"', '', 1, 1, 0, 1, 1),
(86, '', '10244952084', 'BOLIVAR SICCOS TEODORO                                      ', 'AV. MANCO INCA # 307 WANCHAQ- CUSCO                                        ', 241, 216, 29, 217, '\"084784976, 974260627,976300291     \"', '', 3, 1, 0, 1, 1),
(87, '', '10060105923', 'BOLIVAR SICCOS VICTORIA                                     ', 'AV. MANCO CCAPAC NRO. 419 (ALT. REG. PUBLICOS) CUSCO - CUSCO - WANCHAQ     ', 241, 216, 29, 217, '976300291', '', 1, 1, 0, 1, 1),
(88, '', '10452873368', 'BORCIC AGUIRRE LEYLA DANIELA                                ', 'JR. LIMA # 1286 LIMA - BARRANCA - BARRANCA                                 ', 241, 216, 29, 217, '2355483', '', 1, 1, 0, 1, 1),
(89, '', '20601069483', 'BRAVAZO CAR E.I.R.L.                                        ', 'AV. MESONES MURO NRO. 1318 SEC. NUEVO HORIZONTE CAJAMARCA - JAEN           ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(90, '', '10179007181', 'BRICENO CALDERON CARLOS                                     ', 'AV.FEDERICO VILLAREAL #200-TRUJILLO-LA LIBERTAD                            ', 241, 216, 29, 217, '044-9904093                        ', '', 1, 1, 0, 1, 1),
(91, '', '10407943720', 'BUENDIA SUBELETE ELENA                                      ', 'AV. GERARDO UNGER NRO. 4513 INT. 78 URB. INDUSTRIAL NARANJAL  SMP          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(92, '', '10165875325', 'BURGA BUSTAMANTE WALTER SERGIO                              ', 'AV. TODOS LOS SANTOS NRO. 939 CAJAMARCA - CHOTA - CHOTA                    ', 241, 216, 29, 217, '976708707', '', 1, 1, 0, 1, 1),
(93, '', '10443653991', 'BUSTAMANTE MARRUFO MARCOS ANTONIO                           ', 'AV.TODOS LOS SANTOS #636 CHOTA-CAJAMARCA-CAJAMARCA                         ', 241, 216, 29, 217, '938589217', '', 2, 1, 0, 1, 1),
(94, '', '10438871662', 'CABRERA BEJARANO CLAUDIA VANESSA                            ', 'AV.PERU #935-LA INTENDENCIA-TRUJILLO-LA LIBERTAD                           ', 241, 216, 29, 217, '\"044-673540, *269506                \"', 'MARIABEJARANOTAFUR@HOTMAI', 1, 1, 0, 1, 1),
(95, '', '10466071256', 'CABRERA BEJARANO OSWALDO ALONSO                             ', 'AV.VALLEJO #1662 URB.PROLONGACION-TRUJILLO-LA LIBERTAD                     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(96, '', '10424607954', 'CACERES QUISPE ALICIA                                       ', 'CAL. CENTENARIO NRO. 910 INT. 2 C.C. CENTENARIO TACNA - TACNA - TACNA      ', 241, 216, 29, 217, '988100904', '', 1, 1, 0, 1, 1),
(97, '', '20489724970', 'CAEISA S.C.R.L                                              ', 'MLC. DANIAL ALOMIA ROBLES #567 HUANUCO - HUANUCO                           ', 241, 216, 29, 217, '962087592', '', 3, 1, 0, 1, 1),
(98, '', '10101225777', 'CAHUA CAHUA MARUJA DORIS                                    ', 'AV. PROCERES DE LA INDEPENDE. NRO. 5551  SJL                               ', 241, 216, 29, 217, '3920883', '', 1, 1, 0, 1, 1),
(99, '', '10005202341', 'CAHUAYA MAMANI RICARDO                                      ', 'AV.J.BASADRE CON P MELENDEZ S/N INT.AS CC.VILDOSO INT22-23-TACNA-TACNA     ', 241, 216, 29, 217, '952293919', '', 3, 1, 0, 1, 1),
(100, '', '10701840891', 'CALIZAYA CANAHUIRI ROCIO DEL PILAR                          ', 'JR.LAMBAYEQUE 473A  PUNO-JULIACA // GERONIMO CALIZAYA                      ', 241, 216, 29, 217, '950834377', 'SUDAMERICA26@HOTMAIL.COM ', 1, 1, 0, 1, 1),
(101, '', '10295680518', 'CALLATA TICONA JULIO ALFREDO                                ', 'CAL.PUENTE ARNAO NRO. 220 AREQUIPA - AREQUIPA - MIRAFLORES                 ', 241, 216, 29, 217, '996868008', '', 1, 1, 0, 1, 1),
(102, '', '10435029928', 'CALSINA NAVARRO REGINA ANASTACIA                            ', 'CAR.PANAMERICANA S/N SANTA CRUZ DE ACCOTA-CUSCO-CANCHIS-SICUANI            ', 241, 216, 29, 217, '953535355-950977649-984641481     ', '', 3, 1, 0, 1, 1),
(103, '', '10181331921', 'CANCHUCAJA BONARRIBA ANA PATRICIA                           ', 'AV.CONDORCANQUI #1089 LA ESPERANZA-TRUJILLO-LA LIBERTAD                    ', 241, 216, 29, 217, '\"*516968, #990426885                \"', '', 1, 1, 0, 1, 1),
(104, '', '10404531595', 'CANCHUCAJA BONARRIBA KARLA NOEMI                            ', 'AV.CONDORCANQUI #1089-LA ESPERANZA-TRUJILLO-LA LIBERTAD                    ', 241, 216, 29, 217, '\"990426885,*516968                  \"', '', 1, 1, 0, 1, 1),
(105, '', '', 'CANDIOTTI ROJAS MARICELA                                    ', 'AV. GERARDO UNGER URB.EL NARANJAL LIMA -INDEPENDENCIA                      ', 241, 216, 29, 217, '992423799-967643967      ', '', 1, 1, 0, 1, 1),
(106, '', '20495709532', 'CAR AUDIO E.I.R.L                                           ', 'AV.VIA DE EVITAMIENTO SUR #721 -  CAJAMARCA                                ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(107, '', '10804940117', 'CARBAJAL SANCHEZ CESAR AUGUSTO                              ', 'AV. CONDORCANQUI#2552 PARTE ALTA-LA ESPERANZA-TRUJILLO                     ', 241, 216, 29, 217, '414309', '', 1, 1, 0, 1, 1),
(108, '', '10074785951', 'CARBONELL VILLANUEVA CESAR JULIO                            ', 'AV.GERARDO UNGER 4565 INT.14 URB.IND.EL NARANJAL LIMA-SMP                  ', 241, 216, 29, 217, '947289072', '', 1, 1, 0, 1, 1),
(109, '', '20485978233', 'CARGO 1 S.A.                                                ', 'AV.HUANCAVELICA NRO.2868 JUNIN - HUANCAYO - EL TAMBO                       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(110, '', '', 'CARLOS MIGUEL APOLINAR                                      ', 'JR.LAS MICAS 149 SAN JUAN DE LURIGANCHO                                    ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(111, '', '20439807181', 'CARPAMA S.R.L.                                              ', 'AV.AMERICA SUR #1289 URB.STO DOMINGUITO-TRUJILLO-LA LIBERTAD               ', 241, 216, 29, 217, '\"044-291891,044251802               \"', '', 1, 1, 0, 1, 1),
(112, '', '10423758789', 'CARRION TIMANA DE LEON YENY MARIBEL                         ', 'JR. SUCRE  306 BR LA FLORIDA CAJAMARCA - CAJAMARCA                         ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(113, '', '20531750315', 'CASA DE REPUESTOS MUCHIK S.A.C.                             ', 'AV. V. R. HAYA DE LA TORRE NRO. 1870 A.H. MIRAFLORES CHIMBOTE              ', 241, 216, 29, 217, '043-323233                         ', '', 1, 1, 0, 1, 1),
(114, '', '10448322641', 'CASAS MAXIMILIANO KELLY ROSARIO                             ', 'AV.MARIATEGUI 287 (ALT JR STA ISABEL.)JUNIN-HUANCAYO-EL TAMBO              ', 241, 216, 29, 217, '981553755-979309132', '', 1, 1, 0, 1, 1),
(115, '', '10101665203', 'CASTAÑEDA ALARCON MARY LUZ                                  ', 'G UNGER NRO. 4513 NARANJAL (PUESTO68-69-CENTRO COMERCIAL RODEO I) LIMA     ', 241, 216, 29, 217, '998311109', '', 1, 1, 0, 1, 1),
(116, '', '10200489794', 'CASTAÑEDA ALARCON YANSI DORIS                               ', 'AV.GERARDO UNGER 4513 URB.INDUSTRIAL NARANJAL-S.M.P-LIMA                   ', 241, 216, 29, 217, '998311109', '', 2, 1, 0, 1, 1),
(117, '', '', 'CASTILLO CHUICA MAYRA                                       ', 'LIMA / LA CINCUENTA                                                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(118, '', '10411563559', 'CASTRO DE LA CRUZ GISELLA                                   ', 'AV.CESAR VALLEJO #823 ARANJUEZ-TRUJILLO-LA LIBERTAD                        ', 241, 216, 29, 217, '\"044-231843, *257964                \"', '', 1, 1, 0, 1, 1),
(119, '', '10435249057', 'CAYLLAHUA CASTRO ZENAIDA MERY LUZ                           ', 'CAL. PUENTE ARNAO #245 MIRAFLORES - AREQUIPA                               ', 241, 216, 29, 217, '\"RPC:973695269,#958501515           \"', '', 3, 1, 0, 1, 1),
(120, '', '10418910726', 'CAYSAHUANA MEZA ELENA NOLVERTA                              ', 'SECTOR 2 BAR 2 MZA. Z LOTE. 15 AGR PACHACAMAC IV ETAPA                     ', 241, 216, 29, 217, '944774178-994716754      ', '', 2, 1, 0, 1, 1),
(121, '', '10450337906', 'CELESTINO MORALES CONNIE FRANCIS                            ', 'AV. MARIATEGUI NRO. 330 INT. 21  JUNIN - HUANCAYO - EL TAMBO               ', 241, 216, 29, 217, '964542806-947470303      ', '', 3, 1, 0, 1, 1),
(122, '', '10410741658', 'CERCEDO VIVIAN HECTOR DIONEL                                ', 'AV.UNIVERSITARIA 2521 URB.CAYHUAYNA HUANUCO - HUANUCO - PILLCO MARCA       ', 241, 216, 29, 217, '962644454', '', 1, 1, 0, 1, 1),
(123, '', '10094812203', 'CERNA CELESTINO KATTY MAGNA                                 ', 'AV.GERARDO UNGER 4517 INT.42 LIMA - LIMA - INDEPENDENCIA                   ', 241, 216, 29, 217, '981581092', '', 2, 1, 0, 1, 1),
(124, '', '10742081007', 'CHACON HUAYAPA MAURICIO ALFREDO                             ', 'CAL.PUNO # 505 MIRAFLORES-AREQUIPA                                         ', 241, 216, 29, 217, '\"969838252,   054696987             \"', '', 1, 1, 0, 1, 1),
(125, '', '10013395743', 'CHAMBI CHACHAQUE AURELIA                                    ', 'AV.JORGE B.GROHOMAN #S/N INT.06 ASOC.CRISTINA VILDOSO-TACNA - TACNA        ', 241, 216, 29, 217, '952293919-943262000                ', '', 3, 1, 0, 1, 1),
(126, '', '10406650222', 'CHAMBI CHACHAQUE NESTOR RUBEN                               ', 'MZA. M LOTE. 22 ASOC.RAMON COPAJA TACNA - TACNA - ALTO DE LA ALIANZA       ', 241, 216, 29, 217, '952257138', '', 1, 1, 0, 1, 1),
(127, '', '10805318037', 'CHAMBI CHACHAQUE RUFINA                                     ', 'AV.JORGE BASADRE PSTO 41-42 NRO ASOC COM CRISTINA VILDOSO-TACNA            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(128, '', '10446289051', 'CHAMBILLA CALIZAYA VALERIA MAURA                            ', 'JR. LAMBAYEQUE NRO. 473SAN ROMAN - JULIACA                                 ', 241, 216, 29, 217, '950834377', '', 1, 1, 0, 1, 1),
(129, '', '10438085403', '\"CHAMBILLA VELASQUEZ, FREDY HERNAN                           \"', 'JR. CARABAYA #208 PORTEÑO-PUNO                                             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(130, '', '', 'CHANCHAMAYO                                                 ', 'PROCERES                                                                   ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(131, '', '10407282944', 'CHAUCA FIGUEROA YAJSEELITA LIDIA                            ', 'JR FRANCISCO BOLOGNESI  143 URB ROSAS PAMPA ANCASH - HUARAZ - HUARAZ       ', 241, 216, 29, 217, '970030556', '', 1, 1, 0, 1, 1),
(132, '', '10458895665', 'CHAVEZ ESPIRITU YERRI FELIX                                 ', 'UVC 7 LOTE. 2 A.H. HUAYCAN ZONA F                                          ', 241, 216, 29, 217, '\"3573308, 3533798-CHARLY            \"', '', 1, 1, 0, 1, 1),
(133, '', '10180907331', 'CHAVEZ GARCIA JOHN FRANK                                    ', 'CAL.PUERTO ARGENTINO MZA.D LT12-EL PALOMAR-TRUJILLO-LA LIBERTAD            ', 241, 216, 29, 217, '\"948113540, *666061                 \"', '', 1, 1, 0, 1, 1),
(134, '', '10463856392', 'CHIPANA QUINTO EDGAR JOSEPH                                 ', 'AV.MARIATEGUI 330 JUNIN - HUANCAYO - EL TAMBO                              ', 241, 216, 29, 217, '951530013', '', 1, 1, 0, 1, 1),
(135, '', '10074020254', 'CHOQUE CUTIPA HUMBERTO VALERIANO                            ', 'AV. CALCA 107 COO.27 DE ABRIL  LIMA-LIMA-ATE                               ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(136, '', '10422940320', 'CHOQUEHUANCA CHAMBI WILBER                                  ', 'JR.TUPAC AMARU 404 (ESQUINA CON AV. SIMON BOLIVAR) PUNO - PUNO - PUNO      ', 241, 216, 29, 217, '950869648', '', 1, 1, 0, 1, 1),
(137, '', '10416077342', 'CHUA CHAVEZ ANDRES                                          ', 'MZA.C LOTE.24 URB. AEROPUERTO II ETAPA PUNO - SAN ROMAN - JULIACA          ', 241, 216, 29, 217, '974228953-951006291      ', '', 1, 1, 0, 1, 1),
(138, '', '10428942880', 'CHURASACARI SAIRA WILLIAM                                   ', 'AV.FERNANDO LEON DE VIVERO MZ.A LT3 ICA - ICA - ICA                        ', 241, 216, 29, 217, '956320032', '', 1, 1, 0, 1, 1),
(139, '', '20565421248', 'CIAC DEL PERU E.I.R.L.                                      ', '\"CAL.SANTA NICERATA NRO. 187 URB. 3RA,ETAPA PANDO LIMA - LIMA - LIMA        \"', 241, 216, 29, 217, '999129921-5644749       ', 'CIACDELPERU@GMAIL.COM         ', 1, 1, 0, 1, 1),
(140, '', '10419846967', 'CIEZA ROJAS ALIGS                                           ', 'CAL.LOS TALADROS 228 INT.4 URB.EL NARANJAL -LIMA -LIMA -INDEPENDENCIA      ', 241, 216, 29, 217, '992454444', '', 1, 1, 0, 1, 1),
(141, '', '10415442772', 'CIEZA ROJAS VICTOR                                          ', 'CAL.LOS TALLERES MZA.E LTE16A URB.IND.EL NARANJAL-INDEPENDENCIA            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(142, '', '10224683079', 'CLOUD ZEVALLOS JUAN DE DIOS                                 ', 'MLC. ALOMIA ROBLES  871  HUANUCO - HUANUCO                                 ', 241, 216, 29, 217, '984119544-971238009      ', '', 3, 1, 0, 1, 1),
(143, '', '10295771815', 'COAQUIRA APAZA JUANA VIVIANA                                ', 'V.GOYENECHE # 802 INT. 2 SECCION 2 -MIRAFLORES - AREQUIPA                  ', 241, 216, 29, 217, '959269077', '', 1, 1, 0, 1, 1),
(144, '', '10005043528', 'COAQUIRA LAQUI FLABIA DOMITILA                              ', 'PROLG. PATRICIO MELENDEZ S/N INT 171           ASOC. MICAELA BASTIDA - TACN', 241, 216, 29, 217, '952684352', '', 1, 1, 0, 1, 1),
(145, '', '10418878431', 'COARITA UCHARICO DAYSI AZUCENA                              ', 'NRO. S/N INT. 49 ASOC. MANUEL A. ODRIA  TACNA - TACNA                      ', 241, 216, 29, 217, '924216255-970475025      ', '', 1, 1, 0, 1, 1),
(146, '', '10471650116', 'COLLANTES GUEVARA TEODOMIRO                                 ', 'AV. AUGUSTO B. LEGUIA NRO. 1259LAMBAYEQUE - CHICLAYO - CHICLAYO            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(147, '', '20536479792', 'COMERCIAL R.G.C. S.R.L                                      ', 'AV.GERARDO UNGER 4727 URB.INDUSTRIAL LIMA - LIMA - INDEPENDENCIA           ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(148, '', '20515901711', 'COMPANY LIMITED SUR AMERICA SRL                             ', 'PROLONG. PARINACOCHAS #1450  LA VICTORIA                                   ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(149, '', '20547168349', 'COMPANY SHANGHAI CENTER E.I.R.L.                            ', 'AV. MEXICO NRO. 1343 LIMA - LIMA - LA VICTORIA                             ', 241, 216, 29, 217, '4327536-955213197      ', '', 3, 1, 0, 1, 1),
(150, '', '10157357315', 'CONDOR MORENO HOMERO JUAN                                   ', 'AV.GERARDO UNGER 4513 INT.15 LIMA-LIMA-S.M.P                               ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(151, '', '10407526738', 'CONDORI BARRANTES ISAAC RENZO                               ', 'JR.LIBERTAD 901 SAN ROMAN JULIACA-JULIACA                                  ', 241, 216, 29, 217, '950059075 -#951648727              ', '', 3, 1, 0, 1, 1),
(152, '', '10422498414', 'CONDORI CONDORI WILBER                                      ', 'AV.CIRCUNVALACION #707 URB.SAN JOSE-PUNO-SAN ROMAN-JULIACA                 ', 241, 216, 29, 217, '951578454', '', 1, 1, 0, 1, 1),
(153, '', '10075174310', 'CONDORI FLORES SATURNINO FLORENCIO                          ', 'AV. MEXICO NRO. 1685-LA VICTORIA-LIMA                                      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(154, '', '10026421654', 'CONDORI MAMANI MARIO SEBASTIAN                              ', 'AV. CHULUCANAS  S/N ZONA INDUSTRIAL III PIURA -PIURA -26 OCTUBRE           ', 241, 216, 29, 217, '955163710', '', 1, 1, 0, 1, 1),
(155, '', '20529383925', 'CONTRATISTAS GENERALES SAN LORENZO EIRL                     ', 'AV.VIA EVITAMIENTO SUR # 716 ASC. VICTOR RAUL CAJAMARCA                    ', 241, 216, 29, 217, '# 259798                           ', '', 1, 1, 0, 1, 1),
(156, '', '20508971177', 'CORPORACION ADDYE SAC                                       ', 'PJ. FAROS 160 P.J.SAN JACINTO LIMA - LIMA - SAN LUIS                       ', 241, 216, 29, 217, '3247668', '', 1, 1, 0, 1, 1),
(157, '', '20490834916', 'CORPORACION DE AUTOPARTES Y TRANSPORTE LIMA S.R.L.          ', 'AV.MANCO CAPAC 411-WANCHAQ-CUSCO                                           ', 241, 216, 29, 217, '984631210', '', 1, 1, 0, 1, 1),
(158, '', '20600803680', 'CORPORACION ZUKA S.A.C.                                     ', 'AV. AVIACION NRO. 939 URB. SAN GERMAN (...) LIMA - LIMA - LA VICTORIA      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(159, '', '10206624154', 'COTERA MUÑOZ RODRIGO DECILOS                                ', 'AV.PROCERES DE INDEPENDENCIA 2274  LIMA-LIMA -SAN JUAN DE LURIGANCHO       ', 241, 216, 29, 217, '947360518', '', 1, 1, 0, 1, 1),
(160, '', '10465154701', 'CRESPO GAMARRA DEYVIS OLIVER                                ', 'MZA.F3 LT.03 A.H.BOCANEGRA PROV.CONST. DEL CALLAO - PROV. CONST.CALLAO     ', 241, 216, 29, 217, '939314995', '', 1, 1, 0, 1, 1),
(161, '', '10401042003', 'CRIOLLO GUERRERO ANGELITA                                   ', 'AV.BUENOS AIRES MZ A4 LT 2B AH. STA TERESITA-PIURA-SULLANA                 ', 241, 216, 29, 217, '968098408', '', 1, 1, 0, 1, 1),
(162, '', '10474475927', 'CRISTOBAL CARLOS DANILA                                     ', 'AV.CIRCUNV.TUPAC AMARU #135  CHAUPIMARCA -CERRO DE PASCO                   ', 241, 216, 29, 217, '#437777                            ', '', 1, 1, 0, 1, 1),
(163, '42525925', '10425259259', 'CRISTOBAL ROJAS ELVA VIRGINIA                               ', 'AV LEON.PRADO 1206(CRUCE C/AMAZONAS) HUANCAYO-JUNIN         ', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(164, '', '10012225909', 'CRUZ CANAHUIRI PEDRO DOMINGO                                ', 'JR. ALFONSO UGARTE 213 BAR.LA FLORIDA CAJAMARCA-CAJAMARCA                  ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(165, '', '10443910391', 'CRUZ JAHUIRA BEATRIZ JHENNY                                 ', 'JR.SUCRE #394 BR FLORIDA - CAJAMARCA-CAJAMARCA                             ', 241, 216, 29, 217, '\"076-777985 , *240582 ,    # 9444420\"', '', 2, 1, 0, 1, 1),
(166, '', '10756945047', 'CRUZ JAHUIRA JAVIER AURELIO                                 ', 'JR. SUCRE NRO. 388 BAR. LA FLORIDA CAJAMARCA - CAJAMARCA - CAJAMARCA       ', 241, 216, 29, 217, '945365260', '', 1, 1, 0, 1, 1),
(167, '', '10097943007', 'CRUZ LLANO EUGENIO CARLOS                                   ', 'AV. MARISCAL CACERES #316 HUAMANGA-AYACUCHO                                ', 241, 216, 29, 217, '66528318', '', 1, 1, 0, 1, 1),
(168, '', '10013456211', 'CRUZ LLANO ZORAIDA CARMEN                                   ', 'AV.MARISCAL CACERES 326 AYACUCHO - HUAMANGA - AYACUCHO                     ', 241, 216, 29, 217, '\"985824657,969821304 ,966800656   \"', 'PARABRISASPRISMACAR@HOTMA', 1, 1, 0, 1, 1),
(169, '', '10098796326', 'CRUZ RAMOS IRMA                                             ', 'AV.DEFENSORES DEL MORRO MZE LT30 ASOC.SARITA COLONIA CHORRILLOS-LIMA       ', 241, 216, 29, 217, '990608661', '', 1, 1, 0, 1, 1),
(170, '', '10036653332', 'CRUZ TINEO CHARITO                                          ', 'CAL. LAS LOMAS NRO. 203 A.H. EL OBRERO-SULLANANA                           ', 241, 216, 29, 217, '968960290', '', 1, 1, 0, 1, 1),
(171, '', '10205900719', 'CUETO ONOFRE TITO VIDES                                     ', 'AV.PESCHIERA NRO. S/N  JUNIN - CHANCHAMAYO - CHANCHAMAYO                   ', 241, 216, 29, 217, '954085886', '', 1, 1, 0, 1, 1),
(172, '', '10245766829', 'CUSI CCAPATINTA EDILBERTO                                   ', 'SICUANI-SICUANI-CUSCO                                                      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(173, '', '10479457609', 'CUYA SANCHEZ ROBERTO                                        ', 'JR.LOSTALLERES MZA.E LT16 INT.21 P.J.INDUSTRIAL EL NARANJAL                ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(174, '', '20525962203', 'D & R E HIJOS REPRESENTACIONES Y DISTRIBUCIONES GENERALES   ', 'AV. GRAU NRO. 4009 A.H. SAN MARTIN III ETAPA -PIURA                        ', 241, 216, 29, 217, '073-360214                         ', '', 1, 1, 0, 1, 1),
(175, '', '10428877654', 'DAMAS BOHORQUEZ JENNIFER                                    ', 'AV.PROCERES DE INDEPENDENCIA 1741 APV.SAN HILARION LIMA-S.J.L              ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(176, '', '20532876461', 'D\'AMERICAN PARTS E.I.R.L.                                   ', 'CAL.TALARA NRO. 1430 TACNA-TACNA                                           ', 241, 216, 29, 217, '952888861', '', 1, 1, 0, 1, 1),
(177, '', '20549122346', 'DANIEL CAR S.R.L.                                           ', 'AV. GERARDO UNGER NRO. 4599 INT. B LIMA - LIMA - INDEPENDENCIA             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(178, '', '10403930259', 'DANILA ANGELICA GARCIA SILVIA                               ', 'AV.METROPOLITANA MZ.J LT7 INT1A ASOC FORTALEZA DE VITARTE-LIMA             ', 241, 216, 29, 217, '942619045', '', 1, 1, 0, 1, 1),
(179, '', '20553221049', 'DAVID SERVIS E.I.R.L.                                       ', 'AV.G.UNGER 4513 INT.90 URB. NARANJAL-LIMA - LIMA-S.M.P                     ', 241, 216, 29, 217, '981258297', '', 1, 1, 0, 1, 1),
(180, '', '10180109876', 'DE LA CRUZ TUESTA MARIA DIOMIRA                             ', 'AV.CESAR VALLEJO 823 URB.PALERMO LA LIBERTAD -TRUJILLO -TRUJILLO           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(181, '', '10716579170', 'DE LA CRUZ ZEVALLOS EDERSON                                 ', 'AV. MANCO CCAQPAC #511-CUSCO - WANCHAQ                                     ', 241, 216, 29, 217, '#950889755     ', '', 1, 1, 0, 1, 1),
(182, '', '20600458753', 'DECORVILM E.I.R.L.                                          ', 'AV.PACHACUTEC 3499 LIMA - LIMA - VILLA MARIA DEL TRIUNFO                   ', 241, 216, 29, 217, '951399650-943065353      ', '', 1, 1, 0, 1, 1),
(183, '', '10178815542', 'DEZA DEZA ESDRAS MIGUEL                                     ', 'AV.CESAR VALLEJO  1617 INT.B PALOMAR-LA LIBERTAD - TRUJILLO                ', 241, 216, 29, 217, '996464232-977391606  ', '', 1, 1, 0, 1, 1),
(184, '', '10407917851', 'DIAZ CALLA ALEXANDER ALFONSO                                ', 'AV.GERARDO UNGER 4475 INT.4  LIMA - LIMA - COMAS                           ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(185, '', '10435744562', 'DIAZ CALLA JORGE LUIS                                       ', 'AV.GERARDO UNGER 4475 (INTERIOR STAND NRO 38) LIMA-LIMA-S.M.P              ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(186, '', '10425386137', 'DIAZ CONTRERAS JAVIER RANULFO                               ', 'AV.CHACHAPOYAS NRO.1805 AMAZONAS- UTCUBAMBA -BAGUA GRANDE                  ', 241, 216, 29, 217, '955614261', '', 1, 1, 0, 1, 1),
(187, '', '10414975718', 'DIAZ GAMARRA ANTERO MANUEL                                  ', 'AV. LOS INCAS NRO. 1065 LAMBAYEQUE - CHICLAYO - LA VICTORIA                ', 241, 216, 29, 217, '979903723', '', 1, 1, 0, 1, 1),
(188, '', '10071656204', 'DIONICIO RAMIREZ MAGNOR ABDON                               ', '\"AV.GERARDO UNGER 4533 INT8,9 URB.EL NARANJAL LIMA -LIMA -INDEPENDENCIA     \"', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(189, '', '20452726051', 'DISTRIBUIDORA DE REPUESTOS Y SERVICIOS DIJOFRA S.R.L.       ', 'AV. LOS INCAS NRO. SN (2DA CUADR N° 215)ICA - NASCA - NASCA                ', 241, 216, 29, 217, '966660366', '', 1, 1, 0, 1, 1),
(190, '', '', 'DORIS CAHUI                                                 ', 'PROCERES DE LA INDEPENDENCIA-SAN JUAN DE LURIGANCHO                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(191, '', '20538773388', 'DURAN REPUESTOS Y SERVICIOS S.A.C                           ', 'AV.DE LOS HEROES #395-SJM                                                  ', 241, 216, 29, 217, '\"2765114, NEX:420*8727, 9898788148  \"', '', 1, 1, 0, 1, 1),
(192, '', '10249936427', 'EGUIA CAMPANA LINDER                                        ', 'AV. MANCO CAPAC NRO. 604 WANCHAP CUSCO - CUSCO                             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(193, '', '20539819501', 'EL ARABE REPUESTOS DE AUTOS S.A.C.                          ', 'AV.TUPAC AMARU 1ER PISO #523 URB.LAS QUINTANAS-TRUJILLO-LA LIBERTAD        ', 241, 216, 29, 217, '*299875                            ', '', 1, 1, 0, 1, 1),
(194, '', '', 'EL CHATO                                                    ', '                                                                           ', 241, 216, 29, 217, '7664782', '', 1, 1, 0, 1, 1),
(195, '', '20564006646', 'EL FARAMALLA EMPRESA INDIVIDUAL DE RESPONSABILIDAD LIMITADA ', 'AV.DIAGONAL ANGAMOS #1860 WANCHAQ-CUSCO                                    ', 241, 216, 29, 217, '974965645-#984998000-MAYRA         ', '', 1, 1, 0, 1, 1),
(196, '', '20477529900', 'EL INGE INVERSIONES JR S.A.C.                               ', 'MZ.D LT02 A.H.EL PALOMAR-TRUJILLO-LA LIBERTAD                              ', 241, 216, 29, 217, '\"*666602, #942535                   \"', '', 1, 1, 0, 1, 1),
(197, '', '20601551129', 'EL MUNDO DE LOS ACCESORIOS AUTOMOTOS E.I.R.L                ', 'V. ANDRES AVELINO CACERES LOTE. 17 A.H. HUAYCAN ZONA B (66) LIMA - ATE     ', 241, 216, 29, 217, '947128094', '', 1, 1, 0, 1, 1),
(198, '', '20494916208', 'EL PARAISO DE LOS REPUESTOS E.I.R.L.                    ', 'CAL.CONDE DE LA MONCLOVA #795                          ICA - PISCO         ', 241, 216, 29, 217, '\"056311997 , 056766127, 956091715   \"', '', 1, 1, 0, 1, 1),
(199, '', '', 'ELVIS                                                       ', 'LA 50-SMP                                                                  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(200, '', '20331492630', 'EMBRAGUES Y FRENOS LOPEZ EIRL                               ', 'AV.LA MAR 151- ATE                                                         ', 241, 216, 29, 217, '3487473', '', 1, 1, 0, 1, 1),
(201, '', '', 'EMILIA BELLIDO                                              ', 'VILLA MARIA                                                                ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(202, '', '20530781250', 'EMPRESA COMERC. Y SERV. AUTO BOUTIQUE MISHELL S.R.L.        ', 'AV.INDEPENDENCIA #1970 ANCASH-HUARAZ-INDEPENDENCIA                         ', 241, 216, 29, 217, ' # 970031943-#959577216            ', '', 1, 1, 0, 1, 1),
(203, '', '20563253950', 'EMPRESA DE TRANSPORTES DE CARGA PEPITO E.I.R.L.             ', 'ANDAHUAYLAS 735 (FREN A LA BIBLIOT.MUNICIPAL) LIMA-LIMA-LA VICTORIA        ', 241, 216, 29, 217, '987152331', '', 1, 1, 0, 1, 1),
(204, '', '20536124404', 'EMPRESA DE TRANSPORTES PAREDES RECINES S.A.                 ', 'MZA.M LOTE. 8 COO.VIV PACHACUTEC  LIMA - LIMA - SANTA ANITA                ', 241, 216, 29, 217, '964887668', '', 5, 1, 0, 1, 1),
(205, '', '20517903915', 'EQUIP CAR INDUSTRIAL S.R.L.                                 ', 'AV.MEXICO  790 (ENTRE APTAO Y MEXICO) LIMA - LIMA - LA VICTORIA            ', 241, 216, 29, 217, '981253234', '', 1, 1, 0, 1, 1),
(206, '', '20559327604', 'EQUIPAMIENTOS SUCAR´S E.I.R.L.                              ', 'NRO. 118 CHANCAY AREQUIPA - AREQUIPA - MARIANO MELGAR                      ', 241, 216, 29, 217, '959741967', '', 1, 1, 0, 1, 1),
(207, '', '', 'ERNESTO                                                     ', 'AV. JOSE CARLOS MARIATEGUI LOTE 39-HUAYCAN                                 ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(208, '', '10404619361', 'ESCALANTE AGUIRRE FLORA                                     ', 'AV.PANAMERICANA KM.1 URB.BELLAVISTA BAJA APURIMAC-ABANCAY                  ', 241, 216, 29, 217, '959631111', '', 1, 1, 0, 1, 1),
(209, '', '10181962475', 'ESCALANTE CERQUEIRA AISSA JANETTE                           ', 'CAL.GUZMAN BARRON #110 URB.PALERMO-TRUJILLO-LA LIBERTAD                    ', 241, 216, 29, 217, '\"#75079011, 975079011, 044226917, #9\"', '', 1, 1, 0, 1, 1),
(210, '', '10209952373', 'ESCOBAR ALVA MARIELLA                                       ', 'CAR. MARGINAL 01 JUNIN - SATIPO - SATIPO                                   ', 241, 216, 29, 217, '964337823', '', 1, 1, 0, 1, 1),
(211, '', '10084347839', 'ESCOBAR BALBIN JUANA MARIA                                  ', 'AV. NICOLAS AYLLON #685 URB.SAN JACINTO -LA VICTORIA                       ', 241, 216, 29, 217, '3236056', '', 1, 1, 0, 1, 1),
(212, '', '10038340935', 'ESCOBAR CAMACHO RICARTE GONOFREDO                           ', 'AV.BUENOS AIRES 535 A.H. STA TERESITA PIURA-SULLANA                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(213, '', '10198596928', 'ESCOBAR DE HINOSTROZA ALEJANDRA PROFETA                     ', 'JR.MARISCAL CACERES #199 JUNIN - HUANCAYO - CHILCA                         ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(214, '', '10198818238', 'ESCOBAR JORA ELSA                                           ', 'JR. AMAZONAS  199 JUNIN - HUANCAYO - CHILCA                                ', 241, 216, 29, 217, '990270315', '', 1, 1, 0, 1, 1);
INSERT INTO `cliente` (`id_clte`, `dni_clte`, `ruc_clte`, `nombre_clte`, `direcc_clte`, `pais_cte`, `depto_cte`, `provi_cte`, `dtto_clte`, `tlf_ctle`, `email_clte`, `vendedor_clte`, `estatus_ctle`, `condp_clte`, `sucursal_clte`, `lista_clte`) VALUES
(215, '', '10108307566', 'ESCOBEDO CERNA ROSA AMELIA                                  ', 'AV.10 DE JULIO 249 PBLO.HUAMACHUCO LA LIBERTAD-SANCHEZ CARRION             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(216, '', '10308377160', 'ESCUDERO CUBA JUAN CARLOS                                   ', 'MZA.F LOTE 2 APVIS SAN BORJA-MOLLENDO-AREQUIPA-AREQUIPA                    ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(217, '', '10420901572', 'ESPIRILLA CALSINA AMERICO                                   ', 'AV.PROL. AV.AREQUIPA # 905 CUSCO - CANCHIS -SICUANI                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(218, '', '10211066836', 'ESTRELLA PANDO RICHARD JHON                                 ', 'AV. MANUEL A ODRIA NRO. 919  JUNIN - TARMA - TARMA                         ', 241, 216, 29, 217, '989897962', '', 1, 1, 0, 1, 1),
(219, '', '', 'EVA ESPINOZA                                                ', 'AV.IQUITOS 574                                                             ', 241, 216, 29, 217, '4337015', '', 1, 1, 0, 1, 1),
(220, '', '10082920876', 'EVANGELISTA GARCIA CARLOS MANUEL                            ', 'AV.CESAR VALLEJO 606 URB.PALERMO LA LIBERTAD TRUJILLO TRUJILLO             ', 241, 216, 29, 217, '#044204876     ', '', 1, 1, 0, 1, 1),
(221, '0', '', 'EWDIN QUISPE CONDOR                                         ', 'HUAYCAN                                                                    ', 241, 216, 29, 217, '                                   ', '', 5, 1, 0, 1, 1),
(222, '', '20545625271', 'EXTINTORES MARCOS S.A.C                                     ', 'AV.SEPARADORA INDUSTRIAL MZD\' LT31 URB.PACHACAMAC 4TA ET-V.SALVADOR        ', 241, 216, 29, 217, '947291742-994131759      ', '', 2, 1, 0, 1, 1),
(223, '', '20454269552', 'EZAP E.I.R.L.                                               ', 'CAL. PUNO NRO. 546 AREQUIPA - AREQUIPA - MIRAFLORES                        ', 241, 216, 29, 217, '958578821-054-285672-#977220938    ', '', 1, 1, 0, 1, 1),
(224, '', '20489504341', 'FACTORIA PEPE E.I.R.L.                                      ', 'AV.TUPAC AMARU NRO.505 HUANUCO - AMARILIS                                  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(225, '', '10103835815', 'FARFAN LUCIANO ELENA MARIBEL                                ', 'AV. AUGUSTO B. LEGUIA 1206-CHICLAYO                                        ', 241, 216, 29, 217, '074-257257//*270533// 985726367 MON', '', 1, 1, 0, 1, 1),
(226, '', '20491629798', 'FEDERAL TECH CORPORATION S.R.L.                             ', 'AV.VIA DE EVITAMIENTO SUR #710                             ASC. VICTOR RAUL', 241, 216, 29, 217, '#413190                            ', '', 1, 1, 0, 1, 1),
(227, '', '', 'FELICIANA LARA DIAZ                                         ', 'AV-WIESE 330 E.M SAN JUAN DE LURIGANCHO                                    ', 241, 216, 29, 217, '968523590', '', 1, 1, 0, 1, 1),
(228, '', '', 'FELIX JALISTO OLARTE                                        ', 'AV.PROLONGACION HUAYLAS M.D.LT 32-CHORRILLO                                ', 241, 216, 29, 217, '959109905', '', 1, 1, 0, 1, 1),
(229, '', '10412836443', 'FERIL CHOCCA EDGAR                                          ', 'AV. MARIATEGUI NRO. 317 JUNIN - HUANCAYO - EL TAMBO                        ', 241, 216, 29, 217, '949052530', '', 3, 1, 0, 1, 1),
(230, '', '10400729161', 'FERNANDEZ TANTAYAURI DAVID IVAN                             ', 'AV.MARIATRGUI 287 JUNIN - HUANCAYO - EL TAMBO                              ', 241, 216, 29, 217, '964750590', '', 1, 1, 0, 1, 1),
(231, '', '10401808235', 'FERNANDEZ TANTAYAURI ORLANDO ROMAN                          ', 'AV. MARIATEGUI NRO. 240 B JUNIN - HUANCAYO-EL TAMBO                        ', 241, 216, 29, 217, '996844098', '', 3, 1, 0, 1, 1),
(232, '', '20525066976', 'FIRENZE IMPORT & EXPORT E.I.R.L.                            ', 'PRL FRANCIA #1707-LA VICTORIA                                              ', 241, 216, 29, 217, '\"NEX:126*5606, 3245926, 3256828, 324\"', '', 1, 1, 0, 1, 1),
(233, '', '', 'FLOR GARCIA                                                 ', 'AV.GERARDO UNGER S/N URB.INDUSTRIAL NARANJAL SMP-LIMA                      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(234, '', '10414917491', 'FLORA VIOLETA FLORES FLORES                                 ', 'CALL.PUNO 704 MIRAFLORES-AREQUIPA-AREQUIPA                                 ', 241, 216, 29, 217, '983461104', '', 3, 1, 0, 1, 1),
(235, '', '10414618737', 'FLORES CHANCOLLA MISTER CESAR                               ', 'CAL. PUNO NRO. 600 MIRAFLORES-AREQUIPA-AREQUIPA                            ', 241, 216, 29, 217, '962533444', '', 3, 1, 0, 1, 1),
(236, '', '10024322713', 'FLORES HUMPIRI TIMOTEA                                      ', 'JR. LIBERTAD #802 MANCO CAPAC PUNO-SAN ROMAN-JULIACA                       ', 241, 216, 29, 217, '950081189', '', 3, 1, 0, 1, 1),
(237, '', '10471253052', 'FLORES LOPEZ JAVIER                                         ', 'PROL.LUCANAS #1273 URB.MATUTE-LA VICTORIA-LIMA                             ', 241, 216, 29, 217, '406-4109                           ', '', 1, 1, 0, 1, 1),
(238, '', '10410090622', 'FLOREZ HUAMAN CASIANO                                       ', 'AV. MANCO CCAPAC NRO. 531  CUSCO - CUSCO - WANCHAQ                         ', 241, 216, 29, 217, '990681985', '', 3, 1, 0, 1, 1),
(239, '', '20495992340', 'FOCSA E.I.R.L.                                              ', 'JR.SUCRE # 349 BR LA FLORIDA -  CAJAMARCA                                  ', 241, 216, 29, 217, '\"# 886539 , 076362828               \"', '', 1, 1, 0, 1, 1),
(240, '', '20601815428', 'FRANCAR PERU E.I.R.L.                                       ', 'AV. SALAMANCA C-8 (ESQ CON JR GRAU) AMAZONAS-CHACHAPOYAS-CHACHAPOYAS       ', 241, 216, 29, 217, '994764070', '', 2, 1, 0, 1, 1),
(241, '', '20495893015', 'FREIMINSA EIRL                                              ', 'JR. SUCRE # 473 BARRIO LA FLORIDA //        CAJAMARCA                      ', 241, 216, 29, 217, '\"976990554 , #259798, 975574497, #68\"', '', 1, 1, 0, 1, 1),
(242, '', '20549881760', 'G & H INVERSIONES SUAREZ S.A.C.                             ', 'PJ. SIN NOMBRE MZA. 177 LOTE. 04 A.H. HUAYCAN ZONA N- ATE                  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(243, '', '10453532891', 'GALECIO RIOS TEOLINDA ELENA DESIREE                         ', 'AV. BUENOS AIRES NRO. 264 A.H. JUAN VELASCO-SULLANA                        ', 241, 216, 29, 217, '#945206857                         ', '', 1, 1, 0, 1, 1),
(244, '', '10328603107', 'GAMARRA MICHER IRMA CONCEPCION                              ', 'MZA. A LOTE. 1 A.H. VILLA MARIA ENACE ANCASH-NUEVO CHIMBOTE                ', 241, 216, 29, 217, '#968149921                         ', '', 1, 1, 0, 1, 1),
(245, '', '10801950529', 'GAMARRA PERALTA LUZ MARINA                                  ', 'JR.PAMPACHIRI 166 APURIMAC - ANDAHUAYLAS - ANDAHUAYLAS                     ', 241, 216, 29, 217, '964565646', '', 1, 1, 0, 1, 1),
(246, '', '10239205475', 'GAMARRA PERALTA TOMASA                                      ', 'AV. SESQUICENTENARIO NRO.SN APURIMAC - ANDAHUAYLAS - ANDAHUAYLAS           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(247, '', '10098413681', 'GAMERO ESPIRITU RUTH CELIA                                  ', 'AV.MEXICO 1116 URB. BALCONCILLO LIMA - LIMA - LA VICTORIA                  ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(248, '', '10005064282', 'GARCIA APAZA NORMA                                          ', 'MZ B LT.05 PARQ INDUSTRIAL TACNA - TACNA - ALTO DE LA ALIANZA              ', 241, 216, 29, 217, '952652682', '', 1, 1, 0, 1, 1),
(249, '', '10406510358', 'GARCIA FLORES FLOR ISABET                                   ', 'AV.GERARDO UNGER 4513 LIMA - LIMA - S.M.P                                  ', 241, 216, 29, 217, '983276389', '', 1, 1, 0, 1, 1),
(250, '', '10402514090', 'GIRALDO QUIÑONES WALTER FILOMENO                            ', 'AV CONFRAT. INTERNAC OES 920 BAR DE CHALLHUA ANCASH - HUARAZ - HUARAZ      ', 241, 216, 29, 217, '943194983', '', 1, 1, 0, 1, 1),
(251, '', '10101856491', 'GOMERO CRISTOBAL DIOCELINDA CARMELA                         ', 'AV. NICOLAS AYLLON NRO. 687 LIMA - LIMA - SAN LUIS                         ', 241, 216, 29, 217, '940075663', '', 1, 1, 0, 1, 1),
(252, '', '10070857095', 'GOMERO CRISTOBAL MARIZOL MILDA                              ', 'PJ. AROS NRO.142 P.J. SAN JACINTO LIMA - LIMA - SAN LUIS                   ', 241, 216, 29, 217, '947368047-983232135      ', '', 1, 1, 0, 1, 1),
(253, '', '10449450502', 'GONGORA MORALES GARY JOHNATHAN                              ', 'AV.HUAYNA CCAPAC 302A (ALT. DE LA PISCINA DE WANCHAQ) CUSCO-CUSCO-CUSC     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(254, '', '10475442569', 'GONZALES CASACHAGUA JOSMAR TANIA                            ', 'AV. JACINTO IBARRA NRO. 490 JUNIN-HUANCAYO - HUANCAYO                      ', 241, 216, 29, 217, '977322909', '', 1, 1, 0, 1, 1),
(255, '', '10083440096', 'GONZALES TRUJILLO DE DE LA CRUZ GRACIELA                    ', 'AV. EL COMERCIO 390  ANCASH - HUARI - RAHUAPAMPA                           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(256, '', '10192309455', 'GONZALEZ BENITES JOBA MARCELA                               ', 'AV. ENRIQUE VALENZUELA #198-PACASMAYO-LA LIBERTAD                          ', 241, 216, 29, 217, '044-521322                         ', '', 1, 1, 0, 1, 1),
(257, '', '10152084337', 'GRACIANO VELLON FLORENCIA GENOBEBA                          ', 'AV.TUPAC AMARU 226 LIMA-HUAURA - HUACHO                                    ', 241, 216, 29, 217, '957582132', '', 1, 1, 0, 1, 1),
(258, '', '10230097629', 'GRADOS TELLO MILTON BERNARDO                                ', 'AV.TUPAC AMARU 600 PAUCARBAMBA HUANUCO-HUANUCO - AMARILIS                  ', 241, 216, 29, 217, '958582805', '', 3, 1, 0, 1, 1),
(259, '', '20546692672', 'GRELAMY S.A.C                                               ', 'AV.GER.UNGER 4465 INT10 A URB.INDUST.EL NARANJAL-LIMA-S.M.P                ', 241, 216, 29, 217, '981027411-5213609        ', '', 1, 1, 0, 1, 1),
(260, '', '20486515776', 'GRUPO BALDEON SOCIEDAD ANONIMA CERRADA                      ', 'AV. MANUEL A. ODRIA NRO. 2178 URB. HUALHUAS CHICO JUNIN - TARMA - TARM     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(261, '', '20568145403', 'GRUPO MEJICANO E.I.R.L                                      ', 'AV. MARIATEGUI 336 JUNIN - HUANCAYO-EL TAMBO                               ', 241, 216, 29, 217, '954488333', '', 3, 1, 0, 1, 1),
(262, '', '20600150201', 'GRUPO VILCAR S.R.L.                                         ', 'MZ. Ñ2 LT. 9A MADRE COVADONGA AYACUCHO - HUAMANGA - AYACUCHO               ', 241, 216, 29, 217, '957554182-#010125        ', '', 2, 1, 0, 1, 1),
(263, '', '10616601348', 'GUERRA LEÑAN RAFAEL                                         ', 'JR. BELLAVISTA 192  AYACUCHO - HUAMANGA - AYACUCHO                         ', 241, 216, 29, 217, '944800102', '', 1, 1, 0, 1, 1),
(264, '', '10467114951', 'GUERRERO MORETO EDITH KOOKI                                 ', 'AV. AUGUSTO.B.LEGUIA NRO. 951 INT. 86 URB. FERIA SAN LORENZO               ', 241, 216, 29, 217, '#945345500     ', '', 1, 1, 0, 1, 1),
(265, '', '10011607042', 'GUEVARA SALON ALEX                                          ', 'JR. LIBERTAD NRO. 161 HUAYCO SAN MARTIN - SAN MARTIN - TARAPOTO            ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(266, '', '10082147506', 'GUIZADO GAGO LUIS ANDRES                                    ', 'CAL.SEGOVIA MZ.C LT9 URB.MAYORAZGO-ATE                                     ', 241, 216, 29, 217, '\"3497435,  946533933                \"', '', 1, 1, 0, 1, 1),
(267, '', '10421699165', 'GUTIERREZ GOMEZ LUIS ANGEL                                  ', 'CAR.CENTRAL 3425 URB.CAYHUAYNA HUANUCO - HUANUCO - HUANUCO                 ', 241, 216, 29, 217, '962570279', '', 3, 1, 0, 1, 1),
(268, '', '10459121671', 'GUTIERREZ PALPA ROX MERY                                    ', 'AV.GERARDO UNGER 4475 INT.19 URB.IND EL NARANJAL-S.M.P                     ', 241, 216, 29, 217, '993853349-982566127     ', '', 1, 1, 0, 1, 1),
(269, '', '10316292068', 'GUZMAN ROSARIO ZENAIDA ARMANDA                              ', 'AV.CONFRAT. INTERN. OESTE # 457-ANCASH                                     ', 241, 216, 29, 217, '\"043423115 , # 285626               \"', '', 1, 1, 0, 1, 1),
(270, '', '10406703784', 'GUZMAN TICONA MARGOT SILVIA                                 ', 'AV.SIMON BOLIVAR 1277 BARRIO PORTEñO-PUNO-PUNO                             ', 241, 216, 29, 217, '976588366', '', 3, 1, 0, 1, 1),
(271, '', '20481589194', 'GZM EIRL                                                    ', 'AV.PERU #916 BAR.LA INTENDENCIA-TRUJILLO-LA LIBERTAD                       ', 241, 216, 29, 217, '225283', '', 1, 1, 0, 1, 1),
(272, '', '10023678875', 'HANCCO LIPA SIMON                                           ', 'JR. LIBERTAD NRO. 825 LAS MERCEDES-SAN ROMAN-JULIACA                       ', 241, 216, 29, 217, '\"051-337139, 951013882              \"', '', 3, 1, 0, 1, 1),
(273, '', '10415053784', 'HERNANDEZ IZQUIERDO ANAHI ZULEYKA                           ', 'PJ. LOS AROS NRO. 158 P.J. SAN JACINTO LIMA - LIMA - SAN LUIS              ', 241, 216, 29, 217, '2383891', '', 1, 1, 0, 1, 1),
(274, '', '10438610753', 'HERRERA HUAMANI CARLOS                                      ', 'AV.PANAMERICANA KM.02 URB. BELLAVISTA BAJA APURIMAC -ABANCAY - ABANCAY     ', 241, 216, 29, 217, '956006869', '', 1, 1, 0, 1, 1),
(275, '', '10414888327', 'HERRERA HUAMANI JORGE                                       ', 'AV.PANAMERICANA MZA.B LT13 APURIMAC - ABANCAY - ABANCAY                    ', 241, 216, 29, 217, '933255978', '', 2, 1, 0, 1, 1),
(276, '', '10412548677', 'HERRERA HUAMANI MARICELA                                    ', 'AV.PANAMERICANA NRO.S/N URB.BELLAVISTA BAJA APURIMAC-ABANCAY-ABANCAY       ', 241, 216, 29, 217, '#9984 06017 -983984561      ', '', 2, 1, 0, 1, 1),
(277, '', '10327326851', 'HIDALGO BARRIOS LUIS ALVARO                                 ', 'AV. JOSE PARDO NRO. 1194 CHIMBOTE                                          ', 241, 216, 29, 217, '327-383                            ', '', 1, 1, 0, 1, 1),
(278, '', '10739993283', 'HINOSTROZA TAPIA RAUL FERNANDO                              ', 'AV JOSE CARLOS MARIATEGUI 332 JUNIN - HUANCAYO - EL TAMBO                  ', 241, 216, 29, 217, '920450201', '', 3, 1, 0, 1, 1),
(279, '', '10418981801', 'HUACASI CAHUINA FERREYROS                                   ', 'JR.URGUAY 540 URB.SANTA ASUNCION PUNO - SAN ROMAN - JULIACA                ', 241, 216, 29, 217, '995005053', '', 3, 1, 0, 1, 1),
(280, '', '10420359620', 'HUACCHILLO PARDO EDGAR JOEL                                 ', 'MZA. A2 LOTE. 07 URB. SAN RAMON -PIURA - PIURA - PIURA                     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(281, '', '10430744998', 'HUAMAN ALHUAY RUTH GLEYBES                                  ', 'AV.OLLANTA HUMALA MZC LT10 A.H.3 DE MAYO JUNIN-CHANCHAMAYO -PICHANAQUI     ', 241, 216, 29, 217, '*6917991       ', '', 1, 1, 0, 1, 1),
(282, '', '10703284391', 'HUAMAN CHAMBI ALEX CIPRIANO                                 ', 'MZA PZ LOTE.07 URB.ESCURI CCORIHUATA ABAJO-PUNO-SAN ROMAN -JULIACA         ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(283, '', '10094620690', 'HUAMAN NAURAY ERNESTO MOISES                                ', 'AV. MANCCO CCAPAC # 525WANCHAQ- CUSCO                                      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(284, '', '10410897674', 'HUAMAN PASTOR EVELYN JULIANA                                ', 'AV.VIA DE EVITAMIENTO NORTE # 1901                   URB. SAN ROQUE - CAJAM', 241, 216, 29, 217, '*787628                            ', '', 1, 1, 0, 1, 1),
(285, '', '10773319273', 'HUAMAN RENDON ANALI                                         ', 'AV.HUAYNA CAPAC 315 CUSCO-CUSCO - WANCHAQ                                  ', 241, 216, 29, 217, '931027224', '', 1, 1, 0, 1, 1),
(286, '', '10422505968', 'HUAMAN RENGIFO JOEL CARLOS                                  ', 'AV. MARIATEGUI NRO. 285 JUNIN - HUANCAYO - EL TAMBO                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(287, '', '10103708023', 'HUAMBO QUISPE FLORA ROSA                                    ', 'CAL. PUNO NRO. 555B AREQUIPA - AREQUIPA - MIRAFLORES                       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(288, '', '10096579379', 'HUAMBO QUISPE SAMUEL BERNARDINO                             ', 'MZA. A LOTE. 17 APV FORTALEZA DE VITARTE LIMA - LIMA - ATE                 ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(289, '', '10098231965', 'HUANCA APO OLGA                                             ', 'AV.PACHACUTEC 3353 URB.HOGAR POLICIAL VILLA MARIA TRIUNFO                  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(290, '', '10424697422', 'HUANCARUNA ROMERO MARIA LEYBI                               ', 'CAJAMARCA SUR 660 SAN MARTIN - RIOJA - NUEVA CAJAMARCA                     ', 241, 216, 29, 217, '941800413', '', 1, 1, 0, 1, 1),
(291, '', '10403597045', 'HUANGAL BAZAN ROSA CONSUELO                                 ', 'JR.SUCRE # 420 BR LA FLORIDA -  CAJAMARCA                                  ', 241, 216, 29, 217, '#0011623 //                        ', '', 1, 1, 0, 1, 1),
(292, '', '10480536474', 'HUAQUISTO MARONA FRANK LUIS                                 ', 'JR LIBERTAD 8VA CDA PAB-A TDA-9 NRO.9 MANCO CAPAC-PUNO-SAN ROMAN-JULIA     ', 241, 216, 29, 217, '951854285', '', 1, 1, 0, 1, 1),
(293, '', '10410185453', 'HUARACHI ACCARAPI TEODOSIA                                  ', 'PJ.LIBERTAD 876A BARRIO MANCO CAPAC  PUNO - SAN ROMAN - JULIACA            ', 241, 216, 29, 217, '995005053', '', 1, 1, 0, 1, 1),
(294, '', '10198469101', 'HUARANCCA TUNQUE JULIA                                      ', '                                                                           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(295, '', '10326492456', 'HUARANGA LEON LEONIDAS                                      ', 'JR. LIMA NRO. S/N (CUADRA 13)LIMA - BARRANCA - BARRANCA                    ', 241, 216, 29, 217, '999008555', '', 1, 1, 0, 1, 1),
(296, '', '10412911909', 'HUARAQUI TRABESAÑO MARISOL                                  ', 'AV. GERVASIO SANTILLANA NRO. 1382 AYACUCHO - HUANTA - HUANTA               ', 241, 216, 29, 217, '#994481827-936704493-988057555     ', '', 2, 1, 0, 1, 1),
(297, '', '10443177553', 'HUARCA CASTRO YANET                                         ', 'AV. TAMBOPATA LT16 S/N - PUERTO MALDONADO                                  ', 241, 216, 29, 217, '\"982309418 , 982710401              \"', 'YANETHUARCACASTRO@GMAIL.C', 1, 1, 0, 1, 1),
(298, '', '10094720449', 'HUAYAPA BERROCAL JACINTA LADY                               ', 'JR.GERARDO UNGER #4333-INDEPENDENCIA                                       ', 241, 216, 29, 217, '990851393', '', 1, 1, 0, 1, 1),
(299, '', '10452078444', 'HUAYHUA PEREZ EDWIN                                         ', 'CAL. PUNO NRO. 655 AREQUIPA - AREQUIPA - MIRAFLORES                        ', 241, 216, 29, 217, '954644544-957897815      ', '', 1, 1, 0, 1, 1),
(300, '', '', 'HUGO VILLANEUVA COLLAZOS                                    ', 'AV.AUGUSTO B.LEGUIA 1253-CHICLAYO                                          ', 241, 216, 29, 217, '074-222380                         ', '', 1, 1, 0, 1, 1),
(301, '', '10015360912', 'HUISA AVENDAÑO MARIA ANTONIETA                              ', 'AV. MANCO CCAPAC # 500 WANCHAQ- CUSCO                                      ', 241, 216, 29, 217, '\"084784580 , 974999188              \"', '', 3, 1, 0, 1, 1),
(302, '', '10015360904', '\"HUISA AVENDAÑO, BENIGNA                                     \"', 'AV. HUAYNA CAPAC # 301 WANCHAQ-CUSCO                                       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(303, '', '10449571792', 'HURTADO LIMA ALIDA VENUS                                    ', 'AV.FIZTCARRALD MZ 6A LT.11MADRE DE DIOS - TAMBOPATA - TAMBOPATA            ', 241, 216, 29, 217, '948126406-940191179     ', 'ALIFORESTAL@GMAIL.COM    ', 1, 1, 0, 1, 1),
(304, '', '10274332927', 'IDROGO BENAVIDES VICTOR HUGO                                ', 'JR. EDELMIRA SILVA NRO. 600 CAJAMARCA - CHOTA - CHOTA                      ', 241, 216, 29, 217, '976620385', '', 1, 1, 0, 1, 1),
(305, '', '20511106339', 'IMPORT Y EXPORT MEXICO SCRL                                 ', 'AV.MEJICO 1326 (ENTRE MEJICO Y PARINACOCHAS) LIMA- LIMA - LA VICTORIA      ', 241, 216, 29, 217, '3235226-3255508        ', 'ROSMERYIEM@GMAIL.COM     ', 1, 1, 0, 1, 1),
(306, '', '20490112619', 'IMPORTACIONES AUTOPARTES IQUIQUE MOTOR\'S SAC                ', 'AV. MANCO CAPAC # 341 WANCHAQ- CUSCO                                       ', 241, 216, 29, 217, '\"974948383, 084242416               \"', 'GRISCARITO_1@HOTMAIL.COM ', 3, 1, 0, 1, 1),
(307, '', '20555181575', 'IMPORTACIONES CYAM DIESEL E.I.R.L.                          ', 'AV.LOS ALISOS 555 URB.MICAELA BASTIDAS LIMA - LOS OLIVOS                   ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(308, '', '20100835321', 'IMPORTACIONES ESPINOZA S.A.                                 ', 'JR.TRES AVENIDAS #127 URB.APOLO-LA VICTORIA                                ', 241, 216, 29, 217, '\"RPC:989048053, RPM:#275603, 4736914\"', '', 1, 1, 0, 1, 1),
(309, '', '20564236994', 'IMPORTACIONES FLORES K E.I.R.L                              ', 'AV.PANAMERICANA SN URB.LAS AMERICAS-APURIMAC - ABANCAY - ABANCAY           ', 241, 216, 29, 217, '982517939', '', 1, 1, 0, 1, 1),
(310, '', '20536896989', 'IMPORTACIONES MANTARO MOTORS S.A.C.                         ', 'AV. VENEZUELA  # 1463 LIMA - LIMA - BREÑA                                  ', 241, 216, 29, 217, '\"3391431,  990272293                \"', '', 1, 1, 0, 1, 1),
(311, '', '20523825136', 'IMPORTACIONES TAKE S.A.C.                                   ', 'AV. LOS ALISOS NRO. 247 URB. NARANJAL LIMA - LIMA - SAN MARTIN DE PORRES   ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(312, '', '20516814528', 'IMPORTACIONES VIL JUNIOR SAC                                ', 'JR.RAYMONDI NRO. 219 DPTO. 501-LA VICTORIA-LIMA                            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(313, '', '', 'IMPORTACIONES Y DISTRIBUCIONES LA REPUESTERA  // MARIA H.CAS', 'CALLE RAMIRO PRIALE 140                                                    ', 241, 216, 29, 217, '994147628 //NEX:414*7628 // #044260', '', 1, 1, 0, 1, 1),
(314, '', '20538615553', 'IMPORTADORA DAIKI MOTOR\'S S.A.C.                            ', 'AV.LOS HEROES #413B COO.CIUDAD DE DIOS-SJM-LIMA                            ', 241, 216, 29, 217, '2769944', '', 1, 1, 0, 1, 1),
(315, '', '20477300821', 'IMPORTADORA DE REPUESTOS OBAJ S.A.C.                        ', 'AV. CESAR VALLEJO NRO. 865 URB. ARANJUEZ LA LIBERTAD - TRUJILLO - TRUJ     ', 241, 216, 29, 217, '956724695', '', 1, 1, 0, 1, 1),
(316, '', '20537474344', 'IMPORTADORA MEXICO E.I.R.L.                                 ', 'AV.MEXICO #1190-LA VICTORIA                                                ', 241, 216, 29, 217, '3236243', '', 1, 1, 0, 1, 1),
(317, '', '20566492980', 'IMPORTADORA Y DISTRIBUIDORA CAROL S.AC.                     ', 'JR.LOS TALLERES MZ E LT.16 URB.IND EL NARANJAL LIMA-LIMA- S.M.P            ', 241, 216, 29, 217, '951304738', '', 1, 1, 0, 1, 1),
(318, '', '20504924603', 'IMPRE JUNIOR E.I.R.L.                                       ', 'AV.IQUITOS #109-LA VICTORIA                                                ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(319, '', '20563489996', 'INVERSIONES ARI & PER E.I.R.L                               ', 'PJ. HUASCAR NRO. 122 URB. LA ASUNCION LIMA - LIMA - SAN LUIS               ', 241, 216, 29, 217, '13234530', '', 1, 1, 0, 1, 1),
(320, '', '', 'INVERSIONES ARTURO S.A.C.                                   ', 'AV.ANDRES A.CACERES UCV 2 LT 11 A.H. HUAYCAN ZONA O-ATE-LIMA               ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(321, '', '20602861962', 'INVERSIONES AUTOMOTRIZ L & M                                ', 'AV.GERARDO UNGER 4553 INT.2 URB.NARANJAL INDUSTRIAL-INDEPENDENCIA-LIMA     ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(322, '', '20502846206', 'INVERSIONES CANTA GAS S.A.C.                                ', 'CAR.CARRETERA CAJAMARQUILLA NRO. S/N INT. 87-6 PARCELAC.CAJAMARQUILLA- LURI', 241, 216, 29, 217, '\"998094172,    #964887668           \"', '', 1, 1, 0, 1, 1),
(323, '', '20517133117', 'INVERSIONES CASTILLO E HIJAS S.AC.                          ', 'AV.GERARDO UNGER 4553 INT.1-2 URB.INDUSTRIAL NARANJAL                      ', 241, 216, 29, 217, '998391636-981470128     ', '', 2, 1, 0, 1, 1),
(324, '', '20507787381', 'INVERSIONES CORPORALES LEON S.A.C.                          ', 'CAL.LOS AROS 139 URB.SAN JACINTO LIMA - LIMA - SAN LUIS                    ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(325, '', '20556596302', 'INVERSIONES EFRAIN PALOMINO CAMPO S.A.C.                    ', 'AV.PROCERES DE LA INDEP.MZA. B1 LT.22 APV.LOS PINOS S.J.L                  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(326, '', '20548575941', 'INVERSIONES FRANQUITO S.R.L.                                ', 'AV.GERARDO UNGER 4513 INT.10 URB.INDUSTRIAL NARANJAL                       ', 241, 216, 29, 217, '947279777', '', 1, 1, 0, 1, 1),
(327, '', '20454095201', 'INVERSIONES GENERALES  BEN-PACK EIRL                        ', 'JR.SUCRE 493 - CAJAMARCA                                                   ', 241, 216, 29, 217, '76341302', '', 1, 1, 0, 1, 1),
(328, '', '20602036511', 'INVERSIONES GENERALES VICA EIRL                             ', 'JR. SUCRE NRO. 434A BAR. LA FLORIDA CAJAMARCA - CAJAMARCA - CAJAMARCA      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(329, '', '20602357202', 'INVERSIONES IVAN SAIR S.C.R.L                               ', 'JR.SANTA ISABEL 1569 (ENTRE MARIAT Y F.QUISPE) JUNIN-HUANCAYO-EL TAMBO     ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(330, '', '20548255954', 'INVERSIONES JERUMLIKA S.A.C.                                ', 'PJ. LOS FAROS NRO. 154 URB. SAN JACINTO LIMA - LIMA - SAN LUIS             ', 241, 135, 15, 135, '324-5511    ', '', 2, 1, 1, 1, 1),
(331, '', '20510437072', 'INVERSIONES LUCHITO S.R.L                                   ', 'PASAJE LOS AROS 124 SAN.JACINTO LA VICTORIA-LA VICTORIA                    ', 241, 216, 29, 217, '4734972', '', 1, 1, 0, 1, 1),
(332, '               ', '20493905997', 'INVERSIONES MAYABY E.I.R.L.', 'JR.CUSCO 458 SAN MARTIN  - SAN MARTIN  - TARAPOTO           ', 241, 216, 29, 217, '', '                                                  ', 2, 1, 0, 1, 1),
(333, '', '20445742091', 'INVERSIONES MELIRIS S.R.L.                                  ', 'AV. PROLG.PARDO 1148 MIRAMAR BAJO-ANCASH-CHIMBOTE                          ', 241, 216, 29, 217, '043-792601/943012500/943215035/9942', '', 2, 1, 0, 1, 1),
(334, '               ', '20546237801', 'INVERSIONES MONTALVO E HIJOS E.I.R.L.', 'AV. BOLIVAR NRO. 186 - LIMA HUAROCHIRI SANTA EULALIA', 241, 216, 29, 217, '', '                                                  ', 5, 1, 0, 1, 1),
(335, '', '20481753091', 'INVERSIONES PINTO SAC                                       ', 'AV. CESAR VALLEJO #1710 INT.B A.H.SAN CARLOS-TRUJILLO-LA LIBERTAD          ', 241, 216, 29, 217, '\"044-3784824, #335480, 044380309    \"', 'INVERSIONESPINTO@HOTMAIL.', 1, 1, 0, 1, 1),
(336, '', '20445483134', 'INVERSIONES QUISPE E.I.R.L.                                 ', 'V. JOSE PARDO NRO. 1325-CHIMBOTE                                           ', 241, 216, 29, 217, '944432200', '', 1, 1, 0, 1, 1),
(337, '', '20529513721', 'INVERSIONES RAM CARS EIRL                                   ', 'AV.VIA DE EVITAMIENTO SUR # 746 - CAJAMARCA                                ', 241, 216, 29, 217, '\"976018248 , # 602170               \"', '', 1, 1, 0, 1, 1),
(338, '', '20558606453', 'INVERSIONES SUJEY S.A.C                                     ', 'CAL.CHANCAY #118 AREQUIPA- AREQUIPA- MARIANO MELGAR                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(339, '', '20479647250', 'INVERSIONES TICO\'S JOSE MIGUEL EMPRESA INDIVIDUAL DE RESPONS', 'CAL. AYACUCHO #899 P.J. GARCES LAMBAYEQUE-CHICLAYO-JOSE LEONARDO ORTIZ     ', 241, 216, 29, 217, '\"RPM #985245313, 251038             \"', '', 1, 1, 0, 1, 1),
(340, '', '20602264794', 'INVERSIONES TM&HT E.I.R.L                                   ', 'AV.CARLOS CH. HIRAOKA NRO.SN CHILLICOPAMPA AYACUCHO - HUANTA - HUANTA      ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(341, '', '20601945569', 'INVERSIONES Y ACCESORIOS BRICAR E.I.R.L.                    ', 'AV. JOSE CARLOS MARIATEGUI NRO.330 INT. 19 JUNIN - HUANCAYO - EL TAMBO     ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(342, '', '10473109471', 'ISABEL CONDORI SALAZAR                                      ', 'AV.HUAYNA CCAPAC #311-WANCHAQ-CUSCO                                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(343, '', '', 'J & K REPUESTOS E.I.R.L.                                    ', 'AV.CESAR VALLEJO #1031 URB. ARANJUEZ-TRUJILLO-LA LIBERTAD                  ', 241, 216, 29, 217, '044-243968                         ', '', 1, 1, 0, 1, 1),
(344, '', '20481119040', 'J & K REPUESTOS E.I.R.L.                                    ', 'AV.CESAR VALLEJO#1031 URB.ARANJUEZ-TRUJILLO-LA LIBERTAD                    ', 241, 216, 29, 217, '*257961                            ', '', 1, 1, 0, 1, 1),
(345, '', '20494514151', 'J & L RALLY GLASS E.I.R.L.                                  ', 'JR.CIRO ALEGRIA #200-HUAMANGA - AYACUCHO                                   ', 241, 216, 29, 217, '\"966013579,066319829,#039485,0663198\"', '', 1, 1, 0, 1, 1),
(346, '               ', '20536732102', 'J.V. SANTA ROSA E.I.R.L                                     ', 'PJ. LOS AROS #165 P.J.SAN JACINTO-SAN LUIS-LA VICTORIA      ', 241, 216, 29, 217, '\"7918220, 991072681  \"', '                                                  ', 1, 1, 0, 1, 1),
(347, '               ', '10266862640', 'JAHUIRA CONDORI MARIA RAYTA                                 ', 'JR.SUCRE # 392 BARR.LA FLORIDA CAJAMARCA                    ', 241, 216, 29, 217, '\"#076357948 , #956674\"', '                                                  ', 1, 1, 0, 1, 1),
(348, '', '20525909141', 'JC REPUESTOS Y SERVICIOS EIRL                               ', 'AV.PROLONGACION GRAU 3821.AH SAN MARTIN-PIURA                              ', 241, 216, 29, 217, '\"073-360232, 073-320162 JORGE JIMENE\"', '', 1, 1, 0, 1, 1),
(349, '               ', '20490016571', 'JC SERVILLANTAS & COMERCIO EL ZORRO E.I.R.L                 ', 'PJ. JOSEFINA CAMACHO NRO. 135 MADRE DE DIOS - TAMBOPATA - TA', 241, 216, 29, 217, '982317941', '                                                  ', 1, 1, 0, 1, 1),
(350, '', '', 'JORGE SICHES GOICOCHEA                                      ', '                                                                           ', 241, 216, 29, 217, '994091905', '', 1, 1, 0, 1, 1),
(351, '', '', 'JUSTINA CLARISA CAPCHA AQUINO                               ', 'AV.MEXICO 1745 URB SAN GERMAN                                              ', 241, 216, 29, 217, '3250856 /995001756                 ', '', 1, 1, 0, 1, 1),
(352, '', '20547031475', 'JV MOTORS SOCIEDAD ANONIMA CERRADA                          ', 'AV. GERARDO UNGER NRO. 4503 Z.I. NARANJAL LIMA - LIMA - INDEPENDENCIA      ', 241, 216, 29, 217, '947120376', '', 1, 1, 0, 1, 1),
(353, '', '', 'JV REPUESTOS Y SERVICIOS GENERALES SRL                      ', 'JR.SUCRE 395-CAJAMARCA                                                     ', 241, 216, 29, 217, '976462680/#765058                  ', '', 1, 1, 0, 1, 1),
(354, '', '20487935256', 'LA CASA DE LAS MICAS E IMPORTACIONES SAC                    ', 'AV. LEGUIA NRO. 1259-CHICLAYO                                              ', 241, 216, 29, 217, '\"979903723 ANTERO, 074270991- RPM*27\"', '', 1, 1, 0, 1, 1),
(355, '', '20398907630', 'LA CASA DE LAS MICAS SRL                                    ', 'AV.LORETO 1311-PIURA                                                       ', 241, 216, 29, 217, '\"073-307296, RPM:#680311            \"', '', 2, 1, 0, 1, 1),
(356, '', '20559330737', 'LA CASA DE LOS FAROS Y MICAS E.I.R.L.                       ', 'CAL. PUNO NRO. 647  AREQUIPA - AREQUIPA - MIRAFLORES                       ', 241, 216, 29, 217, '998552738', 'VMARIN_14_8@HOTMAIL.COM  ', 3, 1, 0, 1, 1),
(357, '', '20559641732', 'LA CASA DEL FARO S.A.C.                                     ', 'AV. PERU# 939 URB. LA INTENDENCIA-TRUJILLO-LA LIBERTAD                     ', 241, 216, 29, 217, '44611075-968487868-944690001       ', '', 1, 1, 0, 1, 1),
(358, '', '20522417409', 'LA PEQUEÑA TIENDITA S.A.C.                                  ', 'AV.MEJICO #1649-LA VICTORIA                                                ', 241, 216, 29, 217, '\"3247601, NEX: 120*7700, 992898224, \"', '', 1, 1, 0, 1, 1),
(359, '', '20542710340', 'LA VEINTIUNO E.I.R.L                                        ', 'JR.LIBERTAD SN INT. 21 PUNO - SAN ROMAN - JULIACA                          ', 241, 216, 29, 217, '#942942061     ', '', 1, 1, 0, 1, 1),
(360, '', '10412941204', 'LAOR MAXIMILIANO KARINA CONCEPCION                          ', 'AV.MARIATEGUI 285 (ENTRE STA ISABEL Y GRAU)JUNIN - HUANCAYO - EL TAMBO     ', 241, 216, 29, 217, '954431404', '', 1, 1, 0, 1, 1),
(361, '25147896', '', 'LARA                                                        ', 'PROCERES DE LA INDEPNDENCIA SAN JUAN D ELURIGANCHO                         ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(362, '', '10070297464', 'LEON OSCCO CARMELA                                          ', 'AV.4 DE DICIEMBRE MZ A H31- CHORRILLOS                                     ', 241, 216, 29, 217, '\"997750694, 995918365               \"', '', 1, 1, 0, 1, 1),
(363, '', '20529368616', 'LINE ZONA CAR E.I.R.L.                                      ', 'JR.SUCRE #436 BR LA FLORIDA -  CAJAMARCA                                   ', 241, 216, 29, 217, '.                                  ', '', 1, 1, 0, 1, 1),
(364, '', '10024333499', 'LIPA EDITH MERCEDES                                         ', 'JR.TARMA 167 BARRIO LAS MERCEDES PUNO - SAN ROMAN - JULIACA                ', 241, 216, 29, 217, '958481150', '', 1, 1, 0, 1, 1),
(365, '', '10406735953', 'LLACHI LAURENTE MONICA YRENE                                ', 'JR.LIBERTAD 928 BARRIO MANCOCAPAC-JULIACA-JULIACA                          ', 241, 216, 29, 217, '995050677', '', 1, 1, 0, 1, 1),
(366, '', '10705165535', 'LLAMACPONCCA ALVAREZ YENI                                   ', 'AV.MANCO INCA 311ACUSCO - CUSCO  - WANCHAQ                                 ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(367, '', '10465422233', 'LLANO CHOQUE JESSICA                                        ', 'MZA. V LOTE.10 A.H. LAS BRISAS DE VILLA-SURCO                              ', 241, 216, 29, 217, '\"989921921, 991420682, 7925489, 7311\"', '', 1, 1, 0, 1, 1),
(368, '', '10224846016', 'LLANOS AISANOA JUAN ROGELIO                                 ', 'AV. TUPAC AMARU NRO. 507 HUANUCO - HUANUCO - AMARILIS                      ', 241, 216, 29, 217, '999131088', '', 1, 1, 0, 1, 1),
(369, '', '10465426280', 'LLANOS CARRASCO SAMUEL EULALIO                              ', 'CAL. PUNO NRO. 706 AREQUIPA-AREQUIPA-MIRAFLORES                            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(370, '', '10282261923', 'LOAYZA PEREZ MAURA HERLINDA                                 ', 'AV. MARISCAL CACERES NRO. 258 AYACUCHO - HUAMANGA - AYACUCHO               ', 241, 216, 29, 217, '966877172 //352242                 ', '', 1, 1, 0, 1, 1),
(371, '', '95698544', 'LOMA TARQUI BERNABE                                         ', 'AV.JORGE BASADRE #1615 INT.40 CEN.COM.CRISTINA VILDOSO-TACNA               ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(372, '', '10414134659', 'LOPEZ FABIAN NOEMI                                          ', 'AV.MARGINAL 722 URB.PICHANAKI JUNIN - CHANCHAMAYO - PICHANAQUI             ', 241, 216, 29, 217, '935299788', '', 1, 1, 0, 1, 1),
(373, '', '10211194079', 'LORENZO PERALES GADY MARUJA                                 ', 'JR. PROLONGACION LUCANAS #1465-LA VICTORIA                                 ', 241, 216, 29, 217, '3257738', '', 1, 1, 0, 1, 1),
(374, '', '20559992446', 'LORITO KARS S.R.L.                                          ', 'AV.CESAR VALLEJO# 890-101URB.PALERMO LA LIBERTAD-TRUJILLO                  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(375, '', '20260811658', 'LUBRICENTRO ARTIAGA E.I.R.L.                                ', 'AV. JOSE CARLOS MARIATEGUI LOTE 39-B-HUAYCAN                               ', 241, 216, 29, 217, '\"5848741, 945046411, *530195        \"', '', 5, 1, 0, 1, 1),
(376, '', '10466978626', 'LUCAS VALENZUELA ALBERTO DANIEL                             ', 'AV.TUPAC AMARU 05 URB.PAUCARBAMBA HUANUCO - HUANUCO - AMARILIS             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(377, '', '', 'LUCIANO CALZADO TABRA                                       ', 'AV.CIRCUNV.TUPAC AMARU #135-CHAUPIMARCA -CERRO DE PASCO                    ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(378, '', '', 'LUIS (PORTON)                                               ', 'SAN JUAN DE LURIGANCHO                                                     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(379, '', '20495141153', 'M & A VILCAR S.R.L.                                         ', 'AV. A. A. CACERES  #276- HUAMANGA-AYACUCHO                                 ', 241, 216, 29, 217, '\"#957554181,  #957554182,957554209  \"', '', 1, 1, 0, 1, 1),
(380, '', '20601408440', 'M.M. INVERSIONES ARIAM S.A.C.                               ', 'N.AYLLON NRO. 685 SAN JACINTO LIMA - LIMA - SAN LUIS                       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(381, '', '10418055753', 'MACHACA MAMANI EDITH YOVANA                                 ', 'AV. JORGE BASADRE GROHMANN S/N INT.72 ASOC.COM.CRISTINA VILDOSO TACNA      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(382, '', '10316777240', 'MAGUIñA MINAYA EDWAR JOHN                                   ', 'AV.FRANCISCO BOLOGNESI 137-HUARAZ                                          ', 241, 216, 29, 217, '990281555', '', 1, 1, 0, 1, 1),
(383, '', '', 'MALACA CASTILLO JONNHY LUIS                                 ', 'AV.RANCHERIA BAJA S/N EX COOP.HUANDO LIMA - HUARAL                         ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(384, '', '10166354540', 'MALCA ROJAS FERNANDO                                        ', 'AV. AUGUSTO B.LEGUIA NRO. 1235-CHICLAYO                                    ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(385, '', '10094955802', 'MALLQUI ARELLANO GROVER                                     ', 'JR.FLORENCIA DE MORA CD03 PBLO.HUAMACHUCO LA LIBERTAD -SANCHEZ CARRION     ', 241, 216, 29, 217, '959990164-996962321    ', '', 2, 1, 0, 1, 1),
(386, '', '10195745221', 'MALLQUI ARELLANO IRIS JUDITH                                ', 'JR.SANTIAGO ZAVALA 237 PBLO.HUAMACHUCO LA LIBERTAD-SANCHEZ CARRION         ', 241, 216, 29, 217, '947873552-995566479 ', '', 1, 1, 0, 1, 1),
(387, '', '10436772900', 'MAMANI ARQUE MILAGROS NATALI                                ', 'CAL.PUNO NRO. 562 AREQUIPA - AREQUIPA - MIRAFLORES                         ', 241, 216, 29, 217, '972456410', '', 1, 1, 0, 1, 1),
(388, '', '10411174439', 'MAMANI LIPA MERCEDES                                        ', 'JR.MARINERO 428 URB.SAN JOSE II ETAPA-PUNO-SAN ROMAN-JULIACA               ', 241, 216, 29, 217, '943269278', '', 3, 1, 0, 1, 1),
(389, '', '10024235578', 'MAMANI ORTEGA RODOLFO JUSTINIANO                            ', '\"PABELLON A, TDA #16 JR.LIBERTAD 8VA.CDRA -PUNO-SAN ROMAN-JULIACA           \"', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(390, '', '20517053270', 'MARCILLA VIGO SCRL                                          ', 'JR.LAS ALCAPARRAS 467 COO.LAS FLORES-LIMA - SAN JUAN DE LURIGANCHO         ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(391, '', '', 'MARIA                                                       ', 'HUAYCAN                                                                    ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(392, '', '', 'MARIA ARIAS                                                 ', '                                                                           ', 241, 216, 29, 217, '3718913', '', 1, 1, 0, 1, 1),
(393, '', '', 'MARIA DEL PILAR HUAMAN CASTILLO                             ', '                                                                           ', 241, 216, 29, 217, '\"3401048 , RPM #044260              \"', '', 1, 1, 0, 1, 1),
(394, '', '10024304847', 'MARIN QUIRO ANDRES EDGAR                                    ', 'JR. LIBERTAD NRO. 1101 URB. LAS MERCEDES-SAN ROMAN-JULIACA                 ', 241, 216, 29, 217, '\"#995999934, 950810945,051-782852   \"', '', 1, 1, 0, 1, 1),
(395, '', '10024432594', 'MARONA CRUZ DELIA                                           ', 'JR.LIBERTAD 8VA.CDRA #A-9 BARRIO MANCO CAPAC-PUNO-SAN ROMAN - JULIACA      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(396, '', '', 'MARTA CASTILLO                                              ', '\"#75079011, 975079011, 044226917, #984592504, 044-509341                    \"', 241, 216, 29, 217, '\"947868613, RPM *598613             \"', '', 1, 1, 0, 1, 1),
(397, '', '10156480792', 'MARTEL SUSANIBAR CARMEN ROCIO                               ', 'JR.PRIMAVERA 587 URB.SAN IDELFONSO LIMA - BARRANCA - BARRANCA              ', 241, 216, 29, 217, '994083312', '', 1, 1, 0, 1, 1),
(398, '', '', 'MARTIN REYNALTE TRUJILLO - IMPORTACIONES SAN MARTIN         ', 'AV.GERARADO UNGER 4463-INDEPENDENCIA-AV LOS ALISOS 247B-SMP                ', 241, 216, 29, 217, '5216184 //827*8395 // 988197966    ', '', 1, 1, 0, 1, 1),
(399, '', '10416869672', 'MARTINEZ SIERRA MARCELO JESUS                               ', 'PJ.LOS FRENOS #101 INT.B URB.SAN JACINTO-SAN LUIS-LA VICTORIA              ', 241, 216, 29, 217, '\"991420682, 942798942, 311925       \"', '', 1, 1, 0, 1, 1),
(400, '', '20518144287', 'MAXIBUS EIRL                                                ', 'PR PARINACOCHAS 1365 (ENTRE PARINA.Y MEXICO) LIMA - LIMA - LA VICTORIA     ', 241, 216, 29, 217, '\"3238772, 991214568                 \"', '', 1, 1, 0, 1, 1),
(401, '', '10445927550', 'MAXIMILIANO ESPIRITU HECTOR DAVID                           ', 'AV.ANDRES AVELINO CACERES MZA.2 LT10 A.H.HUAYCAN ZNA O-ATE                 ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(402, '10445927', '', 'MAXIMILIANO ESPIRITU HECTOR DAVID                           ', 'AV.ANDRES AVELINO CACERES MZA.02 LT10 A.H. HUAYCAN ZONA O ATE-LIMA         ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(403, '', '10199139466', 'MAYTA FABIAN ELIZABETH LUCIA                                ', 'AV. JOSE CARLOS MARIATEGUI #381  JUNIN - HUANCAYO - EL TAMBO               ', 241, 216, 29, 217, '964461863', '', 1, 1, 0, 1, 1),
(404, '', '10199584737', 'MAYTA MALPICA FELIX FORTUNATO                               ', 'CAL.SAENZ PEÑA NRO. 231-LA VICTORIA-LIMA                                   ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(405, '', '20481258678', 'MB REPUESTOS Y SERVICIOS E.I.R.L.                           ', 'AV.AMERICA SUR #454 URB.PALERMO-TRUJILLO-LA LIBERTAD                       ', 241, 216, 29, 217, '044-425753                         ', '', 1, 1, 0, 1, 1),
(406, '', '', 'MECHE                                                       ', 'SAN JUAN DE LURIGANCHO                                                     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(407, '', '10065665935', 'MEDINA ESPIRITU JULIO ALEXANDER                             ', 'AV. MEXICO NRO. 1538 LIMA - LIMA - LA VICTORIA                             ', 241, 216, 29, 217, '324-5015                           ', '', 3, 1, 0, 1, 1),
(408, '', '10105044696', 'MEDINA ESPIRITU SILVIA                                      ', 'NRO.MZ.I INT.LT22 URB.SOL DE VITARTE (ALT.GRIFO VISTA ALEGRE) ATE-LIMA     ', 241, 216, 29, 217, '                                   ', '', 5, 1, 0, 1, 1),
(409, '', '20563545811', 'MEGA PART\' S TEJEDA S.R.L.                                  ', 'AV. CALCA NRO. 290 COO. VEINTISIETE DE ABRIL LIMA - LIMA - ATE             ', 241, 216, 29, 217, '997524884', '', 1, 1, 0, 1, 1),
(410, '', '10104606666', 'MELO CARLOS ELMER SEGUNDINO                                 ', 'AV.WIESSE MZA.D1 LOTE.39 URB.CORMERCIAL ARTESANOS-LIMA-S.J.L               ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(411, '', '10105330788', 'MENDOZA ALTAMIRANO ALEXANDER                                ', 'AV.MESONES MURO# 1096 SEC.NUEVO HORIXONTE CAJAMARCA-JAEN                   ', 241, 216, 29, 217, '976075408', '', 2, 1, 0, 1, 1),
(412, '', '10454078425', 'MENDOZA CHICLLA CLEOFE                                      ', 'AV. PANAMERICANA 1410 APURIMAC - ABANCAY - ABANCAY                         ', 241, 216, 29, 217, '992738684', '', 1, 1, 0, 1, 1),
(413, '', '10324065569', 'MERIS REYES NELLY YOLANDA                                   ', 'AV. ANDRES AVELINO CACERES MZA B LT 2A            A.H 08 DE OCTUBRE- PUERTO', 241, 216, 29, 217, '\"794447, 571858, 952303792          \"', '', 1, 1, 0, 1, 1),
(414, '', '', 'MEZA LAURA JHON                                             ', 'AV CIRCUNVALACION 123(AL FRENT.GRIFO PAPIN) PUERTO MALDONADO               ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(415, '', '20601653223', 'MEZA PARTS. PERU S.A.C.                                     ', 'AV.PACHACUTEC 3501 URB.AV PACHACUTEC LIMA-LIMA-V.M.T                       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(416, '', '10432040777', 'MEZA TACAY ADOLFO                                           ', 'AV. PACHACUTEC NRO. 3501LIMA - LIMA - VILLA MARIA DEL TRIUNFO              ', 241, 216, 29, 217, '981487368', '', 1, 1, 0, 1, 1),
(417, '', '10419187637', 'MEZA TACAY JOLVER YNDALECIO                                 ', 'AV.PACHACUTEC 3465 P.J.HOGAR POLICIAL LIMA -VILLA MARIA DEL TRIUNFO        ', 241, 216, 29, 217, '990356523-990967482-*0120255       ', '', 2, 1, 0, 1, 1),
(418, '', '10295324941', 'MEZA VDA DE FUENTES SONIA                                   ', 'CAL. PUNO # 427B MIRAFLORES-AREQUIPA                                       ', 241, 216, 29, 217, '\"054281961,    959303316            \"', '', 1, 1, 0, 1, 1),
(419, '22222222', '', 'MICAS ELVIS                                                 ', 'SJL                                                                        ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(420, '', '', 'MICAS LARA                                                  ', 'SAN JUNA DE LURIGANCHO                                                     ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(421, '', '20516652951', 'MICAS YUCRA S.A.C.                                          ', 'PROLONGACION PARINACOCHAS NRO. 1383 LIMA - LIMA - LA VICTORIA              ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(422, '', '10060250664', 'MIGUEL APOLINARIO CARLOS GREGORIO                           ', 'JR.LAS MICAS125 URB LAS FLORES 78 (ALT.CDRA 17 AV PROCERES) S.J.L          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(423, '', '10437240031', '\"MILLA PACAN, SUSANA                                         \"', 'AV. MEXICO NRO. 1329  LIMA - LIMA - LA VICTORIA                            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(424, '', '10441010988', 'MINCHOLA RODRIGUEZ KARINA LISTH                             ', 'PROLON.UNION 1816 URB.LA RINCONADA LA LIBERTAD - TRUJILLO - TRUJILLO       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(425, '', '10090750131', 'MIRALLES SALAS RENEE GLORIA                                 ', 'AV.IQUITOS #353 INT.1-LA VICTORIA-LIMA                                     ', 241, 216, 29, 217, '4236505', '', 1, 1, 0, 1, 1);
INSERT INTO `cliente` (`id_clte`, `dni_clte`, `ruc_clte`, `nombre_clte`, `direcc_clte`, `pais_cte`, `depto_cte`, `provi_cte`, `dtto_clte`, `tlf_ctle`, `email_clte`, `vendedor_clte`, `estatus_ctle`, `condp_clte`, `sucursal_clte`, `lista_clte`) VALUES
(426, '', '10448573783', 'MONZON BARAZORDA JESUS                                      ', 'AV.PANAMERICANA  SN URB.PERIFERIE APURIMAC - ABANCAY - ABANCAY             ', 241, 216, 29, 217, '958005455', '', 1, 1, 0, 1, 1),
(427, '', '10463553225', 'MORALES BLAS MARIO JUNIOR                                   ', 'AV.TUPAC  AMARU #1712 ALTO MOCHICA-TRUJILLO-LA LIBERTAD                    ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(428, '', '10095503131', 'MORALES GUTIERREZ HUGO                                      ', 'AV.GERARDO UNGER 4513 Z.I.NARANJAL (Y 4517.) S.M.P - LIMA                  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(429, '', '10400025521', 'MORE COVEÑAS JOVANY                                         ', 'STAND 02 MZA. E LOTE. 22 INT. 02 URB. GRAU PIURA - PIURA - PIURA           ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(430, '', '10155833918', 'MORENO MACEDO BENJAMINA DOLORES                             ', 'AV.G.UNGER NRO4513 INT.39 URB. IND.NARANJAL LIMA - LIMA -INDEPENDENCIA     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(431, '', '20445113639', 'MULTI PART\'S E.I.R.L.                                       ', 'AV. JOSE PARDO NRO. 1733 P.J. MIRAFLORES CHIMBOTE                          ', 241, 216, 29, 217, '043-341639-OSWALDO ALVARADO        ', '', 1, 1, 0, 1, 1),
(432, '', '20448828175', 'MULTILLANTAS SAFARI S.A.C.                                  ', 'JR.CARABAYA 214 BARRIO PORTEÑO PUNO - PUNO - PUNO                          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(433, '', '20530762204', 'MULTILLANTAS Y REPUESTOS YUNGAY S.R.L.                      ', 'CAR.CENTRAL NRO. S/N (ESQ. JR.GRAU Y CARRET.CENTRAL)ANCASH -HUAYLAS - CARAZ', 241, 216, 29, 217, '#989217     ', '', 1, 1, 0, 1, 1),
(434, '', '20600838386', 'MULTIMARCAS AUTOMOTRIZ PEPE SOCIEDAD ANONIMA CERRADA        ', 'AV.28 DE AGOSTO 301 CENT PAUCARBAMBA HUANUCO - HUANUCO - AMARILIS          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(435, '', '20601453682', 'MULTISERVICIOS BEN PACK E.I.R.L.                            ', 'JR. SUCRE NRO. 493 BAR. LA FLORIDA - CAJAMARCA                             ', 241, 216, 29, 217, '76341302-970071678      ', '', 1, 1, 0, 1, 1),
(436, '', '20538865151', 'MULTISERVICIOS C-KARLOS AGENCY TRAVEL S.A.C.                ', 'AV.ANDRES AVELINO CACERES MZ O2 LT 17 A.H. HUAYCAN ZONA O                  ', 241, 216, 29, 217, '949145683', '', 1, 1, 0, 1, 1),
(437, '', '20491819228', 'MULTISERVICIOS LACSA E.I.R.L                                ', 'JR.JUAN BEATO MASIAS 418 LOT. SAN MARTIN DE PORRES - CAJAMARCA             ', 241, 216, 29, 217, '\"076340920 , # 860256               \"', '', 1, 1, 0, 1, 1),
(438, '', '20407804245', 'MULTISERVICIOS TRANSPORTES \'ORTIZ\' E.I.R.L                  ', 'JR.MIGUEL GRAU 1442 ANCASH - HUAYLAS - CARAZ                               ', 241, 216, 29, 217, '943182741-943182725      ', '', 2, 1, 0, 1, 1),
(439, '', '20602150691', 'MULTISERVIS HERRERA S.C.R.L                                 ', 'AV. PANAMERICANA NRO. KM2 APURIMAC - ABANCAY - ABANCAY                     ', 241, 216, 29, 217, '956006869', '', 2, 1, 0, 1, 1),
(440, '', '10222815881', 'MUÑOZ QUISPE CRISTINA DEL ROSARIO                           ', 'CAR.PANAMERICANA SUR 309 (KM. 199)ICA -CHINCHA -CHINCHA ALTA               ', 241, 216, 29, 217, '999972889', '', 1, 1, 0, 1, 1),
(441, '', '10198708165', 'MURIEL CACERES HERNAN RONALD                                ', 'JR.SANTA ISABEL 1558  JUNIN - HUANCAYO - EL TAMBO                          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(442, '', '10458698037', 'NARCIZO DE LA CRUZ KELLY VERONICA                           ', '\"LAS PRENSAS 231, STAND 8-INDEPENDENDIA                                     \"', 241, 216, 29, 217, '998330749', '', 1, 1, 0, 1, 1),
(443, '', '20512151508', 'NC AUTOPARTES S.A.C.                                        ', 'AV.INDEPENDENCIA # 389  - CAJAMARCA-              ', 241, 216, 29, 217, '\"076362983 , # 213722,     # 9628896\"', '', 1, 1, 0, 1, 1),
(444, '', '20447716675', 'NIPON CAR EIRL                                              ', 'JR. LAMBAYEQUE #539 SAN ROMAN-JULIACA                                      ', 241, 216, 29, 217, '#951916821                         ', '', 1, 1, 0, 1, 1),
(445, '', '10449944271', 'ÑACA BANEGAS SANDY NATALY                                   ', 'AV.CENTENARIO S/N INT.05 C.C. CENTENARIO TACNA - TACNA                     ', 241, 216, 29, 217, '923533861-988137017     ', '', 1, 1, 0, 1, 1),
(446, '', '10443684200', 'OJEDA RAMIREZ ORFELINDA                                     ', 'AV.PERU SN APURIMAC - ANDAHUAYLAS - ANDAHUAYLAS                            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(447, '', '10405943102', 'OLIVARES NAVARRO MARLENE VERONICA                           ', 'JR. LOS CAPULIES NRO. 143  JUNIN - TARMA - TARMA                           ', 241, 216, 29, 217, '#964079049     ', '', 3, 1, 0, 1, 1),
(448, '', '10056450390', 'OMAR HUACCHILLO PARDO                                       ', 'MZA. A LT. 9 AH.SAN JUAN DE COSCOMBA- CATACAOS- PIURA                      ', 241, 216, 29, 217, '969490312', 'OMAR_HP@HOTMAIL.COM   ', 1, 1, 0, 1, 1),
(449, '', '10200839931', 'ORE CASAS MARCO ANTONIO                                     ', 'JR. ATAHUALPA #419  JUNIN - HUANCAYO                                       ', 241, 216, 29, 217, '998486600', '', 3, 1, 0, 1, 1),
(450, '25453654', '', 'ORLANDO TITI                                                ', 'PROCERES DE LA INDEPENDENCIA                                               ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(451, '', '10205422868', 'OROSCO FLORES NEMIAS                                        ', 'AV.MARGINAL 722 URB.PICHANAKI JUNIN - CHANCHAMAYO - PICHANAQUI             ', 241, 216, 29, 217, '992227182-959484880-969530590      ', '', 1, 1, 0, 1, 1),
(452, '', '10403972199', 'OSCANOA HUAMANI JORGE ANTONIO                               ', 'AV. PROCERES DE LA INDEPENDEN NRO. 5549  SAN JUAN DE LURIGANCHO            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(453, '', '10429020099', 'PACHECO PANEZ PILAR ISABEL                                  ', 'AV.NICOLAS AYLLON 5021 COO.SO DE VITARTE-ATE                               ', 241, 216, 29, 217, '443-1247                           ', '', 1, 1, 0, 1, 1),
(454, '', '10024449594', 'PACORI QUISPE ALEJANDRO                                     ', 'JR. LIBERTAD NRO. 934 SAN ROMAN - JULIACA-JULIACA                          ', 241, 216, 29, 217, '951010860', '', 3, 1, 0, 1, 1),
(455, '', '10432130962', 'PALOMINO ARANGO CLEDY                                       ', 'MZA.H4 LOTE.21 AH. JOSE CARLOS MARIATEGUI S.J.L                            ', 241, 216, 29, 217, '946593426-947376499      ', '', 4, 1, 0, 1, 1),
(456, '', '10111111112', 'PANA                                                        ', 'SAN JUAN                                                                   ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(457, '', '', 'PANA : ALVARADO BELTRAN JULIO)                              ', 'WILLY RETO 3162 MZ C LT 4 URB.CANTO DEL SOL                                ', 241, 216, 29, 217, '\"3885915, 980358299                 \"', '', 1, 1, 0, 1, 1),
(458, '', '10435671646', 'PANIURA FLORES HEBERT ANGEL                                 ', 'AV. EL SOL NRO. 986 BARRIO PORTEñO PUNO                                    ', 241, 216, 29, 217, '951893747', '', 1, 1, 0, 1, 1),
(459, '               ', '10432530260', 'PARDO ALARCON CARLOS', 'AV.LUIS GONZALES 1650 INT.13 -LAMBAYEQUE CHICLAYO CHICLAYO  ', 241, 216, 29, 217, '', '                                                  ', 2, 1, 0, 1, 1),
(460, '', '10417321191', 'PARDO ALARCON HERMES                                        ', 'CAL.COIS 0504 OTR.CERCADO COIS I SECTOR LAMBAYEQUE - CHICLAYO - CHICLAYO   ', 241, 216, 29, 217, '#977226470                         ', '', 2, 1, 0, 1, 1),
(461, '', '10463094131', 'PARDO FERNANDEZ RONAL                                       ', 'AV.AUGUSTO B.LEGUIA 951 FERIA SAN LORENZO LAMBAYEQUE - CHICLAYO            ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(462, '', '10295751482', 'PAREDES HUAMAN DE CONDORI AURELIA                           ', 'AV. MANCO INCA NRO. 300 CUSCO - CUSCO - WANCHAQ                            ', 241, 216, 29, 217, '#944921826-963509949      ', '', 1, 1, 0, 1, 1),
(463, '', '10420967735', 'PARICAHUA PARICAHUA EUDES VIDAL                             ', 'JR. LIBERTAD NRO. 936 SAN ROMAN - JULIACA                                  ', 241, 216, 29, 217, '951503450', '', 1, 1, 0, 1, 1),
(464, '', '10706768390', 'PARIONA CARDENAS NERIDA                                     ', 'AV.SESQUICENTENARIO SN APURIMAC - ANDAHUAYLAS - ANDAHUAYLAS                ', 241, 216, 29, 217, '958201791', '', 2, 1, 0, 1, 1),
(465, '', '10102807711', 'PARIONA OSCCO LUIS ALBERTO                                  ', 'AV. FERNANDO WIESE MZA. B1 LOTE. 19 URB. LOS PINOS                         ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(466, '', '', 'PAUCAR DAVID                                                ', 'ATE                                                                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(467, '', '10040330696', 'PAUCAR QUISPE DOMINGO                                       ', 'AV.ANDRES AVELINO CACERES LT 16 A.H. HUAYCAN                               ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(468, '', '10252226511', 'PEREZ LLOCLLE JOSE EDUARDO                                  ', 'AV. TINTAYA NRO. 605 (FRENTE AL GRIFO SAN JOSE) CUSCO - ESPINAR - ESPINAR  ', 241, 216, 29, 217, '#984529944-987188414   ', '', 1, 1, 0, 1, 1),
(469, '               ', '20571384834', 'PEROTYY E.I.R.L.', 'AV.FRANCISCO BOLOG.127 BAR.ROSAS PAMP-ANCASH-HUARAZ         ', 241, 216, 29, 217, '                    ', '                                                  ', 2, 1, 0, 1, 1),
(470, '', '10224870626', 'PONCE SANTAMARIA TOMAS                                      ', 'MLC.DANIEL ALOMIA ROBLES #713 INT.A HUANUCO - HUANUCO                      ', 241, 216, 29, 217, '#255207      ', '', 1, 1, 0, 1, 1),
(471, '', '10434166859', 'POSTIGO MAYTA MARTHA VICTORIA                               ', 'JR. LIBERTAD #815 LAS MERCEDES PUNO-SAN ROMAN-JULIACA                      ', 241, 216, 29, 217, '951995188', '', 1, 1, 0, 1, 1),
(472, '', '10066654856', 'PULACHE SANDOVAL EDUARDO EMILIO                             ', 'UCV 2 ZONA B LOTE. 57 HUAYCAN                                              ', 241, 216, 29, 217, '\"943150657,     988449347,    994080\"', '', 1, 1, 0, 1, 1),
(473, '', '10438617359', 'PUMA HUAMAN NILTON ISAAC                                    ', 'JR.JUNIN MZA.12A LT38 MADRE DE DIOS - TAMBOPATA - TAMBOPATA                ', 241, 216, 29, 217, '082-621514-986822357      ', '', 3, 1, 0, 1, 1),
(474, '', '10208966869', 'PURIS HUARANGA EDMUNDO MARCIANO                             ', 'AV.ANDRES AVELINO CACERES LT13 A.H.HUAYCAN ZONA O -ATE                     ', 241, 216, 29, 217, '949197418', '', 5, 1, 0, 1, 1),
(475, '', '10424641567', 'QUINO CCOÑAS ALVINA                                         ', 'AV.PANAMERICANA NRO.SN APURIMAC - ABANCAY - ABANCAY                        ', 241, 216, 29, 217, '975471694', '', 1, 1, 0, 1, 1),
(476, '', '10021523904', 'QUISPE CATACORA DE SAAVEDRA HILDA VICTORIA                  ', 'JR.LIBERTAD 883 CERCADO PUNO-SAN ROMAN-JULIACA                             ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(477, '', '10439089208', 'QUISPE CHUA JAVIER                                          ', 'AV. PROCERES DE LA INDEPENDENCIA NRO. 2223 A.V. LOS POSTES LIMA - SJL      ', 241, 216, 29, 217, '910748581', '', 1, 1, 0, 1, 1),
(478, '', '10252172896', 'QUISPE HIRPAHUANCA BERTHA                                   ', 'LOTE. 5 URB. KANTU - TRES DE MAYO CUSCO - CUSCO - SAN JERONIMO             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(479, '', '10074628783', 'QUISPE MAMANI GERARDO                                       ', 'CAL. PUNO # 557A MIRAFLORES-AREQUIPA                                       ', 241, 216, 29, 217, '54406455', 'BUJI1818@HOTMAIL.COM   ', 1, 1, 0, 1, 1),
(480, '', '10249656645', 'QUISPE SICOS NICOLASA                                       ', 'AV. MANCO INCA NRO. 307  CUSCO - CUSCO - WANCHAQ                           ', 241, 216, 29, 217, '974260627', '', 1, 1, 0, 1, 1),
(481, '', '10320432117', 'RAFAEL PAJUELO IGNACIO ANATOLIO                             ', 'AV.PROGRESO 199  ANCASH - CARHUAZ - CARHUAZ                                ', 241, 216, 29, 217, '941969 709-043394216       ', 'JE.-LGF.-@HOTMAIL.COM    ', 1, 1, 0, 1, 1),
(482, '', '10433348988', 'RAMIREZ CACERES MAICOL OSNI                                 ', 'CAR.PANAM.NORTE KM.1018 LIMONCILLO LIMA - BARRANCA                         ', 241, 216, 29, 217, '944486923-951947118      ', '', 2, 1, 0, 1, 1),
(483, '', '10158505989', 'RAMIREZ ESPADA HONORATO FROILAN                             ', 'LIMONCILLO #1018 LIMA - BARRANCA - BARRANCA                                ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(484, '', '10411179180', 'RAMIREZ TERRONES EDGAR                                      ', 'JR. 20 DE ABRIL NRO. C-17 URB. MOYOBAMBA-SAN MARTIN - MOYOBAMBA            ', 241, 216, 29, 217, '966682009', '', 1, 1, 0, 1, 1),
(485, '', '10199306893', 'RAMON RAMOS ALBERTA CLEMENCIA                               ', 'AV.JOSE CARLOS MARIATEGUI 385 INT.A  JUNIN - HUANCAYO - EL TAMBO           ', 241, 216, 29, 217, '999048918', '', 3, 1, 0, 1, 1),
(486, '', '10199140979', 'RAMON RAMOS ESTELITA VICTORIA                               ', 'AV. JOSE CARLOS MARIATEGUI 387 JUNIN - HUANCAYO - EL TAMBO                 ', 241, 216, 29, 217, '964888244', '', 1, 1, 0, 1, 1),
(487, '', '10422978939', 'RAMOS CARAZAS KARINA VERONICA                               ', 'NRO. S/N INT. 47 ASOC.COM.MANUEL A.ODRIA TACNA-TACNA-TACNA                 ', 241, 216, 29, 217, '#952855394   ', '', 1, 1, 0, 1, 1),
(488, '', '10404700613', 'RAMOS HUANCA PERCY VIDAL                                    ', 'JR.MACHU PICCHU 290 URB.LA CAPILLA PUNO - SAN ROMAN - JULIACA              ', 241, 216, 29, 217, '951454878', '', 3, 1, 0, 1, 1),
(489, '', '20514800236', 'RED CAR E.I.R.L.                                            ', 'PROL. FRANCIA NRO. 1700-LA VICTORIA-LIMA                                   ', 241, 216, 29, 217, '3245432 NEX:(99)823*3425  / RPM:*53', '', 1, 1, 0, 1, 1),
(490, '', '10418695396', 'RENDON CORDOVA PERCY DAVID                                  ', 'AV. HUAYNA CCAPAC # 302-WANCHAQ-CUSCO                                      ', 241, 216, 29, 217, '974313731', '', 3, 1, 0, 1, 1),
(491, '', '10239983010', 'RENDON TORRES MARCELINA                                     ', 'AV. HUAYNA CCAPAC # 302 - WANCHAQ- CUSCO                                   ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(492, '', '', 'REPRESENTACIONES CENTENARIO                                 ', '\"SR: ANTONIO, SRA OLGA-LURDES                                               \"', 241, 216, 29, 217, '\"3762940, 3752565                   \"', '', 1, 1, 0, 1, 1),
(493, '', '20448608990', 'REPRESENTACIONES DIAZ AUTOMOTRIZ NIPPOM CAR\'S SCRL          ', '\"JR. LAMBAYEQUE #541 BARRIO TUPAC AMARU,SAN ROMAN-JULIACA                   \"', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(494, '', '', 'REPRESENTACIONES GENERALES PERU                             ', 'REGEPSA                                                                    ', 241, 216, 29, 217, '\"ANEXO 105, 4853236, SR.JIBAJA      \"', '', 1, 1, 0, 1, 1),
(495, '', '20229718836', 'REPRESENTACIONES SAN GREGORIO E I R L                       ', 'AV. ESPINAR NRO. 541 DPTO. B LIMA - HUAURA - HUACHO                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(496, '', '20515090569', 'REPSAN REPRESENTACIONES S.A.C.                              ', '\"AV, BUENOS AIRES 806 SULLANA-PIURA                                         \"', 241, 216, 29, 217, '\"073-501285, #389710                \"', 'REPSANSAC@SPEEDY.COM.PE -', 1, 1, 0, 1, 1),
(497, '', '20132111678', 'REPUESTERA TRUJILLO S R L                                   ', 'AV. PERU NRO. 372 LA LIBERTAD - TRUJILLO - TRUJILLO                        ', 241, 216, 29, 217, '044-223449-945049788               ', '', 2, 1, 0, 1, 1),
(498, '               ', '20600792149', 'REPUESTOS &amp; LUBRICANTES JARUMI S.A.C.', 'CAR.CENTRAL S/N BAR.LA ESPERANZA-ANCASH HUAY-CARAZ          ', 241, 216, 29, 217, '', 'REPUESTOS_JARUMI@HOTMAIL.COM                      ', 2, 1, 0, 1, 1),
(499, '', '20481955808', 'REPUESTOS ABELITO IMPORTACION Y SERVICIOS SAC               ', 'PROL.CESAR VALLEJO#909-TRUJILLO-LA LIBERTAD                                ', 241, 216, 29, 217, '044214566 CONT-044252313           ', '', 1, 1, 0, 1, 1),
(500, '', '20445694348', 'REPUESTOS ANDRESITO E.I.R.L.                                ', 'PROL PARDO NRO. 1898 CHIMBOTE                                              ', 241, 216, 29, 217, '943975770', '', 1, 1, 0, 1, 1),
(501, '', '20529559713', 'REPUESTOS AUTO PERU CARS E.I.R.L.                           ', 'JR. SUCRE NRO. 397 CAJAMARCA - CAJAMARCA - CAJAMARCA                       ', 241, 216, 29, 217, '76313980', '', 1, 1, 0, 1, 1),
(502, '', '20527556466', 'REPUESTOS AUTOMOTRICES EL AMIGO S.R.L.                      ', 'AV. HUAYRUROPATA # 1710 WANCHAQ- CUSCO                                     ', 241, 216, 29, 217, '\"084-235194, 984928108              \"', '', 1, 1, 0, 1, 1),
(503, '', '20531691980', 'REPUESTOS AUTOMOTRICES MARIN E.I.R.L.                       ', 'PRLG. PARDO NRO. 1898 INT. A- CHIMBOTE                                     ', 241, 216, 29, 217, '943805153', '', 1, 1, 0, 1, 1),
(504, '', '20482431934', 'REPUESTOS AUTOMOTRIZ ELIZABETH E.I.R.L.                     ', 'JR.PUNO#570 URB.ARANJUEZ-TRUJILLO-LA LIBERTAD                              ', 241, 216, 29, 217, '\"044-202088, 949590891              \"', '', 2, 1, 0, 1, 1),
(505, '', '20480426194', 'REPUESTOS EL PACIFICO E.I.R.L.                              ', 'AV. AUGUSTO B LEGUIA NRO. 900 CHICLAYO                                     ', 241, 216, 29, 217, '\"*0042022, *0042040                 \"', '', 1, 1, 0, 1, 1),
(506, '', '20216185197', 'REPUESTOS LADERA EMPRESA INDIV RESP LTDA                    ', 'AV.FCO DE PAULA OTERO NRO. 433 JUNIN - TARMA - TARMA                       ', 241, 216, 29, 217, '#996966050     ', '', 3, 1, 0, 1, 1),
(507, '', '20118981066', 'REPUESTOS M. MENDOZA E.I.R.LTDA.                            ', 'AV. TUPAC AMARU NRO. 202 LIMA - HUAURA - HUACHO                            ', 241, 216, 29, 217, '\"2321999, #681534                   \"', '', 1, 1, 0, 1, 1),
(508, '', '20481892296', 'REPUESTOS MIGUELITOS S.A.C.                                 ', 'AV.CESAR VALLEJO #833 ARANJUEZ-TRUJILLO-LA LIBERTAD                        ', 241, 216, 29, 217, '\"RPM #988180884, nex:639*1321 , 044-\"', '', 1, 1, 0, 1, 1),
(509, '', '20494942896', 'REPUESTOS MONTAÑO S.A.C.                                    ', 'JR.PROTZEL #209 HUAMANGA - AYACUCHO                                        ', 241, 216, 29, 217, '\"966825767,   #809267               \"', '', 1, 1, 0, 1, 1),
(510, '', '20494942896', 'REPUESTOS MONTAÑO SAC                                       ', 'JR.PROTZEL #209 HUAMANGA - AYACUCHO                                        ', 241, 216, 29, 217, '\"RPM 809267, 966825767              \"', '', 1, 1, 0, 1, 1),
(511, '', '20477376488', 'REPUESTOS NICOLL E.I.R.L.                                   ', 'PROLONG. UNION 1971-A NRO. . URB. LOS GRANADOS  LA LIBERTAD - TRUJILLO     ', 241, 216, 29, 217, '945049788', '', 1, 1, 0, 1, 1),
(512, '               ', '20525713599', 'REPUESTOS RIOS S.R.L.', 'CAL. UNION NRO. 377 A.H. JUAN VELASCO ALVARADO - PIURA SULLA', 241, 216, 29, 217, '', '                                                  ', 1, 1, 0, 1, 1),
(513, '', '20525309976', 'REPUESTOS ROLANDO S.R.L                                     ', 'AV.BUENOS AIRES 800-SULLANA-PIURA                                          ', 241, 216, 29, 217, '\"073-491377, #304100 ROLANDO.  96957\"', '', 1, 1, 0, 1, 1),
(514, '', '', 'REPUESTOS SALIM                                             ', '                                                                           ', 241, 216, 29, 217, '5342061', '', 1, 1, 0, 1, 1),
(515, '', '20481428344', 'REPUESTOS TEJADA SRL                                        ', 'CAL. CHIRA NRO. 210 URB. EL MOLINO LA LIBERTAD - TRUJILLO - TRUJILLO       ', 241, 216, 29, 217, '208362', '', 1, 1, 0, 1, 1),
(516, '', '20481137617', 'REPUESTOS TICO SAC                                          ', 'AV.PERU #880 LA INTENDENCIA-TRUJILLO-LA LIBERTAD                           ', 241, 216, 29, 217, '203441', '', 1, 1, 0, 1, 1),
(517, '', '20601133785', 'REPUESTOS Y ACCESORIOS DAY CAR S.A.C.                       ', 'AV.JORGE BASADRE GROHMANN MZA. M LT16 ASOCIACION RAMON COPAJA TACNA        ', 241, 216, 29, 217, '924216255-970475025     ', '', 3, 1, 0, 1, 1),
(518, '', '20452387418', 'REPUESTOS Y ACCESORIOS KIKE E.I.R.L.                        ', 'CAL.AYACUCHO 605 (AL COSTADO DEL PODER JUDICIAL)ICA - ICA                  ', 241, 216, 29, 217, '56217209-956492134 -966690889      ', '', 1, 1, 0, 1, 1),
(519, '               ', '20480192690', 'REPUESTOS Y ACCESORIOS NIKKO E.I.R.L.', 'AV.AUGUSTO B.LEGUIA 1206 URB.SAN LORENZO-LAMBAYEQUE         ', 241, 216, 29, 217, '', '                                                  ', 2, 1, 0, 1, 1),
(520, '', '20600807391', 'REPUESTOS Y ACCESORIOS NIKOCAR E.I.R.L.                     ', 'AV. CESAR VALLEJO NRO. 697 URB. PALERMO ET. 1 LA LIBERTAD-TRUJILLO-TRUJILLO', 241, 216, 29, 217, '961005905', '', 2, 1, 0, 1, 1),
(521, '', '20477241558', 'REPUESTOS Y ACCESORIOS R & R SAC                            ', 'AV.SALVADOR LARA #910 SEC.LOS GERANIOS-TRUJILLO-LA LIBERTAD                ', 241, 216, 29, 217, '\"*790406, 949905113                 \"', '', 1, 1, 0, 1, 1),
(522, '', '20455352666', 'REPUESTOS Y ACCESORIOS UNIVERSO E.I.R.L.                    ', 'CAL. PUNO NRO. 513 AREQUIPA  - MIRAFLORES                                  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(523, '', '20525983031', 'REPUESTOS Y AUTOPARTES UNION E.I.R.L.                       ', '\"AV.BUENOS AIRES 298, JUAN ALVARADO-SULLANA                                 \"', 241, 216, 29, 217, '\"073-706032, 969894743:ELIA VILLALTA\"', '', 1, 1, 0, 1, 1),
(524, '', '20487753654', 'REPUESTOS Y FRENOS BRAVO S.A.C.                             ', 'CAL. FERREÑAFE NRO. 101 URB. SAN LORENZO-CHICLAYO                          ', 241, 216, 29, 217, '#995472730                         ', '', 1, 1, 0, 1, 1),
(525, '', '20494867827', 'REPUESTOS Y LUBRICANTES CARLITOS  E.I.R.L.                  ', 'PROL.GRAU # 300 PARCONA - ICA                                              ', 241, 216, 29, 217, '\"233399, *145547                    \"', '', 1, 1, 0, 1, 1),
(526, '', '20525538223', 'REPUESTOS Y LUBRICANTES FLORES S.A.C                        ', 'JR.ZANJON 484 PIURA - PAITA - PAITA                                        ', 241, 216, 29, 217, '*039-650       ', '', 1, 1, 0, 1, 1),
(527, '', '20525774628', 'REPUESTOS Y LUBRICANTES HNOS. CALDERON S.R.L.               ', 'CAL. UNION NRO. 273 A.H. SANTA TERESITA PIURA - SULLANA                    ', 241, 216, 29, 217, '\"073506659 , *709815                \"', '', 1, 1, 0, 1, 1),
(528, '', '20525948391', 'REPUESTOS Y LUBRICANTES LUCHO E.I.R.L                       ', 'AV. BUENOS AIRES NRO. 318 A.H. 09 DE OCTUBRE-SULLANA-PIURA                 ', 241, 216, 29, 217, '\"073-508927, 073-490066, #392325    \"', '', 1, 1, 0, 1, 1),
(529, '', '20509732800', 'REPUESTOS Y RODAMIENTOS GABACAL SOCIEDAD ANONIMA CERRADA    ', 'AV.IQUITOS #283 -LA VICTORIA                                               ', 241, 216, 29, 217, '3312187', '', 1, 1, 0, 1, 1),
(530, '', '20479544361', 'REPUESTOS Y RODAMIENTOS LEGUIA EIRL                         ', 'AV. AUGUSTO B.LEGUIA NRO. 920 INT. A-CHICLAYO                              ', 241, 216, 29, 217, '\"074-251367 , #950397               \"', '', 1, 1, 0, 1, 1),
(531, '', '', 'REPUESTOS Y SERVICIOS ELECTRICOS LEO DIESEL S.A.C.          ', 'CAL.PUERTO ARGENTINO MZA.B LT15 LAS MALVINAS-TRUJILLO-LA LIBERTAD          ', 241, 216, 29, 217, '\"044-345834, 044-217304, #0354567   \"', '', 1, 1, 0, 1, 1),
(532, '', '', 'RESPUESTOS SEHON                                            ', 'SRA MARY                                                                   ', 241, 216, 29, 217, '945938998', '', 1, 1, 0, 1, 1),
(533, '', '10096673243', 'REYES ESPADA MANUEL JESUS                                   ', 'AV.CONF.INTERNACIONAL OESTE # 201-B ANCASH                                 ', 241, 216, 29, 217, '\"043428255 , *0338134,968362193,9389\"', '', 1, 1, 0, 1, 1),
(534, '', '10257541369', 'REYNALTE TRUJILLO TEODORICO MARTIN                          ', 'AV.GERARDO UNGER #4463 INT. B URB. EL NARANJAL (ZONA INDUSTRIAL) LIMA - LIM', 241, 216, 29, 217, '\"98274493, 5216184, 988197966, 25034\"', '', 1, 1, 0, 1, 1),
(535, '', '10441065120', 'RIOS SANCHEZ EDWIN PAUL                                     ', 'CAL. UNION NRO. 110 SULLANA- PIURA                                         ', 241, 216, 29, 217, '#288094                            ', '', 1, 1, 0, 1, 1),
(536, '', '10096861791', 'ROCCA HUAMAN PERCY                                          ', 'AV.SEPAR.INDUST.MZ.M LT.26 ASOC.FERROVIARIA-IV ETAPA VILLA EL SALVADOR     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(537, '', '20481220352', 'RODAMIENTOS DEL CASTILLO E.I.R.L.                           ', 'AV. CESAR VALLEJO 836 - TRUJILLO                                           ', 241, 216, 29, 217, '044-291104/ #949408211             ', '', 1, 1, 0, 1, 1),
(538, '', '20526056281', 'RODAMIENTOS Y REPRESENTACIONES TALLEDO EIRL                 ', 'AV. BOLOGNESI NRO. 308- PIURA                                              ', 241, 216, 29, 217, '\"*776826 , #968947147               \"', '', 1, 1, 0, 1, 1),
(539, '', '20412159501', 'ROGGER AUTOMOTRIZ E.I.R.L.                                  ', 'JR. SANTA LUCIA  #208 - CHACHAPOYAS      AMAZONAS                          ', 241, 216, 29, 217, '\"041479157,941981092, 966968190,9821\"', '', 2, 1, 0, 1, 1),
(540, '', '10102463213', 'ROJAS CHOCCA ARMANDO                                        ', 'AV.PLAN VIAL METROP.MZA.J LOT.08 ASOC FORTALEZA DE VITARTE-ATE-LIMA        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(541, '', '10409137895', 'ROJAS SAENZ LEYDI LOURDES                                   ', 'AV.MARIATEGUI 240 SEC.07  JUNIN - HUANCAYO - EL TAMBO                      ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(542, '', '20402959763', 'ROKASA SAC                                                  ', 'AV. JOSÉ PARDO NRO. 1154-CHIMBOTE                                          ', 241, 216, 29, 217, '043-344573 SRTA ROCIO FLORES       ', '', 1, 1, 0, 1, 1),
(543, '', '20514432768', 'ROMA IMPORT&EXPORT INTERNAZIONALE S.A.C.                    ', 'AV. AVIACION #895 LA VICTORIA-LIMA                                         ', 241, 216, 29, 217, '3245926 / 3256828                  ', '', 1, 1, 0, 1, 1),
(544, '', '10102365874', 'ROMERO ALVA RICHARD FRANK                                   ', 'AV. IQUITOS 557 CERCADO (ALT. MUNICIPALIDAD DE LA VICTORIA)LA VICTORIA     ', 241, 216, 29, 217, '3330154', '', 1, 1, 0, 1, 1),
(545, '', '10100559671', 'ROMERO APOLINARIO LUIS                                      ', 'MZA.D LT.3 RESI PRADERAS DE PARIACHI (2DA ETAPA)LIMA - LIMA - ATE          ', 241, 216, 29, 217, '949197418', '', 1, 1, 0, 1, 1),
(546, '', '20492173585', 'ROMERO DIESEL S.A.C.                                        ', 'CAL.RAMIRO PRIALE # 145  LIMA - ATE                                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(547, '', '10316642948', 'ROMERO FIGUEROA TIMOTEO MAURO                               ', 'AV.ARIAZ GRAZIANI S/N (JUNTO AL PUENTE DE YUNGAY)ANCASH -YUNGAY-YUNGAY     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(548, '', '10167238802', 'ROMERO RONCAL SANTOS ALEJANDRO                              ', 'AV. AUGUSTO B LEGUIA NRO. 951 INT. S-96 CHICLAYO                           ', 241, 216, 29, 217, '979914929 /#929976                 ', '', 1, 1, 0, 1, 1),
(549, '', '10329544911', 'ROQUE CARRASCO JHON MARCO                                   ', 'AV.CONFRAT.INTER.OESTE #195 ANCASH                                         ', 241, 216, 29, 217, '\" # 0031336 , 220619                \"', '', 1, 1, 0, 1, 1),
(550, '', '10426209271', 'ROQUE INCHICAQUI ABRAHAM HILARIO                            ', 'AV.FRANCISCO BOLOGNESI 137 BAR HUARUPAMPA ANCASH- HUARAZ-HUARAZ            ', 241, 216, 29, 217, '944923089', '', 1, 1, 0, 1, 1),
(551, '', '10408723359', 'ROSALES JORGE LIDIA ROSMERY                                 ', 'AV. FCO. DE PAULA DE OTERO NRO. 663 SEC. JUNIN - TARMA - TARMA             ', 241, 216, 29, 217, '9950976997 -995097699              ', '', 3, 1, 0, 1, 1),
(552, '', '10012147118', 'RUELAS SOTO LEONIDAS                                        ', 'JR. ANDAHUAYLAS NRO. 144 BARRIO PORTEÑO PUNO                               ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(553, '', '10230973861', 'RUFINO NUÑEZ HERIOL                                         ', 'JR.GARCIA NARANJO #150 TDA01-LA VICTORIA                                   ', 241, 216, 29, 217, '\"2400735, 995104316                 \"', '', 1, 1, 0, 1, 1),
(554, '', '10021519095', 'SAAVEDRA CAMPOS FORTUNATO                                   ', 'JR.LIBERTAD #1121 BAR LAS MERCEDES-PUNO-SAN ROMAN-JULIACA                  ', 241, 216, 29, 217, '969675085', '', 3, 1, 0, 1, 1),
(555, '', '10021527926', 'SAAVEDRA CAMPOS LIDIA                                       ', 'JR.TUMBES 1955 BAR.MANCO CAPAC -PUNO - SAN ROMAN - JULIACA                 ', 241, 216, 29, 217, '933564819-#985181905 -951574241    ', '', 3, 1, 0, 1, 1),
(556, '', '10012902463', 'SAIRA ADUVIRI PEDRO                                         ', 'AV.FERNANDO LEON DE VIVERO NRO.S/N ICA - ICA - ICA                         ', 241, 216, 29, 217, '998100771', '', 1, 1, 0, 1, 1),
(557, '', '10166541315', 'SALAS RODRIGUEZ VICTOR MARTIN                               ', 'JR.SUCRE # 373 -CAJAMARCA                                                  ', 241, 216, 29, 217, '# 019333                           ', '', 1, 1, 0, 1, 1),
(558, '', '10413013491', 'SALAZAR LOLI YONI MARIA                                     ', 'JR.FRANCISCO BOLOGNESI 137URB. ROSAS PAMPA-HUARAZ-HUARAZ                   ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(559, '', '10103377086', 'SALCEDO LUJAN MIGUEL                                        ', 'AV.CENTENARIO 1863 BARRIO EL MILAGRO ANCASH - HUARAZ - INDEPENDENCIA       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(560, '', '10258446874', 'SALDAñA CALLE EDY                                           ', 'AV.MESONES MURO 924 SEC NUEVO HORIZONTE CAJAMARCA - JAEN - JAEN            ', 241, 216, 29, 217, '976919675', '', 2, 1, 0, 1, 1),
(561, '', '10102053953', 'SALVADOR ERAZO EDIE JESUS                                   ', 'CAL.LOS TALADROS NRO. 298 URB. EL NARANJAL LIMA - LIMA - INDEPENDENCIA     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(562, '', '10468953761', 'SALVADOR ERAZO LUIS ANGEL                                   ', 'CAL. LOS TALADROS 98 URB. NARANJAL                                         ', 241, 216, 29, 217, '982162732', '', 1, 1, 0, 1, 1),
(563, '', '10180958857', 'SALVADOR RODRIGUEZ SANTOS YSABEL                            ', 'AV.FERNANDO BELAUNDE 810 URB.LA PRIMAVERA LAMBAYEQUE- CHICLAYO - CHICLAYO  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(564, '', '10482825503', 'SANCHEZ LINARES JACKSON ADRIEL                              ', 'AV. AUGUSTO B. LEGUIA 1197-CHICLAYO                                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(565, '', '10427091371', 'SANCHEZ NUÑEZ DIANA MARCELINA                               ', 'CAL. 26 DE ABRIL 291 A.H. JUAN VELASCO ALVARADO PIURA-SULLANA-SULLANA      ', 241, 216, 29, 217, '956917863', '', 1, 1, 0, 1, 1),
(566, '', '10181825150', 'SANCHEZ RAMIREZ JOSE AGUSTIN                                ', 'PROL.CESAR VALLEJO #1633 A.H. EL PALOMAR-TRUJILLO-LA LIBERTAD              ', 241, 216, 29, 217, '044-215154                         ', '', 1, 1, 0, 1, 1),
(567, '', '10456396319', 'SANCHEZ TUESTA DIANA CAROLINA                               ', 'AV.AMERICA SUR#1287 URB.SANTO DOMINGUITO-TRUJILLO-LA LIBERTAD              ', 241, 216, 29, 217, '044-223449                         ', '', 1, 1, 0, 1, 1),
(568, '', '10471243952', 'SANCHEZ TUESTA JOSE LUIS                                    ', 'AV.PERU #372 LA INTENDENCIA-TRUJILLO-LA LIBERTAD                           ', 241, 216, 29, 217, '\"044-223449, *257963, #220779, 94999\"', '', 1, 1, 0, 1, 1),
(569, '', '10036693415', 'SANDOVAL SAAVEDRA ELSA                                      ', 'AV. MIGUEL GRAU 215 CAS. MONTERON-SULLANA                                  ', 241, 216, 29, 217, '073-669920                         ', '', 1, 1, 0, 1, 1),
(570, '', '10101559144', 'SANTIAGO ESPINOZA SOTERO AVELINO                            ', 'AV.GERARDO UNGER 4513 INT.18 NARANJAL-IND-LIMA-S.M.P                       ', 241, 216, 29, 217, '983274828', '', 1, 1, 0, 1, 1),
(571, '', '20407025807', 'SEMMAGE & CONSTRUCTORA SRL                                  ', 'CAR.CARRETERA CENTRAL NRO. 01 ANCASH - HUAYLAS - CARAZ                     ', 241, 216, 29, 217, '943615663-943789512      ', '', 1, 1, 0, 1, 1),
(572, '', '20602587771', 'SENATINO´S MOTOR PARTS E.I.R.L.                             ', 'AV. CENTENARIO NRO. 1863 BAR. EL MILAGRO ANCASH - HUARAZ - INDEPENDENC     ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(573, '', '20525307418', 'SERVICIOS Y REPUESTOS NEIRA EIRL                            ', 'AV. BOLOGNESI NRO. 403-PIURA                                               ', 241, 216, 29, 217, '\"073-309646, #972874302 ENRIQUE , *6\"', '', 1, 1, 0, 1, 1),
(574, '', '20491804204', 'SERVIPARTS S.R.L                                            ', 'JR.SUCRE #434 BR LA FLORIDA - CAJAMARCA                                    ', 241, 216, 29, 217, '\"076361339 , # 727569 , 976554504   \"', 'LIDIA_FLOR1@HOTMAIL.COM  ', 1, 1, 0, 1, 1),
(575, '', '20559885101', 'SERVIRENTS FG E.I.R.L.                                      ', 'JR.UNION 1817 URB.LOS GRANADOS TRUJILLO-LA LIBERTAD                        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(576, '', '10088932876', 'SHUAN RAMOS CIRILO ZENON                                    ', 'AV.MARIANO PASTOR SEVILLA MZ.CH LT.15 SECT 1 GRUPO 21 A LIMA-VILLA.SAL     ', 241, 216, 29, 217, '959011432', '', 1, 1, 0, 1, 1),
(577, '', '10179309101', 'SILVA CASTAÑEDA HEBERT ALEJANDRO                            ', 'CAL.CESAR VALLEJO  1615 A.H. SANTA ROSA-TRUJILLO-LA LIBERTAD               ', 241, 216, 29, 217, '#996464232     ', '', 1, 1, 0, 1, 1),
(578, '', '10417435188', 'SILVA HUARHUA KARINA JANNET                                 ', 'JR. CARABAYA NRO. 243 PUNO - SAN ROMAN - JULIACA                           ', 241, 216, 29, 217, '953460613', '', 3, 1, 0, 1, 1),
(579, '', '10415910784', 'SILVA TEJADA MIGUEL IVAN                                    ', 'AV.PROL CESAR VALLEJO #1770 INT B URB.LA RINCONADA-TRUJILLO-LA LIBERTAD    ', 241, 216, 29, 217, 'RPM #0135413                       ', '', 1, 1, 0, 1, 1),
(580, '', '10311916055', 'SILVERA RAMIREZ FREDY RAYMUNDO                              ', 'JR. PAMPACHIRI 148 APURIMAC - ANDAHUAYLAS - ANDAHUAYLAS                    ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(581, '', '10040094364', 'SOLANO POVIS ADELAIDA                                       ', 'PJ.LOS AROS 149 P.J. SAN JACINTO LIMA - LIMA - SAN LUIS                    ', 241, 216, 29, 217, '14741750', '', 1, 1, 0, 1, 1),
(582, '', '10701986798', 'SOLANO QUISPE NELSON                                        ', 'S.J.L                                                                      ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(583, '', '10210751063', 'SOLORZANO ESTEBAN JAIME                                     ', 'JR.SAN MATIAS 127 SEC.TARMA JUNIN - TARMA - TARMA                          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(584, '', '10717771082', 'SOLORZANO SALCEDO JHON CARLOS                               ', 'JR. SAN MATIAS #118 SEC. TARMA  JUNIN- TARMA- TARMA                        ', 241, 216, 29, 217, '955705176', '', 1, 1, 0, 1, 1),
(585, '', '10294158087', 'SONCCO ALVAREZ VICTORIA MARTINA                             ', 'CAL.PUNO NRO. 556 AREQUIPA - AREQUIPA - MIRAFLORES                         ', 241, 216, 29, 217, '966869535-958533656      ', '', 1, 1, 0, 1, 1),
(586, '', '10422587565', 'SOTO LAZO PATRICIA                                          ', 'AV. MARIATEGUI NRO. 316 JUNIN - HUANCAYO - EL TAMBO                        ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(587, '', '10418500412', 'SOTO VILLENA TEODOLINDA CARLOTA                             ', 'AV.PACHACUTEC 3483 A.H.HOGAR POLICIAL-LIMA-LIMA-V.M.T                      ', 241, 216, 29, 217, '967202447', '', 1, 1, 0, 1, 1),
(588, '', '20490395572', 'SPARE PARTS CORIMANYA E.I.R.L.                              ', 'AV. AREQUIPA NRO. 414 CUSCO - CANCHIS-SICUANI                              ', 241, 216, 29, 217, '974982994', '', 1, 1, 0, 1, 1),
(589, '', '20601249627', 'SPZ REPUESTOS E.I.R.L.                                      ', 'CAL.PUNO NRO. 546 AREQUIPA - AREQUIPA - MIRAFLORES                         ', 241, 216, 29, 217, '958578821', '', 3, 1, 0, 1, 1),
(590, '', '', 'SRA MECHE                                                   ', '                                                                           ', 241, 216, 29, 217, '958006527', '', 1, 1, 0, 1, 1),
(591, '11111111', '', 'SRA. ROSITA                                                 ', 'AV. PROCERES DE LA INDEPENDENCIA NRO. 2288 LIMA SJL                        ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(592, '', '', 'SRA. VARGAS                                                 ', 'SAN JUAN DE LURIGANCHO                                                     ', 241, 216, 29, 217, '931237610', '', 4, 1, 0, 1, 1),
(593, '', '10418927955', 'SUCASACA HALLASI DAVID                                      ', 'JR. LIBERTAD #1080 BARRIO MANCO CAPAC-SAN ROMAN-JULIACA                    ', 241, 216, 29, 217, '\"#995999934, 950810945,051-782852   \"', '', 1, 1, 0, 1, 1),
(594, '', '10004391336', 'SUCESION YANAPA RAMOS TEOFILO                               ', 'CAL.TALARA #1364 TACNA - TACNA                                             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(595, '', '10737665190', 'SULLCAHUAMAN HUARACA MARCO ANTONIO                          ', 'AV.PANAMERICANA 924 (COSTADO SERV.MORILLO)-ABANCAY-ABANCAY-ABANCAY         ', 241, 216, 29, 217, '957788752', '', 1, 1, 0, 1, 1),
(596, '', '10800267922', 'TACCA LEONARDO ANTONIO                                      ', 'JR. LIBERTAD NRO. 919-SAN ROMAN - JULIACA                                  ', 241, 216, 29, 217, '988-070609                         ', '', 1, 1, 0, 1, 1),
(597, '', '10800289811', 'TACCA LEONARDO EUGENIO                                      ', 'JR. LIBERTAD NRO. 905 PUNO - SAN ROMAN - JULIACA                           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(598, '10800289', '', 'TACCA LEONARDO EUGENIO                                      ', 'JR. LIBERTAD NRO. 905 PUNO - SAN ROMAN - JULIACA                           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(599, '', '10409499568', 'TACCA LEONARDO JUANA                                        ', 'JR.LIBERTAD #933 BARRIO MANCO CAPAC.PUNO-SAN ROMAN-JULIACA                 ', 241, 216, 29, 217, '\"950464433, 951591148               \"', '', 1, 1, 0, 1, 1),
(600, '', '10433645435', 'TACCA LEONARDO SALOMON                                      ', 'JR. CARABAYA 211 BARRIO MANCO CAPAC - PUNO - SAN ROMAN - JULIACA           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(601, '2446560', '', 'TACCA LEONARDO VICTORIA                                     ', 'JR. LIBERTAD NRO. 913 SAN ROMAN - JULIACA-JULIACA                          ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(602, '', '10423012604', 'TACCA ZELA LUCIANO                                          ', 'JR. CARABAYA NRO. 324 BR. MANCO CAPAC-SAN ROMAN-JULIACA                    ', 241, 216, 29, 217, '950802154', '', 1, 1, 0, 1, 1),
(603, '', '10448649577', 'TAIPE CUSI ROSSVELT MARTIN                                  ', 'AV.ARENALES 633  AYACUCHO - HUAMANGA - SAN JUAN BAUTISTA                   ', 241, 216, 29, 217, '990558520', '', 1, 1, 0, 1, 1),
(604, '', '10401370183', 'TANTARICO ARRIETA SANTOS                                    ', 'CAL.PROL.FEDERICO VILLAREAL #767 LAS MALVINAS-TRUJILLO-LA LIBERTAD         ', 241, 216, 29, 217, '947958364', '', 1, 1, 0, 1, 1),
(605, '', '10465151477', 'TARRILLO SILVA YANINA LISETH                                ', 'JR. JOSE ARANA NRO. 445 CENTR CHOTA CAJAMARCA - CHOTA - CHOTA              ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(606, '', '10277170731', 'TAVARA PEREZ JOSE MANUEL                                    ', 'AV.MESONES MURO # 1043 MORRO SOLAR-CAJAMARCA-CAJAMARCA                     ', 241, 216, 29, 217, '\"076431809, 976541109               \"', '', 2, 1, 0, 1, 1),
(607, '', '10246640195', 'TAYPE LAGUNA VICTORIANO                                     ', 'AV. AREQUIPA ACCOTA SN CUSCO - CANCHIS - SICUANI                           ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(608, '', '10478180689', 'TAYPE TACURI JESUS FERNANDO                                 ', 'AV. AREQUIPA NRO. S/N COM. ACCOTA CUSCO - CANCHIS - SICUANI                ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(609, '', '10413866141', 'TAYPE TACURI MARGARITA                                      ', 'AV. SANTA CRUZ NRO. SN  CUSCO - CANCHIS - SICUANI                          ', 241, 216, 29, 217, '985116166', '', 3, 1, 0, 1, 1),
(610, '', '10181905579', 'TEJADA MAYTA IRMA RAQUEL                                    ', 'AV. PROLONG.CESAR VALLEJO 890 INT.101 -TRUJILLO-LA LIBERTAD                ', 241, 216, 29, 217, '\"#949622667,                        \"', '', 1, 1, 0, 1, 1),
(611, '', '10239937875', 'TELLO ZEVALLOS SEGUNDINA                                    ', 'AV. TACNA # 300 WANCHAQ-CUSCO-CUSCO                                        ', 241, 216, 29, 217, '\"996,093,453,955,694,000,000,000,000\"', '', 1, 1, 0, 1, 1),
(612, '', '10438545293', 'TICONA PAREDES ESTHER                                       ', 'JR.LIBERTAD 919 SAN ROMAN-JULIACA                                          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(613, '65147892', '', 'TIITI                                                       ', 'PROCERES                                                                   ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(614, '', '10013267044', 'TIPULA TIPULA BENITO                                        ', 'AV. EL SOL NRO. 923 BARRIO PORTEñO-PUNO-PUNO-PUNO                          ', 241, 216, 29, 217, '950807168', '', 3, 1, 0, 1, 1),
(615, '', '10401879477', 'TIPULA TIPULA LIDIA                                         ', 'JR.CARABAYA 226 VICTORIA PUNO - PUNO - PUNO                                ', 241, 216, 29, 217, '978030032', '', 1, 1, 0, 1, 1),
(616, '', '10062517650', 'TITI CALSINA ROLANDO LUCHO                                  ', 'MZA.H9 LT.15 A.H. JOSE CARLOS (PDERO 6.5 AV WIESSE)-SJL                    ', 241, 216, 29, 217, '984027510', '', 1, 1, 0, 1, 1),
(617, '', '10457044611', 'TITO SUXSO ELENA                                            ', 'AV. TACNA NRO. 308 (COSTADO DE PUNTO AZUL) CUSCO - CUSCO - WANCHAQ         ', 241, 216, 29, 217, '958922971 O 958422971              ', '', 3, 1, 0, 1, 1),
(618, '', '10316660270', 'TOLEDO CARRION CLOTILDE ROSALINDA                           ', 'AV. ARIAS GRAZZIANI NRO. S/N-YUNGAY-ANCASH                                 ', 241, 216, 29, 217, '\"043-393284, RPM:989217             \"', '', 1, 1, 0, 1, 1),
(619, '', '10410124217', 'TORIBIO RODRIGUEZ ALEX HUMBERTO                             ', 'AV. F. VILLARREAL MZA. U LOTE. 15 SEMIRUSTICA EL BOSQUE-TRUJILLO-LA LIBERTA', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(620, '11111111', '', 'TORITO                                                      ', 'SAN JUAN DE LURIGANCHO                                                     ', 241, 216, 29, 217, '                                   ', '', 4, 1, 0, 1, 1),
(621, '', '10204349962', 'TORRES VERASTEGUI AMANDA SUSANA                             ', 'PJ.LOS AROS #165 P.J.SAN JACINTO-SAN LUIS-LIMA                             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(622, '', '20221172117', 'TRANSPORTES Y SERVICIOS MULTIPLES S A                       ', 'AV. ANCHOVETA MZA. B LOTE. 33 NUEVO CHIMBOTE                               ', 241, 216, 29, 217, '043311967 / 317150                 ', '', 1, 1, 0, 1, 1),
(623, '', '10717245119', 'TROYES RIMAPA JHON FRANKLIN                                 ', 'AV.CAJAMARCA 772 RES.CERCADO SAN MARTIN -RIOJA - NUEVA CAJAMARCA           ', 241, 216, 29, 217, '958606772', '', 1, 1, 0, 1, 1),
(624, '', '20506545081', 'TURBO MOTORS EIRL                                           ', 'AV.TUPAC AMARU 224-HUACHO                                                  ', 241, 216, 29, 217, '2391402', '', 1, 1, 0, 1, 1),
(625, '', '20508710888', 'UNITED CORP S.A.C.                                          ', 'CAL.PALLASCA 1430 URB.COVIDA 2DA ENTRADA LIMA - LIMA - LOS OLIVOS          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(626, '', '10411943211', 'URURI MARCA ABRAHAM                                         ', 'CAL.PUNO # 511C MIRAFLORES-AREQUIPA-AREQUIPA                               ', 241, 216, 29, 217, '\"054791983,   0548036909, 054791983 \"', '', 3, 1, 0, 1, 1),
(627, '', '10046410462', 'URURI MARCA EDILBERTO                                       ', 'CAL.PUNO NRO. 517 AREQUIPA - AREQUIPA - MIRAFLORES                         ', 241, 216, 29, 217, '950765048', 'UNIVERSO.AQP@GMAIL.COM        ', 3, 1, 0, 1, 1),
(628, '', '10266964001', 'VALDERRAMA SIGÜENZA JORGE LUIS                              ', 'JR.ALFONSO UGARTE 243A BR LA FLORIDA CAJAMARCA-CAJAMARCA-CAJAMARCA         ', 241, 216, 29, 217, '#944658306-976003827               ', '', 1, 1, 0, 1, 1),
(629, '', '10036410456', 'VALDIVIEZO SANTIN GILBERTO ENRIQUE                          ', 'CAL. BOLOGNESI NRO. 325 PIURA - SULLANA - SULLANA                          ', 241, 216, 29, 217, '073-504032                         ', '', 1, 1, 0, 1, 1),
(630, '', '', 'VALE CAR     - ENRIQUE VALENCIA LOZA                        ', 'JR.PARURO 1132 CENTRO COMERCIAL ELECTRO FERRETERA STAND 116                ', 241, 216, 29, 217, '4275517//942091751 /*0078915       ', '', 1, 1, 0, 1, 1),
(631, '', '10316556138', 'VALVERDE COLLAS OMAR RUBEN                                  ', 'CAR.CARRET.CENTRAL S/N U.V.BARR.YANACHACA ANCASH-HUAYLAS-CARAZ             ', 241, 216, 29, 217, '#964744347     ', '', 2, 1, 0, 1, 1),
(632, '', '10257537388', 'VARGAS CALLISAYA SUSANA EDITH                               ', 'CAL.LOS TALLERES 16 URB.INDUSTRIAL EL NARANJAL-INDEPENDENCIA-LIMA          ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(633, '', '10444383874', 'VARGAS CHACHAQUE JUAN PABLO                                 ', 'AV. JORGE BASADRE NRO.S/N INT. 24 ASOC.COM.CRISTINA VILDOSO TACNA          ', 241, 216, 29, 217, '\"935075910, 967293766               \"', '', 3, 1, 0, 1, 1),
(634, '', '10255770476', '\"VARGAS CHACHAQUE, EMERITA                                   \"', 'ASOC.COMERC.4 DE NOVIEMBRE INTS 19-64.AV.JORGE.BASA.S/N-TACNA-TACNA-TACNA  ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(635, '', '15387584541', 'VARGAS PACCO JULIAN MARCELO                                 ', 'AV.GERARDO UNGER 4523 URB.EL NARANJAL                                      ', 241, 216, 29, 217, '982162831', '', 1, 1, 0, 1, 1),
(636, '', '20487592626', 'VARGAS PINTADO GRACIELA                                     ', 'AV. AUGUSTO B. LEGUIA 951  STAND 111/114-CHICLAYO                          ', 241, 216, 29, 217, '*317350                            ', '', 1, 1, 0, 1, 1);
INSERT INTO `cliente` (`id_clte`, `dni_clte`, `ruc_clte`, `nombre_clte`, `direcc_clte`, `pais_cte`, `depto_cte`, `provi_cte`, `dtto_clte`, `tlf_ctle`, `email_clte`, `vendedor_clte`, `estatus_ctle`, `condp_clte`, `sucursal_clte`, `lista_clte`) VALUES
(637, '', '10419274335', 'VARGAS PINTADO LADY HONELIA                                 ', 'AV. AUGUSTO B.LEGUIA # 951 INT. 99 FERIA SAN LORENZO LAMBAYEQUE - CHICLAYO ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(638, '', '10167779897', 'VARGAS PINTADO MARIA AZUCENA                                ', 'AV. AUGUSTO B LEGUIA NRO. 951 INT. 58-CHICLAYO                             ', 241, 216, 29, 217, '\"979859852 , *0279736               \"', '', 1, 1, 0, 1, 1),
(639, '', '10473505075', 'VASQUEZ CALDERON FLOR MARIELA                               ', 'AV.VIA DE EVITAMIENTO SUR # 746 - CAJAMARCA                                ', 241, 216, 29, 217, '*602170                            ', '', 1, 1, 0, 1, 1),
(640, '', '10329636106', 'VASQUEZ INFANTES JUAN CARLOS                                ', 'AV.LIMONCILLO 1026 LIMA - BARRANCA                                         ', 241, 216, 29, 217, '#968167903    ', '', 3, 1, 0, 1, 1),
(641, '', '10095157144', 'VASQUEZ VASQUEZ WILMER ALFREDO                              ', 'AV.GERARDO UNGER 4553 INT.67 URB.INDUSTRIAL NARANJAL-LIMA-SMP              ', 241, 216, 29, 217, '996373226', '', 1, 1, 0, 1, 1),
(642, '', '20453822738', 'VECAMIV EIRL                                                ', 'JR.SUCRE #495 BR LA FLORIDA - CAJAMARCA                                    ', 241, 216, 29, 217, '\"076847122 , 976802638 , 976061057, \"', '', 1, 1, 0, 1, 1),
(643, '', '10709059195', 'VEGA PORTOCARRERO ALEXANDER                                 ', 'AV. NARANJAL NRO. 357 URB. INDUSTRIAL PANAMERICANA NORTE LIMA              ', 241, 216, 29, 217, '997196269', '', 1, 1, 0, 1, 1),
(644, '', '10106202554', 'VELA OCAMPO ROBERTO JENSEN                                  ', 'AV.PROCERES DE LA INDEPENDEN 1755 -SAN JUAN DE LURIGANCHO-LIMA             ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(645, '', '10413891383', 'VELARDE OROZ KATY INGRID                                    ', 'AV. INCA LLOQUE YUPANQUI MZA. Y LOTE. 8 C.C. ANEXO 22 JICAMARCA - LIMA - HU', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(646, '', '10102541052', 'VELASCO BEDREÑANA VICTOR EDDY                               ', 'AV. FERNANDO LEON DE VIVERO #311 INT.B  URB.SAN JOAQUIN VIEJO  - ICA       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(647, '', '', 'VELASQUE SILVERA DELFINA                                    ', 'JR.PANPACHIRI 162 APURIMAC-ANDAHUAYLAS                                     ', 241, 216, 29, 217, '995669980', '', 1, 1, 0, 1, 1),
(648, '', '10106138678', 'VELASQUE SILVERA HERMELINDA                                 ', 'JR.PANPACHIRI #148 APURIMAC-ANDAHUAYLAS-ANDAHUAYLAS                        ', 241, 216, 29, 217, '983666143 // TEL:205543            ', '', 2, 1, 0, 1, 1),
(649, '', '10408919661', 'VELASQUEZ ROJAS LUZMILA ROSA                                ', 'JR.CANDELARIA VILLAR SUB DIV #668 BARR. DE CENTENARIO-HUARAZ-ANCASH        ', 241, 216, 29, 217, '\"968362190, *0338124                \"', '', 1, 1, 0, 1, 1),
(650, '', '10415596206', 'VENTOCILLA HERRERA CARLOS DARWIN                            ', 'AV.ANDRES AVELINO CACERES LT.17 A.H. ZONA O LIMA - LIMA -SANTA ANITA       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(651, '', '10210816858', 'VICENTE MAXIMILIANO MARTA LUZ                               ', 'AV.JOSE CARLOS MARIATEGUI # 314 JUNIN - HUANCAYO - EL TAMBO                ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(652, '', '10200114961', 'VICENTE MAXIMILIANO SILA                                    ', 'AV. JOSE C. MARIATEGUI NRO. 336 JUNIN - HUANCAYO - EL TAMBO                ', 241, 216, 29, 217, '                                   ', '', 3, 1, 0, 1, 1),
(653, '', '20545948282', 'VICTCAM S.A.C.                                              ', 'CAL.RAMIRO PRIALE MZA. B1 LOTE. 9-ATE                                      ', 241, 216, 29, 217, '\"3484295,      #979047109,          \"', '', 1, 1, 0, 1, 1),
(654, '94727682', '', 'VICTOR ATAUJE FLORES                                        ', 'AV.MEXICO 1679-LA VICTORIA                                                 ', 241, 216, 29, 217, '947276826', '', 1, 1, 0, 1, 1),
(655, '', '10419534965', 'VILCA CAYLLAHUA TRINIDAD VIRGILIA                           ', 'CAL. PUNO # 562 MIRAFLORES-AREQUIPA                                        ', 241, 216, 29, 217, '\"958800150,    #999332280           \"', '', 1, 1, 0, 1, 1),
(656, '', '10024108894', 'VILCA TINTAYA LUCIA                                         ', 'JR.VILCANOTA 115  PUNO - SAN ROMAN - JULIACA                               ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(657, '', '10200889733', 'VILCAPOMA VILCAPOMA RUDE LUZ                                ', 'JR. ATAHUALPA NRO. 436 INT. 1 JUNIN - HUANCAYO-HUANCAYO                    ', 241, 216, 29, 217, '997596277', '', 1, 1, 0, 1, 1),
(658, '', '10232759939', 'VILCARANO CHAVEZ ZENON                                      ', 'AV.MARISCAL CACERES #323 HUAMANGA-AYACUCHO                                 ', 241, 216, 29, 217, '990060043', '', 2, 1, 0, 1, 1),
(659, '', '10083100708', 'VILCATOMA ALATA JOSE ANTONIO                                ', 'AV.JOSE DE LA TORRE UGARTE #102A-SJL                                       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(660, '', '10456267101', 'VILCATOMA GONZALES GRISELDA                                 ', 'AV.NICOLAS AYLLON 5007(ALT. DE COO. SOL DE VITARTE)LIMA - LIMA -ATE        ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(661, '', '10036518052', 'VILCHEZ SIANCAS DE CRESPO CARMEN DEL ROSARIO                ', 'CAL. UNION NRO. 110 A.H. EL OBRERO PIURA - SULLANA - SULLANA               ', 241, 216, 29, 217, '947602688', '', 1, 1, 0, 1, 1),
(662, '', '10296515171', 'VIZA CARLOSVIZA AGUSTINA BENITA                             ', 'AV.MANCO INCA 300 (1CDR DE SUNARP C2P 979242244) CUSCO-CUSCO-WANCHAQ       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(663, '', '20549905022', 'WIKAR E.I.R.L.                                              ', 'AV.ANDRES A.CACERES UVC 02 MZA.O LTE.12 A.H. HUAYCAN                       ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(664, '', '20542289610', 'WILKEANCAR S.A.C.                                           ', 'JR. BOLOGNESI NRO.648 SAN MARTIN - RIOJA - NUEVA CAJAMARCA                 ', 241, 216, 29, 217, '986667293', '', 2, 1, 0, 1, 1),
(665, '', '20538140181', 'WV DIESEL E.I.R.L.                                          ', 'PJ.LOS ROBLES MZA.I LT. 5A URBCANTO BELLO LIMA -SAN JUAN DE LURIGANCHO     ', 241, 216, 29, 217, '                                   ', '', 1, 1, 0, 1, 1),
(666, '', '10440337878', 'YAHUAIRE TACUNAN BELEN                                      ', 'AV. MEXICO NRO. 946 (FTE A PROLG.HUAMANGA)LIMA - LIMA - LA VICTORIA        ', 241, 216, 29, 217, '998226065', '', 1, 1, 0, 1, 1),
(667, '', '10703489678', 'YANAPA QUISPE SHAYDA NARDY                                  ', 'CAL.TALARA 1364 TACNA-TACNA-TACNA                                          ', 241, 216, 29, 217, '967684114', '', 3, 1, 0, 1, 1),
(668, '', '', 'YENY                                                        ', 'INDEPENDENCIA                                                              ', 241, 216, 29, 217, '                                   ', '', 2, 1, 0, 1, 1),
(669, '               ', '10461500108', 'YGLESIAS LEYVA JOSE LUIS', 'JR.SANTIAGO H.RABANAL 174 -CAJAMARCA CELENDIN CELENDIN      ', 241, 216, 29, 217, '', '                                                  ', 1, 1, 0, 1, 1),
(670, '', '10460374141', 'YZQUIERDO CERNA ROBERT BRYAN                                ', 'AV.GERARDO UNGER .4475 INT.59 URB.IND EL NARANJAL-S.M.P                    ', 241, 216, 29, 217, '983453123', '', 1, 1, 0, 1, 1),
(671, '', '10428725285', 'ZAMBRANO HUAMAN ELMER PERCY                                 ', 'JR. SANTA ROSA NRO. 720 CENTRO CHOTA CAJAMARCA - CHOTA - CHOTA             ', 241, 216, 29, 217, '951657364', '', 1, 1, 0, 1, 1),
(672, '', '10205242851', 'ZARATE SOTELO DELTA JULIETA                                 ', 'AV.FRAY JERONIMO JIMENEZ 953 URB.SAN CARLOS JUNIN-CHANCHAMAYO              ', 241, 216, 29, 217, '949632787', '', 3, 1, 0, 1, 1),
(673, '', '10198572174', 'ZUASNABAR CUNYAS ROBERTO VITALIANO                          ', 'AV.MARIATEGUI 719 JUNIN - HUANCAYO - EL TAMBO                              ', 241, 216, 29, 217, '930933736', '', 1, 1, 0, 1, 1),
(674, '', '20546548717', 'ZUKA IMPORT E.I.R.L.                                        ', 'AV.AVIACION #939 URB.SAN GERMAN-LA VICTORIA                                ', 241, 216, 29, 217, '\"3254280, 999994391, 950950620      \"', '', 1, 1, 0, 1, 1),
(675, '               ', '20517286533', 'COMERCIAL MIRELLA SAC                                       ', 'CAL. LOS  FAROS NRO. 197 URB. SAN JACINTO - LIMA LIMA SAN LU', 241, 216, 29, 217, '                    ', '                                                  ', 2, 1, 0, 1, 1),
(676, '               ', '', 'SPZ REPUESTOS E.I.R.L.                                      ', 'CAL. PUNO NRO. 546 - AREQUIPA AREQUIPA MIRAFLORES', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(677, '               ', '20603547978', 'MULTISERVICIOS REYES &AMP; INGENIEROS S.A.C.                ', 'JR.SANTIAGO ZAVALA  237-PBLO.HUAMACHUCO-LA LIBERTAD         ', 241, 216, 29, 217, '                    ', '                                                  ', 2, 1, 0, 1, 1),
(678, '               ', '10296854684', 'CORDOVA TICONA RICHARD FELIPE', 'CAL. PUENTE ARNAO NRO. 245 - AREQUIPA AREQUIPA MIRAFLORES', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(679, '', '10435957108', 'CONDORI PAREDES VICTOR SAUL', 'AV. MANCO CAPAC NRO. 411 - CUSCO CUSCO WANCHAQ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(680, '42275883', '10422758831', 'SUCATICONA APAZA RUTHY', 'JR. LIBERTAD NRO. 907 BAR. LAS MERCEDES - PUNO SAN ROMAN JUL', 241, 216, 29, 217, '', '                                                  ', 3, 1, 0, 1, 1),
(681, '70254078', '10702540785', 'QUISPE ORTEGA JULIO CESAR', 'JR. PUNO NRO. 669 CRUZANI -PUNO EL COLLAO ILAVE             ', 241, 216, 29, 217, '                    ', '', 3, 1, 0, 1, 1),
(682, '', '', 'CHILENO                                                     ', '', 241, 216, 29, 217, '', '', 1, 1, 0, 1, 1),
(683, '19970641', '10199706417', 'REMON TENORIO JULIA', 'AV.JOSE CARLOS MARIATE 315A -CERCADO EL TAMBO-HUANCAYO      ', 241, 216, 29, 217, '', '                                                  ', 3, 1, 0, 1, 1),
(684, '', '10442467647', 'HUAMAN OSORIO MELIN PAULINO', 'AV. CARABAYLLO NRO. 565 URB. SANTA ISOLINA 2DA ETAPA - LIMA ', 241, 216, 29, 217, '', '', 1, 1, 0, 1, 1),
(685, '9874512369', '', 'MICAS ALVAREZ                                               ', 'SJL                                                         ', 241, 216, 29, 217, '123456789', '                                                  ', 4, 1, 0, 1, 1),
(686, '               ', '10210804884', 'LEYVA MANSILLA OSWALDO                                      ', 'AV. JOSE DE AGUIRREZABAL NRO. S/N URB. PAMPA-JUNIN-CHANCHAMA', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(687, '43273158', '', 'GIANCARLO                                                   ', 'S-J-L                                                       ', 241, 216, 29, 217, '977596973', '                                                  ', 1, 1, 0, 1, 1),
(688, '75852692', '10758526921', 'FAUSTINO SANCHEZ FRANCISCO MAXIMO', 'AV. SAN LUIS NRO. 1427 - LIMA LIMA SAN LUIS', 241, 216, 29, 217, '                    ', '', 3, 1, 0, 1, 1),
(689, '               ', '10479994183', 'CUENCA ARROYO JHULISSA ELIZABETH', 'AV.VIA DE EVITA.SUR 761 P.J.HAYA DE LA TORRE-CAJAMARCA      ', 241, 216, 29, 217, '', '                                                  ', 2, 1, 0, 1, 1),
(690, '46791006', '10467910065', 'FLORES FLORES CHRISTIAN ALFREDO                             ', 'CAL.PUNO 604 MIRAFLORES-AREQUIPA-AREQUIPA                   ', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(691, '76572135', '', 'CALIZAYA APAZA YONATHAN                                     ', 'PUNO-PUNO-PUNO                                              ', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(692, '70182478', '', 'PACORI TACCA YESSICA ZADID                                  ', 'JR.LIBERTAD 913 SAN ROMAN-JULIACA-JULIACA                   ', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(693, '               ', '10229857458', 'FLORES FLORES JESUS RAFAEL                                  ', 'CAR. CENTRAL KM. 1 LLICUA BAJA - HUANUCO HUANUCO AMARIL     ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(694, '               ', '10101436310', 'MAYCA FIGUEROA MILUSKA FANNY                                ', 'AV. CARLOS PESCHIERA 516 LA MERCED - JUNIN - CHANCHAMAYO    ', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(695, '               ', '', 'GILGUERO                                                    ', 'SAN JUAN DE LURIGANCHO                                      ', 241, 216, 29, 217, '', '', 1, 1, 0, 1, 1),
(696, '', '10420859606', 'LOPEZ ASTUHUAMAN ZULMA JANETH                               ', 'AV. TUPAC AMARU NRO 350 - JUNIN TARMA TARMA                 ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(697, '14785236', '', 'ELIOT                                                       ', 'LIMA                                                        ', 241, 216, 29, 217, '                    ', '                                                  ', 5, 1, 0, 1, 1),
(698, '6253724', '', 'DIAZ HUAMAN ALFONSO                                         ', 'AV. GERARDO UNGER 44 75 INT. 4 LIMA - LIMA - COMAS          ', 241, 216, 29, 217, '', '', 2, 1, 0, 1, 1),
(699, '151587', '', 'OMAR                                                        ', 'LIMA                                                        ', 241, 216, 29, 217, '15158', '                                                  ', 1, 1, 0, 1, 1),
(700, '', '20545653134', 'TRADING NUEVA ERA S.R.L', 'AV. MEXICO NRO. 1447 URB. SAN GERMAN LIMA  - LIMA  - LA VICT', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(701, '43299583', '', 'EDSSON FRANK MARCA PUMA                                     ', '', 241, 216, 29, 217, '', '', 1, 1, 0, 1, 1),
(702, '               ', '10404903891', 'GRANDEZ QUISPE MIGUEL ANGEL                                 ', 'MANCO INCA 311 A WANCHAQ - CUSCO                            ', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(703, '10', '10456164698', 'SAAVEDRA QUISPE RENE', 'JR. LIBERTAD # 883 - JULIACA                                ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(704, '7292408', '', 'JOSE ABANTO SALAS                                           ', 'SAN JUAN DE LURIGANCHO                                      ', 241, 216, 29, 217, '', '', 2, 1, 0, 1, 1),
(705, '', '10766346966', 'DIAZ CASTAÑEDA ALEXIS ROLANDO                               ', 'AV.GERARDO UNGER 4513 URB.INDUSTRIAL NARANJAL-S.M.P-LIMA    ', 241, 216, 29, 217, '', '', 1, 1, 0, 1, 1),
(706, '', '10013304616', 'RAMOS LAQUIHUANACO ADELAIDA', 'JR.PUNO 784 ILAVE-PUNO-PUNO                                 ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(707, '', '20523076940', 'LINPLAST AUTOMOTRIZ S.A.C.', 'MZA. C LOTE. 8 P.VIV.RES.VILLA ESPERANZA LIMA  - LIMA  - COM', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(708, '41812097', '', 'EMERSON ERIN TAPIA CRUZ                                     ', 'NUEVA CAJAMARCA SAN MARTIN                                  ', 241, 216, 29, 217, '                    ', '                                                  ', 1, 1, 0, 1, 1),
(709, '', '20517237168', 'REPUESTOS CELESTE S.A.C.', 'NRO. 1433 ---- PROLONG.PARINACOCHAS - LIMA LIMA LA VICTORIA ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(710, '', '', 'ALFONZO DIAZ HUAMAN                                         ', 'CALLE LOS OLIVOS MZ :L2  - LT22                             ', 241, 216, 29, 217, '', '', 2, 1, 0, 1, 1),
(711, '               ', '20459597329', 'ELIMPORT INVERSIONES SRL                                    ', 'PJ. ANDRES DE SANTA CRUZ N140 URB.EL RETABLO-COMAS-LIMA     ', 241, 216, 29, 217, '                    ', '                                                  ', 2, 1, 0, 1, 1),
(712, '10484192885', '10484192885', 'ROSALES JORGE DANNY MIGUEL', 'AV. FCO. DE PAULA OTERO NRO. 787 SEC. TARMA - JUNIN TARMA TA', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(713, '10167364514', '10167364514', 'DELGADO CUEVA PEDRO DAVID', 'AV. G. UNGER NRO. 4513 Z.I. NARANJAL - LIMA LIMA SAN MARTIN ', 241, 216, 29, 217, '', '', 4, 1, 0, 1, 1),
(714, '', '10441143040', 'CELESTINO MORALES DEBBY LOURDES', 'JR. FAUSTINO QUISPE NRO. 402 - JUNIN - HUANCAYO - EL TAMBO  ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(715, '45124808', '', 'VELASQUEZ DAVILA ANGELO                                     ', 'BARRANCA-BARRANCA                                           ', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(716, '', '10410399011', 'MARAZA CALLA CESAR', 'JR. CARABAYA NRO. 104 - PUNO SAN ROMAN JULIACA              ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(717, '               ', '20556181510', 'INTERNATIONAL KARINO E.I.R.L.', 'PRO. PARINACOCHAS 1450 OTR. OTROS - LIMA LIMA LA VICTORIA   ', 241, 216, 29, 217, '                    ', '                                                  ', 1, 1, 0, 1, 1),
(718, '               ', '10453327472', 'CHOCCA FLORES ALEX EMERSON                                  ', 'AV.JOSE CARLOS MARIATEGUI 332 INT.3 - JUNIN HUANCAYO EL TAMB', 241, 216, 29, 217, '                    ', '                                                  ', 1, 1, 0, 1, 1),
(719, '', '10334070137', 'CABAÑAS PICON DORA MERCEDES', 'CAL.INTISUYO 290 URB.MARANGA ET. SIETE - LIMA LIMA SAN MIGUE', 241, 216, 29, 217, '', '', 1, 1, 0, 1, 1),
(720, '               ', '10472004714', 'RAMOS VALENTIN JULIO DAVID                                  ', 'AV. PANAMERICANA NRO. SN - APURIMAC ABANCAY ABANCAY', 241, 216, 29, 217, '                    ', '                                                  ', 2, 1, 0, 1, 1),
(721, '', '10238466810', 'ALVAREZ MOZO JUANA', 'AV. MANCO CCAPAC NRO. 332 - CUSCO CUSCO WANCHAQ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(722, '444444', '', 'MATIAS                                                      ', 'SAN JUAN DE LURIGANCHO                                      ', 241, 216, 29, 217, '44444', '                                                  ', 1, 1, 0, 1, 1),
(723, '9960654', '', 'GOMEZ ROCA EDSON                                            ', 'MZ M LT10 CANTO GRANDE S-J-L                                ', 241, 216, 29, 217, '                    ', '                                                  ', 1, 1, 0, 1, 1),
(724, '', '20394044432', 'AUTOREPUESTOS Y SERVICIOS MULTIPLES NICOLE E.I.R.L.', 'AV. CENTENARIO NRO. 286 URB. JOSE C. MARIATEGUI - UCAYALI - ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(725, '               ', '10270730961', 'CHAVEZ ROJAS MIGUEL                                         ', 'LT.67 KM.12.5 FND.SECTOR PACAYAL DE SAN JUA - LIMA LIMA ATE ', 241, 216, 29, 217, '                    ', '                                                  ', 5, 1, 0, 1, 1),
(726, '               ', '10477677440', 'CORDERO GOMEZ YOVANA GLORIA                                 ', 'JR. ALFONSO UGARTE NRO. 219 BAR. LA FLORIDA - CAJAMARCA CAJA', 241, 216, 29, 217, '                    ', '                                                  ', 2, 1, 0, 1, 1),
(727, '714', '', 'AUTOPARTES MANUEL                                           ', 'AV METROPOLITANA 291-ATE                                    ', 241, 216, 29, 217, '                    ', '', 5, 1, 0, 1, 1),
(728, '36521498', '', 'OFICINA                                                     ', 'OFICINA                                                     ', 241, 216, 29, 217, '36985', '', 1, 1, 0, 1, 1),
(729, '               ', '10250089321', 'ARZUBIALDE ROMAN REYNER EMERSON                             ', 'JR. MANDOR N P2 QUILLABAMBA - CUSCO                         ', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(730, '               ', '10472521611', 'TORRES SANDOVAL ERWIN GENARO NASSER                         ', 'CAL. 6 DE ENERO LT. 7 MZ. 73 - AREQUIPA CARAVELI CHALA', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(731, '', '10430249989', 'GUTIERREZ REMON MIRIAN', 'PJ. JOSE CARLOS MARIATEGUI NRO. 234 - JUNIN HUANCAYO EL TAMB', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(732, '               ', '', 'JOSE GUERRA                                                 ', '', 241, 216, 29, 217, '                    ', '                                                  ', 1, 1, 0, 1, 1),
(733, '', '', 'ANDREITA PEZO                                               ', '', 241, 216, 29, 217, '', '', 5, 1, 0, 1, 1),
(734, '', '', 'ALEXANDER GONZALES                                          ', '', 241, 216, 29, 217, '', '', 5, 1, 0, 1, 1),
(735, '', '', 'OSCAR ALVAREZ                                               ', '', 241, 216, 29, 217, '', '', 5, 1, 0, 1, 1),
(736, '', '10293948521', 'CORDOVA RODRIGUEZ GLORIA MARIA', 'AV. SEPULVEDA NRO. 408 - AREQUIPA AREQUIPA MIRAFLORES', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(737, '', '10769169216', 'QUENAYA RAMOS MIRYAM GLADYS', 'JR. LA LIBERTAD NRO. S/N - PUNO SAN ROMAN JULIACA', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(738, '', '', 'PERCY (CARLOS MAR)                                          ', '', 241, 216, 29, 217, '', '', 1, 1, 0, 1, 1),
(739, '', '10451541671', 'YARLEQUE TAPIA YANET PAMELA', 'AV. JOSE CARLOS MARIATEGUI NRO. 332 - JUNIN HUANCAYO EL TAMB', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(740, '', '10432753188', 'ATAUJE FLORES VICTOR                                        ', 'AV MEXICO NRO. 1679 - LIMA LIMA LA VICTORIA                 ', 241, 216, 29, 217, '', '', 1, 1, 0, 1, 1),
(741, '', '10435969378', 'PUMA PEREZ WILBER JHON', 'CAL. 52 LT. 27 MZ. E14 A.H. SU SANTIDAD JUAN PABLO II - LIMA', 241, 216, 29, 217, '', '', 1, 1, 0, 1, 1),
(742, '', '', 'WILDER SOTO                                                 ', '                                                            ', 241, 216, 29, 217, '', '', 5, 1, 0, 1, 1),
(743, '', '10420718441', 'VILCA LOPEZ NILDA SOLEDAD                                   ', 'LT. 20 MZ. W ---- C.P. EL PEDREGAL NORTE - AREQUIPA CAYLLOMA', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(744, '', '20565346955', 'IMPORTACIONES VEGA PLAST S.A.C.', '---- PARINACOCHAS NRO. 1426 - LIMA LIMA LA VICTORIA', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(745, '47469314', '', 'SUAÑA CENTENO RUSSEL WILSON                                 ', 'JULIACA-JULIACA                                             ', 241, 216, 29, 217, '                    ', '                                                  ', 3, 1, 0, 1, 1),
(746, '', '10739043943', 'BAEZ MOTTOCCANCHI VANESA', 'AV. MANCO CAPAC ESQ.AV.TACNA NRO. 213 - CUSCO CUSCO WANCHAQ', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(747, '', '10103962949', 'FLORES CURASI MAGDALENA ROSARIO', 'AV. SIMON BOLIVAR NRO. 1410 - PUNO PUNO PUNO', 241, 216, 29, 217, '', '', 3, 1, 0, 1, 1),
(748, '', '20216916582', 'EMP.IND DE RESP LIMITADA CHAVEZ LTDA                        ', 'CAL. AYACUCHO NRO. S/N P.J. COLUMNA PASCO - PASCO PASCO YANA', 241, 216, 29, 217, '', '', 5, 1, 0, 1, 1),
(749, '70130085', '', 'ROJAS CASTELLANO BETZABET GLADIS                            ', 'AV.JOSE CARLOS MARIATEGUI 332 INT.3-JUNIN HUANCAYO EL TAMBO ', 241, 216, 29, 217, '                    ', '', 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL COMMENT 'ID UNICO',
  `cod_compra` varchar(10) NOT NULL COMMENT 'CODIGO COMPRA',
  `fecha_compra` date NOT NULL COMMENT 'FECHA COMPRA',
  `provee_compra` int(11) NOT NULL COMMENT 'PROVEEDOR COMPRA',
  `moneda_compra` int(11) NOT NULL COMMENT 'MONEDA COMPRA',
  `condp_compra` int(11) NOT NULL COMMENT 'CONDICION PAGO COMPRA',
  `usuario_compra` int(11) NOT NULL COMMENT 'USUARIO COMPRA',
  `estatus_compra` int(11) NOT NULL DEFAULT '0' COMMENT 'ESTATUS COMPRA',
  `edicion_compra` varchar(1) DEFAULT 'N' COMMENT 'EDICION COMPRA',
  `excento_compra` int(11) NOT NULL DEFAULT '1' COMMENT 'EXCENTO DE IMPUESTO 1=EXCENTO, 0=APLICA IMPUESTO',
  `afectaalm_compra` int(11) NOT NULL DEFAULT '0' COMMENT 'AFECTA ALMACEN COMPRA',
  `nrodoc_compra` varchar(25) DEFAULT NULL COMMENT 'NRO DOCUMENTO COMPRA',
  `sucursal_compra` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL COMPRA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA ORDEN DE COMPRAS';

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `cod_compra`, `fecha_compra`, `provee_compra`, `moneda_compra`, `condp_compra`, `usuario_compra`, `estatus_compra`, `edicion_compra`, `excento_compra`, `afectaalm_compra`, `nrodoc_compra`, `sucursal_compra`) VALUES
(4, '0000000001', '2019-08-23', 1, 1, 1, 2, 0, 'N', 0, 1, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_detalle`
--

CREATE TABLE `compra_detalle` (
  `id_cdetalle` int(11) NOT NULL COMMENT 'ID UNICO',
  `prod_cdetalle` int(11) NOT NULL COMMENT 'PRODUCTO COMPRA DETALLE',
  `cant_cdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'CANTIDAD COMPRA DETALLE',
  `precio_cdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'PRECIO COMPRA DETALLE',
  `descu_cdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'DESCUENTO % COMPRA DETALLE',
  `impuesto_cdetalle` decimal(18,0) NOT NULL DEFAULT '0' COMMENT 'IMPUESTO COMPRA DETALLE',
  `status_cdetalle` int(11) NOT NULL DEFAULT '1' COMMENT 'ESTATUS COMPRA DETALLE',
  `compra_cdetalle` int(11) NOT NULL DEFAULT '0',
  `plista_cdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'PRECIO LISTA COMPRA DETALLE',
  `total_cdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'TOTAL COMPRA DETALLE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DETALLE DE COMPRAS';

--
-- Volcado de datos para la tabla `compra_detalle`
--

INSERT INTO `compra_detalle` (`id_cdetalle`, `prod_cdetalle`, `cant_cdetalle`, `precio_cdetalle`, `descu_cdetalle`, `impuesto_cdetalle`, `status_cdetalle`, `compra_cdetalle`, `plista_cdetalle`, `total_cdetalle`) VALUES
(3, 7, '5.00', '2.00', '0.00', '0', 1, 4, '0.00', '10.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cond_pago`
--

CREATE TABLE `cond_pago` (
  `id_condp` int(11) NOT NULL COMMENT 'ID UNICO',
  `desc_condp` varchar(100) NOT NULL COMMENT 'DESCRIP COND PAGO',
  `status_condp` int(11) NOT NULL COMMENT 'ESTATUS CONDICION PAGO',
  `sucursal_condp` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL COND PAGO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA LAS CONDICIONES DE PAGO';

--
-- Volcado de datos para la tabla `cond_pago`
--

INSERT INTO `cond_pago` (`id_condp`, `desc_condp`, `status_condp`, `sucursal_condp`) VALUES
(1, 'CONTADO', 1, 1),
(2, 'CREDITO', 1, 1),
(3, 'FACTURA A 30 DIAS', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_depto` int(11) NOT NULL COMMENT 'ID UNICO',
  `des_depto` varchar(30) NOT NULL COMMENT 'DESCRIPCION DEPARTAMENTO',
  `prov_depto` int(11) NOT NULL COMMENT 'PROVINCIA DEPARTAMENTO',
  `pais_depto` int(11) NOT NULL,
  `status_depto` int(11) NOT NULL COMMENT 'ESTATUS DEPARTAMENTO',
  `sucursal_depto` int(11) NOT NULL COMMENT 'SUCURSAL DEPARTAMENTO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE DEPARTAMENTOS';

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_depto`, `des_depto`, `prov_depto`, `pais_depto`, `status_depto`, `sucursal_depto`) VALUES
(1, 'Bagua', 1, 241, 1, 1),
(2, 'Bongará', 1, 241, 1, 1),
(3, 'Chachapoyas', 1, 241, 1, 1),
(4, 'Condorcanqui', 1, 241, 1, 1),
(5, 'Luya', 1, 241, 1, 1),
(6, 'Rodríguez de Mendoza', 1, 241, 1, 1),
(7, 'Utcubamba', 1, 241, 1, 1),
(8, 'Aija', 2, 241, 1, 1),
(9, 'Antonio Raymond', 2, 241, 1, 1),
(10, 'Asunción', 2, 241, 1, 1),
(11, 'Bolognesi', 2, 241, 1, 1),
(12, 'Carhuaz', 2, 241, 1, 1),
(13, 'Carlos Fermín Fitzcarrald', 2, 241, 1, 1),
(14, 'Casma', 2, 241, 1, 1),
(15, 'Corongo', 2, 241, 1, 1),
(16, 'Huaraz', 2, 241, 1, 1),
(17, 'Huari', 2, 241, 1, 1),
(18, 'Huarmey', 2, 241, 1, 1),
(19, 'Huaylas', 2, 241, 1, 1),
(20, 'Mariscal Luzuriaga', 2, 241, 1, 1),
(21, 'Ocros', 2, 241, 1, 1),
(22, 'Pallasca', 2, 241, 1, 1),
(23, 'Pomabamba', 2, 241, 1, 1),
(24, 'Recuay', 2, 241, 1, 1),
(25, 'Santa', 2, 241, 1, 1),
(26, 'Sihuas', 2, 241, 1, 1),
(27, 'Yungay', 2, 241, 1, 1),
(28, 'Abancay', 3, 241, 1, 1),
(29, 'Andahuaylas', 3, 241, 1, 1),
(30, 'Antabamba', 3, 241, 1, 1),
(31, 'Aymaraes', 3, 241, 1, 1),
(32, 'Chicheros', 3, 241, 1, 1),
(33, 'Cotabambas', 3, 241, 1, 1),
(34, 'Grau', 3, 241, 1, 1),
(35, 'Arequipa', 4, 241, 1, 1),
(36, 'Camaná', 4, 241, 1, 1),
(37, 'Caraveli', 4, 241, 1, 1),
(38, 'Castilla', 4, 241, 1, 1),
(39, 'Caylloma', 4, 241, 1, 1),
(40, 'Condesuyos', 4, 241, 1, 1),
(41, 'Islay', 4, 241, 1, 1),
(42, 'La Unión', 4, 241, 1, 1),
(43, 'Cangallo', 5, 241, 1, 1),
(44, 'Huamanga', 5, 241, 1, 1),
(45, 'Huancasancos', 5, 241, 1, 1),
(46, 'Huanta', 5, 241, 1, 1),
(47, 'La Mar', 5, 241, 1, 1),
(48, 'Lucanas', 5, 241, 1, 1),
(49, 'Parinacochas', 5, 241, 1, 1),
(50, 'Páucar del Sara Sara', 5, 241, 1, 1),
(51, 'Sucre', 5, 241, 1, 1),
(52, 'Víctor Fajardo', 5, 241, 1, 1),
(53, 'Vilcashuaman', 5, 241, 1, 1),
(54, 'Cajabamba', 6, 241, 1, 1),
(55, 'Cajamarca', 6, 241, 1, 1),
(56, 'Celendín', 6, 241, 1, 1),
(57, 'Chota', 6, 241, 1, 1),
(58, 'Contumazá', 6, 241, 1, 1),
(59, 'Cutervo', 6, 241, 1, 1),
(60, 'Hualgayoc', 6, 241, 1, 1),
(61, 'Jaén', 6, 241, 1, 1),
(62, 'San Ignacio', 6, 241, 1, 1),
(63, 'San Marcos', 6, 241, 1, 1),
(64, 'San Miguel', 6, 241, 1, 1),
(65, 'San Pablo', 6, 241, 1, 1),
(66, 'Santa Cruz', 6, 241, 1, 1),
(67, 'Callao', 7, 241, 1, 1),
(68, 'Acomayo', 8, 241, 1, 1),
(69, 'Anta', 8, 241, 1, 1),
(70, 'Calca', 8, 241, 1, 1),
(71, 'Canas', 8, 241, 1, 1),
(72, 'Canchis', 8, 241, 1, 1),
(73, 'Chumbivilcas', 8, 241, 1, 1),
(74, 'Cusco', 8, 241, 1, 1),
(75, 'Espinar', 8, 241, 1, 1),
(76, 'La Convención', 8, 241, 1, 1),
(77, 'Paruro', 8, 241, 1, 1),
(78, 'Paucartambo', 8, 241, 1, 1),
(79, 'Quispicanchi', 8, 241, 1, 1),
(80, 'Urubamba', 8, 241, 1, 1),
(81, 'Acobamba', 9, 241, 1, 1),
(82, 'Angaraes', 9, 241, 1, 1),
(83, 'Castrovirreyna', 9, 241, 1, 1),
(84, 'Churcampa', 9, 241, 1, 1),
(85, 'Huancavelica', 9, 241, 1, 1),
(86, 'Huaytará', 9, 241, 1, 1),
(87, 'Tayacaja', 9, 241, 1, 1),
(88, 'Ambo', 10, 241, 1, 1),
(89, 'Dos de Mayo', 10, 241, 1, 1),
(90, 'Huacaybamba', 10, 241, 1, 1),
(91, 'Huamalíes', 10, 241, 1, 1),
(92, 'Huanuco', 10, 241, 1, 1),
(93, 'Lauricocha', 10, 241, 1, 1),
(94, 'Leoncio Prado', 10, 241, 1, 1),
(95, 'Marañón', 10, 241, 1, 1),
(96, 'Pachitea', 10, 241, 1, 1),
(97, 'Puerto Inca', 10, 241, 1, 1),
(98, 'Yarowilca', 10, 241, 1, 1),
(99, 'Chincha', 11, 241, 1, 1),
(100, 'Ica', 11, 241, 1, 1),
(101, 'Nazca', 11, 241, 1, 1),
(102, 'Palpa', 11, 241, 1, 1),
(103, 'Pisco', 11, 241, 1, 1),
(104, 'Chanchamayo', 12, 241, 1, 1),
(105, 'Chupaca', 12, 241, 1, 1),
(106, 'Concepción', 12, 241, 1, 1),
(107, 'Huancayo', 12, 241, 1, 1),
(108, 'Jauja', 12, 241, 1, 1),
(109, 'Junín', 12, 241, 1, 1),
(110, 'Satipo', 12, 241, 1, 1),
(111, 'Tarma', 12, 241, 1, 1),
(112, 'Yauli', 12, 241, 1, 1),
(113, 'Ascope', 13, 241, 1, 1),
(114, 'Bolívar', 13, 241, 1, 1),
(115, 'Chepén', 13, 241, 1, 1),
(116, 'Gran Chimú', 13, 241, 1, 1),
(117, 'Julcán', 13, 241, 1, 1),
(118, 'Otuzco', 13, 241, 1, 1),
(119, 'Pacasmayo', 13, 241, 1, 1),
(120, 'Pataz', 13, 241, 1, 1),
(121, 'Sanchez Carrión', 13, 241, 1, 1),
(122, 'Santiago de Chuco', 13, 241, 1, 1),
(123, 'Trujillo', 13, 241, 1, 1),
(124, 'Virú', 13, 241, 1, 1),
(125, 'Chiclayo', 14, 241, 1, 1),
(126, 'Ferreñafe', 14, 241, 1, 1),
(127, 'Lambayeque', 14, 241, 1, 1),
(128, 'Barranca', 15, 241, 1, 1),
(129, 'Cajatambo', 15, 241, 1, 1),
(130, 'Canta', 15, 241, 1, 1),
(131, 'Cañete', 15, 241, 1, 1),
(132, 'Huaral', 15, 241, 1, 1),
(133, 'Huarochirí', 15, 241, 1, 1),
(134, 'Huaura', 15, 241, 1, 1),
(135, 'Lima', 15, 241, 1, 1),
(136, 'Oyón', 15, 241, 1, 1),
(137, 'Yauyos', 15, 241, 1, 1),
(138, 'Alto Amazonas', 16, 241, 1, 1),
(139, 'Datem de Marañón', 16, 241, 1, 1),
(140, 'Loreto', 16, 241, 1, 1),
(141, 'Mariscal Ramón Castilla', 16, 241, 1, 1),
(142, 'Maynas', 16, 241, 1, 1),
(143, 'Putumayo', 16, 241, 1, 1),
(144, 'Requena', 16, 241, 1, 1),
(145, 'Ucayali', 16, 241, 1, 1),
(146, 'Manu', 17, 241, 1, 1),
(147, 'Tahuamanu', 17, 241, 1, 1),
(148, 'Tambopata', 17, 241, 1, 1),
(149, 'General Sánchez Cerro', 18, 241, 1, 1),
(150, 'Ilo', 18, 241, 1, 1),
(151, 'Mariscal Nieto', 18, 241, 1, 1),
(152, 'Daniel Alcides Carrión', 19, 241, 1, 1),
(153, 'Oxapampa', 19, 241, 1, 1),
(154, 'Pasco', 19, 241, 1, 1),
(155, 'Ayabaca', 20, 241, 1, 1),
(156, 'Huancabamba', 20, 241, 1, 1),
(157, 'Morropón', 20, 241, 1, 1),
(158, 'Paita', 20, 241, 1, 1),
(159, 'Piura', 20, 241, 1, 1),
(160, 'Secure', 20, 241, 1, 1),
(161, 'Sullana', 20, 241, 1, 1),
(162, 'Talara', 20, 241, 1, 1),
(163, 'Azángaro', 21, 241, 1, 1),
(164, 'Carabaya', 21, 241, 1, 1),
(165, 'Chucuito', 21, 241, 1, 1),
(166, 'El Collao', 21, 241, 1, 1),
(167, 'Huacané', 21, 241, 1, 1),
(168, 'Lampa', 21, 241, 1, 1),
(169, 'Melgar', 21, 241, 1, 1),
(170, 'Moho', 21, 241, 1, 1),
(171, 'Puno', 21, 241, 1, 1),
(172, 'San Antonio de Putiña', 21, 241, 1, 1),
(173, 'San Román', 21, 241, 1, 1),
(174, 'Sandía', 21, 241, 1, 1),
(175, 'Yunguyo', 21, 241, 1, 1),
(176, 'Bellavista', 22, 241, 1, 1),
(177, 'El Dorado', 22, 241, 1, 1),
(178, 'Huallaga', 22, 241, 1, 1),
(179, 'Lamas', 22, 241, 1, 1),
(180, 'Mariscal Cáceres', 22, 241, 1, 1),
(181, 'Moyobamba', 22, 241, 1, 1),
(182, 'Picota', 22, 241, 1, 1),
(183, 'Rioja', 22, 241, 1, 1),
(184, 'San Martín', 22, 241, 1, 1),
(185, 'Tocache', 22, 241, 1, 1),
(186, 'Candarave', 23, 241, 1, 1),
(187, 'Jorge Basadre', 23, 241, 1, 1),
(188, 'Tacna', 23, 241, 1, 1),
(189, 'Tarata', 23, 241, 1, 1),
(190, 'Contralmirante Villar', 24, 241, 1, 1),
(191, 'Tumbes', 24, 241, 1, 1),
(192, 'Zarumilla', 24, 241, 1, 1),
(193, 'Atalaya', 25, 241, 1, 1),
(194, 'Coronel Portillo', 25, 241, 1, 1),
(195, 'Padre Abad', 25, 241, 1, 1),
(196, 'Purús', 25, 241, 1, 1),
(215, 'Valencia', 28, 231, 1, 1),
(216, 'SIN DEPARTAMENTO', 29, 241, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depts`
--

CREATE TABLE `depts` (
  `provincia` varchar(100) DEFAULT NULL,
  `depart` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `dtto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `depts`
--

INSERT INTO `depts` (`provincia`, `depart`, `dtto`) VALUES
('AMAZONAS', 'Chachapoyas', 'Chachapoyas'),
('AMAZONAS', 'Bagua', 'Bagua'),
('AMAZONAS', 'Bongará', 'Jumbilla'),
('AMAZONAS', 'Condorcanqui', 'Santa María Nieva'),
('AMAZONAS', 'Luya', 'Lamud'),
('AMAZONAS', 'Rodríguez de Mendoza', 'Mendoza'),
('AMAZONAS', 'Utcubamba', 'Bagua Grande'),
('ANCASH', 'Huaraz', 'Huaraz'),
('ANCASH', 'Aija', 'Aija'),
('ANCASH', 'Antonio Raymond', 'Llamellín'),
('ANCASH', 'Asunción', 'Chacas'),
('ANCASH', 'Bolognesi', 'Chiquián'),
('ANCASH', 'Carhuaz', 'Carhuaz'),
('ANCASH', 'Carlos Fermín Fitzcarrald', 'San Luis'),
('ANCASH', 'Casma', 'Casma'),
('ANCASH', 'Corongo', 'Corongo'),
('ANCASH', 'Huari', 'Huari'),
('ANCASH', 'Huarmey', 'Huarmey'),
('ANCASH', 'Huaylas', 'Caras'),
('ANCASH', 'Mariscal Luzuriaga', 'Piscobamba'),
('ANCASH', 'Ocros', 'Ocros'),
('ANCASH', 'Pallasca', 'Cabana'),
('ANCASH', 'Pomabamba', 'Pomabamba'),
('ANCASH', 'Recuay', 'Recuay'),
('ANCASH', 'Santa', 'Chimbo'),
('ANCASH', 'Sihuas', 'Sihuas'),
('ANCASH', 'Yungay', 'Yungay'),
('APURIMAC', 'Abancay', 'Abancay'),
('APURIMAC', 'Andahuaylas', 'Andahuaylas'),
('APURIMAC', 'Antabamba', 'Antabamba'),
('APURIMAC', 'Aymaraes', 'Chalhuanca'),
('APURIMAC', 'Cotabambas', 'Tambobamba'),
('APURIMAC', 'Chicheros', 'Chincheros'),
('APURIMAC', 'Grau', 'Chuquibambilla'),
('AREQUIPA', 'Arequipa', 'Arequipa'),
('AREQUIPA', 'Camaná', 'Camaná'),
('AREQUIPA', 'Caraveli', 'Caraveli'),
('AREQUIPA', 'Castilla', 'Aplao'),
('AREQUIPA', 'Caylloma', 'Chivay'),
('AREQUIPA', 'Condesuyos', 'Chuquibamba'),
('AREQUIPA', 'Islay', 'Mollendo'),
('AREQUIPA', 'La Unión', 'Cotahuasi'),
('AYACUCHO', 'Huamanga', 'Ayacucho'),
('AYACUCHO', 'Cangallo', 'Cangallo'),
('AYACUCHO', 'Huancasancos', 'Huancasancos'),
('AYACUCHO', 'Huanta', 'Huanta'),
('AYACUCHO', 'La Mar', 'San Miguel'),
('AYACUCHO', 'Lucanas', 'Puquio'),
('AYACUCHO', 'Parinacochas', 'Coracora'),
('AYACUCHO', 'Páucar del Sara Sara', 'Pauza'),
('AYACUCHO', 'Sucre', 'Querobamba'),
('AYACUCHO', 'Víctor Fajardo', 'Huancapi'),
('AYACUCHO', 'Vilcashuaman', 'Vilcashuamán'),
('CAJAMARCA', 'Cajamarca', 'Cajamarca'),
('CAJAMARCA', 'Cajabamba', 'Cajabamba'),
('CAJAMARCA', 'Celendín', 'Celendín'),
('CAJAMARCA', 'Chota', 'Chota'),
('CAJAMARCA', 'Contumazá', 'Contumazá'),
('CAJAMARCA', 'Cutervo', 'Cutervo'),
('CAJAMARCA', 'Hualgayoc', 'Bambamarca'),
('CAJAMARCA', 'Jaén', 'Jaén'),
('CAJAMARCA', 'San Ignacio', 'San Ignacio'),
('CAJAMARCA', 'San Marcos', 'San marcos (Pedro Gálvez)'),
('CAJAMARCA', 'San Miguel', 'San Miguel de Pallaques'),
('CAJAMARCA', 'San Pablo', 'San Pablo'),
('CAJAMARCA', 'Santa Cruz', 'Santa Cruz de Succhabamba'),
('CALLAO', 'Callao', 'Callao'),
('CUSCO', 'Cusco', 'Cusco'),
('CUSCO', 'Acomayo', 'Acomayo'),
('CUSCO', 'Anta', 'Anta'),
('CUSCO', 'Calca', 'Calca'),
('CUSCO', 'Canas', 'Yanaoca'),
('CUSCO', 'Canchis', 'Sicuani'),
('CUSCO', 'Chumbivilcas', 'Santo Tomás'),
('CUSCO', 'Espinar', 'Yauri (Espinar)'),
('CUSCO', 'La Convención', 'Quillabamba'),
('CUSCO', 'Paruro', 'Paruro'),
('CUSCO', 'Paucartambo', 'Paucartambo'),
('CUSCO', 'Quispicanchi', 'Urcos'),
('CUSCO', 'Urubamba', 'Urubamba'),
('HUANCAVELICA', 'Huancavelica', 'Huancavelica'),
('HUANCAVELICA', 'Acobamba', 'Acobamba'),
('HUANCAVELICA', 'Angaraes', 'Lircay'),
('HUANCAVELICA', 'Castrovirreyna', 'Castrovirreyna'),
('HUANCAVELICA', 'Churcampa', 'Churcampa'),
('HUANCAVELICA', 'Huaytará', 'Huaytará'),
('HUANCAVELICA', 'Tayacaja', 'Pampas'),
('HUÁNUCO', 'Huanuco', 'Huánuco'),
('HUÁNUCO', 'Ambo', 'Ambo'),
('HUÁNUCO', 'Dos de Mayo', 'La Unión'),
('HUÁNUCO', 'Huacaybamba', 'Huacaybamba'),
('HUÁNUCO', 'Huamalíes', 'Llata'),
('HUÁNUCO', 'Leoncio Prado', 'Tingo María'),
('HUÁNUCO', 'Marañón', 'Huacrachuco'),
('HUÁNUCO', 'Pachitea', 'Panao'),
('HUÁNUCO', 'Puerto Inca', 'Puerto Inca'),
('HUÁNUCO', 'Lauricocha', 'Jesús'),
('HUÁNUCO', 'Yarowilca', 'Chavinillo'),
('ICA', 'Ica', 'Ica'),
('ICA', 'Chincha', 'Chincha Alta'),
('ICA', 'Nazca', 'Nazca'),
('ICA', 'Palpa', 'Palpa'),
('ICA', 'Pisco', 'Pisco'),
('JUNÍN', 'Huancayo', 'Huancayo'),
('JUNÍN', 'Concepción', 'Concepción'),
('JUNÍN', 'Chanchamayo', 'La Merced'),
('JUNÍN', 'Jauja', 'Jauja'),
('JUNÍN', 'Junín', 'Junín'),
('JUNÍN', 'Satipo', 'Satipo'),
('JUNÍN', 'Tarma', 'Tarma'),
('JUNÍN', 'Yauli', 'La Oroya'),
('JUNÍN', 'Chupaca', 'Chupaca'),
('LA LIBERTAD', 'Trujillo', 'Trujillo'),
('LA LIBERTAD', 'Ascope', 'Ascope'),
('LA LIBERTAD', 'Bolívar', 'Bolívar'),
('LA LIBERTAD', 'Chepén', 'Chepén'),
('LA LIBERTAD', 'Julcán', 'Julcán'),
('LA LIBERTAD', 'Otuzco', 'Otuzco'),
('LA LIBERTAD', 'Pacasmayo', 'San Pedro de Lloc'),
('LA LIBERTAD', 'Pataz', 'Tayabamba'),
('LA LIBERTAD', 'Sanchez Carrión', 'Huamachuco'),
('LA LIBERTAD', 'Santiago de Chuco', 'Santiago de Chuco'),
('LA LIBERTAD', 'Gran Chimú', 'Cascas'),
('LA LIBERTAD', 'Virú', 'Virú'),
('LAMBAYEQUE', 'Chiclayo', 'Chiclayo'),
('LAMBAYEQUE', 'Ferreñafe', 'Ferreñafe'),
('LAMBAYEQUE', 'Lambayeque', 'Lambayeque'),
('LIMA', 'Lima', 'Lima'),
('LIMA', 'Barranca', 'Barranca'),
('LIMA', 'Cajatambo', 'Cajatambo'),
('LIMA', 'Canta', 'Canta'),
('LIMA', 'Cañete', 'San Vicente de Cañete'),
('LIMA', 'Huaral', 'Huaral'),
('LIMA', 'Huarochirí', 'Matucana'),
('LIMA', 'Huaura', 'Huacho'),
('LIMA', 'Oyón', 'Oyón'),
('LIMA', 'Yauyos', 'Yauyos'),
('LORETO', 'Maynas', 'Iquitos'),
('LORETO', 'Alto Amazonas', 'Yurimaguas'),
('LORETO', 'Loreto', 'Nauta'),
('LORETO', 'Mariscal Ramón Castilla', 'Caballococha'),
('LORETO', 'Requena', 'Requena'),
('LORETO', 'Ucayali', 'Contamana'),
('LORETO', 'Datem de Marañón', 'San Lorenzo'),
('LORETO', 'Putumayo', 'San Antonio del Estrecho'),
('MADRE DE DIOS', 'Tambopata', 'Puerto Maldonado'),
('MADRE DE DIOS', 'Manu', 'Salvación'),
('MADRE DE DIOS', 'Tahuamanu', 'Iñapari'),
('MOQUEGUA', 'Mariscal Nieto', 'Moquegua'),
('MOQUEGUA', 'General Sánchez Cerro', 'Omate'),
('MOQUEGUA', 'Ilo', 'Ilo'),
('PASCO', 'Pasco', 'Cerro de Pasco'),
('PASCO', 'Daniel Alcides Carrión', 'Yanahuanca'),
('PASCO', 'Oxapampa', 'Oxapampa'),
('PIURA', 'Piura', 'Piura'),
('PIURA', 'Ayabaca', 'Ayabaca'),
('PIURA', 'Huancabamba', 'Huancabamba'),
('PIURA', 'Morropón', 'Chulucanas'),
('PIURA', 'Paita', 'Paita'),
('PIURA', 'Sullana', 'Sullana'),
('PIURA', 'Talara', 'Talara'),
('PIURA', 'Secure', 'Sechura'),
('PUNO', 'Puno', 'Puno'),
('PUNO', 'Azángaro', 'Azángaro'),
('PUNO', 'Carabaya', 'Macusani'),
('PUNO', 'Chucuito', 'Juli'),
('PUNO', 'El Collao', 'Ilave'),
('PUNO', 'Huacané', 'Huancané'),
('PUNO', 'Lampa', 'Lampa'),
('PUNO', 'Melgar', 'Ayaviri'),
('PUNO', 'Moho', 'Moho'),
('PUNO', 'San Antonio de Putiña', 'Putina'),
('PUNO', 'San Román', 'Juliaca'),
('PUNO', 'Sandía', 'Sandia'),
('PUNO', 'Yunguyo', 'Yunguyo'),
('SAN MARTÍN', 'Moyobamba', 'Moyobamba'),
('SAN MARTÍN', 'Bellavista', 'Bellavista'),
('SAN MARTÍN', 'El Dorado', 'San José de Sisa'),
('SAN MARTÍN', 'Huallaga', 'Saposoa'),
('SAN MARTÍN', 'Lamas', 'Lamas'),
('SAN MARTÍN', 'Mariscal Cáceres', 'Juanjuí'),
('SAN MARTÍN', 'Picota', 'Picota'),
('SAN MARTÍN', 'Rioja', 'Rioja'),
('SAN MARTÍN', 'San Martín', 'Tarapoto'),
('SAN MARTÍN', 'Tocache', 'Tocache'),
('TACNA', 'Tacna', 'Tacna'),
('TACNA', 'Candarave', 'Candarave'),
('TACNA', 'Jorge Basadre', 'Locumba'),
('TACNA', 'Tarata', 'Tarata'),
('TUMBES', 'Tumbes', 'Tumbes'),
('TUMBES', 'Contralmirante Villar', 'Zorritos'),
('TUMBES', 'Zarumilla', 'Zarumilla'),
('UCAYALI', 'Coronel Portillo', 'Pucallpa'),
('UCAYALI', 'Atalaya', 'Atalaya'),
('UCAYALI', 'Padre Abad', 'Aguaytía'),
('UCAYALI', 'Purús', 'Puerto Esperanza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito`
--

CREATE TABLE `distrito` (
  `id_dtto` int(11) NOT NULL COMMENT 'ID UNICO',
  `des_dtto` varchar(30) NOT NULL COMMENT 'DESCRIPCION DISTRITO',
  `pais_dtto` int(11) NOT NULL,
  `prov_dtto` int(11) NOT NULL,
  `depto_dtto` int(11) NOT NULL COMMENT 'DEPARTAMENTO DISTRITO',
  `status_dtto` int(11) NOT NULL COMMENT 'ESTATUS DISTRITO',
  `sucursal_dtto` int(11) NOT NULL COMMENT 'SUCURSAL DISTRITO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE DISTRITOS';

--
-- Volcado de datos para la tabla `distrito`
--

INSERT INTO `distrito` (`id_dtto`, `des_dtto`, `pais_dtto`, `prov_dtto`, `depto_dtto`, `status_dtto`, `sucursal_dtto`) VALUES
(1, 'Bagua', 241, 1, 1, 1, 1),
(2, 'Jumbilla', 241, 1, 2, 1, 1),
(3, 'Chachapoyas', 241, 1, 3, 1, 1),
(4, 'Santa María Nieva', 241, 1, 4, 1, 1),
(5, 'Lamud', 241, 1, 5, 1, 1),
(6, 'Mendoza', 241, 1, 6, 1, 1),
(7, 'Bagua Grande', 241, 1, 7, 1, 1),
(8, 'Aija', 241, 2, 8, 1, 1),
(9, 'Llamellín', 241, 2, 9, 1, 1),
(10, 'Chacas', 241, 2, 10, 1, 1),
(11, 'Chiquián', 241, 2, 11, 1, 1),
(12, 'Carhuaz', 241, 2, 12, 1, 1),
(13, 'San Luis', 241, 2, 13, 1, 1),
(14, 'Casma', 241, 2, 14, 1, 1),
(15, 'Corongo', 241, 2, 15, 1, 1),
(16, 'Huaraz', 241, 2, 16, 1, 1),
(17, 'Huari', 241, 2, 17, 1, 1),
(18, 'Huarmey', 241, 2, 18, 1, 1),
(19, 'Caras', 241, 2, 19, 1, 1),
(20, 'Piscobamba', 241, 2, 20, 1, 1),
(21, 'Ocros', 241, 2, 21, 1, 1),
(22, 'Cabana', 241, 2, 22, 1, 1),
(23, 'Pomabamba', 241, 2, 23, 1, 1),
(24, 'Recuay', 241, 2, 24, 1, 1),
(25, 'Chimbo', 241, 2, 25, 1, 1),
(26, 'Sihuas', 241, 2, 26, 1, 1),
(27, 'Yungay', 241, 2, 27, 1, 1),
(28, 'Abancay', 241, 3, 28, 1, 1),
(29, 'Andahuaylas', 241, 3, 29, 1, 1),
(30, 'Antabamba', 241, 3, 30, 1, 1),
(31, 'Chalhuanca', 241, 3, 31, 1, 1),
(32, 'Chincheros', 241, 3, 32, 1, 1),
(33, 'Tambobamba', 241, 3, 33, 1, 1),
(34, 'Chuquibambilla', 241, 3, 34, 1, 1),
(35, 'Arequipa', 241, 4, 35, 1, 1),
(36, 'Camaná', 241, 4, 36, 1, 1),
(37, 'Caraveli', 241, 4, 37, 1, 1),
(38, 'Aplao', 241, 4, 38, 1, 1),
(39, 'Chivay', 241, 4, 39, 1, 1),
(40, 'Chuquibamba', 241, 4, 40, 1, 1),
(41, 'Mollendo', 241, 4, 41, 1, 1),
(42, 'Cotahuasi', 241, 4, 42, 1, 1),
(43, 'Cangallo', 241, 5, 43, 1, 1),
(44, 'Ayacucho', 241, 5, 44, 1, 1),
(45, 'Huancasancos', 241, 5, 45, 1, 1),
(46, 'Huanta', 241, 5, 46, 1, 1),
(47, 'San Miguel', 241, 5, 47, 1, 1),
(48, 'Puquio', 241, 5, 48, 1, 1),
(49, 'Coracora', 241, 5, 49, 1, 1),
(50, 'Pauza', 241, 5, 50, 1, 1),
(51, 'Querobamba', 241, 5, 51, 1, 1),
(52, 'Huancapi', 241, 5, 52, 1, 1),
(53, 'Vilcashuamán', 241, 5, 53, 1, 1),
(54, 'Cajabamba', 241, 6, 54, 1, 1),
(55, 'Cajamarca', 241, 6, 55, 1, 1),
(56, 'Celendín', 241, 6, 56, 1, 1),
(57, 'Chota', 241, 6, 57, 1, 1),
(58, 'Contumazá', 241, 6, 58, 1, 1),
(59, 'Cutervo', 241, 6, 59, 1, 1),
(60, 'Bambamarca', 241, 6, 60, 1, 1),
(61, 'Jaén', 241, 6, 61, 1, 1),
(62, 'San Ignacio', 241, 6, 62, 1, 1),
(63, 'San marcos (Pedro Gálvez)', 241, 6, 63, 1, 1),
(64, 'San Miguel de Pallaques', 241, 6, 64, 1, 1),
(65, 'San Pablo', 241, 6, 65, 1, 1),
(66, 'Santa Cruz de Succhabamba', 241, 6, 66, 1, 1),
(67, 'Callao', 241, 7, 67, 1, 1),
(68, 'Acomayo', 241, 8, 68, 1, 1),
(69, 'Anta', 241, 8, 69, 1, 1),
(70, 'Calca', 241, 8, 70, 1, 1),
(71, 'Yanaoca', 241, 8, 71, 1, 1),
(72, 'Sicuani', 241, 8, 72, 1, 1),
(73, 'Santo Tomás', 241, 8, 73, 1, 1),
(74, 'Cusco', 241, 8, 74, 1, 1),
(75, 'Yauri (Espinar)', 241, 8, 75, 1, 1),
(76, 'Quillabamba', 241, 8, 76, 1, 1),
(77, 'Paruro', 241, 8, 77, 1, 1),
(78, 'Paucartambo', 241, 8, 78, 1, 1),
(79, 'Urcos', 241, 8, 79, 1, 1),
(80, 'Urubamba', 241, 8, 80, 1, 1),
(81, 'Acobamba', 241, 9, 81, 1, 1),
(82, 'Lircay', 241, 9, 82, 1, 1),
(83, 'Castrovirreyna', 241, 9, 83, 1, 1),
(84, 'Churcampa', 241, 9, 84, 1, 1),
(85, 'Huancavelica', 241, 9, 85, 1, 1),
(86, 'Huaytará', 241, 9, 86, 1, 1),
(87, 'Pampas', 241, 9, 87, 1, 1),
(88, 'Ambo', 241, 10, 88, 1, 1),
(89, 'La Unión', 241, 10, 89, 1, 1),
(90, 'Huacaybamba', 241, 10, 90, 1, 1),
(91, 'Llata', 241, 10, 91, 1, 1),
(92, 'Huánuco', 241, 10, 92, 1, 1),
(93, 'Jesús', 241, 10, 93, 1, 1),
(94, 'Tingo María', 241, 10, 94, 1, 1),
(95, 'Huacrachuco', 241, 10, 95, 1, 1),
(96, 'Panao', 241, 10, 96, 1, 1),
(97, 'Puerto Inca', 241, 10, 97, 1, 1),
(98, 'Chavinillo', 241, 10, 98, 1, 1),
(99, 'Chincha Alta', 241, 11, 99, 1, 1),
(100, 'Ica', 241, 11, 100, 1, 1),
(101, 'Nazca', 241, 11, 101, 1, 1),
(102, 'Palpa', 241, 11, 102, 1, 1),
(103, 'Pisco', 241, 11, 103, 1, 1),
(104, 'La Merced', 241, 12, 104, 1, 1),
(105, 'Chupaca', 241, 12, 105, 1, 1),
(106, 'Concepción', 241, 12, 106, 1, 1),
(107, 'Huancayo', 241, 12, 107, 1, 1),
(108, 'Jauja', 241, 12, 108, 1, 1),
(109, 'Junín', 241, 12, 109, 1, 1),
(110, 'Satipo', 241, 12, 110, 1, 1),
(111, 'Tarma', 241, 12, 111, 1, 1),
(112, 'La Oroya', 241, 12, 112, 1, 1),
(113, 'Ascope', 241, 13, 113, 1, 1),
(114, 'Bolívar', 241, 13, 114, 1, 1),
(115, 'Chepén', 241, 13, 115, 1, 1),
(116, 'Cascas', 241, 13, 116, 1, 1),
(117, 'Julcán', 241, 13, 117, 1, 1),
(118, 'Otuzco', 241, 13, 118, 1, 1),
(119, 'San Pedro de Lloc', 241, 13, 119, 1, 1),
(120, 'Tayabamba', 241, 13, 120, 1, 1),
(121, 'Huamachuco', 241, 13, 121, 1, 1),
(122, 'Santiago de Chuco', 241, 13, 122, 1, 1),
(123, 'Trujillo', 241, 13, 123, 1, 1),
(124, 'Virú', 241, 13, 124, 1, 1),
(125, 'Chiclayo', 241, 14, 125, 1, 1),
(126, 'Ferreñafe', 241, 14, 126, 1, 1),
(127, 'Lambayeque', 241, 14, 127, 1, 1),
(128, 'Barranca', 241, 15, 128, 1, 1),
(129, 'Cajatambo', 241, 15, 129, 1, 1),
(130, 'Canta', 241, 15, 130, 1, 1),
(131, 'San Vicente de Cañete', 241, 15, 131, 1, 1),
(132, 'Huaral', 241, 15, 132, 1, 1),
(133, 'Matucana', 241, 15, 133, 1, 1),
(134, 'Huacho', 241, 15, 134, 1, 1),
(135, 'Lima', 241, 15, 135, 1, 1),
(136, 'Oyón', 241, 15, 136, 1, 1),
(137, 'Yauyos', 241, 15, 137, 1, 1),
(138, 'Yurimaguas', 241, 16, 138, 1, 1),
(139, 'San Lorenzo', 241, 16, 139, 1, 1),
(140, 'Nauta', 241, 16, 140, 1, 1),
(141, 'Caballococha', 241, 16, 141, 1, 1),
(142, 'Iquitos', 241, 16, 142, 1, 1),
(143, 'San Antonio del Estrecho', 241, 16, 143, 1, 1),
(144, 'Requena', 241, 16, 144, 1, 1),
(145, 'Contamana', 241, 16, 145, 1, 1),
(146, 'Salvación', 241, 17, 146, 1, 1),
(147, 'Iñapari', 241, 17, 147, 1, 1),
(148, 'Puerto Maldonado', 241, 17, 148, 1, 1),
(149, 'Omate', 241, 18, 149, 1, 1),
(150, 'Ilo', 241, 18, 150, 1, 1),
(151, 'Moquegua', 241, 18, 151, 1, 1),
(152, 'Yanahuanca', 241, 19, 152, 1, 1),
(153, 'Oxapampa', 241, 19, 153, 1, 1),
(154, 'Cerro de Pasco', 241, 19, 154, 1, 1),
(155, 'Ayabaca', 241, 20, 155, 1, 1),
(156, 'Huancabamba', 241, 20, 156, 1, 1),
(157, 'Chulucanas', 241, 20, 157, 1, 1),
(158, 'Paita', 241, 20, 158, 1, 1),
(159, 'Piura', 241, 20, 159, 1, 1),
(160, 'Sechura', 241, 20, 160, 1, 1),
(161, 'Sullana', 241, 20, 161, 1, 1),
(162, 'Talara', 241, 20, 162, 1, 1),
(163, 'Azángaro', 241, 21, 163, 1, 1),
(164, 'Macusani', 241, 21, 164, 1, 1),
(165, 'Juli', 241, 21, 165, 1, 1),
(166, 'Ilave', 241, 21, 166, 1, 1),
(167, 'Huancané', 241, 21, 167, 1, 1),
(168, 'Lampa', 241, 21, 168, 1, 1),
(169, 'Ayaviri', 241, 21, 169, 1, 1),
(170, 'Moho', 241, 21, 170, 1, 1),
(171, 'Puno', 241, 21, 171, 1, 1),
(172, 'Putina', 241, 21, 172, 1, 1),
(173, 'Juliaca', 241, 21, 173, 1, 1),
(174, 'Sandia', 241, 21, 174, 1, 1),
(175, 'Yunguyo', 241, 21, 175, 1, 1),
(176, 'Bellavista', 241, 22, 176, 1, 1),
(177, 'San José de Sisa', 241, 22, 177, 1, 1),
(178, 'Saposoa', 241, 22, 178, 1, 1),
(179, 'Lamas', 241, 22, 179, 1, 1),
(180, 'Juanjuí', 241, 22, 180, 1, 1),
(181, 'Moyobamba', 241, 22, 181, 1, 1),
(182, 'Picota', 241, 22, 182, 1, 1),
(183, 'Rioja', 241, 22, 183, 1, 1),
(184, 'Tarapoto', 241, 22, 184, 1, 1),
(185, 'Tocache', 241, 22, 185, 1, 1),
(186, 'Candarave', 241, 23, 186, 1, 1),
(187, 'Locumba', 241, 23, 187, 1, 1),
(188, 'Tacna', 241, 23, 188, 1, 1),
(189, 'Tarata', 241, 23, 189, 1, 1),
(190, 'Zorritos', 241, 24, 190, 1, 1),
(191, 'Tumbes', 241, 24, 191, 1, 1),
(192, 'Zarumilla', 241, 24, 192, 1, 1),
(193, 'Atalaya', 241, 25, 193, 1, 1),
(194, 'Pucallpa', 241, 25, 194, 1, 1),
(195, 'Aguaytía', 241, 25, 195, 1, 1),
(196, 'Puerto Esperanza', 241, 25, 196, 1, 1),
(206, 'San Jose', 231, 28, 215, 1, 1),
(213, 'Candelaria', 231, 28, 215, 1, 1),
(215, 'Rafael Urdaneta', 231, 28, 215, 1, 1),
(216, 'Miguel Peña', 231, 28, 215, 1, 1),
(217, 'SIN DISTRITO', 241, 29, 216, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

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
(1, 'CORPORACION LEOPHARD S.A.C.', 1, '', '20604954241', 1, '', 'Jr. Las Alcaparras N° 467 Urb. Las Flores - S.J.L. - Lima - Lima (Pdo. 4 Av. las Flores de Primavera)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inv` int(11) NOT NULL COMMENT 'ID UNICO',
  `tipotrans_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'TIPO TRANSACCION INVENTARIO',
  `fecha_inv` date NOT NULL COMMENT 'FECHA DE CREACION INVENTARIO',
  `fecham_inv` date NOT NULL COMMENT 'FECHA DE MODIFICACION INVENTARIO',
  `prod_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'PRODUCTO INVENTARIO',
  `cantidad_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'CANTIDAD INVENTARIO',
  `orden_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'NUMERO DE ORDEN PEDIDO / COMPRA INVENTARIO',
  `sucursal_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL INVENTARIO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA MOVIMIENTOS DE ALMACEN';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_precios`
--

CREATE TABLE `lista_precios` (
  `id_lista` int(11) NOT NULL COMMENT 'ID UNICO',
  `tipo_lista` int(11) NOT NULL DEFAULT '0' COMMENT 'TIPO DE LISTA DE PRECIO',
  `prod_lista` int(11) NOT NULL DEFAULT '0' COMMENT 'PRODUCTO LISTA',
  `precio_lista` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'PRECIO LISTA',
  `sucursal_lista` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL LISTA',
  `preciod_lista` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'PRECIO DIVISAS LISTA',
  `preciom_lista` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'PRECIO MONEDA LOCAL LISTA',
  `utilidad1_lista` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'UTILIDAD 1 LISTA',
  `utilidad2_lista` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'UTILIDAD 2 LISTA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA LISTAS DE PRECIOS';

--
-- Volcado de datos para la tabla `lista_precios`
--

INSERT INTO `lista_precios` (`id_lista`, `tipo_lista`, `prod_lista`, `precio_lista`, `sucursal_lista`, `preciod_lista`, `preciom_lista`, `utilidad1_lista`, `utilidad2_lista`) VALUES
(2, 1, 1, '70.00', 1, '0.50', '0.00', '0.00', '0.00'),
(3, 1, 2, '60.00', 1, '0.00', '0.00', '0.00', '0.00'),
(4, 1, 3, '21.00', 1, '0.00', '0.00', '0.00', '0.00'),
(5, 1, 4, '52.00', 1, '0.00', '0.00', '0.00', '0.00'),
(6, 1, 5, '60.00', 1, '0.00', '0.00', '0.00', '0.00'),
(7, 1, 6, '35.00', 1, '0.00', '0.00', '0.00', '0.00'),
(8, 1, 7, '58.00', 1, '0.00', '0.00', '0.00', '0.00'),
(9, 1, 8, '40.00', 1, '0.00', '0.00', '0.00', '0.00'),
(10, 1, 9, '140.00', 1, '0.00', '0.00', '0.00', '0.00'),
(11, 1, 10, '40.00', 1, '0.00', '0.00', '0.00', '0.00'),
(12, 1, 11, '25.00', 1, '0.00', '0.00', '0.00', '0.00'),
(13, 1, 12, '25.00', 1, '0.00', '0.00', '0.00', '0.00'),
(14, 1, 13, '41.70', 1, '0.00', '0.00', '0.00', '0.00'),
(15, 1, 14, '45.00', 1, '0.00', '0.00', '0.00', '0.00'),
(16, 1, 15, '17.00', 1, '0.00', '0.00', '0.00', '0.00'),
(17, 1, 16, '34.00', 1, '0.00', '0.00', '0.00', '0.00'),
(18, 1, 17, '56.00', 1, '0.00', '0.00', '0.00', '0.00'),
(19, 1, 18, '79.60', 1, '0.00', '0.00', '0.00', '0.00'),
(20, 1, 21, '64.00', 1, '0.00', '0.00', '0.00', '0.00'),
(21, 1, 22, '32.00', 1, '0.00', '0.00', '0.00', '0.00'),
(22, 1, 23, '16.00', 1, '0.00', '0.00', '0.00', '0.00'),
(23, 1, 24, '16.00', 1, '0.00', '0.00', '0.00', '0.00'),
(24, 1, 25, '36.00', 1, '0.00', '0.00', '0.00', '0.00'),
(25, 1, 26, '45.50', 1, '0.00', '0.00', '0.00', '0.00'),
(26, 1, 27, '43.00', 1, '0.00', '0.00', '0.00', '0.00'),
(27, 1, 28, '50.00', 1, '0.00', '0.00', '0.00', '0.00'),
(28, 1, 29, '40.00', 1, '0.00', '0.00', '0.00', '0.00'),
(29, 1, 30, '110.00', 1, '0.00', '0.00', '0.00', '0.00'),
(30, 1, 31, '141.00', 1, '0.00', '0.00', '0.00', '0.00'),
(31, 1, 32, '58.00', 1, '0.00', '0.00', '0.00', '0.00'),
(32, 1, 33, '29.00', 1, '0.00', '0.00', '0.00', '0.00'),
(33, 1, 34, '29.00', 1, '0.00', '0.00', '0.00', '0.00'),
(34, 1, 35, '50.00', 1, '0.00', '0.00', '0.00', '0.00'),
(35, 1, 36, '42.00', 1, '0.00', '0.00', '0.00', '0.00'),
(36, 1, 37, '40.00', 1, '0.00', '0.00', '0.00', '0.00'),
(37, 1, 38, '70.00', 1, '0.00', '0.00', '0.00', '0.00'),
(38, 1, 39, '90.00', 1, '0.00', '0.00', '0.00', '0.00'),
(39, 1, 40, '130.00', 1, '0.00', '0.00', '0.00', '0.00'),
(40, 1, 41, '90.00', 1, '0.00', '0.00', '0.00', '0.00'),
(41, 1, 42, '29.00', 1, '0.00', '0.00', '0.00', '0.00'),
(42, 1, 43, '29.00', 1, '0.00', '0.00', '0.00', '0.00'),
(43, 1, 44, '118.50', 1, '0.00', '0.00', '0.00', '0.00'),
(44, 1, 45, '63.00', 1, '0.00', '0.00', '0.00', '0.00'),
(45, 1, 46, '90.40', 1, '0.00', '0.00', '0.00', '0.00'),
(46, 1, 47, '55.00', 1, '0.00', '0.00', '0.00', '0.00'),
(47, 1, 48, '75.00', 1, '0.00', '0.00', '0.00', '0.00'),
(48, 1, 49, '90.00', 1, '0.00', '0.00', '0.00', '0.00'),
(49, 1, 50, '38.00', 1, '0.00', '0.00', '0.00', '0.00'),
(50, 1, 51, '38.00', 1, '0.00', '0.00', '0.00', '0.00'),
(51, 1, 52, '98.00', 1, '0.00', '0.00', '0.00', '0.00'),
(52, 1, 53, '85.00', 1, '0.00', '0.00', '0.00', '0.00'),
(53, 1, 54, '70.00', 1, '0.00', '0.00', '0.00', '0.00'),
(54, 1, 55, '65.00', 1, '0.00', '0.00', '0.00', '0.00'),
(55, 1, 56, '40.00', 1, '0.00', '0.00', '0.00', '0.00'),
(56, 1, 57, '48.00', 1, '0.00', '0.00', '0.00', '0.00'),
(57, 1, 58, '96.00', 1, '0.00', '0.00', '0.00', '0.00'),
(58, 1, 59, '102.00', 1, '0.00', '0.00', '0.00', '0.00'),
(59, 1, 60, '60.00', 1, '0.00', '0.00', '0.00', '0.00'),
(60, 1, 61, '30.00', 1, '0.00', '0.00', '0.00', '0.00'),
(61, 1, 62, '30.00', 1, '0.00', '0.00', '0.00', '0.00'),
(62, 1, 63, '60.00', 1, '0.00', '0.00', '0.00', '0.00'),
(63, 1, 64, '52.00', 1, '0.00', '0.00', '0.00', '0.00'),
(64, 1, 65, '100.00', 1, '0.00', '0.00', '0.00', '0.00'),
(65, 1, 66, '120.00', 1, '0.00', '0.00', '0.00', '0.00'),
(66, 1, 67, '62.00', 1, '0.00', '0.00', '0.00', '0.00'),
(67, 1, 68, '60.00', 1, '0.00', '0.00', '0.00', '0.00'),
(68, 1, 69, '130.00', 1, '0.00', '0.00', '0.00', '0.00'),
(69, 1, 71, '90.00', 1, '0.00', '0.00', '0.00', '0.00'),
(70, 1, 72, '150.00', 1, '0.00', '0.00', '0.00', '0.00'),
(71, 1, 73, '58.00', 1, '0.00', '0.00', '0.00', '0.00'),
(72, 1, 74, '73.50', 1, '0.00', '0.00', '0.00', '0.00'),
(73, 1, 75, '95.55', 1, '0.00', '0.00', '0.00', '0.00'),
(74, 1, 76, '116.00', 1, '0.00', '0.00', '0.00', '0.00'),
(75, 1, 77, '141.00', 1, '0.00', '0.00', '0.00', '0.00'),
(76, 1, 78, '125.00', 1, '0.00', '0.00', '0.00', '0.00'),
(77, 1, 79, '80.00', 1, '0.00', '0.00', '0.00', '0.00'),
(78, 1, 80, '80.00', 1, '0.00', '0.00', '0.00', '0.00'),
(79, 1, 81, '150.00', 1, '0.00', '0.00', '0.00', '0.00'),
(80, 1, 82, '60.00', 1, '0.00', '0.00', '0.00', '0.00'),
(81, 1, 83, '86.00', 1, '0.00', '0.00', '0.00', '0.00'),
(82, 1, 84, '86.00', 1, '0.00', '0.00', '0.00', '0.00'),
(83, 1, 85, '41.70', 1, '0.00', '0.00', '0.00', '0.00'),
(84, 1, 86, '70.80', 1, '0.00', '0.00', '0.00', '0.00'),
(85, 1, 87, '138.80', 1, '0.00', '0.00', '0.00', '0.00'),
(86, 1, 88, '99.50', 1, '0.00', '0.00', '0.00', '0.00'),
(87, 1, 89, '124.70', 1, '0.00', '0.00', '0.00', '0.00'),
(88, 1, 90, '130.80', 1, '0.00', '0.00', '0.00', '0.00'),
(89, 1, 91, '86.80', 1, '0.00', '0.00', '0.00', '0.00'),
(90, 1, 92, '24.00', 1, '0.00', '0.00', '0.00', '0.00'),
(91, 1, 93, '80.00', 1, '0.00', '0.00', '0.00', '0.00'),
(92, 1, 94, '105.60', 1, '0.00', '0.00', '0.00', '0.00'),
(93, 1, 95, '84.00', 1, '0.00', '0.00', '0.00', '0.00'),
(94, 1, 96, '111.00', 1, '0.00', '0.00', '0.00', '0.00'),
(95, 1, 97, '35.00', 1, '0.00', '0.00', '0.00', '0.00'),
(96, 1, 98, '109.20', 1, '0.00', '0.00', '0.00', '0.00'),
(97, 1, 99, '47.50', 1, '0.00', '0.00', '0.00', '0.00'),
(98, 1, 100, '109.20', 1, '0.00', '0.00', '0.00', '0.00'),
(99, 1, 101, '126.50', 1, '0.00', '0.00', '0.00', '0.00'),
(100, 1, 102, '55.00', 1, '0.00', '0.00', '0.00', '0.00'),
(101, 1, 103, '25.00', 1, '0.00', '0.00', '0.00', '0.00'),
(102, 1, 104, '25.00', 1, '0.00', '0.00', '0.00', '0.00'),
(103, 1, 105, '70.00', 1, '0.00', '0.00', '0.00', '0.00'),
(104, 1, 106, '70.00', 1, '0.00', '0.00', '0.00', '0.00'),
(105, 1, 107, '103.40', 1, '0.00', '0.00', '0.00', '0.00'),
(106, 1, 108, '67.00', 1, '0.00', '0.00', '0.00', '0.00'),
(107, 1, 109, '145.30', 1, '0.00', '0.00', '0.00', '0.00'),
(108, 1, 110, '123.30', 1, '0.00', '0.00', '0.00', '0.00'),
(109, 1, 111, '136.60', 1, '0.00', '0.00', '0.00', '0.00'),
(110, 1, 112, '58.60', 1, '0.00', '0.00', '0.00', '0.00'),
(111, 1, 113, '108.50', 1, '0.00', '0.00', '0.00', '0.00'),
(112, 1, 114, '145.30', 1, '0.00', '0.00', '0.00', '0.00'),
(113, 1, 115, '103.40', 1, '0.00', '0.00', '0.00', '0.00'),
(114, 1, 116, '94.70', 1, '0.00', '0.00', '0.00', '0.00'),
(115, 1, 117, '70.00', 1, '0.00', '0.00', '0.00', '0.00'),
(116, 1, 118, '48.00', 1, '0.00', '0.00', '0.00', '0.00'),
(117, 1, 120, '118.20', 1, '0.00', '0.00', '0.00', '0.00'),
(118, 1, 122, '85.00', 1, '0.00', '0.00', '0.00', '0.00'),
(119, 1, 123, '60.00', 1, '0.00', '0.00', '0.00', '0.00'),
(120, 1, 124, '18.00', 1, '0.00', '0.00', '0.00', '0.00'),
(121, 1, 125, '18.00', 1, '0.00', '0.00', '0.00', '0.00'),
(122, 1, 126, '75.00', 1, '0.00', '0.00', '0.00', '0.00'),
(123, 1, 127, '100.00', 1, '0.00', '0.00', '0.00', '0.00'),
(124, 1, 128, '118.50', 1, '0.00', '0.00', '0.00', '0.00'),
(125, 1, 129, '110.00', 1, '0.00', '0.00', '0.00', '0.00'),
(126, 1, 130, '123.00', 1, '0.00', '0.00', '0.00', '0.00'),
(127, 1, 131, '87.00', 1, '0.00', '0.00', '0.00', '0.00'),
(128, 1, 132, '133.80', 1, '0.00', '0.00', '0.00', '0.00'),
(129, 1, 133, '90.00', 1, '0.00', '0.00', '0.00', '0.00'),
(130, 1, 134, '109.00', 1, '0.00', '0.00', '0.00', '0.00'),
(131, 1, 135, '110.50', 1, '0.00', '0.00', '0.00', '0.00'),
(132, 1, 136, '23.00', 1, '0.00', '0.00', '0.00', '0.00'),
(133, 1, 137, '56.00', 1, '0.00', '0.00', '0.00', '0.00'),
(134, 1, 138, '109.00', 1, '0.00', '0.00', '0.00', '0.00'),
(135, 1, 139, '147.00', 1, '0.00', '0.00', '0.00', '0.00'),
(136, 1, 140, '20.00', 1, '0.00', '0.00', '0.00', '0.00'),
(137, 1, 141, '91.00', 1, '0.00', '0.00', '0.00', '0.00'),
(138, 1, 142, '102.00', 1, '0.00', '0.00', '0.00', '0.00'),
(139, 1, 143, '94.00', 1, '0.00', '0.00', '0.00', '0.00'),
(140, 1, 144, '108.50', 1, '0.00', '0.00', '0.00', '0.00'),
(141, 1, 145, '48.00', 1, '0.00', '0.00', '0.00', '0.00'),
(142, 1, 146, '103.80', 1, '0.00', '0.00', '0.00', '0.00'),
(143, 1, 147, '93.00', 1, '0.00', '0.00', '0.00', '0.00'),
(144, 1, 148, '46.00', 1, '0.00', '0.00', '0.00', '0.00'),
(145, 1, 149, '106.00', 1, '0.00', '0.00', '0.00', '0.00'),
(146, 1, 150, '113.00', 1, '0.00', '0.00', '0.00', '0.00'),
(147, 1, 151, '13.00', 1, '0.00', '0.00', '0.00', '0.00'),
(148, 1, 152, '13.00', 1, '0.00', '0.00', '0.00', '0.00'),
(149, 1, 153, '30.00', 1, '0.00', '0.00', '0.00', '0.00'),
(150, 1, 154, '30.00', 1, '0.00', '0.00', '0.00', '0.00'),
(151, 1, 155, '50.00', 1, '0.00', '0.00', '0.00', '0.00'),
(152, 1, 156, '50.00', 1, '0.00', '0.00', '0.00', '0.00'),
(153, 1, 157, '130.00', 1, '0.00', '0.00', '0.00', '0.00'),
(154, 1, 158, '134.50', 1, '0.00', '0.00', '0.00', '0.00'),
(155, 1, 159, '120.00', 1, '0.00', '0.00', '0.00', '0.00'),
(156, 1, 160, '140.00', 1, '0.00', '0.00', '0.00', '0.00'),
(157, 1, 161, '120.50', 1, '0.00', '0.00', '0.00', '0.00'),
(158, 1, 162, '75.00', 1, '0.00', '0.00', '0.00', '0.00'),
(159, 1, 163, '146.00', 1, '0.00', '0.00', '0.00', '0.00'),
(160, 1, 164, '92.00', 1, '0.00', '0.00', '0.00', '0.00'),
(161, 1, 165, '63.00', 1, '0.00', '0.00', '0.00', '0.00'),
(162, 1, 166, '22.50', 1, '0.00', '0.00', '0.00', '0.00'),
(163, 1, 167, '22.50', 1, '0.00', '0.00', '0.00', '0.00'),
(164, 1, 168, '145.20', 1, '0.00', '0.00', '0.00', '0.00'),
(165, 1, 169, '109.50', 1, '0.00', '0.00', '0.00', '0.00'),
(166, 1, 170, '138.00', 1, '0.00', '0.00', '0.00', '0.00'),
(167, 1, 171, '60.00', 1, '0.00', '0.00', '0.00', '0.00'),
(168, 1, 172, '40.00', 1, '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m140506_102106_rbac_init', 1562771518),
('m140602_111327_create_menu_table', 1562771473),
('m160312_050000_create_user', 1562771473),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1562771518),
('m180523_151638_rbac_updates_indexes_without_prefix', 1562771518);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `id_moneda` int(11) NOT NULL COMMENT 'ID UNICO',
  `des_moneda` varchar(50) NOT NULL COMMENT 'DESCRIPCION MONEDA',
  `tipo_moneda` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'TIPO MONEDA',
  `status_moneda` int(11) NOT NULL COMMENT 'ESTATUS MONEDA',
  `sucursal_moneda` int(11) NOT NULL COMMENT 'SUCURSAL MONEDA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT=' GUARDA DATOS DE MONEDAS';

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`id_moneda`, `des_moneda`, `tipo_moneda`, `status_moneda`, `sucursal_moneda`) VALUES
(1, 'Soles', 'N', 1, 1),
(2, 'Dolares', 'E', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_inv`
--

CREATE TABLE `movimiento_inv` (
  `id_inv` int(11) NOT NULL COMMENT 'ID UNICO',
  `tipotrans_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'TIPO TRANSACCION INVENTARIO',
  `fecha_inv` date NOT NULL COMMENT 'FECHA DE CREACION INVENTARIO',
  `fecham_inv` date NOT NULL COMMENT 'FECHA DE MODIFICACION INVENTARIO',
  `prod_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'PRODUCTO INVENTARIO',
  `cantidad_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'CANTIDAD INVENTARIO',
  `orden_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'NUMERO DE ORDEN PEDIDO / COMPRA INVENTARIO',
  `sucursal_inv` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL INVENTARIO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA MOVIMIENTOS DE ALMACEN';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeracion`
--

CREATE TABLE `numeracion` (
  `id_num` int(11) NOT NULL COMMENT 'ID UNICO',
  `tipo_num` int(11) NOT NULL DEFAULT '0' COMMENT 'TIPO NUMERACION',
  `numero_num` varchar(10) NOT NULL DEFAULT '0000000000' COMMENT 'NUMERO NUMERACION',
  `sucursal_num` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL NUMERACION',
  `serie_num` varchar(2) NOT NULL COMMENT 'SERIE NUMERACION',
  `status_num` int(11) NOT NULL DEFAULT '0' COMMENT 'ESTATUS NUMERACION'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA NUMERACION DE DOCUMENTOS';

--
-- Volcado de datos para la tabla `numeracion`
--

INSERT INTO `numeracion` (`id_num`, `tipo_num`, `numero_num`, `sucursal_num`, `serie_num`, `status_num`) VALUES
(1, 1, '0000000000', 1, '00', 1),
(2, 7, '0000000001', 1, '00', 1),
(3, 8, '0000000000', 1, '00', 1),
(4, 6, '0000000001', 1, '00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL COMMENT 'ID UNICO',
  `cod_pais` varchar(3) NOT NULL COMMENT 'CODIGO PAIS',
  `des_pais` varchar(100) NOT NULL COMMENT 'DESCIPCION DE PAIS',
  `status_pais` int(11) NOT NULL DEFAULT '1' COMMENT 'ESTATUS PAIS',
  `sucursal_pais` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL PAIS'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE PAISES';

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `cod_pais`, `des_pais`, `status_pais`, `sucursal_pais`) VALUES
(1, 'AND', 'Andorra', 1, 1),
(2, 'ARE', 'Emiratos Árabes Unidos', 1, 1),
(3, 'AFG', 'Afganistán', 1, 1),
(4, 'ATG', 'Antigua y Barbuda', 1, 1),
(5, 'AIA', 'Anguila', 1, 1),
(6, 'ALB', 'Albania', 1, 1),
(7, 'ARM', 'Armenia', 1, 1),
(8, 'ANT', 'Antillas Neerlandesas', 1, 1),
(9, 'AGO', 'Angola', 1, 1),
(10, 'ATA', 'Antártida', 1, 1),
(11, 'ARG', 'Argentina', 1, 1),
(12, 'ASM', 'Samoa Americana', 1, 1),
(13, 'AUT', 'Austria', 1, 1),
(14, 'AUS', 'Australia', 1, 1),
(15, 'ABW', 'Aruba', 1, 1),
(16, 'ALA', 'Islas Áland', 1, 1),
(17, 'AZE', 'Azerbaiyán', 1, 1),
(18, 'BIH', 'Bosnia y Herzegovina', 1, 1),
(19, 'BRB', 'Barbados', 1, 1),
(20, 'BGD', 'Bangladesh', 1, 1),
(21, 'BEL', 'Bélgica', 1, 1),
(22, 'BFA', 'Burkina Faso', 1, 1),
(23, 'BGR', 'Bulgaria', 1, 1),
(24, 'BHR', 'Bahréin', 1, 1),
(25, 'BDI', 'Burundi', 1, 1),
(26, 'BEN', 'Benin', 1, 1),
(27, 'BLM', 'San Bartolomé', 1, 1),
(28, 'BMU', 'Bermudas', 1, 1),
(29, 'BRN', 'Brunéi', 1, 1),
(30, 'BOL', 'Bolivia', 1, 1),
(31, 'BRA', 'Brasil', 1, 1),
(32, 'BHS', 'Bahamas', 1, 1),
(33, 'BTN', 'Bhután', 1, 1),
(34, 'BVT', 'Isla Bouvet', 1, 1),
(35, 'BWA', 'Botsuana', 1, 1),
(36, 'BLR', 'Belarús', 1, 1),
(37, 'BLZ', 'Belice', 1, 1),
(38, 'CAN', 'Canadá', 1, 1),
(39, 'CCK', 'Islas Cocos', 1, 1),
(40, 'CAF', 'República Centro-Africana', 1, 1),
(41, 'COG', 'Congo', 1, 1),
(42, 'CHE', 'Suiza', 1, 1),
(43, 'CIV', 'Costa de Marfil', 1, 1),
(44, 'COK', 'Islas Cook', 1, 1),
(45, 'CHL', 'Chile', 1, 1),
(46, 'CMR', 'Camerún', 1, 1),
(47, 'CHN', 'China', 1, 1),
(48, 'COL', 'Colombia', 1, 1),
(49, 'CRI', 'Costa Rica', 1, 1),
(50, 'CUB', 'Cuba', 1, 1),
(51, 'CPV', 'Cabo Verde', 1, 1),
(52, 'CXR', 'Islas Christmas', 1, 1),
(53, 'CYP', 'Chipre', 1, 1),
(54, 'CZE', 'República Checa', 1, 1),
(55, 'DEU', 'Alemania', 1, 1),
(56, 'DJI', 'Yibuti', 1, 1),
(57, 'DNK', 'Dinamarca', 1, 1),
(58, 'DMA', 'Domínica', 1, 1),
(59, 'DOM', 'República Dominicana', 1, 1),
(60, 'DZA', 'Argel', 1, 1),
(61, 'ECU', 'Ecuador', 1, 1),
(62, 'EST', 'Estonia', 1, 1),
(63, 'EGY', 'Egipto', 1, 1),
(64, 'ESH', 'Sahara Occidental', 1, 1),
(65, 'ERI', 'Eritrea', 1, 1),
(66, 'ESP', 'España', 1, 1),
(67, 'ETH', 'Etiopía', 1, 1),
(68, 'FIN', 'Finlandia', 1, 1),
(69, 'FJI', 'Fiji', 1, 1),
(70, 'KLK', 'Islas Malvinas', 1, 1),
(71, 'FSM', 'Micronesia', 1, 1),
(72, 'FRO', 'Islas Faroe', 1, 1),
(73, 'FRA', 'Francia', 1, 1),
(74, 'GAB', 'Gabón', 1, 1),
(75, 'GBR', 'Reino Unido', 1, 1),
(76, 'GRD', 'Granada', 1, 1),
(77, 'GEO', 'Georgia', 1, 1),
(78, 'GUF', 'Guayana Francesa', 1, 1),
(79, 'GGY', 'Guernsey', 1, 1),
(80, 'GHA', 'Ghana', 1, 1),
(81, 'GIB', 'Gibraltar', 1, 1),
(82, 'GRL', 'Groenlandia', 1, 1),
(83, 'GMB', 'Gambia', 1, 1),
(84, 'GIN', 'Guinea', 1, 1),
(85, 'GLP', 'Guadalupe', 1, 1),
(86, 'GNQ', 'Guinea Ecuatorial', 1, 1),
(87, 'GRC', 'Grecia', 1, 1),
(88, 'SGS', 'Georgia del Sur e Islas Sandwich del Sur', 1, 1),
(89, 'GTM', 'Guatemala', 1, 1),
(90, 'GUM', 'Guam', 1, 1),
(91, 'GNB', 'Guinea-Bissau', 1, 1),
(92, 'GUY', 'Guayana', 1, 1),
(93, 'HKG', 'Hong Kong', 1, 1),
(94, 'HMD', 'Islas Heard y McDonald', 1, 1),
(95, 'HND', 'Honduras', 1, 1),
(96, 'HRV', 'Croacia', 1, 1),
(97, 'HTI', 'Haití', 1, 1),
(98, 'HUN', 'Hungría', 1, 1),
(99, 'IDN', 'Indonesia', 1, 1),
(100, 'IRL', 'Irlanda', 1, 1),
(101, 'ISR', 'Israel', 1, 1),
(102, 'IMN', 'Isla de Man', 1, 1),
(103, 'IND', 'India', 1, 1),
(104, 'IOT', 'Territorio Británico del Océano Índico', 1, 1),
(105, 'IRQ', 'Irak', 1, 1),
(106, 'IRN', 'Irán', 1, 1),
(107, 'ISL', 'Islandia', 1, 1),
(108, 'ITA', 'Italia', 1, 1),
(109, 'JEY', 'Jersey', 1, 1),
(110, 'JAM', 'Jamaica', 1, 1),
(111, 'JOR', 'Jordania', 1, 1),
(112, 'JPN', 'Japón', 1, 1),
(113, 'KEN', 'Kenia', 1, 1),
(114, 'KGZ', 'Kirguistán', 1, 1),
(115, 'KHM', 'Camboya', 1, 1),
(116, 'KIR', 'Kiribati', 1, 1),
(117, 'COM', 'Comoros', 1, 1),
(118, 'KNA', 'San Cristóbal y Nieves', 1, 1),
(119, 'PRK', 'Corea del Norte', 1, 1),
(120, 'KOR', 'Corea del Sur', 1, 1),
(121, 'KWT', 'Kuwait', 1, 1),
(122, 'CYM', 'Islas Caimán', 1, 1),
(123, 'KAZ', 'Kazajstán', 1, 1),
(124, 'LAO', 'Laos', 1, 1),
(125, 'LBN', 'Líbano', 1, 1),
(126, 'LCA', 'Santa Lucía', 1, 1),
(127, 'LIE', 'Liechtenstein', 1, 1),
(128, 'LKA', 'Sri Lanka', 1, 1),
(129, 'LBR', 'Liberia', 1, 1),
(130, 'LSO', 'Lesotho', 1, 1),
(131, 'LTU', 'Lituania', 1, 1),
(132, 'LUX', 'Luxemburgo', 1, 1),
(133, 'LVA', 'Letonia', 1, 1),
(134, 'LBY', 'Libia', 1, 1),
(135, 'MAR', 'Marruecos', 1, 1),
(136, 'MCO', 'Mónaco', 1, 1),
(137, 'MDA', 'Moldova', 1, 1),
(138, 'MNE', 'Montenegro', 1, 1),
(139, 'MDG', 'Madagascar', 1, 1),
(140, 'MHL', 'Islas Marshall', 1, 1),
(141, 'MKD', 'Macedonia', 1, 1),
(142, 'MLI', 'Mali', 1, 1),
(143, 'MMR', 'Myanmar', 1, 1),
(144, 'MNG', 'Mongolia', 1, 1),
(145, 'MAC', 'Macao', 1, 1),
(146, 'MTQ', 'Martinica', 1, 1),
(147, 'MRT', 'Mauritania', 1, 1),
(148, 'MSR', 'Montserrat', 1, 1),
(149, 'MLT', 'Malta', 1, 1),
(150, 'MUS', 'Mauricio', 1, 1),
(151, 'MDV', 'Maldivas', 1, 1),
(152, 'MWI', 'Malawi', 1, 1),
(153, 'MEX', 'México', 1, 1),
(154, 'MYS', 'Malasia', 1, 1),
(155, 'MOZ', 'Mozambique', 1, 1),
(156, 'NAM', 'Namibia', 1, 1),
(157, 'NCL', 'Nueva Caledonia', 1, 1),
(158, 'NER', 'Níger', 1, 1),
(159, 'NFK', 'Islas Norkfolk', 1, 1),
(160, 'NGA', 'Nigeria', 1, 1),
(161, 'NIC', 'Nicaragua', 1, 1),
(162, 'NLD', 'Países Bajos', 1, 1),
(163, 'NOR', 'Noruega', 1, 1),
(164, 'NPL', 'Nepal', 1, 1),
(165, 'NRU', 'Nauru', 1, 1),
(166, 'NIU', 'Niue', 1, 1),
(167, 'NZL', 'Nueva Zelanda', 1, 1),
(168, 'OMN', 'Omán', 1, 1),
(169, 'PAN', 'Panamá', 1, 1),
(171, 'PYF', 'Polinesia Francesa', 1, 1),
(172, 'PNG', 'Papúa Nueva Guinea', 1, 1),
(173, 'PHL', 'Filipinas', 1, 1),
(174, 'PAK', 'Pakistán', 1, 1),
(175, 'POL', 'Polonia', 1, 1),
(176, 'SPM', 'San Pedro y Miquelón', 1, 1),
(177, 'PCN', 'Islas Pitcairn', 1, 1),
(178, 'PRI', 'Puerto Rico', 1, 1),
(179, 'PSE', 'Palestina', 1, 1),
(180, 'PRT', 'Portugal', 1, 1),
(181, 'PLW', 'Islas Palaos', 1, 1),
(182, 'PRY', 'Paraguay', 1, 1),
(183, 'QAT', 'Qatar', 1, 1),
(184, 'REU', 'Reunión', 1, 1),
(185, 'ROU', 'Rumanía', 1, 1),
(186, 'SRB', 'Serbia y Montenegro', 1, 1),
(187, 'RUS', 'Rusia', 1, 1),
(188, 'RWA', 'Ruanda', 1, 1),
(189, 'SAU', 'Arabia Saudita', 1, 1),
(190, 'SLB', 'Islas Solomón', 1, 1),
(191, 'SYC', 'Seychelles', 1, 1),
(192, 'SDN', 'Sudán', 1, 1),
(193, 'SWE', 'Suecia', 1, 1),
(194, 'SGP', 'Singapur', 1, 1),
(195, 'SHN', 'Santa Elena', 1, 1),
(196, 'SVN', 'Eslovenia', 1, 1),
(197, 'SJM', 'Islas Svalbard y Jan Mayen', 1, 1),
(198, 'SVK', 'Eslovaquia', 1, 1),
(199, 'SLE', 'Sierra Leona', 1, 1),
(200, 'SMR', 'San Marino', 1, 1),
(201, 'SEN', 'Senegal', 1, 1),
(202, 'SOM', 'Somalia', 1, 1),
(203, 'SUR', 'Surinam', 1, 1),
(204, 'STP', 'Santo Tomé y Príncipe', 1, 1),
(205, 'SLV', 'El Salvador', 1, 1),
(206, 'SYR', 'Siria', 1, 1),
(207, 'SWZ', 'Suazilandia', 1, 1),
(208, 'TCA', 'Islas Turcas y Caicos', 1, 1),
(209, 'TCD', 'Chad', 1, 1),
(210, 'ATF', 'Territorios Australes Franceses', 1, 1),
(211, 'TGO', 'Togo', 1, 1),
(212, 'THA', 'Tailandia', 1, 1),
(213, 'TZA', 'Tanzania', 1, 1),
(214, 'TJK', 'Tayikistán', 1, 1),
(215, 'TKL', 'Tokelau', 1, 1),
(216, 'TLS', 'Timor-Leste', 1, 1),
(217, 'TKM', 'Turkmenistán', 1, 1),
(218, 'TUN', 'Túnez', 1, 1),
(219, 'TON', 'Tonga', 1, 1),
(220, 'TUR', 'Turquía', 1, 1),
(221, 'TTO', 'Trinidad y Tobago', 1, 1),
(222, 'TUV', 'Tuvalu', 1, 1),
(223, 'TWN', 'Taiwán', 1, 1),
(224, 'UKR', 'Ucrania', 1, 1),
(225, 'UGA', 'Uganda', 1, 1),
(226, 'USA', 'Estados Unidos de América', 1, 1),
(227, 'URY', 'Uruguay', 1, 1),
(228, 'UZB', 'Uzbekistán', 1, 1),
(229, 'VAT', 'Ciudad del Vaticano', 1, 1),
(230, 'VCT', 'San Vicente y las Granadinas', 1, 1),
(231, 'VEN', 'Venezuela', 1, 1),
(232, 'VGB', 'Islas Vírgenes Británicas', 1, 1),
(233, 'VIR', 'Islas Vírgenes de los Estados Unidos de América', 1, 1),
(234, 'VNM', 'Vietnam', 1, 1),
(235, 'VUT', 'Vanuatu', 1, 1),
(236, 'WLF', 'Wallis y Futuna', 1, 1),
(237, 'WSM', 'Samoa', 1, 1),
(238, 'YEM', 'Yemen', 1, 1),
(239, 'MYT', 'Mayotte', 1, 1),
(240, 'ZAF', 'Sudáfrica', 1, 1),
(241, 'PER', 'Perú', 1, 1),
(242, 'S/P', 'SIN PAIS', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL COMMENT 'ID UNICO',
  `cod_pedido` varchar(10) NOT NULL COMMENT 'CODIGO PEDIDO',
  `fecha_pedido` date NOT NULL COMMENT 'FECHA PEDIDO',
  `clte_pedido` int(11) NOT NULL COMMENT 'CLIENTE PEDIDO',
  `vend_pedido` int(11) NOT NULL COMMENT 'VENDEDOR PEDIDO',
  `moneda_pedido` int(11) NOT NULL COMMENT 'MONEDA PEDIDO',
  `almacen_pedido` int(11) NOT NULL COMMENT 'ALMACEN PEDIDO',
  `usuario_pedido` int(11) NOT NULL COMMENT 'USUARIO PEDIDO',
  `estatus_pedido` int(11) NOT NULL DEFAULT '0' COMMENT 'ESTATUS PEDIDO',
  `sucursal_pedido` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL PEDIDO',
  `condp_pedido` int(11) NOT NULL DEFAULT '0' COMMENT 'CONDICION PAGO PEDIDO',
  `tipo_pedido` varchar(2) NOT NULL COMMENT 'TIPO DE PEDIDO NP = PEDIDO, PR = PROFORMA, CT = COTIZACION  ',
  `edicion_pedido` varchar(1) DEFAULT 'N' COMMENT 'EDICION PEDIDO',
  `nrodoc_pedido` varchar(25) DEFAULT NULL COMMENT 'NRO DOCUMENTO PEDIDO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA PEDIDOS';

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `cod_pedido`, `fecha_pedido`, `clte_pedido`, `vend_pedido`, `moneda_pedido`, `almacen_pedido`, `usuario_pedido`, `estatus_pedido`, `sucursal_pedido`, `condp_pedido`, `tipo_pedido`, `edicion_pedido`, `nrodoc_pedido`) VALUES
(8, '0000000001', '2019-08-23', 420, 4, 1, 1, 2, 0, 1, 1, 'NP', 'N', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

CREATE TABLE `pedido_detalle` (
  `id_pdetalle` int(11) NOT NULL COMMENT 'ID UNICO',
  `prod_pdetalle` int(11) NOT NULL COMMENT 'PRODUCTO PEDIDO DETALLE',
  `cant_pdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'CANTIDAD PEDIDO DETALLE',
  `precio_pdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'PRECIO PEDIDO DETALLE',
  `descu_pdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'DESCUENTO % PEDIDO DETALLE',
  `impuesto_pdetalle` decimal(18,0) NOT NULL DEFAULT '0' COMMENT 'IMPUESTO PEDIDO DETALLE',
  `status_pdetalle` int(11) NOT NULL DEFAULT '1' COMMENT 'ESTATUS PEDIDO DETALLE',
  `pedido_pdetalle` int(11) NOT NULL DEFAULT '0',
  `plista_pdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'PRECIO LISTA PEDIDO DETALLE',
  `total_pdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'TOTAL PEDIDO DETALLE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DETALLE DE PEDIDOS';

--
-- Volcado de datos para la tabla `pedido_detalle`
--

INSERT INTO `pedido_detalle` (`id_pdetalle`, `prod_pdetalle`, `cant_pdetalle`, `precio_pdetalle`, `descu_pdetalle`, `impuesto_pdetalle`, `status_pdetalle`, `pedido_pdetalle`, `plista_pdetalle`, `total_pdetalle`) VALUES
(13, 43, '5.00', '28.13', '3.00', '18', 1, 8, '29.00', '140.65');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_prod` int(11) NOT NULL COMMENT 'ID UNICO',
  `cod_prod` varchar(25) NOT NULL COMMENT 'CODIGO PRODUCTO',
  `codfab_prod` varchar(45) DEFAULT NULL,
  `des_prod` varchar(70) NOT NULL COMMENT 'DESCRIPCION PRODUCTO',
  `tipo_prod` int(11) NOT NULL COMMENT 'TIPO PRODUCTO',
  `umed_prod` int(11) NOT NULL COMMENT 'UNIDAD DE MEDIDA PRODUCTO',
  `contenido_prod` int(11) NOT NULL COMMENT 'CONTENIDO PRODUCTO',
  `exctoigv_prod` int(11) NOT NULL COMMENT 'EXCENTO IGV (IVA) PRODUCTO',
  `compra_prod` int(11) NOT NULL DEFAULT '0' COMMENT 'PRODUCTO PARA COMPRA',
  `venta_prod` int(11) NOT NULL DEFAULT '0' COMMENT 'PRODUCTO PARA VENTA',
  `stockini_prod` int(11) NOT NULL DEFAULT '0' COMMENT 'STOCK INICIAL PRODUCTO',
  `stockmax_prod` int(11) NOT NULL DEFAULT '0' COMMENT 'STOCK MAXIMO PRODUCTO',
  `stockmin_prod` int(11) NOT NULL DEFAULT '0' COMMENT 'STOCK MINIMO PRODUCTO',
  `stock_prod` int(11) NOT NULL DEFAULT '0' COMMENT 'STOCK PRODUCTO',
  `status_prod` int(11) NOT NULL COMMENT 'ESTATUS PRODUCTO',
  `sucursal_prod` int(11) NOT NULL COMMENT 'SUCURSAL PRODUCTO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS PRODUCTOS';

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_prod`, `cod_prod`, `codfab_prod`, `des_prod`, `tipo_prod`, `umed_prod`, `contenido_prod`, `exctoigv_prod`, `compra_prod`, `venta_prod`, `stockini_prod`, `stockmax_prod`, `stockmin_prod`, `stock_prod`, `status_prod`, `sucursal_prod`) VALUES
(1, 'LP-BC2', 'CM13-BC02', 'FARO NEBLINERO BAIC ANTIGUO (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(2, 'LP-BH2', 'CM-WHG2', 'FARO NEBLINERO BAOJUN HONGGUANG V(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(3, 'LP-F32', 'CM3-BYD2', 'FARO NEBLINERO BYD F3 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(4, 'LP-F62', 'CM6-BYD2', 'FARO NEBLINERO BYD F6 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(5, 'LP-CG2', 'CM12-CHG2', 'FARO NEBLINERO CHANGHAN 2012 (SET X 2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(6, 'LP-CF2', 'CM-CH02', 'FARO NEBLINERO MINIVAN CHANGHE FREEDOM(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(7, 'LP-A12', 'CM-A102', 'FARO NEBLINERO CHERRY A1 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 10, 1, 1),
(8, 'LP-AV2C', 'CM07-AV4', 'FARO NEBLI.CHEV. AVEO 2005-2007(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(9, 'LP-AV2', 'CM-9416', 'FARO NEBLI.CHEV. AVEO 2005-2007(SETX2)NEGRO         ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(10, 'LP-N32', 'CM-N3004  ', 'FARO NEBLI.CHEV. N300 2013(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(11, 'LP-N22L', 'CM-N2004L', 'FARO NEBLI.CHEV. N200 ( HONGTU 2010)', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(12, 'LP-N22R', 'CM-N2004R', 'FARO NEBLI.CHEV. N200 ( HONGTU 2010)', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(13, 'LP-SA2', 'CM10-SAL5', 'FARO NEBLI.CHEV. SAIL 2010 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(14, 'LP-SP2', 'CM5-SPK04', 'FARO NEBLI.CHEV. SPARK 2005 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(15, 'LP-SP2A', 'CM5-SPK8', 'FARO NEBLI.CHEV. SPARK 2005 POST RED', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(16, 'LP-SP2B', 'CM5-SPK5', 'FARO NEBLI.CHEV. SPARK 2005 POST.BLANCO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(17, 'LP-SP4', 'CM9-SPK02', 'FARO NEBLI.CHEV. SPARK 2009 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(18, 'LP-OP2', 'CM-9342', 'FARO NEBLI.CHEV. OPTRA 2003-2008(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(19, 'LP-ES2L', 'CM92-DE4L', 'FARO NEBLI.DAEWOO ESPERO 92....', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(20, 'LP-ES2R', 'CM92-DE4R', 'FARO NEBLI.DAEWOO ESPERO 92....', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(21, 'LP-ES4', 'CM96-DE4A', 'FARO NEBLI.DAEWOO ESPERO 96(SET)  ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(22, 'LP-CI2', 'CM94-DC4A', 'FARO NEBLI.DAEWOO CIELO NEGRO 94-96 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(23, 'LP-CI2CL', 'CM94-DC4L', 'FARO NEBLI.DAEWOO CIELO CRISTAL 94-96', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(24, 'LP-CI2CR', 'CM94-DC4R', 'FARO NEBLI.DAEWOO CIELO CRISTAL 94-96', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(25, 'LP-LA2', 'CM-LN04', 'FARO NEBLI.DAEWOO LANOS (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(26, 'LP-LA2C', 'CM-LN04C', 'FARO NEBLI.DAEWOO LANOS CRYSTAL(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(27, 'LP-NB2', 'CM97-DN04', 'FARO NEBLI.DAEWOO NUBIRA 1997 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(28, 'LP-NB4', 'CM00-DN2', 'FARO NEBLI.DAEWOO NUBIRA 2000 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(29, 'LP-XI2', 'CM15-DX02', 'FARO NEBLI.DONGFENG XIAOKANG(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(30, 'LP-C372', 'CM37-DF02', 'FARO NEBLI.DONGFEND C37 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(31, 'LP-RA4', 'CM-9296', 'FARO NEBLI.FORD RANGER 2012...(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(32, 'LP-FL4', 'CM16-FLD2', 'FARO NEBLI.FORLAND 2016(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(33, 'LP-FT2L', 'CM06-FT02L', 'FARO NEBLI.FOTON 2007.....', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(34, 'LP-FT2R', 'CM06-FT02R', 'FARO NEBLI.FOTON 2007.....', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(35, 'LP-CK2', 'CM12-GY02', 'FARO NEBLI.GEELLY CK1 2012(SET2)    ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(36, 'LP-GY2', 'CM07-GY2', 'FARO NEBLI.GEELY 2012 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(37, 'LP-MK4', 'CM14-GY02', 'FARO NEBLI.GEELLY MK CROSS 2014(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(38, 'LP-GO4', 'CM14-GW02', 'FARO NEBLI.GONOW 2014(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(39, 'LP-FJ2', 'CM5-WIN2', 'FARO NEBLI.GREATWALL FENG JUN 5(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(40, 'LP-GH2', 'CM5-GH02', 'FARO NEBLI.GREATWALL HOVER(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(41, 'LP-ST4', 'CM05-SX2', 'FARO NEBLI.PARACH. HY.STAREX 2005(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(42, 'LP-AC2', 'CM98-AC4A', 'FARO NEBLI.PARACH. HY ACCENT AMBAR 1998-1999 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 10, 1, 1),
(43, 'LP-AC2B', 'CM98-AC4', 'FARO NEBLI.PARACH. HY ACCENT BLANCO 1998-1999 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(44, 'LP-AC4', 'CM-9172', 'FARO NEBLI.PARACH. HY ACCENT 2006...(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(45, 'LP-AC4B', 'CM10-AC04', 'FARO NEBLI.PARACH. HY ACCENT 2011-2014(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(46, 'LP-EL2', 'CM-9071', 'FARO NEBLI.PARACH. HY ELANTRA 2007(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(47, 'LP-EL2C', 'CM07-EL02', 'FARO NEBLI.PARACH. HY ELANTRA 2007(SETX2)CHINO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(48, 'LP-EL4', 'CM11-EL5  ', 'FARO NEBLI.PARACH. HY ELANTRA 2011(SETX2)CHINO ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(49, 'LP-EL4B', 'CM13-EL4', 'FARO NEBLI.PARACH. HY ELANTRA 2013-2014 (SETX2)CHINO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(50, 'LP-I104L', 'CM12-I104L', 'FARO NEBLI.PARACH. HY I10 2012 CHINO', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(51, 'LP-I104R', 'CM12-I104R', 'FARO NEBLI.PARACH. HY I10 2012 CHINO', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(52, 'LP-I104A', 'CM14-I102', 'FARO NEBLI.PARACH. HY I10 2014 (SET2)CHINO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(53, 'LP-I104B', 'CM14-I102A', 'FARO NEBLI.PARACH. HY I10 2014FULL (SET2)CHINO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(54, 'LP-H12', 'CMH1-002', 'FARO NEBLI.PARACH. HY H1(SET2)    ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(55, 'LP-HD2', 'CM65-HD04', 'FARO NEBLI.PARACH. HY.HD 65 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(56, 'LP-HD4', 'CM75-HD05', 'FARO NEBLI.PARACH. HY.HD 75 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(57, 'LP-H1004', 'CM96-HP4', 'FARO NEBLI.PARACH. H100 PANEL VAN GRACE (SET2) 96', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(58, 'LP-PO4', 'CM13-PRT2', 'FARO NEBLI.PARACH. HY PORTER II 2013(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(59, 'LP-SF2', 'CM09-SF2', 'FARO NEBLI.PARACH. HY SANTA FE 2009 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(60, 'LP-MA2', 'CM07-MX2', 'FARO NEBLI.PARACH. HY MATRIX 2005(SET X 2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(61, 'LP-SO2L', 'CM03-SON4L', 'FARO NEBLI.PARACH.HY SONATA 2003', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(62, 'LP-SO2R', 'CM03-SON4R', 'FARO NEBLI.PARACH.HY SONATA 2003', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(63, 'LP-SO4', 'CM08-SON2', 'FARO NEBLI.PARACH.HY SONATA 2008(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(64, 'LP-TU2', 'CM03-TS2', 'FARO NEBLI.PARACH.HY TUCSON 2003 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(65, 'LP-EO4', 'CM11-EON4', 'FARO NEBLI.PARACH.HY EON 2011-2013 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(66, 'LP-JR2', 'CM-JRF02', 'FARO NEBLI.JAC REFINE(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(67, 'LP-JS4', 'CM13-JS02', 'FARO NEBLI.JAC STAR SEDAN 2013 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(68, 'LP-JM2', 'CM02-JB06', 'FARO NEBLI.JINBEI 2002 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(69, 'LP-K27004', 'CM12-BN02', 'FARO NEBLI.KIA K2700 2012-2013(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(71, 'LP-CE4', 'CM13-KC2', 'FARO NEBLI.KIA CERATO  2013 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(72, 'LP-CE4B', 'CM17-CR2', 'FARO NEBLI.KIA CERATO 2018(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(73, 'LP-PI2C', 'CM08-PI02', 'FARO NEBLI.KIA PICANTO 2008(SET2)CHINO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(74, 'LP-PI2', 'CM-9226', 'FARO NEBLI.KIA PICANTO 2008...(SET2)        ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(75, 'LP-PI4', 'CM12-PI02', 'FARO NEBLI.KIA PICANTO 2011-2013(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(76, 'LP-PI4C', 'CM14-PI02', 'FARO NEBLI.KIA PICANTO 2014 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(77, 'LP-PI4D', 'CM16-PI2A', 'FARO NEBLI.KIA PICANTO 2016  (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(78, 'LP-PI4B', 'CM16-PI02', 'FARO NEBLI.KIA PICANTO 2016 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(79, 'LP-RI2', 'CM10-KR02', 'FARO NEBLI.KIA RIO 2010 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(80, 'LP-RI4', 'CM11-KR02', 'FARO NEBLI.KIA RIO SEDAN 2011(SET2) ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(81, 'LP-RI4D', 'CM16-KR4A', 'FARO NEBLI.KIA RIO 2016(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(82, 'LP-SG2', 'CM05-SP2', 'FARO NEBLI.KIA SPORTAGE 2005 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(83, 'LP-SG4', 'CM11-SP02', 'FARO NEBLI.KIA SPORTAGE 2011 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(84, 'LP-SG4A', 'CM11-SP2N', 'FARO NEBLI.KIA SPORTAGE 2011 (SETX2)(NEGRO)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(85, 'LP-LI2', 'CM-LF02', 'FARO NEBLI.LIFAN 520 SET X2', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(86, 'LP-LI4', 'CM-LF02B', 'FARO NEBLI.LIFAN 620 SET X 2', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(87, 'LP-MZ4', 'CM-9403', 'FARO NEBLI.PARACH MAZDA CX5 2013-2016(SET2)NEGRO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(88, 'LP-MZ2', 'CM-9101', 'FARO NEBLI.PARACH MAZDA 3 2008(SET2)NEGRO              ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(89, 'LP-BT2', 'CM-9289', 'FARO NEBLI.PARACH.MAZDA BT-50 2008(SET2)NEGRO      ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(90, 'LP-BT4', 'CM-9295', 'FARO NEBLI.PARACH.MAZDA BT-50 2015 (SET2)CROMO       ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(91, 'LP-AM2', 'CM-9483', 'FARO NEBLI.AMAROK-JETTA III-GOLF V 2001-2016(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(92, 'LP-FU2', 'CM86-MF4', 'FARO NEBLI.PARACH.MITSUB.FUSO 1986(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(93, 'LP-RO2', 'CM-MR04', 'FARO NEBLI.PARACH MITSUB.ROSA(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(94, 'LP-TR2', 'CM-9236', 'FARO NEBLI.PARACH.MITSUB.TRITON L200 2008...(SET2)CROMADO     ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(95, 'LP-TR2S', 'CM-9242', 'FARO NEBLI.PARACH.MITSUB.TRITON L200 2008 S/TAPA..(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(96, 'LP-TR4', 'CM-9417', 'FARO NEBLI.PARACH.MITSUB.TRITON L200 2016...(SET2)CROMO     ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(97, 'LP-AD2', 'CM00-AD4L', 'FARO NEBLI.NISSAN AD WAGON WINGROAD 1998-2005', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(98, 'LP-FR2', 'CM-9097', 'FARO NEBLI.NISS FRONTIER 01-04(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(99, 'LP-NA2', 'CM-9150', 'FARO NEBLI.NISS.NAVARA 2005/X-TERRA 05-09(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(100, 'LP-NA4', 'CM-9406', 'FARO NEBLI.NISS.NAVARA 2009(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(101, 'LP-NA4B', 'CM-9449', 'FARO NEBLI.NISS.NAVARA 2010-2015(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(102, 'LP-UR4', 'CM25-UC5', 'FARO NEBLI.NISS.CARAVAN E25 2005(SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(103, 'LP-UR4AL', 'CM26-UC5L', 'FARO NEBLI.NISS.URVAN NV350/AMARO/RAV4/SUZUKI GRAND NOMA', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(104, 'LP-UR4AR', 'CM26-UC5R', 'FARO NEBLI.NISS.URVAN NV350/AMARO/RAV4/SUZUKI GRAND NOMA', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(105, 'LP-UR4CL', 'CM26-UC5AL', 'FARO NEBLI.NISS.URVAN NV350 C/LED AZUL 2013', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(106, 'LP-UR4CR', 'CM26-UC5AR', 'FARO NEBLI.NISS.URVAN NV350 C/LED AZUL 2013', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(107, 'LP-AL2', 'CM-9141', 'FARO NEBLI.NISS.ALMERA 2000-2007(SET2)NEGRO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(108, 'LP-AL2Q', 'CM-9281', 'FARO NEBLI.NISS.ALMERA 2007-QASHQAI(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(109, 'LP-VE4C', 'CM-9304', 'FARO NEBLI.NISS.VERSA 2011-2013(SET2)CROMAD', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(110, 'LP-VE4', 'CM-9290', 'FARO NEBLI.NISS.VERSA 2011-2013(SET2)NEGRO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(111, 'LP-VE4K', 'CM-9454', 'FARO NEBLI.NISS.VERSA 2014...(SET2)CROMO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(112, 'LP-TI2', 'CM-9381', 'FARO NEBLI.NISS NOTE/MURANO 07-TIIDA/X-TRAIL 2007(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(113, 'LP-TI4', 'CM-9565', 'FARO NEBLI.NISS.TIIDA 2008-2012...(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(114, 'LP-JU4', 'CM-9456', 'FARO NEBLI.NISS.JUKE 2015(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(115, 'LP-MH2', 'CM-9255', 'FARO NEBLI.NISS.MARCH 2010 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(116, 'LP-NE2', 'CM-9374', 'FARO NEBLI.NISS.NEO 2004 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(117, 'LP-SW2', 'CM4-SW02', 'FARO NEBLI.SUZ.SWIFT SX4 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(118, 'LP-SW4', 'CM-9197', 'FARO NEBLI.SUZ.SWIFT05-10/SX4 06-13/ALTO 09/CELERIO14/(SET2)UNIVERSAL', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(120, 'LP-SW4N', 'CM-9310', 'FARO NEBLI.SUZ.SWIFT 2012....(SET2)NEGRO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(122, 'LP-AE2', 'CM03-AE02     ', 'FARO NEBLI.SUZ.AERIO 2003 (SET2)               ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(123, 'LP-AZ4', 'CM-9262', 'FARO NEBLI.TY AVANZA 2012...(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(124, 'LP-DI2L', 'CM99-DN4L', 'FARO NEBLI.TY DINA 1999-2008', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(125, 'LP-DI2T', 'CM99-DN4R', 'FARO NEBLI.TY DINA 1999-2008', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(126, 'LP-CA2', 'CM98-CA4', 'FARO NEBLI.TY CALDINA AVENSIS(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(127, 'LP-YS2', 'CM-9225', 'FARO NEBLI.TY YARIS SEDAN 2007...NEGRO (SET2) ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(128, 'LP-YS2C', 'CM-9235', 'FARO NEBLI.TY YARIS SEDAN 2007...CROMO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(129, 'LP-YS4', 'CM-9333', 'FARO NEBLI.TY YARIS SEDAN 2013-2016 NEGRO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(130, 'LP-YS4C', 'CM-9336', 'FARO NEBLI.TY YARIS SEDAN 2013-2016 CROMO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(131, 'LP-YH2', 'CM-9241', 'FARO NEBLI.TY YARIS HASHBACH 2009...NEGRO(SET2) ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(132, 'LP-YH4', 'CM-9352', 'FARO NEBLI.TY.YARIS HASHBACK 2014-2017 CROMO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(133, 'LP-YP2', 'CM-9107', 'FARO NEBLI.TY.YARIS PLAST(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(134, 'LP-AT2D', 'CM-9128', 'FARO NEBLI.TY.ALTIS 2001-2006 DOBLE PUNTA(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(135, 'LP-AT2', 'CM-9282', 'FARO NEBLI.TY.ALTIS 2001-2006 UNA PUNTA(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(136, 'LP-AT2C', 'CM01-TA5L', 'FARO NEBLI.TY ALTIS 2001-2006 UNA PUNTA(CHINO)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(137, 'LP-AT2B', 'CM01-TA5C', 'FARO NEBLI.TY ALTIS 2001-2006 UNA PUNTA CRYSTAL CHINO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(138, 'LP-AT4C', 'CM-9228', 'FARO NEBLI.TY.ALTIS 2011-2013 CROMADO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(139, 'LP-AS2', 'CM-9174', 'FARO NEBLI.TY COROLLA 2001-ASISTA..(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(140, 'LP-CO2', 'CM01-TC4L', 'FARO NEBLI.TY COROLLA 2001..', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(141, 'LP-CO4', 'CM-9170', 'FARO NEBLI.TY.COROLLA 2008-2011 CROMO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(142, 'LP-CO4N', 'CM-9277', 'FARO NEBLI.TY.COROLLA 2011-2013 NEGRO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(143, 'LP-CO4D', 'CM-9366', ' FARO NEBLI.TY.COROLLA 2014-2016 C/NEGRO(SET2) ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(144, 'LP-FS2', 'CM-9024', 'FARO NEBLI.TY.FIELDER SEDAN 2004 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(145, 'LP-FS2C', 'CM04-TF4', 'FARO NEBLI.TY.FIELDER 2004 (212-2031-UEH)(SET2)CHINO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(146, 'LP-HX2', 'CM-9129', 'FARO NEBLI.TY HILUX VIGO 04-07(SET 2 )    ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(147, 'LP-HX2D', 'CM-9222', 'FARO NEBLI.TY HILUX VIGO 2008-2010 (SETX2)      ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(148, 'LP-HX4C', 'CM15-HX4', 'FARO NEBLI.TY REVO 2015-AVANZA 2016-YARIS 2014(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(149, 'LP-HX4', 'CM-9430', 'FARO NEBLI.TY.REVO 2015 NEGRO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(150, 'LP-HX4B', 'CM-9430C', 'FARO NEBLI.TY.REVO 2015 CROMO (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(151, 'LP-TH2L', 'CM97-TH6L', 'FARO NEBLI.TY HIACE WAGON-OJO CHINO 1996 (212-2014)', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(152, 'LP-TH2R', 'CM97-TH6R', 'FARO NEBLI.TY HIACE WAGON-OJO CHINO 1996 (212-2014)', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(153, 'LP-TH2AL', 'CM04-TH9L', 'FARO NEBLI.TY HIACE 2004-2010', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(154, 'LP-TH2AR', 'CM04-TH9R', 'FARO NEBLI.TY HIACE 2004-2010', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(155, 'LP-TH4AL', 'CM11-TH7L ', 'FARO NEBLI.TY HIACE 2011-2013 NEGRO CHINO        ', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(156, 'LP-TH4AR', 'CM11-TH7R ', 'FARO NEBLI.TY HIACE 2011-2013 NEGRO CHINO        ', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(157, 'LP-TH4C', 'CM11-TH7-1', 'FARO NEBLI.TY HIACE 2011-2013 NEGRO 9 FOCOS LED CHINO (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(158, 'LP-TH4B', 'CM-9315', 'FARO NEBLI.TY.HIACE 2011-2013 CROMO (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(159, 'LP-TH4E', 'CM11-TH7C', 'FARO NEBLI.TY HIACE 2011-2013 CROMO (SET2)CHINO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(160, 'LP-TH4D', 'CM11-TH7-2', 'FARO NEBLI.TY HIACE 2011-2013 CROMO 9FOCOS (SET2)CHINO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(161, 'LP-TH6', 'CM-9415', 'FARO NEBLI.TY HIACE 2014-2015 NEGRO(SET2)    ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(162, 'LP-TH6A', 'CM14-TH4', 'FARO NEBLI.TY HIACE 2014-2015 NEGRO(SET2)CHINO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(163, 'LP-TH6C', 'CM-9415C', 'FARO NEBLI.TY HIACE 2014-2015 CROMO(SET2)   ', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(164, 'LP-NH2', 'CM96-TN4', 'FARO NEBLI.TY NOAH (SETX2)VIDRIO', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(165, 'LP-SU2M', 'CM05-SC6M', 'FARO NEBLI.TY SUCCED MICA (SET X 2)C/BASE', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(166, 'LP-SU2VL', 'CM05-SC6L', 'FARO NEBLI.TY SUCCED(VIDRIO)', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(167, 'LP-SU2VR', 'CM05-SC6R', 'FARO NEBLI.TY SUCCED(VIDRIO)', 1, 2, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(168, 'LP-RV2C', 'CM-9431', 'FARO NEBLI.TY RAV4 2008-2012 CROMO(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(169, 'LP-RV4', 'CM-9488', 'FARO NEBLI.TY RAV4 2013-2015 (SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(170, 'LP-RV6', 'CM-9455', 'FARO NEBLI.TY RAV4 2016-2017 NEGRO...(SET2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(171, 'LP-WR2', 'CM-WRG2', 'FARO NEBLI.WULING RONGGUANS  (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1),
(172, 'LP-ZT2', 'CM08-ZT2', 'FARO NEBLI.ZOTYE 2008 (SETX2)', 1, 1, 1, 0, 1, 1, 0, 0, 0, 15, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL COMMENT 'ID UNICO',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'ID USER',
  `nombre` varchar(50) NOT NULL DEFAULT '' COMMENT 'NOMBRE USUARIO',
  `apellido` varchar(50) NOT NULL DEFAULT '' COMMENT 'APELLIDO USUARIO',
  `empresa` int(11) NOT NULL DEFAULT '0' COMMENT 'EMPRESA USUARIO',
  `sucursal` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL USUARIO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA PERFILES DE USUARIOS';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_prove` int(11) NOT NULL COMMENT 'ID UNICO',
  `dni_prove` varchar(20) NOT NULL COMMENT 'DNI PROVEEDOR',
  `ruc_prove` varchar(20) NOT NULL COMMENT 'RUC PROVEEDOR',
  `nombre_prove` varchar(150) NOT NULL COMMENT 'NOMBRE PROVEEDOR',
  `direcc_prove` text NOT NULL COMMENT 'DIRECCION PROVEEDOR',
  `pais_prove` int(11) NOT NULL COMMENT 'PAIS PROVEEDOR',
  `depto_prove` int(11) NOT NULL COMMENT 'DEPARTAMENTO PROVEEDOR',
  `provi_prove` int(11) NOT NULL COMMENT 'PROVINCIA PROVEEDOR',
  `dtto_prove` int(11) NOT NULL COMMENT 'DISTRITO PROVEEDOR',
  `tlf_prove` varchar(100) NOT NULL COMMENT 'TELEFONO PROVEEDOR',
  `tipo_prove` int(11) NOT NULL COMMENT 'TIPO PROVEEDOR',
  `status_prove` int(11) NOT NULL COMMENT 'ESTATUS PROVEEDOR',
  `sucursal_prove` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE PROVEEDORES';

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_prove`, `dni_prove`, `ruc_prove`, `nombre_prove`, `direcc_prove`, `pais_prove`, `depto_prove`, `provi_prove`, `dtto_prove`, `tlf_prove`, `tipo_prove`, `status_prove`, `sucursal_prove`) VALUES
(1, '', '', 'pedro perez', 'asdasd', 231, 215, 28, 215, '', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id_prov` int(11) NOT NULL COMMENT 'ID UNICO',
  `des_prov` varchar(30) NOT NULL COMMENT 'DESCRIPCION PROVINCIA',
  `status_prov` int(11) NOT NULL COMMENT 'ESTATUS PROVINCIA',
  `sucursal_prov` int(11) NOT NULL COMMENT 'SUCURSAL PROVINCIA',
  `pais_prov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE PROVINCIA';

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_prov`, `des_prov`, `status_prov`, `sucursal_prov`, `pais_prov`) VALUES
(1, 'AMAZONAS', 1, 1, 241),
(2, 'ANCASH', 1, 1, 241),
(3, 'APURIMAC', 1, 1, 241),
(4, 'AREQUIPA', 1, 1, 241),
(5, 'AYACUCHO', 1, 1, 241),
(6, 'CAJAMARCA', 1, 1, 241),
(7, 'CALLAO', 1, 1, 241),
(8, 'CUSCO', 1, 1, 241),
(9, 'HUANCAVELICA', 1, 1, 241),
(10, 'HUÁNUCO', 1, 1, 241),
(11, 'ICA', 1, 1, 241),
(12, 'JUNÍN', 1, 1, 241),
(13, 'LA LIBERTAD', 1, 1, 241),
(14, 'LAMBAYEQUE', 1, 1, 241),
(15, 'LIMA', 1, 1, 241),
(16, 'LORETO', 1, 1, 241),
(17, 'MADRE DE DIOS', 1, 1, 241),
(18, 'MOQUEGUA', 1, 1, 241),
(19, 'PASCO', 1, 1, 241),
(20, 'PIURA', 1, 1, 241),
(21, 'PUNO', 1, 1, 241),
(22, 'SAN MARTÍN', 1, 1, 241),
(23, 'TACNA', 1, 1, 241),
(24, 'TUMBES', 1, 1, 241),
(25, 'UCAYALI', 1, 1, 241),
(28, 'Carabobo', 1, 1, 231),
(29, 'SIN PROVINCIA', 1, 1, 241);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `id_serie` int(11) NOT NULL COMMENT 'ID SERIE',
  `des_serie` varchar(3) DEFAULT '000' COMMENT 'DESCRIPCION SERIE',
  `status_serie` int(11) NOT NULL DEFAULT '0' COMMENT 'ESTATUS SERIE',
  `sucursal_serie` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL SERIE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ALMACENA DATOS DE SERIES DE DOCUMENTOS';

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`id_serie`, `des_serie`, `status_serie`, `sucursal_serie`) VALUES
(1, '001', 1, 1),
(2, '002', 1, 1),
(3, '003', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id_suc` int(11) NOT NULL COMMENT 'ID UNICO',
  `nombre_suc` varchar(50) NOT NULL COMMENT 'NOMBRE SUCURSAL',
  `estatus_suc` int(11) NOT NULL COMMENT 'ESTATUS SUCURSAL',
  `empresa_suc` int(11) NOT NULL COMMENT 'EMPRESA  DE LA SUCURSAL',
  `impuesto_suc` decimal(7,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE SUCURSALES';

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id_suc`, `nombre_suc`, `estatus_suc`, `empresa_suc`, `impuesto_suc`) VALUES
(1, 'PRINCIPAL', 1, 1, '18.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipod` int(11) NOT NULL COMMENT 'ID UNICO',
  `des_tipod` varchar(100) DEFAULT NULL COMMENT 'DESCRIPCION TIPO DOCUMENTO',
  `abrv_tipod` varchar(3) NOT NULL COMMENT 'ABREVIACION TIPO DOCUMENTO',
  `ope_tipod` varchar(1) DEFAULT 'N' COMMENT 'E = ENTRADA, S = SALIDA, N'' = NINGUNO OPERACION TIPO DOCUMENTO',
  `sucursal_tipod` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL TIPO DOCUMENTO',
  `status_tipod` int(11) NOT NULL DEFAULT '0' COMMENT 'ESTATUS TIPO DOCUMENTO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ALMACENA TIPOS DE DOCUMENTOS';

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipod`, `des_tipod`, `abrv_tipod`, `ope_tipod`, `sucursal_tipod`, `status_tipod`) VALUES
(1, 'PEDIDO', 'NP', 'N', 1, 1),
(2, 'FACTURA', 'FE', 'S', 1, 1),
(3, 'GUIA DE REMISION', 'GR', 'N', 1, 1),
(4, 'NOTA DE INGRESO', 'NI', 'E', 1, 1),
(5, 'NOTA DE SALIDA', 'NS', 'S', 1, 1),
(6, 'ORDEN DE COMPRA', 'OC', 'N', 1, 1),
(7, 'PROFORMA', 'PR', 'S', 1, 1),
(8, 'COTIZACION', 'CT', 'N', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_listap`
--

CREATE TABLE `tipo_listap` (
  `id_lista` int(11) NOT NULL COMMENT 'ID UNICO',
  `desc_lista` varchar(30) NOT NULL DEFAULT '' COMMENT 'DESCRIPCION TIPO LISTA',
  `estatus_lista` int(11) NOT NULL COMMENT 'ESTATUS TIPO LISTA',
  `sucursal_lista` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL TIPO LISTA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA TIPOS DE LISTA DE PRECIOS';

--
-- Volcado de datos para la tabla `tipo_listap`
--

INSERT INTO `tipo_listap` (`id_lista`, `desc_lista`, `estatus_lista`, `sucursal_lista`) VALUES
(1, 'PRINCIPAL', 1, 1),
(2, 'SECUNDARIA', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE `tipo_movimiento` (
  `id_tipom` int(11) NOT NULL COMMENT 'ID UNICO',
  `des_tipom` varchar(60) NOT NULL COMMENT 'DESCRIPCION TIPO MOVIMIENTO',
  `status_tipom` int(11) NOT NULL DEFAULT '0' COMMENT 'ESTATUS TIPO MOVIMIENTO',
  `sucursal_tipom` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL TIPO MOVIMIENTO',
  `tipo_tipom` varchar(1) DEFAULT NULL COMMENT 'TIPO E = ENTRADA, S = SALIDA '
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE TIPOS DE MOVIMIENTOS DE ALMACEN';

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id_tipom`, `des_tipom`, `status_tipom`, `sucursal_tipom`, `tipo_tipom`) VALUES
(1, 'INGRESO', 1, 1, 'E'),
(2, 'SALIDA', 1, 1, 'S'),
(3, 'COMPRA', 1, 1, 'E'),
(4, 'VENTA', 1, 1, 'S'),
(5, 'AJUSTE DE ENTRADA', 1, 1, 'E'),
(6, 'AJUSTE DE SALIDA', 1, 1, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tpdcto` int(11) NOT NULL COMMENT 'ID UNICO',
  `desc_tpdcto` varchar(255) NOT NULL COMMENT 'DESCRIP TIPO PRODUCTO',
  `status_tpdcto` int(11) NOT NULL COMMENT 'ESTATUS TIPO PRODUCTO',
  `sucursal_tpdcto` int(11) NOT NULL COMMENT 'SUCURSAL TIPO PRODUCTO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE TIPO PRODUCTOS';

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tpdcto`, `desc_tpdcto`, `status_tpdcto`, `sucursal_tpdcto`) VALUES
(1, 'FARO NEBLINERO', 1, 1),
(2, 'MANIJAS', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_proveedor`
--

CREATE TABLE `tipo_proveedor` (
  `id_tprov` int(11) NOT NULL,
  `des_tprov` varchar(45) DEFAULT NULL,
  `status_tprov` int(11) NOT NULL,
  `sucursal_tprov` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA TIPO PROVEEDOR';

--
-- Volcado de datos para la tabla `tipo_proveedor`
--

INSERT INTO `tipo_proveedor` (`id_tprov`, `des_tprov`, `status_tprov`, `sucursal_tprov`) VALUES
(1, 'Importador', 1, 1),
(2, 'Compra', 1, 1),
(3, 'Servicios', 1, 1),
(5, 'Honorarios profesionales', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `id_trans` int(11) NOT NULL COMMENT 'ID UNICO',
  `codigo_trans` varchar(10) NOT NULL COMMENT 'CODIGO TRANSACCION',
  `fecha_trans` date DEFAULT NULL COMMENT 'FECHA TRANSACCION',
  `obsv_trans` text COMMENT 'OBSERVACIONES TRANSACCION',
  `tipo_trans` int(11) NOT NULL DEFAULT '0' COMMENT 'TIPO TRANSACCION',
  `ope_trans` varchar(1) NOT NULL,
  `docref_trans` varchar(10) DEFAULT NULL COMMENT 'DOCUMENTO REFERENCIA TRANSACCION',
  `almacen_trans` int(11) NOT NULL COMMENT 'ALMACEN TRANSACCION',
  `sucursal_trans` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL TRANSACCION',
  `usuario_trans` int(11) NOT NULL DEFAULT '0' COMMENT 'USUARIO TRANSACCION',
  `status_trans` int(11) NOT NULL DEFAULT '0' COMMENT 'ESTATUS TRANSACCION 0=NO APROBADA, 1 = APROBADA, 2 = ANULADA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE LOS TRANSACCIONES';

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`id_trans`, `codigo_trans`, `fecha_trans`, `obsv_trans`, `tipo_trans`, `ope_trans`, `docref_trans`, `almacen_trans`, `sucursal_trans`, `usuario_trans`, `status_trans`) VALUES
(1, '0000000001', '2019-08-15', '', 5, 'E', '111111', 1, 1, 2, 1),
(3, '0000000001', '2019-08-15', '', 6, 'S', '111111', 1, 1, 2, 1),
(5, '0000000002', '2019-08-15', '', 5, 'E', '222222', 1, 1, 2, 0),
(6, '0000000002', '2019-08-15', '', 6, 'S', '222222', 1, 1, 2, 2),
(7, '0000000003', '2019-08-15', '', 6, 'S', '3333', 1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trans_detalle`
--

CREATE TABLE `trans_detalle` (
  `id_detalle` int(11) NOT NULL COMMENT 'ID UNICO',
  `trans_detalle` int(11) NOT NULL DEFAULT '0' COMMENT 'TRANSACCION DETALLE',
  `prod_detalle` int(11) NOT NULL DEFAULT '0' COMMENT 'PRODUCTO DETALLE',
  `cant_detalle` int(11) NOT NULL DEFAULT '0' COMMENT 'CANTIDAD DETALLE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DETALLE DE TRANSACCIONES';

--
-- Volcado de datos para la tabla `trans_detalle`
--

INSERT INTO `trans_detalle` (`id_detalle`, `trans_detalle`, `prod_detalle`, `cant_detalle`) VALUES
(19, 1, 7, 5),
(20, 1, 42, 5),
(23, 3, 7, 5),
(24, 3, 42, 5),
(27, 5, 7, 5),
(28, 5, 42, 5),
(29, 6, 7, 5),
(30, 6, 42, 5),
(31, 7, 42, 5),
(32, 7, 7, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id_und` int(11) NOT NULL COMMENT 'ID UNICO',
  `des_und` varchar(50) NOT NULL COMMENT 'DESCRIPCION UNIDAD MEDIDA',
  `status_und` int(11) NOT NULL COMMENT 'ESTATUS UNIDAD MEDIDA',
  `sucursal_und` int(11) NOT NULL COMMENT 'SUCURSAL UNIDAD MEDIDA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS UNIDAD MEDIDA';

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id_und`, `des_und`, `status_und`, `sucursal_und`) VALUES
(1, 'SET', 1, 1),
(2, 'UNIDAD', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `empresa` int(11) DEFAULT '0',
  `sucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `empresa`, `sucursal`) VALUES
(2, 'admin', 'qQb-eZ47QFy_2Gcngm-mBgtoItkkFQa4', '$2y$13$JAQP/j7i49qCfP8mACKq2uCVBgqVM/Th6k91sj8RAThAvLHoa28BS', NULL, 'admin@local.com', 10, 1563458207, 1563467567, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `id_vendedor` int(11) NOT NULL COMMENT 'ID UNICO',
  `dni_vend` varchar(11) NOT NULL COMMENT 'DNI VENDEDOR',
  `nombre_vend` varchar(50) NOT NULL COMMENT 'NOMBRE VENDEDOR',
  `tlf_vend` varchar(20) NOT NULL COMMENT 'TELEFONO VENDEDOR',
  `estatus_vend` int(11) NOT NULL COMMENT 'ESTATUS VENDEDOR',
  `sucursal_vend` int(11) NOT NULL COMMENT 'SUCURSAL VENDEDOR',
  `zona_vend` int(11) NOT NULL COMMENT 'ZONA VENDEDOR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE VENDEDORES';

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`id_vendedor`, `dni_vend`, `nombre_vend`, `tlf_vend`, `estatus_vend`, `sucursal_vend`, `zona_vend`) VALUES
(1, '', 'OFICINA', '', 1, 1, 1),
(2, '', 'OMAR CAHUI', '', 1, 1, 1),
(3, '', 'MELIN HUAMAN', '', 1, 1, 1),
(4, '', 'IRVIN PEREZ', '', 1, 1, 1),
(5, '', 'APP', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_productos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_productos` (
`id_prod` int(11)
,`cod_prod` varchar(25)
,`des_prod` varchar(70)
,`texto` varchar(149)
,`sucursal_prod` int(11)
,`status_prod` int(11)
,`precio_lista` decimal(18,2)
,`tipo_lista` int(11)
,`id_suc` int(11)
,`impuesto_suc` decimal(7,2)
,`id_und` int(11)
,`des_und` varchar(50)
,`compra_prod` int(11)
,`venta_prod` int(11)
,`stock_prod` decimal(41,2)
,`estatus_pedido` bigint(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `id_zona` int(11) NOT NULL COMMENT 'ID UNICO',
  `nombre_zona` varchar(150) NOT NULL COMMENT 'NOMBRE ZONA',
  `desc_zona` text NOT NULL COMMENT 'DESCRIPCION ZONA',
  `estatus_zona` int(11) NOT NULL COMMENT 'ESTATUS ZONA',
  `sucursal_zona` int(11) NOT NULL COMMENT 'SUCURSAL ZONA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE ZONAS';

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id_zona`, `nombre_zona`, `desc_zona`, `estatus_zona`, `sucursal_zona`) VALUES
(1, 'LIMA', 'LIMA, TODAS LAS ZONAS EXCEPTO LA CINCUENTA', 1, 1),
(2, 'LA CINCUENTA', 'LIMA -  LA CINCUENTA', 1, 1),
(3, 'PROVINCIA - NORTE', 'PROVINCIAS DEL NORTE', 1, 1),
(4, 'PROVINCIA - CENTRO', 'PROVINCIAS DEL CENTRO', 1, 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_productos`
--
DROP TABLE IF EXISTS `v_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_productos`  AS  select `producto`.`id_prod` AS `id_prod`,`producto`.`cod_prod` AS `cod_prod`,`producto`.`des_prod` AS `des_prod`,concat(`producto`.`cod_prod`,' ',`producto`.`des_prod`,' - ',`unidad_medida`.`des_und`) AS `texto`,`producto`.`sucursal_prod` AS `sucursal_prod`,`producto`.`status_prod` AS `status_prod`,`lista_precios`.`precio_lista` AS `precio_lista`,`lista_precios`.`tipo_lista` AS `tipo_lista`,`sucursal`.`id_suc` AS `id_suc`,`sucursal`.`impuesto_suc` AS `impuesto_suc`,`unidad_medida`.`id_und` AS `id_und`,`unidad_medida`.`des_und` AS `des_und`,`producto`.`compra_prod` AS `compra_prod`,`producto`.`venta_prod` AS `venta_prod`,(`producto`.`stock_prod` - sum(coalesce(`pedido_detalle`.`cant_pdetalle`,0))) AS `stock_prod`,coalesce(`pedido`.`estatus_pedido`,0) AS `estatus_pedido` from (((((`producto` join `lista_precios` on((`producto`.`id_prod` = `lista_precios`.`prod_lista`))) join `sucursal` on((`producto`.`sucursal_prod` = `sucursal`.`id_suc`))) join `unidad_medida` on((`producto`.`umed_prod` = `unidad_medida`.`id_und`))) left join `pedido_detalle` on((`pedido_detalle`.`prod_pdetalle` = `producto`.`id_prod`))) left join `pedido` on(((`pedido`.`id_pedido` = `pedido_detalle`.`pedido_pdetalle`) and (coalesce(`pedido`.`estatus_pedido`,0) in (0,1))))) group by `producto`.`id_prod`,`producto`.`cod_prod`,`producto`.`des_prod`,`producto`.`sucursal_prod`,`producto`.`status_prod`,`lista_precios`.`precio_lista`,`lista_precios`.`tipo_lista`,`producto`.`stock_prod`,`sucursal`.`id_suc`,`sucursal`.`impuesto_suc`,`unidad_medida`.`id_und`,`unidad_medida`.`des_und`,`producto`.`compra_prod`,`producto`.`venta_prod`,`pedido`.`estatus_pedido` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`),
  ADD KEY `sucursal_almacen` (`sucursal_almacen`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_clte`),
  ADD KEY `sucursal_clte` (`sucursal_clte`),
  ADD KEY `cliente_ibfk_1` (`vendedor_clte`),
  ADD KEY `pais_cte` (`pais_cte`),
  ADD KEY `provi_cte` (`provi_cte`),
  ADD KEY `depto_cte` (`depto_cte`),
  ADD KEY `dtto_cte` (`dtto_clte`),
  ADD KEY `lista_clte` (`lista_clte`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD UNIQUE KEY `cod_compra` (`cod_compra`),
  ADD KEY `fecha_compra` (`fecha_compra`),
  ADD KEY `provee_compra` (`provee_compra`),
  ADD KEY `moneda_compra` (`moneda_compra`),
  ADD KEY `usuario_compra` (`usuario_compra`),
  ADD KEY `sucursal_compra` (`sucursal_compra`),
  ADD KEY `condp_compra` (`condp_compra`);

--
-- Indices de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD PRIMARY KEY (`id_cdetalle`),
  ADD KEY `prod_cdetalle` (`prod_cdetalle`),
  ADD KEY `compra_cdetalle` (`compra_cdetalle`);

--
-- Indices de la tabla `cond_pago`
--
ALTER TABLE `cond_pago`
  ADD PRIMARY KEY (`id_condp`),
  ADD KEY `sucursal_condp` (`sucursal_condp`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_depto`),
  ADD KEY `sucursal_depto` (`sucursal_depto`),
  ADD KEY `prov_depto` (`prov_depto`);

--
-- Indices de la tabla `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`id_dtto`),
  ADD KEY `sucursal_dtto` (`sucursal_dtto`),
  ADD KEY `depto_dtto` (`depto_dtto`),
  ADD KEY `pais_dtto` (`pais_dtto`),
  ADD KEY `prov_dtto` (`prov_dtto`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inv`),
  ADD KEY `sucursal_inv` (`sucursal_inv`);

--
-- Indices de la tabla `lista_precios`
--
ALTER TABLE `lista_precios`
  ADD PRIMARY KEY (`id_lista`),
  ADD UNIQUE KEY `lista` (`prod_lista`,`tipo_lista`),
  ADD KEY `tipo_lista` (`tipo_lista`),
  ADD KEY `prod_lista` (`prod_lista`),
  ADD KEY `sucursal_lista` (`sucursal_lista`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id_moneda`),
  ADD KEY `sucursal_moneda` (`sucursal_moneda`);

--
-- Indices de la tabla `movimiento_inv`
--
ALTER TABLE `movimiento_inv`
  ADD PRIMARY KEY (`id_inv`),
  ADD KEY `sucursal_inv` (`sucursal_inv`);

--
-- Indices de la tabla `numeracion`
--
ALTER TABLE `numeracion`
  ADD PRIMARY KEY (`id_num`),
  ADD KEY `sucursal_num` (`sucursal_num`),
  ADD KEY `tipo_num` (`tipo_num`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`,`cod_pedido`,`tipo_pedido`),
  ADD UNIQUE KEY `cod_pedido` (`cod_pedido`,`tipo_pedido`),
  ADD KEY `fecha_pedido` (`fecha_pedido`),
  ADD KEY `clte_pedido` (`clte_pedido`),
  ADD KEY `vend_pedido` (`vend_pedido`),
  ADD KEY `moneda_pedido` (`moneda_pedido`),
  ADD KEY `almacen_pedido` (`almacen_pedido`),
  ADD KEY `usuario_pedido` (`usuario_pedido`),
  ADD KEY `sucursal_pedido` (`sucursal_pedido`),
  ADD KEY `condp_pedido` (`condp_pedido`),
  ADD KEY `tipo_pedido` (`tipo_pedido`);

--
-- Indices de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD PRIMARY KEY (`id_pdetalle`),
  ADD KEY `prod_pdetalle` (`prod_pdetalle`),
  ADD KEY `pedido_pdetalle` (`pedido_pdetalle`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_prod`),
  ADD UNIQUE KEY `cod_prod` (`cod_prod`),
  ADD KEY `tipo_prod` (`tipo_prod`),
  ADD KEY `sucursal_prod` (`sucursal_prod`),
  ADD KEY `umed_prod` (`umed_prod`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_prove`),
  ADD KEY `sucursal_prove` (`sucursal_prove`),
  ADD KEY `pais_prove` (`pais_prove`),
  ADD KEY `provi_prove` (`provi_prove`),
  ADD KEY `depto_prove` (`depto_prove`),
  ADD KEY `dttp_prove` (`dtto_prove`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_prov`),
  ADD KEY `sucursal_prov` (`sucursal_prov`),
  ADD KEY `fx_pais_prov_idx` (`pais_prov`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id_serie`),
  ADD KEY `sucursal_serie` (`sucursal_serie`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id_suc`),
  ADD KEY `EMPRESA_SUC` (`empresa_suc`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipod`),
  ADD KEY `id_tipod` (`id_tipod`),
  ADD KEY `sucursal_tipod` (`sucursal_tipod`);

--
-- Indices de la tabla `tipo_listap`
--
ALTER TABLE `tipo_listap`
  ADD PRIMARY KEY (`id_lista`),
  ADD KEY `sucursal_lista` (`sucursal_lista`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  ADD PRIMARY KEY (`id_tipom`),
  ADD KEY `sucursal_tipom` (`sucursal_tipom`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tpdcto`);

--
-- Indices de la tabla `tipo_proveedor`
--
ALTER TABLE `tipo_proveedor`
  ADD PRIMARY KEY (`id_tprov`),
  ADD KEY `sucursal_tprov` (`sucursal_tprov`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id_trans`,`codigo_trans`,`ope_trans`),
  ADD KEY `codigo_trans` (`codigo_trans`),
  ADD KEY `fecha_trans` (`fecha_trans`),
  ADD KEY `tipo_trans` (`tipo_trans`),
  ADD KEY `almacen_trans` (`almacen_trans`),
  ADD KEY `usuario_trans` (`usuario_trans`),
  ADD KEY `grupo_trans` (`ope_trans`);

--
-- Indices de la tabla `trans_detalle`
--
ALTER TABLE `trans_detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `trans_detalle` (`trans_detalle`),
  ADD KEY `prod_detalle` (`prod_detalle`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id_und`),
  ADD KEY `sucursal_und` (`sucursal_und`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa` (`empresa`),
  ADD KEY `sucursal` (`sucursal`);

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
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_clte` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=750;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  MODIFY `id_cdetalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cond_pago`
--
ALTER TABLE `cond_pago`
  MODIFY `id_condp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_depto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT de la tabla `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_dtto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inv` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO';

--
-- AUTO_INCREMENT de la tabla `lista_precios`
--
ALTER TABLE `lista_precios`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimiento_inv`
--
ALTER TABLE `movimiento_inv`
  MODIFY `id_inv` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO';

--
-- AUTO_INCREMENT de la tabla `numeracion`
--
ALTER TABLE `numeracion`
  MODIFY `id_num` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  MODIFY `id_pdetalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO';

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_prove` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id_serie` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID SERIE', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id_suc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_listap`
--
ALTER TABLE `tipo_listap`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  MODIFY `id_tipom` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tpdcto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_proveedor`
--
ALTER TABLE `tipo_proveedor`
  MODIFY `id_tprov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `trans_detalle`
--
ALTER TABLE `trans_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id_und` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id_zona` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`vendedor_clte`) REFERENCES `vendedor` (`id_vendedor`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`pais_cte`) REFERENCES `pais` (`id_pais`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`provi_cte`) REFERENCES `provincia` (`id_prov`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_4` FOREIGN KEY (`depto_cte`) REFERENCES `departamento` (`id_depto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_5` FOREIGN KEY (`dtto_clte`) REFERENCES `distrito` (`id_dtto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_6` FOREIGN KEY (`lista_clte`) REFERENCES `tipo_listap` (`id_lista`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`provee_compra`) REFERENCES `proveedor` (`id_prove`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`moneda_compra`) REFERENCES `moneda` (`id_moneda`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_4` FOREIGN KEY (`condp_compra`) REFERENCES `cond_pago` (`id_condp`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD CONSTRAINT `compra_detalle_ibfk_1` FOREIGN KEY (`compra_cdetalle`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_detalle_ibfk_2` FOREIGN KEY (`prod_cdetalle`) REFERENCES `producto` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `prov_depto_ibkf` FOREIGN KEY (`prov_depto`) REFERENCES `provincia` (`id_prov`);

--
-- Filtros para la tabla `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `depto_dtto_ibkf` FOREIGN KEY (`depto_dtto`) REFERENCES `departamento` (`id_depto`);

--
-- Filtros para la tabla `lista_precios`
--
ALTER TABLE `lista_precios`
  ADD CONSTRAINT `lista_precios_ibfk_1` FOREIGN KEY (`tipo_lista`) REFERENCES `tipo_listap` (`id_lista`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lista_precios_ibfk_2` FOREIGN KEY (`prod_lista`) REFERENCES `producto` (`id_prod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `numeracion`
--
ALTER TABLE `numeracion`
  ADD CONSTRAINT `numeracion_ibfk_1` FOREIGN KEY (`tipo_num`) REFERENCES `tipo_documento` (`id_tipod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`clte_pedido`) REFERENCES `cliente` (`id_clte`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`vend_pedido`) REFERENCES `vendedor` (`id_vendedor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`moneda_pedido`) REFERENCES `moneda` (`id_moneda`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`condp_pedido`) REFERENCES `cond_pago` (`id_condp`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD CONSTRAINT `fk_pedido_detalle_1` FOREIGN KEY (`prod_pdetalle`) REFERENCES `producto` (`id_prod`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_detalle_ibfk_1` FOREIGN KEY (`pedido_pdetalle`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibkf_1` FOREIGN KEY (`tipo_prod`) REFERENCES `tipo_producto` (`id_tpdcto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibkf_2` FOREIGN KEY (`umed_prod`) REFERENCES `unidad_medida` (`id_und`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `provee_ibfk_1` FOREIGN KEY (`pais_prove`) REFERENCES `pais` (`id_pais`) ON UPDATE CASCADE,
  ADD CONSTRAINT `provee_ibfk_2` FOREIGN KEY (`provi_prove`) REFERENCES `provincia` (`id_prov`) ON UPDATE CASCADE,
  ADD CONSTRAINT `provee_ibfk_3` FOREIGN KEY (`depto_prove`) REFERENCES `departamento` (`id_depto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `provee_ibfk_4` FOREIGN KEY (`dtto_prove`) REFERENCES `distrito` (`id_dtto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `fx_pais_prov` FOREIGN KEY (`pais_prov`) REFERENCES `pais` (`id_pais`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`empresa_suc`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `transaccion_ibfk_1` FOREIGN KEY (`tipo_trans`) REFERENCES `tipo_movimiento` (`id_tipom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaccion_ibfk_2` FOREIGN KEY (`almacen_trans`) REFERENCES `almacen` (`id_almacen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trans_detalle`
--
ALTER TABLE `trans_detalle`
  ADD CONSTRAINT `trans_detalle_ibfk_1` FOREIGN KEY (`trans_detalle`) REFERENCES `transaccion` (`id_trans`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_detalle_ibfk_2` FOREIGN KEY (`prod_detalle`) REFERENCES `producto` (`id_prod`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD CONSTRAINT `vendedor_ibfk_1` FOREIGN KEY (`zona_vend`) REFERENCES `zona` (`id_zona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
