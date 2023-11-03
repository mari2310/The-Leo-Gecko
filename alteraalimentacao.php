<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ida'])) {
    $ida = $_POST['ida'];
 
    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $data = $_POST['data'];
    $idin = $_POST['idin'];
    $quantidade = $_POST['quantidade'];

    $query_update_alimentacao = $mysqli->prepare("UPDATE alimentacao SET data = ?, idin = ?, quantidade = ? WHERE ida = ?");
    $query_update_alimentacao->bind_param('siii', $data, $idin, $quantidade, $ida);

    if ($query_update_alimentacao->execute()) {
        header("Location: confaltali.php?idgecko=" . $_GET['idgecko']);
        exit;
    } else {
        header("Location: erro.php");
    }

    $query_update_alimentacao->close();
    $mysqli->close();
} else {
    header("Location: erro.php");
}
?>