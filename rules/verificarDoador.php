<script>
    function verificarUsuarioLogado() {
        var usuarioLogado = sessionStorage.getItem('usuarioLogado');
        if (!usuarioLogado) {
            window.location.href = '<?php echo $domain; ?>/login.php';
            return;
        }

        if (usuarioLogado) {
            var usuario = JSON.parse(usuarioLogado);
            if (usuario.usuario.tipoUsuario === 'doador') {
            }else{
                window.location.href = '<?php echo $domain; ?>/login.php';
            }
        }
    }

    window.onload = function() {
        verificarUsuarioLogado();
    };
</script>