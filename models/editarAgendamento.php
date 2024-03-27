<div class="modal fade" id="editarAgendamentoModal" tabindex="-1" aria-labelledby="editarAgendamentoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarAgendamentoModalLabel">Editar Agendamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editarAgendamentoForm">
          <div class="form-group">
            <label for="edit_nome">Nome:</label>
            <input type="text" id="edit_nome" name="nome" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="edit_email">Email:</label>
            <input type="email" id="edit_email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="edit_dataInicio">Data de Início:</label>
            <input type="datetime-local" id="edit_dataInicio" name="dataInicio" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="edit_dataFim">Data de Fim:</label>
            <input type="datetime-local" id="edit_dataFim" name="dataFim" class="form-control" required>
          </div>
          <!-- Adicionar depois outros campos como: municipio-->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="atualizarAgendamento">Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>

<script>

  eventClick: function(arg) {
  $('#edit_nome').val(arg.event.extendedProps.nome);
  $('#edit_email').val(arg.event.extendedProps.email);

  var start = new Date(arg.event.start.getTime() - (3 * 60 * 60 * 1000));
  var end = new Date(arg.event.end.getTime() - (3 * 60 * 60 * 1000)); 

  var startISO = start.toISOString().slice(0, -8);
  var endISO = end.toISOString().slice(0, -8);

  $('#edit_dataInicio').val(startISO);
  $('#edit_dataFim').val(endISO);
  
  // chama a modal de edição
  $('#editarAgendamentoModal').modal('show');
},


</script>