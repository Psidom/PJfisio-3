<?php
$nome = isset($_POST["input1"]) ?  $_POST["input1"] : "";
$email = isset($_POST["input2"]) ? $_POST["input2"] : "";
$plano = isset($_POST["input3"]) ? $_POST["input3"] : "";

echo $nome." ".$email." ".$plano;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academia";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
$conn->connect_error;

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS academia";
$conn->query($sql);

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS solicitacoes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(30) NOT NULL,
    plano VARCHAR(300) NOT NULL,
    email VARCHAR(50)
    )";
    
    $conn->query($sql);

$sql = "INSERT INTO solicitacoes (nome,plano,email)
VALUES ('$nome', '$plano', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Solicitação feita com sucesso";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


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

