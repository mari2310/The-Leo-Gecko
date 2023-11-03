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
			<img class="left-image" src="images/20.png" alt="Imagem à Esquerda">
			Alimentação: <?= $nomeGecko; ?>
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

					$query_select_alimentacao = $mysqli->prepare("SELECT ida, data, quantidade, idin FROM alimentacao WHERE idgecko = ?");
					$query_select_alimentacao->bind_param('i', $idgecko);

					$query_select_alimentacao->execute();

					$result_alimentacao = $query_select_alimentacao->get_result();

					if ($result_alimentacao->num_rows > 0) {
						while ($row_alimentacao = $result_alimentacao->fetch_assoc()) {
							$ida = $row_alimentacao['ida'];
							$data = $row_alimentacao['data'];
							$quantidade = $row_alimentacao['quantidade'];

							$idin = $row_alimentacao['idin'];
							$query_select_inseto = $mysqli->prepare("SELECT inseto FROM inseto WHERE idin = ?");
							$query_select_inseto->bind_param('i', $idin);
							$query_select_inseto->execute();
							$query_select_inseto->store_result();

							$nomeInseto = "Inseto não encontrado"; 

							if ($query_select_inseto->num_rows > 0) {
								$query_select_inseto->bind_result($inseto);
								$query_select_inseto->fetch();
								$nomeInseto = $inseto;
							}

							$query_select_inseto->close();

							echo "<li class='registro'>ID: $ida | Data: $data | Inseto: $nomeInseto | Quantidade: $quantidade | <a href='editaalimentacao.php?ida=$ida&idgecko=$idgecko' class='btn-edit'>Editar</a> | <a href='confexclusaoalimentacao.php?ida=$ida&idgecko=$idgecko' class='btn-delete'>Excluir</a></li><br>";
						}
					} else {
						echo "<li class='registro'>Nenhum registro de alimentação disponível para este gecko.</li><br>";
					}

					$query_select_alimentacao->close();
				} else {
					echo "ID do Gecko não especificado.";
				}
				?>
			</ul>
		</div>
		<a href="cadastroalimentacao.php?idgecko=<?= $_GET['idgecko'] ?>" class="add-gecko-button"> + </a>
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
