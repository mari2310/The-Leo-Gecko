<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && isset($_POST['idin']) && isset($_POST['idgecko'])) {
    $idgecko = $_POST['idgecko'];
    $idinseto = $_POST['idin'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $delete_query = "DELETE FROM inseto WHERE idin = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param('i', $idinseto);

    if ($stmt->execute()) {
        header("Location: excluiok.php?idgecko=" . $idgecko);
        exit;
    } else {
        header("Location: erro.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: confexclusaoinseto.php?idin=" . $_GET['idin']);
}
?>
