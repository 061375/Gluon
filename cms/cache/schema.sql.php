<?php
#auto-generated by Gluon\Libraries\Cache::__construct on 01/27/2017 21:55:56 America/Los_Angeles
$return = array('1'=>'CREATE TABLE `admin` (  `id` int(11) NOT NULL,  `title` text NOT NULL,  `post` text NOT NULL,  `template` varchar(35) NOT NULL,  `status` tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'0=draft,1=publish,2=revision\',  `permissions` tinyint(2) NOT NULL,  `date_posted` datetime NOT NULL,  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1','2'=>'CREATE TABLE `cms_options` (  `id` int(11) NOT NULL,  `option_name` varchar(35) NOT NULL,  `option_value` text NOT NULL,  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1','3'=>'INSERT INTO `cms_options` (`id`, `option_name`, `option_value`, `date_modified`) VALUES(1, \'site_name\', \'\', \'2017-01-20 09:12:41\'),(2, \'base_url\', \'\', \'2017-01-20 09:12:41\'),(3, \'active_template\', \'default\', \'2017-01-20 09:13:28\'),(4, \'admin_template\', \'default\', \'2017-01-20 09:13:28\'),(5, \'upload_hash\', \'\', \'2017-01-20 09:14:21\')','4'=>'CREATE TABLE `keywords` (  `id` int(11) NOT NULL,  `word` varchar(35) NOT NULL,  `weight` int(11) NOT NULL,  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1','5'=>'CREATE TABLE `media` (  `id` int(11) NOT NULL,  `title` varchar(50) NOT NULL,  `path` text NOT NULL,  `tags` text NOT NULL,  `meta` text NOT NULL,  `mime_type` varchar(50) NOT NULL,  `status` tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'0=active,1=revision\',  `permissions` tinyint(2) NOT NULL,  `date_posted` datetime NOT NULL,  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1','6'=>'CREATE TABLE `permissions` (  `id` tinyint(2) NOT NULL,  `title` varchar(35) NOT NULL,  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1','7'=>'INSERT INTO `permissions` (`id`, `title`, `date_modified`) VALUES(1, \'inactive\', \'2017-01-25 13:36:08\'),(2, \'superadmin\', \'2017-01-25 13:36:08\'),(3, \'admin\', \'2017-01-25 13:36:21\'),(4, \'guest\', \'2017-01-25 13:36:21\')','8'=>'CREATE TABLE `posts` (  `id` int(11) NOT NULL,  `title` text NOT NULL,  `post` text NOT NULL,  `template` varchar(35) NOT NULL,  `meta` text NOT NULL,  `keywords` text NOT NULL,  `status` tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'0=draft,1=publish,2=revision\',  `permissions` tinyint(2) NOT NULL,  `date_posted` datetime NOT NULL,  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1','9'=>'CREATE TABLE `upload_log` (  `id` int(11) NOT NULL,  `log` text NOT NULL,  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1','10'=>'CREATE TABLE `urls` (  `id` int(11) NOT NULL,  `post_id` int(11) NOT NULL,  `path` text NOT NULL,  `type` enum(\'media\',\'posts\',\'admin\') NOT NULL,  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1','11'=>'CREATE TABLE `users` (  `id` int(11) NOT NULL,  `username` varchar(35) NOT NULL,  `usernice` varchar(35) NOT NULL,  `password` text NOT NULL,  `permissions` tinyint(2) NOT NULL,  `ip` varchar(35) NOT NULL,  `session` text NOT NULL,  `date_created` datetime NOT NULL,  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1','12'=>'ALTER TABLE `admin`  ADD PRIMARY KEY (`id`)','13'=>'ALTER TABLE `cms_options`  ADD PRIMARY KEY (`id`),  ADD UNIQUE KEY `option_name` (`option_name`)','14'=>'ALTER TABLE `keywords`  ADD PRIMARY KEY (`id`),  ADD UNIQUE KEY `word` (`word`)','15'=>'ALTER TABLE `media`  ADD PRIMARY KEY (`id`),  ADD KEY `mime_type` (`mime_type`)','16'=>'ALTER TABLE `permissions`  ADD PRIMARY KEY (`id`)','17'=>'ALTER TABLE `posts`  ADD PRIMARY KEY (`id`)','18'=>'ALTER TABLE `upload_log`  ADD PRIMARY KEY (`id`)','19'=>'ALTER TABLE `urls`  ADD PRIMARY KEY (`id`)','20'=>'ALTER TABLE `users`  ADD PRIMARY KEY (`id`),  ADD UNIQUE KEY `username` (`username`)','21'=>'ALTER TABLE `admin`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT','22'=>'ALTER TABLE `cms_options`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6','23'=>'ALTER TABLE `keywords`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT','24'=>'ALTER TABLE `media`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT','25'=>'ALTER TABLE `permissions`  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5','26'=>'ALTER TABLE `posts`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT','27'=>'ALTER TABLE `upload_log`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT','28'=>'ALTER TABLE `urls`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT','29'=>'ALTER TABLE `users`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1',);