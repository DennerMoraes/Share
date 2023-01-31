<?php

require 'conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$troca = $conexao->query("SELECT * FROM troca WHERE id_troca = $id");
$troca = $troca->fetch();

if($troca['id_user2']!=$_SESSION['id_user']){
    die("Acesso negado");
}

$sql = "UPDATE troca SET status = 'Andamento' WHERE id_troca = $id";
$conexao->query($sql);
?>
<script>
    alert("Troca aceita com sucesso!");
    window.location.href = "main.php?page=perfil";
</script>