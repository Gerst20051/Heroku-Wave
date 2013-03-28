<?php
$CLEARDB_URL = parse_url(getenv("CLEARDB_DATABASE_URL"));
define('MYSQL_HOST',$CLEARDB_URL["host"]);
define('MYSQL_USER',$CLEARDB_URL["user"]);
define('MYSQL_PASSWORD',$CLEARDB_URL["pass"]);
define('MYSQL_DATABASE',substr($CLEARDB_URL["path"],1));
define('MYSQL_TABLE','quotes');
define('MYSQL_TABLE_USERS','users');
define('MYSQL_ALL_USERS','uid, email, username, firstname, lastname, access_level, last_login, date_joined, logins');
?>