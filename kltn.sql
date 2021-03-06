-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 02:31 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kltn`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_09_135640_create_permission_tables', 1),
(5, '2021_08_26_113211_create_topics_table', 1),
(6, '2021_08_26_141924_create_user_register_topics_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 108),
(4, 'App\\Models\\User', 109),
(4, 'App\\Models\\User', 110),
(4, 'App\\Models\\User', 111),
(4, 'App\\Models\\User', 112),
(4, 'App\\Models\\User', 113),
(4, 'App\\Models\\User', 114),
(4, 'App\\Models\\User', 115),
(4, 'App\\Models\\User', 116),
(4, 'App\\Models\\User', 117),
(4, 'App\\Models\\User', 118),
(4, 'App\\Models\\User', 119),
(4, 'App\\Models\\User', 120),
(4, 'App\\Models\\User', 121),
(4, 'App\\Models\\User', 122),
(4, 'App\\Models\\User', 123),
(5, 'App\\Models\\User', 128),
(5, 'App\\Models\\User', 129),
(5, 'App\\Models\\User', 130),
(5, 'App\\Models\\User', 131),
(5, 'App\\Models\\User', 132),
(5, 'App\\Models\\User', 133),
(5, 'App\\Models\\User', 134),
(5, 'App\\Models\\User', 135),
(5, 'App\\Models\\User', 136),
(5, 'App\\Models\\User', 137),
(5, 'App\\Models\\User', 138),
(5, 'App\\Models\\User', 139),
(5, 'App\\Models\\User', 140),
(5, 'App\\Models\\User', 141),
(5, 'App\\Models\\User', 142),
(5, 'App\\Models\\User', 143),
(5, 'App\\Models\\User', 144),
(5, 'App\\Models\\User', 145),
(5, 'App\\Models\\User', 146),
(5, 'App\\Models\\User', 147),
(5, 'App\\Models\\User', 148),
(5, 'App\\Models\\User', 149),
(5, 'App\\Models\\User', 150),
(5, 'App\\Models\\User', 151),
(5, 'App\\Models\\User', 152),
(5, 'App\\Models\\User', 153),
(5, 'App\\Models\\User', 154),
(5, 'App\\Models\\User', 155),
(5, 'App\\Models\\User', 156),
(5, 'App\\Models\\User', 157),
(5, 'App\\Models\\User', 158);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(2, 'user-create', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(3, 'user-edit', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(4, 'user-delete', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(5, 'role-list', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(6, 'role-create', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(7, 'role-edit', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(8, 'role-delete', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(9, 'topic-register', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(10, 'topic-list', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(11, 'topic-create', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(12, 'topic-edit', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(13, 'topic-delete', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38'),
(14, 'topic-report', 'web', '2021-01-16 03:12:38', '2021-01-16 03:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Qu???n tr??? vi??n', 'web', '2021-01-16 03:12:42', '2021-01-16 03:12:42'),
(2, 'Gi??o v???', 'web', '2021-01-16 03:12:42', '2021-01-16 03:12:42'),
(3, 'BCN Khoa', 'web', '2021-01-16 03:12:46', '2021-01-16 03:12:46'),
(4, 'Gi???ng vi??n', 'web', '2021-01-16 03:13:54', '2021-01-16 03:13:54'),
(5, 'Sinh vi??n', 'web', '2021-02-04 20:42:55', '2021-02-04 20:44:47'),
(6, 'Chuy??n vi??n S??? (M??? r???ng)', 'web', '2021-02-05 02:20:45', '2021-02-05 02:20:45'),
(7, 'Nh???p ??i???m', 'web', '2021-03-10 10:35:04', '2021-03-10 10:35:04'),
(8, 'S???a ????? t??i', 'web', '2021-03-10 10:36:00', '2021-03-10 10:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 4),
(9, 5),
(10, 1),
(11, 1),
(12, 1),
(13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_student` int(11) NOT NULL,
  `required` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subinstructor_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(32) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `created_at`, `updated_at`, `name`, `department`, `number_student`, `required`, `note`, `user_id`, `subinstructor_id`, `student_id`, `status`) VALUES
