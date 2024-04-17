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
      tbody.innerHTML = ''; 

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
      document.getElementById('editId').value = data.id;
      document.getElementById('editSolicitante').value = data.solicitante;
      document.getElementById('editTipoSanguineo').value = data.tiposan;
      document.getElementById('editCidade').value = data.cidade;
      document.getElementById('editContato').value = data.contato;

      $('#modalEditarCampanha').modal('show');
    })
    .catch(error => {
      console.error('Erro ao carregar dados para edição:', error);
      alert('Erro ao carregar dados para edição.');
    });
}


document.addEventListener('DOMContentLoaded', carregarCampanhas);

function excluirCampanha(id) {
  const confirmar = confirm("Tem certeza que deseja excluir esta campanha?");
  if (!confirmar) {
    return; 
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
    carregarCampanhas();
  })
  .catch(error => {
    console.error('Erro:', error);
    alert('Erro ao excluir campanha. Verifique o console para mais detalhes.');
  });
}


function popularSelectCidades(selectId) {
  const selectCidade = document.getElementById(selectId);

  fetch('https://hemocentro-pi.vercel.app/hemocentro/cidades')
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro ao buscar as cidades');
      }
      return response.json();
    })
    .then(data => {
      selectCidade.innerHTML = '';

      const optionDefault = document.createElement('option');
      optionDefault.value = '';
      optionDefault.textContent = 'Selecione uma cidade';
      selectCidade.appendChild(optionDefault);

      data.forEach(cidade => {
        const option = document.createElement('option');
        option.value = cidade;
        option.textContent = cidade;
        selectCidade.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Erro ao buscar as cidades:', error);
    });
}

document.addEventListener('DOMContentLoaded', () => {
  popularSelectCidades('editCidade');
  popularSelectCidades('novaCidade');
});



// niveis de sangue ####################################################



// Função para atualizar o estoque
function atualizarEstoque() {
    const formData = {
        valorIdeal: $('#valorIdeal').val(),
        valorMin: $('#valorMin').val(),
        valorMax: $('#valorMax').val(),
        tiposSanguineos: {
            'A+': $('#tipoA\\+').val(),
            'A-': $('#tipoA-').val(),
            'B+': $('#tipoB\\+').val(),
            'B-': $('#tipoB-').val(),
            'AB+': $('#tipoAB\\+').val(),
            'AB-': $('#tipoAB-').val(),
            'O+': $('#tipoO\\+').val(),
            'O-': $('#tipoO-').val()
        }
    };


    $.ajax({
        url: `https://hemocentro-pi.vercel.app/banco/${bancoDeSangue.hemocentro_id}`,
        type: "PUT",
        contentType: "application/json",
        data: JSON.stringify(formData),
        success: function(response) {
            alert("Estoque atualizado com sucesso!");
        },
        error: function(xhr, status, error) {
            console.error("Erro ao atualizar o estoque:", error);
            alert("Erro ao atualizar o estoque. Verifique o console para mais detalhes.");
        }
    });
}


$('#editarEstoqueForm').on('submit', function(event) {
    event.preventDefault(); // Evita o comportamento padrão de envio do formulário
    atualizarEstoque(); // Chama a função para atualizar o estoque
});