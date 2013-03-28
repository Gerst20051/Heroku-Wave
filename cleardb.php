<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"],1);

print_r($url);

$link = mysql_connect($server, $username, $password);

if (!$link) {
	echo "<p>Could not connect to the server '" . $server . "'</p>\n";
	echo mysql_error();
} else {
	echo "<p>Successfully connected to the server '" . $server . "'</p>\n";
	printf("<p>MySQL client info: %s</p>\n", mysql_get_client_info());
	printf("<p>MySQL host info: %s</p>\n", mysql_get_host_info());
	printf("<p>MySQL server version: %s</p>\n", mysql_get_server_info());
	printf("<p>MySQL protocol version: %s</p>\n", mysql_get_proto_info());
}

if ($link && !$db) {
	echo "<p>No database name was given. Available databases:</p>\n";
	$db_list = mysql_list_dbs($link);
	echo "<pre>\n";
	while ($row = mysql_fetch_array($db_list)) {
	     echo $row['Database'] . "\n";
	}
	echo "</pre>\n";
}

if ($db) {
	$dbcheck = mysql_select_db($db);
	if (!$dbcheck) {
		echo mysql_error();
	} else {
		echo "<p>Successfully connected to the database '" . $db . "'</p>\n";
		$sql = "SHOW TABLES FROM `$db`";
		$result = mysql_query($sql);
		if (0 < mysql_num_rows($result)) {
			echo "<p>Available tables:</p>\n";
			echo "<pre>\n";
			while ($row = mysql_fetch_row($result)) {
				echo "{$row[0]}\n";
			}
			echo "</pre>\n";
		} else {
			echo "<p>The database '" . $db . "' contains no tables.</p>\n";
			echo mysql_error();
		}
	}
}

$CREATETABLES = false;

if ($CREATETABLES) {
	$query = 'CREATE TABLE `users` (
	  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `email` varchar(50) NOT NULL,
	  `pass` varchar(256) NOT NULL,
	  `salt` varchar(64) NOT NULL,
	  `username` varchar(50) NOT NULL,
	  `firstname` varchar(50) NOT NULL,
	  `lastname` varchar(50) NOT NULL,
	  `access_level` tinyint(1) NOT NULL,
	  `last_login` int(11) NOT NULL,
	  `date_joined` int(11) NOT NULL,
	  `logins` int(11) NOT NULL,
	  PRIMARY KEY (`uid`),
	  UNIQUE KEY `username` (`username`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

	$result = mysql_query($query);
	if (!$result) {
		echo mysql_error() . "\n";
	}

	$query = 'CREATE TABLE `quotes` (
	  `id` int(10) NOT NULL AUTO_INCREMENT,
	  `owner_id` int(10) NOT NULL,
	  `quote` text NOT NULL,
	  `timestamp` int(15) NOT NULL,
	  PRIMARY KEY (`id`),
	  KEY `owner_id` (`owner_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

	$result = mysql_query($query);
	if (!$result) {
		echo mysql_error() . "\n";
	}
}

$ALTERTABLES = false;

if ($ALTERTABLES) {
	/*
	$query = "ALTER TABLE users";

	$result = mysql_query($query);
	if (!$result) {
		echo mysql_error() . "\n";
	}
	*/

	$query = "INSERT INTO `users` VALUES(1, 'gerst20051@gmail.com', '10511002359e132ecdb3e743bb6ffdb72eb1ba6ad1d99baa1fa32a6cc63ecdb18ac99922a99660ba5926bdaefb52f2e2beeb7665bd7a230e883fa951718647a56d797432a4c4a0b64f7dcd4c7af65fdb3ef6a825697af9dc3c595eaefff5d0a24c94b68155d0d750f7d78b4be4d431adc9426db2d9a308b8c593afd8e1b8f385', 'f74df8dc1176051808ce4455f4c60f20eedb92f8a9f421bb877382a117005697', 'andrew', 'Andrew', 'Gerst', 2, 1364415928, 1364263211, 5);";

	$result = mysql_query($query);
	if (!$result) {
		echo mysql_error() . "\n";
	}

	$query = 'INSERT INTO `quotes` VALUES(1, 1, \'{"name":"Shakespeare","quote":"If music be the food of love, play on."}\', 1351413690);';

	$result = mysql_query($query);
	if (!$result) {
		echo mysql_error() . "\n";
	}
}
?>