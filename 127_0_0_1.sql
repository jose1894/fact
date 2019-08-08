-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2019 a las 00:33:08
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
  `vendedor_clte` int(11) NOT NULL COMMENT 'VENDEDOR CLIENTE',
  `estatus_ctle` int(11) NOT NULL COMMENT 'ESTATUS CLIENTE',
  `condp_clte` int(11) NOT NULL COMMENT 'CONDICION DE PAGO',
  `sucursal_clte` int(11) NOT NULL,
  `lista_clte` int(11) NOT NULL DEFAULT '0' COMMENT 'LISTA DE PRECIOS CLIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE CLIENTES';

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_clte`, `dni_clte`, `ruc_clte`, `nombre_clte`, `direcc_clte`, `pais_cte`, `depto_cte`, `provi_cte`, `dtto_clte`, `tlf_ctle`, `vendedor_clte`, `estatus_ctle`, `condp_clte`, `sucursal_clte`, `lista_clte`) VALUES
(2, '', '', 'PEDRO PEREZ', 'JUAN IGNACIO LULAkk', 241, 133, 15, 133, '', 1, 1, 2, 1, 2),
(3, '', '', 'JUAN RENGIFO', 'ASDASDASVB DDFDFG', 241, 135, 15, 135, '', 3, 1, 2, 1, 1),
(4, '', '', 'MARIANO QUISPE', 'HUAYNA CAPAC', 241, 133, 15, 133, '', 2, 1, 2, 1, 1),
(5, '', '', 'NESTOR RODRIGUEZ', 'ASDASDASD', 241, 135, 15, 135, '', 2, 1, 1, 1, 1),
(7, '', '', 'PABLO JOSE', 'ASDAS', 241, 135, 15, 135, '', 2, 1, 1, 1, 1);

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
(1, '0000000001', '2019-08-05', 1, 1, 1, 2, 0, 'N', 0, 0, '58', 1);

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
(1, 5, '1.00', '5.00', '5.00', '0', 1, 1, '0.00', '4.75');

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
(215, 'Valencia', 28, 231, 1, 1);

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
(216, 'Miguel Peña', 231, 28, 215, 1, 1);

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
(1, 'MARVIG', 1, '', '20517053270', 1, '', 'scasdasd');

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
(9, 2, 3, '60.00', 1, '0.00', '0.00', '0.00', '0.00'),
(10, 1, 6, '90.00', 1, '0.00', '0.00', '0.00', '0.00'),
(12, 1, 5, '24.00', 1, '0.00', '0.00', '0.00', '0.00'),
(14, 1, 3, '60.00', 0, '0.00', '0.00', '0.00', '0.00'),
(16, 1, 4, '24.00', 0, '0.00', '0.00', '0.00', '0.00'),
(17, 2, 4, '30.00', 0, '0.00', '0.00', '0.00', '0.00');

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
(241, 'PER', 'Perú', 1, 1);

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
  `tipo_pedido` int(11) NOT NULL DEFAULT '0' COMMENT 'TIPO DE PEDIDO 0 = PEDIDO, 1 = PROFORMA, 2 = COTIZACION  ',
  `edicion_pedido` varchar(1) DEFAULT 'N' COMMENT 'EDICION PEDIDO',
  `nrodoc_pedido` varchar(25) DEFAULT NULL COMMENT 'NRO DOCUMENTO PEDIDO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA PEDIDOS';

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `cod_pedido`, `fecha_pedido`, `clte_pedido`, `vend_pedido`, `moneda_pedido`, `almacen_pedido`, `usuario_pedido`, `estatus_pedido`, `sucursal_pedido`, `condp_pedido`, `tipo_pedido`, `edicion_pedido`, `nrodoc_pedido`) VALUES
(1, '0000000001', '2019-08-02', 4, 2, 1, 1, 1, 0, 1, 2, 0, 'N', '111111'),
(3, '0000000001', '2019-06-21', 4, 2, 1, 1, 1, 0, 1, 2, 1, 'N', ''),
(4, '0000000002', '2019-06-21', 4, 2, 1, 1, 1, 0, 1, 2, 0, 'N', ''),
(5, '0000000005', '2019-07-26', 4, 2, 1, 1, 1, 0, 1, 2, 0, 'N', '78943'),
(6, '0000000006', '2019-07-24', 2, 1, 1, 1, 1, 0, 1, 2, 0, 'N', ''),
(7, '0000000007', '2019-07-24', 3, 3, 1, 1, 1, 0, 1, 2, 0, 'N', ''),
(8, '0000000008', '2019-07-24', 3, 3, 1, 1, 1, 0, 1, 2, 0, 'N', ''),
(9, '0000000009', '2019-08-05', 3, 3, 1, 1, 1, 0, 1, 2, 0, 'N', '254');

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
(4, 5, '1.00', '22.80', '5.00', '18', 1, 3, '24.00', '22.80'),
(5, 5, '3.00', '23.52', '2.00', '18', 1, 4, '24.00', '70.56'),
(6, 4, '3.00', '23.52', '2.00', '18', 1, 4, '24.00', '70.56'),
(7, 6, '1.00', '88.20', '2.00', '18', 1, 4, '90.00', '88.20'),
(8, 6, '1.00', '87.30', '3.00', '18', 1, 5, '90.00', '87.30'),
(14, 5, '1.00', '23.28', '3.00', '18', 1, 1, '24.00', '23.28'),
(15, 3, '1.00', '32.20', '5.00', '18', 1, 6, '33.90', '32.20'),
(16, 5, '1.00', '19.73', '3.00', '18', 1, 7, '20.34', '19.73'),
(17, 4, '1.00', '19.73', '3.00', '18', 1, 8, '20.34', '19.73'),
(20, 5, '2.00', '23.52', '2.00', '18', 1, 5, '24.00', '47.04'),
(21, 4, '2.00', '22.80', '5.00', '18', 1, 5, '24.00', '45.60'),
(22, 4, '1.00', '22.80', '5.00', '18', 1, 1, '24.00', '22.80'),
(23, 5, '5.00', '23.28', '3.00', '18', 1, 9, '24.00', '116.40'),
(24, 4, '5.00', '23.28', '3.00', '18', 1, 9, '24.00', '116.40'),
(25, 3, '5.00', '60.00', '0.00', '18', 1, 9, '60.00', '300.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_prod` int(11) NOT NULL COMMENT 'ID UNICO',
  `cod_prod` varchar(25) NOT NULL COMMENT 'CODIGO PRODUCTO',
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
  `status_prod` int(11) NOT NULL COMMENT 'ESTATUS PRODUCTO',
  `sucursal_prod` int(11) NOT NULL COMMENT 'SUCURSAL PRODUCTO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS PRODUCTOS';

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_prod`, `cod_prod`, `des_prod`, `tipo_prod`, `umed_prod`, `contenido_prod`, `exctoigv_prod`, `compra_prod`, `venta_prod`, `stockini_prod`, `stockmax_prod`, `stockmin_prod`, `status_prod`, `sucursal_prod`) VALUES
(3, 'CM02-PX20', 'MANDIL DE GUARDAFANGO DELANTERO TOYOTA PROBOX', 2, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1),
(4, 'CM-001R   ', 'PORTAFARO DELANTERO TOYOTA HIACE VAN 1993-1996       ', 10, 2, 1, 0, 0, 0, 0, 0, 0, 1, 1),
(5, 'CM-001L', 'PORTAFARO DELANTERO TOYOTA HIACE VAN 1993-1996       ', 10, 2, 1, 0, 0, 0, 0, 0, 0, 1, 1),
(6, 'CM01-TA1L', 'FARO DELANTERO TY.COROLLA ALTIS 2001-2004(BLANCO)', 3, 2, 1, 0, 1, 1, 0, 0, 0, 1, 1);

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
(28, 'Carabobo', 1, 1, 231);

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
(2, 'MANDILES', 1, 1),
(3, 'FARO DELANTERO', 1, 1),
(4, 'FARO POSTERIOR', 1, 1),
(5, 'PARACHOQUE DELANTERO', 1, 1),
(6, 'PARACHOQUE TRASERO', 1, 1),
(7, 'MANIJA', 1, 1),
(8, 'FARO NEBLINERO', 1, 1),
(9, 'Parachoque posterior', 1, 1),
(10, 'PORTAFARO', 1, 1);

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
(1, '', 'IRWIN PEREZ', '', 1, 1, 2),
(2, '', 'APP', '', 1, 1, 1),
(3, '', 'MELIN HUAMAN', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_productos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_productos` (
`id_prod` int(11)
,`cod_prod` varchar(25)
,`des_prod` varchar(70)
,`texto` varchar(96)
,`sucursal_prod` int(11)
,`status_prod` int(11)
,`precio_lista` decimal(18,2)
,`tipo_lista` int(11)
,`id_suc` int(11)
,`impuesto_suc` decimal(7,2)
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_productos`  AS  select `producto`.`id_prod` AS `id_prod`,`producto`.`cod_prod` AS `cod_prod`,`producto`.`des_prod` AS `des_prod`,concat(`producto`.`cod_prod`,' ',`producto`.`des_prod`) AS `texto`,`producto`.`sucursal_prod` AS `sucursal_prod`,`producto`.`status_prod` AS `status_prod`,`lista_precios`.`precio_lista` AS `precio_lista`,`lista_precios`.`tipo_lista` AS `tipo_lista`,`sucursal`.`id_suc` AS `id_suc`,`sucursal`.`impuesto_suc` AS `impuesto_suc` from ((`producto` join `lista_precios` on((`producto`.`id_prod` = `lista_precios`.`prod_lista`))) join `sucursal` on((`producto`.`sucursal_prod` = `sucursal`.`id_suc`))) ;

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
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
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
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id_suc`),
  ADD KEY `EMPRESA_SUC` (`empresa_suc`);

