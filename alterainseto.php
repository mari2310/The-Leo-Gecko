<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idin'])) {
    $idin = $_POST['idin'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $inseto = $_POST['inseto'];

    $query_update_inseto = $mysqli->prepare("UPDATE inseto SET  inseto = ? WHERE idin = ?");
    $query_update_inseto->bind_param('si', $inseto, $idin);

    if ($query_update_inseto->execute()) {
        header("Location: confaltins.php?idgecko=" . $_GET['idgecko']);
        exit;
    } else {
        header("Location: erro.php");
    }

    $query_update_inseto->close();
    $mysqli->close();
} else {
    header("Location: erro.php");
}
?>
