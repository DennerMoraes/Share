<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nome = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$numero = filter_input(INPUT_POST, 'numero',FILTER_SANITIZE_SPECIAL_CHARS);
$usuario = filter_input(INPUT_POST, 'usuario',FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha');
$senha2 = filter_input(INPUT_POST, 'senha2');

if ($senha != $senha2){
    header('Location:../cadastro.php?erro=2');
    exit;
};

require 'conexao.php';

$u = $conexao->query("SELECT * FROM user WHERE email='$email'");

if($u->rowCount() > 0){
    header('Location:../cadastro.php?erro=1');
    exit;
}

$u2 = $conexao->query("SELECT * FROM user WHERE login='$usuario'");

if($u2->rowCount() > 0){
    header('Location:../cadastro.php?erro=3');
    exit;
}

$hash = password_hash($senha, PASSWORD_BCRYPT);

$sql = "INSERT INTO user (login, password,nome_completo,email,numero_telefone,reputacao) VALUES ('$usuario','$hash','$nome','$email','$numero',0)";

$conexao->query($sql);
    
header('Location:../login.php?erro=4');
