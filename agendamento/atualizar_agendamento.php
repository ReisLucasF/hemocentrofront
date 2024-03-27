<?php
include 'financeiro/banco.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['titulo'];
    $color = $_POST['cor'];
    $start = $_POST['dataInicio'];
    $end = $_POST['dataFim'];
    $valor = $_POST['valor'];

    $conexao = obterConexao();

    $sql = "UPDATE agendamentos SET title = ?, color = ?, start = ?, end = ?, valor = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssii", $title, $color, $start, $end, $valor, $id);
    $id = $_POST['id'];
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: index.php");
        exit(); 
    } else {
        echo "<script>alert('Erro ao atualizar o agendamento.');</script>";
    }

    mysqli_close($conexao);
}
?>
