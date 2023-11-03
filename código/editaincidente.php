<?php
if (isset($_GET['idi'])) {
    $idi = intval($_GET['idi']);
    
    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $query_select_incidente = $mysqli->prepare("SELECT datai, incidente FROM incidente WHERE idi = ?");
    $query_select_incidente->bind_param('i', $idi);

    $query_select_incidente->execute();

    $result_incidente = $query_select_incidente->get_result();

    if ($result_incidente->num_rows > 0) {
        $row_incidente = $result_incidente->fetch_assoc();
        $datai = $row_incidente['datai'];
        $incidente = $row_incidente['incidente'];
    } else {
        die("Nenhum registro de incidente disponível para edição.");
    }

    $query_select_incidente->close();
} else {
    die("ID do incidente não especificado.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar Incidente</title>
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
            <img class="left-image" src="images/6.png" alt="Imagem à Esquerda">
            Editar incidente
            <br>
            <br>
        </div>
        <div class="register-section">
            <form action="alteraincidente.php" method="post">
                <input type="hidden" name="idi" value="<?= $idi ?>">
                <br>
                <label for="datai">Data:</label>
                <br>
                <input type="text" id="datai" class="lacuna" name="datai" value="<?= $datai ?>"><br>
                <label for="incidente">Incidente:</label>
                <br>
                <input type="text" id="incidente" class="lacuna" name="incidente" value="<?= $incidente ?>"><br>
                <input type="submit" class="btn-cadastro" value="Atualizar">
            </form>
        </div>
        <a href="incidente.php?idgecko=<?= $_GET['idgecko'] ?>" class="btn-cadastro">Voltar para o incidente</a>
        <footer>
            <img src="images/footer.png" alt="Footer Logo">
        </footer>
    </body>
</html>
