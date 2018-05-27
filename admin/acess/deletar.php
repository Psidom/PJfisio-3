<?php
include '../cnx/adminconexao.php';
$id = filter_input(INPUT_POST, 'did', FILTER_SANITIZE_STRING);
        
deletar($id,$servername,$username,$password,$dbname);