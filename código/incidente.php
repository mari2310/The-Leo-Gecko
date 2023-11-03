<?php
	if (isset($_GET['idgecko'])) {
    $idgecko = intval($_GET['idgecko']);

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $query_select_gecko = $mysqli->prepare("SELECT nome FROM gecko WHERE idgecko = ?");
    $query_select_gecko->bind_param('i', $idgecko);
    $query_select_gecko->execute();
    $query_select_gecko->store_result();

    $nomeGecko = "Nome do Gecko não encontrado";

    if ($query_select_gecko->num_rows > 0) {
        $query_select_gecko->bind_result($nome);
        $query_select_gecko->fetch();
        $nomeGecko = $nome;
    }

    $query_select_gecko->close();

?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
	<head>
		<title>The Leo Gecko</title>
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
			<img class="left-image" src="images/6.png" alt="Imagem à Esquerda">
			Incidente: <?= $nomeGecko; ?>
			<br>
			<br>
		</div>
		<div class="gecko-list">
			<ul>
				<?php
					if (isset($_GET['idgecko'])) {
					$idgecko = intval($_GET['idgecko']);

					$mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

					if ($mysqli->connect_error) {
						die('Erro na conexão: ' . $mysqli->connect_error);
					}

					$query_select_incidente = $mysqli->prepare("SELECT idi, datai, incidente FROM incidente WHERE idgecko = ?");
					$query_select_incidente->bind_param('i', $idgecko);

					$query_select_incidente->execute();

					$result_incidente = $query_select_incidente->get_result();

					if ($result_incidente->num_rows > 0) {
						while ($row_incidente = $result_incidente->fetch_assoc()) {
							echo "<li class='registro'>ID: " . $row_incidente['idi'] . " | Data: " . $row_incidente['datai'] . " | Incidente: " . $row_incidente['incidente'] . " | <a href='editaincidente.php?idi=" . $row_incidente['idi'] . "&idgecko=" . $idgecko . "' class='btn-edit'>Editar</a> | <a href='confexclusaoincidente.php?idi=" . $row_incidente['idi'] . "&idgecko=" . $idgecko . "' class='btn-delete'>Excluir</a></li><br>";
						}
					} else {
						echo "<li class='registro'>Nenhum registro de incidente disponível para este gecko.</li><br>";
					}

					$query_select_incidente->close();
				} else {
					echo "ID do Gecko não especificado.";
				}
				?>
            </ul>
		</div>
		<a href="cadastroincidente.php?idgecko=<?= $_GET['idgecko'] ?>" class="add-gecko-button"> + </a>
		<a href="home.php" class="btn-gergecko">Voltar para o Gerenciamento de Geckos</a>
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
<?php
    $mysqli->close();
}
?>
