-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 24, 2024 at 04:23 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikacja_wyborcza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kandydaci`
--

CREATE TABLE `kandydaci` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `glosy` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kandydaci`
--

INSERT INTO `kandydaci` (`id`, `imie`, `glosy`) VALUES
(1, 'Batman', 0),
(2, 'Superman', 0),
(3, 'Wojtek Mann', 0),
(4, 'Marek Sierocki', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `username`, `password`, `is_admin`) VALUES
(1, 'euroecofood', '$2y$10$9HayEl1YduTGDbKKjjOFveUBAJboOkJop4ju/7WEmBNkNR6DQF8h2', 0),
(2, 'Grela', '$2y$10$1MgnDOu2YxrPF80NVVYcP.P/zP/SMz8xlUT4.v9g5Jk4HeEbISo3u', 0),
(3, 'admin', '$2y$10$.ZIjppnGw/.Eg4k8kTzBEeouDcIwggtRUubRYvSZElVn5iNBbew4q', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyborcy`
--

CREATE TABLE `wyborcy` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `glosowal` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wyborcy`
--

INSERT INTO `wyborcy` (`id`, `imie`, `glosowal`) VALUES
(1, 'Grela', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kandydaci`
--
ALTER TABLE `kandydaci`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imie` (`imie`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeksy dla tabeli `wyborcy`
--
ALTER TABLE `wyborcy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imie` (`imie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kandydaci`
--
ALTER TABLE `kandydaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wyborcy`
--
ALTER TABLE `wyborcy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
