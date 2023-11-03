<?php
if (isset($_GET['idt'])) {
    $idt = intval($_GET['idt']);

    $mysqli = new mysqli('localhost', 'root', '', 'tlg'); 

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $query_select_terrario = $mysqli->prepare("SELECT datat, obst FROM terrario WHERE idt = ?");
    $query_select_terrario->bind_param('i', $idt);

    $query_select_terrario->execute();

    $result_terrario = $query_select_terrario->get_result();

    if ($result_terrario->num_rows > 0) {
        $row_terrario = $result_terrario->fetch_assoc();
        $datat = $row_terrario['datat'];
        $obst = $row_terrario['obst'];
    } else {
        die("Nenhum registro de terrário disponível para edição.");
    }

    $query_select_terrario->close();
} else {
    die("ID do Terrário não especificado.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar Terrário</title>
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
            <img class="left-image" src="images/30.png" alt="Imagem à Esquerda">
            Editar Terrário
            <br>
            <br>
        </div>
        <div class="register-section">
            <form action="alteraterrario.php" method="post">
                <input type="hidden" name="idt" value="<?= $idt ?>">
                <br>
                <label for="datat">Data:</label>
                <br>
                <input type="text" id="datat" class="lacuna" name="datat" value="<?= $datat ?>"><br>
                <label for="obst">Observações:</label>
                <br>
                <input type="text" id="obst" class="lacuna" name="obst" value="<?= $obst ?>"><br>
                <input type="submit" class="btn-cadastro" value="Atualizar">
            </form>
        </div>
        <a href="terrario.php?idgecko=<?= $_GET['idgecko'] ?>" class="btn-cadastro">Voltar para o Terrário</a>
        <footer>
            <img src="images/footer.png" alt="Footer Logo">
        </footer>
    </body>
</html>
