-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Feb 2025 pada 12.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alam-rent`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `return_proof` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `category`, `product_id`, `start_date`, `end_date`, `return_date`, `return_proof`, `created_at`, `updated_at`, `total_price`, `status`) VALUES
(30, 5, 'Sepatu', 12, '2024-06-03', '2024-06-05', NULL, NULL, '2024-06-03 05:19:54', '2024-06-03 05:20:03', 120000, 'cancelled'),
(31, 5, 'Tenda', 11, '2024-06-03', '2024-06-04', '2024-06-03', NULL, '2024-06-03 05:20:36', '2024-06-03 05:20:52', 160000, 'returned_on_time'),
(37, 4, 'Pakaian', 10, '2024-06-05', '2024-06-07', NULL, NULL, '2024-06-05 06:43:28', '2024-06-05 06:43:36', 120000, 'cancelled'),
(38, 4, 'Pakaian', 13, '2024-06-05', '2024-06-06', NULL, NULL, '2024-06-05 06:44:27', '2024-06-05 06:44:27', 100000, 'ongoing'),
(45, 7, 'Sepatu', 11, '2024-06-05', '2024-06-07', NULL, NULL, '2024-06-05 07:56:59', '2024-06-05 07:56:59', 105000, 'ongoing'),
(46, 8, 'Pakaian', 8, '2024-06-06', '2024-06-08', NULL, NULL, '2024-06-05 07:58:28', '2024-06-05 07:58:28', 120000, 'ongoing'),
(47, 9, 'Sepatu', 4, '2024-06-06', '2024-06-09', NULL, NULL, '2024-06-05 07:59:53', '2024-06-05 07:59:53', 160000, 'ongoing'),
(48, 2, 'Tenda', 9, '2024-06-06', '2024-06-10', '2024-06-10', NULL, '2024-06-05 08:00:50', '2024-06-10 11:16:28', 750000, 'returned_on_time'),
(49, 2, 'Sepatu', 8, '2024-06-12', '2024-06-14', NULL, NULL, '2024-06-10 11:21:02', '2024-06-12 14:14:37', 105000, 'cancelled'),
(59, 6, 'Ransel', 16, '2024-06-13', '2024-06-15', NULL, NULL, '2024-06-12 19:25:23', '2024-06-12 19:25:23', 150000, 'ongoing'),
(60, 2, 'Sepatu', 9, '2024-06-14', '2024-06-16', NULL, NULL, '2024-06-12 20:20:56', '2024-06-12 20:51:11', 120000, 'cancelled'),
(61, 2, 'Tenda', 4, '2024-06-14', '2024-06-15', '2024-06-19', NULL, '2024-06-12 20:50:16', '2024-06-19 01:21:20', 900000, 'returned_late'),
(62, 2, 'Ransel', 17, '2024-06-15', '2024-06-16', NULL, NULL, '2024-06-12 21:11:03', '2024-06-12 21:18:09', 100000, 'cancelled'),
(63, 2, 'Ransel', 12, '2024-06-13', '2024-06-14', '2024-06-13', NULL, '2024-06-12 21:17:35', '2024-06-12 21:18:01', 200000, 'returned_on_time'),
(64, 11, 'Ransel', 13, '2024-06-13', '2024-06-15', '2024-06-13', NULL, '2024-06-12 21:22:41', '2024-06-12 21:22:52', 240000, 'returned_late'),
(65, 11, 'Ransel', 14, '2024-06-14', '2024-06-15', NULL, NULL, '2024-06-12 21:27:16', '2024-06-12 21:27:22', 120000, 'cancelled'),
(66, 2, 'Ransel', 18, '2024-06-17', '2024-06-19', '2024-06-16', NULL, '2024-06-16 06:28:40', '2024-06-16 06:29:23', 180000, 'returned_late');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `nama`, `email`, `phone`, `pesan`, `created_at`, `updated_at`) VALUES
(12, 'Nuansa Bening', 'nuansabening2005@gmail.com', '082122324658', 'Halooo, website ini keren banget!', '2024-06-05 06:46:18', '2024-06-05 06:46:18'),
(13, 'Armelia Zahrah', 'armel@gmail.com', '085772970054', 'Halo, jika cancel apakah ada pengembalian uang?', '2024-06-05 07:54:49', '2024-06-05 07:54:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_28_114429_create_ransels_table', 1),
(6, '2024_05_28_130928_add_gambar_to_ransels_table', 1),
(7, '2024_05_29_130925_create_pakaians_table', 2),
(8, '2024_05_29_141316_create_sepatus_table', 3),
(9, '2024_05_29_143951_create_tendas_table', 4),
(10, '2024_05_29_150142_create_contacts_table', 5),
(11, '2024_05_29_160528_create_contacs_table', 6),
(12, '2024_05_29_161035_create_contacts_table', 7),
(13, '2024_05_31_155607_create_testimonis_table', 8),
(14, '2024_05_31_163009_create_testimonis_table', 9),
(15, '2024_06_02_043554_create_bookings_table', 10),
(16, '2024_06_02_052611_add_category_to_ransels_table', 11),
(17, '2024_06_02_053107_add_category_to_tendas_table', 12),
(18, '2024_06_02_053240_add_category_to_pakaians_table', 13),
(19, '2024_06_02_053347_add_category_to_sepatus_table', 14),
(20, '2024_06_02_060323_add_uang_to_bookings_table', 15),
(21, '2024_06_02_085252_create_bookings_table', 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakaians`
--

