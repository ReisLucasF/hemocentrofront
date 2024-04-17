

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Campanhas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
  <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
</head>
<style>

</style>
<body>
  <?php
      include '../partials/header.php';
  ?>
  <div class="container mt-4">
      <button class="btn btn-sm btnADC mb-2" data-toggle="modal" data-target="#modalAdicionarCampanha">Adicionar</button>
  <h2>Campanhas/Solicitações</h2>
  <div class="campanhasMenu">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Solicitante</th>
            <th scope="col">Tipo Sanguíneo</th>
            <th scope="col">Cidade</th>
            <th scope="col">Solicitado em</th>
            <th scope="col">Contato</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody id="tabela-campanhas">
        <!-- Os dados da tabela serão inseridos aqui -->
        </tbody>
    </table>
  </div>
</div>

<?php
    include './modals/criarCampanha.php'
?>

<?php
    include './modals/editarCampanha.php'
?>

      

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <script src="index.js"></script>
  
<?php
    include '../partials/footer.php';
?>
</body>
</html>
