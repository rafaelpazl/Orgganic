<?php
include_once('../backend/config.php');

// Verifique se a conexão com o banco de dados foi estabelecida corretamente
if ($conexao) {
    // Verifique se o ID do produto está presente na URL
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        
        // Consulta SQL para selecionar os detalhes do produto com base no ID fornecido
        $sql = "SELECT title, description, price, discount, main_image, additional_images FROM product WHERE id = ?";
        
        // Preparar a consulta SQL
        $stmt = mysqli_prepare($conexao, $sql);

        if ($stmt) {
            // Vincular o parâmetro ID
            mysqli_stmt_bind_param($stmt, "i", $product_id);

            // Execute a consulta SQL
            mysqli_stmt_execute($stmt);

            // Trate os resultados da consulta
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $discount = $row['discount'];
                $main_image = $row['main_image'];
                $additional_images = explode(",", $row['additional_images']); // Converta as imagens adicionais em um array
            } else {
                // Produto não encontrado com o ID fornecido
                echo "Produto não encontrado";
            }

            // Feche o statement
            mysqli_stmt_close($stmt);
        } else {
            // Trate o erro ao preparar a consulta
            echo "Erro ao preparar a consulta: " . mysqli_error($conexao);
        }
    } else {
        // ID do produto não fornecido na URL
        echo "ID do produto não fornecido";
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    // Trate o erro de conexão com o banco de dados
    echo "Erro ao conectar ao banco de dados: " . mysqli_connect_error();
}
?>

<!DOCTYPE html>
  <head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="Orgganic, Streetwear, rap," />
    <meta name="description" content="" />
    <meta name="author" content="Rafael Paz" />
    <link rel="shortcut icon" href="../images/favicon-32x32.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- CSS -->
    
    <link href="../css/products.css" rel="stylesheet">
    <meta name="robots" content="noindex,follow" />
  
    <title>
      Orgganic ® - Exale autoestima
    </title>

   <!-- Owl Carousel stylesheet -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">    
  
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/responsive.css" rel="stylesheet" />
  
    <!-- Fonte inter - Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&family=Montserrat:wght@100;500;900&display=swap" rel="stylesheet">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <!-- Add Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Owl Carousel stylesheet -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  
  <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
  
  <link href="../css/modal.css" rel="stylesheet"/>
  </head>
  <style>
    
      body{
        overflow-x: hidden!important;
      }
      .product-price strong{
        margin-left: 10px;
      }
      .main-image{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
      }
      #mainImage{
        width: 60%;
      }
      .owl-carousel .owl-item img {
    display: block; 
}
@media (max-width: 767px) {
    .main-image{
        display: none;
    }
    }
  </style>
  <body>
    <div class="texthead">
      PARCELAMENTO NO CARTÃO EM ATÉ 3X SEM JUROS
    </div>  
     <span class="top-nav">       
       <img class="animated-image" src="../images/elemento_1-removebg-preview.png" alt="">
       <img class="animated-image" src="../images/elemento_2-removebg-preview.png" alt="">
       <img class="animated-image" src="../images/elemento_3-removebg-preview.png" alt="">
       <img class="animated-image" src="../images/elemento_5-removebg-preview.png" alt="">
       <img class="animated-image" src="../images/elemento_6-removebg-preview.png" alt="">
       <img class="logotipo" src="../images/LOGOOblack.png" alt="Orgganic" onclick="logotipoHead()">
       <img class="animated-image" src="../images/elemento_7-removebg-preview.png" alt="">
       <img class="animated-image" src="../images/elemento_8-removebg-preview.png" alt="">
       <img class="animated-image" src="../images/elemento_9-removebg-preview.png" alt="">
       <img class="animated-image" src="../images/elemento_10-removebg-preview.png" alt="">
       <img class="animated-image" src="../images/elemento_11-removebg-preview.png" alt="">
     </span>
      <!-- Navigation-->
      <div class="container nav-containter">
       <nav class="navbar navbar-expand-lg navbar-dark" id="mainNav">
           <div class="container">
               <a class="navbar-brand " href="/pages//pages/index.html"><img class="logo-nav" src="../images/LOGOO.png" height="90px" alt="Pazweb"/></a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                   Menu
                   <i class="fas fa-bars ms-1"></i>
                   
               </button>
               <div class="collapse navbar-collapse" id="navbarResponsive">
                  <div class="float-left">
                     <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0 l-flex">
                         <li class="nav-item"><a class="nav-link" href="index.html#shop_section">Panos</a></li>
                         <li class="nav-item"><a class="nav-link" href="index.html#saving_section">OGGNC</a></li>
                         <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Fala com nóis!
                           </a>
                           <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="https://api.whatsapp.com/send?phone=5575983414324&text=Salvee!%20Curti%20os%20trajes%20mano,%20quero%20saber%20mais" target="_blank">
                               <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                               <span>+55 75 9212-2132</span></a></li>
                             <li><a class="dropdown-item" href="https://www.instagram.com/_orgganic/" target="_blank">
                               <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                               <span>@_orgganic</span></a></li>
                             <li><hr class="dropdown-divider"></li>
                             <li><a class="dropdown-item" href="mailto:orggnc@gmail.com?" target="_blank">
                               <i class="fa fa-envelope" aria-hidden="true"></i>
                               <span>orggnc@gmail.com</span></a></li>
                           </ul>
                         </li>
                     </ul>
                  </div>
                  <div class="container nav-container">
                   <div class="float-right">
                     <a href="">
                           <i class="fa fa-user falogin" aria-hidden="true">
                             Login
                           </i>
                         </a>
                         <a href="">
                           <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                         </a>
                         <form class="form-inline ">
                           <button class="btn nav_search-btn" type="submit">
                             <a><i class="fa fa-search" aria-hidden="true"></i></a>
     
                           </button>
                   </div>
                 </div>
               </div>
           </div>
       </nav>
   </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!--  End navbar  -->
   
