<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && isset($_POST['idm']) && isset($_POST['idgecko'])) {
    $idgecko = $_POST['idgecko'];
    $idmedida = $_POST['idm'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $delete_query = "DELETE FROM medida WHERE idm = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param('i', $idmedida);

    if ($stmt->execute()) {
        header("Location: excluiok.php?idgecko=" . $idgecko);
        exit;
    } else {
        header("Location: erro.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: confexclusaomedida.php?idm=" . $_GET['idm']);
}
?>
