<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar']) && isset($_POST['idr']) && isset($_POST['idgecko'])) {
    $idgecko = $_POST['idgecko'];
    $idmedicacao = $_POST['idr'];

    $mysqli = new mysqli('localhost', 'root', '', 'tlg');

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $delete_query = "DELETE FROM medicacao WHERE idr = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param('i', $idmedicacao);

    if ($stmt->execute()) {
        header("Location: excluiok.php?idgecko=" . $idgecko);
        exit;
    } else {
        header("Location: erro.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: confexclusaomedicacao.php?idin=" . $_GET['idr']);
}
?>
