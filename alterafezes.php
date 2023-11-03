<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idf'])) {
    $idf = $_POST['idf'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $dataf = $_POST['dataf'];
    $obsf = $_POST['obsf'];

    $query_update_fezes = $mysqli->prepare("UPDATE fezes SET dataf = ?, obsf = ? WHERE idf = ?");
    $query_update_fezes->bind_param('ssi', $dataf, $obsf, $idf);

    if ($query_update_fezes->execute()) {
        header("Location: confaltfez.php?idgecko=" . $_GET['idgecko']);
        exit;
    } else {
        header("Location: erro.php");
    }

    $query_update_fezes->close();
    $mysqli->close();
} else {
    header("Location: erro.php");
}
?>
