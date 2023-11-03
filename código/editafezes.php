<?php
if (isset($_GET['idf'])) {
    $idf = intval($_GET['idf']);
    
    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $query_select_fezes = $mysqli->prepare("SELECT dataf, obsf FROM fezes WHERE idf = ?");
    $query_select_fezes->bind_param('i', $idf);

    $query_select_fezes->execute();

    $result_fezes = $query_select_fezes->get_result();

    if ($result_fezes->num_rows > 0) {
        $row_fezes = $result_fezes->fetch_assoc();
        $dataf = $row_fezes['dataf'];
        $obsf = $row_fezes['obsf'];
    } else {
        die("Nenhum registro de fezes disponível para edição.");
    }

    $query_select_fezes->close();
} else {
    die("ID de fezes não especificado.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar fezes</title>
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
            <img class="left-image" src="images/23.png" alt="Imagem à Esquerda">
            Editar fezes
            <br>
            <br>
        </div>
        <div class="register-section">
            <form action="alterafezes.php" method="post">
                <input type="hidden" name="idf" value="<?= $idf ?>">
                <br>
                <label for="dataf">Data:</label>
                <br>
                <input type="text" id="dataf" class="lacuna" name="dataf" value="<?= $dataf ?>"><br>
                <label for="obsf">Observações:</label>
                <br>
                <input type="text" id="obsf" class="lacuna" name="obsf" value="<?= $obsf ?>"><br>
                <input type="submit" class="btn-cadastro" value="Atualizar">
            </form>
        </div>
        <a href="fezes.php?idgecko=<?= $_GET['idgecko'] ?>" class="btn-cadastro">Voltar para o fezes</a>
        <footer>
            <img src="images/footer.png" alt="Footer Logo">
        </footer>
    </body>
</html>
