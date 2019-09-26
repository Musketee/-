<?php
require_once '../../functions.php';

$users =xiu_fetch_all('select * from users;');
$json = json_encode($users);
header('Content-Type: application/json');
echo $json;
