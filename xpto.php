<?php
$nome = isset($_POST["input1"]) ?  $_POST["input1"] : "";
$email = isset($_POST["input2"]) ? $_POST["input2"] : "";
$plano = isset($_POST["input3"]) ? $_POST["input3"] : "";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academia";

// Criar conexão
$conn = new mysqli($servername, $username, $password);

// Checar conexão
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
    $conn->close();


$conn = new mysqli($servername, $username, $password,$dbname);
//preparando o bind
$stmt= $conn->prepare("INSERT INTO solicitacoes (nome,plano,email) VALUES (?,?,?)");
$stmt->bind_param("sss",$rnome, $rplano, $remail);

//Setar Parametros e executar
$rnome = $nome;
$rplano= $plano;
$remail = $email;

if ($stmt->execute() === TRUE) {
    //echo "Solicitação feita com sucesso";
    echo"<script>alert('Solicitação feita com sucesso')</script>";
} else {
    echo"<script>alert('Error: ' . $sql . '<br>' . $conn->error)</script>";
    //echo "Error: " . $sql . "<br>" . $conn->error;
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

