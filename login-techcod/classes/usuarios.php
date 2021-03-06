<?php 

	class Usuario{

		private $pdo;
		public $msgErro = "";


		// Conexão com banco de dados
		public function conectar($nome, $host, $usuario, $senha){
			global $pdo;

			// Conectar com banco de dados
			try{
				$pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
			} catch(PDOExcepion $e){
				$msgErro = $e->getMessage();

			}
		} // conectar

		#####################################################

		// Cadastrar usuários
		public function cadastrar($nome, $telefone, $email, $senha){
			global $pdo;

			//Verificar se email já é cadastrado
			$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
			$sql->bindValue(":e", $email);
			$sql->execute();
			if($sql->rowCount() > 0){

				return false; // já está cadastrado
			}else{
				// caso não,Cadastrar
				$sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");	
				$sql->bindValue(":n", $nome);
				$sql->bindValue(":t", $telefone);
				$sql->bindValue(":e", $email);
				$sql->bindValue(":s", md5($senha));
				$sql->execute();
				return true; // Cadastrada com sucesso
			}

			


		} // cadastrar

		#####################################################

		// Função para Login
		public function logar($email, $senha){
			global $pdo;


			// verificar se email e senha estão cadastrados, se sim
			
			
			$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
			$sql->bindvalue(":e", $email);
			$sql->bindValue(":s", md5($senha));
			$sql->execute();

			if($sql->rowCount() > 0){
				// entrar no sistema (sessao)
				$dado = $sql->fetch();
				session_start();
				$_SESSION['id_usuario'] = $dado['id_usuario'];
				return true;
			}else{

				return false; // não foi possível logar

			}
			


		}// logar


		#####################################################3

	} // Usuarios


 ?>