/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 8.0.30 : Database - raportmini
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `attendance_records` */

DROP TABLE IF EXISTS `attendance_records`;

CREATE TABLE `attendance_records` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sakit` int NOT NULL DEFAULT '0',
  `alpha` int NOT NULL DEFAULT '0',
  `izin` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendance_records_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `attendance_records_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `attendance_records` */

insert  into `attendance_records`(`id`,`siswa_id`,`semester`,`sakit`,`alpha`,`izin`,`created_at`,`updated_at`) values 
(1,3,'Semester 1',5,4,3,'2024-12-10 16:45:09','2024-12-10 16:45:09'),
(2,14,'Semester 1',2,2,2,'2024-12-10 17:10:01','2024-12-10 17:10:01'),
(3,15,'Semester 1',3,3,3,'2024-12-10 17:10:07','2024-12-10 17:10:07'),
(4,2,'Semester 1',6,6,6,'2025-01-02 08:44:37','2025-01-02 08:44:37');

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `ekskul` */

DROP TABLE IF EXISTS `ekskul`;

CREATE TABLE `ekskul` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ekskul` */

insert  into `ekskul`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'tester','2024-12-11 11:11:43','2025-01-02 07:56:48');

/*Table structure for table `ekskul_scores` */

DROP TABLE IF EXISTS `ekskul_scores`;

CREATE TABLE `ekskul_scores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `ekskul_id` bigint unsigned NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ekskul_scores_siswa_id_foreign` (`siswa_id`),
  KEY `ekskul_scores_ekskul_id_foreign` (`ekskul_id`),
  CONSTRAINT `ekskul_scores_ekskul_id_foreign` FOREIGN KEY (`ekskul_id`) REFERENCES `ekskul` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ekskul_scores_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ekskul_scores` */

insert  into `ekskul_scores`(`id`,`siswa_id`,`ekskul_id`,`semester`,`score`,`description`,`created_at`,`updated_at`) values 
(1,15,1,'Semester 1',3,'g','2024-12-11 11:12:02','2024-12-11 06:21:59'),
(6,14,1,'Semester 1',1,'1sdas','2024-12-11 04:44:16','2024-12-11 06:21:00'),
(16,3,1,'Semester 1',100,'sdds','2024-12-12 03:04:18','2024-12-12 03:04:18');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `guru` */

DROP TABLE IF EXISTS `guru`;

CREATE TABLE `guru` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_guru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guru_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `guru` */

insert  into `guru`(`id`,`nama_guru`,`email`,`nip`,`created_at`,`updated_at`) values 
(2,'ARYO','sas@adsa.g','13213','2024-12-06 01:38:43','2024-12-12 08:46:51'),
(14,'ADE','derrick.streich@example.com','324343','2024-12-12 08:47:52','2024-12-12 08:47:52');

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kelas` */

insert  into `kelas`(`id`,`nama_kelas`,`created_at`,`updated_at`) values 
(1,'10','2024-12-05 19:25:09','2024-12-05 19:25:09'),
(2,'11','2024-12-05 19:25:13','2024-12-05 19:25:13'),
(3,'12','2024-12-05 19:25:17','2024-12-05 19:25:17');

/*Table structure for table `kkm` */

DROP TABLE IF EXISTS `kkm`;

CREATE TABLE `kkm` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kelas_id` bigint unsigned NOT NULL,
  `kkm_value` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kkm_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `kkm_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kkm` */

insert  into `kkm`(`id`,`kelas_id`,`kkm_value`,`created_at`,`updated_at`) values 
(11,3,70,'2024-12-12 04:10:17','2024-12-12 04:14:50');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2024_12_05_190518_create_kelas_table',1),
(5,'2024_12_05_190519_create_guru_table',2),
(6,'2024_12_05_190519_create_siswa_table',3),
(7,'2024_12_05_190519_create_walikelas_table',4),
(8,'2024_12_05_190518_create_pelajaran_table',5),
(9,'2024_12_05_190520_create_nilai_table',6),
(10,'2024_12_06_093413_add_semester_to_nilai_table',7),
(11,'2024_12_10_164127_create_attendance_records_table',8),
(12,'2024_12_11_040334_create_eskul_table',9),
(13,'2024_12_12_033847_create_kkm_table',10),
(14,'2024_12_12_055445_create_settings_table',11),
(15,'2024_12_12_062940_create_sikap_table',12),
(16,'2024_12_12_081753_add_status_kenaikan_to_siswa_table',13),
(17,'2024_12_12_082630_add_next_kelas_id_to_siswa_table',14);