(36, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Ho??n thi???n h??? th???ng ????nh gi?? k???t qu??? r??n luy???n Ho??n thi???n v?? b??? sung ch???c n??ng cho h??? th???ng ????nh gi?? k???t qu??? r??n luy???n ???? c?? (s??? d???ng framework laravel)', 'CNPM', 1, '-Th??nh th???o ??t nh???t 1 framework, laravel l?? m???t l???i th???\n-C?? kh??? n??ng ?????c hi???u t??i li???u ph??n t??ch v?? thi???t k??? h??? th???ng\n-C?? kh??? n??ng l??m vi???c d?????i ??p l???c cao\n-Cam k???t l??m vi???c v?? b??o c??o ti???n ????? ?????u ?????n theo l???ch tr??nh c???a gi???ng vi??n h?????ng d???n', '', 108, 0, 0, 1),
(37, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Ph??t tri???n h??? th???ng qu???n l?? c??ng vi???c cho khoa CNTT', 'CNPM', 1, '-C?? kh??? n??ng ph??n t??ch thi???t k??? h??? th???ng (??i???m PTTK HTTT t??? B tr??? l??n)\n-Th??nh th???o ??t nh???t m???t ng??n ng??? l???p tr??nh Web PHP, Java, Python???\n-C?? kh??? n??ng l??m vi???c d?????i ??p l???c cao\n-Cam k???t l??m vi???c v?? b??o c??o ti???n ????? ?????u ?????n theo l???ch tr??nh c???a gi???ng vi??n h?????n', '', 108, 0, 0, 1),
(38, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Nh???n d???ng c???m x??c t??? ?????ng d???a tr??n ???nh khu??n  m???t', 'CNPM', 1, '', '???? c?? SV', 109, 0, 0, 0),
(39, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Theo v???t ?????i t?????ng trong video', 'CNPM', 1, '', '???? c?? SV', 109, 0, 0, 0),
(40, '2021-08-26 08:38:12', '2021-09-02 09:14:41', 'X??y d???ng v?? ph??t tri???n h??? th???ng qu???n l?? v?? b???o v??? kh??a lu???n cho sinh vi??n Khoa CNTT.', 'CNPM', 1, '-Hi???u v?? c?? th??? l???p tr??nh t???t PHP ho???c Java\r\n-Hi???u v?? thao t??c ???????c CSDL MySQL ho???c SQL Server\r\n-Ch??m ch???, ham h???c h???i.', '????? t??i c???p thi???t', 109, 0, 0, 1),
(41, '2021-08-26 08:38:12', '2021-08-26 08:38:12', '???ng d???ng machine learning ????? gi???i m?? h??nh ???nh captcha t??? ?????ng', 'CNPM', 1, '', '???? c?? SV', 109, 0, 0, 0),
(42, '2021-08-26 08:38:12', '2021-08-26 08:38:12', '???ng d???ng QR code trong qu???n l?? b??n h??ng', 'CNPM', 1, '-Code PHP framework laravel\n-Code build c??c template = Vuejs\n-S??? d???ng jquery v?? bootstrap', '', 110, 0, 0, 1),
(43, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Ph??t tri???n website b??n h??ng s??? d???ng Heatmap ????? truy v???t v?? g???i ?? qu???ng c??o', 'CNPM', 1, '-Code PHP framework laravel\n-Code build c??c template v???i Vuejs\n-S??? d???ng jquery v?? bootstrap\n-S??? d???ng ???????c javascript ES6, ES7, bi???t c??ch module h??a c??c th?? vi???n tracking\n-S??? d???ng javascript c??i ?????t ???????c c??c trigger ??p d???ng c??c behaviour event ng?????i d??ng.', '', 110, 0, 0, 1),
(44, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'A/B Testing cho c??c Heatmap website ', 'CNPM', 1, '-S??? d???ng ???????c javascript ES6, ES7, bi???t c??ch module h??a c??c th?? vi???n tracking\n-S??? d???ng javascript c??i ?????t ???????c c??c trigger ??p d???ng c??c behaviour event ng?????i d??ng\n-S??? d???ng javascript highchart v??? c??c bi???u ????? th???ng k??\n-Th??nh th???o Mysql', '', 110, 0, 0, 1),
(45, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Nghi??n c???u ph????ng ph??p ph??n r?? ma tr???n cho b??i to??n gi???m chi???u d??? li???u', 'CNPM', 1, 'Sinh vi??n ch??m ch???, c?? kh??? n??ng ?????c t??i li???u ti???ng Anh, c?? ki???n th???c To??n t???t, c?? kh??? n??ng l???p tr??nh C/C++/Python', '', 111, 0, 0, 1),
(46, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Nghi??n c???u c??c ph????ng ph??p nh??ng ????? th??? (graph embedding), ???ng d???ng trong khai ph?? d??? li???u y-sinh', 'CNPM', 1, 'Sinh vi??n ch??m ch???, c?? kh??? n??ng ?????c t??i li???u ti???ng Anh, c?? ki???n th???c To??n t???t, c?? kh??? n??ng l???p tr??nh C/C++/Python', '', 111, 0, 0, 1),
(47, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'X??y d???ng ???ng d???ng mobile ?????c ???nh phi???u tr??? l???i tr???c nghi???m', 'HTTT', 1, '', '', 112, 0, 0, 1),
(48, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'X??y d???ng ph???n m???m h??? tr??? gi??o vi??n sinh ????? t??? ?????ng t??? ma tr???n ????? v?? ng??n h??ng c??u h???i', 'HTTT', 1, '', '', 112, 0, 0, 1),
(49, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'X??y d???ng ph???n m???m ????? thi th??ng minh gi??p gi??o vi??n t??? ch???c thi tr???c tuy???n', 'HTTT', 1, '', '', 112, 0, 0, 1),
(50, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Thi???t k??? chuy??n ????? ???ng d???ng Tin h???c l???p 11 trong Ch????ng tr??nh GDPT m??n Tin h???c 2018', 'HTTT', 1, '', '', 113, 0, 0, 1),
(51, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Song song h??a thu???t to??n PCA tr??n m?? h??nh l???p tr??nh mapreduce v?? ???ng d???ng', 'HTTT', 1, '', '', 114, 0, 0, 1),
(52, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'X??y d???ng m???ng x?? h???i h???c t???p d???a tr??n s??? k???t h???p c???a nhi???u h??? qu???n tr??? c?? s??? d??? li???u', 'HTTT', 1, '', '', 114, 115, 0, 1),
(53, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Tr??ch r??t t??m t???t b???ng ng??n ng??? t??? c?? s??? d??? li???u s???', 'KHMT', 1, 'Y??u c???u: SV ?????c hi???u ???????c t??i li???u ti???ng Anh, c??i ?????t ???????c thu???t to??n.', '', 116, 0, 0, 1),
(54, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Tr??ch r??t t??m t???t b???ng ng??n ng??? t??? d??? li???u chu???i th???i gian', 'KHMT', 1, 'Y??u c???u: SV ?????c hi???u ???????c t??i li???u ti???ng Anh, c??i ?????t ???????c thu???t to??n.', '', 116, 0, 0, 1),
(55, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'M???t s??? b??i to??n t???i ??u trong th???c t???', 'KHMT', 1, '', '', 117, 0, 0, 1),
(56, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'M???t s??? b??i to??n ph??n t??ch d??? li???u trong gi??o d???c', 'KHMT', 1, '', '', 117, 0, 0, 1),
(57, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'B??? c??ng c??? gi??m s??t v?? ph??n t??ch m???ng', 'KTMT', 1, 'Y??u c???u sinh vi??n am hi???u v??? h??? th???ng m???ng. b???o m???t v?? c?? kh??? n??ng t??? nghi??n c???u', '', 118, 0, 0, 1),
(58, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'T??m hi???u c??c ph???n m???m gi??? l???p thi???t b??? m???ng', 'KTMT', 1, 'Y??u c???u sinh vi??n am hi???u v??? h??? th???ng m???ng  v?? c?? kh??? n??ng t??? nghi??n c???u', '', 118, 0, 0, 1),
(59, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Qu???n tr??? m???ng v???i Windows server 2016', 'KTMT', 1, 'Y??u c???u sinh vi??n am hi???u v??? h??? th???ng m???ng  v?? c?? kh??? n??ng t??? nghi??n c???u', '', 118, 0, 0, 1),
(60, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'B??i to??n l???p l???ch lu???ng c??ng vi???c trong Cloud Computing', 'KTMT', 1, 'Sinh vi??n c???n c?? kh??? n??ng l???p tr??nh Java ho???c C#. C?? kh??? n??ng v??? thu???t to??n, ?????c t??i li???u ti???ng Anh', '', 119, 0, 0, 1),
(61, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'B??i to??n MS-RCPSP', 'KTMT', 1, 'Sinh vi??n c???n c?? kh??? n??ng l???p tr??nh Java ho???c C#. C?? kh??? n??ng v??? thu???t to??n, ?????c t??i li???u ti???ng Anh', '', 119, 0, 0, 1),
(62, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'T??m hi???u v??? thu???t to??n Support Vector Machine', 'KTMT', 1, 'Y??u c???u sinh vi??n c?? ki???n th???c c?? b???n v??? x??? l?? ???nh v?? c?? kh??? n??ng s??? d???ng ng??n ng??? l???p tr??nh c?? b???n, ?????ng th???i c?? kh??? n??ng t??m hi???u v?? s??? d???ng c??c th?? vi???n h??? tr??? trong x??? l?? ???nh', '', 120, 0, 0, 1),
(63, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'T??m hi???u v??? b??i to??n ph??n lo???i v?? m?? h??nh h???i quy Logistic', 'KTMT', 1, 'Y??u c???u sinh vi??n c?? ki???n th???c c?? b???n v??? x??? l?? ???nh v?? c?? kh??? n??ng s??? d???ng ng??n ng??? l???p tr??nh c?? b???n, ?????ng th???i c?? kh??? n??ng t??m hi???u v?? s??? d???ng c??c th?? vi???n h??? tr??? trong x??? l?? ???nh', '', 120, 0, 0, 1),
(64, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'V???n d???ng ???h???c t???p d???a tr??n tr?? ch??i??? h??? tr??? ????nh gi?? k???t qu??? h???c t???p c???a h???c sinh trong d???y h???c ch????ng C???u tr??c r??? nh??nh v?? l???p', 'PPGD', 1, '', '', 121, 0, 0, 1),
(65, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Ph??t tri???n n??ng l???c t??? h???c cho h???c sinh th??ng qua thi???t k??? h???c li???u t??? h???c c?? h?????ng d???n trong d???y h???c ch??? ????? D ??? ?????o ?????c, ph??p lu???t v?? v??n ho?? trong m??i tr?????ng s??? ??? tr?????ng Trung h???c ph??? th??ng', 'PPGD', 1, '', '', 122, 0, 0, 1),
(66, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Ph??t tri???n n??ng l???c t??? h???c cho h???c sinh th??ng qua thi???t k??? h???c li???u t??? h???c c?? h?????ng d???n trong d???y h???c ch??? ????? E ??? ???ng d???ng Tin h???c ??? tr?????ng Trung h???c ph??? th??ng', 'PPGD', 1, '', '', 122, 0, 0, 1),
(67, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'T??ch c???c h??a ho???t ?????ng c???a h???c sinh th??ng qua thi???t k??? c??c ho???t ?????ng h???c d?????i d???ng tr?? ch??i (game-based learning) trong d???y h???c ch??? ????? E- ???ng d???ng Tin h???c ??? tr?????ng Trung h???c ph??? th??ng', 'PPGD', 1, '', '', 122, 0, 0, 1),
(68, '2021-08-26 08:38:13', '2021-08-26 08:38:13', 'M???t s??? bi???n ph??p t??? ch???c d???y h???c ch??? ????? ???Ph???n m???m thi???t k??? ????? h???a??? ??? l???p 10, trung h???c ph??? th??ng', 'PPGD', 1, '', '', 123, 0, 0, 1),
(69, '2021-08-26 08:38:13', '2021-08-26 08:38:13', 'M???t ????? xu???t tri???n khai n???i dung d???y h???c chuy??n ????? ???Ch???nh s???a ???nh??? ??? l???p 11, trung h???c ph??? th??ng', 'PPGD', 1, '', '', 123, 0, 0, 1),
(70, '2021-08-26 08:38:13', '2021-08-26 08:38:13', 'Th???c hi???n ki???m tra, ????nh gi?? th?????ng xuy??n nh?? m???t ho???t ?????ng h???c khi d???y h???c ch??? ????? ???L???p tr??nh c?? b???n??? ??? l???p 10, trung h???c ph??? th??ng', 'PPGD', 1, '', '', 123, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `academic_year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_ref` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password_change_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `phone`, `academic_year`, `class`, `id_ref`, `email_verified_at`, `password_change_at`, `password`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Qu???n tr??? vi??n', 'admin', 'tranhailong0807@gmail.com', 1, '', '', '', '1', NULL, '2021-02-23 13:21:53', '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, '2021-01-16 03:12:42', '2021-01-16 03:12:42'),
(2, 'Gi??o v??? 1', 'giaovu01', '', 2, '', '', '', NULL, NULL, '2021-02-01 00:27:32', '$2b$12$ArJpPGPZ2BZ/fD.VmDODwugI5fDP2XEs7U5ZS8EAWqEZzg9yZnGtK', NULL, NULL, '2021-01-16 03:12:42', '2021-09-02 10:34:06'),
(3, 'Ban ch??? nhi???m Khoa 1', 'bcnkhoa01', NULL, 3, '', '', '', '1', NULL, '2021-01-29 23:20:46', '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, '2021-01-16 03:12:46', '2021-09-02 10:06:52'),
(108, 'TS. Nguy???n Th??? Thanh Huy???n', 'huyenntt', 'ntthuyen@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 10:25:06'),
(109, 'TS. ?????ng Th??nh Trung', 'trungdt', 'trungdt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 09:57:25'),
(110, 'ThS. Nguy???n Th??? H???nh', 'hanhnt', 'hanhit@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 10:18:00'),
(111, 'PGS. TS Tr???n ????ng H??ng', 'hungtd', 'hungtd@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(112, 'PGS. TS Ph???m Th??? Ho??n', 'hoanpt', 'hoanpt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 10:11:00'),
(113, 'TS. Ph???m Th??? Anh L??', 'lepta', 'lepta@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(114, 'TS. L?? Th??? T?? Ki??n', 'kienltt', 'kienltt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(115, 'CN. L?? Xu??n Hi???n', 'hienlx', 'lexuanhien@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(116, 'ThS. Ph???m Th??? Lan', 'lanpt', 'ptlan@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(117, 'TS. ????? Trung Ki??n', 'kiendt', 'kiendt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(118, 'ThS. V?? Th??i Giang', 'giangvt', 'giangvt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(119, 'TS. Nguy???n Th??? L???c', 'locnt', 'locnt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(120, 'ThS. Nguy???n th??? Qu???nh Hoa', 'hoantq', 'hoantq@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 09:52:13'),
(121, 'ThS. Nguy???n Th??? H???ng', 'hongnt', 'nguyenthihong@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(122, 'ThS. Ki???u Ph????ng Th??y', 'thuykp', 'thuykp@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(123, 'TS. Nguy???n Ch?? Trung', 'trungnc', 'trungnc@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(128, 'Ph???m Quang Huy', '685105031', '685105031@gmail.com', 5, '', 'K68', '', NULL, NULL, '2021-09-05 14:05:26', '$2y$10$pNyCzmdQuKOhW1XgP8xhiOpCYTg6fTTHVjwc2AX7fLub13w/1PQ/.', NULL, NULL, NULL, '2021-09-05 14:05:26'),
(129, 'Nh??? Duy Th??n', '685105061', '685105061@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$ycGuAa6hXGRXXDDWeKhs.e8C9lEDW13NrOxXVQzeZxGxmkLZ8sLjq', NULL, NULL, NULL, NULL),
(130, '??inh Quang ?????o', '685105012', '685105012@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$ojL3GiPbYiSx1L.L96UMROi1TbV3toptjRdFDeOtihteImFE0QIJm', NULL, NULL, NULL, NULL),
(131, 'L?? Th??? Nga', '685105043', '685105043@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$XbyBqPOt0p2yFuZEE7QDTOmweooP4jatnXPVKMvNkmc/yI188w/G.', NULL, NULL, NULL, NULL),
(132, 'Nguy???n Minh Ph????ng', '685105053', '685105053@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$EU6Zpz0rvhdfzpwrFVaYueohCEwYoX/Ws.ZWLQxjte2PltGq6Dmoe', NULL, NULL, NULL, NULL),
(133, 'L?? Th??? Ng???c', '685105046', '685105046@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$5zUL3agwffYP9ynf2NvxX.7ePmQ449Rsms1iOwc0UTxla4Sqmijtq', NULL, NULL, NULL, NULL),
(134, 'V?? Th??nh Vinh', '685105079', '685105079@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$k8LhCiGO8s5GQVFvSK2VVecA9z5Lo0QthO6lbmm8r1v81ptj0qF0m', NULL, NULL, NULL, NULL),
(135, 'V?? B?? Th???', '685105062', '685105062@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$SyiWyLnZFBmeS4VLX1ufLeaESl70z.hmpXC7FesI2zBTaP1kBhv4G', NULL, NULL, NULL, NULL),
(136, 'L??u Anh T??', '685105073', '685105073@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$rbfkeTrEr42eE6jLtNyAWev/55h8tbMgYoPqAY9NTvwnjcdHJStvm', NULL, NULL, NULL, NULL),
(137, 'Nguy???n H???i Phong', '685105050', '685105050@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$J0SYXUWnfTEBHMKCeop2A.2kVLyP5BjSSyvgDL2521LUYk9OBL0lm', NULL, NULL, NULL, NULL),
(138, 'Nguy???n Th??? Kim Ng??n', '685105044', '685105044@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$ekSOaxyJob8IQffV3BrlzeTR6bs5srr1rtSekfsqlpUkE4ubFFqju', NULL, NULL, NULL, NULL),
(139, 'L?? Nguy??n H??ng', '685105033', '685105033@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$jGVF4IHTVF9m3PbyEGlX4OtfYsGDtfT7yfqDGr.adnGOoSnoltJOy', NULL, NULL, NULL, NULL),
(140, 'D????ng Th??? Thanh Nga', '685105042', '685105042@gmail.com', 5, '', 'K68', '', NULL, NULL, '2021-09-05 14:08:38', '$2y$10$KecdSQWScTFv4go0HISKiuIzAoKscGWAiQRDiL.lQiilXYb/5AjYm', NULL, NULL, NULL, '2021-09-05 14:08:38'),
(141, 'Tr???nh Trung Hi???u', '685105027', '685105027@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$Nhp9/dJPiU3HBGqQ9d0WyO/1Hme0w2gyClp4Rsj.gERV3OYc6/9Sq', NULL, NULL, NULL, NULL),
(142, 'Mai V??n Hi???u', '685105022', '685105022@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$AbE8F/Rzz7Z3ci55MuWgEOle5bghrUKUCiO09eOWZDm.thDdiVhSi', NULL, NULL, NULL, NULL),
(143, 'V?? C??ng Th??nh', '685105057', '685105057@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$fOnGv5WG69ZHJ7.0rK.Xge3VidWTg.M/6LmeRk9uOXBSGH21ICqsi', NULL, NULL, NULL, NULL),
(144, 'Mai Th??i D????ng', '685105010', '685105010@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$wrmmsW9QAaLVmTPtbTvkBeH3Pik1lZ5t0tMOAMj.0fWsF7m4Fehji', NULL, NULL, NULL, NULL),
(145, 'Tr???n Th??? Thu H??', '685105015', '685105015@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$GLniGX5OmTmSsvfH4AMwnOPbingJ33PR114GuANy.Uaws3CHYtDDi', NULL, NULL, NULL, NULL),
(146, 'Mai Thi??n Quang Anh', '685105004', '685105004@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$bHUohts47LCBK7uwaZ/OM.tK9n2QZsX9uAfpS5c94xK1aNP27Etw2', NULL, NULL, NULL, NULL),
(147, 'Nguy???n Th??? Thanh Ng??n', '685105045', '685105045@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$8R7Ap1ptU1zgDAywgogmdef5QuQojPH6UpfnWHVmBW/LYvk7TF5wO', NULL, NULL, NULL, NULL),
(148, 'Tr???n Th??? Loan', '685102006', '685102006@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$441T6T.u3MkT4BgSU6XC1uUecB0pSBb6zSPCy5seTeXXnKZ53zbhC', NULL, NULL, NULL, NULL),
(149, '????? Anh V??n', '685102014', '685102014@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$Qsm1XQET9qia2jm1SSHpROJI3lG2vW.LVTQsiPw61K6Is5NvNUMFK', NULL, NULL, NULL, NULL),
(150, 'B??i Th??? Khuy', '685102002', '685102002@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$j9KwRZLMhAxwI.DJ3uLUWOtn7AD1bOCh.rn67APw70K9eO9jssXR2', NULL, NULL, NULL, NULL),
(151, 'Nguy???n Thu Ph????ng', '685102009', '685102009@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$J0HyK9GbNZnj8tjxIdDwResgiYov4U70.CMUNmqJB08fLMEU8q012', NULL, NULL, NULL, NULL),
(152, 'Nguy???n Th??? Thoan', '685102013', '685102013@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$nqpOxu/oM2uQFHooIqeBYOpQIg0ctqgxeOdU4w6qqv3m1ugF8CNZq', NULL, NULL, NULL, NULL),
(153, 'V?? Th??? Thanh Th???o', '685102012', '685102012@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$Sh4Q4GYXTeM1a27RQPx5DeVB5usTBD4MbwVZq1pFFRH9f2kNO2v9m', NULL, NULL, NULL, NULL),
(154, 'Tr???n Th??? Kim Loan', '685102005', '685102005@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$xa0W.dTYDYBtpMlZ9r91wO36Yok1inTY9aiBq/6lk8ccubDll7L.C', NULL, NULL, NULL, NULL),
(155, 'Ph???m Trung Ki??n', '685102003', '685102003@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$FIiUTJxf2WWsv2ROebOj.OXJIRqOQLb9nhpRVWmovE/3gW9z9On9C', NULL, NULL, NULL, NULL),
(156, 'Ph???m Th??? L??', '665302010', '665302010@gmail.com', 5, '', 'K68', '', NULL, NULL, '2021-09-05 14:10:24', '$2y$10$o3eEyFspT9TRfncKtWHWN.ynhx3JW46x0PP5q5QRUWZZWhroa./3y', NULL, NULL, NULL, '2021-09-05 14:10:24'),
(158, 'H???i Long', '665105037', 'tranhailong8798@gmail.com', 5, '', 'K66', '', NULL, NULL, '2021-09-04 04:50:39', '$2y$10$S1kCt0vaPizylgSzaKvAhO96icdJ3uVK0sDcaJpbFmtLF8f7/RybG', NULL, NULL, '2021-09-04 04:50:39', '2021-09-04 04:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_register_topics`
--

CREATE TABLE `user_register_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2021-2022',
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_register_topics`
--

INSERT INTO `user_register_topics` (`id`, `semester`, `user_id`, `topic_id`, `created_at`, `updated_at`) VALUES
(4, '2021-2022', 128, 38, '2021-09-05 14:07:08', '2021-09-05 14:07:08'),
(5, '2021-2022', 140, 41, '2021-09-05 14:09:39', '2021-09-05 14:09:39'),
(6, '2021-2022', 156, 39, '2021-09-05 14:10:51', '2021-09-05 14:10:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_topic` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_register_topics`
--
ALTER TABLE `user_register_topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `user_register_topics`
--
ALTER TABLE `user_register_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `instructor_topic` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
