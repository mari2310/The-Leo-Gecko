<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && isset($_POST['idf']) && isset($_POST['idgecko'])) {
    $idgecko = $_POST['idgecko'];
    $idfezes = $_POST['idf'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $delete_query = "DELETE FROM fezes WHERE idf = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param('i', $idfezes);

    if ($stmt->execute()) {
        header("Location: excluiok.php?idgecko=" . $idgecko);
        exit;
    } else {
        header("Location: erro.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: confexclusaofezes.php?idf=" . $_GET['idf']);
}
?>
