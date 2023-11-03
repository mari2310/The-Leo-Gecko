<!DOCTYPE html>
<html>
	<head>
		<title>Editar Gecko</title>
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
			Editar Gecko
			<br>
			<br>
		</div>
		<div class="register-section">
			<?php
			if (isset($_GET['idgecko'])) {
				$idgecko = $_GET['idgecko'];

				$mysqli = new mysqli('localhost', 'root', '', 'tlg');

				if ($mysqli->connect_error) {
					die('Erro na conexão: ' . $mysqli->connect_error);
				}

				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$nome = $_POST['nome'];
					$nascimento = $_POST['nascimento'];
					$padrao = $_POST['padrao'];
					$genero = $_POST['genero'];
					$veterinario = $_POST['veterinario'];
					$contato_veterinario = $_POST['contato_veterinario'];

					$update_query = "UPDATE gecko SET nome=?, nascimento=?, padrao=?, genero=?, veterinario=?, contato_veterinario=? WHERE idgecko=?";
					$stmt = $mysqli->prepare($update_query);
					$stmt->bind_param('ssssssi', $nome, $nascimento, $padrao, $genero, $veterinario, $contato_veterinario, $idgecko);

					if ($stmt->execute()) {
						echo "Gecko atualizado com sucesso.";
					} else {
						echo "Erro ao atualizar o gecko: " . $stmt->error;
					}

					$stmt->close();
				}

				$query_select = $mysqli->query("SELECT * FROM gecko WHERE idgecko = $idgecko");

				if ($query_select->num_rows > 0) {
					$gecko = $query_select->fetch_assoc();
			?>
			<form method="post" action="alteragecko.php">
				<input type="hidden" name="idgecko" value="<?php echo $idgecko; ?>">
				<label for="nome">Nome:</label><br>
				<input type="text" name="nome" class="lacuna" value="<?php echo $gecko['nome']; ?>" required>
				<br>
				<label for="nascimento">Data de Nascimento:</label><br>
				<input type="date" name="nascimento" class="lacuna" value="<?php echo $gecko['nascimento']; ?>" required>
				<br>
				<label for="padrao">Padrão:</label><br>
				<input type="text" name="padrao" class="lacuna"  value="<?php echo $gecko['padrao']; ?>" required>
				<br>
				<label for="genero">Gênero:</label><br>
				<input type="text" name="genero" class="lacuna"  value="<?php echo $gecko['genero']; ?>" required>
				<br>
				<label for="veterinario">Veterinário:</label><br>
				<input type="text" name="veterinario" class="lacuna" value="<?php echo $gecko['veterinario']; ?>" required>
				<br>
				<label for="contato_veterinario">Contato do Veterinário:</label><br>
				<input type="text" name="contato_veterinario" class="lacuna" value="<?php echo $gecko['contato_veterinario']; ?>" required>
				<br>
				<input type="submit" class="btn-cadastro" value="Atualizar">
				<a href="gerenciamentogecko.php?idgecko=<?php echo $idgecko; ?>"  class="btn-voltar">Voltar</a>
			</form>
			<?php
				} else {
					echo "Gecko não encontrado.";
				}

				$mysqli->close();
			} else {
				echo "ID do Gecko não especificado.";
			}
			?>
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
