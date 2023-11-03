<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ide'])) {
    $ide = $_POST['ide'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $datae = $_POST['datae'];
    $obse = $_POST['obse'];

    $query_update_ecdise = $mysqli->prepare("UPDATE ecdise SET datae = ?, obse = ? WHERE ide = ?");
    $query_update_ecdise->bind_param('ssi', $datae, $obse, $ide);

    if ($query_update_ecdise->execute()) {
        header("Location: confaltecd.php?idgecko=" . $_GET['idgecko']);
        exit;
    } else {
        header("Location: erro.php");
    }

    $query_update_ecdise->close();
    $mysqli->close();
} else {
    header("Location: erro.php");
}
?>
