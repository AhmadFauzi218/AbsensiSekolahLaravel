-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Apr 2020 pada 18.13
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nis_siswa` int(255) DEFAULT NULL,
  `absen_date` date DEFAULT NULL,
  `absen_time` time DEFAULT NULL,
  `absen_status` int(11) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id`, `id_user`, `nis_siswa`, `absen_date`, `absen_time`, `absen_status`, `keterangan`) VALUES
(1, 34, 12345, '2020-04-21', '19:46:38', 1, 'Hadir'),
(2, 34, 12346, '2020-04-21', '19:47:38', 3, 'Dispen'),
(3, 34, 12347, '2020-04-21', '19:59:11', 1, 'Hadir'),
(4, 34, 12345, '2020-04-22', '20:01:24', 2, 'Panas, Badan Sakit'),
(5, 44, 12348, '2020-04-21', '21:29:56', 5, 'Ban depan Bocor'),
(6, 44, 12349, '2020-04-21', '21:30:16', 5, 'Macet'),
(7, 44, 12356, '2020-04-21', '21:30:30', 5, 'Kesiangan'),
(8, 44, 12351, '2020-04-21', '21:55:11', 5, 'Kesiangan'),
(9, 34, 12345, '2020-04-23', '23:10:29', 2, 'Panas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`nip`, `nama`, `jenis_kelamin`, `no_hp`, `alamat`) VALUES
('17181056', 'Tedy H', 'Laki - Laki', '085324237299', 'Babakan'),
('17181057', 'Mohammad Ibrahim', 'Laki - Laki', '085224503737', 'Perum'),
('17181058', 'Farhan Ramadhan', 'Laki - Laki', '2839283238', 'Jln. Suratno'),
('17181059', 'Mohammad Ramdan', 'Laki - Laki', '2727422', 'Jln. Perjuangan No. 101'),
('17181060', 'Siti Elsa', 'Perempuan', '28392221', 'Jln. Cipto Mangunkusumo'),
('17181061', 'Agus Budiman', 'Laki - Laki', '27272727', 'Jln. Kartini No. 150'),
('17181062', 'Dani Wahyudi', 'Laki - Laki', '28392839', 'Jln. Mangunkusumo No. 120'),
('17181063', 'Yanuar hidayah', 'Laki - Laki', '3894384398', 'Gunung Jati'),
('17181064', 'Fatur Rizki', 'Laki - Laki', '3848349', 'Jln. Wahidin'),
('17181065', 'Ahmad Zaki Afif', 'Laki - Laki', '2839283821', 'Pilang Mas Garden No. 150'),
('17181066', 'Ahmad Santoso', 'Laki - Laki', '1829181', 'Kedawung Raya'),
('17181067', 'Ahmad Heri', 'Laki - Laki', '21881818', 'Sumber');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_piket`
--

CREATE TABLE `jadwal_piket` (
  `id` int(11) NOT NULL,
  `nip_guru` int(255) DEFAULT NULL,
  `hari` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_piket`
--

INSERT INTO `jadwal_piket` (`id`, `nip_guru`, `hari`, `status`) VALUES
(1, 17181061, 'Senin', 1),
(2, 17181067, 'Senin', 1),
(4, 17181065, 'Selasa', 1),
(5, 17181062, 'Selasa', 1),
(6, 17181058, 'Rabu', 1),
(7, 17181066, 'Senin', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_wali_kelas` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `nip_wali_kelas`) VALUES
(1, 'XII RPL 1', 17181057),
(2, 'XII RPL 2', 17181056),
(3, 'XII MM', 17181058),
(4, 'XII TKJ', 17181059),
(5, 'X RPL', 17181060),
(6, 'X TKJ', 17181062),
(7, 'X MM', 17181061),
(8, 'XI RPL', 17181064),
(9, 'XI MM 1', 17181063),
(10, 'XI TKJ', 17181065),
(11, 'XI MM 2', 17181067);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(255) NOT NULL,
  `nama` varchar(191) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `alamat` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `id_kelas`, `no_telp`, `jenis_kelamin`, `alamat`) VALUES
('12345', 'Adjie Bintang W', 2, '8493843', 'Laki - Laki', 'Drajat'),
('12346', 'Ahmad Zakaria', 2, '9239231', 'Laki - Laki', 'Mundu'),
('12347', 'Alfarrel Rizki Setiawan', 2, '23222', 'Laki - Laki', 'Lawanggada, Kesambi'),
('12348', 'Chandra Maulana Khalim', 2, '9203222', 'Laki - Laki', 'Kesambi'),
('12349', 'Denvin Adhi Syahputra', 2, '28392392', 'Laki - Laki', 'Kedawung'),
('12350', 'Elang Luthfi N', 2, '177171', 'Laki - Laki', 'Pamengkang'),
('12351', 'Fadel Muhammad', 2, '99272', 'Laki - Laki', 'Kasepuhan'),
('12352', 'Firli Ardiansyah', 2, '887222', 'Laki - Laki', 'Pilang Mas Garden'),
('12353', 'Gilang Dwi Saputra', 2, '87222', 'Laki - Laki', 'Mundu'),
('12354', 'Husin A A', 2, '2839211', 'Laki - Laki', 'Perum'),
('12355', 'M Ilham Teguhriyadi', 2, '08522045923', 'Laki - Laki', 'Villa Intan 2 Blok i4 No.1'),
('12356', 'Dheby Silvia A P', 2, '88222', 'Perempuan', 'Jln. Perjuangan'),
('12357', 'Michael Musthafa', 2, '112333', 'Laki - Laki', 'Tengah Tani'),
('12358', 'Ahmad Wildan A', 1, '283211', 'Laki - Laki', 'Perum'),
('12359', 'Ahmad Fauzi', 1, '77888', 'Laki - Laki', 'Kedawung'),
('12360', 'M Tigin Sawala', 1, '920311', 'Laki - Laki', 'Villa Intan 2 Blok L'),
('12361', 'Wemal A', 1, '281111', 'Laki - Laki', 'Jln. Sultan Agung'),
('12362', 'M Ridho', 1, '291919', 'Laki - Laki', 'Perum'),
('12363', 'Dinar Nurjaman', 1, '922828', 'Laki - Laki', 'Kesambi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `role` int(1) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `id_kelas` int(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `remember_token`, `role`, `active`, `id_kelas`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$G7kK56uFWYRrFEUhSyEK/esES6EJaKQ1FzysLwlEbHUxti.woy5T6', NULL, 1, 1, NULL, '2020-03-24 00:47:14', '2020-03-24 00:47:14'),
(33, 'Mohammad Ibrahim', '17181057', '$2y$10$35QapaXyj1bR0rZOn7xGDuJDpic7TWZe1LJEUnMpDnhcO25ySyGgm', NULL, 2, 1, 1, '2020-04-21 11:19:24', '2020-04-21 11:19:24'),
(34, 'Tedy H', '17181056', '$2y$10$hkV3qUd/0Y4O58uKsLO1FOPZ2AoI7w4RDSOqLpYmdt6E6x3KFKoRe', NULL, 2, 1, 2, '2020-04-21 11:19:55', '2020-04-21 11:19:55'),
(35, 'Farhan Ramadhan', '17181058', '$2y$10$4yGj9i2D4cV.14NN/VnuVOmsnEWv2Zf57/wrxNzv.ULyZ0wL.aEQO', NULL, 2, 1, 3, '2020-04-21 11:23:32', '2020-04-21 11:23:32'),
(36, 'Mohammad Ramdan', '17181059', '$2y$10$WLyDqKY1EJzxpZBJqwDxAeErEwIfn6TVFaaSTcWePUv9prbryK/Eq', NULL, 2, 1, 4, '2020-04-21 11:23:43', '2020-04-21 11:23:43'),
(37, 'Siti Elsa', '17181060', '$2y$10$XCSVfHar2/2dFClsfS/t.eBWhjgn6B7C6zv98J2qrTQByw9iMJ4GS', NULL, 2, 1, 5, '2020-04-21 11:36:00', '2020-04-21 11:36:00'),
(38, 'Dani Wahyudi', '17181062', '$2y$10$VjXCeqTrGMIm24Y.z9V3qOuMIJpb9uLU7vNbIeAU1nk2rUG08ZLfW', NULL, 2, 1, 6, '2020-04-21 11:36:11', '2020-04-21 11:36:11'),
(39, 'Agus Budiman', '17181061', '$2y$10$1/urEDmT7GIGeriaqbJ4Wu6r0k.22cJ7YBeqkvPn5Q2WDSmUBq9ki', NULL, 2, 1, 7, '2020-04-21 11:36:22', '2020-04-21 11:36:22'),
(40, 'Fatur Rizki', '17181064', '$2y$10$7N7nkLQrwsJawlBaLsN9jOObxXXmcJuYlcuxcHuX0/45yPlPE/6La', NULL, 2, 1, 8, '2020-04-21 11:58:27', '2020-04-21 11:58:27'),
(41, 'Yanuar hidayah', '17181063', '$2y$10$UvgmcRg4KTdns/4sEZFLP.XJFw9gmE8KOZbIPusB/dZ7ooFcZAhHy', NULL, 2, 1, 9, '2020-04-21 11:58:40', '2020-04-21 11:59:12'),
(42, 'Ahmad Zaki Afif', '17181065', '$2y$10$Lh96vt/QRHI9ayefYWT2EewwwQKbQomj4OV31K/3C2vTwAEFQNdz6', NULL, 2, 1, 10, '2020-04-21 11:58:51', '2020-04-21 11:58:51'),
(43, 'Ahmad Heri', '17181067', '$2y$10$AOReooLtpj7HNjd8uRO14efRnZvWLaYD7NfyuPaCEkEdaj32s2j7G', NULL, 2, 1, 11, '2020-04-21 12:02:52', '2020-04-21 12:02:52'),
(44, 'Agus Budiman', '17181061', '$2y$10$gyhdHuj2hTGfnbE.D5HjYObU6vp8YhmWStUIvkS8kFcrDNHRTWj4y', NULL, 3, 1, NULL, '2020-04-21 12:25:28', '2020-04-21 12:25:28'),
(45, 'Ahmad Heri', '17181067', '$2y$10$mulKDwojCGX8biRCPrAFze8cwBYrmNansmHvFc28HDvmjMtggiMie', NULL, 3, 1, NULL, '2020-04-21 12:25:37', '2020-04-21 12:25:37'),
(47, 'Ahmad Zaki Afif', '17181065', '$2y$10$54ozNyYEiMo74ZWHB4hCL.rYZd5Sy3N7HPruA0YB1.VIN4L0BNJgy', NULL, 3, 1, NULL, '2020-04-21 12:25:49', '2020-04-21 12:25:56'),
(48, 'Dani Wahyudi', '17181062', '$2y$10$lm9fYF0dJsN.Aq0x37YT1.GdQmY6l3Xr.rD9Oh.NnKIGWbAfOoCYa', NULL, 3, 1, NULL, '2020-04-21 12:26:21', '2020-04-21 12:26:21'),
(49, 'Farhan Ramadhan', '17181058', '$2y$10$/tN8sfIYU27J/Sma27fZQ.kNPX1cKW7iODFbGRVrO.Ob5.kaA/Ziy', NULL, 3, 1, NULL, '2020-04-21 12:26:30', '2020-04-21 12:26:41'),
(50, 'Ahmad Santoso', '17181066', '$2y$10$Lb7aQISx.ybCfxIAmum2n.O1HVCFaibHFUnzuBRHP90ma5LS0XMDe', NULL, 3, 1, NULL, '2020-04-21 12:27:09', '2020-04-21 12:27:09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `jadwal_piket`
--
ALTER TABLE `jadwal_piket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jadwal_piket`
--
ALTER TABLE `jadwal_piket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
