<?php
require '../cnx/adminconexao.php';

$user = filter_input(INPUT_POST, 'input1', FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, 'input2', FILTER_SANITIZE_STRING);

checar_login($user,$pass,$servername,$username,$password,$dbadmin);
?>
