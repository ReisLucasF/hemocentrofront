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

    <!-- Adicione os links para o Bootstrap CSS e JavaScript -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    
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
            <input type="text" id="nome" name="nome" class="form-control" value="Nome do Usuário" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="email do Usuário" readonly>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" class="form-control" required readonly>
        </div>
        <div class="form-group">
            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" class="form-control" required readonly>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" class="form-control">
        </div>
        <!-- <div class="form-group">
            <label for="dataAgendamento">Data do Agendamento:</label>
            <input type="date" id="dataAgendamento" name="dataAgendamento" class="form-control" required>
        </div> -->
        <div class="form-group">
            <label for="dataAgendamento">Data do Agendamento:</label>
            <div class="input-group">
                <input type="text" id="dataAgendamento" name="dataAgendamento" class="form-control" required>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>

        <label for="horaAgendamento">Data do Agendamento:</label>
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
$(document).ready(function() {
    $('#dataAgendamento').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: new Date(),
        daysOfWeekDisabled: '0,6'
    }).on('changeDate', function(e) {
        // A data está no formato dd/mm/yyyy, precisa ser convertida para yyyy-mm-dd
        const dataFormatada = e.format('yyyy-mm-dd');
        console.log(dataFormatada); // Deve mostrar a data no console
        habilitarHorarios(dataFormatada);
        atualizarHorariosDisponiveis(dataFormatada);
    });

    function habilitarHorarios(data) {
        const horaAgendamento = $('#horaAgendamento');
        horaAgendamento.prop('disabled', !data);
        if (!data) {
            horaAgendamento.val('');
        }
    }

    function atualizarHorariosDisponiveis(dataSelecionada) {
        // Assegure-se de que dataSelecionada está no formato correto esperado pela API
        fetch(`https://hemocentro.vercel.app/disponibilidade/${dataSelecionada}`)
            .then(response => response.json())
            .then(data => {
                const selectHoras = $('#horaAgendamento');
                selectHoras.empty();
                if (data.horariosDisponiveis && data.horariosDisponiveis.length) {
                    data.horariosDisponiveis.forEach(horario => {
                        selectHoras.append(new Option(horario, horario));
                    });
                } else {
                    selectHoras.append(new Option('Não há horários disponíveis', ''));
                }
            })
            .catch(error => {
                console.error('Erro:', error);
            });
    }

    // Defina a data atual como valor padrão e atualize os horários disponíveis
    const dataAtual = new Date().toISOString().split('T')[0];
    $('#dataAgendamento').datepicker('update', dataAtual);
    atualizarHorariosDisponiveis(dataAtual);
});

</script>



<script>

    function habilitarHorarios() {
        const dataAgendamento = document.getElementById('dataAgendamento').value;
        const horaAgendamento = document.getElementById('horaAgendamento');
        
        if (dataAgendamento) {
            horaAgendamento.disabled = false;
        } else {
            horaAgendamento.disabled = true;
            horaAgendamento.value = ''; 
        }
    }
    
    function atualizarHorariosDisponiveis(dataSelecionada) {
        fetch(`https://hemocentro.vercel.app/disponibilidade/${dataSelecionada}`)
        .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao obter os horários disponíveis');
                }
                return response.json();
            })
            .then(data => {
                const selectHoras = document.getElementById('horaAgendamento');
                selectHoras.innerHTML = '';
                
                data.horariosDisponiveis.forEach(horario => {
                    const option = document.createElement('option');
                    option.value = horario;
                    option.textContent = horario;
                    selectHoras.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Erro:', error);
            });
        }
        
        document.getElementById('dataAgendamento').addEventListener('change', function() {
            habilitarHorarios()
            const dataSelecionada = this.value;
            atualizarHorariosDisponiveis(dataSelecionada);
        });
        
        window.onload = function() {
            const dataAtual = new Date().toISOString().split('T')[0];
            atualizarHorariosDisponiveis(dataAtual);
        };
    </script>


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


<?php
    include 'fetchAgendamento.php'
    ?>

<?php
    include './rules/verificarDoador.php'
    ?>

<?php
    include './regrasHorarios.php'
    ?>

<?php
    include './partials/footer.php';
    ?>

<!-- Adicione o link para o jQuery e o Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KXQo5qByhwpDS6Zk+AH9C7wE/R5K9aDjEGI1fL5VozM=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>