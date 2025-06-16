-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2025 a las 19:38:00
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
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('si','no') NOT NULL,
  `excusa` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `estudiante_id`, `fecha`, `estado`, `excusa`, `created_at`, `updated_at`) VALUES
(5, 31, '2025-05-06', 'si', NULL, '2025-05-06 16:46:53', '2025-05-06 16:46:53'),
(6, 31, '2025-05-07', 'si', NULL, '2025-05-07 13:12:29', '2025-05-07 13:12:29'),
(7, 31, '2025-05-07', 'no', 'Esta enfermo', '2025-05-07 14:04:46', '2025-05-07 14:04:46'),
(8, 31, '2025-05-08', 'si', NULL, '2025-05-08 12:36:14', '2025-05-08 12:36:14'),
(9, 31, '2025-05-08', 'si', NULL, '2025-05-08 12:37:36', '2025-05-08 12:37:36'),
(10, 31, '2025-05-19', 'si', NULL, '2025-05-19 15:51:25', '2025-05-19 15:51:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaspbj`
--

CREATE TABLE `asistenciaspbj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `asistio` tinyint(1) NOT NULL,
  `excusa` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistenciaspbj`
--

INSERT INTO `asistenciaspbj` (`id`, `estudiante_id`, `fecha`, `asistio`, `excusa`, `created_at`, `updated_at`) VALUES
(13, 10, '2025-05-08', 1, NULL, '2025-05-08 15:05:23', '2025-05-08 15:05:23'),
(14, 11, '2025-05-08', 1, NULL, '2025-05-08 15:05:23', '2025-05-08 15:05:23'),
(15, 10, '2025-05-09', 1, NULL, '2025-05-09 15:10:08', '2025-05-09 15:10:08'),
(16, 11, '2025-05-09', 1, NULL, '2025-05-09 15:10:08', '2025-05-09 15:10:08'),
(17, 10, '2025-05-20', 1, NULL, '2025-05-20 15:21:26', '2025-05-20 15:21:26'),
(18, 11, '2025-05-20', 0, NULL, '2025-05-20 15:21:27', '2025-05-20 15:21:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `grado` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `profesor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante_materia`
--

CREATE TABLE `estudiante_materia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventospbj`
--

CREATE TABLE `eventospbj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eventospbj`
--

INSERT INTO `eventospbj` (`id`, `titulo`, `descripcion`, `fecha`, `created_at`, `updated_at`) VALUES
(1, 'Día de la independencia', 'ougi', '2025-05-19', '2025-05-06 16:12:24', '2025-05-06 16:12:24'),
(2, 'Día de la madre', '456456', '2025-06-18', '2025-06-16 14:52:24', '2025-06-16 14:52:24');

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
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `porcentual` decimal(5,2) NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `profesor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_pbj`
--

CREATE TABLE `materias_pbj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias_pbj`
--

INSERT INTO `materias_pbj` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(2, 'Español', '2025-05-09 20:05:27', '2025-05-19 14:27:38'),
(3, 'Matemáticas', '2025-05-09 20:05:40', '2025-05-09 20:05:40'),
(4, 'Educación Física', '2025-05-09 20:06:06', '2025-05-09 20:06:06'),
(5, 'Inglés', '2025-05-19 13:37:04', '2025-05-19 13:37:45'),
(6, 'Estadística', '2025-05-19 13:37:22', '2025-05-19 13:37:22'),
(7, 'Geometría', '2025-05-19 13:38:07', '2025-05-19 13:38:07'),
(8, 'Artística', '2025-05-19 13:38:25', '2025-05-19 13:38:25'),
(9, 'Religión', '2025-05-19 13:38:36', '2025-05-19 13:38:36'),
(10, 'Emprendimiento', '2025-05-19 13:38:54', '2025-05-19 13:38:54'),
(11, 'Informática', '2025-05-19 13:39:17', '2025-05-19 13:39:17'),
(12, 'Física', '2025-05-19 13:40:07', '2025-05-19 13:40:07'),
(13, 'Química', '2025-05-19 13:40:44', '2025-05-19 13:40:44'),
(14, 'Ética y Valores', '2025-05-19 13:41:49', '2025-05-19 13:41:49'),
(15, 'Biología', '2025-05-19 13:42:46', '2025-05-19 13:42:46'),
(16, 'Geografía e Historia', '2025-05-19 13:43:14', '2025-05-19 13:43:14'),
(18, 'Física Cuántica', '2025-05-27 14:00:20', '2025-05-27 14:00:20');

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 2),
(4, '2025_02_24_144316_create_preguntas_table', 4),
(5, '2025_02_26_105429_create_cursos_table', 5),
(6, '2025_02_28_113831_create_respuestas_table', 6),
(7, '2025_03_05_104415_create_eventos_table', 7),
(8, '2025_03_11_090223_create_materias_table', 8),
(9, '2025_03_11_115107_create_estudiante_materia_table', 9),
(10, '2025_02_18_224807_create_sessions_table', 10),
(19, '2025_03_27_093501_create_asistencias_table', 11),
(20, '2025_04_03_121818_create_usuarios_p_b_j_table', 12),
(21, '2025_04_14_145139_create_preguntas_pbj_table', 13),
(22, '2025_04_14_152030_create_preguntas_pbj_table', 14),
(24, '2025_04_15_124711_create_respuestapbj_table', 15),
(25, '2025_04_24_100512_create_preguntas_pbj_table', 16),
(27, '2025_04_25_092752_create_respuestas_pbj_table', 17),
(28, '2025_04_28_114909_create_eventospbj_table', 18),
(29, '2025_05_07_100906_create_asistenciaspbj_table', 19),
(30, '2025_05_09_124101_create_materias_pbj_table', 20),
(31, '2025_05_23_114034_create_periodo1_p_b_j_table', 21),
(32, '2025_05_26_092625_create_periodo1pbj_table', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo1pbj`
--

CREATE TABLE `periodo1pbj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `nota1` decimal(3,1) DEFAULT NULL,
  `nota2` decimal(3,1) DEFAULT NULL,
  `nota3` decimal(3,1) DEFAULT NULL,
  `nota4` decimal(3,1) DEFAULT NULL,
  `nota5` decimal(3,1) DEFAULT NULL,
  `nota6` decimal(3,1) DEFAULT NULL,
  `promedio` decimal(3,1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `periodo1pbj`
--

INSERT INTO `periodo1pbj` (`id`, `estudiante_id`, `materia_id`, `nota1`, `nota2`, `nota3`, `nota4`, `nota5`, `nota6`, `promedio`, `created_at`, `updated_at`) VALUES
(92, 10, 2, 5.0, 4.4, 3.5, 4.9, 5.0, 5.0, 4.6, '2025-06-06 19:19:13', '2025-06-06 19:23:20'),
(93, 11, 2, 4.8, 4.9, 5.0, 5.0, 5.0, 5.0, 5.0, '2025-06-06 19:19:13', '2025-06-06 19:23:20'),
(94, 12, 2, 4.8, 4.5, 4.2, 3.3, 4.9, 3.9, 4.3, '2025-06-06 19:19:13', '2025-06-06 19:23:20'),
(95, 13, 2, 4.3, 4.6, 4.1, 5.0, 3.9, 4.9, 4.5, '2025-06-06 19:19:13', '2025-06-06 19:23:21'),
(96, 14, 2, 5.0, 4.8, 5.0, 4.9, 4.5, 4.6, 4.8, '2025-06-06 19:19:13', '2025-06-06 19:23:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo2pbj`
--

CREATE TABLE `periodo2pbj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `nota1` decimal(3,1) DEFAULT NULL,
  `nota2` decimal(3,1) DEFAULT NULL,
  `nota3` decimal(3,1) DEFAULT NULL,
  `nota4` decimal(3,1) DEFAULT NULL,
  `nota5` decimal(3,1) DEFAULT NULL,
  `nota6` decimal(3,1) DEFAULT NULL,
  `promedio` decimal(3,1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `periodo2pbj`
--

INSERT INTO `periodo2pbj` (`id`, `estudiante_id`, `materia_id`, `nota1`, `nota2`, `nota3`, `nota4`, `nota5`, `nota6`, `promedio`, `created_at`, `updated_at`) VALUES
(46, 10, 3, 5.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.8, '2025-06-16 15:13:27', '2025-06-16 15:13:27'),
(47, 11, 3, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, '2025-06-16 15:13:27', '2025-06-16 15:13:27'),
(48, 12, 3, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, '2025-06-16 15:13:27', '2025-06-16 15:13:27'),
(49, 13, 3, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, '2025-06-16 15:13:27', '2025-06-16 15:13:27'),
(50, 14, 3, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, '2025-06-16 15:13:27', '2025-06-16 15:13:27'),
(51, 10, 2, 4.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.7, '2025-06-16 15:13:34', '2025-06-16 15:18:22'),
(52, 11, 2, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, '2025-06-16 15:13:34', '2025-06-16 15:18:23'),
(53, 12, 2, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, '2025-06-16 15:13:34', '2025-06-16 15:18:23'),
(54, 13, 2, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, '2025-06-16 15:13:34', '2025-06-16 15:18:23'),
(55, 14, 2, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, '2025-06-16 15:13:34', '2025-06-16 15:18:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `texto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `texto`, `created_at`, `updated_at`) VALUES
(3, '¿Tienes padres?', '2025-04-21 16:56:01', '2025-04-21 16:56:01'),
(4, 'Te ha gustado la plataforma', '2025-04-25 19:46:57', '2025-04-25 19:46:57'),
(5, 'Hay inconformidad con la nueva plataforma web de ASODISVALLE?', '2025-04-25 19:47:56', '2025-04-25 19:47:56'),
(6, 'Te ha gustado la plataforma', '2025-05-06 16:07:05', '2025-05-06 16:07:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_pbj`
--

CREATE TABLE `preguntas_pbj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pregunta_id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `pregunta_id`, `estudiante_id`, `respuesta`, `created_at`, `updated_at`) VALUES
(5, 3, 31, 'Sí', '2025-04-25 17:17:24', '2025-04-25 17:17:24'),
(6, 4, 31, 'Sí', '2025-04-25 19:47:15', '2025-04-25 19:47:15'),
(7, 5, 31, 'No', '2025-04-25 19:48:04', '2025-04-25 19:48:04'),
(8, 3, 37, 'Sí', '2025-05-06 16:02:48', '2025-05-06 16:02:48'),
(9, 4, 37, 'Sí', '2025-05-06 16:02:48', '2025-05-06 16:02:48'),
(10, 5, 37, 'No', '2025-05-06 16:02:48', '2025-05-06 16:02:48'),
(11, 3, 32, 'Sí', '2025-05-06 16:10:15', '2025-05-06 16:10:15'),
(12, 4, 32, 'Sí', '2025-05-06 16:10:15', '2025-05-06 16:10:15'),
(13, 5, 32, 'No', '2025-05-06 16:10:16', '2025-05-06 16:10:16'),
(14, 6, 32, 'Sí', '2025-05-06 16:10:16', '2025-05-06 16:10:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_pbj`
--

CREATE TABLE `respuestas_pbj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pregunta_pbj_id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
('CofaHtHSqrzAVP3vVPQXcN0wCP2rxANtw8vNqO68', 99999999, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'ZXlKcGRpSTZJakZCVGprclRIVnNkbEZ4UWt4WE0xa3JkRzVrZUhjOVBTSXNJblpoYkhWbElqb2lTRE55ZVZOMGVDdHNTRzFUV2pNMmFYbHBPV2h3U0VKdk1rSlpjbFZrU2xOb01ISnpWbmw2YW5ac01FcExSM0JqTUZGMk5HSk9aVEZwZVM5elMzVTNOVk5CWVhvMFYwaE1UVlJDU0RkelpsZEhhbkV4TlZCMldVc3hPV280V0Uxdk1tRjJTMGRTTjFWdk1sUTFjVVZEVkhaeFFuTnZkRE5QU0d0c2JGb3hOMjlsZVd0VlkySmpRVGQ1TkZseE0zY3JjamxSY21oR2NHTndRVUp3WkhneE9HTkhMelEzU1ROc1MwOXBhaXRRV25JNU1qaE1TRzg1ZFRKbVkzTmxjbE12YTNGWVdHOVVRMnBxVjFGdVZrTXdUV1l5ZVc5eU1IUktRMUpKUkRsbFJYVlZlRE5KWTFCbmRHTmFlakJ1TjJ3NWJESm9URmgzTlZOdmExaG1aQ3N4VTJONVRXUjZVRVF4T0dJMVpFMDBZMm94TDNkUE1GQnJNRlZXTHpJMWNYZGljR2xxTkRJeFpuSnZVVTlZYlZSeVN6bFRjbFZXVmpjNGNGSkJhVnBKYVZOTlRIZFZOemt4WkVWSk0zZzJTRUo0WVZSQlVWcEpUbXBCTm5aWlIxWjBNMGRVWkVaUmFFUmtNazFDVm1sWWIyRk5NMHBPU3pONmRGQndPRVJOU0RGNlJUbGtTRU0xUmtWQmVrWktZbVprVFhwSldVMUNjMjVLY1RCR2JVTlNUSGwyYmtkbGFHc3pkM0Z6VVcxT2FWbHhXa2xhWkVaQmRubFdWV1ZQWm1GdmNHSXlOR000UWpkR1MxZDZNbEJsTWt3eE5YSlhTVWhKVm05SlkyTjZaM05EYm5kMmRIZENiVnBMYjFoSlVHZE9ORnBTY3paWlpHSm9Ua2g1VUdGWmJrWWlMQ0p0WVdNaU9pSmlPVEkzTnpsak1qSXpNelUyTVdRNFpqRXdPR0ZsTXpjME1UUTBORGhsTVRjM01HWXlZbVEyWVdFeFpXUXlOMlJrTnpFeVpERmpOek5tT0ROa04yVXdJaXdpZEdGbklqb2lJbjA9', 1746542717),
('irtb2Pts4wpinDgV6OUBSwgUTGABhKfKUlHnioX3', 99999999, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'ZXlKcGRpSTZJa3AxWTI1alRVcHllWHAyYWxGWVIwaGhTWFI2VUVFOVBTSXNJblpoYkhWbElqb2lSMWxCYzFVM2RWVk5OelJvZHpoS04wWnNXR1ZLUXl0UGRXWTJlV05wWkdjeU0yTllhMFo1VUV4aE1rcHpSMk5GVHpWdFZqRXZPRnBFYVZnMVoxaDFSekZIYVhVcllVcHplRzlUVHpsRmN6SkxLemxoY0V0dFpEUXpSbE5aVW5kbVpFTndTa3d3VUVsQ2RIcHJSRFF5VGtsMk1GRnVNbFYwTDA5VVZVbEpjMHRVV21Wdk1tTnRNVzFwYW5sU1J6SjFVVmhoTkV0eE4yMWFTbWRMYnpoRGJpdHFNV2Q2WTNka1VVZDVia1U1Vm1aaWVHMXVZUzltT0dkRVZITlBhVGxIYVRCNWFWRjJORkU1VlRobFJVbG5WMlJHZEdJelNEQjRXQzk2U2tzNVZsQkNNVlZaY0dsM05HOWFUVmMyVFRkTU9YTnJkV2c1WWxkSWFuTnJkbVpwVG1KaVVXOUlkMkYyY0VOaFdrNXFTRGRTVVVKcU1IUlVjM051VlRWa2R6SlBWV1F5TVV4WlJYbGhSa3d2VnpFelNuY3hkR2xFVUVwWVF6UXZWR00xT0ROelJVUTNTWEpDYVNzMWIwaEZSalUwTWt4bVRHSjJZblozYmpGQlFtUlFUVVoyVXpCM1EyUkhTWEJ5Y0hKb2VWVXdZbXhHTXpCaVFXeElSVTV4WjBGS1RYRkpaR2c1WjJkeE1rVnpXR3RZVGxKbmRUZElXWGs0VjB0SmFFcHdTemg0VVROMmMwVnRVRE4zY2xOaU0zSXlhRGhYUVVSdWJrUllSMFJNYlZCbldrbEJTMGRSVHk4NUszSlBhRFJuZDJWamNITkVPRGg0Y0ROWE5qRm1PVUpvVEVaRldqaFhiV2d4YkUwOUlpd2liV0ZqSWpvaVltRTBabU00WmprelkyTmxOR1UzWmpabU9XTTFNek00WVRsa056bGpOVEppTkRWaVl6ZGpNVGxrTUdOa1ltWTVZMlZoTkdZMU1ERTJNakV5TkRNeFppSXNJblJoWnlJNklpSjk=', 1744392606);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `grado` varchar(255) DEFAULT NULL,
  `discapacidad` varchar(255) DEFAULT NULL,
  `descripcionDiscapacidad` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `curso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `nombre`, `email`, `usuario`, `password`, `grado`, `discapacidad`, `descripcionDiscapacidad`, `telefono`, `curso_id`, `created_at`, `updated_at`) VALUES
(23, 'admin', 'johann Velez', 'johann@gmail.com', '1006110834', '$2y$12$q1dXfY8fuhUM0mF/8syVhOJCDajlL.F6DidcMhkIyj3eN9PLwYHt.', NULL, 'no', NULL, NULL, NULL, '2025-03-25 16:43:05', '2025-03-25 16:43:05'),
(24, 'admin', 'Stiven Yesid Pantoja Castro', 'stibenpantoja963@gmail.com', '1004339757', '$2y$12$HDTS1xP6abeDd8dF.rNshOR4VqWgrPoJLxP7bIguqAEdUZwP4vqzS', NULL, 'no', NULL, '3015207617', NULL, '2025-03-26 13:35:48', '2025-05-06 16:06:51'),
(28, 'profesor', 'mariana lopez', 'marianalopez@gmail.com', '99999999', '$2y$12$1CHQ0cNDTU0LYxPhL1UTk.UXlB7taApR6nCje0LT55hRxq4mFSbjy', 'Jardin', 'no', NULL, '3004246600', NULL, '2025-03-26 15:52:22', '2025-05-06 16:09:24'),
(29, 'profesor', 'Helany Caicedo', 'Hecai@gmail.com', '888888', '$2y$12$Rcim/QOj3KjknnZmWIFwG.l6TFNBJys22Ur6XzbNUjFOpmNSRVToO', 'Pimer Grado', 'no', NULL, NULL, NULL, '2025-03-26 16:57:06', '2025-03-26 16:57:06'),
(31, 'estudiante', 'Pepe Grillo', 'pegry@gmail.com', '666666', '$2y$12$TgqjydoTutu/I1pjo7VLlOj2itaHOWoWLPV1r2YagcT4/s2BtjMeS', 'Jardin', 'no', NULL, NULL, NULL, '2025-03-27 14:09:31', '2025-03-27 14:09:31'),
(32, 'estudiante', 'penasdro angulo', 'nasdro@gmail.com', '555555', '$2y$12$v8iKc.Q2r33ou.NEXxjVFe6wqu4vhSn14Gf.wYV2FBO9mOJ.hhiBm', 'Pimer Grado', 'no', NULL, NULL, NULL, '2025-03-27 14:12:17', '2025-05-06 16:10:01'),
(36, 'evaluador_pedagogico', 'cristina pedagoga', 'cristi@gmail.com', '443322', '$2y$12$p5U4pOM4uKMwa6gwUPmhpONOI4NWuFBXy9lJ6cOTv.gi1dGcIrraG', NULL, NULL, NULL, NULL, NULL, '2025-04-04 20:46:44', '2025-04-04 20:46:44'),
(37, 'estudiante', 'Soraya Mera', 'sora@gmail.com', '444444', '$2y$12$VDApq2adidB/uQ5FlwZeY.x4HPO1rlELXZpkAWd7EnzI8CVmXNdSC', 'Segundo Grado', 'no', NULL, NULL, NULL, '2025-05-06 16:01:40', '2025-05-06 16:01:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariospbj`
--

CREATE TABLE `usuariospbj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `grado` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `curso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuariospbj`
--

INSERT INTO `usuariospbj` (`id`, `role`, `nombre`, `email`, `usuario`, `password`, `grado`, `telefono`, `curso_id`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'juan juan', 'juan@gmail.com', '151515', '$2y$12$R7LYlFDNdu8x2K.dCTccpOaoZ9xUsF2MJopoqiZ3eH8MeOF6nfylq', NULL, '3004246600', NULL, '2025-04-04 17:37:57', '2025-05-06 16:12:01'),
(4, 'profesor', 'cristina valverde', 'cristi@gmail.com', '161616', '$2y$12$bQdti9dxsADXsT2bLUFZEOXoxe8y3RujDsdZQYK0CJG2Z13.4pgtm', '3', '3125221212', NULL, '2025-04-09 17:22:53', '2025-05-06 12:58:34'),
(5, 'estudiante', 'sanson vique', 'sanso@gmail.com', '111111', '$2y$12$wSBdPMAJPRk0ilzOPou2O.5bN6ycWCBV3sxB0Rb4c7W.zsyVf4..a', '5', '3114456896', NULL, '2025-04-10 20:55:35', '2025-05-06 16:24:48'),
(7, 'profesor', 'Pepito Angulo', 'pepi@gmail.com', '333333', '$2y$12$.jPXvTTBRsjWJSOCec/R8.weWbWe6ZYRiLf9RrfdZbScBKmh8CSuO', '11', '3112225522', NULL, '2025-05-06 13:13:25', '2025-05-06 13:13:25'),
(8, 'profesor', 'mariana lopez', 'marianalopez@gmail.com', '888888', '$2y$12$oVxKvsZSyuOyJ0EoK2UkkOE5IDve2oHFSyRNMGFmRLzMMPy2iuw9m', '5', '3625564556', NULL, '2025-05-06 16:11:39', '2025-05-06 16:13:12'),
(9, 'estudiante', 'Edwar Mauricio Pantoja Portilla', 'Edwar@gmail.com', '757575', '$2y$12$NFR2Jdcdm/aFMmpct33QrOoyCJ80by1yy0PsORcit.QvVnZlpETde', '5', '3216827174', NULL, '2025-05-07 16:31:14', '2025-05-07 16:31:14'),
(10, 'estudiante', 'Adriana Saldaña Marin Mejia', 'adri@gmail.com', '858585', '$2y$12$6GCc/nQ.asSKDHxrRmlxg.0aOax6V4A9sz7rCOpvgjCODb0yDlueq', '3', '3111132123', NULL, '2025-05-07 16:35:25', '2025-05-07 16:35:25'),
(11, 'estudiante', 'Juan de Dios Pantoja Velez', 'velez@gmail.com', '959595', '$2y$12$loyATwUZmTIq.Hlcq4lCruy9fgo73aT8xQ2fBB/eWGJvCiWw8ijT.', '3', '3652363232', NULL, '2025-05-08 12:20:17', '2025-05-08 12:20:17'),
(12, 'estudiante', 'Pepito de pasto', 'pasto@gmail.com', '363636', '$2y$12$MZQ.J2aadP1LP9vdNeVtJuhlE4wD.iDmfNje/gvzWADF5k5Oq3eke', '3', '3663663636', NULL, '2025-05-21 15:13:18', '2025-05-21 15:13:18'),
(13, 'estudiante', 'angulo martinez', 'mars@gmail.com', '636363', '$2y$12$0BdFbp7C4VCUY7KA/BBNFuWhN2jkRssBhD7me91pvjTQJS/7jwdsW', '3', '3663663636', NULL, '2025-05-21 15:16:45', '2025-05-21 15:16:45'),
(14, 'estudiante', 'Paula Andrea Rivera', 'andrea@gmail.com', '878787', '$2y$12$RveMJw0Dv5U/yUbvY42Fo.IOZAlwCPbT5Zl5bcaqhDWqZaQlooUHm', '3', '3111156556', NULL, '2025-05-26 21:35:35', '2025-05-26 21:35:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistencias_estudiante_id_foreign` (`estudiante_id`);

--
-- Indices de la tabla `asistenciaspbj`
--
ALTER TABLE `asistenciaspbj`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistenciaspbj_estudiante_id_foreign` (`estudiante_id`);

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
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cursos_profesor_id_foreign` (`profesor_id`);

--
-- Indices de la tabla `estudiante_materia`
--
ALTER TABLE `estudiante_materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante_materia_user_id_foreign` (`user_id`),
  ADD KEY `estudiante_materia_materia_id_foreign` (`materia_id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventospbj`
--
ALTER TABLE `eventospbj`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materias_curso_id_foreign` (`curso_id`),
  ADD KEY `materias_profesor_id_foreign` (`profesor_id`);

--
-- Indices de la tabla `materias_pbj`
--
ALTER TABLE `materias_pbj`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `periodo1pbj`
--
ALTER TABLE `periodo1pbj`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodo1pbj_estudiante_id_foreign` (`estudiante_id`);

--
-- Indices de la tabla `periodo2pbj`
--
ALTER TABLE `periodo2pbj`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodo2pbj_estudiante_id_foreign` (`estudiante_id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas_pbj`
--
ALTER TABLE `preguntas_pbj`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuestas_pregunta_id_foreign` (`pregunta_id`),
  ADD KEY `respuestas_estudiante_id_foreign` (`estudiante_id`);

--
-- Indices de la tabla `respuestas_pbj`
--
ALTER TABLE `respuestas_pbj`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuestas_pbj_pregunta_pbj_id_foreign` (`pregunta_pbj_id`),
  ADD KEY `respuestas_pbj_estudiante_id_foreign` (`estudiante_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuariospbj`
--
ALTER TABLE `usuariospbj`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuariospbj_email_unique` (`email`),
  ADD UNIQUE KEY `usuariospbj_usuario_unique` (`usuario`),
  ADD KEY `usuariospbj_curso_id_foreign` (`curso_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `asistenciaspbj`
--
ALTER TABLE `asistenciaspbj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estudiante_materia`
--
ALTER TABLE `estudiante_materia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventospbj`
--
ALTER TABLE `eventospbj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `materias_pbj`
--
ALTER TABLE `materias_pbj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `periodo1pbj`
--
ALTER TABLE `periodo1pbj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `periodo2pbj`
--
ALTER TABLE `periodo2pbj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `preguntas_pbj`
--
ALTER TABLE `preguntas_pbj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `respuestas_pbj`
--
ALTER TABLE `respuestas_pbj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `usuariospbj`
--
ALTER TABLE `usuariospbj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asistenciaspbj`
--
ALTER TABLE `asistenciaspbj`
  ADD CONSTRAINT `asistenciaspbj_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `usuariospbj` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `estudiante_materia`
--
ALTER TABLE `estudiante_materia`
  ADD CONSTRAINT `estudiante_materia_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `estudiante_materia_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materias_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `periodo1pbj`
--
ALTER TABLE `periodo1pbj`
  ADD CONSTRAINT `periodo1pbj_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `usuariospbj` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `periodo2pbj`
--
ALTER TABLE `periodo2pbj`
  ADD CONSTRAINT `periodo2pbj_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `usuariospbj` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_pregunta_id_foreign` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas_pbj`
--
ALTER TABLE `respuestas_pbj`
  ADD CONSTRAINT `respuestas_pbj_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `usuariospbj` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_pbj_pregunta_pbj_id_foreign` FOREIGN KEY (`pregunta_pbj_id`) REFERENCES `preguntas_pbj` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuariospbj`
--
ALTER TABLE `usuariospbj`
  ADD CONSTRAINT `usuariospbj_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
