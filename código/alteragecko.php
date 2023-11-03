<?php
	include 'funcoes.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Recupera os dados do formulário
		$idgecko = $_POST['idgecko'];
		$nome = $_POST['nome'];
		$nascimento = $_POST['nascimento'];
		$padrao = $_POST['padrao'];
		$genero = $_POST['genero'];
		$veterinario = $_POST['veterinario'];
		$contato_veterinario = $_POST['contato_veterinario'];

		$mysqli = new mysqli('localhost', 'root', '', 'tlg');

		if ($mysqli->connect_error) {
			die('Erro na conexão: ' . $mysqli->connect_error);
		}

		$update_query = "UPDATE gecko SET nome=?, nascimento=?, padrao=?, genero=?, veterinario=?, contato_veterinario=? WHERE idgecko=?";
		$stmt = $mysqli->prepare($update_query);
		$stmt->bind_param('ssssssi', $nome, $nascimento, $padrao, $genero, $veterinario, $contato_veterinario, $idgecko);

		if ($stmt->execute()) {
			header("Location: confalt.php?idgecko=$idgecko");
			exit;
		} else {
			header("Location: erro.php");
		}

		$stmt->close();
		$mysqli->close();
	} else {
		echo "Dados do gecko não recebidos corretamente.";
	}
?>
