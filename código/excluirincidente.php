<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && isset($_POST['idi']) && isset($_POST['idgecko'])) {
    $idgecko = $_POST['idgecko'];
    $idincidente = $_POST['idi'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $delete_query = "DELETE FROM incidente WHERE idi = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param('i', $idincidente);

    if ($stmt->execute()) {
        header("Location: excluiok.php?idgecko=" . $idgecko);
        exit;
    } else {
        header("Location: erro.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: confexclusaoincidente.php?ide=" . $_GET['idi']);
}
?>
