<?php

require 'conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$troca = $conexao->query("SELECT * FROM troca WHERE id_troca = $id");
$troca = $troca->fetch();
if(!isset($_SESSION['id_user'])){
    die("Acesso negado");
}elseif($troca['id_user2']!=$_SESSION['id_user'] && $troca['id_user1']!=$_SESSION['id_user']){
    die("Acesso negado");
}

$livros = $conexao->query("SELECT id_item_user1,id_item_user2 FROM troca WHERE id_troca = $id")->fetch();

$reputacao_user1 = $conexao->query("SELECT * FROM user WHERE id_user = ".$troca['id_user1']);
$reputacao_user1 = $reputacao_user1->fetch();
$reputacao_user2 = $conexao->query("SELECT * FROM user WHERE id_user = ".$troca['id_user2']);
$reputacao_user2 = $reputacao_user2->fetch();

$reputacao_user1 = $reputacao_user1['reputacao'] + 1;
$reputacao_user2 = $reputacao_user2['reputacao'] + 1;

$sql = "UPDATE user SET reputacao = $reputacao_user1 WHERE id_user = ".$troca['id_user1'];
$conexao->query($sql);
$sql = "UPDATE user SET reputacao = $reputacao_user2 WHERE id_user = ".$troca['id_user2'];
$conexao->query($sql);


$conexao->query("DELETE FROM troca WHERE id_troca = $id");
$conexao->query("DELETE FROM livro WHERE id_livro = ".$livros['id_item_user1']);
$conexao->query("DELETE FROM livro WHERE id_livro = " . $livros['id_item_user2']);



?>
<script>
    alert("Troca finalizada com sucesso!");
    window.location.href = "main.php?page=perfil";
</script>

