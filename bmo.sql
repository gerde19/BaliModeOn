-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2022 pada 16.20
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `user_id` int(111) NOT NULL,
  `user_nama` varchar(255) NOT NULL,
  `user_email` varchar(111) NOT NULL,
  `user_password` varchar(111) NOT NULL,
  `user_foto` varchar(111) NOT NULL,
  `user_level` enum('admin','manajemen') NOT NULL,
  `user_status` enum('active','disable') NOT NULL,
  `user_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`user_id`, `user_nama`, `user_email`, `user_password`, `user_foto`, `user_level`, `user_status`, `user_date`) VALUES
(1, 'Gerde Aditya', 'gerde.aditya@gmail.com', '$2y$10$t1msT8gFWofGXWGRAMdbmOV.yT.P.m4dNaQFvBAAk.mBQgK2w0vLm', 'mr fredickson.png', 'admin', 'active', '2022-04-21'),
(2, 'Arsen Sarfaraz', 'arsen.sarfaraz@gmail.com', '$2y$10$ROY47d1852rJyAXVI2Yc.efnIg6W3PyX3jhWRAdbvUq8Qca1aghia', 'russell up.png', 'manajemen', 'active', '2022-04-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(111) NOT NULL,
  `cus_nama` varchar(255) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_password` varchar(255) NOT NULL,
  `cus_alamat` varchar(255) NOT NULL,
  `cus_kota` varchar(255) NOT NULL,
  `cus_provinsi` varchar(255) NOT NULL,
  `cus_negara` varchar(255) NOT NULL,
  `cus_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_nama`, `cus_email`, `cus_password`, `cus_alamat`, `cus_kota`, `cus_provinsi`, `cus_negara`, `cus_date`) VALUES
(1, 'Alias', 'alias@email.com', '$2y$10$W68prI2mCsfymsIcx.YG3ue1GotSaS.V8YTOqFaQDAuZSgTfKA6wS', 'Jl. Kuta 22', 'Denpasar', 'Bali', 'Indonesia', '2022-04-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kapal`
--

CREATE TABLE `detail_kapal` (
  `dk_id` int(111) NOT NULL,
  `dk_kode` int(111) NOT NULL,
  `dk_nama` varchar(255) NOT NULL,
  `dk_kapten` int(10) NOT NULL,
  `dk_kapasitas` decimal(65,0) NOT NULL,
  `dk_mesin` varchar(255) NOT NULL,
  `dk_day` decimal(65,0) NOT NULL,
  `dk_end` decimal(65,0) NOT NULL,
  `dk_perjam` decimal(65,0) NOT NULL,
  `dk_diskon` decimal(65,0) NOT NULL,
  `dk_gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `detail_kapal`
--

INSERT INTO `detail_kapal` (`dk_id`, `dk_kode`, `dk_nama`, `dk_kapten`, `dk_kapasitas`, `dk_mesin`, `dk_day`, `dk_end`, `dk_perjam`, `dk_diskon`, `dk_gambar`) VALUES
(1, 1, 'PINISI', 1, '5', 'SUZUKI DT15AL', '550000', '650000', '80000', '15000', 'kapal 01.jpg'),
(3, 2, 'KAPTEN JHON', 1, '5', 'MITSHUBISI POWER TRAIN', '500000', '600000', '70000', '10000', 'kapal02.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_kamar`
--

CREATE TABLE `kode_kamar` (
  `kh_id` bigint(111) UNSIGNED NOT NULL,
  `kh_kode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_kapal`
--

CREATE TABLE `kode_kapal` (
  `kk_id` bigint(111) UNSIGNED NOT NULL,
  `kk_kode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kode_kapal`
--

INSERT INTO `kode_kapal` (`kk_id`, `kk_kode`) VALUES
(1, 'KPL 001'),
(2, 'KPL 002'),
(3, 'KPL 003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_mobil`
--

CREATE TABLE `kode_mobil` (
  `km_id` bigint(111) UNSIGNED NOT NULL,
  `km_kode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(4, '2022-04-12-071302', 'App\\Database\\Migrations\\KodeKapal', 'default', 'App', 1649918139, 1),
(5, '2022-04-12-071327', 'App\\Database\\Migrations\\KodeMobil', 'default', 'App', 1649918139, 1),
(6, '2022-04-12-071333', 'App\\Database\\Migrations\\KodeKamar', 'default', 'App', 1649918139, 1),
(7, '2022-04-16-060713', 'App\\Database\\Migrations\\HargaKapal', 'default', 'App', 1650092024, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_kapal`
--

CREATE TABLE `transaksi_kapal` (
  `transaksi_id` int(111) NOT NULL,
  `customer` int(111) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nama_kapal` int(111) NOT NULL,
  `tgl_booking` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `harga_booking` decimal(65,0) NOT NULL,
  `harga_perjam` decimal(65,0) NOT NULL,
  `harga_bayar` decimal(65,0) NOT NULL,
  `kode_bank` int(111) NOT NULL,
  `status_kapal` enum('Berlayar','Kembali','Booked') NOT NULL,
  `status_pembayaran` enum('DP','Lunas','Belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi_kapal`
--

INSERT INTO `transaksi_kapal` (`transaksi_id`, `customer`, `nama`, `nama_kapal`, `tgl_booking`, `tgl_selesai`, `harga_booking`, `harga_perjam`, `harga_bayar`, `kode_bank`, `status_kapal`, `status_pembayaran`) VALUES
(1, 1, 'JARNO', 1, '2022-04-26', '2022-04-26', '550000', '80000', '550000', 75896947, 'Kembali', 'Lunas'),
(6, 1, 'NANDO', 3, '2022-04-26', '2022-04-26', '500000', '70000', '500000', 0, 'Kembali', 'Lunas'),
(7, 1, 'TRISTAN', 3, '2022-04-27', '2022-04-27', '500000', '70000', '0', 0, 'Booked', 'Belum');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indeks untuk tabel `detail_kapal`
--
ALTER TABLE `detail_kapal`
  ADD PRIMARY KEY (`dk_id`);

--
-- Indeks untuk tabel `kode_kamar`
--
ALTER TABLE `kode_kamar`
  ADD PRIMARY KEY (`kh_id`);

--
-- Indeks untuk tabel `kode_kapal`
--
ALTER TABLE `kode_kapal`
  ADD PRIMARY KEY (`kk_id`);

--
-- Indeks untuk tabel `kode_mobil`
--
ALTER TABLE `kode_mobil`
  ADD PRIMARY KEY (`km_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_kapal`
--
ALTER TABLE `transaksi_kapal`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `user_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_kapal`
--
ALTER TABLE `detail_kapal`
  MODIFY `dk_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kode_kamar`
--
ALTER TABLE `kode_kamar`
  MODIFY `kh_id` bigint(111) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kode_kapal`
--
ALTER TABLE `kode_kapal`
  MODIFY `kk_id` bigint(111) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kode_mobil`
--
ALTER TABLE `kode_mobil`
  MODIFY `km_id` bigint(111) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaksi_kapal`
--
ALTER TABLE `transaksi_kapal`
  MODIFY `transaksi_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