CREATE TABLE `pakaians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` text NOT NULL,
  `merk` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `denda` decimal(8,2) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pakaians`
--

INSERT INTO `pakaians` (`id`, `gambar`, `merk`, `slug`, `harga`, `denda`, `deskripsi`, `status`, `created_at`, `updated_at`, `category`) VALUES
(6, 'assets/pakaian/Df0atD6DdHNvgflK3EDN1gIwREuBxWrjVrS0mxk0.png', 'Adidas TERREX - Xploric Wind', 'adidas-terrex-xploric-wind', 40000.00, 20000.00, 'Jaket ringan untuk trek dan kegiatan di udara sejuk dan berangin. Terbuat dari katun stretch yang bernapas dan fleksibel.', 0, '2024-06-01 10:18:06', '2024-06-01 10:18:06', 'Pakaian'),
(7, 'assets/pakaian/ibm8o2Tnaph6MtXJju26RRTIMqIastglzPLhnEMT.png', 'Adidas TERREX - Xperior Pant', 'adidas-terrex-xperior-pant', 40000.00, 20000.00, 'Celana adidas yang tahan lama namun nyaman, cocok untuk perjalanan mu. Terbuat dari bahan ringan yang menawarkan elastisitas yang Anda butuhkan untuk mendaki.', 0, '2024-06-01 10:18:45', '2024-06-01 10:18:45', 'Pakaian'),
(8, 'assets/pakaian/MoPnkivPvAUdL518ikaapCZLpLiWcmovWj5EFZRP.png', 'Marmot - Retro Rocklin 1/2-Zip', 'marmot-retro-rocklin-12-zip', 40000.00, 20000.00, 'Fleece Retro Rocklin 1/2-Zip adalah pilihan yang handal dan nyaman untuk malam yang sejuk di kemah. Dengan kantong tangan dan dada berzipper memberikan ruang penyimpanan ekstra yang Anda butuhkan.', 0, '2024-06-01 10:19:26', '2024-06-01 10:19:26', 'Pakaian'),
(9, 'assets/pakaian/6i4IKY7CQtOWEJqpRUtxwOOmR4hdb6j7bHLOcUwO.png', 'Marmot - Minimalist Pro Jacket', 'marmot-minimalist-pro', 40000.00, 20000.00, 'Jaket Minimalist Pro adalah jaket sederhana dengan desain teknis yang sempurna untuk melawan cuaca buruk. Desain ringan dan mudah dilipat membuatnya sangat cocok untuk kegiatan luar ruangan.', 0, '2024-06-01 10:19:55', '2024-06-01 20:44:18', 'Pakaian'),
(10, 'assets/pakaian/olF9vHkA4Y2IHcLGx0ouZx428K0gCbILHHExWk44.png', 'Black Diamond - Alpine Pant', 'black-diamond-alpine-pant', 40000.00, 20000.00, 'Celana Alpine Pant dari Black Diamond adalah celana softshell sederhana yang cocok untuk mendaki dengan perlindungan dari hujan ringan serta material yang sangat nyaman.', 0, '2024-06-01 10:20:25', '2024-06-01 10:20:25', 'Pakaian'),
(11, 'assets/pakaian/RVMXyFwBV5VhDyjCO1FdLBB0DgxCwjWtfS8ESI8v.png', 'The North Face - Aphrodite 2.0 Pant', 'the-north-face-aphrodite-20-pant', 40000.00, 20000.00, 'Celana Women\'s Aphrodite 2.0 dari The North Face cocok untuk berbagai aktivitas seperti salah satunya hiking dengan bahan yang sangat nyaman.', 0, '2024-06-01 10:20:53', '2024-06-01 10:20:53', 'Pakaian'),
(12, 'assets/pakaian/mYdsvEDX1PwdTj65tc59pWpOBbzZQmoKEf6b0vTk.png', 'The North Face - Paramount Convertible', 'the-north-face-paramount-convertible-pant', 40000.00, 20000.00, 'Celana Paramount Convertible Pant dari The North Face siap menghadapi petualangan di berbagai medan. Terbuat dari bahan nylon yang elastis dan tahan air, serta dilengkapi dengan perlindungan dari sinar UV.', 0, '2024-06-01 10:21:26', '2024-06-01 20:43:25', 'Pakaian'),
(13, 'assets/pakaian/Z1WfwM9H3rXuCaE45oQZKr9U0bPHr84cpx83wOWK.png', 'The North Face -Summit Papsura FUTURELIGHT', 'the-north-face-summit-papsura-futurelight', 50000.00, 25000.00, 'Jaket Summit Papsura FUTURELIGHT dari The North Face memberikan perlindungan ringan dan teknologi tinggi dari cuaca. Dengan teknologi FUTURELIGHT yang tahan air dan permeabel udara, serta desain yang nyaman untuk aktivitas outdoor.', 0, '2024-06-01 10:22:13', '2024-06-01 10:22:13', 'Pakaian'),
(14, 'assets/pakaian/UoXv5BSMS0RsMfBucIbh0aWffCy5aCB54IknFtJR.png', 'Outdoor Research - Helium Down Hooded', 'outdoor-research-helium-down-hooded-jacket', 50000.00, 25000.00, 'Jaket Helium Down Hooded Jacket adalah pilihan utama kami untuk berbagai kegiatan, nyaman digunakan ketika musim dingin.', 0, '2024-06-01 10:22:46', '2024-06-01 20:43:16', 'Pakaian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ransels`
--

