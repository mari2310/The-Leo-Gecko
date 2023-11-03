<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idi'])) {
    $idi = $_POST['idi'];
 
    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $datat = $_POST['datai'];
    $incidente = $_POST['incidente'];

    $query_update_incidente = $mysqli->prepare("UPDATE incidente SET datai = ?, incidente = ? WHERE idi = ?");
    $query_update_incidente->bind_param('ssi', $datai, $incidente, $idi);

    if ($query_update_incidente->execute()) {
        header("Location: confaltinc.php?idgecko=" . $_GET['idgecko']);
        exit;
    } else {
        header("Location: erro.php");
    }

    $query_update_incidente->close();
    $mysqli->close();
} else {
    header("Location: erro.php");
}
?>
