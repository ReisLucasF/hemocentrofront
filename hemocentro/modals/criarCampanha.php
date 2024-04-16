<!-- Modal para Adicionar Campanha -->
<div class="modal fade" id="modalAdicionarCampanha" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarCampanhaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAdicionarCampanhaLabel">Adicionar Nova Campanha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formNovaCampanha">
          <div class="form-group">
            <label for="novaSolicitante">Solicitante:</label>
            <input type="text" class="form-control" id="novaSolicitante" name="solicitante" required>
          </div>
          <div class="form-group">
            <label for="novoTipoSanguineo">Tipo Sanguíneo:</label>
            <select name="" class="form-control" id="novoTipoSanguineo" name="tiposan" required>
                <option value="">Selecione o tipo sanguíneo</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
          </div>
          <div class="form-group">
            <label for="novaCidade">Cidade:</label>
            <select class="form-control" name="novaCidade" id="novaCidade" required>
              <!-- Opções serão adicionadas aqui -->
            </select>
          </div>
          <div class="form-group">
            <label for="novoContato">Contato:</label>
            <input type="text" class="form-control" id="novoContato" name="contato" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="adicionarCampanha()">Salvar</button>
      </div>
    </div>
  </div>
</div>

<script>
function adicionarCampanha() {
    const dadosCampanha = {
        solicitante: document.getElementById('novaSolicitante').value,
        tiposan: document.getElementById('novoTipoSanguineo').value,
        cidade: document.getElementById('novaCidade').value,
        contato: document.getElementById('novoContato').value
    };

    fetch('https://hemocentro-pi.vercel.app/campanhas', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(dadosCampanha)
    })
    .then(response => {
        if (!response.ok) {
        throw new Error('Erro ao adicionar campanha');
        }
        return response.json();
    })
    .then(() => {
        $('#modalAdicionarCampanha').modal('hide');
        carregarCampanhas(); 
    })
    .catch(error => {
        console.error('Erro:', error);
    });
    }
</script>