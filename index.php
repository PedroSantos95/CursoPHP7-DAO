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
//$user = new Usuario();
//$user->getAuthUser("Pedro","123123");
//echo $user;

//CREATE NEW USER
//$aluno = new Usuario("1111", "121113");
//$aluno->insert();
//echo $aluno;

//UPDATE USER
//$usuario = new Usuario();
//$usuario->loadById(2);
//$usuario->update("2", "123123");

//ELIMINAR USER
$usuario = new Usuario();
$usuario->loadById(1);
$usuario->delete();

echo $usuario;

?>