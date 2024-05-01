<?php if (isset($_GET['productId'])) {
                $productId = $_GET['productId'];
            ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_product.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Adicionar Variações de Produto</title>
</head>
<style>
    .button-voltar{
        background-color: blue;
        padding: 15px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        
    }
    .button-voltar a{
        color: #fff;
        text-decoration: none;
    }
</style>
<body>
    <div class="container">
        <h1>Adicionar Variações de Produto</h1>
        <h2>Variação</h2>
        <form action="../backend/backend_add_mult_product2.php?productId=<?php echo urlencode($productId); ?>" method="post" enctype="multipart/form-data">

          
            <!-- Hidden input to store the product ID -->
            <input type="hidden" name="productId" value="<?php echo $productId; ?>">

            <label for="picture__input" class="picture">
                <span class="picture__image"></span>
            </label>
            <input type="file" name="picture__input" id="picture__input" required>
            <br>

            <!-- Input fields for variation data -->
            <label for="category">Categoria:</label>
            <input type="text" name="category" id="category" class="category" placeholder="COR, TAMANHO, MATERIAL" required oninput="this.value = this.value.toUpperCase()">

            <label for="variation">Variação:</label>
            <input type="text" name="variation" id="variation" class="variation" placeholder="(AZUL, BRANCO, VERMELHO) (P, M, GG) (OURO, PRATA, ALUMÍNIO)" required oninput="this.value = this.value.toUpperCase()">


            <label for="price">Preço:</label>
            <input type="number" name="price" id="price" class="price" placeholder="R$0,00" required>

            <label for="discount">Preço com desconto:</label>
            <input type="number" name="discount" id="discount" class="discount" placeholder="R$0,00">

            <label for="gtin" class="tooltip">
                GTIN (EAN) (opcional)
                <span class="material-symbols-outlined">help</span>
                <span class="tooltiptext">
                    <ul>
                        <li>GTIN é um identificador para itens comerciais, desenvolvido pela organização internacional GS1.</li><br>
                        <li>Esse identificador tem de 8 a 14 dígitos. Os tipos mais comuns são UPC, EAN, JAN e ISBN.</li><br>
                        <li>GTIN ajudará a impulsionar o posicionamento em canais de marketing online como Google e Faceook.</li><br>
                        <li>Essa incorporação do GTIN também vai auxiliar no mecanismo de Busca e Recomendação na internet, permitindo aos compradores encontrar exatamente o produto desejado com maior facilidade.</li>
                    </ul>
                </span>
            </label>
            <input type="text" name="gtin" id="gtin" class="gtin" placeholder="00000000000000">

            <label for="manage-storage">Gerenciar estoque:</label>
            <input type="checkbox" id="manage-storage">

            <div id="storage-container">
                <label for="storage">Quantidade em estoque:</label>
                <input type="number" name="storage" id="storage" class="storage">
            </div>

            <button type="submit" id="submit-btn">Adicionar produto</button>
            <button class="button-voltar"><a href="view_product.php?id=<?php echo urlencode($productId); ?>">Voltar</a></button>    
        </form>
        
    </div>
    <script src="../js/add_product.js"></script>
</body>
</html>

<?php } else { ?>
            <p>O parâmetro 'productId' não está definido na URL.</p>
            <?php } ?>