<?php
if (isset($_GET['ide'])) {
    $ide = intval($_GET['ide']);

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }
 
    $query_select_ecdise = $mysqli->prepare("SELECT datae, obse FROM ecdise WHERE ide = ?");
    $query_select_ecdise->bind_param('i', $ide);

    $query_select_ecdise->execute();

    $result_ecdise = $query_select_ecdise->get_result();

    if ($result_ecdise->num_rows > 0) {
        $row_ecdise = $result_ecdise->fetch_assoc();
        $datae = $row_ecdise['datae'];
        $obse = $row_ecdise['obse'];
    } else {
        die("Nenhum registro de ecdise disponível para edição.");
    }

    $query_select_ecdise->close();
} else {
    die("ID de ecdise não especificado.");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Editar ecdise</title>
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
            <img class="left-image" src="images/9.png" alt="Imagem à Esquerda">
            Editar ecdise
            <br>
            <br>
        </div>
        <div class="register-section">
            <form action="alteraecdise.php" method="post">
                <input type="hidden" name="ide" value="<?= $ide ?>">
                <br>
                <label for="datae">Data:</label>
                <br>
                <input type="text" id="datae" class="lacuna" name="datae" value="<?= $datae ?>"><br>
                <label for="obse">Observações:</label>
                <br>
                <input type="text" id="obse" class="lacuna" name="obse" value="<?= $obse ?>"><br>
                <input type="submit" class="btn-cadastro" value="Atualizar">
            </form>
        </div>
        <a href="ecdise.php?idgecko=<?= $_GET['idgecko'] ?>" class="btn-cadastro">Voltar para a ecdise</a>
        <footer>
            <img src="images/footer.png" alt="Footer Logo">
        </footer>
    </body>
</html>
