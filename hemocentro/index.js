// Agendamento ###################################################

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



// campanhas ############################################################

function formatDate(dateString) {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    return new Date(dateString).toLocaleDateString('pt-BR', options);
}

function carregarCampanhas() {
  fetch('https://hemocentro-pi.vercel.app/campanhas')
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro ao obter os dados da API.');
      }
      return response.json();
    })
    .then(data => {
      const tbody = document.getElementById('tabela-campanhas');
      tbody.innerHTML = ''; // Limpa a tabela antes de inserir novos dados

      data.forEach(campanha => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${campanha.solicitante}</td>
          <td>${campanha.tiposan}</td>
          <td>${campanha.cidade}</td>
          <td>${formatDate(campanha.solicitado)}</td>
          <td>${campanha.contato}</td>
          <td>
            <button class="btn btn-primary btn-sm btnAcoes" data-target="#modalEditarCampanha" onclick="editarCampanha(${campanha.id})">Editar</button>
            <button class="btn btn-danger btn-sm btnAcoes" data-toggle="modal" onclick="excluirCampanha(${campanha.id})">Excluir</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    })
    .catch(error => {
      console.error('Erro:', error);
      const tbody = document.getElementById('tabela-campanhas');
      tbody.innerHTML = '<tr><td colspan="6" class="text-center">Erro ao buscar os dados da API.</td></tr>';
    });
}

function editarCampanha(id) {
  fetch(`https://hemocentro-pi.vercel.app/campanhas/${id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data)
      document.getElementById('editId').value = data.id;
      console.log(data.id)
      document.getElementById('editSolicitante').value = data.solicitante;
      console.log(data.solicitante)
      document.getElementById('editTipoSanguineo').value = data.tiposan;
      console.log(data.tiposan)
      document.getElementById('editCidade').value = data.cidade;
      console.log(data.cidade)
      document.getElementById('editContato').value = data.contato;
      console.log(data.contato)

      $('#modalEditarCampanha').modal('show');
    })
    .catch(error => {
      console.error('Erro ao carregar dados para edição:', error);
      alert('Erro ao carregar dados para edição.');
    });
}


// Chame a função para carregar as campanhas quando a página estiver pronta
document.addEventListener('DOMContentLoaded', carregarCampanhas);

function excluirCampanha(id) {
  const confirmar = confirm("Tem certeza que deseja excluir esta campanha?");
  if (!confirmar) {
    return; // Se o usuário não confirmar, aborta a função
  }

  const apiUrl = `https://hemocentro-pi.vercel.app/campanhas/${id}`;

  fetch(apiUrl, {
    method: 'DELETE'
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Falha ao excluir a campanha');
    }
    return response.json();
  })
  .then(() => {
    alert('Campanha excluída com sucesso!');
    carregarCampanhas(); // Recarrega as campanhas após a exclusão
  })
  .catch(error => {
    console.error('Erro:', error);
    alert('Erro ao excluir campanha. Verifique o console para mais detalhes.');
  });
}
