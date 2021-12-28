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
(1, 'Quản trị viên', 'web', '2021-01-16 03:12:42', '2021-01-16 03:12:42'),
(2, 'Giáo vụ', 'web', '2021-01-16 03:12:42', '2021-01-16 03:12:42'),
(3, 'BCN Khoa', 'web', '2021-01-16 03:12:46', '2021-01-16 03:12:46'),
(4, 'Giảng viên', 'web', '2021-01-16 03:13:54', '2021-01-16 03:13:54'),
(5, 'Sinh viên', 'web', '2021-02-04 20:42:55', '2021-02-04 20:44:47'),
(6, 'Chuyên viên Sở (Mở rộng)', 'web', '2021-02-05 02:20:45', '2021-02-05 02:20:45'),
(7, 'Nhập điểm', 'web', '2021-03-10 10:35:04', '2021-03-10 10:35:04'),
(8, 'Sửa đề tài', 'web', '2021-03-10 10:36:00', '2021-03-10 10:36:00');

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
(36, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Hoàn thiện hệ thống đánh giá kết quả rèn luyện Hoàn thiện và bổ sung chức năng cho hệ thống đánh giá kết quả rèn luyện đã có (sử dụng framework laravel)', 'CNPM', 1, '-Thành thạo ít nhất 1 framework, laravel là một lợi thế\n-Có khả năng đọc hiểu tài liệu phân tích và thiết kế hệ thống\n-Có khả năng làm việc dưới áp lực cao\n-Cam kết làm việc và báo cáo tiến độ đều đặn theo lịch trình của giảng viên hướng dẫn', '', 108, 0, 0, 1),
(37, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Phát triển hệ thống quản lý công việc cho khoa CNTT', 'CNPM', 1, '-Có khả năng phân tích thiết kế hệ thống (Điểm PTTK HTTT từ B trở lên)\n-Thành thạo ít nhất một ngôn ngữ lập trình Web PHP, Java, Python…\n-Có khả năng làm việc dưới áp lực cao\n-Cam kết làm việc và báo cáo tiến độ đều đặn theo lịch trình của giảng viên hướn', '', 108, 0, 0, 1),
(38, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Nhận dạng cảm xúc tự động dựa trên ảnh khuôn  mặt', 'CNPM', 1, '', 'Đã có SV', 109, 0, 0, 0),
(39, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Theo vết đối tượng trong video', 'CNPM', 1, '', 'Đã có SV', 109, 0, 0, 0),
(40, '2021-08-26 08:38:12', '2021-09-02 09:14:41', 'Xây dựng và phát triển hệ thống quản lý và bảo vệ khóa luận cho sinh viên Khoa CNTT.', 'CNPM', 1, '-Hiểu và có thể lập trình tốt PHP hoặc Java\r\n-Hiểu và thao tác được CSDL MySQL hoặc SQL Server\r\n-Chăm chỉ, ham học hỏi.', 'Đề tài cấp thiết', 109, 0, 0, 1),
(41, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Ứng dụng machine learning để giải mã hình ảnh captcha tự động', 'CNPM', 1, '', 'Đã có SV', 109, 0, 0, 0),
(42, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Ứng dụng QR code trong quản lý bán hàng', 'CNPM', 1, '-Code PHP framework laravel\n-Code build các template = Vuejs\n-Sử dụng jquery và bootstrap', '', 110, 0, 0, 1),
(43, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Phát triển website bán hàng sử dụng Heatmap để truy vết và gợi ý quảng cáo', 'CNPM', 1, '-Code PHP framework laravel\n-Code build các template với Vuejs\n-Sử dụng jquery và bootstrap\n-Sử dụng được javascript ES6, ES7, biết cách module hóa các thư viện tracking\n-Sử dụng javascript cài đặt được các trigger áp dụng các behaviour event người dùng.', '', 110, 0, 0, 1),
(44, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'A/B Testing cho các Heatmap website ', 'CNPM', 1, '-Sử dụng được javascript ES6, ES7, biết cách module hóa các thư viện tracking\n-Sử dụng javascript cài đặt được các trigger áp dụng các behaviour event người dùng\n-Sử dụng javascript highchart vẽ các biểu đồ thống kê\n-Thành thạo Mysql', '', 110, 0, 0, 1),
(45, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Nghiên cứu phương pháp phân rã ma trận cho bài toán giảm chiều dữ liệu', 'CNPM', 1, 'Sinh viên chăm chỉ, có khả năng đọc tài liệu tiếng Anh, có kiến thức Toán tốt, có khả năng lập trình C/C++/Python', '', 111, 0, 0, 1),
(46, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Nghiên cứu các phương pháp nhúng đồ thị (graph embedding), ứng dụng trong khai phá dữ liệu y-sinh', 'CNPM', 1, 'Sinh viên chăm chỉ, có khả năng đọc tài liệu tiếng Anh, có kiến thức Toán tốt, có khả năng lập trình C/C++/Python', '', 111, 0, 0, 1),
(47, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Xây dựng ứng dụng mobile đọc ảnh phiếu trả lời trắc nghiệm', 'HTTT', 1, '', '', 112, 0, 0, 1),
(48, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Xây dựng phần mềm hỗ trợ giáo viên sinh đề tự động từ ma trận đề và ngân hàng câu hỏi', 'HTTT', 1, '', '', 112, 0, 0, 1),
(49, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Xây dựng phần mềm đề thi thông minh giúp giáo viên tổ chức thi trực tuyến', 'HTTT', 1, '', '', 112, 0, 0, 1),
(50, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Thiết kế chuyên đề ứng dụng Tin học lớp 11 trong Chương trình GDPT môn Tin học 2018', 'HTTT', 1, '', '', 113, 0, 0, 1),
(51, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Song song hóa thuật toán PCA trên mô hình lập trình mapreduce và ứng dụng', 'HTTT', 1, '', '', 114, 0, 0, 1),
(52, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Xây dựng mạng xã hội học tập dựa trên sự kết hợp của nhiều hệ quản trị cơ sở dữ liệu', 'HTTT', 1, '', '', 114, 115, 0, 1),
(53, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Trích rút tóm tắt bằng ngôn ngữ từ cơ sở dữ liệu số', 'KHMT', 1, 'Yêu cầu: SV đọc hiểu được tài liệu tiếng Anh, cài đặt được thuật toán.', '', 116, 0, 0, 1),
(54, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Trích rút tóm tắt bằng ngôn ngữ từ dữ liệu chuỗi thời gian', 'KHMT', 1, 'Yêu cầu: SV đọc hiểu được tài liệu tiếng Anh, cài đặt được thuật toán.', '', 116, 0, 0, 1),
(55, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Một số bài toán tối ưu trong thực tế', 'KHMT', 1, '', '', 117, 0, 0, 1),
(56, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Một số bài toán phân tích dữ liệu trong giáo dục', 'KHMT', 1, '', '', 117, 0, 0, 1),
(57, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Bộ công cụ giám sát và phân tích mạng', 'KTMT', 1, 'Yêu cầu sinh viên am hiểu về hệ thống mạng. bảo mật và có khả năng tự nghiên cứu', '', 118, 0, 0, 1),
(58, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Tìm hiểu các phần mềm giả lập thiết bị mạng', 'KTMT', 1, 'Yêu cầu sinh viên am hiểu về hệ thống mạng  và có khả năng tự nghiên cứu', '', 118, 0, 0, 1),
(59, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Quản trị mạng với Windows server 2016', 'KTMT', 1, 'Yêu cầu sinh viên am hiểu về hệ thống mạng  và có khả năng tự nghiên cứu', '', 118, 0, 0, 1),
(60, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Bài toán lập lịch luồng công việc trong Cloud Computing', 'KTMT', 1, 'Sinh viên cần có khả năng lập trình Java hoặc C#. Có khả năng về thuật toán, đọc tài liệu tiếng Anh', '', 119, 0, 0, 1),
(61, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Bài toán MS-RCPSP', 'KTMT', 1, 'Sinh viên cần có khả năng lập trình Java hoặc C#. Có khả năng về thuật toán, đọc tài liệu tiếng Anh', '', 119, 0, 0, 1),
(62, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Tìm hiểu về thuật toán Support Vector Machine', 'KTMT', 1, 'Yêu cầu sinh viên có kiến thức cơ bản về xử lý ảnh và có khả năng sử dụng ngôn ngữ lập trình cơ bản, đồng thời có khả năng tìm hiểu và sử dụng các thư viện hỗ trợ trong xử lý ảnh', '', 120, 0, 0, 1),
(63, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Tìm hiểu về bài toán phân loại và mô hình hồi quy Logistic', 'KTMT', 1, 'Yêu cầu sinh viên có kiến thức cơ bản về xử lý ảnh và có khả năng sử dụng ngôn ngữ lập trình cơ bản, đồng thời có khả năng tìm hiểu và sử dụng các thư viện hỗ trợ trong xử lý ảnh', '', 120, 0, 0, 1),
(64, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Vận dụng “học tập dựa trên trò chơi” hỗ trợ đánh giá kết quả học tập của học sinh trong dạy học chương Cấu trúc rẽ nhánh và lặp', 'PPGD', 1, '', '', 121, 0, 0, 1),
(65, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Phát triển năng lực tự học cho học sinh thông qua thiết kế học liệu tự học có hướng dẫn trong dạy học chủ đề D – Đạo đức, pháp luật và văn hoá trong môi trường số ở trường Trung học phổ thông', 'PPGD', 1, '', '', 122, 0, 0, 1),
(66, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Phát triển năng lực tự học cho học sinh thông qua thiết kế học liệu tự học có hướng dẫn trong dạy học chủ đề E – Ứng dụng Tin học ở trường Trung học phổ thông', 'PPGD', 1, '', '', 122, 0, 0, 1),
(67, '2021-08-26 08:38:12', '2021-08-26 08:38:12', 'Tích cực hóa hoạt động của học sinh thông qua thiết kế các hoạt động học dưới dạng trò chơi (game-based learning) trong dạy học chủ đề E- Ứng dụng Tin học ở trường Trung học phổ thông', 'PPGD', 1, '', '', 122, 0, 0, 1),
(68, '2021-08-26 08:38:13', '2021-08-26 08:38:13', 'Một số biện pháp tổ chức dạy học chủ đề “Phần mềm thiết kế đồ họa” ở lớp 10, trung học phổ thông', 'PPGD', 1, '', '', 123, 0, 0, 1),
(69, '2021-08-26 08:38:13', '2021-08-26 08:38:13', 'Một đề xuất triển khai nội dung dạy học chuyên đề “Chỉnh sửa ảnh” ở lớp 11, trung học phổ thông', 'PPGD', 1, '', '', 123, 0, 0, 1),
(70, '2021-08-26 08:38:13', '2021-08-26 08:38:13', 'Thực hiện kiểm tra, đánh giá thường xuyên như một hoạt động học khi dạy học chủ đề “Lập trình cơ bản” ở lớp 10, trung học phổ thông', 'PPGD', 1, '', '', 123, 0, 0, 1);

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
(1, 'Quản trị viên', 'admin', 'tranhailong0807@gmail.com', 1, '', '', '', '1', NULL, '2021-02-23 13:21:53', '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, '2021-01-16 03:12:42', '2021-01-16 03:12:42'),
(2, 'Giáo vụ 1', 'giaovu01', '', 2, '', '', '', NULL, NULL, '2021-02-01 00:27:32', '$2b$12$ArJpPGPZ2BZ/fD.VmDODwugI5fDP2XEs7U5ZS8EAWqEZzg9yZnGtK', NULL, NULL, '2021-01-16 03:12:42', '2021-09-02 10:34:06'),
(3, 'Ban chủ nhiệm Khoa 1', 'bcnkhoa01', NULL, 3, '', '', '', '1', NULL, '2021-01-29 23:20:46', '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, '2021-01-16 03:12:46', '2021-09-02 10:06:52'),
(108, 'TS. Nguyễn Thị Thanh Huyền', 'huyenntt', 'ntthuyen@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 10:25:06'),
(109, 'TS. Đặng Thành Trung', 'trungdt', 'trungdt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 09:57:25'),
(110, 'ThS. Nguyễn Thị Hạnh', 'hanhnt', 'hanhit@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 10:18:00'),
(111, 'PGS. TS Trần Đăng Hưng', 'hungtd', 'hungtd@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(112, 'PGS. TS Phạm Thọ Hoàn', 'hoanpt', 'hoanpt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 10:11:00'),
(113, 'TS. Phạm Thị Anh Lê', 'lepta', 'lepta@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(114, 'TS. Lê Thị Tú Kiên', 'kienltt', 'kienltt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(115, 'CN. Lê Xuân Hiền', 'hienlx', 'lexuanhien@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(116, 'ThS. Phạm Thị Lan', 'lanpt', 'ptlan@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(117, 'TS. Đỗ Trung Kiên', 'kiendt', 'kiendt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(118, 'ThS. Vũ Thái Giang', 'giangvt', 'giangvt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(119, 'TS. Nguyễn Thế Lộc', 'locnt', 'locnt@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(120, 'ThS. Nguyễn thị Quỳnh Hoa', 'hoantq', 'hoantq@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, '2021-09-02 09:52:13'),
(121, 'ThS. Nguyễn Thị Hồng', 'hongnt', 'nguyenthihong@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(122, 'ThS. Kiều Phương Thùy', 'thuykp', 'thuykp@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(123, 'TS. Nguyễn Chí Trung', 'trungnc', 'trungnc@hnue.edu.vn', 4, '', '', '', NULL, NULL, NULL, '$2y$12$GcKySLnA268yjdN3SwmK2.1oZbsBeXjp3zah3iEO0LR6UrqfLtvku', NULL, NULL, NULL, NULL),
(128, 'Phạm Quang Huy', '685105031', '685105031@gmail.com', 5, '', 'K68', '', NULL, NULL, '2021-09-05 14:05:26', '$2y$10$pNyCzmdQuKOhW1XgP8xhiOpCYTg6fTTHVjwc2AX7fLub13w/1PQ/.', NULL, NULL, NULL, '2021-09-05 14:05:26'),
(129, 'Nhữ Duy Thìn', '685105061', '685105061@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$ycGuAa6hXGRXXDDWeKhs.e8C9lEDW13NrOxXVQzeZxGxmkLZ8sLjq', NULL, NULL, NULL, NULL),
(130, 'Đinh Quang Đạo', '685105012', '685105012@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$ojL3GiPbYiSx1L.L96UMROi1TbV3toptjRdFDeOtihteImFE0QIJm', NULL, NULL, NULL, NULL),
(131, 'Lê Thị Nga', '685105043', '685105043@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$XbyBqPOt0p2yFuZEE7QDTOmweooP4jatnXPVKMvNkmc/yI188w/G.', NULL, NULL, NULL, NULL),
(132, 'Nguyễn Minh Phương', '685105053', '685105053@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$EU6Zpz0rvhdfzpwrFVaYueohCEwYoX/Ws.ZWLQxjte2PltGq6Dmoe', NULL, NULL, NULL, NULL),
(133, 'Lê Thị Ngọc', '685105046', '685105046@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$5zUL3agwffYP9ynf2NvxX.7ePmQ449Rsms1iOwc0UTxla4Sqmijtq', NULL, NULL, NULL, NULL),
(134, 'Vũ Thành Vinh', '685105079', '685105079@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$k8LhCiGO8s5GQVFvSK2VVecA9z5Lo0QthO6lbmm8r1v81ptj0qF0m', NULL, NULL, NULL, NULL),
(135, 'Vũ Bá Thọ', '685105062', '685105062@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$SyiWyLnZFBmeS4VLX1ufLeaESl70z.hmpXC7FesI2zBTaP1kBhv4G', NULL, NULL, NULL, NULL),
(136, 'Lưu Anh Tú', '685105073', '685105073@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$rbfkeTrEr42eE6jLtNyAWev/55h8tbMgYoPqAY9NTvwnjcdHJStvm', NULL, NULL, NULL, NULL),
(137, 'Nguyễn Hải Phong', '685105050', '685105050@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$J0SYXUWnfTEBHMKCeop2A.2kVLyP5BjSSyvgDL2521LUYk9OBL0lm', NULL, NULL, NULL, NULL),
(138, 'Nguyễn Thị Kim Ngân', '685105044', '685105044@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$ekSOaxyJob8IQffV3BrlzeTR6bs5srr1rtSekfsqlpUkE4ubFFqju', NULL, NULL, NULL, NULL),
(139, 'Lê Nguyên Hưng', '685105033', '685105033@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$jGVF4IHTVF9m3PbyEGlX4OtfYsGDtfT7yfqDGr.adnGOoSnoltJOy', NULL, NULL, NULL, NULL),
(140, 'Dương Thị Thanh Nga', '685105042', '685105042@gmail.com', 5, '', 'K68', '', NULL, NULL, '2021-09-05 14:08:38', '$2y$10$KecdSQWScTFv4go0HISKiuIzAoKscGWAiQRDiL.lQiilXYb/5AjYm', NULL, NULL, NULL, '2021-09-05 14:08:38'),
(141, 'Trịnh Trung Hiếu', '685105027', '685105027@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$Nhp9/dJPiU3HBGqQ9d0WyO/1Hme0w2gyClp4Rsj.gERV3OYc6/9Sq', NULL, NULL, NULL, NULL),
(142, 'Mai Văn Hiểu', '685105022', '685105022@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$AbE8F/Rzz7Z3ci55MuWgEOle5bghrUKUCiO09eOWZDm.thDdiVhSi', NULL, NULL, NULL, NULL),
(143, 'Vũ Công Thành', '685105057', '685105057@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$fOnGv5WG69ZHJ7.0rK.Xge3VidWTg.M/6LmeRk9uOXBSGH21ICqsi', NULL, NULL, NULL, NULL),
(144, 'Mai Thái Dương', '685105010', '685105010@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$wrmmsW9QAaLVmTPtbTvkBeH3Pik1lZ5t0tMOAMj.0fWsF7m4Fehji', NULL, NULL, NULL, NULL),
(145, 'Trần Thị Thu Hà', '685105015', '685105015@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$GLniGX5OmTmSsvfH4AMwnOPbingJ33PR114GuANy.Uaws3CHYtDDi', NULL, NULL, NULL, NULL),
(146, 'Mai Thiên Quang Anh', '685105004', '685105004@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$bHUohts47LCBK7uwaZ/OM.tK9n2QZsX9uAfpS5c94xK1aNP27Etw2', NULL, NULL, NULL, NULL),
(147, 'Nguyễn Thị Thanh Ngân', '685105045', '685105045@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$8R7Ap1ptU1zgDAywgogmdef5QuQojPH6UpfnWHVmBW/LYvk7TF5wO', NULL, NULL, NULL, NULL),
(148, 'Trần Thị Loan', '685102006', '685102006@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$441T6T.u3MkT4BgSU6XC1uUecB0pSBb6zSPCy5seTeXXnKZ53zbhC', NULL, NULL, NULL, NULL),
(149, 'Đỗ Anh Văn', '685102014', '685102014@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$Qsm1XQET9qia2jm1SSHpROJI3lG2vW.LVTQsiPw61K6Is5NvNUMFK', NULL, NULL, NULL, NULL),
(150, 'Bùi Thị Khuy', '685102002', '685102002@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$j9KwRZLMhAxwI.DJ3uLUWOtn7AD1bOCh.rn67APw70K9eO9jssXR2', NULL, NULL, NULL, NULL),
(151, 'Nguyễn Thu Phương', '685102009', '685102009@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$J0HyK9GbNZnj8tjxIdDwResgiYov4U70.CMUNmqJB08fLMEU8q012', NULL, NULL, NULL, NULL),
(152, 'Nguyễn Thị Thoan', '685102013', '685102013@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$nqpOxu/oM2uQFHooIqeBYOpQIg0ctqgxeOdU4w6qqv3m1ugF8CNZq', NULL, NULL, NULL, NULL),
(153, 'Vũ Thị Thanh Thảo', '685102012', '685102012@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$Sh4Q4GYXTeM1a27RQPx5DeVB5usTBD4MbwVZq1pFFRH9f2kNO2v9m', NULL, NULL, NULL, NULL),
(154, 'Trần Thị Kim Loan', '685102005', '685102005@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$xa0W.dTYDYBtpMlZ9r91wO36Yok1inTY9aiBq/6lk8ccubDll7L.C', NULL, NULL, NULL, NULL),
(155, 'Phạm Trung Kiên', '685102003', '685102003@gmail.com', 5, '', 'K68', '', NULL, NULL, NULL, '$2b$12$FIiUTJxf2WWsv2ROebOj.OXJIRqOQLb9nhpRVWmovE/3gW9z9On9C', NULL, NULL, NULL, NULL),
(156, 'Phạm Thị Lý', '665302010', '665302010@gmail.com', 5, '', 'K68', '', NULL, NULL, '2021-09-05 14:10:24', '$2y$10$o3eEyFspT9TRfncKtWHWN.ynhx3JW46x0PP5q5QRUWZZWhroa./3y', NULL, NULL, NULL, '2021-09-05 14:10:24'),
(158, 'Hải Long', '665105037', 'tranhailong8798@gmail.com', 5, '', 'K66', '', NULL, NULL, '2021-09-04 04:50:39', '$2y$10$S1kCt0vaPizylgSzaKvAhO96icdJ3uVK0sDcaJpbFmtLF8f7/RybG', NULL, NULL, '2021-09-04 04:50:39', '2021-09-04 04:50:39');

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
