<?php 
	require_once "classes/usuarios.php";
	$u = new Usuario();
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Área de Login</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>

	<!-- Corpo Form !-->
		<div id="corpo-form">

			<h1>Entrar</h1>
			<!-- Form-->
			<form method="POST"">
				
				<input type="email" placeholder="Usuário" name="email">
				<input type="password" placeholder="Senha" name="senha">
				<input type="submit" value="ACESSAR">
				<a href="cadastrar.php">Ainda não é escrito ?<strong>Cadastra-se</strong></a>

			</form>
		<!-- //Form !-->

		<?php 

			if(isset($_POST['email'])){

				$email = addslashes($_POST['email']);
				$senha = addslashes($_POST['senha']);
				

				if(!empty($email) && !empty($senha)){

					$u->conectar("login_techcod", "localhost", "safeno", "root");
					if($u->msgErro == ""){

						if($u->logar($email, $senha)){

							header("Location: areaprivada.php");

						}else{
							?>
							<div class="msgErro">
							Email e/ou senha Inválidos
							<?php 
								print_r($senha);
							 ?>
							</div>

							<?php
						}
					}else{
						echo "Erro : ".$u->msgErro;
					}	
				}else{
					?>
					<div class="msgErro">
					Preencha todos os campos
					</div>
					<?php
				}



			} // fim isset

		 ?>


		</div>
	<!-- //corpo-form !-->



</body>
</html>