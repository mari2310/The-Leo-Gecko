<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idm'])) {
	$idm = $_POST['idm'];
 
	$mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

	if ($mysqli->connect_error) {
		die('Erro na conexão: ' . $mysqli->connect_error);
	}

	$datam = $_POST['datam'];
	$comprimento = $_POST['comprimento'];
	$peso = $_POST['peso'];

	$query_update_medida = $mysqli->prepare("UPDATE medida SET datam = ?, comprimento = ? , peso = ? WHERE idm = ?");
	$query_update_medida->bind_param('siii', $datam, $comprimento, $peso, $idm);

	if ($query_update_medida->execute()) {

		header("Location: confaltmed.php?idgecko=" . $_GET['idgecko']);
		exit;
	} else {
	   
		header("Location: erro.php");
	}

	$query_update_medida->close();
	$mysqli->close();
} else {
	
	header("Location: erro.php");
}
?>