/*Table structure for table `nilai` */

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `pelajaran_id` bigint unsigned NOT NULL,
  `nilai` int NOT NULL,
  `prediket` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_2` int DEFAULT NULL,
  `prediket_2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nilai_siswa_id_foreign` (`siswa_id`),
  KEY `nilai_pelajaran_id_foreign` (`pelajaran_id`),
  CONSTRAINT `nilai_pelajaran_id_foreign` FOREIGN KEY (`pelajaran_id`) REFERENCES `pelajaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nilai_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `nilai` */

insert  into `nilai`(`id`,`siswa_id`,`pelajaran_id`,`nilai`,`prediket`,`nilai_2`,`prediket_2`,`deskripsi`,`semester`,`created_at`,`updated_at`) values 
(33,3,5,34,'b',45,'b','df','Semester 1','2024-12-12 09:08:42','2024-12-29 13:54:47'),
(34,14,5,55,'g',66,'4','ff','Semester 1','2024-12-29 13:55:02','2024-12-29 13:55:02'),
(35,15,5,77,'b',88,'6','6','Semester 1','2024-12-29 13:55:27','2024-12-29 13:55:27'),
(36,3,7,55,'g',55,'g','g','Semester 1','2024-12-29 13:56:00','2024-12-29 13:56:00'),
(37,14,7,77,'5',55,'d','d','Semester 1','2024-12-29 13:56:15','2024-12-29 13:56:15'),
(38,15,7,76,'gg',66,'e','e','Semester 1','2024-12-29 13:59:49','2024-12-29 13:59:49'),
(39,2,6,2,'2',2,'2','2','Semester 1','2025-01-02 07:42:25','2025-01-02 07:42:25');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `pelajaran` */

DROP TABLE IF EXISTS `pelajaran`;

CREATE TABLE `pelajaran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `guru_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pelajaran_guru_id_foreign` (`guru_id`),
  KEY `pelajaran_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `pelajaran_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pelajaran_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pelajaran` */

insert  into `pelajaran`(`id`,`nama_pelajaran`,`kelas_id`,`guru_id`,`created_at`,`updated_at`) values 
(5,'matematika',3,14,'2024-12-12 08:55:56','2024-12-12 08:56:08'),
(6,'PJOK',2,14,'2024-12-12 08:57:35','2024-12-12 08:57:35'),
(7,'B.indo',3,2,'2024-12-12 08:57:48','2024-12-12 08:57:48');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('82f80fYskVAYrtllgY6x1VPxrMEB1y95pJQrC5o8',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSERFQ2F2Z083RTZEenM5aEpLTVRMaENySjhjOHVNd3BTNjlDaTRBQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vcmFwb3J0bWluaS5jb20vd2FsaWtlbGFzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1735807442),
('EpPT24LYeD16ioaNP2wUqQ8jtqGl3sVVaTdFbo8Q',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZFFjTGZlQmFZTm1taU9xWDU5SU92MVcyZHJ0TU55aUVLYWREcVVvQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHBzOi8vcmFwb3J0bWluaS5jb20vcmFwb3IvY2V0YWsvc2lzd2EvMTQ/c2VtZXN0ZXI9U2VtZXN0ZXIlMjAxIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9',1735809819),
('iE9MuszyzsbMVc4skSGV81Qoi3fhMiuHUTIJZrBm',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlk2REVSWGEwdkVXaXZoc0dWcW45YWVaRE5tWmVUcWlCR2RsRWM3SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vcmFwb3J0bWluaS5jb20vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1735834967),
('TtKVbto6DbjlbA5VxkpbnaxWZmwiWgGvn0XBGkoE',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSHN4TDFSSWlwMVVXRWp5cVBpMU15NkNDeUJPdGFVaE55SUduTmVTWSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMjoiaHR0cHM6Ly9yYXBvcnRtaW5pLmNvbS9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyODoiaHR0cHM6Ly9yYXBvcnRtaW5pLmNvbS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1735810489);

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kepsek_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepsek_nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`kepsek_name`,`kepsek_nip`,`telp`,`email`,`academic_year`,`created_at`,`updated_at`) values 
(1,'argo sunandar.M.pd','1231231232','12312312','admin@gmail.com','2024/2025','2024-12-12 05:58:23','2025-01-02 08:05:21');

