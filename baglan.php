<?php
session_start();
require_once('include/ez_sql_core.php');
require_once('include/ez_sql_mysqli.php');
$db = new ezSQL_mysqli('root','','blog','localhost');
$db->query("SET NAMES 'utf8'");
$db->query("SET CHARACTER SET utf8" );
$db->query("SET COLLATION_CONNECTION = 'utf8_general_ci'");
define('url','http://localhost/blog');
define('tema','default');
define('temalink',url.'/tema/'.tema);