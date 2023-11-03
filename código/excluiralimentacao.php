<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && isset($_POST['ida']) && isset($_POST['idgecko'])) {
    $idgecko = $_POST['idgecko'];
    $idalimentacao = $_POST['ida'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $delete_query = "DELETE FROM alimentacao WHERE ida = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param('i', $idalimentacao);

    if ($stmt->execute()) {
        header("Location: excluiok.php?idgecko=" . $idgecko);
        exit;
    } else {
        header("Location: erro.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: confexclusaoalimentacao.php?ida=" . $_GET['ida']);
}
?>
