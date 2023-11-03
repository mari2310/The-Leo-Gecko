<?php
$mysqli = new mysqli('localhost', 'root', '', 'tlg');
if ($mysqli->connect_error) {
    die('Erro na conexão com o banco de dados: ' . $mysqli->connect_error);
}
?>
