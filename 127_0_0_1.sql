-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2019 a las 00:09:57
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.28

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

DROP TABLE IF EXISTS `almacen`;
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
(1, 'ALMACEN PRINCIPAL', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrador', '1', 1556978944);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
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
('/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/admin/*', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/default/*', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/default/index', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/menu/*', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/menu/create', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/menu/index', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/menu/update', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/menu/view', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/permission/*', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/permission/create', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/permission/index', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/permission/update', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/permission/view', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/admin/role/*', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/role/assign', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/role/create', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/role/delete', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/role/index', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/role/remove', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/role/update', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/role/view', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/route/*', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/route/assign', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/route/create', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/route/index', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/route/remove', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/rule/*', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/rule/create', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/rule/index', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/rule/update', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/rule/view', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/*', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/activate', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/delete', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/index', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/login', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/logout', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/signup', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/admin/user/view', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/almacen/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/almacen/create', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/almacen/delete', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/almacen/index', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/almacen/update', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/almacen/view', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cliente/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cliente/create', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cliente/delete', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cliente/index', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cliente/update', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cliente/view', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cond-pago/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cond-pago/create', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cond-pago/delete', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cond-pago/index', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cond-pago/update', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/cond-pago/view', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/debug/*', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/debug/default/*', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/debug/default/index', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/debug/default/view', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/debug/user/*', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/departamento/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/departamento/create', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/departamento/delete', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/departamento/departamentos', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/departamento/index', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/departamento/update', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/departamento/view', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/distrito/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/distrito/create', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/distrito/delete', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/distrito/distritos', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/distrito/index', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/distrito/update', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/distrito/view', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/empresa/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/empresa/create', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/empresa/delete', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/empresa/index', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/empresa/update', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/empresa/view', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/gii/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/gii/default/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/gii/default/action', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/gii/default/diff', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/gii/default/index', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/gii/default/preview', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/gii/default/view', 2, NULL, NULL, NULL, 1556979092, 1556979092),
('/gridview/*', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/gridview/export/*', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/gridview/export/download', 2, NULL, NULL, NULL, 1556979091, 1556979091),
('/moneda/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/moneda/create', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/moneda/delete', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/moneda/index', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/moneda/update', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/moneda/view', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/pais/*', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/pais/create', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/pais/delete', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/pais/index', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/pais/update', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/pais/view', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/producto/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/producto/create', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/producto/delete', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/producto/index', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/producto/update', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/producto/view', 2, NULL, NULL, NULL, 1556979093, 1556979093),
('/proveedor/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/proveedor/create', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/proveedor/delete', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/proveedor/index', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/proveedor/update', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/proveedor/view', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/provincia/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/provincia/create', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/provincia/delete', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/provincia/index', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/provincia/provincias', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/provincia/update', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/provincia/view', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/about', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/add-admin', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/captcha', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/contact', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/error', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/index', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/login', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/logout', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/site/signup', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-producto/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-producto/create', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-producto/delete', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-producto/index', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-producto/update', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-producto/view', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-proveedor/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-proveedor/create', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-proveedor/delete', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-proveedor/index', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-proveedor/update', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/tipo-proveedor/view', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/unidad-medida/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/unidad-medida/create', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/unidad-medida/delete', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/unidad-medida/index', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/unidad-medida/update', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/unidad-medida/view', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/vendedor/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/vendedor/create', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/vendedor/delete', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/vendedor/index', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/vendedor/update', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/vendedor/view', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/zona/*', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/zona/create', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/zona/delete', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/zona/index', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/zona/update', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('/zona/view', 2, NULL, NULL, NULL, 1556979094, 1556979094),
('Administrador', 1, 'Administrador del sistema', NULL, NULL, 1556921385, 1556921385),
('Supervisor', 2, 'Supervisor', NULL, NULL, 1556922387, 1556922387);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Administrador', '/*'),
('Administrador', '/admin/*'),
('Administrador', '/admin/assignment/*'),
('Administrador', '/admin/assignment/assign'),
('Administrador', '/admin/assignment/index'),
('Administrador', '/admin/assignment/revoke'),
('Administrador', '/admin/assignment/view'),
('Administrador', '/admin/default/*'),
('Administrador', '/admin/default/index'),
('Administrador', '/admin/menu/*'),
('Administrador', '/admin/menu/create'),
('Administrador', '/admin/menu/delete'),
('Administrador', '/admin/menu/index'),
('Administrador', '/admin/menu/update'),
('Administrador', '/admin/menu/view'),
('Administrador', '/admin/permission/*'),
('Administrador', '/admin/permission/assign'),
('Administrador', '/admin/permission/create'),
('Administrador', '/admin/permission/delete'),
('Administrador', '/admin/permission/index'),
('Administrador', '/admin/permission/remove'),
('Administrador', '/admin/permission/update'),
('Administrador', '/admin/permission/view'),
('Administrador', '/admin/role/*'),
('Administrador', '/admin/role/assign'),
('Administrador', '/admin/role/create'),
('Administrador', '/admin/role/delete'),
('Administrador', '/admin/role/index'),
('Administrador', '/admin/role/remove'),
('Administrador', '/admin/role/update'),
('Administrador', '/admin/role/view'),
('Administrador', '/admin/route/*'),
('Administrador', '/admin/route/assign'),
('Administrador', '/admin/route/create'),
('Administrador', '/admin/route/index'),
('Administrador', '/admin/route/refresh'),
('Administrador', '/admin/route/remove'),
('Administrador', '/admin/rule/*'),
('Administrador', '/admin/rule/create'),
('Administrador', '/admin/rule/delete'),
('Administrador', '/admin/rule/index'),
('Administrador', '/admin/rule/update'),
('Administrador', '/admin/rule/view'),
('Administrador', '/admin/user/*'),
('Administrador', '/admin/user/activate'),
('Administrador', '/admin/user/change-password'),
('Administrador', '/admin/user/delete'),
('Administrador', '/admin/user/index'),
('Administrador', '/admin/user/login'),
('Administrador', '/admin/user/logout'),
('Administrador', '/admin/user/request-password-reset'),
('Administrador', '/admin/user/reset-password'),
('Administrador', '/admin/user/signup'),
('Administrador', '/admin/user/view'),
('Administrador', '/almacen/*'),
('Administrador', '/almacen/create'),
('Administrador', '/almacen/delete'),
('Administrador', '/almacen/index'),
('Administrador', '/almacen/update'),
('Administrador', '/almacen/view'),
('Administrador', '/cliente/*'),
('Administrador', '/cliente/create'),
('Administrador', '/cliente/delete'),
('Administrador', '/cliente/index'),
('Administrador', '/cliente/update'),
('Administrador', '/cliente/view'),
('Administrador', '/cond-pago/*'),
('Administrador', '/cond-pago/create'),
('Administrador', '/cond-pago/delete'),
('Administrador', '/cond-pago/index'),
('Administrador', '/cond-pago/update'),
('Administrador', '/cond-pago/view'),
('Administrador', '/debug/*'),
('Administrador', '/debug/default/*'),
('Administrador', '/debug/default/db-explain'),
('Administrador', '/debug/default/download-mail'),
('Administrador', '/debug/default/index'),
('Administrador', '/debug/default/toolbar'),
('Administrador', '/debug/default/view'),
('Administrador', '/debug/user/*'),
('Administrador', '/debug/user/reset-identity'),
('Administrador', '/debug/user/set-identity'),
('Administrador', '/departamento/*'),
('Administrador', '/departamento/create'),
('Administrador', '/departamento/delete'),
('Administrador', '/departamento/departamentos'),
('Administrador', '/departamento/index'),
('Administrador', '/departamento/update'),
('Administrador', '/departamento/view'),
('Administrador', '/distrito/*'),
('Administrador', '/distrito/create'),
('Administrador', '/distrito/delete'),
('Administrador', '/distrito/distritos'),
('Administrador', '/distrito/index'),
('Administrador', '/distrito/update'),
('Administrador', '/distrito/view'),
('Administrador', '/empresa/*'),
('Administrador', '/empresa/create'),
('Administrador', '/empresa/delete'),
('Administrador', '/empresa/index'),
('Administrador', '/empresa/update'),
('Administrador', '/empresa/view'),
('Administrador', '/gii/*'),
('Administrador', '/gii/default/*'),
('Administrador', '/gii/default/action'),
('Administrador', '/gii/default/diff'),
('Administrador', '/gii/default/index'),
('Administrador', '/gii/default/preview'),
('Administrador', '/gii/default/view'),
('Administrador', '/gridview/*'),
('Administrador', '/gridview/export/*'),
('Administrador', '/gridview/export/download'),
('Administrador', '/moneda/*'),
('Administrador', '/moneda/create'),
('Administrador', '/moneda/delete'),
('Administrador', '/moneda/index'),
('Administrador', '/moneda/update'),
('Administrador', '/moneda/view'),
('Administrador', '/pais/*'),
('Administrador', '/pais/create'),
('Administrador', '/pais/delete'),
('Administrador', '/pais/index'),
('Administrador', '/pais/update'),
('Administrador', '/pais/view'),
('Administrador', '/producto/*'),
('Administrador', '/producto/create'),
('Administrador', '/producto/delete'),
('Administrador', '/producto/index'),
('Administrador', '/producto/update'),
('Administrador', '/producto/view'),
('Administrador', '/proveedor/*'),
('Administrador', '/proveedor/create'),
('Administrador', '/proveedor/delete'),
('Administrador', '/proveedor/index'),
('Administrador', '/proveedor/update'),
('Administrador', '/proveedor/view'),
('Administrador', '/provincia/*'),
('Administrador', '/provincia/create'),
('Administrador', '/provincia/delete'),
('Administrador', '/provincia/index'),
('Administrador', '/provincia/provincias'),
('Administrador', '/provincia/update'),
('Administrador', '/provincia/view'),
('Administrador', '/site/*'),
('Administrador', '/site/about'),
('Administrador', '/site/add-admin'),
('Administrador', '/site/captcha'),
('Administrador', '/site/contact'),
('Administrador', '/site/error'),
('Administrador', '/site/index'),
('Administrador', '/site/login'),
('Administrador', '/site/logout'),
('Administrador', '/site/signup'),
('Administrador', '/tipo-producto/*'),
('Administrador', '/tipo-producto/create'),
('Administrador', '/tipo-producto/delete'),
('Administrador', '/tipo-producto/index'),
('Administrador', '/tipo-producto/update'),
('Administrador', '/tipo-producto/view'),
('Administrador', '/tipo-proveedor/*'),
('Administrador', '/tipo-proveedor/create'),
('Administrador', '/tipo-proveedor/delete'),
('Administrador', '/tipo-proveedor/index'),
('Administrador', '/tipo-proveedor/update'),
('Administrador', '/tipo-proveedor/view'),
('Administrador', '/unidad-medida/*'),
('Administrador', '/unidad-medida/create'),
('Administrador', '/unidad-medida/delete'),
('Administrador', '/unidad-medida/index'),
('Administrador', '/unidad-medida/update'),
('Administrador', '/unidad-medida/view'),
('Administrador', '/vendedor/*'),
('Administrador', '/vendedor/create'),
('Administrador', '/vendedor/delete'),
('Administrador', '/vendedor/index'),
('Administrador', '/vendedor/update'),
('Administrador', '/vendedor/view'),
('Administrador', '/zona/*'),
('Administrador', '/zona/create'),
('Administrador', '/zona/delete'),
('Administrador', '/zona/index'),
('Administrador', '/zona/update'),
('Administrador', '/zona/view');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
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

DROP TABLE IF EXISTS `cliente`;
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
(2, '', '', 'PEDRO PEREZ', 'JUAN IGNACIO LULA', 241, 133, 15, 133, '', 1, 1, 2, 0, 2),
(3, '', '', 'JUAN RENGIFO', 'ASDASDASVB DDFDFG', 241, 135, 15, 135, '', 3, 1, 2, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cond_pago`
--

DROP TABLE IF EXISTS `cond_pago`;
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
(1, 'CONTADO', 1, 0),
(2, 'CREDITO', 1, 0),
(3, 'FACTURA A 30 DIAS', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
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
(1, 'Bagua', 1, 241, 1, 0),
(2, 'Bongará', 1, 241, 1, 0),
(3, 'Chachapoyas', 1, 241, 1, 0),
(4, 'Condorcanqui', 1, 241, 1, 0),
(5, 'Luya', 1, 241, 1, 0),
(6, 'Rodríguez de Mendoza', 1, 241, 1, 0),
(7, 'Utcubamba', 1, 241, 1, 0),
(8, 'Aija', 2, 241, 1, 0),
(9, 'Antonio Raymond', 2, 241, 1, 0),
(10, 'Asunción', 2, 241, 1, 0),
(11, 'Bolognesi', 2, 241, 1, 0),
(12, 'Carhuaz', 2, 241, 1, 0),
(13, 'Carlos Fermín Fitzcarrald', 2, 241, 1, 0),
(14, 'Casma', 2, 241, 1, 0),
(15, 'Corongo', 2, 241, 1, 0),
(16, 'Huaraz', 2, 241, 1, 0),
(17, 'Huari', 2, 241, 1, 0),
(18, 'Huarmey', 2, 241, 1, 0),
(19, 'Huaylas', 2, 241, 1, 0),
(20, 'Mariscal Luzuriaga', 2, 241, 1, 0),
(21, 'Ocros', 2, 241, 1, 0),
(22, 'Pallasca', 2, 241, 1, 0),
(23, 'Pomabamba', 2, 241, 1, 0),
(24, 'Recuay', 2, 241, 1, 0),
(25, 'Santa', 2, 241, 1, 0),
(26, 'Sihuas', 2, 241, 1, 0),
(27, 'Yungay', 2, 241, 1, 0),
(28, 'Abancay', 3, 241, 1, 0),
(29, 'Andahuaylas', 3, 241, 1, 0),
(30, 'Antabamba', 3, 241, 1, 0),
(31, 'Aymaraes', 3, 241, 1, 0),
(32, 'Chicheros', 3, 241, 1, 0),
(33, 'Cotabambas', 3, 241, 1, 0),
(34, 'Grau', 3, 241, 1, 0),
(35, 'Arequipa', 4, 241, 1, 0),
(36, 'Camaná', 4, 241, 1, 0),
(37, 'Caraveli', 4, 241, 1, 0),
(38, 'Castilla', 4, 241, 1, 0),
(39, 'Caylloma', 4, 241, 1, 0),
(40, 'Condesuyos', 4, 241, 1, 0),
(41, 'Islay', 4, 241, 1, 0),
(42, 'La Unión', 4, 241, 1, 0),
(43, 'Cangallo', 5, 241, 1, 0),
(44, 'Huamanga', 5, 241, 1, 0),
(45, 'Huancasancos', 5, 241, 1, 0),
(46, 'Huanta', 5, 241, 1, 0),
(47, 'La Mar', 5, 241, 1, 0),
(48, 'Lucanas', 5, 241, 1, 0),
(49, 'Parinacochas', 5, 241, 1, 0),
(50, 'Páucar del Sara Sara', 5, 241, 1, 0),
(51, 'Sucre', 5, 241, 1, 0),
(52, 'Víctor Fajardo', 5, 241, 1, 0),
(53, 'Vilcashuaman', 5, 241, 1, 0),
(54, 'Cajabamba', 6, 241, 1, 0),
(55, 'Cajamarca', 6, 241, 1, 0),
(56, 'Celendín', 6, 241, 1, 0),
(57, 'Chota', 6, 241, 1, 0),
(58, 'Contumazá', 6, 241, 1, 0),
(59, 'Cutervo', 6, 241, 1, 0),
(60, 'Hualgayoc', 6, 241, 1, 0),
(61, 'Jaén', 6, 241, 1, 0),
(62, 'San Ignacio', 6, 241, 1, 0),
(63, 'San Marcos', 6, 241, 1, 0),
(64, 'San Miguel', 6, 241, 1, 0),
(65, 'San Pablo', 6, 241, 1, 0),
(66, 'Santa Cruz', 6, 241, 1, 0),
(67, 'Callao', 7, 241, 1, 0),
(68, 'Acomayo', 8, 241, 1, 0),
(69, 'Anta', 8, 241, 1, 0),
(70, 'Calca', 8, 241, 1, 0),
(71, 'Canas', 8, 241, 1, 0),
(72, 'Canchis', 8, 241, 1, 0),
(73, 'Chumbivilcas', 8, 241, 1, 0),
(74, 'Cusco', 8, 241, 1, 0),
(75, 'Espinar', 8, 241, 1, 0),
(76, 'La Convención', 8, 241, 1, 0),
(77, 'Paruro', 8, 241, 1, 0),
(78, 'Paucartambo', 8, 241, 1, 0),
(79, 'Quispicanchi', 8, 241, 1, 0),
(80, 'Urubamba', 8, 241, 1, 0),
(81, 'Acobamba', 9, 241, 1, 0),
(82, 'Angaraes', 9, 241, 1, 0),
(83, 'Castrovirreyna', 9, 241, 1, 0),
(84, 'Churcampa', 9, 241, 1, 0),
(85, 'Huancavelica', 9, 241, 1, 0),
(86, 'Huaytará', 9, 241, 1, 0),
(87, 'Tayacaja', 9, 241, 1, 0),
(88, 'Ambo', 10, 241, 1, 0),
(89, 'Dos de Mayo', 10, 241, 1, 0),
(90, 'Huacaybamba', 10, 241, 1, 0),
(91, 'Huamalíes', 10, 241, 1, 0),
(92, 'Huanuco', 10, 241, 1, 0),
(93, 'Lauricocha', 10, 241, 1, 0),
(94, 'Leoncio Prado', 10, 241, 1, 0),
(95, 'Marañón', 10, 241, 1, 0),
(96, 'Pachitea', 10, 241, 1, 0),
(97, 'Puerto Inca', 10, 241, 1, 0),
(98, 'Yarowilca', 10, 241, 1, 0),
(99, 'Chincha', 11, 241, 1, 0),
(100, 'Ica', 11, 241, 1, 0),
(101, 'Nazca', 11, 241, 1, 0),
(102, 'Palpa', 11, 241, 1, 0),
(103, 'Pisco', 11, 241, 1, 0),
(104, 'Chanchamayo', 12, 241, 1, 0),
(105, 'Chupaca', 12, 241, 1, 0),
(106, 'Concepción', 12, 241, 1, 0),
(107, 'Huancayo', 12, 241, 1, 0),
(108, 'Jauja', 12, 241, 1, 0),
(109, 'Junín', 12, 241, 1, 0),
(110, 'Satipo', 12, 241, 1, 0),
(111, 'Tarma', 12, 241, 1, 0),
(112, 'Yauli', 12, 241, 1, 0),
(113, 'Ascope', 13, 241, 1, 0),
(114, 'Bolívar', 13, 241, 1, 0),
(115, 'Chepén', 13, 241, 1, 0),
(116, 'Gran Chimú', 13, 241, 1, 0),
(117, 'Julcán', 13, 241, 1, 0),
(118, 'Otuzco', 13, 241, 1, 0),
(119, 'Pacasmayo', 13, 241, 1, 0),
(120, 'Pataz', 13, 241, 1, 0),
(121, 'Sanchez Carrión', 13, 241, 1, 0),
(122, 'Santiago de Chuco', 13, 241, 1, 0),
(123, 'Trujillo', 13, 241, 1, 0),
(124, 'Virú', 13, 241, 1, 0),
(125, 'Chiclayo', 14, 241, 1, 0),
(126, 'Ferreñafe', 14, 241, 1, 0),
(127, 'Lambayeque', 14, 241, 1, 0),
(128, 'Barranca', 15, 241, 1, 0),
(129, 'Cajatambo', 15, 241, 1, 0),
(130, 'Canta', 15, 241, 1, 0),
(131, 'Cañete', 15, 241, 1, 0),
(132, 'Huaral', 15, 241, 1, 0),
(133, 'Huarochirí', 15, 241, 1, 0),
(134, 'Huaura', 15, 241, 1, 0),
(135, 'Lima', 15, 241, 1, 0),
(136, 'Oyón', 15, 241, 1, 0),
(137, 'Yauyos', 15, 241, 1, 0),
(138, 'Alto Amazonas', 16, 241, 1, 0),
(139, 'Datem de Marañón', 16, 241, 1, 0),
(140, 'Loreto', 16, 241, 1, 0),
(141, 'Mariscal Ramón Castilla', 16, 241, 1, 0),
(142, 'Maynas', 16, 241, 1, 0),
(143, 'Putumayo', 16, 241, 1, 0),
(144, 'Requena', 16, 241, 1, 0),
(145, 'Ucayali', 16, 241, 1, 0),
(146, 'Manu', 17, 241, 1, 0),
(147, 'Tahuamanu', 17, 241, 1, 0),
(148, 'Tambopata', 17, 241, 1, 0),
(149, 'General Sánchez Cerro', 18, 241, 1, 0),
(150, 'Ilo', 18, 241, 1, 0),
(151, 'Mariscal Nieto', 18, 241, 1, 0),
(152, 'Daniel Alcides Carrión', 19, 241, 1, 0),
(153, 'Oxapampa', 19, 241, 1, 0),
(154, 'Pasco', 19, 241, 1, 0),
(155, 'Ayabaca', 20, 241, 1, 0),
(156, 'Huancabamba', 20, 241, 1, 0),
(157, 'Morropón', 20, 241, 1, 0),
(158, 'Paita', 20, 241, 1, 0),
(159, 'Piura', 20, 241, 1, 0),
(160, 'Secure', 20, 241, 1, 0),
(161, 'Sullana', 20, 241, 1, 0),
(162, 'Talara', 20, 241, 1, 0),
(163, 'Azángaro', 21, 241, 1, 0),
(164, 'Carabaya', 21, 241, 1, 0),
(165, 'Chucuito', 21, 241, 1, 0),
(166, 'El Collao', 21, 241, 1, 0),
(167, 'Huacané', 21, 241, 1, 0),
(168, 'Lampa', 21, 241, 1, 0),
(169, 'Melgar', 21, 241, 1, 0),
(170, 'Moho', 21, 241, 1, 0),
(171, 'Puno', 21, 241, 1, 0),
(172, 'San Antonio de Putiña', 21, 241, 1, 0),
(173, 'San Román', 21, 241, 1, 0),
(174, 'Sandía', 21, 241, 1, 0),
(175, 'Yunguyo', 21, 241, 1, 0),
(176, 'Bellavista', 22, 241, 1, 0),
(177, 'El Dorado', 22, 241, 1, 0),
(178, 'Huallaga', 22, 241, 1, 0),
(179, 'Lamas', 22, 241, 1, 0),
(180, 'Mariscal Cáceres', 22, 241, 1, 0),
(181, 'Moyobamba', 22, 241, 1, 0),
(182, 'Picota', 22, 241, 1, 0),
(183, 'Rioja', 22, 241, 1, 0),
(184, 'San Martín', 22, 241, 1, 0),
(185, 'Tocache', 22, 241, 1, 0),
(186, 'Candarave', 23, 241, 1, 0),
(187, 'Jorge Basadre', 23, 241, 1, 0),
(188, 'Tacna', 23, 241, 1, 0),
(189, 'Tarata', 23, 241, 1, 0),
(190, 'Contralmirante Villar', 24, 241, 1, 0),
(191, 'Tumbes', 24, 241, 1, 0),
(192, 'Zarumilla', 24, 241, 1, 0),
(193, 'Atalaya', 25, 241, 1, 0),
(194, 'Coronel Portillo', 25, 241, 1, 0),
(195, 'Padre Abad', 25, 241, 1, 0),
(196, 'Purús', 25, 241, 1, 0),
(215, 'Valencia', 28, 231, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depts`
--

DROP TABLE IF EXISTS `depts`;
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

DROP TABLE IF EXISTS `distrito`;
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
(1, 'Bagua', 241, 1, 1, 1, 0),
(2, 'Jumbilla', 241, 1, 2, 1, 0),
(3, 'Chachapoyas', 241, 1, 3, 1, 0),
(4, 'Santa María Nieva', 241, 1, 4, 1, 0),
(5, 'Lamud', 241, 1, 5, 1, 0),
(6, 'Mendoza', 241, 1, 6, 1, 0),
(7, 'Bagua Grande', 241, 1, 7, 1, 0),
(8, 'Aija', 241, 2, 8, 1, 0),
(9, 'Llamellín', 241, 2, 9, 1, 0),
(10, 'Chacas', 241, 2, 10, 1, 0),
(11, 'Chiquián', 241, 2, 11, 1, 0),
(12, 'Carhuaz', 241, 2, 12, 1, 0),
(13, 'San Luis', 241, 2, 13, 1, 0),
(14, 'Casma', 241, 2, 14, 1, 0),
(15, 'Corongo', 241, 2, 15, 1, 0),
(16, 'Huaraz', 241, 2, 16, 1, 0),
(17, 'Huari', 241, 2, 17, 1, 0),
(18, 'Huarmey', 241, 2, 18, 1, 0),
(19, 'Caras', 241, 2, 19, 1, 0),
(20, 'Piscobamba', 241, 2, 20, 1, 0),
(21, 'Ocros', 241, 2, 21, 1, 0),
(22, 'Cabana', 241, 2, 22, 1, 0),
(23, 'Pomabamba', 241, 2, 23, 1, 0),
(24, 'Recuay', 241, 2, 24, 1, 0),
(25, 'Chimbo', 241, 2, 25, 1, 0),
(26, 'Sihuas', 241, 2, 26, 1, 0),
(27, 'Yungay', 241, 2, 27, 1, 0),
(28, 'Abancay', 241, 3, 28, 1, 0),
(29, 'Andahuaylas', 241, 3, 29, 1, 0),
(30, 'Antabamba', 241, 3, 30, 1, 0),
(31, 'Chalhuanca', 241, 3, 31, 1, 0),
(32, 'Chincheros', 241, 3, 32, 1, 0),
(33, 'Tambobamba', 241, 3, 33, 1, 0),
(34, 'Chuquibambilla', 241, 3, 34, 1, 0),
(35, 'Arequipa', 241, 4, 35, 1, 0),
(36, 'Camaná', 241, 4, 36, 1, 0),
(37, 'Caraveli', 241, 4, 37, 1, 0),
(38, 'Aplao', 241, 4, 38, 1, 0),
(39, 'Chivay', 241, 4, 39, 1, 0),
(40, 'Chuquibamba', 241, 4, 40, 1, 0),
(41, 'Mollendo', 241, 4, 41, 1, 0),
(42, 'Cotahuasi', 241, 4, 42, 1, 0),
(43, 'Cangallo', 241, 5, 43, 1, 0),
(44, 'Ayacucho', 241, 5, 44, 1, 0),
(45, 'Huancasancos', 241, 5, 45, 1, 0),
(46, 'Huanta', 241, 5, 46, 1, 0),
(47, 'San Miguel', 241, 5, 47, 1, 0),
(48, 'Puquio', 241, 5, 48, 1, 0),
(49, 'Coracora', 241, 5, 49, 1, 0),
(50, 'Pauza', 241, 5, 50, 1, 0),
(51, 'Querobamba', 241, 5, 51, 1, 0),
(52, 'Huancapi', 241, 5, 52, 1, 0),
(53, 'Vilcashuamán', 241, 5, 53, 1, 0),
(54, 'Cajabamba', 241, 6, 54, 1, 0),
(55, 'Cajamarca', 241, 6, 55, 1, 0),
(56, 'Celendín', 241, 6, 56, 1, 0),
(57, 'Chota', 241, 6, 57, 1, 0),
(58, 'Contumazá', 241, 6, 58, 1, 0),
(59, 'Cutervo', 241, 6, 59, 1, 0),
(60, 'Bambamarca', 241, 6, 60, 1, 0),
(61, 'Jaén', 241, 6, 61, 1, 0),
(62, 'San Ignacio', 241, 6, 62, 1, 0),
(63, 'San marcos (Pedro Gálvez)', 241, 6, 63, 1, 0),
(64, 'San Miguel de Pallaques', 241, 6, 64, 1, 0),
(65, 'San Pablo', 241, 6, 65, 1, 0),
(66, 'Santa Cruz de Succhabamba', 241, 6, 66, 1, 0),
(67, 'Callao', 241, 7, 67, 1, 0),
(68, 'Acomayo', 241, 8, 68, 1, 0),
(69, 'Anta', 241, 8, 69, 1, 0),
(70, 'Calca', 241, 8, 70, 1, 0),
(71, 'Yanaoca', 241, 8, 71, 1, 0),
(72, 'Sicuani', 241, 8, 72, 1, 0),
(73, 'Santo Tomás', 241, 8, 73, 1, 0),
(74, 'Cusco', 241, 8, 74, 1, 0),
(75, 'Yauri (Espinar)', 241, 8, 75, 1, 0),
(76, 'Quillabamba', 241, 8, 76, 1, 0),
(77, 'Paruro', 241, 8, 77, 1, 0),
(78, 'Paucartambo', 241, 8, 78, 1, 0),
(79, 'Urcos', 241, 8, 79, 1, 0),
(80, 'Urubamba', 241, 8, 80, 1, 0),
(81, 'Acobamba', 241, 9, 81, 1, 0),
(82, 'Lircay', 241, 9, 82, 1, 0),
(83, 'Castrovirreyna', 241, 9, 83, 1, 0),
(84, 'Churcampa', 241, 9, 84, 1, 0),
(85, 'Huancavelica', 241, 9, 85, 1, 0),
(86, 'Huaytará', 241, 9, 86, 1, 0),
(87, 'Pampas', 241, 9, 87, 1, 0),
(88, 'Ambo', 241, 10, 88, 1, 0),
(89, 'La Unión', 241, 10, 89, 1, 0),
(90, 'Huacaybamba', 241, 10, 90, 1, 0),
(91, 'Llata', 241, 10, 91, 1, 0),
(92, 'Huánuco', 241, 10, 92, 1, 0),
(93, 'Jesús', 241, 10, 93, 1, 0),
(94, 'Tingo María', 241, 10, 94, 1, 0),
(95, 'Huacrachuco', 241, 10, 95, 1, 0),
(96, 'Panao', 241, 10, 96, 1, 0),
(97, 'Puerto Inca', 241, 10, 97, 1, 0),
(98, 'Chavinillo', 241, 10, 98, 1, 0),
(99, 'Chincha Alta', 241, 11, 99, 1, 0),
(100, 'Ica', 241, 11, 100, 1, 0),
(101, 'Nazca', 241, 11, 101, 1, 0),
(102, 'Palpa', 241, 11, 102, 1, 0),
(103, 'Pisco', 241, 11, 103, 1, 0),
(104, 'La Merced', 241, 12, 104, 1, 0),
(105, 'Chupaca', 241, 12, 105, 1, 0),
(106, 'Concepción', 241, 12, 106, 1, 0),
(107, 'Huancayo', 241, 12, 107, 1, 0),
(108, 'Jauja', 241, 12, 108, 1, 0),
(109, 'Junín', 241, 12, 109, 1, 0),
(110, 'Satipo', 241, 12, 110, 1, 0),
(111, 'Tarma', 241, 12, 111, 1, 0),
(112, 'La Oroya', 241, 12, 112, 1, 0),
(113, 'Ascope', 241, 13, 113, 1, 0),
(114, 'Bolívar', 241, 13, 114, 1, 0),
(115, 'Chepén', 241, 13, 115, 1, 0),
(116, 'Cascas', 241, 13, 116, 1, 0),
(117, 'Julcán', 241, 13, 117, 1, 0),
(118, 'Otuzco', 241, 13, 118, 1, 0),
(119, 'San Pedro de Lloc', 241, 13, 119, 1, 0),
(120, 'Tayabamba', 241, 13, 120, 1, 0),
(121, 'Huamachuco', 241, 13, 121, 1, 0),
(122, 'Santiago de Chuco', 241, 13, 122, 1, 0),
(123, 'Trujillo', 241, 13, 123, 1, 0),
(124, 'Virú', 241, 13, 124, 1, 0),
(125, 'Chiclayo', 241, 14, 125, 1, 0),
(126, 'Ferreñafe', 241, 14, 126, 1, 0),
(127, 'Lambayeque', 241, 14, 127, 1, 0),
(128, 'Barranca', 241, 15, 128, 1, 0),
(129, 'Cajatambo', 241, 15, 129, 1, 0),
(130, 'Canta', 241, 15, 130, 1, 0),
(131, 'San Vicente de Cañete', 241, 15, 131, 1, 0),
(132, 'Huaral', 241, 15, 132, 1, 0),
(133, 'Matucana', 241, 15, 133, 1, 0),
(134, 'Huacho', 241, 15, 134, 1, 0),
(135, 'Lima', 241, 15, 135, 1, 0),
(136, 'Oyón', 241, 15, 136, 1, 0),
(137, 'Yauyos', 241, 15, 137, 1, 0),
(138, 'Yurimaguas', 241, 16, 138, 1, 0),
(139, 'San Lorenzo', 241, 16, 139, 1, 0),
(140, 'Nauta', 241, 16, 140, 1, 0),
(141, 'Caballococha', 241, 16, 141, 1, 0),
(142, 'Iquitos', 241, 16, 142, 1, 0),
(143, 'San Antonio del Estrecho', 241, 16, 143, 1, 0),
(144, 'Requena', 241, 16, 144, 1, 0),
(145, 'Contamana', 241, 16, 145, 1, 0),
(146, 'Salvación', 241, 17, 146, 1, 0),
(147, 'Iñapari', 241, 17, 147, 1, 0),
(148, 'Puerto Maldonado', 241, 17, 148, 1, 0),
(149, 'Omate', 241, 18, 149, 1, 0),
(150, 'Ilo', 241, 18, 150, 1, 0),
(151, 'Moquegua', 241, 18, 151, 1, 0),
(152, 'Yanahuanca', 241, 19, 152, 1, 0),
(153, 'Oxapampa', 241, 19, 153, 1, 0),
(154, 'Cerro de Pasco', 241, 19, 154, 1, 0),
(155, 'Ayabaca', 241, 20, 155, 1, 0),
(156, 'Huancabamba', 241, 20, 156, 1, 0),
(157, 'Chulucanas', 241, 20, 157, 1, 0),
(158, 'Paita', 241, 20, 158, 1, 0),
(159, 'Piura', 241, 20, 159, 1, 0),
(160, 'Sechura', 241, 20, 160, 1, 0),
(161, 'Sullana', 241, 20, 161, 1, 0),
(162, 'Talara', 241, 20, 162, 1, 0),
(163, 'Azángaro', 241, 21, 163, 1, 0),
(164, 'Macusani', 241, 21, 164, 1, 0),
(165, 'Juli', 241, 21, 165, 1, 0),
(166, 'Ilave', 241, 21, 166, 1, 0),
(167, 'Huancané', 241, 21, 167, 1, 0),
(168, 'Lampa', 241, 21, 168, 1, 0),
(169, 'Ayaviri', 241, 21, 169, 1, 0),
(170, 'Moho', 241, 21, 170, 1, 0),
(171, 'Puno', 241, 21, 171, 1, 0),
(172, 'Putina', 241, 21, 172, 1, 0),
(173, 'Juliaca', 241, 21, 173, 1, 0),
(174, 'Sandia', 241, 21, 174, 1, 0),
(175, 'Yunguyo', 241, 21, 175, 1, 0),
(176, 'Bellavista', 241, 22, 176, 1, 0),
(177, 'San José de Sisa', 241, 22, 177, 1, 0),
(178, 'Saposoa', 241, 22, 178, 1, 0),
(179, 'Lamas', 241, 22, 179, 1, 0),
(180, 'Juanjuí', 241, 22, 180, 1, 0),
(181, 'Moyobamba', 241, 22, 181, 1, 0),
(182, 'Picota', 241, 22, 182, 1, 0),
(183, 'Rioja', 241, 22, 183, 1, 0),
(184, 'Tarapoto', 241, 22, 184, 1, 0),
(185, 'Tocache', 241, 22, 185, 1, 0),
(186, 'Candarave', 241, 23, 186, 1, 0),
(187, 'Locumba', 241, 23, 187, 1, 0),
(188, 'Tacna', 241, 23, 188, 1, 0),
(189, 'Tarata', 241, 23, 189, 1, 0),
(190, 'Zorritos', 241, 24, 190, 1, 0),
(191, 'Tumbes', 241, 24, 191, 1, 0),
(192, 'Zarumilla', 241, 24, 192, 1, 0),
(193, 'Atalaya', 241, 25, 193, 1, 0),
(194, 'Pucallpa', 241, 25, 194, 1, 0),
(195, 'Aguaytía', 241, 25, 195, 1, 0),
(196, 'Puerto Esperanza', 241, 25, 196, 1, 0),
(206, 'San Jose', 231, 28, 215, 1, 0),
(213, 'Candelaria', 231, 28, 215, 1, 0),
(215, 'Rafael Urdaneta', 231, 28, 215, 1, 0),
(216, 'Miguel Peña', 231, 28, 215, 1, 0);

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
-- Estructura de tabla para la tabla `lista_precios`
--

DROP TABLE IF EXISTS `lista_precios`;
CREATE TABLE `lista_precios` (
  `id_lista` int(11) NOT NULL COMMENT 'ID UNICO',
  `tipo_lista` int(11) NOT NULL DEFAULT '0' COMMENT 'TIPO DE LISTA DE PRECIO',
  `prod_lista` int(11) NOT NULL DEFAULT '0' COMMENT 'PRODUCTO LISTA',
  `precio_lista` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'PRECIO LISTA',
  `sucursal_lista` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL LISTA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA LISTAS DE PRECIOS';

--
-- Volcado de datos para la tabla `lista_precios`
--

INSERT INTO `lista_precios` (`id_lista`, `tipo_lista`, `prod_lista`, `precio_lista`, `sucursal_lista`) VALUES
(8, 1, 4, '24.00', 0),
(9, 2, 3, '40.00', 0),
(10, 1, 6, '90.00', 0),
(12, 1, 5, '24.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
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

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1556917839),
('m140506_102106_rbac_init', 1556918256),
('m140602_111327_create_menu_table', 1556917845),
('m160312_050000_create_user', 1556917845),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1556918256),
('m180523_151638_rbac_updates_indexes_without_prefix', 1556918257);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

DROP TABLE IF EXISTS `moneda`;
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
(1, 'Soles', 'N', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
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
(1, 'AND', 'Andorra', 1, 0),
(2, 'ARE', 'Emiratos Árabes Unidos', 1, 0),
(3, 'AFG', 'Afganistán', 1, 0),
(4, 'ATG', 'Antigua y Barbuda', 1, 0),
(5, 'AIA', 'Anguila', 1, 0),
(6, 'ALB', 'Albania', 1, 0),
(7, 'ARM', 'Armenia', 1, 0),
(8, 'ANT', 'Antillas Neerlandesas', 1, 0),
(9, 'AGO', 'Angola', 1, 0),
(10, 'ATA', 'Antártida', 1, 0),
(11, 'ARG', 'Argentina', 1, 0),
(12, 'ASM', 'Samoa Americana', 1, 0),
(13, 'AUT', 'Austria', 1, 0),
(14, 'AUS', 'Australia', 1, 0),
(15, 'ABW', 'Aruba', 1, 0),
(16, 'ALA', 'Islas Áland', 1, 0),
(17, 'AZE', 'Azerbaiyán', 1, 0),
(18, 'BIH', 'Bosnia y Herzegovina', 1, 0),
(19, 'BRB', 'Barbados', 1, 0),
(20, 'BGD', 'Bangladesh', 1, 0),
(21, 'BEL', 'Bélgica', 1, 0),
(22, 'BFA', 'Burkina Faso', 1, 0),
(23, 'BGR', 'Bulgaria', 1, 0),
(24, 'BHR', 'Bahréin', 1, 0),
(25, 'BDI', 'Burundi', 1, 0),
(26, 'BEN', 'Benin', 1, 0),
(27, 'BLM', 'San Bartolomé', 1, 0),
(28, 'BMU', 'Bermudas', 1, 0),
(29, 'BRN', 'Brunéi', 1, 0),
(30, 'BOL', 'Bolivia', 1, 0),
(31, 'BRA', 'Brasil', 1, 0),
(32, 'BHS', 'Bahamas', 1, 0),
(33, 'BTN', 'Bhután', 1, 0),
(34, 'BVT', 'Isla Bouvet', 1, 0),
(35, 'BWA', 'Botsuana', 1, 0),
(36, 'BLR', 'Belarús', 1, 0),
(37, 'BLZ', 'Belice', 1, 0),
(38, 'CAN', 'Canadá', 1, 0),
(39, 'CCK', 'Islas Cocos', 1, 0),
(40, 'CAF', 'República Centro-Africana', 1, 0),
(41, 'COG', 'Congo', 1, 0),
(42, 'CHE', 'Suiza', 1, 0),
(43, 'CIV', 'Costa de Marfil', 1, 0),
(44, 'COK', 'Islas Cook', 1, 0),
(45, 'CHL', 'Chile', 1, 0),
(46, 'CMR', 'Camerún', 1, 0),
(47, 'CHN', 'China', 1, 0),
(48, 'COL', 'Colombia', 1, 0),
(49, 'CRI', 'Costa Rica', 1, 0),
(50, 'CUB', 'Cuba', 1, 0),
(51, 'CPV', 'Cabo Verde', 1, 0),
(52, 'CXR', 'Islas Christmas', 1, 0),
(53, 'CYP', 'Chipre', 1, 0),
(54, 'CZE', 'República Checa', 1, 0),
(55, 'DEU', 'Alemania', 1, 0),
(56, 'DJI', 'Yibuti', 1, 0),
(57, 'DNK', 'Dinamarca', 1, 0),
(58, 'DMA', 'Domínica', 1, 0),
(59, 'DOM', 'República Dominicana', 1, 0),
(60, 'DZA', 'Argel', 1, 0),
(61, 'ECU', 'Ecuador', 1, 0),
(62, 'EST', 'Estonia', 1, 0),
(63, 'EGY', 'Egipto', 1, 0),
(64, 'ESH', 'Sahara Occidental', 1, 0),
(65, 'ERI', 'Eritrea', 1, 0),
(66, 'ESP', 'España', 1, 0),
(67, 'ETH', 'Etiopía', 1, 0),
(68, 'FIN', 'Finlandia', 1, 0),
(69, 'FJI', 'Fiji', 1, 0),
(70, 'KLK', 'Islas Malvinas', 1, 0),
(71, 'FSM', 'Micronesia', 1, 0),
(72, 'FRO', 'Islas Faroe', 1, 0),
(73, 'FRA', 'Francia', 1, 0),
(74, 'GAB', 'Gabón', 1, 0),
(75, 'GBR', 'Reino Unido', 1, 0),
(76, 'GRD', 'Granada', 1, 0),
(77, 'GEO', 'Georgia', 1, 0),
(78, 'GUF', 'Guayana Francesa', 1, 0),
(79, 'GGY', 'Guernsey', 1, 0),
(80, 'GHA', 'Ghana', 1, 0),
(81, 'GIB', 'Gibraltar', 1, 0),
(82, 'GRL', 'Groenlandia', 1, 0),
(83, 'GMB', 'Gambia', 1, 0),
(84, 'GIN', 'Guinea', 1, 0),
(85, 'GLP', 'Guadalupe', 1, 0),
(86, 'GNQ', 'Guinea Ecuatorial', 1, 0),
(87, 'GRC', 'Grecia', 1, 0),
(88, 'SGS', 'Georgia del Sur e Islas Sandwich del Sur', 1, 0),
(89, 'GTM', 'Guatemala', 1, 0),
(90, 'GUM', 'Guam', 1, 0),
(91, 'GNB', 'Guinea-Bissau', 1, 0),
(92, 'GUY', 'Guayana', 1, 0),
(93, 'HKG', 'Hong Kong', 1, 0),
(94, 'HMD', 'Islas Heard y McDonald', 1, 0),
(95, 'HND', 'Honduras', 1, 0),
(96, 'HRV', 'Croacia', 1, 0),
(97, 'HTI', 'Haití', 1, 0),
(98, 'HUN', 'Hungría', 1, 0),
(99, 'IDN', 'Indonesia', 1, 0),
(100, 'IRL', 'Irlanda', 1, 0),
(101, 'ISR', 'Israel', 1, 0),
(102, 'IMN', 'Isla de Man', 1, 0),
(103, 'IND', 'India', 1, 0),
(104, 'IOT', 'Territorio Británico del Océano Índico', 1, 0),
(105, 'IRQ', 'Irak', 1, 0),
(106, 'IRN', 'Irán', 1, 0),
(107, 'ISL', 'Islandia', 1, 0),
(108, 'ITA', 'Italia', 1, 0),
(109, 'JEY', 'Jersey', 1, 0),
(110, 'JAM', 'Jamaica', 1, 0),
(111, 'JOR', 'Jordania', 1, 0),
(112, 'JPN', 'Japón', 1, 0),
(113, 'KEN', 'Kenia', 1, 0),
(114, 'KGZ', 'Kirguistán', 1, 0),
(115, 'KHM', 'Camboya', 1, 0),
(116, 'KIR', 'Kiribati', 1, 0),
(117, 'COM', 'Comoros', 1, 0),
(118, 'KNA', 'San Cristóbal y Nieves', 1, 0),
(119, 'PRK', 'Corea del Norte', 1, 0),
(120, 'KOR', 'Corea del Sur', 1, 0),
(121, 'KWT', 'Kuwait', 1, 0),
(122, 'CYM', 'Islas Caimán', 1, 0),
(123, 'KAZ', 'Kazajstán', 1, 0),
(124, 'LAO', 'Laos', 1, 0),
(125, 'LBN', 'Líbano', 1, 0),
(126, 'LCA', 'Santa Lucía', 1, 0),
(127, 'LIE', 'Liechtenstein', 1, 0),
(128, 'LKA', 'Sri Lanka', 1, 0),
(129, 'LBR', 'Liberia', 1, 0),
(130, 'LSO', 'Lesotho', 1, 0),
(131, 'LTU', 'Lituania', 1, 0),
(132, 'LUX', 'Luxemburgo', 1, 0),
(133, 'LVA', 'Letonia', 1, 0),
(134, 'LBY', 'Libia', 1, 0),
(135, 'MAR', 'Marruecos', 1, 0),
(136, 'MCO', 'Mónaco', 1, 0),
(137, 'MDA', 'Moldova', 1, 0),
(138, 'MNE', 'Montenegro', 1, 0),
(139, 'MDG', 'Madagascar', 1, 0),
(140, 'MHL', 'Islas Marshall', 1, 0),
(141, 'MKD', 'Macedonia', 1, 0),
(142, 'MLI', 'Mali', 1, 0),
(143, 'MMR', 'Myanmar', 1, 0),
(144, 'MNG', 'Mongolia', 1, 0),
(145, 'MAC', 'Macao', 1, 0),
(146, 'MTQ', 'Martinica', 1, 0),
(147, 'MRT', 'Mauritania', 1, 0),
(148, 'MSR', 'Montserrat', 1, 0),
(149, 'MLT', 'Malta', 1, 0),
(150, 'MUS', 'Mauricio', 1, 0),
(151, 'MDV', 'Maldivas', 1, 0),
(152, 'MWI', 'Malawi', 1, 0),
(153, 'MEX', 'México', 1, 0),
(154, 'MYS', 'Malasia', 1, 0),
(155, 'MOZ', 'Mozambique', 1, 0),
(156, 'NAM', 'Namibia', 1, 0),
(157, 'NCL', 'Nueva Caledonia', 1, 0),
(158, 'NER', 'Níger', 1, 0),
(159, 'NFK', 'Islas Norkfolk', 1, 0),
(160, 'NGA', 'Nigeria', 1, 0),
(161, 'NIC', 'Nicaragua', 1, 0),
(162, 'NLD', 'Países Bajos', 1, 0),
(163, 'NOR', 'Noruega', 1, 0),
(164, 'NPL', 'Nepal', 1, 0),
(165, 'NRU', 'Nauru', 1, 0),
(166, 'NIU', 'Niue', 1, 0),
(167, 'NZL', 'Nueva Zelanda', 1, 0),
(168, 'OMN', 'Omán', 1, 0),
(169, 'PAN', 'Panamá', 1, 0),
(171, 'PYF', 'Polinesia Francesa', 1, 0),
(172, 'PNG', 'Papúa Nueva Guinea', 1, 0),
(173, 'PHL', 'Filipinas', 1, 0),
(174, 'PAK', 'Pakistán', 1, 0),
(175, 'POL', 'Polonia', 1, 0),
(176, 'SPM', 'San Pedro y Miquelón', 1, 0),
(177, 'PCN', 'Islas Pitcairn', 1, 0),
(178, 'PRI', 'Puerto Rico', 1, 0),
(179, 'PSE', 'Palestina', 1, 0),
(180, 'PRT', 'Portugal', 1, 0),
(181, 'PLW', 'Islas Palaos', 1, 0),
(182, 'PRY', 'Paraguay', 1, 0),
(183, 'QAT', 'Qatar', 1, 0),
(184, 'REU', 'Reunión', 1, 0),
(185, 'ROU', 'Rumanía', 1, 0),
(186, 'SRB', 'Serbia y Montenegro', 1, 0),
(187, 'RUS', 'Rusia', 1, 0),
(188, 'RWA', 'Ruanda', 1, 0),
(189, 'SAU', 'Arabia Saudita', 1, 0),
(190, 'SLB', 'Islas Solomón', 1, 0),
(191, 'SYC', 'Seychelles', 1, 0),
(192, 'SDN', 'Sudán', 1, 0),
(193, 'SWE', 'Suecia', 1, 0),
(194, 'SGP', 'Singapur', 1, 0),
(195, 'SHN', 'Santa Elena', 1, 0),
(196, 'SVN', 'Eslovenia', 1, 0),
(197, 'SJM', 'Islas Svalbard y Jan Mayen', 1, 0),
(198, 'SVK', 'Eslovaquia', 1, 0),
(199, 'SLE', 'Sierra Leona', 1, 0),
(200, 'SMR', 'San Marino', 1, 0),
(201, 'SEN', 'Senegal', 1, 0),
(202, 'SOM', 'Somalia', 1, 0),
(203, 'SUR', 'Surinam', 1, 0),
(204, 'STP', 'Santo Tomé y Príncipe', 1, 0),
(205, 'SLV', 'El Salvador', 1, 0),
(206, 'SYR', 'Siria', 1, 0),
(207, 'SWZ', 'Suazilandia', 1, 0),
(208, 'TCA', 'Islas Turcas y Caicos', 1, 0),
(209, 'TCD', 'Chad', 1, 0),
(210, 'ATF', 'Territorios Australes Franceses', 1, 0),
(211, 'TGO', 'Togo', 1, 0),
(212, 'THA', 'Tailandia', 1, 0),
(213, 'TZA', 'Tanzania', 1, 0),
(214, 'TJK', 'Tayikistán', 1, 0),
(215, 'TKL', 'Tokelau', 1, 0),
(216, 'TLS', 'Timor-Leste', 1, 0),
(217, 'TKM', 'Turkmenistán', 1, 0),
(218, 'TUN', 'Túnez', 1, 0),
(219, 'TON', 'Tonga', 1, 0),
(220, 'TUR', 'Turquía', 1, 0),
(221, 'TTO', 'Trinidad y Tobago', 1, 0),
(222, 'TUV', 'Tuvalu', 1, 0),
(223, 'TWN', 'Taiwán', 1, 0),
(224, 'UKR', 'Ucrania', 1, 0),
(225, 'UGA', 'Uganda', 1, 0),
(226, 'USA', 'Estados Unidos de América', 1, 0),
(227, 'URY', 'Uruguay', 1, 0),
(228, 'UZB', 'Uzbekistán', 1, 0),
(229, 'VAT', 'Ciudad del Vaticano', 1, 0),
(230, 'VCT', 'San Vicente y las Granadinas', 1, 0),
(231, 'VEN', 'Venezuela', 1, 0),
(232, 'VGB', 'Islas Vírgenes Británicas', 1, 0),
(233, 'VIR', 'Islas Vírgenes de los Estados Unidos de América', 1, 0),
(234, 'VNM', 'Vietnam', 1, 0),
(235, 'VUT', 'Vanuatu', 1, 0),
(236, 'WLF', 'Wallis y Futuna', 1, 0),
(237, 'WSM', 'Samoa', 1, 0),
(238, 'YEM', 'Yemen', 1, 0),
(239, 'MYT', 'Mayotte', 1, 0),
(240, 'ZAF', 'Sudáfrica', 1, 0),
(241, 'PER', 'Perú', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL COMMENT 'ID UNICO',
  `cod_pedido` varchar(7) NOT NULL COMMENT 'CODIGO PEDIDO',
  `fecha_pedido` date NOT NULL COMMENT 'FECHA PEDIDO',
  `clte_pedido` int(11) NOT NULL COMMENT 'CLIENTE PEDIDO',
  `vend_pedido` int(11) NOT NULL COMMENT 'VENDEDOR PEDIDO',
  `moneda_pedido` int(11) NOT NULL COMMENT 'MONEDA PEDIDO',
  `almacen_pedido` int(11) NOT NULL COMMENT 'ALMACEN PEDIDO',
  `usuario_pedido` int(11) NOT NULL COMMENT 'USUARIO PEDIDO',
  `estatus_pedido` int(11) NOT NULL DEFAULT '0' COMMENT 'ESTATUS PEDIDO',
  `sucursal_pedido` int(11) NOT NULL DEFAULT '0' COMMENT 'SUCURSAL PEDIDO',
  `condp_pedido` int(11) NOT NULL DEFAULT '0',
  `tipo_pedido` int(11) NOT NULL DEFAULT '0',
  `edicion_pedido` varchar(1) DEFAULT 'N',
  `nrodoc_pedido` varchar(25) DEFAULT NULL COMMENT 'NRO DOCUMENTO PEDIDO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA PEDIDOS';

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `cod_pedido`, `fecha_pedido`, `clte_pedido`, `vend_pedido`, `moneda_pedido`, `almacen_pedido`, `usuario_pedido`, `estatus_pedido`, `sucursal_pedido`, `condp_pedido`, `tipo_pedido`, `edicion_pedido`, `nrodoc_pedido`) VALUES
(20, '0000020', '2019-06-09', 3, 3, 1, 1, 1, 0, 0, 2, 0, 'N', ''),
(21, '0000021', '2019-06-09', 3, 3, 1, 1, 1, 0, 0, 2, 0, 'N', ''),
(22, '0000022', '2019-06-10', 3, 3, 1, 1, 1, 0, 0, 2, 0, 'N', ''),
(23, '0000023', '0000-00-00', 3, 3, 1, 1, 1, 0, 0, 2, 0, 'N', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

DROP TABLE IF EXISTS `pedido_detalle`;
CREATE TABLE `pedido_detalle` (
  `id_pdetalle` int(11) NOT NULL COMMENT 'ID UNICO',
  `prod_pdetalle` int(11) NOT NULL COMMENT 'PRODUCTO PEDIDO DETALLE',
  `cant_pdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'CANTIDAD PEDIDO DETALLE',
  `precio_pdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'PRECIO PEDIDO DETALLE',
  `descu_pdetalle` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'DESCUENTO % PEDIDO DETALLE',
  `impuesto_pdetalle` decimal(18,0) NOT NULL DEFAULT '0' COMMENT 'IMPUESTO PEDIDO DETALLE',
  `status_pdetalle` int(11) NOT NULL DEFAULT '1' COMMENT 'ESTATUS PEDIDO DETALLE',
  `pedido_pdetalle` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='GUARDA DETALLE DE PEDIDOS';

--
-- Volcado de datos para la tabla `pedido_detalle`
--

INSERT INTO `pedido_detalle` (`id_pdetalle`, `prod_pdetalle`, `cant_pdetalle`, `precio_pdetalle`, `descu_pdetalle`, `impuesto_pdetalle`, `status_pdetalle`, `pedido_pdetalle`) VALUES
(3, 5, '1.00', '24.00', '0.00', '18', 1, 20),
(4, 4, '1.00', '24.00', '0.00', '18', 1, 20),
(5, 6, '1.00', '90.00', '0.00', '18', 1, 20),
(6, 5, '1.00', '24.00', '0.00', '18', 1, 21),
(7, 4, '3.00', '22.80', '5.00', '18', 1, 22),
(8, 6, '2.00', '87.30', '3.00', '18', 1, 22),
(9, 5, '1.00', '23.16', '3.50', '18', 1, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
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
(3, 'CM02-PX20', 'MANDIL DE GUARDAFANGO DELANTERO TOYOTA PROBOX', 2, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0),
(4, 'CM-001R   ', 'PORTAFARO DELANTERO TOYOTA HIACE VAN 1993-1996       ', 10, 2, 1, 0, 0, 0, 0, 0, 0, 1, 0),
(5, 'CM-001L', 'PORTAFARO DELANTERO TOYOTA HIACE VAN 1993-1996       ', 10, 2, 1, 0, 0, 0, 0, 0, 0, 1, 0),
(6, 'CM01-TA1L', 'FARO DELANTERO TY.COROLLA ALTIS 2001-2004(BLANCO)', 3, 2, 1, 0, 1, 1, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
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
(1, '', '', 'pedro perez', 'asdasd', 231, 215, 28, 215, '', 2, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

DROP TABLE IF EXISTS `provincia`;
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
(1, 'AMAZONAS', 1, 0, 241),
(2, 'ANCASH', 1, 0, 241),
(3, 'APURIMAC', 1, 0, 241),
(4, 'AREQUIPA', 1, 0, 241),
(5, 'AYACUCHO', 1, 0, 241),
(6, 'CAJAMARCA', 1, 0, 241),
(7, 'CALLAO', 1, 0, 241),
(8, 'CUSCO', 1, 0, 241),
(9, 'HUANCAVELICA', 1, 0, 241),
(10, 'HUÁNUCO', 1, 0, 241),
(11, 'ICA', 1, 0, 241),
(12, 'JUNÍN', 1, 0, 241),
(13, 'LA LIBERTAD', 1, 0, 241),
(14, 'LAMBAYEQUE', 1, 0, 241),
(15, 'LIMA', 1, 0, 241),
(16, 'LORETO', 1, 0, 241),
(17, 'MADRE DE DIOS', 1, 0, 241),
(18, 'MOQUEGUA', 1, 0, 241),
(19, 'PASCO', 1, 0, 241),
(20, 'PIURA', 1, 0, 241),
(21, 'PUNO', 1, 0, 241),
(22, 'SAN MARTÍN', 1, 0, 241),
(23, 'TACNA', 1, 0, 241),
(24, 'TUMBES', 1, 0, 241),
(25, 'UCAYALI', 1, 0, 241),
(28, 'Carabobo', 1, 0, 231);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
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
(12, 'PRINCIPAL', 1, 1, '0.00'),
(16, 'SCUNDARIA', 1, 1, '0.00'),
(18, 'PRINCIPAL', 1, 1, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_listap`
--

DROP TABLE IF EXISTS `tipo_listap`;
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
(1, 'PRINCIPAL', 1, 0),
(2, 'SECUNDARIA', 1, 0);

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

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tpdcto`, `desc_tpdcto`, `status_tpdcto`, `sucursal_tpdcto`) VALUES
(2, 'MANDILES', 1, 0),
(3, 'FARO DELANTERO', 1, 0),
(4, 'FARO POSTERIOR', 1, 0),
(5, 'PARACHOQUE DELANTERO', 1, 0),
(6, 'PARACHOQUE TRASERO', 1, 0),
(7, 'MANIJA', 1, 0),
(8, 'FARO NEBLINERO', 1, 0),
(9, 'Parachoque posterior', 1, 0),
(10, 'PORTAFARO', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_proveedor`
--

DROP TABLE IF EXISTS `tipo_proveedor`;
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
(1, 'Importador', 1, NULL),
(2, 'Compra', 1, NULL),
(3, 'Servicios', 1, NULL),
(5, 'Honorarios profesionales', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

DROP TABLE IF EXISTS `unidad_medida`;
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
(1, 'SET', 1, 0),
(2, 'UNIDAD', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'cUrtRttA8-CFUsXs9JOyOyhkfPelFksC', '$2y$13$RxNqy7mh1WW8ZlI1kxpKm.RsbMPiMw9VYvzHbc2A4xFiVBj9rDgYG', NULL, 'admin@local.com', 10, 1556978558, 1556978558);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

DROP TABLE IF EXISTS `vendedor`;
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
(1, '', 'IRWIN PEREZ', '', 1, 0, 2),
(2, '', 'APP', '', 1, 0, 1),
(3, '', 'MELIN HUAMAN', '', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_productos`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_productos`;
CREATE TABLE `v_productos` (
`id_prod` int(11)
,`cod_prod` varchar(25)
,`des_prod` varchar(70)
,`texto` varchar(96)
,`sucursal_prod` int(11)
,`status_prod` int(11)
,`precio_lista` decimal(18,2)
,`tipo_lista` int(11)
);

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
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id_zona`, `nombre_zona`, `desc_zona`, `estatus_zona`, `sucursal_zona`) VALUES
(1, 'LIMA', 'LIMA, TODAS LAS ZONAS EXCEPTO LA CINCUENTA', 1, 0),
(2, 'LA CINCUENTA', 'LIMA -  LA CINCUENTA', 1, 0),
(3, 'PROVINCIA - NORTE', 'PROVINCIAS DEL NORTE', 1, 0),
(4, 'PROVINCIA - CENTRO', 'PROVINCIAS DEL CENTRO', 1, 0);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_productos`
--
DROP TABLE IF EXISTS `v_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_productos`  AS  select `producto`.`id_prod` AS `id_prod`,`producto`.`cod_prod` AS `cod_prod`,`producto`.`des_prod` AS `des_prod`,concat(`producto`.`cod_prod`,' ',`producto`.`des_prod`) AS `texto`,`producto`.`sucursal_prod` AS `sucursal_prod`,`producto`.`status_prod` AS `status_prod`,`lista_precios`.`precio_lista` AS `precio_lista`,`lista_precios`.`tipo_lista` AS `tipo_lista` from (`producto` join `lista_precios` on((`producto`.`id_prod` = `lista_precios`.`prod_lista`))) ;

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
  ADD UNIQUE KEY `cod_pedido` (`cod_pedido`),
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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_clte` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT de la tabla `lista_precios`
--
ALTER TABLE `lista_precios`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  MODIFY `id_pdetalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=7;

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
  MODIFY `id_suc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID UNICO', AUTO_INCREMENT=19;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
