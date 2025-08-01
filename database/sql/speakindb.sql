-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2025 a las 06:19:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `speakindb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `type` enum('task','material','guide') NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `attachments`
--

INSERT INTO `attachments` (`id`, `course_id`, `title`, `file_url`, `type`, `uploaded_at`, `created_at`, `updated_at`) VALUES
(2, 3, 'Magic Guide', 'attachments/iiSOon7aHktxYlZap7YgBvs4vEuxDYm7Fs0c0Z1A.pdf', 'material', '2025-07-31 09:11:57', '2025-07-31 09:11:57', '2025-08-01 03:40:35'),
(4, 2, 'test_archivo', 'attachments/J9DiRP2xX1gP2a4rn9azB1qEcNJ4Gvnv7xh3TaqV.pdf', 'material', '2025-08-01 03:41:21', '2025-08-01 03:41:21', '2025-08-01 03:41:21'),
(5, 2, 'final_review', 'attachments/0vgYcWlarch5knR9qDQ1t8WplIy1veVvrmjzvEsr.pdf', 'material', '2025-08-01 06:58:31', '2025-08-01 06:58:31', '2025-08-01 06:58:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('speakinapp-cache-123@123.com|127.0.0.1', 'i:1;', 1754018273),
('speakinapp-cache-123@123.com|127.0.0.1:timer', 'i:1754018273;', 1754018273),
('speakinapp-cache-admin@speakin.com|127.0.0.1', 'i:1;', 1754018730),
('speakinapp-cache-admin@speakin.com|127.0.0.1:timer', 'i:1754018730;', 1754018730),
('speakinapp-cache-teacher@speakin.to|127.0.0.1', 'i:1;', 1754019455),
('speakinapp-cache-teacher@speakin.to|127.0.0.1:timer', 'i:1754019455;', 1754019455),
('speakinapp-cache-teacher2@speakin.com|127.0.0.1', 'i:2;', 1753989473),
('speakinapp-cache-teacher2@speakin.com|127.0.0.1:timer', 'i:1753989473;', 1753989473);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','finished','cancelled') NOT NULL DEFAULT 'active',
  `modality` enum('on_site','virtual','hybrid') NOT NULL,
  `virtual_link` varchar(255) DEFAULT NULL,
  `max_capacity` int(10) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `start_date`, `end_date`, `status`, `modality`, `virtual_link`, `max_capacity`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 'English Level 1', 'Basic English course for disociative minds', '2025-08-07', '2025-10-31', 'active', 'on_site', NULL, 20, 2, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(2, 'Español de supervivencia', 'Español con dialecto del salvaje Oeste', '2025-08-14', '2025-12-01', 'active', 'virtual', 'https://meet.example.com/spanish', 15, 2, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(3, 'Advanced Magic', 'Curso avanzado de magia y hechizos', '2025-08-21', '2025-10-01', 'active', 'hybrid', 'https://meet.example.com/magic', 10, 3, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(4, 'Curso Extra 1', 'Curso extra para prueba de límite 1', '2025-08-01', '2025-10-01', 'active', 'on_site', NULL, 10, 2, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(6, 'Curso Extra 3', 'Curso extra para prueba de límite 3', '2025-08-03', '2025-10-01', 'active', 'on_site', NULL, 10, 2, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(7, 'Curso Extra 4', 'Curso extra para prueba de límite 4', '2025-08-04', '2025-10-01', 'active', 'on_site', NULL, 10, 2, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(8, 'Curso Extra 5', 'Curso extra para prueba de límite 5', '2025-08-05', '2025-10-01', 'active', 'on_site', NULL, 10, 2, '2025-07-31 09:11:57', '2025-07-31 09:11:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_date` date NOT NULL,
  `status` enum('enrolled','in_progress','approved','failed') NOT NULL DEFAULT 'enrolled',
  `final_grade` tinyint(3) UNSIGNED DEFAULT NULL,
  `attendance` tinyint(3) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `graded_by_teacher` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `course_id`, `enrollment_date`, `status`, `final_grade`, `attendance`, `notes`, `graded_by_teacher`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '2025-07-31', 'enrolled', 8, 92, 'Good performance', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(3, 3, 1, '2025-07-31', 'enrolled', 9, 84, 'Good performance', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(4, 4, 1, '2025-07-31', 'enrolled', 6, 100, 'Good performance', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(5, 5, 1, '2025-07-31', 'enrolled', 7, 95, 'Good performance', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(6, 6, 3, '2025-07-31', 'enrolled', 8, 90, 'Magical performance', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(7, 7, 3, '2025-07-31', 'enrolled', 7, 86, 'Magical performance', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(8, 8, 3, '2025-07-31', 'enrolled', 8, 92, 'Magical performance', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(9, 9, 4, '2025-07-31', 'enrolled', 7, 97, 'Prueba de límite de cursos activos', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(11, 9, 6, '2025-07-31', 'enrolled', 6, 88, 'Prueba de límite de cursos activos', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(12, 9, 7, '2025-07-31', 'enrolled', 9, 89, 'Prueba de límite de cursos activos', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(13, 9, 8, '2025-07-31', 'enrolled', 9, 93, 'Prueba de límite de cursos activos', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(14, 9, 1, '2025-08-01', 'enrolled', NULL, NULL, NULL, 0, '2025-08-01 03:27:55', '2025-08-01 03:27:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluations`
--

CREATE TABLE `evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `score` tinyint(3) UNSIGNED DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evaluations`
--

INSERT INTO `evaluations` (`id`, `student_id`, `course_id`, `score`, `comments`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 10, 'Well done!', '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(3, 3, 1, 8, 'Well done!', '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(4, 4, 1, 6, 'Well done!', '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(5, 5, 1, 8, 'Well done!', '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(6, 6, 3, 9, 'Excellent magic!', '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(7, 7, 3, 10, 'Excellent magic!', '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(8, 8, 3, 10, 'Excellent magic!', '2025-07-31 09:11:57', '2025-07-31 09:11:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_27_052900_create_students_table', 1),
(5, '2025_07_27_052901_create_courses_table', 1),
(6, '2025_07_27_052902_create_enrollments_table', 1),
(7, '2025_07_27_052903_create_evaluations_table', 1),
(8, '2025_07_27_052904_create_attachments_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('d6SyJTUQLtL7WpFXBHR1lZ4gZGBiX2vAH67mGXbr', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjVwOXM5dlBjZTU2NndGNExiUHBGOFlEZllpbVA0UmVRRjQ0dzEyayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hdHRhY2htZW50cy80L2VkaXQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1754020994),
('U0Ax4CeGhvIBIaOv7XFjkADcMCYBD7m8WseyRmwO', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQkVQeW1iZDFNTm0wTndrdWJHMjlJckFTa1g2TWNKVW00Q0E5TXhTTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9lbnJvbGxtZW50cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1754020990),
('ZB8oZLOnsEYj7R1hPd5JzGgj02zxaPqhLtECRN3p', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN2lvRDNxZ0YzQ3Q4VlFRVGl3ZDMyaTd3dUN2NzlZRzBBVkJCTzFwVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9lbnJvbGxtZW50cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1754019609);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dni` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `dni`, `email`, `birth_date`, `phone`, `address`, `gender`, `active`, `created_at`, `updated_at`) VALUES
(2, 'Waino', 'Wunsch', '59451483', 'lindsey45@example.org', '1990-05-09', '(854) 852-2509', '61614 Lowe Expressway Suite 066\nLaurynstad, NC 80039-4462', 'male', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(3, 'Karianne', 'O\'Connell', '82436154', 'jenkins.myrna@example.net', '1970-12-19', '(520) 890-3392', '424 Marks Stravenue\nSouth Marietta, ID 07383', 'other', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(4, 'Dennis', 'Bauch', '15711253', 'guy34@example.org', '2004-09-17', '+12237415541', '83953 Gutmann Place\nMartyland, ME 82116-4316', 'female', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(5, 'Luna', 'Kohler', '08117350', 'joseph19@example.org', '1985-07-21', '+1 (615) 607-5424', '71596 Barton Crescent\nLebsackport, KS 00540-2644', 'female', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(6, 'Berenice', 'Ernser', '10079875', 'agleichner@example.net', '1993-06-12', '858.729.5361', '43867 Bauch Station Suite 883\nSmithborough, WV 41040-1828', 'other', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(7, 'Elian', 'Rohan', '57898765', 'jeffrey.hoppe@example.com', '1996-02-11', '+1.608.257.2741', '96449 Linnea Ridge Suite 225\nGrahamland, KY 66943-6398', 'female', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(8, 'Ciara', 'Carroll', '64442416', 'devonte63@example.org', '2005-06-20', '334.943.9860', '8819 Deangelo Greens Apt. 528\nGerholdborough, UT 90019', 'male', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(9, 'Eulalia', 'Feeney', '77777777', 'limit@student.com', '1986-05-18', '1-786-932-5301', '34410 Wunsch Turnpike\nNew Cloyd, NC 42902-3976', 'female', 1, '2025-07-31 09:11:57', '2025-07-31 09:11:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','coordinator','professor') NOT NULL DEFAULT 'professor',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'AllmightyAdmin', 'admin@speakin.to', NULL, '$2y$12$ombN8UpV.RZ4r1CEfeR/E.0krK9uikev53dJwJWAzUCuuBd4l4XMO', 'admin', NULL, '2025-07-31 09:11:56', '2025-07-31 09:11:56'),
(2, 'Dewey Finn', 'dewey@speakin.to', NULL, '$2y$12$6kYTdtfhKV80t.Q1M65EOuRut97jCGbNwQ5BVZcxlcn5XzuIQCAyu', 'professor', NULL, '2025-07-31 09:11:56', '2025-07-31 09:11:56'),
(3, 'Minerva McGonagall', 'minerva@speakin.to', NULL, '$2y$12$ogxAuEd8n1j70g.h/79.Qu9/Hk1O0ACVRVfY45ayrbj0FhKxbrHK2', 'professor', NULL, '2025-07-31 09:11:56', '2025-07-31 09:11:56'),
(4, 'Corgi the Coordinator', 'coordinator@speakin.to', NULL, '$2y$12$60O5mzpGK53Cl/YcEL1Q3.Zq7rvrDjVR/4hTbN1RGviVpbwjGZjB2', 'coordinator', NULL, '2025-07-31 09:11:57', '2025-07-31 09:11:57'),
(5, 'Hermione Granger', 'hermione@speakin.to', NULL, '$2y$12$Li11NdE9IdT.Kkh87e5LMuEQD2SMLScX./nGBCRclN1Bre97KYbdq', 'coordinator', NULL, '2025-07-31 09:11:57', '2025-07-31 09:11:57');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_course_id_foreign` (`course_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_teacher_id_foreign` (`teacher_id`);

--
-- Indices de la tabla `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enrollments_student_id_course_id_unique` (`student_id`,`course_id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`);

--
-- Indices de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluations_student_id_foreign` (`student_id`),
  ADD KEY `evaluations_course_id_foreign` (`course_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_dni_unique` (`dni`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
