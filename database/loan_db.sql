-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220507.f68a18df64
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2022 a las 17:36:58
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `loan_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int(30) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `salary` varchar(11) NOT NULL,
  `tax_id` varchar(50) NOT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `borrowers`
--

INSERT INTO `borrowers` (`id`, `firstname`, `middlename`, `lastname`, `contact_no`, `address`, `email`, `salary`, `tax_id`, `date_created`) VALUES
(1, 'John', 'C', 'Smith', '+16554 454654', 'Sample address', 'jsmith@sample.com', '20000', '789845-23', 0),
(2, 'Karina', 'Karina', 'Montero', '8091111111', 'Calle 3', 'karina@gmail.com', '30000', '65', NULL),
(3, 'Vanessa', 'Luz', 'Montero', '8091111111', 'Calle 2', 'vanessa@hotmail.com', '40000', '8943', NULL),
(4, 'Juan', 'Carlos', 'Soto', '8091111111', 'Calle 2', 'jsoto@gmail.com', '', '54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_list`
--

CREATE TABLE `loan_list` (
  `id` int(30) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `loan_type_id` int(30) NOT NULL,
  `borrower_id` int(30) NOT NULL,
  `purpose` text DEFAULT NULL,
  `amount` double NOT NULL,
  `plan_id` int(30) NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0= request, 1= confrimed,2=released,3=complteted,4=denied\r\n',
  `date_released` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `loan_list`
--

INSERT INTO `loan_list` (`id`, `ref_no`, `loan_type_id`, `borrower_id`, `purpose`, `amount`, `plan_id`, `status`, `date_released`, `date_created`) VALUES
(3, '81409630', 1, 1, 'Sample Only', 100000, 1, 2, '2020-09-26 09:06:00', '2020-09-26 15:06:29'),
(4, '64460504', 3, 2, 'Para pagar la luz', 2500, 1, 1, NULL, '2022-05-01 21:12:20'),
(5, '62262361', 3, 3, 'Comprar carro', 40000, 3, 0, NULL, '2022-05-07 11:48:26'),
(6, '23704152', 1, 2, 'Pago de Vivienda', 40000, 1, 0, NULL, '2022-05-07 13:02:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_plan`
--

CREATE TABLE `loan_plan` (
  `id` int(30) NOT NULL,
  `months` int(11) NOT NULL,
  `interest_percentage` float NOT NULL,
  `penalty_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `loan_plan`
--

INSERT INTO `loan_plan` (`id`, `months`, `interest_percentage`, `penalty_rate`) VALUES
(1, 36, 8, 3),
(2, 24, 5, 2),
(3, 27, 6, 2),
(4, 12, 3, 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_schedules`
--

CREATE TABLE `loan_schedules` (
  `id` int(30) NOT NULL,
  `loan_id` int(30) NOT NULL,
  `date_due` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `loan_schedules`
--

INSERT INTO `loan_schedules` (`id`, `loan_id`, `date_due`) VALUES
(2, 3, '2020-10-26'),
(3, 3, '2020-11-26'),
(4, 3, '2020-12-26'),
(5, 3, '2021-01-26'),
(6, 3, '2021-02-26'),
(7, 3, '2021-03-26'),
(8, 3, '2021-04-26'),
(9, 3, '2021-05-26'),
(10, 3, '2021-06-26'),
(11, 3, '2021-07-26'),
(12, 3, '2021-08-26'),
(13, 3, '2021-09-26'),
(14, 3, '2021-10-26'),
(15, 3, '2021-11-26'),
(16, 3, '2021-12-26'),
(17, 3, '2022-01-26'),
(18, 3, '2022-02-26'),
(19, 3, '2022-03-26'),
(20, 3, '2022-04-26'),
(21, 3, '2022-05-26'),
(22, 3, '2022-06-26'),
(23, 3, '2022-07-26'),
(24, 3, '2022-08-26'),
(25, 3, '2022-09-26'),
(26, 3, '2022-10-26'),
(27, 3, '2022-11-26'),
(28, 3, '2022-12-26'),
(29, 3, '2023-01-26'),
(30, 3, '2023-02-26'),
(31, 3, '2023-03-26'),
(32, 3, '2023-04-26'),
(33, 3, '2023-05-26'),
(34, 3, '2023-06-26'),
(35, 3, '2023-07-26'),
(36, 3, '2023-08-26'),
(37, 3, '2023-09-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_types`
--

CREATE TABLE `loan_types` (
  `id` int(30) NOT NULL,
  `type_name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `loan_types`
--

INSERT INTO `loan_types` (`id`, `type_name`, `description`) VALUES
(1, 'Small Business', 'Small Business Loans'),
(2, 'Mortgages', 'Mortgages'),
(3, 'Personal Loans', 'Personal Loans'),
(4, 'Big Business', 'Big Business Loan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` int(30) NOT NULL,
  `loan_id` int(30) NOT NULL,
  `payee` text NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `penalty_amount` float NOT NULL DEFAULT 0,
  `overdue` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no , 1 = yes',
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `loan_id`, `payee`, `amount`, `penalty_amount`, `overdue`, `date_created`) VALUES
(2, 3, 'Smith, John C', 4000, 90, 1, '2020-09-26 15:51:01'),
(3, 3, 'Smith, John C', 2000, 90, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saving`
--

CREATE TABLE `saving` (
  `id` int(11) NOT NULL,
  `saving_type_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `current_balance` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `saving`
--

INSERT INTO `saving` (`id`, `saving_type_id`, `borrower_id`, `amount`, `current_balance`) VALUES
(1, 3, 2, '20000', ' 64999'),
(2, 2, 1, '30000', ' 15000'),
(5, 3, 3, '30000', '60000 '),
(8, 1, 2, '40000', '40000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saving_types`
--

CREATE TABLE `saving_types` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `saving_types`
--

INSERT INTO `saving_types` (`id`, `name`, `description`) VALUES
(1, 'Ayuda Mutua', NULL),
(2, 'Aportaciones', NULL),
(3, 'Ahorro Retirable', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `membership_number` varchar(30) NOT NULL,
  `contact` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` enum('admin','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `membership_number`, `contact`, `email`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'Gomez', '434345', '8091111118', 'admin@gmail.com', 'admin', 'admin123', 'admin'),
(50, 'Karina', 'Montero Leonardo', '43', '8091111112', 'kmontero@gmail.com', 'kmontero', '123', 'staff'),
(51, 'Pedro', 'Montero Leonardo', '43', '8091111112', 'pmontero@gmail.com', 'pmontero', '123', 'admin'),
(53, 'Ronald', 'Cruz', '545', '8091111112', 'rcruz@gmail.com', 'rcruz', '123', 'staff'),
(54, 'Johan', 'Fernandez', '943094', '8091111112', 'jfernandez@gmail.com', 'jfernandez', '123', 'staff'),
(55, 'Cesar', 'Caracas', '587', '8091111112', 'ccaracas@gmail.com', 'ccaracas', '123', 'admin'),
(56, 'Rosa ', 'Cruz', '89798', '8091111112', 'rosacruz@gmail.com', 'rosacruz', '123', 'staff'),
(57, 'Ronald Test', 'Cruz', '435', '8091111111', 'rcruz@gmail.com', 'rcruzz', 'admin123', 'staff');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `loan_list`
--
ALTER TABLE `loan_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_borrower_id` (`borrower_id`),
  ADD KEY `fk_loan_type_id` (`loan_type_id`),
  ADD KEY `fk_loan_plan_id` (`plan_id`);

--
-- Indices de la tabla `loan_plan`
--
ALTER TABLE `loan_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `loan_schedules`
--
ALTER TABLE `loan_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_loan_id` (`loan_id`);

--
-- Indices de la tabla `loan_types`
--
ALTER TABLE `loan_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_loan_list_id` (`loan_id`);

--
-- Indices de la tabla `saving`
--
ALTER TABLE `saving`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_borrower_saving_id` (`borrower_id`),
  ADD KEY `fk_saving_type_id` (`saving_type_id`);

--
-- Indices de la tabla `saving_types`
--
ALTER TABLE `saving_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `loan_list`
--
ALTER TABLE `loan_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `loan_plan`
--
ALTER TABLE `loan_plan`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `loan_schedules`
--
ALTER TABLE `loan_schedules`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `loan_types`
--
ALTER TABLE `loan_types`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `saving`
--
ALTER TABLE `saving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `saving_types`
--
ALTER TABLE `saving_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `loan_list`
--
ALTER TABLE `loan_list`
  ADD CONSTRAINT `fk_borrower_id` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`),
  ADD CONSTRAINT `fk_loan_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `loan_plan` (`id`),
  ADD CONSTRAINT `fk_loan_type_id` FOREIGN KEY (`loan_type_id`) REFERENCES `loan_types` (`id`);

--
-- Filtros para la tabla `loan_schedules`
--
ALTER TABLE `loan_schedules`
  ADD CONSTRAINT `fk_loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loan_list` (`id`);

--
-- Filtros para la tabla `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_loan_list_id` FOREIGN KEY (`loan_id`) REFERENCES `loan_list` (`id`);

--
-- Filtros para la tabla `saving`
--
ALTER TABLE `saving`
  ADD CONSTRAINT `fk_borrower_saving_id` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`),
  ADD CONSTRAINT `fk_saving_type_id` FOREIGN KEY (`saving_type_id`) REFERENCES `saving_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



