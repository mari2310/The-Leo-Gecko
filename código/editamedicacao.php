<?php
if (isset($_GET['idr'])) {
    $idr = intval($_GET['idr']);

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $query_select_medicacao = $mysqli->prepare("SELECT datar, nome, indicacao, periodo FROM medicacao WHERE idr = ?");
    $query_select_medicacao->bind_param('i', $idr);

    $query_select_medicacao->execute();

    $result_medicacao = $query_select_medicacao->get_result();

    if ($result_medicacao->num_rows > 0) {
        $row_medicacao = $result_medicacao->fetch_assoc();
        $datar = $row_medicacao['datar'];
        $nome = $row_medicacao['nome'];
        $indicacao = $row_medicacao['indicacao'];
        $periodo = $row_medicacao['periodo'];
    } else {
        die("Nenhum registro de medicação disponível para edição.");
    }

    $query_select_medicacao->close();
} else {
    die("ID da medicação não especificado.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar Medicação</title>
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
            <img class="left-image" src="images/21.png" alt="Imagem à Esquerda">
            Editar medicação
            <br>
            <br>
        </div>
        <div class="register-section">
            <form action="alteramedicacao.php" method="post">
                <input type="hidden" name="idr" value="<?= $idr ?>">
                <br>
                <label for="datar">Data:</label>
                <br>
                <input type="text" id="datar" class="lacuna" name="datar" value="<?= $datar ?>"><br>
                <label for="nome">Medicação:</label>
                <br>
                <input type="text" id="nome" class="lacuna" name="nome" value="<?= $nome ?>"><br>
                <label for="indicacao">Indicação:</label>
                <br>
                <input type="text" id="indicacao" class="lacuna" name="indicacao" value="<?= $indicacao ?>"><br>
                <label for="periodo">Período:</label>
                <br>
                <input type="text" id="periodo" class="lacuna" name="periodo" value="<?= $periodo ?>"><br>
                <input type="submit" class="btn-cadastro" value="Atualizar">
            </form>
        </div>
        <a href="medicacao.php?idgecko=<?= $_GET['idgecko'] ?>" class="btn-cadastro">Voltar para medicação</a>
        <footer>
            <img src="images/footer.png" alt="Footer Logo">
        </footer>
    </body>
</html>
