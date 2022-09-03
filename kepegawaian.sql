-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jul 2022 pada 08.33
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kepegawaian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berkala`
--

CREATE TABLE `berkala` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tmt` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bup`
--

CREATE TABLE `bup` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tmt` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepangkatan`
--

CREATE TABLE `kepangkatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tmt` varchar(80) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kepangkatan`
--

INSERT INTO `kepangkatan` (`id`, `nama`, `tmt`, `file`) VALUES
(2, 'suhanan', '2022-07-19', '62e56e7ebb1de.pdf'),
(3, 'asepsan', '2022-07-27', '62e571c3d5f3f.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(0, 'asep', '$2y$10$YuKJIKQ3NA7BGQLSh18R4.gH0T1mFL/fe14CZnsJdzzhQzyaxUPMK');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berkala`
--
ALTER TABLE `berkala`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bup`
--
ALTER TABLE `bup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kepangkatan`
--
ALTER TABLE `kepangkatan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berkala`
--
ALTER TABLE `berkala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bup`
--
ALTER TABLE `bup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kepangkatan`
--
ALTER TABLE `kepangkatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
