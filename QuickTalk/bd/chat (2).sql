-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2024 at 06:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22026208_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int NOT NULL,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 1622688038, 340066300, 'hola man'),
(2, 340066300, 1622688038, 'bien'),
(3, 1622688038, 340066300, 'hola'),
(4, 340066300, 1622688038, 'hola'),
(5, 440971576, 1622688038, 'hola pedro, necesito tu ayuda'),
(6, 1622688038, 440971576, 'hola Mauricio, claro, dime !!'),
(7, 1665979203, 816495272, 'Hola'),
(8, 816495272, 1665979203, 'Que tal'),
(9, 469366459, 1245546704, 'Joto'),
(10, 1245546704, 469366459, 'si soy'),
(11, 1006106426, 352677438, 'Que tal bro'),
(12, 352677438, 202214741, 'Bro'),
(13, 202214741, 352677438, 'si dime'),
(14, 202214741, 352677438, 'que tal?'),
(15, 202214741, 352677438, 'Todo bien?'),
(16, 352677438, 947520595, 'Que tal men'),
(17, 352677438, 1533070385, 'Que onda bro'),
(18, 1533070385, 352677438, 'Exelente'),
(19, 352677438, 524514422, 'Que tal bro'),
(20, 524514422, 352677438, 'bien'),
(21, 524514422, 352677438, 'Cual madre'),
(22, 352677438, 1213945937, 'Hola'),
(23, 1213945937, 352677438, 'bien'),
(24, 1622688038, 352677438, 'JK'),
(25, 340066300, 352677438, 'cd'),
(26, 340066300, 352677438, 'Bro');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `unique_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `rol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `rol`) VALUES
(2, 340066300, 'Juan', 'Usuario', 'jusuario@cweb.commm', '917b71bac8e0eb5307e547722819cd09', '1652660638staff-avatar.png', 'Desconectad@', 0),
(3, 440971576, 'Pedro', 'Usuario', 'pusuario@cweb.com', 'KEVO', '1652670758chatbot.png', 'Disponible', 0),
(12, 352677438, 'Jose', 'Luna', 'jose.rodriguez.isw@unipolidgo.edu.mx', '0f7d259e60057221c3f7002e253a3a91', '1710048631monagullo.jpg', 'Disponible', 1),
(27, 202214741, 'sergio@joto.com', 'Soto', 'sergio@joto.com', '3c77f4029be2e609c22bba665f13b101', '1710570140ingresos.png', 'Disponible', 0),
(40, 1350356221, 'Jose', 'L', 'dskfjkldDVSjflfj@gmail.com', 'c664b11cdea90713059430637d34cd4b', '1713288452QuickTalkLogo.png', 'Offline now', 0),
(41, 651565577, 'ANgel', 'Prueba', 'dskfjklDVSjflfj@gmail.com', '0f7d259e60057221c3f7002e253a3a91', '1713290340Diseño sin título.png', 'Disponible', 0),
(42, 1039785979, 'ANgelss', 'Prueba', 'dskfjklsDVSjflfj@gmail.com', 'b81d208eab6ef7e96cef4a2ef1362718', '1713290431QuickTalkLogo-1.png', 'Disponible', 0),
(43, 1559534219, 'ANgelssffff', 'Prueba', 'dskfjklsffDVSjflfj@gmail.com', '0f7d259e60057221c3f7002e253a3a91', '1713290747QuickTalkLogo-1.png', 'Disponible', 0),
(44, 276939511, 'Jose', 'Rodriguez', 'jose.rodriguez.isw@unipolDidgo.edu.mx', 'd39c126546bdeab036b67f3bd45c909c', '1713290867QuickTalkLogo.png', 'Disponible', 0),
(45, 857962423, 'Mario', 'operando', 'dskfjkldjflfj@gmail.comd', '0f7d259e60057221c3f7002e253a3a91', '1713291213QuickTalkLogo.png', 'Disponible', 0),
(46, 1515799148, 'fevfvfr', 'L', 'dskfjkldjflfj@gfmail.com', '7fd315fd5f381bb9035d003dbd904102', '1713292566Diseño sin título.png', 'Disponible', 0),
(51, 450479738, 'Sergio', 'Soto', 'sergio.soto.isw@unipolidgo.edu.mx', 'fcb5cc629e61a0ee347215e94d618de0', '1713417039Logo_QuickTalk.jpg', 'Disponible', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
