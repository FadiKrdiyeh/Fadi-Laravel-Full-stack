-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 12:36 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_styles`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Fadi Krdiyeh', '66fadiiiiii66@gmail.com', '$2y$10$ppBKKY5NPgblSMs6QIBGIeVwi3RkTbQ9hEEkKFJH3OI3myO.3TaDm');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('Example@gmail.com', '$2y$10$3GyQChiD/O6YXvr4uNpT0.hMmTVf1FyFg3eCgdzrCpGESeWnD.xm6', '2022-03-20 09:24:25'),
('Example5@gmail.com', '$2y$10$YLvD674rgIIBbQYkcR3eFOQT7buCf9Zc2QWf1jTvhBnxU3DROMVBC', '2022-03-30 10:39:22'),
('Example6@gmail.com', '$2y$10$7tANMfFMPxGoYZdL3xjI6ubvt5R8Nj7/r7larLAy1dQxbeCqlyfte', '2022-03-30 10:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `pay_status`
--

CREATE TABLE `pay_status` (
  `id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0 => Not Paied\r\n1 => Paied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `media` varchar(255) NOT NULL,
  `html_code` text NOT NULL,
  `css_code` text DEFAULT NULL,
  `js_code` text DEFAULT NULL,
  `style_rate` float NOT NULL DEFAULT 5,
  `pays_count` int(11) NOT NULL DEFAULT 0,
  `free_status` int(1) NOT NULL DEFAULT 1 COMMENT '0 => free\r\n1 => paied',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `request_status` int(1) NOT NULL DEFAULT 0 COMMENT '0 => Not Accepted\r\n1 => Accepted',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `title`, `description`, `media`, `html_code`, `css_code`, `js_code`, `style_rate`, `pays_count`, `free_status`, `created_at`, `updated_at`, `request_status`, `user_id`) VALUES
