<?php

function checkUserLoggedIn() {
    if (!isset($_SESSION['usuarioLogado']) || !isset($_SESSION['usuarioLogado']['usuario'])) {
        // redirectToLogin();
    }
}

function redirectToLogin() {
    header('Location: /login.php'); 
    exit;
}

// Executa a verificação
checkUserLoggedIn();
?>