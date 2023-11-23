-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Okt 2023 pada 15.57
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `ID_Absensi` int(11) NOT NULL,
  `ID_Siswa` bigint(20) DEFAULT NULL,
  `Waktu_Absensi` datetime NOT NULL,
  `Keterangan` enum('hadir','sakit','izin','alpha') DEFAULT 'hadir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `ID_Guru` int(11) NOT NULL,
  `Nama_Guru` varchar(255) DEFAULT NULL,
  `Mata_Pelajaran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`ID_Guru`, `Nama_Guru`, `Mata_Pelajaran`) VALUES
(1, 'Agung Septiawan', 'Platform Komputasi Awan'),
(2, 'Fajar Shodiq', 'Sistem Internet Of Things'),
(3, 'Hafidz Muhsiyy', 'PKKR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `ID_Kelas` int(11) NOT NULL,
  `Nama_Kelas` varchar(50) DEFAULT NULL,
  `ID_Wali_Kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`ID_Kelas`, `Nama_Kelas`, `ID_Wali_Kelas`) VALUES
(1, 'XII SIJA 2', 1),
(2, 'XII SIJA 1', 2),
(3, 'XII TKRO', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `ID_Siswa` bigint(20) NOT NULL,
  `Nama_Siswa` varchar(255) DEFAULT NULL,
  `NIS` varchar(10) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `ID_Kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`ID_Siswa`, `Nama_Siswa`, `NIS`, `Tanggal_Lahir`, `Alamat`, `ID_Kelas`) VALUES
(1664245521, 'Egista Adelia', '3454353', '2023-10-13', 'Sinarmarga', 3),
(1931368721, 'Refal Maheza', '3454367', '2023-10-27', 'Sukosari', 2),
(1931870227, 'Muhammad Rifki', '345435', '2023-10-27', 'Srimulyo', 2),
(3278050067, 'Fajar Shodiq', '465456', '2023-10-06', 'Bandung Baru', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmprfid`
--

CREATE TABLE `tmprfid` (
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`ID_Absensi`),
  ADD KEY `FK_ID_Siswa` (`ID_Siswa`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`ID_Guru`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`ID_Kelas`),
  ADD KEY `ID_Wali_Kelas` (`ID_Wali_Kelas`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`ID_Siswa`),
  ADD UNIQUE KEY `NIS` (`NIS`),
  ADD KEY `FK_ID_Kelas` (`ID_Kelas`);

--
-- Indeks untuk tabel `tmprfid`
--
ALTER TABLE `tmprfid`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `ID_Absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `ID_Guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `ID_Kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `ID_Siswa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3278050068;

--
-- AUTO_INCREMENT untuk tabel `tmprfid`
--
ALTER TABLE `tmprfid`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3278050068;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `FK_ID_Siswa` FOREIGN KEY (`ID_Siswa`) REFERENCES `siswa` (`ID_Siswa`);

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`ID_Wali_Kelas`) REFERENCES `guru` (`ID_Guru`);

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `FK_ID_Kelas` FOREIGN KEY (`ID_Kelas`) REFERENCES `kelas` (`ID_Kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
