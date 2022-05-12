-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2022 pada 07.39
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyekakhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `username` varchar(50) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`username`, `pwd`, `last_login`) VALUES
('adminpakan', '21232f297a57a5a743894a0e4a801fc3', '2021-06-14 18:16:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ayam`
--

CREATE TABLE `ayam` (
  `id_ayam` char(10) NOT NULL,
  `nama_ayam` varchar(20) DEFAULT NULL,
  `jenis_ayam` varchar(50) DEFAULT NULL,
  `usia_ayam` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ayam`
--

INSERT INTO `ayam` (`id_ayam`, `nama_ayam`, `jenis_ayam`, `usia_ayam`) VALUES
('AYM1', 'Ayam Manggala', 'Jantan', '2 Tahun'),
('AYM2', 'Rhode Island Red', 'Jantan', '5 Tahun'),
('AYM3', 'Ayam Broiler', 'Betina', '6 Tahun'),
('AYM4', 'Ayam Pelung', 'Jantan', '4 Tahun'),
('AYM5', 'Ayam Kampung', 'Jantan', '2 Tahun'),
('AYM6', 'Ayam Kampung', 'Betina', '2 Tahun'),
('AYM7', 'Ayam Ketawa', 'Betina', '6 Tahun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa`
--

CREATE TABLE `coa` (
  `kode_coa` varchar(100) NOT NULL,
  `nama_coa` varchar(100) NOT NULL,
  `header_akun` varchar(30) NOT NULL,
  `posisi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `coa`
--

INSERT INTO `coa` (`kode_coa`, `nama_coa`, `header_akun`, `posisi`) VALUES
('111', 'Kas', 'Harta', 'Debit'),
('112', 'Pembelian', 'Kewajiban', 'Kredit'),
('411', 'Penjualan', 'Pendapatan', 'Debit'),
('511', 'Beban Gaji', 'Beban', 'Kredit'),
('512', 'Beban Sewa', 'Beban', 'Kredit'),
('513', 'Beban Listrik', 'Beban', 'Kredit'),
('514', 'Beban Peralatan', 'Beban', 'Kredit'),
('515', 'Beban Air', 'Beban', 'Debit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `id_pakan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `id_transaksi`, `id_pakan`, `qty`, `harga_beli`, `total`) VALUES
(6, 'PMB-001', 'PKN1', 2, 25000, 50000),
(7, 'PMB-002', 'PKN2', 1, 28000, 28000),
(8, 'PMB-003', 'PKN1', 5, 25000, 125000),
(9, 'PMB-004', 'PKN5', 3, 25000, 75000),
(10, 'PMB-004', 'PKN6', 3, 26500, 79500),
(11, 'PMB-005', 'PKN7', 3, 27500, 82500),
(12, 'PMB-006', 'PKN4', 1, 32000, 32000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `id_pakan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `id_transaksi`, `id_pakan`, `qty`, `harga_jual`, `total`) VALUES
(7, 'PNJ-001', 'PKN1', 3, 28000, 84000),
(8, 'PNJ-002', 'PKN2', 2, 30000, 60000),
(9, 'PNJ-003', 'PKN4', 3, 34000, 102000),
(10, 'PNJ-004', 'PKN1', 5, 28000, 140000),
(11, 'PNJ-005', 'PKN5', 2, 28000, 56000),
(12, 'PNJ-005', 'PKN6', 3, 29000, 87000),
(13, 'PNJ-006', 'PKN7', 3, 31000, 93000),
(14, 'PNJ-007', 'PKN6', 1, 29000, 29000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `kode_akun` int(11) NOT NULL,
  `tgl_jurnal` date NOT NULL,
  `posisi_d_c` varchar(1) NOT NULL,
  `nominal` double NOT NULL,
  `kelompok` int(11) NOT NULL,
  `transaksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`id`, `id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`) VALUES
(27, 'PNJ-001', 111, '2022-01-05', 'd', 84000, 2, 'penjualan'),
(28, 'PNJ-001', 411, '2022-01-05', 'c', 84000, 2, 'penjualan'),
(29, 'PNJ-002', 111, '2022-01-05', 'd', 60000, 2, 'penjualan'),
(30, 'PNJ-002', 411, '2022-01-05', 'c', 60000, 2, 'penjualan'),
(31, 'PMB-001', 112, '2022-01-05', 'd', 50000, 3, 'pembelian'),
(32, 'PMB-001', 111, '2022-01-05', 'c', 50000, 3, 'pembelian'),
(33, 'PMB-002', 112, '2022-01-05', 'd', 28000, 3, 'pembelian'),
(34, 'PMB-002', 111, '2022-01-05', 'c', 28000, 3, 'pembelian'),
(35, '1', 513, '2022-01-05', 'd', 150000, 1, 'pembebanan'),
(36, '1', 111, '2022-01-05', 'c', 150000, 1, 'pembebanan'),
(37, '2', 512, '2022-01-09', 'd', 200000, 1, 'pembebanan'),
(38, '2', 111, '2022-01-09', 'c', 200000, 1, 'pembebanan'),
(39, 'PNJ-003', 111, '2022-01-08', 'd', 102000, 2, 'penjualan'),
(40, 'PNJ-003', 411, '2022-01-08', 'c', 102000, 2, 'penjualan'),
(41, 'PNJ-004', 111, '2022-01-08', 'd', 140000, 2, 'penjualan'),
(42, 'PNJ-004', 411, '2022-01-08', 'c', 140000, 2, 'penjualan'),
(43, 'PMB-003', 112, '2022-01-08', 'd', 125000, 3, 'pembelian'),
(44, 'PMB-003', 111, '2022-01-08', 'c', 125000, 3, 'pembelian'),
(45, 'PNJ-005', 111, '2022-01-09', 'd', 143000, 2, 'penjualan'),
(46, 'PNJ-005', 411, '2022-01-09', 'c', 143000, 2, 'penjualan'),
(47, 'PMB-004', 112, '2022-01-09', 'd', 154500, 3, 'pembelian'),
(48, 'PMB-004', 111, '2022-01-09', 'c', 154500, 3, 'pembelian'),
(49, 'PNJ-006', 111, '2022-01-09', 'd', 93000, 2, 'penjualan'),
(50, 'PNJ-006', 411, '2022-01-09', 'c', 93000, 2, 'penjualan'),
(51, 'PMB-005', 112, '2022-01-09', 'd', 82500, 3, 'pembelian'),
(52, 'PMB-005', 111, '2022-01-09', 'c', 82500, 3, 'pembelian'),
(53, 'PNJ-007', 111, '2022-01-18', 'd', 29000, 2, 'penjualan'),
(54, 'PNJ-007', 411, '2022-01-18', 'c', 29000, 2, 'penjualan'),
(55, 'PMB-006', 112, '2022-01-18', 'd', 32000, 3, 'pembelian'),
(56, 'PMB-006', 111, '2022-01-18', 'c', 32000, 3, 'pembelian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kandang`
--

CREATE TABLE `kandang` (
  `id_kandang` char(10) NOT NULL,
  `nama_kandang` varchar(50) NOT NULL,
  `jenis_kandang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kandang`
--

INSERT INTO `kandang` (`id_kandang`, `nama_kandang`, `jenis_kandang`) VALUES
('KNDG1', 'Sevilla', 'Reguler'),
('KNDG2', 'Chicken Coop', 'Khusus'),
('KNDG3', 'Postal', 'Reguler'),
('KNDG4', 'Koloni', 'Reguler'),
('KNDG5', 'Closed House', 'Khusus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakai`
--

CREATE TABLE `pakai` (
  `no_pakai` char(10) NOT NULL,
  `nama_kandang` varchar(50) NOT NULL,
  `nama_ayam` varchar(50) NOT NULL,
  `nama_pakan` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pakai`
--

INSERT INTO `pakai` (`no_pakai`, `nama_kandang`, `nama_ayam`, `nama_pakan`, `jumlah`) VALUES
('PKAI1', 'Sevilla', 'Ayam Manggala', 'ChickBoost', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakan`
--

CREATE TABLE `pakan` (
  `id_pakan` char(10) NOT NULL,
  `nama_pakan` varchar(20) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `harga_beli` int(11) NOT NULL,
  `jenis_pakan` varchar(50) DEFAULT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pakan`
--

INSERT INTO `pakan` (`id_pakan`, `nama_pakan`, `harga_jual`, `harga_beli`, `jenis_pakan`, `satuan`) VALUES
('PKN1', 'ChickBoost', 28000, 25000, 'Pre-starter', 'Kilogram'),
('PKN2', 'CBR 1 Plus', 30000, 28000, 'Starter', 'Kilogram'),
('PKN3', 'CBR 2 Plus', 32000, 30000, 'Finisher', 'Kilogram'),
('PKN4', 'CL 5 SP', 34000, 32000, 'Layer', 'Kilogram'),
('PKN5', 'BR 1 SS', 28000, 25000, 'Pre-starter', 'Kilogram'),
('PKN6', 'BR 1 S', 29000, 26500, 'Starter', 'Kilogram'),
('PKN7', 'BR 1 W', 31000, 27500, 'Finisher', 'Kilogram'),
('PKN8', 'P 3-1', 26000, 22000, 'Layer', 'Kilogram');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(10) NOT NULL,
  `nm_pelanggan` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nm_pelanggan`, `alamat`, `no_telp`, `email`) VALUES
('PEL1', 'Kayla Nadira', 'Grand Sharon Residence, Bandung', '081222343512', 'kaylakazami911@gmail.com'),
('PEL2', 'Aliya Suryani', 'Gegerkalong, Bandung', '081233456331', 'alias01@gmail.com'),
('PEL3', 'Kamila Asy Syifa', 'Babakan Leuwi Bandung', '087756789000', 'lisasyifa@gmail.com'),
('PEL4', 'Khalisya Humaira', 'Permata Buah Batu, Bandung', '081221334552', 'khalisa@gmail.com'),
('PEL5', 'Ma\'rifahtun Khasanah', 'Jl. Parung Halang, Bandung', '081316021563', 'khasanahmarifah091@gmail.com'),
('PEL6', 'Nadzira Shafa S', 'Perumahan Akita, Bojongsoang, Bandung', '087767334556', 'shafadzira@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` varchar(10) NOT NULL,
  `nm_pemasok` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nm_pemasok`, `alamat`, `no_telp`, `email`) VALUES
('PSK1', 'Citra Feed', 'Jakarta Timur', ' (021) 8400844', 'guyofeed@centrin.net.id'),
('PSK2', 'Farmsco', 'Tangerang', '(0254) 480999', 'farmsco@gmail.com'),
('PSK3', 'Wonokoyo', 'Tangerang', '(021) 29863092', 'infoweb@wonokoyo.co.id'),
('PSK4', 'Medion', 'Bogor', '(0251) 8345865', 'cs@medion.co.id');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembebanan`
--

CREATE TABLE `pembebanan` (
  `id_transaksi` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembebanan`
--

INSERT INTO `pembebanan` (`id_transaksi`, `biaya`, `nama`, `waktu`) VALUES
(1, 150000, 'Listrik Periode Januari', '2022-01-09 20:41:48'),
(2, 200000, 'Sewa Kandang Periode Januari', '2022-01-09 20:41:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `id_pemasok` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_transaksi`, `id_pemasok`, `tanggal`, `total`, `status`) VALUES
(5, 'PMB-001', 'PSK1', '2022-01-05', 50000, 'selesai'),
(6, 'PMB-002', 'PSK2', '2022-01-05', 28000, 'selesai'),
(7, 'PMB-003', 'PSK3', '2022-01-08', 125000, 'selesai'),
(8, 'PMB-004', 'PSK4', '2022-01-09', 154500, 'selesai'),
(9, 'PMB-005', 'PSK2', '2022-01-09', 82500, 'selesai'),
(10, 'PMB-006', 'PSK3', '2022-01-18', 32000, 'selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `id_pelanggan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_transaksi`, `id_pelanggan`, `tanggal`, `total`, `status`) VALUES
(7, 'PNJ-001', 'PEL1', '2022-01-05', 84000, 'selesai'),
(8, 'PNJ-002', 'PEL2', '2022-01-05', 60000, 'selesai'),
(9, 'PNJ-003', 'PEL6', '2022-01-08', 102000, 'selesai'),
(10, 'PNJ-004', 'PEL3', '2022-01-08', 140000, 'selesai'),
(11, 'PNJ-005', 'PEL5', '2022-01-09', 143000, 'selesai'),
(12, 'PNJ-006', 'PEL4', '2022-01-09', 93000, 'selesai'),
(13, 'PNJ-007', 'PEL5', '2022-01-18', 29000, 'selesai');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_transaksi` (
`id_transaksi` int(11)
,`waktu` datetime
,`sumber` varchar(10)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_transaksi`
--
DROP TABLE IF EXISTS `view_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi`  AS SELECT `pembebanan`.`id_transaksi` AS `id_transaksi`, `pembebanan`.`waktu` AS `waktu`, 'pembebanan' AS `sumber` FROM `pembebanan` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `ayam`
--
ALTER TABLE `ayam`
  ADD PRIMARY KEY (`id_ayam`);

--
-- Indeks untuk tabel `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`kode_coa`);

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kandang`
--
ALTER TABLE `kandang`
  ADD PRIMARY KEY (`id_kandang`);

--
-- Indeks untuk tabel `pakai`
--
ALTER TABLE `pakai`
  ADD PRIMARY KEY (`no_pakai`);

--
-- Indeks untuk tabel `pakan`
--
ALTER TABLE `pakan`
  ADD PRIMARY KEY (`id_pakan`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indeks untuk tabel `pembebanan`
--
ALTER TABLE `pembebanan`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
