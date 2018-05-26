<?php
require 'conexao.php';

$nome = isset($_POST["input1"]) ?  $_POST["input1"] : "";
$email = isset($_POST["input2"]) ? $_POST["input2"] : "";
$plano = isset($_POST["input3"]) ? $_POST["input3"] : "";

/* @var $nome type */
$nome = filter_var($nome,FILTER_SANITIZE_STRING);

$email = filter_var($email,FILTER_SANITIZE_EMAIL);
/* @var $filter_var type */
$plano = filter_var($plano,FILTER_SANITIZE_STRING);

inserir($nome,$email,$plano);

/* $para="psidom@gmail.com";
$titulo= "Plano para Academia";

$cabecalho = "From: teste \r\n";
$cabecalho .= "Reply-To: teste \r\n";
$cabecalho .= "CC:\r\n";
$cabecalho .= "MIME-Version: 1.0\r\n";
$cabecalho .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$msg=" $nome ";

if(mail($para,$titulo,$msg,$cabecalho)){

}else{

}*/

