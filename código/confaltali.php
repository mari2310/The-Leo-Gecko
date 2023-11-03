<?php
include 'funcoes.php';

if (isset($_GET['idgecko'])) {
    $idgecko = $_GET['idgecko'];

}
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
	<head>
		<title>Alteração Bem-Sucedida!</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<header>
			<img src="images/cabecalho.png" alt="Header Image">
			<hr>
		</header>
		<div class="logo">
			<img src="images/12.png" width="200px" alt="Logo">
		</div>
		<div class="register-section">
			<h2>Alteração Bem-Sucedida!</h2>
			<a href="home.php" class="confirm-button">Voltar para Home</a>
		</div>
		<footer>
			<img src="images/footer.png" alt="Footer Logo">
		</footer>
	</body>
</html>
