-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 25, 2017 at 01:41 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


--
-- Database: `gl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
DROP TABLE  `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `post` text NOT NULL,
  `template` varchar(35) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=draft,1=publish,2=revision',
  `permissions` tinyint(2) NOT NULL,
  `date_posted` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_options`
--
DROP TABLE  `cms_options`;
CREATE TABLE `cms_options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(35) NOT NULL,
  `option_value` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_options`
--

INSERT INTO `cms_options` (`id`, `option_name`, `option_value`, `date_modified`) VALUES
(1, 'site_name', '', '2017-01-20 09:12:41'),
(2, 'base_url', '', '2017-01-20 09:12:41'),
(3, 'active_template', 'default', '2017-01-20 09:13:28'),
(4, 'admin_template', 'default', '2017-01-20 09:13:28'),
(5, 'upload_hash', '', '2017-01-20 09:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--
DROP TABLE  `keywords`;
CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `word` varchar(35) NOT NULL,
  `weight` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--
DROP TABLE  `media`;
CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `path` text NOT NULL,
  `tags` text NOT NULL,
  `meta` text NOT NULL,
  `mime_type` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=active,1=revision',
  `permissions` tinyint(2) NOT NULL,
  `date_posted` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--
DROP TABLE  `permissions`;
CREATE TABLE `permissions` (
  `id` tinyint(2) NOT NULL,
  `title` varchar(35) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `date_modified`) VALUES
(1, 'inactive', '2017-01-25 13:36:08'),
(2, 'superadmin', '2017-01-25 13:36:08'),
(3, 'admin', '2017-01-25 13:36:21'),
(4, 'guest', '2017-01-25 13:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--
DROP TABLE  `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `post` text NOT NULL,
  `template` varchar(35) NOT NULL,
  `meta` text NOT NULL,
  `keywords` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=draft,1=publish,2=revision',
  `permissions` tinyint(2) NOT NULL,
  `date_posted` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload_log`
--
DROP TABLE  `upload_log`;
CREATE TABLE `upload_log` (
  `id` int(11) NOT NULL,
  `log` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--
DROP TABLE  `urls`;
CREATE TABLE `urls` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `path` text NOT NULL,
  `type` enum('media','posts','admin') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
DROP TABLE  `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `usernice` varchar(35) NOT NULL,
  `password` text NOT NULL,
  `permissions` tinyint(2) NOT NULL,
  `ip` varchar(35) NOT NULL,
  `session` text NOT NULL,
  `extra` text NOT NULL COMMENT 'serialized data containing extra user data',
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_options`
--
ALTER TABLE `cms_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `word` (`word`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mime_type` (`mime_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_log`
--
ALTER TABLE `upload_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_options`
--
ALTER TABLE `cms_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upload_log`
--
ALTER TABLE `upload_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

--
-- Table structure for table `session`
--

DROP TABLE  `session`;
CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session` varchar(35) NOT NULL,
  `ip` varchar(35) NOT NULL,
  `misc` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`),
  ADD KEY `session` (`session`,`ip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;