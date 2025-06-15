-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Jun-2025 às 22:38
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `deapc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE `clients` (
  `nif` int(9) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `payment` varchar(30) DEFAULT NULL,
  `phone` int(9) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders_client`
--

CREATE TABLE `orders_client` (
  `orderID` varchar(20) NOT NULL,
  `client_nif` int(11) DEFAULT NULL,
  `client_name` varchar(20) DEFAULT NULL,
  `stat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `orders_client`
--

INSERT INTO `orders_client` (`orderID`, `client_nif`, `client_name`, `stat`) VALUES
('123DRE', NULL, 'company01', 'PENDING'),
('789ASW', NULL, 'company02', 'READY');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders_products`
--

CREATE TABLE `orders_products` (
  `orderID` varchar(20) DEFAULT NULL,
  `prodID` int(11) DEFAULT NULL,
  `prod_name` varchar(20) DEFAULT NULL,
  `prod_desc` varchar(200) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `orders_products`
--

INSERT INTO `orders_products` (`orderID`, `prodID`, `prod_name`, `prod_desc`, `qty`) VALUES
('123DRE', NULL, 'box', 'cardboard box', 12),
('123DRE', NULL, 'pallet', 'wooden pallet', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `supplier` varchar(20) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `supplier`, `price`, `category`, `notes`, `date`) VALUES
(1, 'S21 Phone Case', 'Samsung', 20, 'Phones', '', '2025-06-05'),
(2, 'TESTE', 'TESTE', 5, 'TESTE', 'TESTE', '2025-06-06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `passw` varchar(20) DEFAULT NULL,
  `adm` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`username`, `email`, `passw`, `adm`) VALUES
('Arthur Peixoto', '1192117@isep.ipp.pt', '4cd79461', 1),
('Daniel Afonso', '1240570@isep.ipp.pt', 'b8a9bd40', 1),
('Marcel Silva', '1240575@isep.ipp.pt', 'c864bb3c', 1);

--
-- Acionadores `users`
--
DELIMITER $$
CREATE TRIGGER `generate_password` BEFORE INSERT ON `users` FOR EACH ROW SET NEW.passw = SUBSTRING(MD5(RAND()), 1, 8)
$$
DELIMITER ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`nif`);

--
-- Índices para tabela `orders_client`
--
ALTER TABLE `orders_client`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `client_nif` (`client_nif`);

--
-- Índices para tabela `orders_products`
--
ALTER TABLE `orders_products`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `prodID` (`prodID`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `orders_client`
--
ALTER TABLE `orders_client`
  ADD CONSTRAINT `orders_client_ibfk_1` FOREIGN KEY (`client_nif`) REFERENCES `clients` (`nif`);

--
-- Limitadores para a tabela `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders_client` (`orderID`),
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`prodID`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
