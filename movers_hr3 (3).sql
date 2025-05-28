-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 04:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movers_hr3`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowed_locations`
--

CREATE TABLE `allowed_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allowed_locations`
--

INSERT INTO `allowed_locations` (`id`, `name`, `latitude`, `longitude`) VALUES
(1, 'Main Office', 14.59950000, 120.98420000),
(2, 'Warehouse', 14.60050000, 120.98300000),
(3, 'DEV AREA', 14.70709610, 121.00423800);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `mname`, `lname`, `department`, `created_at`) VALUES
(1, 'Juan', 'Dela', 'Cruz', 'IT', '2025-04-23 13:55:56'),
(2, 'Maria', 'sasd', 'Santos', 'HR', '2025-04-23 13:55:56'),
(3, 'Carlos', 'Reyes', 'Garcia', 'Operations', '2025-04-23 13:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `employees_hr1`
--

CREATE TABLE `employees_hr1` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `job_type` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees_hr1`
--

INSERT INTO `employees_hr1` (`id`, `first_name`, `last_name`, `email`, `department`, `position`, `bdate`, `job_type`, `gender`, `status`, `contact`, `created_at`, `updated_at`) VALUES
(4, 'Lourdes', 'Fernandez', 'lourdes.fernandez@company.com', 'Operations', 'Driver', '1986-08-18', 'Part-time', 'Female', 'active', '0937783677', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(5, 'Ricardo', 'Gutierrez', 'ricardo.gutierrez@company.com', 'Operations', 'Driver', '1981-11-30', 'Full-time', 'Male', 'active', '0941027659', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(6, 'Teresa', 'Castillo', 'teresa.castillo@company.com', 'Operations', 'Driver', '1984-02-14', 'Full-time', 'Female', 'active', '0933480184', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(7, 'Fernando', 'Ocampo', 'fernando.ocampo@company.com', 'Operations', 'Driver', '1982-07-22', 'Part-time', 'Male', 'active', '0944621185', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(8, 'Carmen', 'Reyes', 'carmen.reyes@company.com', 'Operations', 'Driver', '1988-04-05', 'Full-time', 'Female', 'active', '0976328603', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(9, 'Ramon', 'Aquino', 'ramon.aquino@company.com', 'Operations', 'Driver', '1980-09-17', 'Full-time', 'Male', 'active', '0939005071', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(10, 'Amalia', 'Cruz', 'amalia.cruz@company.com', 'Operations', 'Driver', '1989-12-03', 'Part-time', 'Female', 'active', '0995595882', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(11, 'Alfredo', 'Garcia', 'alfredo.garcia@company.com', 'Operations', 'Driver', '1983-06-28', 'Full-time', 'Male', 'active', '0988269265', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(12, 'Corazon', 'Lopez', 'corazon.lopez@company.com', 'Operations', 'Driver', '1987-01-19', 'Full-time', 'Female', 'active', '0952527852', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(13, 'Gregorio', 'Santos', 'gregorio.santos@company.com', 'Operations', 'Driver', '1981-03-08', 'Part-time', 'Male', 'active', '0961333604', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(14, 'Rosario', 'Mendoza', 'rosario.mendoza@company.com', 'Operations', 'Driver', '1985-10-25', 'Full-time', 'Female', 'active', '0963461282', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(15, 'Roberto', 'Sanchez', 'roberto.sanchez@company.com', 'Operations', 'Driver', '1984-07-14', 'Full-time', 'Male', 'active', '0919407518', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(16, 'Imelda', 'Torres', 'imelda.torres@company.com', 'Operations', 'Driver', '1986-05-30', 'Part-time', 'Female', 'active', '0927731209', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(17, 'Armando', 'Rivera', 'armando.rivera@company.com', 'Operations', 'Driver', '1982-11-11', 'Full-time', 'Male', 'active', '0992171747', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(18, 'Lydia', 'Gomez', 'lydia.gomez@company.com', 'Operations', 'Driver', '1988-08-22', 'Full-time', 'Female', 'active', '0953832627', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(19, 'Ernesto', 'Diaz', 'ernesto.diaz@company.com', 'Operations', 'Driver', '1980-04-17', 'Part-time', 'Male', 'active', '0922198800', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(20, 'Esperanza', 'Ramos', 'esperanza.ramos@company.com', 'Operations', 'Driver', '1987-09-09', 'Full-time', 'Female', 'active', '0928490245', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(21, 'Rodolfo', 'Alvarez', 'rodolfo.alvarez@company.com', 'Operations', 'Driver', '1983-12-24', 'Full-time', 'Male', 'active', '0910631337', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(22, 'Gloria', 'Romero', 'gloria.romero@company.com', 'Operations', 'Driver', '1985-02-28', 'Part-time', 'Female', 'active', '0997786436', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(23, 'Arturo', 'Chavez', 'arturo.chavez@company.com', 'Operations', 'Driver', '1981-06-13', 'Full-time', 'Male', 'active', '0918944255', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(24, 'Aurora', 'Ortega', 'aurora.ortega@company.com', 'Operations', 'Driver', '1989-03-07', 'Full-time', 'Female', 'active', '0939285688', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(25, 'Felipe', 'Del Rosario', 'felipe.delrosario@company.com', 'Operations', 'Driver', '1984-10-31', 'Part-time', 'Male', 'active', '0963338041', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(26, 'Beatriz', 'Navarro', 'beatriz.navarro@company.com', 'Operations', 'Driver', '1986-07-16', 'Full-time', 'Female', 'active', '0999827682', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(27, 'Victor', 'Salazar', 'victor.salazar@company.com', 'Operations', 'Driver', '1982-01-23', 'Full-time', 'Male', 'active', '0977652800', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(28, 'Consuelo', 'Villanueva', 'consuelo.villanueva@company.com', 'Operations', 'Driver', '1988-04-04', 'Part-time', 'Female', 'active', '0936969743', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(29, 'Hector', 'Castro', 'hector.castro@company.com', 'Operations', 'Driver', '1980-08-09', 'Full-time', 'Male', 'active', '0971641924', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(30, 'Rebecca', 'Pineda', 'rebecca.pineda@company.com', 'Operations', 'Driver', '1987-11-12', 'Full-time', 'Female', 'active', '0982729722', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(31, 'Carlos', 'Lim', 'carlos.lim@company.com', 'Operations', 'Driver', '1982-07-14', 'Full-time', 'Male', 'inactive', '0927299864', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(32, 'Lorna', 'Gonzales', 'lorna.gonzales@company.com', 'Operations', 'Driver', '1989-09-05', 'Part-time', 'Female', 'inactive', '0922663829', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(33, 'Raul', 'Martinez', 'raul.martinez@company.com', 'Operations', 'Driver', '1981-12-18', 'Full-time', 'Male', 'inactive', '0917859336', '2025-04-13 04:18:45', '2025-04-13 04:18:45'),
(34, 'Tessie', 'Salcedo', 'tessie.salcedo@company.com', 'Operations', 'Driver', '1984-03-27', 'Part-time', 'Female', 'inactive', '0989984048', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(35, 'Rogelio', 'Estrada', 'rogelio.estrada@company.com', 'Operations', 'Driver', '1983-05-30', 'Full-time', 'Male', 'inactive', '0966220602', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(36, 'Mercedes', 'Cordero', 'mercedes.cordero@company.com', 'Operations', 'Driver', '1986-08-11', 'Full-time', 'Female', 'inactive', '0956789661', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(37, 'Arnulfo', 'Galang', 'arnulfo.galang@company.com', 'Operations', 'Driver', '1980-01-25', 'Part-time', 'Male', 'inactive', '0986575433', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(38, 'Nenita', 'Barrera', 'nenita.barrera@company.com', 'Operations', 'Driver', '1985-06-19', 'Full-time', 'Female', 'inactive', '0996207241', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(39, 'Dominador', 'Tuazon', 'dominador.tuazon@company.com', 'Operations', 'Driver', '1987-10-08', 'Full-time', 'Male', 'inactive', '0950860935', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(40, 'Perla', 'Samson', 'perla.samson@company.com', 'Operations', 'Driver', '1982-02-14', 'Part-time', 'Female', 'inactive', '0917691842', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(41, 'Maria', 'Santos', 'maria.santos@company.com', 'HR', 'HR Manager', '1985-08-22', 'Full-time', 'Female', 'active', '0936188683', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(42, 'Luis', 'Garcia', 'luis.garcia@company.com', 'HR', 'Recruiter', '1990-04-15', 'Full-time', 'Male', 'active', '0990816049', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(43, 'Elena', 'Ramos', 'elena.ramos@company.com', 'HR', 'Training Officer', '1988-11-30', 'Full-time', 'Female', 'active', '0923975376', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(44, 'Daniel', 'Lopez', 'daniel.lopez@company.com', 'HR', 'Payroll Officer', '1987-05-18', 'Full-time', 'Male', 'active', '0939473921', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(45, 'Ricardo', 'Mendoza', 'ricardo.mendoza@company.com', 'Logistics', 'Fleet Manager', '1980-12-05', 'Full-time', 'Male', 'active', '0923872408', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(46, 'Andrea', 'Torres', 'andrea.torres@company.com', 'Logistics', 'Dispatch Coordinator', '1992-02-20', 'Full-time', 'Female', 'active', '0911374007', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(47, 'Jose', 'Reyes', 'jose.reyes@company.com', 'Operations', 'Operations Manager', '1978-06-10', 'Full-time', 'Male', 'active', '0943503018', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(48, 'Carla', 'Jimenez', 'carla.jimeneez@company.com', 'Operations', 'Customer Support Lead', '1991-09-15', 'Full-time', 'Female', 'active', '0945897037', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(49, 'Sofia', 'Lim', 'sofia.lim@company.com', 'Finance', 'Finance Officer', '1983-04-25', 'Full-time', 'Female', 'active', '0960468708', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(50, 'Gabriel', 'Cruz', 'gabriel.cruz@company.com', 'Admin', 'Administrative Assistant', '1990-07-30', 'Full-time', 'Male', 'active', '0986292781', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(51, 'Juan', 'Dela Cruz', 'juan.delacruz@company.com', 'IT', 'Software Developer', '1990-05-15', 'Full-time', 'Male', 'active', '0987509571', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(52, 'Liza', 'Panganiban', 'liza.panganiban@company.com', 'IT', 'System Administrator', '1988-07-22', 'Full-time', 'Female', 'active', '0972384163', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(53, 'Mark', 'Salvador', 'mark.salvador@company.com', 'IT', 'Database Administrator', '1987-09-10', 'Full-time', 'Male', 'active', '0949644522', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(54, 'Grace', 'Perez', 'grace.perez@company.com', 'IT', 'UX Designer', '1991-03-28', 'Full-time', 'Female', 'active', '0949872857', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(55, 'Ryan', 'Ong', 'ryan.ong@company.com', 'IT', 'Network Engineer', '1989-11-05', 'Full-time', 'Male', 'active', '0965591103', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(56, 'Patricia', 'Gonzalez', 'patricia.gonzalez@company.com', 'Marketing', 'Marketing Manager', '1986-04-12', 'Full-time', 'Female', 'active', '0966635913', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(57, 'Albert', 'Tan', 'albert.tan@company.com', 'Marketing', 'Digital Marketer', '1990-08-19', 'Full-time', 'Male', 'active', '0922028567', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(58, 'Maricel', 'Lazaro', 'maricel.lazaro@company.com', 'Marketing', 'Content Writer', '1987-01-25', 'Full-time', 'Female', 'active', '0932735820', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(59, 'Arnel', 'Ignacio', 'arnel.ignacio@company.com', 'Marketing', 'Graphic Designer', '1989-06-30', 'Full-time', 'Male', 'active', '0954921405', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(60, 'Melissa', 'Robles', 'melissa.robles@company.com', 'Customer Support', 'Support Agent', '1992-02-15', 'Full-time', 'Female', 'active', '0951314115', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(61, 'Ronald', 'Sison', 'ronald.sison@company.com', 'Customer Support', 'Support Agent', '1991-05-20', 'Full-time', 'Male', 'active', '0948760834', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(62, 'Jennifer', 'Mercado', 'jennifer.mercado@company.com', 'Customer Support', 'Support Agent', '1990-09-10', 'Full-time', 'Female', 'active', '0979486851', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(63, 'Dennis', 'Reyes', 'dennis.reyes@company.com', 'Customer Support', 'Support Agent', '1989-12-05', 'Full-time', 'Male', 'active', '0920154406', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(64, 'Angelica', 'Fuentes', 'angelica.fuentes@company.com', 'Customer Support', 'Support Agent', '1993-03-18', 'Full-time', 'Female', 'active', '0999029118', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(65, 'Marvin', 'Dizon', 'marvin.dizon@company.com', 'Customer Support', 'Support Agent', '1990-07-22', 'Full-time', 'Male', 'active', '0918636598', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(66, 'Catherine', 'Romero', 'catherine.romero@company.com', 'Customer Support', 'Support Agent', '1991-10-30', 'Full-time', 'Female', 'active', '0924163653', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(67, 'Allan', 'Navarro', 'allan.navarro@company.com', 'Customer Support', 'Support Agent', '1988-04-14', 'Full-time', 'Male', 'active', '0937374302', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(68, 'Roberto', 'Gonzales', 'roberto.gonzales@company.com', 'Accounting', 'Accountant', '1985-11-08', 'Full-time', 'Male', 'active', '0994175585', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(69, 'Susan', 'Chua', 'susan.chua@company.com', 'Accounting', 'Bookkeeper', '1987-02-17', 'Full-time', 'Female', 'active', '0957803084', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(70, 'Benedict', 'Sy', 'benedict.sy@company.com', 'Accounting', 'Auditor', '1984-08-23', 'Full-time', 'Male', 'active', '0975561667', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(71, 'Ramon', 'Hizon', 'ramon.hizon@company.com', 'Legal', 'Legal Counsel', '1975-05-10', 'Full-time', 'Male', 'active', '0958122241', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(72, 'Lourdes', 'Manalo', 'lourdes.manalo@company.com', 'Legal', 'Compliance Officer', '1978-09-15', 'Full-time', 'Female', 'active', '0982966633', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(73, 'Dante', 'Silva', 'dante.silva@company.com', 'Safety', 'Safety Officer', '1980-12-20', 'Full-time', 'Male', 'active', '0959996467', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(74, 'Marissa', 'Lazatin', 'marissa.lazatin@company.com', 'Safety', 'Compliance Specialist', '1983-04-05', 'Full-time', 'Female', 'active', '0913467098', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(75, 'Ricardo', 'Molina', 'ricardo.molina@company.com', 'Safety', 'Vehicle Inspector', '1982-07-30', 'Full-time', 'Male', 'active', '0984039708', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(76, 'Enrique', 'Delgado', 'enrique.delgado@company.com', 'Executive', 'CEO', '1970-03-12', 'Full-time', 'Male', 'active', '0945054178', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(77, 'Isabel', 'Vasquez', 'isabel.vasquez@company.com', 'Executive', 'COO', '1972-06-25', 'Full-time', 'Female', 'active', '0995939033', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(78, 'Raul', 'Hernandez', 'raul.hernandez@company.com', 'Executive', 'CFO', '1973-09-18', 'Full-time', 'Male', 'active', '0968523656', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(79, 'Carmen', 'Reyes', 'carmen.reyes2@company.com', 'Executive', 'CTO', '1975-01-30', 'Full-time', 'Female', 'active', '0983323870', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(80, 'Alfredo', 'Santos', 'alfredo.santos@company.com', 'Executive', 'CMO', '1974-11-05', 'Full-time', 'Male', 'active', '0992305892', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(81, 'Ramon', 'Gutierrez', 'ramon.gutierrez@company.com', 'Operations', 'Operations Assistant', '1986-10-12', 'Full-time', 'Male', 'active', '0968100265', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(82, 'Lourdes', 'Bautista', 'lourdes.bautista@company.com', 'HR', 'HR Assistant', '1989-02-28', 'Full-time', 'Female', 'active', '0968285508', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(83, 'Fernando', 'Marquez', 'fernando.marquez@company.com', 'Logistics', 'Logistics Assistant', '1987-07-15', 'Full-time', 'Male', 'active', '0998790960', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(84, 'Teresita', 'Santiago', 'teresita.santiago@company.com', 'Customer Support', 'Support Assistant', '1990-04-20', 'Full-time', 'Female', 'active', '0951434641', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(85, 'Arturo', 'Lopez', 'arturo.lopez@company.com', 'IT', 'IT Support', '1988-12-10', 'Full-time', 'Male', 'active', '0930514506', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(86, 'Rosalinda', 'Garcia', 'rosalinda.garcia@company.com', 'Admin', 'Receptionist', '1991-05-25', 'Full-time', 'Female', 'active', '0951752575', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(87, 'Eduardo', 'Castro', 'eduardo.castro@company.com', 'Marketing', 'Marketing Assistant', '1989-08-18', 'Full-time', 'Male', 'active', '0974714551', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(88, 'Imelda', 'Reyes', 'imelda.reyes@company.com', 'Finance', 'Finance Assistant', '1987-11-30', 'Full-time', 'Female', 'active', '0988417626', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(89, 'Rolando', 'Mendoza', 'rolando.mendoza@company.com', 'Safety', 'Safety Assistant', '1986-03-15', 'Full-time', 'Male', 'active', '0979107905', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(90, 'Gina', 'Torres', 'gina.torres@company.com', 'Legal', 'Legal Assistant', '1988-06-22', 'Full-time', 'Female', 'active', '0994196243', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(91, 'Rafael', 'Basilio', 'rafael.basilio@company.com', 'Operations', 'Driver', '1995-04-13', 'Full-time', 'Male', 'active', '0973068210', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(92, 'Andrea', 'Cortez', 'andrea.cortez@company.com', 'Operations', 'Customer Support', '2003-04-13', 'Full-time', 'Female', 'active', '0932178251', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(93, 'Marvin', 'Estrella', 'marvin.estrella@company.com', 'Logistics', 'Dispatch Assistant', '1997-04-13', 'Full-time', 'Male', 'active', '0980416009', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(94, 'Carla', 'Jimenez', 'carla.jimenez@company.com', 'HR', 'HR Assistant', '1998-04-13', 'Full-time', 'Female', 'active', '0982211978', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(95, 'Eduardo', 'Magsaysay', 'eduardo.magsaysay@company.com', 'Logistics', 'Fleet Maintenance', '1998-04-13', 'Full-time', 'Male', 'active', '0937119818', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(96, 'Lourdes', 'Natividad', 'lourdes.natividad@company.com', 'Finance', 'Finance Clerk', '2004-04-13', 'Full-time', 'Female', 'active', '0922348911', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(97, 'Romeo', 'Pascual', 'romeo.pascual@company.com', 'Admin', 'Admin Assistant', '1996-04-13', 'Full-time', 'Male', 'active', '0941525108', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(98, 'Teresita', 'Quizon', 'teresita.quizon@company.com', 'Operations', 'Driver', '1997-04-13', 'Part-time', 'Female', 'active', '0990053072', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(99, 'Samuel', 'Rubio', 'samuel.rubio@company.com', 'Operations', 'Data Entry', '1995-04-13', 'Full-time', 'Male', 'active', '0929005477', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(100, 'Victoria', 'Sison', 'victoria.sison@company.com', 'Support', 'Safety Assistant', '1995-04-13', 'Full-time', 'Female', 'active', '0981320141', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(101, 'Benjamin', 'Tolentino', 'benjamin.tolentino@company.com', 'Operations', 'Driver', '2003-04-13', 'Full-time', 'Male', 'active', '0961963382', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(102, 'Danica', 'Umali', 'danica.umali@company.com', 'Operations', 'Customer Support', '1996-04-13', 'Full-time', 'Female', 'active', '0981078454', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(103, 'Christian', 'Villanueva', 'christian.villanueva@company.com', 'Logistics', 'Vehicle Inspector', '2000-04-13', 'Full-time', 'Male', 'active', '0994685841', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(104, 'Erica', 'Yabut', 'erica.yabut@company.com', 'HR', 'Recruitment Assistant', '1995-04-13', 'Full-time', 'Female', 'active', '0921248390', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(105, 'Francis', 'Zamora', 'francis.zamora@company.com', 'Finance', 'Billing Clerk', '1998-04-13', 'Full-time', 'Male', 'active', '0986164363', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(106, 'Giselle', 'Aguilar', 'giselle.aguilar@company.com', 'Admin', 'Office Clerk', '1996-04-13', 'Full-time', 'Female', 'active', '0989023645', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(107, 'Harold', 'Bautista', 'harold.bautista@company.com', 'Operations', 'Driver', '1997-04-13', 'Full-time', 'Male', 'active', '0996075520', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(108, 'Irene', 'Cruz', 'irene.cruz@company.com', 'Support', 'Safety Monitor', '1997-04-13', 'Full-time', 'Female', 'active', '0960816247', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(109, 'Jerome', 'Dela Rosa', 'jerome.delarosa@company.com', 'Logistics', 'Fleet Assistant', '1995-04-13', 'Full-time', 'Male', 'active', '0958089279', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(110, 'Katherine', 'Evangelista', 'katherine.evangelista@company.com', 'Operations', 'Reservation Specialist', '2004-04-13', 'Full-time', 'Female', 'active', '0923149861', '2025-04-13 04:18:46', '2025-04-13 04:18:46'),
(112, 'John Albert', 'illanuea', 'hoho@gmail.com', 'IT', 'Quality Assurance', '1986-04-15', 'Full-time', 'Male', 'active', '09169492068', '2025-04-13 08:01:31', '2025-04-13 08:01:31'),
(113, 'Richmon', 'Salarda', 'romdoy123@gmail.com', 'IT', 'Web Developer', '2001-04-10', 'Full-time', 'Male', 'active', '09332322312', '2025-04-22 08:45:05', '2025-04-22 08:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `incident_id` int(11) NOT NULL,
  `incident_type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `incident_datetime` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`incident_id`, `incident_type`, `description`, `incident_datetime`, `created_at`) VALUES
