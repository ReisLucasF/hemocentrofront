<?php
session_start();

if (isset($_POST['usuarioLogado'])) {
    $_SESSION['usuarioLogado'] = json_decode($_POST['usuarioLogado'], true);
    echo 'Sessão configurada com sucesso';
} else {
    http_response_code(400);
    echo 'Dados de usuário não fornecidos';
}
?>