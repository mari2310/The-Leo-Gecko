<?php
function obterIdGeckoAposAlteracao($mysqli) {

    $query = "SELECT idgecko FROM gecko WHERE nome = ?";

    $stmt = $mysqli->prepare($query);

    $nome = $_POST['nome']; 

    $stmt->bind_param('s', $nome);
    $stmt->execute();
    $stmt->bind_result($idgecko);

    if ($stmt->fetch()) {
        return $idgecko;
    } else {
        return null; 
    }
}
?>
