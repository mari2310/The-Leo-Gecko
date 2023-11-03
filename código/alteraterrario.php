<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idt'])) {
    $idt = $_POST['idt'];
 
    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $datat = $_POST['datat'];
    $obst = $_POST['obst'];

    $query_update_terrario = $mysqli->prepare("UPDATE terrario SET datat = ?, obst = ? WHERE idt = ?");
    $query_update_terrario->bind_param('ssi', $datat, $obst, $idt);

    if ($query_update_terrario->execute()) {
        header("Location: confaltter.php?idgecko=" . $_GET['idgecko']);
        exit;
    } else {
        header("Location: erro.php");
    }

    $query_update_terrario->close();
    $mysqli->close();
} else {
    header("Location: erro.php");
}
?>
