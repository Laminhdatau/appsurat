-- phpMyAdmin SQL Dump
-- version 5.1.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2023 at 01:19 PM
-- Server version: 8.0.33-0ubuntu0.22.10.2
-- PHP Version: 8.1.7-1ubuntu3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_pegawai`
--

CREATE TABLE `t_pegawai` (
  `id_pegawai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nip` char(18) DEFAULT NULL,
  `pangkat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tmpt_lahir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `jenis_pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_instansi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_pegawai`
--

INSERT INTO `t_pegawai` (`id_pegawai`, `nama_lengkap`, `nip`, `pangkat`, `golongan`, `jabatan`, `tmpt_lahir`, `tanggal_lahir`, `jenis_kelamin`, `jenis_pegawai`, `id_instansi`, `keterangan`) VALUES
('761c7b75-2966-11ee-b728-503eaa456e2a', 'Akub Zainal S. Busura, SH, MH', '196808202005011003', 'Pembina', 'IV/a', 'Arsiparis Ahli Muda', 'Gorontalo', '1968-08-20', 'Laki-laki', 'PNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT 1 April 2021\r'),
('761c7d44-2966-11ee-b728-503eaa456e2a', 'Rivai Hamzah Amate, S.Pd, M.Si', '196612201995011001', 'Pembina Tkt. I', 'IV/b', 'Arsiparis Ahli Madya', 'Gorontalo', '1966-12-20', 'Laki-laki', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Feb.  2022 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c7ed7-2966-11ee-b728-503eaa456e2a', 'Munawir Sadzali Razak, S.IP. MA', '198306102006041001', 'Pembina Tkt. I', 'IV/b', 'Kepala Lembaga', 'Sinjai', '1983-06-10', 'Laki-laki', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Juni  2022 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c819b-2966-11ee-b728-503eaa456e2a', 'Herlina Astuti Bengkal, S.Pd', '197909132005012003', 'Penata', 'III/c', 'Bendahara', 'Gorontalo', '1979-09-13', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT 1 Januari 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c843a-2966-11ee-b728-503eaa456e2a', 'Rubianasari Laisa, S.Pd', '197205101998022001', 'Penata Muda Tkt. I', 'III/b', 'Analis Kepegawaian Ahli Muda', 'Gorontalo', '1972-05-10', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT 1 Januari 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c85c5-2966-11ee-b728-503eaa456e2a', 'Sugandi H. Moito', '197806252009101001', 'Pengatur Tingkat I', 'II/d', 'Pengadministrasi Kepegawaian', 'Paguyaman', '1978-06-25', 'Laki-laki', 'PNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT 1 Oktober 2021\r'),
('761c8742-2966-11ee-b728-503eaa456e2a', 'Drs. Irwan Halid, M.Sc', '196812291989011002', 'Pembina Tkt. I', 'IV/b', 'Kepala Bagian Umum', 'Gorontalo', '1968-12-29', 'Laki-laki', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  28 Januari 2022\r'),
('761c88ac-2966-11ee-b728-503eaa456e2a', 'Hariyanto T. Huntua, S.Sos, SE, MM', '197012051994031005', 'Pembina Tkt. I', 'IV/b', 'Analis Sarana Pendidikan', 'Manado', '1970-12-05', 'Laki-laki', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 April 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c8a16-2966-11ee-b728-503eaa456e2a', 'Leliyana Lahay, S.Kom', '197606172002122005', 'Penata Tkt. I', 'III/d', 'Analis Sistem Informasi dan Jaringan', 'Kecamata Suwawa Gorontalo', '1976-06-17', 'Perempuan', 'PNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT  1 April 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c8b94-2966-11ee-b728-503eaa456e2a', 'Novel Acub Umar, SE, M.Si', '197711072007011006', 'Penata Tkt. I', 'III/d', 'Analis Barang Milik Negara', 'Manado', '1977-11-07', 'Laki-laki', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Oktober 2021\r'),
('761c8d07-2966-11ee-b728-503eaa456e2a', 'Yusna Dani, SP, MM', '197405152009012002', 'Penata Tkt. I', 'III/d', 'Penyusun Program, Anggaran dan Pelaporan', 'Gorontalo', '1974-05-15', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Oktober 2021\r'),
('761c8e69-2966-11ee-b728-503eaa456e2a', 'Selvy Hinelo, S.IP', '197706182005012008', 'Penata Muda Tkt. I', 'III/b', 'Analis Organisasi', 'Gorontalo', '1977-06-18', 'Perempuan', 'PNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT  1 April 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c8fda-2966-11ee-b728-503eaa456e2a', 'Darwin Baruwadi, S.Pd, M.Pd', '196909202005011012', 'Pembina', 'IV/a', 'Analis Kualifikasi dan Karir Pendidik dan Tenaga Kependidikan', 'Gorontalo', '1969-09-20', 'Laki-laki', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 April 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c9149-2966-11ee-b728-503eaa456e2a', 'Linda Van Gobel, S.Pd, M.Pd', '198107282005012016', 'Pembina', 'IV/a', 'Analis Prasarana Pendidikan', 'Bolangitang Barat', '1981-07-28', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 April 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c92b0-2966-11ee-b728-503eaa456e2a', 'Lapandri Ilahude, SE', '197404082009011001', 'Penata Tkt. I', 'III/d', 'Pengolah Data', 'Gorontalo', '1974-04-08', 'Laki-laki', 'PNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT  1 Oktober 2021\r'),
('761c9419-2966-11ee-b728-503eaa456e2a', 'Tris Meriyana Yapanto, SE., MM', '197006032010012001', 'Penata Tkt. I', 'III/d', 'Verifikator Keuangan', 'Gorontalo', '1970-06-03', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Oktober 2021\r'),
('761c957f-2966-11ee-b728-503eaa456e2a', 'Surajuddin Laliyo, SE', '197211291994031002', 'Penata Tkt. I', 'III/d', 'Pengelola Barang Milik Negara', 'Gorontalo', '1972-11-29', 'Laki-laki', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 April 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c96e6-2966-11ee-b728-503eaa456e2a', 'Rahnikmawati Hasan, A.Md', '197908072006042014', 'Penata Muda Tkt. I', 'III/b', 'Pengolah Data', 'Tibawa', '1979-08-07', 'Perempuan', 'PNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT  1 April 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c98a6-2966-11ee-b728-503eaa456e2a', 'Sri Rahayu Modjo, A.Md', '197911062005012003', 'Penata Muda', 'III/a', 'Pengolah Data', 'Gorontalo', '1979-11-06', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 April 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c9a14-2966-11ee-b728-503eaa456e2a', 'Endang Hamzah', '197007312000031002', 'Penata Muda Tkt. I', 'III/b', 'Pengolah Data', 'Gorontalo', '1970-07-31', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 April 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c9b80-2966-11ee-b728-503eaa456e2a', 'Syafrudin T. Abdul, SE., M.Si', '198206112009011002', 'Penata', 'III/c', 'Pengolah Data', 'Gorontalo', '1982-06-11', 'Laki-laki', 'PNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT  1 Mei  2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c9ce5-2966-11ee-b728-503eaa456e2a', 'Bambang Dermawan Podungge, S.Pd', '197707012005011013', 'Pembina', 'IV/a', 'Pengolah Data Program Beasiswa', 'Gorontalo', '1977-07-01', 'Laki-laki', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Juni 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c9e54-2966-11ee-b728-503eaa456e2a', 'Pelmawaty Djafar, S.E', '198404142008012015', 'Penata', 'III/c', 'Pengelola Keuangan', 'Gorontalo', '2022-01-01', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Juni 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761c9fb5-2966-11ee-b728-503eaa456e2a', 'Saiful Kiay, S.Pd., M.Si', '197910272007011005', 'Penata Tkt. I', 'III/d', 'Pengelola Keuangan', 'Gorontalo', '1979-10-27', 'Laki-laki', 'PNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT  1 Juni 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761ca11d-2966-11ee-b728-503eaa456e2a', 'Fatra Juwita Dewi Puspita Dano Putri, S.H., M.I.Kom', '198811032011012001', 'Penata', 'III/c', 'Pengolah Bahan Informasi dan Publikasi', 'Manado', '2022-01-01', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Juni 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761ca283-2966-11ee-b728-503eaa456e2a', 'Risnawati Labdjo', '197112102007012014', 'Penata', 'III/c', 'Pengelola Kepegawain', 'Gorontalo', '2022-01-01', 'Perempuan', 'PNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Juli 2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761ca3f3-2966-11ee-b728-503eaa456e2a', 'Aminnur J. Dj. Mohi, SPd.I., M.si', '198411212005011004', 'Penata Tkt. I', 'IV/a', 'Pengelola Informasi Akademik', 'Marisa', '1984-11-21', 'Laki-laki', 'PNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT  1 September  2021 dimutasi Ke LLDIKTI Wil. XVI\r'),
('761ca565-2966-11ee-b728-503eaa456e2a', 'Rian Oktavianto Husain, S.Kom', '199110262022031006', 'CPNS', 'III/a', 'Analis Kualifikasi dan Karir Pendidik dan Tenaga Kependidikan', 'Gorontalo', '1991-10-26', 'Laki-laki', 'CPNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Maret 2022 CPNS LL16\r'),
('761ca6d0-2966-11ee-b728-503eaa456e2a', 'Auliya Cornelia Hidayat, SE', '199605032022032014', 'CPNS', 'III/a', 'Analis Pelaksanaan Akademik dan Kemahasiswaan', 'Gorontalo', '1996-05-03', 'Perempuan', 'CPNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Maret 2022 CPNS LL16\r'),
('761ca833-2966-11ee-b728-503eaa456e2a', 'Meity Adam, S.H', '198805202022032006', 'CPNS', 'III/a', 'Analis Tata Laksana', 'Gorontalo', '1988-05-20', 'Perempuan', 'CPNS', '7b8bb77e-0bf0-11ee-841a-503eaa456e2a', 'TMT  1 Maret 2022 CPNS LL16\r'),
('761ca95b-2966-11ee-b728-503eaa456e2a', 'Haris Labantu, SE', '199101202022031005', 'CPNS', 'III/a', 'Penyusun Program, Anggaran dan Pelaporan', 'Gorontalo', '1991-10-12', 'Laki-laki', 'CPNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Maret 2022 CPNS LL16\r'),
('761caa82-2966-11ee-b728-503eaa456e2a', 'Lowry Rimbault, A.Md.T', '200005282022031004', 'CPNS', 'II/c', 'Teknisi sarana & Prasarana', '', '2000-05-28', 'Laki-laki', 'CPNS', '782909e8-09b4-11ee-8c85-503eaa456e2a', 'TMT  1 Maret 2022 CPNS LL16\r');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_pegawai`
--
ALTER TABLE `t_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_instansi` (`id_instansi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
