<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idr'])) {
    $idr = $_POST['idr'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $datar = $_POST['datar'];
    $nome = $_POST['nome'];
    $indicacao = $_POST['indicacao'];
    $periodo = $_POST['periodo'];

    $query_update_medicacao = $mysqli->prepare("UPDATE medicacao SET datar = ?, nome = ?, indicacao = ?, periodo = ? WHERE idr = ?");
    $query_update_medicacao->bind_param('ssssi', $datar, $nome, $indicacao, $periodo, $idr);

    if ($query_update_medicacao->execute()) {
        header("Location: confaltrem.php?idgecko=" . $_GET['idgecko']);
        exit;
    } else {
        header("Location: erro.php");
    }

    $query_update_medicacao->close();
    $mysqli->close();
} else {
    header("Location: erro.php");
}
?>