CREATE TABLE `ransels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` text NOT NULL,
  `merk` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `denda` decimal(8,2) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ransels`
--

INSERT INTO `ransels` (`id`, `gambar`, `merk`, `slug`, `harga`, `denda`, `deskripsi`, `status`, `created_at`, `updated_at`, `category`) VALUES
(11, 'assets/ransel/sSqP1E9jGd8pqVcAPyuUIaIIUdnkHSVvqLRfIFki.png', 'Gregory - Zulu 65L', 'gregory-zulu-65l', 70000.00, 35000.00, 'Ransel berkapasitas besar. Dilengkapi dengan ruang untuk membawa air dan kantong pinggang yang praktis untuk ponsel, camilan, dan lainnya.', 0, '2024-06-01 10:11:58', '2024-06-01 10:12:26', 'Ransel'),
(12, 'assets/ransel/rNdQ41OqZyXewOheT4RoWOuXjgM2SoheKTG5MhVb.png', 'Osprey - Atmos AG 65L', 'osprey-atmos-ag-65l', 100000.00, 50000.00, 'Ransel Osprey 65L terbaik untuk petualangan berhari-hari. Nyaman dipakai dengan suspensi Anti-Gravity, penyesuaian bahu dan sabuk pinggang yang mudah, serta kompartemen khusus untuk sleeping bag dan minum.', 0, '2024-06-01 10:13:08', '2024-06-01 10:13:08', 'Ransel'),
(13, 'assets/ransel/AJF7vJv1yrINWAtZMV61D1ylirwbpkZZrvyQcgJJ.png', 'The North Face - Terra 65L', 'the-nort-face-terra-65l', 80000.00, 40000.00, 'Ransel nyaman 65L untuk trek panjang.Akses cepat dengan J-Zip panel depan, tutup bisa mengambang. Ada kantong depan dan pinggang berzipper.', 0, '2024-06-01 10:13:41', '2024-06-01 20:47:25', 'Ransel'),
(14, 'assets/ransel/30HwV0Ti3vtuEhGr1UIEsvc7GOfqDe5z6lzHYaen.png', 'Kelty - Redwing 50L', 'kelty-redwing-50l', 60000.00, 30000.00, 'Ransel perjalanan serbaguna dengan kapasitas 50L yang cocok untuk petualanganmu. Suspensi FitPro dapat disesuaikan sepenuhnya untuk kenyamanan yang disesuaikan.', 0, '2024-06-01 10:14:27', '2024-06-01 10:14:27', 'Ransel'),
(16, 'assets/ransel/36kfiz9bJIEycJrPt59UIzbCGeX6lFRGmTsu32Y9.png', 'Mystery Ranch - Terraframe 3-Zip 50L', 'mystery-ranch-terraframe-3-zip-50l', 50000.00, 25000.00, 'Ransel kuat untuk backpacking dengan beban berat atau tidak teratur. Terbuat dari Lite Plus Cordura yang kokoh tanpa memberatkan.', 0, '2024-06-01 10:15:05', '2024-06-01 10:15:05', 'Ransel'),
(17, 'assets/ransel/KhUN9vD9pJ4MIXPRiW1cE5sfms6dEGMsG5cR3OmR.png', 'Deuter - Aircontact Ultra SL 50L', 'deuter-aircontact-ultra-sl-50l', 50000.00, 25000.00, 'Ransel ringan dengan desain minimalis cocok untuk backpacking. Kapasitas besar menawarkan banyak ruang penyimpanan untuk petualangan berhari-hari.', 0, '2024-06-01 10:15:58', '2024-06-01 10:15:58', 'Ransel'),
(18, 'assets/ransel/fO9XkqCOErccpgbfATTP4YPfgJeJAPUAkrVgeBoS.png', 'Osprey - Tempest 40L', 'osprey-tempest-40l', 60000.00, 30000.00, 'Ransel ramping dengan tali berkontur dan torso kecil untuk penyesuaian feminin. Ukuran ransel yang penting untuk perjalanan semalam dan akhir pekan panjang.', 0, '2024-06-01 10:17:05', '2024-06-01 10:17:05', 'Ransel'),
(25, 'assets/ransel/XXPRWOwSr4ghDIFFGpuLq5KidSkpmVQCRpcJmW0X.png', 'Mountainsmith - Zerk 40L', 'mountainsmith-zerk-40l', 40000.00, 20000.00, 'Ransel ringan untuk perjalanan yang lebih jauh dan cepat. Dengan kapasitas 40 liter, cocok untuk perjalanan semalam.', 0, '2024-06-05 06:51:18', '2024-06-05 06:51:18', 'Ransel'),
(26, 'assets/ransel/VE6ZKptjQHf0PQoFJ6gcYAUM6gVeHmQvHCbJeuWF.png', 'Hyperlite Mountain Gear - Ice 40L', 'hyperlite-mountain-gear-ice-40l-ransel-multi-sport-cocok-untuk-pendakian-cepat-di-pegunungan-musim-dingin-terbuat-dari-dyneema-yang-kokoh-ringan-dan-tahan-air', 50000.00, 25000.00, 'Ransel multi-sport cocok untuk pendakian cepat di pegunungan musim dingin. Terbuat dari Dyneema yang kokoh, ringan, dan tahan air.', 0, '2024-06-05 06:52:01', '2024-06-05 07:51:26', 'Ransel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sepatus`
--

