<!DOCTYPE html>
<html>
	<head>
		<title>Confirmação de Exclusão</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<header>
			<img src="images/cabecalho.png" alt="Header Image">
			<hr>
		</header>
		<div class="logo">
			<img src="images/36.png" width="200px" alt="Logo">
		</div>
		<div class="register-section"">
			<h2>Tem certeza de que deseja excluir este registro?</h2>
			<form action="excluirincidente.php" method="post">
				<input type="hidden" name="idi" value="<?php echo $_GET['idi']; ?>">
				<input type="hidden" name="idgecko" value="<?php echo $_GET['idgecko']; ?>">
				<button type="submit" name="confirmar" class="btn-confirm">Confirmar Exclusão</button>
			</form>
			<a href="home.php" class="cancel-button">Cancelar</a>
		</div>
		<footer>
			<img src="images/footer.png" alt="Footer Logo">
		</footer>
	</body>
</html>