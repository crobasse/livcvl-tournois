<?php

define('HOST', 'localhost');
define('DB_NAME', 'u160780608_livfoot');
define('USER', 'u160780608_livfoot');
define('PASS', '58?UIiJz>');

try {
	$db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e;
}