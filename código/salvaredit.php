<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idt"])) {
		$idt = intval($_POST["idt"]);
		$datat = $_POST["datat"];
		$obst = $_POST["obst"];

		$mysqli = new mysqli('localhost', 'root', '', 'tlg');

		if ($mysqli->connect_error) {
			die('Erro na conexão: ' . $mysqli->connect_error);
		}

		$query_update_terrario = $mysqli->prepare("UPDATE terrario SET datat = ?, obst = ? WHERE idt = ?");
		$query_update_terrario->bind_param('ssi', $datat, $obst, $idt);

	  if ($query_update_terrario->execute()) {
		if ($query_update_terrario->affected_rows > 0) {
			header("Location: home.php");
			exit();
		} else {
			echo "Nenhuma alteração foi feita.";
		}
	} else {
		echo "Erro ao atualizar o registro do terrário.";
	}
		$query_update_terrario->close();
		$mysqli->close();
	} else {
		echo "Requisição inválida.";
	}
?>
