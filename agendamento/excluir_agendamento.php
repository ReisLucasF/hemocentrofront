<?php

include 'financeiro/banco.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        $conexao = obterConexao();

        $sql = "DELETE FROM agendamentos WHERE id = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'success'; 
        } else {
            echo 'error'; 
        }

        mysqli_close($conexao);
    } else {
        echo 'error';
    }
} else {
    echo 'error'; 
}
?>