/*Table structure for table `sikap` */

DROP TABLE IF EXISTS `sikap`;

CREATE TABLE `sikap` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `spiritual_desc` longtext COLLATE utf8mb4_unicode_ci,
  `social_desc` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sikap_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `sikap_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sikap` */

insert  into `sikap`(`id`,`siswa_id`,`spiritual_desc`,`social_desc`,`created_at`,`updated_at`) values 
(3,3,'2','2','2024-12-12 07:05:46','2024-12-12 07:05:46'),
(4,14,'asd','dasd','2024-12-12 07:54:02','2024-12-12 07:54:02'),
(5,15,'asd','sd','2024-12-12 07:54:07','2024-12-12 07:54:07');

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kenaikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `next_kelas_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswa_nis_unique` (`nis`),
  KEY `siswa_kelas_id_foreign` (`kelas_id`),
  KEY `siswa_next_kelas_id_foreign` (`next_kelas_id`),
  CONSTRAINT `siswa_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `siswa_next_kelas_id_foreign` FOREIGN KEY (`next_kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `siswa` */

insert  into `siswa`(`id`,`nama_siswa`,`nis`,`status_kenaikan`,`kelas_id`,`next_kelas_id`,`created_at`,`updated_at`) values 
(1,'goni','11',NULL,1,NULL,'2024-12-06 03:10:43','2024-12-06 09:25:26'),
(2,'heru','66',NULL,2,NULL,'2024-12-06 07:53:15','2024-12-06 09:25:31'),
(3,'anto','23132','Tinggal',3,NULL,'2024-12-07 07:21:11','2024-12-12 08:23:02'),
(14,'ane','22',NULL,3,NULL,'2024-12-07 07:21:11','2024-12-07 07:21:11'),
(15,'anr','223',NULL,3,NULL,'2024-12-07 07:21:11','2024-12-07 07:21:11');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `level` enum('admin','kepsek','walikelas') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`level`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin ku','admin@gmail.com',NULL,'admin','$2y$12$CIw0Z1POYxKAmZyFyliMxeK.3Rc499ECwNzN2IsI7sMn5Hx.mpfiu',NULL,'2024-12-05 19:24:53','2024-12-07 06:56:28'),
(3,'Anto Purnomo.S.pd','walikelas@gmail.com',NULL,'walikelas','$2y$12$/R6pf.xVrtbvuw9kMP/Ep..bkzB6nppFOup63YJKMr9cZoBHTKkxO',NULL,'2024-12-07 07:00:13','2024-12-12 05:44:22'),
(19,'kepsek','kepsek@gmail.com',NULL,'kepsek','$2y$12$oxr.MyCSVTaq3NULvPlTCewpUNBus2STEhuKj9p.XBG0p0kF44Q9u',NULL,'2025-01-02 07:40:47','2025-01-02 07:40:47'),
(20,'parjo','parjo@gmail.com',NULL,'walikelas','$2y$12$HysrREiuxEHia12jfevXXu7pMx9sc4MwCqs3Zh43WnstnUeBqQZQi',NULL,'2025-01-02 07:41:26','2025-01-02 07:41:26');

/*Table structure for table `walikelas` */

DROP TABLE IF EXISTS `walikelas`;

CREATE TABLE `walikelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `guru_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `walikelas_guru_id_foreign` (`guru_id`),
  KEY `walikelas_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `walikelas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  CONSTRAINT `walikelas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `walikelas` */

insert  into `walikelas`(`id`,`user_id`,`guru_id`,`kelas_id`,`created_at`,`updated_at`) values 
(13,3,14,3,'2024-12-12 08:59:01','2025-01-02 08:25:11'),
(14,20,2,2,'2025-01-02 07:41:39','2025-01-02 08:25:01');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
