<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_product.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Adicionar Produtos</title>
</head>

<style>
    .next-btn {
        display: flex;
        width: 100%;
        justify-content: end;
    }
    #next-btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<body>
    <div class="container">
        <h1>Adicionar Produtos</h1>
        <form id="product-form" action="../backend/backend_add_mult_product1.php" method="post" enctype="multipart/form-data">
            <!-- Adicione um campo oculto para o ID do usuário -->
            
            <input type="text" name="variations" value="YES" id="variations" style="display: none;">
         
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
            <div class="next-btn">
                <button id="next-btn">Avançar <span class="material-symbols-outlined"></span></button>
                <button><a href="manager_products.php" target="_blank">GERENCIAR PRODUTOS</a></button>
            </div>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="../js/add_product.js"></script>
    <script>
        document.getElementById('next-btn').addEventListener('click', function(event) {
            var title = document.getElementById('title-product').value;
            var mainImage = document.getElementById('picture__input').value;
            
            if (title === '' || mainImage === '') {
                alert('Por favor, preencha todos os campos obrigatórios.');
                event.preventDefault(); // Impede o envio do formulário
            }
        });
    </script>
</body>
</html>
