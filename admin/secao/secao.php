<?php
session_start();

require './cnx/adminconexao.php';
if(!isloggedIn()){
    echo"<script language='javascript' type='text/javascript'>alert('Tentativa de Acesso Não Permitido');window.location.href='/Academia/admin/acess/login.html';</script>";
    exit;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

