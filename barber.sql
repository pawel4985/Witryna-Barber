-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Cze 2022, 22:12
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `barber`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL,
  `haslo` text NOT NULL,
  `typ` varchar(30) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `accounts`
--

INSERT INTO `accounts` (`id`, `nazwa`, `haslo`, `typ`, `email`) VALUES
(1, 'admin', '$2y$10$c68vsIcKMk5McibRatwDIe1bgYs.TfWy/RLRSBKuQStdSdgDlUTAi', 'pracownik', ''),
(2, 'Szymon', '$2y$10$hrXEG2B0KO5Iegey.EF1k..EOo33POoGLdV/AI7dOgsfO0Q3hacMO', 'klient', 'pawel14021@gmail.com'),
(3, 'Pawel', '$2y$10$WJ6vD.NXZVIJlCQ7uv0PZubd82kutDY6wW.Kvof5DyEQbwdWZVuqK', 'klient', ''),
(4, 'Adam', '$2y$10$kQStkqUhWQV5tD0BXW9Lle6RtiGhHaXCKVBT05nSkICrYJkHvrBui', 'klient', ''),
(5, 'Maciek', '$2y$10$FQMtHq4Smb257ly84mbMcOzPp39YgbMkRhj.vpqcteCIb3Ek6AsnW', 'klient', ''),
(6, 'Janusz', '$2y$10$Mnx41DYH06ndbWhXu4zRR.8IDK4lz93vG052OHvU/7sTjQ6/axKgm', 'klient', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `appoints`
--

CREATE TABLE `appoints` (
  `id` int(11) NOT NULL,
  `dane` varchar(60) NOT NULL,
  `godzina` time NOT NULL,
  `data` date NOT NULL,
  `usluga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `appoints`
--

INSERT INTO `appoints` (`id`, `dane`, `godzina`, `data`, `usluga`) VALUES
(5, 'Szymon Ekran', '13:00:00', '2022-06-15', 3),
(6, 'Adam Nowak', '09:30:00', '2022-06-13', 2),
(7, 'Paweł Kowalski', '10:00:00', '2022-07-21', 5),
(8, 'Kacper Nowacki', '13:30:00', '2022-06-14', 4),
(9, 'Michał Kołek', '09:00:00', '2022-06-14', 6),
(10, 'Janusz Kowalski', '14:00:00', '2022-08-05', 11),
(11, 'Adrian Polak', '10:30:00', '2022-06-15', 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `day_offer`
--

CREATE TABLE `day_offer` (
  `id` int(11) NOT NULL,
  `nazwa_uslugi` text NOT NULL,
  `rabat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `day_offer`
--

INSERT INTO `day_offer` (`id`, `nazwa_uslugi`, `rabat`) VALUES
(1, 'strzyżenie włosów', 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opinions`
--

CREATE TABLE `opinions` (
  `id` int(11) NOT NULL,
  `opinia` text NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `opinions`
--

INSERT INTO `opinions` (`id`, `opinia`, `user`) VALUES
(2, 'Profesjonalna obsługa, super klimat. Przystępne ceny.', 3),
(3, 'Polecam bardzo, mistrzostwo Polski całkiem nieprzypadkowo zdobyte :) za każdym razem jestem Bardzo zadowolony! Nie wiem czy da się lepiej!', 5),
(4, 'Profesjonalnie. Miła atmosfera. Zadowolony z usług. Polecam', 4),
(5, 'Świetna obsługa , fachowość na najwyższym poziome , człowiek wychodzi z efektem wow 😀 polecam każdemu', 6),
(6, 'Dobry barber. Polecam serdecznie', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `nazwa_uslugi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `services`
--

INSERT INTO `services` (`id`, `nazwa_uslugi`) VALUES
(1, 'Oferta dnia'),
(2, 'Strzyżenie brody'),
(3, 'Strzyżenie włosów'),
(4, 'Strzyżenie na łyso + shaver'),
(5, 'Farbowanie brody'),
(11, 'Konturowanie brody'),
(12, 'Golenie pełne brody brzytwą');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `appoints`
--
ALTER TABLE `appoints`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `opinions`
--
ALTER TABLE `opinions`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `appoints`
--
ALTER TABLE `appoints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `opinions`
--
ALTER TABLE `opinions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
