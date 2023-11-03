<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $data = $_POST['data'];
    $idin = $_POST['idin'];
    $quantidade = $_POST['quantidade'];
    $idgecko = isset($_POST['idgecko']) ? intval($_POST['idgecko']) : 0;

    if ($idgecko > 0) {
        
    } else {
        echo "ID do Gecko inválido.";
    }
 
    $query_insert = $mysqli->prepare("INSERT INTO alimentacao (data, idin, quantidade, idgecko) VALUES (?, ?, ?, ?)");
    $query_insert->bind_param('ssii', $data, $idin, $quantidade, $idgecko);

    if ($query_insert->execute()) {
        header("Location: confirmacaoalimentacao.php");
        exit;
    } else {
        header("Location: erro.php");
        exit;
    }

    $query_insert->close();
    $mysqli->close();
}

$mysqli = new mysqli('localhost', 'root', '', 'tlg');
$idgecko = isset($_GET['idgecko']) ? intval($_GET['idgecko']) : 0;

if ($idgecko > 0) {
    $query_select_gecko = $mysqli->prepare("SELECT nome FROM gecko WHERE idgecko = ?");
    $query_select_gecko->bind_param('i', $idgecko);
    $query_select_gecko->execute();
    $query_select_gecko->store_result();

    $nomeGecko = "Gecko não encontrado"; 

    if ($query_select_gecko->num_rows > 0) {
        $query_select_gecko->bind_result($nome);
        $query_select_gecko->fetch();
        $nomeGecko = $nome;
    }

    $query_select_gecko->close();
} else {
    echo "ID do Gecko inválido.";
}

$mysqli->close();
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
	<head>
		<title>Cadastro de Alimentação</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<header>
			<img src="images/cabecalho.png" alt="Header Image">
			<hr>
		</header>
		<div class="deslogar">
			<a href="logout.php" class="btn-deslogar">Deslogar</a>
		</div>
		<div class="header" class="login-section">
			<img class="left-image" src="images/20.png" alt="Imagem à Esquerda">
			Cadastro de alimentação para o Gecko <?= $nomeGecko; ?>
			<br>
			<br>
		</div>
		<div class="register-section">
			<form action="cadastroalimentacao.php" method="post">
				<input type="hidden" name="idgecko" value="<?= $idgecko ?>"> <!-- Campo oculto para o ID do Gecko -->
				<label for="data">Data:</label><br>
				<input type="date" class="lacuna" name="data" required><br>
				<label for="idin">Inseto:</label><br>
				<select class="lacuna" name="idin" required>
					<?php
					$mysqli = new mysqli('localhost', 'root', '', 'tlg');
			
					if ($mysqli->connect_error) {
						die('Erro na conexão: ' . $mysqli->connect_error);
					}
					
					$query_select_insetos = $mysqli->prepare("SELECT idin, inseto FROM inseto");
					$query_select_insetos->execute();
					$result_insetos = $query_select_insetos->get_result();
					
					while ($row_inseto = $result_insetos->fetch_assoc()) {
						echo "<option value='" . $row_inseto['idin'] . "'>" . $row_inseto['inseto'] . "</option>";
					}
					
					$query_select_insetos->close();
					$mysqli->close();
					?>
				</select><br>
				<label for="quantidade">Quantidade:</label><br>
				<textarea class="lacuna" name="quantidade" rows="4" required></textarea><br>
				<input type="submit" class="btn-cadastro" value="Cadastrar">
				<a href="alimentacao.php?idgecko=<?= $idgecko ?>" class="cancel-button">Cancelar</a>
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