(1, 'asdasd', 'asdasd', '2025-04-26 18:08:00', '2025-04-26 10:08:04'),
(2, 'asdasd', 'asdasd', '2025-04-26 18:18:00', '2025-04-26 10:18:26'),
(3, 'asdasd', 'asdasd', '2025-04-26 18:18:00', '2025-04-26 10:18:29'),
(4, 'asdasd', 'asd', '2025-04-26 18:18:00', '2025-04-26 10:18:40'),
(5, 'asd', 'asd', '2025-04-26 18:19:00', '2025-04-26 10:19:24'),
(6, 'asd', 'asd', '2025-04-26 18:22:00', '2025-04-26 10:22:10'),
(7, 'asdzz', 'asdzz', '2025-04-26 18:26:00', '2025-04-26 10:26:37'),
(8, 'asd', 'asd', '2025-04-26 18:27:00', '2025-04-26 10:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `incident_attachments`
--

CREATE TABLE `incident_attachments` (
  `id` int(11) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `witness_statement` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incident_attachments`
--

INSERT INTO `incident_attachments` (`id`, `incident_id`, `file_path`, `witness_statement`, `uploaded_at`) VALUES
(1, 1, 'uploads/1745662947_logo_movers.jpg', 'asdasdsad', '2025-04-26 10:22:27'),
(2, 1, 'uploads/1745663274_logo_movers.jpg', 'zzzzzzzzzzzzzzzzzzzzzxzx', '2025-04-26 10:27:54'),
(3, 8, 'uploads/1745663366_logo_movers.jpg', 'asdasd', '2025-04-26 10:29:26'),
(4, 8, 'uploads/incidents/1745663463_logo_movers.jpg', 'asdasd', '2025-04-26 10:31:03'),
(5, 7, 'incidents/1745663522_logo_movers.jpg', 'asdasd', '2025-04-26 10:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `incident_status`
--

CREATE TABLE `incident_status` (
  `id` int(11) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `status` enum('Open','In Progress','Resolved','Closed') NOT NULL,
  `corrective_action` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incident_status`
--

INSERT INTO `incident_status` (`id`, `incident_id`, `status`, `corrective_action`, `updated_at`) VALUES
(1, 1, 'Open', 'asdasd', '2025-04-26 10:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `leave_balances`
--

CREATE TABLE `leave_balances` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `balance` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_balances`
--

INSERT INTO `leave_balances` (`id`, `emp_id`, `leave_type_id`, `balance`) VALUES
(3, '1001', 1, 5),
(4, '1001', 2, 13),
(5, '1001', 3, 10),
(6, '3', 1, 5),
(7, '3', 2, 14),
(8, '3', 3, 5),
(9, '5', 1, 14),
(10, '5', 2, 14),
(11, '5', 3, 5),
(12, '5', 4, 10),
(17, '5', 5, 14),
(18, '5', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `leave_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `filed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `proof_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `emp_id`, `leave_type_id`, `leave_date`, `reason`, `status`, `filed_at`, `proof_file`) VALUES
(3, '1001', 2, '2025-04-18', 'asd', 'Approved', '2025-04-18 07:28:14', 'uploads/sick_certificates/1744961294_v28_finding_20250308.pdf'),
(4, '1001', 2, '2025-04-18', 'asd', 'Disapproved', '2025-04-18 07:29:41', 'uploads/sick_certificates/1744961381_Number_master.png'),
(5, '3', 2, '2025-04-25', 'asdasd', 'Pending', '2025-04-24 08:56:13', 'uploads/sick_certificates/1745484973_v28_finding_20250308.pdf'),
(6, '5', 2, '2025-04-27', 'Feeling unwell', 'Pending', '2025-04-26 03:57:23', 'uploads/sick_certificates/1745639843_doctor_note.jpg'),
(7, '5', 2, '2025-04-25', 'not felling wellk', 'Approved', '2025-04-26 04:09:13', 'uploads/sick_certificates/1745640553_IMG-6c4eace8ef2c8dc2d04c39d767db15de-V.jpg'),
(8, '5', 1, '2025-04-25', 'vl', 'Approved', '2025-04-26 04:41:35', NULL),
(9, '5', 1, '2025-04-25', 'bakasyon', 'Disapproved', '2025-04-26 07:20:04', NULL),
(10, '5', 2, '2025-05-17', 'hjjkk', 'Pending', '2025-04-26 07:24:14', 'uploads/sick_certificates/1745652254_IMG-003ef8bcf57dc427d9808cd3f9a62b19-V.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `description`) VALUES
(1, 'Vacation', 'Planned personal time off'),
(2, 'Sick', 'Sick leave'),
(3, 'Emergency', 'Emergency leave'),
(4, 'Bereavement ', 'Bereavement Leave'),
(5, 'Paternity Leave', 'Paternity Leave'),
(6, 'MATERNITY LEAVE', 'MATERNITY LEAVE');

-- --------------------------------------------------------

--
-- Table structure for table `root_causes`
--

CREATE TABLE `root_causes` (
  `id` int(11) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `root_cause` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `root_causes`
--

INSERT INTO `root_causes` (`id`, `incident_id`, `root_cause`, `created_at`) VALUES
(1, 1, 'ewan', '2025-04-26 10:22:16'),
(2, 8, 'zzzzzzzzz', '2025-04-26 10:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `time_logs`
--

CREATE TABLE `time_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  `log_type` tinyint(4) NOT NULL COMMENT '1 = Morning In, 2 = Morning Out, 3 = Lunch In, 4 = Time Out',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_logs`
--

INSERT INTO `time_logs` (`id`, `user_id`, `log_date`, `log_time`, `log_type`, `created_at`, `latitude`, `longitude`, `location_id`) VALUES
(1, 4, '2025-04-18', '08:02:00', 1, '2025-04-23 13:54:15', NULL, NULL, NULL),
(2, 4, '2025-04-18', '08:02:00', 1, '2025-04-23 13:54:25', NULL, NULL, NULL),
(3, 5, '2025-04-18', '08:05:00', 1, '2025-04-23 14:04:23', NULL, NULL, NULL),
(4, 5, '2025-04-18', '08:02:00', 2, '2025-04-23 14:05:20', NULL, NULL, NULL),
(5, 5, '2025-04-23', '08:02:00', 2, '2025-04-23 14:15:37', NULL, NULL, NULL),
(6, 4, '2025-04-23', '12:03:00', 2, '2025-04-23 14:15:41', NULL, NULL, NULL),
(7, 4, '2025-04-23', '09:02:00', 1, '2025-04-23 14:15:48', NULL, NULL, NULL),
(8, 5, '2025-04-23', '08:02:00', 1, '2025-04-23 14:15:53', NULL, NULL, NULL),
(9, 5, '2025-04-23', '12:02:00', 2, '2025-04-23 14:16:09', NULL, NULL, NULL),
(10, 5, '2025-04-23', '12:20:00', 3, '2025-04-23 14:16:17', NULL, NULL, NULL),
(11, 5, '2025-04-23', '17:20:00', 4, '2025-04-23 14:16:24', NULL, NULL, NULL),
(12, 5, '2025-04-23', '18:20:00', 4, '2025-04-23 14:16:37', NULL, NULL, NULL),
(13, 5, '2025-04-23', '20:20:00', 4, '2025-04-23 14:17:00', NULL, NULL, NULL),
(14, 4, '2025-04-23', '12:05:00', 3, '2025-04-23 15:05:46', NULL, NULL, NULL),
(15, 4, '2025-04-23', '05:00:00', 4, '2025-04-23 15:05:46', NULL, NULL, NULL),
(16, 2, '2025-04-23', '19:20:00', 4, '2025-04-25 23:02:32', NULL, NULL, NULL),
(35, 5, '2025-04-26', '21:58:00', 1, '2025-04-26 13:58:08', 14.70709950, 121.00423960, 3),
(36, 5, '2025-04-26', '21:58:00', 2, '2025-04-26 13:58:22', 14.70708680, 121.00424060, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emp_id`, `username`, `password`, `full_name`, `role`, `created_at`) VALUES
(1, 0, 'admin', '$2y$10$T2YwbF.FdKVAJPw.x6qUie1yJ/1qI/.A7X2qbLMP/ho/zuHKQzjjG', 'Administrator', 'admin', '2025-04-23 13:42:47'),
(341, 1, 'antonio.manalo@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(342, 2, 'rosa.dizon@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(343, 3, 'eduardo.bautista@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(344, 4, 'ramosbactol@gmail.com', '$2y$10$WdNq88jcGbLyZSYwspIXUuESX7hb1i6Ob/gyzRNmV1TDW2t3sMVDq', NULL, 'User', '2025-04-25 11:45:31'),
(345, 5, 'ricardo.gutierrez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(346, 6, 'teresa.castillo@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(347, 7, 'fernando.ocampo@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(348, 8, 'carmen.reyes@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(349, 9, 'ramon.aquino@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(350, 10, 'amalia.cruz@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(351, 11, 'alfredo.garcia@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(352, 12, 'corazon.lopez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(353, 13, 'gregorio.santos@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(354, 14, 'rosario.mendoza@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(355, 15, 'roberto.sanchez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(356, 16, 'imelda.torres@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(357, 17, 'armando.rivera@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(358, 18, 'lydia.gomez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(359, 19, 'ernesto.diaz@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(360, 20, 'esperanza.ramos@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(361, 21, 'rodolfo.alvarez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(362, 22, 'gloria.romero@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(363, 23, 'arturo.chavez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(364, 24, 'aurora.ortega@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(365, 25, 'felipe.delrosario@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(366, 26, 'beatriz.navarro@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(367, 27, 'victor.salazar@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(368, 28, 'consuelo.villanueva@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(369, 29, 'hector.castro@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(370, 30, 'rebecca.pineda@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(371, 31, 'carlos.lim@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(372, 32, 'lorna.gonzales@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(373, 33, 'raul.martinez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(374, 34, 'tessie.salcedo@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(375, 35, 'rogelio.estrada@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(376, 36, 'mercedes.cordero@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(377, 37, 'arnulfo.galang@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(378, 38, 'nenita.barrera@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(379, 39, 'dominador.tuazon@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(380, 40, 'perla.samson@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(381, 41, 'maria.santos@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(382, 42, 'luis.garcia@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(383, 43, 'elena.ramos@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(384, 44, 'daniel.lopez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(385, 45, 'ricardo.mendoza@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(386, 46, 'andrea.torres@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(387, 47, 'jose.reyes@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(388, 48, 'carla.jimeneez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(389, 49, 'sofia.lim@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(390, 50, 'gabriel.cruz@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(391, 51, 'juan.delacruz@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(392, 52, 'liza.panganiban@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(393, 53, 'mark.salvador@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(394, 54, 'grace.perez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(395, 55, 'ryan.ong@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(396, 56, 'patricia.gonzalez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(397, 57, 'albert.tan@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(398, 58, 'maricel.lazaro@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(399, 59, 'arnel.ignacio@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(400, 60, 'melissa.robles@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(401, 61, 'ronald.sison@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(402, 62, 'jennifer.mercado@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(403, 63, 'dennis.reyes@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(404, 64, 'angelica.fuentes@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(405, 65, 'marvin.dizon@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(406, 66, 'catherine.romero@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(407, 67, 'allan.navarro@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(408, 68, 'roberto.gonzales@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(409, 69, 'susan.chua@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(410, 70, 'benedict.sy@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(411, 71, 'ramon.hizon@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(412, 72, 'lourdes.manalo@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(413, 73, 'dante.silva@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(414, 74, 'marissa.lazatin@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(415, 75, 'ricardo.molina@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(416, 76, 'enrique.delgado@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(417, 77, 'isabel.vasquez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(418, 78, 'raul.hernandez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(419, 79, 'carmen.reyes2@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(420, 80, 'alfredo.santos@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(421, 81, 'ramon.gutierrez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(422, 82, 'lourdes.bautista@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(423, 83, 'fernando.marquez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(424, 84, 'teresita.santiago@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(425, 85, 'arturo.lopez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(426, 86, 'rosalinda.garcia@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(427, 87, 'eduardo.castro@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(428, 88, 'imelda.reyes@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(429, 89, 'rolando.mendoza@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(430, 90, 'gina.torres@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(431, 91, 'rafael.basilio@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(432, 92, 'andrea.cortez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(433, 93, 'marvin.estrella@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(434, 94, 'carla.jimenez@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(435, 95, 'eduardo.magsaysay@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(436, 96, 'lourdes.natividad@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(437, 97, 'romeo.pascual@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(438, 98, 'teresita.quizon@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(439, 99, 'samuel.rubio@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(440, 100, 'victoria.sison@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(441, 101, 'benjamin.tolentino@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(442, 102, 'danica.umali@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(443, 103, 'christian.villanueva@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(444, 104, 'erica.yabut@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(445, 105, 'francis.zamora@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(446, 106, 'giselle.aguilar@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(447, 107, 'harold.bautista@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(448, 108, 'irene.cruz@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(449, 109, 'jerome.delarosa@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(450, 110, 'katherine.evangelista@company.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(451, 112, 'hoho@gmail.com', '', NULL, 'User', '2025-04-25 11:45:31'),
(452, 113, 'romdoy123@gmail.com', '', NULL, 'User', '2025-04-25 11:45:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowed_locations`
--
ALTER TABLE `allowed_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees_hr1`
--
ALTER TABLE `employees_hr1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`incident_id`);

--
-- Indexes for table `incident_attachments`
--
ALTER TABLE `incident_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_id` (`incident_id`);

--
-- Indexes for table `incident_status`
--
ALTER TABLE `incident_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_id` (`incident_id`);

--
-- Indexes for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_type_id` (`leave_type_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `root_causes`
--
ALTER TABLE `root_causes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_id` (`incident_id`);

--
-- Indexes for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowed_locations`
--
ALTER TABLE `allowed_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `incident_attachments`
--
ALTER TABLE `incident_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `incident_status`
--
ALTER TABLE `incident_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_balances`
--
ALTER TABLE `leave_balances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `root_causes`
--
ALTER TABLE `root_causes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `time_logs`
--
ALTER TABLE `time_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=453;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incident_attachments`
--
ALTER TABLE `incident_attachments`
  ADD CONSTRAINT `incident_attachments_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`incident_id`) ON DELETE CASCADE;

--
-- Constraints for table `incident_status`
--
ALTER TABLE `incident_status`
  ADD CONSTRAINT `incident_status_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`incident_id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD CONSTRAINT `leave_balances_ibfk_1` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`);

--
-- Constraints for table `root_causes`
--
ALTER TABLE `root_causes`
  ADD CONSTRAINT `root_causes_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`incident_id`) ON DELETE CASCADE;

--
-- Constraints for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD CONSTRAINT `time_logs_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `allowed_locations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
