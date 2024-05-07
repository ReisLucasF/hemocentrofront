

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <style>
        .blood01 {
            content: url('./img/bloodlevel/bloodlevel-3.png');
        }
        .blood02 {
            content: url('./img/bloodlevel/bloodlevel-2.png');
        }
        .blood03 {
            content: url('./img/bloodlevel/bloodlevel-1.png');
        }
        .owl-carousel .item {
            text-align: center;
            border-radius: 10px;
            overflow: hidden;
        }
        .owl-carousel .item img {
            display: block;
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .owl-nav button {
            width: 30px;
            height: 30px;
            background-color: transparent;
            border: none;
        }
        .owl-nav button {
            background-color: #ffffff !important;
            border: none;
            border-radius: 100% !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            color: #000;
            transition: background-color 0.3s, color 0.3s;
        }
        .owl-nav button:hover {
            background-color: #e0e0e0 !important;
            color: #666;
        }
        .owl-nav button.owl-prev, .owl-nav button.owl-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
        }
        .owl-nav button.owl-prev {
            left: -50px;
        }
        .owl-nav button.owl-next {
            right: -50px;
        }
        .owl-dots .owl-dot span {
            background: #000;
        }
    </style>
</head>
<body>
    
    <?php
        include './partials/header.php';
    ?>
    
  <div class="container">
    <div class="row">
        <div class="col">
            <h2>Notícias</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="owl-carousel owl-theme">
                <div class="item"><img src="<?php echo $domain; ?>/img/noticias/noticia01.svg" alt="Imagem 1"></div>
                <div class="item"><img src="<?php echo $domain; ?>/img/noticias/noticia02.svg" alt="Imagem 2"></div>
                <div class="item"><img src="<?php echo $domain; ?>/img/noticias/noticia03.svg" alt="Imagem 3"></div>
                <div class="item"><img src="<?php echo $domain; ?>/img/noticias/noticia04.svg" alt="Imagem 4"></div>
                <div class="item"><img src="<?php echo $domain; ?>/img/noticias/noticia05.svg" alt="Imagem 5"></div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col">
        <h2>Indicadores</h2>
        <p>Nossos indicadores sanguíneos.</p>
        <!-- Grid dos Estoques -->
        <header class="row align-items-center mb-2">
            <div class="col-auto">
                <button class="btn btn-niveis btn-secondary seta-anterior" id="botao-anterior">&lt;</button>
            </div>
            <div class="col">
                <h2 class="text-center" id="nome-hemocentro">Nome do Hemocentro</h2>
            </div>
            <div class="col-auto">
                <button class="btn btn-niveis btn-secondary seta-proxima" id="botao-proximo">&gt;</button>
            </div>
        </header>

        <container-estoque>
            
            <section-1>
                <div><img src="https://hemocentro.devosalliance.com/img/carregamento.gif" class="card-blood" id="blood-Apos" alt="A+"><h4>A+</h4></div>
                <div><img src="https://hemocentro.devosalliance.com/img/carregamento.gif" class="card-blood" id="blood-Aneg" alt="A-"><h4>A-</h4></div>
                <div><img src="https://hemocentro.devosalliance.com/img/carregamento.gif" class="card-blood" id="blood-Bpos" alt="B+"><h4>B+</h4></div>
                <div><img src="https://hemocentro.devosalliance.com/img/carregamento.gif" class="card-blood" id="blood-Bneg" alt="B-"><h4>B-</h4></div>
                <div><img src="https://hemocentro.devosalliance.com/img/carregamento.gif" class="card-blood" id="blood-ABpos" alt="AB+"><h4>AB+</h4></div>
                <div><img src="https://hemocentro.devosalliance.com/img/carregamento.gif" class="card-blood" id="blood-ABneg" alt="AB-"><h4>AB-</h4></div>
                <div><img src="https://hemocentro.devosalliance.com/img/carregamento.gif" class="card-blood" id="blood-Opos" alt="o+"><h4>o+</h4></div>
                <div><img src="https://hemocentro.devosalliance.com/img/carregamento.gif" class="card-blood" id="blood-Oneg" alt="o-"><h4>o-</h4></div>
            </section-1>
            <!-- Colunas de legenda -->
            <section-2>
                <h2>Nível</h2>
                <img class="card-blood-leg blood01" alt="carregando...">
                <h4>Crítico</h4>
                <img class="card-blood-leg blood02" alt="carregando...">
                <h4>Regular</h4>
                <img class="card-blood-leg blood03" alt="carregando...">
                <h4>Adequado</h4>
            </section-2>
        </container-estoque>
      </div>


      
      <div class="col  text-center">
        <h2>Agende sua Doação</h2>
        <p>Seja um doador recorrente.</p>
        <a href="<?php echo $domain; ?>/doador/criar_agendamento.php"><img  class="agenda" src="./img/calendario.png" alt=""></a>
      </div>
    </div>
  </div>
  
  <script src="blood.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
 <script>
      $(document).ready(function(){
          $(".owl-carousel").owlCarousel({
              items: 1,
              loop: true,
              margin: 10,
              nav: true,
              dots: true,
              navText: [
                  '<i class="fas fa-chevron-left"></i>',
                  '<i class="fas fa-chevron-right"></i>'
              ]
          });
      });
  </script>

  
<!-- Bootstrap JS e jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  
<?php
    include './partials/footer.php';
?>
</body>
</html>