--
-- Indices de la tabla `tipo_listap`
--
ALTER TABLE `tipo_listap`
  ADD PRIMARY KEY (`id_lista`),
  ADD KEY `sucursal_lista` (`sucursal_lista`);

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
  MODIFY `id_clte` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  MODIFY `id_cdetalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cond_pago`
--
ALTER TABLE `cond_pago`
  MODIFY `id_condp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_depto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT de la tabla `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_dtto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=217;

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
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  MODIFY `id_pdetalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=7;

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
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id_suc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_listap`
--
ALTER TABLE `tipo_listap`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tpdcto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipo_proveedor`
--
ALTER TABLE `tipo_proveedor`
  MODIFY `id_tprov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `compra_detalle_ibfk_1` FOREIGN KEY (`compra_cdetalle`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`clte_pedido`) REFERENCES `cliente` (`id_clte`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`vend_pedido`) REFERENCES `vendedor` (`id_vendedor`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`moneda_pedido`) REFERENCES `moneda` (`id_moneda`),
  ADD CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`condp_pedido`) REFERENCES `cond_pago` (`id_condp`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
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
-- Filtros para la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD CONSTRAINT `vendedor_ibfk_1` FOREIGN KEY (`zona_vend`) REFERENCES `zona` (`id_zona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
