-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 13, 2022 at 02:17 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siforest`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(5) NOT NULL,
  `tema` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tema_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_agenda` text COLLATE latin1_general_ci NOT NULL,
  `tempat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pengirim` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tgl_posting` date NOT NULL,
  `jam` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `tema`, `tema_seo`, `isi_agenda`, `tempat`, `pengirim`, `gambar`, `tgl_mulai`, `tgl_selesai`, `tgl_posting`, `jam`, `dibaca`, `username`) VALUES
(64, 'Elton John Greatest Hits Tour', 'elton-john-greatest-hits-tour', '<p>November ini,&nbsp; Indonesia akan disuguhkan salah satu konser megah dari legenda musik dunia yaitu Elton John. Penampilan Elton John yang pertama kalinya di Indonesia akan berlangsung pada 17 November 2012, di&nbsp; Sentul International Convention Center, Bogor yang lokasinya tidak begitu jauh dari Jakarta.<br />\r\n<br />\r\nKonser Elton John ini merupakan bagian dari tur dunianya yang bertajuk &ldquo;Greatest Hits Tour&rdquo; dan akan dimulai pada awal November dari Latvia sampai ke Australia. Elton John akan membawa band lamanya yang terdiri dari Davey Johnstone, Nigel Olsson, Robert Birch, Kim Bullard dan John Mahon, dan empat backing vocal yaitu Rose&nbsp; Batu (Sly dan The Family Stone), Lisa Bank, Tata Vega, dan Jean Witherspoon.</p>\r\n', 'Sentul International Convention Center', 'Robby Prihandaya', '', '2012-11-17', '2012-11-17', '2012-08-20', '02:00:00 - 13:30:00', 89, 'admin'),
(62, 'Maroon Live in Jakarta 2012', 'maroon-live-in-jakarta-2012', 'Maroon 5 akan kembali menghibur penggemar Jakarta mereka dengan sebuah konser pada 5 Oktober 2012 di Istora Senayan, Jakarta. Ini akan menjadi penampilan kedua mereka di tanah air setelah tampil pada konser sold out 27 April 2011 lalu. Grup musik beraliran pop rock yang berasal dari Los Angeles, California Amerika Serikat. Rencananya menggelar konsernya pada 5 Oktober 2012, di Istora Senayan, Jakarta. Java Musikindo selaku promotor telah mengumumkan pembagian kelas serta harga tiket konser. Band yang digawangi oleh Adam Levine (vokal/gitar), Jesse Carmichael (keyboard/gitar),Mickey Madden (bass), James Valentine (gitar), Matt Flynn (drum) ini menggelar konser di Jakarta sebagai bagian dari promo album barunya, Overexposed, yang dirilis Juni lalu.\r\n', 'Istora Senayan Jakarta', 'Muhammad Arsenio', '', '2012-10-05', '2012-10-05', '2012-08-19', '20:00:00 - Selesai', 25, 'admin'),
(63, 'Festival Musik Bambu Nusa', 'festival-musik-bambu-nusantara-2012', 'Bambu Nusantara ke-6 tahun ini akan digelar di Jakarta Convention Center (JCC), di Jalan Jenderal Gatot Subroto, Jakarta, pada 1 - 2 September 2012. Acara tersebut akan menghadirkan beraneka kreasi berbahan bambu dan tampilnya beragam seni dari bambu. Selain suguhan musik etnik berpadu dengan musik modern, dalam Acara ini juga akan turut diisi dengan pameran, seminar, merchandise, kuliner, dan fashion yang dipadu padankan dengan karya berbahan bambu.<br />\r\n', 'Jakarta Convention Center (JCC), Jakarta', 'Dewiit Safitri', '', '2012-09-01', '2012-09-02', '2012-08-20', '09:00:00 - 21:00:00', 42, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id_album` int(5) NOT NULL,
  `jdl_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `album_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `hits_album` int(5) NOT NULL DEFAULT '1',
  `tgl_posting` date NOT NULL,
  `jam` time NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `jdl_album`, `album_seo`, `keterangan`, `gbr_album`, `aktif`, `hits_album`, `tgl_posting`, `jam`, `hari`, `username`) VALUES
(30, 'Konser Kantata Barock 2018 berlangsung Dramatis', 'konser-kantata-barock-2018-berlangsung-dramatis', '<p>Para macan tua yang digawangi Iwan Fals, Setiawan Djody dan Sawung Jabo di Stadion Gelora Bung Karno, Jakarta, Jumat (30/12) malam. Kantata kembali membawakan lagu-lagu legendarisnya setelah 21 tahun vakum dari dunia musik.</p>\r\n\r\n<div style=\"background-color:#ffffff; border:medium none; color:#000000; overflow:hidden; text-align:left; text-decoration:none\">&nbsp;</div>\r\n', 'konser.png', 'Y', 36, '2012-08-20', '09:12:06', 'Senin', 'admin'),
(31, 'Asunt in anim uis aute irure dolor in reprehenderit', 'asunt-in-anim-uis-aute-irure-dolor-in-reprehenderit', '<p>Asunt in anim uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in anim id est laborum. Allamco laboris nisi ut aliquip ex ea commodo consequat. Aser velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in anim id est laborum.</p>\r\n', 'maxresdefault.jpg', 'Y', 10, '2012-08-20', '09:40:01', 'Senin', 'admin'),
(28, 'Murah Meriah belanja puas di Pasar Asemka', 'murah-meriah-belanja-puas-di-pasar-asemka', '<p>Pasar Asemka, Jakarta, merupakan pasar grosir yang banyak menyediakan berbagai aksesoris seperti kalung, cincin, Souvenir pernakahan, dan lainnya. Di Pasara Asemka anda akan dimanjakan dengan beragam barang yang dibandrol dengan harga murah meriah dan biasanya dijual grosiran.</p>\r\n', 'Murah-Meriah.jpg', 'Y', 61, '2012-08-18', '23:14:05', 'Sabtu', 'admin'),
(29, 'Karpet Raksasa dari Bunga mendapatkan rekor muri', 'karpet-raksasa-dari-bunga-mendapatkan-rekor-muri', '<p>Belgia sedang memperingati peristiwa tahunan &quot;La Fete De La Fleur&quot; atau pesta bunga di bulan Agustus. Ahli bunga merancang karpet raksasa dari bunga di depan Grand Place di Brussel. Karpet ini dibuat menggunakan 700 ribu bunga.</p>\r\n', 'karpet.jpg', 'Y', 118, '2012-08-19', '03:02:27', 'Minggu', 'admin'),
(51, 'Jalan-jalan bersama pemenang quiz online swarakalibata', 'jalanjalan-bersama-pemenang-quiz-online-swarakalibata', '<p>Israel pekan-pekan belakangan ini meningkatkan ancaman-ancamannya untuk menghancurkan fasilitas-fasilitas nuklir Iran guna mencegah Teheran mampu memproduksi senjata-senjata atom. Iran yang terkena sanksi-sanksi Barat membantah tuduhan itu dan menegaskan bahwa program nuklirnya hanya untuk tujuan damai. Militernya memperingatkan akan menghancurkan Israel jika diserang.</p>\r\n', 'quiz.jpg', 'Y', 0, '2018-04-21', '22:55:11', 'Sabtu', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `background`
--

CREATE TABLE `background` (
  `id_background` int(5) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `background`
--

INSERT INTO `background` (`id_background`, `gambar`) VALUES
(1, 'green');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(5) NOT NULL,
  `id_kategori_banner` int(11) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `icon` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `posisi` enum('top','footer','login','produk') COLLATE latin1_general_ci NOT NULL DEFAULT 'top',
  `tgl_posting` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id_banner`, `id_kategori_banner`, `judul`, `keterangan`, `url`, `gambar`, `icon`, `posisi`, `tgl_posting`) VALUES
(19, 0, 'Layanan Hadiah', 'Mendukung layanan hadiah', 'https://siforestka.co.id/main#', '', 'icon-gift', 'top', '2017-05-21'),
(20, 0, 'Dukungan 1 x 24 jam', 'Dukungan khusus untuk anda', 'https://siforestka.co.id/main#', '', 'icon-bubbles', 'top', '2017-05-21'),
(21, 0, 'Pembayaran aman', 'Pembayaran aman 100%', 'https://siforestka.co.id/main#', '', 'icon-credit-card', 'top', '2017-05-21'),
(22, 0, '90 % uang Kembali', 'Jika barang Bermasalah', 'https://siforestka.co.id/main#', '', 'icon-sync', 'top', '2017-05-21'),
(23, 0, 'Pengiriman gratis', 'Untuk pesanan min Rp 999.000', 'https://siforestka.co.id/main#', '', 'icon-rocket', 'top', '2017-05-21'),
(24, 1, 'Tentang Kami', 'Website  Kesatuan Pengelolaan Hutan (KPH) Tabalong dibawah Dinas Kehutanan Provinsi Kalimantan Selatan merupakan media informasi seputar kedinasan dan perhutanan di Lingkungan Kalimantan Selatan', '', '', '', 'footer', '2020-02-07'),
(42, 6, 'Jl. A. Yani Km. 6 (arah kaltim), Kelurahan Belimbing Raya, Kec. Murung Pudak, Kab. Tabalong', '', '', '', '', 'footer', '2022-05-18'),
(38, 0, 'Pengiriman ke seluruh Pelosok Indonesia.', 'Pengiriman ke seluruh Pelosok Indonesia.', 'https://siforestka.co.id/main#', '', 'icon-network', 'produk', '2020-07-19'),
(40, 0, 'Penjual memberikan tagihan untuk produk ini.', 'Penjual memberikan tagihan untuk produk ini.', 'https://siforestka.co.id/main#', '', 'icon-receipt', 'produk', '2020-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_judul` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `judul_seo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `headline` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `utama` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `isi_berita` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keterangan_gambar` text COLLATE latin1_general_ci NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  `tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
(695, 61, 'admin', 'Dua Lokasi HMPI 2021 Sukses digelar di Kab. HSS', '', '', 'dua-lokasi-hmpi-2021-sukses-digelar-di-kab-hss', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Kandangan - Hari Menanam Pohon Indonesia ( HMPI ) tahun 2021 diselenggarakan serentak pada tanggal 21 November 2021 di Kalimantan Selatan</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">KPH Hulu Sungai sebagai pengelola kawasan hutan tingkat tapak di Kab. Hulu Sungai Selatan turut mensukseskan acara yang diperingati  pada 2 titik lokasi dengan total bibit yang ditanam sebanyak 710 batang </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Lokasi pertama berada di TPA Malutu yang terletak di desa Batang Kulur Kiri Kec. Sungai Raya dan sebanyak 450 bibit telah ditanam dari jenis Spathodea, Mahoni dan Petai</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Acara penanaman dipimpin langsung oleh Bupati HSS,  H. Achmad Fikry.  Hadir pula, Wakil Bupati dan instansi terkait.  </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">\"Kami akan terus menghijaukan tanah yang berpotensi longsor bersama masyarakat dan terus menghimbau masyarakat untuk tidak membakar lahan,\" tekad Beliau sebelum memulai penanaman</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Selaras dengan Bupati HSS, Noor Rahmansyah, KSBTU KPH Hulu Sungai juga mengungkapkan akan terus mendukung aksi - aksi penanaman pohon di wilayah kelola, baik dengan turut aksi maupun dengan suplai bibit yang diperlukan</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Sedangkan lokasi kedua berada di lingkungan SMPN 1 Loksado.  Penanaman dilaksanakan bersama para Dewan Guru serta siswa.  Bibit yang ditanam berjumlah 260 batang dengan jenis Petai, Langsat, Alpukat, Mahoni, Spathodea dan Tabebuya</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">\"Sedari dini harus terus diajarkan untuk menanam dan merawat pohon, karena pohon menjadi salah satu tabungan di masa depan, \" pesan Priyadi, Kepala Seksi Pemanfaatan Hutan KPH Hulu Sungai kepada guru dan siswa yang begitu antusias menanam (risna/kphhulusungai)</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR2qmtqHes3rubU1Q0CwvGJOITGo-7blIaXgg2Jp2PkWtkJ0Z63fDZrcRM0\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZVimtYfDl6EsfjWKA19nPp2xsm3n7oWuiFLV27GN-1xX_vLNpIV4Qyzfk9qsGQcGw5whJQbJxWStUIDuxZUXakgU6xiF7zo021xdH13mvZbQWU4XZp_otLmVKBDBBCCr7O9wDas2oOH2OpHLO0NA8OF3xSGy3yKQhqUrCBWofxFlg&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZVimtYfDl6EsfjWKA19nPp2xsm3n7oWuiFLV27GN-1xX_vLNpIV4Qyzfk9qsGQcGw5whJQbJxWStUIDuxZUXakgU6xiF7zo021xdH13mvZbQWU4XZp_otLmVKBDBBCCr7O9wDas2oOH2OpHLO0NA8OF3xSGy3yKQhqUrCBWofxFlg&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZVimtYfDl6EsfjWKA19nPp2xsm3n7oWuiFLV27GN-1xX_vLNpIV4Qyzfk9qsGQcGw5whJQbJxWStUIDuxZUXakgU6xiF7zo021xdH13mvZbQWU4XZp_otLmVKBDBBCCr7O9wDas2oOH2OpHLO0NA8OF3xSGy3yKQhqUrCBWofxFlg&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZVimtYfDl6EsfjWKA19nPp2xsm3n7oWuiFLV27GN-1xX_vLNpIV4Qyzfk9qsGQcGw5whJQbJxWStUIDuxZUXakgU6xiF7zo021xdH13mvZbQWU4XZp_otLmVKBDBBCCr7O9wDas2oOH2OpHLO0NA8OF3xSGy3yKQhqUrCBWofxFlg&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Dua Lokasi HMPI 2021 Sukses digelar di Kab. HSS', 'Rabu', '2021-12-01', '16:06:00', '259883548_264092385749790_7207024969435267910_n.jpg', 27, '', 'Y'),
(693, 61, 'admin', 'KPH Tanah Laut Gelar Peringatan Hari Menanaman Indonesia 2021', '', '', 'kph-tanah-laut-gelar-peringatan-hari-menanaman-indonesia-2021', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">PELAIHARI - Peringatan Hari Menanam Pohon Indonesia (HMPI) diperingati jatuh pada tanggal 21 November yang dimaksudkan untuk memberikan kesadaran dan kepedulian kepada masyarakat tentang pentingnya pemulihan kerusakan sumber daya hutan dan lahan melalui penanaman pohon. </span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dengan adanya acara HMPI, Pemerintah Provinsi Kalimantan Selatan dalam hal ini Gubernur Kalimantan Selatan, H. Sahbirin Noor memerintahkan secara langsung penanaman serentak di lingkungan SKPD Kalimantan Selatan. Salah satu pelaksana kegiatan yakni KPH Tanah Laut bersama dengan peserta lainnya, yakni oleh LSM, Dinas Lingkungan Hidup Kab. Tanah Laut, Polsek, Koramil, Unsur Perangkat Kecamatan dan Desa serta 14 KTH (Kelompok Tani Hutan) yang tersebar di Kabupaten Tanah Laut.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Lokasi lokasi yang tersebar antara lain, Desa Ambungan, Desa Sei. Pinang, Desa Telaga, Desa Bumi Jaya, Desa Kandangan Lama, Desa Galam, Desa Bajuin, Desa Damit, Desa Pemalongan, Desa Sei. Bakar, Desa Ujung Batu, Desa Kurau, Desa Batu Ampar, dan Desa Sei. Jelai. Adapun jenis jenis pohon yang ditanam yakni Spatodhea, Sirsak, Durian, Alpukat, Nangka, Jambu Mete, Trembesi dan Kaliandra dengan jumlah total sebanyak 5.075 bibit yang berasal dari Balai Perbenihan Tanaman Hutan (BPTH) Dinas Kehutanan.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Seperti yang kita ketahui, pohon mempunyai peran yang sangat penting bagi makhluk hidup. Pohon dapat menjaga suhu bumi tetap dingin, menyerap karbon dan menyaring polusi udara. Selain itu juga, pohon secara tidak langsung dapat memitigasi bencana alam dengan mengatur cuaca, menstabilkan tanah dan mencegah erosi. Maka dari itu, mari kita perlu menyadarkan diri sendiri serta orang orang sekitar kita akan pemahaman betapa pentingnya pohon bagi bumi kita tercinta. Selamat Hari Menanam Pohon! (novi/kphtala).</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR2c7ewW1qQJAjKvVjaXhHjN70kECew5cZg90ZhSlTVNrd2_bM5DhtA1kRM\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZUj9KWX-d1hVfiV8d1ElKh6R463wclUtwwgKztk7Dmzz1VGUIimDx4ZHJYrOMEp5RRb2BdVDCZj2OTqPiAqChjcrqLSiwhi-I3x7vtat9IT_3mE9hcdv0wEVepd8ORMhYgNweVXPP2KlOcu_yyu1fk3tgXLJvjelx8-vKrXzwefzQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZUj9KWX-d1hVfiV8d1ElKh6R463wclUtwwgKztk7Dmzz1VGUIimDx4ZHJYrOMEp5RRb2BdVDCZj2OTqPiAqChjcrqLSiwhi-I3x7vtat9IT_3mE9hcdv0wEVepd8ORMhYgNweVXPP2KlOcu_yyu1fk3tgXLJvjelx8-vKrXzwefzQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZUj9KWX-d1hVfiV8d1ElKh6R463wclUtwwgKztk7Dmzz1VGUIimDx4ZHJYrOMEp5RRb2BdVDCZj2OTqPiAqChjcrqLSiwhi-I3x7vtat9IT_3mE9hcdv0wEVepd8ORMhYgNweVXPP2KlOcu_yyu1fk3tgXLJvjelx8-vKrXzwefzQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZUj9KWX-d1hVfiV8d1ElKh6R463wclUtwwgKztk7Dmzz1VGUIimDx4ZHJYrOMEp5RRb2BdVDCZj2OTqPiAqChjcrqLSiwhi-I3x7vtat9IT_3mE9hcdv0wEVepd8ORMhYgNweVXPP2KlOcu_yyu1fk3tgXLJvjelx8-vKrXzwefzQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'KPH Tanah Laut Gelar Peringatan Hari Menanaman Indonesia 2021', 'Rabu', '2021-12-01', '16:02:53', '259978161_264331459059216_6590666651431822987_n.jpg', 29, '', 'Y'),
(694, 61, 'admin', 'Bersama Siswa, Peringati HMPI di Tapin', '', '', 'bersama-siswa-peringati-hmpi-di-tapin', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Rantau - Peringatan Hari Menanam Pohon Indonesia ( HMPI ) dilaksanakan serentak di Kalimantan Selatan pada hari Senin tanggal 22 November 2021, termasuk di KPH Hulu Sungai</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Kab. Tapin sebagai salah satu wilayah kelola KPH Hulu Sungai turut mensukseskannya di 2 (dua) lokasi yaitu di Pasar Baru Binuang dan lahan eks Kebun PKK di Pulau Kutil</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Kepala KPH Hulu Sungai, Rudiono Herlambang yang hadir di lahan eks Kebun PKK menyatakan bahwa dengan menanam pohon itu sama dengan sedekah jariah.  </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">\'Selain setara sedekah jariah, juga jadi tabungan amal dan tabungan masa depan anak cucu kita,\" turur Herlambang</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Acara penanaman dihadiri oleh Staf ahli Bupati, beberapa instansi, komunitas pemuda Tapin, Duta Lingkungan dan sekolah adiwiyata.  Sebanyak 130 batang bibit telah  ditanam terdiri dari tanaman produktif dan tabebuya.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Sedangkan dilokasi Pasar Baru Binuang, 500 batang bibit terdiri dari Spathodea, Johar dan Trembesi telah ditanam. </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Antusias menanam ditunjukkan oleh siswa SMKN Binuang.  Bahu membahu mereka menanam pohon yang telah disiapkan.  Harapannya, pohon2 ini bisa menjadi pelindung dan mempercantik lingkungan pasar (risna/kphhulusungai)</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://l.facebook.com/l.php?u=https%3A%2F%2Finstagram.com%2FDishutProvKalsel%3Ffbclid%3DIwAR3zkCk_GhS0Re6wgnjUTl48-1So_-ERo5pBw2mit89s5pzlxjGP2UnkQ2Y&amp;h=AT0BRds6D4br5Z95LuETUUcbwVIANkwFoyW90SntKdAQcfkPWzs0pjAOzWw-WvB5jU2TFezeXB_XULqqXeRXiCroTUrxizuThRn-ryA0YGciPdXrJR8Hbmj9AH_-Qc4617Ep&amp;__tn__=-UK-y-R&amp;c[0]=AT0zv2-DvmAESZ1QWazMGHykAAeWHzxs5CZrCoWJBgNsVd2X92nVARbYigq9tC_vBr_VO7SOmPvfqNihEzQgwBFEga4M1fJDC60l9OFD-C0N7CusIjd-1woqkGH0CZOVfHXJqoNNJfZ03ywghCGwgCCNzdbHB9noW3Jt0RAvYvfOzC0sio54e0ttgoRklEEG-XtgVG4\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZUVPQgemo6J-WCKTsaLqTrF5IN9UzGDc2iqSpE1pSIEZ6Gblj-AcExP19KEZZY_iNZpS8X6XOJQsw0bx_nbsimnL_8qgPptgSFlE-tbppIcjN_IAwqVRsZPHoOZ5wXSsxWcPdDLZunPlBQSmV49Q0uFWO-rLOW1hPgNqnZ7Ou538A&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZUVPQgemo6J-WCKTsaLqTrF5IN9UzGDc2iqSpE1pSIEZ6Gblj-AcExP19KEZZY_iNZpS8X6XOJQsw0bx_nbsimnL_8qgPptgSFlE-tbppIcjN_IAwqVRsZPHoOZ5wXSsxWcPdDLZunPlBQSmV49Q0uFWO-rLOW1hPgNqnZ7Ou538A&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZUVPQgemo6J-WCKTsaLqTrF5IN9UzGDc2iqSpE1pSIEZ6Gblj-AcExP19KEZZY_iNZpS8X6XOJQsw0bx_nbsimnL_8qgPptgSFlE-tbppIcjN_IAwqVRsZPHoOZ5wXSsxWcPdDLZunPlBQSmV49Q0uFWO-rLOW1hPgNqnZ7Ou538A&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZUVPQgemo6J-WCKTsaLqTrF5IN9UzGDc2iqSpE1pSIEZ6Gblj-AcExP19KEZZY_iNZpS8X6XOJQsw0bx_nbsimnL_8qgPptgSFlE-tbppIcjN_IAwqVRsZPHoOZ5wXSsxWcPdDLZunPlBQSmV49Q0uFWO-rLOW1hPgNqnZ7Ou538A&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Bersama Siswa, Peringati HMPI di Tapin', 'Rabu', '2021-12-01', '16:04:40', '259439014_264331012392594_4321826406128373826_n.jpg', 28, '', 'Y'),
(696, 61, 'admin', 'Menanam Gasan Anak Cucu.', '', '', 'menanam-gasan-anak-cucu', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">MANDIANGIN_ Pagi cerah dengan sinar mentari telihat di antara rindang dedaunan, kicauan burung burung seakan ikut bahagia menyambut kedatangan parq undangan penanaman dalam acara Hari Menanam Pohon Indonesia di Tahura SA Mandiangin.</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Penanaman di hadiri oleh Dekan Fakultas Kehutanan ULM,  Organisasi Mahasisiwa, dan Pecinta Alam, sebelum penanaman terlebih dahulu di laksanakan apel dan di lanjutkan dengan acara penanaman dengan jenis bibit Nangka dan Jambu mente sebanyak 2000 batang.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Kepala Tahura SA, Ainun Jariah selaku pembina apel membacakan pidato Gubernur Kal Sel, H. Sahbirin Noor, yang mana dalam pidatonya Gubernur mengajak seluruh lapisan masyarakat untuk terus menanam, menanam dan menanan gasan anak cucu kita.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Ainun berharap,\"semoga apa yang kita tanam hari ini akan memberikan manfaat bagi kita maupun flora dan fauna yang ada di sekitar kawasan hutan konservasi Tahura SA,\" pungkasnya.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Salah seorang mahasiswi dari fakultas kehutanan ULM, Nitta mengatakan,\"kami bangga telah di libatkan dalam acara penanaman hari ini,\" ujarnya</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">ia berharap,\" mudahan apa yang kami tanam ini bisa tumbuh besar, dan bisa menjadi kenangan apabila datang ke Tahura selalu ingat itu lho aku yang menanam,\" pungkasnya  (rizani/tahura)</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://l.facebook.com/l.php?u=https%3A%2F%2Finstagram.com%2FDishutProvKalsel%3Ffbclid%3DIwAR1Jxe1RuSupcCmBoRLeoNt5lsV_TFwVIScNHWCmcp1Cdkv0_t-fidMyAog&amp;h=AT0BRds6D4br5Z95LuETUUcbwVIANkwFoyW90SntKdAQcfkPWzs0pjAOzWw-WvB5jU2TFezeXB_XULqqXeRXiCroTUrxizuThRn-ryA0YGciPdXrJR8Hbmj9AH_-Qc4617Ep&amp;__tn__=-UK-y-R&amp;c[0]=AT0V_EZSvZOj0GXc5_cGYZ-t-zWl2BTh0M3r71F5GjTWJEAZCKgIg08XIy0Lzphbn9A3uxUH4tiJZKX1x2dpr2KUiAfDpt5RsCJoopAH_Wf4YLHwfFP91kcxcT2lA0ynLlg7YwxbJiO217p7pOSzajQoeg4VSPF0sRoZmHraHL41WibDaHLj0Q3Ia-U0a-O8xCHH36M\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZWrbEdctU3Et8ZcddB9EmsT1Kx9N27nDtxeOLUwm8ajeO3DdaZtOIaZh1Nso8l-zyYWHh7bz4I02qQ0ZztexI7RL3wX26g6uAX0WHbqUkhDRIeB0Xicf6xe3VbMnP7U9G-wXg7FrjQ3abbg8nw0UZTbuuo7USBVxHebbF4GVbTnwA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZWrbEdctU3Et8ZcddB9EmsT1Kx9N27nDtxeOLUwm8ajeO3DdaZtOIaZh1Nso8l-zyYWHh7bz4I02qQ0ZztexI7RL3wX26g6uAX0WHbqUkhDRIeB0Xicf6xe3VbMnP7U9G-wXg7FrjQ3abbg8nw0UZTbuuo7USBVxHebbF4GVbTnwA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZWrbEdctU3Et8ZcddB9EmsT1Kx9N27nDtxeOLUwm8ajeO3DdaZtOIaZh1Nso8l-zyYWHh7bz4I02qQ0ZztexI7RL3wX26g6uAX0WHbqUkhDRIeB0Xicf6xe3VbMnP7U9G-wXg7FrjQ3abbg8nw0UZTbuuo7USBVxHebbF4GVbTnwA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZWrbEdctU3Et8ZcddB9EmsT1Kx9N27nDtxeOLUwm8ajeO3DdaZtOIaZh1Nso8l-zyYWHh7bz4I02qQ0ZztexI7RL3wX26g6uAX0WHbqUkhDRIeB0Xicf6xe3VbMnP7U9G-wXg7FrjQ3abbg8nw0UZTbuuo7USBVxHebbF4GVbTnwA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Menanam Gasan Anak Cucu.', 'Rabu', '2021-12-01', '16:08:02', '259738248_264090842416611_3713749138303502266_n.jpg', 26, '', 'Y'),
(697, 61, 'admin', 'Hari Menanam Pohon Indonesia 2021 KPH Tabalong.', '', '', 'hari-menanam-pohon-indonesia-2021-kph-tabalong', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Tanjung - 22/11/21 KPH Tabalong bersama Dinas Lingkungan Hidup Kab. Tabalong, Forum Komunitas Hijau Kariwaya dan Anggota Saka Wanabakti memperingati Hari Menanam Pohon Indonesia (HMPI).</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Kegiatan ini dilaksanakan dibantaran sungai Jaing, Desa Mambuun. HMPI  kali ini dilaksanakan serentak Se Kalimantan Selatan yang dipimpin langsung oleh Bapak Gubernur Kalimantan Selatan H. Sahbirin Noor di Pantai Kopi Kec. Karang Intan, Kab. Banjar.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Sambutan disampaikan Gunernur Kalimantan Selatan, dibacakan oleh Kepala KPH Tabalong.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dalam sambutannya Gubernur Kalimantan Selatan, H. Sahbirin Noor, mengajak semua lapisan masyarakat banua untuk tidak berhenti melakukan penghijauan.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">\"Presiden Jokowi pernah melontarkan pujian Kalsel menjadi provinsi <span style=\"font-family: inherit;\"><span class=\"l9j0dhe7\" style=\"position: relative; font-family: inherit;\"><div class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl\" role=\"button\" tabindex=\"0\" style=\"outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; background-color: transparent; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\"><span style=\"font-family: inherit; color: rgb(219, 131, 28); font-weight: bold;\">terbaik</span></div><div class=\"n00je7tq arfg74bv qs9ysxi8 k77z8yql i09qtzwb n7fi1qx3 b5wmifdl hzruof5a pmk7jnqg j9ispegn kr520xx4 c5ndavph art1omkt ot9fgl3s\" data-visualcompletion=\"ignore\" style=\"border-radius: 4px; transition-property: opacity; opacity: 0; transition-duration: var(--fds-duration-extra-extra-short-out); pointer-events: none; inset: -2px -4px; transition-timing-function: var(--fds-animation-fade-out); position: absolute; font-family: inherit;\"></div></span></span> dalam melaksanakan program penghijauan. Ayo kita tunjukan bahwa penghijauan di banua kita tidak pernah berhenti. Kita terus menggencarkan penghijauan\" kata H. Sahbirin Noor dalam sambutannya yang dibacakan Kepala KPH Tabalong.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Semoga acara HMPI ini kita kembali bersemangat dan  diingatkan betapa pentingnya pohon untuk kehidupan.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">(erwin/kphtabalong)</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR25KJ3SKgUVkGW1oNvaHvomJ1MVXSCq0w1Ocz2nvSISghG9se5FlGc-0WE\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZW-51iB_9udDPcJY0Jk2iluSurP4q6sY7cBrKEludgCCSAftzgsZ4Lazoy1mlwIuGFb5L3_MgTxA3wznKiOjKxHh8UqQn5FnrBXegMUKsJXfwXGuZ69PHl99Mo2XifAGiAalgso9wTWfg8EidpXYQL3_nPGoqPzPz-167Ni91H6Mw&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZW-51iB_9udDPcJY0Jk2iluSurP4q6sY7cBrKEludgCCSAftzgsZ4Lazoy1mlwIuGFb5L3_MgTxA3wznKiOjKxHh8UqQn5FnrBXegMUKsJXfwXGuZ69PHl99Mo2XifAGiAalgso9wTWfg8EidpXYQL3_nPGoqPzPz-167Ni91H6Mw&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZW-51iB_9udDPcJY0Jk2iluSurP4q6sY7cBrKEludgCCSAftzgsZ4Lazoy1mlwIuGFb5L3_MgTxA3wznKiOjKxHh8UqQn5FnrBXegMUKsJXfwXGuZ69PHl99Mo2XifAGiAalgso9wTWfg8EidpXYQL3_nPGoqPzPz-167Ni91H6Mw&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZW-51iB_9udDPcJY0Jk2iluSurP4q6sY7cBrKEludgCCSAftzgsZ4Lazoy1mlwIuGFb5L3_MgTxA3wznKiOjKxHh8UqQn5FnrBXegMUKsJXfwXGuZ69PHl99Mo2XifAGiAalgso9wTWfg8EidpXYQL3_nPGoqPzPz-167Ni91H6Mw&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Hari Menanam Pohon Indonesia 2021 KPH Tabalong.', 'Rabu', '2021-12-01', '16:09:19', '260214114_264087412416954_263489118039733558_n.jpg', 28, '', 'Y');
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
(698, 61, 'admin', 'HMPI KPH Cantung', '', '', 'hmpi-kph-cantung', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Bungkukan - KPH Cantung melaksanakan kegiatan menanan di perayaan Hari Menanam Pohon Indonesia yang serentak di lansakan se kalimantan selatan . </span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Acara di hadiri beberapa instansi sekecamatan kelumpang barat antara lain Polsek, kecamatan, Aparat desa, serta beberapa anggota KTH .</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Bibit yang di tanam kali ini antara lain spatodea, mahoni, alpukat, jengkol, pucuk merah yang seluruh nya berjumlah kurang lebih 800 batang .</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://l.facebook.com/l.php?u=https%3A%2F%2Finstagram.com%2FDishutProvKalsel%3Ffbclid%3DIwAR01vsHVQNKecOBmNJwxGmWEk3wGJHx0P_awjIKlN29Ljf-SOwiyynGAPU8&amp;h=AT3bThRozrobC0-yTMzVdPzMgRj2c_7evLonU1rBr2JT-U3wrjkHUg-LFEE8avBookcQUbYReJrLhJq94TMAr_xvbuvzrRLZtHoypiyH-PxRjIt6QcnvVVuw3cGuqdfDuj9f&amp;__tn__=-UK-y-R&amp;c[0]=AT10jllgfAiuaCMWgpSbvGlJA_8ozkP5CD1UcGOorQIcBFLZ2sCHBlqerhupKrTsp6EaOBLKlQB9ciD2uq-veHBjw7pycFnu4peZqURD7i8QMcX1FSufBtCSY45PsTJK8JNxAfymPvvwcdDCorTk9sNYe6BXuK0KXOtsasBBcC7zzYnLiwNRak6jP7QrpT8h9dd0h84\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZWy2ZNSPm1g7XaVHH_XXhlYo1cKOxiC1gul-nYPHWdl5Quz_a1T3_ca4pavZNulDlz1PvU1DnsAInxnkwxAvnJoDyA7_Z6fVo9ZCrjO6SBRaKFSnxKqZp3jIXw9gLQYDv6I6aU__coWaCCCqLSdW9HIsEEUO_GTKLC1khnm5uYlkA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZWy2ZNSPm1g7XaVHH_XXhlYo1cKOxiC1gul-nYPHWdl5Quz_a1T3_ca4pavZNulDlz1PvU1DnsAInxnkwxAvnJoDyA7_Z6fVo9ZCrjO6SBRaKFSnxKqZp3jIXw9gLQYDv6I6aU__coWaCCCqLSdW9HIsEEUO_GTKLC1khnm5uYlkA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZWy2ZNSPm1g7XaVHH_XXhlYo1cKOxiC1gul-nYPHWdl5Quz_a1T3_ca4pavZNulDlz1PvU1DnsAInxnkwxAvnJoDyA7_Z6fVo9ZCrjO6SBRaKFSnxKqZp3jIXw9gLQYDv6I6aU__coWaCCCqLSdW9HIsEEUO_GTKLC1khnm5uYlkA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZWy2ZNSPm1g7XaVHH_XXhlYo1cKOxiC1gul-nYPHWdl5Quz_a1T3_ca4pavZNulDlz1PvU1DnsAInxnkwxAvnJoDyA7_Z6fVo9ZCrjO6SBRaKFSnxKqZp3jIXw9gLQYDv6I6aU__coWaCCCqLSdW9HIsEEUO_GTKLC1khnm5uYlkA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'HMPI KPH Cantung', 'Rabu', '2021-12-01', '16:10:39', '260203645_264086042417091_1378129068330695198_n.jpg', 28, '', 'Y'),
(699, 61, 'admin', 'Hari Menanam Pohon Indonesia (HMPI) Sukses di Kabupaten Banjar', '', '', 'hari-menanam-pohon-indonesia-hmpi-sukses-di-kabupaten-banjar', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Bupati Banjar H. Saidi Mansyur sukse  laksanakan HMPI di kabupaten Banjar Senin, 22 November 2021.</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Kegiatan ini dilaksanakan di Desa Indrasari tepatnya  di lokasi  SDN  negeri  2 Indrasari kabupaten Banjar. </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Kegiatan ini  dilaksanakan bersama Dinas Lingkungan Hidup Kabupaten Banjar  dan KPH Kayu Tangi Dinas Kehutanan Provinsi  Kalimantan  Selatan. Bersama Forkompimda Kabupaten Banjar  pelaksanan HMPI  ini berjalan dengan lancar dan sukses. </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Kegiatan ini dimulai  dengan penyerahan Bibit pohon oleh  kepala KPH Kayu Tangi, Lanang Budi  menyampaikan bahwa kegiatan ini guna mensukseskan program Revolusi  Hijau yang  telah  digaungkan Pemerintah  Provinsi  Kalimantan Selatan dan dalam hal ini  Dinas Kehutanan Provinsi. Juga  tentunya  menyemarakan program KLHK  dalam mensukseskan HMPI kali ini. </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dalam mendukung kegiatan HMPI ini turut juga  FIF group  turut menyumbang  sebanyak  200 bibit pohon buah-buahan  terdiri dari :Duku 15,</div><div dir=\"auto\" style=\"font-family: inherit;\">Alpukat 15,Mangga gadung 20,Kasturi 30,Jambu air,madu Deli 30,Jambu air citra 30,Jambu air Dalair 20,Rambutan 40 dan KPH Kayu Tangi  sendiri memberikan bantuan bibit sebanyak 330 bibit pohon jenis buah-buahan terdiri dari Jambu mente 210,Nangka 100,Petai 10 batang pohon. </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dalam sambutan yang disampaikan oleh Bupati Banjar diharapkan dengan  semangat  HMPI ini bisa mewujudkan kelestarian lingkungan dan tercapainya tujuan dari penghijauan ini diseluruh pelosok Kalimantan Selatan dan khususnya  kabupaten Banjar. (Ade/kph kyt).</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://l.facebook.com/l.php?u=https%3A%2F%2Finstagram.com%2FDishutProvKalsel%3Ffbclid%3DIwAR0m1HRizzY4QTVWfNLnNtWZ0GOM1gDbLsGFQzEpu4dToE47F_OCWoVBy7M&amp;h=AT3bThRozrobC0-yTMzVdPzMgRj2c_7evLonU1rBr2JT-U3wrjkHUg-LFEE8avBookcQUbYReJrLhJq94TMAr_xvbuvzrRLZtHoypiyH-PxRjIt6QcnvVVuw3cGuqdfDuj9f&amp;__tn__=-UK-y-R&amp;c[0]=AT0vPUzgUd3zGNuRjD3kKQpOQ0JqRhNZKLQO4vnZR69iIZq_SFFLTcWaefUcf9RDx9UWQy53XdpfvJ-1aSnCXC3KT0EuEAB-Nv6n40DNgGD8L_udewizwajFd841W-OdAki4ykGZs7xRh1vD_dRps5BcoAFqLhL440MxcvsJ_7-OMHsD8GV8sCperLoi_j1GGDBYZDo\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZXr60QlY3Osfn3q6NpAn1c4KM5P-UIbfnRCzgRr-3vc8lE-xGe7jMa_9t8fEt-bmG4lvGd1BfuyknsETE6GX0VjdfKg6zr4RDQjm-RA_Btf_60t0lJel4Vn1FU1EiiEVHh5Et99F5-enMJVzi4eQ9knfFzGcsakyWhHUAOg1O4cug&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZXr60QlY3Osfn3q6NpAn1c4KM5P-UIbfnRCzgRr-3vc8lE-xGe7jMa_9t8fEt-bmG4lvGd1BfuyknsETE6GX0VjdfKg6zr4RDQjm-RA_Btf_60t0lJel4Vn1FU1EiiEVHh5Et99F5-enMJVzi4eQ9knfFzGcsakyWhHUAOg1O4cug&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZXr60QlY3Osfn3q6NpAn1c4KM5P-UIbfnRCzgRr-3vc8lE-xGe7jMa_9t8fEt-bmG4lvGd1BfuyknsETE6GX0VjdfKg6zr4RDQjm-RA_Btf_60t0lJel4Vn1FU1EiiEVHh5Et99F5-enMJVzi4eQ9knfFzGcsakyWhHUAOg1O4cug&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZXr60QlY3Osfn3q6NpAn1c4KM5P-UIbfnRCzgRr-3vc8lE-xGe7jMa_9t8fEt-bmG4lvGd1BfuyknsETE6GX0VjdfKg6zr4RDQjm-RA_Btf_60t0lJel4Vn1FU1EiiEVHh5Et99F5-enMJVzi4eQ9knfFzGcsakyWhHUAOg1O4cug&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Hari Menanam Pohon Indonesia (HMPI) Sukses di Kabupaten Banjar', 'Rabu', '2021-12-01', '16:12:12', '259596072_264084685750560_1880409873255547506_n.jpg', 27, '', 'Y'),
(700, 61, 'admin', 'HMPI KPH PLS ', '', '', 'hmpi-kph-pls-', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Kotabaru - KPH Pulau Laut Sebuku laksanakan Hari Menanam Pohon Indonesia (HMPI) yang terpusat di Wisata Air Terjun Tumpang Dua Desa Sebelimbingan dengan tetap mengikuti protokol kesehatan (22/11)</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Acara dihadiri oleh Sekda Kab.Kotabaru Forkopimda, Instansi terkait, Camat Pulau Laut Utara, Kepala Desa Megasari, Kepala Desa Gunung Sari, SMAN 2 Kotabaru, SMKN Kotabaru berserta para siswa yang turut berpartisipasi dalam kegiatan penanaman.</div><div dir=\"auto\" style=\"font-family: inherit;\">Bibit yang ditanam sebanyak 120 batang bibit terdiri dari bibit Meranti dan buah-buahan.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Ditempat yang berbeda HMPI juga dilaksanakan oleh KTH Tunas Harapan, KTH Sinar Timur, KTH Harapan Bersama, KTH Jambangan Lestari, LPHD Teluk Kemuning, LPHD Teluk Sirih, LPHD Teluk Aru dan Desa Berangas dengan total bibit yang ditanam sebanyak 3.510 batang bibit dengan jenis tanaman Spatodea, Tabebuya, Petai, Jengkol, Cengkeh, Mangga dan Rambutan.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dalam sambutan Gubernur yang dibacakan oleh Sekda Kotabaru mengatakan bahwa \"Gerakan Revolusi Hijau mendapat dukungan yang luas dari berbagai pihak untuk terus menghijaukan kembali bumi Kalimantan Selatan\"</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR28KL1sIDlFU_g5Y8NHTcaZuosXTtNYuDVcadQVdccxs9HciqDEMSBJSk4\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZVEtlUwuCnfHKtvA9iJzO0a6yy8actmCz3_c-aHvcw1pL7gp8hkLz5JFjcI-ZweOGYyd5tNy12IYIPux4k5MFDHFprAvUeEsbWLwRynzCMH6h7zqyosc3DzDtG3bFmpQ4N2CiLG-h1OnxrkL9AhV0DxRQ6n2OASOicm7OfTAlNoLA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZVEtlUwuCnfHKtvA9iJzO0a6yy8actmCz3_c-aHvcw1pL7gp8hkLz5JFjcI-ZweOGYyd5tNy12IYIPux4k5MFDHFprAvUeEsbWLwRynzCMH6h7zqyosc3DzDtG3bFmpQ4N2CiLG-h1OnxrkL9AhV0DxRQ6n2OASOicm7OfTAlNoLA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZVEtlUwuCnfHKtvA9iJzO0a6yy8actmCz3_c-aHvcw1pL7gp8hkLz5JFjcI-ZweOGYyd5tNy12IYIPux4k5MFDHFprAvUeEsbWLwRynzCMH6h7zqyosc3DzDtG3bFmpQ4N2CiLG-h1OnxrkL9AhV0DxRQ6n2OASOicm7OfTAlNoLA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZVEtlUwuCnfHKtvA9iJzO0a6yy8actmCz3_c-aHvcw1pL7gp8hkLz5JFjcI-ZweOGYyd5tNy12IYIPux4k5MFDHFprAvUeEsbWLwRynzCMH6h7zqyosc3DzDtG3bFmpQ4N2CiLG-h1OnxrkL9AhV0DxRQ6n2OASOicm7OfTAlNoLA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'HMPI KPH PLS ', 'Rabu', '2021-12-01', '16:13:24', '259794855_264083395750689_324551687980888667_n.jpg', 25, '', 'Y'),
(701, 61, 'admin', 'Kph Balangan Ikut Serta HMPI 2021', '', '', 'kph-balangan-ikut-serta-hmpi-2021', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Paringin - KPH Balangan ikut serta dalam kegiatan Hari Menanam Pohon Indonesia (HMPI) yang Serentak dilaksanakan se Kalimantan Selatan yang bertempat di SMPN 3 Batu Mandi Desa Munjung Kabupaten Balangan dengan tetap mengikuti protokol kesehatan, pada Senin (22/11/2021).</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dalam kegiatan tersebut turut hadir Kepala Dinas Lingkungan Hidup dan Pertanahan Kabupaten Balangan, Camat Batumandi, Koramil Batumandi, Komunitas Penggiat Lingkungan (Tadas, Kukura Borneo, Peperlingsih, Forum Anak Balangan, Pramuka), Aparat Desa Munjung serta Dewan Guru dan Siswa - Siswi SMPN 3 yang ikut berpartisipasi dalam memeriahkan Hari Menanam Pohon Indonesia (HMPI).</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Untuk mendukung kegiatan HMPI tersebut, KPH Balangan Mendistribusikan  bibit sebanyak 500 batang, terdiri dari jenis MPTS dan tanaman peneduh. </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dalam sambutannya Kepala Dinas Lingkungan Hidup dan Pertanahan mengatakan \" Kegiatan ini merupakan langkah yang sangat baik dilaksanakan untuk mendukung  kegiatan Revolusi Hijau, tentunya Penghijaun di Kabupaten Balangan, serta mengharapkan kegiatan ini bukannya dilaksanakan pada Kegiatan ini saja tetapi terus dilaksanakan yang tentunya akan memberikan manfaat untuk Kebaikan bagi kita semua dan Generasi mendatang\"</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Yang kemudian sambutan tersebut pun di tanggapi dari Camat Batumandi yang dalam sambutan nya menuturkan \"Tentunya kita sangat mendukung kegiatan ini dan juga mengharapkan kepada semua pihak untuk selalu menjaga tanaman dan merawatnya untuk bisa menjaga keasrian Lingkungan kita\"</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Semantara itu Kasi perlindungan Hutan, M. Emir Faisal sangat mengapresiasi atas kerjasama dan dukungan semua pihak serta ke ikut sertaan para siswa dan siswi yang mau ikut ambil andil dalam Pelaksanaan HMPI ini seperti yang dikatakannya dalam sambutan nya\" Kami ucapkan Terima Kasih atas dukungan semua pihak yang terlibat dalam kegiatan ini dan ke ikut sertaan adek adek ini dalam melakukan Penanaman Hari ini yang sangat antusias sekali dalam kegiatan ini \"</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">\"Tentunya kita berupaya sebaik mungkin untuk terus menggaungkan Revolusi Hijau untuk Menjadikan Kalimantan bagian dari Indonesia yang terus menjadi dari Paru parunya Dunia\" tutupnya.</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR1vkDG9N5NxICs_XfsVm5Yas7PsZ2XXmQZLvi2D_wdMb7WvtZtQmEwNrs8\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZXOne1cQzytZVFr9L-jo8MYTrvyNvNEjDtTnFPxqVky9UXPvP3MesaxL1WW_ea_TDw21TgGby1Ogh7hipOl_wPN2wCatxLtJS8hpLgKnQrM5Mjk94NuJpevigDdZm4m4YocNz8EjfWuAaVNX0W-MIZQaohaf29fxcPIA6lmQ7A6lQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZXOne1cQzytZVFr9L-jo8MYTrvyNvNEjDtTnFPxqVky9UXPvP3MesaxL1WW_ea_TDw21TgGby1Ogh7hipOl_wPN2wCatxLtJS8hpLgKnQrM5Mjk94NuJpevigDdZm4m4YocNz8EjfWuAaVNX0W-MIZQaohaf29fxcPIA6lmQ7A6lQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZXOne1cQzytZVFr9L-jo8MYTrvyNvNEjDtTnFPxqVky9UXPvP3MesaxL1WW_ea_TDw21TgGby1Ogh7hipOl_wPN2wCatxLtJS8hpLgKnQrM5Mjk94NuJpevigDdZm4m4YocNz8EjfWuAaVNX0W-MIZQaohaf29fxcPIA6lmQ7A6lQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZXOne1cQzytZVFr9L-jo8MYTrvyNvNEjDtTnFPxqVky9UXPvP3MesaxL1WW_ea_TDw21TgGby1Ogh7hipOl_wPN2wCatxLtJS8hpLgKnQrM5Mjk94NuJpevigDdZm4m4YocNz8EjfWuAaVNX0W-MIZQaohaf29fxcPIA6lmQ7A6lQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Kph Balangan Ikut Serta HMPI 2021', 'Rabu', '2021-12-01', '16:14:42', '259815543_264081795750849_744445092810519096_n.jpg', 20, '', 'Y'),
(702, 61, 'admin', 'Sambut HMPI 2021, Penanaman Bersama Dilaksanakan', '', '', 'sambut-hmpi-2021-penanaman-bersama-dilaksanakan', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Kandangan - Berdasarkan Keputusan Presiden RI Nomor 24 Tahun 2008, Hari Menanam Pohon Indonesia ( HMPI ) diperingati setiap tanggal 28 November.  Sebuah gerakan yang bertujuan untuk memberikan kesadaran dan kepedulian kepada masyarakat tentang pentingnya fungsi pohon dalam pemulihan kerusakan sumber daya hutan dan lahan</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Sejalan dengan Gerakan Revolusi Hijau, HMPI tahun ini mengambil tema Kalsel Menanam Bersama Paman Birin </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Meski tinggal beberapa hari lagi, namun gemanya sudah terasa dari sekarang.  Antusias para pecinta dan penggiat lingkungan sudah terlihat dari beberapa aksi penanaman pohon yang telah dilaksanakan</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Seperti pada pagi Sabtu tadi (20/11), dalam rangka HMPI tahun 2021 dan Gerakan Revolusi Hijau, KPH Hulu Sungai Bersama Forum Komunitas Hijau (FKH) Sehati Kandangan, melaksanakan penanaman bersama di STAI Darul Ulum yang berlokasi di Gambah Luar Kec. Kandangan Kab. HSS</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Pada sambutannya, Ketua FKH Sehati, H. Yusran Fahmi, menyampaikan ucapan terima kasihnya karena telah beberapa kali disuplai bibit untuk penanaman</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">\"Kita telah beberapa kali melaksanakan penanaman bersama.  Ini sebagai upaya kita turut memperbaiki lingkungan,\" paparnya</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Sedangkan Priyadi, Kepala Seksi Pemanfaatan Hutan yang mewakili Kepala KPH Hulu Sungai memberikan apresiasi kepada FKH Sehati atas partisipasi dan kegigihannya dalam berbagai aksi peduli lingkungan</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Pada kesempatan itu, telah ditanam secara simbolis bibit Mahoni sebanyak 50 batang, Spathodea sebanyak 30 batang dan Tabebuya sebanyak 30 batang</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">\"Pohon berbunga indah ini akan mempercantik lingkungan sekolah ini,\" imbuh Yusran</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dia juga mengungkapkan bahwa bibit dari jenis MPTS yang telah diterima akan ditanam dan dibagikan ke masyarakat, antara lain jenis Petai sebanyak 140 batang, Langsat sebanyak 140 batang dan Alpukat sebanyak 100 batang </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Selesai acara, personil KPH Hulu Sungai berfoto bersama sebatang pohon Ulin ( Eusideroxylon zwageri ) yang tumbuh subur di halaman rumah warga</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Menurut informasi, umur pohon Ulin ini sudah mencapai 100 tahun (risna/kphhulusungai)</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR3Ej2DGTlKb51z8yyDiIV6pYYmdDxfeiKr8rFV-9oGuo03FkSB5-Duz22U\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hmpi?__eep__=6&amp;__cft__[0]=AZU3lgmDG3yTxz1-_avtkyMiMo1FjlrUMwZ5GvNg_kXew5oYY1e27MLqdzPXTIM-i9x_lNxFgkA0KSbJ7vj6mPQFM6Lj-4_WcOD5o0Ls8vMu4vQMhk-4uTTTTzANvXXKLWdLaYv9wP2wWL_Qy0vPlbpcNq7z93AlBDMCoHMKaOi_IQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HMPI</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kphkalsel?__eep__=6&amp;__cft__[0]=AZU3lgmDG3yTxz1-_avtkyMiMo1FjlrUMwZ5GvNg_kXew5oYY1e27MLqdzPXTIM-i9x_lNxFgkA0KSbJ7vj6mPQFM6Lj-4_WcOD5o0Ls8vMu4vQMhk-4uTTTTzANvXXKLWdLaYv9wP2wWL_Qy0vPlbpcNq7z93AlBDMCoHMKaOi_IQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KPHKALSEL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZU3lgmDG3yTxz1-_avtkyMiMo1FjlrUMwZ5GvNg_kXew5oYY1e27MLqdzPXTIM-i9x_lNxFgkA0KSbJ7vj6mPQFM6Lj-4_WcOD5o0Ls8vMu4vQMhk-4uTTTTzANvXXKLWdLaYv9wP2wWL_Qy0vPlbpcNq7z93AlBDMCoHMKaOi_IQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZU3lgmDG3yTxz1-_avtkyMiMo1FjlrUMwZ5GvNg_kXew5oYY1e27MLqdzPXTIM-i9x_lNxFgkA0KSbJ7vj6mPQFM6Lj-4_WcOD5o0Ls8vMu4vQMhk-4uTTTTzANvXXKLWdLaYv9wP2wWL_Qy0vPlbpcNq7z93AlBDMCoHMKaOi_IQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Sambut HMPI 2021, Penanaman Bersama Dilaksanakan', 'Rabu', '2021-12-01', '16:16:29', '260282305_264080415750987_8150289126086528314_n.jpg', 26, '', 'Y');
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
(703, 61, 'admin', 'Sukseskan HMPI, Paman Birin Tanam Bambu Bersama Unsur Forkopimda di Dusun Pantai Kopi', '', '', 'sukseskan-hmpi-paman-birin-tanam-bambu-bersama-unsur-forkopimda-di-dusun-pantai-kopi', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px;\" segoe=\"\" ui=\"\" historic\",=\"\" \"segoe=\"\" ui\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(5,=\"\" 5,=\"\" 5);=\"\" font-size:=\"\" 15px;\"=\"\"><div dir=\"auto\" style=\"\"><span style=\"font-size: 14px; white-space: pre-wrap;\">Banjar – Program Revolusi Hijau terus digelorakan Gubernur Kalsel Sahbirin Noor. Memperingati Hari Penanaman Pohon Indonesia (HMPI) Tahun 2021 dengan tajuk “Kalsel menanam Bersama Paman Birin”, beliau memimpin langsung kegiatan menanam di Dusun Pantai Kopi Desa Mandiangin Kecamatan Karang Intan Kabupaten Banjar, Senin (22/11).\r\nDibawah terik matahari yang menyengat di kawasan Pantai Kopi, Paman Birin bersama unsur Forkopimda Kalsel dan jajaran SKPD Kalsel menanam pohon bambu kuning. Berhadir pula Setditjen PKTL KLHK Hanif Faisol Nurofiq dalam acara tersebut.\r\n“Semoga dengan apa yang kita tanam hari ini dapat menjadikan manfaat bagi masyarakat dan berguna bagi anal cucu kita di masa mendatang,” harap Paman Birin.\r\nDikatakannya, kegiatan penanaman ini selain untuk mengurangi tingkat pemanasan global, juga merupakan bentuk upaya pemerintah untuk terus mengkampanyekan menanam pohon di kalangan masyarakat.\r\nSementara Plt Kadishut Kalsel Fathimatuzzahra mengatakan kegiatan “Kalsel Menanam Bersama Paman Birin” tidak hanya dilaksanakan di lokasi tersebut, namun juga serentak di 13 kabupaten/kota se-Kalsel dengan melibatkan sekitar 7 ribu orang. \r\n“Kegiatan penanaman memang juga sudah dilaksanakan di hari sebelumnya, kemudian hari ini, dan akan terus dilaksanakan pula di hari berikutnya, total bibit yang ditanam sebanyak 65.000 batang yang setara dengan 65 hektare,” ujarnya.\r\nKegiatan Kalsel menanam dilaksanakan di 65 lokasi berbeda yang dimotori oleh SKPD Prov Kalsel dan SKPD di kabupaten/kota (Dinas LH, KPH, dan yang lainnya), penggiat lingkungan, terdiri dari FKH, KTH, LPHD, unsur desa/kelurahan, ponpes, pramuka, SMP, SMA dan masyarakat lainnya. Adapun bibit yang ditanam selain bambu kuning juga ditanam jenis tanaman kayu-kayuan antara lain trembesi, mahoni, sengon, petai, jambu mete, spathodea, dan jenis buah-buahan.\r\nSesuai arahan Gubernur Kalsel Sahbirin Noor, direncanakan pada tahun mendatang Dishut Kalsel akan menggandeng pemerintah kabupaten kota untuk melaksanakan penanaman serentak. “Kita akan memberikan penghargaan bagi kabupaten kota yang melaksanakan area penanaman terluas,” kata Fathimatuzzahra.\r\nNanti bibitnya akan disediakan oleh Pemprov Kalsel dan BPDASHL Kementerian LHK. Ditargetkan setiap tahun Dishut Kalsel melakukan penanaman seluas 32 ribu hektar untuk pengurangan lahan kritis di Kalsel.\r\nDalam acara tersebut juga hadir perwakilan dari Komunitas Dingsanak Geopark Meratus sebagai mitra pemerintah dalam upaya melibatkan partisipasi masyarakat dalam pelestarian lingkungan dan pemanfaatan Geopark sebagai objek wisata serta mendukung suksesnya sebagai UNESCO Global Geopark. (dende/dishut)\r\n-------------------------------------------\r\nAyo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :\r\nFacebook : Dishut Kalsel\r\nInstagram : instagram.com/DishutProvKalsel\r\n--------------------------------------------\r\n#HMPI\r\n#PantaiKopi\r\n#Revjo\r\n#DishutProvKalsel</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: \" segoe=\"\" ui=\"\" historic\",=\"\" \"segoe=\"\" ui\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(5,=\"\" 5,=\"\" 5);=\"\" font-size:=\"\" 15px;\"=\"\"></div>', 'Gubernur Kalimantan Selatan dan  Setditjen PKTL KLHK serta Plt Kepala Dinas Kehutanan', 'Rabu', '2021-12-01', '16:21:44', '260149374_264065262419169_4008880319884910583_n.jpg', 31, '', 'Y'),
(692, 61, 'admin', 'Kembali, Dishut Kalsel Rutin Laksanakan Latihan Karate Untuk Menjaga Kesehatan Dan Keterampilan', '', '', 'kembali-dishut-kalsel-rutin-laksanakan-latihan-karate-untuk-menjaga-kesehatan-dan-keterampilan', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Banjarbaru – Tepat pukul 07:00 pagi Dinas Kehutanan Prov Kalsel menggelar latihan karate bersama di halaman terbuka depan kantor Dishut Prov Kalsel , Rabu (24/11).  Latihan karate tersebut diikuti oleh seluruh staf Dishut Prov Kalsel dan Polisi Kehutanan dengan tetap menerapkan Protokol Kesehatan.</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Latihan karate bersama tersebut diinstrukturi Eko Djatmiko Widodo salah satu personel Polisi Kehutanan  \"kali ini kita latihan karate bersama dan ditemani sinar matahari pagi yang bagus untuk imun tubuh kita semua, dan hari ini kita lebih fokus dalam latihan pukulan agar gerakan tersebut lebih sempurna. Selain itu kita akan praktekan langsung gerakan pukulan tersebut dengan berpasangan bersama teman yang ada dibelakang kita \" kata, Eko.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Eko juga menambahkan, latihan karate yang rutin dilaksanakan setiap hari rabu ini berguna agar metabolisme dan kesehatan badan kita tetap terjaga dan harapannya seluruh staf setelah mengikuti latihan ini akan selalu sehat dan bugar dalam bekerja dan beraktifitas.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Latihan tersebut dilanjutkan dengan mempraktekkan gerakan kata 1 dan kata 2 dan ditutup dengan gerakan pendinginan agar kondisi tubuh terjaga dan tetap dalam kondisi stabil.</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://l.facebook.com/l.php?u=https%3A%2F%2Finstagram.com%2FDishutProvKalsel%3Ffbclid%3DIwAR1dyYSNXkODd43Z-kwU00hb9_KvrAzVyCU-X1zS9TqINv6ry8LbTQiTmFo&amp;h=AT1AVOt0-zp614UAe_1-Eulmp4JpTjyqtDzYGSdxxjZ3kiqvAWjPuhZLgZMmJq19kigY7B_uWiN4rTvmN3k9bJLh-BwnFs1U61PIoS9DJD4Z9z8aKXTZP5T7SQUuCHdhGcw7&amp;__tn__=-UK-y-R&amp;c[0]=AT1ZBuTNNjybhOWh_GkZoJ-6sMTmB8sPhFpp5eJTJQ3onGqxNiuwIWiFwMPUvPqX1EN0bzRfqGu6GAwiB9QL27mspAJZoKRD8L2T6eRv68SusoTRW6h2ngkHp2Jc1GXiwpWq5RUWmNHXqprdY7eDvTLEEFu4QBlorJ9Oo1WQy9r3M8ppylZEW8j9_L6pqkHSI8173I0\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/karatebersama?__eep__=6&amp;__cft__[0]=AZW5OqMBKnA2j4POlizNC1m9OjEB24_8YpS8z7NbbX0saDFJp8TMyeAqs7FQnb4hAuuqsR8wlRm2npP2ICPG4qNfT7WMZrMUHphz-dVlbzTAFGORe21q0e7gkDIWB332r-SYZwM_VEauhyo2FGAVJI5ArbS_cVip-Ep3oz_espDk6Q&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#karatebersama</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/kesehatanjasmani?__eep__=6&amp;__cft__[0]=AZW5OqMBKnA2j4POlizNC1m9OjEB24_8YpS8z7NbbX0saDFJp8TMyeAqs7FQnb4hAuuqsR8wlRm2npP2ICPG4qNfT7WMZrMUHphz-dVlbzTAFGORe21q0e7gkDIWB332r-SYZwM_VEauhyo2FGAVJI5ArbS_cVip-Ep3oz_espDk6Q&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#kesehatanjasmani</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZW5OqMBKnA2j4POlizNC1m9OjEB24_8YpS8z7NbbX0saDFJp8TMyeAqs7FQnb4hAuuqsR8wlRm2npP2ICPG4qNfT7WMZrMUHphz-dVlbzTAFGORe21q0e7gkDIWB332r-SYZwM_VEauhyo2FGAVJI5ArbS_cVip-Ep3oz_espDk6Q&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Kembali, Dishut Kalsel Rutin Laksanakan Latihan Karate Untuk Menjaga Kesehatan Dan Keterampilan', 'Rabu', '2021-12-01', '16:01:14', '257463702_265154635643565_5925405615562478794_n.jpg', 29, '', 'Y'),
(686, 61, 'admin', 'Dinas Kehutanan Raih Penghargaan Perkantoran Ramah Lingkungan', '', '', 'dinas-kehutanan-raih-penghargaan-perkantoran-ramah-lingkungan', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Banjarbaru - Dinas Kehutanan kembali raih penghargaan Perkantoran Ramah Lingkungan 2021. Penghargaan diserahkan langsung oleh Gubernur Kalsel H. Sahbirin Noor kepada Plt. Kadishut Prov Kalsel Hj. Fathimatuzzahra di sela acara pembukaan Musrenbang Provinsi Kalimantan Selatan Tahun 2021 di pada di gedung KH. Ideham Chalid, komplek perkantoran Setda Prov Kalsel Banjarbaru, Rabu (1/12).</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dinas Kehutanan meraih penghargaan peringkat kedua perkantoran ramah lingkungan diantara SKPD Pemprov lainnya. Hasil capaian ini tentunya prestasi yang menggembirakan bagi Dishut Kalsel.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dihadiri seluruh Kepala SKPD (Satuan Kerja Perangkat Daerah) Lingkup Pemerintah Provinsi Kalimantan Selatan, acara Musrenbang tersebut dilaksankan dalam rangka penyusunan dokumen Rencana Kerja Pemerintah Daerah (RPJMD) Provinsi Kalimantan Selatan Tahun 2021-2026 dengan mengangkat tema ‘Kalsel Maju’ (Makmur, Sejahtera dan Berkelanjutan) sebagai Gerbang Ibu Kota Negara.</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR31Z7HMF5LFARxqu2k0UiTE1ojeIq7jMqgv7j1sGsDJaRSKCH-BAW6WVCs\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/penghargaan?__eep__=6&amp;__cft__[0]=AZULXuWTK4ZC1rpoW2aqA7AD3Y-T_h2u6_Wc3nD1mSZmGa8aQH7WB-3WhpPHrzuljhZzI3IFuy__h-Bky3oudliP6Er1AX0BdTqb8wlGQv-C5dN_K-chQiVxbmm5XKmJS6b8Elnp8JLaYgQsRVjQmhpAKoxdss7NMs2QL_cqELlPxQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#penghargaan</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/musrenbang2021?__eep__=6&amp;__cft__[0]=AZULXuWTK4ZC1rpoW2aqA7AD3Y-T_h2u6_Wc3nD1mSZmGa8aQH7WB-3WhpPHrzuljhZzI3IFuy__h-Bky3oudliP6Er1AX0BdTqb8wlGQv-C5dN_K-chQiVxbmm5XKmJS6b8Elnp8JLaYgQsRVjQmhpAKoxdss7NMs2QL_cqELlPxQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Musrenbang2021</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZULXuWTK4ZC1rpoW2aqA7AD3Y-T_h2u6_Wc3nD1mSZmGa8aQH7WB-3WhpPHrzuljhZzI3IFuy__h-Bky3oudliP6Er1AX0BdTqb8wlGQv-C5dN_K-chQiVxbmm5XKmJS6b8Elnp8JLaYgQsRVjQmhpAKoxdss7NMs2QL_cqELlPxQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Gubernur Kalimantan Selatan beserta Plt. Kepala Dinas Kehutanan dan Kepala BAPPEDA Prov. Kalsel', 'Rabu', '2021-12-01', '15:37:59', '262798823_269805695178459_1267246647746050307_n.jpg', 29, '', 'Y'),
(687, 61, 'admin', 'Agar Tetap Bugar Dan Stamina Terjaga Dishut Kalsel Kembali Latihan Karate Bersama', '', '', 'agar-tetap-bugar-dan-stamina-terjaga-dishut-kalsel-kembali-latihan-karate-bersama', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Banjarbaru – sebelum memulai kegiatan kantor seluruh staf Dinas Kehutanan Prov Kalsel kembali gelar latihan karate bersama di halaman terbuka depan kantor Dishut Prov Kalsel, Rabu pagi (1/12).  Latihan tersebut juga dihadiri Polisi Kehutanan dan digelar dengan tetap menerapkan Protokol Kesehatan.</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Latihan karate bersama tersebut diinstrukturi Eko Djatmiko Widodo salah satu personel Polisi Kehutanan, eko mengawali latihan tersebut dengan melakukan pemanasan dan melatih gerakan dasar karate yang sudah dipelajari sebelumnya, selain itu menjelaskan kegunaan gerakan yang dilatih selama ini dalam membela diri pada saat tertekan, agar semua staf serius dalam mengikuti latihan bela diri karate bersama dalam latihan tersebut.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">\"Kali ini kita akan mempraktekkan gerakan pukulan dan tangkisan seperti gerakan gedanbarai dan ageuke yang kita latih selama ini dengan berpasangan bersama teman dibelakang kita masing masing, sebelumnya kita akan melakukan pemanasan terlebih dahulu agar otot kita tidak cedera dalam latihan nanti\" ujar Eko</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dalam latihan karate tersebut eko juga menerangkan bahwa ada sebuah pepatah \"Tujuan akhir dari karate tidak terletak pada kemenangan atau kekalahan tetapi kesempurnaan karakter para karateka\" kata, eko.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Latihan tersebut dilanjutkan dengan mempraktekkan gerakan kata 1 dan kata 2 yang selanjutnya ditutup dengan gerakan pendinginan agar kondisi tubuh terjaga dan tetap dalam kondisi stabil.</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR3RUlTsePZttEQO083QFUq5kcfCeoMOszIRMnG0eOr1u6aaX6fH4bWjdLk\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/latihankarate?__eep__=6&amp;__cft__[0]=AZUMydoU2EtRCCDIaR_fDv7z1rn_xNqd57h9M0yVmigpKvK6AY15aori2wYFPO0TwLL3cliHv_oC31OzkczRXpAaHVTnBWX_bFmJ2d-iWNsfG8MbyVtt0zIlDg13ax3eLB4DfZVPOVyylKoJ1GFbwaWt4UO8EURZewUwc6_gn4pRcQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#latihankarate</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/karatebersama?__eep__=6&amp;__cft__[0]=AZUMydoU2EtRCCDIaR_fDv7z1rn_xNqd57h9M0yVmigpKvK6AY15aori2wYFPO0TwLL3cliHv_oC31OzkczRXpAaHVTnBWX_bFmJ2d-iWNsfG8MbyVtt0zIlDg13ax3eLB4DfZVPOVyylKoJ1GFbwaWt4UO8EURZewUwc6_gn4pRcQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#karatebersama</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/badansehatdanbugar?__eep__=6&amp;__cft__[0]=AZUMydoU2EtRCCDIaR_fDv7z1rn_xNqd57h9M0yVmigpKvK6AY15aori2wYFPO0TwLL3cliHv_oC31OzkczRXpAaHVTnBWX_bFmJ2d-iWNsfG8MbyVtt0zIlDg13ax3eLB4DfZVPOVyylKoJ1GFbwaWt4UO8EURZewUwc6_gn4pRcQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#badansehatdanbugar</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZUMydoU2EtRCCDIaR_fDv7z1rn_xNqd57h9M0yVmigpKvK6AY15aori2wYFPO0TwLL3cliHv_oC31OzkczRXpAaHVTnBWX_bFmJ2d-iWNsfG8MbyVtt0zIlDg13ax3eLB4DfZVPOVyylKoJ1GFbwaWt4UO8EURZewUwc6_gn4pRcQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Karateka Dinas Kehutanan Provinsi Kalimantan Selatan', 'Rabu', '2021-12-01', '15:43:26', '258776164_269674841858211_7896731394718287661_n.jpg', 24, '', 'Y'),
(688, 61, 'admin', 'Dishut Kalsel Ikut Serta Acara Puncak Peringatan HUT Ke-50 KORPRI Tahun 2021', '', '', 'dishut-kalsel-ikut-serta-acara-puncak-peringatan-hut-ke50-korpri-tahun-2021', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">BANJARBARU - Pada pukul 09.30 WITA Dishut Prov Kalsel Ikuti pelaksanakaan Acara Puncak Peringatan HUT Ke-50 KORPRI Tahun 2021 dengan tema ASN Bersatu, Korpri Tangguh, Indonesia Tumbuh yang diikuti secara Virtual di Aula Rimbawan 1 Dishut Prov Kalsel. acara tersebut dilaksanakan dengan tetap menerapkan Protokol Kesehatan. Senin, (29/11).</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dalam acara yang dilaksanakan secara Virtual tersebut seluruh perserta yang terdiri dari Eselon 3 &amp; 4 Dishut Prov Kalsel mengikuti dengan khidmat, mulai dari awal sampai akhir Acara Puncak Peringatan HUT Ke-50 .</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Tujuan utama  Acara Puncak Peringatan HUT Ke-50 KORPRI Tahun 2021 adalah untuk memperkokoh rasa nasionalisme dan wawasan kebangsaan, pada seluruh pegawai negeri sipil dalam memberikan pelayanan kepada masyarakat.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Kegiatan tersebut dilaksanakan pada masing-masing Satuan Kerja Perangkat Daerah dilingkungan Pemerintah Provinsi Kalimantan Selatan dan diikuti oleh seluruh Anggota KORPRI dengan penuh rasa tanggungjawab, sederhana namun khidmat dengan tetap mematuhi protokol kesehatan dan melaporkan pelaksanaannya kepada Sekretaris KORPRI Provinsi Kalimantan Selatan melalui Badan Kepegawaian Daerah Provinsi Kalimantan Selatan.</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR3huArUn-fvHBgMR72KbxeYiw0xLIDkoKgDw1caSG7xjLuXTltlZ_kQIqk\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hutkorprike50?__eep__=6&amp;__cft__[0]=AZWtn47ttSwK3_UjlQjm0YhZSo9ZiBc_XuSd8zm6ri0_LX3o-eg1h0Z2WMtF_nSeTSBms5LJfewW0IT0vT6yAJFK_9GRZ38gh2NjMoEAFQJV3LEwdvgb7OvuTJ6Ij-zPa_YPbi1uCr7wCWkOFlL8S29z6ZBT18WDPEyfSOe6eSTwjg&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HUTKORPRIKE50</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/korprinasional?__eep__=6&amp;__cft__[0]=AZWtn47ttSwK3_UjlQjm0YhZSo9ZiBc_XuSd8zm6ri0_LX3o-eg1h0Z2WMtF_nSeTSBms5LJfewW0IT0vT6yAJFK_9GRZ38gh2NjMoEAFQJV3LEwdvgb7OvuTJ6Ij-zPa_YPbi1uCr7wCWkOFlL8S29z6ZBT18WDPEyfSOe6eSTwjg&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KORPRINASIONAL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZWtn47ttSwK3_UjlQjm0YhZSo9ZiBc_XuSd8zm6ri0_LX3o-eg1h0Z2WMtF_nSeTSBms5LJfewW0IT0vT6yAJFK_9GRZ38gh2NjMoEAFQJV3LEwdvgb7OvuTJ6Ij-zPa_YPbi1uCr7wCWkOFlL8S29z6ZBT18WDPEyfSOe6eSTwjg&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Plt. Kepala Dinas Kehutanan Provinsi Kalimantan Selatan Beserta Eselon 3 & 4', 'Rabu', '2021-12-01', '15:45:54', '261862711_268501908642171_3838949963938125469_n.jpg', 24, '', 'Y'),
(689, 61, 'admin', 'Dishut Kalsel Gelar Apel Bersama Peringatan HUT KORPRI', '', '', 'dishut-kalsel-gelar-apel-bersama-peringatan-hut-korpri', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Banjarbaru - Memperingati HUT Korps Pegawai Negeri Republik Indonesia (KORPRI) ke-50, Dinas Kehutanan Prov. Kalsel menggelar apel bersama di halaman Kantor Dishut Kalsel Banjarbaru, Senin (29/11) yang diikuti oleh Aparatur Sipil Negara (ASN) beserta seluruh staf.</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Apel di laksanakan dengan hikmat dan dipimpin oleh Sekretaris Dishut Kalsel Bijuri. Berhadir pula Plt. Kadishut Prov Kalsel Fathimatuzzahra bersama para pejabat lingkup Dishut Prov Kalsel. </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dalam amanatnya, Sekretaris Dishut mengucapkan selamat ulang tahun kepada seluruh anggota KORPRI di Kalimantan Selatan. </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">\"Mengusung tema HUT KORPRI, ASN Bersatu, KORPRI Tangguh, Indonesia Tumbuh., saya berharap kepada para anggota KORPRI khususnya di Lingkup Dinas Kehutanan  Prov Kalsel untuk tetap bersemangat dalam bekerja sebagai Aparatur Sipil Negara\", ucap Bijuri</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Harapannya, semoga pada momentum HUT Korpri ke-50 ini seluruh anggota KORPRI dapat memberikan kontribusi dan upaya sebagai awal perjuangan KORPRI di usia ke-50 tahun, serta meningkatkan kinerja sebagai Aparatur Sipil Negara.</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://l.facebook.com/l.php?u=https%3A%2F%2Finstagram.com%2FDishutProvKalsel%3Ffbclid%3DIwAR1dvcVa9oSHFS92XNanVz-0g-6-sQf4uV_EzK0UB51t29-scQIus2C22YI&amp;h=AT3pIAOMbo_7yWCiUPW4KiWkprRIYUtr_N222IMJlKExiCajXzlCfGGwDbSwOrOD3BA0BF0a8EAo7M4WSgHge2yXr0RnBY5MPSBC-XRc-FPXV_82AZ9wgYkAt-W3gvs1Taqu&amp;__tn__=-UK-y-R&amp;c[0]=AT3Bf2KfgjrMnRXI7KtE2vJtQq66YkNMWbX9_FjXGpeEyg0XYSJMnHhU3vbZxaokqHDS1W_VsaW1c_TjjLQ6V4jM-NroFjbZRMqaawPjrCJAORF0TNkfMib0u5XV4_Bpvxv5DyglgbdZSB_qn4Mokrljah8Blkl8CC3xZpAKzA3sNr9zgQ00Y_1ej1gvSdOKsuLasSk\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hutkorprike50?__eep__=6&amp;__cft__[0]=AZWhNioZY0u_Kt-lNa9IViETwZRZjiiWIRiRs_i_pVgdP3DecEofFAxPlNXyaJ3VBLh9unTFiRJT1GWTValoRTWaOg9ZtFykr6m0xiTaJKgWljhiwBePEAzxVf0brjXphD6ZZjPqfenBL-hPbzugT7Rhz1y8WDSti78YoP_M4NPz-w&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#HUTKORPRIKE50</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/korprinasional?__eep__=6&amp;__cft__[0]=AZWhNioZY0u_Kt-lNa9IViETwZRZjiiWIRiRs_i_pVgdP3DecEofFAxPlNXyaJ3VBLh9unTFiRJT1GWTValoRTWaOg9ZtFykr6m0xiTaJKgWljhiwBePEAzxVf0brjXphD6ZZjPqfenBL-hPbzugT7Rhz1y8WDSti78YoP_M4NPz-w&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#KORPRINASIONAL</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZWhNioZY0u_Kt-lNa9IViETwZRZjiiWIRiRs_i_pVgdP3DecEofFAxPlNXyaJ3VBLh9unTFiRJT1GWTValoRTWaOg9ZtFykr6m0xiTaJKgWljhiwBePEAzxVf0brjXphD6ZZjPqfenBL-hPbzugT7Rhz1y8WDSti78YoP_M4NPz-w&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Dishut Kalsel Gelar Apel Bersama Peringatan HUT KORPRI', 'Rabu', '2021-12-01', '15:48:50', '261984126_268466348645727_5165746297813058738_n.jpg', 24, '', 'Y');
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
(690, 61, 'admin', 'Menaman Dan Menaman, Dishut Kalsel Gelorakan Semangat Revolusi Hijau Tanam 800 Bibit Sengon', '', '', 'menaman-dan-menaman-dishut-kalsel-gelorakan-semangat-revolusi-hijau-tanam-800-bibit-sengon', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">BANJARBARU – Tepat pukul 07:00 Wib seluruh personel Dishut Kalsel, Balai Perbenihan Tanaman Hutan(BPTH), dan Polisi Kehutanan kembali beraksi melakukan penanaman bersama, Jum\'at Pagi (26/11). Kali ini penanaman dilaksanakan disekitaran belakang Lapas Banjarbaru yang berada dalam kawasan perkantoran Pemprov Kalsel. dengan tetap menerapkan protokol kesehatan seperti menggunakan masker dan menjaga jarak penanaman tersebut digelar.</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Kasubbag Tata Usaha BPTH Agung Hananto, yang juga menjadi peserta dalam kegiatan penanaman bersama tersebut mengatakan bahwa walaupun kondisi lokasi penanaman kotor karena sehabis diguyur hujan tidak melunturkan semangat Revolusi Hijau para Rimbawan \"Walau sebelumnya lokasi penanaman sempat terguyur hujan, kita semua harus tetap semangat dalam melaksanakan kegiatan ini, diharapkan nantinya bisa memperbaiki kualitas lingkungan hidup yang lebih baik lagi\" kata, Agung</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Pagi itu, setelah berkumpul dilokasi penanaman semua personil langsung bergegas menanam dengan menggunakan alat alat penanaman yang sudah dibawa dari rumah masing-masing sebelumnya seperti cangkul, sarung tangan, parang, dan sepatu boots. Tak lupa setelah ditanam, semua tanaman tersebut langsung diberi pupuk agar menjaga tanaman bisa tumbuh dengan baik dan maksimal.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Penanaman yang dilaksanakan setiap pagi dihari kamis dan jumat tersebut rutin dilaksanakan Dishut Prov Kalsel untuk mendukung dan membangkitkan semangat Revolusi Hijau.</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dengan gembira, total sekitar 800 bibit Sengon berhasil ditanam  semua personel dengan semangat Revolusi Hijau dikawasan tersebut.(olf/dishut)</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR1otGroNzaObHtPh7zdZgCdc5K6j_GauiXuMIAvtkGdb_OIXAv35GJRx9U\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/penanamanbersama?__eep__=6&amp;__cft__[0]=AZWImgRwSqAup44Fe4b2YP9g_13tM23a6RiCg4TCOQsxit0sMN6qTnXUSYPfy7qJNroBLCw00Aa4UNUAyO_RRG_f38cryDjHUKFTxrT74h2wsUW6_o4iWIWxMH-H3WNphGMMaR2ryNogpybT-PReUT01xO0l_Qns_9I_qcvnqusOYQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#penanamanbersama</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/bibitsengon?__eep__=6&amp;__cft__[0]=AZWImgRwSqAup44Fe4b2YP9g_13tM23a6RiCg4TCOQsxit0sMN6qTnXUSYPfy7qJNroBLCw00Aa4UNUAyO_RRG_f38cryDjHUKFTxrT74h2wsUW6_o4iWIWxMH-H3WNphGMMaR2ryNogpybT-PReUT01xO0l_Qns_9I_qcvnqusOYQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#bibitsengon</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revolusihijau?__eep__=6&amp;__cft__[0]=AZWImgRwSqAup44Fe4b2YP9g_13tM23a6RiCg4TCOQsxit0sMN6qTnXUSYPfy7qJNroBLCw00Aa4UNUAyO_RRG_f38cryDjHUKFTxrT74h2wsUW6_o4iWIWxMH-H3WNphGMMaR2ryNogpybT-PReUT01xO0l_Qns_9I_qcvnqusOYQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#revolusihijau</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZWImgRwSqAup44Fe4b2YP9g_13tM23a6RiCg4TCOQsxit0sMN6qTnXUSYPfy7qJNroBLCw00Aa4UNUAyO_RRG_f38cryDjHUKFTxrT74h2wsUW6_o4iWIWxMH-H3WNphGMMaR2ryNogpybT-PReUT01xO0l_Qns_9I_qcvnqusOYQ&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Dishut Kalsel Gelorakan Semangat Revolusi Hijau Tanam 800 Bibit Sengon', 'Rabu', '2021-12-01', '15:51:22', '258572572_266612162164479_5963168040706605774_n.jpg', 25, '', 'Y'),
(691, 61, 'admin', 'Dishut Gelar Pemeliharaan Tanaman Disekitar Belakang  Lapas Banjarbaru', '', '', 'dishut-gelar-pemeliharaan-tanaman-disekitar-belakang--lapas-banjarbaru', 'N', 'N', 'N', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\">Banjarbaru – Berlanjut, kali ini pemeliharaan tanaman yang dilakukan tim gabungan dari Dishut Prov. Kalsel, Balai Perbenihan tanaman Hutan, dan Polisi Kehutanan. Pemeliharaan tanaman kali ini  berlokasi dibelakang lapas banjarbaru yang termasuk dalam kawasan perkantoran Pemprov Kalsel.</span><br></div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Dipimpin langsung Kabid Perencanaan Pemanfaatan Hutan Warsita Jinawi Kamis pagi(25/11).  Setelah berkumpul dilokasi, dan pembagian tugas kepada  semua personel gabungan tersebut. Dengan alat yang sudah dibawa personil dari rumah masing masing seperti cangkul dan sarung tangan, kali ini perawatan tanaman yang dilakukan dengan cara pemberian pupuk kompos dan pupuk npk tertuju pada tanaman yang sudah ditanam dikawasan tersebut .</div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">“Dinas Kehutanan tugas utamanya menanam dan menanam, jadi kita semua juga harus semangat dalam kegiatan pemeliharaan agar tumbuh bibit tanaman bisa baik dan maksimal\" kata, Warsita. </div></div><div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">para personil sangat bersemangat dalam kegiatan kali ini, Dengan menggunakan sepatu boots semua personil berpencar sesuai arahan untuk memberikan pupuk kompos dan pupuk npk yang sudah disediakan disetiap tanaman yang berada dilokasi tersebut.(olf/dishut)</div><div dir=\"auto\" style=\"font-family: inherit;\">-------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\">Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div dir=\"auto\" style=\"font-family: inherit;\">Facebook : Dishut Kalsel</div><div dir=\"auto\" style=\"font-family: inherit;\">Instagram : <span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl py34i1dx gpro0wi8\" href=\"https://instagram.com/DishutProvKalsel?fbclid=IwAR1Age9m4ShKWBmHZaQ4H8D_kMZr4UQQDIxxDDcDpPhtPBWmpZAI2AxNv70\" rel=\"nofollow noopener\" role=\"link\" tabindex=\"0\" target=\"_blank\" style=\"color: var(--blue-link); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">instagram.com/DishutProvKalsel</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\">--------------------------------------------</div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/pemeliharaantanaman?__eep__=6&amp;__cft__[0]=AZWfSshtBuXvfUjEUzUiOkqebPaDM3OtHJZUMaOJJ-CM0sZW_Z-8-y7HBx7nIZJ1Hndj_CNtnKPZ28MWoQajzwK1He8xomykEQiGRswJLqg2OOl6LaQSDCpwjk_Zg6bjZ5qWQnHJTlRlsyBlHSJY3v9l-hdNHYWv9ugbz1BbNDGeoA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#Pemeliharaantanaman</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/revjo?__eep__=6&amp;__cft__[0]=AZWfSshtBuXvfUjEUzUiOkqebPaDM3OtHJZUMaOJJ-CM0sZW_Z-8-y7HBx7nIZJ1Hndj_CNtnKPZ28MWoQajzwK1He8xomykEQiGRswJLqg2OOl6LaQSDCpwjk_Zg6bjZ5qWQnHJTlRlsyBlHSJY3v9l-hdNHYWv9ugbz1BbNDGeoA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#revjo</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/hutanlestarimasyarakatsejahtera?__eep__=6&amp;__cft__[0]=AZWfSshtBuXvfUjEUzUiOkqebPaDM3OtHJZUMaOJJ-CM0sZW_Z-8-y7HBx7nIZJ1Hndj_CNtnKPZ28MWoQajzwK1He8xomykEQiGRswJLqg2OOl6LaQSDCpwjk_Zg6bjZ5qWQnHJTlRlsyBlHSJY3v9l-hdNHYWv9ugbz1BbNDGeoA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#hutanlestarimasyarakatsejahtera</a></span></div><div dir=\"auto\" style=\"font-family: inherit;\"><span style=\"font-family: inherit;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" href=\"https://www.facebook.com/hashtag/dishutprovkalsel?__eep__=6&amp;__cft__[0]=AZWfSshtBuXvfUjEUzUiOkqebPaDM3OtHJZUMaOJJ-CM0sZW_Z-8-y7HBx7nIZJ1Hndj_CNtnKPZ28MWoQajzwK1He8xomykEQiGRswJLqg2OOl6LaQSDCpwjk_Zg6bjZ5qWQnHJTlRlsyBlHSJY3v9l-hdNHYWv9ugbz1BbNDGeoA&amp;__tn__=*NK-y-R\" role=\"link\" tabindex=\"0\" style=\"color: var(--accent); cursor: pointer; outline: none; list-style: none; border-width: 0px; border-style: initial; border-color: initial; padding: 0px; margin: 0px; touch-action: manipulation; text-align: inherit; display: inline; -webkit-tap-highlight-color: transparent; font-family: inherit;\">#DishutProvKalsel</a></span></div></div>', 'Dishut Gelar Pemeliharaan Tanaman Disekitar Belakang  Lapas Banjarbaru', 'Rabu', '2021-12-01', '15:53:23', '255368093_265909372234758_5698327444798128861_n.jpg', 23, '', 'Y'),
(704, 61, 'admin', 'HUT Polhut Ke-55 Dirayakan Dengan Apel Bersama dan Penanaman 1.000 Bibit Pohon', '', 'https://youtu.be/0v2pKnUx1NI', 'hut-polhut-ke55-dirayakan-dengan-apel-bersama-dan-penanaman-1000-bibit-pohon', 'N', 'N', 'N', '<div class=\"cxmmr5t8 oygrvhab hcukyx3x c1et5uql o9v6fnle ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px;\" segoe=\"\" ui=\"\" historic\",=\"\" \"segoe=\"\" ui\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(228,=\"\" 230,=\"\" 235);=\"\" background-color:=\"\" rgb(36,=\"\" 37,=\"\" 38);\"=\"\"><div dir=\"auto\" style=\"\"><span style=\"white-space: pre-wrap;\">Mandiangin – Seluruh personel Polisi Kehutanan di Kalsel  berkumpul untuk melaksanakan Apel bersama dalam rangka HUT Polisi Kehutanan yang ke-55 bertemakan \"Polhut Handal Hutan Lestari\" yang dilaksanakan di Plaza Taman Hutan Raya Sultan Adam Mandiangin. Kegiatan apel HUT Polisi Kehutanan yang Ke-55 tersebut dilaksanakan serentak seluruh jajaran Polisi Kehutanan di Indonesia. Senin pagi, (27/12).\r\nApel dipimpin langsung oleh Plt. Kadishut Prov Kalsel Fathimatuzzahra bersama jajaran Polisi Kehutanan diKalsel. juga hadir Perwakilan dari Polda Kalsel, Polres Banjarbaru, BPHP Wilayah IX, BPKH Wilayah V, BPDASHL Barito, BPP LHK, BPSKL, Kepala Balai Gakum Kalimantan Seksi Wilayah I, IPKI Kalsel, BKSDA Kalsel, dan Polhut KPH lingkup Dishut Prov Kalsel.\r\nDengan tetap mematuhi Protokol Kesehatan seperti menggunakan Masker dan Handsanitizer\r\nSeluruh peserta apel tersebut mengikuti dengan hikmat apel tersebut serta menyanyikan lagu Indonesia Raya Dan Mars Polisi Kehutanan selain itu pembacaan Undang-Undang Dasar dan pembacaan Pancasatya Polisi Kehutanan.\r\nFathimatuzzahra atau sapaan akrabnya \'Aya\' dalam sambutannya mengatakan “sebelumnya saya sampaikan ucapkan selamat ulang tahun Polisi Kehutanan yang ke-55, dan saya yakin Polhut semakin memberi kontribusi untuk membangun negara khususnya dalam pencegahan dan membatasi kerusakan hutan, kawasan hutan, dan hasil hutan. yang tidak lain bahwa semua itu untuk bela negara dan bangsa” kata, Fathimatuzzahra.\r\nPelaksanaan Apel HUT Polisi Kehutanan ke-55 tersebut dilanjutkan dengan kegiatan penanaman bersama yang dilaksanakan tepat dihalaman belakang Plaza Tahura Sultan Adam Mandiangin oleh semua peserta yang hadir.\r\nDengan gembira, sekitar 1000 bibit pohon dengan jenis tanaman meranti dan pulantan tertanam dilokasi tersebut dan langsung diberi pupuk untuk memaksimalkan pertumbuhan tanaman.(olf/dishut)\r\n-------------------------------------------\r\nAyo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :\r\nFacebook : Dishut Kalsel\r\nInstagram : instagram.com/DishutProvKalsel\r\n--------------------------------------------\r\n#apelbersama\r\n#HUTPOLHUT\r\n#UlangTahunPolisiKehutananke55\r\n#TahuraSultanAdamMandiangin\r\n#DishutProvKalsel</span><br></div></div><div class=\"cxmmr5t8 oygrvhab hcukyx3x c1et5uql o9v6fnle ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: \" segoe=\"\" ui=\"\" historic\",=\"\" \"segoe=\"\" ui\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(228,=\"\" 230,=\"\" 235);=\"\" background-color:=\"\" rgb(36,=\"\" 37,=\"\" 38);\"=\"\"></div>', '', 'Selasa', '2022-01-04', '13:56:08', '270248101_287452920080403_1134991263781554329_n.jpg', 39, '', 'Y'),
(706, 61, 'admin', 'Dishut Kalsel Serahkan Laporan Revjo dan Perhutanan Sosial 2021 Kepada Kemen LHK', '', '', 'dishut-kalsel-serahkan-laporan-revjo-dan-perhutanan-sosial-2021-kepada-kemen-lhk', 'N', 'N', 'N', '<div>Jakarta - Plt. Kepala Dinas Kehutan Prov Kalsel, Fathimatuzzahra menyerahkan Laporan Revolusi Hijau dan Laporan Perhutanan Sosial tahun 2021 kepada Direktorat Jendral PDAS RH dan Direktorat Jendral PSKL di Gedung Manggala Wanabakti Jakarta, Senin (10/1/2022).</div><div>Saat Penyerahan, Kadishut Kalsel didampingi oleh Kasi RHL Dishut Kalsel.&nbsp;</div><div>“Alhamdulillah hari ini kita menyerahkan Laporan Revjo dan Laporan Perhutanan Sosial tahun 2021, semoga hasil pemeriksaan nantinya sesuai dan kita bisa terus kembali melanjutkan program Revolusi Hijau dan Perhutanan Sosial demi tercipta nya hutan lestari masyarakat sejahtera untuk pembangunan kehutanan,” ucap Fathimatuzzahra.</div><div>Dalam kunjungan tersebut juga dilaksanakan koordinasi terkait rencana pembangunan persemaian modern yang dialokasikan oleh Kemen LHK kepada Pemprov Kalsel melalui Dinas Kehutanan</div><div>-----------------------------------------</div><div>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div>Facebook : facebook.com/DishutProvKalsel</div><div>Instagram : instagram.com/DishutProvKalsel</div><div>--------------------------------------------</div><div>.</div><div>.</div><div>.</div><div>#Revjo</div><div>#Kunker</div><div>#DishutProvKalsel</div>', '', 'Rabu', '2022-01-12', '11:18:38', 'Untitled-2.jpg', 28, '', 'Y'),
(707, 61, 'admin', 'Dirjend PKTL Kementerian LHK Kunjungi Tahura SA', '', 'https://www.youtube.com/watch?v=EKEW9riKm_w', 'dirjend-pktl-kementerian-lhk-kunjungi-tahura-sa', 'N', 'N', 'N', '<p>Banjarbaru - Dishut Kalsel Gelar Acara Ramah Tamah dan Dialog dalam rangka Kunjungan Kerja Direktur Jendral Planalogi Kehutanan dan Tata Lingkungan Kementerian Lingkungan Hidup dan Kehutanan RI Ruandha Agung Sugardiman. Dilaksanakan di Pesanggaran/Rumah Belanda Tahura Sultan Adam dengan tetap mengutamakan Protokol Kesehatan Covid-19. Rabu, (12/1).</p><p>Dalam Acara Ramah Tamah dan Dialog tersebut juga dihadiri  Sekditjen PKTL Kemen LHK Hanif Faisol Nurofiq dan beberapa perwakilan SKPD Provinsi Kalsel seperti Dinas Lingkungan Hidup Prov Kalsel, Dinas Peternakan Dan Perkebunan Prov Kalsel, dan BAPPEDA Prov Kalsel. Hadir juga perwakilan UPT Kementerian LHK yang ada di Provinsi Kalsel yakni BPHP Wilayah XI, BPKH Wilayah V, BPDASHL Barito, BKSDA Kalsel, BPSKL Wilayah Kalimantan, BPSILHK Wilayah Kalimantan.</p><p>Diacara tersebut  Direktur Jendral Planalogi Kehutanan dan Tata Lingkungan Kementerian Lingkungan Hidup dan Kehutanan RI Ruandha Agung Sugardiman </p><p>juga berkesempatan untuk melakukan penanaman pohon  jenis Tabebuya sebagai tanda cinta lingkungan yang merupakan jiwa dari seorang rimbawan.</p><p>Selain itu Direktur Jendral Planalogi Kehutanan dan Tata Lingkungan Kementerian Lingkungan Hidup dan Kehutanan RI Ruandha Agung Sugardiman </p><p>didampingi  langsung  Plt. Kadishut Prov Kalsel Fathimatuzzahra bersama sama melihat suasanan dikawasan Pesanggrahan/Rumah Belanda Tahura Sultan Adam.</p><p>\"Melihat pemandangan yang luar biasa di Tahura Sultan Adam Mandiangin ini betul betul memanjakan mata kita semua, dan Pesanggrahanini adalah salah satu bangunan belanda yang direnovasi sehingga menjadi tempat peristirahatan menarik untuk para wisatawan. Kata, Ruandha Agung Sugardiman.</p><p>Ruandha Agung Sugardiman menambahkah bahwa Eko Wisata Tahura Sultan Adam merupakan tempat yang bagus untuk wadah pelestarian hutan di indonesia terutama di Provinsi Kalimantan Selatan. \"Ini suatu upaya yang luar biasa, bagaimana kita bisa melestarikan hutan kita sehingga betul-betul tujuan pelestarian alam indonesia terutama di Provinsi Kalimantan Selatan bisa tercapai, dan dengan adanya bangunan fenomenal (Pesanggaran/Rumah Belanda) ditahura sultan adam ini nilai konservasi semakin luar biasa\" katanya.</p><p>Kegiatan Ramah Tamah dan Dialog tersebut dilanjutkan dengan acara makan malam sambil berbincang terkait tetang Kehutanan dan Wisata Tahura Sultan Adam.</p><p>-----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#DirjendPKTLKementerianLHK</p><p>#ramahtamahdandialog</p><p>#TahuraSultanAdam</p><p>#DishutProvKalsel</p><div><br></div>', '', 'Rabu', '2022-02-16', '14:45:40', '1.jpg', 26, 'tahura-sultan-adam,dinas-kehutanan,dishut-kalsel', 'Y'),
(708, 61, 'admin', 'Sebelum Sarapan, Gubernur Kalsel Dan Direktur Jenderal PKTL KLHK RI Tanam Pohon Meranti di TH2TI', '', 'https://youtu.be/ObYUwB4lsc8', 'sebelum-sarapan-gubernur-kalsel-dan-direktur-jenderal-pktl-klhk-ri-tanam-pohon-meranti-di-th2ti', 'N', 'N', 'N', '<p>Banjarbaru - Langit cerah mengawali jamuan makan pagi bersama antara Gubernur Kalimantan Selatan Sahbirin Noor dengan Direktur Jenderal PKTL KLHK RI Ruandha Agung Sugardiman di Hutan Kota atau yang biasa dikenal (Taman Hutan Hujan Tropis Indonesia) TH2TI yang terletak di kawasan Komplek Perkantoran Pemprov Kalsel. Jamuan makan pagi ini diselenggarakan disela kunjungan kerja Direktur Jenderal PKTL KLHK RI Ruandha Agung Sugardiman yang akan menyerahkan Dokumen Hasil Kajian dan Penandatanganan Nota Kesepakatan Bersama Upaya Percepatan Pemulihan Lingkungan Hidup Pasca Banjir di Kalsel antara Kementerian Lingkungan Hidup dan Kehutanan dengan Pemerintah Provinsi Kalsel. Kegiatan dilaksanakan dengan tetap mengutamakan Protokol Kesehatan Covid-19. Kamis pagi, (13/1).</p><p>Sebelum jamuan sarapan pagi dimulai, kegiatan diawali dengan penanaman bersama bibit pohon Meranti Kuning yang dipimpin langsung Gubernur Kalimantan Selatan Sahbirin Noor atau yang sering disapa Paman Birin. \"Menanam, menanam, dan menanam untuk anak cucu kita\", kata paman birin, sambil melakukan penanaman pohon tersebut.</p><p>Hadir dalam acara tersebut Ketua DPRD Supian HK, Sekda Prov Kalsel Roy Rizali Anwar, Sekditjen PKTL Kemen LHK Hanif Faisol Nurofiq dan Plt. Kadishut Prov Kalsel Fathimatuzzahra. Hadir pula perwakilan SKPD lingkup Provinsi Kalsel seperti Dinas Lingkungan Hidup Prov Kalsel, Dinas PUPR Prov Kalsel, Dinas PRKP Prov Kalsel, Dinas ESDM Prov Kalsel, Dinas Perkebunan dan Peternakan, Dinas Penanaman Modal dan Perizinan Terpadu Satu Pintu Prov Kalsel, Dinas Pemberdayaan Masyarakat dan Desa Prov Kalsel, Dinas Pariwisata Prov Kalsel, BPBD Prov Kalsel, Biro Organisasi Prov Kalsel, Biro Pemerintahan dan Otonomi Daerah Prov Kalsel, BPKH Wilayah V, BPDASHL Barito, BKSDA Kalimantan, Balai Penelitian dan Pengembangan LHK Banjarbaru, Balai Penerapan Standar Instrumen LHK Banjarbaru.</p><p>Setelah acara jamuan sarapan pagi selesai dilaksanakan, Gubernur Kalimantan Selatan Sahbirin Noor dan Direktur Jenderal PKTL KLHK RI Ruandha Agung Sugardiman bergeser menuju ruang rapat Ideham Chalid Pemerintah Provinsi Kalsel untuk melanjutkan ke acara pokok kunjungan kerja Ruandha Agung Sugardiman.</p><p>-----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#penanamanpohonbersamagubernurkalsel</p><p>#pemprovkalsel</p><p>#DishutProvKalsel</p>', '', 'Rabu', '2022-02-16', '14:46:57', '21.jpg', 26, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(705, 61, 'admin', 'Bersama Membangun Tahura Sultan Adam Dengan Semangat Revolusi Hijau', '', 'https://youtu.be/ihC9ytAjvcQ', 'bersama-membangun-tahura-sultan-adam-dengan-semangat-revolusi-hijau', 'N', 'N', 'N', '<div>Mandiangin - Pagi cerah pukul 07:00 Jumat (7/1) berlokasi dibelakang Plaza Suharto Tahura Sultan Adam seluruh peserta yang hadir bukan hanya dari jajaran Dinas Kehutanan Kalsel saja, melainkan para anggota Polisi Kehutanan, dan UPT Tahura Sultan Adam Mandiangin. Penanaman tersebut dilaksanakan dengan tetap menerapkan Protokol Kesehatan.</div><div>Aksi penanaman tersebut dibuka langsung oleh Plt. Kadishut Prov Kalsel Fathimatuzzahra melalui apel pagi \"sebelum pelaksanaan penanaman bersama yang pertama dengan dilaksanannya kegiatan penanaman ini kita ingin menyatukan kembali jiwa korsa bagi sesama rimbawan kita, saling bersaudara, saling bertanggung jawab dan kedua kita akan tutup Tahura Sultan Adam dengan tanaman yang hijau\" kata \'Aya\' sapaan akrab Fathimatuzzahra. Setelah diawali apel pagi dan pengarahan oleh Aya, bibit langsung dibagikan kepada para staf. Semua bergerak cepat. Bibit dibawa untuk ditanam. </div><div>Setelah pembagian instruksi seluruh staf langsung berpencar dan terjun ke lokasi sesuai arahan yang sudah diberikan. Satu persatu mereka turun ke lokasi penanaman yang miring dengan membawa bibit yang ditanam. Ada yang dengan cara digendong, ada pula yang dirangkul.</div><div>Dengan gembira,  satu per satu bibit pohon ditanam di lokasi tersebut. Walau di lokasi penanaman sedikit bertanah liat dan licin karna bebatuan, tak menyulitkan seluruh anggota beraksi. Semangat tetap berkobar, meskipun keringat bercucuran.</div><div>Sampai selesai dengan semangat Revolusi Hijau sekitar 1000 bibit seperti bibit kapuk dan bibit johar berhasil ditanam dikawasan belakang Plaza Suharto Tahura Sultan Adam Mandiangin.</div><div>------------------------------------------</div><div>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</div><div>Facebook : Dishut Kalsel</div><div>Instagram : instagram.com/DishutProvKalsel</div><div>--------------------------------------------</div><div>#penamanbersama</div><div>#bibitkapuk</div><div>#bibitjohar</div><div>#TahuraSultanAdamMandiangin</div><div>#DishutProvKalsel</div>', '', 'Senin', '2022-01-10', '07:55:19', '271546583_294259809399714_6355615384577085517_n.jpg', 31, '', 'Y'),
(709, 61, 'admin', 'Dishut Kalsel Hadiri  Acara Penandatanganann MoU Percepatan Pemulihan Lingkungan Hidup Pasca Banjir', '', '', 'dishut-kalsel-hadiri--acara-penandatanganann-mou-percepatan-pemulihan-lingkungan-hidup-pasca-banjir', 'N', 'N', 'N', '<p>Banjarbaru - Plt. Kadishut Prov Kalsel Fathimatuzzahra hadiri kegiatan Penyerahan Dokumen Pengamanan Lingkungan dan DAS Barito Berbasis Ekoregion, Kolaborasi KLHK Dengan Pemprov Kalsel dan Penandatanganan Kesepakatan Bersama Upaya Percepatan Pemulihan Lingkungan Hidup Pasca Banjir di Provinsi Kalsel yang dilaksanakan di Aula Idham Khalid Setda Prov Kalsel, Kamis (13/1).</p><p>Acara tersebut juga dihadiri Sekretaris Daerah Prov Kalsel Roy Rizali Anwar, Ketua DPRD Prov Kalsel Supian HK, Bupati dan Walikota se Kalsel, serta perwakilan SKPD dan seluruh kepala Balai terkait Provinsi Kalsel. Acara dilaksanakan dengan tetap menerapkan Protokol Kesehatan yang ketat.&nbsp;</p><p>Penandatanganan Kesepakatan Bersama Upaya Percepatan Pemulihan Lingkungan Hidup Pasca Banjir di Provinsi Kalsel dilakukan oleh Gubernur Kalsel Sahbirin Noor dengan Bupati dan Walikota diKalsel yang kemudian dilanjutkan dengan Penyerahan Dokumen Pengamanan Lingkungan dan DAS Barito Berbasis Ekoregion, Kolaborasi KLHK Dengan Pemprov Kalsel yang diserahkan langsung oleh Gubernur Kalsel.&nbsp;</p><p>Gubernur Kalsel Sahbirin Noor yang memimpin acara tersebut menyampaikan bahwa \"dalam menanggulangi sebuah bencana kita tidak bisa hanya sendiri, maka dari itu dibutuhkan satu tim yang solid baik pemerintah pusat, pemerintah provinsi, dan pemerintah kabupaten/kota dengan catatan dilakukan dengan perencanaan yang baik dan diaplikasikan dalam pekerjaan yang juga baik,” ujar Sahbirin Noor.</p><p>Direktur Jendral PKTL KLHK RI, Ruanda Agung Sugardiman yang juga turut hadir dalam acara tersebut menyampaikan bahwa \"sebelumnya kami diutus ibu Mentri untuk menyampaikan hasil kajian ini, dan ini mungkin akan menjadi model di nasional dimana kita akan bisa menangani bencana banjir khususnya secara TSM (Terstruktur, Sistematis, dan Masif) artinya penyelesaiannya betul betul&nbsp; secara kompetensif dan ini bisa dilakukan dengan kajian-kajian mendalam dari sisi ilmiahnya,” kata Ruanda Agung Sugardiman pada saat paparan.</p><p>Kegiatan tersebut secara panjang lebar bertujuan untuk upaya percepatan pemulihan lingkungan hidup pasca banjir di Provinsi Kalimantan Selatan.</p><p>-----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#PenandatanganannMoUPercepatanPemulihanLingkunganHidupPascaBanjir</p><p>#gubernurkalsel</p><p>#DishutProvKalsel</p><p><br></p><p><img src=\"https://siforestka.co.id/asset/images/271806273_298058959019799_6524129957855224278_n.jpg\" style=\"width: 960px;\"><img src=\"https://siforestka.co.id/asset/images/271835232_298058812353147_5849844639234824664_n.jpg\" style=\"width: 960px;\"><img src=\"https://siforestka.co.id/asset/images/271877589_298062412352787_1007971229624902970_n.jpg\" style=\"width: 960px;\"><img src=\"https://siforestka.co.id/asset/images/271806273_298058959019799_6524129957855224278_n1.jpg\" style=\"width: 960px;\"><br></p>', '', 'Jumat', '2022-01-14', '13:02:57', '271858451_298058559019839_958659130855725760_n.jpg', 29, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(710, 61, 'admin', 'Fasilitasi GGGI, Dishut Gelar FGD Imbal Jasa Lingkungan Tahura Sultan Adam', '', '', 'fasilitasi-gggi-dishut-gelar-fgd-imbal-jasa-lingkungan-tahura-sultan-adam', 'N', 'N', 'N', '<p>Banjarbaru - Dishut Kalsel kembali menggelar Forum Group Discussion (FGD) Kajian Imbal Jasa Lingkungan Tahura Sultan Adam di Hotel Novotel Banjarbaru, Kamis (13/1). FGD tersebut merupakan diskusi terfokus untuk hasil analisis studi dasar dan desain model bisnis dan kelembagaan imbal jasa lingkungan Taman Hutan Raya (Tahura) Sultan Adam yang difasilitasi oleh GGGI (Global Green Growth Institude). Kajian imbal jasa ini merupakan upaya terencana agar jasa lingkungan air pada Tahura Sultan Adam terus lestari dan manfaatnya dapat dirasakan secara berkesinambungan.&nbsp;</p><p>FGD dibuka langsung oleh Sekretaris Daerah Provinsi Kalsel yang diwakili oleh Asisten Bidang Perekonomian dan Pembangunan Setda Prov Kalsel, Syaiful Azhari dan dihadiri, Direktur Pemanfaatan Jasa Lingkungan hutan Konservasi, Direktur Pencegahan Dampak Lingkungan Kebijakan Wilayah dan Sektor Kemen LHK, Kepala/Perwakilan SKPD lingkup Kabupanten dan Provinsi Kalsel, Kepala Tahura SA, Kepala BKSDA Kalsel, Dekan Fakultas Kehutanan ULM, (Global Green Growth Institude) dan Lembaga Usaha yang berkaitan dengan kajian imbal jasa lingkungan Tahura Sultan Adam seperti PDAM, PLTA, Balai Perikanan, hingga perusahaan air minum swasta.</p><p>“Pertemuan FGD ini kiranya semakin mempertajam hasil kajian-kajian jasa lingkungan, dan sekaligus forum untuk mengkolaborasikan konsep yang seideal mungkin untuk bisa diterapkan dalam pelaksanaan jasa lingkungan, demi memelihara kelestarian lingkungan di Kalimantan Selatan,” kata Syaiful Azhari dalam sambutannya.</p><p>Plt. Kadishut Prov Kalsel yang diwakili oleh Kaepala Bidang Perencanaan dan Pemanfaatan Hutan, Warsita yang hadir dalam kesempatan tersebut juga menyampaikan bahwa FGD ini merupakan hasil analisis studi awal dan akan masih ada studi lanjutan sebelum nantinya diimplementasikan. “Memohon ijin, nantinya GGGi juga akan melakukan komunikasi lanjutan ke Fakultas Kehutanan ULM terkait kajian imbal jasa lingkungan ini,” ujar Warsita.</p><p>Dilanjutkan paparan oleh GGGI yang diwakili Carissa Hanjani, dalam hal ini menyampaikan hasil analisis studi awal yang sudah dilakukan dan menawarkan dua contoh usulan skema potensi imbal jasa lingkungan di Tahura Sultan Adam. “Ini baru tahap awal, tim juga akan mengkaji seluruh masukan yang disampaikan oleh partisipan yang kemudian akan ditindaklanjuti dengan penelitian lanjutan,” ujarnya.</p><p>Dalam acara tersebut juga dilakukan tanya jawab oleh peserta dan dijawab narasumber untuk menemukan kesepemahaman dalam Kajian Imbal Jasa Lingkungan Tahura Sultan Adam.&nbsp;</p><p>-----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#GGGI</p><p>#FGDImbalJasaLingkunganTahuraSultanAdam</p><p>#TahuraSultanAdam</p><p>#DishutProvKalsel</p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/271836220_297999229025772_1447548816439868671_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=730e14&amp;_nc_eui2=AeGAOAZWolKaR1X4dmzpi7sfG_7z1GCRiTIb_vPUYJGJMnIjz5YyNiALeOANz4HHCfDlxx2mQbYZ4QHO1vHQnRrP&amp;_nc_ohc=oa51C6TMEzgAX8GAlOf&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT-FHgQDI2KJUgqPaC-U8OzrnIgMOLAIPsMNIU78uwLixw&amp;oe=61E5FCC6\" alt=\"May be an image of 5 people and text that says \'DISKUSI TERFOKUS KAJIAN IMBAL JASA LINGKUNGAN TAMAN HUTAN RAYA SULTAN ADAM: HASIL STUDI DASAR, USULAN MODEL BISNIS DANKELEMBAGAAN Kalimantan Selatan\'\"><br></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/271813455_297999245692437_2127345022440083022_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=730e14&amp;_nc_eui2=AeFsvrZ8KVkcq_DaZw1c3KgDGSQPDe6nvfYZJA8N7qe99rWOSValmKLJ3zh8kYwwJlGo3s9UOb6TPtgYjzWKMGn4&amp;_nc_ohc=gioVsT6SF9IAX8NjpDW&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT_47E7hx8YOf7nBAb3KikBZAFCTcYftWmA1pGq4SihT9g&amp;oe=61E693F2\" alt=\"May be an image of 1 person, standing and indoor\"></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/271833808_297999325692429_7174190990892508543_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=730e14&amp;_nc_eui2=AeEzVPVPkKarcKCaBev8dZ8Z17p1tJnUCa_XunW0mdQJr0B8JRmUdT7GmlMi6JNMvhrPwFpfZg0UBG3DU8k0BMeO&amp;_nc_ohc=2Z5DLgChjdUAX8lgRL1&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT99EHROBdm9rP8qpGwZIOG7h1QDLqxKYWKtKElRnIxewQ&amp;oe=61E55DC3\" alt=\"May be an image of 1 person, standing and text that says \'Kalir tan Selat\'\"></p><p><img src=\"https://siforestka.co.id/asset/images/image4.png\" style=\"width: 1280px;\"></p><p><img src=\"https://siforestka.co.id/asset/images/image7.png\" style=\"width: 1280px;\"><img src=\"https://siforestka.co.id/asset/images/image6.png\" style=\"width: 1280px;\"></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/271772933_297999152359113_735232243386202352_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=730e14&amp;_nc_eui2=AeE-6yYyKclIbDA9S5ropWPpdAdmzsSgfPd0B2bOxKB891T3v4qVO9kktmaZ73GInIPYPsI2qzT7HsUh7eyhkOXD&amp;_nc_ohc=TcEHlWGmQTYAX-FYaLo&amp;tn=2UclAcFuxqH7ASP4&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT-mAIDeA2okMk0NsLtUX1GYsROqFbHU_KbSUmGyLILE9A&amp;oe=61E6CA48\" alt=\"May be an image of 2 people, people sitting and indoor\"><br></p>', '', 'Jumat', '2022-01-14', '13:51:44', '271803917_297999292359099_2147820441423226706_n.jpg', 36, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(711, 61, 'admin', 'Plt. Kadishut Prov Kalsel Hadiri Rakor Penataan Batas Kawasan Hutan', '', '', 'plt-kadishut-prov-kalsel-hadiri-rakor-penataan-batas-kawasan-hutan', 'N', 'N', 'N', '<p>Banjarbaru - Dinas Kehutanan Prov Kalsel diwakili langsung Plt. Kadishut Prov Kalsel Fathimatuzzahra dengan sapaan akrabnya \'Aya\' menghadiri kegiatan Rapat Koordinasi Penataan Batas Kawasan Hutan Di Provinsi Kalimantan Selatan yang digelar di Hotel Novotel Banjarmasin. Kamis siang (13/1).</p><p>Bersamaan dengan Kunjungan Kerjanya Ke Provinsi Kalimantan Selatan dalam acara tersebut Direktur Jendral PKTL KLHK RI Ruandha Agung Sugardiman yang turut hadir dalam Rakor tersebut membuka secara langsung Rapat Koordinasi Penataan Batas Kawasan Hutan Di Provinsi Kalimantan Selatan. Selain itu hadir juga Sekditjen PKTL Kemen LHK Hanif Faisol Nurofiq dan Kepala BPKH Wilayah V Safrudin Zen serta perwakilan Kepala KPH lingkup Dishut Prov Kalsel.</p><p>\"Tujuan utama dari penetapan kawasan hutan adalah mewujudkan kawasan hutan yang mantap, yang memiliki status yang jelas, tegas, dan keberadaannya mendapat pengakuan dari masyarakat. Jadi penetapan Kawasan hutan merupakan hal penting yang harus diselesaikan untuk dapat mendukung seluruh pembangun nasional terutama yang termasuk dalam kegiatan pembangunan prioritas nasional dalam pusat atau PSN (Projek Strategis Nasional)\" Kata, Ruandha Agung Sugardiman dalam sambutannya</p><p>Dalam Rakor tersebut juga diadakan kegiatan tanya jawab terkait koordinasi Penataan Batas Kawasan Hutan Di Provinsi Kalimantan Selatan tujuannya untuk menemukan kesepahaman yang tertuju untuk percepatan Penataan Batas Kawasan Hutan Di Provinsi Kalimantan Selatan.</p><p>Dalam Rakor tersebut juga disampaikan terkait strategi penyelesaian tata batas dan penetapan kawasan hutan Provinsi Kalimantan Selatan yang dimana strategi tersebut diantaranya seperti alokasi anggaran untuk penyelesaian penataan batas kawasan hutan demi tercapainya penetapan kawasan hutan 100% diprovinsi kalsel, perencanaan pelaksanaan dan tata waktu kegiatan tata batas yang baik dan terstruktur untuk penyelesaian tata batas, dan pembuatan design penetapan kawasan hutan berdasarkan hasil tata batas dan rencana penetapan batas yang akan dilakukan.</p><p>-----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#RakorPenataanBatasKawasanHutan</p><p>#DirekturJendralPKTLKLHKRI</p><p>#gubernurkalsel</p><p>#DishutProvKalsel</p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/271925411_298344675657894_6707439725039445209_n.jpg?_nc_cat=101&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHpnRuFiySY0PrPDg195rYfxTDdiLnaxNDFMN2IudrE0MqCY_VeUeORhVxCghpIAUgp0ygsRLr0iuuQsi-bad9X&amp;_nc_ohc=buENIH_xLqUAX-Uw3IN&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT-MWd55e4QTe9H_n1MSjcPjbCGLIf2DgnMBHElEdO1_dw&amp;oe=61E6B74D\" alt=\"May be an image of 6 people, people sitting and text that says \'DINAS KEHUTANAN PROV. KALSEL RAPA ompeter PENATAAN BATAS KA DI PROVINSI KALIMAN\'\"></p><p><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/271775977_298344705657891_2627940901374882067_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEWNnQLDesXBhXdTLIf_JS_aEDZMhUxUOhoQNkyFTFQ6LgsY4lSP8eCLz6a1A_capGKbW0TJRt4LRQvwumhYMhp&amp;_nc_ohc=uq03kpcW8w8AX-lA0zJ&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-5.fna&amp;oh=00_AT_rqQC4wajr-FzG0o1wglW3goVQLV_A1zQApuJoVhbidA&amp;oe=61E7728B\" alt=\"May be an image of 1 person, sitting and text\"></p><p></p><p></p><p><img src=\"https://siforestka.co.id/asset/images/image9.png\" style=\"width: 960px;\"></p><p><img src=\"https://siforestka.co.id/asset/images/image10.png\" style=\"width: 960px;\"></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/271772955_298344785657883_342717913340367496_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeErXxwHsNHg5PVGVVOgA9Vmy4wa2p_Af73LjBran8B_vWs6jR5kBeMElDj0VLicvY8CLqE3aPNaPKQU5ajP9uJc&amp;_nc_ohc=r1Eh0h-3KK4AX-mWYu6&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT-SLBm7AwSxQ3WdJT5Yijj9Q_si3-F_FdVZA7WHNVInLg&amp;oe=61E70619\" alt=\"May be an image of 2 people and text\"><br></p>', '', 'Sabtu', '2022-01-15', '13:25:38', '271782892_298345272324501_4044157473259395558_n.jpg', 32, 'dinas-kehutanan,dishut-kalsel', 'Y');
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
(712, 61, 'admin', 'Gubernur Kalsel Launching SIFORESTKA Sekaligus Resmikan Galery Market HHBK Kalsel', '', 'https://youtu.be/uwgmIzKQaQc', 'gubernur-kalsel-launching-siforestka-sekaligus-resmikan-galery-market-hhbk-kalsel', 'N', 'N', 'N', '<p>Banjarbaru - Gubernur Kalimantan Selatan Sahbirin Noor atau yang akrab disapa Paman Birin meluncurkan karya inovasi Dinas Kehutanan Kalsel di bidang digital, yakni e-service SIFORESTKA (Sistem Informasi Kehutanan Kalimantan Selatan), Jumat pagi 21 januari 2022 di halaman kantor Dishut Kalsel, Banjarbaru. Peluncuran SIFORESTKA ini dirangkaikan dengan peresmian Gallery Market Hasil Hutan Bukan Kayu serta telah selesainya renovasi gedung Dinas Kehutanan Kalsel.</p><p>Dalam sambutannya Gubernur Kalimantan Selatan Sahbirin Noor menyampaikan apresiasinya terhadap kinerja dan terobosan Dinas Kehutanan dalam pembangunan kehutanan di Provinsi Kalimantan Selatan \"Dikesempatan ini saya mengucapkan terimakasih kepada seluruh jajaran Dinas Kehutanan Prov Kalsel yang terus membuat terobosan, inovasi, dan kreativitas dalam pembangunan kehutanan dikalimantan selatan, berbagai sarana dan prasarana yang dibangun oleh Dinas Kehutanan  untuk mendukung pembangunan sektor kehutanan sangat layak mendapat apresiasi dan dukungan dari kita semua” ucap Paman Birin. Lebih lanjut Paman Birin mengatakan “Pembangunan galeri market HHBK dan aplikasi SIFORESTKA ini merupakan hasil inovasi dan kreatifitas yang luar biasa dari Dinas Kehutanan\" . “Cara kerja inovatif dan kreatif seperti ini yang perlu dikembangkan setiap SKPD sehingga dapat meningkatkan daya saing daerah di tingkat nasional” lanjut Paman Birin.</p><p>Kegiatan tersebut dilanjutkan dengan pemotongan pita dan penandatanganan prasasti oleh Gubernur Kalsel Paman Birin dalam rangka Peresmian Renovasi Kantor Dishut Prov Kalsel dan Galeri Market Hasil Hutan Bukan Kayu Prov Kalsel serta penekanan bersama tombol sirine yang menandakan aplikasi E-Service (SIFORESTKA) resmi dapat dipergunakan oleh khalayak umum untuk mengakses informasi terkait potensi sumber daya hutan kayu, hasil hutan bukan kayu, jasa lingkungan dan pengelolaannya.</p><p>SIFORESTKA adalah sistem informasi kehutanan yang berbasis WebGis dan E Comerce, Sistem tersebut serupa dengan platform Shopee, yang menghubungkan penjual dan pembeli melalui kombinasi webGis dan e-Commerce, isinya memuat aturan kehutanan, produk hasil hutan kayu dan bukan kayu, jasa lingkungan, persedian bibit di Kalsel serta layanan sertifikasi benih dan bibit. Masyarakat dapat mengakses Si-Forestka ini untuk mengetahui dimana produk hasil hutan kayu dan bukan kayu serta sebara jasa lingkungan. “Jadi tinggal klik saja di peta, maka muncul produk kehutanan apa saja yang ada disana beserta nomor kontrak yang dapat dihubungi” kata Fathimatuzzahra, Plt. Kepala Dinas Kehutanan Provinsi Kalsel. Lebih lanjut Fathimatuzzahra mengungkapkan, e-service SIFORESTKA terinspirasi dari hasil pembelajaran pengelolaan hutan lestari di Finlandia pada tahun 2017-2018 lalu. </p><p>Terkait galeri market HHBK, Dinas Kehutanan Provinsi Kalsel sudah memiliki 10 unit galeri yang di antaranya satu unit di Banjarmasin pada kantor Pusat Pemasaran Hasil Hutan, serta sembilan unit outlet HHBK pada seluruh Kesatuan Pengelolaan Hutan (KPH) yang ada.</p><p>Turut hadir dalam acara tersebut Sekretaris Daerah Prov Kalsel Roy Rizali Anwar, dan beberapa SKPD terkait serta dari seluruh UPT Kementerian Lingkungan Hidup dan Kehutanan yang ada di Provinsi Kalimantan Selatan.</p><p>-----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#GedungKantor</p><p>#RenovasiGedungKantor</p><p>#GaleriaMarketHHBK</p><p>#SIFORESTKA</p><p>#DishutProvKalsel</p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/272252955_302851845207177_4593874704079327253_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeHmg7xs5wqLvvY9jL3uT-Wl8Gg_K7vrue3waD8ru-u57Zi1ynQ4mLvwvtIgydGCJG8Cf8ZCfNkLD0WtHndsDhnF&_nc_ohc=ZX1hMp37lrEAX9hTdwZ&_nc_ht=scontent.fbdj5-1.fna&oh=00_AT9yDNl1sq3aRYpSojefWI-0CR8BMnaNBjx552ar_sY2pg&oe=61F31284\" alt=\"May be an image of 1 person and standing\"></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/272249018_302851881873840_8339249559138578_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeFCz15zJgzTMPZbEb_VUK2hvCTZ2jCrdtC8JNnaMKt20AtGM5tOp9C8DUfiUaFNAxVO-MzWZy103pn3iDswPDDh&_nc_ohc=Ds718Mc8eDoAX8kqGjG&_nc_ht=scontent.fbdj5-1.fna&oh=00_AT-ojsNU8cRmj5vR4ugikaYtD3Yhf6flQyrCBk-6O-Pw3w&oe=61F40F2D\" alt=\"May be an image of 2 people, people sitting, people standing and headscarf\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/272253831_302851961873832_7681144027609510967_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeGHinM166NKEoyAlMJra4xGQK09MAcYlrtArT0wBxiWu6ZEAudGx_KXFPaKj-4FhzFJ4jYYVtqb8Q45EWpFCtSP&_nc_ohc=Ni2t6LiwNK0AX8F6OUh&tn=Scr20AvjaTElGuIG&_nc_ht=scontent.fbdj5-1.fna&oh=00_AT_GoFtDUXzsdsogk4z7defGPaRFrmc3z0jvOJ4kD9UjsA&oe=61F3712F\" alt=\"May be an image of 5 people and people standing\"></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/272201406_302851998540495_4145400594446447566_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeHZF5N8OZSIWo2asPFSD3tALDo7O36S2aQsOjs7fpLZpDRRIMHHF3Kv_CS_ycX93i6lSE6oargrJnsJZ9FX5WF0&_nc_ohc=8i3-nGbRffQAX9xKCiY&_nc_ht=scontent.fbdj5-1.fna&oh=00_AT_wcvcjfi9xlb8jA1qa4TFSyf5HCBxzuQerWo8OCOJ3MQ&oe=61F3D521\" alt=\"May be an image of 9 people and people standing\"><br></p>', '', 'Kamis', '2022-02-17', '14:26:19', '272368153_302852448540450_4526912555597523411_n.jpg', 23, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(724, 61, 'admin', '50 Potong Kayu Hasil Ilegal Loging Diamankan KPH Tabalong', '', '', '50-potong-kayu-hasil-ilegal-loging-diamankan-kph-tabalong', 'N', 'N', 'N', '<div>Muara Uya - Tim Pengamanan Hutan KPH Tabalong yang terdiri dari jajaran personel Polisi&nbsp; Kehutanan yang dipimpin kepala seksi Linhut KPH Tabalong Zainal Abidin melaksanakan patroli pengamanan hutan dikawasan wilayah RPH Muara Uya.</div><div>Dalam kegiatan pengamanan hutan tersebut tim pengamanan hutan KPH Tabalong berhasil menemukan tumpukan kayu kelompok dengan jenis Rimba Campuran yang dimana diduga berasal dari kawasan hutan yang belum diketahui pemiliknya, kayu tersebut ditemukan berjumlah 50 potong kayu. Selasa (15/2)</div><div>Setelah tim menemukan dan mengidentifikasi jenis kayu tersebut, tim pengamanan hutan KPH Tabalong bergegas mengevakuasi kayu kayu penemuan tersebut untuk diamankan keDishut Prov Kalsel diBanjarbaru.</div><div>Saat ditemui, Zainal Kasi Linhut KPH Tabalong menjelaskan&nbsp; \"saat kami sedang melaksanakan patroli ditemukan 50 potong kayu tak bertuan yang kuat diduga berasal dari dalam kawasan hutan, segera kami amankan dan evakuasi ke Dishut di Banjarbaru\" lebih lanjut Zainal sampaikan bahwa posisi kayu tersebut saat ini sudah berada di Kantor Dishut Banjarbaru</div><div><br></div><div><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273990591_317955403696821_2178138869179161545_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEUIorGUXsycJCIRtNaYJxudE-voS8WsH10T6-hLxawfaYluQpmNkVBYNmUiQ4PEpGs1c0VkV2rAgBh-Bgb40Bu&amp;_nc_ohc=Lsoxb_NpWWQAX93RF7R&amp;tn=Scr20AvjaTElGuIG&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT-eYY4vOzK3aDPYk_AKC2RXgaIgTguUYQwgKarw0PJpBA&amp;oe=6213AF42\" alt=\"May be an image of 2 people, tree and outdoors\"></div><div><br></div><div><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273814088_317955507030144_478889399640298973_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeG4eTNK0TnJ_bm2-3oJ_5tPC6bj35tqhCcLpuPfm2qEJ61VVxxH-UB245uGBxk3YKO5nnivF_QSX7hgsrfWyOMx&amp;_nc_ohc=_nHcWsUWJ-EAX8a5S1e&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT-SagZpxjYooF_FA2xQSrcECLNq2G9rrBqhV5MxcYa1gg&amp;oe=621248C7\" alt=\"May be an image of 2 people, people standing, outdoors and text that says \'SKKUM POLHUT প SHOOTEPTEM SHOOTEP HUAWEI Mate 30 Pro SuperSensing Cine Camera LEICA\'\"></div><div><br></div><div><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273274759_317955597030135_548459400386805316_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHXEL-tiuxtjKwPKeJaOdpslEIzTmwL3h2UQjNObAveHcXExFzi7Z5gVgjYrx2giHs70HqWj7fc3GGL3ftw78wR&amp;_nc_ohc=m3333Sq94LIAX-Am0GV&amp;_nc_oc=AQmBjDCOU2PriNr3iCT8GQXzkO6r2EoyOtTq7X-xP-Pk99RmY6rDIJJoVMTbfRh7Pws&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT_zdeq83maKG1c_DOEnu4oieugtEA0R462UvE17qy0Gdg&amp;oe=621240B8\" alt=\"May be an image of 5 people, people standing and outdoors\"></div><div><br></div><div><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273909591_317955623696799_661464219958683087_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEPAeHQfFU6BHAFZrc9N0_YZxD7k2NEu5FnEPuTY0S7kcR2eXRaHff-YaWeqLf1IAEoD5l6qfKkTef6EKsC1xTs&amp;_nc_ohc=42a40XrPlA4AX9vwIhF&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT_6RysP129jnua0_Ep-ejL74tdxpkOyhz6zEVjRb647BA&amp;oe=6213B677\" alt=\"May be an image of 5 people, people standing and railroad\"></div><div><br></div><div><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273609694_317955657030129_5336664846426397881_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEH8ySKPV73iPDioy6KEVpTBjaJi1Nt4TsGNomLU23hO35JwODigVTMhNIBkleJKm_gPR63vglOwUcc-_JizwZX&amp;_nc_ohc=sGjKqyRJcqEAX9-0b5r&amp;_nc_oc=AQmKDrbPfZ8LSPHlpiBccDGAzJMVPL8pdZjMtGaIWTrcjBD4KgZI4ITx0zfnUXiJBow&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT9BmrkTCa1SFKZm2VYsxaI6cX_ZGjAzd3fl04GIuCRSfA&amp;oe=62132E45\" alt=\"May be an image of 2 people, outdoors, tree and text that says \'HUAW El Mate 30 Pro SuperSensing Cine Camera LEICA\'\"><br></div><div><br></div><div><img src=\"https://siforestka.co.id/asset/images/image16.png\" style=\"width: 960px;\"><br></div>', '', 'Kamis', '2022-02-17', '14:30:13', '273897240_317955377030157_7130672072633505789_n.jpg', 24, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(715, 61, 'admin', 'Dishut Kalsel Lakukan Bimtek E-Service SIFORESTKA', '', '', 'dishut-kalsel-lakukan-bimtek-eservice-siforestka', 'N', 'N', 'N', '<p>Banjarbaru - bertempat diruang rapat Aula Rimbawan 3 Dishut Kalsel. Semua perwakilan KKPH dan oprator KPH lingkup Dishut Kalsel, Balai Perbenihan Tanaman Hutan, dan Tahura Sultan Adam melaksanakan Bimtek E-Service SIFORESTKA (Sistem Informasi Kehutanan Kalimantan Selatan). Dengan menjaga protokol kesehatan Covid-19 seperti masker dan handsanitizer Bimtek E-Service SIFORESTKA digelar. Rabu,(26/1)</p><p>Kegiatan Bimtek SIFORESTKA dipimpin langsung Warsita Jinawi selaku Kabid Perencanaan dan Pemanfaatan Hutan untuk membuka dan memberikan arahan terkait penjelasan tentang E-Service SIFORESTKA.&nbsp; \" SIFORESTKA ini awalnya disusun/dibangun terinspirasi dari hasil pembelajaran pengelolaan hutan lestari di Finlandia pada tahun 2017-2018 lalu. Selain itu terkait kegiatan Bimtek SIFORESTKA kali ini saya ingin menyampaikan bahwa khususnya operator perwakilan KPH, sampai Oprator Tahura SA berperan penting untuk mengupdate data agar data yang tampil diSIFORESTKA ini selalu update\" kata, Warsita Jinawi.</p><p>Selain itu penjelasan secara teknis terkait pengoprasian dan penginputan dalam Bimtek E-Service SIFORESTKA tersebut dilanjutkan Alip Winarto selaku sub koordinator Pemanfaatan dan Perencanaan Tata Hutan bersama Admin dari Dishut Kalsel.</p><p>“terkait SIFORESTKA jadi sebenarnya prodak disetiap KPH itu sudah ada didalamnya, akan tetapi mengenai data secara detail dan terupdatenya seperti apakah prodak tersebut masih ready atau habis kami butuh keterlibatan secara langsung oprator dari Kph. Maka dari itu nanti terkait cara mengedit/menginput data dan lain sebagainya akan kita praktekkan langsung hari ini”. Kata Alip Winarto.</p><p>Alip bersama Admin Dishut Kalsel, menjelaskan kepada oprator KPH, Oprator Oprator BPTH, Oprator Tahura Sultan Adam mulai dari tentang tata cara login SIFORESTKA, Pengisian data Profil Akun, menambahkan prodak, cara memasukkan foto prodak, sampai cara Penginputan/pengisian data secara detail tentang Prodak unggulan dari setiap KPH lingkup Dishut Kalsel,BPTH, dan Tahura Sultan Adam.</p><p>Berhadir juga dalam kegiatan Bimtek E-Service SIFORESTKA tersebut Plt. Kadishut Prov Kalsel Fathimatuzzahra atau yang sering disapa ‘Aya’ memberikan arahan mengenai Admin/Operator tetap akun E-Service SIFORESTKA milik KPH yang nantinya Admin tersebut berkewajiban untuk mengupdate data didalam E-Service SIFORESTKA. “ saya rasa dalam kegiatan ini penting untuk dibahas kaitannya untuk ‘Admin’ yang kita nyatakan mereka adalah Admin tetap untuk SIFORESTKA. Nanti saya ingin minta data siapa saja yang menjadi Admin dan laporan aktifitas Admin tersebut dalam seminggu. SIFORESTKA ini adalah wajah dari Dinas Kehutanan yang orang akan bisa lihat pembangunan Kehutanannya bagaimana, apa saja yang sudah dilakukan KPH Kalsel, dan HHBKnya ” kata, Aya.</p><p>E-Service (SIFORESTKA) itu sendiri berguna untuk Menyajikan data potensi sumber daya hutan berupa hasil kayu, hasil hutan bukan kayu, jasa hutan dan pengelolaannya serta perangkat pendukung dalam sebuah sistim informasi yang merupakan kombinasi antara Web GIS dan e-Commerce.</p><p>Memberikan informasi tentang peluang usaha kepada seluruh stakholder dalam mendukung pembangunan kehutanan diProvinsi Kalimantan Selatan, dengan memperjualbelikan hasil hutan dari jenis kayu ataupun bukan kayu, menanamkan investasi atau keterlibatan lainnya dalam pembangunan kehutanan.</p><p>Meningkatkan kualitas layanan pemerintah pada sektor kehutanan diProvinsi Kalimantan Selatan kepada seluruh Stakholer ataupun pihak-pihak yang berkepentingan dalam pembangunan kehutanan&nbsp; diKalimantan Selatan.&nbsp;</p><p>Untuk mengakses E-Service SIFORESTKA dapat melalui Link : https://siforestka.co.id</p><p>Video Profil E-Service SIFORESTKA dapat ditonton melalui Link : https://youtu.be/VwmTVOOp0go</p><p>-----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#SIFORESTKA</p><p>#SistemInformasiKehutananKalimantanSelatan</p><p>#HutanLestariMasyarakatSejahtera</p><p>#DishutProvKalsel</p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/272763442_305609294931432_396160076350972090_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeF6FM4Hp8YXn1zku7DtyEcY5Lz7AFJZeFDkvPsAUll4UDDKq1DjuRv7ZPr_Smr4faDDaw4vlBow4UshWZY25QZn&amp;_nc_ohc=3gUoQ4uA0q4AX84TPiP&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT_0MzSo5JMg61E6k9MXRXYNj3DTwZ3s6nX3ciSIhxav7A&amp;oe=61FBF264\" alt=\"May be an image of 7 people and indoor\"></p><p><br></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/272769841_305609131598115_5523418187828737460_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHNaqyCG93pFcdXZAuinbFACF4vvgtMnrkIXi--C0yeuWyAN25May3ptOR_T2WqGjFPNa-B4UWarLbWLiWPT-9S&amp;_nc_ohc=Fk5ue0fIOq4AX-R8LXG&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT-4vUeczxZMwp0mRYlEAkXNDCiToPDR8zVFTSU4f3KSFg&amp;oe=61FC31BA\" alt=\"May be an image of 4 people, people sitting and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK # bangsa\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/272806299_305609171598111_5104424283457550433_n.jpg?_nc_cat=101&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGmPIhtEI2KL2LKIdKBgGKeJeCBndXK5j8l4IGd1crmP6E4iKoW5kPMF6lKUMynulGVlhT99qIlGroIbCtcI7fA&amp;_nc_ohc=gHgBIBl5hEoAX-n2bXT&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT_pCx83kEyrVZcvVvH544YNikNcg7TzkZ6lKkzEyd6Aaw&amp;oe=61FBF402\" alt=\"May be an image of 2 people, people sitting, people standing, indoor and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK # melayani bangsa\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/272758206_305609208264774_7168518437302080768_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEvrwZZXQy4opaNFua9b4gq3Yi9CXbNpujdiL0Jds2m6CjKZyRLqMi1pv8rnTmoC5bznNifuzMirerBBdROPsPR&amp;_nc_ohc=KtG8LdRl-48AX_O-BgW&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT-shd8_YtrKDAo2mAsyQhleF4BIqTeQ9PgVSEPElDziQQ&amp;oe=61FC5871\" alt=\"May be an image of 2 people and people sitting\"></p><p><br></p><p><br></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/272792191_305609378264757_4161785003174418467_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHPugU0n1FKoWm1yTXbXGx0Ygzu-N5vWqtiDO743m9aq_sAtuE9G5m4shugUI4QqZ1VsrN0AUiqmk0MBHxi4ePT&amp;_nc_ohc=FWnbrq9_9xIAX9xJNNG&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT_r6nlTxGH2eVAqVx58fJAWPQvB7_nP9HfU1zejxLnjVA&amp;oe=61FC44C9\" alt=\"May be an image of 2 people and text\"></p><p><br></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/272776788_305609481598080_3868839785999353852_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFXljt5_9o-z_fkR0Ok8DZBkdqqrKfr4S-R2qqsp-vhL5J6dHcEzHe2FqKFhaJTjg3pCzp3OuFWxAwQZQLxIxMo&amp;_nc_ohc=SI7NYwwCMAsAX9IFy0q&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT8sAXygN1nL0KOeoO_ZjIyeM2NxDFzXacEb3r-dlB6LVQ&amp;oe=61FD1A07\" alt=\"May be an image of 1 person, sitting, indoor and text\"><br></p>', '', 'Senin', '2022-01-31', '18:48:44', '272804849_305609254931436_4346937018635478447_n.jpg', 42, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(713, 61, 'admin', 'Tiru Finlandia, Kalsel Punya Aplikasi tentang Informasi Hutan', 'sumber https://www.liputan6.com/regional/read/4866474/tiru-finlandia-kalsel-punya-aplikasi-tentang-informasi-hutan', 'https://youtu.be/uwgmIzKQaQc', 'tiru-finlandia-kalsel-punya-aplikasi-tentang-informasi-hutan', 'N', 'N', 'N', '<p style=\"overflow-wrap: break-word; color: rgb(68, 68, 68); font-family: AcuminPro, arial, helvetica, sans-serif; font-size: 15px;\"><span style=\"color: rgb(255, 51, 0); font-size: 14px;\">Liputan6.com, Banjarmasin -</span> Pemerintah Provinsi Kalimantan Selatan luncurkan inovasi <a href=\"https://www.liputan6.com/regional/read/4855498/rusaknya-hutan-sumbar-akibat-ulah-manusia\" title=\"kehutanan\" style=\"color: rgb(255, 51, 0);\">kehutanan</a> berbasis sistem informasi. Inovasi yang digagas Dinas Kehutanan Kalsel tersebut dinamakan Sistim Informasi Kehutanan Kalimantan Selatan (SIFORESTKA).</p><p style=\"overflow-wrap: break-word; color: rgb(68, 68, 68); font-family: AcuminPro, arial, helvetica, sans-serif; font-size: 15px;\">Peluncurannya dihadiri oleh Gubernur Kalimantan Selatan, Sahbirin Noor, dirangkai dengan peresmian Gallery Market Hasil Hutan Bukan Kayu serta renovasi gedung Dinas Kehutanan Kalsel di Banjarbaru, Jumat (21/1/2022).</p><p style=\"overflow-wrap: break-word; color: rgb(68, 68, 68); font-family: AcuminPro, arial, helvetica, sans-serif; font-size: 15px;\"></p><div class=\"article-content-body__item-content\" data-component-name=\"desktop:read-page:article-content-body:section:text\" style=\"box-sizing: border-box; position: relative; bottom: 12px; color: rgb(68, 68, 68); font-family: AcuminPro, arial, helvetica, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"></div><p></p><div class=\"article-content-body__item-content\" data-component-name=\"desktop:read-page:article-content-body:section:text\" style=\"box-sizing: border-box; color: rgb(68, 68, 68); font-family: AcuminPro, arial, helvetica, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><p style=\"box-sizing: border-box; overflow-wrap: break-word;\">Penyediaan inovasi berbasis sistem informasi memberikan harapan baru terhadap pembangunan kehutanan yang berkelanjutan di Kalimantan Selatan. SIFORESTKA menyediakan data potensi sumber daya hutan.</p><p style=\"box-sizing: border-box; overflow-wrap: break-word;\"></p><p style=\"box-sizing: border-box; overflow-wrap: break-word;\"></p><p style=\"box-sizing: border-box; overflow-wrap: break-word;\">\"Berbagai fitur dalam SIFORESTKA menyajikan kesatuan sistem yang membuka akses luas untuk mendapatkan informasi tentang kehutanan, Saya ingin SIFORESTKA menyediakan informasi akurat,\" pesan Sahbirin.</p><p style=\"box-sizing: border-box; overflow-wrap: break-word;\">Data-data tentang potensi sumber daya hutan, peluang bisnis, perizinan, dan informasi kehutanan lainnya bisa diakses dengan mudah. Termasuk informasi hasil hutan kayu, hasil hutan bukan kayu, jasa lingkungan dan pengelolanya serta perangkat pendukung.</p><p style=\"box-sizing: border-box; overflow-wrap: break-word;\">SIFORESTKA juga bisa menjadi referensi dalam rangka memberikan informasi peluang kontribusi berbagai pihak dalam pembangunan kehutanan di Kalimantan Selatan. Selanjutnya dapat meningkatkan kualitas layanan pemerintah pada<span> </span><a href=\"https://www.liputan6.com/regional/read/4855498/rusaknya-hutan-sumbar-akibat-ulah-manusia\" title=\"sektor kehutanan\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(255, 51, 0); text-decoration: none;\">sektor kehutanan</a><span> </span>kepada pihak terkait serta memberikan peluang sumber pendapatan baru dari sektor tersebut.</p><p style=\"overflow-wrap: break-word;\">Aplikasi SIFORESTKA disebutkan buah adaptasi dari pengelolaan hutan lestari di Finlandia. Pemerintah Provinsi Kalimantan Selatan melirik dan berupaya untuk kembangkan inovasi tersebut di Banua.</p><p style=\"overflow-wrap: break-word;\">Pelaksana Tugas Kepala Dinas Kehutanan Provinsi Kalimantan Selatan, Fathimatuzzahra mengungkapkan, e-service SIFORESTKA terinspirasi dari hasil pembelajaran pengelolaan hutan lestari di Finlandia pada tahun 2017-2018 lalu. Inovasi tersebut terus dikembangkan agar penerapannya dapat dilakukan di Kalsel.</p><p style=\"overflow-wrap: break-word;\">\"Aplikasi ini memuat fitur-fitur antara lain aturan di lingkup kehutanan, juga ada fitur persediaan bibit di Provinsi Kalsel dan informasi hasil hutan, siapa pun bisa mengakses,\" ujar Aya sapaan akrab Fathimatuzzahra.</p><p style=\"overflow-wrap: break-word;\">Dia menjelaskan jika SIFORESTKA tersebut merupakan kombinasi antara WebGis dan ecommerce. Informasi terkait lokasi hutan dapat dapat diakses.</p><p style=\"overflow-wrap: break-word;\">\"Disebut berbasis Gis, karena ketika kita klik di peta, kita bisa menemukan lokasi hasil hutan bukan kayu beserta kontaknya. Siapa pun bisa menghubungi penjual di sini, terbuka untuk umum,\" lanjut Aya.</p><p style=\"overflow-wrap: break-word;\">Sistem digitalisasi tersebut serupa dengan platform e-commerce, yang menghubungkan penjual dan pembeli melalui kombinasi webGis dan e-Commerce. Adapun Gallery Market Hasil Hutan Bukan Kayu, merupakan outlet kesekian di lingkup Provinsi Kalimantan Selatan.</p><p style=\"overflow-wrap: break-word;\">\"Gallery ini sebagai salah satu sarana pemasaran dan promosi Hasil Hutan Bukan Kayu yang tersebar di seluruh KPH maupun Tahura Sultan Adam,\" ujarnya</p><p style=\"overflow-wrap: break-word;\"><br></p><p style=\"overflow-wrap: break-word;\">sumber berita : https://www.liputan6.com/regional/read/4866474/tiru-finlandia-kalsel-punya-aplikasi-tentang-informasi-hutan</p></div>', '', 'Kamis', '2022-02-17', '14:25:11', 'Capture.JPG', 21, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(714, 61, 'admin', 'IKA Fahutan ULM Dukung Revolusi Hijau', '', '', 'ika-fahutan-ulm-dukung-revolusi-hijau', 'N', 'N', 'N', '<p>Banjarbaru – Ikatan Alumni (IKA) Fakultas Kehutanan Universitas Lambung Mangkurat (ULM) melaksanakan Bakti Alumni dengan melakukan penanaman pohon di Tahura Sultan Adam Mandiangin yang juga merupakan KHDTK Hutan Pendidikan Selasa (25/1). Kegiatan tersebut selain sebagai ajang silaturahmi alumni Fakultas Kehutanan (Fahutan) juga sekaligus mendukung program Revolusi Hijau Pemprov Kalsel yang dicanangkan Gubernur Kalsel, H Sahbirin Noor pada tahun 2017 lalu.</p><p>Kegiatan penanaman dipimpin langsung oleh Ketua IKA Fahutan ULM, Nafarin. Sebelum kegiatan penanaman, dalam arahan nya Nafarin menjelaskan tujuan dari kegiatan penanaman ini. “Jadi dalam kegiatan penanaman bersama ini intinya ada dua hal yang harus kita pahami bersama, yang pertama menanam itu adalah investasi, yang dimaksud investasi disini adalah kita akan merasakan nilai atau manfaatnya setelah sekian puluh tahun setelah menanam, kemudian yang kedua, menanam itu adalah ibadah, maksudnya meski bukan untuk kita tapi nanti manfaatnya dirasakan untuk anak cucu kita,” kata Nafarin.</p><p>Berhadir Plt. Kadishut Prov Kalsel Fathimatuzzahra dengan didampingi Kepala Bidang Perencanaan dan Pemanfaatan Hutan, Kepala Seksi Rehabilitasi Hutan Lahan, dan Kepala Seksi Pengembangan Hutan Tanaman dan Perbenihan yang juga merupakan bagian dari IKA Fahutan ULM. </p><p>Aya, sapaan akrab Fathimatuzzahra dalam kesempatan sambutannya menyampaikan bahwa kegiatan Penanaman bersama  ini adalah merupakan suatu dukungan untuk Program Pemerintah Provinsi Kalsel Revolusi Hijau.</p><p>“Pelaksanaan penanaman bersama hari ini merupakan termasuk suatu bentuk dukungan gerakan Revolusi Hijau, dimana target Revolusi Hijau terbesar itu adalah pada pemegang izin konveksi, IPPKH, Hutan Alam, penggiat lingkungan, masyarakat lainnya, termasuk kita semua yang menanam pada hari ini,\" ujar Aya.</p><p>Kurang lebih sekitar 720 bibit pohon Ulin dan bibit pohon Pulantan berhasil ditanam di kawasan tersebut.</p><p>Semoga dengan dilaksanakannya kegiatan penanaman pohon tersebut, bisa memberikan contoh pada masyarakat akan pentingnya menjaga lingkungan hidup yang berdampak pada peningkatan kualitas lingkungan hidup di Kalimantan Selatan.(olf/dishut)</p><p>-----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#IkatanAlumniFakultasKehutanan</p><p>#UniversitasLambungMangkurat</p><p>#penanamanbersama</p><p>#Revjo</p><p>#DishutProvKalsel</p><p><br></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/272746269_305146571644371_8715900219970056210_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeG2YdLrHITH8svXh_GOYUyFY7zARHmHelRjvMBEeYd6VJXdVeAtczH8nVjN_QoVqMo5A34fNL7UwjKUlGxAsvgc&_nc_ohc=t4tHLKYv_pUAX-9qawE&tn=Scr20AvjaTElGuIG&_nc_zt=23&_nc_ht=scontent.fsub6-3.fna&oh=00_AT9HJgw5AL3C3zqE5397e7mKRdfxqoKPZIhcdbLFU_MMtg&oe=61F68764\" alt=\"May be an image of 3 people, outdoors, tree and text\"></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/272629812_305146641644364_7617303450449635157_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeFMl1oTgsNsqlAqoFgp8U3cFydqfiSdAHQXJ2p-JJ0AdOqNTaJRFOhEhQz66Zt_MDv1oJynNBG5xqZVzn2Ij_gE&_nc_ohc=cIV6kyVL1rEAX8q7tIS&_nc_oc=AQkO8r5UTlwWnkWc-7H5XLfYIVERn8xTzzHB5pFosPQ8st0AAqvgWLwy9zPx3f1njQc&_nc_zt=23&_nc_ht=scontent.fsub6-4.fna&oh=00_AT8FCiH5xrO3dz-LuKqUFevuj80AQuTeqO844B37qS8hwA&oe=61F6597F\" alt=\"May be an image of 4 people, outdoors, tree and text that says \'DINAS KEHUTANAN PROV. KALSEL\'\"></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/272671923_305146684977693_2247688791619941641_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeELJBpBtzrVugXLscTjO1CAI2GgTdnX8AAjYaBN2dfwAJcD64qMWdrj3-QIBiJiItORJDMBqoQwjN6iIzCNU5f0&_nc_ohc=BqlcDqpk1_gAX97-bxt&_nc_zt=23&_nc_ht=scontent.fsub6-4.fna&oh=00_AT8kBW67Sr6zyauepFqz8gecR3WRoMvQ0XpIobhTBX6WLg&oe=61F5621D\" alt=\"May be an image of 8 people, people standing, outdoors, tree and text that says \'DINAS KEHUTANAN PROV. KALSEL melay\'\"></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/272694709_305146828311012_6659305223256851005_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeFjAYN-x-mlZhA972kVThgWVAxI7uaw76ZUDEju5rDvpkCTNyxPVghsWtJPvOjS49gFVIiCzn5u9z1X5Axhdm9i&_nc_ohc=W17jD3E-ymMAX-FSU5N&tn=Scr20AvjaTElGuIG&_nc_zt=23&_nc_ht=scontent.fsub6-6.fna&oh=00_AT_UCqiyXlvnlQFbNLkl1Kn0eYmxHYPuxPo-9GMNIcaYuQ&oe=61F4EFCE\" alt=\"May be an image of 10 people, people standing, tree, outdoors and text that says \'DINAS KEHUTANAN PROV.KALSEL PROV. KALSEL\'\"></p><p><br></p>', '', 'Rabu', '2022-01-26', '10:11:32', '272667742_305146924977669_928654566821920640_n.jpg', 40, 'tahura-sultan-adam,dinas-kehutanan,dishut-kalsel', 'Y'),
(716, 61, 'admin', 'Sekretaris BP2SDM KLHK Tanam Pohon Jenis Ulin di TH2TI', '', 'https://www.youtube.com/watch?v=iEJkFoWHqDU', 'sekretaris-bp2sdm-klhk-tanam-pohon-jenis-ulin-di-th2ti', 'N', 'N', 'N', '<p>Banjarbaru - Taman Hutan Hujan Tropis Indonesia (TH2TI) terima kunjungan Sekretaris BP2SDM KLHK Ade Palguna Ruteka. Kegiatannya tersebut untuk melihat suasana terkini keasrian dan keindahan Taman Hutan Hujan Tropis Indonesia (TH2TI). Jum\'at pagi (28/1).</p><p>Kunjungan Sekretaris BP2SDM KLHK tersebut disambut langsung oleh Plt. Kadishut Prov Kalsel fathimatuzzahra bersama Kepala Balai Perbenihan Tanaman Hutan Yudhita Nurdiana dan jajaran. Ade Palguna Ruteka, dan rombongan disuguhi sarapan untuk mengawali kegiatan pagi itu. </p><p>Plt. Kadishut Prov Kalsel Fathimatuzzahra memberikan sambutan langsung dan menjelaskan mengenai tanaman pohon apa saja yang ditanam dikawasan Taman Hutan Hujan Tropis Indonesia kepada Sekretaris BP2SDM KLHK Ade Palguna Ruteka “ selamat datang pak, diareal Taman Hutan Hujan Tropis Indonesia yang diresmikan bapak Presiden Joko Widodo pada saat hari PERS Nasional, sekarang areal TH2TI ini sudah 58 Hektar yang terdiri 3 blok ada blok tanaman ulin, blok tanaman meranti, dan ada blok campuran” kata ‘Aya’ sapaan akrab Fathimatuzzahra.</p><p>Ade Palguna Ruteka dalam kesempatanya menyampaikan kekaguamannya mengenai keindahan hutan kota/ Taman Hutan Hujan Tropis Indonesia dan kesungguhan Pemprov dalam mewujudkan hutan kota.</p><p>“Setelah kami berkunjung  ke Taman Hutan hujan Tropi Indonesia/ hutan kota, yang saya dapat lihat disini adalah kesungguhan pihak Provinsi didalam mewujudkan Hutan Kota ini, dan saya lihat baru berlangsung 4 tahun sudah terjadi pemutaran yang luar biasa seluas 80 Hektar” kata, Ade Palguna Ruteka.</p><p>Dalam kegiatan kunjungan Sekretaris BP2SDM KLHK tersebut juga diadakan acara interaksi bersama perwakilan penyuluh kehutanan dikalimantan selatan yang dihadiri beberapa penyuluh kehutanan lingkup Dinas Kehutanan Prov Kalsel dan KPH lingkup Dishut Kalsel.</p><p>Diacara interaksi bersama Sekretaris BP2SDM KLHK tersebut penyuluh kehutanan yang berhadir bergantian menyampaikan tentang permasalahan dan usulan keperluan untuk penyuluh kehutanan dikalimantan selatan</p><p>Dalam kunjungannya ke Taman Hutan hujan Tropi Indonesia Sekretaris BP2SDM KLHK Ade Palguna Ruteka menyempatkan untuk menanam pohon dengan jenis Ulin sebagai tanda kekagumannya terhadap Taman Hutan hujan Tropi Indonesia.</p><p>-----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#tamanhutanhujantropisindonesia</p><p>#SekretarisBP2SDMKLHK</p><p>#revjo</p><p>#bibitulin</p><p>#DishutProvKalsel</p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/272922151_306830071476021_602204700303227499_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeGxYC-mIGsQxOCQU-cOLVtqytpeDxXnCw7K2l4PFecLDvM0vjPa5WjYcfy1X6LsxHeLBL64UBQLxvPgWnlAr7w6&_nc_ohc=2BTJ1mJyyRoAX_U0Nkk&_nc_zt=23&_nc_ht=scontent.fsub6-4.fna&oh=00_AT_59_9-22z4UgCcLj_FtVG6wmFGevzjLfx9SJc0X6EHVg&oe=61FC82AD\" alt=\"May be an image of 3 people, people sitting, tree, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK ormonis ompeten ompete bangga melayanı bang\'\"></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/273020270_306830114809350_5787613002849823431_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeGhZlgTlFBzYpK2L1ckrZf_FqLPJ2ZFoiUWos8nZkWiJR6dTZ2mUVpsaVseCs7n1FdiuOe14drBYrjApp4yinlG&_nc_ohc=Jak_a93R5UAAX_D0j2f&_nc_zt=23&_nc_ht=scontent.fsub6-6.fna&oh=00_AT-gQyjvS65PfgEPHJn0lHjrLQxwU7IP21r3WlC6Z8By2w&oe=61FBFF88\" alt=\"May be an image of 8 people, people sitting and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAK (HLAK ban gga mel layani hi omon 7 ban gsa DISHUT DISHUT\'\"><br></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/272877011_306830218142673_3283551617243369412_n.jpg?_nc_cat=107&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeFhkzms3VejqfU1WoinUEyC31ck8I4yDYLfVyTwjjINgnKuFanWNW15nv-UwSFEQ6DKHJWcFmRJnVMVZAlyaOC8&_nc_ohc=V0ES4GSyqqsAX84IzCq&tn=Scr20AvjaTElGuIG&_nc_zt=23&_nc_ht=scontent.fsub6-4.fna&oh=00_AT_MbMOgtT5u4knY2oWnibynLgrgjuGBKFsbq7TTXeHYnA&oe=61FD5721\" alt=\"May be an image of 14 people, people standing, outdoors, tree and text that says \'DINAS KEHUTANAN PROV. KALSEL Be FORESTER RESTER\'\"><br></p>', '', 'Rabu', '2022-02-16', '14:41:28', '272885503_306829938142701_7882450218229621675_n.jpg', 19, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(717, 61, 'admin', 'Plt. Kadishut Prov Kalsel Beri Arahan Siswa SMK Kehutanan Negeri Kadipaten Yang Akan PKL di Kalsel', '', '', 'plt-kadishut-prov-kalsel-beri-arahan-siswa-smk-kehutanan-negeri-kadipaten-yang-akan-pkl-di-kalsel', 'N', 'N', 'N', '<p>Banjarbaru – Pembukaan Praktek Kerja Lapangan&nbsp; (PKL) SMK Kehutanan Negeri Kadipaten dilaksanakan di halaman Kantor Dinas Kehutanan Prov Kalsel, Rabu (2/2).Kegiatan tersebut dihadiri beberapa Alumni SKMA Samarinda Lingkup Dishut Prov Kalsel, perwakilan PT. Hutan Rindang Banua, PT. Inhutani II dan PT. Dwima Intiga.</p><p>Berhadir Kepala SMK Kehutanan Negeri Kadipaten Zuljalal Aziz, dalam sambutannya menyampaikan bahwa kegiatan PKL SMK Kehutanan Negeri Kadipaten tersebut diikuti sebanyak 25 peserta didik dan akan dilaksanakan selama 2 bulan, mulai tanggal 1 Februari sampai dengan April 2022 bertempat di PT. Hutan Rindang Banua, PT. Inhutani II dan PT. Dwima Intiga.</p><p>“Perlu kami sampaikan, bahwa jumlah siswa/siswi yang akan melaksanakan PKL selama 2 bulan berjumlah 25 orang dari kelas 11 jurusan Teknik Produksi Hasil Hutan yang nanti dibagi menjadi 3 kelompok yakni 6 orang di PT. Inhutani II, 6 orang di PT. Dwima Intiga, 13 orang di PT. Hutan Rindang Banua, dan mudah mudahan semuanya berjalan dengan baik,” kata Zuljalal Aziz.</p><p>Plt. Kadishut Prov Kalsel Fathimatuzzahra yang membuka langsung kegiatan tersebut, dalam sambutannya memberikan beberapa arahan bahwa, “saya berharap sekali bahwa pihak perusahaan akan lebih banyak membawa kalian kelapangan, karena teori-teori disekolah pada saat dilapangan itu hanya 20% hingga 30% yang bersesuaian, sedangkan yang lainnya lebih banyak kepada situasi dilapangan, namun bukan berarti kita tidak memakai teori itu, tapi pada saat kita di lapangan teknis dan non teknis itu akan lebih menentukan,” ucap Fathimatuzzahra.</p><p>Kegiatan dilanjutkan dengan serah terima siswa PKL oleh Plt. Kadishut Prov Kalsel Fathimatuzzahra kepada pihak perusahaan yang&nbsp; disaksikan langsung seluruh peserta .&nbsp;</p><p>----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#SKMASamarinda</p><p>#PKL</p><p>#MAGANG</p><p>#SMKKehutananNegeriKadipaten</p><p>#HutanLestariMasyarakatSejahtera</p><p>#DishutProvKalsel</p><p><img src=\"https://scontent.fupg2-1.fna.fbcdn.net/v/t39.30808-6/273016286_309669711192057_3366581352142133794_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEwmW_f7VjOcwmXv-4EDMj1T9oSw99meIZP2hLD32Z4hgCp5HkcX5Thxxbg0ZsfrCj56jB-Qch-i-yEj3XddBh0&amp;_nc_ohc=Jd-UFZ937XcAX_koph4&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg2-1.fna&amp;oh=00_AT-JZ55dxY6kCbFp7Tzaf9dGrPVQDkZ-UT0tLecVjUGK2Q&amp;oe=6200EF34\" alt=\"May be an image of 2 people, people standing, outdoors and text\"></p><p><img src=\"https://scontent.fupg2-2.fna.fbcdn.net/v/t39.30808-6/273211535_309669777858717_2358898387198807834_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEmg26jy7G9TTFA5rSfflIh8kR9PJmHs37yRH08mYezfpXeW8RBDIbHvLhMXkwTt8LGT_V-nssAb6GNfSOWqmBP&amp;_nc_ohc=OMqXa-cdsEsAX_AquoD&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg2-2.fna&amp;oh=00_AT-Hwl9se-efMCUaeYsv_8S6_hP0M35BHWUQ3Id-Uw2bmA&amp;oe=6200E0AB\" alt=\"May be an image of 1 person, standing, outdoors and text\"></p><p><img src=\"https://scontent.fupg2-2.fna.fbcdn.net/v/t39.30808-6/273202505_309670054525356_300271150123479273_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEKRMb6whqf0SMixfWJ_TWL8Sg7PbgoHU_xKDs9uCgdT5j2Fr6JuuXe3v5zOWkt75vu5Xh2HpKnEbv1eKKzxVBL&amp;_nc_ohc=ZkFisPPjzSwAX_OFTaW&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg2-2.fna&amp;oh=00_AT8S9h3HTqbxbmAmaZmTKwu9fjyzL8VRJU2hijo6Tv-PbQ&amp;oe=62012813\" alt=\"May be an image of 6 people, people standing, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL gga ggo melayani mel bangsa I-UE\'\"></p><p><img src=\"https://scontent.fupg1-1.fna.fbcdn.net/v/t39.30808-6/273132853_309670104525351_5284567850696209913_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHA8GihB8S9SZ9cvfhdwxneOsZG3bg5WeA6xkbduDlZ4M7O7g75imgWf3kYgzJWK9G3me6eOopyLV2EAWpab9YL&amp;_nc_ohc=n50t-NK69jsAX9nyfdY&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg1-1.fna&amp;oh=00_AT_WWQjaymfD1ZjfuSFXjH5Snjf5VX8fgOqnzM_GYx2U6w&amp;oe=62022946\" alt=\"May be an image of 5 people, people standing, outdoors and text that says \'DINAS KEHUTANAN PROV.KALSEL KALSEL\'\"><br></p>', '', 'Jumat', '2022-02-04', '09:28:56', '273141722_309670151192013_7095599931709167342_n.jpg', 31, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(718, 61, 'admin', 'Presiden Serahkan SK Hijau dan SK Biru  Secara Virtual', '', '', 'presiden-serahkan-sk-hijau-dan-sk-biru--secara-virtual', 'N', 'N', 'N', '<p>BANJARBARU - Presiden Rebuplik Indonesia Joko Widodo menyerahkan Surat Keputusan (SK) Hutan Sosial (SK hijau) dan Surat Keputusan Tanah Objek Reformasi Agraria (TORA) kepada perwakilan masyarakat seluruh Indonesia. Acara dilaksanakan secara faktual di Provinsi Sumatera Utara yang juga diikuti 19 provinsi lainnya secara virtual, termasuk Provinsi Kalimantan Selatan yang mengikuti secara virtual di gedung Dr. KH. Idham Chalid, Kamis (03/2).</p><p>Acara dihadiri oleh Gubernur Kalsel Sahbirin Noor yang diwakili Asisten Administrasi Umum Sekretaris Daerah Prov Kalsel, Adi Santoso dengan didampingi oleh Dirjen Konservasi Sumber Daya Alam dan Ekosistem Kementerian LHK, Plt. Kepala Dinas Kehutanan, Kepala UPT Kementerian LHK , Esselon III Lingkup Dinas Kehutanan dan diikuti perwakilan penerima SK Hutan Sosial prov Kalsel.</p><p>Dalam penyerahan SK Hutan Sosial (SK hijau) dan SK TORA (SK biru), Presiden Republik Indonesia berharap agar bisa memanfaatkan lahan yang sudah diberikan sesegera mungkin dengan tanaman pohon berkayu 50% dan 50% lagi dengan tanaman semusim menggunakan pola agroforestry.</p><p>“Titip lahan yang sudah kita berikan SK nya ini, benar-benar dipakai untuk kegiatan produktif, jangan dipindahtangankan, dan titip&nbsp; jaga kelestariannya,” ujar Jokowi.</p><p>Pada acara ini Kalimantan Selatan menerima total sebanyak 12 SK dari 2 Kabupaten di Provinsi Kalimantan Selatan. SK tersebut berbentuk Izin Pemanfaatan Hutan Perhutanan Sosial (IPHPS) sebanyak 10 unit SK IPHPS pada Kabupaten Tanah Laut, seluas 1.344 Ha untuk 538 Kepala Keluarga (KK). Selanjutnya berbentuk Pengakuan dan Perlindungan Kemitraan Kehutanan (KULIN KK) sejumlah 2 unit SK KULIN KK pada Kabupaten Barito Kuala, seluas 831 Ha untuk 179 KK.&nbsp;</p><p>Diakhir acara Gubernur Kalsel mengucapkan selamat dan berharap dengan diterimanya surat keputusan ini semoga lembaga pengelolaan hutan dan masyarakat setempat dapat melakukan pemanfaatan kawasan hutan yang ramah lingkungan dan berkelanjutan.&nbsp;</p><p>----------------------------------------</p><p>Ayo Bantu Kami Melestarikan, Menjaga Lingkungan Hidup dan Hutan Kalimantan Selatan dengan follow akun sosmed Dinas Kehutanan Provinsi Kalimantan Selatan :</p><p>Facebook : Dishut Kalsel</p><p>Instagram : instagram.com/DishutProvKalsel</p><p>--------------------------------------------</p><p>.</p><p>.</p><p>.</p><p>#SK</p><p>#HutanSosial</p><p>#SuratKeputusanTanahObjekReformasiAgraria</p><p>#DishutProvKalsel</p><p><img src=\"https://scontent.fupg2-1.fna.fbcdn.net/v/t39.30808-6/273159153_310336874458674_253658196485726946_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGXM8-onvcbsqKVGuqQs4zbaB5wamoGo6JoHnBqagajolRbWnuMPr1cIZJ4ywJEkmuzYMhlk0yfpgQdl_LlPThU&amp;_nc_ohc=lezsDvbaa-0AX_r-f1x&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg2-1.fna&amp;oh=00_AT8onUQV8_GP0Q0V1t4IGWOEGaxJ4PJmsvKgAIFXbiUrrg&amp;oe=62015ECA\" alt=\"Mungkin gambar 2 orang dan teks yang menyatakan \'ESIA Penyerahan SK Hutan Sosial dan SK Tanah Obyektif Reforma Agraria (Tora) h Kabupaten Humbang Hasundutan, 3 Februari 2022 Activate Windows @\'\"><br></p><p><img src=\"https://scontent.fupg2-2.fna.fbcdn.net/v/t39.30808-6/273215942_310336344458727_492199045500998218_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFeatGYDo7CGg2XTfza89Y92TXN9gIU3m3ZNc32AhTebZr6Qk03o0pKLwYyiEpQAyVVsdlcokiSBdiGpGJeLtso&amp;_nc_ohc=HhHtFUGMx4gAX9wBihB&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg2-2.fna&amp;oh=00_AT-AsOx76Qt5mJBjoWb3L2YO2_-GKzYRxwHQY9Txl50mQg&amp;oe=620124EC\" alt=\"Mungkin gambar 3 orang, orang berdiri, layar, televisi dan teks yang menyatakan \'DINAS KEHUTANAN PRUV PROV.KALSEL KALSEL BerAKHLA nelayani bangsa\'\"></p><p><img src=\"https://scontent.fupg1-1.fna.fbcdn.net/v/t39.30808-6/273221025_310336397792055_5081634466686431551_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHChdwdDDl7llA9CzElmx90_V66l8NPGsD9XrqXw08awERcnwYoYvnArsGG0ln-tYSSgtgeinQCIhnc_MJkY5v1&amp;_nc_ohc=dql4izv0wVIAX-GO79q&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg1-1.fna&amp;oh=00_AT-UpteMnuHU219yeeP3fRpoeScbJWGY5indixaas6ZZ0w&amp;oe=6200E7C5\" alt=\"Mungkin gambar 3 orang, orang berdiri, layar, televisi dan teks yang menyatakan \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK # n bangsa melayani সক\'\"></p><p><img src=\"https://scontent.fupg1-1.fna.fbcdn.net/v/t39.30808-6/273248735_310336907792004_3658180054901358132_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEa8PPFBH77Y0cYFNIZL3mV5tfCOl9eRNXm18I6X15E1VIvrk6uWVtMPyut90E-jFUl6d6D2WEO2ekjIO4AmDSd&amp;_nc_ohc=Ccyo1F9zhZwAX-tFWU9&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg1-1.fna&amp;oh=00_AT-r9-60dff9cE-N5ANcF2UkaR46xyW0cfWp2Afo43FFLw&amp;oe=6200A07B\" alt=\"Mungkin gambar 4 orang, orang berdiri, orang duduk, kerudung dan teks\"></p><p><img src=\"https://scontent.fupg2-1.fna.fbcdn.net/v/t39.30808-6/273211536_310336837792011_7050374529237960018_n.jpg?_nc_cat=105&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEhM8TrLk_vOIpyib6aLiW-Pn8032FZHiM-fzTfYVkeI4m6EvAEkT2M6-gek2zDK-YHYwH0eqZ2JQdOEwLiuuMJ&amp;_nc_ohc=YF0wm7AWTJUAX8vScWL&amp;tn=Scr20AvjaTElGuIG&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg2-1.fna&amp;oh=00_AT88E-aXjwitkBnNzU3KLDZyf2CSQIgKobIB1vENTuY36Q&amp;oe=62027821\" alt=\"Mungkin gambar 4 orang, orang berdiri dan teks yang menyatakan \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK # melayani bangga neit bangsa PENYERAHAN SURAT KEPUTUSAN OSYEKR\'\"><br></p>', '', 'Jumat', '2022-02-04', '09:38:38', '273211536_310336837792011_7050374529237960018_n.jpg', 29, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(719, 61, 'admin', 'Pejabat Lingkup Dishut Tandatangani Pakta Integritas 2022', '', '', 'pejabat-lingkup-dishut-tandatangani-pakta-integritas-2022', 'N', 'N', 'N', '<p>BANJARBARU - Pejabat esselon 3 dan 4 lingkup Dinas Kehutanan Prov Kalsel , KPH dan UPT melaksanakan Penandatanganan Fakta Integritas di Aula Rimbawan 3 Dinas Kehutanan Provinsi Kalimantan Selatan, Senin (7/2). Acara ini dipimpin dan disaksikan langsung oleh Plt. Kadishut Prov Kalsel, Hj. Fathimatuzzahra.</p><p>Kegiatan tersebut dimulai dengan menyanyikan lagu Indonesia Raya dan Mars Bergerak serta Pembacaan Pakta Integritas oleh Sekretaris Dishut Kalsel Bijuri, yang kemudian dilanjutkan Penandatanganan Pakta Integritas dan Perjanjian Kinerja 2022 ASN Lingkup Dishut Prov Kalsel.</p><p>Dalam sambutannya Kadishut menjelaskan penandatanganan Pakta Integritas itu bukan hanya suatu formalitas saja melainkan suatu tanggungjawab.</p><p>\"Kita hari ini menandatangani Pakta Integritas, otomatis yang ditanda tangani itu merupakan tanggung jawab semua, dan hal ini jangan hanya cuma dianggap formalitas saja&nbsp; karena ini merupakan tanggung jawab kita,\" kata, Fathimatuzzahra.</p><p>Beliau juga menambahkan, kalau Pakta Integritas di semua Dinas Lingkup Pemprov juga pasti mempunyai tanggung jawab dalam Pakta Integritas.</p><p>\"Semua Dinas yang di dalam lingkungan Pemprov mereka mempunyai tanggung jawab di Pakta Integritas, selain itu di Dinas, KPH, Tahura, dan BPTH semuanya pasti mempunya target jadi jangan dianggap bahwa ini hanya sebuah formalitas yang harus kita laksanakan. Formalitas iya tapi Pakta Integritasnya harus kita lakukan, kalaupun di dalamnya nanti ada hal hal yang menjadi permasalahan sehingga kita tidak bisa melaksanakan, itu bisa dipertanggung jawabkan,\" kata, Fathimatuzzahra</p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273517991_312714394220922_481575415192286184_n.jpg?_nc_cat=101&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeF56y0AR6yTDtzXi_MDPy_S_7pk5JepJN3_umTkl6kk3ZBsPQWgMTKvAkk_a8NABP59V_JwOt8K8uUgqvgX7SB8&amp;_nc_ohc=DWuzi0UJmvcAX9wlruR&amp;_nc_oc=AQlrSG1OLbmksGfwlnVw32wTJsIY-sgDcGyA6IWkphTgsfnu6yQhREI--T__UdT7eBs&amp;tn=Scr20AvjaTElGuIG&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT-yCoSemOidKItTRGtIBSsMRb1P_yyqqudfrPzRkkW46w&amp;oe=6209B9EA\" alt=\"May be an image of 10 people, people standing and text\"><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273518632_312714237554271_3378258641246232465_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEs-j4Qu2HV_5dQrXsupgu_QiffY-YBhUFCJ99j5gGFQZRKtccXYXVL2GewVKISmGFUiFQM9l2Kuq2kUp6aG5n7&amp;_nc_ohc=sjhv-lfsWgcAX_0XJ1-&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT-MlFSBKiksk82B-w-jx0b3OySNy5SHl8VWwUeJLACJhA&amp;oe=620A2439\" alt=\"May be an image of 3 people, people standing and text\"></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273446497_312714284220933_6708078841983420236_n.jpg?_nc_cat=103&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGAYBiP85fhprCxIxPhNsbh_NQd7gWiKLD81B3uBaIosKBrZB6WjL5RyidZX2v6o8KrhUubX0nfFEmt2qug2s6t&amp;_nc_ohc=I0HjSCje094AX8dQX6Y&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT_2agaqkJaeeglJ7INLm0I24HO37O6akqTbgB_TulwXGQ&amp;oe=6209B46A\" alt=\"May be an image of 5 people and text that says \'DINAS KEHUTANAN PROV. KALSEL B ompeten BerAKHLAK Amaya bangsa melayani stoy\'\"></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273538328_312714320887596_1180633760031646099_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEEICVbGu4ND4eaDQe7o7jb0vrTNA-iqo7S-tM0D6KqjhNQtTBEfEf1aoPt-aYcVruCXvD0pdpVibyblt6P_1Wi&amp;_nc_ohc=E4DEO1uIwqwAX_5LMkT&amp;tn=Scr20AvjaTElGuIG&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT9hsFC3wLMURztw4ft0PSCBwemsz1HY5yjQfFKmGV_p1Q&amp;oe=6208979E\" alt=\"May be an image of 5 people, people standing and text\"></p><p><br></p><p><br></p>', '', 'Kamis', '2022-02-10', '07:33:05', '273598719_312713910887637_3419660188700488260_n.jpg', 26, 'dinas-kehutanan,dishut-kalsel', 'Y');
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
(720, 61, 'admin', 'Dishut Kalsel Sambut Kedatangan Wamen LHK dan Wamen PUPR Di Bandara Syamsudinnoor Banjarmasin', '', '', 'dishut-kalsel-sambut-kedatangan-wamen-lhk-dan-wamen-pupr-di-bandara-syamsudinnoor-banjarmasin', 'N', 'N', 'N', '<p>Banjarbaru - Dinas Kehutanan Prov Kalsel diwakili Plt. Kadishut Prov Kalsel Fathimatuzzahra menyambut kedatangan Wakil Menteri Lingkungan Hidup dan Kehutanan RI&nbsp; Alue Dohong, PhD dan Wakil Menteri Pekerjaan Umum dan Perumahanan Rakyat John Wempi Wetipo, SH, MH diBandara Syamsudinnoor Banjarmasin Dalam Rangka Kunjungan Kerja . Rabu (9/2).</p><p>“Selamat datang pak diBandara Syamsudinnoor” kata ‘Aya’ sapaan akrab Fathimatuzzahra pada saat menerima kedatangan Wamen LHK Alue Dohong, PhD dan Wamen PUPR John Wempi Wetipo, SH, MH.</p><p>Wamen LHK Alue Dohong, PhD dan Wamen PUPR John Wempi Wetipo, SH, MH langsung disambut dengan hidangan untuk sarapan pagi di VIP Room Bandara Syamsuddinnoor Banjarmasin untuk menunggu&nbsp; waktu transit selama 2 jam yang dimana rencananya Wamen LHK Alue Dohong, PhD dan Wamen PUPR John Wempi Wetipo, SH, MH tersebut akan melakukan penerbangan kembali dalam kunjungan kerja mulai dari tanggal 9 Februari 2022 sampai 12 Februari 2022 ke Kabupaten Murung Raya Provinsi Kalimantan Tengah. Kunjungan kerja tersebut dalam rangka meninjau kegiatan di Site Adaro Metcoal Tuhup serta meninjau rencana pembangunan Bandara Tira Tangka Bangka.</p><p>Turut hadir juga dalam kegiatan tersebut perwakilan Dinas PUPR Prov Kalsel,BPKH Wilayah V, BPDASHL Barito, dan BKSDA KALSEL untuk menyambut kedatangan Wamen LHK dan Wamen PUPR diBandara Syamsudinnoor</p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273655899_313893817436313_7157003757395889155_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHFeG0v6ivS6qINtJmnIMSP3joKqkZRuYHeOgqqRlG5gX5nS7bbU6X6fZdR03leQSd9uD7vgq-JnOkGp23e3xrI&amp;_nc_ohc=MwdNR22QFoEAX-SGdLi&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT-UwHZ_bLcpWzkkW3iMda0xVxMoe0KYdZvdK-JrUwHiaA&amp;oe=6208B75E\" alt=\"Mungkin gambar 5 orang, orang duduk, orang berdiri, luar ruangan dan teks yang menyatakan \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK Hama bangga melayani bangsa\'\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273714800_313893894102972_3827518527782317302_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGSO0TuWOaA5mhIB4Vtxw1v5UcRov9w4EDlRxGi_3DgQDtO-42PpIDT0R32NZqDlzu-BRsxPDHwuDmvzlCN9rRh&amp;_nc_ohc=H-Ud6Jdt_00AX_1sqEY&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT_hQt6XrADBkdaPahT1E_UZVkUvb1ct7GriaBfngqHNXw&amp;oe=6209F695\" alt=\"Mungkin gambar 5 orang, orang duduk dan dalam ruangan\"><br></p><p><br></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/273661989_313893977436297_1353139039177625152_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFKC06-GhxNuT6cD5Y-tnX7OQeyRNA-a8w5B7JE0D5rzN5vofW6eJUTSU4P0-1poKSbjpOTksBgqhxO-CONRTrD&amp;_nc_ohc=Tkq6VqN9mpgAX_q08Mp&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT8_F1c1g9yGnOTHkfM3_1trU_q4e4bKe_uFgqqSgqTooA&amp;oe=62096FEB\" alt=\"Mungkin gambar 3 orang, orang duduk, dalam ruangan dan teks yang menyatakan \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK Ûutabempn bangga bangsa T\'\"></p><p><br></p><p><br></p>', '', 'Kamis', '2022-02-10', '07:39:24', '273711124_313893730769655_8943160809372566901_n.jpg', 29, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(721, 61, 'admin', 'Silaturahmi Sekaligus Konsultasi Terkait Pengelolaan Tahura, Dishut Kalteng Kunjungi Dishut Kalsel', '', '', 'silaturahmi-sekaligus-konsultasi-terkait-pengelolaan-tahura-dishut-kalteng-kunjungi-dishut-kalsel', 'N', 'N', 'N', '<p>Banjarbaru – Plt. Kadishut Prov Kalsel Fathimatuzzahra bersama esselon 3 dan 4 Dishut Kalsel sambut kedatangan rombongan anggota Dinas Kehutanan Prov Kalteng. Rombongan yang terdiri dari perwakilan Dishut Prov Kalteng,DLH Kobar, Dinas PUPR Kobar, dan KPHP Kobar. Kunker tersebut berhubungan dalam pelaksanaan proyek Strengthening Forest Area Planning and&nbsp; Manegement In Kalimantan (Kalfor) dalam Program pengelolaan dan pengembangan Tahura di Provinsi Kalimantan Tengah. Rombongan lalu diarahkan untuk memasuki ruangan Aula Rimbawan 1 Dishut Prov Kalsel untuk memulai mendiskusikan sambil mempelajari kaitannya mengenai pengelolan dan pengembangan di Tahura Sultan Adam Mandiangin. Kamis pagi (10/2).</p><p>Arifin mewakili Kadishut Prov Kalteng menyampaikan tujuan kedatangan rombongannya untuk berdiskusi sambil memperlajari terkait pengelolaan Tahura Sultan Adam Mandiangin.</p><p>\"maksud kedatangan kami adalah ingin mengetahui bagaimana progress dari awal Tahura Sultan Adam Mandiangin sampai akhirnya ditetapkan, kemudian bagaimana proses pembangunan dan pengelolaannya. jadi informasi atau ilmu ini yang ingin kami pelajari dan ingin kami ketahui sehingga bisa kami bawa ke Provinsi Kalimantan Tengah dan juga dikabupaten Kotawaringin Barat agar Tahura yang nanti ditetapkan bisa kami Kelola paling tidak mendekati atau sama dengan Tahura Sultan Adam Mandiangin\" kata Arifin</p><p>Plt. Kadishut Prov Kalsel Fathimatuzzahra yang menerima langsung rombongan tersebut dalam kesempatannya menjelaskan terkait pengelolan dan perkembangan Tahura Sultan Adam Mandiangin.</p><p>\"bicara Tahura Sultan Adam sejak tahun 2012 pembangunannya sambil merangkak/Perlahan, namun sejak zaman Kadishut Prov Kalsel Hanif Faisol Nurofiq yang sekarang menjadi Sesditjen PKTL, baru Tahura Sultan Adam Dibangun secara besar besaran. Selain itu tidak kurang 11 Miliar pertahunnya dana yang harus digulirkan oleh Pemprov untuk pembangunan/pengelolaan Tahura Sultan Adam, jadi dalam hal ini Pemprov benar benar yang mensuport/mendukung dalam kegiatan kehutanan\" Kata, Fathimatuzzahra.</p><p>Dalam kegiatan tersebut secara panjang lebar juga diadakan sesi tanya jawab dan berdiskusi untuk menemukan kesepahaman dalam pengelolan dan&nbsp; pengembangan Tahura Sultan Adam Mandiangin. Lalu para rombongan tersebut dihadiahi kenang kenangan Souvenir Produk Produk HHBK dari KTH Binaan KPH Lingkup Dishut Prov Kalsel serta Buku Promosi yang berjudul The Wonderful of South Kalimantan Forest.</p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/273774901_314429674049394_7628441595386090283_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHiIy6KvOkSsz86xdfPTrhNJaxPvm_miXslrE--b-aJe1EknI5Yp6Glh2mxsHuvKYbAYQir730PzDdjHmNFo5Fk&amp;_nc_ohc=QWz4HPrXV7cAX9E_HZ3&amp;tn=Scr20AvjaTElGuIG&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT8HUgw2oLuQ99Qu6EKJvLZuu0d1ZFIBLdmIsujudYPqWA&amp;oe=6210EAE1\" alt=\"May be an image of 6 people, indoor and text\"></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/273735143_314429817382713_1129220484860902013_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFw2PMHGO5i0zq4JeKOlnDGzvPdMzmr0NLO890zOavQ0vWDODGFWIj1sU_NOeR9xppICma0MLPKXBfLIQ_mJ4pF&amp;_nc_ohc=1ZKWXIJbGvkAX-Y54ec&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT-a8xVc4w-866eyWphwL96If_tieYqblA4gscQiE0hkRA&amp;oe=62118574\" alt=\"May be an image of 3 people, people standing and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK Hmayan melayan bangga\'\"></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/273751567_314429907382704_3867992760869456066_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeF1r7bd2qs_2POjBtmo-9gR64MojjNG5H7rgyiOM0bkfkBgUkNDJjVF-h5eaXvebU3XW7sGRoZk4rCJgaMSze7j&amp;_nc_ohc=nZ5meUuw85cAX_AWgIp&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT9jTrN47DD_ug5iHeMZlZcZOeLMp6PdYgyW2JS20onzQg&amp;oe=62126E27\" alt=\"May be an image of 2 people, people standing, people sitting, headscarf, indoor and text that says \'DINAS KEHUTANAN PROV.KALSEL KALSEL BerAKHLAK emen melayani bangsa\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/273827754_314429977382697_2876357775568137112_n.jpg?_nc_cat=103&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFlLCGRgaucnoz02aSKpQEkDHVfRSjo64EMdV9FKOjrgaAWpYCTmq-Q1Srw_6oB1gqdIys7pD8wp4h3BaMMjGGn&amp;_nc_ohc=xLIRmkpcdlAAX9pFTxC&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT96Wj4qwj1xP77wmTHR84lceLIcHXutqsxk_r2VQ7rSrQ&amp;oe=6210DA19\" alt=\"May be an image of 2 people, people standing, headscarf, indoor and text\"><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/273674751_314429940716034_8869082669237368657_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGe2jK7IKcfsjLZmv9CCw_lVaKhZ0WEYF9VoqFnRYRgX-qROtz2f883zRHmfG9INFBbqJo6j3tZfTvSd3mOOdEX&amp;_nc_ohc=yZnVV_X-ghYAX-gS1V4&amp;tn=Scr20AvjaTElGuIG&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT97BvXFKyLvqEiHOGQRsyjOztzGk-Txwvtd6qDm6zG-0Q&amp;oe=62113F1D\" alt=\"May be an image of 3 people, indoor and text\"><br></p>', '', 'Rabu', '2022-02-16', '14:33:26', '273714169_314430097382685_1003606668403867005_n.jpg', 21, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(722, 61, 'admin', 'Sukseskan Program Revolusi Hijau BNNP Kalsel Bersama Dishut Kalsel Tanam 1.200 Bibit Sengon', '', '', 'sukseskan-program-revolusi-hijau-bnnp-kalsel-bersama-dishut-kalsel-tanam-1200-bibit-sengon', 'N', 'N', 'N', '<p>Banjarbaru – Program Kegiatan Revolusi Hijau terus digelorakan.  Dishut Prov Kalsel Bersama Badan Narkotika Nasional Provinsi Kalimantan Selatan dan Badan Narkotika Nasional Kota Banjarbaru melaksanakan penanaman bersama dengan jenis bibit pohon sengon dalam rangka mendukung Program Revolusi Hijau yang telah dicanangkan oleh Bapak Gubernur Kalimantan Selatan Sahbirin Noor sejak tahun 2017. Kegiatan penanaman tersebut dilaksanakan diareal Tanah Milik BNN seluas 1,2 Ha yang berada dalam lingkungan Perkantoran Pemprov Kalsel. Jum’at pagi (11/2).</p><p> Kegiatan tersebut diawali dengan Apel gabungan Bersama sama, yang dimana dalam kegiatan penanaman tersebut Kepala BNNP Kalsel Jackson Arison Lapalonga menyampaikan kegiatan penanaman Bersama ini merupakan upaya dukungan terhadap Program Revolusi Hijau dan menggelorakan gerakan perang terhadap Narkoba.</p><p>“dalam rangka mendukung pemerintah provinsi kalsel dalam kegiatan Revolusi Hijau, kami memanfaatkan lahan kantor kami yang belum kami bangun dan ingin kami manfaatkan untuk kami hijaukan agar produktif dan tidak kosong. Dan sehingga kami harapkan kedepan untuk beberapa lahan kami yang kosong akan kami manfaatkan bekerjasama dengan Dinas Kehutanan untuk melakukan penanaman dan mendukung Gerakan Revolusi Hijau selain itu untuk menggelorakan gerakan perang terhadap Narkoba” kata, Jackson Arison Lapalonga.</p><p>Sementara Plt. Kadishut Prov Kalsel Fathimatuzzahra dalam kesempatannya juga menyampaikan bahwa penanaman Bersama kali ini merupakan tugas Bersama khususnya Dinas Kehutanan untuk menghijaukan Kalimantan Selatan serta mengelorakan Program Gubernur Kalsel dalam kegiatan Revolusi Hijau.</p><p>“dengan menggunakan sepatu boot, cangkul dan parang yang kita bawa untuk melakukan penanaman kali ini lah yang menjadi suatu kebanggan bagi kami semua, karena ini lah tugas kita semua khususnya tugas kami sebagai Leading Sector untuk menghijaukan Kalimatan Selatan serta dalam mendukung Program Gubernur Kalsel Revolusi Hijau” Kata Aya sapaan Akrab Fathimatuzzahra.</p><p>Setelah Apel bersama semua personil langsung menyusuri seluruh Kawasan Tanah Milik BNN dengan menggunakan alat yang sudah disediakan seperti sarung tangan, sepatu boots dan cangkul. Dengan semangat Revolusi Hijau Para personel bergotong royong membawa bibit pohon sengon tersebut. Dalam kegiatan tersebut ada yang membuat lobang tanam, memasang tiang ajir, dan menanaman bibit pohon.</p><p>Hingga sampai penanaman selesai, sekitar 1.200 batang bibit pohon Sengon berhasil ditanam semua personil dikawasan tersebut.</p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/273729187_315041313988230_6831705299600325743_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeHu9-QV0aQQd-goFJfa2qunohb9jGcXE26iFv2MZxcTbsiVjKQQnKxkqcgBnjs7QL_DTFA76vCwRR7M2GLZuvaM&_nc_ohc=GwjODq2r3OsAX_14TvM&_nc_zt=23&_nc_ht=scontent.fsub6-6.fna&oh=00_AT-9GUkEP6ZBtwXAgPFPcm_-wisfLQtGeWb1Zdk17rMN7A&oe=6211676C\" alt=\"May be an image of 11 people, people standing and outdoors\"></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/273775390_315041790654849_2971701879631290197_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeGtnFH5EhaRwAtCb-Cw_KOcTw9gTdSUwBlPD2BN1JTAGVli6XXz6HgIKYVJBrpqRAZm811IkddFI5hRodXoPirn&_nc_ohc=6PHWOENlZHgAX-QkDtz&_nc_zt=23&_nc_ht=scontent.fsub6-7.fna&oh=00_AT_2MDeY0uIP470IE9CczeB9ug4yTRfEKNA3BuRrexdY8Q&oe=62119814\" alt=\"May be an image of 10 people, people standing and outdoors\"></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/273779810_315041270654901_3079780373408998179_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeF0y2S9e3oExLB3HZPvEyLGb0ww_CBp6UVvTDD8IGnpRWSoN2OVl7wK5xvbpOq4KDVmCRIE4mrTeW34HpOPXkCT&_nc_ohc=PFpjvtLd_UkAX9fBvz3&_nc_zt=23&_nc_ht=scontent.fsub6-7.fna&oh=00_AT-9Cl8d0Itxt-624XWURzQe40qGTcOwBClTZNJSFcktOw&oe=6211119B\" alt=\"May be an image of 10 people, people standing, outdoors and text\"></p><p><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/273704358_315041450654883_8099581477355607240_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeFIYiNQ8wYsvJFfc8JHjNUxbDlUUOShbSVsOVRQ5KFtJVlTZYwlY1grWzlo25gSDyuFw_oH95fV3y7EcEsBCYou&_nc_ohc=wedLf8Udaj4AX88M0q8&_nc_zt=23&_nc_ht=scontent.fsub6-5.fna&oh=00_AT8L3Z_9h2Xn9kM-ixWh9tRm6HT2cWT4LL78fTcOLq-WTg&oe=62113870\" alt=\"May be an image of 8 people, outdoors and text\"><br></p>', '', 'Rabu', '2022-02-16', '14:36:46', '273803060_315041113988250_6434102265366479663_n.jpg', 27, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(723, 61, 'admin', 'ASN Dishut Prov Kalsel Dukung Vaksinasi Covid-19', '', '', 'asn-dishut-prov-kalsel-dukung-vaksinasi-covid19', 'N', 'N', 'N', '<p>Banjarbaru - Aparatur Sipil Negara (ASN) di Dinas Kehutanan Provinsi Kalsel mendukung program Vaksinasi Bergerak Covid-19 jenis Vaksin Booster. Vaksinasi tersebut dilaksanakan di Gedung Idham Khalid Kantor Sekretaris Daerah Provinsi Kalsel untuk ASN dan Non ASN Lingkup SKPD Prov Kalsel.&nbsp;</p><p>Saat ini, nama-nama pegawai Dishut Kalsel sudah teregistrasi sebagai penerima vaksin di Gedung Idham Khalid Kantor Sekretaris Daerah Provinsi Kalsel dan menjalani tahapan vaksinasi yang sedang berjalan. Selasa siang (15/2).</p><p>Dalam kegiatan tersebut secara bergantian seluruh ASN Dishut Prov Kalsel menjalani vaksinasi. Dimulai dengan pengisian formulir data diri, pengecekkan kondisi tubuh lalu penyuntikkan Vaksin jenis Booster.</p><p>Kegiatan vaksinasi tersebut diharapkan dapat memperkuat imun tubuh para ASN dan agar dapat melindungi diri dari Virus Covid-19</p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/274067353_317544713737890_3392962371352417787_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeH4dH1Fq70mm2_7_tzirj_-BLXvlhXnrccEte-WFeetx1c-mqnasDMS_xyI5Qb-7qQ98RWar7x74_Q-HXHmihgy&amp;_nc_ohc=N2L9cFjq8_cAX8fp52D&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT8jfO_JZX7EYRCO0-OHPha4_DDC32XQXdlHTNcJDY0t2A&amp;oe=621155DE\" alt=\"May be an image of 6 people and people sitting\"></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/273989716_317545020404526_5349039065354807707_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeErDWZL2vZQsPdF42DbKvwI4gjGLRR8683iCMYtFHzrzXb8b5j-m8GPO4V3RcS-wxVHTVJuvMZ2eZbDsH8JR96X&amp;_nc_ohc=L0007-uYve8AX_pzMsO&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT8z93wQOfoP6gP1yUzr3GzavQPkZg5XNNXIwQKwbe7jrA&amp;oe=6210A18C\" alt=\"May be an image of 11 people and text\"></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/274013814_317544667071228_4386230822373807412_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFDXgNc2yLUzGku9AyPKrXVld17PR4dlpyV3Xs9Hh2WnEMWz1ch26pNkWCK7KaMq1UZVh9GXOsMtoP_gCCwfHqt&amp;_nc_ohc=HSil_5n9u0IAX9VJLkx&amp;tn=Scr20AvjaTElGuIG&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT_bqe_83uIuGS_8Q5TKYYJTHPV770qv3zIVwFwTmm7LRQ&amp;oe=621205D0\" alt=\"May be an image of 9 people and text\"><br></p>', '', 'Rabu', '2022-02-16', '14:40:42', '273981485_317544797071215_3100736706088130679_n.jpg', 25, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(725, 61, 'admin', 'Plt. Kadishut Prov Kalsel  Hadiri Rapat Pembahasan Permasalahan Pengelolaan HTR Koperasi Budi Sejaht', '', '', 'plt-kadishut-prov-kalsel--hadiri-rapat-pembahasan-permasalahan-pengelolaan-htr-koperasi-budi-sejahtera', 'N', 'N', 'N', '<p>Banjarbaru - Dishut Kalsel diwakili langsung Plt. Kadishut Prov Kalsel Fathimatuzzahra bersama eselon 3 dan 4 Dishut Kalsel hadiri rapat Pembahasan Permasalahan Pengelolaan HTR An. Koperasi Budi Sejahtera di Kab. Tanah Bumbu Provinsi Kalimantan Selatan yang dilaksanakan secara Virtual Zoom Meeting di Aula Rimbawan 2 Dishut Kalsel.Rabu, (15/2).</p><p>Dalam Kesempatan itu Plt. Kadishut Prov Kalsel Fathimatuzzahra menyampaikan juga terkait hasil mediasi antara PT. Borneo Indobara dan HTR Koprasi Budi sejahtera dalam Pembahasan Permasalahan Pengelolaan HTR An. Koperasi Budi Sejahtera di Kab. Tanah Bumbu Provinsi Kalimantan Selatan.</p><p>“saya ingin menyampaikan kaitannya dengan kondisi tumpang tindih antara HTR Koprasi Budi Sejahtera dengan PT. Borneo Indobara, Kita sudah melakukan mediasi yang ke3 kalinya bersama PT. Borneo Indobara, yang dimana PT. Borneo Indobara bersiap untuk melakukan kerjasama antara HTR nantinya, diareal yang bisa dijadikan untuk areal HTR untuk Koperasi Budi Sejahtera yang baru seluas 376 Hektare dan yang kedua Pembangunan Kantor Koperasi Budi Sejahtera selain itu yang ketiga akan memfasilitasi/mendukung Koperasi Budi Sejahtera dalam pengembangan usaha Produktif” kata, Fathimatuzzahra.</p><p>Dalam rapat tersebut seluruh undangan yang hadir berdiskusi agar untuk menemukan kesepahaman dalam Pembahasan Permasalahan Pengelolaan HTR An. Koprerasi Budi Sejahtera dan menemukan titik terang penyelesaian tumpang tindih perizinan serta perihal permohonan persetujuan pengelolaan HTR baru oleh Koperasi Budi Sejahtera.</p><p>Turut hadir dalam rapat tersebut perwakilan Tenaga Ahli Ditjen PSKL Bidang Hukum, BPHK Wilayah IX Banjarbaru, BPKH Wilayah V Banjarbaru, BPSKL Wilayah Kalimantan, Kph Kusan, Kasubdit Penyiapan HKm dan HTR dan Biro Hukum serta pihak terkait.</p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274046099_318082607017434_1024857081487151263_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGFB9dfvLFAbKxh2OcyP8nWyTTJdcmUabzJNMl1yZRpvJwEAAIsaN39YLPmwz1ZSfyNXhCWjIsiaACD_sKWYKmS&amp;_nc_ohc=x7oPKsLsU3oAX_td7qc&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT8F1ZtwwrojFlXavZM5V61oCgRpXtY-jB5RfjlsQaSFCg&amp;oe=6212729C\" alt=\"May be an image of 6 people, indoor, office and text\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274134925_318082283684133_7039968603948998040_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeG3HwaNM9cwoe3ivW9iKEvGaJ2ixQyHBHNonaLFDIcEc8Gp5KDz6c36JZjkXag1HZYmu61bw5IiYbb0w8P7PMso&amp;_nc_ohc=h0g6WODL58MAX-5LWE-&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT8tQnispVNZonxQY9VyFjyjp_tjbOnU7aoQalzCDrUHUA&amp;oe=6212F433\" alt=\"May be an image of 1 person, sitting, indoor and text\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274164081_318082330350795_5200884514259592060_n.jpg?_nc_cat=105&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHYKiF-XW4rnh-TlOajgKPF9oaivrcxkLr2hqK-tzGQugeJk7Q0p4NfZTEWxYKTvZNySb63-S8BniEG08vOfsT7&amp;_nc_ohc=8ysF2rBPnf8AX-jQUT3&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT8F81nru2c4-CMtdBuwroJ721rFZZFIArgHTAZCgT452A&amp;oe=6213A24C\" alt=\"May be an image of 4 people, indoor and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK 天 bangsa bangga melayani\'\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274057764_318082363684125_5576458429227680331_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGpRSVd7KdJF6-WF2PDee8Vbfh7YHh9TUtt-HtgeH1NS0m1hqDt8frVT4khc8BgW8G0egjJB5zeEjMRa9FHa_j3&amp;_nc_ohc=Gof9eq7DdTsAX8b8pzI&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT8RZigNsZWQm-l1cGOJwtfePagJw865A9s09YZrZJmBkA&amp;oe=62124C3B\" alt=\"May be an image of 5 people, screen and text\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274070212_318082413684120_8602536790082060389_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEkfg48HMdPqbuWDpqfJ7lcOWDduytm0fk5YN27K2bR-cAv1vw627O0PoGw7Jr3VgzdNZDWGrl-qcqXVi2NE2K8&amp;_nc_ohc=xIwd51CytaQAX_ljS29&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT-SyHfKMkj2xoa2oST4KECkb50mwupya2l5kBHawhOC5A&amp;oe=6213640F\" alt=\"May be an image of 4 people, people sitting and text\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274220416_318082457017449_4136887164377973663_n.jpg?_nc_cat=105&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHue9O7mBrd6BH81GBcpQ5jns-TZoga_zyez5NmiBr_PHjMQJIOvie5ig6Rp021BevqxD15jHU9rOrFftfzubQv&amp;_nc_ohc=aOjC0TLrdrsAX_1tZ_c&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT_l8MuXNMMFaek6ONjhm1x1mGSSc2NTQqQ57ConPCiR-A&amp;oe=62131805\" alt=\"May be an image of 3 people, people sitting and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK becoriento Fom # bangga melayani c9 bangsa\'\"><br></p>', '', 'Kamis', '2022-02-17', '14:35:03', '274153275_318082487017446_8368222226976007754_n.jpg', 25, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(726, 61, 'admin', 'Rimbawan Dishut Kalsel Kawal Revolusi Hijau,  Pemeliharaan Tanaman Dilaksanakan', '', '', 'rimbawan-dishut-kalsel-kawal-revolusi-hijau--pemeliharaan-tanaman-dilaksanakan', 'N', 'N', 'N', '<p>Banjarbaru – Sebelum memulai aktifitas dan pekerjaan kantor Tim&nbsp; gabungan dari Dishut Prov. Kalsel, Balai Perbenihan tanaman Hutan, dan Polisi Kehutanan melakukan kegiatan pemeliharaan tanaman. Pemeliharaan kali ini berlokasi dikawasan tanah milik Polda Kalsel yang berada didalam kawasan Perkantoran Pemprov Kalsel. Kegiatan tersebut dilaksanakan dengan tetap menerapkan protokol kesehatan. Kamis (17/2)</p><p>Dipimpin langsung oleh Sekretaris Dishut Prov Kalsel Bijuri.&nbsp; Setelah berkumpul dilokasi, dan pembagian tugas kepada&nbsp; semua personel gabungan tersebut. Dengan alat yang sudah dibawa personil dari rumah masing masing seperti cangkul, parang, dan gunting tanaman semua personel langsung meluncur kelokasi penanaman/perawatan tanaman .</p><p>“Kita semua harus semangat dalam kegiatan pemeliharaan tanaman ini demi terciptanya hutan lestari masyarakat sejahtera selain itu dapat memberikan contoh kepada masyarakat bahwa pentingnya peran lingkungan untuk kehidupan \" kata, Bijuri.</p><p>para personil sangat bersemangat dalam kegiatan kali ini, Dengan menggunakan sepatu boots semua personil berpencar sesuai arahan yang sudah diberikan, kegiatan kali ini lebih tertuju kepemeliharaan tanaman seperti mengganti bibit yang mati, Pendangiran , dan Pemupukan agar tumbuh bibit pohon bisa maksimal.</p><p>Sampai selesai, sekitar 300 bibit pohon jabon dan sengon berhasil ditanam personel dan terdapat 2 bibit pohon jabon terdahulu yang harus disulam karena tidak dapat tumbuh atau mati</p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274055995_318568530302175_4260116433262302102_n.jpg?_nc_cat=103&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHmSQpSj8jM_4lSpgAjkXm1O48JC9CK0vk7jwkL0IrS-Rmm5CzibdnlQiMEig4_f8x_jGUcF-lwDDmRa2IhwOIa&amp;_nc_ohc=dmXdQQZg2vwAX_TgSUf&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT8rAJtwGruu0ksTcjRXFY57Y4HsLwvQt8KcB8NmCBLqog&amp;oe=6212EA2F\" alt=\"May be an image of 1 person, standing, outdoors and text that says \'DINAS KEHUTANAN PROV.KALSEL KALSEL BerAKHLAK B ompeten bangga melayani bangsa kito Tta\'\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274086612_318568146968880_4811569813610317431_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEO90lemlvd7zZJb3ipRuyU9zrBVh9S8Ov3OsFWH1Lw614J_PVE_gKhpyRmuZx77g6AFuvKcnHpY_rtIEtN9IHl&amp;_nc_ohc=RBZdRRjuDVYAX95g7Ep&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT_wpJbRHwcr_yqAZg2Gv_UxH45Dwz72JNQV2xZR8lfzmQ&amp;oe=62121C5E\" alt=\"May be an image of 6 people, people standing, outdoors, tree and text\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274083011_318568310302197_2220412854589436599_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGLGD7epe4ieJ2OSa3g-eyD6wc3xQP0zVnrBzfFA_TNWRS9a1n2kkf5Rvo4NBur1p2hqUZiWz0koaS9F_nrG3DY&amp;_nc_ohc=kG8gwWPiJDsAX_RbH_0&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT-pO1Bja4L6JQL4QkxxZVIwHLZQaRypoGkHbTkP8xQAVA&amp;oe=62133C27\" alt=\"May be an image of 2 people, people standing, outdoors and text\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274084110_318568423635519_7773259630820158951_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHwejSf-MXKFZ7vrDfz6O2DIeoc5qGLXg8h6hzmoYteD7kRbQXmE4KpqT8mTCr62TGFmHejOqN2rFiDWbt3GqXm&amp;_nc_ohc=H7wYXs62kJ0AX9gk6kz&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT9IRkOZXXizud4DTrlSlORxnOYrD8EnSSZuRlIAK5hI3Q&amp;oe=6212553F\" alt=\"May be an image of 1 person, outdoors and text that says \'DINAS KEHUTANAN ANAN PROV. KALSEL BerAKHLAK P ampeten bangga melayani bangsa POASR\'\"></p><p><br></p><p><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274147879_318568480302180_559647466063854296_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHKm-ue-CsebNROUbPkEkF5UpOdf8V6ndtSk51_xXqd2xHHay-MTdiaY71yKW0E9POvVX-bfOoL_66rhjMIaFmK&amp;_nc_ohc=fZmerLBzZ0EAX_td07i&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT_HZtWEWj7YJx2pbuNa0riLtXHx2wJroVpmUhlFi-ZMew&amp;oe=6212274A\" alt=\"May be an image of 1 person, outdoors, tree and text\"></p><p><br></p><p><img src=\"https://siforestka.co.id/asset/images/image17.png\" style=\"width: 960px;\"><br></p>', '', 'Kamis', '2022-02-17', '14:40:25', '274201909_318568056968889_1209493207644521421_n.jpg', 23, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(727, 61, 'admin', 'Dishut Kalsel Gelar Rakor Rehabilitasi DAS', '', '', 'dishut-kalsel-gelar-rakor-rehabilitasi-das', 'N', 'N', 'N', '<div>Banjarbaru - Dishut Kalsel laksanakan Rapat Koordinasi petugas Pengawas Rehabilitasi DAS di Aula Rimbawan 3 Dishut Kalsel, Kamis (17/2). Rapat koordinasi diikuti para petugas Pengawas Rehabilitasi DAS dari UPT dan KPH lingkup Dishut Prov Kalsel dan peserta rapat juga sebagian berhadir secara daring melalui Virtual Zoom Meeting.</div><div>Rakor tersebut dipimpin langsung Plt. Kadishut Prov Kalsel Fathimatuzzahra. Dalam kesempatannya \'Aya\' sapaan akrab Fathimatuzzahra menjelaskan bahwa Rakor tersebut terkait penyampaian hasil laporan pengawas Rehab DAS di Provinsi Kalimantan Selatan.</div><div>\"Hari ini kita hadir untuk sama-sama&nbsp; mendengarkan penjelasan dari pengawas Rehab DAS di Provinsi Kalimantan Selatan yang mana kegiatan ini untuk memberikan penyampaian hasil laporan pengawas Rehab DAS terkait realisasi tanaman oleh IPPKH,” kata Fathimatuzzahra.</div><div>Kegiatan kemudian dilanjutkan dengan penyampaian hasil laporan realisasi tanaman secara bergantian oleh pengawas Rehabilitasi DAS dari UPT dan KPH pemegang IPPKH (Izin Pinjam Pakai Kawasan Hutan). Penyampaian mulai dari jenis tanaman, jumlah tanaman sampai kondisi tanaman terbaru, dilaporkan oleh petugas pengawas rehabilitasi DAS dalam Rakor tersebut.</div><div>Diakhir arahan Aya berpesan kepada khususnya pengawas rehab DAS, demi kesuksesan kegiatan penanaman dilokasi rehab DAS, agar terus menambah semangatnya dan jangan pernah kendor.&nbsp;</div><div>“Tetap berkomitmen dalam menyampaikan hasil laporan sebenar-benarnya yang ada di lapangan untuk keberhasilan, serta semoga semua yang telah dilakukan akan menjadi amal ibadah di akhirat kelak,\" tutup Aya.</div><div><br></div><div><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274177608_318741136951581_4710635418356534062_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHc1C80h2B9L8WScgCKY8GZWCDivnErqJ5YIOK-cSuonobUxh48aG5gGwEpqijrSCyRK6YtTlls2s-JmcHX1prV&amp;_nc_ohc=GgzQSwK-b74AX_5prSF&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT8Cuqqofb_LOh3De5wIj-eJhJv6RTA_q_Fm0LBbqppsOQ&amp;oe=62127A5E\" alt=\"May be an image of 8 people, people sitting and text\"></div><div><br></div><div><br></div><div><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274133060_318741270284901_9179881572984374326_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFP3fRKgTCAJqOR9qZlkQYXezn8Tx4S3vR7OfxPHhLe9KEbmTp0TngH6E9__nG15h0LaUmIuHRdFqvQEKdoO4nn&amp;_nc_ohc=KT7UG6IfsPYAX9ZUgP7&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT8AYzU0wo_Ac4YJ1U6stKI5lJBim5O_oCPnS9IAhNdBOQ&amp;oe=62126F9A\" alt=\"May be an image of 3 people, people sitting and text\"></div><div><br></div><div><img src=\"https://scontent.fbdj5-1.fna.fbcdn.net/v/t39.30808-6/274129146_318741340284894_4322584498472418485_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHKe7VJixtIAvreuOZ-cit3i3wBHpZYEd6LfAEellgR3vBiDpCc-Fl6pGaoEqA66-gEym6-Wz-XsJ2Xr-Idzz_T&amp;_nc_ohc=frXy-GedD0QAX-tFLFT&amp;_nc_ht=scontent.fbdj5-1.fna&amp;oh=00_AT8mG-QVnwp0MZG4OaQxwo71dLnoWS3VcdhDoi0KEC2O7A&amp;oe=62127756\" alt=\"May be an image of 6 people, people sitting, headscarf, indoor and text that says \'DINAS KEHUTANAN PROV. PROV.KALSEL BerA bangga BerAKHLAK melayan A Kompeten bangsa\'\"><br></div>', '', 'Kamis', '2022-02-17', '14:43:47', '274163850_318741056951589_270473155717396409_n.jpg', 22, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(728, 61, 'admin', 'Dishut Kalsel Gelar Rakor Rencana Kerja Tahunan PBPH ', '', '', 'dishut-kalsel-gelar-rakor-rencana-kerja-tahunan-pbph-', 'N', 'N', 'N', '<div>Banjarbaru - Dishut Kalsel laksanakan Rapat Koordinasi (Rakor) Rencana Kerja Tahunan Perizinan Berusaha Pemanfaatan Hutan (PBPH) Tahun 2022 di Aula Rimbawan 3 dengan tetap menerapkan Protokol Kesehatan Covid-19,nSelasa(22/2)</div><div>Rakor dipimpin oleh Plt. Kadishut Prov Kalsel Fathimatuzzahra dengan didamping esselon 3 dan 4 Dishut Kalsel serta dihadiri Pemegang Izin Usaha Pemanfaaatan Hutan di Kalimantan Selatan juga perwakilan BPHK Wilayah IX Banjarbaru.</div><div>Dalam sambutannya, Plt. Kadishut Prov Kalsel menyampaikan permintaannya agar berdiskusi untuk menemukan solusi dan penyampaian rencana kerja tahunan PBPH tahun 2022.</div><div>“Hari ini mari kita berdiskusi, dan saya minta penyampaian rencana kerja tahunan Perizinan Berusaha Pemanfaatan Hutan Hutan Alam maupun Hutan Tanaman serta membahas solusi untuk kegiatan yang di tahun 2021 lalu tidak terlaksanakan, agar kedepannya bisa lebih baik,” kata Fathimatuzzahra.</div><div>PT. Kirana Chatulistiwa yang diwakili Suardi Yanto dalam diskusi, menyampaikan rencana kerja tahunan terkait realisasi tanaman yang sudah dilaksanakan.</div><div>“Kami ingin menyampaiakan terkait realisasi tanaman tahun kemarin belum sesuai target dikarenakan ada kendala dari pihak vendornya, dan sebelumnya memang sempat terpikir bahwa dengan menggunakan tebas manual, akan tetapi melihat kondisi lapangan yang tergolong sulit, sepertinya tidak akan efektif dilaksanakan untuk memenuhi target, sehingga target tersebut akan kami kejar di tahun ini yang mana jika dilihat di lapangan realisasi tersebut sudah cukup luas,” kata Suardi Yanto.</div><div>Dalam Rakor tersebut secara bergantian Pemegang Izin Usaha Pemanfaaatan Hutan&nbsp; menyampaian realisasi target dan rencana kerja tahunan PBPH Tahun 2022 serta berdiskusi untuk menemukan solusi agar rencana kerja ditahun 2022 dapat terlaksana dengan baik dan sesuai target.</div><div><br></div><div><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/274584176_321697319989296_4510381867747556311_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFbcXxV9vrJwddkmtuoX4l0qmhbLYoHogKqaFstigeiAiYYyJCIGjPC4Wda4he5F14LXtDq0PHF_ixZAjGWRLJ1&amp;_nc_ohc=eb_GlbgbSscAX8G_Cm0&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT8YTcRbVekq6F8WhYrZQcLfpA5e0HSfz6ItjnNhzstjfQ&amp;oe=6218ADCA\" alt=\"May be an image of 1 person, sitting, headscarf and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/274656838_321697386655956_4653028732133187484_n.jpg?_nc_cat=101&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGT3zeMaSjATC5_hGk3HaD6vMHYTS8DyRG8wdhNLwPJESQaUJTpgMwAadJskGK_ACtxnrmo2m1l_ihNMgdiqMxO&amp;_nc_ohc=Kd0lbhLnfFIAX8xFcMc&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT-SUiwqaCpMa_1BKyAYQwnE0B7iXDW8_94XZ4FU-z05EQ&amp;oe=621A0835\" alt=\"May be an image of outdoors and text\"></div><div><br></div><div><img src=\"https://siforestka.co.id/asset/images/image23.png\" style=\"width: 2048px;\"><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/274591021_321697036655991_2674327618864130801_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFltMv7WNPSV8Vumm5kNYKvyHvZKMpYx6DIe9koyljHoOQW05fEMLAGEBWwzw6JklsJgFnDQEAHvr6LWeozJq0R&amp;_nc_ohc=2HCaN3ZpETkAX--sreQ&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT-eOLQCx4oqpPInx7AvU2N5UBQnLOnx0_qFcm5WOe9lNw&amp;oe=6219C754\" alt=\"May be an image of 12 people, indoor and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/274550588_321697129989315_8558587372638255462_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGG_DpofZzhRlOJIDjbJimjjub6oF8-1qqO5vqgXz7WqnUJqVK8X2YIofF_woLLAvWTn6PT5GbTdpP7lAXOkrNE&amp;_nc_ohc=aYV6A8oFYRAAX8HGbaI&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT86oVRO_o7vfVs9bjTOdw2JurwldrNpiXOvgwC22UPRqA&amp;oe=6219FFBC\" alt=\"May be an image of 2 people and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/274509479_321697199989308_1721525970388232516_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeF4P-xxD9L16Qjzpe1nKlrw9eG_Zz-t2Sb14b9nP63ZJqrcsTS--Ml9gVh88L2Tz_C-lX49KLBsoMN7iRMdWzic&amp;_nc_ohc=o9Gf7h2OvLQAX-1ZYj2&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT8_-acbP7kfGxweXTrdQ4nT6_y4fzN5XWuc3qdmvnqCQg&amp;oe=6219F01D\" alt=\"May be an image of 5 people, people sitting, indoor and text that says \'DINAS KEHUTANAN PROV. KALSEL\'\"></div><div><br></div><div><br></div><div><br></div><div></div><div><br></div>', '', 'Selasa', '2022-02-22', '14:32:45', '274468240_321696386656056_1073897075467655203_n.jpg', 24, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(729, 61, 'admin', 'Sosialisasi Aplikasi Bela Dilaksanakan Di Dishut Kalsel', '', '', 'sosialisasi-aplikasi-bela-dilaksanakan-di-dishut-kalsel', 'N', 'N', 'N', '<p>BANJARBARU – Dinas Kehutanan Prov Kalsel mengadakan Rapat Sosialisasi Penerapan Program Aplikasi Belanja Pengadaan (BELA) pada Pengadaan Barang/Jasa (PBJ) Pemprov Kalsel yang dilaksanakan di Aula Rimbawan 3 Dishut Kalsel, Rabu (23/2). Rapat sosialisasi diikuti oleh seluruh Pejabat Pelaksana Teknis Kegiatan (PPTK) dan Eselon 4 lingkup Dishut Kalsel.&nbsp;</p><p>Dibuka oleh Sekretaris Dishut Kalsel Bijuri, rapat ini bertujuan untuk sosialisasi penerapan Aplikasi BELA pada PBJ Pemprov Kalsel. “Hari ini kita akan mengadakan sosialisasi Aplikasi BELA yang berkaitan dengan pengadaan barang dan jasa, selain itu mengenai kendala tata cara pengoprasian Aplikasi BELA nanti dapat didiskusikan oleh Narasumber Aplikasi&nbsp; BELA perwakilan dari Biro Pengadaan Barang dan Jasa Provinsi Kalimantan Selatan,” ucap Bijuri.</p><p>Sosialisasi disampaikan oleh Muhidin Artaham dari Biro Pengadaan Barang dan Jasa Provinsi Kalimantan Selatan. Muhidin mengatakan sosialisasi ini memang ditujukan pada proses pengadaan barang/jasa pada Pemprov Kalsel. “Kita sangat ditekankan pada prinsip-prinsip efisiensi dan transparansi, untuk itulah proses pengadaan ini direkomendasikan oleh pusat dilakukan secara online dan hari ini kita lebih tertuju pada sosialisasi secara teknis untuk pengoprasian Aplikasi BELA. Kami juga menghimbau khususnya semua SKPD Lingkup Prov Kalsel agar dapat melakukan pengadaan barang dan jasa dengan melakukan transaksi pada Aplikasi BELA ,” terang Muhidin.</p><p>Aplikasi BELA merupakan platform belanja online untuk pengadaan barang maupun jasa di lingkup pemerintah. Penggunaan Aplikasi ini bukan tanpa alasan. Dengan pembelanjaan yang terpusat, diharapkan pembelian barang dan pengadaan jasa dilingkup pemerintahan bisa dilakukan secara akuntabel, transparan, kompetitif dan bersih. Sebab pengadaan barang dan jasa ini menggunakan anggaran APBN dan APBD.</p><p>Dalam kegiatan tersebut juga dijelaskan terkait Aplikasi MbizMarket yang merupakan Partner Aplikasi BELA. Aplikasi MbizMarket merupakan penyedia untuk mendukung program/kegiatan dalam Aplikasi BELA. Di dalam Aplikasi MbizMarket telah menyediakan seluruh kategori barang dan jasa seperti ATK, peralatan elektronik, jasa transportasi, sewa peralatan &amp; ruangan, perkakas, furniture, hingga barang barang fashion yang dimana MbizMarket merupakan mitra E-Procurement di pemerintahan yang bertindak sebagai penyedia platform para PP/PPK. Di MbizMarket kita dapat bertransaksi,bernegoisasi, dan melakukan manajemen persetujuan langsung dengan pelaku usaha mikro,kecil, dan menengah melalui platform MbizMarket.</p><p><img src=\"https://siforestka.co.id/asset/images/image22.png\" style=\"width: 960px;\"></p><p><br></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/274672063_322571546568540_7446049168237390882_n.jpg?_nc_cat=101&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFDrrTb9NwFSdDlehB3hJ5nf-FP_qsu5Od_4U_-qy7k5yAQrJ5RcQ8NOgeyOxY5qyoGnORMUWQqfFZf6VT22Frg&amp;_nc_ohc=4X2XzZLEBs8AX-ZTosw&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT9VwrZ814j9eTMH0pcZUPV7lIoFgDu-nENjcjGq4JTQyQ&amp;oe=62223DE8\" alt=\"May be an image of 1 person and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK H nelayani bangsa\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/274686691_322571623235199_1220900544683421542_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHL3YTwzCu7-G9DIe9PMlWSxDdD85R4wSPEN0PzlHjBI_vh3Cwj_ztvHM9goDt3ZU2FMF1R47C1SQX53z2ltGOP&amp;_nc_ohc=OY_bdfVZmaIAX-polqh&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT-wUOyTZQZ2gAYflAAncsYDEk02jEi3dPkLjPCuqx5q7A&amp;oe=6222B866\" alt=\"May be an image of 4 people, people standing and text\"></p><p><br></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/274527767_322571709901857_4947576667711445304_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFheqilAmQNbvHqN0f1pixPnv_14TDULwme__XhMNQvCVBcuj6Wzipomou7ITv-AdxLJd_TYWHiHDb3F2J0j-J-&amp;_nc_ohc=bwgKgM1s5RYAX_RM51e&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT9Ll73BIRWontt1z0sIKSlwwurL9SQjxw_Y9IRR_VPugA&amp;oe=622188FE\" alt=\"May be an image of 6 people, people sitting and indoor\"><br></p><p><br></p><p><br></p>', '', 'Selasa', '2022-03-01', '10:31:02', '274643728_322571496568545_2247282602061522023_n.jpg', 20, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(730, 61, 'admin', 'Rimbawan Dishut Kalsel Pelihara Tanaman Johar Di Kawasan Setda Prov Kalsel', '', '', 'rimbawan-dishut-kalsel-pelihara-tanaman-johar-di-kawasan-setda-prov-kalsel', 'N', 'N', 'N', '<div>Banjarbaru - Sebelum memulai aktifitas/pekerjaan kantor Tim&nbsp; gabungan dari Dishut Prov. Kalsel, Balai Perbenihan tanaman Hutan, dan Polisi Kehutanan melakukan kegiatan penanaman/pemeliharaan tanaman Kamis (24/2). Pemeliharaan kali ini berlokasi dikawasan halaman Sekretaris Daerah Provinsi Kalsel. Kegiatan penanaman dan pemeliharaan tanaman ini rutin dilaksanakan Dishut Kalsel setiap hari kamis dan jum\'at selain itu kegiatan tersebut dilaksanakan dengan tetap menerapkan protokol kesehatan Covid-19.</div><div>Dipimpin langsung oleh Plt.Kadishut Prov Kalsel Fathimatuzzahra Setelah berkumpul dilokasi dan pembagian tugas kepada&nbsp; semua personel gabungan tersebut. Dengan alat yang sudah dibawa personil dari rumah masing masing seperti cangkul, parang, dan gunting tanaman semua personel langsung meluncur kelokasi penanaman/pemeliharaan tanaman.</div><div>“Demi terciptanya hutan lestari masyarakat sejahtera dan memberikan contoh kepada masyarakat akan pentingnya peran lingkungan untuk kehidupan, kita harus sama sama semangat dalam melaksanakan pemeliharaan tanaman kali ini\" ucap, Fathimatuzzahra.</div><div>para personil sangat bersemangat dalam kegiatan kali ini, dengan menggunakan sepatu boots semua personil berpencar dan mengelilingi halaman kantor Setda Prov Kalsel sesuai arahan yang sudah diberikan, kegiatan kali ini lebih tertuju kepemeliharaan tanaman seperti penyulaman, Pendangiran, dan Pemupukan dilakukan agar tumbuh bibit pohon bisa maksimal.</div><div>Sampai selesai, sekitar 300 bibit pohon Johar berhasil ditanam personel dan terdapat 2 bibit pohon johar terdahulu yang harus disulam karena tidak dapat tumbuh atau mati</div><div><br></div><div><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/274575529_323038099855218_4795065661277987837_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHhvA8DcGvkKOBMaCS8gI6JReAYHDCMAYpF4BgcMIwBiiL7ak59M7s_5OwR8PFDExTHBBV4Rtu4aUHzymM9shJa&amp;_nc_ohc=Fa6eU8n-1HYAX_BFLQw&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT9I22paLkQtbXR4fzrAQoTWyXuH_atSnsOeNuKkx1oNTw&amp;oe=622339FA\" alt=\"May be an image of 1 person, grass and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/274721466_323038163188545_7168959207178938783_n.jpg?_nc_cat=101&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFI69PZ7OEXlGzhupMMbLoIj5VAz780l6KPlUDPvzSXomGTrQzDvC37_D12RyNySvrMR5Y_tXE2Crc5qTFyHsdG&amp;_nc_ohc=qIOSDAPM1_4AX8dmp9E&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT-m5tsqRtR6xS6ZFvl986ad6uVztf_W2Aq4SH9UhnhkAw&amp;oe=622303A3\" alt=\"May be an image of 2 people, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK # bangga melayani bangsa\'\"></div><div><br></div><div><br></div><div><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/274651624_323038466521848_4319764499139172796_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFrHxKY9wUKK2Lp5TQ2w29CApeDWhTmRT8Cl4NaFOZFPzeTF30l4bA2nva0dR2JzujnCfZPLd46coTpDN3Xor17&amp;_nc_ohc=0FY2POCOUqsAX_HOp12&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-5.fna&amp;oh=00_AT_-AybNRyjcEvgSMM7qUtW0KOsOnWxkWRv_ceLuhCcJXA&amp;oe=6221C571\" alt=\"May be an image of 2 people, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK bangga melayani Recorlentgy 4 bangsa # gsa\'\"></div><div><br></div><div><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/274653527_323036953188666_7569290373832953959_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEI1v0ENscj1zhw1eTk6qPcuoDfWlk6uyG6gN9aWTq7IfIZ6fjQ6-IKLmj_2kdMAiWyt_BFs77C0RyYMBMGgBH3&amp;_nc_ohc=H__hedmIuLEAX98LZLU&amp;tn=2UclAcFuxqH7ASP4&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT9M0KVzGPjdTnOLbk1vNf9dO4-0SOL7L7ftK3ItfbgFrA&amp;oe=6221DD00\" alt=\"May be an image of 12 people, people standing, grass and text\">]\\</div><div><br></div><div><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/274644800_323037619855266_4827506222833739198_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFDX5gurm_95pqIbjfQ-pcFjWEUultUJWuNYRS6W1QlazrLHm49aebhtUlC7o2hEmfe69rOIoNdoYDzvOgp_SWT&amp;_nc_ohc=FTLXHGKX-RgAX_es4pq&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT_-H4tRX6GQAK8NIdS8I2w90jNOHyEUG9oIuJuzjgayGA&amp;oe=62237DBF\" alt=\"May be an image of 1 person, grass and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/274618348_323037799855248_2628547796799271666_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFlKxJJyUOgDnOxgUqFR1nUOEDDOkSpyus4QMM6RKnK69o9Ac0kauhnq852PtPk-dz0Og5JO0JmhgMBQnab6iOQ&amp;_nc_ohc=0qQCXV4AmjAAX9yCU1h&amp;_nc_oc=AQnMfNOJ1xYFlqr3777VuIHnoWF4B_PXMWOr73JtfG6mRFAp2zT8tFQfRjNI3K_1l5g&amp;tn=2UclAcFuxqH7ASP4&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT9RERNoQ8-yunf3a2ys7EsiP5REA6plmeqLe8KYHjfAcg&amp;oe=6222A87C\" alt=\"May be an image of 2 people, tree, grass and text\"><br></div><div><br></div><div><br></div><div><br></div>', '', 'Selasa', '2022-03-01', '10:34:10', '274678585_323036819855346_5548745325704900307_n.jpg', 22, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(731, 61, 'admin', 'Dishut Kalsel Ikut Serta Upaya Percepatan Vaksinasi di Provinsi Kalsel', '', '', 'dishut-kalsel-ikut-serta-upaya-percepatan-vaksinasi-di-provinsi-kalsel', 'N', 'N', 'N', '<p>Banjarbaru - Plt. Kadishut Prov Kalsel Fathimatuzzahra didampingi Kabid PKSDAE ikut serta rapat Percepatan Cakupan Vaksinasi Covid-19 Dosis ke-2 dan Booster di Provinsi Kalimantan Selatan melalui Virtual Zoom Meeting di Aula Rimbawan 2 Dishut Kalsel, Kamis (24/2). Rapat tersebut dilaksanakan berdasarkan Instruksi Presiden Republik Indonesia dan arahan Gubernur Kalimantan Selatan untuk mencapai Cakupan Vaksinasi Covid-19 Dosis ke-2 dan Booster sebesar 70% sampai dengan akhir Februari 2022. Rapat diikuti seluruh SKPD lingkup Pemprov Kalsel.&nbsp;</p><p>Kepala Dinas Kesehatan Prov Kalsel Muslim dalam rapat tersebut menyampaikan bahwa seluruh SKPD lingkup Provinsi Kalsel harus sama-sama bersinergi untuk mempercepat vaksinasi Covid-19 khususnya vaksin Dosis ke-2 dan Booster.</p><p>\"Tugas kita semua intinya untuk bersama-sama bersinergi dan bergerak mempercepat capaian cakupan vaksinasi, khususnya vaksin Dosis ke-2 dan Booster di Provinsi Kalsel dengan target yang sudah ditentukan agar bisa tercapai,\" kata Muslim&nbsp;</p><p>Disepakati dalam rapat tersebut, Dinas Kehutanan Provinsi Kalsel bersama Dinas Energi dan Sumber Daya Mineral Provinsi Kalsel serta Biro Kesejahteraan Rakyat Setda Prov Kalsel bergabung dalam satu kelompok untuk melaksanakan capaian target harian optimalisasi penggunaan Vaksin Astrazeneca sampai dengan 28 Februari 2022 di Kabupaten Balangan.</p><p><br></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/274689075_323212599837768_699535149433851242_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHkUgd6EtN-4eRfQZKPSdmktzOWczT0v2u3M5ZzNPS_axAA7drWt09p-TcnxSSgbRSfMYYdnnaUFzxQq73gbsnE&amp;_nc_ohc=-s4M6aLqCmMAX8n-RfW&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT9R0X_nbJgY0mdy8mpTWVgrv510azwBv9MUCxZutTIxOw&amp;oe=62276141\" alt=\"May be an image of 2 people, people sitting and text that says \'DINAS KEHUTANAN PROV.KALSEL BerAKHLAK melayani bangga ww bangsa\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/274633379_323212733171088_5308010432287732740_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHyVxVpuSGthso_x0wg3palouXvf9UuWO-i5e9_1S5Y78lbERypJ0yHNlErDdEo4BBDKfs33mMpungc97cNk-0G&amp;_nc_ohc=7vSQIi-7ki8AX8qCa73&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT9QsWKU6VH26zpoLR8ohyqdrWky2aZwmW5vS1oQgUd5aA&amp;oe=62291D5E\" alt=\"May be an image of 2 people, indoor and text\"><br></p>', '', 'Sabtu', '2022-03-05', '19:02:16', '274593407_323212773171084_5440675212968068161_n.jpg', 20, 'dinas-kehutanan,dishut-kalsel', 'Y');
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
(732, 61, 'admin', 'Dishut Kalsel Rapat Pembahasan Perbaikan Rapergub Bidang Kehutanan', '', '', 'dishut-kalsel-rapat-pembahasan-perbaikan-rapergub-bidang-kehutanan', 'N', 'N', 'N', '<div>Banjarbaru - Dishut Prov Kalsel gelar Rapat Pembahasan Perbaikan Rancangan Peraturan Gubernur dalam bidang Kehutanan. Dilaksanakan di Aula Rimbawan 3 Dishut Prov Kalsel dan dinstrukturi Said dari Biro Hukum.&nbsp; digelar dengan tetap menerapkan Protokol Kesehatan. Rabu pagi (2/3).</div><div>Dipimpin dan dibuka langsung oleh Kabid PMPPS (Pemberdayaan Masyarakat Penyuluh Perhutanan Sosial) I Gede Arya Subhakti, dihadiri juga Esselon 3 dan 4 Dishut Kalsel. Rapat kali ini bertujuan untuk Penyusunan Rapergub dalam bidang Kehutanan.</div><div>\"hari ini kita akan melakukan pembahasan tentang perbaikan Rapergub dimasing-masing Bidang di Dinas Kehutanan dan akan diarahkan oleh pak Said dari Biro Hukum\" Kata, I Gede Arya Subhakti dalam membuka rapat tersebut.</div><div>Rapat tersebut diawali dengan pembahasan perbaikan dan penyusunan Rapergub dari Bidang PKSDAE tentang Tenaga Pengamanan Hutan dan Rapergub tentang Pengendalian Kerusakan Dan Kebakaran Hutan.</div><div>Secara bergantian dalam rapat tersebut mulai dari bidang Perlindungan dan Konservasi Sumberdaya Alam dan Ekosistem (PKSDAE), bidang Perencanaan Pemanfaatan Hutan (PPH), hingga bidang Pemberdayaan Masyarakat, Penyuluhan dan Perhutanan Sosial (PMPPS) serta bidang Pengelolaan Daerah Aliran Sungai Rehabilitasi Hutan &amp; Lahan (PDASRHL) bergantian menyampaikan usulan Rapergub kepada Said Instruktur dari Biro Hukum agar menemukan kesepahaman dalam penyusunan Rapergub di bidang Kehutanan</div><div><br></div><div><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275010739_326757449483283_6222363454059688666_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeG0YCBDNB3WE11BOvznAzTkgTnotYhrCQyBOei1iGsJDL8K4kHDz_ZZ3ngJXy5t_1LwXMAVkchf2BELUpMXdqkB&amp;_nc_ohc=06BdixpwQ7kAX_Xm_G5&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT9R-xiqwe7wgCSDC0TVXxeI6XCT5vUhWs0maWDhZLn8rQ&amp;oe=6228ABA5\" alt=\"May be an image of 1 person, sitting and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/275052352_326757482816613_3374520613633328529_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFgyRbjtD3ov6pDihAreA7x7IsDR8hMRt3siwNHyExG3UCKG1tUq_Yo_G3JFUGQ6z6B5lMA_cucSuXZq9U7DxEm&amp;_nc_ohc=X83n3sX_uAEAX_VaI7f&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT-lAD0je0t_rXqMSaocEaSbeN4SHMNFRvAwZeOqjahtBw&amp;oe=62279E4B\" alt=\"May be an image of 1 person, sitting, standing, indoor and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275053573_326757519483276_3807902732831978925_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFR2Ri-96_VZDPFlXLqxTP1MFpl_-8JMMswWmX_7wkwy2z8oBPMyh4y2TQHCHvBgYhk43SCGc3wUCoCJ_peumra&amp;_nc_ohc=p1hQzsv7mWMAX-jr5Yd&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT-MrTA2r-5m07qgxTna_owtuZloFX00Kp0L-5TChyShQg&amp;oe=6228279A\" alt=\"May be an image of 2 people, people sitting, indoor and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275170004_326757569483271_5517482608015377091_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHa_I1Hs2hBGmKaQ15kSerD650arXNz8J_rnRqtc3PwnxDe72eluhSQnHoM8WUi3FXFSRYw3GTBzW4M6BhVfBNK&amp;_nc_ohc=wW9F9yRnQ1IAX99AmU6&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT9P_GLbIl4FDbOEoN40XG2uZh6Q00hSXEF1iTVFkfHpew&amp;oe=62286A9E\" alt=\"May be an image of 2 people, people standing, people sitting, indoor and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK kuntabelk # bangsa gga melayani\'\"></div><div><br></div><div><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/275064524_326757616149933_8073921699485505081_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeF4Mk3KCGwuajhcFbcv8Z8k6oJ32YiwnBjqgnfZiLCcGMHN369pqCU_fSgqiG0VHPDu5tbXEqv81X4gPdcyENnY&amp;_nc_ohc=9SdzZTOG0l8AX99HipW&amp;_nc_oc=AQl2EyZ8Xt1qw38frZZuALPM7fJ2jLWqVgsm0qlK9PQrUC2DEkF7bbGX1frjHE0NGDs&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT_GlkCMnq2VHLexn_VW42N3kU3kBcgm93Qpj9vlF_Sm3w&amp;oe=6227AEC8\" alt=\"May be an image of 2 people, people sitting, people standing and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/275069923_326757656149929_218717627600507431_n.jpg?_nc_cat=101&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFANV5CyKyR6Js9ERH3neNnS8mtMcYifxRLya0xxiJ_FEx_sFS8DhTrTJizQBUheC3Fc5JPq4NQR21cliY9s1U8&amp;_nc_ohc=p2Csfs_pOnkAX9EzQcx&amp;tn=Scr20AvjaTElGuIG&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT_wljLCliVt1jrEuhXuhxZyRuGsK7c8ZSa0K7YaiYRagQ&amp;oe=6228EF7B\" alt=\"May be an image of 1 person and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK kompeten bangga melayani bangsa\'\"></div><div><br></div><div><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/274989236_326757712816590_381088610937090318_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEYUOLnWD4wswINyMYkNYuI1K5vOFqkTDHUrm84WqRMMYa2kG7jOjCQcS_0TyXQje5Gc8iFb1_UzCJ_M4p1q2YJ&amp;_nc_ohc=ac7u6-RjEYIAX9XSQbN&amp;tn=Scr20AvjaTElGuIG&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT9DtI2UjRJGwkE48G7nxYwIfc-hCBcsBLdQZ7xurV_kOQ&amp;oe=6227F953\" alt=\"May be an image of 10 people, people sitting, indoor and text\"><br></div>', '', 'Sabtu', '2022-03-05', '19:06:52', '275079089_326757416149953_5843214107775153913_n.jpg', 21, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(733, 61, 'admin', 'Dukung Revolusi Hijau Paman Birin, Dishut Kalsel & Tahura Sultan Adam Tanam 800 Bibit Johar', '', '', 'dukung-revolusi-hijau-paman-birin-dishut-kalsel--tahura-sultan-adam-tanam-800-bibit-johar', 'N', 'N', 'N', '<div>Mandiangin – Program Kegiatan Revolusi Hijau terus digelorakan.  Dishut Prov Kalsel Bersama Tahura Sultan Adam melaksanakan penanaman bersama dengan jenis bibit pohon Johar dalam rangka mendukung Program Revolusi Hijau yang telah dicanangkan oleh Bapak Gubernur Kalimantan Selatan Sahbirin Noor sejak tahun 2017. Kegiatan penanaman tersebut dilaksanakan diareal Refiter yang berada dalam Tahura Sultan Adam Mandiangin. Kamis pagi (3/3).</div><div>Dipimpin langsung oleh Plt. Kadishut Prov Kalsel Fathimatuzzahra, kegiatan penanaman bersama tersebut diawali dengan Apel Bersama dan pembagian tugas kepada semua personel gabungan tersebut. Dengan alat yang sudah dibawa personil dari rumah masing masing seperti cangkul, parang, dan gunting tanaman semua personel langsung meluncur kelokasi penanaman.</div><div>\"Hari ini kita Kembali melakukan kegiatan penanaman, saya harap dengan adanya penanaman kali ini dapat membangkit semangat Revolusi Hijau, khususnya kita semua semakin sadar bahwa pentingnya tanaman bagi kehidupan \" kata Fatimatuzzahra.</div><div>Suasana sejuk berembun membuat para personil sangat bersemangat dalam kegiatan kali ini, dengan menggunakan sepatu boots semua personil berpencar dan mengelilingi Kawasan Refiter sesuai arahan yang sudah diberikan. Dalam kegiatan tersebut ada yang memmbuat lobang tanam, membawa/menyebarkan bibit, dan menanam bibit Johar.</div><div>Sampai selesai, sekitar 800 bibit pohon johar berhasil ditanam personel gabungan Dishut Kalsel dan Tahura Sultan Adam.</div><div>Berlanjut, setelah penanaman selesai Esselon 3 dan 4 Dishut Kalsel bersama Tahura Sultan adam mengadakan rapat terkait persiapan peresmian Taman Konservasi Anggrek yang terletak di Tahura Sultan Adam yang akan diresmikan pada bulan Maret 2022.</div><div>Plt. Kadishut Prov Kalsel Fathimatuzzahra dalam rapat tersebut menyampaikan bahwa \"Terkait peresmian Taman Konservasi Anggrek yang akan dilaksanakan bulan maret ini saya mengharapkan nantinya setelah diresmikan para pengunjung yang datang ke Tahura Sultan Adam dapat menjadikan Taman Konservasi Anggrek ini menjadi tujuan destinasi unggulan terbaru yang ada diTahura dan dapat menarik pengunjung lebih banyak lagi nantinya\" kata Fathimatuzzahra.</div><div>Dalam rapat tersebut dilaksanakan pembahasan bersama pejabat Tahura Sultan Adam mengenai persiapan mengenai konsumsi, undangan yang hadir, dan kesiapan keamanan diacara peresmian Taman Konservasi Anggrek</div><div><br></div><div><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275192651_327378642754497_9184184681910229396_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeFHIwZ4cK4KHy3o5VecNzNx6xpTCpUPH0LrGlMKlQ8fQoEaHwpcreRjK3UxD0Fa3bDaE3QFQLa4KfEFur8-rMdM&_nc_ohc=WolpYWzL0TEAX_zzeRE&_nc_zt=23&_nc_ht=scontent.fsub6-1.fna&oh=00_AT-uzNnzJBz1-K_tH_GBG3YBP4f5iNgT2ke_ePL7szgwbQ&oe=62287DA8\" alt=\"May be an image of 11 people, people standing, road and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/275167995_327378689421159_1925526877139580415_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeEWIUj5xBCFeRz_f-LqcgImsZjjUAY5OL6xmONQBjk4vrOyq1G3xwtV4UIFeZhaNY4aa4jlrijwLkEZPJvSlyp2&_nc_ohc=yq_VS2vYRPEAX8hltST&_nc_zt=23&_nc_ht=scontent.fsub6-5.fna&oh=00_AT9QLc6v9Ijouu_iiFuBVZHAcCPvKfiBw0POf8BBibt78Q&oe=62278A56\" alt=\"May be an image of 10 people, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL DISHUT OETO\'\"></div><div><br></div><div><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/275207972_327378742754487_7045572383712927736_n.jpg?_nc_cat=107&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeFc4XcLqAdEr6h9GUt5YPQPAdg35BZJSHsB2DfkFklIexy1bv_pRpwRbbY9DpLA3t88ig_ByzlNaj8EObCpDyV9&_nc_ohc=pp8gZsq8BqUAX9e6LA2&_nc_zt=23&_nc_ht=scontent.fsub6-4.fna&oh=00_AT-3XbPRH6115ULW-WkNE7dFH1x5c1PVVrPIQJ7XV1Hd9Q&oe=62279F07\" alt=\"May be an image of 9 people, tree, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK # melayani bangga telgyo Akuntabel ompeten Kolaboratit bangsa 29\'\"></div><div><br></div><div><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275029097_327378796087815_6470519112319867557_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeGRU-CtwFOP5Vx1Fxi6xPffMo9JYGeA-t4yj0lgZ4D63uecAsBCwtYeRh5q_YrBZ2mdgqi4sPK5tyoIuFNvy2TJ&_nc_ohc=FCK9qNitt6YAX_W6fJz&_nc_zt=23&_nc_ht=scontent.fsub6-6.fna&oh=00_AT8KKwsIwuNylYT2cby2BqhH_yfQY87DHR9rw0aX_q_-lA&oe=62277D21\" alt=\"May be an image of 11 people, outdoors and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/275108109_327378829421145_7621130521101039968_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeENae9Ulb2XYGw-q8URwp36nbnnsFf1FQidueewV_UVCAaFTsG1MPPGR-KBPEGUSBmRRM3V3SzH_aD07Ja0xbu7&_nc_ohc=U8KmAqm2-SoAX8thFlU&_nc_oc=AQnyGNnVZkDP7XynXn7B01rt9RaMTP2Sqod95QkavqfnH9VKC01-VI6O3OJA5shZDGI&tn=Scr20AvjaTElGuIG&_nc_zt=23&_nc_ht=scontent.fsub6-3.fna&oh=00_AT9zH4KCxu2hViQccB61404sPjDtxx5r0clUFH7265ITsQ&oe=62288D18\" alt=\"May be an image of 8 people, people standing, tree, outdoors and text that says \'DINAS KEHUTANAN PROV.KALSEL PROV KALSEL HAPPO 29\'\"></div><div><br></div><div><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275109698_327378869421141_7134359430595814627_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeF413dW6UulCv2Kur4QdR4VGHc_5FmA_hQYdz_kWYD-FGib5CoAIcUQ3DWRXBcUOawh3Q9DMipCqgM6hKY4y3-Z&_nc_ohc=LeDVYn6eTnwAX_571G4&tn=Scr20AvjaTElGuIG&_nc_zt=23&_nc_ht=scontent.fsub6-7.fna&oh=00_AT9pWgFm61hdeNcGnBsCDEzFi75-IFUW3xKu4JW-SCt2CA&oe=62284FEB\" alt=\"May be an image of 1 person, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKH 14 gga ayani sa\'\"></div><div><br></div><div><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275064188_327379029421125_2374255758002054278_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeEJoCTsmYi-pXGnSDdwidd553DJbDEcC7DncMlsMRwLsHNyJXlNNu75MOeY55xdRmcmej2PEiSAIuTEHaiSZH5-&_nc_ohc=xhR4QkDDtT8AX-8_Y_2&tn=Scr20AvjaTElGuIG&_nc_zt=23&_nc_ht=scontent.fsub6-7.fna&oh=00_AT_IGbvMvHuYgqCtEMHjMxFRvvkGJwGQ8GnFVoA8EnHI2Q&oe=6227B672\" alt=\"May be an image of 3 people, tree, outdoors and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275125249_327379076087787_5714855336475447264_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeGxW0oOuWUXbOjrIJJjRPeaaBjU8C9U4YhoGNTwL1ThiLn3nfqUKKFsIPVVeP4YVGEUSpOHANDXlb2N70iVj2Db&_nc_ohc=oKcmm-A5aEIAX-qTgGH&_nc_zt=23&_nc_ht=scontent.fsub6-7.fna&oh=00_AT9WM2ToB7MJ3IzFbBRXt_QPZua4keF8V647B3kn59wJ_g&oe=6228C706\" alt=\"May be an image of 3 people, people sitting, outdoors and text\"><br></div>', '', 'Sabtu', '2022-03-05', '19:15:05', '275105296_327378999421128_7313697928269115427_n.jpg', 22, 'tahura-sultan-adam,dinas-kehutanan,dishut-kalsel', 'Y'),
(734, 61, 'admin', 'Semangat Revolusi Hijau Di Banua Digelorakan, Dishut Kalsel Tanam 800 Bibit Jabon', '', '', 'semangat-revolusi-hijau-di-banua-digelorakan-dishut-kalsel-tanam-800-bibit-jabon', 'N', 'N', 'N', '<div>Banjarbaru - Kegiatan rutin penanaman Dinas Kehutanan Provinsi Kalimantan Selatan setiap hari Kamis dan Jumat kini berlajut, sekarang giliran lokasi di Lahan Pemprov Kalsel Palam yang di tanami bibit Jabon.</div><div>Anggota staf Polisi Kehutanan dan staf Balai Perbenihan Tanaman Hutan(BPTH) pun juga selalu ikut berpartisipasi dalam kegiatan penanaman pagi tersebut. Jum\'at (4/3) pukul 07:00 wib</div><div>Dipimpin langsung oleh Sekretaris Dishut Kalsel Bijuri kegiatan penanaman di gelar, dengan melaksanakan apel pagi terlebih dulu untuk pembagian tugas dan arahan terlihat dalam kegiatan tersebut semangat Revolusi Hijau para personil untuk menanam.</div><div>\"Penanaman yang selalu kita gelar setiap pagi hari kamis dan jum\'at ini, semata mata agar menjaga keasrian dan menghijaukan lingkungan kita serta menjadikan contoh kepada masyarakat bahwa lingkungan perlu juga dijaga agar tetap hijau yang nantinya akan menghasilkan kenyamanan untuk kita bernafas,\" ucap Bijuri.</div><div>Semua personel yang hadir memang sudah diberikan arahan sebelumnya agar membawa alat penanaman seperti cangkul, sekop taman kebun, dan sarung tangan agar mempermudah proses penanaman.</div><div>Sampai selesai penanaman, sekitar 800 bibit pohon Jabon berdiri tegak dikawasan tersebut dan langsung diberi pupuk agar tumbuh tanaman baik dan maksimal</div><div><br></div><div><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275222913_327950179364010_7612860887554013575_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGUeVQ2Nt8aONHf97k8k3Y-5AcXzr6AnjvkBxfOvoCeOzXY8M9y0m4C4G_2QSIbOc84mvrHNj_9UrPrCbAdsNiI&amp;_nc_ohc=SRs--bDuuwkAX8GfKP9&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT-s40VEK9C7srtwBgNUlg8r4UFsU5J7g0ZF4ZdY2SPEpQ&amp;oe=62289F80\" alt=\"May be an image of 12 people, people standing, outdoors and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/275222776_327950292697332_4663826401580614731_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGn1TDowNs3dEnn8R9FCidkWSMtO9C8mY5ZIy070LyZjovT4Q1VKBwQ64aqi14XkWpWnWjuocQRA2guAm6Pyiz5&amp;_nc_ohc=crApLiYHbVcAX-LAnls&amp;tn=Scr20AvjaTElGuIG&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT9vVQR0mDAgUUdbT1RxJMUH9Z6M0U0oFMb_my2310K9zQ&amp;oe=622854B8\" alt=\"May be an image of 13 people, people standing, tree, outdoors and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275183047_327950322697329_4735761410148170562_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeE1ZHMg8GXCNj7QW6u85kkcqGcvoxm3UgSoZy-jGbdSBOgv4ARl2kLUcAGyJmUFZs-cO2gHH7DWFPE40Vl3IO67&amp;_nc_ohc=1GYCPspmoLoAX_ReF9l&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT8eIyjx7GK4SXWsLzoE0GxifdCK_lkfZGH8rOxf7B5eGw&amp;oe=6227CD89\" alt=\"May be an image of 6 people, people standing, tree, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK # bangga Berorientas ant Kglaboraa Akuntabel tompeten melayani bangsa\'\"></div><div><br></div><div><br></div>', '', 'Sabtu', '2022-03-05', '19:23:39', '275130751_327950202697341_8193165361724992702_n.jpg', 22, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(735, 61, 'admin', 'Rakor Rencana Pembangunan Wahana Bermain Anak di Hutan Pinus Kota Banjarbaru', '', '', 'rakor-rencana-pembangunan-wahana-bermain-anak-di-hutan-pinus-kota-banjarbaru', 'N', 'N', 'N', '<div>Banjarbaru - Dishut Kalsel Rapat koordinasi (Rakor) skema kerjasama dan bagi hasil dalam rangka Rencana Pembangunan Wahana Bermain Anak di Hutan Pinus Kota Banjarbaru yang dilaksanakan di Aula Rimbawan 2 Dishut Kalsel dengan menerapkan Protokol Kesehatan Covid-19.</div><div>Rakor dipimpin langsung Plt.Kadishut Prov Kalsel Fathimatuzzahra dan dihadiri esselon 3 dan 4 Dishut Kalsel serta perwakilan Badan Keuangan dan Aset Daerah Provinsi Kalimantan Selatan, Biro Pemerintahan dan Otonomi Daerah Sekretariat Daerah Provinsi Kalimantan Selatan, Biro Hukum Sekda Prov Kalsel dan Dinas Pemuda Olah Raga Kebudayaan dan Pariwisata Kota Banjarbaru.</div><div>\"Berkumpulnya kita semua disini untuk membahas terkait perizinan dan kewenangan kaitannya dengan kerjasama dan bagi hasil dalam rangka Rencana pembangunan Wahana Bermain Anak di Hutan Pinus Kota Banjarbaru,\" kata Fathimatuzzahra.</div><div>Dalam Rakor tersebut diadakan pembahasan terkait luas areal hutan pinus kota banjarbaru seluas 2,2 Ha, bangunan yang sudah dibangun seperti Gazebo dan Tempat Retribusi serta juga dibahas mengenai legalitas, kewenangan, dan perizinan mengenai kerjasama dalam Rencana pembangunan Wahana Bermain Anak di Hutan Pinus Kota Banjarbaru. Kemudian, hasil Rakor tersebut selanjutnya akan disampaikan Dishut Kalsel kepada Sekda Prov Kalsel secara bersurat untuk mengetahui kebijakan dan arahan selanjutnya.</div><div><br></div><div><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/275377459_329952795830415_5050696674436521625_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGUQuI_CPvq5alvsXt-_wrZ-CJs-5X-3Pv4Imz7lf7c-2MIX3I82ZfrvxnDZjkc8Lbz3PATsAaDrmWP56phJmDW&amp;_nc_ohc=gVKHkCn8HxQAX_Qpyff&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-5.fna&amp;oh=00_AT_JuAE8iYAMwkw6VzMjq3P2KJutQ2zwpOkxKvQfLDs2Qw&amp;oe=62354726\" alt=\"May be an image of 2 people, people sitting and text that says \'DINAS KEHUTANAN PROV. KALSEL\'\"></div><div><br></div><div></div><div><br></div><div><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275403336_329953385830356_4242797375774946608_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEfHy2TAvaoBb4hQAO7lG1ECgBtoNP7jAYKAG2g0_uMBlJEz1eW-jdPsI9oCJvsmO_xRXqTJVYHXRSYfAIGxinB&amp;_nc_ohc=NF0Oyrkf3MYAX9C_BrZ&amp;tn=2UclAcFuxqH7ASP4&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT-Rp1_Q8qZl6rFV-iI80im5uyYDZaFTHWJFEDiCypkg8g&amp;oe=62364BD7\" alt=\"May be an image of 10 people and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275336267_329953439163684_5444038192722360631_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGfxWaOqg7gSNu8RvEA4wU6GPRZN3aMFc4Y9Fk3dowVzohXeYwLRauMx0O2PQdQ3yTY9RQQMMfGX-6f8AgvSHm7&amp;_nc_ohc=wfJYtnDbessAX9kE5gz&amp;_nc_oc=AQlr4cPhQ4A4-UzPGmZJLd_Cqt-CWvMqJh4YcFWZGNEoL2bjZUGsd955FeQ1pLSfXyw&amp;tn=2UclAcFuxqH7ASP4&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT81x7GJzfkcPsS-_cl4Zw8MXaLwE7i95LBO71UxMEmOLw&amp;oe=6236D220\" alt=\"May be an image of 3 people, people sitting and text that says \'PKEANA DINAS KEHUTANAN KALSEL BerAKHLAK bangga www.aoob melayani\'\"></div><div><br></div><div><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/275483609_329953262497035_4857627733720873690_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFTXW_pXeMu9PW2-5RjofRM7tvDDeFl6N7u28MN4WXo3h0yo0o08v9U_ZlLCcVR1gDB3wAh_ktPKVA_tX5xNkrS&amp;_nc_ohc=YpT198GS5-QAX9Qol1w&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT_YiAp5sFqDxRXJzsPvFvPhx7bpoCZOWYgOaPrnJyRoZQ&amp;oe=6236E3B5\" alt=\"May be an image of 3 people, people standing and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275424730_329953295830365_7985252239052171817_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeENBjBkdXH-v06HXvljJRJb8m1kYlKljyXybWRiUqWPJQiJKA4kWmcO3OwKHDErWHqtuSMouERjTsmtJ0JED_5T&amp;_nc_ohc=1PmShYQ5A0sAX-zvJzN&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT9PtchLQuRv2Acdg7GdqazqceLXT_32iFTE1GA_cC95cA&amp;oe=6235E7BE\" alt=\"May be an image of 2 people and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275428759_329953345830360_166026248876809807_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHT4u15KyHNkFMbaBEg3WUwXZj_Ar32X6ddmP8CvfZfp70Qh2mLh3Ozh1oQCB7Y__ABF6AhQMHaz10Zte43SVGx&amp;_nc_ohc=_WaGvzFLWtkAX_uysCU&amp;tn=2UclAcFuxqH7ASP4&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT8ZqAlfIPUCJizG-PBQIziqCb6Wsjagh-4MvmSovzmcvQ&amp;oe=6236D327\" alt=\"May be an image of 3 people, people standing and text\"><br></div>', '', 'Rabu', '2022-03-16', '07:08:56', '275456436_329952839163744_1354388923990025870_n.jpg', 16, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(736, 61, 'admin', 'Dishut Kalsel Rapat Capaian Kinerja Bulanan tahun 2022', '', '', 'dishut-kalsel-rapat-capaian-kinerja-bulanan-tahun-2022', 'N', 'N', 'N', '<div><span style=\"font-size: 14px;\">Banjarbaru - Dishut Kalsel rapat terkait pembahasan Capaian Kinerja Bulanan tahun 2022 dilaksanakan di Aula Rimbawan 1 Dishut Kalsel dan tetap melakukan Protokol Kesehatan Covid-19. Selasa siang (8/3).</span></div><div><span style=\"font-size: 14px;\">Dipimpin langsung Plt. Kadishut Prov Kalsel Fathimatuzzahra dan dihadiri para esselon 3 dan 4 Dishut Kalsel yang bertujuan untuk mengukur capaian kinerja bulanan di tahun 2022.</span></div><div><span style=\"font-size: 14px;\">\"kali ini kita akan membahas terkait capaian kinerja bulanan, dimana hal ini tujuannya nanti untuk mengukur capaian kinerja kita semua disetiap bulan ditahun 2022,\" Kata Fathimatuzzahra.</span></div><div><span style=\"font-size: 14px;\">Dalam rapat capaian kinerja bulanan tersebut dilakukan pembahasan dan penginputan terkait data realisasi kinerja tahun 2022. Pembahasan mengenai penginputan uraian-uraian kegiatan perbidang Dishut Kalsel secara bergantian mulai dari bidang Sekeretariat, bidang Pengelolaan Daerah Aliran Sungai Rehabilitasi Hutan dan Lahan(PDASRHL), bidang Perlindungan dan Konservasi Sumber Daya Alam Ekosistem(PKSDAE), Bidang Perencanaan Pemanfaatan Hutan(PPH) Hingga Bidang Pemberdayaan Masyarakat Penyuluh dan Perhutanan Sosial (PMPPS).</span></div><div><span style=\"font-size: 14px;\">Setelah melakukan penginputan data uraian kegiatan tersebut selanjutnya akan dibagi kembali kemasing masing bidang untuk nantinya dikoreksi apa saja kekurangan dalam data tersebut ditiap bulannya dan akan dijadikan contoh gambaran bagi UPTD lingkup Dishut&nbsp; Prov Kalsel dalam menginput data realisasi kinerja dan capaian kinerja bulanan tahun 2022.</span></div><div><span style=\"font-size: 14px;\"><br></span></div><div><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275487899_330537865771908_6015613253116001322_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFjzP2e1gepOJ_J8r7V-qX2imIKbeeNQ5WKYgpt541DldCWveHOY99IVPluC4PCWTUE5WZscSNvkfLT55HUAY74&amp;_nc_ohc=51QTYDb6jkEAX-SjdIO&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT_Ls-gAarD2VDU91FsmjyeIs_5XZ7NUYV1YtAHb3YYozg&amp;oe=6235CAD9\" alt=\"May be an image of 4 people and text\"><span style=\"font-size: 14px;\"><br></span></div><div><span style=\"font-size: 14px;\"><br></span></div><div><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275474944_330537909105237_4533185510866441952_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEICrgk0sKP1T7HwXcwChctODKukWv3YAM4Mq6Ra_dgA8J_3f9t_PN1Urv8TZstKMFoLqFL4NR9_SID7BxwnCM4&amp;_nc_ohc=bYMaaLxxMQEAX_WcXAQ&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT_W1zAonRozWhEZDMeQNN7eDbVteiFtK9eOFw2KFMfOWA&amp;oe=6235C05D\" alt=\"May be an image of 5 people, people sitting and text\"><span style=\"font-size: 14px;\"><br></span></div><div><span style=\"font-size: 14px;\"><br></span></div><div><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275512166_330537935771901_8931535240874871307_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGoqKQwkcDILgbebIaK4aNR3GQNH9XSSdPcZA0f1dJJ0yje0iuCcA__iErMGyMiaowOEHQ7Ce7-P761l1c2JopC&amp;_nc_ohc=mQT1hR2AVuAAX8C78iS&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT98HBHQL0zasf7z4Ha95SEeDqti7ktcA5gajj3gcG1ByQ&amp;oe=6235C58F\" alt=\"May be an image of 2 people, people sitting and text\"><span style=\"font-size: 14px;\"><br></span></div>', '', 'Rabu', '2022-03-16', '07:08:22', '275427631_330538022438559_5403973021384003792_n.jpg', 15, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(737, 61, 'admin', 'Kesehatan Dan Kebugaran Dijaga, Dishut Kalsel Latihan Karate Bersama', '', '', 'kesehatan-dan-kebugaran-dijaga-dishut-kalsel-latihan-karate-bersama', 'N', 'N', 'N', '<p><span style=\"font-size: 14px;\">Banjarbaru – Sebelum memulai aktifitas kantor setiap hari rabu Dishut Kalsel rutin melaksanakan latihan Karate bersama untuk menjaga kesehatan dan kebugaran tubuh seluruh staf Dinas Kehutanan Prov Kalsel bersama Polisi Kehutanan di halaman terbuka depan kantor Dishut Prov Kalsel, Rabu pagi (9/3).&nbsp;&nbsp;</span></p><p><span style=\"font-size: 14px;\">Latihan karate bersama tersebut diinstrukturi Eko Djatmiko Widodo salah satu personel Polisi Kehutanan, eko mengawali latihan tersebut dengan melakukan pemanasan dan melatih gerakan dasar karate yang sudah dipelajari sebelumnya, selain itu menjelaskan kegunaan gerakan yang dilatih selama ini dalam membela diri pada saat tertekan, agar semua staf serius dalam mengikuti latihan bela diri karate bersama dalam latihan tersebut.</span></p><p><span style=\"font-size: 14px;\">\"Hari ini kita akan melatih gerakan pukulan dan tendangan, sebelumnya kita akan melakukan pemanasan terlebih dahulu agar otot kita tidak cedera dalam latihan nanti\" kata Eko</span></p><p><span style=\"font-size: 14px;\">Dalam latihan karate tersebut eko juga menerangkan bahwa ada sebuah pepatah \" pukulan yang kuat dihasilkan dari proses latihan yang giat\" ucap, Eko.</span></p><p><span style=\"font-size: 14px;\">Latihan tersebut ditutup dengan gerakan pendinginan agar kondisi tubuh terjaga dan tetap dalam kondisi stabil.</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275484061_330984715727223_7651804517548047743_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGijD4jCDRAgTlJEJnCk-ml1S3EFyzFGDTVLcQXLMUYNAQTGmo_PWBkdGXBHi6SxAmu_GQsVOE-itBfSk_Rnwrl&amp;_nc_ohc=cIknGDfSUysAX8vhTgT&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT_ZR-kKuWVRFhL6B2jV6QVsq_6UbruxcO2igUH5bYDGjQ&amp;oe=62355070\" alt=\"May be an image of 14 people, people standing, outdoors and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/275581501_330984985727196_2213140276421648686_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeENwx8qo6lWKpQ2aSCkzSNsNNytsuN0v6o03K2y43S_qmUtCSpNTSvMO-jlbf-1CDYK2Sc8sjwIN-eH_qBDtvq3&amp;_nc_ohc=rZvdzz1Ii08AX-N4bb4&amp;_nc_oc=AQlE5qBufyY1kCFy2cqxc7e0PRIubPcYdChERRUxy1g2YWqWvFXTRaQ_qlXrWQBw1rI&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT-feF2_KarTSdZZ4x75OBHdrY8ZO58SbwL-9-il1Npw3A&amp;oe=62364130\" alt=\"May be an image of 9 people, people standing, grass and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/275490242_330985099060518_2636205438571425231_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHxnJLKAmItVUmZ8UTTNG4A33T-m8cxFULfdP6bxzEVQl9fPGyNL-mccyC8YNS6ZZi33Z_9iZ7Z4GjEMEvUWCnl&amp;_nc_ohc=txopVO-DJu8AX8E73xR&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT-wxDIZyjY5vSmF-qVNc9BSiTBEC-6eYdUIEFciGHmYJQ&amp;oe=62358CEB\" alt=\"May be an image of 1 person, standing, outdoors and text\"><span style=\"font-size: 14px;\"><br></span></p>', '', 'Rabu', '2022-03-16', '07:11:07', '275465720_330984655727229_828546322786072971_n.jpg', 16, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(738, 61, 'admin', 'Tim Pamhut KPH Balangan Laksanakan Patroli Di Wilayah Tebing Tinggi', '', '', 'tim-pamhut-kph-balangan-laksanakan-patroli-di-wilayah-tebing-tinggi', 'N', 'N', 'N', '<p><span style=\"font-size: 14px;\">Tim Perlindungan Hutan KPH Balangan&nbsp; melaksanakan Patroli Pengamanan Hutan di desa yang berada wilayah Kecamatan Tebing Tinggi pada Selasa ( 08/03).</span></p><p><span style=\"font-size: 14px;\">Tim yang beranggotakan Polisi Kehutanan dan Tenaga Kontrak Pengamanan Hutan (TKPH) ini Berpatroli di Desa Ajung, Langkap, Mayanau, Gunung Batu dan Desa Ju\'uh.&nbsp;</span></p><p><span style=\"font-size: 14px;\">Sebelum melakukan Patroli tim terlebih dahulu melakukan koordinasi Kepada Aparat&nbsp; desa setempat mengenai kondisi wilayah setempat.&nbsp;</span></p><p><span style=\"font-size: 14px;\">M. Emir Faisal, S. Hut selaku Kasi Perlindungan Hutan mengatakan\" Tim kita Intruksi kan untuk melakukan giat ini sebagai upaya untuk mencegah terjadinya Ilegal Logging di wilayah kerja, tentunya kita juga sudah melakukan Koordinasi kepada aparat setempat untuk mengatahui seluk beluk kondisi terkini medan yang akan tim kita lalui ungkapnya\".</span></p><p><span style=\"font-size: 14px;\">Dalam melakukan&nbsp; patroli&nbsp; di mulai dari Desa Ajung yg merupakan Desa paling hulu di Kecamatan Tebing Tinggi untuk di lakukan patroli di darat maupun di bantaran sungai&nbsp; untuk dilakukan penyisiran Sampai di desa paling hilir yakni desa Ju\'uh.</span></p><p><span style=\"font-size: 14px;\">Dari beberapa titik yang dicurigai sebagai tempat pemiliran kayu tersebut, Tim tidak menemukan adanya kayu didarat maupun rakit kayu yg dimilirkan melalui aliran sungai tersebut.&nbsp;</span></p><p><span style=\"font-size: 14px;\">Gusti Hairil Imtihan, S. Hut mengatakan\" Alhamdulillah, saat kita melakukan giat ini tidak ditemukan adanya tindakan ilegal logging disepanjang giat patroli tadi&nbsp;</span></p><p><span style=\"font-size: 14px;\">,baik didarat maupun di sungai yang di beberapa tempat yang kita curigai di awal dalam melakukan giat ini\" Ungkapnya.&nbsp;</span></p><p><span style=\"font-size: 14px;\">Dalam giat Patroli tersebut Tim juga menyerahkan bantuan bibit sebanyak 100 batang terdiri dari jenis Mahoni, Spathodea, Angsana dan Trembesi untuk KUPS Wisata/Jasling LPHD Ajung yang akan melakukan penanaman di areal wisata Batu Ajung.&nbsp;</span></p><p><span style=\"font-size: 14px;\">Dengan adanya giat ini diharapkan kegiatan&nbsp; ilegal logging bisa dicegah dan kelestarian alam bisa terjaga untuk generasi berikutnya nya.(pansyah/kphbalangan)</span></p><p><span style=\"font-size: 14px;\">tetap dalam kondisi stabil</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/275616766_331055595720135_7240362038184791672_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGnvIraoQ94zIXzn3rR_Wrv2dCkIc80UzjZ0KQhzzRTONPpUUEv_eSF4HyAF8c4zlPBuvmilcX7PhPoiyuTUF_S&amp;_nc_ohc=77keepJTBkAAX82KMQb&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-5.fna&amp;oh=00_AT9FM9cPaNw-DP5MGRxSnOcK83PBpkVCzk7mtvqfhkFrNw&amp;oe=6236CC6D\" alt=\"May be an image of 5 people, people sitting, indoor and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275466444_331055629053465_4704147829640063234_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEUJFDohmMoqENdV2XE24GPNRstzDFRvLo1Gy3MMVG8utpARVKB6-mpBQ4O77bzfMg5Z3xQikE5kXg7OCTIh0hU&amp;_nc_ohc=Odg-gPujju0AX9NPA9_&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT9nFwMiArdqddKj3YNdu9OEifsatHCfXyprDijttvN3wg&amp;oe=623698FD\" alt=\"May be an image of 1 person, tree, outdoors and text that says \'DINAS KEHUTANAN PROV KALSEL\'\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275549256_331055425720152_8926944318144497772_n.jpg?_nc_cat=103&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHMbfEB_cDN311jobe1GO_agMKOBsPtF2-Awo4Gw-0Xb4yZSPyN6L6uY7kNgqKEBJgSeTuuHvtZWbQXID7woXd-&amp;_nc_ohc=-HWSbWfUNd8AX_ZTvg-&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT_heZ8vw5zBtrvmWsr5wVfGSXHouvbIx82k-YYDKmK8rA&amp;oe=62368334\" alt=\"May be an image of 3 people, people standing, body of water and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/275443518_331054975720197_8724814381175695392_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGSOSUDf6k5eFO87Y0dzDuYLH5LDKxDh1IsfksMrEOHUsyvMJx44rjYVOoZLWcEVm9irw7NUV0JaKT9GcpsV4u_&amp;_nc_ohc=30hcDkCEBk8AX-f26hy&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT8MO_YoQhbSc7iGt4GqqwYr8XRMWZWmhDX1ceElZxURkQ&amp;oe=62371960\" alt=\"May be an image of 2 people, people standing, tree and outdoors\"><span style=\"font-size: 14px;\"><br></span></p>', '', 'Rabu', '2022-03-16', '07:18:11', '275486065_331055549053473_3517788396886635702_n.jpg', 18, 'pengamanan-hutan,polhut,kphbalangan,kphbalangan,dinas-kehutanan,dishut-kalsel', 'Y'),
(739, 61, 'admin', 'Sebelum Memulai Aktifitas Kantor, Dishut Tanam 1000 Pohon Untuk Gelorakan Revolusi Hijau', '', '', 'sebelum-memulai-aktifitas-kantor-dishut-tanam-1000-pohon-untuk-gelorakan-revolusi-hijau', 'N', 'N', 'N', '<p><span style=\"font-size: 14px;\">Banjarbaru - Dishut Kalsel laksanakan penanaman dan pemeliharaan tanaman lanjutan, penanaman dan pemeliharaan tanaman kali ini berlokasi di lahan Pemprov Kalsel di Palam yang di tanam dan disulam kali ini adalah bibit tanaman dengan jenis Sirksak,jambu air, dan langsat. Personel gabungan dari Polisi Kehutanan dan Balai Perbenihan Tanaman Hutan(BPTH) pun juga&nbsp; hadir dan berpartisipasi dalam kegiatan penanaman dan pemeliharaan kali ini. Kamis pagi (10/3).</span></p><p><span style=\"font-size: 14px;\">Dipimpin langsung oleh Plt. Kadishut Prov Kalsel Fathimatuzzahra kegiatan penanaman di gelar, setelah berkumpul dan pembagian tugas seluruh personel langsung berpencar sambil membawa bibit untuk ditanam. Dengan semangat Revolusi Hijau para personil menanam.</span></p><p><span style=\"font-size: 14px;\">\"Hutan lestari masyarakat sejahtera, penanaman dan pemeliharaan tanaman yang selalu kita gelar setiap pagi hari kamis dan jum\'at ini semata - mata agar menjaga keasrian dan menghijaukan lingkungan kita. Saya harap semangat Revolusi Hijau selalu tertanam dihati kita untuk menghijaukan bumi banua kita ,\" kata Fathimatuzzahra.</span></p><p><span style=\"font-size: 14px;\">Semua personel yang hadir sudah diberikan arahan sebelumnya agar membawa alat penanaman seperti cangkul, sekop taman kebun, dan sarung tangan agar mempermudah proses penanaman.</span></p><p><span style=\"font-size: 14px;\">Sampai selesai,&nbsp; penanaman dan penyulaman total 1000 bibit pohon Sirksak,jambu air, dan langsat berdiri tegak dikawasan tersebut dan langsung diberi pupuk agar tumbuh tanaman subur dan baik</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275617210_331561959002832_4056224939907050891_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGukXg_gGsDAKt2AfA7u5U8Mnx9sRliaYQyfH2xGWJphGTXbUFjcWkYGk2x2FxshZlgyVqPq10lzUKXBUNMA_7S&amp;_nc_ohc=jgOPwl5kR7AAX9jbpff&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT_Reck62X9OCV9k0H72lUcuJwY3tw1ufKDmWG5Dr5u4iA&amp;oe=62362404\" alt=\"May be an image of 6 people, people standing, grass and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275602800_331562069002821_2765965696411549988_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeF03HjaRRgrSQw5RUqeHpKn_UnbDuIk-tr9SdsO4iT62neaCbnz24Z5OmsNSE193VmxTUfbzWAxmUWagHmvgzdt&amp;_nc_ohc=WGa2k9p19wcAX97IA4x&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT9OpyU0NiDR9BxHdFhcR2w5qe1XH6darJPdraZkiucOFQ&amp;oe=62364754\" alt=\"May be an image of 11 people, outdoors and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275543943_331562149002813_117824661874652300_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFh8ZOXEu2ZpQVWa9sa_GRfoDxbqVOA3wqgPFupU4DfCmPJIho63oD8r0du0_YyK5xdEwaR3Q0TC0zLIbLSySAp&amp;_nc_ohc=jJvsTuX-e-AAX8ZGDoC&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT89ybUC1VM8GNi8kVZFdcFya2l1OcYEeoyMOoPAwYn3eA&amp;oe=623586E1\" alt=\"May be an image of 15 people, people standing, outdoors and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275506837_331562272336134_5184846620712583958_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGgDeLwaTL04qpGG6hUVkdQyE5xoHYbkHfITnGgdhuQd7AxSVO2JvjbTWx8XLR-2A_EU6gm__CIx6YbObwfXIDm&amp;_nc_ohc=k_j80mpuEJEAX-b1geT&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT_160TVO02JRUXUrsQFBw9G6_oHBrpkcM1lmbHzWIlhDQ&amp;oe=6237132E\" alt=\"May be an image of grass, tree and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275623982_331562302336131_7327604908026056659_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEWzyLkOAZCUtW5OVxVj1RaW7o8wLp076RbujzAunTvpM702bbWEXng6KlvSD3sDc9gPjlzPPoT0Uf02y6mXN3a&amp;_nc_ohc=ngvL13D1QCcAX9G_0hj&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT8J-jEaIFKtk8_LMQfNDfHAlrNMG5GbXcHfPH6Glysa4A&amp;oe=6235A7FB\" alt=\"May be an image of 1 person, tree, grass and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275603221_331562389002789_8482182398600556987_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHfJqezLVvLGOwZgpLgykxLWGD4RSIX8E1YYPhFIhfwTZmGVAD0FmisUhbJDRhFWLwb81a9V14Si8NQDUgaQSwS&amp;_nc_ohc=CIWTrNj9I0sAX8LGKkF&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT-xr_U7DJsaBStfL_a79BZUOMJ_JPJsPAJ9CDHkRCYorg&amp;oe=6235C615\" alt=\"May be an image of 1 person, grass and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/275615378_331562442336117_7702475320639848055_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHcuI13IsKO6_jrJ07IH6sN_oZcjpqiBKT-hlyOmqIEpAyP_xgr2efZf5fb77ZmUtEs1CGurIvYENtarM_Ebwz6&amp;_nc_ohc=yi-U66cp2KsAX8vVyC0&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT920DTuuXF9hUvULcXXVBGE8RYAIk-EX5EsRiYrSU-QnA&amp;oe=62353F4A\" alt=\"May be an image of 3 people, people standing, outdoors and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/275611088_331562662336095_4121610833366145205_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeE0qPm_Xqb3iX40Z1IyOOWoeWe57whLDql5Z7nvCEsOqTYZoCkd7ypKj4AUZPMbKkBlcY0OO0kFDqmr4rc8LMFW&amp;_nc_ohc=ybCrvgXnfowAX-zU4bA&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT8yAUzmXRyZrpVOqsDfP8ZVet4Iw5zAf6ANreoUWZMWag&amp;oe=623554AB\" alt=\"May be an image of 5 people, people standing, tree, outdoors and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275514342_331562945669400_1356499431557437967_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHAItCCisF2AIlUn51cnl-VL_9xIVsfzCsv_3EhWx_MK6gfLYhi_f9F3DNM1NtemGJu_QOih-pt7pnJhnAAJFVn&amp;_nc_ohc=8trgGH9uJc0AX-6oTKh&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT_VWy201rfK0nPXVXO0OL_MTHfoM1cSFLfFJmi6F6LCAw&amp;oe=62363869\" alt=\"May be an image of 2 people, grass and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p>', '', 'Rabu', '2022-03-16', '07:31:28', '275547940_331561985669496_8676312537128990318_n.jpg', 19, 'revolusi-hijau,penanaman,dinas-kehutanan,dishut-kalsel', 'Y'),
(740, 61, 'admin', 'Hijaukan Alam Bersama SDN 1 Paringin Selatan', '', '', 'hijaukan-alam-bersama-sdn-1-paringin-selatan', 'N', 'N', 'N', '<p><span style=\"font-size: 14px;\">KPH Balangan melaksanakan Penanaman Bersama Jajaran Guru dan Siswa-Siswi dari SDN 1 Paringin Selatan yang bertempat dilingkungan Sekolah SDN 1 Paringin Selatan, pada Jum\'at (11/03).&nbsp;</span></p><p><span style=\"font-size: 14px;\">Dalam Penanaman tersebut KPH Balangan&nbsp; dipimpin Kasi Perlindungan Hutan beserta seluruh jajaran Staf KPH turut hadir , dan mendapatkan sambutan yang luar biasa antusias dari Guru dan Siswa-Siswi serta disambut langsung oleh Kepala Sekolah SDN 1 Paringin Selatan.&nbsp;</span></p><p><span style=\"font-size: 14px;\">Dalam sambutan nya Muhammad Suriadie, S. Pd&nbsp; Selaku Kepala Sekolah SDN 1 Paringin Selatan mengatakan \" Saya ucapkan terimakasih, kepada KPH Balangan dan rekan-rekan yang talah hadir, sehingga acara ini bisa terlaksana.&nbsp;</span></p><p><span style=\"font-size: 14px;\">Dengan adanya kegiatan ini mari kita bersama sama menjaga dan melestarikan lingkungan kita dan menumbuhkan rasa semangat kepada siswa-siswi untuk selalu mencintai alam kita\" Ungkap nya.&nbsp;</span></p><p><span style=\"font-size: 14px;\">Dalam penanaman ini&nbsp; KPH Balangan mendistribusikan bibit berjumlah 125 batang, terdiri dari Trembesi, Mahoni, Spathodea, Sengon, Jengkol, Jambu Mete, Langsat dan Kasturi serta Bibit-bibit Produktif (Alpukat, Jambu Air, Jeruk Nipis, Mangga, Rambutan).&nbsp;</span></p><p><span style=\"font-size: 14px;\">M. Emir Faisal, S. HUT Selaku Kasi Perlindungan Hutan mengungkapkan\" Alhamdulillah, kami ucapkan terima kasih atas partisipasi dari adik-adik dan seluruh jajaran Guru SDN 1 Paringin Selatan yang begitu luar biasa antusias dan Penuh semangat dalam melakukan Penanaman ini.&nbsp;</span></p><p><span style=\"font-size: 14px;\">Kedepan nya semoga penanaman ini&nbsp; terus berlanjut dan memberikan kita semua rasa kepedulian terhadap lingkungan kita sehingga tercipta lah lingkungan yang asri untuk kita semua\" tutupnya</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275666213_332312388927789_6500180557688442508_n.jpg?_nc_cat=105&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGsRVlZsqHra2WJXCXhC56DNvXQAlYFOlA29dACVgU6UG1CQ4L0pDS4fmgtFIl3xu1l4l4ZLiceQDTaYzg_bntc&amp;_nc_ohc=k564VPLF2OIAX8lds-y&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT-lwFCoYYAa4Co4jn3TjuVBDEnVaZzeQmY4Ly6rpp2YhA&amp;oe=6235BE62\" alt=\"May be an image of 12 people, people standing, tree, outdoors and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/275623283_332312322261129_2321215212614783897_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHnTZ3o1r97diaYwAnfKkn6qL-4NLqh6Dmov7g0uqHoObkvkizyO8691gtPmswla6JgKAjmxPgA4tYe9ZRYmD-U&amp;_nc_ohc=5gT63IM_qT0AX_gE3Tv&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT_23AF87K3dmurk1p8bWkv8JRTKvE-M7NTVz007qcKgIg&amp;oe=62362E9B\" alt=\"May be an image of one or more people, people standing and outdoors\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275602423_332312528927775_482133739525063304_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeF-8HDO_AHDflYnfZpZF3cY7qfbFLvx52Tup9sUu_HnZEzZKPoTojGZNhyqYcNhW3YyS9t9Qf9UTuYwhI2m8C_s&amp;_nc_ohc=HNhcaeTQCc4AX99nADm&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT-_fPkM0r_KVr73qStKUurAndjlGVCGY7gFYAXBPvO7kA&amp;oe=6235B5ED\" alt=\"May be an image of 12 people, people standing and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLA #al Tbangsa bangsa\'\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275615125_332312552261106_5592198256514000197_n.jpg?_nc_cat=105&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeH_va2NGD6dXc31Z8MQRkayTk8roeUVDyVOTyuh5RUPJfdfTnlIJHQiwv4m73VYFBGuYtgUjNc1Twu1MEfw0eNI&amp;_nc_ohc=xXrAtn1ZejYAX_cQb78&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT9D2Cjy5lGUERzu8-iSSMiCViffswYyT6_6KhPON0-l-w&amp;oe=6236FFED\" alt=\"May be an image of 12 people, people standing, tree, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLA # bangsa\'\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275607824_332312448927783_5446595904160260971_n.jpg?_nc_cat=103&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHjq-4E9_WvV1eu-wqFaWh3yniQ0zPbFF7KeJDTM9sUXvakTFmUU-EmbhSIc19OedIax6oGxCh9ZUj-raEwnro8&amp;_nc_ohc=FdAY7Z6QElUAX8JyUjT&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT8c1OP45YCWMkvnK4D2zJCeZ6K8gwgCYBdkIpODOrw2wQ&amp;oe=62357FAF\" alt=\"May be an image of 5 people, outdoors and text that says \'59952 DINAS KEHUTANAN PROV. KALSEL\'\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275621238_332312492261112_2957377513883059375_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFkpVe8skvnI3K_HH5gWciIkUmWV6erh4qRSZZXp6uHit8X5VANUuCecrgtzx5J5aUM5cI311oIXL0uDaTYTjM4&amp;_nc_ohc=ZNRsyCwm7GkAX_NkGE4&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT_NhhSGL2lfDqbUL0tp7V7jhTOL6_PPPbp2taxp60t1_Q&amp;oe=6236B9DA\" alt=\"May be an image of 3 people, people standing, people sitting, outdoors and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p>', '', 'Rabu', '2022-03-16', '07:36:49', '275512868_332311655594529_6205304744429931390_n.jpg', 20, 'revolusi-hijau,penanaman,kphbalangan,kphbalangan', 'Y');
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
(742, 61, 'admin', 'Dukung Publikasi Pembangunan Kehutanan, Dishut Gelar Pelatihan Jurnalistik', '', '', 'dukung-publikasi-pembangunan-kehutanan-dishut-gelar-pelatihan-jurnalistik', 'N', 'N', 'N', '<p><span style=\"font-size: 14px;\">Banjarbaru - Dalam rangka mendukung publikasi pelaksanaan program dan kegiatan pembangunan kehutanan di Provinsi Kalimantan Selatan kepada masyarakat luas, bekerjasama dengan Radar Banjarmasin, Dinas Kehutanan Provinsi Kalimantan Selatan laksanakan kegiatan Pelatihan Jurnalistik di Aula Rimbawan 3 Dishut Kalsel, Senin (14/3).</span></p><p><span style=\"font-size: 14px;\">Pelatihan jurnalistik yang dilaksanakan selama 4 hari dimulai dari tanggal 14 sampai dengan 17 Maret 2022 tersebut menghadirkan narasumber Toto Fachrudin selaku Pimpinan Redaksi Radar Banjarmasin dan Elsa Pratiwi dari Seatoday News. Pelatihan tersebut diikuti oleh peserta dari Dinas Kehutanan dan seluruh UPTD serta KPH lingkup Dishut Prov Kalsel. Senin pagi (14/3).</span></p><p><span style=\"font-size: 14px;\">Dihari pertama para peserta dibekali dengan teori tentang ilmu jurnalistik, serta bagaimana mengolah suatu informasi atau berita yang terjadi dilapangan menjadi sebuah artikel yang menarik seperti menentukan tema video, menyiapkan story line video, dan menyusun naskah/script.</span></p><p><span style=\"font-size: 14px;\">Melalui pelatihan atau workshop jurnalistik ini, peserta akan mampu mengemas naskah-naskah di media internal mereka menjadi jauh lebih menarik, baik itu naskah berita, dan video liputan. Pelatihan jurnalistik ini juga bertujuan sekaligus untuk meningkatkan SDM bagi Penyuluh Kehutanan dan Staf yang menangani media dimasing-masing Bidang dan UPTD serta KPH lingkup Dishut Prov Kalsel</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275783218_334269928732035_7961646464456442308_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeFXt0IXyzvPpx-GgTmXR-Sg29vrr78SWujb2-uvvxJa6GHwiQikvN_-7t8dbezp1ZFKee3oWzDnHojyJbArPA5s&_nc_ohc=5HKj1KbHBp4AX_ZWv12&_nc_zt=23&_nc_ht=scontent.fsub6-7.fna&oh=00_AT83sH83-DmnqcAJhZDyd9LIMfc0QcvBZTXstTtBF07k4Q&oe=6236C82F\" alt=\"May be an image of 11 people, indoor and text that says \'DINAS KEHUTANAN PROV.KALSEL KALSEL BerAKHLAK bangga manayan\'\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275841857_334271042065257_2170391039339446549_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeG4euK4lEsDiNvoRW4mX2zsTwTmxcNUACJPBObFw1QAIvrk5E_tOyIBuYad6CYVHAmWwnEcwvvtkxuQeNSBG9LQ&_nc_ohc=lAf88G-6UqoAX__WlC4&tn=2UclAcFuxqH7ASP4&_nc_zt=23&_nc_ht=scontent.fsub6-7.fna&oh=00_AT_40bQAzBlG7naKy_6vt1JeD4SG_ISQmSxR9x3CAHO2UA&oe=6236AB6D\" alt=\"May be an image of 10 people and indoor\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275856666_334270198732008_192352063971636863_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeEOXMWpf4NW3_WkaaPl22kqx4602EUclDrHjrTYRRyUOoCXFwgkg0Y396Uu_N_OPuggXGfmbSFHpF05glJZOesF&_nc_ohc=-ijssn5HUcMAX8DsAsE&tn=2UclAcFuxqH7ASP4&_nc_zt=23&_nc_ht=scontent.fsub6-1.fna&oh=00_AT-bXClEgs3jmh1UduuAQCIgGlWS180ZzV40PMjAg5p3IQ&oe=6236C127\" alt=\"May be an image of 5 people, people sitting and text\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275837038_334270318731996_3715868406406500093_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeGGBz927T7J52LYaf7npjlGdWKnpCG_4Y51YqekIb_hjgURhNP4jrL75kCpVcvrftT4qW4AoC6LFxCEOnMa7uSI&_nc_ohc=7NP_V7KzfyQAX8bCy7c&_nc_zt=23&_nc_ht=scontent.fsub6-1.fna&oh=00_AT9x1VeqVU5m6JbiykUxULealvSvyJ6frUD2k-k3nfABYA&oe=62366D79\" alt=\"May be an image of 3 people, people sitting, indoor and text\"><span style=\"font-size: 14px;\"><br></span></p>', '', 'Rabu', '2022-03-16', '07:48:08', '275742163_334270918731936_686997601177342883_n2.jpg', 22, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(743, 61, 'admin', 'Dishut Kalsel Rakor Tindak Lanjut Kajian Imbal Jasa Lingkungan Tahura', '', '', 'dishut-kalsel-rakor-tindak-lanjut-kajian-imbal-jasa-lingkungan-tahura', 'N', 'N', 'N', '<p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\">Banjarbaru - Dishut Kalsel laksanakan Rapat Koordinasi (Rakor) terkait pembahasan rencana tindak lanjut kajian imbal jasa lingkungan Tahura Sultan Adam secara virtual Zoom Meeting, Selasa (15/3).</span></p><p><span style=\"font-size: 14px;\">Dibuka Sekretaris Dishut Kalsel Bijuri, rakor dihadiri esselon 4 Dishut Kalsel, perwakilan Tahura SA serta perwakilan Global Green Growth Institute (GGGI) perwakilan Kalteng dan Kalsel di Palangkaraya.</span></p><p><span style=\"font-size: 14px;\">\"Kali ini kita akan bersama-sama membahas mengenai rencana tindak lanjut kajian imbal jasa lingkungan Tahura Sultan Adam,\" kata Bijuri.</span></p><p><span style=\"font-size: 14px;\">Dalam rakor kajian imbal jasa Taman Hutan Raya Sultan Adam&nbsp; tersebut dilakukan pembahasan mengenai usulan bentuk model bisnis mengenai pembiayaan bersama untuk dana air dan konservasi, selain itu&nbsp; rencana tindak lanjut mengenai studi cepat tentang hidrologi, studi tentang BLUD Tahura Sultan Adam, dan studi aturan IE, Kementrian, dan Kawasan Konservasi.</span></p><p><span style=\"font-size: 14px;\">Tujuan dari rakor kajian imbal jasa lingkungan Tahura Sultan Adam yang secara subtansi adalah untuk mendapatkan nilai ekonomis terhadap pemanfaatan jasa lingkungan Tahura Sultan Adam yang kemudian dimanfaatkan kembali untuk pengelolaan kelestarian Tahura Sultan Adam serta peningkatan kesejahteraan masyarakat di sekitar kawasan Tahura Sultan Adam.</span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275607240_334779318681096_5871193250133241894_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEYFJ0V-L3HGyZhC5g3svVdlI2U9xj-o1SUjZT3GP6jVPLfcHNcfx62Es86Td6wyBcc_c_dvSJlIadXd_GlxTar&amp;_nc_ohc=qfe4BQOWQPkAX-QQXf0&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT8vqnUomECHZLcb7R_yvBgAqP8fBLJfeLxl7-NA4tWvzA&amp;oe=6235C6ED\" alt=\"Mungkin gambar 4 orang dan teks\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/275664821_334779298681098_1269248749846977579_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGtWDAHR-3QOX8vsxDCtsIIWY-S97Vl42dZj5L3tWXjZ1QW2eSdsWxt9hd55e94AgEoJfM6eMp1PtTBhy7lT4Mw&amp;_nc_ohc=ErDuJiEKJgoAX8K702q&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-5.fna&amp;oh=00_AT80HN47DVKVsISaw9TnrLGy2rTTT6gapxi8xuDaBhR4xw&amp;oe=6236E16D\" alt=\"Mungkin gambar 7 orang dan teks\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275877324_334778982014463_3770034145155511863_n.jpg?_nc_cat=109&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHJby2N0JlnukpKVmHr2eWK_4h4OI4vL7j_iHg4ji8vuMfwrCua66agpBY2BrlMXZ_9E9UgHZqvpURChFuhdQFQ&amp;_nc_ohc=dzE4Qy8vzegAX-d4_E_&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT-MUN7U3Nv2ZVJyttEf0XSVVKdqEW_Wd676Vp9N_3916g&amp;oe=6236ADFD\" alt=\"Mungkin gambar 1 orang dan teks\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275966827_334779212014440_5731675406563225855_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGmbPhHy-p6PX_VTOzbr56g1o3-SHcmokHWjf5IdyaiQVqxZL_Wn9k4Y5fiIT9KPlnW1qE7_tdEiIdiUtCpSgAl&amp;_nc_ohc=QTVzp5sAsowAX9CepHx&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT___qxf5k5xlaw6uQmFGkuEGfAKfXSAvYqaAC613L6q1Q&amp;oe=62370EBF\" alt=\"Mungkin gambar 1 orang dan teks\"><span style=\"font-size: 14px;\"><br></span></p><p><span style=\"font-size: 14px;\"><br></span></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275756987_334779455347749_3232582899114625800_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEPV367UbFjqFXfUlOYjjgiFenSM8Jk5CYV6dIzwmTkJu8sd-EHVf7fbmm-jOppvaXz6RyTYEQZqwSgDsV9THbo&amp;_nc_ohc=AF66WICHC5kAX8l_lqf&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT_T9-R21gH70O5XXHuX25iLXbH_P1GrlhtALmCnLwlc9Q&amp;oe=623657BC\" alt=\"Mungkin gambar 1 orang, duduk dan teks\"><span style=\"font-size: 14px;\"><br></span></p>', '', 'Rabu', '2022-03-16', '07:51:49', '275847078_334779255347769_8655185364108001189_n.jpg', 22, 'tahura-sultan-adam,dinas-kehutanan,dishut-kalsel', 'Y'),
(744, 61, 'admin', 'Tim Sertifkator BPTH Kembali Lakukan Sertifikasi Mutu Bibit', '', '', 'tim-sertifkator-bpth-kembali-lakukan-sertifikasi-mutu-bibit', 'N', 'N', 'N', '<p>Sengayam - Tim teknis BPTH kembali melaksanakan kegiatan sertifikasi mutu bibit di dua tempat, yaitu di Persemaian KPH Cantung dan Persemaian KPH Sengayam, Jumat (11/3) lalu.</p><p>Kedua tim ini, dipimpin oleh Abdillah Rosyadi, Kasi Sertifikasi Benih BPTH, yang didampingi Ishak dan Aco, sertifikator BPTH.</p><p>Di kedua lokasi persemaian itu, bibit yang tersedia yaitu jenis sengon. Kemudian oleh tim, dilakukanlah pengujian terhadap bibit yang layak uji.</p><p>Berdasarkan hasil pengujian, secara teknis bibit sengon di kedua persemaian tersebut, layak diberikan Surat Keterangan Penilaian Mutu Bibit.&nbsp;</p><p>\"Hal ini sesuai ketentuan bila bibit yang berasal dari benih tidak bersertifikat, maka yang diberikan adalah surat keterangan ini,” tutur Abdillah.</p><p>Adapun untuk pengambilan sampel lanjut Abdillah, bibit sengon di KPH Cantung yaitu sebanyak seratus batang dari jumlah total tujuh ribu batang.</p><p>“Sedangkan dari sekitar tujuh ratus batang bibit sengon di Persemaian KPH Sengayam, yang kita ambil sampel yaitu sebanyak sepuluh batang,\" ujar Abdillah.&nbsp;</p><p>Hal ini menurutnya, sesuai ketentuan pengujian bilamana kurang dari seribu bibit, maka diambil sampel sepuluh batang. Namun apabila jumlah bibit antara seribu hingga sepuluh ribu, maka sampel yang diambil adalah seratus batang.</p><p>Kegiatan sertifikasi mutu bibit ini, merupakan upaya untuk meningkatkan kualitas bibit, khususnya di Persemaian KPH-KPH se-Kalsel. “Nantinya semua persemaian KPH yang merupakan mitra kerja kita, akan terus disertifikasi mutu bibitnya,” tutup Abdillah.&nbsp;</p><p><br></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275920445_335489258610102_1031513069463778673_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeG8uMGKn0WNHCiPE7jc8biJeuC9sGCKkVB64L2wYIqRUBXWjSkaTqL5vA98HZdAPjX7jjsFGZBsymrVtpQ5hIt3&amp;_nc_ohc=QQ0vLJXwqdYAX-fvi3e&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT_2rOZtoEDcPTg3lUfovWhxIaCi7xLf1L6AV2y1imVR8w&amp;oe=62393AB9\" alt=\"May be an image of 4 people, people standing, tree and outdoors\"></p><p><br></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/275935902_335489111943450_6221702724989606096_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEcryLhDb9kqTbziwjy-hVJG4OfWtD_eakbg59a0P95qQ74l0_SGXaHervbSwGPnjboTSsrtePyyOVGfUYz2NdX&amp;_nc_ohc=9LLXg37r0Q8AX9wkO_O&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT_XQo4naBOemCYZJAdt7Drv8XohK0zHUC7D127o3BTyzw&amp;oe=6238C183\" alt=\"May be an image of 3 people, people standing, tree, outdoors and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK Ay bangsa melayani alsel Sainei\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/275923163_335489221943439_6750374617878308147_n.jpg?_nc_cat=105&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEPYf3_zdY7VuEI2wJaY591a6D2A8Wnil9roPYDxaeKX2ED35iFuQF7pnu9APS70HaDn0hJu3oeHTD2Fde9ImEw&amp;_nc_ohc=fT1lgia_ouQAX-g3Ok9&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT9Vb1pNLk-eeaHrVcCI1BSdwUPkW6XtqHZTaK8lEQPGHw&amp;oe=6238003F\" alt=\"May be an image of 3 people and outdoors\"></p><p><br></p><p><br></p>', '', 'Jumat', '2022-03-18', '06:42:19', '275968041_335489295276765_8559990144937223550_n.jpg', 19, 'revolusi-hijau,bpth,dinas-kehutanan,dishut-kalsel', 'Y'),
(745, 61, 'admin', 'Dishut Kalsel Pelihara Hutan Pinus Banjarbaru', '', '', 'dishut-kalsel-pelihara-hutan-pinus-banjarbaru', 'N', 'N', 'N', '<p>Banjarbaru – Dinas Kehutanan Provinsi Kalimantan Selatan pelihara Hutan Kota Pinus yang terletak di Mentaos I Banjarbaru, Kamis (17/3). Hutan kota yang terletak tepat di depan SMA Negeri 2 Banjarbaru tersebut saat ini dikelola oleh Pokdarwis Banjarbaru dan dijadikan kawasan rekreasi juga ruang publik bagi warga.</p><p>Hutan kota yang luasnya 2 Ha tersebut dikenal masyarakat dengan Hutan Pinus I atau Hutan Pinus Mentaos, sebab tumbuhan di kawasan tersebut didominasi oleh pohon Pinus. Langkah awal kegiatan pemeliharaan oleh Dinas Kehutanan di hari pertama ini yaitu dengan melakukan pembersihan kawasan, penanaman beberapa batang pohon Ulin serta menginventarisir pohon di kawasan tersebut.</p><p>“Untuk kedepannya akan dilakukan pemeliharaan lebih intensif lagi, pohon yang sudah tua akan dilakukan penebangan, kemudian juga akan dilakukan peremajaan dengan menanami lahan yang masih kosong dengan tanaman Ulin, Meranti dan Pinus,” ucap Kadishut Kalsel, Fathimatuzzahra.</p><p>Saat ini Hutan Pinus Mentaos sudah dilengkapi dengan berbagai macam fasilitas yang nyaman untuk dijadikan sebagai kawasan rekreasi maupun alternatif destinasi wisata yang murah dan mudah dijangkau bagi warga. Pemeliharaan dan peremajaan tanaman akan terus dilakukan agar menjadi kawasan rekreasi yang nyaman dan aman bagi warga.&nbsp;</p><p><br></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275926092_335926155233079_6869077171574688894_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEGHEFVZ1Y22Sy6usKw9HPfCjv-VBAxnKsKO_5UEDGcq6TQjrsr7bDnS836BrFKc_IuxW2Em4Eqw0MPjcxqpXBT&amp;_nc_ohc=QcvRVrHFAlwAX_CM56g&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT97xRoguAX8EHG0cjE7xFSTo03qUOnH3uCxQp98xezeZA&amp;oe=6238EABD\" alt=\"Mungkin gambar ‎17 orang, orang berdiri, luar ruangan, pohon dan ‎teks yang menyatakan \'‎DINAS KEHUTANAN PROV. KALSEL سزر‎\'‎‎\"></p><p><br></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275987987_335926321899729_7357785028691445188_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEwKPKbM2SSJ-xVl-IUeUB8hBagFdMSSwWEFqAV0xJLBfWywffmX_4L_mWgi-V_RJLEl3JzAeh2Hurcq4PCqhD1&amp;_nc_ohc=2y5RLGpBXjgAX9phGim&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT_tWm9bWR3aVcpARUcDWfCsoNyfgmxwsbkn8XEA56InKA&amp;oe=6237F60D\" alt=\"Mungkin gambar 9 orang, luar ruangan dan pohon\"></p><p><br></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275928422_335926565233038_4652148819486060919_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGFb_c1UELmw_reDbSbZ8jzZ_TzypvnaQBn9PPKm-dpACLr9UMMQGhnQlUFilrNapDuDr_jU_MJiDxHtaltmakS&amp;_nc_ohc=QHMJGG0TJT4AX8wYwT4&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT-tD9egrDzW_luAEH-9G7rd14f83ihItim445jUKtWkgA&amp;oe=6238380C\" alt=\"Mungkin gambar 9 orang, orang berdiri, luar ruangan, pohon dan teks yang menyatakan \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK ban mel Ubang EIGRR\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-7.fna.fbcdn.net/v/t39.30808-6/275955378_335926755233019_806426675990382156_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHdL44jNKlDeUv-8XmxyiY1KarTLY1TJYkpqtMtjVMliYJgyybVJ_F7jE9v5-WdPkngJrqCrKh2CUMFbZIOFh1S&amp;_nc_ohc=SatSVwxyVaQAX9er9aY&amp;_nc_oc=AQle3hWtDMuwMvrEmz6_Wbski4-jVS_mDwson8DS1KDgI62pCjGMaWw2iNSK1VAXVZI&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-7.fna&amp;oh=00_AT_Y2dSeZov2OWIi3VFf1kAIVVz9uyVdFC5W_N58_t7EpA&amp;oe=6237EB5E\" alt=\"Mungkin gambar 5 orang, orang berdiri, luar ruangan, pohon dan teks yang menyatakan \'DINAS KEHUTANAN PROV. KALSEL SAPTAPESÃNA AMAN TERTIB BERSIH SEJUK INDAH RAMAH KENANGAN H I\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/275998127_335927255232969_2879585915659362250_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFIIi1bnpe1lmVZBXivk9IhmWFS_QeYifaZYVL9B5iJ9s7U5HeK4P4bdGE2OSgQGYyJJVrV_BrCJKLsFdd5EKk1&amp;_nc_ohc=bw8i3Gtn0OwAX8WcRRa&amp;tn=2UclAcFuxqH7ASP4&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT9SI1VDfTegwicnt-X-wS0xBrKwhcyPPr1nZ6OvsmEA7Q&amp;oe=62396855\" alt=\"Mungkin gambar 3 orang, orang berdiri, luar ruangan dan teks\"></p><p><br></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/276006901_335927301899631_9180664489175917540_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHz7mzyZVCiclDeEMfl0a74_uvtK7AiXr_-6-0rsCJev4DdEn48x05317d1KC_T6CByc4khbz5r0Trzr5TAUJ47&amp;_nc_ohc=ogFTZSIUIH4AX9zZgEz&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT8bch6xPMEnHQlxm8ZgVhpRpY8LXDsdAj6rbDBsHJObwg&amp;oe=62393F56\" alt=\"Mungkin gambar 2 orang, orang berdiri, luar ruangan dan teks\"><br></p>', '', 'Jumat', '2022-03-18', '06:45:07', '275996593_335925931899768_5998175156772058978_n.jpg', 18, 'penanaman,dinas-kehutanan,dishut-kalsel', 'Y'),
(746, 61, 'admin', 'Bagusnya Manajemen dan Leadership Kalsel Membangun Hutan Hujan Tropis, Menteri LHK Ajak FOReTIKA', '', '', 'bagusnya-manajemen-dan-leadership-kalsel-membangun-hutan-hujan-tropis-menteri-lhk-ajak-foretika', 'N', 'N', 'N', '<p>Banjarbaru -  Menteri LHK bersama Dekan Fakultas Kehutanan se-Indonesia kunjungi Taman Hutan Hujan Tropis Indonesia (TH2TI) di kawasan perkantoran Setda Prov Kalsel Banjarbaru, Kamis (24/4). Kedatangan Menteri LHK tersebut juga sebagai lanjutan rangkaian kunjungan kerja terkait penerapan forest city di IKN Nusantara sehari sebelumnya di Provinsi Kalimantan Timur.</p><p>“Tujuan dari kunjungan ini sebenarnya ialah mengajak para guru besar otoritas akademik bidang kehutanan juga praktisi komunikasi yang ada di Balikpapan untuk melihat cara kerjanya, pola-polanya untuk pembangunan forest city, sebab secara yang paling dekat itu di sini,” kata Menteri LHK Siti Nurbaya dalam sambutannya. </p><p>Kunjungan Menteri LHK ke Kalimantan Selatan ini didampingi oleh Dirjen PKTL, Dirjen PDAS HL, Dirjen Pengelolaan Hutan Lestari, Esselon II Kemen LHK, perwakilan World Bank Group, FOReTIKA, dan dihadiri oleh Gubernur Kalsel yang diwakili Sekda Prov Kalsel, Ketua DPRD Prov Kalsel, Kepala Dinas Kehutanan Prov Kalsel, dan Forkopimda Kalsel.</p><p>Dalam kunjungan tersebut, Menteri LHK beserta rombongan juga menyempatkan diri melakukan penanaman pohon dengan jenis Tengkawang, Belangeran dan Meranti Bunga. Selain itu juga dilakukan pelepasliaran burung jenis Tekukur dan Karuang di kawasan tersebut. </p><p><br></p><p><img src=\"https://scontent.fupg2-1.fna.fbcdn.net/v/t39.30808-6/277336728_340390804786614_1934019860528529267_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeELPNwtqclvPumNn90sT7hjHCHSeSvpnRMcIdJ5K-mdE2PW2E0UrvemnXnYHHEj3jRhnROp3-TukYgu_dCOK2wn&_nc_ohc=shOa5_gcniIAX9C29jL&_nc_zt=23&_nc_ht=scontent.fupg2-1.fna&oh=00_AT_A-y6SPmIKzGGoVMvLUdxTWGL0MvNGCMzx0VBdXEwHnw&oe=624562AD\" alt=\"May be an image of 2 people, outdoors and text\"><br></p><p><img src=\"https://scontent.fupg2-1.fna.fbcdn.net/v/t39.30808-6/277353417_340391144786580_5644213439717056139_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeGEBG03SaDRJkrPoIgpxCrov4cDoQ1oYji_hwOhDWhiOGgH40sUSqj4LacSz-m4N4_hWgGcTOHcgrq1vrMqvf4l&_nc_ohc=j6_NBylgLOIAX_f-EyZ&_nc_zt=23&_nc_ht=scontent.fupg2-1.fna&oh=00_AT8Vp7V-8c-f5LJVj4dLc_v5rUFmCLoNHyOcaV2AYjA-YQ&oe=6245A1EA\" alt=\"May be an image of 10 people, people standing, outdoors, tree and text that says \'DINAS KEHUTANAN PROV. KALSEL Ber kalimantan TAHUN2020 2020 TAHUN\'\"></p><p><br></p><p><img src=\"https://scontent.fupg2-2.fna.fbcdn.net/v/t39.30808-6/277346006_340391214786573_6164173766096067991_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeGhwTUInbbhXxrV7_Y45tA8k2-haoxYl3iTb6FqjFiXeEELRPvjjQnqsvTFRI1FxCZOU6RfwQTf6j39TlT8XsGw&_nc_ohc=ndQmuZt3HHgAX8GIICG&_nc_zt=23&_nc_ht=scontent.fupg2-2.fna&oh=00_AT-GP0Bf7aoZghCmAczOOw3Wfc-K5GH_UNOY2s6BpnbHBQ&oe=624535FA\" alt=\"May be an image of 8 people, people standing, outdoors and text\"></p><p><br></p><p><br></p>', '', 'Minggu', '2022-03-27', '09:25:05', '277297780_340390864786608_6737237367575762455_n.jpg', 14, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(747, 61, 'admin', 'Kunjungi Tahura SA, Menteri LHK Lepasliarkan Dua Elang Bondol', '', '', 'kunjungi-tahura-sa-menteri-lhk-lepasliarkan-dua-elang-bondol', 'N', 'N', 'N', '<p>Banjarbaru – Usai kunjungi Taman Hutan Hujan Tropis Indonesia (TH2TI), Menteri LHK beserta rombongan langsung bertolak menuju Taman Hutan Raya Sultan Adam (Tahura SA) Mandiangin. Tepat di Puncak Tengger Mandiangin, Menteri LHK Siti Nurbaya melepasliarkan dua ekor Elang Bondol (24/4).</p><p>Elang Bondol yang memiliki nama imliah Haliastur indus tersebut berjenis kelamin jantan dan berumur kurang lebih 2 tahun. Elang tersebut merupakan hewan yang diserahkan masyarakat secara sukarela kepada BKSDA Kalsel pada Pebruari lalu.</p><p>Sebelum pelepasliaran, di lokasi yang sama, Kadishut Kalsel Fathimatuzzahra memaparkan data progress serah terima keberhasilan rehab DAS di wilayah Kalsel dan date realisasi rehab DAS oleh IPPKH wilayah Tahura SA.</p><p>Kegiatan kemudian dilanjutkan dengan acara ramah tamah di Pesanggrahan Belanda Tahura SA. Menteri LHK saat diwawancara, mengatakan kepada awak media akan mendukung penuh terkait perbaikan lingkungkan di Kalsel.</p><p>\"Ada lah pasti dukungan untuk rehabilitasi hutan dan lahan,\" kata Siti.</p><p>Namun, yang lebih penting menurutnya adalah kolaborasi untuk melakukan percepatan berbaikan lingkungan di daerah itu sendiri.</p><p>\"Yang penting kolaborasinya, kalau diperlukan turun juga. Pada dasarnya Word Bank kalau halnya baik pasti akan dukung. Yang penting kan semangatnya, menejemen, kesertaan masyarakatnya,\" ucapnya.</p><p>Data terakhir Kementrian LHK tahun 2018 ada sebanyak 511.640 Hektar lahan kritis yang harus direhabilitasi di Kalsel. Adapun upaya Kalsel adalah lewat Revolusi hijau Gubernur Kalsel sejak 2017, dengan mempercepat rehab DAS dari pemegang IPPKH, penanaman hutan tanaman dan alam serta kota. Dengan target pertahun, seluas&nbsp; 30.000 Hektar yang diperkirakan tercapai hingga 20 tahun</p><p><br></p><p><img src=\"https://scontent.fupg2-1.fna.fbcdn.net/v/t39.30808-6/277364271_340402381452123_4890081103797085615_n.jpg?_nc_cat=105&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGbR0zaP_d8P1o7bX9goChkctd0Pd-yFYdy13Q937IVh0gGOzmNDx05_56GV2op9sQgEvAhQP3iTHP09E_6sKA_&amp;_nc_ohc=mVRstrk0DYAAX8DA2MB&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg2-1.fna&amp;oh=00_AT8aWLCDPf2k80FU9gJIyqSBAkx4hsydiP1O8FVtvRMA5Q&amp;oe=62443FF2\" alt=\"May be an image of 10 people, people standing, road and text\"><br></p><p><br></p><p><img src=\"https://scontent.fupg2-2.fna.fbcdn.net/v/t39.30808-6/277178851_340401701452191_5347999521745530239_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFL3PZKceI6pDu9uaRgHAiGjOi_d5eCcIuM6L93l4Jwi-gca1ljx9kA_QPRuYt-RX3falPDj5iDasIcmeYjs6xd&amp;_nc_ohc=0fw1K6fzedQAX9css5I&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg2-2.fna&amp;oh=00_AT_o5PkRvdzxjNPwwes5YdSOj7Lu9OshgzDu3-KDGHH3zA&amp;oe=6243E995\" alt=\"May be an image of 6 people, people standing, outdoors and text\"></p><p><br></p><p><img src=\"https://scontent.fupg2-1.fna.fbcdn.net/v/t39.30808-6/277346255_340402354785459_1508016792123805487_n.jpg?_nc_cat=102&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFpEY2WwUJqMH5L0u09hFzWAycwGN_0zNQDJzAY3_TM1JCwoQZn-sqJ_267YBWw3r1Jk08F88NflRikKi8CtEr5&amp;_nc_ohc=LqUt69IlpdQAX-VCdyk&amp;_nc_oc=AQnt5dapjZupW4hj_iZgq_Csou6djlvqqVMOcM8PybmhUmkLsxT6DDQAI4h04oraUUU&amp;tn=Scr20AvjaTElGuIG&amp;_nc_zt=23&amp;_nc_ht=scontent.fupg2-1.fna&amp;oh=00_AT_F5Mx2o08FXvyVpWcz6Vjjm1l3hcqdNU77cVmfBOlqUg&amp;oe=62442DE2\" alt=\"May be an image of 9 people, outdoors and text\"></p><p><br></p><p><br></p>', '', 'Minggu', '2022-03-27', '09:27:33', '277251571_340402534785441_8040893593515291716_n.jpg', 16, 'tahura-sultan-adam,dinas-kehutanan', 'Y'),
(748, 61, 'admin', 'Komisi II DPRD Kabupaten Tabalong Kunjungi Dishut Kalsel', '', '', 'komisi-ii-dprd-kabupaten-tabalong-kunjungi-dishut-kalsel', 'N', 'N', 'N', '<p>Banjarbaru - Dishut kalsel mendapat kunjungan Komisi II DPRD Kabupaten Tabalong untuk Koordinasi Kerja. Kunjungan tersebut terkait pembahasan mengenai pemanfaatan kawasan oleh adat kebiasaan masyarakat setempat . Koordinasi tersebut berlangsung di Ruangan Aula Rimbawan 3 Dishut Prov Kalsel dengan tetap menerapkan protokol kesehatan, Senin (28/3).&nbsp;</p><p>Rapat koordinasi tersebut dibuka Sekretaris Dishut Kalsel Bijuri didampingi seluruh Esselon 3 dan Esselon 4 Bidang PPH dan Bidang PMPPS. Rapat tersebut dihadiri Ketua Komisi II DPRD Kabupaten Tabalong Muhammad Hudianor dan wakil Ketua Komisi I DPRD Kabupaten Tabalong Jurdi bersama jajarannya, turut hadir Kepala KPH Tabalong Heriyadi Joesri bersama Kasi Pengamanan Hutan KPH Tabalong Zainal Abidin.</p><p>“kaitannya dengan hutan adat, kami akan memberikan satu gambaran mengenai hukum adat melalui penjelasan dipaparan nanti yang dibawakan Pak Gede Selaku Kabid PMPPS,” kata Bijuri.</p><p>Ketua DPRD Komisi II Kabupaten Tabalong Muhammad Hudianor, dalam kesempatannya di Koordinasi Kerja tersebut menyampaikan tujuan kedatangannya terkait pembahasan mengenai pemanfaatan Kawasan oleh adat kebiasaan masyarakat setempat.</p><p>“adapun tujuan dan kedatangan kami kesini ingin melakukan koordinasi dan konsultasi terkait pemanfaatan kawasan oleh adat kebiasaan masyarakat setempat, agar kami nantinya bisa memberikan pemahaman kepada masyarakat kami mengenai masalah hutan yang ada di Kabupaten Tabalong dan tidak menyalahi aturan yang berlaku,” kata Muhammad Hudianor.</p><p>Dalam rapat tersebut Kabid PMPPS I Gede Arya Subhakti, menjawab sekaligus memaparkan mengenai pemanfaatan kawasan oleh adat kebiasaan masyarakat setempat.</p><p>“Terkait tentang pemanfaatan hutan adat, selama masyarakat hukum adatnya belum dibentuk atau ditetapkan maka pemanfaatan kawasan hutan ini masih bisa dilakukan oleh masyarakat adat dengan skema hutan desa HKm (Hutan Kemasyarakatan), “ Kata I Gede Arya Subhakti.</p><p>Dalam koordinasi kerja Komisi II DPRD Kabupaten Tabalong tersebut juga disampaikan penjelasan mengenai Masyarakat Hukum Adat, Penetapan Hutan Adat, Pengakuan Masyarakat Hukum Adat, Regulasi Masyarakat Hukum Adat, Skema Perhutanan Sosial dan Tahapan Penetapan Status Hutan Adat oleh Dinas Kehutanan Provinsi Kalsel</p><p><br></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/277553219_342840454541649_8201311067967043555_n.jpg?_nc_cat=104&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFzcoTskxYMVQ7FqQc-jCZIubyXlN9z6bO5vJeU33Pps3l7iqMHlXL9YjyT9O9UoQydCckAIiabup5TnKpluSm0&amp;_nc_ohc=Uv2R4hVQvk8AX-B7Ufp&amp;_nc_oc=AQkUUAUUC-Uqoj1SQG_tuUAgSdWS17HowgBxQ3cV7_ID1Te5nOV5ylLrc7r91sR0z8s&amp;tn=Scr20AvjaTElGuIG&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT9nhEa0RpYnIeMO_8bXuVKRwE3OEtCuSFnv16fzwsZLAg&amp;oe=624FF12C\" alt=\"May be an image of 7 people, people sitting, indoor and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAK -\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/277168042_342841277874900_8421723390410617333_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGuYn7oqcyYv89yh5se8pf0h-eZSUjQfLeH55lJSNB8t6OlO1FStU7T5iy2esWjkZD5ZIR5a7JN9UQeSbfM0jJA&amp;_nc_ohc=R5PBoYhgHIQAX_WrUiK&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-5.fna&amp;oh=00_AT9_Ih2WfLC5r0iM6UYx1rocdMoHcKqmHLdpYrpLF9b8HA&amp;oe=624F480F\" alt=\"May be an image of 4 people, people sitting, people standing and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHL bangga\'\"></p><p><br></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/277563934_342839747875053_8573388574760756232_n.jpg?_nc_cat=106&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEZSigZWOLxhia4e_tW-nEYha4M5InAb2-FrgzkicBvb6q6LvM4LkcGW7ovo7p9E8YXwBFz6D0ZQD0jynE9ZGXz&amp;_nc_ohc=7kh6486eEzYAX_rUr5h&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT_ds9dBujwjLSFAZ2ZDe_Met0VKZzFdUxgH6GaGCcPS3A&amp;oe=624FF66B\" alt=\"May be an image of 6 people, people sitting, indoor and text\"><br></p>', '', 'Senin', '2022-04-04', '08:32:12', '277557702_342840397874988_2291478292841351479_n.jpg', 14, 'kphtabalong,dinas-kehutanan,dishut-kalsel', 'Y');
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
INSERT INTO `berita` (`id_berita`, `id_kategori`, `username`, `judul`, `sub_judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `utama`, `isi_berita`, `keterangan_gambar`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`, `tag`, `status`) VALUES
(750, 61, 'admin', 'Media Nasional Kunjungi dan Review Program FIP di KPH Tanah Laut', '', '', 'media-nasional-kunjungi-dan-review-program-fip-di-kph-tanah-laut', 'N', 'N', 'N', '<p>Banjarbaru – Plt. Kadishut Prov Kalsel Fathimatuzzahra terima kunjungan wartawan Nasional yang akan Ke KPH Tanah Laut di Aula Rimbawan 1 Dishut Prov Kalsel, Senin (4/4). Kunjungan Tim Wartawan dari Jakarta tersebut terkait peliputan kegiatan Forest Investment Program (FIP) II yang bertemakan program investasi hutan untuk mempromosikan pengelolaan sumber daya alam berbasis masyakarakat secara berkelanjutan dan pengembangan kelembagaan. Turut hadir Kepala BPKH Wilayah V Banjarbaru Safrudin Zen dan Kepala KPH Tanah Laut Rahmad Riansyah.</p><p>Dalam diskusi, Fathimatuzzahra menjelaskan bahwa jika membicarakan revolusi hijau, itu tidak selalu dapat dikaitkan hanya pada kegiatan penanaman dan pemeliaraan tanaman saja, tetapi juga terkait ekonomi masyarakat. “Yang sekarang kita lakukan kaitannya dengan program revolusi hijau itu dari sisi hulu nya kita lakukan penanaman kemudian di tengahnya kita lakukan mekanisme Suplay dan Feedback antara Kelompok Tani Hutan dan industri yang kita fasilitasi pemasarannya,” terang Aya, ia biasa disapa.&nbsp;</p><p>Itu semua sama halnya dengan dikegiatan program FIP ini, “kita juga memfasilitasi baik dari pembinaan dan penyuluhan serta&nbsp; dari segi pemasarannya kita akan memfasilitasi dengan menggunakan Aplikasi SIFORESTKA (Sistem Informasi Kehutanan Kalimantan Selatan)\" ujar Aya menambahkan.</p><p>Mashut, selaku perwakilan dari program koordinator unit FIP Indonesia dalam kesempatannya menyampaikan tujuan kedatangannya ialah dalam rangka kunjungan jurnalistik bersama wartawan nasional yang terdiri dari perwakilan Media Indonesia, ANTARA, Humas KLHK, dan Tropis Indonesia.</p><p>\"Tujuan TIM FIP II kesini adalah dalam rangka kunjungan jurnalistik, jadi kita mengajak teman-teman media (Wartawan Nasional) untuk kita coba publikasikan apa saja yang sudah dikerjakan Kelompok Tani Hutan Tanah Laut yang diintervensi oleh Forest Investment Program II,\" ucap Mashut.</p><p>Direncanakan, tim wartawan nasional tersebut akan mengunjungi 5 Kelompok Tani Hutan (KTH) binaan KPH Tanah Laut terkait kegiatan FIP II, mulai dari KTH Gunung Birah, KTH Harapan Baru, KTH Batu Kura, KTH Subur Makmur, sampai KTH Pinang Muda dari tanggal 4 hingga 6 Maret 2022 untuk menjelajahi dan mempublikasikan hasil kerja dari 5 KTH tersebut</p><p><br></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/277752965_347103400782021_5058543870648392274_n.jpg?_nc_cat=101&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeESpqM-DZyCoB57Soq23CmJt397Hdkly6W3f3sd2SXLpYKMi-cqkEd0XZYm8ulyjc84UzyK-38xZVRatmX7QaPU&amp;_nc_ohc=9EcUMLemPykAX9d2DfR&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT92uSaCZ5W61iZC_z0tcTvYpJ3gjOB2xZaMFaTOuhH_Vg&amp;oe=6261653A\" alt=\"May be an image of 7 people and text\"></p><p><br></p><p><img src=\"https://siforestka.co.id/asset/images/image26.png\" style=\"width: 960px;\"></p><p><br></p><p><br></p>', '', 'Senin', '2022-04-18', '07:29:30', '277758195_347103357448692_3288494367951544980_n.jpg', 4, 'hasil-hutan-bukan-kayu,kphtanahlaut,dinas-kehutanan,dishut-kalsel', 'Y'),
(751, 61, 'admin', 'Rapat Pansus Pembahasan LKPj, Dishut Penuhi Undangan Komisi II DPRD Kalsel', '', '', 'rapat-pansus-pembahasan-lkpj-dishut-penuhi-undangan-komisi-ii-dprd-kalsel', 'N', 'N', 'N', '<p>BANJARMASIN – Dinas Kehutanan Provinsi Kalimantan Selatan memenuhi undangan Panitia Khusus (Pansus) Pembahas Laporan Pertanggungjawaban Kepala Daerah Prov Kalsel dalam rangka rapat pembahasan mengenai capaian-capaian kinerja pada Tahun Anggaran 2021. Plt. Kepala Dinas Kehutanan Fathimatuzzahra hadir dalam rapat tersebut dengan didampingi beberapa pejabat esselon Dishut Prov Kalsel (27/12).</p><p>Rapat yang dilaksanakan di ruang rapat komisi II Lt. 4 gedung A DPRD Prov Kalsel tersebut juga dihadiri oleh mitra kerja SKPD lingkup sektor ekonomi dan keuangan, Biro Perekonomian Setda Prov Kalsel, Dinas Tanaman Pangan &amp; Holtikultura, Dinas Perkebunan &amp; Peternakan, Dinas Perikanan &amp; Kelautan, serta Dinas Ketahanan Pangan Prov Kalsel. Dengan tetap mengedepankan protokol kesehatan, masing-masing SKPD dihadiri 3 (tiga) orang sebagai perwakilan.&nbsp;</p><p>Dalam rapat tersebut Dishut menyampaikan laporan capaian-capaian program dan kegiatan dari sektor kehutanan yang sudah dicapai sepanjang tahun 2021.</p>', '', 'Senin', '2022-04-18', '07:31:25', '277990615_348232390669122_6272173080236188272_n.jpg', 5, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(752, 61, 'admin', 'Terima Laporan Masyarakat, Polhut Berhasil Amankan Kayu Illegal', '', '', 'terima-laporan-masyarakat-polhut-berhasil-amankan-kayu-illegal', 'N', 'N', 'N', '<div>Tanjung – Sekitar 40 potong kayu berjenis Meranti Campuran berhasil diamankan satuan Polisi Hutan (polhut) Kesatuan Pengelolaan Hutan (KPH) Tabalong di Kecamatan Bintang Ara, Senin (11/4). Kayu tersebut diduga hasil dari kegiatan illegal logging dari wilayah kawasan hutan RPH Panaan yang coba disusupkan melalui jalur sungai.</div><div>Kegiatan pengamanan tersebut merupakan pulbaket atas dasar laporan masyarakat akan adanya kegitan pengangkutan kayu hasil illegal logging lewat jalur sungai. Setelah tim patroli melakukan ground check, benar didapati adanya rakit kayu berbagai jenis dan ukuran di sungai Dusun Mantuyup Desa Bintang Ara yang langsung diamankan oleh tim .</div><div>“Mengingat situasi dan kondisi di lapangan yang kurang kondusif, kayu-kayu ini langsung diamankan dan diangkut ke kantor KPH Tabalong. Secepatnya juga akan kami bawa ke Banjarbaru (kantor polhut Dishut),” ucap Kepala Seksi Perlindungan Hutan KPH Tabalong, Aris Setiawan.</div><div>Barang bukti kayu temuan tersebut sudah diangkut dengan menggunakan truk untuk dibawa dan diamankan oleh tim ke Banjarbaru. Malam harinya, kayu tersebut sudah berada di kantor Polhut Dinas Kehutanan yang berada di Gang Petai Banjarbaru, untuk kemudian diukur dan diperiksa oleh petugas yang berwenang.</div><div>Plt. Kadishut Kalsel, Fathimatuzzahra mengatakan, seringnya dilaksanakan patroli rutin pengamanan hutan diharapkan mampu mengurangi tindak kejahatan illegal logging di wilayah kawasan hutan Kalimantan Selatan.</div><div><br></div><div><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/278410671_351933146965713_7815463261265527159_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=730e14&amp;_nc_eui2=AeFt5AKZ4NdKZE0JVzcmedO9RDzQYrSSRk5EPNBitJJGTpzr1SeAKiSAqkEqoiAQH0nDK_rbE6GQTOiIpU9VP_FQ&amp;_nc_ohc=iSvW-E2cIesAX-3rNG_&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-5.fna&amp;oh=00_AT9T0RVpUaUo6cXRP7RkAPciASNa5HMENrGYVPnZjP0c_A&amp;oe=6260BA2A\" alt=\"May be an image of 7 people, people standing, body of water and text\"></div><div><br></div><div><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/277783147_351933170299044_786137379347879620_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=730e14&amp;_nc_eui2=AeFyHdn_fSsdlgktigycCBXhz9mHy0rQHTrP2YfLStAdOqH0uMFjiKx7jP1npE-EIlXRsv4joYh5skMMjD7gixOE&amp;_nc_ohc=NIbZvsv_ZSoAX-74hxB&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-5.fna&amp;oh=00_AT_Xhr4RI4IGcPexYYT1ZKdi5n02jhbjD6w1aLEzUWh1cw&amp;oe=62629669\" alt=\"May be an image of tree and text that says \'DINAS KEHUTANAN PROV. KALSEL BerAKHLAKmela melayani BerAKHLAK bangsa HUAWEI Mate 30 Pro SuperSensing Cine Camera LECA\'\"><br></div>', '', 'Senin', '2022-04-18', '07:34:03', '277811639_351932886965739_1267272181840263184_n.jpg', 7, 'polhut,kphtabalong,dinas-kehutanan,dishut-kalsel', 'Y'),
(753, 61, 'admin', 'Dukung Misi Dagang Dan Investasi Kalsel-Jatim, Dishut Kalsel Dan Dishut Jatim Tandatangani MoU ', '', '', 'dukung-misi-dagang-dan-investasi-kalseljatim-dishut-kalsel-dan-dishut-jatim-tandatangani-mou-', 'N', 'N', 'N', '<p>Banjarmasin - Dinas Kehutanan Provinsi Kalimantan Selatan turut serta dalam kegiatan Misi dagang dan Investasi antara Pemerintah Provinsi Kalimantan Selatan dan Pemerintah Provinsi Jawa Timur yang diselenggarakan di Galaxy Hotel Banjarmasin, Rabu, 13 April 2022.</p><p>Kalsel memiliki sejumlah sektor unggulan, diantaranya pertambangan, pertanian, kehutanan, perikanan dan perkebunan yang saat ini sudah memberikan kontribusi nyata terhadap pertumbuhan ekonomi daerah dan dengan kehadiran program kemitraan lewat misi dagang ini diharapkan dapat memberikan keuntungan bagi kedua daerah, bukan hanya di sektor perdagangan dan industri, tetapi juga berdampak pada peningkatan sumber daya manusia (SDM).</p><p>Gubernur Jawa Timur Khofifah Indar Parawansa mengemukakan, meski program ini baru di mulai namun perdagangan kedua daerah ini sudah terjalin sejak lama, yang mana produk Jawa Timur banyak diminati pedagang maupun pengusaha asal Kalsel, begitu pula sebaliknya antara kedua daerah.</p><p>Dalam rangka memperkuat jaringan perdagangan, kedua Pemerintah Provinsi akan saling menguatkan ditandai dengan penandatanganan Perjanjian Kerjasama antar organisasi dan perangkat daerah (OPD) serta unsur terkait lainnya di bidang industri, perdagangan dan investasi.</p><p>Dinas Kehutanan Provinsi Kalimantan Selatan dalam kesempatan yang baik ini juga turut andil dalam beberapa kegiatan dan misi dagang serta investasi ini, dimana juga secara bersama-sama dengan Dinas Kehutanan Prov. Jawa Timur melaksanakan penandatanganan perjanjian kerjasama saat acara berlangsung.</p><p>Usai acara saat dimintai tanggapannya, Plt. Kadishut Kalsel Fathimatuzzahra mengatakan misi dagang dan investasi ini diharapkan dapat meningkatkan konektivitas antar daerah, “dengan adanya hubungan kerjasama ini diharapkan mampu memberi dampak positif terhadap kemajuan ekonomi daerah di masa depan,” ujar Fathimatuzzahra.&nbsp;</p><p>Beberapa Ruang Lingkup Perjanjian Kerja Sama antara Dishut Kalsel dan Dishut Jatim ini, meliputi :</p><p>- Pelaksanaan pertukaran data dan informasi bidang kehutanan;</p><p>- Pemasaran produk hasil hutan kayu;</p><p>- Pemasaran produk hasil hutan bukan kayu antara lain madu, pasak bumi, kopi, gula aren, kayu manis, kemiri, karet, jengkol, sereh wangi, beras merah, porang, empon-empon dan produk turunannya.&nbsp;</p><p>- Temu usaha sektor kehutanan;</p><p>sharing knowledge Kelompok Usaha Perhutanan Sosial, pengendalian Karhutla dan perubahan iklim, pengelolaan Tahura, dan Kawasan Ekosistem Essensial;&nbsp;</p><p>- Pengendalian peredaran hasil hutan;</p><p>- Pertukaran satwa dan tumbuhan.</p><p><br></p><p><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/278398849_352660460226315_1534360060363946291_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGUHRhCKWHg0_EJkot3G6iSXHCKWOwdfcNccIpY7B19w7v1Xh-2BevzEqKglxszZYrYhommlcExtwzVpib1jckq&amp;_nc_ohc=dfkMdm9nZ1gAX-dxQ4-&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT8dfcuyIaGQX6qYqntAHFpv8O4jM5OpqTXGqjyyIr1Mxg&amp;oe=62629F22\" alt=\"May be an image of 11 people and people standing\"></p><p><br></p><p><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/278448104_352660396892988_8236108392070855432_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeHlUUFsd40E7ll_eW48HZxeHr-HRyxK-F8ev4dHLEr4X5j2IHaiKRSOOE_r5qGXz0B2RY8J-xOMi1IxWVi34Fsp&amp;_nc_ohc=E88xoep3V0IAX_LgWM2&amp;tn=2UclAcFuxqH7ASP4&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT-QGLNop8qZTmzpFoFlRfdve8NAl-C9gfQzt82mBkp60w&amp;oe=62621C6E\" alt=\"May be an image of text that says \'LYWOoD PLYWOOD FLYWQOR MISI DAGANG PROVINSI KALIMANTAN SELATAN PROVINSI JAWA TIMUR DENGAN TAHUN 2022 BASIRIH INDUSTRIAL NAMA USAHA GANANG DZIKRY RAMADHANI PEMILIK PLYWOOITAN SELATAN KOMODITI DAERAH 0812 LIMANTAN 0866 NO.\'\"></p><p></p><p><br></p><p><img src=\"https://scontent.fsub6-1.fna.fbcdn.net/v/t39.30808-6/278383398_352660303559664_638984613320474625_n.jpg?_nc_cat=110&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFeR_yE-EAf5DkOGRtiqsmct0BunI1tk963QG6cjW2T3qC_vZJr1WHVnYUrvZNuq-vu3RY_M0Na3T_0zqvdiUvr&amp;_nc_ohc=WNzIOB7DHsIAX8monKg&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-1.fna&amp;oh=00_AT-_4pATKtfSq0SJp_jQx9RiB349oMRBtjsQ7POExb5hrg&amp;oe=6260A914\" alt=\"May be an image of 3 people, food and indoor\"></p><p><br></p><p><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/278422697_352660493559645_3937288701569240838_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGE77s_VQRav-6Kuje83lWqZWFisp1COJplYWKynUI4mp9XxjMXEutH-xyqjrR28kQDFu4Tv_tAQ0P-to5F0Bhq&amp;_nc_ohc=Kay4ztSSQeoAX9KQ06j&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT-TNTRyxArMyz0thKkgcMqAlOUb1aSUQn6HVhB-XFFC9A&amp;oe=6261397F\" alt=\"May be an image of 6 people, people standing and indoor\"><br></p><p><br></p>', '', 'Senin', '2022-04-18', '07:36:30', '278468800_352660286892999_499278285591349170_n.jpg', 6, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(754, 61, 'admin', 'Gubernur Lantik 16 Pejabat Eselon II di Lingkungan Pemprov Kalsel, Fathimatuzzahra Jadi Kadishut', '', '', 'gubernur-lantik-16-pejabat-eselon-ii-di-lingkungan-pemprov-kalsel-fathimatuzzahra-jadi-kadishut', 'N', 'N', 'N', '<div>Banjarmasin - Gubernur Kalimantan Selatan, Sahbirin Noor, memimpin Pengambilan Sumpah dan Pelantikan 16 Pejabat Tinggi Pratama (Eselon II) di lingkungan Pemerintah Provinsi Kalimantan Selatan, di Gedung Mahligai Pancasila, Kamis (14/4/2022).&nbsp;</div><div>Prosesi Pelantikan dan Pengambilan Sumpah Jabatan bagi 16 Kepala Organisasi Perangkat Organisasi (OPD) Pemerintah Provinsi Kalimantan Selatan diawali dengan pembacaan Surat Keputusan Gubernur Kalimantan Selatan.</div><div>Dalam sambutannya, Sahbirin meminta kepada semua kepala OPD Pemprov Kalsel untuk benar-benar memahami tugas dan fungsi yang melekat dalam SKPD yang dipimpin.</div><div>“Pahami dan kaji program-program secara mendalam, cermat dan teliti, serta pastikan korelasi nya dengan sasaran pembangunan, tentunya sesuai dengan RPJMD provinsi Kalimantan Selatan Tahun 2021-2026,” ujarnya.</div><div>Gubernur yang akrab disapa Paman Birin tersebut juga mengucapkan selamat bekerja kepada para pejabat yang dilantik, dan berharap agar semuanya memberikan dedikasi, loyalitas dan kinerja yang tinggi serta mampu beradaptasi dengan suasana dan lingkungan kerja yang baru.</div><div>Salah satu pejabat yang dilantik ialah Hj. Fathimatuzzahra, S.Hut, MP. Fathimatuzzahra atau biasa disapa Aya, dilantik menjadi Kepala Dinas Kehutanan Provinsi Kalimantan Selatan yang sebelumnya menjabat sebagai Kepala Bidang Pengelolaan DAS dan RHL pada Dinas Kehutanan Prov Kalsel.</div><div>Saat ditemuin usai acara pelantikan, Aya mengatakan bahwa akan serius dalam melaksanakan pembangunan kehutanan, sebagaimana diamanatkan dalam RPJMD.</div><div>“Saat ini kita sudah membuat Rencana Strategis (Renstra) Tahun 2021-2026 sebagai penjabaran RPJMD, dalam Renstra tersebut kita telah menetapkan tujuan dan sasaran yang secara garis besar untuk mencapai kelestarian hutan sekaligus mengoptimalkan manfaat hutan bagi daerah dan kesejahteraan masyarakat,” ujar Aya.</div><div>Sahbirin juga mengharapkan bahwa pendelegasian tugas dan tanggung jawab yang dipercayakan kepada sadara-saudara sekalian tentunya dapat diaplikasikan dengan segera.</div><div>“Dedikasikan diri anda dalam pengabdian yang terbaik, yang mampu menghantarkan banua kita menuju cita-cita yang mulia, yaitu Kalimantan Selatan yang maju (Kalsel Maju),” ucap Paman Birin.</div><div><br></div><div><img src=\"https://scontent.fsub6-4.fna.fbcdn.net/v/t39.30808-6/278585190_353156450176716_991752024591878456_n.jpg?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeFkfy9TYg4K1Og61eMiW5mBeNDSQri0Mb940NJCuLQxv4pDdvZ4kcVSFxF__u8qbtzfIpedeWzeqt_ES2so645g&amp;_nc_ohc=ENhgEbM5EUoAX-W-Waf&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-4.fna&amp;oh=00_AT-G5e0zg93gTAD69ojmQ48MPzXtsw60Wfxs1HS409xdTg&amp;oe=62615F34\" alt=\"May be an image of 12 people, people standing and indoor\"></div><div><br></div><div><img src=\"https://scontent.fsub6-3.fna.fbcdn.net/v/t39.30808-6/278528885_353156720176689_3305250126021965161_n.jpg?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEY95garBdzvYKjqe-SdW1l7BJfeMaJSiDsEl94xolKIMd1PT0MdFCYxL68X0qDpbly1dPvji8w0rc0OyuGhbfG&amp;_nc_ohc=5ufVlVA1td8AX_ilw0H&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-3.fna&amp;oh=00_AT-_3-d9bKv0h4KpfEWHQ4zAp4lVtr0Mr0ObCOSXxBk3cg&amp;oe=6260B8D3\" alt=\"May be an image of 14 people, people standing and indoor\"></div><div><br></div><div><br></div>', '', 'Senin', '2022-04-18', '07:38:18', '278509671_353156443510050_2285175568282983551_n.jpg', 6, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(755, 61, 'admin', 'Susun RKPD 2023, Dishut Kalsel Laksanakan Asistensi Penginputan RKPD Pada Aplikasi SIPD', '', '', 'susun-rkpd-2023-dishut-kalsel-laksanakan-asistensi-penginputan-rkpd-pada-aplikasi-sipd', 'N', 'N', 'N', '<div>BANJARBARU – Dinas Kehutanan Provinsi Kalsel laksanakan rapat Asistensi Penginputan RKPD (Rencana Kerja Perangkat Daerah) pada Aplikasi SIPD&nbsp; (Sistem Informasi Perangkat Daerah) Tahun 2023. Dilaksanakan di Aula Rimbawan 3 Dishut Kalsel, kegiatan tersebut dilaksanakan&nbsp; dalam rangka kelancaran pelaksanaan penginputan RKPD lingkup Dinas Kehutanan Provinsi Kalimantan Selatan yang diikuti oleh KSBTU bersama para operator KPH lingkup Dinas Kehutanan Prov Kalsel, operator BPTH dan Tahura Sultan Adam. Kegiatan tersebut diasistensi operator dari Bappeda Provinsi Kalsel Ardi. Kamis (14/4).</div><div>Dibuka Kasubag Perencanaan dan Pelaporan Dishut Kalsel Syarif Rachman, rapat ini bertujuan untuk kelancaran asistensi penginputan data dan komponen dalam aplikasi SIPD.</div><div>&nbsp;“Rapat Asistensi Pengimputan SIPD tahun Anggaran 2023 ini dilakukan agar menemukan kesepahaman&nbsp; dalam pengisian data/penginputan data oleh para operator dalam menyelesaikan penginputan SIPD yang sudah ditargetkan,” tutur Syarif.</div><div>Ardi operator dari Bappeda Provinsi Kalsel mengatakan, dengan asistensi ini diharapkan para operator lingkup Dishut Kalsel dapat melakukan penginputan secara baik dan benar serta selesai sesuai jadwal yang sudah ditargetkan. “Dalam kegiatan ini bertujuan untuk memberikan informasi dan tata Kelola keuangan pemerintahan yang efektif dan efisien serta asistensi penginputan SIPD yang benar,” ujar Ardi.</div><div>Penginputan data ke aplikasi SIPD ini merupakan kewajiban masing-masing SKPD. Ini agar data yang masuk lebih akurat dan terjaga. Aplikasi SIPD sendiri, merupakan sistem terintegrasi sebagai amanah dari Permendagri Nomor 70 Tahun 2019 tentang SIPD</div><div><br></div><div><img src=\"https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/278569378_353222283503466_4430408246045960495_n.jpg?_nc_cat=100&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeEdXH79OzSxQAM8EKi899pNCid_d2F43BoKJ393YXjcGhAySTWMd7Uxk5TTbu7uXq_cbLKk0XuOWX8n6eLKcHfW&amp;_nc_ohc=C9n5kFaZ6DwAX-kWfy1&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-6.fna&amp;oh=00_AT85SXsfQy_wHy6n_8yNPGlrmO-M7h3M7FSweVOxRFu7WA&amp;oe=62629DCF\" alt=\"Mungkin gambar 6 orang, orang duduk, kerudung dan teks\"></div><div><br></div><div><img src=\"https://scontent.fsub6-5.fna.fbcdn.net/v/t39.30808-6/278461050_353222120170149_6719360448474019693_n.jpg?_nc_cat=111&amp;ccb=1-5&amp;_nc_sid=8bfeb9&amp;_nc_eui2=AeGJ5U-3n_I3sb2gwoLGC2hbYGBV_tqPIrlgYFX-2o8iubcm-7lrB-sPnG04sIgdQJ0JzHL_Vd769egtk7JVoHij&amp;_nc_ohc=CpczdTK9OkkAX9s94B5&amp;_nc_zt=23&amp;_nc_ht=scontent.fsub6-5.fna&amp;oh=00_AT_911BqDA0ks7XUGhA6A2H4QXPUqhCc3GDYCF79xpRJDw&amp;oe=62614CF7\" alt=\"Mungkin gambar 3 orang, orang duduk, orang berdiri dan teks\"><br></div>', '', 'Senin', '2022-04-18', '07:40:30', '278582535_353222160170145_58291781667445_n.jpg', 21, 'dinas-kehutanan,dishut-kalsel', 'Y'),
(756, 61, 'admin', 'Selamatkan Bumi Antasari Sedari Dini, Kadishut Dialog Hari Bumi Bersama BPost', '', 'https://youtu.be/YYFE4y9URJU', 'selamatkan-bumi-antasari-sedari-dini-kadishut-dialog-hari-bumi-bersama-bpost', 'N', 'N', 'N', '<p>Banjarmasin - Kepala Dinas Kehutanan Prov Kalsel Fathimatuzzahra menjadi pembicara pada acara dialog BTalk di studio redaksi Banjarmasin Post gedung BPost lantai 4, Jumat (22/4/2022). Acara yang juga disiarkan langsung di akun youtube, instagram dan facebook Banjarmasinpost tersebut membahas tentang lingkungan dan peran serta Dinas Kehutanan dalam rangka memperingati Hari Bumi yang bertepatan pada hari ini.</p><p>Dalam dialog yang bertajuk Selamatkan Bumi Antasari Sedari Dini tersebut beliau menegaskan bahwa Hari Bumi ini mestinya kita peringati setiap hari, bukan hanya hari ini.&nbsp;</p><p>“Kalau bagi kami hari bumi ini setiap hari, jadi tidak hanya seremonial saja, sebab kami rutin melalaksanakan penanaman maupun pemeliharaan tanaman,” ujar Fathimatuzzahra dalam dialognya.&nbsp;</p><p>Dinas Kehutanan juga turut mendukung dengan pemberian akses dalam pengelolaan hutan kepada masyarakat melalui perhutanan sosial yang bisa dimanfaatkan dengan sistem agroforestri antara tanaman kehutanan, tanaman semusim, hingga peternakan, sehingga masyarakat dalam dan sekitar hutan dapat sejahtera.</p><p>Harapannya untuk mewujudkan hutan lestari masyarakat sejahtera harus berkolaborasi dengan semua pihak baik itu instansi pemerintah maupun swasta, “semua stakeholder di Kalimantan Selatan harus turut aktif berperanserta menyukseskan gerakan revolusi hijau yang dicanangkan Gubernur Kalimantan Selatan di semua kegiatan dalam rangka rehabilitasi lahan kritis di Kalsel, sebab perbaikan lahan kritis juga turut mendukung upaya menurunkan potensi banjir maupun global warming,” pesan Fathimatuzzahra.&nbsp;</p><p>Di akhir acara, Dishut melalui Fathimatuzzahra mengajak semua unsur dan semua pihak untuk menjaga lingkungan sekitar kita untuk Kalsel yang lebih baik, “bersama kita bisa memperbaiki lingkungan kita,” tutup Fathimatuzzahra.</p><p>Selengkapnya, dialog ini secara penuh dapat anda saksikan di seluruh akun youtube, instagram dan facebook Banjarmasinpost</p>', '', 'Minggu', '2022-04-24', '09:17:08', '279073209_357974409694920_2037136998432395723_n.jpg', 25, 'dinas-kehutanan,dishut-kalsel', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `id_download` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_file` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jenis` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `hits` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id_download`, `judul`, `nama_file`, `jenis`, `tgl_posting`, `hits`) VALUES
(36, 'Permen LHK - Perencanaan, Perubahan Peruntukan & Fungsi, Penggunaan Kawasan Hutan (P.7 Tahun 2021)', 'P_7-2021-Perencanaan,_Perubahan_Peruntukan_Fungsi,_Penggunaan_KH.pdf', 'Peraturan Menteri LHK', '2021-11-02', 0),
(46, 'Tutorial SIFORESTKA', 'MANUAL_PENGGUNAAN_SIFORESTKA.pdf', 'Tutorial', '2022-02-07', 8),
(47, 'SK 306 - Penetapan Lahan Kritis Nasional Tahun 2018', 'SK__306_Penetapan_Lahan_Kritis_Nasional.pdf', 'Surat Keputusan Menteri LHK', '2022-04-21', 1),
(35, 'Undang Undang Cipta Kerja', 'UU_11_2020_Cipta Kerja.pdf', 'Undang-Undang', '2021-11-02', 0),
(37, 'Penyelenggaraan Kehutanan (PP No. 23 Tahun 2021)', 'PP_23_2021_Penyelenggaraan_Kehutanan.pdf', 'Peraturan Pemerintah', '2021-11-02', 10),
(38, 'Undang Undang Tentang Kehutanan (UU No. 41 Tahun 1999)', 'UU_41_1999_Kehutanan.pdf', 'Undang-Undang', '2021-11-02', 8),
(39, 'Penetapan Wilayah KPHL KPHP Provinsi kalimantan Selatan (SK 363/Menlhk/Setjen/PLA.0/7/2021)', 'Kepmenhut-LHK-363-Penetapan-wilayah-KPHL-KPHP-Kalsel.pdf', 'Surat Keputusan Menteri LHK', '2021-11-02', 9),
(40, 'Peraturan KLHK Tentang Pengelolaan Perhutanan Sosial - Nomor 9 Tahun 2021', 'P_9-2021-Pengelolaan_Perhutanan_Sosial.pdf', 'Peraturan Menteri LHK', '2021-12-20', 7),
(41, 'Tata Hutan dan Penyusunan Rencana Pengelolaan Hutan, Serta Pemanfaatan HL dan HP - No 8 Tahun 2021', 'P_8-2021-Tahu_Penyusunan_Rcn_Pengelolaan,_Pemanfaatan_HL-HP.pdf', 'Peraturan Menteri LHK', '2021-12-20', 0),
(42, 'Gerakan Revolusi Hijau - Perda Prov. Kalsel No 7 tahun 2018', 'PERDA_NOMOR_7_TAHUN_2018.pdf', 'Peraturan Daerah', '2022-01-24', 11),
(43, 'RENCANA PERLINDUNGAN DAN PENGELOLAAN LINGKUNGAN HIDUP PROV. KALSEL - PERDA PROV. KALSEL NO 2 TAHUN 2', 'Perda_Nomor_2_Tahun_2017.pdf', 'Peraturan Daerah', '2022-01-24', 6),
(44, 'REHABILITASI LAHAN KRITIS - PERDA PROV. KALSEL NO. 7 TAHUN 2017', 'Perda_Nomor_7_Tahun_2017.pdf', 'Peraturan Daerah', '2022-01-24', 4),
(45, 'PENGELOLAAN DAERAH ALIRAN SUNGAI - PERDA PROV.KALSEL NO. 2 TAHUN 2019', 'Perda_Nomor_2_Tahun_2019.pdf', 'Peraturan Daerah', '2022-01-24', 5);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(5) NOT NULL,
  `id_album` int(5) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `jdl_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gallery_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `id_album`, `username`, `jdl_gallery`, `gallery_seo`, `keterangan`, `gbr_gallery`) VALUES
(238, 30, 'admin', 'Lautan Penonton', 'lautan-penonton', 'Lebih kurang dari 50.000 penonton yang memadati Stadion Gelora Bung Karno menyaksikan aksi Kantata Barock.\r\n', ''),
(237, 30, 'admin', 'Mengenang WS. Rendra', 'mengenang-ws-rendra', 'Konser didedikasikan buat salah satu anggota Kantata Takwa, WS. Rendra. Suasana kemeriahan para artis pendukung.\r\n', ''),
(240, 31, 'admin', 'Doa Bersamaaa', 'doa-bersamaaa', '<p>Mengingat agresi yang militer yang dilancarkan Israel merupakan pelanggaran hukum humaniter internasional. Menyusul banyak warga sipil yang telah menjadi korban akibat pertempuran yang dilakukan Israel dan Hamas. Sebelumnya, Sekretaris Jendral Perserikatan Bangsa - Bangsa (PBB) Ban Ki-moon dan Menteri Luar Negeri Amerika Serikat (AS) John Kerry melakukan pertemuan di Kairo, Mesir. Pertemuan di bertujuan untuk mendesak agar konflik yang terjadi di Gaza segera dihentikan.cbcvb</p>\r\n', ''),
(239, 30, 'admin', 'Semangat Kantata', 'semangat-kantata', 'Semangat para macan-macan tua Kantata, seolah mmemberi penyadaran baru dan bagai api yang tak pernah padam.\r\n', ''),
(236, 30, 'admin', 'Iwan Fals', 'iwan-fals', 'Iwan Fals yang tergabung dalam Kantata Barock bersama Setiawan Djodi dan Sawong Jabo menghibur penggemarnya di GBK.\r\n', ''),
(235, 30, 'admin', 'Iwan dan Oemar Bakrie', 'iwan-dan-oemar-bakrie', 'Aksi penonton yang mirip dengan Iwan Fals dan sang guru Oemar Bakrie\r\n', ''),
(234, 30, 'admin', 'Bento...Bento..!!', 'bentobento', 'Bento...Bento...Bentok...!! ....Asyikkk... begitu teriak Setiawan Djody dan Sawung Jabo yang ikuti ribuan penonton.\r\n', ''),
(232, 29, 'admin', 'Karpet Raksasa dari Bunga 008', 'karpet-raksasa-dari-bunga-008', 'sdasdasd', ''),
(233, 30, 'admin', 'Sujud Syukur', 'sujud-syukur', 'Seluruh awak Kantata Barock melakukan sujud syukur di penghujung acara.<br />\r\n', ''),
(231, 29, 'admin', 'Karpet Raksasa dari Bunga 007', 'karpet-raksasa-dari-bunga-007', '', ''),
(230, 29, 'admin', 'Karpet Raksasa dari Bunga 006', 'karpet-raksasa-dari-bunga-006', '', ''),
(229, 29, 'admin', 'Karpet Raksasa dari Bunga 005', 'karpet-raksasa-dari-bunga-005', '', ''),
(228, 29, 'admin', 'Karpet Raksasa dari Bunga 004', 'karpet-raksasa-dari-bunga-004', '', ''),
(227, 29, 'admin', 'Karpet Raksasa dari Bunga 003', 'karpet-raksasa-dari-bunga-003', '', ''),
(225, 29, 'admin', 'Karpet Raksasa dari Bunga 001', 'karpet-raksasa-dari-bunga-001', '', ''),
(226, 29, 'admin', 'Karpet Raksasa dari Bunga 002', 'karpet-raksasa-dari-bunga-002', '', ''),
(224, 28, 'admin', 'Favorit', 'favorit', 'Mainan adalah barang favorit yang senantiasa diburu para pembeli. Selain murah, pilihannya pun berbagai jenis.\r\n', ''),
(223, 28, 'admin', 'Suasana Pasar Asemka', 'suasana-pasar-asemka', 'Pasar Asemka, Jakarta, merupakan pasar grosir yang banyak menyediakan berbagai aksesoris seperti kalung, cincin, Souvenir pernakahan, dan lainnya. Di Pasara Asemka anda akan dimanjakan dengan beragam barang yang dibandrol dengan harga murah meriah dan biasanya dijual grosiran.<br />\r\n', ''),
(222, 28, 'admin', 'Petasan', 'petasan', 'Petasan aneka jenis juga dijajakan di Pasar Asemka, Jakarta.\r\n', ''),
(221, 28, 'admin', 'Merah Marun', 'merah-marun', 'Salah satu suvenir pernikahan nan cantik yang dijual di Pasar Asemka, Jakarta.\r\n', ''),
(220, 28, 'admin', 'Menata Cincin', 'menata-cincin', 'Seorang pedagang cincin aksesoris sedang merapihkan letak cincin agar lebih menarik di Pasar Asemka, Jakarta.\r\n', ''),
(219, 28, 'admin', 'Suvenir', 'suvenir', 'Aneka Souvenir Pernikahan yang dijual di Pasar Asemka, Jakarta.\r\n', ''),
(218, 28, 'admin', 'Seorang Wanita Pedagang', 'seorang-wanita-pedagang', 'Seorang wanita sedang menunggu kios aksesorisnya.\r\n', ''),
(217, 28, 'admin', 'Suasana Pasar', 'suasana-pasar', 'Suasana di Pasar Asemka yang senantiasa ramai. Dan pengunjung bebas memilih berbagai jenis aksesoris.\r\n', ''),
(216, 28, 'admin', 'Pedagang', 'pedagang', 'Seorang pedagang sedang membungkus souvenir penikahan yang akan dijual ataupun pesanan dari pelanggangnnya.\r\n', ''),
(254, 1, 'admin', 'Screenshot 1 ', 'screenshot-1-', 'Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 Screenshot 1 ', '');

-- --------------------------------------------------------

--
-- Table structure for table `halamanstatis`
--

CREATE TABLE `halamanstatis` (
  `id_halaman` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `judul_seo` varchar(100) NOT NULL,
  `isi_halaman` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  `jam` time NOT NULL,
  `hari` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halamanstatis`
--

INSERT INTO `halamanstatis` (`id_halaman`, `judul`, `judul_seo`, `isi_halaman`, `tgl_posting`, `gambar`, `username`, `dibaca`, `jam`, `hari`) VALUES
(46, 'Tentang Kami', 'tentang-kami', '<blockquote><p><img src=\"https://siforestka.co.id/asset/images/SIFORESTTKAAAA.jpg\" style=\"width: 1904px;\"><br></p></blockquote>', '2021-10-18', 'SIFORESTTKA1.jpg', 'admin', 492, '14:10:57', 'Senin'),
(48, 'Cara Belanja Disini', 'cara-belanja-disini', '<p>Pembeli dapat berbelanja dari beberapa lapak berbeda dan membayarnya dalam satu transaksi sekaligus, Misalnya pembeli berbelanja dari 3 pelapak atau lebih, pembeli dapat membayar semua transaksi tersebut dengan fitur Bayar Transaksi Sekaligus .</p><p>Berikut adalah langkah-langkah mudah yang dapat pembeli lakukan ketika ingin belanja banyak barang sekaligus di E-Service.</p><p>Login ke akun E-Service.</p><p>Pilih barang yang pembeli inginkan, lalu klik tombol Tambahkan ke Keranjang.</p><p>Tambahkan ke Keranjang</p><p>Cari barang lain yang pembeli inginkan, lalu klik tombol Tambahkan ke Keranjang</p><p>Jika barang yang pembeli inginkan sudah lengkap, klik icon Keranjang Belanja di bagian kanan atas.</p><p>Tambahkan ke Keranjang</p><p><br></p><p>Pilih transaksi.</p><p>Klik tombol Bayar pada Transaksi yang Dipilih.</p><p>Bayar Transaksi Dipilih</p><p>Isi data pembelian dengan lengkap seperti alamat penerima, catatan pelapak, dan jasa pengiriman. Pada bagian catatan pelapak pembeli dapat mencantumkan ukuran, warna, atau detail lainnya mengenai barang pesanan.</p><p><br></p><p>Data Pembeli</p><p>Klik tombol Pilih Metode Pembayaran.</p><p>Pilih metode pembayaran yang pembeli inginkan, lalu klik tombol Bayar.</p><p>Metode Pembayaran</p><p>Saat pesanan pembeli sudah sampai, jangan lupa klik Konfirmasi Terima Barang</p>\r\n', '2021-10-18', '', 'admin', 213, '14:32:28', 'Senin'),
(52, 'Star Seller 1 Bulan', 'star-seller-1-bulan', '<p>Keterangan untuk paket&nbsp;Star Seller 1 Bulan</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2020-02-23', '', 'admin', 5, '06:28:09', 'Minggu'),
(53, 'Star Seller 3 Bulan', 'star-seller-3-bulan', '<p>Keterangan untuk paket&nbsp;Star Seller 3 Bulan</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2020-02-23', '', 'admin', 0, '06:28:22', 'Minggu'),
(54, 'Star Seller 6 Bulan', 'star-seller-6-bulan', '<p>Keterangan untuk paket&nbsp;Star Seller 6 Bulan</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2020-02-23', '', 'admin', 3, '06:28:32', 'Minggu'),
(1, 'Perjanjian Pengguna', 'perjanjian-pengguna', '<p>Pendahuluan</p>\r\n\r\n<p>Selamat datang di BakulSolo.com. Dengan menggunakan blanja.com (mencakup blanja.com dan situs, layanan, dan piranti terkait), Anda menyetujui persyaratan berikut, termasuk hal yang berupa tautan, dengan prinsip umum untuk PT.Metraplasa. Jika Anda memiliki pertanyaan, silahkan menghubungi Layanan Pelanggan.Perjanjian ini berlaku secara efektif pada tanggal 30 Mei 2014 untuk pengguna sekarang dan setelah persetujuan ini, juga termasuk pengguna baru.</p>\r\n\r\n<p>Cakupan</p>\r\n\r\n<p>Sebelum Anda menjadi anggota dari blanja.com, Anda harus membaca dan menyetujui seluruh syarat dan ketentuan yang ada dan yang berkaitan dengan, Perjanjian Penggunaan dan Kebijakan Privasi blanja.com. Kami merekomendasikan saat Anda membaca Perjanjian Penggunaan, Anda juga mengakses dan membaca informasi yang disajikan berupa tautan. Dengan menerima Perjanjian Penggunaan ini, Anda menyetujui bahwa Perjanjian Penggunaan dan Kebijakan Privasi akan berlaku kapanpun Anda menggunakan situs dan layanan di blanja.com, atau saat Anda menggunakan piranti yang berhubungan/berkaitan dengan situs dan layanan di blanja.com. Jika Anda menggunakan situs blanja.com yang lain, Anda setuju untuk menerima Perjanjian Penggunaan dan Kebijakan Privasi yang berlaku pada situs tersebut. Perjanjian yang berlaku di berbagai domain dan sub-domain merupakan perjanjian yang tampak di bagian bawah di setiap situs. Beberapa situs, layanan, dan piranti blanja.com memiliki tambahan atau ketentuan lain yang disediakan untuk Anda saat menggunakan situs, layanan, ataupun peranti pada website tersebut.</p>\r\n', '2020-03-18', '', 'admin', 51, '09:38:01', 'Rabu'),
(2, 'Kebijakan Privasi', 'kebijakan-privasi', '<p>Kebijakan ini menjelaskan pada Anda tentang bagaimana Kami menggunakan dan melindungi informasi pribadi Anda.</p>\r\n\r\n<p>Kebijakan Privasi ini menjelaskan bagaimana Kami menangani informasi pribadi Anda dalam pelayanan Kami di website blanja.com. Website blanja.com beserta konten dan website terkait lainnya dimanapun kebijakan ini ada pada bagian bawah halaman blanja.comDengan menyetujui Kebijakan Privasi dan Perjanjian Pengguna pada saat registrasi, Anda berarti menyetujui pengumpulan, penyimpanan, penggunaan dan pengungkapan informasi pribadi Anda seperti yang telah dijelaskan pada Kebijakan Privasi ini. Kebijakan Privasi ini mulai berlaku sejak penerimaan pengguna baru atau mulai berlaku pada tanggal 28 Juni 2013.</p>\r\n\r\n<p>Pengumpulan</p>\r\n\r\n<p>Anda dapat menelusuri situs Kami tanpa memberitahu Kami siapa Anda atau menyampaikan informasi pribadi apa pun tentang diri Anda. Sekali Anda memberi Kami informasi pribadi Anda, Anda tidak asing bagi Kami. Jika Anda memberikan informasi pribadi Anda, Anda setuju memindahkan dan menyimpan informasi tersebut dalam server Kami di Indonesia.Kami dapat mengumpulkan dan menyimpan informasi pribadi berikut ini:</p>\r\n\r\n<ul>\r\n	<li>Alamat email, informasi kontak, dan (tergantung layanan yang digunakan) terkadang informasi keuangan, seperti kartu kredit atau nomor rekening bank;</li>\r\n	<li>Informasi transaksi berdasarkan aktivitas Anda di situs (seperti menawar, membeli, menjual barang dan konten yang Anda hasilkan atau yang berhubungan dengan akun Anda);</li>\r\n	<li>Biaya pengiriman, penagihan dan informasi lain yang Anda berikan untuk membeli atau mengirim barang;</li>\r\n	<li>Forum diskusi, obrolan/chating, penyelesaian perselisihan, korespondensi melalui situs, dan korespondensi yang dikirimkan kepada Kami;</li>\r\n	<li>Informasi profil seperti nama, alamat email, gambar profil dan ulang tahun dari layanan keaslian pihak ketiga seperti Facebook Connect;</li>\r\n</ul>\r\n', '2020-03-18', '', 'admin', 64, '09:38:51', 'Rabu'),
(57, 'Jemput Sedekah', 'jemput-sedekah', '<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#ff0000\"><strong>Belum ada Informasi pada Halaman ini.</strong></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n', '2020-04-05', '', 'admin', 4, '14:22:43', 'Minggu'),
(3, 'Informasi Pendaftaran Sopir', 'informasi-pendaftaran-sopir', '<p><b>Persyaratan</b></p>\r\n<ul><li>Pendidikan min. SMA/SMK</li><li>Memiliki SIM C atau SIM A, Tergantung jenis kendaraan</li><li>Memiliki pengalaman sebagai sopir minimal 2 tahun</li><li>Hafal wilayah dan sekitarnya</li><li> Jujur, tekun, pekerja keras</li><li>Upload Scan <b>SIM, STNK dan KTP</b> pada Formulir Pendaftaran di Inputan <b>Lampiran File</b></li></ul><br>\r\n\r\n<p><b>Deskripsi Pekerjaan</b></p>\r\n<ul><li>Bertanggung jawab untuk melakukan pengiriman barang ke customer sesuai dengan surat jalan</li>\r\n<li>Bertanggung jawab atas kendaraan yang digunakan dalam melaksanakan tugas</li>\r\n<li>Siap Melakukan loading dan unloading barang ke mobil</li>\r\n<li>Mampu mengoperasikan dan terbiasa menggunakan Google Map</li></ul><br><p></p>', '2020-08-10', '', 'admin', 1, '14:02:00', 'Senin'),
(58, 'Halaman masih kosong', 'halaman-masih-kosong', '<p xss=\"removed\"><br></p><p xss=\"removed\"><br></p><p xss=\"removed\"><br></p><p xss=\"removed\"><br></p><p xss=\"removed\"><br></p><p xss=\"removed\" xss=removed><span xss=\"removed\" xss=removed>Belum ada Content pada halaman ini..</span></p><p xss=\"removed\"><br></p><p xss=\"removed\"><br></p><p xss=\"removed\"><br></p><p xss=\"removed\"><br></p><p xss=\"removed\"><br>\r\n<br class=\"Apple-interchange-newline\"></p>', '2021-03-13', '', 'admin', 22, '18:09:23', 'Sabtu'),
(59, 'Kontak Kami', 'kontak-kami', '<div><b>Alamat Kantor</b></div><div>Jl. A. Yani, Loktabat Sel., Kec. Banjarbaru Selatan, Kota Banjarbaru, Kalimantan Selatan 70714</div><div><br></div><div><br></div><div><iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.613888038022!2d114.8391041511387!3d-3.443708042745085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6810e2e4fbbdd%3A0x5939079e7fa05b8d!2sSouth%20Kalimantan%20Provincial%20Forestry%20Office!5e0!3m2!1sen!2sid!4v1634612115926!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe><br></div>', '2021-10-18', '', 'admin', 119, '13:55:16', 'Senin'),
(61, 'Persediaan Bibit', 'persediaan-bibit', '<div><div style=\"text-align: center; \">Berikut daftar stock bibit siap tanam dengan spesifikasi tinggi 30 cm up di Persemaian Permanen UPTD Balai Perbenihan Tanaman Hutan (BPTH), update data per tanggal 19 Maret 2022.</div><div style=\"text-align: center; \">Hanya denggan fotocopy KTP anda bisa dapatkan 25 bibit pohon GRATIS</div><div style=\"text-align: center; \">Silahkan ajukan permohonan bibit ke Persemaian Permanen UPTD BPTH, kami siap melayani Anda!</div><div style=\"text-align: center; \"><br></div><div style=\"text-align: center; \"><img src=\"https://siforestka.co.id/asset/images/19_maret_2022.jpg\" style=\"width: 50%;\"><br></div><div style=\"text-align: center; \"><br></div></div><div><div class=\"cxmmr5t8 oygrvhab hcukyx3x c1et5uql o9v6fnle ii04i59q\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: \" segoe=\"\" ui=\"\" historic\",=\"\" \"segoe=\"\" ui\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(228,=\"\" 230,=\"\" 235);=\"\" background-color:=\"\" rgb(36,=\"\" 37,=\"\" 38);\"=\"\"></div></div>', '2021-10-26', '1.jpg', 'admin', 117, '07:37:58', 'Selasa'),
(62, 'Produksi Bibit', 'produksi-bibit', '<p style=\"text-align: justify; \"><span style=\"text-align: center;\">Berikut Laporan Produksi Bibit Tanaman Persemaian Permanen UPTD Balai Perbenihan Tanaman Hutan Dinas Kehutanan Provinsi Kalimantan Selatan&nbsp;</span><span style=\"text-align: center;\">(Periode Bulan Januari - Februari 2022)</span></p><p style=\"text-align: justify; \"><br></p><p style=\"text-align: center;\"><img src=\"https://siforestka.co.id/asset/images/produksi_1.jpg\" style=\"width: 100%;\"><span style=\"text-align: center;\"><br></span></p><p style=\"text-align: center;\"><img src=\"https://siforestka.co.id/asset/images/produksi_2.jpg\" style=\"width: 100%;\"><span style=\"text-align: center;\"><br></span></p><p style=\"text-align: center;\"><img src=\"https://siforestka.co.id/asset/images/produksi_3.jpg\" style=\"width: 100%;\"><span style=\"text-align: center;\"><br></span></p>', '2021-10-26', '', 'admin', 77, '07:38:58', 'Selasa'),
(64, 'Distribusi Bibit', 'distribusi-bibit', '<p><span style=\"text-align: center;\">Berikut Laporan Distribusi Bibit Tanaman Persemaian Permanen UPTD Balai Perbenihan Tanaman Hutan Dinas Kehutanan Provinsi Kalimantan Selatan&nbsp;</span><span style=\"text-align: center;\">(Periode Bulan Januari - Februari 2022)</span></p><p>&nbsp; &nbsp;&nbsp;<img src=\"https://siforestka.co.id/asset/images/distribusi_11.jpg\" style=\"width: 100%;\"><span style=\"text-align: center;\"><br></span></p><p></p><p style=\"text-align: left;\"><img src=\"https://siforestka.co.id/asset/images/distribusi_2.jpg\" style=\"width: 100%;\"><br></p>', '2022-01-24', '', 'admin', 70, '13:33:34', 'Senin');

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE `header` (
  `id_header` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id_header`, `judul`, `url`, `gambar`, `tgl_posting`) VALUES
(31, 'Header3', '', 'header3.jpg', '2011-04-06'),
(32, 'Header2', '', 'header1.jpg', '2011-04-06'),
(33, 'Header1', '', 'header2.jpg', '2011-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi`
--

CREATE TABLE `hubungi` (
  `id_hubungi` int(5) NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `dibaca` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `lampiran` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `hubungi`
--

INSERT INTO `hubungi` (`id_hubungi`, `nama`, `email`, `subjek`, `pesan`, `tanggal`, `jam`, `dibaca`, `lampiran`) VALUES
(39, 'Robby Prihandaya', 'robby.prihandaya@gmail.com', '::1', 'Kami memiliki komitmen untuk memberikan layanan terbaik kepada Anda dan selalu berusaha untuk menyediakan produk dan layanan terbaik yang Anda butuhkan. Apabila untuk alasan tertentu Anda merasa tidak puas dengan pelayanan kami, Anda dapat menyampaikan kritik dan saran Anda kepada kami. Kami akan menidaklanjuti masukan yang Anda berikan dan bila perlu mengambil tindakan untuk mencegah masalah yang sama terulang kembali.', '2017-01-23', '21:56:12', 'Y', ''),
(35, 'yusri renor', 'aciafifah@gmail.com', 'pertanyaan', 'bagaimana cara mengunduh nomor ujian fak. pertanian', '2014-01-19', '00:00:00', 'Y', ''),
(36, 'Lusi Rahmawati', 'robby.prihandaya@gmail.com', 'xvgxcvxc', 'gbvibviubuibiub', '2014-07-02', '00:00:00', 'Y', ''),
(38, 'Udin Sedunia', 'udin.sedunia@gmail.com', 'Ip Pengirim : 120.177.28.244', 'Silahkan menghubungi kami melalui private message melalui form yang berada pada bagian kanan halaman ini. Kritik dan saran Anda sangat penting bagi kami untuk terus meningkatkan kualitas produk dan layanan yang kami berikan kepada Anda.', '2015-06-02', '00:00:00', 'Y', ''),
(40, 'Robby Prihandaya', 'robby.prihandaya@gmail.com', '::1', 'Kami memiliki komitmen untuk memberikan layanan terbaik kepada Anda dan selalu berusaha untuk menyediakan produk dan layanan terbaik yang Anda butuhkan. Apabila untuk alasan tertentu Anda merasa tidak puas dengan pelayanan kami, Anda dapat menyampaikan kritik dan saran Anda kepada kami. Kami akan menidaklanjuti masukan yang Anda berikan dan bila perlu mengambil tindakan untuk mencegah masalah yang sama terulang kembali.', '2017-01-25', '09:54:45', 'Y', ''),
(41, 'Robby Prihandaya', 'todaynews.co.id@gmail.coms', '::1', 'asdasdasd', '2018-05-04', '19:33:01', 'N', '');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(5) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `pengirim_email` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `url` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `facebook` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `rekening` varchar(100) NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `maps` text NOT NULL,
  `api_mutasibank` text NOT NULL,
  `api_rajaongkir` text NOT NULL,
  `free_reseller` int(11) NOT NULL,
  `flash_deal` date NOT NULL,
  `info_atas` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_website`, `pengirim_email`, `email`, `password`, `url`, `facebook`, `rekening`, `no_telp`, `meta_deskripsi`, `meta_keyword`, `favicon`, `maps`, `api_mutasibank`, `api_rajaongkir`, `free_reseller`, `flash_deal`, `info_atas`) VALUES
(1, 'Sistem Informasi Sumber Daya Hutan Kalimantan Selatan', 'SIFORESTKA.CO.ID', 'webgis7@gmail.com', 'asri2216', 'https://siforestka.co.id', 'https://www.facebook.com, https://twitter.com, https://plus.google.com, https://id.linkedin.com/', '0310004740406', '0511 4777534', 'Sistem Informasi Sumber Daya Hutan Kalimantan Selatan (SISDH) merupakan penyampaian informasi dalam menyajikan data potensi sumber daya hutan berupa hasil kayu (HHK), hasil hutan bukan kayu (HHBK) dan jasa lingkungan (JASLING).', 'Selamat datang di Sistem Informasi Sumber Daya Hutan Kalimantan Selatan', 'sisdh.png', '3RKHRKu0jPPehKEDauu5zSQKYKTEWP5q|xxxx|xxFj22s4iof4VfkGTqRXhmLqLcS2UevnCAElgis0RkRsWtGhwzZvo4lVEnOnNpHx', 'xxQwWGNUMTdRTmlnYklia3RYWGV6R0I4SWZzd0F3S3FLUlNuUXRiTXgwbE83VXVyYk1raEZTbEVacm1B5dd91ff047d9x', '42d9164584a209caad6f635480f01b35', 12000, '2020-09-29', 'Jual Beli produk di sisdh kalsel <a href=\"https://siforestka.co.id/auth/login\"><strong>Daftar Sekarang!</strong></a>');

-- --------------------------------------------------------

--
-- Table structure for table `iklanatas`
--

CREATE TABLE `iklanatas` (
  `id_iklanatas` int(5) NOT NULL,
  `judul` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `url` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `iklanatas`
--

INSERT INTO `iklanatas` (`id_iklanatas`, `judul`, `username`, `url`, `gambar`, `tgl_posting`) VALUES
(40, 'Dapatkan Informasi dari Kami', 'N', '', 'depan.jpg', '2021-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `iklantengah`
--

CREATE TABLE `iklantengah` (
  `id_iklantengah` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `iklantengah`
--

INSERT INTO `iklantengah` (`id_iklantengah`, `judul`, `username`, `url`, `gambar`, `tgl_posting`) VALUES
(41, 'home Opini Publik', 'admin', 'http://dishut.kalselprov.go.id/opini', 'op_publik.png', '2022-05-12'),
(40, 'home GIS Website', 'admin', 'http://dishut.kalselprov.go.id/web-gis', 'gis.png', '2022-05-12'),
(37, 'home Aplikasi Revolusi Hijau', 'admin', 'https://play.google.com/store/apps/details?id=com.pinandu.android.revolusihijau&hl=en&gl=US', 'rev_hijau.png', '2022-05-12'),
(38, 'home Aksi Revolusi Hijau', 'admin', 'http://dishut.kalselprov.go.id/revjo/aksi', 'aksi_rh.png', '2022-05-12'),
(39, 'home Informasi Hasil Hutan', 'admin', 'http://dishut.kalselprov.go.id/hasil-hutan', 'ihasil_hutan.png', '2022-05-12');

-- --------------------------------------------------------

--
-- Table structure for table `img_comment`
--

CREATE TABLE `img_comment` (
  `id` int(11) NOT NULL,
  `file_name` varchar(150) NOT NULL,
  `uploaded_on` varchar(150) NOT NULL,
  `id_comment` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `img_comment`
--

INSERT INTO `img_comment` (`id`, `file_name`, `uploaded_on`, `id_comment`) VALUES
(1, 'tas1.jpg', '2020-07-31 10:46:01', '1-produk-20200731104601'),
(6, 'avanza-veloz542.jpg', '2020-08-11 07:29:06', '1-syarat-20200811072906'),
(7, 'avanza-veloz543.jpeg', '2020-08-11 07:29:06', '1-syarat-20200811072906'),
(8, 'Capture111.JPG', '2020-08-15 20:36:39', '39-produk-20200815083639'),
(9, 'sendok1.jpg', '2020-08-17 13:57:27', '50-produk-20200817015727'),
(10, 'sendok2.jpg', '2020-08-17 13:57:27', '50-produk-20200817015727'),
(11, 'anak_buah.png', '2020-08-17 14:18:15', '1-syarat-20200817021815'),
(12, 'produk3.png', '2020-08-17 14:18:16', '1-syarat-20200817021815'),
(16, 'hasil_membuat_form_edit_soal.png', '2020-08-22 17:37:39', '52-produk-20200822053733'),
(18, 'foto.jpg', '2020-08-22 17:50:34', '53-produk-20200822055029'),
(19, 'phpmu-logo.png', '2020-08-22 17:50:42', '53-produk-20200822055029'),
(26, '22.png', '2020-09-21 10:24:10', '1-produk-20200921102409'),
(27, '4.jpg', '2020-09-21 10:24:10', '1-produk-20200921102409'),
(29, '2.png', '2020-09-21 10:24:10', '1-produk-20200921102409'),
(30, 'a1.jpg', '2020-09-21 10:24:10', '1-produk-20200921102409'),
(31, 'a2.jpg', '2020-09-21 10:24:11', '1-produk-20200921102409'),
(32, 'a4.jpg', '2020-09-21 10:24:11', '1-produk-20200921102409'),
(33, 'a7.jpg', '2020-09-21 10:24:11', '1-produk-20200921102409'),
(34, 'a8.jpg', '2020-09-21 10:24:11', '1-produk-20200921102409'),
(35, 'a9.jpg', '2020-09-21 10:24:11', '1-produk-20200921102409'),
(36, 'AD_19_20_Misty_Grey_grande.jpg', '2020-09-21 10:24:12', '1-produk-20200921102409'),
(37, 'apple-touch-icon-152x152.png', '2020-09-21 10:24:12', '1-produk-20200921102409'),
(38, 'AR91_45_Afia_Black_grande.jpg', '2020-09-21 10:24:12', '1-produk-20200921102409'),
(39, 'AR91_87_Molly_Grey_grande.jpg', '2020-09-21 10:24:12', '1-produk-20200921102409'),
(40, 'AR91_95_Sheva_Maroon_1_grande.png', '2020-09-21 10:24:12', '1-produk-20200921102409'),
(41, 'AR91_95_Sheva_Maroon_1_grande1.png', '2020-09-21 10:24:12', '1-produk-20200921102409'),
(42, 'AR96_13_Tartan_Grey_grande.jpg', '2020-09-21 10:24:13', '1-produk-20200921102409'),
(43, 'AYD5_3_Mayra_Pink_grande.jpg', '2020-09-21 10:24:13', '1-produk-20200921102409'),
(44, 'baju_dalam7.jpg', '2020-09-21 10:24:13', '1-produk-20200921102409'),
(45, 'baju_dalam15.jpg', '2020-09-21 10:24:13', '1-produk-20200921102409'),
(46, 'baju_dalam25.jpg', '2020-09-21 10:24:14', '1-produk-20200921102409'),
(47, 'botol-madu-embun-Murni-PET-botol-plastik-transparan-bodoh-perak-aluminium.jpg', '2020-09-21 10:24:14', '1-produk-20200921102409'),
(48, 'c4_grande1.jpg', '2020-09-21 10:24:14', '1-produk-20200921102409'),
(49, 'carbon1.jpg', '2020-09-21 10:24:14', '1-produk-20200921102409'),
(50, 'carbon2.jpg', '2020-09-21 10:24:14', '1-produk-20200921102409'),
(51, 'carbon3.jpg', '2020-09-21 10:24:15', '1-produk-20200921102409'),
(52, 'carbon4.jpg', '2020-09-21 10:24:16', '1-produk-20200921102409'),
(53, 'cookware.jpg', '2020-09-21 10:24:16', '1-produk-20200921102409'),
(54, 'cookware1.jpg', '2020-09-21 10:24:16', '1-produk-20200921102409'),
(55, 'dc4_grande.jpg', '2020-09-21 10:24:16', '1-produk-20200921102409'),
(56, 'Emily_Grey_grande.jpg', '2020-09-21 10:24:16', '1-produk-20200921102409'),
(57, 'foto.jpg', '2020-09-21 10:24:17', '1-produk-20200921102409'),
(58, 'foto_kopers.jpg', '2020-09-21 10:24:17', '1-produk-20200921102409'),
(59, 'FZ827_Jeans_OK.jpg', '2020-09-21 10:24:17', '1-produk-20200921102409'),
(60, 'gamis1.jpg', '2020-09-21 10:24:18', '1-produk-20200921102409'),
(61, 'gamis3.jpg', '2020-09-21 10:24:18', '1-produk-20200921102409'),
(62, 'gamis4.jpg', '2020-09-21 10:24:18', '1-produk-20200921102409'),
(63, 'gamis5.jpg', '2020-09-21 10:24:19', '1-produk-20200921102409'),
(64, 'gamis6.jpg', '2020-09-21 10:24:19', '1-produk-20200921102409'),
(65, 'gamis11.jpg', '2020-09-21 10:24:19', '1-produk-20200921102409'),
(66, 'hasil_membuat_form_edit_soal.png', '2020-09-21 10:24:20', '1-produk-20200921102409'),
(67, 'Hydrangeas.jpg', '2020-09-21 10:24:20', '1-produk-20200921102409'),
(68, 'KYB4_14_Soft_Lavender_1024x1024_f993283a-dae0-4a05-b163-9f6b44465732_grande.jpg', '2020-09-21 10:24:20', '1-produk-20200921102409'),
(69, 'MK97_7_Mocca_grande.jpg', '2020-09-21 10:24:20', '1-produk-20200921102409'),
(70, 'MK97_7_Mocca_grande1.jpg', '2020-09-21 10:24:20', '1-produk-20200921102409'),
(71, 'olahraga.jpg', '2020-09-21 10:24:21', '1-produk-20200921102409'),
(72, 'olahraga1.jpg', '2020-09-21 10:24:21', '1-produk-20200921102409'),
(73, 'olahraga2.jpg', '2020-09-21 10:24:21', '1-produk-20200921102409'),
(74, 'olahraga3.jpg', '2020-09-21 10:24:21', '1-produk-20200921102409'),
(75, 'panci.jpg', '2020-09-21 10:24:21', '1-produk-20200921102409'),
(76, 'RV71_5_Cold_Ocean_grande.jpg', '2020-09-21 10:24:22', '1-produk-20200921102409'),
(77, 'RV71_27_Jeans_grande.jpg', '2020-09-21 10:24:22', '1-produk-20200921102409'),
(78, 'RYB6_1_Grey_grande.jpg', '2020-09-21 10:24:22', '1-produk-20200921102409'),
(79, 'tas.jpg', '2020-09-21 10:24:22', '1-produk-20200921102409'),
(80, 'tas1.jpg', '2020-09-21 10:24:22', '1-produk-20200921102409'),
(81, 'xiaomi-zhiwu.jpg', '2020-09-21 10:24:22', '1-produk-20200921102409'),
(83, 'persyaratan.jpg', '2020-10-30 16:51:07', '2-syarat-20201030045107'),
(86, 'bukti_kerusakan_produk.jpg', '2020-11-06 13:18:17', '-messages_diskusi-20201106011817'),
(87, 'bukti_kerusakan_produk1.jpg', '2020-11-07 09:53:43', 'admin-messages_diskusi-20201107095343'),
(98, 'bukti_transfer.jpg', '2020-12-08 10:37:19', '1-produk-20201208100630'),
(102, 'bukti_transfer1.jpg', '2020-12-08 10:43:22', '1-produk-20201208100630'),
(118, 'bukti_transfer2.jpg', '2020-12-08 11:49:36', '1-produk-20201208100630'),
(123, 'bukti_transfer3.jpg', '2021-01-07 15:01:40', 'admin-produk-20210107024203'),
(124, 'bukti_transfer4.jpg', '2021-01-07 15:02:37', 'admin-produk-20210107024203'),
(126, 'bukti_transfer5.jpg', '2021-02-10 07:03:57', '1-produk-20210210070357'),
(127, 'bukti_transfer6.jpg', '2021-02-10 07:15:00', '1-produk-20210210070357'),
(128, 'home-2-1.jpg', '2021-02-22 08:59:00', 'admin-produk-20210222085900'),
(129, 'home-2-2.jpg', '2021-02-22 08:59:00', 'admin-produk-20210222085900'),
(130, 'group_order.png', '2021-05-16 10:18:26', '1-produk-20210516101826'),
(131, 'group_order1.png', '2021-05-16 10:24:54', '1-produk-20210516102454'),
(132, 'kiyora1.jpg', '2021-05-16 10:42:39', '1-produk-20210516104239'),
(133, 'kiyora2.jpg', '2021-05-16 10:42:39', '1-produk-20210516104239'),
(134, '531-2.jpg', '2021-07-02 21:36:47', '71-produk-20210702093647'),
(135, '531-1.jpg', '2021-07-15 05:31:50', '71-produk-20210715053150'),
(136, '43-2.jpg', '2021-07-15 05:34:05', '71-produk-20210715053405'),
(137, '531-21.jpg', '2021-07-15 05:34:05', '71-produk-20210715053405'),
(138, '531-11.jpg', '2021-07-15 05:34:05', '71-produk-20210715053405'),
(139, '43-1.JPG', '2021-07-15 05:34:05', '71-produk-20210715053405'),
(140, '43-11.JPG', '2021-07-15 05:35:52', '71-produk-20210715053552'),
(141, '531-12.jpg', '2021-07-15 05:35:52', '71-produk-20210715053552'),
(142, '43-21.jpg', '2021-07-15 05:35:53', '71-produk-20210715053552'),
(143, 'foto3.png', '2021-07-15 05:35:53', '71-produk-20210715053552'),
(144, '531-22.jpg', '2021-07-15 05:35:53', '71-produk-20210715053552'),
(145, '43-22.jpg', '2021-07-15 05:36:41', '71-produk-20210715053641'),
(146, '43-12.JPG', '2021-07-15 05:36:41', '71-produk-20210715053641'),
(147, '531-13.jpg', '2021-07-15 05:36:41', '71-produk-20210715053641'),
(148, '531-23.jpg', '2021-07-15 05:36:41', '71-produk-20210715053641'),
(153, '43-13.JPG', '2021-07-15 05:38:02', '71-produk-20210715053731'),
(154, '43-23.jpg', '2021-07-15 05:38:02', '71-produk-20210715053731'),
(155, '531-14.jpg', '2021-07-15 05:38:02', '71-produk-20210715053731'),
(156, '531-24.jpg', '2021-07-15 05:38:02', '71-produk-20210715053731'),
(157, '531-15.jpg', '2021-07-15 05:39:46', '71-produk-20210715053946'),
(158, '531-25.jpg', '2021-07-15 05:39:46', '71-produk-20210715053946'),
(159, '531-26.jpg', '2021-07-15 05:40:11', '71-produk-20210715054011'),
(160, '531-16.jpg', '2021-07-15 05:40:11', '71-produk-20210715054011'),
(161, '43-24.jpg', '2021-07-15 05:40:47', '71-produk-20210715054047'),
(162, '43-14.JPG', '2021-07-15 05:40:47', '71-produk-20210715054047'),
(163, 'WhatsApp_Image_2021-08-25_at_10_27_05.jpeg', '2021-08-25 21:05:20', '9-produk-20210825090520'),
(164, 'Tahura-Mandingin-Bjb.JPG', '2021-08-25 21:05:45', '9-produk-20210825090520'),
(165, 'batu-balian-kalimantan-selatan.jpg', '2021-09-21 07:05:46', '9-produk-20210921070545'),
(166, 'Bukit_Batas.jpg', '2021-09-21 07:14:33', '9-produk-20210921071433'),
(167, 'raja_lima.jpg', '2021-09-21 07:16:26', '9-produk-20210921071626'),
(168, 'kahung.jpg', '2021-09-21 07:17:47', '9-produk-20210921071747'),
(169, 'pulau_bekantan.jpg', '2021-09-21 07:20:54', '9-produk-20210921072054'),
(170, 'pulau-rusa-tiga.jpg', '2021-09-21 07:22:05', '9-produk-20210921072205'),
(171, 'desa_balangian.jpg', '2021-09-21 07:27:04', '9-produk-20210921072704'),
(172, 'mandin_malinau.jpeg', '2021-09-21 07:30:22', '9-produk-20210921073022'),
(173, 'mandin_mihak.jpg', '2021-09-21 07:32:04', '9-produk-20210921073204'),
(174, 'air-terjun-sungai-karuh-halau-halau.jpg', '2021-09-21 07:33:07', '9-produk-20210921073307'),
(175, 'riam_lima.png', '2021-09-21 07:36:33', '9-produk-20210921073633'),
(176, 'matang_keladan.jpg', '2021-09-21 07:38:00', '9-produk-20210921073800'),
(177, 'bukit_ilalang.jpg', '2021-09-21 07:44:07', '8-produk-20210921074407'),
(178, 'MANGGROVE-PANTAI-TAKISUNG-KAB_-TANAH-LAUT-1.jpg', '2021-09-21 07:47:08', '8-produk-20210921074708'),
(179, 'bukit_jambangan.jpg', '2021-09-21 07:48:43', '8-produk-20210921074843'),
(180, 'bukit_ilalang1.jpg', '2021-09-21 07:50:58', '8-produk-20210921075058'),
(181, 'pantaibalambus.jpg', '2021-09-21 07:55:07', '8-produk-20210921075506'),
(182, 'objek-wisata-baru-gunung-mamake-kotabaru.jpg', '2021-09-21 07:56:55', '8-produk-20210921075655'),
(183, 'bukit_tameang_tinggi.jpeg', '2021-09-21 07:59:58', '5-produk-20210921075958'),
(184, 'gunung_katunun.jpg', '2021-09-21 08:02:41', '5-produk-20210921080240'),
(185, 'Goa_Marmer.JPG', '2021-09-21 08:06:09', '5-produk-20210921080609'),
(186, 'bukit_priangan.jpg', '2021-09-21 08:08:25', '5-produk-20210921080825'),
(187, 'gunung-birah-tala-04.jpg', '2021-09-21 08:09:26', '5-produk-20210921080926'),
(188, 'gunung_damar_wulan.jpg', '2021-09-21 08:11:40', '5-produk-20210921081140'),
(189, 'moulding.jpg', '2021-09-28 05:33:20', '11-produk-20210928053320'),
(190, 'moulding2.jpg', '2021-09-28 05:33:20', '11-produk-20210928053320'),
(191, 'Triplek.jpg', '2021-09-28 05:43:07', '21-produk-20210928054307'),
(192, 'IMG-20211026-WA0008.jpg', '2021-10-27 09:58:35', '1-produk-20211027095834'),
(193, 'IMG-20211026-WA0004.jpg', '2021-10-27 09:59:02', '1-produk-20211027095834'),
(194, 'IMG_6230.JPG', '2021-10-27 10:09:21', '2-produk-20211027100920'),
(195, 'IMG_6278.JPG', '2021-10-27 10:09:23', '2-produk-20211027100920'),
(196, 'IMG_6127.JPG', '2021-10-27 10:09:24', '2-produk-20211027100920'),
(197, 'IMG_6276.JPG', '2021-10-27 10:09:24', '2-produk-20211027100920'),
(198, '1615253609893.jpg', '2021-10-27 10:19:24', '1-produk-20211027101923'),
(199, '1615253609889.jpeg', '2021-10-27 10:19:57', '1-produk-20211027101923'),
(201, '5ef9c7c7-147d-4e59-b6cc-b37028f0ff04.jpg', '2021-10-27 10:21:15', '4-produk-20211027102021'),
(202, 'IMG_5717.JPG', '2021-10-27 10:27:46', '2-produk-20211027102745'),
(203, 'IMG_5714.JPG', '2021-10-27 10:27:46', '2-produk-20211027102745'),
(204, 'IMG_5723.JPG', '2021-10-27 10:27:47', '2-produk-20211027102745'),
(205, 'DJI_0153_1.jpg', '2021-10-27 10:30:45', '9-produk-20211027103044'),
(206, 'IMG-20210713-WA0003.jpg', '2021-10-27 10:30:53', '9-produk-20211027103044'),
(207, 'IMG_5170.JPG', '2021-10-27 10:31:03', '2-produk-20211027103103'),
(208, 'IMG_5209_-_Copy.JPG', '2021-10-27 10:31:04', '2-produk-20211027103103'),
(209, 'IMG_5194.JPG', '2021-10-27 10:31:04', '2-produk-20211027103103'),
(210, 'YAN_6225_1.jpg', '2021-10-27 10:31:10', '9-produk-20211027103044'),
(211, 'Bukit-Batu-Riam-Kanan_-Foto-net.jpeg', '2021-10-27 10:31:20', '9-produk-20211027103044'),
(212, 'IMG-20210308-WA0007.jpg', '2021-10-27 10:51:54', '1-produk-20211027105154'),
(213, 'IMG-20210308-WA0002.jpg', '2021-10-27 10:52:30', '1-produk-20211027105154'),
(214, '1615253609877.jpeg', '2021-10-27 10:53:32', '1-produk-20211027105332'),
(215, 'AIR_TERJUN_LANO.jpg', '2021-10-27 10:54:25', '1-produk-20211027105332'),
(216, '654ca11f-7bf0-4dda-9115-b444581608d9.jpg', '2021-10-27 10:57:51', '4-produk-20211027105751'),
(217, '1.PNG', '2021-10-27 13:45:18', '5-produk-20211027014518'),
(218, 'gunung_birah2.jpg', '2021-11-22 07:20:08', '5-produk-20211122072008'),
(219, 'HHBK-KPH_TANAH_LAUT(JAMUR_TIRAM_KRISPY).png', '2021-11-22 07:26:09', '5-produk-20211122072609'),
(220, 'HHBK-KPH_TANAH_LAUT(BUAH_KEMIRI_BATUKURA).jpg', '2021-11-22 08:39:32', '5-produk-20211122083932'),
(221, 'HHBK-KPH_TANAH_LAUT(GULA_MERAH_AREN).jpg', '2021-11-22 08:40:35', '5-produk-20211122084035'),
(222, 'HHBK-KPH_TANAH_LAUT(MADU_LEBAH_TELAGA_MADU).jpeg', '2021-11-22 08:42:22', '5-produk-20211122084222'),
(223, 'HHBK-KPH_TANAH_LAUT(KOPI_SUMBER_REJEKI).jpg', '2021-11-22 08:43:16', '5-produk-20211122084316'),
(224, 'HHBK-KPH_TANAH_LAUT(NATURAL_HONEY_TRIGONA_SAKATALU).jpg', '2021-11-22 08:46:19', '5-produk-20211122084619'),
(225, 'HHBK-KPH_TANAH_LAUT(NATURAL_HONEY_TRIGONA_SAKATALU)1.jpg', '2021-11-22 08:46:31', '5-produk-20211122084631'),
(226, 'HHBK-KPH_TANAH_LAUT(MADU_KELULUT_KPH_TANAH_LAUT).png', '2021-11-22 08:48:17', '5-produk-20211122084817'),
(227, 'minyak_serai.jpg', '2021-11-22 08:59:45', '5-produk-20211122085945'),
(228, 'HHBK-KPH_TANAH_LAUT(MADU_KELULUT_KARIYA_JAYA).png', '2021-11-22 09:00:25', '5-produk-20211122090025'),
(229, 'HHBK-KPH_TANAH_LAUT(PORANG).jpeg', '2021-11-22 09:05:10', '5-produk-20211122090510'),
(230, 'HHBK-KPH_TANAH_LAUT(JAHE_MERAH_INSTAN).png', '2021-11-22 09:07:00', '5-produk-20211122090700'),
(231, 'HHBK-KPH_TANAH_LAUT(TEMULAWAK_INSTAN).png', '2021-11-22 09:08:12', '5-produk-20211122090812'),
(232, 'HHBK-KPH_TANAH_LAUT(KUNYIT_INSTAN).png', '2021-11-22 09:10:32', '5-produk-20211122091032'),
(233, 'HHBK-KPH_TANAH_LAUT(KAPSUL_BEEPOLEN).png', '2021-11-22 09:11:11', '5-produk-20211122091111'),
(234, 'HHBK-KPH_TANAH_LAUT(MADU_KELULUT_RAJAMADU).png', '2021-11-22 09:11:36', '5-produk-20211122091136'),
(235, 'HHBK-KPH_TANAH_LAUT(BRIKET_ARANG).jpg', '2021-11-22 09:16:57', '5-produk-20211122091657'),
(236, 'HHBK-KPH_TANAH_LAUT(BUAH_KEMIRI_BATUKURA)1.jpg', '2021-11-22 09:47:53', '5-produk-20211122094753'),
(237, 'KJ.jpg', '2021-11-22 10:20:53', '5-produk-20211122102053'),
(238, 'HUTAN_5.jpg', '2021-11-22 10:31:19', '5-produk-20211122103119'),
(239, 'jamur.jpg', '2021-11-22 14:14:07', '5-produk-20211122021407'),
(240, 'jamur1.jpg', '2021-11-22 14:15:04', '5-produk-20211122021504'),
(241, 'Madu_Lebah_Alam.jpeg', '2021-12-02 10:23:39', '9-produk-20211202102338'),
(242, 'Madu_Lebah_Alam_2.jpeg', '2021-12-02 10:23:47', '9-produk-20211202102338'),
(243, 'Deorub.jpeg', '2021-12-02 10:48:13', '9-produk-20211202104808'),
(244, 'Madu_Kelulut.jpeg', '2021-12-02 11:12:15', '9-produk-20211202111215'),
(245, 'Kopi_Aranio.jpeg', '2021-12-02 11:19:26', '9-produk-20211202111926'),
(246, 'Kopi_Aranio_(1).jpeg', '2021-12-02 11:19:29', '9-produk-20211202111926'),
(247, 'Sirup_Temulawak.jpeg', '2021-12-02 11:29:03', '9-produk-20211202112903'),
(248, 'Sirup_Jahe_Merah.jpeg', '2021-12-02 11:43:12', '9-produk-20211202114312'),
(250, 'WhatsApp_Image_2021-12-03_at_16_16_29.jpeg', '2021-12-06 10:39:22', '9-produk-20211206103849'),
(251, 'WhatsApp_Image_2021-12-03_at_16_33_24_(1).jpeg', '2021-12-06 10:39:38', '9-produk-20211206103849'),
(252, 'WhatsApp_Image_2021-12-03_at_16_33_24.jpeg', '2021-12-06 10:39:38', '9-produk-20211206103849'),
(253, 'WhatsApp_Image_2021-12-03_at_16_27_23.jpeg', '2021-12-06 10:39:38', '9-produk-20211206103849'),
(254, 'WhatsApp_Image_2021-12-03_at_16_30_59.jpeg', '2021-12-06 10:39:38', '9-produk-20211206103849'),
(255, 'tahura-sultan-adam.jpg', '2021-12-06 10:39:50', '9-produk-20211206103849'),
(256, 'tahura-dua-dua.jpg', '2021-12-06 10:40:02', '9-produk-20211206103849'),
(257, 'WhatsApp_Image_2021-12-03_at_16_18_53.jpeg', '2021-12-06 10:40:08', '9-produk-20211206103849'),
(258, 'WhatsApp_Image_2021-12-03_at_16_20_00.jpeg', '2021-12-06 10:40:08', '9-produk-20211206103849'),
(259, 'WhatsApp_Image_2021-12-03_at_16_20_49.jpeg', '2021-12-06 10:40:08', '9-produk-20211206103849'),
(260, 'WhatsApp_Image_2021-12-03_at_16_19_33.jpeg', '2021-12-06 10:40:09', '9-produk-20211206103849'),
(261, 'em_gerbang.jpeg', '2021-12-06 11:10:45', '9-produk-20211206111045'),
(262, 'em_anggrek2.jpeg', '2021-12-06 11:12:10', '9-produk-20211206111045'),
(263, 'em_anggrek1.jpeg', '2021-12-06 11:12:10', '9-produk-20211206111045'),
(264, 'em_pesanggrahan4.jpg', '2021-12-06 11:26:23', '9-produk-20211206111045'),
(265, 'em_pesanggrahan1.jpeg', '2021-12-06 11:26:24', '9-produk-20211206111045'),
(266, 'em_pesanggrahan3.jpeg', '2021-12-06 11:26:24', '9-produk-20211206111045'),
(267, 'em_pesanggrahan2.jpeg', '2021-12-06 11:26:24', '9-produk-20211206111045'),
(268, 'em_kolam.jpeg', '2021-12-06 11:30:07', '9-produk-20211206111045'),
(269, 'em_airterjun.jpg', '2021-12-06 11:30:21', '9-produk-20211206111045'),
(270, 'em_puncak4.jpeg', '2021-12-06 11:30:35', '9-produk-20211206111045'),
(271, 'em_puncak2.jpg', '2021-12-06 11:30:39', '9-produk-20211206111045'),
(272, 'em_puncak.jpg', '2021-12-06 11:30:41', '9-produk-20211206111045'),
(273, 'WhatsApp_Image_2021-12-03_at_16_33_241.jpeg', '2021-12-06 11:31:10', '9-produk-20211206111045'),
(274, 'bukit-batu-kalsel.JPG', '2021-12-06 12:41:40', '9-produk-20211206124140'),
(280, '1.jpg', '2021-12-06 12:43:47', '9-produk-20211206124332'),
(281, '2.jpg', '2021-12-06 12:43:53', '9-produk-20211206124332'),
(282, '3.jpg', '2021-12-06 12:43:54', '9-produk-20211206124332'),
(283, '4.jpeg', '2021-12-06 12:43:56', '9-produk-20211206124332'),
(284, '5.JPG', '2021-12-06 12:43:58', '9-produk-20211206124332'),
(286, '1_v2.jpg', '2021-12-06 13:10:11', '9-produk-20211206125812'),
(287, 'blg2.jpg', '2021-12-06 13:10:20', '9-produk-20211206125812'),
(288, 'blg1.jpg', '2021-12-06 13:10:29', '9-produk-20211206125812'),
(289, '2_v2.jpg', '2021-12-06 13:11:37', '9-produk-20211206125812'),
(290, 'blg3.jpg', '2021-12-06 13:11:45', '9-produk-20211206125812'),
(293, 'mln1.jpeg', '2021-12-06 13:31:40', '9-produk-20211206013119'),
(294, 'mln2.jpeg', '2021-12-06 13:31:42', '9-produk-20211206013119'),
(295, 'pb5.jpg', '2021-12-06 13:36:48', '9-produk-20211206013647'),
(296, 'pb2.jpeg', '2021-12-06 13:36:48', '9-produk-20211206013647'),
(297, 'pb4.jpeg', '2021-12-06 13:36:48', '9-produk-20211206013647'),
(298, 'pb3.jpg', '2021-12-06 13:36:48', '9-produk-20211206013647'),
(299, 'pb1.jpeg', '2021-12-06 13:36:48', '9-produk-20211206013647'),
(300, 'pb11.jpeg', '2021-12-06 13:37:27', '9-produk-20211206013727'),
(301, 'pb21.jpeg', '2021-12-06 13:37:31', '9-produk-20211206013727'),
(307, 'pb51.jpg', '2021-12-06 13:37:57', '9-produk-20211206013747'),
(308, 'pb41.jpeg', '2021-12-06 13:38:00', '9-produk-20211206013747'),
(309, 'pb31.jpg', '2021-12-06 13:38:02', '9-produk-20211206013747'),
(310, 'pb22.jpeg', '2021-12-06 13:38:04', '9-produk-20211206013747'),
(311, 'pb12.jpeg', '2021-12-06 13:38:06', '9-produk-20211206013747'),
(312, 'pb13.jpeg', '2021-12-06 13:38:49', '9-produk-20211206013849'),
(313, 'pb23.jpeg', '2021-12-06 13:38:52', '9-produk-20211206013849'),
(314, 'pb32.jpg', '2021-12-06 13:38:54', '9-produk-20211206013849'),
(315, 'pb42.jpeg', '2021-12-06 13:38:56', '9-produk-20211206013849'),
(316, 'pb52.jpg', '2021-12-06 13:38:58', '9-produk-20211206013849'),
(317, 'mk4.jpg', '2021-12-06 13:43:36', '9-produk-20211206014336'),
(318, 'mk2.jpg', '2021-12-06 13:43:36', '9-produk-20211206014336'),
(319, 'mk7.jpg', '2021-12-06 13:43:37', '9-produk-20211206014336'),
(320, 'mk3.jpg', '2021-12-06 13:43:37', '9-produk-20211206014336'),
(321, 'mk1.jpeg', '2021-12-06 13:43:37', '9-produk-20211206014336'),
(322, 'mk6.jpg', '2021-12-06 13:43:37', '9-produk-20211206014336'),
(323, 'mk5.jpg', '2021-12-06 13:43:37', '9-produk-20211206014336'),
(324, 'mk11.jpeg', '2021-12-06 13:45:20', '9-produk-20211206014519'),
(325, 'mk21.jpg', '2021-12-06 13:45:28', '9-produk-20211206014519'),
(326, 'mk31.jpg', '2021-12-06 13:45:31', '9-produk-20211206014519'),
(327, 'mk41.jpg', '2021-12-06 13:45:33', '9-produk-20211206014519'),
(328, 'mk51.jpg', '2021-12-06 13:45:36', '9-produk-20211206014519'),
(329, 'mk61.jpg', '2021-12-06 13:45:39', '9-produk-20211206014519'),
(330, 'mk71.jpg', '2021-12-06 13:45:41', '9-produk-20211206014519'),
(331, 'bb1.jpg', '2021-12-06 13:58:58', '9-produk-20211206015857'),
(332, 'bb2.jpg', '2021-12-06 13:58:58', '9-produk-20211206015857'),
(333, 'bb3.jpeg', '2021-12-06 13:59:01', '9-produk-20211206015857'),
(334, 'pba1.jpg', '2021-12-06 14:50:34', '9-produk-20211206025034'),
(335, 'pba2.jpeg', '2021-12-06 14:50:37', '9-produk-20211206025034'),
(336, 'pba3.jpeg', '2021-12-06 14:50:40', '9-produk-20211206025034'),
(337, 'pba4.jpg', '2021-12-06 14:50:42', '9-produk-20211206025034'),
(338, '31.jpg', '2021-12-06 15:01:02', '9-produk-20211206030102'),
(339, '2.jpeg', '2021-12-06 15:01:02', '9-produk-20211206030102'),
(340, '5.jpeg', '2021-12-06 15:01:03', '9-produk-20211206030102'),
(341, '41.jpeg', '2021-12-06 15:01:03', '9-produk-20211206030102'),
(342, '1.jpeg', '2021-12-06 15:01:03', '9-produk-20211206030102'),
(343, '32.jpg', '2021-12-07 08:40:00', '9-produk-20211207083959'),
(344, '21.jpg', '2021-12-07 08:40:09', '9-produk-20211207083959'),
(345, '11.jpg', '2021-12-07 08:40:10', '9-produk-20211207083959'),
(346, '42.jpeg', '2021-12-07 08:40:13', '9-produk-20211207083959'),
(347, '51.JPG', '2021-12-07 08:40:15', '9-produk-20211207083959'),
(348, 'pw2.jpg', '2021-12-07 08:51:44', '9-produk-20211207085144'),
(349, 'pw1.jpg', '2021-12-07 08:51:57', '9-produk-20211207085144'),
(350, 'pw4.jpg', '2021-12-07 08:53:25', '9-produk-20211207085144'),
(351, 'pw3.jpg', '2021-12-07 08:53:25', '9-produk-20211207085144'),
(352, 'jb5.jpg', '2021-12-07 09:22:29', '9-produk-20211207092229'),
(353, 'jb6.jpg', '2021-12-07 09:22:33', '9-produk-20211207092229'),
(354, 'jb4.jpeg', '2021-12-07 09:22:38', '9-produk-20211207092229'),
(355, 'jb3.jpg', '2021-12-07 09:22:40', '9-produk-20211207092229'),
(356, 'jb1.jpeg', '2021-12-07 09:22:43', '9-produk-20211207092229'),
(357, '1_v21.jpg', '2021-12-07 09:34:23', '9-produk-20211207093423'),
(358, 'blg11.jpg', '2021-12-07 09:34:57', '9-produk-20211207093423'),
(359, 'mk12.jpeg', '2021-12-07 09:37:43', '9-produk-20211207093743'),
(360, 'mk22.jpg', '2021-12-07 09:37:48', '9-produk-20211207093743'),
(361, 'mk32.jpg', '2021-12-07 09:37:52', '9-produk-20211207093743'),
(362, 'mk42.jpg', '2021-12-07 09:37:55', '9-produk-20211207093743'),
(363, 'mk52.jpg', '2021-12-07 09:38:01', '9-produk-20211207093743'),
(364, 'mk72.jpg', '2021-12-07 09:38:01', '9-produk-20211207093743'),
(365, 'mk62.jpg', '2021-12-07 09:38:01', '9-produk-20211207093743'),
(366, 'bb11.jpg', '2021-12-07 09:40:01', '9-produk-20211207094001'),
(367, 'bb21.jpg', '2021-12-07 09:40:05', '9-produk-20211207094001'),
(368, 'bb31.jpeg', '2021-12-07 09:40:08', '9-produk-20211207094001'),
(369, '1589529380298.jpg', '2021-12-07 09:43:14', '9-produk-20211207094314'),
(370, '15895293802981.jpg', '2021-12-07 09:43:38', '9-produk-20211207094338'),
(371, '15895293802982.jpg', '2021-12-07 09:44:31', '9-produk-20211207094431'),
(372, '15895293802983.jpg', '2021-12-07 09:45:12', '9-produk-20211207094512'),
(373, '15895293802984.jpg', '2021-12-07 09:46:36', '9-produk-20211207094636'),
(374, '15895293802985.jpg', '2021-12-07 09:47:00', '9-produk-20211207094700'),
(375, '15895293802986.jpg', '2021-12-07 09:47:33', '9-produk-20211207094733'),
(376, 'WhatsApp_Image_2021-12-10_at_09_54_49_(1).jpeg', '2021-12-10 09:12:41', '5-produk-20211210091241'),
(377, 'bibit-porang.jpeg', '2021-12-10 11:24:54', '5-produk-20211210112450'),
(380, 'Bukit_Tamiang_Tinggi.PNG', '2021-12-10 14:01:55', '5-produk-20211210020115'),
(381, '7.PNG', '2021-12-10 14:02:21', '5-produk-20211210020221'),
(383, 'Bukit_Tamiang_Tinggi2.PNG', '2021-12-10 14:10:04', '5-produk-20211210020232'),
(384, 'Gunung_Birah.PNG', '2021-12-10 19:50:06', '5-produk-20211210075006'),
(385, 'water_gel_blaster_gunung_birah.PNG', '2021-12-12 19:01:51', '5-produk-20211212070150'),
(386, 'HHBK_PORANG.PNG', '2021-12-13 08:41:54', '5-produk-20211213084154'),
(387, 'tpd_1.jpg', '2021-12-13 09:01:24', '5-produk-20211213090124'),
(388, 'HHBK_4.png', '2021-12-16 07:42:03', '5-produk-20211216074203'),
(389, 'HHBK_1.png', '2021-12-16 07:47:11', '5-produk-20211216074711'),
(390, 'HHBK_3.PNG', '2021-12-16 07:47:44', '5-produk-20211216074744'),
(391, 'HHBK_2.png', '2021-12-16 07:48:47', '5-produk-20211216074847'),
(392, 'HHBK_3.png', '2021-12-16 09:57:56', '5-produk-20211216095756'),
(393, 'WhatsApp_Image_2021-12-22_at_14_57_14_(1).jpeg', '2021-12-22 14:08:42', '2-produk-20211222020841'),
(394, 'WhatsApp_Image_2021-12-22_at_14_57_14.jpeg', '2021-12-22 14:08:42', '2-produk-20211222020841'),
(395, 'Kemiri_Biji.jpg', '2021-12-30 10:58:18', '8-produk-20211230105818'),
(396, 'Kemiri_Kupas.jpg', '2021-12-30 10:58:18', '8-produk-20211230105818'),
(397, 'Kayu_Manis_Batang.jpg', '2021-12-30 10:58:18', '8-produk-20211230105818'),
(398, 'Kayu_Manis_Batang1.jpg', '2021-12-30 11:17:17', '8-produk-20211230111717'),
(399, 'Kemiri_Kupas1.jpg', '2021-12-30 11:17:17', '8-produk-20211230111717'),
(400, 'Kemiri_Biji1.jpg', '2021-12-30 11:17:17', '8-produk-20211230111717'),
(415, 'Kemiri_Kupas11.jpg', '2021-12-30 12:18:39', '8-produk-20211230121724'),
(416, 'HHBK_3.png', '2021-12-31 07:20:55', '5-produk-20211231072055'),
(417, 'HHBK_31.png', '2021-12-31 07:21:13', '5-produk-20211231072113'),
(418, 'HHBK-KPH_TANAH_LAUT(MADU_KELULUT_SAHABAT_MADU).jpeg', '2021-12-31 07:24:17', '5-produk-20211231072417'),
(419, 'HHBK-KPH_TANAH_LAUT(MADU_KELULUT_UJUNG_BATU)_2.PNG', '2021-12-31 07:25:11', '5-produk-20211231072511'),
(420, 'HHBK-KPH_TANAH_LAUT(MADU_KELULUTKATUNUN).png', '2021-12-31 07:26:58', '5-produk-20211231072658'),
(421, '1_(16).jpeg', '2021-12-31 07:44:51', '5-produk-20211231074451'),
(422, 'JASLING_WATER_GEL_BLASTER.PNG', '2021-12-31 07:46:04', '5-produk-20211231074604'),
(423, 'PORANG.jpg', '2021-12-31 07:47:44', '5-produk-20211231074744'),
(424, 'DW_5.PNG', '2021-12-31 07:51:38', '5-produk-20211231075138'),
(425, 'DW_6.PNG', '2021-12-31 07:54:56', '5-produk-20211231075456'),
(426, 'WhatsApp_Image_2022-01-12_at_14_22_46.jpeg', '2022-01-12 13:23:26', '88-produk-20220112012326'),
(427, 'WhatsApp_Image_2022-01-12_at_14_22_45.jpeg', '2022-01-12 13:23:27', '88-produk-20220112012326'),
(428, 'WhatsApp_Image_2022-01-12_at_14_22_45_(1).jpeg', '2022-01-12 13:23:27', '88-produk-20220112012326'),
(429, 'WhatsApp_Image_2022-01-12_at_14_22_46.jpeg', '2022-01-12 13:29:16', '88-produk-20220112012916'),
(430, 'WhatsApp_Image_2022-01-12_at_14_22_45_(1).jpeg', '2022-01-12 13:36:14', '88-produk-20220112013614'),
(431, 'WhatsApp_Image_2022-01-12_at_14_22_45.jpeg', '2022-01-12 13:41:48', '88-produk-20220112014148'),
(432, 'serbuk_gula_aren.jpg', '2022-01-20 10:50:34', '1-produk-20220120105034'),
(433, 'Madu_Kelulut1.jpeg', '2022-01-20 11:29:23', '1-produk-20220120112923'),
(434, 'Madu_Kelulut2.jpeg', '2022-01-20 11:35:17', '1-produk-20220120113517'),
(435, 'Madu_Hutan.jpeg', '2022-01-20 11:38:39', '1-produk-20220120113839'),
(436, 'Kopi_Gula_Aren_Kayu_Manis.jpg', '2022-01-24 10:01:38', '1-produk-20220124100138'),
(437, 'Kopi_Pamungkas.jpg', '2022-01-24 10:10:10', '1-produk-20220124101010'),
(438, 'madu_manis_1.jpg', '2022-01-24 14:40:59', '88-produk-20220124024059'),
(439, 'madu_manis_2.jpg', '2022-01-24 14:45:56', '88-produk-20220124024556'),
(440, 'madu_manis_3.jpg', '2022-01-24 14:51:58', '88-produk-20220124025158'),
(441, 'KELULUT_100.jpg', '2022-01-24 15:14:31', '88-produk-20220124031431'),
(442, 'Kopi_gng_batu_kumpay.jpeg', '2022-01-25 09:25:54', '1-produk-20220125092554'),
(443, 'villa4.jpeg', '2022-01-26 09:34:48', '9-produk-20220126093448'),
(444, '1_(4).jpeg', '2022-01-26 09:38:13', '5-produk-20220126093813'),
(445, '1_(13).jpeg', '2022-01-26 09:38:31', '5-produk-20220126093813'),
(446, '1_(22).jpeg', '2022-01-26 09:38:47', '5-produk-20220126093813'),
(447, '1_(21).jpeg', '2022-01-26 09:38:55', '5-produk-20220126093813'),
(448, '0a0eaef8-d792-4704-a635-98a5e928bdca.jpg', '2022-01-26 09:39:57', '8-produk-20220126093957'),
(449, '8.PNG', '2022-01-26 09:40:55', '5-produk-20220126094055'),
(450, '12.jpg', '2022-01-26 09:41:34', '5-produk-20220126094055'),
(451, '10.jpg', '2022-01-26 09:42:12', '5-produk-20220126094055'),
(452, 'e50cc3f3-84c7-48d8-a210-15f3100d6754.jpg', '2022-01-26 09:42:39', '8-produk-20220126094239'),
(453, 'HHBK-KPH_TANAH_LAUT(BUAH_KEMIRI_BATUKURA)2.jpg', '2022-01-26 09:45:31', '5-produk-20220126094531'),
(454, '81.PNG', '2022-01-26 09:46:51', '5-produk-20220126094651'),
(455, '101.jpg', '2022-01-26 09:47:03', '5-produk-20220126094651'),
(456, '53f5852a-4c8f-4538-b48a-137cbdcc0c52.jpg', '2022-01-26 09:47:34', '88-produk-20220126094734'),
(457, '82.PNG', '2022-01-26 09:48:18', '5-produk-20220126094817'),
(458, '102.jpg', '2022-01-26 09:48:29', '5-produk-20220126094817'),
(459, '121.jpg', '2022-01-26 09:48:40', '5-produk-20220126094817'),
(460, 'HHBK-KPH_TANAH_LAUT(BUAH_KEMIRI_BATUKURA)3.jpg', '2022-01-26 09:48:53', '5-produk-20220126094817'),
(461, 'HHBK-KPH_TANAH_LAUT(BUAH_KEMIRI_BATUKURA)4.jpg', '2022-01-26 09:49:57', '5-produk-20220126094957'),
(462, 'villa1.jpeg', '2022-01-26 09:50:14', '9-produk-20220126095014'),
(463, '83.PNG', '2022-01-26 09:50:18', '5-produk-20220126094957'),
(464, '122.jpg', '2022-01-26 09:50:39', '5-produk-20220126094957'),
(465, '103.jpg', '2022-01-26 09:50:51', '5-produk-20220126094957'),
(466, '3.PNG', '2022-01-26 09:53:00', '5-produk-20220126095259'),
(467, 'IMG-20201021-WA0020.jpg', '2022-01-26 09:53:02', '88-produk-20220126095302'),
(468, '4.PNG', '2022-01-26 09:53:13', '5-produk-20220126095259'),
(469, '11.PNG', '2022-01-26 09:53:24', '5-produk-20220126095259'),
(470, 'IMG-20201021-WA0018.jpg', '2022-01-26 09:54:08', '88-produk-20220126095302'),
(471, 'IMG-20201021-WA0023.jpg', '2022-01-26 09:54:11', '88-produk-20220126095302'),
(472, 'IMG-20201021-WA0021.jpg', '2022-01-26 09:54:16', '88-produk-20220126095302'),
(473, '1_(22)1.jpeg', '2022-01-26 09:55:28', '5-produk-20220126095528'),
(474, '1_(2).jpeg', '2022-01-26 09:55:36', '5-produk-20220126095528'),
(475, '1_(13)1.jpeg', '2022-01-26 09:55:49', '5-produk-20220126095528'),
(476, '1_(13)2.jpeg', '2022-01-26 09:56:20', '5-produk-20220126095528'),
(477, '1_(4)1.jpeg', '2022-01-26 09:56:28', '5-produk-20220126095528'),
(478, '1_(22)2.jpeg', '2022-01-26 09:57:54', '5-produk-20220126095754'),
(479, '1_(1).jpeg', '2022-01-26 09:58:05', '5-produk-20220126095754'),
(480, '1_(3).jpeg', '2022-01-26 09:58:16', '5-produk-20220126095754'),
(481, '1_(21)1.jpeg', '2022-01-26 09:58:25', '5-produk-20220126095754'),
(482, '1_(13)3.jpeg', '2022-01-26 09:58:43', '5-produk-20220126095754'),
(483, '9d45a443-3bc9-4142-a4df-5b210ec9ee5a.jpg', '2022-01-26 10:00:20', '88-produk-20220126100020'),
(484, 'villa11.jpeg', '2022-01-26 10:01:35', '9-produk-20220126100135'),
(485, 'Bukit_Tamiang_Tinggi1.PNG', '2022-01-26 10:01:37', '5-produk-20220126100137'),
(487, '5.PNG', '2022-01-26 10:01:55', '5-produk-20220126100137'),
(488, '84.PNG', '2022-01-26 10:02:11', '5-produk-20220126100137'),
(489, '71.PNG', '2022-01-26 10:02:28', '5-produk-20220126100137'),
(490, 'villa10.jpeg', '2022-01-26 10:04:39', '9-produk-20220126100135'),
(491, 'villa12.jpeg', '2022-01-26 10:04:55', '9-produk-20220126100135'),
(492, 'villa2.jpeg', '2022-01-26 10:05:19', '9-produk-20220126100135'),
(493, 'villa5.jpeg', '2022-01-26 10:05:21', '9-produk-20220126100135'),
(494, 'villa8.jpeg', '2022-01-26 10:05:29', '9-produk-20220126100135'),
(495, 'villa9.jpeg', '2022-01-26 10:05:34', '9-produk-20220126100135'),
(496, 'IMG-20190316-WA0014.jpg', '2022-01-26 10:07:50', '88-produk-20220126100750'),
(497, '38b5d5c1-acc3-4449-85b5-2364424582f6.jpg', '2022-01-26 10:09:03', '8-produk-20220126100903'),
(498, '38b5d5c1-acc3-4449-85b5-2364424582f61.jpg', '2022-01-26 10:11:27', '8-produk-20220126101126'),
(499, 'IMG-20201022-WA0054.jpg', '2022-01-26 10:14:07', '88-produk-20220126101407'),
(500, 'IMG-20201022-WA0053.jpg', '2022-01-26 10:14:16', '88-produk-20220126101407'),
(501, '3cba2012-376b-49cf-8f69-314e7b31ac09.jpg', '2022-01-26 10:16:09', '8-produk-20220126101609'),
(502, 'HHBK-KPH_TANAH_LAUT_GULA_AREN.jpg', '2022-01-26 10:19:16', '5-produk-20220126101916'),
(503, 'HHBK-KPH_TANAH_LAUT(GULA_MERAH_AREN)1.jpg', '2022-01-26 10:19:38', '5-produk-20220126101916'),
(504, '4b202395-3e5f-40a8-a6ee-12aed7b0a015.jpg', '2022-01-26 10:23:13', '88-produk-20220126102313'),
(505, '64c8b99d-e3ff-4d4e-82cf-5e6abdf73e7e.jpg', '2022-01-26 10:27:49', '88-produk-20220126102749'),
(506, 'IMG-20190316-WA0012.jpg', '2022-01-26 10:30:29', '88-produk-20220126103029'),
(507, '914bdcd2-9f9e-4f76-8e4f-b01e72a7271a.jpg', '2022-01-26 10:32:28', '88-produk-20220126103228'),
(508, 'tpd_11.jpg', '2022-01-26 10:32:35', '5-produk-20220126103235'),
(509, 'tpd2.PNG', '2022-01-26 10:32:47', '5-produk-20220126103235'),
(510, 'tpd3.PNG', '2022-01-26 10:33:27', '5-produk-20220126103235'),
(511, 'tpd.PNG', '2022-01-26 10:33:53', '5-produk-20220126103235'),
(512, 'IMG-20201024-WA0019.jpg', '2022-01-26 10:43:53', '88-produk-20220126104352'),
(513, 'bibit-porang1.jpeg', '2022-01-26 10:44:55', '5-produk-20220126104455'),
(514, 'bibit_porang.PNG', '2022-01-26 10:45:12', '5-produk-20220126104455'),
(515, 'bibit_porang2.PNG', '2022-01-26 10:45:22', '5-produk-20220126104455'),
(516, 'bibit_porang3.PNG', '2022-01-26 10:45:30', '5-produk-20220126104455'),
(517, 'cg4.jpeg', '2022-01-26 10:49:35', '9-produk-20220126104935'),
(518, 'cg3.jpeg', '2022-01-26 10:49:47', '9-produk-20220126104935'),
(519, 'sirup_kayu_manis.jpeg', '2022-01-26 10:49:49', '3-produk-20220126104949'),
(520, 'cg2.jpeg', '2022-01-26 10:49:52', '9-produk-20220126104935'),
(521, 'cg1.jpeg', '2022-01-26 10:49:54', '9-produk-20220126104935'),
(522, 'madu_kelulut.jpeg', '2022-01-26 10:50:28', '3-produk-20220126105028'),
(523, 'tas_tangan_bambu.jpeg', '2022-01-26 10:52:10', '3-produk-20220126105209'),
(524, 'tempat_pensil_rotan.jpeg', '2022-01-26 10:55:55', '3-produk-20220126105555'),
(525, 'HHBK-KPH_TANAH_LAUT(GULA_MERAH_AREN)2.jpg', '2022-01-26 10:59:43', '5-produk-20220126105931'),
(526, 'rempah_minjangan.jpg', '2022-01-26 11:01:03', '3-produk-20220126110103'),
(527, 'arung_jeram.jpg', '2022-01-26 11:05:09', '3-produk-20220126110509'),
(528, 'Unknown58.jpg', '2022-01-26 11:12:14', '88-produk-20220126111214'),
(529, '20200211_174613.jpg', '2022-01-26 11:13:38', '88-produk-20220126111337'),
(530, 'IMG-20201022-WA0060.jpg', '2022-01-26 11:20:24', '88-produk-20220126112024'),
(531, '20200123_163235.jpg', '2022-01-26 11:20:38', '88-produk-20220126112024'),
(532, 'sumaragi.JPG', '2022-01-26 11:25:31', '3-produk-20220126112531'),
(533, 'IMG-20201022-WA0051.jpg', '2022-01-26 11:29:25', '88-produk-20220126112924'),
(534, '20190316_145652.jpg', '2022-01-26 11:29:51', '88-produk-20220126112924'),
(535, 'IMG-20190316-WA0033.jpg', '2022-01-26 11:34:36', '88-produk-20220126113436'),
(536, 'IMG-20190316-WA0041.jpg', '2022-01-26 11:34:42', '88-produk-20220126113436'),
(537, 'IMG-20201022-WA0058.jpg', '2022-01-26 11:34:51', '88-produk-20220126113436'),
(538, 'IMG-20190316-WA0040.jpg', '2022-01-26 12:58:03', '88-produk-20220126125803'),
(539, 'IMG-20190316-WA0058.jpg', '2022-01-26 12:58:09', '88-produk-20220126125803'),
(540, 'IMG_7300_copy.jpg', '2022-01-26 13:03:03', '88-produk-20220126010302'),
(541, 'IMG-20201019-WA0027.jpg', '2022-01-26 13:03:09', '88-produk-20220126010302'),
(542, 'IMG-20190316-WA0043.jpg', '2022-01-26 13:23:45', '88-produk-20220126012345'),
(543, 'IMG-20190316-WA0035.jpg', '2022-01-26 13:23:54', '88-produk-20220126012345'),
(544, '8ec1fbca-8b2a-418a-b3c3-9ed73076b55f.jpg', '2022-01-26 13:56:18', '88-produk-20220126015618'),
(545, 'air_terjun_ceria.jpg', '2022-02-03 10:28:55', '6-produk-20220203102855'),
(546, 'air_terjun_batis_langkupan.jpg', '2022-02-03 10:32:05', '6-produk-20220203103205'),
(547, 'sungai_riam_rindang.jpg', '2022-02-03 10:34:26', '6-produk-20220203103426'),
(548, 'goa_sugung_km_47.png', '2022-02-03 10:36:20', '6-produk-20220203103620'),
(549, 'tumampang_raya.jpg', '2022-02-03 10:37:55', '6-produk-20220203103755'),
(550, 'air_terjun_mandin_damar_1.png', '2022-02-03 10:38:30', '6-produk-20220203103830'),
(551, 'air_terjun_mandin_damar.jpg', '2022-02-03 10:40:39', '6-produk-20220203104039'),
(552, 'air_terjun_mandin_damar_11.png', '2022-02-03 10:41:10', '6-produk-20220203104039'),
(553, 'ef2b064a-a1d7-4aec-a478-70c328edf0f7.jpg', '2022-02-03 10:50:32', '6-produk-20220203104252'),
(554, 'ef2b064a-a1d7-4aec-a478-70c328edf0f71.jpg', '2022-02-03 10:52:04', '6-produk-20220203105204'),
(555, 'ce056a37-c9cf-4612-8539-ff9419a2cb67.jpg', '2022-02-03 10:52:17', '6-produk-20220203105204'),
(557, 'b1010564-fd4a-416f-8eb5-ad42eca64737.jpg', '2022-02-03 10:52:54', '6-produk-20220203105204'),
(558, '_MG_7061.JPG', '2022-02-03 11:33:49', '6-produk-20220203113349'),
(559, 'IMG_7127.JPG', '2022-02-03 11:34:21', '6-produk-20220203113349'),
(560, 'IMG_7123.JPG', '2022-02-03 11:34:42', '6-produk-20220203113349'),
(561, 'IMG_7099.JPG', '2022-02-03 11:35:22', '6-produk-20220203113349'),
(562, '69525581_176584323386743_734504231923426119_n.jpg', '2022-02-03 11:57:21', '6-produk-20220203115721'),
(563, 'e0e5a5af-90f0-4c46-b5e0-a5016089bc63.jpg', '2022-02-03 12:13:41', '6-produk-20220203121341'),
(564, 'jamur_tiram_ayu.png', '2022-02-04 09:16:09', '5-produk-20220204091609'),
(565, 'madu_lebah_pelaihari.png', '2022-02-04 09:25:04', '5-produk-20220204092503'),
(566, 'MK_Rajamadu_250ml.png', '2022-02-04 09:29:05', '5-produk-20220204092904'),
(567, 'MK_Sakatalu.png', '2022-02-04 09:42:38', '5-produk-20220204094238'),
(568, 'MK_katunun.png', '2022-02-04 10:28:15', '5-produk-20220204102815'),
(569, 'MK_sahabat_madu.png', '2022-02-04 10:30:30', '5-produk-20220204103029'),
(570, 'jahe_merah_instan_2.png', '2022-02-04 10:32:45', '5-produk-20220204103244'),
(571, 'beras_merah_code.jpg', '2022-02-04 10:36:00', '88-produk-20220204103600'),
(572, 'permen_gula_aren_code.jpg', '2022-02-04 10:36:28', '88-produk-20220204103628'),
(573, 'kopi_pasak_bumi_code.jpg', '2022-02-04 10:37:02', '88-produk-20220204103702'),
(574, 'serbuk_gula_aren_code.jpg', '2022-02-04 10:37:56', '88-produk-20220204103756'),
(575, 'minyak_kemiri_code.jpg', '2022-02-04 10:42:04', '88-produk-20220204104204'),
(576, 'pasak_bumi_code.jpg', '2022-02-04 10:55:39', '88-produk-20220204105539'),
(577, 'kopi_pasak_bumi_code1.jpg', '2022-02-04 10:55:46', '88-produk-20220204105539'),
(578, 'kemiri_kupas_code.jpg', '2022-02-04 10:56:30', '88-produk-20220204105629'),
(579, 'ting_jahe_code.jpg', '2022-02-04 10:56:49', '88-produk-20220204105648'),
(580, 'kerupuk_jengkol_code.jpg', '2022-02-04 10:57:15', '88-produk-20220204105714'),
(581, 'kerupuk_kayumanis_code.jpg', '2022-02-04 10:57:36', '88-produk-20220204105736'),
(582, 'kemiri_cangkang_code.jpg', '2022-02-04 10:58:34', '88-produk-20220204105833'),
(583, 'aren_code.jpg', '2022-02-04 11:12:47', '88-produk-20220204111247'),
(584, 'serbuk_kyu_manis_code.jpg', '2022-02-04 11:13:02', '88-produk-20220204111302'),
(585, 'jamur_code.jpg', '2022-02-04 11:13:13', '88-produk-20220204111313'),
(586, 'kopi_pasak_bumi_ori_code.jpg', '2022-02-04 11:13:26', '88-produk-20220204111326'),
(587, 'minyak_serai_code.jpg', '2022-02-04 11:13:38', '88-produk-20220204111338'),
(588, 'sirup_code.jpg', '2022-02-04 11:13:55', '88-produk-20220204111354'),
(589, 'jahe_code.JPG', '2022-02-04 11:25:27', '88-produk-20220204112527'),
(590, 'temulawak_code.jpg', '2022-02-04 11:25:44', '88-produk-20220204112544'),
(591, 'kunyit_code.jpg', '2022-02-04 11:26:01', '88-produk-20220204112601'),
(592, 'serai_code.jpg', '2022-02-04 11:26:21', '88-produk-20220204112621'),
(593, 'seraii_code.jpg', '2022-02-04 11:26:28', '88-produk-20220204112621'),
(594, 'kelulut_100_code.jpg', '2022-02-04 11:39:37', '88-produk-20220204113937'),
(595, 'manis_250_cide.jpg', '2022-02-04 11:39:52', '88-produk-20220204113951'),
(596, 'manis_1000_code.jpg', '2022-02-04 11:40:04', '88-produk-20220204114004'),
(597, 'manis_code.jpg', '2022-02-04 11:40:24', '88-produk-20220204114024'),
(598, 'pahitt_code.jpg', '2022-02-04 11:40:48', '88-produk-20220204114048'),
(599, 'pahit_cide.jpg', '2022-02-04 11:40:54', '88-produk-20220204114048'),
(600, 'MK_tanah_laut.png', '2022-02-04 11:50:44', '5-produk-20220204115044'),
(601, 'MK_katunun1.png', '2022-02-04 11:51:01', '5-produk-20220204115101'),
(602, 'MK_sahabat_madu1.png', '2022-02-04 11:51:14', '5-produk-20220204115114'),
(603, 'MK_sakatalu.png', '2022-02-04 11:51:28', '5-produk-20220204115127'),
(604, 'MK_rajamadu_250ml.png', '2022-02-04 11:51:44', '5-produk-20220204115144'),
(605, 'madu_lebah_pelaihari1.png', '2022-02-04 11:52:06', '5-produk-20220204115206'),
(606, 'jamur_ayu.png', '2022-02-04 11:52:19', '5-produk-20220204115219'),
(607, 'temulawak_instan.png', '2022-02-04 11:52:36', '5-produk-20220204115236'),
(608, 'ML_telaga.png', '2022-02-04 11:53:18', '5-produk-20220204115318'),
(609, 'jamur_syifa.png', '2022-02-04 11:53:46', '5-produk-20220204115345'),
(610, 'MK_rajamadu_100ml.png', '2022-02-04 11:54:09', '5-produk-20220204115408'),
(611, 'MK_kuning.png', '2022-02-04 11:54:37', '5-produk-20220204115437'),
(612, 'bee_pollen.png', '2022-02-04 12:07:32', '5-produk-20220204120732'),
(613, 'kunyit_instan.png', '2022-02-04 12:07:58', '5-produk-20220204120758'),
(614, 'kopi_banua.png', '2022-02-04 12:08:08', '5-produk-20220204120808'),
(615, 'gula_aren.png', '2022-02-04 12:08:32', '5-produk-20220204120832'),
(621, 'kemiri.png', '2022-02-04 12:12:44', '5-produk-20220204121125'),
(622, '85.PNG', '2022-02-04 12:12:59', '5-produk-20220204121125'),
(623, '10.PNG', '2022-02-04 12:13:07', '5-produk-20220204121125'),
(624, '104.jpg', '2022-02-04 12:13:12', '5-produk-20220204121125'),
(625, '123.jpg', '2022-02-04 12:13:17', '5-produk-20220204121125'),
(626, 'porang.png', '2022-02-04 12:16:46', '5-produk-20220204121646'),
(627, 'briket_arang.png', '2022-02-04 12:20:03', '5-produk-20220204122003'),
(628, 'porangg.png', '2022-02-04 12:24:56', '5-produk-20220204122456'),
(629, 'manis_1000_code1.jpg', '2022-02-07 07:32:11', '88-produk-20220207073211'),
(630, 'manis_1000_cde.jpg', '2022-02-07 07:32:12', '88-produk-20220207073211'),
(631, 'manis_1000_cde1.jpg', '2022-02-07 07:33:15', '88-produk-20220207073315'),
(632, 'manis_1000_code2.jpg', '2022-02-07 07:33:23', '88-produk-20220207073315'),
(633, 'manis_500_code.jpg', '2022-02-07 07:35:18', '88-produk-20220207073517'),
(634, 'hitam_250_code.jpg', '2022-02-07 07:35:57', '88-produk-20220207073556'),
(635, 'hitam_250_cd.jpg', '2022-02-07 07:36:06', '88-produk-20220207073556'),
(636, 'hitam_500_code.jpg', '2022-02-07 07:36:55', '88-produk-20220207073655'),
(637, 'kelulut_500_code.jpg', '2022-02-07 07:38:09', '88-produk-20220207073808'),
(638, 'kelulut_500_code1.jpg', '2022-02-07 07:40:37', '88-produk-20220207074037'),
(639, 'MK_sakatalu1.png', '2022-02-07 09:20:37', '5-produk-20220207092036'),
(640, 'MK_sakatalu2.png', '2022-02-07 09:21:26', '5-produk-20220207092126'),
(641, 'MK_sakatalu3.png', '2022-02-07 09:23:40', '5-produk-20220207092340'),
(642, 'MK_sakatalu_100ml.png', '2022-02-07 09:33:13', '5-produk-20220207093313'),
(643, 'MK_sakatalu_50ml.png', '2022-02-07 09:33:35', '5-produk-20220207093335'),
(644, 'MK_sakatalu_500ml.png', '2022-02-07 09:33:55', '5-produk-20220207093355'),
(645, 'jamur_tiram.png', '2022-02-07 10:05:21', '5-produk-20220207100521'),
(646, 'jamur_2.jpg', '2022-02-07 10:06:10', '5-produk-20220207100521'),
(647, 'jamur_3.jpg', '2022-02-07 10:06:15', '5-produk-20220207100521'),
(648, 'jamur_4.jpeg', '2022-02-07 10:06:21', '5-produk-20220207100521'),
(649, 'Tepi_danau_PTP.png', '2022-02-07 10:13:25', '5-produk-20220207101325'),
(650, 'tpd31.PNG', '2022-02-07 10:13:44', '5-produk-20220207101325'),
(651, 'KJ1.jpg', '2022-02-07 10:13:51', '5-produk-20220207101325'),
(652, 'tpd1.PNG', '2022-02-07 10:13:57', '5-produk-20220207101325'),
(653, 'tpd21.PNG', '2022-02-07 10:14:04', '5-produk-20220207101325'),
(654, 'WATER_GEL_GAME.png', '2022-02-07 10:23:48', '5-produk-20220207102348'),
(655, 'WATER_GEL_GAME1.png', '2022-02-07 10:24:53', '5-produk-20220207102453'),
(656, '1_(18).jpeg', '2022-02-07 10:25:20', '5-produk-20220207102453'),
(657, '1_(19).jpeg', '2022-02-07 10:25:26', '5-produk-20220207102453'),
(658, '1_(17).jpeg', '2022-02-07 10:25:35', '5-produk-20220207102453'),
(659, '1_(8).jpeg', '2022-02-07 10:25:44', '5-produk-20220207102453'),
(660, 'WATER_GEL_GAME2.png', '2022-02-07 10:30:32', '5-produk-20220207103032'),
(661, '1.JPG', '2022-02-07 10:30:49', '5-produk-20220207103032'),
(662, '2.JPG', '2022-02-07 10:30:59', '5-produk-20220207103032'),
(663, '3.JPG', '2022-02-07 10:30:59', '5-produk-20220207103032'),
(664, 'GUNUNG_BIRAH.png', '2022-02-07 10:41:55', '5-produk-20220207104155'),
(665, 'GB_5.JPG', '2022-02-07 10:42:17', '5-produk-20220207104155'),
(666, 'GB_2.JPG', '2022-02-07 10:42:38', '5-produk-20220207104155'),
(668, '1_(22)3.jpeg', '2022-02-07 10:42:58', '5-produk-20220207104155'),
(669, 'GB_3.JPG', '2022-02-07 10:43:47', '5-produk-20220207104155'),
(670, 'Bibit_porang.png', '2022-02-07 10:52:33', '5-produk-20220207105233'),
(671, 'bibit_porang.jpg', '2022-02-07 10:52:41', '5-produk-20220207105233'),
(672, 'bibit_porang3.png', '2022-02-07 10:52:58', '5-produk-20220207105233'),
(673, 'bibit_porang_1.jpg', '2022-02-07 10:53:03', '5-produk-20220207105233'),
(674, 'GOA_MARMER.png', '2022-02-07 10:57:20', '5-produk-20220207105720'),
(675, 'GUNUNG_DAMAR_WULAN.png', '2022-02-07 11:02:03', '5-produk-20220207110203'),
(676, 'DW_61.PNG', '2022-02-07 11:02:33', '5-produk-20220207110203'),
(677, 'DW_4.PNG', '2022-02-07 11:02:40', '5-produk-20220207110203'),
(678, 'DW_2.PNG', '2022-02-07 11:02:42', '5-produk-20220207110203'),
(679, 'DW_3.PNG', '2022-02-07 11:02:42', '5-produk-20220207110203'),
(680, 'GUNUNG_KATUNUN.png', '2022-02-07 11:25:11', '5-produk-20220207112511'),
(681, 'bk2.PNG', '2022-02-07 11:25:31', '5-produk-20220207112511'),
(682, 'bk1.PNG', '2022-02-07 11:25:31', '5-produk-20220207112511'),
(683, 'bk4.PNG', '2022-02-07 11:25:34', '5-produk-20220207112511'),
(684, 'GUNUNG_TAMIANG_TINGGI.png', '2022-02-07 11:35:11', '5-produk-20220207113511'),
(685, '86.PNG', '2022-02-07 11:36:38', '5-produk-20220207113511'),
(686, '51.PNG', '2022-02-07 11:36:44', '5-produk-20220207113511'),
(687, '72.PNG', '2022-02-07 11:36:44', '5-produk-20220207113511'),
(688, '6.PNG', '2022-02-07 11:36:45', '5-produk-20220207113511'),
(689, 'GUNUNG_PRIANGAN.png', '2022-02-07 11:52:42', '5-produk-20220207115242'),
(690, '11.JPG', '2022-02-07 11:52:56', '5-produk-20220207115242'),
(691, '21.JPG', '2022-02-07 11:53:04', '5-produk-20220207115242'),
(692, '41.PNG', '2022-02-07 11:53:13', '5-produk-20220207115242'),
(693, '4.JPG', '2022-02-07 11:53:21', '5-produk-20220207115242'),
(694, 'madu_lebah_pelaihari2.png', '2022-02-08 07:48:59', '5-produk-20220208074859'),
(695, 'madu_lebah_pelaihari3.png', '2022-02-08 07:50:44', '5-produk-20220208075043'),
(696, 'madu_lebah_pelaihari_100ml.png', '2022-02-08 07:58:11', '5-produk-20220208075811'),
(697, 'madu_lebah_pelaihari_150ml.png', '2022-02-08 08:00:15', '5-produk-20220208080015'),
(698, 'WhatsApp_Image_2022-02-09_at_19_57_45_(1).jpeg', '2022-02-10 11:20:07', '8-produk-20220210112007'),
(701, 'WhatsApp_Image_2022-02-09_at_19_57_45.jpeg', '2022-02-10 11:26:39', '8-produk-20220210112345'),
(702, '0185c8db-005e-4aa0-b6cf-9a47592faaa1.jpg', '2022-02-10 12:00:31', '8-produk-20220210120031'),
(703, '5f2ae646-912e-447d-b597-40e834748ece.jpg', '2022-02-10 12:19:06', '8-produk-20220210121906'),
(704, 'df8fa328-2674-4243-bbb5-edb4ce9f0374.jpg', '2022-02-17 09:06:44', '6-produk-20220217090644'),
(705, 'f7129f6c-ea4e-45a8-928f-5456ebb0f719.jpg', '2022-02-17 09:06:55', '6-produk-20220217090644'),
(706, '6f6af218-e79e-4456-a41b-85abb70ab543.jpg', '2022-02-17 09:07:02', '6-produk-20220217090644'),
(707, 'df8fa328-2674-4243-bbb5-edb4ce9f03741.jpg', '2022-02-17 09:09:20', '6-produk-20220217090920'),
(708, 'f7129f6c-ea4e-45a8-928f-5456ebb0f7191.jpg', '2022-02-17 09:09:26', '6-produk-20220217090920'),
(709, '6f6af218-e79e-4456-a41b-85abb70ab5431.jpg', '2022-02-17 09:09:38', '6-produk-20220217090920'),
(710, 'kopi_jahe_gula_aren_150.jpg', '2022-02-21 09:59:20', '88-produk-20220221095920'),
(711, 'kopi_jahe_pasak_bumi_150.jpg', '2022-02-21 10:01:55', '88-produk-20220221100155'),
(712, 'jahe_merah_gula_aren_150.jpg', '2022-02-21 10:04:14', '88-produk-20220221100414'),
(713, 'kopi_jahe_bajakah_150.jpg', '2022-02-21 10:19:41', '88-produk-20220221101940'),
(714, 'kopi_jahe_bajakah_50.jpg', '2022-02-21 10:21:13', '88-produk-20220221102112'),
(715, 'jahe_merah_gula_aren_50.jpg', '2022-02-21 10:22:53', '88-produk-20220221102253'),
(716, 'kopi_jahe_pasak_bumi_50.jpg', '2022-02-21 10:24:04', '88-produk-20220221102404'),
(717, 'jahe_merah_gula_aren_501.jpg', '2022-02-21 10:25:34', '88-produk-20220221102533'),
(718, '15.jpg', '2022-02-22 10:00:01', '9-produk-20220222100001'),
(719, 'upload5.jpg', '2022-02-22 10:00:04', '9-produk-20220222100001'),
(720, 'a1.jpg', '2022-02-22 10:00:09', '9-produk-20220222100001'),
(721, '111.jpg', '2022-02-22 10:00:20', '9-produk-20220222100001'),
(722, 'IMG_20200826_151636.jpg', '2022-02-22 10:00:50', '9-produk-20220222100001'),
(724, '7_1.jpg', '2022-02-22 14:02:24', '9-produk-20220222015957'),
(725, '8.jpg', '2022-02-22 14:03:23', '9-produk-20220222015957'),
(726, 'Air-Terjun-Kahung-2.jpg', '2022-02-22 14:03:32', '9-produk-20220222015957'),
(727, '151.jpg', '2022-02-22 14:03:33', '9-produk-20220222015957'),
(728, 'upload51.jpg', '2022-02-22 14:03:33', '9-produk-20220222015957'),
(729, 'Picture9.jpg', '2022-02-22 14:03:35', '9-produk-20220222015957'),
(730, '112.jpg', '2022-02-22 14:03:45', '9-produk-20220222015957'),
(731, 'bibit_porang31.png', '2022-02-24 08:15:32', '5-produk-20220224081532'),
(734, 'madu1.jpg', '2022-02-24 11:27:59', '108-produk-20220224112759'),
(735, 'madu.jpg', '2022-02-24 11:28:10', '108-produk-20220224112759'),
(736, 'madu_kelulut.png', '2022-02-25 10:56:10', '5-produk-20220225105610'),
(737, 'rajamadu_100.png', '2022-02-25 10:56:35', '5-produk-20220225105635'),
(738, 'madu_rajamadu_100.png', '2022-02-25 10:56:54', '5-produk-20220225105654'),
(739, 'bee_pollen1.png', '2022-02-25 10:57:08', '5-produk-20220225105708'),
(740, 'jamur_syifa1.png', '2022-02-25 10:57:23', '5-produk-20220225105723'),
(741, 'kemiri1.png', '2022-02-25 10:57:45', '5-produk-20220225105744'),
(742, 'kemiri2.png', '2022-02-25 10:58:39', '5-produk-20220225105839'),
(743, '13.jpg', '2022-02-25 10:59:27', '5-produk-20220225105839'),
(744, '87.PNG', '2022-02-25 10:59:33', '5-produk-20220225105839'),
(745, '124.jpg', '2022-02-25 10:59:46', '5-produk-20220225105839'),
(746, '105.jpg', '2022-02-25 10:59:52', '5-produk-20220225105839'),
(747, 'aren.png', '2022-02-25 11:00:13', '5-produk-20220225110013'),
(748, 'madu_lebah_telaga.png', '2022-02-25 11:00:38', '5-produk-20220225110038');
INSERT INTO `img_comment` (`id`, `file_name`, `uploaded_on`, `id_comment`) VALUES
(749, 'kopi_banua1.png', '2022-02-25 11:00:48', '5-produk-20220225110048'),
(750, 'madu_kelulut_kph.png', '2022-02-25 11:01:03', '5-produk-20220225110103'),
(751, 'kunyit_instan1.png', '2022-02-25 11:01:27', '5-produk-20220225110127'),
(752, 'jahe_merah_instan.png', '2022-02-25 11:01:43', '5-produk-20220225110143'),
(753, 'temulawak_instan1.png', '2022-02-25 11:02:04', '5-produk-20220225110204'),
(754, 'briket_arang1.png', '2022-02-25 11:02:19', '5-produk-20220225110219'),
(755, 'jamur_tiram1.png', '2022-02-25 11:02:33', '5-produk-20220225110233'),
(756, 'jamur_tiram2.png', '2022-02-25 11:05:15', '5-produk-20220225110515'),
(757, 'jamur_21.jpg', '2022-02-25 11:05:23', '5-produk-20220225110515'),
(758, 'jamur11.jpg', '2022-02-25 11:05:24', '5-produk-20220225110515'),
(759, 'jamur_41.jpeg', '2022-02-25 11:05:24', '5-produk-20220225110515'),
(760, 'jamur_31.jpg', '2022-02-25 11:05:24', '5-produk-20220225110515'),
(761, 'jamur_ayu1.png', '2022-02-25 11:05:53', '5-produk-20220225110553'),
(762, 'rajamadu_250.png', '2022-02-25 11:06:04', '5-produk-20220225110604'),
(763, 'madu_sahabat_madu_100.png', '2022-02-25 11:06:18', '5-produk-20220225110618'),
(764, 'madu_katunun_100.png', '2022-02-25 11:06:32', '5-produk-20220225110632'),
(766, 'madu_sakatalu_50.png', '2022-02-25 11:07:07', '5-produk-20220225110651'),
(767, 'madu_sakatalu_100.png', '2022-02-25 11:07:24', '5-produk-20220225110724'),
(768, 'madu_sakatalu_500.png', '2022-02-25 11:07:38', '5-produk-20220225110738'),
(769, 'madu_plh_100.png', '2022-02-25 11:07:52', '5-produk-20220225110752'),
(770, 'madu_plh_250.png', '2022-02-25 11:08:15', '5-produk-20220225110815'),
(771, 'bibit_porang.png', '2022-02-25 11:11:01', '5-produk-20220225111101'),
(772, 'bibit_porang_1.jpg', '2022-02-25 11:11:09', '5-produk-20220225111101'),
(773, 'bibit_porang.jpg', '2022-02-25 11:11:14', '5-produk-20220225111101'),
(774, 'bibit_porang3.png', '2022-02-25 11:11:15', '5-produk-20220225111101'),
(779, 'kasi.jpg', '2022-02-25 12:35:12', '108-produk-20220225123212'),
(780, 'WISATA.jpg', '2022-02-25 12:35:20', '108-produk-20220225123212'),
(782, 'lombok.jpg', '2022-03-03 11:10:25', '108-produk-20220303110950'),
(783, 'KOPI_UJUNG_BATU.png', '2022-04-06 07:53:46', '5-produk-20220406075346'),
(784, 'limbah_ulin.jpg', '2022-04-06 07:55:10', '5-produk-20220406075510'),
(785, 'limbah_ulin_2.jpg', '2022-04-06 07:55:11', '5-produk-20220406075510'),
(786, 'limbah_ulin_21.jpg', '2022-04-06 07:55:43', '5-produk-20220406075543'),
(787, 'limbah_ulin1.jpg', '2022-04-06 07:55:49', '5-produk-20220406075543'),
(788, 'KOPI_KATUNUN.png', '2022-04-06 07:57:27', '5-produk-20220406075727'),
(789, 'kopi_ujung_batu.png', '2022-04-06 08:16:16', '5-produk-20220406081616'),
(790, 'kopi_katunun.png', '2022-04-06 08:20:13', '5-produk-20220406082013'),
(791, 'limbah_ulin.png', '2022-04-06 08:24:23', '5-produk-20220406082423'),
(792, 'limbah_ulin-removebg-preview.png', '2022-04-06 08:24:29', '5-produk-20220406082423');

-- --------------------------------------------------------

--
-- Table structure for table `katajelek`
--

CREATE TABLE `katajelek` (
  `id_jelek` int(11) NOT NULL,
  `kata` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `ganti` varchar(60) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `katajelek`
--

INSERT INTO `katajelek` (`id_jelek`, `kata`, `username`, `ganti`) VALUES
(4, 'sex', '', 's**'),
(2, 'bajingan', '', 'b*******'),
(3, 'bangsat', '', 'b******'),
(5, 'fuck', 'admin', 'f**k'),
(6, 'pantat', 'admin', 'p****t');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `sidebar` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `username`, `kategori_seo`, `aktif`, `sidebar`) VALUES
(19, 'Teknologi', '', 'teknologi', 'Y', 2),
(2, 'Olahraga', '', 'olahraga', 'Y', 4),
(21, 'Ekonomi', '', 'ekonomi', 'Y', 7),
(22, 'Politik', '', 'politik', 'N', 0),
(23, 'Hiburan', 'admin', 'hiburan', 'Y', 3),
(31, 'Kesehatan ', '', 'kesehatan-', 'Y', 5),
(39, 'Internasional', '', 'internasional', 'Y', 1),
(40, 'Kuliner', '', 'kuliner', 'Y', 0),
(41, 'Metropolitan', '', 'metropolitan', 'Y', 6),
(42, 'Dunia Islam', '', 'dunia-islam', 'N', 0),
(44, 'Wisata', '', 'wisata', 'N', 0),
(61, 'Dishut', 'admin', 'dishut', 'Y', 8);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_banner`
--

CREATE TABLE `kategori_banner` (
  `id_kategori_banner` int(11) NOT NULL,
  `nama_kategori_banner` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_banner`
--

INSERT INTO `kategori_banner` (`id_kategori_banner`, `nama_kategori_banner`) VALUES
(1, 'Hubungi Kami'),
(6, 'Alamat'),
(7, 'Statistik Pengunjung'),
(8, 'Kontak');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(5) NOT NULL,
  `id_berita` int(5) NOT NULL,
  `nama_komentar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_komentar` text COLLATE latin1_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `jam_komentar` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_berita`, `nama_komentar`, `url`, `isi_komentar`, `tgl`, `jam_komentar`, `aktif`, `email`) VALUES
(84, 650, 'Robby Prihandaya', 'robby.prihandaya@gmail.com', 'Nice  story, Roy suryo dan Susilo bambang yudhoyono memang cucak rowo. :)   ', '2012-01-05', '00:15:45', 'N', 'robby.prihandaya@gmail.com'),
(88, 650, 'Udin Sedunia', 'www.belajarkonseling.com', ' hm...  kae.x  perlu  juga  ne  bantuan  dari  para  konselor...:)		   ', '2012-01-13', '20:09:07', 'Y', 'www.belajarkonseling.com'),
(90, 650, 'Rizal Faizal', 'www.rizal-online.co.cc', ' asyik  aja  dehh...   ', '2012-02-25', '15:01:40', 'Y', 'www.rizal-online.co.cc'),
(91, 645, 'Eka Praja W', 'komputerkampus.com', ' makin  parah  aja  nih  ...\r\nmudah2n  bisa  berbenah  negeri  ku  yg  q  banggakan   ', '2012-03-08', '20:06:07', 'Y', 'komputerkampus.com'),
(137, 650, 'Lukmanul Hakim', '', ' saya  yakin  PHP  juga  bisa  bertahan  sampai  2030   ', '2013-01-19', '18:56:25', 'Y', 'lukmanul.haskim@gmai;.com'),
(146, 645, 'Tommy Utama', 'tommy.utama@gmail.com', ' Calon  hakim  agung  Muhammad  Daming  Sanusi  menyatakan,  hukuman  mati  tidak  layak  diberlakukan  bagi  pelaku  pemerkosaan.   ', '2014-07-21', '21:03:04', 'Y', 'tommy.utama@gmail.com'),
(147, 655, 'Robby Prihandaya', 'robby.prihandaya@gmail.com', 'Mudah-mudahan  windows  8.2  tampilannya  lebih  keren  lagi  dari  windows  8.1 sebelumnya  yang  kurang  enak  di gunakan.  heheheee   ', '2014-07-22', '08:33:04', 'Y', 'robby.prihandaya@gmail.com'),
(144, 650, 'Tommy Utama', 'tommy.utama@gmail.com', 'Pengamat  politik  dari  Charta  Politika,  Yunarto  Wijaya  mempertanyakan  dasar  keputusan  SBY  menunjuk  Roy  Suryo  sebagai  Menpora.   ', '2014-07-21', '20:59:16', 'Y', 'tommy.utama@gmail.com'),
(143, 650, 'Udin Sedunia', 'udin.sedunia@gmail.com', 'Menurut  Yunarto,  Roy  selama  ini  lebih  dikenal  sebagai  pakar  foto  digital  dan  video  serta  dosen  di  sebuah  perguruan  tinggi  negeri.   ', '2014-07-21', '20:57:52', 'Y', 'udin.sedunia@gmail.com'),
(148, 662, 'Robby Prihandaya', 'robby.prihandaya@gmail.com', 'pantat negara yahudi yang sangat perlu untuk dihancurkan /  musnahkan  dan  bantai  seluruh  warga israel..!!!   ', '2014-07-24', '09:29:20', 'Y', 'robby.prihandaya@gmail.com'),
(149, 662, 'Edo Ikfianda', 'edomuhammad90@gmail.com', 'Setelah membentuk Timnas, PSSI versi KLB pimpinan La Nyalla Mahmud Matalitti menunjuk Alfred Riedl sebagai pelatihnya.', '2014-08-09', '17:34:35', 'Y', 'edomuhammad90@gmail.com'),
(152, 685, 'Dewi Safitriir', 'dewi_safitri@gmail.com', 'Peremimpin  tertinggi  Iran,  Ayatollah  Ali  Khamenei  menyampaikan  pernyataan  kontroversial  terkait  ketegangan  di  Gaza.Israele.   ', '2014-08-17', '17:46:28', 'Y', 'dewi_safitri@gmail.com'),
(153, 662, 'Robby Prihandaya', 'ww.phpmu.com', 'Anda penyuka Transformer? Tentu hal yang paling menarik saat menonton film Transformer salah satunya adalah saat adegan transformasi yang begitu keren dari sebuah mobil atau truk menjadi robot yang gagah.\r\n\r\nAnda penyuka Transformer? Tentu hal yang paling menarik saat menonton film Transformer salah satunya adalah saat adegan transformasi yang begitu keren dari sebuah mobil atau truk menjadi robot yang gagah.', '2015-03-25', '06:10:12', 'Y', 'robby.prihandaya@gmail.com'),
(154, 642, 'Tommy Utama', 'tommyutama.com', ' Para  pengunjuk  rasa  membawa  bendera-bendera  Palestina  dan  foro-foto  pemimpin  tertinggi  Iran,  Ayatollah  Ali  Khamenei.   ', '2016-11-24', '10:24:15', 'Y', 'tommy.utama@gmail.com'),
(164, 656, 'Robby Prihandaya', 'https://phpmu.com', 'Komentar paling pedas Khamenei adalah Iran tidak pernah mengenal Israel. Negara ini juga secara terang-terangan mendukung Hamas. Hamas sendiri sudah dimasukan ke dalam daftar hitam terorisme oleh Israel.', '2018-04-20', '10:41:54', 'Y', 'robby.prihandaya@gmail.com'),
(165, 685, 'Robby Prihandaya', '#', 'Rekan setim Takaaki Nakagami itu mengaku insiden ini terjadi karena dirinya salah memilih ban. Ban keras yang digunakan Crutchlow saat race di MotoGP Amerika Serikat ternyata membuat laju kendaraannya tak dapat maksimal. Alhasil, dirinya pun harus terjatuh saat tengah memperebutkan posisi terdepan.', '2021-03-14', '22:15:13', 'Y', 'robby.prihandaya1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `komentarvid`
--

CREATE TABLE `komentarvid` (
  `id_komentar` int(5) NOT NULL,
  `id_video` int(5) NOT NULL,
  `nama_komentar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_komentar` text COLLATE latin1_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `jam_komentar` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `komentarvid`
--

INSERT INTO `komentarvid` (`id_komentar`, `id_video`, `nama_komentar`, `url`, `isi_komentar`, `tgl`, `jam_komentar`, `aktif`) VALUES
(107, 160, 'Prabowo Subianto', 'Prabowo@gmail.com', ' Your  email  address  will  not  be  published.  Required  fields  are  marked', '2014-07-21', '13:29:29', 'N'),
(108, 163, 'Robby Prihandaya', 'robby.prihandaya@gmail.com', ' Kita  memang  harus  selamatkan  hutan  indonesia,  walau  apapun  yang  terjadi.   ', '2014-07-21', '13:31:10', 'Y'),
(109, 160, 'Robby Prihandaya', 'robby.prihandaya@gmail.com', ' Swarakalibata  V.3 sekarang  hadir  dengan  tampilan  baru  yang  pastinya  sudah  jauh  lebih  maju  dari  versi  sebelumnya.', '2014-07-21', '21:09:31', 'Y'),
(112, 166, 'Robby Prihandaya', 'robby.prihandaya@gmail.com', 'Exclusive Di IDAFF Acedemy - &quot;Social Blogging Mastery 2&quot; - Workshop 2 Hari Yang Akan Merubah Hidup Anda Di Tahun 2017. Di Bongkar Oleh Ahlinya Cara Paling Mudah Memiliki Penghasillan Sampingan Lewat Internet Hingga Jutaan Rupiah Setiap Bulannya.', '2017-01-25', '09:40:01', 'Y'),
(113, 166, 'Dewiit Safitri', 'dewiit.safitri@gmail.com', 'Pemimpin tertinggi Iran, Ayatollah Ali Khamenei menyampaikan pernyataan kontroversial terkait ketegangan di Gaza. Khamenei mendorong agar Palestina terus melawan Israel. &quot;Salah satu cara untuk menghentikan rezim kurang ajar ini adalah melanjutkan perlawanan dan dan perjuangan bersenjata harus diperluas ke Tepi Barat,&quot; sebut Khamenei, seperti dikutip dari IRNA.', '2017-01-25', '09:40:55', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id_logo` int(5) NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id_logo`, `gambar`) VALUES
(15, 'logo_baru.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(5) NOT NULL,
  `id_parent` int(5) NOT NULL DEFAULT '0',
  `nama_menu` varchar(30) NOT NULL,
  `link` varchar(100) NOT NULL,
  `aktif` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  `position` enum('Top','Bottom') DEFAULT 'Bottom',
  `urutan` int(3) NOT NULL,
  `keterangan` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_parent`, `nama_menu`, `link`, `aktif`, `position`, `urutan`, `keterangan`) VALUES
(115, 150, 'Cara Belanja', 'halaman/detail/cara-belanja-disini', 'Ya', 'Bottom', 16, NULL),
(112, 22, 'Dalam Negeri', '#', 'Ya', 'Bottom', 20, NULL),
(151, 150, 'Semua Produk', 'produk', 'Ya', 'Bottom', 5, NULL),
(150, 0, 'Produk Lokal', '#', 'Ya', 'Bottom', 4, NULL),
(126, 22, 'Luar Negeri', '#', 'Ya', 'Bottom', 21, NULL),
(148, 150, 'Konfirmasi Pesanan', 'konfirmasi', 'Ya', 'Bottom', 14, NULL),
(149, 150, 'Telusuri Pesanan', 'konfirmasi/tracking', 'Ya', 'Bottom', 13, NULL),
(152, 150, 'Penjual', 'produk/reseller', 'Ya', 'Bottom', 12, NULL),
(155, 150, 'Laporan Pesanan', 'members/orders_report', 'Ya', 'Bottom', 15, NULL),
(157, 0, 'Beranda', 'main', 'Ya', 'Bottom', 1, ''),
(159, 0, 'Berita', 'berita', 'Ya', 'Bottom', 2, ''),
(179, 150, 'Group Pesanan', 'produk?s=group', 'Ya', 'Bottom', 11, ''),
(180, 0, 'Web GIS', 'peta/dishut', 'Ya', 'Bottom', 3, ''),
(182, 150, 'Kategori Produk', '#', 'Ya', 'Bottom', 6, ''),
(183, 182, 'Hasil Hutan Bukan Kayu', 'produk/kategori/hasil-hutan-bukan-kayu', 'Ya', 'Bottom', 7, ''),
(184, 182, 'Hasil Hutan Kayu', '/produk/kategori/kayu', 'Ya', 'Bottom', 8, ''),
(185, 182, 'Jasa Lingkungan', '/produk/kategori/jasling', 'Ya', 'Bottom', 9, ''),
(186, 182, 'Karbon', 'produk/kategori/karbon', 'Ya', 'Bottom', 10, ''),
(191, 0, 'Kontak', 'halaman/detail/kontak-kami', 'Ya', 'Bottom', 21, ''),
(193, 150, 'Perbenihan', '#', 'Ya', 'Bottom', 17, ''),
(194, 193, 'Siap Tanam', 'halaman/detail/persediaan-bibit', 'Ya', 'Bottom', 18, ''),
(195, 193, 'Produksi Bibit', '	halaman/detail/produksi-bibit', 'Ya', 'Bottom', 19, ''),
(196, 193, 'Distribusi Bibit', 'halaman/detail/distribusi-bibit', 'Ya', 'Bottom', 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL,
  `nama_modul` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `static_content` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('user','admin') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `username`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Manajemen User', 'admin', 'manajemenuser', '', '', 'Y', 'user', 'Y', 0, ''),
(18, 'Berita', 'admin', 'listberita', '', '', 'Y', 'user', 'Y', 0, ''),
(71, 'Background Website', 'admin', 'background', '', '', 'N', 'user', 'N', 0, ''),
(10, 'Manajemen Modul', 'admin', 'manajemenmodul', '', '', 'Y', 'user', 'Y', 0, ''),
(31, 'Kategori Berita ', 'admin', 'kategorikategori', '', '', 'Y', 'user', 'Y', 0, ''),
(34, 'Tag Berita', 'admin', 'tagberita', '', '', 'Y', 'user', 'Y', 0, ''),
(45, 'Template Website', 'admin', 'templatewebsite', '', '', 'Y', 'user', 'Y', 0, ''),
(61, 'Identitas Website', 'admin', 'identitaswebsite', '', '', 'Y', 'user', 'Y', 0, ''),
(57, 'Menu Website', 'admin', 'menuwebsite', '', '', 'Y', 'user', 'Y', 0, ''),
(59, 'Halaman Baru', 'admin', 'halamanbaru', '', '', 'Y', 'user', 'Y', 0, ''),
(66, 'Logo Website', 'admin', 'logowebsite', '', '', 'Y', 'user', 'Y', 0, ''),
(67, 'Iklan Sidebar', 'admin', 'iklansidebar', '', '', 'N', 'user', 'N', 0, ''),
(75, 'Alamat Kontak', 'admin', 'alamat', '', '', 'Y', 'user', 'Y', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `mod_alamat`
--

CREATE TABLE `mod_alamat` (
  `id_alamat` int(5) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mod_alamat`
--

INSERT INTO `mod_alamat` (`id_alamat`, `judul`, `alamat`) VALUES
(1, 'Alamat / Hubungi', '<strong>Haloo!</strong>, Kami berkomitmen memberikan layanan terbaik untuk Anda,&nbsp;menyediakan produk dan layanan terbaik yang Anda butuhkan. Apabila untuk alasan tertentu Anda merasa tidak puas dengan pelayanan kami dapat menyampaikan kritik dan saran.<br />\r\n<br />\r\nKami akan menidaklanjuti masukan yang Anda berikan dan bila perlu mengambil tindakan untuk mencegah masalah yang sama terulang kembali.\r\n'),
(2, 'Informasi Login dan Register', '<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<h3><strong>Sign up today and you will be able to:</strong></h3>\r\n\r\n<p>MartFury Buyer Protection has you covered from click to delivery. Sign up or sign in and you will be able to:</p>\r\n\r\n<ul>\r\n	<li>SPEED YOUR WAY THROUGH CHECKOUT</li>\r\n	<li>TRACK YOUR ORDERS EASILY</li>\r\n	<li>KEEP A RECORD OF ALL YOUR PURCHASES</li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pasangiklan`
--

CREATE TABLE `pasangiklan` (
  `id_pasangiklan` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `pasangiklan`
--

INSERT INTO `pasangiklan` (`id_pasangiklan`, `judul`, `username`, `url`, `gambar`, `tgl_posting`) VALUES
(1, 'Iklan Sidebar Kanan atas 2', 'admin', 'http://dishut.kalselprov.go.id/', 'home-2-2221.jpg', '2022-01-05'),
(2, 'Iklan Sidebar Kanan atas 1', 'admin', 'https://play.google.com/store/apps/details?id=com.pinandu.android.siphh&hl=en&gl=US', 'home-2-111.jpg', '2022-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id_playlist` int(5) NOT NULL,
  `jdl_playlist` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `playlist_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gbr_playlist` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id_playlist`, `jdl_playlist`, `username`, `playlist_seo`, `gbr_playlist`, `aktif`) VALUES
(56, 'Playlist Video 1', 'admin', 'playlist-video-1', '', 'Y'),
(57, 'Playlist Video 2', 'admin', 'playlist-video-2', '', 'Y'),
(61, 'Playlist Video 4', 'admin', 'playlist-video-4', '', 'Y'),
(60, 'Playlist Video 3', 'admin', 'playlist-video-3', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `poling`
--

CREATE TABLE `poling` (
  `id_poling` int(5) NOT NULL,
  `pilihan` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `rating` int(5) NOT NULL DEFAULT '0',
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `poling`
--

INSERT INTO `poling` (`id_poling`, `pilihan`, `status`, `username`, `rating`, `aktif`) VALUES
(18, 'Siapakah Calon Walikota dan Wakil Walikota Padang Favorit Anda?', 'Pertanyaan', 'admin', 0, 'Y'),
(25, 'Mahyeldi Ansyarullah - Emzalmi', 'Jawaban', 'admin', 25, 'Y'),
(31, 'Robby Prihandaya - Dewi Safitri', 'Jawaban', 'admin', 1, 'Y'),
(32, 'Tommy Utama - Laura Hikmah', 'Jawaban', 'admin', 3, 'Y'),
(33, 'Willy Fernando - Vicky Armita', 'Jawaban', 'admin', 9, 'Y'),
(35, 'Laura Himah i Nisaa - Safaruddin', 'Jawaban', 'admin', 5, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `created`, `modified`, `status`) VALUES
(1, 'Adding Google Map on Your Website within 5 Minutes', '2019-08-20 11:28:29', '2019-08-20 11:28:29', 1),
(2, 'Top Features of AngularJS that Sets it Apart from other Frameworks', '2019-08-22 11:28:29', '2019-08-22 11:28:29', 1),
(3, 'Get visitor location using HTML5 Geolocation API and PHP', '2019-08-25 11:28:29', '2019-08-25 11:28:29', 1),
(4, 'WordPress &mdash; How to Display Most Popular Posts by Views', '2019-08-28 11:28:29', '2019-08-28 11:28:29', 1),
(5, 'PayPal Payment Gateway Integration in CodeIgniter', '2019-09-05 11:28:29', '2019-09-05 11:28:29', 1),
(6, 'Drupal 8 Installation and Configuration Tutorial', '2019-09-09 11:28:29', '2019-09-09 11:28:29', 1),
(7, 'How to Create a MySQL Database in cPanel', '2019-09-13 11:28:29', '2019-09-13 11:28:29', 1),
(8, 'CakePHP Tutorial Part 3: Working with Elements and Layout', '2019-09-18 11:28:29', '2019-09-18 11:28:29', 1),
(9, 'Build an event calendar using jQuery, Ajax and PHP', '2019-09-20 11:28:29', '2019-09-20 11:28:29', 1),
(10, 'Disable mouse right click, cut, copy and paste using jQuery', '2019-09-21 11:28:29', '2019-09-21 11:28:29', 1),
(11, 'Dynamic Dependent Select Box using jQuery, Ajax and PHP', '2019-10-11 11:28:29', '2019-10-11 11:28:29', 1),
(12, 'Drupal Custom Module &mdash; Create database table during installation', '2019-10-14 11:28:29', '2019-10-14 11:28:29', 1),
(13, 'Redirect non-www to www & HTTP to HTTPS using .htaccess file', '2019-10-19 11:28:29', '2019-10-19 11:28:29', 1),
(14, 'PayPal Pro payment gateway integration in PHP', '2019-10-30 11:28:29', '2019-10-30 11:28:29', 1),
(15, 'Creating PayPal Sandbox Test Account and Website Payments Pro Account', '2019-11-12 11:28:29', '2019-11-12 11:28:29', 1),
(16, 'Add featured image or thumbnail to WordPress post', '2019-11-15 11:28:29', '2019-11-15 11:28:29', 1),
(17, 'Drupal custom module development tutorial', '2019-11-17 11:28:29', '2019-11-17 11:28:29', 1),
(18, 'Multi-Language implementation in CodeIgniter', '2019-11-22 11:28:29', '2019-11-22 11:28:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rb_bonus`
--

CREATE TABLE `rb_bonus` (
  `id_bonus` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('1','2') NOT NULL,
  `waktu_bonus` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_config`
--

CREATE TABLE `rb_config` (
  `id` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `field` text NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rb_config`
--

INSERT INTO `rb_config` (`id`, `tgl`, `field`, `value`) VALUES
(1, '2020-10-13 15:01:55', 'ipaymu', 'F7DDF209-27E1-4C5D-8297-870C1DA5F54A'),
(2, '2020-10-13 15:01:55', 'ipaymu_url', 'https://my.ipaymu.com/payment.htm'),
(3, '2020-10-13 15:03:56', 'midtrans_server', 'SB-Mid-server-en3N9vKOkEUhFmnC0-hBj5pU'),
(4, '2020-10-13 15:03:56', 'midtrans_client', 'SB-Mid-client-99V_V0f0_PR2Q7Bn'),
(5, '2020-10-13 15:04:50', 'midtrans_snap', 'https://app.sandbox.midtrans.com/snap/snap.js'),
(6, '2020-10-24 11:44:08', 'apps_image', 'app.png'),
(7, '2020-10-24 11:44:08', 'apps_title', 'Download sisdh.kalselprov.go.id App Now!'),
(8, '2020-10-24 11:45:18', 'apps_deskripsi', 'Shopping fastly and easily more with our app. Get a link to download the app on your phone'),
(9, '2020-10-24 11:45:18', 'apps_google_play', 'http://sisdh.kalselprov.go.id/sipsdhkalsel.apk'),
(10, '2020-10-24 11:46:10', 'apps_app_store', 'http://sisdh.kalselprov.go.id/sipsdhkalsel.apk'),
(11, '2020-10-24 11:46:10', 'apps_aktif', 'N'),
(12, '2020-10-26 14:32:57', 'wa_domain', 'https://console.wablas.com'),
(13, '2020-10-26 14:34:53', 'ipaymu_aktif', 'N'),
(14, '2020-10-26 14:34:53', 'midtrans_aktif', 'Y'),
(15, '2020-10-26 14:48:27', 'email_server', 'smtp.googlemail.com'),
(16, '2020-10-26 14:48:27', 'email_port', '465'),
(17, '2020-10-27 13:49:34', 'ipaymu_fee', '3500'),
(18, '2020-11-03 09:34:48', 'wa_seller', 'Y'),
(19, '2020-11-03 09:45:19', 'facebook_app_id', '4714346908673406'),
(20, '2020-11-03 09:45:19', 'facebook_app_secret', '3690c6d9d660e663a7b5e3e3de697091'),
(21, '2020-11-03 09:45:49', 'google_client_id', '208294641718-uaecn97glcm2oug1usf9o4frelcjoig3.apps.googleusercontent.com'),
(22, '2020-11-03 09:45:49', 'google_client_secret', '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'),
(23, '2020-11-03 09:53:21', 'application_name', 'SIFORESTKA.CO.ID'),
(24, '2020-11-03 09:53:21', 'redirect_uri', 'https://siforestka.co.id/auth/'),
(25, '2020-11-03 16:58:43', 'twitter', '@sipsdhkalsel'),
(28, '2020-11-04 10:49:52', 'title', 'https://siforestka.co.id'),
(27, '2020-11-03 16:59:42', 'google_site_verification', 'EARHo7uZW58sdKm-JGfhezeCWdnjy8oVIJWTrCfRLhU'),
(29, '2020-11-07 08:33:40', 'resolusi_center', 'Team Resolution Center'),
(30, '2020-11-11 10:48:18', 'smtp_secure', 'ssl'),
(31, '2020-11-18 07:40:45', 'market_sample', '0'),
(33, '2020-11-20 14:20:26', 'facebook_pixel', '210565931085744'),
(34, '2020-12-02 17:21:23', 'withdraw_fee', '7500'),
(35, '2020-12-02 17:52:00', 'withdraw_min', '50000'),
(36, '2020-12-02 20:42:02', 'token_referral', 'Y'),
(37, '2020-12-02 20:54:05', 'info_footer', 'SIFORESTKA.CO.ID  Hak Cipta Terpelihara '),
(38, '2020-12-07 11:36:34', 'api_resi', 'xxd25353ffbf5762348b8811bb7cde3b82460a19f85354939c2bdf8036c6b1cx'),
(39, '2020-12-07 11:52:12', 'api_resi_aktif', 'rajaongkir'),
(40, '2020-12-07 13:09:29', 'api_resi_off', 'jne,tiki,rpx,pandu'),
(42, '2021-01-25 22:18:32', 'approve_produk', 'Y'),
(43, '2021-02-12 09:32:05', 'mode', 'marketplace'),
(46, '2021-02-23 09:58:06', 'fee_produk', 'N'),
(47, '2021-02-24 21:30:28', 'wa_gateway', 'wablas');

-- --------------------------------------------------------

--
-- Table structure for table `rb_donasi`
--

CREATE TABLE `rb_donasi` (
  `id_donasi` int(11) NOT NULL,
  `jenis` enum('sedekah','zakat','wakaf_uang','wakaf_asset') NOT NULL DEFAULT 'sedekah',
  `nominal` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `no_handphone` varchar(100) NOT NULL,
  `alamat_email` varchar(255) NOT NULL,
  `id_rekening` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `doa_terbaik` text,
  `file_upload` text,
  `waktu_kirim` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_driver_ongkir`
--

CREATE TABLE `rb_driver_ongkir` (
  `id_driver_ongkir` int(11) NOT NULL,
  `id_jenis_kendaraan` int(11) NOT NULL,
  `provinsi_kota` varchar(50) NOT NULL,
  `posisi` int(11) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_driver_ongkir`
--

INSERT INTO `rb_driver_ongkir` (`id_driver_ongkir`, `id_jenis_kendaraan`, `provinsi_kota`, `posisi`, `tujuan`, `ongkir`, `keterangan`) VALUES
(6, 1, '13:35|13:35', 502, 502, 12000, '10 menit'),
(7, 1, '13:35|13:36', 502, 507, 60000, '60 menit');

-- --------------------------------------------------------

--
-- Table structure for table `rb_jenis_kendaraan`
--

CREATE TABLE `rb_jenis_kendaraan` (
  `id_jenis_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_jenis_kendaraan`
--

INSERT INTO `rb_jenis_kendaraan` (`id_jenis_kendaraan`, `jenis_kendaraan`) VALUES
(1, 'Roda 2'),
(2, 'Roda 4');

-- --------------------------------------------------------

--
-- Table structure for table `rb_kategori_produk`
--

CREATE TABLE `rb_kategori_produk` (
  `id_kategori_produk` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `kategori_seo` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `icon_kode` varchar(100) DEFAULT NULL,
  `icon_image` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `mkolom` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_kategori_produk`
--

INSERT INTO `rb_kategori_produk` (`id_kategori_produk`, `nama_kategori`, `kategori_seo`, `gambar`, `icon_kode`, `icon_image`, `urutan`, `mkolom`) VALUES
(1, 'Hasil Hutan Kayu', 'kayu', 'HHK1.png', '', NULL, 1, 12),
(2, 'Hasil Hutan Bukan Kayu', 'hasil-hutan-bukan-kayu', 'HHBK.png', '', NULL, 2, 12),
(6, 'Jasa Lingkungan', 'jasling', 'Jasling1.png', '', NULL, 3, 12),
(9, 'Karbon', 'karbon', 'karbon1.png', '', NULL, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `rb_kategori_produk_sub`
--

CREATE TABLE `rb_kategori_produk_sub` (
  `id_kategori_produk_sub` int(11) NOT NULL,
  `id_kategori_produk` int(11) NOT NULL,
  `nama_kategori_sub` varchar(255) NOT NULL,
  `kategori_seo_sub` varchar(255) NOT NULL,
  `icon_kode` varchar(100) DEFAULT NULL,
  `icon_image` varchar(255) DEFAULT NULL,
  `mkolom_sub` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_kategori_produk_sub`
--

INSERT INTO `rb_kategori_produk_sub` (`id_kategori_produk_sub`, `id_kategori_produk`, `nama_kategori_sub`, `kategori_seo_sub`, `icon_kode`, `icon_image`, `mkolom_sub`) VALUES
(4, 1, 'IPPKHHTI', 'ippkhhti', '', NULL, 12),
(6, 1, 'IPPKHA', 'ippkha', '', NULL, 12),
(14, 6, 'Pantai', 'pantai', '', NULL, 12),
(15, 6, 'Gunung', 'gunung', '', NULL, 12),
(16, 6, 'Air Terjun', 'air-terjun', '', NULL, 12),
(25, 1, 'Industri', 'industri', '', NULL, NULL),
(26, 6, 'Sungai', 'sungai', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rb_keterangan`
--

CREATE TABLE `rb_keterangan` (
  `id_keterangan` int(5) NOT NULL,
  `id_reseller` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_posting` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_keterangan`
--

INSERT INTO `rb_keterangan` (`id_keterangan`, `id_reseller`, `keterangan`, `tanggal_posting`) VALUES
(1, 2, '<b>Informasi dari Reseller :</b><p></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque condimentum mattis. Suspendisse potenti. Proin vitae elementum nisi. Aliquam eu pretium risus. Nam varius efficitur consectetur. Aenean vestibulum felis sed mollis faucibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin venenatis est sit amet eleifend vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer id nunc eu odio ultrices pulvinar non feugiat felis.&nbsp; dfsdfsdf</p><p>Duis consequat urna sapien, porta gravida diam venenatis at. Duis at ornare enim, ac accumsan eros. Sed in finibus metus. Etiam blandit tristique orci, sit amet congue dui facilisis id. Donec fermentum diam at orci viverra placerat. Sed nunc lorem, cursus nec vestibulum hendrerit, tempus et libero. ertert</p>', '2017-03-31'),
(2, 6, '<p>asdasdasd</p>', '2019-09-07'),
(3, 1, '<p></p>', '2019-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `rb_konfirmasi_pembayaran`
--

CREATE TABLE `rb_konfirmasi_pembayaran` (
  `id_konfirmasi_pembayaran` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `total_transfer` varchar(20) NOT NULL,
  `id_rekening` int(11) NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `waktu_konfirmasi` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_konfirmasi_pembayaran_konsumen`
--

CREATE TABLE `rb_konfirmasi_pembayaran_konsumen` (
  `id_konfirmasi_pembayaran` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `total_transfer` varchar(20) NOT NULL,
  `id_rekening` int(11) NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `waktu_konfirmasi` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_konsumen`
--

CREATE TABLE `rb_konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `token` enum('Y','N') NOT NULL DEFAULT 'N',
  `referral_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_konsumen`
--

INSERT INTO `rb_konsumen` (`id_konsumen`, `username`, `password`, `nama_lengkap`, `email`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `alamat_lengkap`, `kecamatan_id`, `kota_id`, `provinsi_id`, `no_hp`, `foto`, `tanggal_daftar`, `token`, `referral_id`) VALUES
(1, 'kph.tabalong', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'KPH TABALONG', 'kph.tabalong@gmail.com', 'Laki-laki', '2022-01-26', '-', 'Jl.A.Yani km 9 (arah kaltim), Belimbing Raya, Murung Pudak, Kabupaten Tabalong, Kalimantan Selatan 71571', 6174, 446, 13, '081253909393', 'TABALONG1.png', '0000-00-00', 'Y', NULL),
(2, 'kph.balangan', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'KPH BALANGAN', 'kph.balangan@gmail.com', 'Laki-laki', '2021-12-22', '-', 'Jalan Lingkar Barat Kelurahan Batu Piring Kecamatan Paringin Selatan Kabupaten Balangan', 270, 18, 13, '082255809034', 'BALANGAN.png', '0000-00-00', 'Y', NULL),
(3, 'kph.hulusungai', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'KPH HULU SUNGAI', 'kph.hulusungai@gmail.com', 'Laki-laki', '2021-09-28', 'Kandangan', 'Jl. Durian Rabung, Durian Rabung, Padang Batung, Kabupaten Hulu Sungai Selatan, Kalimantan Selatan 71281', 1981, 143, 13, '081234567890', 'HS1.png', '0000-00-00', 'Y', NULL),
(4, 'kph.kayutangi', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'KPH KAYU TANGI', 'kph.kayutangi@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Jl. Barintik No.5, Sungai Sipai, Kec. Martapura, Banjar, Kalimantan Selatan 70714', 484, 33, 13, '', 'KATA1.png', '0000-00-00', 'Y', NULL),
(5, 'kph.tanahlaut', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'KPH TANAH LAUT', 'kph.tanahlaut@gmail.com', 'Perempuan', '2000-10-07', '-', 'Jl. A. Syairani Komp. Perkantoran Gagas, Pelaihari, Tanah Laut', 6265, 454, 13, '082250291331', 'TANAH_LAUT1.png', '0000-00-00', 'Y', NULL),
(6, 'kph.kusan', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'KPH KUSAN', 'kph.kusan@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Jl. Poros 30, No. 01, Tanah Merah, Kecamatan Batulicin', 6234, 452, 13, '081234903071', 'KUSAN1.png', '0000-00-00', 'Y', NULL),
(7, 'kph.cantung', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'KPH CANTUNG', 'kph.cantung@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Jl. Provinsi Kalsel-Kaltim, Desa Sei. Kupang, Kecamatan Kelumpang Hulu Kabupaten Kotabaru, 72162', 2852, 203, 13, '', 'CANTUNG1.png', '0000-00-00', 'Y', NULL),
(8, 'kph.pulaulaut', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'KPH PULAU LAUT SEBUKU', 'kph.pulaulaut@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Jl. Tanjung Serdang Km. 35, Desa Mekarpura, Kecamatan Pulau Laut Tengah Kotabaru.', 2863, 203, 13, '', 'PULAU_LAUT1.png', '0000-00-00', 'Y', NULL),
(9, 'tahura', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'TAHURA SULTAN ADAM', 'tahura.sultanadam@gmail.com', 'Laki-laki', '2021-12-01', '-', 'Kabupaten Banjar', 481, 33, 13, '081218621975', 'Tahura-SA.PNG', '0000-00-00', 'Y', NULL),
(10, 'trikorindotama', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT.TRIKORINDOTAMA WANAKARYA', 'trikorindotamawanakarya@gmail.com', 'Laki-laki', '0000-00-00', '-', 'JL.KAPTEN PIERE TENDEAN NO.158 BANJARMASIN', 506, 36, 13, NULL, '', '0000-00-00', 'Y', NULL),
(11, 'jhonlin', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT. JHONLIN AGRO MANDIRI', 'syafie.btlcn@gmail.com', 'Laki-laki', '2021-09-24', '-', 'Jl. Kodeco Km 47, Mantewe, Kecamatan Mantewe, Kab. Tanah Bumbu, Kalsel 72211', 6239, 452, 13, '08125002012', '', '0000-00-00', 'Y', NULL),
(12, 'kodeco.ha', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT. KODECO TIMBER ( IUPHHK - HA )', 'kodecotimber.btl@gmaill.com', 'Laki-laki', '0000-00-00', '-', 'Jalan Raya Kodeco Km.1 Ds. Gunung Antasari Kec. Simpang Empat Kab. Tanah Bumbu', 6241, 452, 13, NULL, '', '0000-00-00', 'Y', NULL),
(13, 'inni.joa', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT. INNI JOA', 'innijoa77@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Jl. Kodeco KM 60, Desa Gunung Baturaya, Kecamatan Mantewe, Kab Tanah Bumbu, 72211', 6239, 452, 13, NULL, '', '0000-00-00', 'Y', NULL),
(14, 'kodeco.hti', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT. KODECO TIMBER (IUPHHK - HTI)', 'kodecotimber.btl@gmaill.com', 'Laki-laki', '0000-00-00', '-', 'Jalan Raya Kodeco Km.1 Ds. Gunung Antasari Kec. Simpang Empat Kab. Tanah Bumbu', 6241, 452, 13, NULL, '', '0000-00-00', 'Y', NULL),
(15, 'batulicin.bumibersujud', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT. BATULICIN BUMI BERSUJUD', 'pt.batulicinbumibersujud69@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Sejahtera Mulia KM 29 Tandui Kecamatan Satui Kabupaten Kalimantan Selatan 72275', 6240, 452, 13, NULL, '', '0000-00-00', 'Y', NULL),
(16, 'inhutani.semaras', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'IUPHHK-HT  PT Inhutani II Pulau Laut/Semaras', 'iht2gmkalsel@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Base Camp Semaras, Desa Semaras, Kec Pulau Laut Barat, Kab Kotabaru', 2859, 203, 13, NULL, '', '0000-00-00', 'Y', NULL),
(17, 'inhutani.senakin', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'IUPHHK-HT PT Inhutani II Senakin', 'iht2gmkalsel2@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Desa Gronggang, Kec Kelumpang Tengah, Kab Kotabaru', 2854, 203, 13, NULL, '', '0000-00-00', 'Y', NULL),
(18, 'inhutani.pulaulaut', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'IUPHHK-HA PT Inhutani II Pulau Laut', 'iht2gmkalsel3@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Jln. Tanjung Serdang, Desa Mekarpura, Kec Pulau Laut Tengah, Kab Kotabaru', 2863, 203, 13, NULL, '', '0000-00-00', 'Y', NULL),
(19, 'inhutani.pelaihari', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT.INHUTANI III unit PELAIHARI', 'intigabjb@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Jl Sei. Salak KM 28 Kel Guntung Manggis Kec Landasan Ulin, Banjarbaru', 502, 35, 13, NULL, '', '0000-00-00', 'Y', NULL),
(20, 'inhutani.riamkiwa', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT. INHUTANI III unit RIAM KIWA', 'intigabjb2@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Jl Sei. Salak KM 28 Kel Guntung Manggis Kec Landasan Ulin, Banjarbaru', 502, 35, 13, NULL, '', '0000-00-00', 'Y', NULL),
(21, 'elbana', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT.ELBANA ABADI JAYA', 'borneoexcellent937@gmail.com', 'Laki-laki', '0000-00-00', '-', 'DS.LANO KEC.JARO KAB.TABALONG PROV KALSEL', 6170, 446, 13, NULL, '', '0000-00-00', 'Y', NULL),
(22, 'dwima.intiga', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'PT.DWIMA INTIGA', 'dwimain3@gmail.com', 'Laki-laki', '0000-00-00', '-', 'Jln. H. Hasan Basry Km 7 Desa Lokpaikat, Kecamatan Lokpaikat, Kabupaten Tapin', 6426, 466, 13, NULL, '', '0000-00-00', 'Y', NULL),
(23, 'ha.aya.yayang', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'IUPHHK-HA PT. AYA YAYANG INDONESIA', 'indra.haris@yahoo.co.id', 'Laki-laki', '0000-00-00', '-', 'Gatot Subroto XI Jalan Artha Graha No.36 RT. 29 RW.02 Kel.Kuripan Kec. Banjarmasin Timur Kodya Banjarmasin  Kodepos 70536', 507, 36, 13, NULL, '', '0000-00-00', 'Y', NULL),
(24, 'hti.aya.yayang', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'HTI PT. AYA YAYANG INDONESIA', 'indra.haris2@yahoo.co.id', 'Laki-laki', '0000-00-00', '-', 'Gatot Subroto XI jalan artha graha no. 36 RT .29 RW.02 Kel. Kuripan Kec. Banjarmasin Timur  Kodya Banjarmasin Kode Pos 70236', 507, 36, 13, NULL, '', '0000-00-00', 'Y', NULL),
(25, 'janggala.semesta', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'HTI PT. JANGGALA SEMESTA', 'indra.haris3@yahoo.co.id', 'Laki-laki', '0000-00-00', '-', 'Jl. Gatot Subroto XI Jln Artha Graha No.36 RT.29 RW.02 Kel. Kuripan Kec. Banjarmasin Timur Kodya Banjarmasin Kodepos 70236', 507, 36, 13, NULL, '', '0000-00-00', 'Y', NULL),
(26, 'hutan.sembada', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'HTI PT. HUTAN SEMBADA', 'indra.haris4@yahoo.co.id', 'Laki-laki', '0000-00-00', '-', 'Gatot Subroto XI Jalan Artha Graha No.36 RT.29 RW.02 Kel. Kuripan Kec. Banjarmasin Timur Kodya Banjarmasin Kodepos 70236', 507, 36, 13, NULL, '', '0000-00-00', 'Y', NULL),
(77, 'herma', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'herma ataya', 'kymteta@gmail.com', 'Perempuan', '2017-03-20', 'Banjarbaru', 'Jl.Golf Komp.Wengga 4 Blok E No.229', 502, 35, 13, '082156090645', '', '2021-09-28', 'Y', NULL),
(78, 'asdi', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'serbaserbi645', 'serbaserbi645@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, '082178945646', '', '2021-10-26', 'Y', NULL),
(79, 'budi', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'budi', 'budi@gmail.com', 'Laki-laki', '2021-10-27', '-', 'banjarbaru', 499, 35, 13, '08214567895', '', '2021-10-27', 'Y', NULL),
(80, 'KPHKAYUTANGI', 'bbf91810f92a71bf585b6582f65074f7239cce9ef46534ad66d4bd08e709194dde1b38934bcf81eb4dffe1924136b65f2c3dc952ce0637d33fd4ff26ede6cd39', 'aderusmana81', 'aderusmana81@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, '081349603261', '', '2021-10-27', 'Y', NULL),
(81, 'AgungH', 'febd36cb90adf270e501d756ec2f7b43c20b65ede88a4f11efb8167a951294d557dc3c074d7ad1c43fb063e3038239c8dc091f81edebc81ba953ea93f3aa1ccb', 'agung.hananto77', 'agung.hananto77@gmail.com', 'Laki-laki', '2021-10-27', 'Kebumen', 'Komplek Wengga TrikoRa Blok E No 225 Guntung Manggis', 502, 35, 13, '08125026242', 'karate.jpeg', '2021-10-27', 'Y', NULL),
(82, 'BPTH', '94dc8066a693c219342aee1a4b9b10a9c3fefee6373064dfc0c0a54ebe34b6bb1faf46699a359066daa0a2dcbacbcd57bed8973ecbaf8e3547af88b780345e5a', 'BPTH', 'uptdbpthpersemaian@gmail.com', 'Perempuan', '2022-01-26', '-', 'Jl. Pangeran Syuriansyah No 22, Banjarbaru', 0, 0, 0, '085348711664', '', '2021-10-27', 'Y', NULL),
(83, 'subhan.forester', 'df7fff35544bd9f15b0a091dcdf8a184e7950957d0da590b8a905bb1893f4cd1b0ffc876c8f09274ca09283b57c427d1430cb85dbf21ff17c488e2e807415704', 'Subhan Fahrani', 'subhan.forester@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2021-12-13', 'Y', NULL),
(89, 'iwanmunandar16', '21d6691045b6ba9f943697d41fc7f939843f7b44c0320543950b0ced3d8e5ffc591483d3da88bcf6a38a664971f97f37e28262a1cc25cd1b6c6e8c2c8b2772a5', 'Riswan Muhammad Nur', 'iwanmunandar16@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-01-26', 'Y', NULL),
(90, 'Iyan', '2c9e4191b6db04957d73400e9b0c1cda6c573aa81582da8ea8116dc3596315815f5bd1bce18771332176844bec3d9ab7e89cde634aac4dcdeec9c6779863ac8d', 'ianone2000', 'ianone2000@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, '081352992186', '', '2022-02-04', 'Y', NULL),
(91, 'rijasanjaya', '7777f8506e870855d7e03d893529fe9a0aa0fd5dfbf38e72cb13c76857ba86fec2d97b1701d27d04955ce5cc0b53b176b40001bbf7348c17ae9d510424f3d640', 'rija sanjaya', 'rijasanjaya@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-02-04', 'Y', NULL),
(92, 'Elvina', '231fdd7494c49488eb33d7cb82a8ff840c5f9fee7b38adff5fe2628273930a12a465de0751aab6ab98ddefd42582d8a3ac82bf821d86158708bf281de9fe063c', 'thisiselvinamardiana', 'thisiselvinamardiana@gmail.com', 'Perempuan', '0000-00-00', '', '', 0, 0, 0, '085651906216', '', '2022-02-04', 'Y', NULL),
(88, 'PPHH', '0551235b1aac1a4fe54f8d75e23c35859785521f1d49f2cd6e579b83c4162efea81c003c671632fcf7a092f53456564e074d5e4d58a012273195ab82e8f1b55a', 'Pusat Pemasaran Hasil Hutan Dishut Kalsel', 'bidpph.kalsel@gmail.com', 'Laki-laki', '2000-01-01', 'Banjarbaru', 'Jalan A. Yani No. 14 - Banjarbaru', 499, 35, 13, '081258662814', '', '2022-01-07', 'Y', NULL),
(93, 'nurilpuadi', 'ab26fa24e9c59d4bfbd814a56c5ab6919a583faeb38705c74b3d7f7cc646b2f87823b56766c7451d7214609eaf328754efda1d27576d76a90a1da75e819a617d', 'Nuril Puadi', 'nurilpuadi@gmail.com', 'Laki-laki', '2022-02-04', 'Banjarmasin, 17 Oktober 1964', 'Jl. Bina Karya No. 79 RT.015 RW.004 Guntung Lua', 499, 35, 13, '081349447725', '', '2022-02-04', 'Y', NULL),
(94, 'abdulwahabwahab186', '8716cd7ecf520bae7acbcb3599e9c71ba3afe4f304971cb6294c8a7ab45835a13a1b3387a5c137f2223af85280c1b213dd99e6ca4ee0e022c0d0bbd820992ad8', 'Abdulwahab Wahab', 'abdulwahabwahab186@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-02-04', 'Y', NULL),
(95, 'lyssaindriani', '6e296f291edaafe07d6e4562b4dd93b3c07766e771ce7762c168c1280e51f3fb26d5e425ba0d442a722a063b149f4e94ac295d37494a7675d291ad082ddb7001', 'LiShaa Indrii', 'lyssaindriani@rocketmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-02-04', 'Y', NULL),
(96, 'hafamadmf', '44d6ce2933232cc75f3e8e8fcbd90e99ad554e559f9c01cfd94b689b740f80c7e3e1cf95e9b5a462e41c632cd58dee53b9c8bfba72c9ee206a6c5e9f8c2572f7', 'Dimas MF', 'hafamadmf@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-02-04', 'Y', NULL),
(97, 'Adi', '02e3a5d8c0b1ae7b18f286e60d92ae099718adebe50b5eb3a26e0dce7e47b6e7eabe004256df7c429e7524a8d21a481c7b27311e6910effd25492730569fb248', 'adi.hriadi', 'adi.hriadi@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, '082251644443', '', '2022-02-04', 'Y', NULL),
(98, 'RUSMIN', 'a161fea9d680f870a9031734f7407eebf475b1b722d6c42e731956713edf39efdee8ea1def5c3014da9637f993a402e58c088f06555de1617bdc76dcfb85baa8', 'rusminnuriyadin', 'rusminnuriyadin@gmail.com', 'Laki-laki', '1975-10-24', 'TANAH BUMBU', 'Jalan Hasta Karya 1 RT. 07 NOMOR 10 DESA PAGARRUYUNG KECAMATAN KUSAN HILIR PAGATAN', 0, 0, 0, '085332862777', '', '2022-02-04', 'Y', NULL),
(99, 'sei.paring63', 'f0654d6205d085fb306095ab58d46c0debfecb51f9597abd46014bbb59949acf60b6b2d206dfbd089e4ca9f3fbd74cceb31dbf8d78fff4fa2077d1525eaac13d', 'Ruslan Ruslan', 'sei.paring63@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-02-04', 'Y', NULL),
(100, 'UMMIAISHWA', '7731654ce4ceec31969fcdeeadf8d5f82110dfc9588036afbda3af0f7489303c7319a0a29c2615301bd3624366b0d82e309299c8ee73fb1eb6f7e7ab0909cb83', 'maulidi.fadhilah.232', 'maulidi.fadhilah.232@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, '085248888778', '', '2022-02-04', 'Y', NULL),
(101, 'tanduo', 'cbbff44f947b01ae880e3f8d552dae1b69a9cc47becf995dabad026b398881632a6f4425510dd4d47c486b34aa90cd82cd518e123beea32858bdda7661c0d260', 'tandu.orianto', 'tandu.orianto@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, '085750750346', '', '2022-02-05', 'Y', NULL),
(102, 'pmpps.kalsel', 'e0e8f64d0783027f6567973de17622cba914c4f77ef33da88cb523fbe24d37ca229f412f2eea92be8f9172998d2e31ea94d92191c1cd66843532725923fd63fa', 'pmpps dishut', 'pmpps.kalsel@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-02-07', 'Y', NULL),
(103, 'rojundi.pedist', '5e7174b18796776a6429d07ea58fb35ff2ac75b543d28eeff3a6abf5716f9b5996b4f08ebb12af24068030b54c711251ed791c45feae2f1c9afda6d29eaaa53e', 'Rony Junaidi', 'rojundi.pedist@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-02-07', 'Y', NULL),
(104, 'asd@gmail.com', '3e39b3844837bdefc8017fbcb386ea302af877fb17baa09d0a1bd34b67bbf2b34fba314bbcab450f5f3f73771b7aea956ba3320defda029723f4fdff7dfa007b', 'asd', 'asd@gmail.com', 'Laki-laki', '0000-00-00', '', 'asd', 505, 36, 13, '123', '', '2022-02-08', '', NULL),
(105, 'kurniawan', '34e219f3c7011e26d3e1751a433aac1b4be3b1a82a2bd6734b43ccd674f634f87b8bdb4270a1aa0b4add6cb94721e33bdc6dd3cf389f500222596eef372f84a5', 'kurniawan iwan', 'kurniaypkp@gmail.com', 'Laki-laki', '2022-02-14', '-', 'Jl. Gajah Mada', 704, 50, 8, '081274957935', '', '2022-02-14', 'Y', NULL),
(106, 'kinta.ambarasti', '237760bb706ce7a7231d2de6ec1a03a62c27cb59345daf29668d73245f1a90ec3c5d46cf63528adc25148cfb999d1573c1bcabc0bf527639a6cfa9ccf2d6afbe', 'kinta ambarasti', 'kinta.ambarasti@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-02-15', 'Y', NULL),
(107, 'MazDeden', '460a7fa45b2965f799375e450a0fd2efdba3fe312779d556c765fb42737b951eb06ee8dafefb4004964fa0e03d09f61d23da451e64032f49fa9fff75512c7664', 'dennypurnomo', 'dennypurnomo@yahoo.co.id', 'Laki-laki', '1977-04-07', 'Banjarmasin', 'Jl. Jeruk Perum Griya Mustika Bukit Asri No.E4 Banjarbaru', 500, 35, 13, '085251250450', '', '2022-02-21', 'Y', NULL),
(108, 'kph.sengayam', '2ab2fcd6ccfd60823ed7b6623ae4788fc5d3c9fb3feacbf328d935e72529c8126395472394a464c9ba429b5f93e9fbccef4a72a547413c789ccd870495ca3cb4', 'kph.sengayam', 'kph.sengayam@gmail.com', 'Laki-laki', '2000-10-16', 'Banjarmasin', 'Jln. Jenderal Sudirman, Sengayam, Kec. Pamukan Barat. Kab. Kotabaru - Kalimantan Selatan 72169', 2856, 203, 13, '083112263832', 'SENGAYAM1.png', '2022-02-24', 'Y', NULL),
(109, 'syafie.bjb', 'c6eb2c5317bd4a06291a7e8c8dd5b86ff2146b69ebfa06cab77fca7ea3396b03762a2ffc4b6de0fa86f54be16ec3561fe18906f1cd70110da16b53ae7f79a38c', 'Abdullah Syafie', 'syafie.bjb@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-03-09', 'Y', NULL),
(110, 'yd7hpf.btlcn', 'c0c30eafa6734b293c222658ba68b746f755ea0c3b2b11f35f928b44fd97f5845dfa8c9367b7de8667b259eb725540bbcbec97b6afefc68e3b6e843091c47112', 'Abdul yd7hpf', 'yd7hpf.btlcn@gmail.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, NULL, '', '2022-03-22', 'Y', NULL),
(111, 'Astidwirahmawati', '018c90827744330bf48819fe629534a27086db18a11347b8573d2bd4a3d423a76a8860f1ecce601fbd049c1b3d2c83f45efd1b29597615a60a5f9ab13bb612b7', 'astidwirahmawati', 'astidwirahmawati@gmail.com', 'Perempuan', '0000-00-00', '', '', 0, 0, 0, '081314634635', '', '2022-04-05', 'Y', NULL),
(112, 'testing123', 'e67a20d5a981d8d6a7ad2bf6a6bb9494d9cb7ed49bdc2a7c10ce6d47c555b70ada5143563af33e9d948a6982cad9193e1619be46d61517e437b141c5bcaf392e', 'test', 'test@test.com', 'Laki-laki', '0000-00-00', '', '', 0, 0, 0, '08881111111', '', '2022-04-25', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rb_konsumen_alamat`
--

CREATE TABLE `rb_konsumen_alamat` (
  `id_konsumen_alamat` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `waktu_perubahan` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_konsumen_detail`
--

CREATE TABLE `rb_konsumen_detail` (
  `id_konsumen_detail` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('sosmed','rekening') NOT NULL DEFAULT 'sosmed',
  `waktu_input` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_konsumen_detail`
--

INSERT INTO `rb_konsumen_detail` (`id_konsumen_detail`, `id_konsumen`, `keterangan`, `status`, `waktu_input`) VALUES
(15, 7, 'KPHCantung;-;-;-;-;-PKWarior;-;-', 'sosmed', '2021-10-27 09:59:44'),
(16, 5, 'https://www.facebook.com/kph.laut;-;https://www.instagram.com/kph_tala/;085245487969;-;https://www.youtube.com/channel/UCZzctzgdXnG3ciSdxP18Tww;-;kph.kabtanahlaut@gmail.com', 'sosmed', '2021-12-10 14:40:56'),
(17, 88, 'https://www.facebook.com/balai.pphh.7;-;https://www.instagram.com/pphh_dishut_kalsel/;081258662814;-;-;-;-', 'sosmed', '2022-02-04 11:47:10'),
(18, 108, 'https://www.facebook.com/kph.sengayam;-;https://www.instagram.com/invites/contact/?i=46st94auwsj3&amp;utm_content=h61nmc0;-;-;https://youtub.com/channel/UCqtJ4EvfmQA9qcCIJmKnAw;-;kph.sengayam@gmail.com', 'sosmed', '2022-02-24 13:23:30'),
(19, 100, '-;-;-;-085248888778;-;-;-;-', 'sosmed', '2022-03-19 21:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `rb_konsumen_simpan`
--

CREATE TABLE `rb_konsumen_simpan` (
  `id_konsumen_simpan` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `waktu_simpan` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_konsumen_simpan`
--

INSERT INTO `rb_konsumen_simpan` (`id_konsumen_simpan`, `id_konsumen`, `id_produk`, `waktu_simpan`) VALUES
(22, 108, 224, '2022-02-24 13:24:06'),
(23, 108, 224, '2022-02-25 23:33:46'),
(24, 8, 183, '2022-04-15 05:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `rb_kota`
--

CREATE TABLE `rb_kota` (
  `kota_id` int(11) NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_kota`
--

INSERT INTO `rb_kota` (`kota_id`, `provinsi_id`, `nama_kota`) VALUES
(17, 1, 'Badung'),
(32, 1, 'Bangli'),
(94, 1, 'Buleleng'),
(114, 1, 'Denpasar'),
(128, 1, 'Gianyar'),
(161, 1, 'Jembrana'),
(170, 1, 'Karangasem'),
(197, 1, 'Klungkung'),
(447, 1, 'Tabanan'),
(27, 2, 'Bangka'),
(28, 2, 'Bangka Barat'),
(29, 2, 'Bangka Selatan'),
(30, 2, 'Bangka Tengah'),
(56, 2, 'Belitung'),
(57, 2, 'Belitung Timur'),
(334, 2, 'Pangkal Pinang'),
(106, 3, 'Cilegon'),
(232, 3, 'Lebak'),
(331, 3, 'Pandeglang'),
(402, 3, 'Serang'),
(403, 3, 'Serang'),
(455, 3, 'Tangerang'),
(456, 3, 'Tangerang'),
(457, 3, 'Tangerang Selatan'),
(62, 4, 'Bengkulu'),
(63, 4, 'Bengkulu Selatan'),
(64, 4, 'Bengkulu Tengah'),
(65, 4, 'Bengkulu Utara'),
(175, 4, 'Kaur'),
(183, 4, 'Kepahiang'),
(233, 4, 'Lebong'),
(294, 4, 'Muko Muko'),
(379, 4, 'Rejang Lebong'),
(397, 4, 'Seluma'),
(39, 5, 'Bantul'),
(135, 5, 'Gunung Kidul'),
(210, 5, 'Kulon Progo'),
(419, 5, 'Sleman'),
(501, 5, 'Yogyakarta'),
(151, 6, 'Jakarta Barat'),
(152, 6, 'Jakarta Pusat'),
(153, 6, 'Jakarta Selatan'),
(154, 6, 'Jakarta Timur'),
(155, 6, 'Jakarta Utara'),
(189, 6, 'Kepulauan Seribu'),
(77, 7, 'Boalemo'),
(88, 7, 'Bone Bolango'),
(129, 7, 'Gorontalo'),
(130, 7, 'Gorontalo'),
(131, 7, 'Gorontalo Utara'),
(361, 7, 'Pohuwato'),
(50, 8, 'Batang Hari'),
(97, 8, 'Bungo'),
(156, 8, 'Jambi'),
(194, 8, 'Kerinci'),
(280, 8, 'Merangin'),
(293, 8, 'Muaro Jambi'),
(393, 8, 'Sarolangun'),
(442, 8, 'Sungaipenuh'),
(460, 8, 'Tanjung Jabung Barat'),
(461, 8, 'Tanjung Jabung Timur'),
(471, 8, 'Tebo'),
(22, 9, 'Bandung'),
(23, 9, 'Bandung'),
(24, 9, 'Bandung Barat'),
(34, 9, 'Banjar'),
(54, 9, 'Bekasi'),
(55, 9, 'Bekasi'),
(78, 9, 'Bogor'),
(79, 9, 'Bogor'),
(103, 9, 'Ciamis'),
(104, 9, 'Cianjur'),
(107, 9, 'Cimahi'),
(108, 9, 'Cirebon'),
(109, 9, 'Cirebon'),
(115, 9, 'Depok'),
(126, 9, 'Garut'),
(149, 9, 'Indramayu'),
(171, 9, 'Karawang'),
(211, 9, 'Kuningan'),
(252, 9, 'Majalengka'),
(332, 9, 'Pangandaran'),
(376, 9, 'Purwakarta'),
(428, 9, 'Subang'),
(430, 9, 'Sukabumi'),
(431, 9, 'Sukabumi'),
(440, 9, 'Sumedang'),
(468, 9, 'Tasikmalaya'),
(469, 9, 'Tasikmalaya'),
(37, 10, 'Banjarnegara'),
(41, 10, 'Banyumas'),
(49, 10, 'Batang'),
(76, 10, 'Blora'),
(91, 10, 'Boyolali'),
(92, 10, 'Brebes'),
(105, 10, 'Cilacap'),
(113, 10, 'Demak'),
(134, 10, 'Grobogan'),
(163, 10, 'Jepara'),
(169, 10, 'Karanganyar'),
(177, 10, 'Kebumen'),
(181, 10, 'Kendal'),
(196, 10, 'Klaten'),
(209, 10, 'Kudus'),
(249, 10, 'Magelang'),
(250, 10, 'Magelang'),
(344, 10, 'Pati'),
(348, 10, 'Pekalongan'),
(349, 10, 'Pekalongan'),
(352, 10, 'Pemalang'),
(375, 10, 'Purbalingga'),
(377, 10, 'Purworejo'),
(380, 10, 'Rembang'),
(386, 10, 'Salatiga'),
(398, 10, 'Semarang'),
(399, 10, 'Semarang'),
(427, 10, 'Sragen'),
(433, 10, 'Sukoharjo'),
(445, 10, 'Surakarta (Solo)'),
(472, 10, 'Tegal'),
(473, 10, 'Tegal'),
(476, 10, 'Temanggung'),
(497, 10, 'Wonogiri'),
(498, 10, 'Wonosobo'),
(31, 11, 'Bangkalan'),
(42, 11, 'Banyuwangi'),
(51, 11, 'Batu'),
(74, 11, 'Blitar'),
(75, 11, 'Blitar'),
(80, 11, 'Bojonegoro'),
(86, 11, 'Bondowoso'),
(133, 11, 'Gresik'),
(160, 11, 'Jember'),
(164, 11, 'Jombang'),
(178, 11, 'Kediri'),
(179, 11, 'Kediri'),
(222, 11, 'Lamongan'),
(243, 11, 'Lumajang'),
(247, 11, 'Madiun'),
(248, 11, 'Madiun'),
(251, 11, 'Magetan'),
(256, 11, 'Malang'),
(255, 11, 'Malang'),
(289, 11, 'Mojokerto'),
(290, 11, 'Mojokerto'),
(305, 11, 'Nganjuk'),
(306, 11, 'Ngawi'),
(317, 11, 'Pacitan'),
(330, 11, 'Pamekasan'),
(342, 11, 'Pasuruan'),
(343, 11, 'Pasuruan'),
(363, 11, 'Ponorogo'),
(369, 11, 'Probolinggo'),
(370, 11, 'Probolinggo'),
(390, 11, 'Sampang'),
(409, 11, 'Sidoarjo'),
(418, 11, 'Situbondo'),
(441, 11, 'Sumenep'),
(444, 11, 'Surabaya'),
(487, 11, 'Trenggalek'),
(489, 11, 'Tuban'),
(492, 11, 'Tulungagung'),
(61, 12, 'Bengkayang'),
(168, 12, 'Kapuas Hulu'),
(176, 12, 'Kayong Utara'),
(195, 12, 'Ketapang'),
(208, 12, 'Kubu Raya'),
(228, 12, 'Landak'),
(279, 12, 'Melawi'),
(364, 12, 'Pontianak'),
(365, 12, 'Pontianak'),
(388, 12, 'Sambas'),
(391, 12, 'Sanggau'),
(395, 12, 'Sekadau'),
(415, 12, 'Singkawang'),
(417, 12, 'Sintang'),
(18, 13, 'Balangan'),
(33, 13, 'Banjar'),
(35, 13, 'Banjarbaru'),
(36, 13, 'Banjarmasin'),
(43, 13, 'Barito Kuala'),
(143, 13, 'Hulu Sungai Selatan'),
(144, 13, 'Hulu Sungai Tengah'),
(145, 13, 'Hulu Sungai Utara'),
(203, 13, 'Kotabaru'),
(446, 13, 'Tabalong'),
(452, 13, 'Tanah Bumbu'),
(454, 13, 'Tanah Laut'),
(466, 13, 'Tapin'),
(44, 14, 'Barito Selatan'),
(45, 14, 'Barito Timur'),
(46, 14, 'Barito Utara'),
(136, 14, 'Gunung Mas'),
(167, 14, 'Kapuas'),
(174, 14, 'Katingan'),
(205, 14, 'Kotawaringin Barat'),
(206, 14, 'Kotawaringin Timur'),
(221, 14, 'Lamandau'),
(296, 14, 'Murung Raya'),
(326, 14, 'Palangka Raya'),
(371, 14, 'Pulang Pisau'),
(405, 14, 'Seruyan'),
(432, 14, 'Sukamara'),
(19, 15, 'Balikpapan'),
(66, 15, 'Berau'),
(89, 15, 'Bontang'),
(214, 15, 'Kutai Barat'),
(215, 15, 'Kutai Kartanegara'),
(216, 15, 'Kutai Timur'),
(341, 15, 'Paser'),
(354, 15, 'Penajam Paser Utara'),
(387, 15, 'Samarinda'),
(96, 16, 'Bulungan (Bulongan)'),
(257, 16, 'Malinau'),
(311, 16, 'Nunukan'),
(450, 16, 'Tana Tidung'),
(467, 16, 'Tarakan'),
(48, 17, 'Batam'),
(71, 17, 'Bintan'),
(172, 17, 'Karimun'),
(184, 17, 'Kepulauan Anambas'),
(237, 17, 'Lingga'),
(302, 17, 'Natuna'),
(462, 17, 'Tanjung Pinang'),
(21, 18, 'Bandar Lampung'),
(223, 18, 'Lampung Barat'),
(224, 18, 'Lampung Selatan'),
(225, 18, 'Lampung Tengah'),
(226, 18, 'Lampung Timur'),
(227, 18, 'Lampung Utara'),
(282, 18, 'Mesuji'),
(283, 18, 'Metro'),
(355, 18, 'Pesawaran'),
(356, 18, 'Pesisir Barat'),
(368, 18, 'Pringsewu'),
(458, 18, 'Tanggamus'),
(490, 18, 'Tulang Bawang'),
(491, 18, 'Tulang Bawang Barat'),
(496, 18, 'Way Kanan'),
(14, 19, 'Ambon'),
(99, 19, 'Buru'),
(100, 19, 'Buru Selatan'),
(185, 19, 'Kepulauan Aru'),
(258, 19, 'Maluku Barat Daya'),
(259, 19, 'Maluku Tengah'),
(260, 19, 'Maluku Tenggara'),
(261, 19, 'Maluku Tenggara Barat'),
(400, 19, 'Seram Bagian Barat'),
(401, 19, 'Seram Bagian Timur'),
(488, 19, 'Tual'),
(138, 20, 'Halmahera Barat'),
(139, 20, 'Halmahera Selatan'),
(140, 20, 'Halmahera Tengah'),
(141, 20, 'Halmahera Timur'),
(142, 20, 'Halmahera Utara'),
(191, 20, 'Kepulauan Sula'),
(372, 20, 'Pulau Morotai'),
(477, 20, 'Ternate'),
(478, 20, 'Tidore Kepulauan'),
(1, 21, 'Aceh Barat'),
(2, 21, 'Aceh Barat Daya'),
(3, 21, 'Aceh Besar'),
(4, 21, 'Aceh Jaya'),
(5, 21, 'Aceh Selatan'),
(6, 21, 'Aceh Singkil'),
(7, 21, 'Aceh Tamiang'),
(8, 21, 'Aceh Tengah'),
(9, 21, 'Aceh Tenggara'),
(10, 21, 'Aceh Timur'),
(11, 21, 'Aceh Utara'),
(20, 21, 'Banda Aceh'),
(59, 21, 'Bener Meriah'),
(72, 21, 'Bireuen'),
(127, 21, 'Gayo Lues'),
(230, 21, 'Langsa'),
(235, 21, 'Lhokseumawe'),
(300, 21, 'Nagan Raya'),
(358, 21, 'Pidie'),
(359, 21, 'Pidie Jaya'),
(384, 21, 'Sabang'),
(414, 21, 'Simeulue'),
(429, 21, 'Subulussalam'),
(68, 22, 'Bima'),
(69, 22, 'Bima'),
(118, 22, 'Dompu'),
(238, 22, 'Lombok Barat'),
(239, 22, 'Lombok Tengah'),
(240, 22, 'Lombok Timur'),
(241, 22, 'Lombok Utara'),
(276, 22, 'Mataram'),
(438, 22, 'Sumbawa'),
(439, 22, 'Sumbawa Barat'),
(13, 23, 'Alor'),
(58, 23, 'Belu'),
(122, 23, 'Ende'),
(125, 23, 'Flores Timur'),
(212, 23, 'Kupang'),
(213, 23, 'Kupang'),
(234, 23, 'Lembata'),
(269, 23, 'Manggarai'),
(270, 23, 'Manggarai Barat'),
(271, 23, 'Manggarai Timur'),
(301, 23, 'Nagekeo'),
(304, 23, 'Ngada'),
(383, 23, 'Rote Ndao'),
(385, 23, 'Sabu Raijua'),
(412, 23, 'Sikka'),
(434, 23, 'Sumba Barat'),
(435, 23, 'Sumba Barat Daya'),
(436, 23, 'Sumba Tengah'),
(437, 23, 'Sumba Timur'),
(479, 23, 'Timor Tengah Selatan'),
(480, 23, 'Timor Tengah Utara'),
(16, 24, 'Asmat'),
(67, 24, 'Biak Numfor'),
(90, 24, 'Boven Digoel'),
(111, 24, 'Deiyai (Deliyai)'),
(117, 24, 'Dogiyai'),
(150, 24, 'Intan Jaya'),
(157, 24, 'Jayapura'),
(158, 24, 'Jayapura'),
(159, 24, 'Jayawijaya'),
(180, 24, 'Keerom'),
(193, 24, 'Kepulauan Yapen (Yapen Waropen)'),
(231, 24, 'Lanny Jaya'),
(263, 24, 'Mamberamo Raya'),
(264, 24, 'Mamberamo Tengah'),
(274, 24, 'Mappi'),
(281, 24, 'Merauke'),
(284, 24, 'Mimika'),
(299, 24, 'Nabire'),
(303, 24, 'Nduga'),
(335, 24, 'Paniai'),
(347, 24, 'Pegunungan Bintang'),
(373, 24, 'Puncak'),
(374, 24, 'Puncak Jaya'),
(392, 24, 'Sarmi'),
(443, 24, 'Supiori'),
(484, 24, 'Tolikara'),
(495, 24, 'Waropen'),
(499, 24, 'Yahukimo'),
(500, 24, 'Yalimo'),
(124, 25, 'Fakfak'),
(165, 25, 'Kaimana'),
(272, 25, 'Manokwari'),
(273, 25, 'Manokwari Selatan'),
(277, 25, 'Maybrat'),
(346, 25, 'Pegunungan Arfak'),
(378, 25, 'Raja Ampat'),
(424, 25, 'Sorong'),
(425, 25, 'Sorong'),
(426, 25, 'Sorong Selatan'),
(449, 25, 'Tambrauw'),
(474, 25, 'Teluk Bintuni'),
(475, 25, 'Teluk Wondama'),
(60, 26, 'Bengkalis'),
(120, 26, 'Dumai'),
(147, 26, 'Indragiri Hilir'),
(148, 26, 'Indragiri Hulu'),
(166, 26, 'Kampar'),
(187, 26, 'Kepulauan Meranti'),
(207, 26, 'Kuantan Singingi'),
(350, 26, 'Pekanbaru'),
(351, 26, 'Pelalawan'),
(381, 26, 'Rokan Hilir'),
(382, 26, 'Rokan Hulu'),
(406, 26, 'Siak'),
(253, 27, 'Majene'),
(262, 27, 'Mamasa'),
(265, 27, 'Mamuju'),
(266, 27, 'Mamuju Utara'),
(362, 27, 'Polewali Mandar'),
(38, 28, 'Bantaeng'),
(47, 28, 'Barru'),
(87, 28, 'Bone'),
(95, 28, 'Bulukumba'),
(123, 28, 'Enrekang'),
(132, 28, 'Gowa'),
(162, 28, 'Jeneponto'),
(244, 28, 'Luwu'),
(245, 28, 'Luwu Timur'),
(246, 28, 'Luwu Utara'),
(254, 28, 'Makassar'),
(275, 28, 'Maros'),
(328, 28, 'Palopo'),
(333, 28, 'Pangkajene Kepulauan'),
(336, 28, 'Parepare'),
(360, 28, 'Pinrang'),
(396, 28, 'Selayar (Kepulauan Selayar)'),
(408, 28, 'Sidenreng Rappang/Rapang'),
(416, 28, 'Sinjai'),
(423, 28, 'Soppeng'),
(448, 28, 'Takalar'),
(451, 28, 'Tana Toraja'),
(486, 28, 'Toraja Utara'),
(493, 28, 'Wajo'),
(25, 29, 'Banggai'),
(26, 29, 'Banggai Kepulauan'),
(98, 29, 'Buol'),
(119, 29, 'Donggala'),
(291, 29, 'Morowali'),
(329, 29, 'Palu'),
(338, 29, 'Parigi Moutong'),
(366, 29, 'Poso'),
(410, 29, 'Sigi'),
(482, 29, 'Tojo Una-Una'),
(483, 29, 'Toli-Toli'),
(53, 30, 'Bau-Bau'),
(85, 30, 'Bombana'),
(101, 30, 'Buton'),
(102, 30, 'Buton Utara'),
(182, 30, 'Kendari'),
(198, 30, 'Kolaka'),
(199, 30, 'Kolaka Utara'),
(200, 30, 'Konawe'),
(201, 30, 'Konawe Selatan'),
(202, 30, 'Konawe Utara'),
(295, 30, 'Muna'),
(494, 30, 'Wakatobi'),
(73, 31, 'Bitung'),
(81, 31, 'Bolaang Mongondow (Bolmong)'),
(82, 31, 'Bolaang Mongondow Selatan'),
(83, 31, 'Bolaang Mongondow Timur'),
(84, 31, 'Bolaang Mongondow Utara'),
(188, 31, 'Kepulauan Sangihe'),
(190, 31, 'Kepulauan Siau Tagulandang Biaro (Sitaro)'),
(192, 31, 'Kepulauan Talaud'),
(204, 31, 'Kotamobagu'),
(267, 31, 'Manado'),
(285, 31, 'Minahasa'),
(286, 31, 'Minahasa Selatan'),
(287, 31, 'Minahasa Tenggara'),
(288, 31, 'Minahasa Utara'),
(485, 31, 'Tomohon'),
(12, 32, 'Agam'),
(93, 32, 'Bukittinggi'),
(116, 32, 'Dharmasraya'),
(186, 32, 'Kepulauan Mentawai'),
(236, 32, 'Lima Puluh Koto/Kota'),
(318, 32, 'Padang'),
(321, 32, 'Padang Panjang'),
(322, 32, 'Padang Pariaman'),
(337, 32, 'Pariaman'),
(339, 32, 'Pasaman'),
(340, 32, 'Pasaman Barat'),
(345, 32, 'Payakumbuh'),
(357, 32, 'Pesisir Selatan'),
(394, 32, 'Sawah Lunto'),
(411, 32, 'Sijunjung (Sawah Lunto Sijunjung)'),
(420, 32, 'Solok'),
(421, 32, 'Solok'),
(422, 32, 'Solok Selatan'),
(453, 32, 'Tanah Datar'),
(40, 33, 'Banyuasin'),
(121, 33, 'Empat Lawang'),
(220, 33, 'Lahat'),
(242, 33, 'Lubuk Linggau'),
(292, 33, 'Muara Enim'),
(297, 33, 'Musi Banyuasin'),
(298, 33, 'Musi Rawas'),
(312, 33, 'Ogan Ilir'),
(313, 33, 'Ogan Komering Ilir'),
(314, 33, 'Ogan Komering Ulu'),
(315, 33, 'Ogan Komering Ulu Selatan'),
(316, 33, 'Ogan Komering Ulu Timur'),
(324, 33, 'Pagar Alam'),
(327, 33, 'Palembang'),
(367, 33, 'Prabumulih'),
(15, 34, 'Asahan'),
(52, 34, 'Batu Bara'),
(70, 34, 'Binjai'),
(110, 34, 'Dairi'),
(112, 34, 'Deli Serdang'),
(137, 34, 'Gunungsitoli'),
(146, 34, 'Humbang Hasundutan'),
(173, 34, 'Karo'),
(217, 34, 'Labuhan Batu'),
(218, 34, 'Labuhan Batu Selatan'),
(219, 34, 'Labuhan Batu Utara'),
(229, 34, 'Langkat'),
(268, 34, 'Mandailing Natal'),
(278, 34, 'Medan'),
(307, 34, 'Nias'),
(308, 34, 'Nias Barat'),
(309, 34, 'Nias Selatan'),
(310, 34, 'Nias Utara'),
(319, 34, 'Padang Lawas'),
(320, 34, 'Padang Lawas Utara'),
(323, 34, 'Padang Sidempuan'),
(325, 34, 'Pakpak Bharat'),
(353, 34, 'Pematang Siantar'),
(389, 34, 'Samosir'),
(404, 34, 'Serdang Bedagai'),
(407, 34, 'Sibolga'),
(413, 34, 'Simalungun'),
(459, 34, 'Tanjung Balai'),
(463, 34, 'Tapanuli Selatan'),
(464, 34, 'Tapanuli Tengah'),
(465, 34, 'Tapanuli Utara'),
(470, 34, 'Tebing Tinggi'),
(481, 34, 'Toba Samosir');

-- --------------------------------------------------------

--
-- Table structure for table `rb_kurir`
--

CREATE TABLE `rb_kurir` (
  `id_kurir` int(11) NOT NULL,
  `kode_kurir` varchar(50) NOT NULL,
  `nama_kurir` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_kurir`
--

INSERT INTO `rb_kurir` (`id_kurir`, `kode_kurir`, `nama_kurir`) VALUES
(1, 'jne', 'JNE'),
(2, 'jnt', 'J&T'),
(3, 'tiki', 'TIKI'),
(4, 'sicepat', 'SiCepat Express'),
(5, 'pos', 'POS Indonesia'),
(6, 'jet', 'JET Express'),
(7, 'lion', 'Lion Parcel'),
(8, 'ninja', 'Ninja Xpress'),
(9, 'wahana', 'Wahana Prestasi Logistik'),
(10, 'rpx', 'RPX Holding'),
(11, 'rex', 'Royal Express Indonesia (REX)'),
(12, 'ide', 'ID Express (IDE)'),
(13, 'sentral', 'Sentral Cargo (SC)');

-- --------------------------------------------------------

--
-- Table structure for table `rb_paket`
--

CREATE TABLE `rb_paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `durasi` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `max_produk` int(11) NOT NULL,
  `icon_kode` varchar(100) DEFAULT NULL,
  `icon_image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_paket`
--

INSERT INTO `rb_paket` (`id_paket`, `nama_paket`, `judul`, `keterangan`, `durasi`, `harga`, `max_produk`, `icon_kode`, `icon_image`) VALUES
(1, 'Star Seller 1 Bulan', 'Paket Wajib Untuk anda para Newbie', 'Masa Aktif 30 Hari\r\nMaksimal untuk 100 Produk\r\nSelangkapnya : <a target=\"_BLANK\" href=\"https://tajalapak.com/halaman/detail/star-seller-1-bulan\">baca disini</a>', 30, 199000, 100, '', 'star1.png'),
(2, 'Star Seller 3 Bulan', 'Paket Wajib Untuk anda para Pedagang', 'Masa Aktif 90 Hari\r\nMaksimal untuk 200 Produk\r\nSelangkapnya : <a target=\"_BLANK\" href=\"https://tajalapak.com/halaman/detail/star-seller-3-bulan\">baca disini</a>', 90, 549000, 200, '', 'star2.png'),
(3, 'Star Seller 6 Bulan', 'Paket Wajib Untuk anda Berjiwa Pengusaha', 'Masa Aktif 180 Hari\r\nMaksimal untuk 300 Produk\r\nSelangkapnya : <a target=\"_BLANK\" href=\"https://tajalapak.com/halaman/detail/star-seller-6-bulan\">baca disini</a>', 180, 999000, 300, '', 'star3.png');

-- --------------------------------------------------------

--
-- Table structure for table `rb_pembayaran_bonus`
--

CREATE TABLE `rb_pembayaran_bonus` (
  `id_pembayaran_bonus` int(10) NOT NULL,
  `username` varchar(60) NOT NULL,
  `nominal_bayar` int(10) NOT NULL,
  `waktu_bayar` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_pembelian`
--

CREATE TABLE `rb_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `kode_pembelian` varchar(50) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `waktu_beli` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_pembelian_detail`
--

CREATE TABLE `rb_pembelian_detail` (
  `id_pembelian_detail` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_pesan` int(11) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_pembelian_pulsa`
--

CREATE TABLE `rb_pembelian_pulsa` (
  `id_pembelian_pulsa` int(11) NOT NULL,
  `id_reseller` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` text,
  `api_trxid` text,
  `waktu_pembelian` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_pencairan_bonus`
--

CREATE TABLE `rb_pencairan_bonus` (
  `id_pencairan_bonus` int(11) NOT NULL,
  `id_reseller` int(11) NOT NULL,
  `bonus_referral` int(11) NOT NULL,
  `waktu_pencairan` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_pencairan_reward`
--

CREATE TABLE `rb_pencairan_reward` (
  `id_pencairan_reward` int(11) NOT NULL,
  `id_reseller` int(11) NOT NULL,
  `id_reward` int(11) NOT NULL,
  `reward_date` varchar(10) NOT NULL,
  `waktu_pencairan` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rb_penjualan`
--

CREATE TABLE `rb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL DEFAULT '0',
  `status_pembeli` enum('reseller','konsumen') NOT NULL,
  `status_penjual` enum('admin','reseller') NOT NULL,
  `no_resi` varchar(255) DEFAULT NULL,
  `kode_kurir` varchar(100) DEFAULT NULL,
  `kurir` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `keterangan` text,
  `waktu_transaksi` datetime NOT NULL,
  `proses` enum('0','1','2','3','4') NOT NULL,
  `fee` int(11) DEFAULT NULL,
  `fee_admin` int(11) DEFAULT NULL,
  `dropshipper` text,
  `group_order` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_penjualan`
--

INSERT INTO `rb_penjualan` (`id_penjualan`, `kode_transaksi`, `id_pembeli`, `id_penjual`, `status_pembeli`, `status_penjual`, `no_resi`, `kode_kurir`, `kurir`, `service`, `ongkir`, `keterangan`, `waktu_transaksi`, `proses`, `fee`, `fee_admin`, `dropshipper`, `group_order`) VALUES
(187, 'TRX-20210819124913', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:49:13', '4', NULL, NULL, NULL, NULL),
(186, 'TRX-20210819123930', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:39:30', '4', NULL, NULL, NULL, NULL),
(185, 'TRX-20210819123920', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:39:20', '4', NULL, NULL, NULL, NULL),
(184, 'TRX-20210819123911', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:39:11', '4', NULL, NULL, NULL, NULL),
(183, 'TRX-20210819123903', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:39:03', '4', NULL, NULL, NULL, NULL),
(182, 'TRX-20210819123854', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:38:54', '4', NULL, NULL, NULL, NULL),
(181, 'TRX-20210819123846', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:38:46', '4', NULL, NULL, NULL, NULL),
(180, 'TRX-20210819123410', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:34:10', '4', NULL, NULL, NULL, NULL),
(179, 'TRX-20210819123402', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:34:02', '4', NULL, NULL, NULL, NULL),
(178, 'TRX-20210819123305', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:33:05', '4', NULL, NULL, NULL, NULL),
(177, 'TRX-20210819123253', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:32:53', '4', NULL, NULL, NULL, NULL),
(176, 'TRX-20210819123246', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:32:46', '4', NULL, NULL, NULL, NULL),
(175, 'TRX-20210819123237', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:32:37', '4', NULL, NULL, NULL, NULL),
(174, 'TRX-20210819123230', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:32:30', '4', NULL, NULL, NULL, NULL),
(173, 'TRX-20210819123223', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:32:23', '4', NULL, NULL, NULL, NULL),
(172, 'TRX-20210819123215', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:32:15', '4', NULL, NULL, NULL, NULL),
(171, 'TRX-20210819123020', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:30:20', '4', NULL, NULL, NULL, NULL),
(170, 'TRX-20210819123011', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:30:11', '4', NULL, NULL, NULL, NULL),
(169, 'TRX-20210819122959', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:29:59', '4', NULL, NULL, NULL, NULL),
(168, 'TRX-20210819122944', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:29:44', '4', NULL, NULL, NULL, NULL),
(167, 'TRX-20210819122915', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:29:15', '4', NULL, NULL, NULL, NULL),
(166, 'TRX-20210819122905', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:29:05', '4', NULL, NULL, NULL, NULL),
(165, 'TRX-20210819122845', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:28:45', '4', NULL, NULL, NULL, NULL),
(164, 'TRX-20210819122836', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:28:36', '4', NULL, NULL, NULL, NULL),
(163, 'TRX-20210819122826', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:28:26', '4', NULL, NULL, NULL, NULL),
(162, 'TRX-20210819122812', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:28:12', '4', NULL, NULL, NULL, NULL),
(160, 'TRX-20210819122752', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:27:52', '4', NULL, NULL, NULL, NULL),
(161, 'TRX-20210819122802', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:28:02', '4', NULL, NULL, NULL, NULL),
(159, 'TRX-20210819122743', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:27:43', '4', NULL, NULL, NULL, NULL),
(158, 'TRX-20210819122735', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:27:35', '4', NULL, NULL, NULL, NULL),
(157, 'TRX-20210819122726', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:27:26', '4', NULL, NULL, NULL, NULL),
(155, 'TRX-20210819122710', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:27:10', '4', NULL, NULL, NULL, NULL),
(156, 'TRX-20210819122718', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:27:18', '4', NULL, NULL, NULL, NULL),
(154, 'TRX-20210819122624', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:26:24', '4', NULL, NULL, NULL, NULL),
(153, 'TRX-20210819122616', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:26:16', '4', NULL, NULL, NULL, NULL),
(152, 'TRX-20210819122606', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:26:06', '4', NULL, NULL, NULL, NULL),
(150, 'TRX-20210819122548', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:25:48', '4', NULL, NULL, NULL, NULL),
(151, 'TRX-20210819122557', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:25:57', '4', NULL, NULL, NULL, NULL),
(149, 'TRX-20210819122405', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:24:05', '4', NULL, NULL, NULL, NULL),
(148, 'TRX-20210819122354', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:23:54', '4', NULL, NULL, NULL, NULL),
(145, 'TRX-20210817183558', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:35:58', '4', NULL, NULL, NULL, NULL),
(147, 'TRX-20210819122345', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:23:45', '4', NULL, NULL, NULL, NULL),
(144, 'TRX-20210817183545', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:35:45', '4', NULL, NULL, NULL, NULL),
(143, 'TRX-20210817183534', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:35:34', '4', NULL, NULL, NULL, NULL),
(141, 'TRX-20210817183412', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:34:12', '4', NULL, NULL, NULL, NULL),
(142, 'TRX-20210817183424', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:34:24', '4', NULL, NULL, NULL, NULL),
(140, 'TRX-20210817183357', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:33:57', '4', NULL, NULL, NULL, NULL),
(138, 'TRX-20210817183340', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:33:40', '4', NULL, NULL, NULL, NULL),
(139, 'TRX-20210817183349', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:33:49', '4', NULL, NULL, NULL, NULL),
(137, 'TRX-20210817183332', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:33:32', '4', NULL, NULL, NULL, NULL),
(136, 'TRX-20210817183123', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:31:23', '4', NULL, NULL, NULL, NULL),
(134, 'TRX-20210817183036', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:30:36', '4', NULL, NULL, NULL, NULL),
(135, 'TRX-20210817183110', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:31:10', '4', NULL, NULL, NULL, NULL),
(133, 'TRX-20210817183025', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:30:25', '4', NULL, NULL, NULL, NULL),
(146, 'TRX-20210819122334', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:23:34', '4', NULL, NULL, NULL, NULL),
(131, 'TRX-20210817183003', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:30:03', '4', NULL, NULL, NULL, NULL),
(130, 'TRX-20210817182953', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:29:53', '4', NULL, NULL, NULL, NULL),
(129, 'TRX-20210817182945', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:29:45', '4', NULL, NULL, NULL, NULL),
(128, 'TRX-20210817182936', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:29:36', '4', NULL, NULL, NULL, NULL),
(127, 'TRX-20210817182928', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:29:28', '4', NULL, NULL, NULL, NULL),
(125, 'TRX-20210817182907', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:29:07', '4', NULL, NULL, NULL, NULL),
(126, 'TRX-20210817182919', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:29:19', '4', NULL, NULL, NULL, NULL),
(124, 'TRX-20210817182802', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:28:02', '4', NULL, NULL, NULL, NULL),
(123, 'TRX-20210817182614', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:26:14', '4', NULL, NULL, NULL, NULL),
(121, 'TRX-20210817182318', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:23:18', '4', NULL, NULL, NULL, NULL),
(122, 'TRX-20210817182327', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:23:27', '4', NULL, NULL, NULL, NULL),
(119, 'TRX-20210817182253', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:22:53', '4', NULL, NULL, NULL, NULL),
(120, 'TRX-20210817182302', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:23:02', '4', NULL, NULL, NULL, NULL),
(117, 'TRX-20210817182235', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:22:35', '4', NULL, NULL, NULL, NULL),
(118, 'TRX-20210817182244', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:22:44', '4', NULL, NULL, NULL, NULL),
(116, 'TRX-20210817182227', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:22:27', '4', NULL, NULL, NULL, NULL),
(115, 'TRX-20210817182219', 3, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:22:19', '4', NULL, NULL, NULL, NULL),
(114, 'TRX-20210817182105', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:21:05', '4', NULL, NULL, NULL, NULL),
(112, 'TRX-20210817182034', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:20:34', '4', NULL, NULL, NULL, NULL),
(113, 'TRX-20210817182042', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:20:42', '4', NULL, NULL, NULL, NULL),
(111, 'TRX-20210817182025', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:20:25', '4', NULL, NULL, NULL, NULL),
(110, 'TRX-20210817182006', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:20:06', '4', NULL, NULL, NULL, NULL),
(109, 'TRX-20210817181944', 2, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:19:44', '4', NULL, NULL, NULL, NULL),
(108, 'TRX-20210817181524', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:15:24', '4', NULL, NULL, NULL, NULL),
(107, 'TRX-20210817181120', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:11:20', '4', NULL, NULL, NULL, NULL),
(106, 'TRX-20210817181120', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:11:20', '4', NULL, NULL, NULL, NULL),
(105, 'TRX-20210817181120', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:11:20', '4', NULL, NULL, NULL, NULL),
(104, 'TRX-20210817181120', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:11:20', '4', NULL, NULL, NULL, NULL),
(103, 'TRX-20210817181037', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:10:37', '4', NULL, NULL, NULL, NULL),
(102, 'TRX-20210817180915', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:09:15', '4', NULL, NULL, NULL, NULL),
(101, 'TRX-20210817180653', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:06:53', '4', NULL, NULL, NULL, NULL),
(100, 'TRX-20210817180508', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:05:08', '4', NULL, NULL, NULL, NULL),
(99, 'TRX-20210817180318', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 18:03:18', '4', NULL, NULL, NULL, NULL),
(98, 'TRX-20210817172507', 7, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 17:25:07', '4', NULL, NULL, NULL, NULL),
(97, 'TRX-20210817172353', 7, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 17:23:53', '4', NULL, NULL, NULL, NULL),
(96, 'TRX-20210817171028', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 17:10:28', '4', NULL, NULL, NULL, NULL),
(95, 'TRX-20210817170051', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 17:00:51', '4', NULL, NULL, NULL, NULL),
(94, 'TRX-20210817161211', 4, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-17 16:12:11', '4', NULL, NULL, NULL, NULL),
(188, 'TRX-20210819124930', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:49:30', '4', NULL, NULL, NULL, NULL),
(189, 'TRX-20210819125122', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:51:22', '4', NULL, NULL, NULL, NULL),
(190, 'TRX-20210819125134', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:51:34', '4', NULL, NULL, NULL, NULL),
(191, 'TRX-20210819125144', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:51:44', '4', NULL, NULL, NULL, NULL),
(192, 'TRX-20210819125152', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:51:52', '4', NULL, NULL, NULL, NULL),
(193, 'TRX-20210819125216', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:52:16', '4', NULL, NULL, NULL, NULL),
(194, 'TRX-20210819125227', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:52:27', '4', NULL, NULL, NULL, NULL),
(195, 'TRX-20210819125250', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:52:50', '4', NULL, NULL, NULL, NULL),
(196, 'TRX-20210819125301', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:53:01', '4', NULL, NULL, NULL, NULL),
(197, 'TRX-20210819125906', 7, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:59:06', '4', NULL, NULL, NULL, NULL),
(198, 'TRX-20210819125914', 7, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:59:14', '4', NULL, NULL, NULL, NULL),
(199, 'TRX-20210819125921', 7, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:59:21', '4', NULL, NULL, NULL, NULL),
(200, 'TRX-20210819125929', 7, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:59:29', '4', NULL, NULL, NULL, NULL),
(201, 'TRX-20210819125936', 7, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:59:36', '4', NULL, NULL, NULL, NULL),
(202, 'TRX-20210819125945', 7, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 12:59:45', '4', NULL, NULL, NULL, NULL),
(203, 'TRX-20210819131101', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:11:01', '4', NULL, NULL, NULL, NULL),
(204, 'TRX-20210819131109', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:11:09', '4', NULL, NULL, NULL, NULL),
(205, 'TRX-20210819131127', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:11:27', '4', NULL, NULL, NULL, NULL),
(206, 'TRX-20210819131135', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:11:35', '4', NULL, NULL, NULL, NULL),
(207, 'TRX-20210819131143', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:11:43', '4', NULL, NULL, NULL, NULL),
(208, 'TRX-20210819131311', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:13:11', '4', NULL, NULL, NULL, NULL),
(209, 'TRX-20210819131322', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:13:22', '4', NULL, NULL, NULL, NULL),
(210, 'TRX-20210819131330', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:13:30', '4', NULL, NULL, NULL, NULL),
(211, 'TRX-20210819131338', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:13:38', '4', NULL, NULL, NULL, NULL),
(212, 'TRX-20210819131345', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:13:45', '4', NULL, NULL, NULL, NULL),
(213, 'TRX-20210819131354', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:13:54', '4', NULL, NULL, NULL, NULL),
(214, 'TRX-20210819131402', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:14:02', '4', NULL, NULL, NULL, NULL),
(215, 'TRX-20210819131424', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:14:24', '4', NULL, NULL, NULL, NULL),
(216, 'TRX-20210819131435', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:14:35', '4', NULL, NULL, NULL, NULL),
(217, 'TRX-20210819131444', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:14:44', '4', NULL, NULL, NULL, NULL),
(218, 'TRX-20210819131452', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:14:52', '4', NULL, NULL, NULL, NULL),
(219, 'TRX-20210819131501', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:15:01', '4', NULL, NULL, NULL, NULL),
(220, 'TRX-20210819131512', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-08-19 13:15:12', '4', NULL, NULL, NULL, NULL),
(222, 'TRX-20210928053504', 11, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-09-28 05:35:04', '4', NULL, NULL, NULL, NULL),
(223, 'TRX-20210928054356', 21, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-09-28 05:43:56', '4', NULL, NULL, NULL, NULL),
(308, 'TRX-20220124100149', 1, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-24 10:01:49', '4', NULL, NULL, NULL, NULL),
(226, 'TRX-20211027100719', 1, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-10-27 10:07:19', '4', NULL, NULL, NULL, NULL),
(227, 'TRX-20211027103732', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-10-27 10:37:32', '4', NULL, NULL, NULL, NULL),
(307, 'TRX-20220120113929', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-20 11:39:29', '4', NULL, NULL, NULL, NULL),
(229, 'TRX-20211027110602', 4, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-10-27 11:06:02', '4', NULL, NULL, NULL, NULL),
(230, 'TRX-20211027110743', 8, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-10-27 11:07:43', '4', NULL, NULL, NULL, NULL),
(231, 'TRX-20211027134525', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-10-27 13:45:25', '4', NULL, NULL, NULL, NULL),
(306, 'TRX-20220120113842', 1, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-20 11:38:42', '4', NULL, NULL, NULL, NULL),
(233, 'TRX-20211122071143', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 07:11:43', '4', NULL, NULL, NULL, NULL),
(234, 'TRX-20211122071158', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 07:11:58', '4', NULL, NULL, NULL, NULL),
(235, 'TRX-20211122071215', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 07:12:15', '4', NULL, NULL, NULL, NULL),
(236, 'TRX-20211122071237', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 07:12:37', '4', NULL, NULL, NULL, NULL),
(237, 'TRX-20211122071252', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 07:12:52', '4', NULL, NULL, NULL, NULL),
(238, 'TRX-20211122071336', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 07:13:36', '4', NULL, NULL, NULL, NULL),
(239, 'TRX-20211122071638', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 07:16:38', '4', NULL, NULL, NULL, NULL),
(240, 'TRX-20211122071735', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 07:17:35', '4', NULL, NULL, NULL, NULL),
(241, 'TRX-20211122072611', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 07:26:11', '4', NULL, NULL, NULL, NULL),
(242, 'TRX-20211122083934', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 08:39:34', '4', NULL, NULL, NULL, NULL),
(243, 'TRX-20211122084036', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 08:40:36', '4', NULL, NULL, NULL, NULL),
(244, 'TRX-20211122084104', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 08:41:04', '4', NULL, NULL, NULL, NULL),
(245, 'TRX-20211122084223', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 08:42:23', '4', NULL, NULL, NULL, NULL),
(246, 'TRX-20211122084318', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 08:43:18', '4', NULL, NULL, NULL, NULL),
(247, 'TRX-20211122084404', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 08:44:04', '4', NULL, NULL, NULL, NULL),
(248, 'TRX-20211122084618', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 08:46:18', '4', NULL, NULL, NULL, NULL),
(249, 'TRX-20211122084650', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 08:46:50', '4', NULL, NULL, NULL, NULL),
(250, 'TRX-20211122084821', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 08:48:21', '4', NULL, NULL, NULL, NULL),
(251, 'TRX-20211122090520', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 09:05:20', '4', NULL, NULL, NULL, NULL),
(252, 'TRX-20211122090705', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 09:07:05', '4', NULL, NULL, NULL, NULL),
(253, 'TRX-20211122090819', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 09:08:19', '4', NULL, NULL, NULL, NULL),
(254, 'TRX-20211122091037', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 09:10:37', '4', NULL, NULL, NULL, NULL),
(255, 'TRX-20211122091702', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 09:17:02', '4', NULL, NULL, NULL, NULL),
(256, 'TRX-20211122091722', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-22 09:17:22', '4', NULL, NULL, NULL, NULL),
(257, 'TRX-20211122102059', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 10:20:59', '4', NULL, NULL, NULL, NULL),
(258, 'TRX-20211122141407', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-11-22 14:14:07', '4', NULL, NULL, NULL, NULL),
(259, 'TRX-20211126092553', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-11-26 09:25:53', '4', NULL, NULL, NULL, NULL),
(260, 'TRX-20211202102438', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-02 10:24:38', '4', NULL, NULL, NULL, NULL),
(261, 'TRX-20211202104824', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-02 10:48:24', '4', NULL, NULL, NULL, NULL),
(262, 'TRX-20211202111226', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-02 11:12:26', '4', NULL, NULL, NULL, NULL),
(263, 'TRX-20211202111932', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-02 11:19:32', '4', NULL, NULL, NULL, NULL),
(264, 'TRX-20211202112930', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-02 11:29:30', '4', NULL, NULL, NULL, NULL),
(265, 'TRX-20211202114316', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-02 11:43:16', '4', NULL, NULL, NULL, NULL),
(266, 'TRX-20211202114345', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-02 11:43:45', '4', NULL, NULL, NULL, NULL),
(267, 'TRX-20211202131617', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-02 13:16:17', '4', NULL, NULL, NULL, NULL),
(268, 'TRX-20211206113125', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-06 11:31:25', '4', NULL, NULL, NULL, NULL),
(269, 'TRX-20211206131209', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-06 13:12:09', '4', NULL, NULL, NULL, NULL),
(270, 'TRX-20211206133211', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-06 13:32:11', '4', NULL, NULL, NULL, NULL),
(271, 'TRX-20211206133653', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-06 13:36:53', '4', NULL, NULL, NULL, NULL),
(272, 'TRX-20211206134340', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-06 13:43:40', '4', NULL, NULL, NULL, NULL),
(273, 'TRX-20211206135929', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-06 13:59:29', '4', NULL, NULL, NULL, NULL),
(274, 'TRX-20211206145052', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-06 14:50:52', '4', NULL, NULL, NULL, NULL),
(275, 'TRX-20211206150108', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-06 15:01:08', '4', NULL, NULL, NULL, NULL),
(276, 'TRX-20211207091759', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-07 09:17:59', '4', NULL, NULL, NULL, NULL),
(277, 'TRX-20211207092250', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-07 09:22:50', '4', NULL, NULL, NULL, NULL),
(278, 'TRX-20211207093544', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-07 09:35:44', '4', NULL, NULL, NULL, NULL),
(279, 'TRX-20211207094014', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-07 09:40:14', '4', NULL, NULL, NULL, NULL),
(280, 'TRX-20211210091246', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-10 09:12:46', '4', NULL, NULL, NULL, NULL),
(281, 'TRX-20211212221849', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-12 22:18:49', '4', NULL, NULL, NULL, NULL),
(282, 'TRX-20211216074206', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-16 07:42:06', '4', NULL, NULL, NULL, NULL),
(283, 'TRX-20211216074712', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-16 07:47:12', '4', NULL, NULL, NULL, NULL),
(284, 'TRX-20211216074744', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-16 07:47:44', '4', NULL, NULL, NULL, NULL),
(285, 'TRX-20211216074849', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-16 07:48:49', '4', NULL, NULL, NULL, NULL),
(286, 'TRX-20211216074906', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-16 07:49:06', '4', NULL, NULL, NULL, NULL),
(287, 'TRX-20211216075049', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-16 07:50:49', '4', NULL, NULL, NULL, NULL),
(288, 'TRX-20211222140849', 2, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-22 14:08:49', '4', NULL, NULL, NULL, NULL),
(305, 'TRX-20220120113520', 1, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-20 11:35:20', '4', NULL, NULL, NULL, NULL),
(304, 'TRX-20220112134155', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-12 13:41:55', '4', NULL, NULL, NULL, NULL),
(302, 'TRX-20220112133015', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-12 13:30:15', '4', NULL, NULL, NULL, NULL),
(303, 'TRX-20220112133616', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-12 13:36:16', '4', NULL, NULL, NULL, NULL),
(300, 'TRX-20220112132446', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-12 13:24:46', '4', NULL, NULL, NULL, NULL),
(293, 'TRX-20211231072419', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-31 07:24:19', '4', NULL, NULL, NULL, NULL),
(294, 'TRX-20211231072511', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-31 07:25:11', '4', NULL, NULL, NULL, NULL),
(295, 'TRX-20211231072736', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2021-12-31 07:27:36', '4', NULL, NULL, NULL, NULL),
(296, 'TRX-20211231072801', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-31 07:28:01', '4', NULL, NULL, NULL, NULL),
(297, 'TRX-20211231072814', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-31 07:28:14', '4', NULL, NULL, NULL, NULL),
(298, 'TRX-20211231072825', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2021-12-31 07:28:25', '4', NULL, NULL, NULL, NULL),
(301, 'TRX-20220112132936', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-12 13:29:36', '4', NULL, NULL, NULL, NULL),
(309, 'TRX-20220124101013', 1, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-24 10:10:13', '4', NULL, NULL, NULL, NULL),
(310, 'TRX-20220124144116', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-24 14:41:16', '4', NULL, NULL, NULL, NULL),
(311, 'TRX-20220124144920', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-24 14:49:20', '4', NULL, NULL, NULL, NULL),
(312, 'TRX-20220124145226', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-24 14:52:26', '4', NULL, NULL, NULL, NULL),
(313, 'TRX-20220124151436', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-24 15:14:36', '4', NULL, NULL, NULL, NULL),
(314, 'TRX-20220125092609', 1, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-25 09:26:09', '4', NULL, NULL, NULL, NULL),
(315, 'TRX-20220125092740', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-25 09:27:40', '4', NULL, NULL, NULL, NULL),
(316, 'TRX-20220125092842', 1, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-25 09:28:42', '4', NULL, NULL, NULL, NULL),
(317, 'TRX-20220126093457', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 09:34:57', '4', NULL, NULL, NULL, NULL),
(318, 'TRX-20220126094424', 8, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 09:44:24', '4', NULL, NULL, NULL, NULL),
(319, 'TRX-20220126094737', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 09:47:37', '4', NULL, NULL, NULL, NULL),
(320, 'TRX-20220126095428', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 09:54:28', '4', NULL, NULL, NULL, NULL),
(321, 'TRX-20220126100042', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:00:42', '4', NULL, NULL, NULL, NULL),
(322, 'TRX-20220126100811', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:08:11', '4', NULL, NULL, NULL, NULL),
(323, 'TRX-20220126100826', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:08:26', '4', NULL, NULL, NULL, NULL),
(324, 'TRX-20220126101202', 8, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:12:02', '4', NULL, NULL, NULL, NULL),
(325, 'TRX-20220126101417', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:14:17', '4', NULL, NULL, NULL, NULL),
(326, 'TRX-20220126101613', 8, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:16:13', '4', NULL, NULL, NULL, NULL),
(327, 'TRX-20220126102323', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:23:23', '4', NULL, NULL, NULL, NULL),
(328, 'TRX-20220126102342', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:23:42', '4', NULL, NULL, NULL, NULL),
(329, 'TRX-20220126102808', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:28:08', '4', NULL, NULL, NULL, NULL),
(330, 'TRX-20220126103042', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:30:42', '4', NULL, NULL, NULL, NULL),
(331, 'TRX-20220126103236', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:32:36', '4', NULL, NULL, NULL, NULL),
(332, 'TRX-20220126104355', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:43:55', '4', NULL, NULL, NULL, NULL),
(333, 'TRX-20220126104537', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:45:37', '4', NULL, NULL, NULL, NULL),
(334, 'TRX-20220126104555', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:45:55', '4', NULL, NULL, NULL, NULL),
(335, 'TRX-20220126104620', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:46:20', '4', NULL, NULL, NULL, NULL),
(336, 'TRX-20220126104643', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:46:43', '4', NULL, NULL, NULL, NULL),
(337, 'TRX-20220126104701', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:47:01', '4', NULL, NULL, NULL, NULL),
(338, 'TRX-20220126104823', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:48:23', '4', NULL, NULL, NULL, NULL),
(339, 'TRX-20220126104921', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:49:21', '4', NULL, NULL, NULL, NULL),
(340, 'TRX-20220126105004', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:50:04', '4', NULL, NULL, NULL, NULL),
(341, 'TRX-20220126105154', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:51:54', '4', NULL, NULL, NULL, NULL),
(342, 'TRX-20220126105211', 3, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:52:11', '4', NULL, NULL, NULL, NULL),
(343, 'TRX-20220126105230', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-01-26 10:52:30', '4', NULL, NULL, NULL, NULL),
(344, 'TRX-20220126105618', 3, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 10:56:18', '4', NULL, NULL, NULL, NULL),
(345, 'TRX-20220126111223', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 11:12:23', '4', NULL, NULL, NULL, NULL),
(346, 'TRX-20220126112040', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 11:20:40', '4', NULL, NULL, NULL, NULL),
(347, 'TRX-20220126112952', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 11:29:52', '4', NULL, NULL, NULL, NULL),
(348, 'TRX-20220126113506', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 11:35:06', '4', NULL, NULL, NULL, NULL),
(349, 'TRX-20220126125811', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 12:58:11', '4', NULL, NULL, NULL, NULL),
(350, 'TRX-20220126130616', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-01-26 13:06:16', '4', NULL, NULL, NULL, NULL),
(351, 'TRX-20220203113947', 6, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-03 11:39:47', '4', NULL, NULL, NULL, NULL),
(352, 'TRX-20220203121349', 6, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-03 12:13:49', '4', NULL, NULL, NULL, NULL),
(353, 'TRX-20220203123458', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-03 12:34:58', '4', NULL, NULL, NULL, NULL),
(354, 'TRX-20220203123646', 6, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-03 12:36:46', '4', NULL, NULL, NULL, NULL),
(355, 'TRX-20220204100346', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-04 10:03:46', '4', NULL, NULL, NULL, NULL),
(356, 'TRX-20220207073528', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-07 07:35:28', '4', NULL, NULL, NULL, NULL),
(357, 'TRX-20220207073732', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-07 07:37:32', '4', NULL, NULL, NULL, NULL),
(358, 'TRX-20220207073916', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-07 07:39:16', '4', NULL, NULL, NULL, NULL),
(359, 'TRX-20220207074039', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-07 07:40:39', '4', NULL, NULL, NULL, NULL),
(360, 'TRX-20220207092039', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-07 09:20:39', '4', NULL, NULL, NULL, NULL),
(361, 'TRX-20220207092128', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-07 09:21:28', '4', NULL, NULL, NULL, NULL),
(362, 'TRX-20220207092341', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-07 09:23:41', '4', NULL, NULL, NULL, NULL),
(363, 'TRX-20220207092423', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-07 09:24:23', '4', NULL, NULL, NULL, NULL),
(364, 'TRX-20220207092437', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-07 09:24:37', '4', NULL, NULL, NULL, NULL),
(365, 'TRX-20220208074901', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-08 07:49:01', '4', NULL, NULL, NULL, NULL),
(366, 'TRX-20220208075003', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-08 07:50:03', '4', NULL, NULL, NULL, NULL),
(367, 'TRX-20220208075045', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-08 07:50:45', '4', NULL, NULL, NULL, NULL),
(368, 'TRX104.20220208134841', 104, 9, 'konsumen', 'reseller', NULL, 'jnt', 'J&T Express', 'EZ', 9000, '13|36|505|asd', '2022-02-08 13:48:41', '0', NULL, 0, '', NULL),
(369, 'TRX-20220210103511', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-10 10:35:11', '4', NULL, NULL, NULL, NULL),
(370, 'TRX-20220210110337', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-10 11:03:37', '4', NULL, NULL, NULL, NULL),
(371, 'TRX-20220214110338', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-14 11:03:38', '4', NULL, NULL, NULL, NULL),
(372, 'TRX-20220214110354', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-14 11:03:54', '4', NULL, NULL, NULL, NULL),
(373, 'TRX-20220214110429', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-14 11:04:29', '4', NULL, NULL, NULL, NULL),
(374, 'TRX-20220214110507', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-14 11:05:07', '4', NULL, NULL, NULL, NULL),
(375, 'TRX-20220214111500', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-14 11:15:00', '4', NULL, NULL, NULL, NULL),
(376, 'TRX-20220221095933', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-21 09:59:33', '4', NULL, NULL, NULL, NULL),
(377, 'TRX-20220221100200', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-21 10:02:00', '4', NULL, NULL, NULL, NULL),
(378, 'TRX-20220221100415', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-21 10:04:15', '4', NULL, NULL, NULL, NULL),
(379, 'TRX-20220221101951', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-21 10:19:51', '4', NULL, NULL, NULL, NULL),
(380, 'TRX-20220221102017', 61, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-21 10:20:17', '4', NULL, NULL, NULL, NULL),
(381, 'TRX-20220221102149', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-21 10:21:49', '4', NULL, NULL, NULL, NULL),
(382, 'TRX-20220221102258', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-21 10:22:58', '4', NULL, NULL, NULL, NULL),
(383, 'TRX-20220221102407', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-21 10:24:07', '4', NULL, NULL, NULL, NULL),
(384, 'TRX-20220221102541', 61, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-21 10:25:41', '4', NULL, NULL, NULL, NULL),
(385, 'TRX-20220222100057', 9, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-22 10:00:57', '4', NULL, NULL, NULL, NULL),
(386, 'TRX-20220224081534', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-24 08:15:34', '4', NULL, NULL, NULL, NULL),
(387, 'TRX-20220224115038', 62, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-24 11:50:38', '4', NULL, NULL, NULL, NULL),
(388, 'TRX-20220224123613', 62, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-24 12:36:13', '4', NULL, NULL, NULL, NULL),
(389, 'TRX-20220224132834', 62, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-24 13:28:34', '4', NULL, NULL, NULL, NULL),
(390, 'TRX-20220225110127', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-02-25 11:01:27', '4', NULL, NULL, NULL, NULL),
(391, 'TRX-20220225112109', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-25 11:21:09', '4', NULL, NULL, NULL, NULL),
(392, 'TRX-20220225112206', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-25 11:22:06', '4', NULL, NULL, NULL, NULL),
(393, 'TRX-20220225130612', 62, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-02-25 13:06:12', '4', NULL, NULL, NULL, NULL),
(394, 'TRX-20220303111512', 62, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-03-03 11:15:12', '4', NULL, NULL, NULL, NULL),
(395, 'TRX-20220307111555', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-03-07 11:15:55', '4', NULL, NULL, NULL, NULL),
(396, 'TRX-20220307111628', 9, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-03-07 11:16:28', '4', NULL, NULL, NULL, NULL),
(397, 'TRX-20220406075730', 5, 1, 'reseller', 'admin', NULL, NULL, '', 'Stok Otomatis (Pribadi)', 0, NULL, '2022-04-06 07:57:30', '4', NULL, NULL, NULL, NULL),
(398, 'TRX-20220406082600', 5, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-04-06 08:26:00', '4', NULL, NULL, NULL, NULL),
(399, 'TRX-20220415055941', 8, 1, 'reseller', 'admin', '-', '-', '-', 'Stok Otomatis (Pribadi)', 0, '-', '2022-04-15 05:59:41', '4', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rb_penjualan_detail`
--

CREATE TABLE `rb_penjualan_detail` (
  `id_penjualan_detail` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `fee_produk_end` int(11) NOT NULL DEFAULT '0',
  `preorder` int(11) DEFAULT NULL,
  `satuan` varchar(50) NOT NULL,
  `keterangan_order` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_penjualan_detail`
--

INSERT INTO `rb_penjualan_detail` (`id_penjualan_detail`, `id_penjualan`, `id_produk`, `jumlah`, `diskon`, `harga_jual`, `fee_produk_end`, `preorder`, `satuan`, `keterangan_order`) VALUES
(200, 198, 104, 10, 0, 0, 0, NULL, 'lbr', '-'),
(199, 197, 105, 10, 0, 0, 0, NULL, 'lbr', '-'),
(361, 359, 208, 50, 0, 0, 0, NULL, '', NULL),
(359, 357, 206, 50, 0, 0, 0, NULL, '', NULL),
(368, 366, 212, 10, 0, 0, 0, NULL, 'btl', '-'),
(366, 364, 211, 10, 0, 0, 0, NULL, 'btl', '-'),
(363, 361, 210, 5, 0, 0, 0, NULL, 'btl', NULL),
(362, 360, 209, 5, 0, 0, 0, NULL, 'btl', NULL),
(360, 358, 207, 50, 0, 0, 0, NULL, '', NULL),
(358, 356, 205, 50, 0, 0, 0, NULL, '', NULL),
(356, 354, 204, 10, 0, 0, 0, NULL, '', '-'),
(283, 281, 85, 100, 0, 0, 0, NULL, 'polybag', '-'),
(242, 240, 86, 100, 0, 0, 0, NULL, 'lbr', '-'),
(240, 238, 88, 100, 0, 0, 0, NULL, 'lbr', '-'),
(239, 237, 89, 100, 0, 0, 0, NULL, 'lbr', '-'),
(238, 236, 90, 100, 0, 0, 0, NULL, '', '-'),
(378, 376, 214, 10, 0, 0, 0, NULL, '', NULL),
(339, 337, 184, 100, 0, 0, 0, NULL, '', '-'),
(340, 338, 182, 100, 0, 0, 0, NULL, '', '-'),
(342, 340, 191, 500, 0, 0, 0, NULL, 'lembar', NULL),
(377, 375, 185, 1, 0, 0, 0, NULL, 'botol', '-'),
(173, 171, 61, 10, 0, 0, 0, NULL, 'lbr', '-'),
(321, 319, 179, 100, 0, 0, 0, NULL, 'ML', NULL),
(170, 168, 64, 10, 0, 0, 0, NULL, 'lbr', '-'),
(171, 169, 63, 10, 0, 0, 0, NULL, 'lbr', '-'),
(172, 170, 62, 10, 0, 0, 0, NULL, 'lbr', '-'),
(168, 166, 66, 10, 0, 0, 0, NULL, 'lbr', '-'),
(169, 167, 65, 10, 0, 0, 0, NULL, 'lbr', '-'),
(166, 164, 68, 10, 0, 0, 0, NULL, 'lbr', '-'),
(167, 165, 67, 10, 0, 0, 0, NULL, 'lbr', '-'),
(164, 162, 70, 10, 0, 0, 0, NULL, 'lbr', '-'),
(165, 163, 69, 10, 0, 0, 0, NULL, 'lbr', '-'),
(163, 161, 71, 10, 0, 0, 0, NULL, 'lbr', '-'),
(161, 159, 73, 10, 0, 0, 0, NULL, 'lbr', '-'),
(162, 160, 72, 10, 0, 0, 0, NULL, 'lbr', '-'),
(160, 158, 74, 10, 0, 0, 0, NULL, 'lbr', '-'),
(158, 156, 76, 10, 0, 0, 0, NULL, 'lbr', '-'),
(159, 157, 75, 10, 0, 0, 0, NULL, 'lbr', '-'),
(157, 155, 77, 10, 0, 0, 0, NULL, 'lbr', '-'),
(156, 154, 56, 10, 0, 0, 0, NULL, 'lbr', '-'),
(155, 153, 57, 10, 0, 0, 0, NULL, 'lbr', '-'),
(154, 152, 58, 10, 0, 0, 0, NULL, 'lbr', '-'),
(153, 151, 59, 10, 0, 0, 0, NULL, 'lbr', '-'),
(152, 150, 60, 10, 0, 0, 0, NULL, 'lbr', '-'),
(151, 149, 52, 10, 0, 0, 0, NULL, 'lbr', '-'),
(149, 147, 54, 10, 0, 0, 0, NULL, 'lbr', '-'),
(150, 148, 53, 10, 0, 0, 0, NULL, 'lbr', '-'),
(357, 355, 198, 4, 0, 0, 0, NULL, '', '-'),
(146, 144, 47, 10, 0, 0, 0, NULL, 'gr', '-'),
(145, 143, 48, 10, 0, 0, 0, NULL, 'gr', '-'),
(143, 141, 41, 10, 0, 0, 0, NULL, 'ml', '-'),
(144, 142, 40, 10, 0, 0, 0, NULL, 'ml', '-'),
(142, 140, 42, 10, 0, 0, 0, NULL, 'ml', '-'),
(317, 315, 176, 10, 0, 0, 0, NULL, 'gram/pcs', '-'),
(243, 241, 44, 20, 0, 0, 0, NULL, 'pcs', '-'),
(261, 259, 45, 1, 0, 0, 0, NULL, 'btl', '-'),
(401, 399, 183, 40, 0, 0, 0, NULL, 'botol', '-'),
(350, 348, 197, 100, 0, 0, 0, NULL, '', NULL),
(352, 350, 199, 30, 0, 0, 0, NULL, '', NULL),
(148, 146, 55, 10, 0, 0, 0, NULL, 'lbr', '-'),
(336, 334, 188, 100, 0, 0, 0, NULL, '', '-'),
(347, 345, 194, 100, 0, 0, 0, NULL, '', NULL),
(349, 347, 196, 100, 0, 0, 0, NULL, '', NULL),
(335, 333, 189, 100, 0, 0, 0, NULL, '', '-'),
(345, 343, 173, 100, 0, 0, 0, NULL, 'ML', '-'),
(125, 123, 38, 10, 0, 0, 0, NULL, 'Kg', '-'),
(369, 367, 213, 10, 0, 0, 0, NULL, 'btl', NULL),
(122, 120, 20, 10, 0, 0, 0, NULL, 'ml', '-'),
(123, 121, 19, 10, 0, 0, 0, NULL, 'ml', '-'),
(124, 122, 18, 10, 0, 0, 0, NULL, 'gr', '-'),
(121, 119, 21, 10, 0, 0, 0, NULL, 'gr', '-'),
(120, 118, 22, 10, 0, 0, 0, NULL, 'gr', '-'),
(119, 117, 23, 10, 0, 0, 0, NULL, 'gr', '-'),
(118, 116, 24, 10, 0, 0, 0, NULL, 'gr', '-'),
(117, 115, 25, 10, 0, 0, 0, NULL, 'gr', '-'),
(116, 114, 12, 10, 0, 0, 0, NULL, 'gr', '-'),
(115, 113, 13, 10, 0, 0, 0, NULL, 'gr', '-'),
(114, 112, 14, 10, 0, 0, 0, NULL, 'gr', '-'),
(113, 111, 15, 10, 0, 0, 0, NULL, 'gr', '-'),
(112, 110, 16, 10, 0, 0, 0, NULL, 'ml', '-'),
(111, 109, 17, 10, 0, 0, 0, NULL, 'ml', '-'),
(110, 108, 1, 10, 0, 0, 0, NULL, 'gr', '-'),
(109, 107, 2, 10, 0, 0, 0, NULL, 'gr', '-'),
(108, 106, 3, 10, 0, 0, 0, NULL, 'gr', '-'),
(107, 105, 4, 10, 0, 0, 0, NULL, 'gr', '-'),
(106, 104, 5, 10, 0, 0, 0, NULL, 'gr', '-'),
(105, 103, 6, 10, 0, 0, 0, NULL, 'gr', '-'),
(104, 102, 7, 10, 0, 0, 0, NULL, 'gr', '-'),
(103, 101, 8, 10, 0, 0, 0, NULL, 'gr', '-'),
(102, 100, 9, 10, 0, 0, 0, NULL, 'gr', '-'),
(101, 99, 10, 10, 0, 0, 0, NULL, 'gr', '-'),
(100, 98, 49, 10, 0, 0, 0, NULL, 'gr', '-'),
(99, 97, 50, 10, 0, 0, 0, NULL, 'gr', '-'),
(98, 96, 11, 10, 0, 0, 0, NULL, 'gr', '-'),
(337, 335, 187, 100, 0, 0, 0, NULL, '', '-'),
(96, 94, 39, 10, 0, 0, 0, NULL, 'Kg', '-'),
(201, 199, 103, 10, 0, 0, 0, NULL, 'lbr', '-'),
(202, 200, 102, 10, 0, 0, 0, NULL, 'lbr', '-'),
(203, 201, 101, 10, 0, 0, 0, NULL, 'lbr', '-'),
(204, 202, 100, 10, 0, 0, 0, NULL, 'lbr', '-'),
(348, 346, 195, 100, 0, 0, 0, NULL, '', NULL),
(334, 332, 190, 10, 0, 0, 0, NULL, '', NULL),
(346, 344, 193, 2, 0, 0, 0, NULL, 'buah', NULL),
(209, 207, 106, 10, 0, 0, 0, NULL, 'lbr', '-'),
(276, 274, 123, 500, 0, 0, 0, NULL, 'lembar', '-'),
(277, 275, 122, 500, 0, 0, 0, NULL, 'lembar', '-'),
(278, 276, 121, 500, 0, 0, 0, NULL, 'lembar', '-'),
(279, 277, 120, 500, 0, 0, 0, NULL, 'lembar', '-'),
(272, 270, 119, 500, 0, 0, 0, NULL, 'lembar', '-'),
(280, 278, 118, 500, 0, 0, 0, NULL, 'lembar', '-'),
(281, 279, 116, 500, 0, 0, 0, NULL, 'lembar', '-'),
(273, 271, 115, 500, 0, 0, 0, NULL, 'lembar', '-'),
(284, 282, 156, 100, 0, 0, 0, NULL, 'pcs', NULL),
(282, 280, 155, 100, 0, 0, 0, NULL, 'lbr', NULL),
(224, 222, 128, 10, 0, 0, 0, NULL, 'Batang', NULL),
(225, 223, 129, 10, 0, 0, 0, NULL, 'lbr', NULL),
(310, 308, 170, 10, 0, 0, 0, NULL, 'Gram', NULL),
(309, 307, 169, 10, 0, 0, 0, NULL, 'Gram', '-'),
(228, 226, 130, 10, 0, 0, 0, NULL, 'Gram', NULL),
(229, 227, 131, 100, 0, 0, 0, NULL, 'Lembar', NULL),
(308, 306, 169, 1, 0, 0, 0, NULL, '', NULL),
(322, 320, 180, 100, 0, 0, 0, NULL, 'ML', NULL),
(241, 239, 87, 100, 0, 0, 0, NULL, 'lbr', '-'),
(307, 305, 168, 10, 0, 0, 0, NULL, 'Gram', NULL),
(237, 235, 134, 100, 0, 0, 0, NULL, '', '-'),
(244, 242, 135, 10, 0, 0, 0, NULL, 'pcs', NULL),
(246, 244, 136, 50, 0, 0, 0, NULL, 'pcs', '-'),
(247, 245, 137, 5, 0, 0, 0, NULL, 'pcs', NULL),
(249, 247, 138, 30, 0, 0, 0, NULL, 'pcs', '-'),
(251, 249, 139, 10, 0, 0, 0, NULL, 'btl', '-'),
(252, 250, 140, 15, 0, 0, 0, NULL, 'btl', NULL),
(253, 251, 141, 15, 0, 0, 0, NULL, '', NULL),
(254, 252, 142, 25, 0, 0, 0, NULL, 'pcs', NULL),
(255, 253, 143, 30, 0, 0, 0, NULL, 'pcs', NULL),
(316, 314, 176, 10, 0, 0, 0, NULL, 'Gram', NULL),
(258, 256, 145, 20, 0, 0, 0, NULL, 'kg', '-'),
(259, 257, 146, 100, 0, 0, 0, NULL, 'lbr', NULL),
(260, 258, 147, 20, 0, 0, 0, NULL, 'kg', NULL),
(262, 260, 148, 10, 0, 0, 0, NULL, 'Botol', NULL),
(263, 261, 149, 10, 0, 0, 0, NULL, 'Jerigen', NULL),
(397, 395, 149, 40, 0, 0, 0, NULL, 'Jerigen', '-'),
(266, 264, 152, 10, 0, 0, 0, NULL, 'Botol', NULL),
(267, 265, 153, 30, 0, 0, 0, NULL, 'Botol', NULL),
(268, 266, 152, 20, 0, 0, 0, NULL, 'Botol', '-'),
(269, 267, 131, 400, 0, 0, 0, NULL, 'Lembar', '-'),
(270, 268, 154, 500, 0, 0, 0, NULL, 'lembar', NULL),
(271, 269, 117, 500, 0, 0, 0, NULL, 'lembar', '-'),
(285, 283, 157, 10, 0, 0, 0, NULL, 'btl', NULL),
(288, 286, 158, 10, 0, 0, 0, NULL, 'btl', '-'),
(289, 287, 159, 10, 0, 0, 0, NULL, '', '-'),
(290, 288, 160, 1, 0, 0, 0, NULL, '', NULL),
(306, 304, 167, 100, 0, 0, 0, NULL, 'Gram', NULL),
(305, 303, 166, 100, 0, 0, 0, NULL, 'Gram', NULL),
(302, 300, 164, 5, 0, 0, 0, NULL, '1', NULL),
(300, 298, 161, 10, 0, 0, 0, NULL, 'btl', '-'),
(298, 296, 162, 10, 0, 0, 0, NULL, 'btl', '-'),
(299, 297, 163, 10, 0, 0, 0, NULL, 'btl', '-'),
(304, 302, 165, 100, 0, 0, 0, NULL, 'Gram', '-'),
(311, 309, 171, 10, 0, 0, 0, NULL, 'Gram', NULL),
(312, 310, 172, 100, 0, 0, 0, NULL, 'ML', NULL),
(344, 342, 192, 2, 0, 0, 0, NULL, 'buah', NULL),
(343, 341, 174, 100, 0, 0, 0, NULL, '', '-'),
(315, 313, 175, 100, 0, 0, 0, NULL, 'ML', NULL),
(318, 316, 176, 10, 0, 0, 0, NULL, 'Pcs (1000 gram)', '-'),
(319, 317, 177, 3, 0, 0, 0, NULL, 'buah', NULL),
(341, 339, 181, 100, 0, 0, 0, NULL, '', '-'),
(338, 336, 186, 100, 0, 0, 0, NULL, '', '-'),
(370, 368, 153, 1, 0, 25000, 0, NULL, 'Botol', ''),
(379, 377, 215, 10, 0, 0, 0, NULL, '', NULL),
(380, 378, 216, 10, 0, 0, 0, NULL, '', NULL),
(381, 379, 217, 1, 0, 0, 0, NULL, '', NULL),
(382, 380, 217, 9, 0, 0, 0, NULL, '', '-'),
(383, 381, 218, 10, 0, 0, 0, NULL, '', NULL),
(384, 382, 219, 10, 0, 0, 0, NULL, '', NULL),
(385, 383, 220, 10, 0, 0, 0, NULL, '', NULL),
(386, 384, 221, 10, 0, 0, 0, NULL, '', NULL),
(387, 385, 222, 500, 0, 0, 0, NULL, 'lembar', NULL),
(388, 386, 223, 500, 0, 0, 0, NULL, 'polybag', NULL),
(392, 390, 144, 10, 0, 0, 0, NULL, 'pcs', '-'),
(391, 389, 224, 10, 0, 0, 0, NULL, '1', '-'),
(393, 391, 225, 10, 0, 0, 0, NULL, 'btl', NULL),
(394, 392, 226, 10, 0, 0, 0, NULL, 'jenis', NULL),
(395, 393, 227, 1, 0, 0, 0, NULL, '1', NULL),
(396, 394, 228, 1, 0, 0, 0, NULL, '1', NULL),
(398, 396, 148, 40, 0, 0, 0, NULL, 'Botol', '-'),
(399, 397, 229, 20, 0, 0, 0, NULL, 'pcs', NULL),
(400, 398, 226, 5, 0, 0, 0, NULL, 'jenis', '-');

-- --------------------------------------------------------

--
-- Table structure for table `rb_penjualan_kupon`
--

CREATE TABLE `rb_penjualan_kupon` (
  `id_penjualan_kupon` int(11) NOT NULL,
  `id_penjualan_detail` int(11) NOT NULL,
  `id_kupon` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nilai` int(11) NOT NULL,
  `waktu_pakai` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rb_penjualan_otomatis`
--

CREATE TABLE `rb_penjualan_otomatis` (
  `id_penjualan_otomatis` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `nominal` int(50) NOT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `catatan` text,
  `status_trx` varchar(255) DEFAULT NULL,
  `penampung` text,
  `waktu_proses` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_penjualan_otomatis`
--

INSERT INTO `rb_penjualan_otomatis` (`id_penjualan_otomatis`, `kode_transaksi`, `nominal`, `pembayaran`, `catatan`, `status_trx`, `penampung`, `waktu_proses`) VALUES
(1, 'TRX1.20210207143522', 20022, 1, NULL, NULL, NULL, '2021-02-07 14:35:22'),
(2, 'TRX55.20210207144948', 37038, 1, NULL, NULL, NULL, '2021-02-07 14:49:48'),
(3, 'TRX1.20210207214608', 32059, 1, NULL, NULL, NULL, '2021-02-07 21:46:08'),
(4, 'TRX1.20210209134920', 31566, NULL, NULL, NULL, NULL, '2021-02-09 13:49:20'),
(5, 'TRX1.20210209141222', 23273, NULL, NULL, NULL, NULL, '2021-02-09 14:12:22'),
(6, 'TRX1.20210209141638', 22487, NULL, NULL, NULL, NULL, '2021-02-09 14:16:39'),
(7, 'TRX1.20210209142854', 28598, NULL, NULL, NULL, NULL, '2021-02-09 14:28:54'),
(8, 'TRX1.20210209143608', 23956, 1, NULL, NULL, NULL, '2021-02-09 14:36:08'),
(9, 'TRX57.20210209204454', 32854, NULL, '3317AF86-7AC0-4B86-BB0E-9D590D547CF7', NULL, NULL, '2021-02-09 20:44:54'),
(10, 'TRX58.20210210082415', 43159, NULL, '8F25737C-E0A8-44C0-9354-624482160FB7', NULL, NULL, '2021-02-10 08:24:15'),
(11, 'TRX1.20210210103318', 16318, 1, NULL, NULL, NULL, '2021-02-10 10:33:18'),
(12, 'TRX60.20210210111301', 30301, NULL, '91ACA3E8-F824-467E-A190-6511CD3FB8CF', NULL, NULL, '2021-02-10 11:13:01'),
(13, 'TRX60.20210210112234', 30234, NULL, '10C16227-E9C8-4468-9E00-73BF170B3CD1', NULL, NULL, '2021-02-10 11:22:34'),
(14, 'TRX60.20210210113042', 29042, NULL, 'F0B75457-506B-45A6-AC71-F537F36268F2', NULL, NULL, '2021-02-10 11:30:42'),
(15, 'TRX60.20210210113049', 49, NULL, NULL, NULL, NULL, '2021-02-10 11:30:49'),
(16, 'TRX60.20210210113320', 34410, NULL, NULL, NULL, NULL, '2021-02-10 11:33:20'),
(17, 'TRX61.20210210113853', 28652, NULL, '0DB74789-42D9-4A6B-85A2-6D58FC87DE8C', NULL, NULL, '2021-02-10 11:38:53'),
(18, 'TRX62.20210210115339', 24138, NULL, '14541092-BDB6-42EE-A8FC-3DD8762C56F1', NULL, NULL, '2021-02-10 11:53:39'),
(19, 'TRX63.20210210124441', 12491, 1, NULL, NULL, NULL, '2021-02-10 12:44:41'),
(20, 'TRX66.20210210183717', 29207, NULL, '031735BA-27FA-4B40-8723-9CAE6905A44F', NULL, NULL, '2021-02-10 18:37:17'),
(21, 'TRX68.20210211085810', 69609, NULL, NULL, NULL, NULL, '2021-02-11 08:58:10'),
(22, 'TRX68.20210211085820', 820, NULL, NULL, NULL, NULL, '2021-02-11 08:58:20'),
(23, 'TRX1.20210212230056', 24306, 1, NULL, NULL, NULL, '2021-02-12 23:00:56'),
(24, 'TRX3.20210223114819', 19309, NULL, NULL, NULL, NULL, '2021-02-23 11:48:19'),
(25, 'TRX70.20210313182028', 35528, NULL, NULL, NULL, NULL, '2021-03-13 18:20:28'),
(26, 'TRX1.20210429112625', 28574, NULL, NULL, NULL, NULL, '2021-04-29 11:26:25'),
(27, 'TRX1.20210506120308', 9107, NULL, NULL, NULL, NULL, '2021-05-06 12:03:08'),
(28, 'TRX2.20210506135356', 10102, NULL, NULL, NULL, NULL, '2021-05-06 13:53:56'),
(29, 'TRX2.20210516171211', 92711, NULL, NULL, NULL, NULL, '2021-05-16 17:12:11'),
(30, 'TRX3.20210519152449', 96949, NULL, NULL, NULL, NULL, '2021-05-19 15:24:49'),
(31, 'TRX3.20210519153434', 95934, NULL, NULL, NULL, NULL, '2021-05-19 15:34:34'),
(32, 'TRX71.20210622162812', 9312, NULL, NULL, NULL, NULL, '2021-06-22 16:28:12'),
(33, 'TRX72.20210703094233', 26733, NULL, '6FB25337-BEC0-47C5-A0F6-DDF96CDBBA15', NULL, NULL, '2021-07-03 09:42:33'),
(34, 'TRX72.20210703101735', 27235, 1, '427D14E6-8E4C-447A-889E-16B931F0E5F5', NULL, NULL, '2021-07-03 10:17:35'),
(35, 'TRX72.20210703230528', 22028, NULL, NULL, NULL, NULL, '2021-07-03 23:05:28'),
(36, 'TRX72.20210703232536', 22036, NULL, NULL, NULL, NULL, '2021-07-03 23:25:36'),
(37, 'TRX72.20210703235226', 11726, NULL, NULL, NULL, NULL, '2021-07-03 23:52:26'),
(38, 'TRX72.20210704000516', 12016, NULL, NULL, NULL, NULL, '2021-07-04 00:05:16'),
(39, 'TRX72.20210704002006', 11506, NULL, NULL, NULL, NULL, '2021-07-04 00:20:06'),
(40, 'TRX72.20210704003253', 11753, NULL, NULL, NULL, NULL, '2021-07-04 00:32:53'),
(41, 'TRX72.20210704003521', 12021, NULL, NULL, NULL, NULL, '2021-07-04 00:35:21'),
(42, 'TRX72.20210704011908', 20908, NULL, NULL, NULL, NULL, '2021-07-04 01:19:08'),
(43, 'TRX72.20210705095731', 25731, 1, NULL, NULL, NULL, '2021-07-05 09:57:31'),
(44, 'TRX72.20210705212703', 10703, NULL, NULL, NULL, NULL, '2021-07-05 21:27:03'),
(45, 'TRX72.20210705231936', 10936, NULL, NULL, NULL, NULL, '2021-07-05 23:19:36'),
(46, 'TRX72.20210705234338', 10000, NULL, NULL, NULL, NULL, '2021-07-05 23:43:38'),
(47, 'TRX72.20210706191453', 10000, NULL, NULL, NULL, NULL, '2021-07-06 19:14:53'),
(48, 'TRX72.20210706192440', 10983, NULL, NULL, NULL, NULL, '2021-07-06 19:24:40'),
(49, 'TRX72.20210706193653', 10000, NULL, NULL, NULL, NULL, '2021-07-06 19:36:53'),
(50, 'TRX72.20210706213733', 10575, NULL, NULL, NULL, NULL, '2021-07-06 21:37:33'),
(51, 'TIKET72.20210706222627', 10000, NULL, NULL, NULL, NULL, '2021-07-06 22:26:27'),
(52, 'TRX72.20210715052758', 64333, NULL, NULL, NULL, NULL, '2021-07-15 05:27:58'),
(53, 'TRX9.20210921091902', 52902, NULL, 'B3FD0724-64B8-4667-B4AF-B79FD593FA98', NULL, NULL, '2021-09-21 09:19:02'),
(54, 'TIKET79.20211027095924', 100, NULL, NULL, NULL, NULL, '2021-10-27 09:59:24'),
(55, 'TIKET79.20211027095936', 0, NULL, NULL, NULL, NULL, '2021-10-27 09:59:36'),
(56, 'TIKET79.20211027100144', 100, NULL, NULL, NULL, NULL, '2021-10-27 10:01:44'),
(57, 'TIKET79.20211027104346', 20000, NULL, NULL, NULL, NULL, '2021-10-27 10:43:46'),
(58, 'TIKET77.20211027192250', 100, NULL, NULL, NULL, NULL, '2021-10-27 19:22:50'),
(59, 'TRX85.20211230140955', 932955, NULL, NULL, NULL, NULL, '2021-12-30 14:09:55'),
(60, 'TIKET85.20211230141757', 40000, NULL, NULL, NULL, NULL, '2021-12-30 14:17:57'),
(61, 'TRX86.20211230143129', 107129, NULL, NULL, NULL, NULL, '2021-12-30 14:31:29'),
(62, 'TRX87.20211230144220', 137220, NULL, NULL, NULL, NULL, '2021-12-30 14:42:20'),
(63, 'TIKET77.20220104193057', 0, NULL, NULL, NULL, NULL, '2022-01-04 19:30:57'),
(64, 'TRX104.20220208134841', 34841, NULL, NULL, NULL, NULL, '2022-02-08 13:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `rb_penjualan_temp`
--

CREATE TABLE `rb_penjualan_temp` (
  `id_penjualan_detail` int(11) NOT NULL,
  `session` varchar(50) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `id_kupon` int(11) DEFAULT NULL,
  `keterangan_order` text,
  `waktu_order` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_penjualan_temp`
--

INSERT INTO `rb_penjualan_temp` (`id_penjualan_detail`, `session`, `id_produk`, `jumlah`, `diskon`, `harga_jual`, `satuan`, `id_kupon`, `keterangan_order`, `waktu_order`) VALUES
(161, '20210923114118', 123, 1, 0, 100, 'lbr', NULL, '', '2021-09-23 11:41:18'),
(166, '21', 123, 1, 0, 100, 'lbr', NULL, '', '2021-09-28 05:57:13'),
(236, '20211027192829', 118, 1, 0, 100, 'lbr', NULL, '', '2021-10-27 19:28:29'),
(209, '20211027091422', 51, 1, 0, 20000, 'pcs', NULL, '', '2021-10-27 09:14:22'),
(210, '20211027091422', 111, 1, 0, 100, 'lbr', NULL, '', '2021-10-27 09:19:00'),
(211, '20211027091422', 117, 1, 0, 100, 'lbr', NULL, '', '2021-10-27 09:20:02'),
(212, '20211027092043', 121, 1, 0, 100, 'lbr', NULL, 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk||', '2021-10-27 09:20:43'),
(265, '20220126105155', 151, 2, 0, 15000, 'Bungkus', NULL, '', '2022-01-26 10:59:47'),
(218, '79', 131, 1, 0, 10000, 'Lembar', NULL, '', '2021-10-27 10:49:41'),
(227, '20211027164940', 118, 1, 0, 100, 'lbr', NULL, '', '2021-10-27 16:49:40'),
(228, '20211027164940', 131, 1, 0, 10000, 'Lembar', NULL, '', '2021-10-27 16:51:39'),
(237, '20211027212937', 118, 1, 0, 100, 'lbr', NULL, '', '2021-10-27 21:29:37'),
(238, '20211104195630', 42, 1, 0, 85000, 'btl', NULL, '', '2021-11-04 19:56:30'),
(239, '20211104195630', 134, 1, 0, 5000, '', NULL, '', '2021-11-04 20:01:15'),
(240, '20211104195630', 106, 1, 0, 100, 'lbr', NULL, '', '2021-11-04 20:02:10'),
(241, '20211104195630', 130, 1, 0, 5000, 'lbr', NULL, '', '2021-11-04 20:02:47'),
(242, '20211206114032', 154, 1, 0, 10000, 'lembar', NULL, '', '2021-12-06 11:40:32'),
(244, '20211222153258', 145, 1, 0, 10000, 'pcs', NULL, '', '2021-12-22 15:32:58'),
(267, '20220130144105', 183, 1, 0, 40000, 'botol', NULL, '', '2022-01-30 14:41:05'),
(252, '85', 28, 1, 0, 100000, 'btl', NULL, '', '2021-12-30 14:21:09'),
(255, '20211230144803', 30, 1, 0, 65000, 'btl', NULL, '', '2021-12-30 14:48:03'),
(257, '20220104142434', 152, 1, 0, 20000, 'Botol', NULL, '', '2022-01-04 14:25:18'),
(262, '20220121113107', 155, 1, 0, 95000, 'lbr', NULL, '', '2022-01-21 11:31:07'),
(261, '20220109204114', 153, 1, 0, 25000, 'Botol', NULL, '', '2022-01-09 20:48:32'),
(268, '20220204080918', 49, 1, 0, 15000, 'pcs', NULL, 'Uyy bejual kah||', '2022-02-04 08:09:18'),
(269, '20220204091425', 191, 1, 0, 10000, 'lembar', NULL, '', '2022-02-04 09:14:25'),
(272, '92', 38, 1, 0, 36000, 'pcs', NULL, '', '2022-02-04 09:46:50'),
(276, '20220204123601', 195, 2, 0, 25000, '', NULL, '', '2022-02-04 12:36:01'),
(277, '20220204143857', 184, 1, 0, 80000, '', NULL, '', '2022-02-04 14:38:57'),
(278, '20220204150214', 188, 1, 0, 10000, '', NULL, '', '2022-02-04 15:02:14'),
(279, '103', 211, 1, 0, 250000, 'btl', NULL, '', '2022-02-07 15:01:23'),
(280, '20220208092753', 178, 1, 0, 20000, '', NULL, '', '2022-02-08 09:27:53'),
(281, '20220208094236', 129, 1, 0, 123, 'lbr', NULL, '', '2022-02-08 09:42:36'),
(282, '20220208132412', 130, 1, 0, 0, 'lbr', NULL, '', '2022-02-08 13:24:12'),
(284, '20220208161730', 135, 1, 0, 45000, 'pcs', NULL, '', '2022-02-08 16:17:30'),
(285, '20220208173543', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-02-08 17:35:43'),
(286, '20220208185300', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-08 18:53:00'),
(287, '20220209014416', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-02-09 01:44:16'),
(288, '20220209034723', 194, 1, 0, 15000, '', NULL, '', '2022-02-09 03:47:23'),
(289, '20220209124446', 55, 1, 0, 0, 'lbr', NULL, '', '2022-02-09 12:44:46'),
(290, '20220209142639', 193, 1, 0, 35000, 'buah', NULL, '', '2022-02-09 14:26:39'),
(295, '20220209190914', 140, 1, 0, 60000, 'btl', NULL, '', '2022-02-09 19:09:14'),
(294, '20220209151308', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-09 15:13:08'),
(296, '20220210021147', 199, 1, 0, 15000, '', NULL, '', '2022-02-10 02:11:47'),
(297, '20220210032529', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-02-10 03:25:29'),
(298, '20220210060359', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-02-10 06:03:59'),
(299, '20220210060902', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-02-10 06:09:02'),
(300, '20220210124243', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-02-10 12:42:43'),
(301, '20220210125155', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-02-10 12:51:55'),
(302, '20220210132625', 178, 1, 0, 20000, '', NULL, '', '2022-02-10 13:26:25'),
(303, '20220210165418', 188, 1, 0, 10000, '', NULL, '', '2022-02-10 16:54:18'),
(304, '20220210172109', 130, 1, 0, 0, 'lbr', NULL, '', '2022-02-10 17:21:09'),
(305, '20220210184727', 11, 1, 0, 25000, 'pcs', NULL, '', '2022-02-10 18:47:27'),
(306, '20220210185223', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-02-10 18:52:23'),
(307, '20220210200225', 135, 1, 0, 45000, 'pcs', NULL, '', '2022-02-10 20:02:25'),
(308, '20220210211228', 23, 1, 0, 20000, 'pcs', NULL, '', '2022-02-10 21:12:28'),
(309, '20220210224029', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-10 22:40:29'),
(310, '20220211011611', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-02-11 01:16:11'),
(311, '20220211011639', 128, 1, 0, 123, 'Batang', NULL, '', '2022-02-11 01:16:39'),
(312, '20220211063753', 194, 1, 0, 15000, '', NULL, '', '2022-02-11 06:37:53'),
(313, '20220211114110', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-02-11 11:41:10'),
(314, '20220211150626', 212, 1, 0, 85000, 'btl', NULL, '', '2022-02-11 15:06:26'),
(315, '20220211155434', 55, 1, 0, 0, 'lbr', NULL, '', '2022-02-11 15:54:34'),
(316, '20220211164501', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-02-11 16:45:01'),
(317, '20220211180942', 193, 1, 0, 35000, 'buah', NULL, '', '2022-02-11 18:09:42'),
(318, '20220211192023', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-11 19:20:23'),
(319, '20220211225649', 140, 1, 0, 60000, 'btl', NULL, '', '2022-02-11 22:56:49'),
(320, '20220211232401', 206, 1, 0, 100000, '', NULL, '', '2022-02-11 23:24:01'),
(321, '20220212013855', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-02-12 01:38:55'),
(322, '20220212043659', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-02-12 04:36:59'),
(323, '20220212055310', 190, 1, 0, 150000, '', NULL, '', '2022-02-12 05:53:10'),
(324, '20220212105631', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-02-12 10:56:31'),
(325, '20220212115435', 151, 1, 0, 15000, 'Bungkus', NULL, '', '2022-02-12 11:54:35'),
(326, '20220212123750', 177, 1, 0, 500000, 'buah', NULL, '', '2022-02-12 12:37:50'),
(327, '20220212132134', 22, 1, 0, 10000, 'pcs', NULL, '', '2022-02-12 13:21:34'),
(328, '20220212172710', 130, 1, 0, 0, 'lbr', NULL, '', '2022-02-12 17:27:10'),
(329, '20220212173834', 137, 1, 0, 170000, 'btl', NULL, '', '2022-02-12 17:38:34'),
(330, '20220212193025', 187, 1, 0, 8000, '', NULL, '', '2022-02-12 19:30:25'),
(331, '20220212200909', 55, 1, 0, 0, 'lbr', NULL, '', '2022-02-12 20:09:09'),
(332, '20220212202207', 155, 1, 0, 90000, 'lbr', NULL, '', '2022-02-12 20:22:07'),
(333, '20220212221510', 207, 1, 0, 150000, '', NULL, '', '2022-02-12 22:15:10'),
(334, '20220212233425', 211, 1, 0, 250000, 'btl', NULL, '', '2022-02-12 23:34:25'),
(335, '20220213010742', 55, 1, 0, 0, 'lbr', NULL, '', '2022-02-13 01:07:42'),
(336, '20220213012250', 23, 1, 0, 20000, 'pcs', NULL, '', '2022-02-13 01:22:50'),
(337, '20220213015035', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-02-13 01:50:35'),
(338, '20220213030335', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-02-13 03:03:35'),
(339, '20220213034454', 128, 1, 0, 123, 'Batang', NULL, '', '2022-02-13 03:44:54'),
(340, '20220213034847', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-02-13 03:48:47'),
(341, '20220213043831', 117, 1, 0, 5000, 'lembar', NULL, '', '2022-02-13 04:38:31'),
(342, '20220213050618', 128, 1, 0, 123, 'Batang', NULL, '', '2022-02-13 05:06:18'),
(343, '20220213051546', 210, 1, 0, 60000, 'btl', NULL, '', '2022-02-13 05:15:46'),
(344, '20220213065726', 130, 1, 0, 0, 'lbr', NULL, '', '2022-02-13 06:57:26'),
(345, '20220213075816', 171, 1, 0, 35000, 'Pcs (80 gram)', NULL, '', '2022-02-13 07:58:16'),
(346, '20220213080512', 41, 1, 0, 60000, 'btl', NULL, '', '2022-02-13 08:05:12'),
(347, '20220213085033', 213, 1, 0, 130000, 'btl', NULL, '', '2022-02-13 08:50:33'),
(348, '20220213093645', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-02-13 09:36:45'),
(349, '20220213113941', 115, 1, 0, 10000, 'lembar', NULL, '', '2022-02-13 11:39:41'),
(350, '20220213114448', 72, 1, 0, 100, 'lbr', NULL, '', '2022-02-13 11:44:48'),
(351, '20220213133533', 207, 1, 0, 150000, '', NULL, '', '2022-02-13 13:35:33'),
(352, '20220213133543', 100, 1, 0, 100, 'lbr', NULL, '', '2022-02-13 13:35:43'),
(353, '20220213164842', 205, 1, 0, 90000, '', NULL, '', '2022-02-13 16:48:42'),
(354, '20220213172156', 197, 1, 0, 15000, '', NULL, '', '2022-02-13 17:21:56'),
(355, '20220213173926', 167, 1, 0, 17500, '', NULL, '', '2022-02-13 17:39:26'),
(356, '20220213203243', 136, 1, 0, 30000, 'pcs', NULL, '', '2022-02-13 20:32:43'),
(357, '20220213203835', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-02-13 20:38:35'),
(358, '20220213211423', 129, 1, 0, 123, 'lbr', NULL, '', '2022-02-13 21:14:23'),
(359, '20220213215550', 205, 1, 0, 90000, '', NULL, '', '2022-02-13 21:55:50'),
(360, '20220214003326', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-14 00:33:26'),
(361, '20220214004650', 213, 1, 0, 130000, 'btl', NULL, '', '2022-02-14 00:46:50'),
(362, '20220214011024', 209, 1, 0, 35000, 'btl', NULL, '', '2022-02-14 01:10:24'),
(363, '20220214011226', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-02-14 01:12:26'),
(364, '20220214013108', 12, 1, 0, 5000, 'pcs', NULL, 'beli||', '2022-02-14 01:31:08'),
(365, '20220214022038', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-02-14 02:20:38'),
(366, '20220214022956', 191, 1, 0, 10000, 'lembar', NULL, '', '2022-02-14 02:29:56'),
(367, '20220214024440', 204, 1, 0, 8000, '', NULL, '', '2022-02-14 02:44:40'),
(368, '20220214053500', 193, 1, 0, 35000, 'buah', NULL, '', '2022-02-14 05:35:00'),
(369, '20220214055020', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-02-14 05:50:20'),
(370, '20220214065740', 152, 1, 0, 20000, 'Botol', NULL, '', '2022-02-14 06:57:40'),
(371, '20220214071013', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-02-14 07:10:13'),
(372, '20220214090608', 145, 1, 0, 10000, 'pcs', NULL, '', '2022-02-14 09:06:08'),
(373, '20220214101349', 209, 1, 0, 35000, 'btl', NULL, '', '2022-02-14 10:13:49'),
(374, '20220214111313', 194, 1, 0, 15000, '', NULL, '', '2022-02-14 11:13:13'),
(375, '20220214144836', 211, 1, 0, 250000, 'btl', NULL, '', '2022-02-14 14:48:36'),
(376, '20220214144913', 212, 1, 0, 85000, 'btl', NULL, '', '2022-02-14 14:49:13'),
(377, '20220214153852', 47, 1, 0, 12000, 'pcs', NULL, '', '2022-02-14 15:38:52'),
(378, '20220214161431', 76, 1, 0, 100, 'lbr', NULL, '', '2022-02-14 16:14:31'),
(379, '20220214164507', 130, 1, 0, 0, 'lbr', NULL, '', '2022-02-14 16:45:07'),
(380, '20220214180319', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-02-14 18:03:19'),
(381, '20220214185350', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-14 18:53:50'),
(382, '20220214201445', 176, 1, 0, 50000, 'Pcs (1000 gram)', NULL, '', '2022-02-14 20:14:45'),
(383, '20220214211605', 137, 1, 0, 170000, 'btl', NULL, '', '2022-02-14 21:16:05'),
(384, '20220214214525', 130, 1, 0, 0, 'lbr', NULL, '', '2022-02-14 21:45:25'),
(385, '20220214232033', 187, 1, 0, 8000, '', NULL, '', '2022-02-14 23:20:33'),
(386, '20220214232717', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-02-14 23:27:17'),
(387, '20220215004054', 210, 1, 0, 60000, 'btl', NULL, '', '2022-02-15 00:40:54'),
(388, '20220215004849', 170, 1, 0, 25000, 'Pcs (250 gram)', NULL, '', '2022-02-15 00:48:49'),
(389, '20220215010844', 195, 1, 0, 25000, '', NULL, '', '2022-02-15 01:08:44'),
(390, '20220215011323', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-02-15 01:13:23'),
(391, '20220215021323', 207, 1, 0, 150000, '', NULL, '', '2022-02-15 02:13:23'),
(392, '20220215033343', 211, 1, 0, 250000, 'btl', NULL, '', '2022-02-15 03:33:43'),
(393, '20220215034549', 2, 1, 0, 15000, 'pcs', NULL, '', '2022-02-15 03:45:49'),
(394, '20220215045606', 55, 1, 0, 0, 'lbr', NULL, '', '2022-02-15 04:56:06'),
(395, '20220215075613', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-02-15 07:56:13'),
(396, '20220215092730', 22, 1, 0, 10000, 'pcs', NULL, '', '2022-02-15 09:27:30'),
(397, '20220215092859', 210, 1, 0, 60000, 'btl', NULL, '', '2022-02-15 09:28:59'),
(398, '20220215103211', 195, 1, 0, 25000, '', NULL, '', '2022-02-15 10:32:11'),
(399, '20220215103417', 130, 1, 0, 0, 'lbr', NULL, '', '2022-02-15 10:34:17'),
(400, '20220215113349', 41, 1, 0, 60000, 'btl', NULL, '', '2022-02-15 11:33:49'),
(401, '20220215115235', 208, 1, 0, 300000, '', NULL, '', '2022-02-15 11:52:35'),
(402, '20220215124248', 171, 1, 0, 35000, 'Pcs (80 gram)', NULL, '', '2022-02-15 12:42:48'),
(403, '20220215130327', 213, 1, 0, 130000, 'btl', NULL, '', '2022-02-15 13:03:27'),
(404, '20220215135329', 74, 1, 0, 100, 'lbr', NULL, '', '2022-02-15 13:53:29'),
(405, '20220215150209', 105, 1, 0, 100, 'lbr', NULL, '', '2022-02-15 15:02:09'),
(406, '20220215151918', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-02-15 15:19:18'),
(407, '20220215153756', 72, 1, 0, 100, 'lbr', NULL, '', '2022-02-15 15:37:56'),
(408, '20220215154336', 183, 1, 0, 40000, 'botol', NULL, '', '2022-02-15 15:43:36'),
(409, '20220215171029', 115, 1, 0, 10000, 'lembar', NULL, '', '2022-02-15 17:10:29'),
(410, '20220215173507', 207, 1, 0, 150000, '', NULL, '', '2022-02-15 17:35:07'),
(411, '20220215173900', 100, 1, 0, 100, 'lbr', NULL, '', '2022-02-15 17:39:00'),
(412, '20220215185959', 204, 1, 0, 8000, '', NULL, '', '2022-02-15 18:59:59'),
(413, '20220215213244', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-02-15 21:32:44'),
(414, '20220215224328', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-02-15 22:43:28'),
(415, '20220216002246', 208, 1, 0, 300000, '', NULL, '', '2022-02-16 00:22:46'),
(416, '20220216002359', 136, 1, 0, 30000, 'pcs', NULL, '', '2022-02-16 00:23:59'),
(417, '20220216003226', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-02-16 00:32:26'),
(418, '20220216012249', 129, 1, 0, 123, 'lbr', NULL, '', '2022-02-16 01:22:49'),
(419, '20220216042638', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-16 04:26:38'),
(420, '20220216045203', 213, 1, 0, 130000, 'btl', NULL, '', '2022-02-16 04:52:03'),
(421, '20220216054403', 209, 1, 0, 35000, 'btl', NULL, '', '2022-02-16 05:44:03'),
(422, '20220216061712', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-02-16 06:17:12'),
(423, '20220216101134', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-02-16 10:11:34'),
(424, '20220216101505', 193, 1, 0, 35000, 'buah', NULL, '', '2022-02-16 10:15:05'),
(425, '20220216111243', 152, 1, 0, 20000, 'Botol', NULL, '', '2022-02-16 11:12:43'),
(426, '20220216121236', 158, 1, 0, 130000, 'btl', NULL, '', '2022-02-16 12:12:36'),
(427, '20220216181938', 197, 1, 0, 15000, '', NULL, '', '2022-02-16 18:19:38'),
(428, '20220216193046', 44, 1, 0, 10000, 'pcs', NULL, '', '2022-02-16 19:30:46'),
(429, '20220216194801', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-02-16 19:48:01'),
(430, '20220217001159', 176, 1, 0, 50000, 'Pcs (1000 gram)', NULL, '', '2022-02-17 00:11:59'),
(431, '20220217022709', 179, 1, 0, 45000, '', NULL, '', '2022-02-17 02:27:09'),
(432, '20220217035328', 14, 1, 0, 22000, 'pcs', NULL, '', '2022-02-17 03:53:28'),
(433, '20220217041023', 67, 1, 0, 100, 'lbr', NULL, '', '2022-02-17 04:10:23'),
(434, '20220217062627', 191, 1, 0, 10000, 'lembar', NULL, '', '2022-02-17 06:26:27'),
(435, '20220217114328', 198, 1, 0, 35000, '', NULL, '', '2022-02-17 11:43:28'),
(438, '20220217135212', 180, 1, 0, 15000, '', NULL, '', '2022-02-17 13:52:12'),
(437, '20220217114328', 4, 1, 0, 30000, 'pcs', NULL, '', '2022-02-17 11:46:06'),
(439, '20220217144028', 14, 1, 0, 22000, 'pcs', NULL, '', '2022-02-17 14:40:28'),
(440, '20220217153856', 41, 1, 0, 60000, 'btl', NULL, '', '2022-02-17 15:38:56'),
(441, '20220217161115', 208, 1, 0, 300000, '', NULL, '', '2022-02-17 16:11:15'),
(442, '20220217165139', 213, 1, 0, 130000, 'btl', NULL, '', '2022-02-17 16:51:39'),
(443, '20220217181528', 74, 1, 0, 100, 'lbr', NULL, '', '2022-02-17 18:15:28'),
(444, '20220217195442', 183, 1, 0, 40000, 'botol', NULL, '', '2022-02-17 19:54:42'),
(445, '20220217200709', 68, 1, 0, 100, 'lbr', NULL, '', '2022-02-17 20:07:09'),
(446, '20220217211340', 207, 1, 0, 150000, '', NULL, '', '2022-02-17 21:13:40'),
(447, '20220217222949', 204, 1, 0, 8000, '', NULL, '', '2022-02-17 22:29:49'),
(448, '20220217224345', 138, 1, 0, 30000, 'pcs', NULL, '', '2022-02-17 22:43:45'),
(449, '20220218013821', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-02-18 01:38:21'),
(450, '20220218021121', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-02-18 02:11:21'),
(451, '20220218040136', 85, 1, 0, 3000, 'polybag', NULL, '', '2022-02-18 04:01:36'),
(452, '20220218041825', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-02-18 04:18:25'),
(453, '20220218045148', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-02-18 04:51:48'),
(454, '20220218063041', 44, 1, 0, 10000, 'pcs', NULL, '', '2022-02-18 06:30:41'),
(455, '20220218063155', 53, 1, 0, 0, 'lbr', NULL, '', '2022-02-18 06:31:55'),
(456, '20220218082520', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-02-18 08:25:20'),
(457, '20220218092754', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-02-18 09:27:54'),
(458, '20220218124207', 181, 1, 0, 25000, '', NULL, '', '2022-02-18 12:42:07'),
(459, '20220218155329', 156, 1, 0, 13000, 'pcs', NULL, '', '2022-02-18 15:53:29'),
(460, '20220218164612', 13, 1, 0, 25000, 'pcs', NULL, '', '2022-02-18 16:46:12'),
(461, '20220218181116', 105, 1, 0, 100, 'lbr', NULL, '', '2022-02-18 18:11:16'),
(462, '20220218181420', 192, 1, 0, 55000, 'buah', NULL, '', '2022-02-18 18:14:20'),
(463, '20220218192240', 59, 1, 0, 30000, 'lbr', NULL, '', '2022-02-18 19:22:40'),
(464, '20220218220225', 197, 1, 0, 15000, '', NULL, '', '2022-02-18 22:02:25'),
(465, '20220218231830', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-02-18 23:18:30'),
(466, '20220218233652', 44, 1, 0, 10000, 'pcs', NULL, '', '2022-02-18 23:36:52'),
(467, '20220219000021', 16, 1, 0, 80000, 'btl', NULL, '', '2022-02-19 00:00:21'),
(468, '20220219035957', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-02-19 03:59:57'),
(469, '20220219052517', 179, 1, 0, 45000, '', NULL, '', '2022-02-19 05:25:17'),
(470, '20220219075056', 155, 1, 0, 90000, 'lbr', NULL, '', '2022-02-19 07:50:56'),
(471, '20220219084232', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-02-19 08:42:32'),
(472, '20220219085626', 182, 1, 0, 15000, '', NULL, '', '2022-02-19 08:56:26'),
(473, '20220220011416', 17, 1, 0, 100000, 'btl', NULL, '', '2022-02-20 01:14:16'),
(474, '20220220015506', 38, 1, 0, 36000, 'pcs', NULL, '', '2022-02-20 01:55:06'),
(475, '20220220164823', 188, 1, 0, 10000, '', NULL, '', '2022-02-20 16:48:23'),
(476, '20220220210024', 13, 1, 0, 25000, 'pcs', NULL, '', '2022-02-20 21:00:24'),
(477, '20220220214929', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-02-20 21:49:29'),
(478, '20220220233952', 59, 1, 0, 30000, 'lbr', NULL, '', '2022-02-20 23:39:52'),
(479, '20220221080858', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-02-21 08:08:58'),
(480, '20220221124039', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-02-21 12:40:39'),
(481, '20220221130554', 182, 1, 0, 15000, '', NULL, '', '2022-02-21 13:05:54'),
(482, '20220221172006', 175, 1, 0, 40000, '', NULL, '', '2022-02-21 17:20:06'),
(483, '20220222053356', 38, 1, 0, 36000, 'pcs', NULL, '', '2022-02-22 05:33:56'),
(485, '20220222212539', 188, 1, 0, 10000, '', NULL, '', '2022-02-22 21:25:39'),
(486, '20220223045158', 163, 1, 0, 60000, 'btl', NULL, '', '2022-02-23 04:51:58'),
(487, '20220223163121', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-02-23 16:31:21'),
(488, '20220223172716', 182, 1, 0, 15000, '', NULL, '', '2022-02-23 17:27:16'),
(489, '20220223212455', 175, 1, 0, 40000, '', NULL, '', '2022-02-23 21:24:55'),
(490, '20220223223142', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-23 22:31:42'),
(491, '20220224183750', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-24 18:37:50'),
(492, '20220225022928', 168, 1, 0, 90000, 'Pcs (250 ml)', NULL, '', '2022-02-25 02:29:28'),
(493, '20220225095445', 70, 1, 0, 100, 'lbr', NULL, '', '2022-02-25 09:54:45'),
(494, '20220225113149', 9, 1, 0, 25000, 'pcs', NULL, '', '2022-02-25 11:31:49'),
(495, '20220225151848', 137, 1, 0, 170000, 'btl', NULL, '', '2022-02-25 15:18:48'),
(496, '20220226013215', 171, 1, 0, 35000, 'Pcs (80 gram)', NULL, '', '2022-02-26 01:32:15'),
(497, '20220226090807', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-02-26 09:08:07'),
(498, '20220226123148', 181, 1, 0, 25000, '', NULL, '', '2022-02-26 12:31:48'),
(499, '20220226225619', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-02-26 22:56:19'),
(500, '20220227024331', 144, 1, 0, 15000, 'pcs', NULL, '', '2022-02-27 02:43:31'),
(501, '20220227080158', 39, 1, 0, 35000, 'pcs', NULL, '', '2022-02-27 08:01:58'),
(502, '20220227083736', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-02-27 08:37:36'),
(503, '20220227124700', 144, 1, 0, 15000, 'pcs', NULL, '', '2022-02-27 12:47:00'),
(504, '20220227124841', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-02-27 12:48:41'),
(505, '20220227133315', 218, 1, 0, 15000, '', NULL, '', '2022-02-27 13:33:15'),
(506, '20220227152017', 9, 1, 0, 25000, 'pcs', NULL, '', '2022-02-27 15:20:17'),
(507, '20220227173932', 59, 1, 0, 30000, 'lbr', NULL, '', '2022-02-27 17:39:32'),
(508, '20220227225252', 216, 1, 0, 30000, '', NULL, '', '2022-02-27 22:52:52'),
(509, '20220228013648', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-02-28 01:36:48'),
(510, '20220228035440', 196, 1, 0, 15000, '', NULL, '', '2022-02-28 03:54:40'),
(511, '20220228053618', 160, 1, 0, 50000, 'pcs', NULL, '', '2022-02-28 05:36:18'),
(512, '20220228053853', 171, 1, 0, 35000, 'Pcs (80 gram)', NULL, '', '2022-02-28 05:38:53'),
(513, '20220228064803', 18, 1, 0, 15000, 'pcs', NULL, '', '2022-02-28 06:48:03'),
(514, '20220228080138', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-02-28 08:01:38'),
(515, '20220228125008', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-02-28 12:50:08'),
(516, '20220228161242', 181, 1, 0, 25000, '', NULL, '', '2022-02-28 16:12:42'),
(517, '20220228210406', 197, 1, 0, 15000, '', NULL, '', '2022-02-28 21:04:06'),
(518, '20220228230242', 212, 1, 0, 85000, 'btl', NULL, '', '2022-02-28 23:02:42'),
(519, '20220228233357', 17, 1, 0, 100000, 'btl', NULL, '', '2022-02-28 23:33:57'),
(520, '20220301001342', 55, 1, 0, 0, 'lbr', NULL, '', '2022-03-01 00:13:42'),
(521, '20220301002139', 217, 1, 0, 30000, '', NULL, '', '2022-03-01 00:21:39'),
(522, '20220301002800', 136, 1, 0, 25000, 'pcs', NULL, '', '2022-03-01 00:28:00'),
(523, '20220301012305', 227, 1, 0, 25000, '1', NULL, '', '2022-03-01 01:23:05'),
(524, '20220301050838', 215, 1, 0, 30000, '', NULL, '', '2022-03-01 05:08:38'),
(525, '20220301093538', 214, 1, 0, 30000, '', NULL, '', '2022-03-01 09:35:38'),
(526, '20220301151256', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-03-01 15:12:56'),
(527, '20220301163609', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-03-01 16:36:09'),
(528, '20220301165523', 144, 1, 0, 15000, 'pcs', NULL, '', '2022-03-01 16:55:23'),
(529, '20220301171105', 218, 1, 0, 15000, '', NULL, '', '2022-03-01 17:11:05'),
(530, '20220301192142', 211, 1, 0, 250000, 'btl', NULL, '', '2022-03-01 19:21:42'),
(531, '20220301194652', 151, 1, 0, 15000, 'Bungkus', NULL, '', '2022-03-01 19:46:52'),
(532, '20220301195711', 9, 1, 0, 25000, 'pcs', NULL, '', '2022-03-01 19:57:11'),
(533, '20220301212535', 59, 1, 0, 30000, 'lbr', NULL, '', '2022-03-01 21:25:35'),
(534, '20220302014814', 217, 1, 0, 30000, '', NULL, '', '2022-03-02 01:48:14'),
(535, '20220302021716', 216, 1, 0, 30000, '', NULL, '', '2022-03-02 02:17:16'),
(536, '20220302032812', 135, 1, 0, 45000, 'pcs', NULL, '', '2022-03-02 03:28:12'),
(537, '20220302052129', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-03-02 05:21:29'),
(538, '20220302070639', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-03-02 07:06:39'),
(539, '20220302071907', 2, 1, 0, 15000, 'pcs', NULL, '', '2022-03-02 07:19:07'),
(540, '20220302073130', 9, 1, 0, 25000, 'pcs', NULL, '', '2022-03-02 07:31:30'),
(541, '20220302073423', 211, 1, 0, 250000, 'btl', NULL, '', '2022-03-02 07:34:23'),
(542, '20220302074804', 196, 1, 0, 15000, '', NULL, '', '2022-03-02 07:48:04'),
(543, '20220302080533', 216, 1, 0, 30000, '', NULL, '', '2022-03-02 08:05:33'),
(544, '20220302082541', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-03-02 08:25:41'),
(545, '20220302090627', 224, 1, 0, 130000, '1', NULL, '', '2022-03-02 09:06:27'),
(546, '20220302104840', 18, 1, 0, 15000, 'pcs', NULL, '', '2022-03-02 10:48:40'),
(547, '20220302114615', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-03-02 11:46:15'),
(548, '20220302125636', 128, 1, 0, 123, 'Batang', NULL, '', '2022-03-02 12:56:36'),
(549, '20220302154004', 151, 1, 0, 15000, 'Bungkus', NULL, '', '2022-03-02 15:40:04'),
(550, '20220302164747', 143, 1, 0, 15000, 'pcs', NULL, '', '2022-03-02 16:47:47'),
(551, '20220302223317', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-03-02 22:33:17'),
(552, '20220302225419', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-03-02 22:54:19'),
(553, '20220302232332', 154, 1, 0, 10000, 'lembar', NULL, '', '2022-03-02 23:23:32'),
(554, '20220302235428', 170, 1, 0, 25000, 'Pcs (250 gram)', NULL, '', '2022-03-02 23:54:28'),
(555, '20220303004051', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-03-03 00:40:51'),
(556, '20220303011007', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-03-03 01:10:07'),
(557, '20220303022321', 212, 1, 0, 85000, 'btl', NULL, '', '2022-03-03 02:23:21'),
(558, '20220303051256', 227, 1, 0, 25000, '1', NULL, '', '2022-03-03 05:12:56'),
(559, '20220303060549', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-03-03 06:05:49'),
(560, '20220303064503', 221, 1, 0, 15000, '', NULL, '', '2022-03-03 06:45:03'),
(561, '20220303083123', 215, 1, 0, 30000, '', NULL, '', '2022-03-03 08:31:23'),
(562, '20220303130820', 214, 1, 0, 30000, '', NULL, '', '2022-03-03 13:08:20'),
(563, '20220303181315', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-03-03 18:13:15'),
(564, '20220303185936', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-03-03 18:59:36'),
(565, '20220303190345', 148, 1, 0, 200000, 'Botol', NULL, '', '2022-03-03 19:03:45'),
(566, '20220303191741', 227, 1, 0, 25000, '1', NULL, '', '2022-03-03 19:17:41'),
(567, '20220303213504', 215, 1, 0, 30000, '', NULL, '', '2022-03-03 21:35:04'),
(568, '20220303215104', 226, 1, 0, 0, 'jenis', NULL, '', '2022-03-03 21:51:04'),
(569, '20220303220400', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-03-03 22:04:00'),
(570, '20220303232307', 151, 1, 0, 15000, 'Bungkus', NULL, '', '2022-03-03 23:23:07'),
(571, '20220304025028', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-03-04 02:50:28'),
(572, '20220304041536', 226, 1, 0, 0, 'jenis', NULL, '', '2022-03-04 04:15:36'),
(573, '20220304043358', 20, 1, 0, 85000, 'btl', NULL, '', '2022-03-04 04:33:58'),
(574, '20220304043812', 54, 1, 0, 10000, 'lbr', NULL, '', '2022-03-04 04:38:12'),
(575, '20220304055524', 224, 1, 0, 130000, '1', NULL, '', '2022-03-04 05:55:24'),
(576, '20220304071616', 182, 1, 0, 15000, '', NULL, '', '2022-03-04 07:16:16'),
(577, '20220304074339', 149, 1, 0, 35000, 'Jerigen', NULL, '', '2022-03-04 07:43:39'),
(578, '20220304083102', 39, 1, 0, 35000, 'pcs', NULL, '', '2022-03-04 08:31:02'),
(579, '20220304104055', 158, 1, 0, 130000, 'btl', NULL, '', '2022-03-04 10:40:55'),
(580, '20220304110124', 211, 1, 0, 250000, 'btl', NULL, '', '2022-03-04 11:01:24'),
(581, '20220304110649', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-03-04 11:06:49'),
(582, '20220304120314', 55, 1, 0, 10000, 'lbr', NULL, '', '2022-03-04 12:03:14'),
(583, '20220304131947', 174, 1, 0, 55000, '', NULL, '', '2022-03-04 13:19:47'),
(584, '20220304140041', 4, 1, 0, 30000, 'pcs', NULL, '', '2022-03-04 14:00:41'),
(585, '20220304145033', 128, 1, 0, 123, 'Batang', NULL, '', '2022-03-04 14:50:33'),
(586, '20220304162536', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-03-04 16:25:36'),
(587, '20220304180747', 147, 1, 0, 10000, 'kg', NULL, '', '2022-03-04 18:07:47'),
(588, '20220304182355', 225, 1, 0, 15000, 'btl', NULL, '', '2022-03-04 18:23:55'),
(589, '20220304191447', 41, 1, 0, 60000, 'btl', NULL, '', '2022-03-04 19:14:47'),
(590, '20220304192052', 225, 1, 0, 15000, 'btl', NULL, '', '2022-03-04 19:20:52'),
(591, '20220304192746', 171, 1, 0, 35000, 'Pcs (80 gram)', NULL, '', '2022-03-04 19:27:46'),
(592, '20220304212905', 194, 1, 0, 15000, '', NULL, '', '2022-03-04 21:29:05'),
(593, '20220305005419', 223, 1, 0, 3000, 'polybag', NULL, '', '2022-03-05 00:54:19'),
(594, '20220305020427', 73, 1, 0, 100, 'lbr', NULL, '', '2022-03-05 02:04:27'),
(595, '20220305021832', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-03-05 02:18:32'),
(596, '20220305022144', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-03-05 02:21:44'),
(597, '20220305035516', 170, 1, 0, 25000, 'Pcs (250 gram)', NULL, '', '2022-03-05 03:55:16'),
(598, '20220305051026', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-03-05 05:10:26'),
(599, '20220305060328', 161, 1, 0, 60000, 'btl', NULL, '', '2022-03-05 06:03:28'),
(600, '20220305070908', 25, 1, 0, 3000, 'pcs', NULL, '', '2022-03-05 07:09:08'),
(601, '20220305075304', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-03-05 07:53:04'),
(602, '20220305100315', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-03-05 10:03:15'),
(603, '20220305135207', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-03-05 13:52:07'),
(604, '20220305161835', 193, 1, 0, 35000, 'buah', NULL, '', '2022-03-05 16:18:35'),
(605, '20220305203203', 38, 1, 0, 36000, 'pcs', NULL, '', '2022-03-05 20:32:03'),
(606, '20220305224745', 148, 1, 0, 200000, 'Botol', NULL, '', '2022-03-05 22:47:45'),
(607, '20220305225217', 219, 1, 0, 15000, '', NULL, '', '2022-03-05 22:52:17'),
(608, '20220305231224', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-03-05 23:12:24'),
(609, '20220305233307', 227, 1, 0, 25000, '1', NULL, '', '2022-03-05 23:33:07'),
(610, '20220306010435', 226, 1, 0, 0, 'jenis', NULL, '', '2022-03-06 01:04:35'),
(611, '20220306014451', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-03-06 01:44:51'),
(612, '20220306022503', 59, 1, 0, 30000, 'lbr', NULL, '', '2022-03-06 02:25:03'),
(613, '20220306025625', 206, 1, 0, 100000, '', NULL, '', '2022-03-06 02:56:25'),
(614, '20220306035634', 22, 1, 0, 10000, 'pcs', NULL, '', '2022-03-06 03:56:34'),
(615, '20220306043629', 19, 1, 0, 30000, 'btl', NULL, '', '2022-03-06 04:36:29'),
(616, '20220306062318', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-03-06 06:23:18'),
(617, '20220306073608', 176, 1, 0, 50000, 'Pcs (1000 gram)', NULL, '', '2022-03-06 07:36:08'),
(618, '20220306073840', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-03-06 07:38:41'),
(619, '20220306093219', 224, 1, 0, 130000, '1', NULL, '', '2022-03-06 09:32:19'),
(620, '20220306103411', 187, 1, 0, 8000, '', NULL, '', '2022-03-06 10:34:11'),
(621, '20220306105538', 182, 1, 0, 15000, '', NULL, '', '2022-03-06 10:55:38'),
(622, '20220306110119', 14, 1, 0, 22000, 'pcs', NULL, '', '2022-03-06 11:01:19'),
(623, '20220306114954', 39, 1, 0, 35000, 'pcs', NULL, '', '2022-03-06 11:49:54'),
(624, '20220306124159', 141, 1, 0, 25000, 'kg', NULL, '', '2022-03-06 12:41:59'),
(625, '20220306133145', 207, 1, 0, 150000, '', NULL, '', '2022-03-06 13:31:45'),
(626, '20220306133642', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-03-06 13:36:42'),
(627, '20220306140516', 158, 1, 0, 130000, 'btl', NULL, '', '2022-03-06 14:05:16'),
(628, '20220306144247', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-03-06 14:42:47'),
(629, '20220306153904', 184, 1, 0, 60000, '', NULL, '', '2022-03-06 15:39:04'),
(630, '20220306173904', 4, 1, 0, 30000, 'pcs', NULL, '', '2022-03-06 17:39:04'),
(631, '20220306185315', 128, 1, 0, 123, 'Batang', NULL, '', '2022-03-06 18:53:15'),
(632, '20220306195325', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-03-06 19:53:25'),
(633, '20220306221706', 147, 1, 0, 10000, 'kg', NULL, '', '2022-03-06 22:17:06'),
(634, '20220306222950', 221, 1, 0, 15000, '', NULL, '', '2022-03-06 22:29:50'),
(635, '20220306223547', 41, 1, 0, 60000, 'btl', NULL, '', '2022-03-06 22:35:47'),
(636, '20220306225402', 56, 1, 0, 200000, 'lbr', NULL, '', '2022-03-06 22:54:02'),
(637, '20220307011601', 194, 1, 0, 15000, '', NULL, '', '2022-03-07 01:16:01'),
(638, '20220307025817', 166, 1, 0, 17500, '', NULL, '', '2022-03-07 02:58:17'),
(639, '20220307031755', 186, 1, 0, 20000, '', NULL, '', '2022-03-07 03:17:55'),
(640, '20220307060304', 204, 1, 0, 8000, '', NULL, '', '2022-03-07 06:03:04'),
(641, '20220307070039', 68, 1, 0, 100, 'lbr', NULL, '', '2022-03-07 07:00:39'),
(642, '20220307084603', 167, 1, 0, 17500, '', NULL, '', '2022-03-07 08:46:03'),
(643, '20220307084903', 71, 1, 0, 100, 'lbr', NULL, '', '2022-03-07 08:49:03'),
(644, '20220307090441', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-03-07 09:04:41'),
(645, '20220307093908', 161, 1, 0, 60000, 'btl', NULL, '', '2022-03-07 09:39:08'),
(646, '20220307111451', 59, 1, 0, 30000, 'lbr', NULL, '', '2022-03-07 11:14:51'),
(647, '20220307121833', 129, 1, 0, 123, 'lbr', NULL, '', '2022-03-07 12:18:33'),
(648, '20220307141447', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-03-07 14:14:47'),
(649, '20220307173715', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-03-07 17:37:15'),
(650, '20220307175847', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-03-07 17:58:47'),
(651, '20220307200449', 193, 1, 0, 35000, 'buah', NULL, '', '2022-03-07 20:04:49'),
(652, '20220307211406', 101, 1, 0, 100, 'lbr', NULL, '', '2022-03-07 21:14:06'),
(653, '20220307231831', 220, 1, 0, 15000, '', NULL, '', '2022-03-07 23:18:31'),
(654, '20220307232038', 13, 1, 0, 25000, 'pcs', NULL, '', '2022-03-07 23:20:38'),
(655, '20220307234619', 38, 1, 0, 36000, 'pcs', NULL, '', '2022-03-07 23:46:19'),
(656, '20220308014812', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-03-08 01:48:12'),
(657, '20220308021935', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-03-08 02:19:35'),
(658, '20220308024554', 148, 1, 0, 200000, 'Botol', NULL, '', '2022-03-08 02:45:54'),
(659, '20220308025452', 219, 1, 0, 15000, '', NULL, '', '2022-03-08 02:54:52'),
(660, '20220308042932', 223, 1, 0, 3000, 'polybag', NULL, '', '2022-03-08 04:29:32'),
(661, '20220308044158', 226, 1, 0, 0, 'jenis', NULL, '', '2022-03-08 04:41:58'),
(662, '20220308055021', 59, 1, 0, 30000, 'lbr', NULL, '', '2022-03-08 05:50:21'),
(663, '20220308071414', 165, 1, 0, 17500, '', NULL, '', '2022-03-08 07:14:14'),
(664, '20220308084749', 169, 1, 0, 160000, 'Pcs (250 ml)', NULL, '', '2022-03-08 08:47:49'),
(665, '20220308091052', 65, 1, 0, 100, 'lbr', NULL, '', '2022-03-08 09:10:52'),
(666, '20220308113340', 178, 1, 0, 25000, 'Pack', NULL, '', '2022-03-08 11:33:40'),
(667, '20220308123211', 67, 1, 0, 100, 'lbr', NULL, '', '2022-03-08 12:32:11'),
(668, '20220308131437', 177, 1, 0, 500000, 'buah', NULL, '', '2022-03-08 13:14:37'),
(669, '20220308134226', 163, 1, 0, 60000, 'btl', NULL, '', '2022-03-08 13:42:26'),
(670, '20220308140341', 187, 1, 0, 8000, '', NULL, '', '2022-03-08 14:03:41'),
(671, '20220308142022', 14, 1, 0, 22000, 'pcs', NULL, '', '2022-03-08 14:20:22'),
(672, '20220308163433', 141, 1, 0, 25000, 'kg', NULL, '', '2022-03-08 16:34:33'),
(673, '20220308165825', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-03-08 16:58:25'),
(674, '20220308170818', 207, 1, 0, 150000, '', NULL, '', '2022-03-08 17:08:18'),
(675, '20220308184132', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-03-08 18:41:32'),
(676, '20220308191002', 184, 1, 0, 60000, '', NULL, '', '2022-03-08 19:10:02'),
(677, '20220308192105', 23, 1, 0, 20000, 'pcs', NULL, '', '2022-03-08 19:21:05'),
(678, '20220308211646', 148, 1, 0, 200000, 'Botol', NULL, '', '2022-03-08 21:16:46'),
(679, '20220309002400', 22, 1, 0, 10000, 'pcs', NULL, '', '2022-03-09 00:24:00'),
(680, '20220309014126', 14, 1, 0, 22000, 'pcs', NULL, '', '2022-03-09 01:41:26'),
(681, '20220309020122', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-03-09 02:01:22'),
(682, '20220309022529', 56, 1, 0, 200000, 'lbr', NULL, '', '2022-03-09 02:25:29'),
(683, '20220309040853', 154, 1, 0, 10000, 'lembar', NULL, '', '2022-03-09 04:08:53'),
(684, '20220309075658', 156, 1, 0, 13000, 'pcs', NULL, '', '2022-03-09 07:56:58'),
(685, '20220309081550', 17, 1, 0, 100000, 'btl', NULL, '', '2022-03-09 08:15:50'),
(686, '20220309100048', 119, 1, 0, 5000, 'lembar', NULL, '', '2022-03-09 10:00:48'),
(687, '20220309111541', 205, 1, 0, 90000, '', NULL, '', '2022-03-09 11:15:41'),
(688, '20220309120810', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-03-09 12:08:10'),
(689, '20220309154342', 115, 1, 0, 10000, 'lembar', NULL, '', '2022-03-09 15:43:42'),
(690, '20220309155857', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-03-09 15:58:57'),
(691, '20220309170845', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-03-09 17:08:45'),
(692, '20220309200604', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-03-09 20:06:04'),
(693, '20220309202417', 191, 1, 0, 10000, 'lembar', NULL, '', '2022-03-09 20:24:17'),
(694, '20220309205314', 191, 1, 0, 10000, 'lembar', NULL, '', '2022-03-09 20:53:14'),
(695, '20220309224817', 227, 1, 0, 25000, '1', NULL, '', '2022-03-09 22:48:17'),
(696, '20220310005400', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-03-10 00:54:00'),
(697, '20220310021903', 117, 1, 0, 5000, 'lembar', NULL, '', '2022-03-10 02:19:03'),
(698, '20220310032346', 72, 1, 0, 100, 'lbr', NULL, '', '2022-03-10 03:23:46'),
(699, '20220310033735', 154, 1, 0, 10000, 'lembar', NULL, '', '2022-03-10 03:37:35'),
(700, '20220310040928', 120, 1, 0, 5000, 'lembar', NULL, '', '2022-03-10 04:09:28'),
(701, '20220310041227', 50, 1, 0, 10000, 'pcs', NULL, '', '2022-03-10 04:12:27'),
(702, '20220310055308', 61, 1, 0, 100, 'lbr', NULL, '', '2022-03-10 05:53:08'),
(703, '20220310085238', 197, 1, 0, 15000, '', NULL, '', '2022-03-10 08:52:38'),
(704, '20220310110934', 44, 1, 0, 10000, 'pcs', NULL, '', '2022-03-10 11:09:34'),
(705, '20220310142531', 185, 1, 0, 100000, 'botol', NULL, '', '2022-03-10 14:25:31'),
(706, '20220310151933', 42, 1, 0, 60000, 'btl', NULL, '', '2022-03-10 15:19:33'),
(707, '20220310162527', 228, 1, 0, 25000, '1', NULL, '', '2022-03-10 16:25:27'),
(708, '20220310164139', 179, 1, 0, 45000, '', NULL, '', '2022-03-10 16:41:39'),
(709, '20220310185512', 155, 1, 0, 90000, 'lbr', NULL, '', '2022-03-10 18:55:12'),
(710, '20220310190011', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-03-10 19:00:11'),
(711, '20220310202013', 102, 1, 0, 100, 'lbr', NULL, '', '2022-03-10 20:20:13'),
(712, '20220310210431', 191, 1, 0, 10000, 'lembar', NULL, '', '2022-03-10 21:04:31'),
(713, '20220310224537', 135, 1, 0, 45000, 'pcs', NULL, '', '2022-03-10 22:45:37'),
(714, '20220311013332', 177, 1, 0, 500000, 'buah', NULL, '', '2022-03-11 01:33:32'),
(715, '20220311040823', 22, 1, 0, 10000, 'pcs', NULL, '', '2022-03-11 04:08:23'),
(716, '20220311051342', 14, 1, 0, 22000, 'pcs', NULL, '', '2022-03-11 05:13:42'),
(717, '20220311054236', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-03-11 05:42:36'),
(718, '20220311073816', 213, 1, 0, 130000, 'btl', NULL, '', '2022-03-11 07:38:16'),
(719, '20220311115922', 38, 1, 0, 36000, 'pcs', NULL, '', '2022-03-11 11:59:22'),
(720, '20220311174731', 119, 1, 0, 5000, 'lembar', NULL, '', '2022-03-11 17:47:31'),
(721, '20220311181117', 47, 1, 0, 12000, 'pcs', NULL, '', '2022-03-11 18:11:17'),
(722, '20220311190432', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-03-11 19:04:32'),
(723, '20220311200519', 115, 1, 0, 10000, 'lembar', NULL, '', '2022-03-11 20:05:19'),
(724, '20220311202603', 198, 1, 0, 35000, '', NULL, '', '2022-03-11 20:26:03'),
(725, '20220311205533', 178, 1, 0, 25000, 'Pack', NULL, '', '2022-03-11 20:55:33'),
(726, '20220311212456', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-03-11 21:24:56'),
(727, '20220311232042', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-03-11 23:20:42'),
(728, '20220312003343', 140, 1, 0, 60000, 'btl', NULL, '', '2022-03-12 00:33:43'),
(729, '20220312004408', 191, 1, 0, 10000, 'lembar', NULL, '', '2022-03-12 00:44:08'),
(730, '20220312012708', 204, 1, 0, 8000, '', NULL, '', '2022-03-12 01:27:08'),
(731, '20220312031137', 227, 1, 0, 25000, '1', NULL, '', '2022-03-12 03:11:37'),
(732, '20220312043644', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-03-12 04:36:44'),
(733, '20220312050354', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-03-12 05:03:54'),
(734, '20220312051609', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-03-12 05:16:09'),
(735, '20220312060545', 117, 1, 0, 5000, 'lembar', NULL, '', '2022-03-12 06:05:45'),
(736, '20220312065227', 158, 1, 0, 130000, 'btl', NULL, '', '2022-03-12 06:52:27'),
(737, '20220312074852', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-03-12 07:48:52'),
(738, '20220312074936', 72, 1, 0, 100, 'lbr', NULL, '', '2022-03-12 07:49:36'),
(739, '20220312080542', 199, 1, 0, 15000, '', NULL, '', '2022-03-12 08:05:42'),
(740, '20220312080833', 50, 1, 0, 10000, 'pcs', NULL, '', '2022-03-12 08:08:33'),
(741, '20220312091439', 192, 1, 0, 55000, 'buah', NULL, '', '2022-03-12 09:14:39'),
(742, '20220312095320', 61, 1, 0, 100, 'lbr', NULL, '', '2022-03-12 09:53:20'),
(743, '20220312194342', 137, 1, 0, 170000, 'btl', NULL, '', '2022-03-12 19:43:42'),
(744, '20220312204726', 228, 1, 0, 25000, '1', NULL, '', '2022-03-12 20:47:26'),
(745, '20220313002142', 102, 1, 0, 100, 'lbr', NULL, '', '2022-03-13 00:21:42'),
(746, '20220313010122', 191, 1, 0, 10000, 'lembar', NULL, '', '2022-03-13 01:01:22'),
(747, '20220313015118', 135, 1, 0, 45000, 'pcs', NULL, '', '2022-03-13 01:51:18'),
(748, '20220313034433', 175, 1, 0, 40000, '', NULL, '', '2022-03-13 03:44:33'),
(749, '20220313043525', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-03-13 04:35:25'),
(750, '20220313084758', 180, 1, 0, 15000, '', NULL, '', '2022-03-13 08:47:58'),
(751, '20220313114852', 213, 1, 0, 130000, 'btl', NULL, '', '2022-03-13 11:48:52'),
(752, '20220313142404', 68, 1, 0, 100, 'lbr', NULL, '', '2022-03-13 14:24:04'),
(753, '20220313165228', 138, 1, 0, 30000, 'pcs', NULL, '', '2022-03-13 16:52:28'),
(754, '20220313211858', 119, 1, 0, 5000, 'lembar', NULL, '', '2022-03-13 21:18:58'),
(755, '20220313234736', 205, 1, 0, 90000, '', NULL, '', '2022-03-13 23:47:36'),
(756, '20220314001956', 228, 1, 0, 25000, '1', NULL, '', '2022-03-14 00:19:56'),
(757, '20220314042949', 140, 1, 0, 60000, 'btl', NULL, '', '2022-03-14 04:29:49'),
(758, '20220314044930', 204, 1, 0, 8000, '', NULL, '', '2022-03-14 04:49:30'),
(759, '20220314052600', 206, 1, 0, 100000, '', NULL, '', '2022-03-14 05:26:00'),
(760, '20220314070712', 188, 1, 0, 10000, '', NULL, '', '2022-03-14 07:07:12'),
(761, '20220314084052', 168, 1, 0, 90000, 'Pcs (250 ml)', NULL, '', '2022-03-14 08:40:52'),
(762, '20220314085859', 152, 1, 0, 20000, 'Botol', NULL, '', '2022-03-14 08:58:59'),
(763, '20220314103632', 158, 1, 0, 130000, 'btl', NULL, '', '2022-03-14 10:36:32'),
(764, '20220314104941', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-03-14 10:49:41'),
(765, '20220314112547', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-03-14 11:25:48'),
(766, '20220314145807', 218, 1, 0, 15000, '', NULL, '', '2022-03-14 14:58:07'),
(767, '20220314200337', 145, 1, 0, 10000, 'pcs', NULL, '', '2022-03-14 20:03:37'),
(768, '20220314215238', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-03-14 21:52:38'),
(769, '20220315015115', 20, 1, 0, 85000, 'btl', NULL, '', '2022-03-15 01:51:15'),
(770, '20220315024548', 170, 1, 0, 25000, 'Pcs (250 gram)', NULL, '', '2022-03-15 02:45:48'),
(771, '20220315075733', 160, 1, 0, 50000, 'pcs', NULL, '', '2022-03-15 07:57:33'),
(772, '20220315080729', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-03-15 08:07:29'),
(773, '20220315182455', 181, 1, 0, 25000, '', NULL, '', '2022-03-15 18:24:55'),
(774, '20220315225152', 197, 1, 0, 15000, '', NULL, '', '2022-03-15 22:51:52'),
(775, '20220316000431', 214, 1, 0, 30000, '', NULL, '', '2022-03-16 00:04:31'),
(776, '20220316012653', 227, 1, 0, 25000, '1', NULL, '', '2022-03-16 01:26:53'),
(777, '20220316021616', 167, 1, 0, 17500, '', NULL, '', '2022-03-16 02:16:16'),
(778, '20220316042904', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-03-16 04:29:04'),
(779, '20220316110949', 188, 1, 0, 10000, '', NULL, '', '2022-03-16 11:09:49'),
(780, '20220316123330', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-03-16 12:33:30'),
(781, '20220316141604', 136, 1, 0, 25000, 'pcs', NULL, '', '2022-03-16 14:16:04'),
(782, '20220316144844', 190, 1, 0, 150000, '', NULL, '', '2022-03-16 14:48:44'),
(783, '20220316180746', 144, 1, 0, 15000, 'pcs', NULL, '', '2022-03-16 18:07:46'),
(784, '20220316183959', 218, 1, 0, 15000, '', NULL, '', '2022-03-16 18:39:59'),
(785, '20220316184043', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-03-16 18:40:43'),
(786, '20220316203911', 211, 1, 0, 250000, 'btl', NULL, '', '2022-03-16 20:39:11'),
(787, '20220316220504', 116, 1, 0, 5000, 'lembar', NULL, '', '2022-03-16 22:05:04'),
(788, '20220317011615', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-03-17 01:16:15'),
(789, '20220317012640', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-03-17 01:26:40'),
(790, '20220317031851', 129, 1, 0, 123, 'lbr', NULL, '', '2022-03-17 03:18:51'),
(791, '20220317032207', 217, 1, 0, 30000, '', NULL, '', '2022-03-17 03:22:07'),
(792, '20220317051952', 55, 1, 0, 10000, 'lbr', NULL, '', '2022-03-17 05:19:52'),
(793, '20220317062157', 170, 1, 0, 25000, 'Pcs (250 gram)', NULL, '', '2022-03-17 06:21:57'),
(794, '20220317160405', 16, 1, 0, 80000, 'btl', NULL, '', '2022-03-17 16:04:05'),
(795, '20220317175921', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-03-17 17:59:21'),
(796, '20220317181812', 143, 1, 0, 15000, 'pcs', NULL, '', '2022-03-17 18:18:12'),
(797, '20220317200205', 138, 1, 0, 30000, 'pcs', NULL, '', '2022-03-17 20:02:05'),
(798, '20220317214959', 181, 1, 0, 25000, '', NULL, '', '2022-03-17 21:49:59'),
(799, '20220318011935', 104, 1, 0, 100, 'lbr', NULL, '', '2022-03-18 01:19:35'),
(800, '20220318035621', 214, 1, 0, 30000, '', NULL, '', '2022-03-18 03:56:21'),
(801, '20220318041116', 100, 1, 0, 100, 'lbr', NULL, '', '2022-03-18 04:11:16'),
(802, '20220318050004', 55, 1, 0, 10000, 'lbr', NULL, '', '2022-03-18 05:00:04'),
(803, '20220318050007', 17, 1, 0, 100000, 'btl', NULL, '', '2022-03-18 05:00:07'),
(804, '20220318052241', 227, 1, 0, 25000, '1', NULL, '', '2022-03-18 05:22:41'),
(805, '20220318052655', 217, 1, 0, 30000, '', NULL, '', '2022-03-18 05:26:55'),
(806, '20220318100813', 215, 1, 0, 30000, '', NULL, '', '2022-03-18 10:08:13'),
(807, '20220318140712', 141, 1, 0, 25000, 'kg', NULL, '', '2022-03-18 14:07:12'),
(808, '20220318170556', 156, 1, 0, 13000, 'pcs', NULL, '', '2022-03-18 17:05:56'),
(809, '20220318171804', 39, 1, 0, 35000, 'pcs', NULL, '', '2022-03-18 17:18:04'),
(810, '20220318174353', 136, 1, 0, 25000, 'pcs', NULL, '', '2022-03-18 17:43:53'),
(811, '20220318181240', 190, 1, 0, 150000, '', NULL, '', '2022-03-18 18:12:40'),
(812, '20220318191909', 209, 1, 0, 35000, 'btl', NULL, '', '2022-03-18 19:19:09'),
(813, '20220318213422', 144, 1, 0, 15000, 'pcs', NULL, '', '2022-03-18 21:34:22'),
(814, '20220318213930', 163, 1, 0, 60000, 'btl', NULL, '', '2022-03-18 21:39:30'),
(815, '20220318222203', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-03-18 22:22:03'),
(816, '20220319021425', 116, 1, 0, 5000, 'lembar', NULL, '', '2022-03-19 02:14:25'),
(817, '20220319042555', 137, 1, 0, 170000, 'btl', NULL, '', '2022-03-19 04:25:55'),
(818, '20220319044358', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-03-19 04:43:58'),
(819, '20220319050419', 219, 1, 0, 15000, '', NULL, '', '2022-03-19 05:04:19'),
(820, '20220319060538', 20, 1, 0, 85000, 'btl', NULL, '', '2022-03-19 06:05:38'),
(821, '20220319075929', 135, 1, 0, 45000, 'pcs', NULL, '', '2022-03-19 07:59:29'),
(822, '20220319085209', 55, 1, 0, 10000, 'lbr', NULL, '', '2022-03-19 08:52:09'),
(823, '20220319091325', 188, 1, 0, 10000, '', NULL, '', '2022-03-19 09:13:25'),
(824, '20220319092607', 130, 1, 0, 10000, 'lbr', NULL, '', '2022-03-19 09:26:07'),
(825, '20220319095447', 210, 1, 0, 60000, 'btl', NULL, '', '2022-03-19 09:54:47'),
(826, '20220319112609', 2, 1, 0, 15000, 'pcs', NULL, '', '2022-03-19 11:26:09'),
(827, '20220319121705', 211, 1, 0, 250000, 'btl', NULL, '', '2022-03-19 12:17:05'),
(828, '20220319173656', 128, 1, 0, 123, 'Batang', NULL, '', '2022-03-19 17:36:56'),
(829, '20220319192454', 16, 1, 0, 80000, 'btl', NULL, '', '2022-03-19 19:24:54'),
(830, '20220319201529', 185, 1, 0, 100000, 'botol', NULL, '', '2022-03-19 20:15:29'),
(831, '20220319204502', 103, 1, 0, 100, 'lbr', NULL, '', '2022-03-19 20:45:02'),
(832, '20220319205144', 208, 1, 0, 300000, '', NULL, '', '2022-03-19 20:51:44'),
(833, '20220319211745', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-03-19 21:17:45'),
(834, '20220319232452', 138, 1, 0, 30000, 'pcs', NULL, '', '2022-03-19 23:24:52'),
(835, '20220319233436', 105, 1, 0, 100, 'lbr', NULL, '', '2022-03-19 23:34:36'),
(836, '20220320003002', 183, 1, 0, 40000, 'botol', NULL, '', '2022-03-20 00:30:02'),
(837, '20220320073927', 212, 1, 0, 85000, 'btl', NULL, '', '2022-03-20 07:39:27'),
(838, '20220320075416', 217, 1, 0, 30000, '', NULL, '', '2022-03-20 07:54:16'),
(839, '20220320081336', 17, 1, 0, 100000, 'btl', NULL, '', '2022-03-20 08:13:36'),
(840, '20220320111623', 62, 1, 0, 100, 'lbr', NULL, '', '2022-03-20 11:16:23'),
(841, '20220320123112', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-03-20 12:31:12'),
(842, '20220320131220', 209, 1, 0, 35000, 'btl', NULL, '', '2022-03-20 13:12:20'),
(843, '20220320131859', 215, 1, 0, 30000, '', NULL, '', '2022-03-20 13:18:59'),
(844, '20220320152039', 144, 1, 0, 15000, 'pcs', NULL, '', '2022-03-20 15:20:39'),
(845, '20220320170303', 42, 1, 0, 60000, 'btl', NULL, '', '2022-03-20 17:03:03'),
(846, '20220320175859', 141, 1, 0, 25000, 'kg', NULL, '', '2022-03-20 17:58:59'),
(847, '20220320204601', 39, 1, 0, 35000, 'pcs', NULL, '', '2022-03-20 20:46:01'),
(848, '20220321005545', 174, 1, 0, 55000, '', NULL, '', '2022-03-21 00:55:45'),
(849, '20220321020330', 215, 1, 0, 30000, '', NULL, '', '2022-03-21 02:03:30'),
(850, '20220321040301', 206, 1, 0, 100000, '', NULL, '', '2022-03-21 04:03:01'),
(851, '20220321044611', 130, 1, 0, 10000, 'lbr', NULL, '', '2022-03-21 04:46:11'),
(852, '20220321070121', 119, 1, 0, 5000, 'lembar', NULL, '', '2022-03-21 07:01:21'),
(853, '20220321083759', 219, 1, 0, 15000, '', NULL, '', '2022-03-21 08:37:59'),
(854, '20220321100651', 25, 1, 0, 3000, 'pcs', NULL, '', '2022-03-21 10:06:51'),
(855, '20220321112305', 135, 1, 0, 45000, 'pcs', NULL, '', '2022-03-21 11:23:05'),
(856, '20220321122728', 130, 1, 0, 10000, 'lbr', NULL, '', '2022-03-21 12:27:28'),
(857, '20220321123527', 210, 1, 0, 60000, 'btl', NULL, '', '2022-03-21 12:35:28'),
(858, '20220321124142', 155, 1, 0, 90000, 'lbr', NULL, '', '2022-03-21 12:41:42'),
(859, '20220321143530', 2, 1, 0, 15000, 'pcs', NULL, '', '2022-03-21 14:35:30'),
(860, '20220321174108', 55, 1, 0, 10000, 'lbr', NULL, '', '2022-03-21 17:41:08'),
(861, '20220321195327', 147, 1, 0, 10000, 'kg', NULL, '', '2022-03-21 19:53:27'),
(862, '20220321212524', 52, 1, 0, 10000, 'lbr', NULL, '', '2022-03-21 21:25:24'),
(863, '20220321220313', 225, 1, 0, 15000, 'btl', NULL, '', '2022-03-21 22:03:13'),
(864, '20220321222801', 195, 1, 0, 25000, '', NULL, '', '2022-03-21 22:28:01'),
(865, '20220321222854', 130, 1, 0, 10000, 'lbr', NULL, '', '2022-03-21 22:28:54'),
(866, '20220322031924', 183, 1, 0, 40000, 'botol', NULL, '', '2022-03-22 03:19:24'),
(867, '20220322032915', 72, 1, 0, 100, 'lbr', NULL, '', '2022-03-22 03:29:15'),
(868, '20220322053438', 100, 1, 0, 100, 'lbr', NULL, '', '2022-03-22 05:34:38'),
(869, '20220322061853', 8, 1, 0, 3000, 'pcs', NULL, '', '2022-03-22 06:18:53'),
(870, '20220322062208', 223, 1, 0, 3000, 'polybag', NULL, '', '2022-03-22 06:22:08'),
(871, '20220322065614', 165, 1, 0, 17500, '', NULL, '', '2022-03-22 06:56:14');
INSERT INTO `rb_penjualan_temp` (`id_penjualan_detail`, `session`, `id_produk`, `jumlah`, `diskon`, `harga_jual`, `satuan`, `id_kupon`, `keterangan_order`, `waktu_order`) VALUES
(872, '20220322094145', 8, 1, 0, 3000, 'pcs', NULL, '', '2022-03-22 09:41:45'),
(873, '20220322115617', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-03-22 11:56:17'),
(874, '20220322120052', 175, 1, 0, 40000, '', NULL, '', '2022-03-22 12:00:52'),
(875, '20220322122335', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-03-22 12:23:35'),
(876, '20220322144416', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-03-22 14:44:16'),
(877, '20220322155535', 66, 1, 0, 100, 'lbr', NULL, '', '2022-03-22 15:55:35'),
(878, '20220322155942', 199, 1, 0, 15000, '', NULL, '', '2022-03-22 15:59:42'),
(879, '20220322160433', 65, 1, 0, 100, 'lbr', NULL, '', '2022-03-22 16:04:33'),
(880, '20220322163432', 102, 1, 0, 100, 'lbr', NULL, '', '2022-03-22 16:34:32'),
(881, '20220322194413', 42, 1, 0, 60000, 'btl', NULL, '', '2022-03-22 19:44:13'),
(882, '20220323000754', 220, 1, 0, 15000, '', NULL, '', '2022-03-23 00:07:54'),
(883, '20220323004234', 179, 1, 0, 45000, '', NULL, '', '2022-03-23 00:42:34'),
(884, '20220323014428', 166, 1, 0, 17500, '', NULL, '', '2022-03-23 01:44:28'),
(885, '20220323014431', 105, 1, 0, 100, 'lbr', NULL, '', '2022-03-23 01:44:31'),
(886, '20220323041652', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-03-23 04:16:52'),
(887, '20220323050143', 49, 1, 0, 15000, 'pcs', NULL, '', '2022-03-23 05:01:43'),
(888, '20220323061718', 215, 1, 0, 30000, '', NULL, '', '2022-03-23 06:17:18'),
(889, '20220323065635', 9, 1, 0, 25000, 'pcs', NULL, '', '2022-03-23 06:56:35'),
(890, '20220323085659', 19, 1, 0, 30000, 'btl', NULL, '', '2022-03-23 08:56:59'),
(891, '20220323122638', 178, 1, 0, 25000, 'Pack', NULL, '', '2022-03-23 12:26:38'),
(892, '20220323122835', 176, 1, 0, 50000, 'Pcs (1000 gram)', NULL, '', '2022-03-23 12:28:35'),
(893, '20220323214918', 73, 1, 0, 100, 'lbr', NULL, '', '2022-03-23 21:49:18'),
(894, '20220323225643', 128, 1, 0, 123, 'Batang', NULL, '', '2022-03-23 22:56:43'),
(895, '20220323232322', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-03-23 23:23:22'),
(896, '20220323235259', 117, 1, 0, 5000, 'lembar', NULL, '', '2022-03-23 23:52:59'),
(897, '20220324002316', 186, 1, 0, 20000, '', NULL, '', '2022-03-24 00:23:16'),
(898, '20220324022150', 225, 1, 0, 15000, 'btl', NULL, '', '2022-03-24 02:21:50'),
(899, '20220324024357', 75, 1, 0, 100, 'lbr', NULL, '', '2022-03-24 02:43:57'),
(900, '20220324025658', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-03-24 02:56:58'),
(901, '20220324052402', 198, 1, 0, 35000, '', NULL, '', '2022-03-24 05:24:02'),
(902, '20220324054133', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-03-24 05:41:33'),
(903, '20220324070919', 69, 1, 0, 100, 'lbr', NULL, '', '2022-03-24 07:09:19'),
(904, '20220324073047', 72, 1, 0, 100, 'lbr', NULL, '', '2022-03-24 07:30:47'),
(905, '20220324073357', 115, 1, 0, 10000, 'lembar', NULL, '', '2022-03-24 07:33:57'),
(906, '20220324091000', 17, 1, 0, 100000, 'btl', NULL, '', '2022-03-24 09:10:00'),
(907, '20220324091719', 223, 1, 0, 3000, 'polybag', NULL, '', '2022-03-24 09:17:19'),
(908, '20220324092340', 207, 1, 0, 150000, '', NULL, '', '2022-03-24 09:23:40'),
(909, '20220324094831', 100, 1, 0, 100, 'lbr', NULL, '', '2022-03-24 09:48:31'),
(910, '20220324104314', 165, 1, 0, 17500, '', NULL, '', '2022-03-24 10:43:14'),
(911, '20220324113009', 48, 1, 0, 15000, 'pcs', NULL, '', '2022-03-24 11:30:09'),
(912, '20220324134343', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-03-24 13:43:43'),
(913, '20220324153938', 136, 1, 0, 25000, 'pcs', NULL, '', '2022-03-24 15:39:38'),
(914, '20220324160214', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-03-24 16:02:14'),
(915, '20220324162145', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-03-24 16:21:45'),
(916, '20220324185203', 221, 1, 0, 15000, '', NULL, '', '2022-03-24 18:52:03'),
(917, '20220324194021', 199, 1, 0, 15000, '', NULL, '', '2022-03-24 19:40:21'),
(918, '20220324194838', 66, 1, 0, 100, 'lbr', NULL, '', '2022-03-24 19:48:38'),
(919, '20220324200726', 65, 1, 0, 100, 'lbr', NULL, '', '2022-03-24 20:07:26'),
(920, '20220324203036', 102, 1, 0, 100, 'lbr', NULL, '', '2022-03-24 20:30:36'),
(921, '20220324230724', 169, 1, 0, 160000, 'Pcs (250 ml)', NULL, '', '2022-03-24 23:07:24'),
(922, '20220324235153', 181, 1, 0, 25000, '', NULL, '', '2022-03-24 23:51:53'),
(923, '20220325013840', 142, 1, 0, 15000, 'pcs', NULL, '', '2022-03-25 01:38:40'),
(924, '20220325035639', 77, 1, 0, 100, 'lbr', NULL, '', '2022-03-25 03:56:39'),
(925, '20220325040911', 120, 1, 0, 5000, 'lembar', NULL, '', '2022-03-25 04:09:11'),
(926, '20220325042622', 38, 1, 0, 36000, 'pcs', NULL, '', '2022-03-25 04:26:22'),
(927, '20220325044043', 145, 1, 0, 10000, 'pcs', NULL, '', '2022-03-25 04:40:43'),
(928, '20220325053845', 166, 1, 0, 17500, '', NULL, '', '2022-03-25 05:38:45'),
(929, '20220325054711', 105, 1, 0, 100, 'lbr', NULL, '', '2022-03-25 05:47:11'),
(930, '20220325060056', 54, 1, 0, 10000, 'lbr', NULL, '', '2022-03-25 06:00:56'),
(931, '20220325070033', 148, 1, 0, 200000, 'Botol', NULL, '', '2022-03-25 07:00:33'),
(932, '20220325074307', 219, 1, 0, 15000, '', NULL, '', '2022-03-25 07:43:07'),
(933, '20220325080745', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-03-25 08:07:45'),
(934, '20220325102719', 212, 1, 0, 85000, 'btl', NULL, '', '2022-03-25 10:27:19'),
(935, '20220325105120', 9, 1, 0, 25000, 'pcs', NULL, '', '2022-03-25 10:51:20'),
(936, '20220325124316', 19, 1, 0, 30000, 'btl', NULL, '', '2022-03-25 12:43:16'),
(937, '20220325124852', 59, 1, 0, 30000, 'lbr', NULL, '', '2022-03-25 12:48:52'),
(938, '20220325155238', 176, 1, 0, 50000, 'Pcs (1000 gram)', NULL, '', '2022-03-25 15:52:38'),
(939, '20220325173923', 224, 1, 0, 130000, '1', NULL, '', '2022-03-25 17:39:23'),
(940, '20220325180710', 163, 1, 0, 60000, 'btl', NULL, '', '2022-03-25 18:07:10'),
(941, '20220325185113', 155, 1, 0, 90000, 'lbr', NULL, '', '2022-03-25 18:51:13'),
(942, '20220325191608', 67, 1, 0, 100, 'lbr', NULL, '', '2022-03-25 19:16:08'),
(943, '20220325192323', 182, 1, 0, 15000, '', NULL, '', '2022-03-25 19:23:23'),
(944, '20220325195614', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-03-25 19:56:14'),
(945, '20220325203438', 195, 1, 0, 25000, '', NULL, '', '2022-03-25 20:34:38'),
(946, '20220325211235', 11, 1, 0, 25000, 'pcs', NULL, '', '2022-03-25 21:12:35'),
(947, '20220325235516', 216, 1, 0, 30000, '', NULL, '', '2022-03-25 23:55:16'),
(948, '20220326004826', 174, 1, 0, 55000, '', NULL, '', '2022-03-26 00:48:26'),
(949, '20220326005232', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-03-26 00:52:32'),
(950, '20220326013235', 73, 1, 0, 100, 'lbr', NULL, '', '2022-03-26 01:32:35'),
(951, '20220326014846', 148, 1, 0, 200000, 'Botol', NULL, '', '2022-03-26 01:48:46'),
(952, '20220326014915', 171, 1, 0, 35000, 'Pcs (80 gram)', NULL, '', '2022-03-26 01:49:15'),
(953, '20220326024223', 128, 1, 0, 123, 'Batang', NULL, '', '2022-03-26 02:42:23'),
(954, '20220326025250', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-03-26 02:52:50'),
(955, '20220326032308', 186, 1, 0, 20000, '', NULL, '', '2022-03-26 03:23:08'),
(956, '20220326033804', 117, 1, 0, 5000, 'lembar', NULL, '', '2022-03-26 03:38:04'),
(957, '20220326055137', 14, 1, 0, 22000, 'pcs', NULL, '', '2022-03-26 05:51:37'),
(958, '20220326055943', 75, 1, 0, 100, 'lbr', NULL, '', '2022-03-26 05:59:43'),
(959, '20220326062605', 147, 1, 0, 10000, 'kg', NULL, '', '2022-03-26 06:26:05'),
(960, '20220326084830', 198, 1, 0, 35000, '', NULL, '', '2022-03-26 08:48:30'),
(961, '20220326085349', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-03-26 08:53:49'),
(962, '20220326121103', 69, 1, 0, 100, 'lbr', NULL, '', '2022-03-26 12:11:03'),
(963, '20220326124122', 17, 1, 0, 100000, 'btl', NULL, '', '2022-03-26 12:41:22'),
(964, '20220326163742', 167, 1, 0, 17500, '', NULL, '', '2022-03-26 16:37:42'),
(965, '20220326174642', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-03-26 17:46:42'),
(966, '20220326201212', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-03-26 20:12:12'),
(967, '20220326210413', 187, 1, 0, 8000, '', NULL, '', '2022-03-26 21:04:13'),
(968, '20220326232313', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-03-26 23:23:13'),
(969, '20220327000216', 213, 1, 0, 130000, 'btl', NULL, '', '2022-03-27 00:02:16'),
(970, '20220327004437', 143, 1, 0, 15000, 'pcs', NULL, '', '2022-03-27 00:44:37'),
(971, '20220327005932', 176, 1, 0, 50000, 'Pcs (1000 gram)', NULL, '', '2022-03-27 00:59:32'),
(972, '20220327051017', 142, 1, 0, 15000, 'pcs', NULL, '', '2022-03-27 05:10:17'),
(973, '20220327053907', 189, 1, 0, 15000, '', NULL, '', '2022-03-27 05:39:07'),
(974, '20220327085248', 199, 1, 0, 15000, '', NULL, '', '2022-03-27 08:52:48'),
(975, '20220327181545', 23, 1, 0, 20000, 'pcs', NULL, '', '2022-03-27 18:15:45'),
(976, '20220327193518', 42, 1, 0, 60000, 'btl', NULL, '', '2022-03-27 19:35:18'),
(977, '20220327202011', 137, 1, 0, 170000, 'btl', NULL, '', '2022-03-27 20:20:11'),
(978, '20220327232449', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-03-27 23:24:49'),
(979, '20220327233525', 182, 1, 0, 15000, '', NULL, '', '2022-03-27 23:35:25'),
(980, '20220328030409', 184, 1, 0, 60000, '', NULL, '', '2022-03-28 03:04:09'),
(981, '20220328051951', 148, 1, 0, 200000, 'Botol', NULL, '', '2022-03-28 05:19:51'),
(982, '20220328082415', 180, 1, 0, 15000, '', NULL, '', '2022-03-28 08:24:15'),
(983, '20220328100332', 147, 1, 0, 10000, 'kg', NULL, '', '2022-03-28 10:03:32'),
(984, '20220328115514', 213, 1, 0, 130000, 'btl', NULL, '', '2022-03-28 11:55:14'),
(985, '20220328130349', 74, 1, 0, 100, 'lbr', NULL, '', '2022-03-28 13:03:49'),
(986, '20220328185715', 68, 1, 0, 100, 'lbr', NULL, '', '2022-03-28 18:57:15'),
(987, '20220328202945', 167, 1, 0, 17500, '', NULL, '', '2022-03-28 20:29:45'),
(988, '20220328231634', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-03-28 23:16:34'),
(989, '20220328233243', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-03-28 23:32:43'),
(990, '20220328235004', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-03-28 23:50:04'),
(991, '20220329005329', 187, 1, 0, 8000, '', NULL, '', '2022-03-29 00:53:29'),
(992, '20220329005532', 54, 1, 0, 10000, 'lbr', NULL, '', '2022-03-29 00:55:32'),
(993, '20220329010123', 53, 1, 0, 10000, 'lbr', NULL, '', '2022-03-29 01:01:23'),
(994, '20220329010542', 198, 1, 0, 35000, '', NULL, '', '2022-03-29 01:05:42'),
(995, '20220329025458', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-03-29 02:54:58'),
(996, '20220329034908', 213, 1, 0, 130000, 'btl', NULL, '', '2022-03-29 03:49:08'),
(997, '20220329040651', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-03-29 04:06:51'),
(998, '20220329044312', 143, 1, 0, 15000, 'pcs', NULL, '', '2022-03-29 04:43:12'),
(999, '20220329074710', 172, 1, 0, 20000, '', NULL, '', '2022-03-29 07:47:10'),
(1000, '20220329080029', 193, 1, 0, 35000, 'buah', NULL, '', '2022-03-29 08:00:29'),
(1001, '20220329080128', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-03-29 08:01:28'),
(1002, '20220329094423', 52, 1, 0, 10000, 'lbr', NULL, '', '2022-03-29 09:44:23'),
(1003, '20220329113700', 158, 1, 0, 130000, 'btl', NULL, '', '2022-03-29 11:37:00'),
(1004, '20220329114736', 56, 1, 0, 200000, 'lbr', NULL, '', '2022-03-29 11:47:36'),
(1005, '20220329123449', 50, 1, 0, 10000, 'pcs', NULL, '', '2022-03-29 12:34:49'),
(1006, '20220329135615', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-03-29 13:56:15'),
(1007, '20220329145528', 173, 1, 0, 180000, '', NULL, '', '2022-03-29 14:55:28'),
(1008, '20220329193820', 53, 1, 0, 10000, 'lbr', NULL, '', '2022-03-29 19:38:20'),
(1009, '20220329195215', 75, 1, 0, 100, 'lbr', NULL, '', '2022-03-29 19:52:15'),
(1010, '20220329222052', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-03-29 22:20:52'),
(1011, '20220329232243', 42, 1, 0, 60000, 'btl', NULL, '', '2022-03-29 23:22:43'),
(1012, '20220329234352', 137, 1, 0, 170000, 'btl', NULL, '', '2022-03-29 23:43:52'),
(1013, '20220330035640', 182, 1, 0, 15000, '', NULL, '', '2022-03-30 03:56:40'),
(1014, '20220330041222', 161, 1, 0, 60000, 'btl', NULL, '', '2022-03-30 04:12:22'),
(1015, '20220330053852', 2, 1, 0, 15000, 'pcs', NULL, '', '2022-03-30 05:38:52'),
(1016, '20220330055346', 135, 1, 0, 45000, 'pcs', NULL, '', '2022-03-30 05:53:46'),
(1017, '20220330133928', 41, 1, 0, 60000, 'btl', NULL, '', '2022-03-30 13:39:28'),
(1018, '20220330163337', 194, 1, 0, 15000, '', NULL, '', '2022-03-30 16:33:37'),
(1019, '20220330180927', 166, 1, 0, 17500, '', NULL, '', '2022-03-30 18:09:27'),
(1020, '20220330192010', 156, 1, 0, 13000, 'pcs', NULL, '', '2022-03-30 19:20:10'),
(1021, '20220330194441', 4, 1, 0, 30000, 'pcs', NULL, '', '2022-03-30 19:44:41'),
(1022, '20220330210153', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-03-30 21:01:53'),
(1023, '20220330212620', 119, 1, 0, 5000, 'lembar', NULL, '', '2022-03-30 21:26:20'),
(1024, '20220330230101', 197, 1, 0, 15000, '', NULL, '', '2022-03-30 23:01:02'),
(1025, '20220330230704', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-03-30 23:07:04'),
(1026, '20220331011026', 47, 1, 0, 12000, 'pcs', NULL, '', '2022-03-31 01:10:26'),
(1027, '20220331024928', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-03-31 02:49:28'),
(1028, '20220331025649', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-03-31 02:56:49'),
(1029, '20220331030704', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-03-31 03:07:04'),
(1030, '20220331031257', 205, 1, 0, 90000, '', NULL, '', '2022-03-31 03:12:57'),
(1031, '20220331034213', 187, 1, 0, 8000, '', NULL, '', '2022-03-31 03:42:13'),
(1032, '20220331034944', 193, 1, 0, 35000, 'buah', NULL, '', '2022-03-31 03:49:44'),
(1033, '20220331034955', 198, 1, 0, 35000, '', NULL, '', '2022-03-31 03:49:55'),
(1034, '20220331035142', 54, 1, 0, 10000, 'lbr', NULL, '', '2022-03-31 03:51:42'),
(1035, '20220331041216', 44, 1, 0, 10000, 'pcs', NULL, '', '2022-03-31 04:12:16'),
(1036, '20220331042308', 53, 1, 0, 10000, 'lbr', NULL, '', '2022-03-31 04:23:08'),
(1037, '20220331042512', 228, 1, 0, 25000, '1', NULL, '', '2022-03-31 04:25:12'),
(1038, '20220331065402', 213, 1, 0, 130000, 'btl', NULL, '', '2022-03-31 06:54:02'),
(1039, '20220331073222', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-03-31 07:32:22'),
(1040, '20220331080458', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-03-31 08:04:58'),
(1041, '20220331082929', 140, 1, 0, 60000, 'btl', NULL, '', '2022-03-31 08:29:29'),
(1042, '20220331113136', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-03-31 11:31:36'),
(1043, '20220331115232', 193, 1, 0, 35000, 'buah', NULL, '', '2022-03-31 11:52:32'),
(1044, '20220331125346', 52, 1, 0, 10000, 'lbr', NULL, '', '2022-03-31 12:53:46'),
(1045, '20220331151550', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-03-31 15:15:50'),
(1046, '20220331153835', 50, 1, 0, 10000, 'pcs', NULL, '', '2022-03-31 15:38:35'),
(1047, '20220331163808', 76, 1, 0, 100, 'lbr', NULL, '', '2022-03-31 16:38:08'),
(1048, '20220331172111', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-03-31 17:21:11'),
(1049, '20220331181430', 173, 1, 0, 180000, '', NULL, '', '2022-03-31 18:14:30'),
(1050, '20220331212116', 47, 1, 0, 12000, 'pcs', NULL, '', '2022-03-31 21:21:16'),
(1051, '20220331225445', 53, 1, 0, 10000, 'lbr', NULL, '', '2022-03-31 22:54:45'),
(1052, '20220331233904', 75, 1, 0, 100, 'lbr', NULL, '', '2022-03-31 23:39:04'),
(1053, '20220401005329', 52, 1, 0, 10000, 'lbr', NULL, '', '2022-04-01 00:53:29'),
(1054, '20220401010855', 48, 1, 0, 15000, 'pcs', NULL, '', '2022-04-01 01:08:55'),
(1055, '20220401015236', 60, 1, 0, 20000, 'lbr', NULL, '', '2022-04-01 01:52:36'),
(1056, '20220401034304', 216, 1, 0, 30000, '', NULL, '', '2022-04-01 03:43:04'),
(1057, '20220401061304', 149, 1, 0, 35000, 'Jerigen', NULL, '', '2022-04-01 06:13:04'),
(1058, '20220401062848', 182, 1, 0, 15000, '', NULL, '', '2022-04-01 06:28:48'),
(1059, '20220401073159', 161, 1, 0, 60000, 'btl', NULL, '', '2022-04-01 07:31:59'),
(1060, '20220401074534', 207, 1, 0, 150000, '', NULL, '', '2022-04-01 07:45:34'),
(1061, '20220401084400', 2, 1, 0, 15000, 'pcs', NULL, '', '2022-04-01 08:44:00'),
(1062, '20220401090030', 135, 1, 0, 45000, 'pcs', NULL, '', '2022-04-01 09:00:30'),
(1063, '20220401101049', 23, 1, 0, 20000, 'pcs', NULL, '', '2022-04-01 10:10:49'),
(1064, '20220401105646', 160, 1, 0, 50000, 'pcs', NULL, '', '2022-04-01 10:56:46'),
(1065, '20220401122236', 177, 1, 0, 500000, 'buah', NULL, '', '2022-04-01 12:22:36'),
(1066, '20220401122612', 18, 1, 0, 15000, 'pcs', NULL, '', '2022-04-01 12:26:12'),
(1067, '20220401145203', 210, 1, 0, 60000, 'btl', NULL, '', '2022-04-01 14:52:03'),
(1068, '20220401171727', 41, 1, 0, 60000, 'btl', NULL, '', '2022-04-01 17:17:27'),
(1069, '20220401172606', 56, 1, 0, 200000, 'lbr', NULL, '', '2022-04-01 17:26:06'),
(1070, '20220401183001', 213, 1, 0, 130000, 'btl', NULL, '', '2022-04-01 18:30:01'),
(1071, '20220401212930', 166, 1, 0, 17500, '', NULL, '', '2022-04-01 21:29:30'),
(1072, '20220401231846', 4, 1, 0, 30000, 'pcs', NULL, '', '2022-04-01 23:18:46'),
(1073, '20220402003121', 119, 1, 0, 5000, 'lembar', NULL, '', '2022-04-02 00:31:21'),
(1074, '20220402003238', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-04-02 00:32:38'),
(1075, '20220402021659', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-04-02 02:16:59'),
(1076, '20220402024456', 197, 1, 0, 15000, '', NULL, '', '2022-04-02 02:44:56'),
(1077, '20220402053217', 208, 1, 0, 300000, '', NULL, '', '2022-04-02 05:32:17'),
(1078, '20220402055328', 25, 1, 0, 3000, 'pcs', NULL, '', '2022-04-02 05:53:28'),
(1079, '20220402062308', 205, 1, 0, 90000, '', NULL, '', '2022-04-02 06:23:08'),
(1080, '20220402075219', 228, 1, 0, 25000, '1', NULL, '', '2022-04-02 07:52:19'),
(1081, '20220402111746', 140, 1, 0, 60000, 'btl', NULL, '', '2022-04-02 11:17:46'),
(1082, '20220402122616', 206, 1, 0, 100000, '', NULL, '', '2022-04-02 12:26:16'),
(1083, '20220402122820', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-04-02 12:28:20'),
(1084, '20220402135339', 188, 1, 0, 10000, '', NULL, '', '2022-04-02 13:53:39'),
(1085, '20220402142751', 214, 1, 0, 30000, '', NULL, '', '2022-04-02 14:27:51'),
(1086, '20220402152844', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-04-02 15:28:44'),
(1087, '20220402174129', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-04-02 17:41:29'),
(1088, '20220402182448', 10, 1, 0, 15000, 'pcs', NULL, '', '2022-04-02 18:24:48'),
(1089, '20220402201428', 76, 1, 0, 100, 'lbr', NULL, '', '2022-04-02 20:14:28'),
(1090, '20220402220542', 218, 1, 0, 15000, '', NULL, '', '2022-04-02 22:05:42'),
(1091, '20220402224928', 77, 1, 0, 100, 'lbr', NULL, '', '2022-04-02 22:49:28'),
(1092, '20220403005649', 44, 1, 0, 10000, 'pcs', NULL, '', '2022-04-03 00:56:49'),
(1093, '20220403064930', 217, 1, 0, 30000, '', NULL, '', '2022-04-03 06:49:30'),
(1094, '20220403144529', 160, 1, 0, 50000, 'pcs', NULL, '', '2022-04-03 14:45:29'),
(1095, '20220403152629', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-04-03 15:26:29'),
(1096, '20220403210037', 208, 1, 0, 300000, '', NULL, '', '2022-04-03 21:00:37'),
(1097, '20220404044120', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-04-04 04:41:20'),
(1098, '20220404051522', 61, 1, 0, 100, 'lbr', NULL, '', '2022-04-04 05:15:23'),
(1099, '20220404071804', 214, 1, 0, 30000, '', NULL, '', '2022-04-04 07:18:04'),
(1100, '20220404080102', 119, 1, 0, 5000, 'lembar', NULL, '', '2022-04-04 08:01:02'),
(1101, '20220404155209', 220, 1, 0, 15000, '', NULL, '', '2022-04-04 15:52:09'),
(1102, '20220404160511', 206, 1, 0, 100000, '', NULL, '', '2022-04-04 16:05:11'),
(1103, '20220404161618', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-04-04 16:16:18'),
(1104, '20220404180752', 188, 1, 0, 10000, '', NULL, '', '2022-04-04 18:07:52'),
(1105, '20220404181807', 214, 1, 0, 30000, '', NULL, '', '2022-04-04 18:18:07'),
(1106, '20220404194214', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-04-04 19:42:14'),
(1107, '20220404200735', 66, 1, 0, 100, 'lbr', NULL, '', '2022-04-04 20:07:35'),
(1108, '20220404212303', 156, 1, 0, 13000, 'pcs', NULL, '', '2022-04-04 21:23:03'),
(1109, '20220404215104', 190, 1, 0, 150000, '', NULL, '', '2022-04-04 21:51:04'),
(1110, '20220404222354', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-04-04 22:23:54'),
(1111, '20220404230355', 192, 1, 0, 55000, 'buah', NULL, '', '2022-04-04 23:03:55'),
(1112, '20220404234411', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-04-04 23:44:11'),
(1113, '20220405022931', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-04-05 02:29:31'),
(1114, '20220405040015', 211, 1, 0, 250000, 'btl', NULL, '', '2022-04-05 04:00:15'),
(1115, '20220405041728', 16, 1, 0, 80000, 'btl', NULL, '', '2022-04-05 04:17:28'),
(1116, '20220405045832', 44, 1, 0, 10000, 'pcs', NULL, '', '2022-04-05 04:58:32'),
(1117, '20220405052916', 165, 1, 0, 17500, '', NULL, '', '2022-04-05 05:29:16'),
(1118, '20220405055435', 22, 1, 0, 10000, 'pcs', NULL, '', '2022-04-05 05:54:35'),
(1119, '20220405102449', 228, 1, 0, 25000, '1', NULL, '', '2022-04-05 10:24:49'),
(1120, '20220405105106', 217, 1, 0, 30000, '', NULL, '', '2022-04-05 10:51:06'),
(1121, '20220405140019', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-04-05 14:00:19'),
(1122, '20220405164016', 211, 1, 0, 250000, 'btl', NULL, '', '2022-04-05 16:40:16'),
(1123, '20220405192217', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-04-05 19:22:17'),
(1124, '20220405213651', 147, 1, 0, 10000, 'kg', NULL, '', '2022-04-05 21:36:51'),
(1125, '20220406013511', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-04-06 01:35:11'),
(1126, '20220406022123', 143, 1, 0, 15000, 'pcs', NULL, '', '2022-04-06 02:21:23'),
(1127, '20220406031607', 138, 1, 0, 30000, 'pcs', NULL, '', '2022-04-06 03:16:07'),
(1128, '20220406043221', 116, 1, 0, 5000, 'lembar', NULL, '', '2022-04-06 04:32:21'),
(1129, '20220406044654', 186, 1, 0, 20000, '', NULL, '', '2022-04-06 04:46:54'),
(1130, '20220406071702', 204, 1, 0, 8000, '', NULL, '', '2022-04-06 07:17:02'),
(1131, '20220406075759', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-04-06 07:57:59'),
(1132, '20220406084544', 61, 1, 0, 100, 'lbr', NULL, '', '2022-04-06 08:45:44'),
(1133, '20220406100613', 118, 1, 0, 10000, 'lembar', NULL, '', '2022-04-06 10:06:13'),
(1134, '20220406111007', 212, 1, 0, 85000, 'btl', NULL, '', '2022-04-06 11:10:07'),
(1135, '20220406111207', 161, 1, 0, 60000, 'btl', NULL, '', '2022-04-06 11:12:07'),
(1136, '20220406111225', 214, 1, 0, 30000, '', NULL, '', '2022-04-06 11:12:25'),
(1137, '20220406125236', 167, 1, 0, 17500, '', NULL, '', '2022-04-06 12:52:36'),
(1138, '20220406150240', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-04-06 15:02:40'),
(1139, '20220406150644', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-04-06 15:06:44'),
(1140, '20220406185254', 204, 1, 0, 8000, '', NULL, '', '2022-04-06 18:52:54'),
(1141, '20220406185759', 144, 1, 0, 15000, 'pcs', NULL, '', '2022-04-06 18:57:59'),
(1142, '20220406191926', 220, 1, 0, 15000, '', NULL, '', '2022-04-06 19:19:26'),
(1143, '20220406205635', 196, 1, 0, 15000, '', NULL, '', '2022-04-06 20:56:35'),
(1144, '20220406230045', 64, 1, 0, 100, 'lbr', NULL, '', '2022-04-06 23:00:45'),
(1145, '20220406233132', 66, 1, 0, 100, 'lbr', NULL, '', '2022-04-06 23:31:32'),
(1146, '20220407004411', 156, 1, 0, 13000, 'pcs', NULL, '', '2022-04-07 00:44:11'),
(1147, '20220407011813', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-04-07 01:18:13'),
(1148, '20220407021026', 190, 1, 0, 150000, '', NULL, '', '2022-04-07 02:10:26'),
(1149, '20220407021529', 192, 1, 0, 55000, 'buah', NULL, '', '2022-04-07 02:15:29'),
(1150, '20220407024659', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-04-07 02:46:59'),
(1151, '20220407035713', 119, 1, 0, 5000, 'lembar', NULL, '', '2022-04-07 03:57:13'),
(1152, '20220407040016', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-04-07 04:00:16'),
(1153, '20220407042052', 64, 1, 0, 100, 'lbr', NULL, '', '2022-04-07 04:20:52'),
(1154, '20220407044044', 163, 1, 0, 60000, 'btl', NULL, '', '2022-04-07 04:40:44'),
(1155, '20220407050712', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-04-07 05:07:12'),
(1156, '20220407054658', 70, 1, 0, 100, 'lbr', NULL, '', '2022-04-07 05:46:58'),
(1157, '20220407055014', 215, 1, 0, 30000, '', NULL, '', '2022-04-07 05:50:14'),
(1158, '20220407064137', 58, 1, 0, 20000, 'lbr', NULL, '', '2022-04-07 06:41:37'),
(1159, '20220407073654', 16, 1, 0, 80000, 'btl', NULL, '', '2022-04-07 07:36:54'),
(1160, '20220407082848', 165, 1, 0, 17500, '', NULL, '', '2022-04-07 08:28:48'),
(1161, '20220407085455', 22, 1, 0, 10000, 'pcs', NULL, '', '2022-04-07 08:54:55'),
(1162, '20220407102127', 121, 1, 0, 5000, 'lembar', NULL, '', '2022-04-07 10:21:27'),
(1163, '20220407121523', 219, 1, 0, 15000, '', NULL, '', '2022-04-07 12:15:23'),
(1164, '20220407133038', 130, 1, 0, 10000, 'lbr', NULL, '', '2022-04-07 13:30:38'),
(1165, '20220407134104', 129, 1, 0, 123, 'lbr', NULL, '', '2022-04-07 13:41:04'),
(1166, '20220407135104', 25, 1, 0, 3000, 'pcs', NULL, '', '2022-04-07 13:51:04'),
(1167, '20220407140252', 67, 1, 0, 100, 'lbr', NULL, '', '2022-04-07 14:02:52'),
(1168, '20220407140919', 228, 1, 0, 25000, '1', NULL, '', '2022-04-07 14:09:19'),
(1169, '20220407141308', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-04-07 14:13:08'),
(1170, '20220407161132', 14, 1, 0, 22000, 'pcs', NULL, '', '2022-04-07 16:11:32'),
(1171, '20220407173807', 15, 1, 0, 15000, 'pcs', NULL, '', '2022-04-07 17:38:07'),
(1172, '20220407181900', 87, 1, 0, 20000, 'lbr', NULL, '', '2022-04-07 18:19:00'),
(1173, '20220407191535', 211, 1, 0, 250000, 'btl', NULL, '', '2022-04-07 19:15:35'),
(1174, '20220407202621', 196, 1, 0, 15000, '', NULL, '', '2022-04-07 20:26:21'),
(1175, '20220407205830', 224, 1, 0, 130000, '1', NULL, '', '2022-04-07 20:58:30'),
(1176, '20220407210825', 55, 1, 0, 10000, 'lbr', NULL, '', '2022-04-07 21:08:25'),
(1177, '20220407220333', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-04-07 22:03:33'),
(1178, '20220407221127', 90, 1, 0, 30000, 'lbr', NULL, '', '2022-04-07 22:11:27'),
(1179, '20220408003651', 11, 1, 0, 25000, 'pcs', NULL, '', '2022-04-08 00:36:52'),
(1180, '20220408004122', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-04-08 00:41:22'),
(1181, '20220408012633', 22, 1, 0, 10000, 'pcs', NULL, '', '2022-04-08 01:26:33'),
(1182, '20220408030110', 155, 1, 0, 90000, 'lbr', NULL, '', '2022-04-08 03:01:10'),
(1183, '20220408031318', 177, 1, 0, 500000, 'buah', NULL, '', '2022-04-08 03:13:18'),
(1184, '20220408032029', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-04-08 03:20:29'),
(1185, '20220408041753', 134, 1, 0, 25000, 'lbr', NULL, '', '2022-04-08 04:17:53'),
(1186, '20220408063103', 19, 1, 0, 30000, 'btl', NULL, '', '2022-04-08 06:31:03'),
(1187, '20220408071757', 172, 1, 0, 20000, '', NULL, '', '2022-04-08 07:17:57'),
(1188, '20220408075522', 116, 1, 0, 5000, 'lembar', NULL, '', '2022-04-08 07:55:22'),
(1189, '20220408075951', 186, 1, 0, 20000, '', NULL, '', '2022-04-08 07:59:51'),
(1190, '20220408093813', 191, 1, 0, 10000, 'lembar', NULL, '', '2022-04-08 09:38:13'),
(1191, '20220408094721', 12, 1, 0, 5000, 'pcs', NULL, '', '2022-04-08 09:47:21'),
(1192, '20220408102012', 204, 1, 0, 8000, '', NULL, '', '2022-04-08 10:20:12'),
(1193, '20220408104246', 138, 1, 0, 30000, 'pcs', NULL, '', '2022-04-08 10:42:46'),
(1194, '20220408112343', 154, 1, 0, 10000, 'lembar', NULL, '', '2022-04-08 11:23:43'),
(1195, '20220408122029', 170, 1, 0, 25000, 'Pcs (250 gram)', NULL, '', '2022-04-08 12:20:29'),
(1196, '20220408133542', 118, 1, 0, 10000, 'lembar', NULL, '', '2022-04-08 13:35:42'),
(1197, '20220408143647', 212, 1, 0, 85000, 'btl', NULL, '', '2022-04-08 14:36:47'),
(1198, '20220408155621', 227, 1, 0, 25000, '1', NULL, '', '2022-04-08 15:56:21'),
(1199, '20220408160125', 175, 1, 0, 40000, '', NULL, '', '2022-04-08 16:01:25'),
(1200, '20220408163312', 129, 1, 0, 123, 'lbr', NULL, '', '2022-04-08 16:33:12'),
(1201, '20220408164151', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-04-08 16:41:51'),
(1202, '20220408184241', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-04-08 18:42:41'),
(1203, '20220408210844', 154, 1, 0, 10000, 'lembar', NULL, '', '2022-04-08 21:08:44'),
(1204, '20220408222155', 144, 1, 0, 15000, 'pcs', NULL, '', '2022-04-08 22:21:55'),
(1205, '20220408233516', 196, 1, 0, 15000, '', NULL, '', '2022-04-08 23:35:16'),
(1206, '20220408234749', 42, 1, 0, 60000, 'btl', NULL, '', '2022-04-08 23:47:49'),
(1207, '20220409012207', 64, 1, 0, 100, 'lbr', NULL, '', '2022-04-09 01:22:07'),
(1208, '20220409024939', 152, 1, 0, 20000, 'Botol', NULL, '', '2022-04-09 02:49:39'),
(1209, '20220409035444', 220, 1, 0, 15000, '', NULL, '', '2022-04-09 03:54:44'),
(1210, '20220409043116', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-04-09 04:31:16'),
(1211, '20220409050241', 179, 1, 0, 45000, '', NULL, '', '2022-04-09 05:02:41'),
(1212, '20220409054719', 166, 1, 0, 17500, '', NULL, '', '2022-04-09 05:47:19'),
(1213, '20220409060431', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-04-09 06:04:31'),
(1214, '20220409063127', 119, 1, 0, 5000, 'lembar', NULL, '', '2022-04-09 06:31:27'),
(1215, '20220409085132', 218, 1, 0, 15000, '', NULL, '', '2022-04-09 08:51:32'),
(1216, '20220409094806', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-04-09 09:48:06'),
(1217, '20220409115727', 116, 1, 0, 5000, 'lembar', NULL, '', '2022-04-09 11:57:27'),
(1218, '20220409130828', 229, 1, 0, 10000, 'pcs', NULL, '', '2022-04-09 13:08:28'),
(1219, '20220409151752', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-04-09 15:17:52'),
(1220, '20220409165634', 54, 1, 0, 10000, 'lbr', NULL, '', '2022-04-09 16:56:34'),
(1221, '20220409181022', 25, 1, 0, 3000, 'pcs', NULL, '', '2022-04-09 18:10:22'),
(1222, '20220409203102', 182, 1, 0, 15000, '', NULL, '', '2022-04-09 20:31:02'),
(1223, '20220409224246', 69, 1, 0, 100, 'lbr', NULL, '', '2022-04-09 22:42:46'),
(1224, '20220409230842', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-04-09 23:08:42'),
(1225, '20220410023646', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-04-10 02:36:46'),
(1226, '20220410033533', 128, 1, 0, 123, 'Batang', NULL, '', '2022-04-10 03:35:33'),
(1227, '20220410033634', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-04-10 03:36:34'),
(1228, '20220410041057', 57, 1, 0, 50000, 'lbr', NULL, '', '2022-04-10 04:10:57'),
(1229, '20220410050057', 52, 1, 0, 10000, 'lbr', NULL, '', '2022-04-10 05:00:57'),
(1230, '20220410060851', 175, 1, 0, 40000, '', NULL, '', '2022-04-10 06:08:51'),
(1231, '20220410063213', 154, 1, 0, 10000, 'lembar', NULL, '', '2022-04-10 06:32:13'),
(1232, '20220410102637', 175, 1, 0, 40000, '', NULL, '', '2022-04-10 10:26:37'),
(1233, '20220410125921', 9, 1, 0, 25000, 'pcs', NULL, '', '2022-04-10 12:59:21'),
(1234, '20220410150031', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-04-10 15:00:31'),
(1235, '20220410153502', 179, 1, 0, 45000, '', NULL, '', '2022-04-10 15:35:02'),
(1236, '20220410164759', 166, 1, 0, 17500, '', NULL, '', '2022-04-10 16:47:59'),
(1237, '20220410175017', 148, 1, 0, 200000, 'Botol', NULL, '', '2022-04-10 17:50:17'),
(1238, '20220410191132', 89, 1, 0, 30000, 'lbr', NULL, '', '2022-04-10 19:11:32'),
(1239, '20220410191636', 218, 1, 0, 15000, '', NULL, '', '2022-04-10 19:16:36'),
(1240, '20220410202634', 226, 1, 0, 1000000, 'jenis', NULL, '', '2022-04-10 20:26:34'),
(1241, '20220410205854', 86, 1, 0, 40000, 'lbr', NULL, '', '2022-04-10 20:58:54'),
(1242, '20220410222156', 206, 1, 0, 100000, '', NULL, '', '2022-04-10 22:21:56'),
(1243, '20220410225823', 116, 1, 0, 5000, 'lembar', NULL, '', '2022-04-10 22:58:23'),
(1244, '20220410230601', 177, 1, 0, 500000, 'buah', NULL, '', '2022-04-10 23:06:01'),
(1245, '20220410234422', 229, 1, 0, 10000, 'pcs', NULL, '', '2022-04-10 23:44:22'),
(1246, '20220411001635', 145, 1, 0, 10000, 'pcs', NULL, '', '2022-04-11 00:16:35'),
(1247, '20220411020209', 122, 1, 0, 5000, 'lembar', NULL, '', '2022-04-11 02:02:09'),
(1248, '20220411022416', 146, 1, 0, 10000, 'lbr', NULL, '', '2022-04-11 02:24:16'),
(1249, '20220411033818', 54, 1, 0, 10000, 'lbr', NULL, '', '2022-04-11 03:38:18'),
(1250, '20220411062349', 182, 1, 0, 15000, '', NULL, '', '2022-04-11 06:23:49'),
(1251, '20220411092329', 69, 1, 0, 100, 'lbr', NULL, '', '2022-04-11 09:23:29'),
(1252, '20220411093646', 158, 1, 0, 130000, 'btl', NULL, '', '2022-04-11 09:36:46'),
(1253, '20220411095909', 88, 1, 0, 20000, 'lbr', NULL, '', '2022-04-11 09:59:09'),
(1254, '20220411095929', 9, 1, 0, 25000, 'pcs', NULL, '', '2022-04-11 09:59:29'),
(1255, '20220411104943', 184, 1, 0, 60000, '', NULL, '', '2022-04-11 10:49:43'),
(1256, '20220411125436', 148, 1, 0, 200000, 'Botol', NULL, '', '2022-04-11 12:54:36'),
(1257, '20220411151109', 63, 1, 0, 100, 'lbr', NULL, '', '2022-04-11 15:11:09'),
(1258, '20220411152608', 229, 1, 0, 10000, 'pcs', NULL, '', '2022-04-11 15:26:08'),
(1259, '20220411164648', 52, 1, 0, 10000, 'lbr', NULL, '', '2022-04-11 16:46:48'),
(1260, '20220411220817', 173, 1, 0, 180000, '', NULL, '', '2022-04-11 22:08:17'),
(1261, '20220412001811', 223, 1, 0, 3000, 'polybag', NULL, '', '2022-04-12 00:18:11'),
(1262, '20220412012955', 73, 1, 0, 100, 'lbr', NULL, '', '2022-04-12 01:29:55'),
(1263, '20220412014903', 165, 1, 0, 17500, '', NULL, '', '2022-04-12 01:49:03'),
(1264, '20220412023705', 205, 1, 0, 90000, '', NULL, '', '2022-04-12 02:37:05'),
(1265, '20220412033935', 131, 1, 0, 10000, 'Lembar', NULL, '', '2022-04-12 03:39:35'),
(1266, '20220412050423', 120, 1, 0, 5000, 'lembar', NULL, '', '2022-04-12 05:04:23'),
(1267, '20220412050835', 49, 1, 0, 15000, 'pcs', NULL, '', '2022-04-12 05:08:35'),
(1268, '20220412053908', 217, 1, 0, 30000, '', NULL, '', '2022-04-12 05:39:08'),
(1269, '20220412060207', 55, 1, 0, 10000, 'lbr', NULL, '', '2022-04-12 06:02:07'),
(1270, '20220412061931', 227, 1, 0, 25000, '1', NULL, '', '2022-04-12 06:19:31'),
(1271, '20220412063742', 17, 1, 0, 100000, 'btl', NULL, '', '2022-04-12 06:37:42'),
(1272, '20220412073337', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-04-12 07:33:37'),
(1273, '20220412080846', 129, 1, 0, 123, 'lbr', NULL, '', '2022-04-12 08:08:46'),
(1274, '20220412083015', 178, 1, 0, 25000, 'Pack', NULL, '', '2022-04-12 08:30:15'),
(1275, '20220412085537', 123, 1, 0, 5000, 'lembar', NULL, '', '2022-04-12 08:55:37'),
(1276, '20220412090837', 222, 1, 0, 10000, 'lembar', NULL, '', '2022-04-12 09:08:37'),
(1277, '20220412102839', 120, 1, 0, 5000, 'lembar', NULL, '', '2022-04-12 10:28:39'),
(1278, '20220412122917', 143, 1, 0, 15000, 'pcs', NULL, '', '2022-04-12 12:29:17'),
(1279, '20220412142512', 169, 1, 0, 160000, 'Pcs (250 ml)', NULL, '', '2022-04-12 14:25:12'),
(1280, '20220412150056', 181, 1, 0, 25000, '', NULL, '', '2022-04-12 15:00:56'),
(1281, '20220412171040', 152, 1, 0, 20000, 'Botol', NULL, '', '2022-04-12 17:10:40'),
(1282, '20220412183741', 220, 1, 0, 15000, '', NULL, '', '2022-04-12 18:37:41'),
(1283, '20220412184835', 13, 1, 0, 25000, 'pcs', NULL, '', '2022-04-12 18:48:35'),
(1284, '20220412185234', 136, 1, 0, 25000, 'pcs', NULL, '', '2022-04-12 18:52:34'),
(1285, '20220412185427', 72, 1, 0, 100, 'lbr', NULL, '', '2022-04-12 18:54:27'),
(1286, '20220412192320', 120, 1, 0, 5000, 'lembar', NULL, '', '2022-04-12 19:23:20'),
(1287, '20220412194135', 199, 1, 0, 15000, '', NULL, '', '2022-04-12 19:41:35'),
(1288, '20220412195936', 166, 1, 0, 17500, '', NULL, '', '2022-04-12 19:59:36'),
(1289, '20220422213900', 155, 1, 0, 90000, 'lbr', NULL, '', '2022-04-22 21:39:00'),
(1290, '20220425163430', 219, 3, 0, 15000, '', NULL, '', '2022-04-25 16:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `rb_ppob_margin`
--

CREATE TABLE `rb_ppob_margin` (
  `id_ppob_margin` int(11) NOT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_ppob` int(11) NOT NULL,
  `kode_ppob` varchar(20) NOT NULL,
  `nama_ppob` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `margin` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_ppob_margin`
--

INSERT INTO `rb_ppob_margin` (`id_ppob_margin`, `id_jenis`, `id_ppob`, `kode_ppob`, `nama_ppob`, `harga`, `margin`) VALUES
(1, 1, 1, 'AX5', 'AXIS 5.000', 6073, 427),
(4, 1, 1, 'AX10', 'AXIS 10.000', 11004, 496),
(5, 1, 1, 'AX25', 'AXIS 25.000', 24934, 66),
(6, 1, 1, 'AX30', 'AXIS 30K', 30074, 426),
(11, 1, 29, 'S5', 'TELKOMSEL 5.000', 5559, 441);

-- --------------------------------------------------------

--
-- Table structure for table `rb_produk`
--

CREATE TABLE `rb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_produk_perusahaan` int(11) NOT NULL,
  `id_kategori_produk` int(11) NOT NULL,
  `id_kategori_produk_sub` int(11) NOT NULL,
  `id_reseller` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `produk_seo` varchar(255) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_reseller` int(11) NOT NULL,
  `harga_konsumen` int(11) NOT NULL,
  `berat` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tentang_produk` text NOT NULL,
  `keterangan` text NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `tag` varchar(255) NOT NULL,
  `dilihat` int(11) DEFAULT NULL,
  `minimum` int(11) DEFAULT '1',
  `fee_produk` int(11) NOT NULL DEFAULT '0',
  `pre_order` int(11) DEFAULT NULL,
  `waktu_input` datetime NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_produk`
--

INSERT INTO `rb_produk` (`id_produk`, `id_produk_perusahaan`, `id_kategori_produk`, `id_kategori_produk_sub`, `id_reseller`, `nama_produk`, `produk_seo`, `satuan`, `harga_beli`, `harga_reseller`, `harga_konsumen`, `berat`, `gambar`, `tentang_produk`, `keterangan`, `username`, `aktif`, `tag`, `dilihat`, `minimum`, `fee_produk`, `pre_order`, `waktu_input`, `url`) VALUES
(109, 0, 6, 0, 8, 'PANTAI TELUK ILALANG DAN MANGROVE', 'pantai-teluk-ilalang-dan-mangrove', 'lbr', 0, 0, 0, '0', '5f2ae646-912e-447d-b597-40e834748ece.jpg', '', '<p>Secara administratif pemerintahan, Pantai Teluk Ilalang masuk dalam wilayah desa Tanjung Pelayar Kec. Pulau Laut Tanjung Selayar dan masuk dalam kawasan Hutan Produksi. </p><p>Untuk menuju lokasi dapat ditempuh dengan jalan darat dan potensi jasa lingkungan yang dikembangkan berupa pantai dengan air yang jernih dan batu karang serta pasir putih.</p><p><img src=\"https://siforestka.co.id/asset/images/71c01448-32ff-4335-ae0f-eafb8a5f0860.jpg\" style=\"width: 100%;\"><br></p>', '8', 'Y', '', 42, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(110, 0, 6, 0, 8, 'BUKIT ILALANG', 'bukit-ilalang', 'lbr', 0, 0, 0, '0', 'WhatsApp_Image_2022-02-09_at_19_57_45.jpeg', '', '<p>Secara administratif wilayah, lokasi Bukit ilalang masuk ke dalam wilayah Desa Kulipak Kecamatan Pulau Laut Timur. Areal lokasi ini telah diusulkan untuk dikelola oleh Kelompok Tani Hutan Sinar Timur Desa Kulipak melalui Perhutanan Sosial dengan skema Kemitraan Kehutanan dengan Kesatuan Pengelolaan Hutan.</p><p>Untuk menuju lokasi aksesibiltas jalan dapat ditempuh dengan kendaraan roda 2 dan 4 dengan waktu tempuh kurleb 15 menit dari pusat desa. </p><p>Potensi jasa lingkungan yang dapat dikembangkan di lokasi ini antara lain untuk spot foto dan camping ground.</p><p><img src=\"https://siforestka.co.id/asset/foto_produk/WhatsApp_Image_2022-02-09_at_19_57_45_(1).jpeg\"><br></p><p></p><p><br></p><p><br></p><p><br></p><p><br></p>', '8', 'Y', '', 36, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(115, 0, 6, 0, 9, 'PULAU BEKANTAN', 'pulau-bekantan', 'lembar', 10000, 0, 10000, '0', 'pb13.jpeg;pb23.jpeg;pb32.jpg;pb42.jpeg;pb52.jpg', 'Harga diatas merupakan tiket masuk perorang, belum termasuk tiket asuransi, kendaraan atau mobil.', '<p>Semenjak Desember 2020, objek wisata Pulau Bekantan dikelola olehKelompok Tani Hutan (KTH) Batu Batangkup. Terdapat perubahan tujuan dalam pengelolaan Pulau Bekantan ini. Sebelumnya dikelola untuk keperluan habituasi satwa, dan saat ini diubah menjadi tujuan wisata alam.</p><p>Selain hutan wisata yang asri, di pulau ini juga terdapat jembatan yang cantik yang sering digunakan sebagai spot untuk berfoto. Pulau ini dapat dicapai menggunakan klotok dari dermaga Tiwingan dengan waktu tempuh sekitar 45 menit.</p>', '9', 'Y', '', 45, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(116, 0, 6, 0, 9, 'BUKIT BATAS', 'pulau-rusa', 'lembar', 5000, 0, 5000, '0', 'bb11.jpg;bb21.jpg;bb31.jpeg', 'Ayo berwisata kesini !!!\r\n\"Traveling adalah cara mengenal Tuhan, alam sekitar, orang lain, dan diri sendiri.\"', '<p><span style=\"font-family: &quot;Work Sans&quot;, sans-serif; font-weight: bolder; color: rgb(102, 102, 102); font-size: 14px;\">Bukit Batas</span><span style=\"color: rgb(102, 102, 102); font-family: &quot;Work Sans&quot;, sans-serif; font-size: 14px;\">&nbsp;terletak di desa Tiwingan Baru, Kecamatan Aranio, Kabupaten Banjar. Menawarkan keindahan pemandangan pulau-pulau kecil yang ada pada Waduk Riam Kanan. Untuk dapat mencapai lokasi, dari Martapura berjarak tempuh sekitar 30 km. Kemudian menaiki perahu mesin (Klotok) 30 menit dari Dermaga/Pelabuhan Riam Kanan sampai di Kaki Bukit Batas, dilanjutkan dengan berjalan kaki dari Kaki Bukit Batas sampai ke Puncak Bukit Batas selama 60 menit,&nbsp;kalau tidak kuat jalan kaki, bisa naik ojek keatas (harga nego), atau pencinta sepeda yang suka tantangan bisa membawa sepeda pribadi.</span><br></p>', '9', 'Y', '', 44, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(117, 0, 6, 0, 9, 'MATANG KALADAN', 'desa-wisata-belangian', 'lembar', 5000, 0, 5000, '0', 'mk12.jpeg;mk22.jpg;mk32.jpg;mk42.jpg;mk52.jpg;mk72.jpg;mk62.jpg', 'Ayo berwisata kesini !!!\r\n\"Traveling adalah cara mengenal Tuhan, alam sekitar, orang lain, dan diri sendiri.\"', '<p style=\"margin-bottom: 25px; font-size: 14px; line-height: 1.8em;\"><b>Matang Kaladan</b> mulai dikenal dan ramai dikunjungi para pelancong sejak tahun 2015 lalu, setelah foto pemandangan yang sekilas mirip Raja Ampat ini viral di media sosial.&nbsp;<span work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\" style=\"color: rgb(102, 102, 102);\">Tidak hanya menyajikan keindahan panorama pemandangan dari ketinggian saja, perjalanan untuk mencapai puncak Matang Kaladan juga sangat menantang pendaki.&nbsp;</span><span style=\"color: rgb(102, 102, 102); font-family: &quot;Work Sans&quot;, sans-serif; font-size: 14px;\">Jika berangkat dari Kota Martapura, Ibukota Kabupaten Banjar, wisatawan harus menempuh perjalanan darat sekitar 30 menit menuju dermaga Desa Tiwingan Lama.&nbsp;</span><span work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\" style=\"color: rgb(102, 102, 102); font-family: &quot;Work Sans&quot;, sans-serif; font-size: 14px;\">Akses jalan ke sana, saat ini sudah beraspal mulus dan jalurnya besar. Hal tersebut kian memudahkan wisatawan yang datang menggunakan mobil atau sepeda motor untuk bisa tiba ke dermaga Desa Tiwingan Lama di lokasi Waduk PLTA Riam Kanan.</span></p><p style=\"margin-bottom: 25px; font-size: 14px; line-height: 1.8em;\"><span work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\" style=\"color: rgb(102, 102, 102);\">Selama mendaki dengan menapaki ribuan anak tangga dengan waktu tempuh sekitar 30 menit, wisatawan sudah disajikan pemandangan menakjubkan seperti dapat menyaksikan aktivitas ilir mudik perahu motor yang menjadi alat transportasi utama warga sekitar dalam mengarungi Waduk Riam Kanan.&nbsp;</span><span work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\" style=\"color: rgb(102, 102, 102);\">Ditambah lagi keberadaan keramba apung yang berjejer di atas waduk tersebut, tempat para penduduk setempat menggantungkan hidupnya menjadi petambak ikan air tawar jenis ikan mas dan nila.&nbsp;</span><span style=\"color: rgb(102, 102, 102); font-family: &quot;Work Sans&quot;, sans-serif; font-size: 14px;\">Namun, bagi wisatawan yang malas mendaki anak tangga, di sana juga sudah disiapkan ojek motor. Cukup merogoh kocek Rp 20.000, ojek motor siap mengantar pendatang mencapai puncak Matang Kaladan, tanpa harus merasakan lelah dan meneteskan keringat.</span></p>', '9', 'Y', '', 55, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(118, 0, 6, 0, 9, 'DESA WISATA BELANGIAN', 'mandi-angin', 'lembar', 10000, 0, 10000, '0', '1_v21.jpg;blg11.jpg', 'Ayo berwisata kesini !!!\r\n\"Traveling adalah cara mengenal Tuhan, alam sekitar, orang lain, dan diri sendiri.\"\r\n\r\nHarga diatas merupakan tiket masuk perorang, belum termasuk tiket asuransi.', '<p style=\"margin-bottom: 25px; font-size: 14px; line-height: 1.8em;\"><span style=\"font-family: &quot;Work Sans&quot;, sans-serif; font-weight: bolder;\">Desa Wisata Belangian</span>&nbsp;merupakan sebuah desa yang berada dibagian paling ujung waduk riam kanan, perjalanan menuju Desa Wisata Belangian merupakan sebuah petualangan yang mengasikkan, diawali dengan menggunakan kendaraan menuju Waduk Riam Kanan, bendungan terbesar di Kalimantan&nbsp; Selatan yang memakan waktu sekitar 45 menit dari Banjarbaru. Perjalanan Kemudian akan dilanjutkan dengan menggunakan perahu (Kelotok), 2 jam perjalanan membelah air waduk takkan terasa, sebab selama perjalanan itu mata kita akan dimanjakan dengan deretan pegunungan Meratus nan indah biru menjulang beratapkan awan putih bersih dengan pulau-pulau kecil ditengah waduk / danau Riam Kanan.&nbsp;</p><p style=\"margin-bottom: 25px; font-size: 14px; line-height: 1.8em;\">Desa Belangian adalah salah satu dari 12 desa yang berada di Kecamatan Aranio. Luas Desa Belangian ±21,24 km2 yang terdiri dari hamparan hijau dan perbukitan seluas ±1800 ha. Selebihnya adalah hutan lebat yang didalamnya terdapat bermacam-macam jenis kayu dan binatang-binatang liar. Sungai yang membelah Desa Belangian adalah Sungai Kalaan yang berhulu dibawah Gunung Kahung.</p><p style=\"margin-bottom: 25px; font-size: 14px; line-height: 1.8em;\">Nama Belangian diambil dari sebuah telaga/teluk yaitu Teluk Belangian. Kata Belangian berasal dari bahasa Dayak Hulu atau pedalaman yang terdiri dari dua suku kata yaitu “Balai” dan “Ngian”. Balai adalah suatu tempat untuk pertemuan atau tempat untuk mengadakan suatu upacara adat. Ngian artinya makhluk halus atau orang-orang gaib. Jadi Belangian berarti tempat pertemuan untuk mengadakan upacara adat bagi orang halus/gaib</p>', '9', 'Y', '', 59, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(119, 0, 6, 0, 9, 'MANDIN MALINAU', 'mandin-malinau', 'lembar', 5000, 0, 5000, '0', 'mln1.jpeg;mln2.jpeg', 'Ayo berwisata kesini !!!\r\n\"Traveling adalah cara mengenal Tuhan, alam sekitar, orang lain, dan diri sendiri.\"', '<p><b>Mandin Malinau</b> berada di Desa Rantau Bujur, Kecamatan Aranio, Kabupaten Banjar dan dikelola oleh Kelompok Sadar Wisata (Pokdarwis) Desa Rantau Bujur. <span style=\"color: rgb(102, 102, 102); font-family: \" work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\">Beberapa fasilitas pendukung telah dibangun di dalamnya, seperti mushalla, toilet, dan rumah jaga.  </span><span style=\"color: rgb(102, 102, 102); font-family: \"Work Sans\", sans-serif; font-size: 1.4rem;\">Lokasinya memang relatif cukup jauh dari ibukota Kabupaten Banjar yaitu Martapura, namun letaknya sangat strategis berada di pinggir jalan raya bebas hambatan yang saat ini masih dalam proses pembangunan yaitu jalan bebas hambatan yang menghubungkan kota Banjarbaru - Batulicin.</span></p><p>Arus air Mandin Malinau cukup deras dan suasananya sangat sejuk karena terlindung oleh pepohonan hutan sekitar sungai. Airnya yang dingin segar membuat suasana menjadi lebih nyaman. Kondisi alam yang masih sangat asri ini, sangat tepat sebagai tempat wisata alternatif di masa pandemi ini.</p>', '9', 'Y', '', 47, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(120, 0, 6, 0, 9, 'AIR TERJUN JANDA BERANAK TIGA', 'mandin-mihak', 'lembar', 5000, 0, 5000, '', 'jb5.jpg;jb6.jpg;jb4.jpeg;jb3.jpg;jb1.jpeg', 'Ayo berwisata kesini !!!\r\n\"Traveling adalah cara mengenal Tuhan, alam sekitar, orang lain, dan diri sendiri.\"', '<p><b>Air Terjun Janda Beranak Tiga</b> berada di Desa Kiram Kec. Karang Intan Kab. Banjar. Potensi andalan dikawasan ini terdiri dari Camping Ground, Hikking dan Air Terjun (riam).&nbsp;<span style=\"color: rgb(102, 102, 102); font-family: &quot;Work Sans&quot;, sans-serif; font-size: 1.4rem;\">Objek Wisata Janda Beranak 3 saat ini sudah memiliki sarana prasarana pendukung, seperti Gazebo, Toilet, Musholla dan Warung Wisata.</span></p><p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Work Sans&quot;, sans-serif; font-size: 1.4rem;\">Akses jalan menuju objek wisata air terjun Janda Beranak 3 berjarak sekitar 2 km dengan kondisi jalan berbatu dan terdapat 2 buah jembatan darurat dapat di lewati dengan kendaraan roda dua maupun roda empat.</span><br></p>', '9', 'Y', '', 40, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(121, 0, 6, 0, 9, 'PUNCAK PALAWANGAN', 'air-terjun-sungai-karuh ', 'lembar', 5000, 0, 5000, '0', 'pw2.jpg;pw1.jpg;pw4.jpg;pw3.jpg', 'Ayo berwisata kesini !!!\r\n\"Traveling adalah cara mengenal Tuhan, alam sekitar, orang lain, dan diri sendiri.\"', '<p><b>Puncak Palawangan</b> terletak di Desa Awang Bangkal Timur Kecamatan Karang Intan Kabupaten Banjar. Potensi andalan dikawasan ini terdiri dari Camping Ground, Track Sepeda Gunung dan Jalur Hikking.<br></p>', '9', 'Y', '', 56, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(122, 0, 6, 0, 9, 'DESA WISATA PA&#039;AU', 'riam-lima ', 'lembar', 5000, 0, 5000, '0', '31.jpg;2.jpeg;5.jpeg;41.jpeg;1.jpeg', 'Ayo berwisata kesini !!!\r\n\"Traveling adalah cara mengenal Tuhan, alam sekitar, orang lain, dan diri sendiri.\"', '<p>Desa Paau terletak di Kecamatan Aranio ini hanya dihuni 600 jiwa penduduk dengan 172 keluarga. Dinas Kebudayaan dan Pariwisata Kabupaten Banjar telah menetapkan Desa Paau sebagai salah satu destinasi wisata di Kabupaten Banjar. Dengan menggunakan perahu motor dari Dermaga Tiwingan Lama, desa ini dapat dicapai kurang lebih dua jam. Objek wisata di desa ini di kelola oleh Pokdarwis Penyaluhan Indah yang dipunggawai oleh Aspiani Alpawi. Desa ini menyimpan banyak misteri, mitos dan legenda yang hidup di tengah masyarakat setempat. Salah satunya adalah legenda Batu Balian. Batu Balian berupa gugusan bebatuan yang berada di tengah aliran sungai Tuyub.<br></p>', '9', 'Y', '', 59, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(123, 0, 6, 0, 9, 'PUNCAK BUKIT ARTA', 'batu-balian-dan-air-terjun-panyaluhan ', 'lembar', 5000, 0, 5000, '0', 'pba1.jpg;pba2.jpeg;pba3.jpeg;pba4.jpg', 'Ayo berwisata kesini !!!\r\n\"Traveling adalah cara mengenal Tuhan, alam sekitar, orang lain, dan diri sendiri.\"', '<p>Obyek Wisata <b>Puncak Bukit Arta</b> yang terletak di Desa Aranio, Kecamatan Aranio, Kabupaten Banjar, Kalimantan Selatan, bisa dijadikan referensi untuk menikmati akhir pekan. Untuk menuju Puncak Arta yang dikelola oleh Pokdarwis Gunung Tinggi ini, bisa ditempuh memakai kendaraan roda dua maupun roda empat. Akan tetapi khusus roda empat, pengunjung harus memakai jasa ojek dengan biaya 30 ribu untuk pulang pergi sampai ke tempat tujuan.</p><p>Meski bisa menggunakan roda dua untuk sampai ke tempat tujuan, sensasi mendaki tetap bisa dirasakan oleh para pengunjung sambil menikmati panorama alam maupun pegunungan. Rute yang menanjak sepanjang 200 m harus dilalui untuk bisa sampai ke puncak Arta. Sehingga pengunjung harus mepersiapkan fisik untuk melaluinya. Setelah melewati jalan menanjak, rasa lelah wisatawan akan terbayarkan dengan sejuknya udara di puncak Arta tersebut. Dari puncak bukit ini, kita dapat melihat Pegunungan Meratus dan Waduk Riam Kanan.<br></p>', '9', 'Y', '', 75, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(97, 0, 6, 26, 6, 'TUMAMPANG RAYA', 'tumampang-raya', 'lbr', 100, 0, 0, '0', 'tumampang_raya.jpg', '', '', '6', 'Y', '', 46, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(98, 0, 6, 0, 6, 'AIR GUNUNG KUKUSAN', 'air-gunung-kukusan', '', 100, 0, 0, '0', '', '', '', '6', 'Y', '', 25, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(99, 0, 6, 16, 6, 'AIR TERJUN BARUNA', 'air-terjun-baruna', '', 100, 0, 0, '0', '', '', '', '6', 'Y', '', 57, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(100, 0, 6, 0, 7, 'AIR TERJUN RIAM TINGGI-MARIH', 'air-terjun-riam-tinggi-marih', 'lbr', 100, 0, 100, '0', '', '', '', '7', 'Y', '', 43, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(101, 0, 6, 0, 7, 'AIR TERJUN NAPU', 'air-terjun-napu', 'lbr', 100, 0, 100, '0', '', '', '', '7', 'Y', '', 38, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(102, 0, 6, 0, 7, 'AIR TERJUN PARAPAHING', 'air-terjun-parapahing', 'lbr', 100, 0, 100, '0', '', '', '', '7', 'Y', '', 37, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(103, 0, 6, 0, 7, 'GOA BATU BATULIS', 'goa-batu-batulis', 'lbr', 100, 0, 100, '0', '', '', '', '7', 'Y', '', 34, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(104, 0, 6, 0, 7, 'GOA LIAH KAMBING GOA TELUK PAK KASIM', 'goa-liah-kambing-goa-teluk-pak-kasim', 'lbr', 100, 0, 100, '0', '', '', '', '7', 'Y', '', 34, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(105, 0, 6, 0, 7, 'AIR TERJUN MANDIN MARANGSAI', 'air-erjun-mandin-marangsai', 'lbr', 100, 0, 100, '0', '', '', '', '7', 'Y', '', 41, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(106, 0, 6, 0, 8, 'GUNUNG MAMAKE DAN GUNUNG BAPAKE', 'gunung-mamake-dan-gunung-bapake', 'lbr', 5000, 0, 5000, '0', 'objek-wisata-baru-gunung-mamake-kotabaru.jpg', '', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\">Lokasi Gunung Mamake berjarak tidak terlalu jauh dari pusat kota Kabupaten Kotabaru dan dapat ditempuh sekitar 30 menit dengan menggunakan mobil maupun sepeda motor.&nbsp;</span></p><p><span style=\"color: rgb(102, 102, 102); font-family: \" work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\">Pesonanya perpaduan panorama pegunungan dan lautan lepas. Bukit yang diselimuti ilalang itu kelihatan asri. Pada sisi selatan Mamake, Gunung Sebatung nampak berdiri kokoh.&nbsp;</span></p><p><span style=\"color: rgb(102, 102, 102); font-family: \" work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\">Dengan adanya Peraturan Desa Sarang Tiung Nomor 07 Tahun 2021 tentang Retribusi Tempat Wisata Alam tanggal 12 Nopember 2021 maka secara resmi Gunung Mamake dan Bapake telah dikelola oleh Pengelola Wisata Alam dalam hal ini KUPS Jasling Gapoktan Mutiara Sarang Tiung bekerja sama dengan Pemerintah Desa.</span></p><p><span style=\"color: rgb(102, 102, 102); font-family: \" work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\">Fasilitas Wisata Alam yang terdapat di Gunung Mamake antara lain Camping Ground, Tenda, Hammock, Spot Foto yang menarik. Untuk retribusinya diluar dari tarif masuk.</span></p><p><img src=\"https://siforestka.co.id/asset/images/037e9fd1-9134-4236-a8e3-fe1ccd71b041.jpg\" style=\"width: 486px;\"><span style=\"color: rgb(102, 102, 102); font-family: \" work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\"><br></span></p><p><span style=\"color: rgb(102, 102, 102); font-family: \" work=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 1.4rem;\"=\"\"><br></span></p><p><img src=\"https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1572183841/fnkt6xc01ewqf2kwvbi0.jpg\" alt=\"Mendaki Puncak Gunung Mamake, Calon Objek Wisata Paralayang di Kalsel (2)\"></p><p><br></p><p><img src=\"https://siforestka.co.id/asset/images/8c8ac2a2-612c-4a03-8450-8f030506c9b6.jpg\" style=\"width: 486px;\"></p><p><img src=\"https://siforestka.co.id/asset/images/5474b457-44d9-4dca-98cd-da0a25dc0b83.jpg\" style=\"width: 486px;\"></p><p><img src=\"https://siforestka.co.id/asset/images/fd37411b-21c2-4c74-ab10-61f6c16700fb.jpg\" style=\"width: 486px;\"><br></p>', '8', 'Y', '', 59, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(107, 0, 6, 0, 8, 'PANTAI BELAMBUS', 'pantai-balambus', 'lbr', 0, 0, 0, '0', 'pantaibalambus.jpg', '', '<p>Secara administatif pemerintahan, Pantai Belambus masuk ke dalam wilayah desa Belambus Kec. Pulau Laut Sebuku. Lokasi ini merupakan bagian dari usulan Perhutanan Sosial dengan skema Hutan Desa oleh Lembaga Pengelola Hutan Desa. </p><p>Untuk menuju lokasi dapat ditempuh dengan jalan darat dan laut dengan waktu tempuh kurleb 4 jam. </p><p>Potensi jasa lingkungan yang dikembangkan berupa pantai dengan air yang jernih dan batu karang.</p>', '8', 'Y', '', 44, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(108, 0, 6, 0, 8, 'GUNUNG JAMBANGAN', 'gunung-jambangan', 'lbr', 0, 0, 0, '0', 'bukit_jambangan.jpg', '', '<p>Secara administratif pemerintahan, lokasi Gunung Jambangan berada di desa Sungai Pasir Kecamatan Pulau Laut Tengah. Lokasi ini telah diusulkan menjadi areal Perhutanan Sosial oleh kelompok masyarakat setempat.&nbsp;</p><p>Potensi sumber daya masyarakat yang cukup baik di bidang budidaya tanaman, dimana pada kawasan ini merupakan penghasil buah-buahan seperti Durian, Cempedak, Langsat, Rambutan dan lain-lain dan dapat dimanfaatkan sebagai kawasan wisata agro yang dapat menarik wisatawan.</p><p><img src=\"https://siforestka.co.id/asset/images/1adb452d-d175-4f23-8391-b8608ce8249e.jpg\" style=\"width: 100%;\"></p><p><img src=\"https://siforestka.co.id/asset/images/341f54c4-f25f-4779-9d07-8845c735c623.jpg\" style=\"width: 486px;\"><br></p><p><br></p>', '8', 'Y', '', 44, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(81, 0, 6, 0, 4, 'AIR TERJUN MANDIN PILUNG', 'air-terjun-mandin-pilung', 'lbr', 0, 0, 0, '0', '', '', '', '4', 'Y', '', 36, 1, 0, NULL, '0000-00-00 00:00:00', 'https://goo.gl/maps/9z1x1p4G4oz32Sx96'),
(82, 0, 6, 0, 4, 'ARUNG JERAM RIAM BARI', 'arung-jeram-riam-bari', 'lbr', 0, 0, 0, '0', '', '', '', '4', 'Y', '', 40, 1, 0, NULL, '0000-00-00 00:00:00', 'https://goo.gl/maps/qS5P7gFZHdFXEucR7'),
(83, 0, 6, 0, 4, 'MANDIN MARANA', 'mandin-marana', 'lbr', 0, 0, 0, '0', '', '', '', '4', 'Y', '', 35, 1, 0, NULL, '0000-00-00 00:00:00', 'https://goo.gl/maps/ix3KRo9RENpohSxM8'),
(84, 0, 6, 0, 4, 'MANDIN WARAI', 'mandin-warai', 'lbr', 0, 0, 0, '0', '', '', '', '4', 'Y', '', 35, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(224, 0, 2, 0, 62, 'MADU ASLI MERATUS', 'madu-asli-meratus', '1', 0, 0, 130000, '600', 'madu1.jpg;madu.jpg', '', '<p>Madu pegunungan meratus adalah madu asli dari kalimantan yang langsung di ambil dari hasil hutan kalimantan ,madu meratus banyak memiliki manfaat bagi kesehatan contoh; meredakan batuk, demam, menurunkan tekanan darah dan masih banyak lagi manfaat yang terdapat dari madu asli dari pegunungan meratus.</p><p><br></p>', '62', 'Y', '', 62, 1, 0, 2, '2022-02-24 11:50:38', ''),
(225, 0, 2, 0, 5, 'KOPI UJUNG BATU', 'kopi-ujung-batu-112109', 'btl', 15000, 0, 15000, '100', 'kopi_ujung_batu.png', 'Kopi Ujung Batu adalah kopi yang diproduksi dari jenis Kopi Robusta , Kopi Robusta merupakan keturunan beberapa spesies kopi, terutama Coffea canephora. ', '<p class=\"MsoNoSpacing\"><b><span style=\"font-size:14.0pt;mso-bidi-font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Indonesia\r\nMerupakan Salah Satu Produsen Terbesar Kopi Robusta<o:p></o:p></span></b></p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span style=\"mso-bidi-font-size:13.5pt;\r\nfont-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:#222222\">Seperti yang dilaporkan Kementerian Perdagangan RI, Indonesia\r\nsaat ini menempati posisi ke-4 negara produsen Robusta setelah Brazil, Vietnam,\r\ndan juga Kolombia. Mengingat terdapat jutaan penikmat Robusta di seluruh dunia,\r\nposisi ini pun patut diacungi jempol.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span style=\"mso-bidi-font-size:13.5pt;\r\nfont-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:#222222\">Eits, tapi, bukan cuma itu. Produksi biji Robusta ini ternyata\r\njuga memiliki andil besar dalam membuat Indonesia jadi salah satu negara\r\neksportir biji kopi terbesar di dunia, yaitu pada posisi 13. Pada tahun\r\n2018–2019 aja, Indonesia berhasil memproduksi 10,6 juta karung biji kopi\r\n(berukuran 60 kg) dan sekitar 9,4 juta dari angka tersebut adalah kopi robusta.\r\nMenakjubkan, bukan?<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span style=\"mso-bidi-font-size:13.5pt;\r\nfont-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:#222222\">Nah, itulah tadi beberapa fakta menarik seputar kopi robusta\r\nyang wajib buat kamu ketahui. Sekarang, kamu tau, kan, kenapa kopi ini digemari\r\nbanyak banget pencinta kopi di seluruh dunia? Robusta adalah jenis kopi yang\r\nberkualitas dan mudah banget diproduksi.<o:p></o:p></span></p><p class=\"MsoNoSpacing\"><b><span style=\"font-size:14.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\">Biji Robusta Gampang\r\nTumbuh di Dataran Rendah<o:p></o:p></span></b></p><p style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; box-sizing: inherit; margin: 1.25rem; text-rendering: optimizelegibility; line-height: 1.75rem;\"><span style=\"font-size:11.0pt;mso-bidi-font-size:13.5pt;\r\nfont-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#222222\">Dataran rendah dengan\r\nketinggian 100-800 meter di atas permukaan laut merupakan lingkungan yang tepat\r\nbuat biji kopi Robusta tumbuh. Nah, kebetulan, Indonesia punya banyak dataran\r\nrendah seperti ini. Jadi nggak heran kalau beberapa kebun di Indonesia, seperti\r\ndi Provinsi Lampung dan Sumatera Selatan, mampu menghasilkan biji Robusta dalam\r\njumlah yang banyak.<o:p></o:p></span></p><p class=\"MsoNoSpacing\"><b><span style=\"font-size:14.0pt\">Biji Robusta Mampu Tumbuh di Cuaca Lebih Panas<o:p></o:p></span></b></p><p style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; box-sizing: inherit; margin: 1.25rem; text-rendering: optimizelegibility; line-height: 1.75rem;\"><span style=\"font-size:11.0pt;mso-bidi-font-size:13.5pt;\r\nfont-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#222222\">Kopi robusta mampu beradaptasi\r\ndengan baik pada kondisi iklim yang hangat. Sementara kopi Arabica dapat tumbuh\r\nbaik pada suhu yang lebih rendah antara 18-22°C , dengan temperatur maksimal\r\ntidak melebihi 30°C.<o:p></o:p></span></p><p style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; box-sizing: inherit; margin: 1.25rem; text-rendering: optimizelegibility; line-height: 1.75rem;\"><span style=\"font-size:11.0pt;mso-bidi-font-size:13.5pt;\r\nfont-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#222222\">Ini jelas membuat perbedaan\r\nkopi Robusta dan Arabika dalam tingkat produksi jadi lebih signifikan di\r\nIndonesia. Kopi Arabika lebih bisa tumbuh di daerah yang lebih sejuk dengan\r\nsuhu 18-22° C, sedangkan daerah Indonesia bersuhu rata-rata di atas angka itu.<o:p></o:p></span></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\"><span style=\"font-size:9.0pt;mso-bidi-font-size:11.0pt;\r\nline-height:107%;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><o:p>&nbsp;</o:p></span></p>', '5', 'Y', '', 46, 1, 0, NULL, '2022-02-25 11:21:09', ''),
(226, 0, 1, 0, 5, 'KERAJINAN LIMBAH KAYU', 'kerajinan-limbah-kayu-112206', 'jenis', 500000, 0, 1000000, '', 'limbah_ulin.png;limbah_ulin-removebg-preview.png', '', '<p><font color=\"#666666\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Pemanfaatan&nbsp;</span></font><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">hutan</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">termasuk</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">pembalakan</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">liar</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">serta</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">pembukaan</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\">\r\n</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">hutan</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">untuk</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">perkebunan</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">dan</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">pertambagan pada\r\nsaat ini meninggalkan banyak sekali limbah. Limbah itu salah satunya adalah\r\n“tunggak”</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">atau akar kayu. Salah satu\r\nakar kayu yang apabila diolah akan menghasilkan nilai ekonomis tinggi adalah\r\nakar</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: -2.6pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">kayu</span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; letter-spacing: -0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt; font-family: &quot;Times New Roman&quot;;\">ulin (kayu besi).</span></p><p><span style=\"font-size:11.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Pembuatan produk dari limbah</span><span style=\"letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"font-family: &quot;Times New Roman&quot;;\">kayu ulin ini hanya dengan memotong dan\r\nmembentunya menggunakan teknologi apa adanya yaitu dengan</span><span style=\"letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"font-family: &quot;Times New Roman&quot;;\">menggunakan gergaji dan pahat. Oleh karena\r\nitu, perlu usaha penerapan teknologi mekanis dalam peningkatan</span><span style=\"letter-spacing: -2.6pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"font-family: &quot;Times New Roman&quot;;\">produksi ukiran-ukiran dan souvenir yang\r\nlebih variatif, sehingga berujung pada peningkatan pendapatan</span><span style=\"letter-spacing: 0.05pt; font-family: &quot;Times New Roman&quot;;\"> </span><span style=\"font-family: &quot;Times New Roman&quot;;\">ekonomi</span><span style=\"letter-spacing: -0.05pt; font-family: &quot;Times New Roman&quot;;\">\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">pengrajin.</span></span></p><p><span style=\"font-size:11.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Produk limbah ulin&nbsp;</span></span><span style=\"font-size:11.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">yang dihasilkan oleh kelompok ini sebenarnya\r\nmemiliki peluang yang sangat baik<span style=\"letter-spacing:.05pt\"> </span>untuk\r\npangsa pasar dalam negeri maupun luar negeri. Namun selama ini hanya dipasarkan\r\ndi pasar lokal<span style=\"letter-spacing:.05pt\"> </span>dan<span style=\"letter-spacing:.05pt\"> </span>pesanan<span style=\"letter-spacing:.05pt\">\r\n</span>dari<span style=\"letter-spacing:.05pt\"> </span>teman<span style=\"letter-spacing:.05pt\"> </span>atau<span style=\"letter-spacing:.05pt\"> </span>kerabat.<span style=\"letter-spacing:.05pt\"> </span>Sistem<span style=\"letter-spacing:.05pt\"> </span>manajemen<span style=\"letter-spacing:.05pt\"> </span>baik<span style=\"letter-spacing:.05pt\"> </span>administrasi<span style=\"letter-spacing:.05pt\"> </span>maupun<span style=\"letter-spacing:.05pt\"> </span>pemasaran\r\ndalam kelompok ini juga hanya dibuat sangat sederhana.</span></p><p><span style=\"font-size:11.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">Sehingga strategi pemasaran menggunakan SIFORESTKA ini sangat membantu para pengrajin untuk menyebar luaskan potensi yang mereka miliki. KPH Tanah Laut akan selalu memberikan<span style=\"letter-spacing:.05pt\"> </span>pembinaan<span style=\"letter-spacing:.05pt\">\r\n</span>bagi<span style=\"letter-spacing:.05pt\"> </span>kelompok<span style=\"letter-spacing:.05pt\"> </span>tersebut<span style=\"letter-spacing:.05pt\">\r\n</span>untuk<span style=\"letter-spacing:.05pt\"> </span>membantu<span style=\"letter-spacing:.05pt\"> </span>agar<span style=\"letter-spacing:.05pt\"> </span>dapat<span style=\"letter-spacing:.05pt\"> </span>berkembang<span style=\"letter-spacing:\r\n.05pt\"> </span>dan<span style=\"letter-spacing:.05pt\"> </span>mampu<span style=\"letter-spacing:.05pt\"> </span>memberikan<span style=\"letter-spacing:\r\n-.05pt\"> </span>kontribusi kepada pengembangan<span style=\"letter-spacing:-.05pt\">&nbsp;pada kelompok yang mereka miliki</span>.</span><span style=\"font-size:11.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\"><span style=\"font-family: &quot;Times New Roman&quot;;\"><br></span></span><span style=\"color: rgb(102, 102, 102); font-size: 1.4rem; text-align: justify; text-indent: 36pt;\"><br></span></p><p class=\"MsoBodyText\" style=\"margin-top:0cm;margin-right:6.35pt;margin-bottom:\r\n0cm;margin-left:26.75pt;margin-bottom:.0001pt;text-align:justify;text-indent:\r\n36.0pt\"><o:p></o:p></p><p></p>', '5', 'Y', '', 38, 1, 0, 2, '2022-02-25 11:22:06', ''),
(227, 0, 6, 26, 62, 'ARUM JERAM DESA BATUAH', 'arum-jeram-desa-batuah', '1', 0, 0, 25000, '1', 'kasi.jpg;WISATA.jpg', 'wisata arum jeram desa batuah merupakan aliran sungai yang berjeram yang mata air nya langsung turun dari pegunuggan meratus, memiliki kelebihan air yang jernih serta rintangan bebatuan yang cukup untuk memacu ardenalin', '<h5></h5><h5></h5><h4><ul><li style=\"text-align: center;\"><img src=\"https://siforestka.co.id/asset/images/air_terjun4.jpg\" style=\"width: 486px;\"> </li><li style=\"text-align: center;\">wisata arung jeram desa batuah memiliki jeram-jeram sungai yang sanggat menantang, aliran sungai yang turun langsung dari pegununggan mearatus bahkan bukan hanya bisa menikmati arung jeram nya saja tetapi mata kita akan di manjakan dengan pemandangan alam yang masih alami serta pegununggan meratus yang masih murni.</li></ul></h4>', 'admin', 'Y', '', 55, 1, 0, 2, '2022-02-25 13:06:12', 'https://maps.app.goo.gl/aBVSRx5Gr2L9D2xV9');
INSERT INTO `rb_produk` (`id_produk`, `id_produk_perusahaan`, `id_kategori_produk`, `id_kategori_produk_sub`, `id_reseller`, `nama_produk`, `produk_seo`, `satuan`, `harga_beli`, `harga_reseller`, `harga_konsumen`, `berat`, `gambar`, `tentang_produk`, `keterangan`, `username`, `aktif`, `tag`, `dilihat`, `minimum`, `fee_produk`, `pre_order`, `waktu_input`, `url`) VALUES
(87, 0, 6, 6, 5, 'GUA MARMER', 'gua-marmer', 'lbr', 15000, 0, 20000, '0', 'GOA_MARMER.png', 'Gua Marmer terletak di Desa Sungaibakar, Kecamatan Bajuin Kabupaten Tanah Laut. Gua Marmer merupakan gugusan bebatuan besar yang memiliki banyak lubang (gua) yang memiliki stalaktit didalamnya. Wisata ini mimiliki lebih dari 20 Gua yang n saling berkaitan atau tembus. Ada juga salah satu gua yang di dalamnya terdapat kolamnya. Maka hal ini sangat direkomendasikan untuk para pencinta alam.', '<p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><span style=\"color: rgb(0, 0, 0);\">Kepariwisataan di Kabupaten Tanahlaut (Tala), Kalimantan Selatan (Kalsel), sangat beragam. Selain pantai yang sejak dulu menjadi ikon, daerah agraris ini juga memiiki objek wisata alam eksotik lainnya yakni gua marmer namanya.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><img src=\"https://sisdh.kalselprov.go.id/asset/images/KKPH.jpg\" style=\"width: 464.165px; height: 260.609px;\"><span style=\"color: rgb(0, 0, 0);\"><br></span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><span style=\"color: rgb(0, 0, 0);\">Pada tahun 1980-an silam wisata ini cukup mashur seiring dengan ketenaran objek wisata Air Terjun Bajuin. Kedua wisata alam ini memang letaknya berdekatan, hanya sekitar dua kilometer. Wisata gua ternama di Tala yang cukup dikenal publik di Kalimantan Selatan yakni Gua Marmer. Lokasinya yakni di Desa Sungaibakar, Kecamatan Bajuin.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><span style=\"color: rgb(0, 0, 0);\">Kemudian sejak belasan tahun lalu, pamor Gua Marmer meredup seperti halnya Air Terjun Bajuin. Apalagi saat tambang bijih besi booming di Tala sekitar tahun 2006 silam, area sekitar gua tersebut turut terjamah aktivitas penambangan.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><span style=\"color: rgb(0, 0, 0);\">Bahkan kala itu jalan menuju ke Gua Marmer turut ditambang dan dialihkan sehingga menjadi lebih sulit menjangkaunya. Nasib wisata gua berjarak sekitar 13 kilometer dari Kota Pelaihari (ibu kota Kabupaten Tala) itu pun mati suri.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><img src=\"https://sisdh.kalselprov.go.id/asset/images/gos.PNG\" style=\"width: 453.625px; height: 273.409px;\"><span style=\"color: rgb(0, 0, 0);\"><br></span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><span style=\"color: rgb(0, 0, 0);\">KPH Tanah Laut Tala berencana mengeksplorasi kembali Gua Marmer. Upaya ini seiring mulai kembali berdetaknya pamor objek wisata Air Terjun Bajuin setelah pembenahan dan pelengkapan fasilitas fisik selesai dilakukan tahun ini yang seketika mampu menggenjot minat pengunjung.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><span style=\"color: rgb(0, 0, 0);\">Jasa angkutan ojek warga sekitar yang mangkal di Air Terjun Bajuin bisa mengantarkan pelancong yang ingin sekaligus ke Gua Marmer. “Begitu ancar-ancar konsepnya. Jadi, pelancong yang datang ke Air Terjun Bajuin sekaligus dapat pilihan mengunjungi objek wisata lainnya (Gua Marmer) dan masyarakat sekitar makin terberdayakan,\"</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><span style=\"color: rgb(0, 0, 0);\">Lebih lanjut ia mengatakan beberapa pekan lalu pihaknya telah bekerjasama dengan pihak desa untuk melakukan penjajakan lokasi Gua Marmer. Termasuk membersihkan jalan masuk dari semak belukar sehingga kini telah nyaman dituju.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><span style=\"color: rgb(0, 0, 0);\">Area Gua Semprong lumayan luas dan tinggi. Bagian tengah terbuka sehingga sinar matahari masuk leluasa. Itulah mengapa dinamakan semprong karena ada celah terbuka di bagian atas gua.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><span style=\"color: rgb(0, 0, 0);\">Gua Marmer merupakan gugusan bebatuan besar yang memiliki banyak lubang (gua). Kabarnya lebih dari 20-an gua yang ada dan saling berkaitan atau tembus. Ada juga salah satu gua yang di dalamnya terdapat kolamnya.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: \"Open Sans\", sans-serif; font-size: 14px; line-height: 1.6; max-width: 100%;\"><img src=\"https://sisdh.kalselprov.go.id/asset/images/11.PNG\" style=\"width: 467.5px; height: 263.557px;\"><span style=\"color: rgb(0, 0, 0);\"><br></span></p><div style=\"text-align: center; \"><br></div>', '5', 'Y', '', 72, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(91, 0, 6, 6, 6, 'GOA SUGUNG KM 47', 'goa-sugung-km-47', '', 100, 0, 0, '0', 'goa_sugung_km_47.png', '', '<p style=\"font-size: 14px;\"><span style=\"font-family: \"Work Sans\", sans-serif; font-weight: bolder;\">GOA SUGUNG</span></p><p style=\"font-size: 14px;\">Goa Sugung terjadi dari proses alam, teletak di km 44 jalan Kodeco Kecamatan Mantewe dengan luas sekitar 12 ha. Dari ibukota Kabupaten, Batulicin dapat ditempuh kurang lebih 1,5 jam dengan kendaraan roda 4 dan roda 2. Terbentuk dari sebuah proses yang terjadi selama ratusan tahun yang lalu sehingga terbentuk sebuah goa. Dan goa sugung ini menjadi tempat wisata rekreasi dan juga cocok buat anda yang memiliki jiwa tantangan alam dan juga kita baka bisa merasakan kesejukan angin yang berada didalam goa sugung tersebut.</p><p style=\"font-size: 14px;\"><span style=\"font-family: \"Work Sans\", sans-serif; font-weight: bolder;\">MARI BERWISATA KE OBJEK GOA SUGUNG </span></p>', '6', 'Y', '', 48, 1, 0, NULL, '0000-00-00 00:00:00', 'https://goo.gl/maps/HwBVcrHBU6u2WnC66'),
(92, 0, 6, 16, 6, 'AIR TERJUN KM 49', 'air-terjun-km-49', '', 100, 0, 0, '0', '', '', '', '6', 'Y', '', 45, 1, 0, NULL, '0000-00-00 00:00:00', 'https://goo.gl/maps/HRqJ71SG3USurgdZA'),
(96, 0, 6, 26, 6, 'SUNGAI RIAM  RANDUNG-TANDUI', 'sungai-riam -randung-tandui', '', 100, 0, 0, '0', 'df8fa328-2674-4243-bbb5-edb4ce9f03741.jpg;f7129f6c-ea4e-45a8-928f-5456ebb0f7191.jpg;6f6af218-e79e-4456-a41b-85abb70ab5431.jpg', '', '', '6', 'Y', '', 0, 1, 0, NULL, '0000-00-00 00:00:00', ''),
(68, 0, 6, 0, 3, 'AIR KILAT API', 'air-kilat-api', 'lbr', 100, 0, 100, '0', 'air terjun kilat api hulu sungai.jpg', '', '', '3', 'Y', '', 43, 1, 0, NULL, '0000-00-00 00:00:00', 'https://goo.gl/maps/4axqD1bXRGaajS6A9'),


--
--


--
--



--
--
