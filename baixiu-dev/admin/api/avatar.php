<?php
require_once '../../config.php';
 if(empty($_GET['email'])){
     exit('请输入邮箱');
 }
$email = $_GET['email'];
$conn = mysqli_connect(XIU_DB_HOST, XIU_DB_USER, XIU_DB_PASS, XIU_DB_NAME);
$res = mysqli_query($conn, "select avatar from users where email = '{$email}' limit 1;");
if (!$res) {
    exit('连接数据库失败');
}
$row = mysqli_fetch_assoc($res);
//var_dump('1111');
echo $row['avatar'];