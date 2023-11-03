<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_COOKIE['login'])) {
    unset($_COOKIE['login']);
    setcookie('login', '', time() - 3600, '/');
    header("Location: index.html"); 
    exit;
}
?>