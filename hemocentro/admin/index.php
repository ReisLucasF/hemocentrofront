
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layout de Grid com Bootstrap</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="../grid.css">
  <link rel="stylesheet" href="../../style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KXQo5qByhwpDS6Zk+AH9C7wE/R5K9aDjEGI1fL5VozM=" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
</head>

<body>
  <?php
      include '../../partials/header.php';
  ?>
  <div class="container">
    <div class="principal">
      <div class="grid-container">
        <!-- primeira linha -->
        <!--1-->
        <a class="grid-item" href="<?php echo $domain; ?>/hemocentro/admin/hemocentros.php">
          <span class="material-symbols-outlined"> home_health </span><br />
          Hemocentros
        </a>
        <!-- dsd -->
        <!--2-->
        <a class="grid-item" href="<?php echo $domain; ?>/hemocentro/admin/usuarios.php">
          <span class="material-symbols-outlined"> groups </span><br />
          Usuários
        </a>

        <a class="grid-item" href="<?php echo $domain; ?>/hemocentro/admin/chamado.php">
          <span class="material-symbols-outlined"> support_agent </span><br />
          Abrir chamado
        </a>

        <a class="grid-item" href="<?php echo $domain; ?>/hemocentro/admin/niveis.php">
          <span class="material-symbols-outlined"> bloodtype </span><br />
          Níveis de sangue
        </a>
    </div>
  </div>

<?php
  include '../../rules/verificarHemocentro.php';
?>
  
<?php
    include '../../partials/footer.php';
?>
</body>
</html>
