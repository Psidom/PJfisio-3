<?php
include '../cnx/adminconexao.php';
$id = filter_input(INPUT_POST, 'eid', FILTER_SANITIZE_STRING);
$nome = filter_input(INPUT_POST, 'enome', FILTER_SANITIZE_STRING);
$plano = filter_input(INPUT_POST, 'eplano', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'eemail', FILTER_SANITIZE_EMAIL);
        
editar($id,$nome,$plano,$email,$servername,$username,$password,$dbname);