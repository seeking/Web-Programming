--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `isbn` int(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre_id` int(11) NOT NULL default '1',
  `status` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`isbn`)
);

-- --------------------------------------------------------

--
-- Table structure for table `causes`
--

CREATE TABLE IF NOT EXISTS `causes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cause` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE IF NOT EXISTS `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` int(13) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `cause` varchar(255) NOT NULL,
  `notes` text,
  `value` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `listed_at` date NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `epassword` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` int(1) NOT NULL,
  `organization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
);
