<?php
    include './config/config.php';
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
            <!-- Os itens de menu do usuário serão adicionados dinamicamente aqui -->
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
                menuUsuario.append('<li class="nav-item">' +
                                        '<a class="nav-link" href="<?php echo $domain; ?>/agenda.php">Agenda</a>' +
                                    '</li>' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-link" href="<?php echo $domain; ?>/criar_agendamento.php">Criar agendamento</a>' +
                                    '</li>'+
                                    '<li class="nav-item dropdown">' +
                                        '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                            usuario.usuario.nome +
                                        '</a>' +
                                        '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">' +
                                            '<a class="dropdown-item" href="#">Perfil</a>' +
                                            '<div class="dropdown-divider"></div>' +
                                            '<a class="dropdown-item logout-btn" href="#">Logout</a>' +
                                        '</div>' +
                                    '</li>'
                                    );
            } else {
                menuUsuario.empty();
                menuUsuario.append('<li class="nav-item">' +
                                        '<a class="nav-link" href="<?php echo $domain; ?>/agenda.php">Agenda</a>' +
                                    '</li>' +
                                    '<li class="nav-item">' +
                                        '<a class="nav-link" href="<?php echo $domain; ?>/criar_agendamento.php">Criar agendamento</a>' +
                                    '</li>'+
                                    '<li class="nav-item">' +
                                        '<a class="nav-link login" href="<?php echo $domain; ?>/login.php">Login</a>' +
                                    '</li>'
                                    );
            }

            // Adiciona um ouvinte de evento para o botão de logout
            $('.logout-btn').click(function(event) {
                event.preventDefault();
                // Limpa a sessão
                sessionStorage.removeItem('usuarioLogado');
                // Redireciona para a página de login
                window.location.href = '<?php echo $domain; ?>/login.php';
            });
        }

        // Chama a função ao carregar a página
        atualizarMenuUsuario();
    });
</script>
