<!DOCTYPE html>
<meta charset="UTF-8">
<html>
	<head>
		<title>TLG - Geckos</title>
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
			<img class="left-image" src="images/1.png">
			Geckos
			<br>
			<br>
		</div>
		<div class="gecko-list">
			<ul>
				Meus Geckos
				<br>
				<br>
				<?php

				$mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

				if ($mysqli->connect_error) {
					die('Erro na conexão: ' . $mysqli->connect_error);
				}

				$query_select = $mysqli->query("SELECT idgecko, nome FROM gecko");

				while ($row = $query_select->fetch_assoc()) {
					echo "<li class='registro'> <img src='images/1.png' class='icone'> " . $row['nome'] . " <a href='gerenciamentogecko.php?idgecko=" . $row['idgecko'] . "'><button class='direita'>Visualizar</button></a></li><br>";
				}

				$mysqli->close();
				?>
			</ul>
		</div>
		<a href="cadastrogecko.php" class="add-gecko-button"> Cadastrar Gecko </a>
		<br>
		<br>
		<br>
		<div class="gecko-list">
			<ul>
				<p>Dica:<br>
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
