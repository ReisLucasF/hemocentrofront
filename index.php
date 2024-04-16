
<?php
    include './partials/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layout de Grid com Bootstrap</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <?php echo $favicon; ?>
</head>
<style>
  .blood01{
    content:url('./img/bloodlevel/bloodlevel-3.png');
  }
  .blood02 {  
    content:url('./img/bloodlevel/bloodlevel-2.png');  
  }
  .blood03 {
    content:url('./img/bloodlevel/bloodlevel-1.png')
  }
</style>
<body>
  <div class="container">
    <div class="row">
      <div class="col">
        <h2>Aqui será o carrossel</h2>
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
        <a href="<?php echo $domain; ?>/criar_agendamento.php"><img  class="agenda" src="./img/calendario.png" alt=""></a>
      </div>
    </div>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="blood.js"></script>
  
<?php
    include './partials/footer.php';
?>
</body>
</html>
