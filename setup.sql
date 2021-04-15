--
-- Table structure for table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE `discussion` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `author` int(8) NOT NULL,
  `message` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `document_history`
--

DROP TABLE IF EXISTS `document_history`;
CREATE TABLE `document_history` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `doc_id` int(8) NOT NULL,
  `author` int(8) NOT NULL,
  `edit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `diff` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `doc_id` (`doc_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `author` int(8) NOT NULL,
  `title` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `security_class` enum('Unrestricted','Restricted','Confidential','Secret','Top Secret') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unrestricted',
  `object_class` enum('Safe','Euclid','Keter','Thaumiel','Neutralized') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Safe',
  `disruption_class` enum('Dark','Vlam','Keneq','Ekhi','Amida') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dark',
  `risk_class` enum('Notice','Caution','Warning','Danger','Critical') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Notice',
  PRIMARY KEY (`id`),
  KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
