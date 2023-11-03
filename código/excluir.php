<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && isset($_POST['idgecko'])) {
    $idgecko = $_POST['idgecko'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $delete_query = "DELETE FROM gecko WHERE idgecko = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param('i', $idgecko);

    if ($stmt->execute()) {
        header("Location: excluiok.php");
        exit;
    } else {
        header("Location: erro.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: confirmarexclusao.php?idgecko=" . $_GET['idgecko']);
}
?>

