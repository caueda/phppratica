-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2016 at 03:39 PM
-- Server version: 10.0.23-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cursodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(22) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `idade` int(2) DEFAULT NULL,
  `id_departamento` int(22) DEFAULT NULL,
  `matricula` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome`, `idade`, `id_departamento`, `matricula`) VALUES
(1, 'João Soares', 18, 1, '001'),
(2, 'Maria Montanha', 24, 1, '002'),
(3, 'José Arruda', 30, 2, '004'),
(4, 'Bono Ueda', 1, 1, '004'),
(5, 'Maria das Graças', 21, 4, '005'),
(6, 'Lula ', 50, 3, '006'),
(7, 'Lula', 55, 4, '007'),
(8, 'Larisberto', 10, 3, '008');

-- --------------------------------------------------------

--
-- Table structure for table `aluno_curso`
--

CREATE TABLE `aluno_curso` (
  `id_aluno` int(22) DEFAULT NULL,
  `id_curso` int(22) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluno_curso`
--

INSERT INTO `aluno_curso` (`id_aluno`, `id_curso`, `data_cadastro`, `ativo`) VALUES
(1, 2, '2016-04-04 00:00:00', 0),
(2, 3, '2016-01-13 00:00:00', 1),
(3, 5, '2016-05-28 00:00:00', 1),
(5, 6, '2016-06-01 00:00:00', 0),
(7, 6, '2016-04-01 00:00:00', 0),
(1, 1, '2016-05-01 00:00:00', 1),
(4, 4, '2016-06-05 00:00:00', 0),
(8, 6, '2016-06-08 00:00:00', 1),
(4, 3, '2016-04-03 00:00:00', 1),
(5, 10, '2016-04-03 00:00:00', 1),
(7, 8, '2016-04-04 00:00:00', 1),
(6, 6, '2016-04-06 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(22) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `descricao` text,
  `id_departamento` int(22) DEFAULT NULL,
  `ANO` int(4) NOT NULL DEFAULT '2016',
  `ativo` int(1) DEFAULT '1',
  `valor` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`, `descricao`, `id_departamento`, `ANO`, `ativo`, `valor`) VALUES
(1, 'Projetos', 'Gerenciamento de Projetos', 1, 2016, 1, 20000),
(2, 'Desenvolvimento OO', 'Desenvolvimento Orientado a Objetos', 1, 2016, 1, 1555),
(3, 'Pedagogia', 'Curso de Pedagogia', 1, 2016, 1, 800),
(4, 'Java', 'Desenvolvimento Java', 2, 2016, 1, 3700),
(5, '5S', 'Curso de 5S', 2, 2016, 1, 10000),
(6, 'Segurança do Trabalho', 'Curso de Segurança do Trabalho', 3, 2016, 1, 500),
(7, 'Agronomia', 'Curso de Agronomia', 1, 2016, 1, 2500),
(8, 'Mecatrônica', 'Curso de mecatrônica', 4, 2016, 1, 1550),
(9, 'Física', 'Curso de Física', 4, 2016, 1, 2000),
(10, 'Matemática', 'Curso de Matemática', 4, 2016, 1, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(22) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `ativo` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nome`, `descricao`, `ativo`) VALUES
(1, 'EAD', 'Departamento responsável pelos cursos EAD MT.', 1),
(2, 'In Company', 'Depto responsável pelos cursos In Company', 1),
(3, 'Local', 'Depto responsável pelos cursos locais.', 1),
(4, 'Exatas', 'Departamento de Exatas.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `alunodepto_depto_fk` (`id_departamento`);

--
-- Indexes for table `aluno_curso`
--
ALTER TABLE `aluno_curso`
  ADD KEY `alunocurso_aluno_fk` (`id_aluno`),
  ADD KEY `alunocurso_curso_fk` (`id_curso`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `curso_departamento_fk` (`id_departamento`);

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_departamento_pk` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`);

--
-- Constraints for table `aluno_curso`
--
ALTER TABLE `aluno_curso`
  ADD CONSTRAINT `alunocurso_aluno_fk` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `alunocurso_curso_fk` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_departamento_fk` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
