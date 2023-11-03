<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

$idgecko = isset($_GET['idgecko']) ? intval($_GET['idgecko']) : 0;

if ($idgecko > 0) {
   
} else {
    echo "ID do Gecko inválido.";
}

    $idgecko = $_GET['idgecko'];
    echo "ID do Gecko: " . $idgecko; 

    $datat = $_POST['datat'];
    $obst = $_POST['obst'];
    $idgecko = $_POST['idgecko']; 
    $query_insert = $mysqli->prepare("INSERT INTO terrario (datat, obst, idgecko) VALUES (?, ?, ?)");
    $query_insert->bind_param('ssi', $datat, $obst, $idgecko);

    if ($query_insert->execute()) {
        header("Location: confirmacaoterrario.php");
        exit;
    } else {
        header("Location: erro.php");
        exit;
    }

    $query_insert->close();
    $mysqli->close();
}

$mysqli = new mysqli('localhost', 'root', '', 'tlg');
$idgecko = $_GET['idgecko'];
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
$mysqli->close();
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
	<head>
		<title>Cadastro de Terrário</title>
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
			<img class="left-image" src="images/30.png" alt="Imagem à Esquerda">
			Cadastro de Terrário para o Gecko <?= $nomeGecko; ?>
			<br>
			<br>
		</div>
		<div class="register-section">
			<form action="cadastroterrario.php" method="post">
				<input type="hidden" name="idgecko" value="<?= $idgecko ?>"> <!-- Campo oculto para o ID do Gecko -->
				<label for="datat">Data do Terrário:</label><br>
				<input type="date" class="lacuna" name="datat" required><br>
				<label for="obst">Observações:</label><br>
				<textarea class="lacuna" name="obst" rows="4" required></textarea><br>
				<input type="submit" class="btn-cadastro" value="Cadastrar">
				<a href="terrario.php?idgecko=<?= $idgecko ?>" class="cancel-button">Cancelar</a>
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
