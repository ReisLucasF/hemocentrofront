$(document).ready(function() {
    // Evento de clique no botão "Salvar Edição de Agendamento"
    $('#salvarEdicaoAgendamento').on('click', function() {
        // Serializa os dados do formulário
        var formData = $('#editarAgendamentoForm').serialize();
        // Adiciona o ID do evento ao formulário serializado
        formData += '&id=' + eventId;

        // Requisição AJAX para atualizar o agendamento
        $.ajax({
            url: 'atualizar_agendamento.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Recarrega a página após um pequeno intervalo
                setTimeout(function() {
                    location.reload(); 
                }, 500);
            },
            error: function(xhr, status, error) {
                alert('Ocorreu um erro na requisição: ' + error);
            }
        });
    });

    // Evento de clique no botão "Excluir Agendamento"
    $('#excluirAgendamento').on('click', function() {
        var id = eventId; 

        // Confirmação de exclusão
        if (confirm("Tem certeza que deseja excluir este agendamento?")) {
            // Requisição AJAX para excluir o agendamento
            $.ajax({
                url: 'excluir_agendamento.php',
                type: 'POST',
                data: { id: id }, 
                success: function(response) {
                    // Recarrega a página se a exclusão for bem-sucedida
                    if (response == 'success') {
                        location.reload();
                    } else {
                        alert('Erro ao excluir o agendamento.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocorreu um erro na requisição: ' + error);
                }
            });
        }
    });

    // Evento de clique no botão "Salvar Novo Agendamento"
    $('#salvarNovoAgendamento').click(function(e) {
        e.preventDefault();

        // Obter os valores dos campos do formulário
        var formData = {
            nome: $('#nome').val(),
            email: $('#eMail').val(),
            cpf: $('#cpf').val(),
            dataNascimento: $('#dataNascimento').val(),
            telefone: $('#telefone').val(),
            dataAgendamento: $('#dataAgendamento').val(),
            municipio: $('#municipio').val()
        };

        // Requisição AJAX para criar um novo agendamento
        $.ajax({
            url: 'http://localhost:3000/agendamentos',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData), 
            success: function(response) {
                // Exibe mensagem de sucesso e reseta o formulário
                alert('Agendamento criado com sucesso!');
                $('#criarAgendamentoModal').modal('hide');
                $('#criarAgendamentoForm')[0].reset();
            },
            error: function(xhr, status, error) {
                // Exibe mensagem de erro em caso de falha
                alert('Erro ao criar agendamento: ' + error);
            }
        });
    });
});
