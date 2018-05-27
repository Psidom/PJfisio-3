<?php
if(!isLoggedIn()){
    session_start();
}
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


ini_set('display_errors', true);
error_reporting(E_ALL);

function pegar_dados($servername,$username,$password,$dbname){
   $conn = new mysqli($servername,$username,$password,$dbname); 
   
   $sql = "SELECT * FROM solicitacoes";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
    echo "<table width='100%' class='table table-striped table-bordered table-hover' id='tabela-dados'><tr>"
       . "<thead>"
       . "<th>Nome</th>"
       . "<th>E-mail</th>"
       . "<th>Plano</th>"
       . "<th>Editar</th>"
       . "<th>Deletar</th></tr>"
       . "</thead><tbody>";
    // saida de dados a cada row encontrado
    while($row = $result->fetch_assoc()) {
        $i = 1;
        $auxid[$i] = utf8_encode($row["id"]);
        $auxnome[$i] = utf8_encode($row["nome"]);
        $auxemail[$i] = utf8_encode($row["email"]);
        $auxplano[$i] = utf8_encode($row["plano"]);
        echo "<tr><td>"
        .utf8_encode($row["nome"])
        ."</td><td>"
        .utf8_encode($row["email"])
        ."</td><td>"
        .utf8_encode($row["plano"])
        ."</td>";
        ?>
        <td><button onclick="modalEditar('<?php echo $auxnome[$i] ?>','<?php echo $auxemail[$i]?>','<?php echo $auxplano[$i]?>','<?php echo $auxid[$i]?>')" class="btn btn-warning" data-toggle="modal" data-target="#editor" > <i class="fa fa-file-text" > </i> </button></td>
        <td><button onclick="modalDeletar('<?php echo $auxnome[$i]?>','<?php echo $auxemail[$i]?>','<?php echo $auxplano[$i]?>','<?php echo $auxid[$i]?>')" class="btn btn-danger" data-toggle="modal" data-target="#deletar"  > <i class= "fa fa-trash"> </i> </button></td>
        </tr>
        <?php
        $i++;
    }
    echo "</tbody></table>";
} else {
    echo "Sem Solicitações";
}
$conn->close();
}
function isLoggedIn(){
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
          exit;
        }else{
          session_save_path(__DIR__.'\..\secao\arquivos');
          session_set_cookie_params(60,'/admin/*',null,false,true);
          session_start();
          $_SESSION['logged_in'] = true;
          $_SESSION['user_name'] = $user;
          //print_r($_SESSION);
          //header('Location: /Academia/admin/admin.php');
          echo"<script language='javascript' type='text/javascript'>alert(' $user foi logado Com Sucesso');window.location.href='/Academia/admin/admin.php';</script>";
          exit;
        }
   
   $conn->close(); 
}
function editar($id,$nome,$plano,$email,$servername,$username,$password,$dbname){
    $conn = new mysqli($servername,$username,$password,$dbname);
    mysqli_set_charset($conn, "utf8");
    $sql = "UPDATE solicitacoes SET nome = '$nome', plano = '$plano', email = '$email' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo"<script language='javascript' type='text/javascript'>alert('Atualizado Com Sucesso');window.location.href='/Academia/admin/admin.php';</script>";
    } else {
        echo"<script language='javascript' type='text/javascript'>alert(' Não Foi Possivel Atualizar Erro: $conn->error');window.location.href='/Academia/admin/admin.php';</script>";
    }

    $conn->close(); 
}

function deletar($id,$servername,$username,$password,$dbname){
    $conn = new mysqli($servername,$username,$password,$dbname);
    
    $sql = "DELETE FROM solicitacoes WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo"<script language='javascript' type='text/javascript'>alert(' ID: $id Deletado Com Sucesso');window.location.href='/Academia/admin/admin.php';</script>";
    } else {
        echo"<script language='javascript' type='text/javascript'>alert(' Não Foi Possivel Deletar Erro: $conn->error');window.location.href='/Academia/admin/admin.php';</script>";
    }

    $conn->close(); 

}


?>

