<?php 
$currency = '$';
$db_username = getenv('C9_USER');
$db_password = '';
$db_name = 'piccadilly';
$db_host = getenv('IP');
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

?>