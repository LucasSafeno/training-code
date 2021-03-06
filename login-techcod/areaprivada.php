<?php 
session_start();
	// Verificação se está logado
	if(!isset($_SESSION['id_usuario'])){
		header("Location: index.php");
		exit();
	}


	echo "Seja bem-vindo";

 ?>

 <a href="sair.php">Deslogar</a>