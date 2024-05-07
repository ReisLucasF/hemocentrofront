<?php
session_start();
global $domain;
$siteUrl = $_SERVER['HTTP_HOST'];
$domain = "http://{$siteUrl}/hemocentro";
global $favicon;
$favicon = "<link rel='shortcut icon' href='{$domain}/img/favicon.png' type='image/x-icon'>";
global $titlesite;
$titlesite = "Hemocentro";
?>

<nav class="navbar navbar-expand-lg navbar-dark transparent-navbar">
    <a class="navbar-brand" href="<?php echo $domain; ?>">
        Hemocentro
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['usuarioLogado'])): ?>
                <?php $usuario = $_SESSION['usuarioLogado']; ?>
                <?php if ($usuario['tipoUsuario'] === 'hemocentro'): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $domain; ?>/hemocentro/index.php">Painel</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $domain; ?>/hemocentro/campanhas.php">Campanhas</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $usuario['nome']; ?></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo $domain; ?>/hemocentro/perfil/">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo $domain; ?>/logout.php">Logout</a>
                        </div>
                    </li>
                <?php elseif ($usuario['tipoUsuario'] === 'doador'): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $domain; ?>/doador/criar_agendamento.php">Doar</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $domain; ?>/campanhas.php">Campanhas</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $usuario['nome']; ?></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo $domain; ?>/doador/">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo $domain; ?>/logout.php">Logout</a>
                        </div>
                    </li>
                <?php endif; ?>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo $domain; ?>/sobre.php">Sobre</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $domain; ?>/campanhas.php">Campanhas</a></li>
                <li class="nav-item"><a class="nav-link  login" href="<?php echo $domain; ?>/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('.logout-btn').click(function(event) {
            event.preventDefault();
            sessionStorage.removeItem('usuarioLogado');
            window.location.href = '<?php echo $domain; ?>/logout.php';
        });
    });
</script>