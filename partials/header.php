<?php
global $domain;
$siteUrl = $_SERVER['HTTP_HOST'];
$domain = "http://{$siteUrl}";
global $favicon;
$favicon = "<link rel='shortcut icon' href='{$domain}/img/favicon.png' type='image/x-icon'>";
?>

<nav class="navbar navbar-expand-lg navbar-dark  transparent-navbar">
    <a class="navbar-brand" href="<?php echo $domain; ?>">
        Hemocentro
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto" id="menuUsuario">
        </ul>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        function atualizarMenuUsuario() {
            var usuarioLogado = sessionStorage.getItem('usuarioLogado');
            var menuUsuario = $('#menuUsuario');

            if (usuarioLogado) {
                var usuario = JSON.parse(usuarioLogado);
                menuUsuario.empty();

                if (usuario.tipoUsuario === 'hemocentro') {
                    //hemocentro
                    menuUsuario.append('<li class="nav-item">' +
                                            '<a class="nav-link" href="<?php echo $domain; ?>/hemocentro/index.php">Painel</a>' +
                                        '</li>' +
                                        '<li class="nav-item">' +
                                            '<a class="nav-link" href="<?php echo $domain; ?>/hemocentro/campanhas.php">Campanhas</a>' +
                                        '</li>' +
                                        '<li class="nav-item dropdown">' +
                                            '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                                usuario.nome +
                                            '</a>' +
                                            '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">' +
                                                '<a class="dropdown-item" href="<?php echo $domain; ?>/hemocentro/perfil/">Perfil</a>' +
                                                '<div class="dropdown-divider"></div>' +
                                                '<a class="dropdown-item logout-btn" href="#">Logout</a>' +
                                            '</div>' +
                                        '</li>'
                                        );
                } else {
                    //doador
                    menuUsuario.append('<li class="nav-item">' +
                                            '<a class="nav-link" href="<?php echo $domain; ?>/doador/criar_agendamento.php">Doar</a>' +
                                        '</li>'+
                                        '<li class="nav-item">' +
                                            '<a class="nav-link" href="<?php echo $domain; ?>/campanhas.php">Campanhas</a>' +
                                        '</li>' +
                                        '<li class="nav-item dropdown">' +
                                            '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                                usuario.nome +
                                            '</a>' +
                                            '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">' +
                                                '<a class="dropdown-item" href="<?php echo $domain; ?>/doador/">Perfil</a>' +
                                                '<div class="dropdown-divider"></div>' +
                                                '<a class="dropdown-item logout-btn" href="#">Logout</a>' +
                                            '</div>' +
                                        '</li>'
                                        );
                }
            } else {
                menuUsuario.empty();
                menuUsuario.append('<li class="nav-item">' +
                                        '<a class="nav-link" href="<?php echo $domain; ?>/sobre.php">Sobre</a>' +
                                    '</li>'+
                                    '<li class="nav-item">' +
                                            '<a class="nav-link" href="<?php echo $domain; ?>/campanhas.php">Campanhas</a>' +
                                        '</li>' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-link login" href="<?php echo $domain; ?>/login.php">Login</a>' +
                                    '</li>'
                                    );
            }

            $('.logout-btn').click(function(event) {
                event.preventDefault();
                sessionStorage.removeItem('usuarioLogado');
                window.location.href = '<?php echo $domain; ?>/login.php';
            });
        }

        atualizarMenuUsuario();
    });
</script>
