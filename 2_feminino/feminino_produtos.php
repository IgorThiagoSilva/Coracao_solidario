<?php
    echo '<h1>Feminino</h1>';
    require_once './paginas/conexao.php';
    $conexao = novaConexao();

    ?>
    <a href="./index.php"><img class="voltar" src="assets/de-volta.png" alt="Voltar"></a>
    <?php
    $sql = "SELECT Produto.ID,Produto.Nome,Roupa.Tamanho_roupa,Imagem.Caminho_imagem FROM Produto 
    INNER JOIN Imagem ON Imagem.ID_produto = Produto.ID 
    INNER JOIN Roupa ON Roupa.ID_produto = produto.ID
    WHERE Produto.Publico_alvo = 'Feminino' AND Produto.Categoria = 'Roupa' AND Produto.Usuario_admin IS NOT NULL";
    $stmt = $conexao->prepare($sql);
    if($stmt->execute()){
        $resultado = $stmt->get_result();
        if ($resultado -> num_rows > 0){
            echo '<main class="principal">';
            echo '<section class="products">';
            while ($produto = $resultado->fetch_assoc()) {
                ?>
                <div class="product">
                    <div class="img-produto">
                        <img src="<?php echo htmlspecialchars($produto['Caminho_imagem']); ?>" alt="<?php echo htmlspecialchars($produto['Nome']); ?>">
                    </div>
                    <p class="texto-produto"><?php echo htmlspecialchars($produto['Nome']); ?></p>
                    <p class="sub-titulo">Tamanho: <?php echo htmlspecialchars($produto['Tamanho_roupa']); ?></p>
                    <a class="btn-index" href="home.php?dir=2_feminino&file=detalhes_produto&codigo=<?php echo $produto['ID']; ?>">Saiba mais</a>
                </div>
                <?php
            }
            echo '</section>';
            echo '</main>';
        } else {
            echo '<p>Nenhum produto encontrado.</p>';
        }
    } else {
        echo '<p>Erro na consulta ao banco de dados.</p>';
    }
?>
<style>
    .voltar {
        position: absolute;
        top: 120px;
        bottom: 10px;
        left: 20px;
        width: 30px;
        height: 30px;
        cursor: pointer;
    }
</style>