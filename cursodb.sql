-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2016 at 05:24 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cursodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `id_aluno` int(22) unsigned NOT NULL AUTO_INCREMENT COMMENT 'chave primária de aluno',
  `nome` varchar(40) NOT NULL,
  `matricula` varchar(22) NOT NULL,
  `id_departamento` int(22) unsigned DEFAULT NULL,
  `idade` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_aluno`),
  UNIQUE KEY `matricula` (`matricula`),
  KEY `id_departamento` (`id_departamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome`, `matricula`, `id_departamento`, `idade`) VALUES
(1, 'Kung Lao!!!', '123456', 1, 18),
(2, 'Raiden', '123457', 1, 21),
(4, 'Sonya Blade', '123458', 1, 23),
(5, 'Subzero', '123459', 2, 30),
(6, 'Cage', '123450', NULL, 22),
(7, 'Cassie', '123499', NULL, 19),
(8, 'Jack', '123488', NULL, 20),
(9, 'Kung Jin', '123477', NULL, 20),
(10, 'Liu Kang', '123546', NULL, 26),
(16, 'Ryu', '1234577', NULL, 38),
(21, 'Ken', '123411', NULL, 38),
(28, 'Jaspion', '1234562', NULL, 41),
(40, 'Magayver', '123111', NULL, 47),
(44, 'Ms. Hulk', '4455555', NULL, 49),
(45, 'Bane', '7844', NULL, 66),
(46, 'Kamen Rider', '5118711', NULL, 26),
(47, 'Spider Man', '5236987', NULL, 22),
(48, 'Goku', '544111', NULL, 22),
(49, 'Rambo III', '44555', NULL, 55);

-- --------------------------------------------------------

--
-- Table structure for table `aluno_curso`
--

CREATE TABLE IF NOT EXISTS `aluno_curso` (
  `id_aluno` int(22) unsigned NOT NULL,
  `id_curso` int(22) unsigned NOT NULL,
  KEY `id_aluno` (`id_aluno`,`id_curso`),
  KEY `id_curso` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluno_curso`
--

INSERT INTO `aluno_curso` (`id_aluno`, `id_curso`) VALUES
(1, 2),
(2, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(22) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `descricao` text NOT NULL,
  `id_departamento` int(22) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `id_departamento` (`id_departamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`, `descricao`, `id_departamento`) VALUES
(2, 'Ciências da Computação', 'Bacharelado em Ciências da Computação', 1),
(3, 'Ciências Contábeis', 'Bacharelado em Ciências Contábeis', 3),
(4, 'Matemática', 'Bacharelado de Matemática', 3),
(5, 'Física', 'Bacharelado em Física', 3);

-- --------------------------------------------------------

--
-- Table structure for table `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(22) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nome`, `descricao`) VALUES
(1, 'Departamento de Informática', 'Departamento de Informática'),
(2, 'Departamento Contábil', 'Departamento de Ciências Contábeis'),
(3, 'Departamento de Exatas', 'Departamento repsonsável pelos cursos de exatas.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_departamento_fk` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`);

--
-- Constraints for table `aluno_curso`
--
ALTER TABLE `aluno_curso`
  ADD CONSTRAINT `aluno_curso_aluno_fk` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `aluno_curso_curso_fk` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_departamento_fk` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
