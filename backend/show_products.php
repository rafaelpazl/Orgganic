<?php
include_once('config.php');
?>

<html>
<head>
  <link rel="stylesheet" href="../css/show_products.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <style>
    /* Estilos para dispositivos móveis */
    @media (max-width: 767px) {
      .col {
        width: 90%;
      }
      .box .img-box img {
        transition: transform 0.3s ease;
      }
      .box:hover .img-box img {
        transform: scale(1.02); 
      }
    }

    /* Estilos para computadores */
    @media (min-width: 768px) {
      .col {
        width: 30%;
        float: left;
      }

      .box .img-box img {
        max-width: 100%; /* Tornar as imagens responsivas */
        transition: transform 0.3s ease;
      }

      .box:hover .img-box img {
        transform: scale(1.05); 
      }
    }
  </style>
</head>
<body>

<?php
// Verifique se a conexão com o banco de dados foi estabelecida corretamente
if ($conexao) {
    // Consulta SQL para selecionar todos os campos desejados da tabela de produtos
    $sql = "SELECT id, title, price, discount, main_image FROM product";

    // Preparar e executar a consulta SQL
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        // Execute a consulta SQL
        mysqli_stmt_execute($stmt);

        // Trate os resultados da consulta, por exemplo:
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
?> 
<section class="shop_section layout_padding" id="shop_section">
  <div class="container">
    <div class="heading_container heading_center">
    </div>
    <div class="row">
      <div class="col">
        <div class="box">
        <a href="../pages/products.php?id=<?php echo $row['id']; ?>">
            <div class="img-box">
              <!-- Exiba a imagem principal do produto -->
              <img class="img1-vestuario" src="<?php echo $row['main_image']; ?>" alt="">
            </div>
            <div class="detail-box">
              <!-- Exiba o título do produto -->
              <h6><?php echo $row['title']; ?></h6>
              <!-- Exiba o preço do produto com desconto -->
              <h6>
                <span>
                  <del><?php echo "R$" . $row['price']; ?></del> <!-- Preço original riscado -->
                  <?php echo " R$" . $row['discount']; ?> <!-- Preço com desconto -->
                </span>
              </h6>
            </div>
            <div class="new">
              <span>Novo</span>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
        }

        // Feche o statement
        mysqli_stmt_close($stmt);
    } else {
        // Trate o erro ao preparar a consulta
        echo "Erro ao preparar a consulta: " . mysqli_error($conexao);
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    // Trate o erro de conexão com o banco de dados
    echo "Erro ao conectar ao banco de dados: " . mysqli_connect_error();
}
?>

</body>
</html>
