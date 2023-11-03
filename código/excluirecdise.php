<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && isset($_POST['ide']) && isset($_POST['idgecko'])) {
    $idgecko = $_POST['idgecko'];
    $idecdise = $_POST['ide'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $delete_query = "DELETE FROM ecdise WHERE ide = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param('i', $idecdise);

    if ($stmt->execute()) {
        header("Location: excluiok.php?idgecko=" . $idgecko);
        exit;
    } else {
        header("Location: erro.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: confexclusaoecdise.php?ide=" . $_GET['ide']);
}
?>
