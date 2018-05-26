<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academia";
$dbadmin = "myadmindb";

$conn = new mysqli($servername,$username,$password);

// Checar conexão
$conn->connect_error;

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbadmin CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->query($sql);

//Select DataBase
$sql = "USE $dbadmin";
$conn->query($sql);

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS usuarios(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(30) NOT NULL,
    senha VARCHAR(300) NOT NULL,
    UNIQUE (nome)
    )DEFAULT CHARSET=utf8";
$conn->query($sql);

$sql= "INSERT INTO usuarios (nome, senha) VALUES ('dono','89794b621a313bb59eed0d9f0f4e8205')"; 
    
$conn->query($sql);
$conn->close();

function pegar_dados($servername,$username,$password,$dbname){
   $conn = new mysqli($servername,$username,$password,$dbname); 
   
   $sql = "SELECT  nome, plano, email FROM solicitacoes";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
    echo "<table><tr>"
       . "<th>Nome</th>"
       . "<th>E-mail</th>"
       . "<th>Plano</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>"
        .$row["nome"]
        ."</td><td>"
        .$row["email"]
        ."</td><td>"
        .$row["plano"]
        ."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Sem Solicitações";
}
$conn->close();
}
function isLoggedIn()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
    {
        return false;
    }
 
    return true;
}
function checar_login($user,$pass,$servername,$username,$password,$dbadmin){
   $conn = new mysqli($servername,$username,$password,$dbadmin);
   $pass_crypt = md5($pass);
   $sql = "SELECT * FROM usuarios WHERE nome = '$user' AND senha = '$pass_crypt' " or die("erro ao selecionar") ;
   $result = $conn->query($sql); 
   if ($result->num_rows <= 0){
          echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.html';</script>";
          die();
          session_destroy;
          exit;
        }else{
          session_save_path(__DIR__.'\..\secao\arquivos');
          session_set_cookie_params(60*60,'/admin/*',null,false,true);
          session_start();
          $_SESSION['logged_in'] = true;
          $_SESSION['user_name'] = $user;
          print_r($_SESSION);
          //header('Location: /Academia/admin/admin.php');
          echo"<script language='javascript' type='text/javascript'>alert(' $user foi logado Com Sucesso');window.location.href='/Academia/admin/admin.php';</script>";
          exit;
        }
   
   $conn->close(); 
}

