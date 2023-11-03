<?php
if (isset($_GET['idm'])) {
    $idm = intval($_GET['idm']);

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $query_select_medida = $mysqli->prepare("SELECT datam, comprimento, peso FROM medida WHERE idm = ?");
    $query_select_medida->bind_param('i', $idm);

    $query_select_medida->execute();

    $result_medida = $query_select_medida->get_result();

    if ($result_medida->num_rows > 0) {
        $row_medida = $result_medida->fetch_assoc();
        $datam = $row_medida['datam'];
        $comprimento = $row_medida['comprimento'];
        $peso = $row_medida['peso'];
    } else {
        die("Nenhum registro de medida disponível para edição.");
    }

    $query_select_medida->close();
} else {
    die("ID da medida não especificado.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar Medida</title>
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
            <img class="left-image" src="images/41.png" alt="Imagem à Esquerda">
            Editar medida
            <br>
            <br>
        </div>
        <div class="register-section">
            <form action="alteramedida.php" method="post">
                <input type="hidden" name="idm" value="<?= $idm ?>">
                <br>
                <label for="datam">Data:</label>
                <br>
                <input type="text" id="datam" class="lacuna" name="datam" value="<?= $datam ?>"><br>
                <label for="comprimento">Comprimento:</label>
                <br>
                <input type="text" id="comprimento" class="lacuna" name="comprimento" value="<?= $comprimento ?>"><br>
				<label for="peso">Peso:</label>
                <br>
                <input type="text" id="peso" class="lacuna" name="peso" value="<?= $peso ?>"><br>
                <input type="submit" class="btn-cadastro" value="Atualizar">
            </form>
        </div>
        <a href="medida.php?idgecko=<?= $_GET['idgecko'] ?>" class="btn-cadastro">Voltar para medida</a>
        <footer>
            <img src="images/footer.png" alt="Footer Logo">
        </footer>
    </body>
</html>
