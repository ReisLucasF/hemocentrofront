<?php
    include './config/config.php';

    include './partials/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Agendamento</title>
    <!-- Adicione os links para o Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5 formAgendamento">
    <h2 class="mb-4">Criar Novo Agendamento</h2>
    <!-- Formulário de Criação de Agendamento -->
    <form id="criarAgendamentoForm">
        <div class="form-group">
            <label for="municipio">Município:</label>
            <select id="municipio" name="municipio" class="form-control" required>
                <option value="">Selecione um município</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" required disabled>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" class="form-control" required disabled>
        </div>
        <div class="form-group">
            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" class="form-control" required disabled>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" class="form-control">
        </div>
        <div class="form-group">
            <label for="dataAgendamento">Data do Agendamento:</label>
            <input type="date" id="dataAgendamento" name="dataAgendamento" class="form-control" required>
        </div>
        <label for="dataAgendamento">Data do Agendamento:</label>
        <select id="horaAgendamento" name="horaAgendamento" class="form-control" required disabled>
            <option value="08:00">08:00</option>
            <option value="09:00">09:00</option>
            <option value="10:00">10:00</option>
            <option value="11:00">11:00</option>
            <option value="12:00">12:00</option>
            <option value="13:00">13:00</option>
            <option value="14:00">14:00</option>
            <option value="15:00">15:00</option>
            <option value="16:00">16:00</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
        </select>
        <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
    </form>
</div>



<script>
    var usuarioLogado = JSON.parse(sessionStorage.getItem('usuarioLogado'));

    if (usuarioLogado && usuarioLogado.usuario) {
        var usuario = usuarioLogado.usuario;

        document.getElementById('nome').value = usuario.nome;
        document.getElementById('email').value = usuario.email;
        document.getElementById('cpf').value = usuario.cpf;
        document.getElementById('dataNascimento').value = usuario.dataNascimento ? new Date(usuario.dataNascimento).toISOString().split('T')[0] : '';
    }
</script>

<!-- Adicione o link para o jQuery e o Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KXQo5qByhwpDS6Zk+AH9C7wE/R5K9aDjEGI1fL5VozM=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('criarAgendamentoForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    if (!this.checkValidity()) {
        alert('Por favor, preencha todos os campos obrigatórios.');
        return;
    }
    
    var formData = new FormData(this);
    var object = {};
    formData.forEach((value, key) => { object[key] = value; });
    var json = JSON.stringify(object);

    console.log('JSON enviado para o backend:', json);

    fetch('http://localhost:3000/agendamentos', {
        method: 'POST',
        body: json,
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('A resposta da rede não foi ok.');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        alert('Agendamento criado com sucesso!');
        // Redirecionar para outra página após criar o agendamento, se necessário
        window.location.href = <?php echo $domain; ?>;
    })
    .catch(error => {
        console.error('Erro ao criar agendamento:', error);
        alert('Erro ao criar agendamento. Verifique o console para mais detalhes.');
    });
});
</script>

    <?php
        include'./rules/verificarDoador.php'
    ?>

    <?php
        include './regrasHorarios.php'
    ?>

    <?php
        include './partials/footer.php';
    ?>

</body>
</html>