CREATE TABLE `sepatus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` text NOT NULL,
  `merk` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `denda` decimal(8,2) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sepatus`
--

INSERT INTO `sepatus` (`id`, `gambar`, `merk`, `slug`, `harga`, `denda`, `deskripsi`, `status`, `created_at`, `updated_at`, `category`) VALUES
(4, 'assets/sepatu/TmGdmjU5JJ1rLvMjcXzjKUnRWbSKQNq3ODllbgzo.png', 'Adidas TERREX -  AX4 Mid GTX', 'adidas-terrex-ax4-mid-gtx', 40000.00, 20000.00, 'Sepatu hiking Adidas Terrex AX4 Mid GTX memberikan pegangan yang kokoh dan perlindungan di jalur hiking. Dilengkapi dengan lapisan GORE-TEX yang tahan air dan desain pergelangan tinggi yang mendukung.', 1, '2024-06-01 10:23:56', '2024-06-04 06:18:17', 'Sepatu'),
(5, 'assets/sepatu/VVxcTPWvJVoQDOAUkxjjdTxxnCEvxrunkNRPPIQ7.png', 'Adidas TERREX - Hyper Hiker Mid', 'adidas-terrex-hyper-hiker-mid', 40000.00, 20000.00, 'Sepatu hiking adidas TERREX Hyper Hiker Mid Boot memberikan perlindungan dan traksi yang baik untuk golongan kaum muda yang aktif di jalur hiking.', 0, '2024-06-01 10:24:35', '2024-06-01 10:24:35', 'Sepatu'),
(6, 'assets/sepatu/9rHorNiYw0DTP44c3ogpVwHnhOj9usGN6OFb2pDw.png', 'Salomon - Quest 4 GTX Backpacking', 'salomon-quest-4-gtx-backpacking', 45000.00, 20000.00, 'Saat memulai perjalanan di belantara, sepatu hiking Salomon Quest 4 GTX tidak pernah terlewatkan. Dengan dukungan Advanced Chassis yang memastikan kenyamanan dan stabilitas di segala medan.', 0, '2024-06-01 10:25:20', '2024-06-01 10:25:20', 'Sepatu'),
(7, 'assets/sepatu/kCOAQQQCSw2mQMb9bR40KceZwktVh0RyK1GlnGlb.png', 'Salomon - X Ultra 360 Edge GTX', 'salomon-x-ultra-360-edge-gtx', 40000.00, 20000.00, 'Sepatu hiking X Ultra 360 Edge GTX membantu kami mengatasi medan teknis dengan lebih proaktif. Dilengkapi dengan teknologi Advanced Chassis, busa EnergyCell yang tahan lama, dan outsole Contagrip yang menjamin langkah stabil.', 0, '2024-06-01 10:25:53', '2024-06-01 10:25:53', 'Sepatu'),
(8, 'assets/sepatu/vWE08WpTtilhyYCmL8NjrRWVJZE0GZiL0LPIvuGd.png', 'Merrel - Wildwood Mid LTR WP', 'merrel-wildwood-mid-ltr-wp', 35000.00, 15000.00, 'Sepatu hiking Merrell Wildwood Mid LTR WP menjaga kaki tetap kering dan nyaman saat menjelajahi jalur. Dibuat dari bahan kulit dan suede yang tahan lama, dengan lapisan tahan air yang menjaga kaki tetap kering.', 0, '2024-06-01 10:26:22', '2024-06-01 10:26:43', 'Sepatu'),
(9, 'assets/sepatu/Azrm96VUk9YILTsDAzcbcAWiXxbobQWIHdRfpdjU.png', 'Merrel - Moab 3 Mid Waterproof', 'merrel-moab-3-mid-waterproof', 40000.00, 20000.00, 'Sepatu hiking Moab 3 Mid Waterproof siap menghadapi segala cuaca dengan teknologi M Select Dry yang tahan air.', 0, '2024-06-01 10:27:15', '2024-06-01 10:27:15', 'Sepatu'),
(10, 'assets/sepatu/0Pa6U2nyYv1SOF95diYrQ8Pktl6270PrU7ctKepE.png', 'The North Face - Fastpack Mid', 'the-nort-face-fastpack-mid-waterproof', 40000.00, 20000.00, 'Sepatu hiking anak The North Face Fastpack Mid Waterproof menjaga kaki tetap kering dan nyaman.', 0, '2024-06-01 10:28:00', '2024-06-01 20:46:53', 'Sepatu'),
(11, 'assets/sepatu/j3KgQ59dYa1AtJnMK4N0YiUsfVbcWXjrSyibzDXH.png', 'New Balance - Fresh Foam X Hierro Mid Wide', 'new-balance-fresh-foam-x-hierro-mid-wide', 35000.00, 15000.00, 'Sepatu hiking New Balance Fresh Foam X Hierro Mid yang ringan dan nyaman, dilengkapi dengan bantalan Fresh Foam X dan sol Vibram Megagrip.', 0, '2024-06-01 10:29:11', '2024-06-01 10:29:28', 'Sepatu'),
(12, 'assets/sepatu/3aYuxCPPkrBbh8nWxnhAbGbr3nEU4rQOxCZwpkl2.png', 'Columbia - Newton Ridge BC Boot', 'columbia-newton-ridge-bc-boot', 40000.00, 20000.00, 'Sepatu hiking Columbia Newton Ridge BC dengan tampilan baru yang kasual, dilengkapi dengan Omni-SHIELD tahan air dan sol Techlite ringan.', 0, '2024-06-01 10:29:57', '2024-06-01 10:29:57', 'Sepatu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tendas`
--

