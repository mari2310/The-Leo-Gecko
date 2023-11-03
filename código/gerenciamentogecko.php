<!DOCTYPE html>
<html>
	<head>
		<title>Gerenciamento de Gecko</title>
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
		<div class="register-section">
			<?php
			if (isset($_GET['idgecko'])) {
				$idgecko = $_GET['idgecko'];

				$mysqli = new mysqli('localhost', 'root', '', 'tlg');

				if ($mysqli->connect_error) {
					die('Erro na conexão: ' . $mysqli->connect_error);
				}

				$query_select = $mysqli->query("SELECT * FROM gecko WHERE idgecko = $idgecko");

				if ($query_select->num_rows > 0) {
					$gecko = $query_select->fetch_assoc();

					echo "<img class='left-image' src='images/1.png'>";
					echo "<h2>Nome: " . $gecko['nome'] . "</h2>";
					echo "<p>Data de Nascimento: " . $gecko['nascimento'] . "</p>";
					echo "<p>Padrão: " . $gecko['padrao'] . "</p>";
					echo "<p>Gênero: " . $gecko['genero'] . "</p>";
					echo "<p>Veterinário: " . $gecko['veterinario'] . "</p>";
					echo "<p>Contato do Veterinário: " . $gecko['contato_veterinario'] . "</p>";
					echo "<a href='editgecko.php?idgecko=" . $idgecko . "' class='btn-cadastro'>Editar</a>";
					echo "<a href='excluir.php?idgecko=" . $idgecko . "' class='btn-cadastro'>Excluir</a>";
					echo "<a href='home.php' class='cancel-button'>Voltar</a>";
					echo "<br>";
					echo "<br>";

					echo "<img src='images/line.png' width='200px'>";
					echo "<br>";
					echo "<br>";

					echo "<div class='button-column'>";
					echo "<a href='alimentacao.php?idgecko=$idgecko' class='btn-button'>Alimentação</a>";
					echo "<a href='ecdise.php?idgecko=$idgecko' class='btn-button'>Ecdise</a>";
					echo "</div>";
					echo "<div class='button-column'>";
					echo "<a href='fezes.php?idgecko=$idgecko' class='btn-button'>Fezes</a>";
					echo "<a href='incidente.php?idgecko=$idgecko' class='btn-button'>Incidentes</a>";
					echo "</div>";
					echo "<div class='button-column'>";
					echo "<a href='medida.php?idgecko=$idgecko' class='btn-button'>Medidas</a>";
					echo "<a href='inseto.php?idgecko=$idgecko' class='btn-button'>Insetos</a>";
					echo "</div>";
					echo "<div class='button-column'>";
					echo "<a href='medicacao.php?idgecko=$idgecko' class='btn-button'>Medicação</a>";
					echo "<a href='terrario.php?idgecko=$idgecko' class='btn-button'>Terrário</a>";
					echo "</div>";
				} else {
					echo "Gecko não encontrado.";
				}

				$mysqli->close();
			} else {
				echo "ID do Gecko não especificado.";
			}
			?>
		</div>
		<footer>
			<img src="images/footer.png" alt="Footer Logo">
		</footer>
	</body>
</html>
