-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-09-2011 a las 03:53:45
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cz_devel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(180) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `activo`) VALUES
(1, 'bebidas', NULL, 1),
(2, 'electro3', '0sadf asdfsad', 1),
(3, 'limpieza', NULL, 1),
(4, 'abarrotes sss', 'asdas ', 0),
(5, 'linea blanca', NULL, 0),
(6, 'mascotas', NULL, 0),
(7, 'nueva cat', '0', 1),
(8, '   LKJASDHFKJ    ', '0', 1),
(9, 'iuiuiuiuoiuouoi', '0', 1),
(10, 'dsaffds', '0', 1),
(11, 'asdfas', '0', 1),
(12, 'sadfdsa', '0', 1),
(13, '11111111', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fabricante`
--

CREATE TABLE IF NOT EXISTS `fabricante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `fabricante`
--

INSERT INTO `fabricante` (`id`, `nombre`, `activo`) VALUES
(1, 'Fabricante 1', 1),
(2, 'Fabricante 2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_fabricante` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `id_categoria`, `id_fabricante`, `nombre`, `descripcion`, `precio`, `activo`) VALUES
(1, 1, 1, 'Laptop', 'la laptop', 1500, 1),
(2, 2, 3, 'monitor', 'monitor', 800, 1),
(3, 6, 1, 'iPod', 'ipod', 1200, 1),
(4, 5, 2, 'iPad', 'iPad', 3000, 0),
(5, 7, 1, 'NUEVO PROD', 'sdgasda sd', 100.5, 1);