<!-- Se as informações do produto estiverem disponíveis, exiba-as -->
<?php if (isset($title) && isset($description) && isset($price)): ?>
    <section class="product">
        <main class="container row"><!-- Left Column / Product Images Carousel -->
<!-- Left Column / Product Images Carousel -->
<div class="col-md-8">
    <!-- Imagem Principal em Destaque -->
    <div class="main-image">
        <img id="mainImage" src="<?php echo $main_image;?>" alt="Imagem do Produto">
    </div>
    <!-- Carrossel de Imagens Adicionais -->
    <div class="owl-carousel owl-theme">
        <!-- Adicione a imagem principal ao carrossel -->
        <div class="item">
            <img src="<?php echo $main_image;?>" alt="Imagem do Produto" onclick="displayImage('<?php echo $main_image; ?>')">
        </div>
        <!-- Loop para exibir imagens adicionais do produto -->
        <?php foreach ($additional_images as $image): ?>
            <div class="item">
                <img src="<?php echo $image; ?>" alt="Imagem do Produto" onclick="displayImage('<?php echo $image; ?>')">
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    // Função para exibir uma imagem em destaque ao clicar nas miniaturas do carrossel
    function displayImage(imageUrl) {
        document.getElementById('mainImage').src = imageUrl;
    }
</script>



            <!-- Right Column / Product Details -->
            <div class="right-column col-md-4">
                <!-- Product Description -->
                <div class="product-description">
                    <span><?php echo $title; ?></span>
                    <h1><?php echo $description; ?></h1>
                </div>

                <!-- Product Pricing -->
                <div class="product-price">
                    <p><del>R$ <?php echo $price; ?></del></p>
                    <p><strong>R$ <?php echo $discount; ?></strong></p>
                </div>
                <!-- Botão de Adicionar ao Carrinho -->
                <a href="#" class="cart-btn">Adicionar ao Carrinho</a>
            </div>
        </main>
    </section>
<?php endif; ?>


    <!-- end why section -->
  
    <img class="img1" src="../images/banner_footer.jpg" alt="Use Orgganic" width="100%">
    <img class="img2" src="../images/banner_footer1.jpg" alt="Use Orgganic" width="100%">
    
    
    <section class="info_section  layout_padding2-top">
      
      <div class="social_container">
      </div>
      <div class="info_container">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <h6>
                Sobre nós
              </h6>
              <p>
                A orgganic é uma marca de roupa que busca enaltecer o estilo streetwear, e trazer mais visibilidade para nosso estilo de rua.
              </p>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="info_form">
                <h5>
                  Receba novidades pelo e-mail!
                </h5>
                <form action="#">
                  <input type="email" placeholder="Preencha com seu email">
                  <button>
                    Enviar
                  </button>
                </form>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <h6>
                Fale conosco
              </h6>
              <div class="info_link-box">
                <a href="https://www.instagram.com/_orgganic/" target="_blank">
                  <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                  <span>@_orgganic</span>
                </a>
                <a href="https://api.whatsapp.com/send?phone=5575983414324&text=Salvee!%20Curti%20os%20trajes%20mano,%20quero%20saber%20mais" target="_blank">
                  <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                  <span>+55 75 98341-4324</span>
                </a>
                <a href="mailto:orggnc@gmail.com?" target="_blank">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <span>orggnc@gmail.com</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- footer section -->
      <footer class=" footer_section">
        <div class="container">
          <p>
            &copy; <span id="displayYear"></span> Todos os direitos reservados. Feito por
            <strong><a href="https://pazweb.com.br" target="_blank"><img src="../images/pazweb.webp" width="100px"></a></strong>
          </p>
        </div>
      </footer>
      <!-- footer section -->
  
    </section>

    <div class="modal-container">
     <div class="ajuste" onclick="closeModal()">
        <div class="modal">
          <h2>Detalhes do produto</h2>
          <hr />
          <span>
            <table class="rTable"> 
              <tbody>
                  <tr>
                      <td>Tipo de roupa</td>
                      <td>Oversized</td>
                  </tr>
                  <tr>
                      <td>Gola</td>
                      <td>Gola Redonda</td>
                  </tr>
                  <tr>
                    <td>Estilo</td>
                    <td>Estilo de Rua</td>
                </tr>
                <tr>
                  <td>Tamanho Grande</td>
                  <td>Sim</td>
              </tr>
              <tr>
                <td>País de Origem</td>
                <td>Brasil</td>
            </tr>
            <tr>
              <td>Estampa</td>
              <td>Estampado</td>
          </tr>
          <tr>
            <td>Compimento da Manga</td>
            <td>Manga Comprida</td>
        </tr>
        <tr>
          <td>Tamanho Do Pacote</td>
          <td>0.229KG</td>
      </tr>
    <tr>
      <td>Enviado de</td>
      <td>Bahia</td>
  </tr>
  
              </tbody>
          </table>
          </span>
          <hr />
          <div class="btns">
            <button class="btnClose" onclick="closeModal()">Fechar</button>
          </div>
        </div>
     </div>
    </div>  
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        });
    });
</script>
  </body>
</html>
