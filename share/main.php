<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Share</title>
</head>
<body class="body-main">

<nav class="nav-main">

  <a href="main.php"><img src="imagens/Share 2.0.png" alt=""></a>

  <input type="checkbox" id="check">
  <label for="check"><span class="material-symbols-outlined">menu</span></label>

  <ul>
    <?php
    if(isset($_SESSION['id_user'])){
      echo '<li><a href="main.php?page=livro_cadastrar">Cadastrar livro</a></li>';
      echo '<li><a href="main.php?page=perfil">Perfil</a></li>';
      if($_SESSION['id_user'] == 1){
        echo '<li><a href="main.php?page=adm">Administração</a></li>';
      }
    }else{
      echo '<li><a href="login.php">Login</a></li>';
      echo '<li><a href="cadastro.php">Cadastro</a></li>';
    }
    
    ?>
    <li><a href="main.php?page=bibliotecas">Bibliotecas</a></li>
   
  </ul>
</nav>

</body>

<?php

require_once 'includes/conexao.php';

$page = filter_input(INPUT_GET,'page',FILTER_SANITIZE_SPECIAL_CHARS);

if(file_exists("includes/$page.php")){
  require "includes/$page.php";
}elseif((isset($_SESSION['id_user']) && file_exists("adm/$page.php"))){
    require "adm/$page.php";
}
else{
  require "includes/livro_lista.php";
}


?>

</html>