<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && isset($_POST['idt']) && isset($_POST['idgecko'])) {
    $idgecko = $_POST['idgecko'];
    $idterrario = $_POST['idt'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $delete_query = "DELETE FROM terrario WHERE idt = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param('i', $idterrario);

    if ($stmt->execute()) {
        header("Location: excluiok.php?idgecko=" . $idgecko);
        exit;
    } else {
        header("Location: erro.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: confexclusaoterrario.php?idt=" . $_GET['idt']);
}
?>
