<!-- Modal para Edição de Campanha -->
<div class="modal fade" id="modalEditarCampanha" tabindex="-1" role="dialog" aria-labelledby="modalEditarCampanhaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarCampanhaLabel">Editar Campanha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarCampanha">
          <input type="hidden" id="editId">
          <div class="form-group">
            <label for="editSolicitante">Solicitante:</label>
            <input type="text" class="form-control" id="editSolicitante" required>
          </div>
          <div class="form-group">
            <label for="editTipoSanguineo">Tipo Sanguíneo:</label>
            <select name="" class="form-control" id="editTipoSanguineo" required>
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
            <label for="editCidade">Cidade:</label>
            <input type="text" class="form-control" id="editCidade" required>
          </div>
          <div class="form-group">
            <label for="editContato">Contato:</label>
            <input type="text" class="form-control" id="editContato" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="salvarEdicao()">Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>

<script>
function salvarEdicao() {
  const id = document.getElementById('editId').value;
  const campanha = {
    solicitante: document.getElementById('editSolicitante').value,
    tiposan: document.getElementById('editTipoSanguineo').value,
    cidade: document.getElementById('editCidade').value,
    contato: document.getElementById('editContato').value
  };

  fetch(`https://hemocentro-pi.vercel.app/campanhas/${id}`, {
    method: 'PUT',  // Supondo que a API aceite o método PUT para atualizações
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(campanha)
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Falha ao salvar a campanha');
    }
    return response.json();
  })
  .then(() => {
    $('#modalEditarCampanha').modal('hide');
    carregarCampanhas();
  })
  .catch(error => {
    console.error('Erro:', error);
    alert('Erro ao salvar alterações.');
  });
}
</script>