(12, 'lskdfn', 'Final Test For TestFinal Test For TestFinal Test For TestFinal Test For TestFinal Test For TestFinal Test For Test', '16458884931.png', 'public $timestamps = false;\r\n\r\npublic function setCreatedAtAttribute()\r\n{\r\n    $this->attributes[\'created_at\'] = \\Carbon\\Carbon::now()->timestamp;\r\n}', 'public $timestamps = false;\r\n\r\npublic function setCreatedAtAttribute()\r\n{\r\n    $this->attributes[\'created_at\'] = \\Carbon\\Carbon::now()->timestamp;\r\n}', 'public $timestamps = false;\r\n\r\npublic function setCreatedAtAttribute()\r\n{\r\n    $this->attributes[\'created_at\'] = \\Carbon\\Carbon::now()->timestamp;\r\n}', 5, 0, 0, '2022-02-26 15:14:53', '2022-03-05 10:11:40', 1, 1),
(15, 'Style3', 'This Style For Test And It Is Bla Bla Bla...', '16459740951.png', 'sa,fdnasf', 'as.dmasmd', 'lm;emfdf', 5, 0, 1, '2022-02-27 15:01:35', '2022-03-05 10:10:14', 1, 1),
(17, 'Amjad', 'This Style Created To Show to Amjad The Idea Of The Project', '16462414521.png', 'lkdsjflksdf', 'sdlkfjq', ';ldsf', 5, 0, 1, '2022-03-02 17:17:32', '2022-03-15 10:59:14', 1, 1),
(18, 'Ahmed', 'This Style Named Fuckin Ahmed..He Is Gay', '16463145441.jpg', '<html>', 'body{}', ';lksdaffs', 5, 0, 1, '2022-03-03 13:35:44', '2022-03-05 10:03:38', 1, 1),
(19, 'Request 1', 'I Don\'t Know What Is The Need Of This Style', '16463743813.png', 'ddfff', 'dsfd', ';lkdf', 5, 0, 1, '2022-03-04 06:13:01', '2022-03-15 11:00:46', 1, 3),
(34, 'Test hhh2', ';lsmdf;lm', '16464938851.png', 'sld;\'mf', 'ld;smg', 'ldmg', 5, 0, 0, '2022-03-05 15:24:45', '2022-03-22 13:16:54', 1, 1),
(43, 'Test Again', '\'sdgf', '16465038723.jpg', '.,dsf', ',fdsgq', 'sdf', 5, 0, 0, '2022-03-05 18:11:12', '2022-03-22 12:59:28', 1, 3),
(46, 'kjgkg', ';.sdlf', '16466589011.png', '.lfnv', ';nf;', ';lf;', 5, 0, 1, '2022-03-07 13:15:01', '2022-03-28 07:56:19', 1, 1),
(47, 'Admin', 'Admin Style.. Posted By Admin For Test Creating Styles By Admin', '16466591931.png', ';lfd;;kj', ';sldkfjg;', ';j;fdgj', 5, 0, 1, '2022-03-07 13:19:53', '2022-03-22 13:17:47', 1, 0),
(48, 'Admin 2', 'Admin 2 Style.. Also Posted By Admin For Test Creating Styles', '16466593421.png', ';.dlfnj', ';dlfj', 'gf;ldf', 5, 0, 1, '2022-03-07 13:22:22', '2022-03-16 13:48:26', 1, 0),
(49, 'Admin 4', 'Admin 4 Style.. Also Posted By Admin For Test Creating Styles', '16466596501.png', '.dlkjf', ';ljefl;j', ';jf;lk', 5, 0, 1, '2022-03-07 13:27:30', '2022-03-22 13:16:08', 1, 0),
(50, 'Admin Test', 'Admin 2 Style.. Also Posted By Admin For Test Creating StylesAdmin 2 Style.. Also Posted By Admin For Test Crea...Admin 2 Style.. Also Posted By Admin For Test Crea...Admin 2 Style.. Also Posted By Admin For Test Crea...Admin 2 Style.. Also Posted By Admin For Test Crea...Admin 2 Style.. Also Posted By Admin For Test Crea...', '16473536011.png', ';lsdm;lsdf', ';ldms;lfm;sdlmf', ';lm;dsmf;sdmf', 5, 0, 1, '2022-03-15 14:13:21', '2022-03-15 12:13:21', 1, 0),
(51, 'Test Request', '', '16480402921.jpg', '<div class=\"face back back-{{$style->id}}\">\r\n                                        <div class=\"card text-center\">\r\n                                            <div class=\"card-header\">\r\n                                                <div class=\"btn btn-danger hide-details-btn d-flex justify-content-center align-items-center\" style-id=\"{{ $style->id }}\"><i class=\"fa fa-times-circle-o\"></i></div>\r\n                                                <h5 class=\"lead details-t\">Details: </h5>\r\n                                            </div>\r\n                                            <div class=\"card-body\">\r\n                                                <h5 class=\"card-title\">\r\n                                                    <span class=\"title\">Title: <span class=\"inner-title\">{{ $style -> title }}</span></span>\r\n                                                </h5>\r\n                                                <div class=\"card-text\">\r\n                                                    <div class=\"lead description-t\">Description: </div>\r\n                                                    <span class=\"description\">\r\n                                                        {!! Str::words($style -> description, 20, \' <a href=\"\' . route(\"admin.show.style\", $style -> id) . \'\">Read More...</a>\') !!}\r\n                                                    </span>\r\n                                                </div>\r\n                                            </div>\r\n                                            <div class=\"card-footer text-muted\">\r\n                                                <span class=\"footer-titles\">Posted At:</span> {{ $style -> created_at }}\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>', '.form-text {\r\n                color: $darkFontColor;\r\n                font-size: 25px;\r\n                margin-right: 20px;\r\n            }', '$.ajax({\r\n                type: \'post\',\r\n                url: \"{{ route(\'admin.accept.style\') }}\",\r\n                data: {\r\n                    \'_token\': \"{{csrf_token()}}\",\r\n                    \'style_id\': styleId,\r\n                    \'is_free\': isFree\r\n                },\r\n                beforeSend: function(){\r\n                    $(\'#accept-\' + styleId).html(\'<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i><span class=\"sr-only\">Loading...</span>\');\r\n                    $(\'#accept-\' + styleId).prop(\'disabled\', true);\r\n                    $(\'#accept-\' + styleId).css(\'cursor\', \'not-allowed\');\r\n                    $(\'#delete-\' + styleId).prop(\'disabled\', true);\r\n                    $(\'#delete-\' + styleId).css(\'cursor\', \'not-allowed\');\r\n                },\r\n                success: function (data) {\r\n                    if (data.status == true) {\r\n                        $(\'#success_msg\').fadeIn().fadeOut(6000);\r\n                        $(\'.style-\' + styleId).fadeOut().remove();\r\n                    }\r\n                }, error: function (reject) {}\r\n            });', 5, 0, 0, '2022-03-23 12:58:12', '2022-04-02 06:39:57', 1, 1),
(52, 'Test Remove', ';sldf;sldf', '16480418231.jpg', ';lsdkmfs;dkf', ';lknsd;flsdkf', ';lks;dfsdf', 5, 0, 1, '2022-03-23 13:23:43', '2022-03-28 08:22:51', 1, 1),
(53, 'Test Notification', 'lkf;', '16480435331.jpg', 'dlfsjdf', 'jdfj', 'dw;fj', 5, 0, 1, '2022-03-23 13:52:13', '2022-03-23 11:52:13', 0, 1),
(54, 'fadi', 'kjgkjg', '16483951101.jpg', 'kugkfyh', 'lkhl', 'kjgkjg', 5, 0, 1, '2022-03-27 15:31:50', '2022-03-28 07:59:43', 1, 1),
(56, 'Request 654', 'I Don\'t Know What Is The Need Of This Style', '16463743813.png', 'ddfff', 'dsfd', ';lkdf', 5, 0, 1, '2022-03-04 06:13:01', '2022-03-15 11:00:46', 1, 3),
(57, 'Style3934', 'This Style For Test And It Is Bla Bla Bla...', '16459740951.png', 'sa,fdnasf', 'as.dmasmd', 'lm;emfdf', 5, 0, 1, '2022-02-27 15:01:35', '2022-03-05 10:10:14', 1, 1),
(58, 'Admin Test12834', 'Admin 2 Style.. Also Posted By Admin For Test Creating StylesAdmin 2 Style.. Also Posted By Admin For Test Crea...Admin 2 Style.. Also Posted By Admin For Test Crea...Admin 2 Style.. Also Posted By Admin For Test Crea...Admin 2 Style.. Also Posted By Admin For Test Crea...Admin 2 Style.. Also Posted By Admin For Test Crea...', '16473536011.png', ';lsdm;lsdf', ';ldms;lfm;sdlmf', ';lm;dsmf;sdmf', 5, 0, 1, '2022-03-15 14:13:21', '2022-03-15 12:13:21', 1, 0),
(59, 'Test Notification2134', 'lkf;', '16480435331.jpg', 'dlfsjdf', 'jdfj', 'dw;fj', 5, 0, 1, '2022-03-23 13:52:13', '2022-03-23 11:52:13', 0, 1),
(60, ',sdjfsdkjf', 'sdjfsdf', '16499264071.jpg', 'cv,', 'sdkfj', 'sdlkf', 5, 0, 1, '2022-04-14 08:53:27', '2022-04-14 05:53:27', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `style_ratings`
--

CREATE TABLE `style_ratings` (
  `id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0 COMMENT '0 => 0 Star\r\n1 => 0.5 Star\r\n2 => 1 Star\r\n3 => 1.5 Stars\r\n4 => 2 Stars\r\n5 => 2.5 Stars\r\n6 => 3 Stars\r\n7 => 3.5 Stars\r\n8 => 4 Stars\r\n9 => 4.5 Stars\r\n10 => 5 Stars'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `wallet`, `created_at`, `updated_at`) VALUES
(1, 'Fadi', 'Example@gmail.com', NULL, '$2y$10$rHuPjfGrTz4vhQa1UEUcSey/PeptGOqHFXE/ppioIleDFYsCnesr.', NULL, 0, '2022-02-25 08:00:11', '2022-02-25 08:00:11'),
(3, 'Fadi2', 'Example2@gmail.com', NULL, '$2y$10$iA7.XsxQrfWgRw2BvcP8Je/jjIgEHbFojid7y7.2h9yZ1QdARl3my', NULL, 0.49, '2022-03-01 08:08:57', '2022-03-15 11:00:46'),
(4, 'Fadi3', 'Example3@gmail.com', NULL, '$2y$10$xfwTi38UMM5X/9CN2D1dQ.Z6SP1YjokqsWLqJwsKvRopMKm1WNrqu', NULL, 0, '2022-03-30 09:40:46', '2022-03-30 09:40:46'),
(5, 'Fadi4', 'Example4@gmail.com', NULL, '$2y$10$1CWYf2fuL0ba6x.Uc0JzgODpYbJ7PSSJH8kKqKNRVxWJNmoam3pcG', NULL, 0, '2022-03-30 09:52:49', '2022-03-30 09:52:49'),
(6, 'Fadi5', 'Example5@gmail.com', NULL, '$2y$10$yVeUCwNXBihDZbgw2VoUaOONzMuwC1qYphg3SOwhx9vOkDY6pgNfu', NULL, 0, '2022-03-30 10:07:42', '2022-03-30 10:07:42'),
(7, 'Fadi5', '66fadiiiiii66@gmail.com', NULL, '$2y$10$XTdvEjWvDGfALrjJK1/RcO1x0BYqe9yIv92VOmS9OPw/qwZKf43B6', NULL, 0, '2022-03-30 10:10:00', '2022-03-30 10:10:00'),
(8, 'Fadi6', 'Example6@gmail.com', NULL, '$2y$10$EBQVMj2QcuYUjz553xlEpOWlkUv4DF0AXUBNLIoTgJZt05zIVxeEa', NULL, 0, '2022-03-30 10:23:13', '2022-03-30 10:23:13'),
(9, 'Fadi7', 'Example7@gmail.com', NULL, '$2y$10$QEqfyRj4hJu6WwnzN8ykiehqIWbrtWzVPtBu42qlc6ktzzTw9SsoO', NULL, 0, '2022-03-30 10:34:22', '2022-03-30 10:34:22'),
(10, 'Fadi8', 'Example8@gmail.com', NULL, '$2y$10$wxOMEIwlQqiKJ.I/SMAHwOyGtjrJy0AeIYT4HR2su.fHSl.LwEpAq', NULL, 0, '2022-03-30 10:36:03', '2022-03-30 10:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `total_visitors` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `total_visitors`) VALUES
(1, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pay_status`
--
ALTER TABLE `pay_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `style_ratings`
--
ALTER TABLE `style_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pay_status`
--
ALTER TABLE `pay_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `style_ratings`
--
ALTER TABLE `style_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
