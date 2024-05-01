<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="../css/manager_products.css">
    <style>
        /* Estilos para a lista de produtos */
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        /* Estilos para cada item de produto */
        .product {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        /* Estilos para a imagem do produto */
        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        /* Estilos para o título do produto */
        .product h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Estilos para os botões */
        .product a {
            display: inline-block;
            padding: 8px 16px;
            margin-top: 10px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-view-product {
            background-color: #007bff;
        }

        .button-delete-product {
            background-color: red;
        }

        .button-view-product:hover, .button-delete-product:hover {
            background-color: #0056b3;
        }

        /* Estilos para os botões de adição */
        .add-product-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .add-product-buttons a {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-unit-button {
            background-color: green;
        }

        .add-mult-button {
            background-color: red;
        }

        .add-unit-button:hover, .add-mult-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="product-list">
        <!-- Product items will be dynamically generated here -->
        
        <?php
        include_once('../backend/config.php');

        // Conectar ao banco de dados
        $conn = $conexao;

        // Consulta SQL para obter apenas os IDs, main_image e title dos produtos
        $getProductsSql = "SELECT id, main_image, title FROM product";
        $getProductsResult = mysqli_query($conn, $getProductsSql);

        // Verificar se a consulta foi bem-sucedida
        if ($getProductsResult) {
            // Se houver produtos cadastrados
            if (mysqli_num_rows($getProductsResult) > 0) {
                // Exibir apenas as imagens e títulos dos produtos
                while ($row = mysqli_fetch_assoc($getProductsResult)) {
                    echo "<div class='product'>";
                    echo "<img src='" . $row['main_image'] . "' alt='Product Image'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    // Adicionar opção de visualizar mais detalhes (link para view_product.php)
                    echo "<a class='button-view-product' href='view_product.php?id=" . $row['id'] . "'>Ver detalhes</a>";
                    echo "<a class='button-delete-product' href='../backend/delete_product.php?id=" . $row['id'] . "'>EXCLUIR</a>";
                    echo "</div>";
                }
            } else {
                echo "Nenhum produto encontrado.";
            }
        } else {
            echo "Erro ao buscar produtos: " . mysqli_error($conn);
        }

        // Fechar conexão com o banco de dados
        mysqli_close($conn);
        ?>
    </div>

    <div class="add-product-buttons">
        <a class="add-unit-button" href="frontend_add_unit_product_input.php" target="_blank" rel="noopener noreferrer">ADICIONAR PRODUTO SEM VARIAÇÕES</a>
        <a class="add-mult-button" href="frontend_add_mult_product_input1.php" target="_blank" rel="noopener noreferrer">ADICIONAR PRODUTO COM VARIAÇÕES</a>
    </div>
</body>
</html>
