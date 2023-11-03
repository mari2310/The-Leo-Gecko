<?php
if (isset($_GET['idin'])) {
    $idin = intval($_GET['idin']);

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $query_select_inseto = $mysqli->prepare("SELECT inseto FROM inseto WHERE idin = ?");
    $query_select_inseto->bind_param('i', $idin);

    $query_select_inseto->execute();

    $result_inseto = $query_select_inseto->get_result();

    if ($result_inseto->num_rows > 0) {
        $row_inseto = $result_inseto->fetch_assoc();
        $inseto = $row_inseto['inseto'];
    } else {
        die("Nenhum registro de inseto disponível para edição.");
    }

    $query_select_inseto->close();
} else {
    die("ID do inseto não especificado.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar Inseto</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <header>
            <img src="images/cabecalho.png" alt="Header Image">
            <hr>
        </header>
        <div>
            <a href="logout.php" class="btn-deslogar">Deslogar</a>
        </div>
        <div class="header" class="login-section">
            <img class="left-image" src="images/28.png" alt="Imagem à Esquerda">
            Editar inseto
            <br>
            <br>
        </div>
        <div class="register-section">
            <form action="alterainseto.php" method="post">
                <input type="hidden" name="idin" value="<?= $idin ?>">
                <br>
                <label for="inseto">Inseto:</label>
                <br>
                <input type="text" id="inseto" class="lacuna" name="inseto" value="<?= $inseto ?>"><br>
                <input type="submit" class="btn-cadastro" value="Atualizar">
            </form>
        </div>
        <a href="inseto.php?idgecko=<?= $_GET['idgecko'] ?>" class="btn-cadastro">Voltar para o incidente</a>
        <footer>
            <img src="images/footer.png" alt="Footer Logo">
        </footer>
    </body>
</html>