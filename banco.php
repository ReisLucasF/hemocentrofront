<?php

function obterConexao() {
    
    $conexao = new mysqli("82.180.168.2", "u242936904_hemo", "d3M0L1D0R9127!", "u242936904_hemo");
    $conexao->set_charset("utf8mb4");
    // Verificar a conexão
    if ($conexao->connect_error) {
        die("Conexão falhou: " . $conexao->connect_error);
    }

    return $conexao;
}
?>