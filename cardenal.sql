-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 10:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cardenal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cafe_final`
--

CREATE TABLE `cafe_final` (
  `id_cafe_final` int(11) NOT NULL,
  `idcafe_tostado` int(11) DEFAULT NULL,
  `cantidad_paquetes` int(11) DEFAULT NULL,
  `fecha_empaquetado` date DEFAULT NULL,
  `id_bulto` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cafe_final`
--

INSERT INTO `cafe_final` (`id_cafe_final`, `idcafe_tostado`, `cantidad_paquetes`, `fecha_empaquetado`, `id_bulto`, `estado`) VALUES
(315, 180, 37, '2024-01-26', 180, 1),
(316, 181, 37, '2024-01-28', 181, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cafe_tostado`
--

CREATE TABLE `cafe_tostado` (
  `idcafe_tostado` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `nivel_tostado` int(11) NOT NULL,
  `nivel_molido` int(11) NOT NULL,
  `estado` varchar(8) DEFAULT NULL,
  `fecha_tostado` date NOT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cafe_tostado`
--

INSERT INTO `cafe_tostado` (`idcafe_tostado`, `cantidad`, `nivel_tostado`, `nivel_molido`, `estado`, `fecha_tostado`, `usuario_idusuario`) VALUES
(177, 5, 2, 3, '0', '2024-01-26', 28150004),
(180, 5, 2, 3, '0', '2024-01-26', 28150004),
(181, 5, 2, 1, '0', '2024-01-28', 28150004);

--
-- Triggers `cafe_tostado`
--
DELIMITER $$
CREATE TRIGGER `restar_valor_total_cafe` AFTER INSERT ON `cafe_tostado` FOR EACH ROW BEGIN
    -- Restar el valor de cantidad al campo total de id_total_cafe 2 en total_cafe
    UPDATE total_cafe
    SET total = total - NEW.cantidad
    WHERE id_total_cafe = 1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `restar_valor_total_cafe_update` AFTER UPDATE ON `cafe_tostado` FOR EACH ROW BEGIN
    -- Obtener la diferencia entre el nuevo y viejo valor de cantidad
    DECLARE diferencia INT;
    SET diferencia = NEW.cantidad - OLD.cantidad;

    -- Restar la diferencia al campo total de id_total_cafe 2 en total_cafe
    UPDATE total_cafe
    SET total = total - diferencia
    WHERE id_total_cafe = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE `cargo` (
  `idcargo` int(11) NOT NULL,
  `nombre_cargo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`idcargo`, `nombre_cargo`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cedula_fiscal`
--

CREATE TABLE `cedula_fiscal` (
  `id_cedula_fiscal` int(11) NOT NULL,
  `cedula_fiscal` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cedula_fiscal`
--

INSERT INTO `cedula_fiscal` (`id_cedula_fiscal`, `cedula_fiscal`) VALUES
(1, 'V-'),
(2, 'J-'),
(3, 'G-'),
(4, 'C-'),
(5, 'E-'),
(6, 'P-');

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL,
  `fecha_compra` date DEFAULT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`idcompra`, `fecha_compra`, `proveedor_id_proveedor`, `usuario_idusuario`) VALUES
(199, '2024-04-28', 41, 28150004),
(209, '2024-01-28', 43, 28150004);

-- --------------------------------------------------------

--
-- Table structure for table `datos_prov`
--

CREATE TABLE `datos_prov` (
  `identificacion` int(11) NOT NULL,
  `nombre_prov` varchar(20) DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `cedula_fiscal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datos_prov`
--

INSERT INTO `datos_prov` (`identificacion`, `nombre_prov`, `telefono`, `cedula_fiscal_id`) VALUES
(1232413, 'adasasd', 213213, 4),
(15728175, 'Zoraimar Linárez', 2147483647, 1),
(22232558, 'OBG C.A.', 55, 1),
(28150004, 'Juan E Silva', 2147483647, 1),
(28329224, 'Rocio', 2147483647, 1),
(30623657, 'Paula Silva', 2147483647, 1),
(53637425, 'KENDRICK', 53637425, 3);

-- --------------------------------------------------------

--
-- Table structure for table `finca`
--

CREATE TABLE `finca` (
  `idfinca` int(11) NOT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `nombre_finca` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `parroquia` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finca`
--

INSERT INTO `finca` (`idfinca`, `ubicacion`, `nombre_finca`, `estado`, `municipio`, `parroquia`, `ciudad`) VALUES
(44, 'Cerro 2 cerca de la cruz', 'Finca Paula', 'Lara', 'Morán', 'Bolivar', 'El Tocuyo'),
(45, 'En mi casa', 'Juan Silva finca', 'Lara', 'Moran', 'Bolivar', 'El Tocuyo'),
(46, 'Subiendo por quebrada negra km 8', 'Finca Fernandez', 'Portuguesa', 'Unda', 'Quebrada Negra', 'Chabasquen'),
(47, 'Fila del Tigre', 'Rocio', 'Lara', 'Morán', 'Guarico', 'Guarico');

-- --------------------------------------------------------

--
-- Table structure for table `pregunta_s`
--

CREATE TABLE `pregunta_s` (
  `id_pregunta` int(11) NOT NULL,
  `pregunta` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pregunta_s`
--

INSERT INTO `pregunta_s` (`id_pregunta`, `pregunta`) VALUES
(1, 'Color favorito'),
(2, 'Ciudad donde naciste'),
(3, 'Comida favorita'),
(4, 'Fecha de nacimiento'),
(5, 'Lenguaje favorito');

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `id_prov` int(11) NOT NULL,
  `finca_idfinca` int(11) NOT NULL,
  `datos_prov_identificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`id_prov`, `finca_idfinca`, `datos_prov_identificacion`) VALUES
(40, 44, 30623657),
(41, 45, 28150004),
(42, 46, 15728175),
(43, 47, 28329224);

-- --------------------------------------------------------

--
-- Table structure for table `quintal`
--

CREATE TABLE `quintal` (
  `idquintal` int(11) NOT NULL,
  `calidad_idcalidad` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `estado` int(1) NOT NULL,
  `idcompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quintal`
--

INSERT INTO `quintal` (`idquintal`, `calidad_idcalidad`, `cantidad`, `estado`, `idcompra`) VALUES
(255, 1, 1, 0, 199),
(267, 1, 45, 0, 209),
(269, 2, 50, 0, 209);

-- --------------------------------------------------------

--
-- Table structure for table `total_cafe`
--

CREATE TABLE `total_cafe` (
  `id_total_cafe` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_cafe`
--

INSERT INTO `total_cafe` (`id_total_cafe`, `total`) VALUES
(1, 185),
(2, 0),
(3, 74);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `cargo_idcargo` int(11) NOT NULL,
  `id_pregunta_s` int(11) NOT NULL,
  `respuesta` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombres`, `apellidos`, `password`, `cargo_idcargo`, `id_pregunta_s`, `respuesta`) VALUES
(28150003, 'Juaner', 'Silva', '28150003', 1, 2, 'Barquisimeto'),
(28150004, 'Juan', 'Silva', '28150004', 2, 2, 'Barquisimeto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cafe_final`
--
ALTER TABLE `cafe_final`
  ADD PRIMARY KEY (`id_cafe_final`),
  ADD KEY `cafe_final_ibfk_1` (`idcafe_tostado`);

--
-- Indexes for table `cafe_tostado`
--
ALTER TABLE `cafe_tostado`
  ADD PRIMARY KEY (`idcafe_tostado`),
  ADD KEY `fk_usuario_cafe_tostado` (`usuario_idusuario`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idcargo`);

--
-- Indexes for table `cedula_fiscal`
--
ALTER TABLE `cedula_fiscal`
  ADD PRIMARY KEY (`id_cedula_fiscal`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD KEY `fk_compra_proveedor1_idx` (`proveedor_id_proveedor`),
  ADD KEY `fk_compra_usuario1_idx` (`usuario_idusuario`);

--
-- Indexes for table `datos_prov`
--
ALTER TABLE `datos_prov`
  ADD PRIMARY KEY (`identificacion`),
  ADD KEY `fk_datos_prov_cedula_fiscal` (`cedula_fiscal_id`);

--
-- Indexes for table `finca`
--
ALTER TABLE `finca`
  ADD PRIMARY KEY (`idfinca`);

--
-- Indexes for table `pregunta_s`
--
ALTER TABLE `pregunta_s`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_prov`),
  ADD KEY `fk_proveedor_finca_idx` (`finca_idfinca`),
  ADD KEY `fk_datos_prov_identificacion_idx` (`datos_prov_identificacion`);

--
-- Indexes for table `quintal`
--
ALTER TABLE `quintal`
  ADD PRIMARY KEY (`idquintal`),
  ADD KEY `fk_idcompra1` (`idcompra`);

--
-- Indexes for table `total_cafe`
--
ALTER TABLE `total_cafe`
  ADD PRIMARY KEY (`id_total_cafe`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_usuario_cargo1_idx` (`cargo_idcargo`),
  ADD KEY `fk_usuario_pregunta_s1` (`id_pregunta_s`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cafe_final`
--
ALTER TABLE `cafe_final`
  MODIFY `id_cafe_final` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `cafe_tostado`
--
ALTER TABLE `cafe_tostado`
  MODIFY `idcafe_tostado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idcargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cedula_fiscal`
--
ALTER TABLE `cedula_fiscal`
  MODIFY `id_cedula_fiscal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `datos_prov`
--
ALTER TABLE `datos_prov`
  MODIFY `identificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `finca`
--
ALTER TABLE `finca`
  MODIFY `idfinca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pregunta_s`
--
ALTER TABLE `pregunta_s`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `quintal`
--
ALTER TABLE `quintal`
  MODIFY `idquintal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `total_cafe`
--
ALTER TABLE `total_cafe`
  MODIFY `id_total_cafe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28329226;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cafe_final`
--
ALTER TABLE `cafe_final`
  ADD CONSTRAINT `cafe_final_ibfk_1` FOREIGN KEY (`idcafe_tostado`) REFERENCES `cafe_tostado` (`idcafe_tostado`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `cafe_tostado`
--
ALTER TABLE `cafe_tostado`
  ADD CONSTRAINT `fk_usuario_cafe_tostado` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_proveedor` FOREIGN KEY (`proveedor_id_proveedor`) REFERENCES `proveedor` (`id_prov`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_compra_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `datos_prov`
--
ALTER TABLE `datos_prov`
  ADD CONSTRAINT `fk_datos_prov_cedula_fiscal` FOREIGN KEY (`cedula_fiscal_id`) REFERENCES `cedula_fiscal` (`id_cedula_fiscal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_proveedor_datos_prov1` FOREIGN KEY (`datos_prov_identificacion`) REFERENCES `datos_prov` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proveedor_finca` FOREIGN KEY (`finca_idfinca`) REFERENCES `finca` (`idfinca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quintal`
--
ALTER TABLE `quintal`
  ADD CONSTRAINT `fk_idcompra1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_cargo1` FOREIGN KEY (`cargo_idcargo`) REFERENCES `cargo` (`idcargo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_pregunta_s1` FOREIGN KEY (`id_pregunta_s`) REFERENCES `pregunta_s` (`id_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
