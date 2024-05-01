<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            animation: fadein 1s;
        }
        @keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .product-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #007bff;
            text-align: center;
            text-transform: uppercase;
        }
        .product-description {
            margin-bottom: 20px;
            text-align: center;
        }
        .product-info {
            margin-bottom: 20px;
        }
        .product-info p {
            margin: 5px 0;
        }
        .product-images {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .product-images img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }
        .product-images img:hover {
            transform: scale(1.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            word-break: break-all;
        }
        td{
            align-items: center;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .container-variations img{
            width: 100px;
            border-radius: 5px;
            transition: transform 0.3s ease-in-out;
        }
        .container-variations img:hover {
            transform: scale(1.1);
        }
        .edit-button, .save-button {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s ease-in-out;
        }
        .edit-button {
            background-color: #007bff;
            color: #fff;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .save-button {
            background-color: #28a745;
            color: #fff;
        }
        .save-button:hover {
            background-color: #218838;
        }
        img{
            max-width: 150px!important;
            height: auto;
        }
        .uuid{
            display: none;
        }
        .button-delete-variation, .button-add-variation, .button-voltar{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
            min-width: 100px;
            padding: 10px;
            background-color: red;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
        }
        .button-add-variation, .button-voltar{
            
            max-width: 200px;
            margin: 5px;
        }
        .button-add-variation{
            background-color: #007bff;
        }
        .button-voltar{
            background-color: #28a745;
        }
        
    </style>
</head>
<body>
    <div class="container">
        
        <?php
            include_once('../backend/config.php');

            // Verificar se o ID do produto foi passado pela URL
            if(isset($_GET['id'])) {
                // Conectar ao banco de dados
                $conn = $conexao;

                // Obter o ID do produto da URL
                $productId = $_GET['id'];

                // Consulta SQL para obter os detalhes do produto com base no ID
                $getProductDetailsSql = "SELECT title, description, price, main_image, discount, gtin, qnt_storage, additional_images, variations FROM product WHERE id = ?";
                $getProductDetailsStmt = mysqli_prepare($conn, $getProductDetailsSql);
                mysqli_stmt_bind_param($getProductDetailsStmt, "s", $productId);
                mysqli_stmt_execute($getProductDetailsStmt);
                mysqli_stmt_bind_result($getProductDetailsStmt, $title, $description, $price, $main_image, $discount, $gtin, $qnt_storage, $additional_images, $variations);
                mysqli_stmt_fetch($getProductDetailsStmt);
                mysqli_stmt_close($getProductDetailsStmt);

                if ($variations == "YES") {
                    // Exibir os detalhes do produto
                    echo "<div class='product-title'>$title</div>";
                    echo "<div class='product-description'>$description</div>";
                    echo "<div class='product-images'> <img src='$main_image'></div>";
                } else {

                    echo "<div class='container-variations'>";
                    echo "<form method='post' enctype='multipart/form-data' action='../backend/atualizar_produto.php'>";
                    echo "<input type='hidden' name='productId' value='$productId'>";
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Produto</th>";
                    echo "<th>Título</th>";
                    echo "<th>Descrição</th>";
                    echo "<th>Preço</th>";
                    echo "<th>Desconto</th>";
                    echo "<th>GTIN</th>";
                    echo "<th>Qntd</th>";
                    echo "<th>...</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                        echo "<tr>";
                        echo "<td><img src='$main_image' alt='Variation Image'></td>";
                        echo "<td><input type='text' name='title' value='$title'></td>";
                        echo "<td><input type='text' name='description' value='$description'></td>";
                        echo "<td><input type='text' name='price' value='" . number_format($price, 2, ',', '.') . "'></td>";
                        echo "<td><input type='text' name='discount' value='" . number_format($discount, 2, ',', '.') . "'></td>";
                        echo "<td><input type='text' name='gtin' value='$gtin'></td>";
                        echo "<td><input type='text' name='qnt_storage' value='$qnt_storage'></td>";
                        echo "<td><a class='button-delete-variation' href='../backend/delete_product.php?productId=$productId'>EXCLUIR</a></td>";
                        echo "</tr>";

                    echo "</tbody>";
                    echo "</table>";
                    echo "<button type='submit' class='save-button'>Salvar</button>";
                    echo "</form>";
                    echo "<a class='button-voltar' href='manager_products.php'>GERENCIAR PRODUTOS</a>";
                    echo "</div>";
                }



                // Exibir imagens adicionais, se houver
                if (!empty($additional_images)) {
                    $additional_images_array = explode(",", $additional_images);
                    echo "<div class='product-images horizontal'>";
                    foreach ($additional_images_array as $image) {
                        echo "<img src='$image' alt='Additional Image'>";
                    }
                    echo "</div>";
                }

                // Consulta SQL para obter as variações do produto
                $getVariationsSql = "SELECT uuid, category, variation, price, discount, gtin, storage, main_image FROM variation WHERE product_id = ?";
                $getVariationsStmt = mysqli_prepare($conn, $getVariationsSql);
                mysqli_stmt_bind_param($getVariationsStmt, "s", $productId);
                mysqli_stmt_execute($getVariationsStmt);
                mysqli_stmt_bind_result($getVariationsStmt, $uuid, $category, $variation, $price, $discount, $gtin, $storage, $main_image);
                
                if(mysqli_stmt_fetch($getVariationsStmt)) {
                    echo "<h3>Variações:</h3>";
                    echo "<div class='container-variations'>";
                    echo "<form method='post' enctype='multipart/form-data' action='../backend/atualizar_variacoes.php'>";
                    echo "<input type='hidden' name='productId' value='$productId'>";
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Imagem</th>";
                    echo "<th>Categoria</th>";
                    echo "<th>Variação</th>";
                    echo "<th>Preço</th>";
                    echo "<th>Desconto</th>";
                    echo "<th>GTIN</th>";
                    echo "<th>Qntd</th>";
                    echo "<th>...</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    do {
                        echo "<tr>";
                        echo "<td><img src='$main_image' alt='Variation Image'></td>";
                        echo "<td><input type='text' name='category[]' value='$category'></td>";
                        echo "<input type='text' name='uuid[]' class='uuid' value='$uuid'>";
                        echo "<td><input type='text' name='variation[]' value='$variation'></td>";
                        echo "<td><input type='text' name='price[]' value='" . number_format($price, 2, ',', '.') . "'></td>";
                        echo "<td><input type='text' name='discount[]' value='" . number_format($discount, 2, ',', '.') . "'></td>";
                        echo "<td><input type='text' name='gtin[]' value='$gtin'></td>";
                        echo "<td><input type='text' name='storage[]' value='$storage'></td>";
                        echo "<td><a class='button-delete-variation' href='../backend/delete_variation.php?uuid=$uuid&product_id=$productId'>EXCLUIR</a></td>";
                        echo "</tr>";
                    } while(mysqli_stmt_fetch($getVariationsStmt));
                    echo "</tbody>";
                    echo "</table>";
                    echo "<button type='submit' class='save-button'>Salvar</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "<div style='display: flex; flex-direction: row;'>";
                    echo "<a class='button-add-variation' href='frontend_add_mult_product_input2.php?productId=$productId'>ADICIONAR VARIAÇÃO</a>";
                    echo "<a class='button-voltar' href='manager_products.php'>GERENCIAR PRODUTOS</a>";
                    echo "</div>";
                } else {
                    echo "<p>Nenhuma variação disponível para este produto.</p>";
                }
                
                // Fechar a declaração de consulta de variações
                mysqli_stmt_close($getVariationsStmt);
                
            } else {
                echo "ID do produto não fornecido na URL.";
            }
        ?>
    </div>
</body>
</html>
