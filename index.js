$(document).ready(function() {
    $('#salvarEdicaoAgendamento').on('click', function() {
        var formData = $('#editarAgendamentoForm').serialize();
        formData += '&id=' + eventId;

        $.ajax({
            url: 'atualizar_agendamento.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                setTimeout(function() {
                    location.reload(); 
                }, 500);
            },
            error: function(xhr, status, error) {
                alert('Ocorreu um erro na requisição: ' + error);
            }
        });
    });

    $('#excluirAgendamento').on('click', function() {
        var id = eventId; 

        if (confirm("Tem certeza que deseja excluir este agendamento?")) {
            $.ajax({
                url: 'excluir_agendamento.php',
                type: 'POST',
                data: { id: id }, 
                success: function(response) {
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

    $('#salvarNovoAgendamento').click(function(e) {
        e.preventDefault();
        var formData = {
            nome: $('#nome').val(),
            email: $('#eMail').val(),
            cpf: $('#cpf').val(),
            dataNascimento: $('#dataNascimento').val(),
            telefone: $('#telefone').val(),
            dataAgendamento: $('#dataAgendamento').val(),
            municipio: $('#municipio').val()
        };

       $.ajax({
            url: './config/config.json',
            type: 'GET',
            dataType: 'json',
            success: function(config) {
                var apiUrl = config.linkapi + '/agendamentos';
                
                $.ajax({
                    url: apiUrl,
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData), 
                    success: function(response) {
                        alert('Agendamento criado com sucesso!');
                        $('#criarAgendamentoModal').modal('hide');
                        $('#criarAgendamentoForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        alert('Erro ao criar agendamento: ' + error);
                    }
                });
            },
            error: function(xhr, status, error) {
                alert('Erro ao obter configuração: ' + error);
            }
        });
    });
});
