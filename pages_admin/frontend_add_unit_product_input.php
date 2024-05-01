<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_product.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0" />
    <title>Adicionar Produtos</title>
</head>

<body>
    <div class="container">
        <h1>Adicionar Produtos</h1>
        <form action="../backend/backend_add_unit_product.php" method="post" enctype="multipart/form-data">
            <label for="picture__input" class="picture">
                <span class="picture__image"></span>
            </label>
            <input type="file" name="picture__input" id="picture__input" required>
            <br>
            <label for="picture__input__mult" class="picture-mult">
                Imagens do produto *Imagem 1:1
                <input type="file" name="picture__input__mult[]" id="picture__input__mult" multiple>

            </label>
            <br><br>
            <label for="title-product">Título:</label>
            <input type="text" name="title-product" id="title-product" required>
            
            <label for="description">Descrição do Produto:</label>
            <textarea type="text" id="description" name="description"></textarea>

            <label for="price">Preço:</label>
            <input type="number" name="price" step="any" id="price" class="price" required>

            <label for="discount">Preço com desconto:</label>
            <input type="number" name="discount" step="any" id="discount" class="discount">

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
<input type="text" name="gtin" id="gtin">


            <label for="manage-storage">Gerenciar estoque:</label>
            <input type="checkbox" id="manage-storage">

            <div id="storage-container">
                <label for="storage">Quantidade em estoque:</label>
                <input type="number" name="storage" id="storage">
            </div>
            <button id="submit-btn">Enviar</button>
            <button><a href="manager_products.php" target="_blank">GERENCIAR PRODUTOS</a></button>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="../js/add_product.js"></script>
</body>
</html>
