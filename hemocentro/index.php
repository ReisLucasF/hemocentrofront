

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Hemocentro</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="./grid.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KXQo5qByhwpDS6Zk+AH9C7wE/R5K9aDjEGI1fL5VozM=" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
</head>

<body>
  <?php
      include '../partials/header.php';
  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <div class="container">
    <div class="principal">
      <div class="grid-container">
        <!-- primeira linha -->
        <!--1-->
        <a class="grid-item" href="<?php echo $domain; ?>/hemocentro/agenda.php">
          <span class="material-symbols-outlined"> calendar_month </span><br />
          Agenda
        </a>
        <!-- dsd -->
        <!--2-->
        <a class="grid-item" href="<?php echo $domain; ?>/hemocentro/doadores.php">
          <span class="material-symbols-outlined"> groups </span><br />
          Doadores
        </a>

        <!--3-->
        <a  class="grid-item" href="<?php echo $domain; ?>/hemocentro/niveis.php">
          <span class="material-symbols-outlined"> bloodtype </span><br />
          Níveis de sangue
        </a>

        <!-- 4 -->
        <a class="grid-item" href="<?php echo $domain; ?>/hemocentro/campanhas.php">
          <span class="material-symbols-outlined"> campaign </span><br />
          Campanhas
        </a>
        <!-- dsd -->
        <!-- 5 -->
        <a class="grid-item" href="<?php echo $domain; ?>/hemocentro/noticias.php">
          <span class="material-symbols-outlined"> newspaper </span><br />
          Notícias
        </a>

        <!-- 6 -->
        <a  class="grid-item" href="<?php echo $domain; ?>/hemocentro/admin/">
          <span class="material-symbols-outlined"> admin_panel_settings </span><br />
          Administrar
        </a>
    </div>
  </div>

<?php
  include '../rules/verificarHemocentro.php';
?>
  
<?php
    include '../partials/footer.php';
?>
</body>
</html>
