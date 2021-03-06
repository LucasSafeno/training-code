<?php 
	require_once "classes/usuarios.php";

	$u = new Usuario();
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cadastrar</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>

	<!-- Corpo Form !-->
		<div id="corpo-form">

			<h1>Cadastrar</h1>
			<!-- Form-->
			<form method="POST" action="">
				
				<input type="text" name="nome" placeholder="Nome Completo" maxlength="30"> 
				<input type="text" name="telefone" placeholder="Telefone" maxlength="30">
				<input type="email" name="email" placeholder="Usuário" maxlength="40">
				<input type="password" name="senha" placeholder="Senha" maxlength="15">
				<input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
				<input type="submit" value="CADASTRAR">
				

			</form>
		<!-- //Form !-->
		<?php
	

	// Verificar se clicou em cadastrar

	if(isset($_POST['nome'])){

		// Capturar informações dos inputs		
		$nome = addslashes($_POST['nome']);
		$telefone = addslashes($_POST['telefone']);
		$email = addslashes($_POST['email']);
		$senha = addslashes($_POST['senha']);
		$confirmarSenha = addslashes($_POST['confSenha']);

		// Verificar se está vazio
		if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha) ){
			
			$u->conectar("login_techcod", "localhost", "safeno", "root");
			// Verificar erro de conexão
			if($u->msgErro == ""){
				if($senha  == $confirmarSenha){
					if($u->cadastrar($nome, $telefone, $email, $senha)){

						?>

						<div id="msgSucesso">
							Cadastrado com Sucesso
						</div>

						<?php

					}else{
						?>
						<div class="msgErro">
							Email ja cadastrado!	
						</div>
						
						<?php
					}
				}else{
					?>

					<div class="msgErro">
					Senhas não conferem !!!"
					</div>
					<?php
				}
			}else{
				echo "Erro : ".$msgErro;
			}
		}else{
			?>
			<div class="msgErro">
				Preencha todos os campos
			</div>
			<?php
		}


	}// isset

?>

		</div>
	<!-- //corpo-form !-->




</body>
</html>