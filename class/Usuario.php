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
			$this->setData($results[0]);
		}
	}

	public static function listAll()
	{
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario");
	}

	public static function search($login)
	{
		$sql = new Sql();
		return json_encode($sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :LOGIN ORDER BY deslogin", array(
			":LOGIN" => "%" . $login . "%"
		)));
	}

	public function getAuthUser($login, $senha)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN" => $login,
			":PASSWORD" => $senha
		));

		if(count($results) > 0 ){
			$this->setData($results[0]);
		}else
		{
			throw new Exception("Login e/ou senha inválidos");
		}
	}

	public function setData($data)
	{
		$this->setIdUsuario($data['idusuario']);
		$this->setLogin($data['deslogin']);
		$this->setSenha($data['dessenha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro']));	
	}

	public function insert()
	{
		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			':LOGIN' => $this->getLogin(),
			':SENHA' => $this->getSenha()
		));

		if(count($results) > 0)
		{
			$this->setData($results[0]);
		}
	}

	public function __construct($login = "", $password = "")
	{
		$this->setLogin($login);
		$this->setSenha($password);
	}

	public function update($login, $password)
	{
		$this->setLogin($login);
		$this->setSenha($password);

		$sql = new Sql();

		$sql->setQuery("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			":LOGIN"=>$this->getLogin(),
			":PASSWORD"=>$this->getSenha(),
			":ID"=>$this->getIdUsuario()
		));
	}

	public function delete()
	{
		$sql = new Sql();

		$sql->setQuery("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$this->getIdUsuario()
		));

		$this->setIdUsuario(0);
		$this->setLogin("");
		$this->setSenha("");
		$this->setDtCadastro(new DateTime());
	}

}

?>