CREATE TABLE `tendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` text NOT NULL,
  `merk` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `denda` decimal(8,2) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tendas`
--

INSERT INTO `tendas` (`id`, `gambar`, `merk`, `slug`, `harga`, `denda`, `deskripsi`, `status`, `created_at`, `updated_at`, `category`) VALUES
(2, 'assets/tenda/7uLDkv5L6wgQHpgmIkdutkb3WqHYlMB8qOLVyvpQ.png', 'MSR - FreeLite 3', 'msr-freelite-3-tent', 100000.00, 50000.00, 'Tenda MSR FreeLite 3 ultralight untuk 3 orang, ringan dan cepat dipasang, dengan perlindungan cuaca dan ventilasi baik.', 0, '2024-06-01 10:30:56', '2024-06-01 20:41:04', 'Tenda'),
(4, 'assets/tenda/TedyDI5nJwR2WxtDbxTsBhq2RF1OcKfF7YoxMHOz.png', 'MSR - Habiscape', 'msr-habiscape-tent', 90000.00, 45000.00, 'Tenda MSR Habiscape untuk 4 orang, nyaman dan mudah dipasang, dengan banyak kantong penyimpanan dan dua pintu besar.', 0, '2024-06-01 10:34:13', '2024-06-01 20:41:14', 'Tenda'),
(5, 'assets/tenda/pGhsWPokqd4st6DFnjxMr8q7hcEyk96bv4rHV87G.png', 'MSR - Elixir', 'msr-elixir-tent', 80000.00, 40000.00, 'Tenda MSR Elixir 3 ideal untuk 3 orang dengan skylight berbentuk bintang, ringan, dan melindungi dari elemen cuaca.', 0, '2024-06-01 10:34:44', '2024-06-01 20:41:21', 'Tenda'),
(6, 'assets/tenda/mWPPce8qVMpT8DwJUMOJFq6yFl78TLk07ICjAevJ.png', 'NEMO - Kunai 2P', 'nemo-kunai-2p-tent', 90000.00, 45000.00, 'Tenda Nemo Kunai 2-Person 4-Season ringan, tahan angin, hujan, dan salju, ideal untuk petualangan sepanjang tahun', 0, '2024-06-01 10:35:18', '2024-06-01 20:41:28', 'Tenda'),
(7, 'assets/tenda/i0wfqoP3vEOGnMqbAdyyb6Lnw5B5ujNvsdXNDaQz.png', 'NEMO - Aurora Highrise', 'nemo-aurora-highrise-tent', 80000.00, 40000.00, 'Tenda NEMO Aurora Highrise 6 orang dengan ruang luas dan ventilasi baik untuk kenyamanan berkemah.', 0, '2024-06-01 10:35:45', '2024-06-01 20:41:36', 'Tenda'),
(8, 'assets/tenda/aXY3WiXNcAx8gdK5utI3bs69Gj4I5aX7CxGxdmnM.png', 'Snow Peak - Living Shell', 'snow-peak-living-shell-tent', 120000.00, 60000.00, 'Tenda modular Snow Peak Living Shell cocok untuk pertemuan keluarga kecil atau kelompok.', 0, '2024-06-01 10:36:21', '2024-06-01 20:42:17', 'Tenda'),
(9, 'assets/tenda/M8ohqBDQ2SwyMmLuYPMUCd9eEaSc6hV4KMFkUcSi.png', 'Snow Peak - Land Lock', 'snow-peak-land-lock-tent', 150000.00, 70000.00, 'Tenda Land Lock cocok untuk akhir pekan berkemah bersama teman-teman berkat desain luasnya.', 0, '2024-06-01 10:37:02', '2024-06-01 20:41:46', 'Tenda'),
(10, 'assets/tenda/J5qH6h6iksmrRDNgPHrMTiiFeUKjMVgaS0pagoeo.png', 'Marmot - Tungsten', 'marmot-tungsten-tent', 100000.00, 50000.00, 'Tenda Marmot Tungsten 4P menawarkan ruang yang luas untuk keluarga atau rombongan besar.', 1, '2024-06-01 10:37:34', '2024-06-04 01:14:32', 'Tenda'),
(11, 'assets/tenda/CQ01AObi2iwuDuZzByyPaS55WbERkHaeh2Nr317W.png', 'Kelty - Time Out 6P', 'kelty-time-out-6p-tent', 80000.00, 40000.00, 'Tenda Kelty Time Out 6P cocok untuk camping bersama teman-teman', 0, '2024-06-01 10:38:11', '2024-06-01 20:40:36', 'Tenda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonis`
--

