<?php
//header("Content-Type: text/html; charset=UTF-8",true);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academia"; 

// Criar conexão
$conn = new mysqli($servername,$username,$password);

// Checar conexão
$conn->connect_error;

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS academia CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->query($sql);
//Select DataBase
$sql = "USE $dbname";
$conn->query($sql);

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS solicitacoes(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(30) NOT NULL,
    plano VARCHAR(300) NOT NULL,
    email VARCHAR(50)
    )DEFAULT CHARSET=utf8";
    
    $conn->query($sql);
    $conn->close();

    function inserir($nome, $email, $plano, $servername, $username, $password,$dbname){

        $conn = new mysqli($servername,$username,$password,$dbname);
        //preparando o bind
        $stmt= $conn->prepare("INSERT INTO solicitacoes (nome,plano,email) VALUES (?,?,?)");
        $stmt->bind_param("sss",$rnome,$rplano,$remail);

        //Setar Parametros e executar
        $rnome = $nome;
        $rplano= $plano;
        $remail = $email;
                
        if ($stmt->execute() === TRUE) {
            //echo "Solicitação feita com sucesso";
            echo"<script>alert('Solicitação feita com sucesso')</script>";
            echo "<script> window.location.replace('../Academia')</script>";
        } else {
            echo"<script>alert('Error: ' . $sql . '<br>' . $conn->error)</script>";
            echo "<script> window.location.replace('../Academia')</script>";
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();  
    }