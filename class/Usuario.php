<?php 

class Usuario 
{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	//Getters e Setters
	public function getIdUsuario()
	{
		return $this->idusuario;
	}

	public function setIdUsuario($id)
	{
		$this->idusuario = $id;
	}

	public function getLogin()
	{
		return $this->deslogin;
	}

	public function setLogin($login)
	{
		$this->deslogin = $login;
	}

	public function getSenha()
	{
		return $this->dessenha;
	}

	public function setSenha($senha)
	{
		$this->dessenha = $senha;
	}

	public function getDtCadatastro()
	{
		return $this->dtcadastro;
	}

	public function setDtCadastro($dtCadastro)
	{
		$this->dtcadastro = $dtCadastro;
	}

	public function __toString()
	{

		return json_encode(array(
			"idusuario" => $this->getIdUsuario(),
			"deslogin" => $this->getLogin(),
			"dessenha" => $this->getSenha(),
			"dtcadastro" => $this->getDtCadatastro()->format("d/m/Y H:i:s")
		));
	}

	public function loadById($id)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID" => $id));

		if(count($results) > 0 ){
			$row = $results [0];

			$this->setIdUsuario($row['idusuario']);
			$this->setLogin($row['deslogin']);
			$this->setSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}
	}

}

?>