<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $query_select = $mysqli->prepare("SELECT senha FROM usuarios WHERE login = ?");
    $query_select->bind_param('s', $login);
    $query_select->execute();
    $query_select->bind_result($senha_armazenada);
    $query_select->fetch();

    if ($senha === $senha_armazenada) {
        session_start();
        $_SESSION['login'] = $login;
        setcookie('login', $login, time() + 3600, '/');
        header("Location: home.php");
        exit;
    } else {
        header("Location: naoaut.php");
    }
}
?>