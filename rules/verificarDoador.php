<script>
    function verificarUsuarioLogado() {
        var usuarioLogado = sessionStorage.getItem('usuarioLogado');
        if (!usuarioLogado) {
            window.location.href = 'login.php';
            return;
        }

        if (usuarioLogado) {
            var usuario = JSON.parse(usuarioLogado);
            console.log(usuario)
            if (usuario.usuario.tipoUsuario === 'doador') {
            }else{
                window.location.href = 'login.php';

            }
        }
    }

    window.onload = function() {
        verificarUsuarioLogado();
    };
</script>