CREATE TABLE `testimonis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `testimoni` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testimonis`
--

INSERT INTO `testimonis` (`id`, `gambar`, `nama`, `testimoni`, `created_at`, `updated_at`) VALUES
(10, 'assets/testimoni/vcnFShCH5xgTT6PViCCB9gUo5gowZ1EFPlp6YZlr.jpg', 'Chandra', 'Alam Rent memberikan tips berguna untuk pengalaman berkemah yang lebih baik. Rekomendasi!', '2024-06-01 11:00:25', '2024-06-01 11:05:42'),
(11, 'assets/testimoni/Y5CAn3RG4jo2ZsDwRIpJMSmn4KQL22WnaTFkSdi0.jpg', 'Kai', 'Alam Rent memberikan layanan luar biasa! Tenda bersih dan nyaman membuat pengalaman berkemah menyenangkan', '2024-06-01 11:04:07', '2024-06-01 11:06:22'),
(12, 'assets/testimoni/uWw8bobXJXN5CF9fpFnnGF7dX7oaVxpXNnmo0Mbf.jpg', 'Mawar', 'Puas dengan kualitas tenda dan peralatan camping dari Alam Rent. Cocok untuk keluarga atau grup', '2024-06-01 11:06:59', '2024-06-01 11:06:59'),
(13, 'assets/testimoni/vM1Vb2OfvzBYzAWoiV4SUdKOPtE4qMPseKPzR9GP.jpg', 'Nini', 'Pengalaman berkemah istimewa dengan Alam Rent. Semua peralatan tersedia dengan kondisi bagus', '2024-06-01 11:07:56', '2024-06-01 11:08:16'),
(14, 'assets/testimoni/u3ffEIjxRVLGhFVdGa2GpjrtyxchAkXB04R8jypp.jpg', 'Anton', 'Layanan cepat dan efisien dari Alam Rent. Semua peralatan lengkap dan siap pakai', '2024-06-01 11:09:07', '2024-06-01 11:09:07'),
(15, 'assets/testimoni/rgwgP9lK5kOVnSeUpdHLQRZUsTN3YD7iMEhbQBGf.jpg', 'Umin', 'Pilihan yang tepat! Kemah bersama Alam Rent memberikan harga terjangkau', '2024-06-01 11:09:46', '2024-06-01 11:09:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '08154890765', NULL, '$2y$10$WJHCKe/na1cYOSEZOLIY0OF1v7a90PNRFsFxp6j3c4jQYiBAJR4SW', 0, 'WnuA8X5UhXFaHaE7dDdATvGS31zNilwPYXKkqr6aOYqoEBdbIQzo7Jxsb5y4', '2024-05-29 00:37:48', '2024-05-29 00:37:48'),
(2, 'Bening', 'nuansabening2005@gmail.com', '082122324658', NULL, '$2y$10$PObncMIdAi7H1UhnGqAp/Oh0M7GNGI7HtsxYspcZeGZKl9q.cwGC.', 0, 'vgPpZZe4iDkCDVyv48E9zuzfmD9cuWzSwHTaHPs5OpzOLvdXfyrNlrqAP93o', '2024-05-29 08:41:45', '2024-06-12 14:15:21'),
(4, 'Wonu', 'wonu@gmail.com', '0897218781781', NULL, '$2y$10$Vjfw6LLuPDRfVtxX8qvBp.UfkcNfhzztU2LKHClzw11Nb4RHY1q9u', 0, 'iJHXnIgZgYxh7xQneR6CNhWb7t4GjhyjMM5mCCyj7SvFaW0LMyRSQjGjNuGj', '2024-06-02 04:25:49', '2024-06-02 04:25:49'),
(5, 'Cuwi', 'cuwi@gmail.com', '082189897654', NULL, '$2y$10$g2lEY0dlMjKjYwLXNq02Muaw.MNmhnowg/rdIY76AEwsmQPdPZKJ6', 0, '93gXEgnouFfxRX92Lzk9QBRDmAqFLntzQ6lc2y41IdJC0PStlMCHLcgS6Rmv', '2024-06-03 02:46:52', '2024-06-12 14:15:36'),
(6, 'Armelia Zahrah', 'armel@gmail.com', '085772970054', NULL, '$2y$10$mN3FAuMU.FgYgNODcSzjkOjnDxf4mw3tRgMTCXaEiN.WGCGZSvaBy', 0, 'WnQKzK6EMcHUWfODrCuwfVHIRzaNMiU8ISeE0jv2ALuDgT67svWDn4OgLqF5', '2024-06-05 07:43:05', '2024-06-05 07:43:05'),
(7, 'Syahraini Revita P', 'puri@gmail.com', '088211913576', NULL, '$2y$10$vIG3DrTRuuAe4bK2apyxHulEY/vwUzGE/1PwrI9HhCZaFGiBl2Ik.', 0, 'wSRLtLedMWCxalzPraTiYZ4mPvrxXDgBFgbdEMw5l7u8H9rG2GwlM8fNNNrP', '2024-06-05 07:55:47', '2024-06-05 07:55:47'),
(8, 'Meisya Amalia', 'meimei@gmail.com', '081211806375', NULL, '$2y$10$inDbpOugXsTh9Y/VU.A6.Od5CzPHV9yhivcZEK/RdqRgdTDpV4C.W', 0, '82HKDfZ4pKNaQXjxVhJdb9UgV5Xl2lwWlot2q6u0mDbD2xhtGL4FxRBLPMD4', '2024-06-05 07:57:52', '2024-06-05 07:57:52'),
(9, 'Julian Dwi S', 'jule@gmail.com', '081322503073', NULL, '$2y$10$QjOvstpFiSOVzbVJTPsrOeM.Q/38jQ2sDd4U8LC12zyRrxwb/BDZK', 0, 'hyh7BRE4tQubhRxsdg5qKGxtxrSxdpx7LC0t4Z6UTv66hpokgBxEHqIPuZzn', '2024-06-05 07:59:07', '2024-06-05 07:59:07'),
(11, 'miau', 'miau@gmail.com', '08299282934023', NULL, '$2y$10$xtK1esAV6vZPXwKinEeTIO.e.wZTTXwRbsVqfIWOnWFVNplEsl9JG', 0, 'ZY7jVZDYdwH1S2JD87eSCURV9ftX2Y6fIXFBtk3oTvfxJTqhusqtUaFcXApb', '2024-06-12 21:21:04', '2024-06-12 21:21:04'),
(13, 'admin1', 'admin1@gmail.com', '0000000000', NULL, '$2y$10$zroN5wsZEEweEYDVBfugrex8K6GPMduhi7.gMLvDKzD6yfbc.Sw/q', 1, 'EofCSfQ3fEifURaDrYaqzf9q3RdLp1LD4TlkZMvxiDICeMkNmJYJOBc2XGLx', '2025-02-22 03:29:02', '2025-02-22 03:29:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pakaians`
--
ALTER TABLE `pakaians`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `ransels`
--
ALTER TABLE `ransels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sepatus`
--
ALTER TABLE `sepatus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tendas`
--
ALTER TABLE `tendas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimonis`
--
ALTER TABLE `testimonis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pakaians`
--
ALTER TABLE `pakaians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ransels`
--
ALTER TABLE `ransels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `sepatus`
--
ALTER TABLE `sepatus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tendas`
--
ALTER TABLE `tendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `testimonis`
--
ALTER TABLE `testimonis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
