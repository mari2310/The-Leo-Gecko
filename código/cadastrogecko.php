<?php

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$mysqli = new mysqli('localhost', 'root', '', 'tlg');

		if ($mysqli->connect_error) {
			die('Erro na conexão: ' . $mysqli->connect_error);
		}

		$nome = $_POST['nome'];
		$nascimento = $_POST['nascimento'];
		$padrao = $_POST['padrao'];
		$genero = $_POST['genero'];
		$veterinario = $_POST['veterinario'];
		$contato_veterinario = $_POST['contato_veterinario'];

		$query_insert = $mysqli->prepare("INSERT INTO gecko (nome, nascimento, padrao, genero, veterinario, contato_veterinario) VALUES (?, ?, ?, ?, ?, ?)");
		$query_insert->bind_param('ssssss', $nome, $nascimento, $padrao, $genero, $veterinario, $contato_veterinario);

		if ($query_insert->execute()) {
			header("Location: confirmacao.php");
			exit;
		} else {
			header("Location: erro.php");
			exit;
		}

		$query_insert->close();
		$mysqli->close();
	}
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
	<head>
		<title>Cadastro de Gecko</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<header>
			<img src="images/cabecalho.png" alt="Header Image">
			<hr>
		</header>
		<div>
			<a href="logout.php" class="btn-deslogar">Deslogar</a>
		</div>
		<div class="header" class="login-section">
			<img class="left-image" src="images/1.png" alt="Imagem à Esquerda">
			Cadastro de Gecko
			<br>
			<br>
		</div>
		<div class="register-section">
            <form action="cadastrogecko.php" method="post">
				<label for="nome">Nome:</label><br>
				<input type="text" class="lacuna" name="nome" required><br>
				<label for="nascimento">Data de Nascimento:</label><br>
				<input type="date" class="lacuna" name="nascimento" required><br>
				<label for="padrao">Padrão:</label><br>
				<input type="text" class="lacuna" name="padrao"><br>
				<label for="genero">Gênero:</label><br>
				<input type="text" class="lacuna" name="genero" required><br>
				<label for="veterinario">Veterinário:</label><br>
				<input type="text" class="lacuna" name="veterinario" required><br>
				<label for="contato_veterinario">Contato do Veterinário:</label><br>
				<input type="text" class="lacuna" name="contato_veterinario" required><br>
				<input type="submit" class="btn-cadastro" value="Cadastrar">
				<a href="home.php" class="cancel-button">Cancelar</a>
			</form>
		</div>
		<div class="gecko-list">
			<ul>
				<p>Dica<br>
					Lorem ipsum dolor sit amet,
					consectetur adipiscing elit. Sed vitae
					condimentum ipsum, at placerat
					tortor. Nam malesuada rhoncus orci,
					id facilisis justo venenatis sed
				</p>
			</ul>
		</div>
		<footer>
			<img src="images/footer.png" alt="Footer Logo">
		</footer>
	</body>
</html>



