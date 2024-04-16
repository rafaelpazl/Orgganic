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
        <h2>Produto</h2>
        <form action="../backend/add_product.php" method="post" enctype="multipart/form-data">
            <label for="picture__input" class="picture">
                <span class="picture__image"></span>
            </label>
            <input type="file" name="picture__input" id="picture__input" required>
            <br>
            <label for="picture__input__mult" class="picture-mult">
                Imagens do produto
                <input type="file" name="picture__input__mult[]" id="picture__input__mult" multiple>

            </label>
            <br><br>
            <label for="title-product">Título:</label>
            <input type="text" name="title-product" id="title-product" required>
            
            <label for="description">Descrição do Produto:</label>
            <textarea type="text" id="description" name="description"></textarea>

            <label for="price">Preço normal:</label>
            <input type="text" name="price" step="any" id="price" class="price" required>

            <label for="discount">Preço com desconto:</label>
            <input type="text" name="discount" step="any" id="discount" class="discount">

            <label for="sku" class="tooltip">
                SKU
                <span class="material-symbols-outlined">help</span>
                <span class="tooltiptext">Código usado para identificar produtos</span>
                (opcional)
            </label>
            <input type="text" name="sku" id="sku">

            <label for="manage-storage">Gerenciar estoque:</label>
            <input type="checkbox" id="manage-storage">

            <div id="storage-container">
                <label for="storage">Quantidade em estoque:</label>
                <input type="number" name="storage" id="storage">
            </div>

            <h2>Opções</h2>
            <p>Adicione várias opções para esse produto, como diferentes tamanhos ou cores. Vamos fazer combinações para criar variações únicas dos seus produtos.</p>

            <label for="manage-variable">Adicionar variação:</label>
            <input type="checkbox" id="manage-variable">

            <div id="variable-container">
                <label for="variable-add">Adicionar opção:</label>
                <input type="text" name="variable-add" id="variable-add" placeholder="ex: Cor, Tamanho, Material, etc.">
                <a href="#" id="add-variable-select-link">Adicionar seleção</a>
                <div id="variable-select-container"></div>
            </div>

            <button id="submit-btn">Enviar</button>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="../js/add_product.js"></script>
</body>
</html>
