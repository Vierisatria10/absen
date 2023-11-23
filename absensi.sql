-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Nov 2023 pada 14.49
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

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
  `Keterangan` enum('hadir','sakit','izin','alpha') DEFAULT 'hadir',
  `ID_Hari_Libur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`ID_Absensi`, `ID_Siswa`, `Waktu_Absensi`, `Keterangan`, `ID_Hari_Libur`) VALUES
(34, 57738193, '2023-11-01 10:17:57', 'hadir', NULL);

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
-- Struktur dari tabel `hari_libur`
--

CREATE TABLE `hari_libur` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `ID_Kelas` int(11) DEFAULT NULL,
  `foto_siswa` varchar(220) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `chat_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`ID_Siswa`, `Nama_Siswa`, `NIS`, `Tanggal_Lahir`, `Alamat`, `ID_Kelas`, `foto_siswa`, `token`, `chat_id`) VALUES
(57738193, 'MUHAMMAD RIVAI', '0057738193', '2005-11-01', 'KALIREJO', 2, '65426b5d62497.png', NULL, NULL),
(59350498, 'FAIZAL NICKI HANAFI', '0059350498', '2005-07-16', 'KALIREJO', 2, '65426bfa3e88c.jpeg', NULL, NULL),
(59449818, 'SELLY UMMI NADHIA', '0059449818', '2005-12-30', 'BANDUNG BARU', 2, '65426cfeb8aeb.png', NULL, NULL),
(63441822, 'RENDI TRIO FEBRIAN', '0063441822', '2006-02-12', 'SENDANG MUKTI', 2, '65426b129e370.png', NULL, NULL),
(65034136, 'KAMELIA DWI HIDAYANTI', '0065034136', '2006-09-10', 'SRIMULYO', 2, '65426a9320708.jpeg', NULL, NULL),
(65998708, 'NAILA NUR FADILA', '0065998708', '2006-11-25', 'KALIDADI', 2, '65426a069dacf.jpeg', NULL, NULL),
(66623625, 'REVALIA ARLETA', '0066623625', '2006-12-24', 'SRIMULYO', 2, '65426ca1c0373.png', NULL, NULL);

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
  ADD KEY `FK_ID_Siswa` (`ID_Siswa`),
  ADD KEY `FK_ID_Hari_Libur` (`ID_Hari_Libur`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`ID_Guru`);

--
-- Indeks untuk tabel `hari_libur`
--
ALTER TABLE `hari_libur`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `ID_Absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `ID_Guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hari_libur`
--
ALTER TABLE `hari_libur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `FK_ID_Hari_Libur` FOREIGN KEY (`ID_Hari_Libur`) REFERENCES `hari_libur` (`id`),
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
