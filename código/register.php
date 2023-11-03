<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $query_insert = $mysqli->prepare("INSERT INTO usuarios (login, senha) VALUES (?, ?)");
    $query_insert->bind_param('ss', $login, $senha);

    if ($query_insert->execute()) {
        header("Location: sucessocadastro.html");
        exit;
    } else {
        echo "Erro no registro.";
    }
}
?>