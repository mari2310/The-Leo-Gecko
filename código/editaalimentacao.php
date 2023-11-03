<?php
if (isset($_GET['ida'])) {
    $ida = intval($_GET['ida']);

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $query_select_alimentacao = $mysqli->prepare("SELECT data, idin, quantidade FROM alimentacao WHERE ida = ?");
    $query_select_alimentacao->bind_param('i', $ida);

    $query_select_alimentacao->execute();

    $result_alimentacao = $query_select_alimentacao->get_result();

    if ($result_alimentacao->num_rows > 0) {
        $row_alimentacao = $result_alimentacao->fetch_assoc();
        $data = $row_alimentacao['data'];
        $idin = $row_alimentacao['idin'];
        $quantidade = $row_alimentacao['quantidade'];
    } else {
        die("Nenhum registro de alimentação disponível para edição.");
    }

    $query_select_alimentacao->close();
} else {
    die("ID da alimentação não especificado.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar Alimentação</title>
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
            <img class="left-image" src="images/20.png" alt="Imagem à Esquerda">
            Editar alimentação
            <br>
            <br>
        </div>
        <div class="register-section">
            <form action="alteraalimentacao.php" method="post">
                <input type="hidden" name="ida" value="<?= $ida ?>">
                <br>
                <label for="data">Data:</label>
                <br>
                <input type="date" id="data" class="lacuna" name="data" value="<?= $data ?>"><br>
                <label for="idin">Inseto:</label>
                <br>
                <select id="idin" class="lacuna" name="idin">
                    <?php
                    $mysqli = new mysqli('localhost', 'root', '', 'tlg');
                    
                    if ($mysqli->connect_error) {
                        die('Erro na conexão: ' . $mysqli->connect_error);
                    }

                    $query_select_insetos = $mysqli->prepare("SELECT idin, inseto FROM inseto");
                    $query_select_insetos->execute();
                    $result_insetos = $query_select_insetos->get_result();

                    while ($row_inseto = $result_insetos->fetch_assoc()) {
                        $selected = ($row_inseto['idin'] == $idin) ? 'selected' : ''; 
                        echo "<option value='" . $row_inseto['idin'] . "' $selected>" . $row_inseto['inseto'] . "</option>";
                    }
                    
                    $query_select_insetos->close();
                    $mysqli->close();
                    ?>
                </select><br>
                <label for="quantidade">Quantidade:</label>
                <br>
                <input type="text" id="quantidade" class="lacuna" name="quantidade" value="<?= $quantidade ?>"><br>
                <input type="submit" class="btn-cadastro" value="Atualizar">
            </form>
        </div>
        <a href="alimentacao.php?idgecko=<?= $_GET['idgecko'] ?>" class="btn-cadastro">Voltar para medicação</a>
        <footer>
            <img src="images/footer.png" alt="Footer Logo">
        </footer>
    </body>
</html>
