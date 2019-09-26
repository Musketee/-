<?php
require_once '../../functions.php';
var_dump($_POST['email']);
if (empty($_POST['email'])) {
    exit('填写email');
}
if (empty($_POST['slug'])) {
    exit('填写slug');
}if (empty($_POST['nickname'])) {
    exit('填写nickname');
}if (empty($_POST['password'])) {
    exit('填写password');
}
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$password = $_POST['password'];
xiu_fetch_all("insert into users values('{$email}','{$slug}','{$nickname}','{$password}',)");
