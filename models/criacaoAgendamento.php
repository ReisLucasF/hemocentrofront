<div class="modal fade" id="criarAgendamentoModal" tabindex="-1" aria-labelledby="criarAgendamentoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="criarAgendamentoModalLabel">Criar Novo Agendamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulário de Criação de Agendamento -->
        <form id="criarAgendamentoForm">
          <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" class="form-control">
          </div>
          <div class="form-group">
            <label for="dataAgendamento">Data do Agendamento:</label>
            <input type="datetime-local" id="dataAgendamento" name="dataAgendamento" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="municipio">Município:</label>
            <input type="text" id="municipio" name="municipio" class="form-control" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <!-- O botão de salvar agora estará aqui, estilizado com classes do Bootstrap -->
        <button type="button" class="btn btn-primary" id="salvarNovoAgendamento" onclick="document.getElementById('criarAgendamentoForm').submit();">Salvar Agendamento</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KXQo5qByhwpDS6Zk+AH9C7wE/R5K9aDjEGI1fL5VozM=" crossorigin="anonymous"></script>

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

    fetch('https://hemocentro-pi.vercel.app/agendamentos', {
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
        $('#criarAgendamentoModal').modal('hide'); // Fechar a modal
        location.reload(); // Recarregar a página
    })
    .catch(error => {
        console.error('Erro ao criar agendamento:', error);
        alert('Erro ao criar agendamento. Verifique o console para mais detalhes.');
    });
});
</script>
