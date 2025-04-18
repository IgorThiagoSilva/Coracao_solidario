<?php
    echo '<h1>Masculino</h1>';
    require_once 'conexao.php';
    $conexao = novaConexao();

    $sql = "SELECT Produto.ID,Produto.Nome,Roupa.Tamanho_roupa,Imagem.Caminho_imagem FROM Produto 
    INNER JOIN Imagem ON Imagem.ID_produto = Produto.ID 
    INNER JOIN Roupa ON Roupa.ID_produto = produto.ID";
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
                    <a class="btn-index" href="home.php?dir=1_masculino&file=detalhes_produto&codigo=<?php echo $produto['ID']; ?>">Saiba mais</a>
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