-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 28, 2024 at 10:21 PM
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
-- Database: `kwiaciarnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

CREATE TABLE `adresy` (
  `id` int(11) NOT NULL,
  `miasto` varchar(50) DEFAULT NULL,
  `kod_pocztowy` varchar(6) DEFAULT NULL,
  `ulica` varchar(50) DEFAULT NULL,
  `numer` varchar(5) DEFAULT NULL,
  `id_uzytkownik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_klient`
--

CREATE TABLE `dane_klient` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) DEFAULT NULL,
  `nazwisko` varchar(50) DEFAULT NULL,
  `numer_tel` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dane_klient`
--

INSERT INTO `dane_klient` (`id`, `imie`, `nazwisko`, `numer_tel`) VALUES
(3, 'd', 'd', 123123123),
(4, 'd', 'asd', 544432111),
(5, 'd', 'asd', 544432111),
(6, 'asd', 'asd', 123123123),
(8, 'asd', 'asdas', 132234);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `cena` int(4) DEFAULT NULL,
  `zdjecie` varchar(50) DEFAULT NULL,
  `nazwa` varchar(30) DEFAULT NULL,
  `opis` varchar(2000) DEFAULT NULL,
  `full_zdjecie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `cena`, `zdjecie`, `nazwa`, `opis`, `full_zdjecie`) VALUES
(1, 120, 'bukiet1d', 'Purple Stepbrother', '\"Purple Stepbrother\" to propozycja dla osób ceniących subtelne, ale wyraziste kompozycje o unikalnym stylu. Doskonale sprawdzi się jako prezent lub jako ozdoba w stylowym wnętrzu.', 'bukiet1'),
(2, 170, 'bukiet2d', 'Plum Opium', '\"Plum Opium\" to kompozycja idealna na wyjątkowe okazje lub jako luksusowy dodatek do wnętrz. Doskonale sprawdzi się jako wyrazisty prezent lub jako element dekoracyjny, który wprowadzi nutę tajemniczości i elegancji do każdego pomieszczenia.', 'bukiet2'),
(3, 100, 'bukiet3d', 'Mauve Tindeer', '\"Mauve Tindeer\" to elegancka kompozycja dla tych, którzy cenią subtelny urok i wyrazisty styl. Idealny jako prezent lub ozdoba, dodająca klasy i charakteru każdemu wnętrzu.', 'bukiet3'),
(4, 210, 'bukiet4d', 'Rouge Beatchild', 'Ten bukiet to połączenie delikatności i tajemniczości. \"Rouge Beatchild\" w odcieniach różu i fioletu świetnie dopełni wnętrza w stylu nowoczesnym lub klasycznym, stanowiąc elegancki akcent dekoracyjny.', 'bukiet4'),
(5, 240, 'bukiet5d', 'Chunkymilk', '\"Chunkymilk\" to kompozycja pełna subtelnego uroku, idealna do wnętrz, które potrzebują eleganckiego i stylowego akcentu. Doskonały wybór do salonu, sypialni lub gabinetu.', 'bukiet5'),
(6, 190, 'bukiet6d', 'Blush Ballless', '\"Blush Ballless\" to wyważona mieszanka klasyki i nowoczesności. Świetnie sprawdzi się jako prezent lub stylowa ozdoba, wnosząc do wnętrza harmonię i elegancję.', 'bukiet6');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `haslo` varchar(64) DEFAULT NULL,
  `id_dane_klient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownik`
--

INSERT INTO `uzytkownik` (`id`, `email`, `haslo`, `id_dane_klient`) VALUES
(3, 'admin@admin', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 3),
(4, 'mr.dollyo1234@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 4),
(5, '2fsdfsdf@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 4),
(6, 'j.grzana1@gmail.com', 'f10e2821bbbea527ea02200352313bc059445190', 6),
(8, 'mr.dollyo1234567@gmail.com', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `data_zamowienia` date DEFAULT current_timestamp(),
  `cena` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_to_klient`
--

CREATE TABLE `zamowienia_to_klient` (
  `id_zamowienie` int(11) DEFAULT NULL,
  `id_klient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_to_produkty`
--

CREATE TABLE `zamowienia_to_produkty` (
  `id_zamowienie` int(11) DEFAULT NULL,
  `id_produkt` int(11) DEFAULT NULL,
  `ilosc_produktu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownik` (`id_uzytkownik`);

--
-- Indeksy dla tabeli `dane_klient`
--
ALTER TABLE `dane_klient`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dane_klient` (`id_dane_klient`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia_to_klient`
--
ALTER TABLE `zamowienia_to_klient`
  ADD KEY `id_zamowienie` (`id_zamowienie`),
  ADD KEY `id_klient` (`id_klient`);

--
-- Indeksy dla tabeli `zamowienia_to_produkty`
--
ALTER TABLE `zamowienia_to_produkty`
  ADD KEY `id_zamowienie` (`id_zamowienie`),
  ADD KEY `id_produkt` (`id_produkt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresy`
--
ALTER TABLE `adresy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dane_klient`
--
ALTER TABLE `dane_klient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresy`
--
ALTER TABLE `adresy`
  ADD CONSTRAINT `adresy_ibfk_1` FOREIGN KEY (`id_uzytkownik`) REFERENCES `uzytkownik` (`id`);

--
-- Constraints for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD CONSTRAINT `uzytkownik_ibfk_1` FOREIGN KEY (`id_dane_klient`) REFERENCES `dane_klient` (`id`);

--
-- Constraints for table `zamowienia_to_klient`
--
ALTER TABLE `zamowienia_to_klient`
  ADD CONSTRAINT `zamowienia_to_klient_ibfk_1` FOREIGN KEY (`id_zamowienie`) REFERENCES `zamowienia` (`id`),
  ADD CONSTRAINT `zamowienia_to_klient_ibfk_2` FOREIGN KEY (`id_klient`) REFERENCES `uzytkownik` (`id`);

--
-- Constraints for table `zamowienia_to_produkty`
--
ALTER TABLE `zamowienia_to_produkty`
  ADD CONSTRAINT `zamowienia_to_produkty_ibfk_1` FOREIGN KEY (`id_zamowienie`) REFERENCES `zamowienia` (`id`),
  ADD CONSTRAINT `zamowienia_to_produkty_ibfk_2` FOREIGN KEY (`id_produkt`) REFERENCES `produkty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
