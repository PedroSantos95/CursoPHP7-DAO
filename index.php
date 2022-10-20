<?php 

require_once("config.php");

//CARREGAR UM USER
//$user = new Usuario();
//echo $user->loadById(1);

//LISTAR TODOS OS USERS
//echo json_encode(Usuario::listAll());

//PESQUISAR UM USER
//echo Usuario::search("Pedro");

//LOAD DE UM USER USANDO O LOGIN E SENHA
$user = new Usuario();
$user->getAuthUser("Pedro","123123");

echo $user;

?>