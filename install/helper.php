<?php
function create_config($data){
	$server = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']. str_replace('/install', '', dirname($_SERVER['PHP_SELF']));	
    //echo $server;
	$conn = new mysqli($data['db_server'], $data['db_user'], $data['db_password'], $data['db_name']);
	if ($conn->connect_error) {
		exit("Connection failed: " . $conn->connect_error);
	}
	$file_path = "../application/config/database.php";
	$m_file = 'database.php';
    $content = file_get_contents($m_file);
    $content = str_replace('put_db_user', $data['db_user'], $content);
    $content = str_replace('put_db_password', $data['db_password'], $content);
    $content = str_replace('put_db_name', $data['db_name'], $content);
    $content = str_replace('put_db_server', $data['db_server'], $content);
    $content = str_replace('put_driver', $data['driver'], $content);
	file_put_contents($file_path, $content);
	$file_path = "../application/config/config.php";
	$m_file = 'config.php';
    $content = file_get_contents($m_file);
	$content = str_replace('put_base_url', $server, $content);
	file_put_contents($file_path, $content);
}

function create_db($data){
	$conn = new mysqli($data['db_server'], $data['db_user'], $data['db_password'], $data['db_name']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 	
	$conn->query("CREATE TABLE `admin` (
	  `admin_id` INT(11) NOT NULL AUTO_INCREMENT,
	  `firstname` varchar(30) NOT NULL,
	  `lastname` varchar(50) NOT NULL,
	  `image` varchar(100) NOT NULL,
	  `last_login` datetime NOT NULL,
	  `date_register` datetime NOT NULL,
	  `password` varchar(32) NOT NULL,
	  `email` varchar(30) NOT NULL,
	  PRIMARY KEY (`admin_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");

	
	$conn->query("CREATE TABLE `category` (
	  `category_id` INT(11) NOT NULL AUTO_INCREMENT,
	  `priority` INT(3) DEFAULT '0',
	  `name` varchar(30) DEFAULT NULL,
	   PRIMARY KEY (`category_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");

	$conn->query("CREATE TABLE `extension` (
	  `extension_id` INT(11) NOT NULL AUTO_INCREMENT,
	  `path` varchar(250) NOT NULL,
	  `priority` INT(11) NOT NULL,
	  `name` varchar(68) NOT NULL,
	  `status` tinyINT(4) NOT NULL,
	  `part_id` INT(11) NOT NULL,
	   PRIMARY KEY (`extension_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");

	$conn->query("CREATE TABLE `language` (
	  `language_id` INT(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(255) NOT NULL,
	  `code` varchar(5) NOT NULL,
	  `image` varchar(255) DEFAULT NULL,
	  `sort_order` INT(3) NOT NULL DEFAULT '0',
	  PRIMARY KEY (`language_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");

	$conn->query("CREATE TABLE `nation` (
	  `nation_id` INT(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(250) NOT NULL,
	  `priority` INT(11) NOT NULL,
	  `type` tinyINT(4) NOT NULL,
	  PRIMARY KEY (`nation_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");

	$conn->query("CREATE TABLE `part` (
	  `part_id` INT(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(64) NOT NULL,
	  PRIMARY KEY (`part_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");

	$conn->query("CREATE TABLE `region` (
	  `region_id` INT(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(250) NOT NULL,
	  `priority` INT(11) NOT NULL,
	  `type` tinyINT(4) NOT NULL,
	  PRIMARY KEY (`region_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
	
$conn->query("CREATE TABLE `user_group` (
	  `user_group_id` INT(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(64) NOT NULL,
	  PRIMARY KEY (`user_group_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");


	$conn->query("CREATE TABLE `user` (
	  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
	  `user_group_id` INT(11) NOT NULL,
	  `firstname` varchar(300) CHARACTER SET utf8 NOT NULL,
	  `lastname` varchar(300) CHARACTER SET utf8 NOT NULL,
	  `image` varchar(255) DEFAULT NULL,
	  `date_birth` date NOT NULL,
	  `gender` tinyINT(4) NOT NULL,
	  `region_id` INT(11) NOT NULL,
	  `ip` varchar(40) DEFAULT NULL,
	  `email` varchar(96) NOT NULL,
	  `date_added` date NOT NULL,
	  `password` varchar(32) NOT NULL,
	  `nation_id` INT(11) NOT NULL,
	  `ban` tinyINT(4) DEFAULT NULL,
	  PRIMARY KEY (`user_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");


	$conn->query("INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `image`, `last_login`, `date_register`, `password`, `email`) VALUES
	(1, 'Admin', 'Admin', 'avatar5.png', NOW() , NOW(), '". md5($data['password'])."', '". $data['email'] ."')");
	$conn->query("INSERT INTO `user_group` (`name`) VALUES ('Default')");
	$conn->query("INSERT INTO `part` (`name`) VALUES ('left'), ('top'), ('head')");
	$conn->query("INSERT INTO `extension` (`path`, `priority`, `name`, `status`, `part_id`) VALUES
	('home', 0, 'category_module', 1, 1),('home', 0, 'latest', 1, 2),('all', 0, 'fb', 1, 3)");
	$conn->query("INSERT INTO `category` (`priority`, `name`) VALUES
	(0,'Sport'),(0,'Fun')");
	$conn->query("iNSERT INTO `language` (`name`, `code`, `image`, `sort_order`) VALUES
	('english', 'en', NULL, 0),('macedonian', 'mk', NULL, 0)");
	$conn->query("INSERT INTO `nation` (`priority`, `name`, `type`) VALUES
	(0,'nation test','1'),(0,'second nation','1')");
	$conn->query("INSERT INTO `region` (`priority`, `name`, `type`) VALUES
	(0,'region 5','1'),(0,'region 453','1')");
}