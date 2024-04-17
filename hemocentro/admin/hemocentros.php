
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hemocentros</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="../grid.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KXQo5qByhwpDS6Zk+AH9C7wE/R5K9aDjEGI1fL5VozM=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
</head>



<body>

<?php
    include '../../partials/header.php';
?>
 <div class="container box mt-5">
  <h2>Hemocentros</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Município</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody id="hemocentros-table-body">
      <!-- Aqui os dados serão preenchidos dinamicamente -->
    </tbody>
  </table>
</div>

<!-- Bootstrap JS e jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Modal para editar hemocentro -->
<div class="modal fade" id="editarHemocentroModal" tabindex="-1" role="dialog" aria-labelledby="editarHemocentroModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarHemocentroModalLabel">Editar Hemocentro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarHemocentro">
          <input type="hidden" id="hemocentroId">
          <div class="form-group">
            <label for="editarNome">Nome:</label>
            <input type="text" class="form-control" id="editarNome" required>
          </div>
          <div class="form-group">
            <label for="editarMunicipio">Município:</label>
            <input type="text" class="form-control" id="editarMunicipio" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="salvarEdicaoHemocentro">Salvar</button>
      </div>
    </div>
  </div>
</div>

<script>
  function preencherModalEditarHemocentro(hemocentro) {
    $('#hemocentroId').val(hemocentro.id);
    $('#editarNome').val(hemocentro.nome);
    $('#editarMunicipio').val(hemocentro.municipio);
  }

  $(document).on('click', '.btn-editar', function() {
    var hemocentro = $(this).data('hemocentro');
    preencherModalEditarHemocentro(hemocentro);
    $('#editarHemocentroModal').modal('show');
  });

  $('#salvarEdicaoHemocentro').click(function() {
    var hemocentroId = $('#hemocentroId').val();
    var novoNome = $('#editarNome').val();
    var novoMunicipio = $('#editarMunicipio').val();
    console.log('Salvar edição do hemocentro com ID:', hemocentroId);
    console.log('Novo nome:', novoNome);
    console.log('Novo município:', novoMunicipio);
    
    $.ajax({
      url: 'https://hemocentro-pi.vercel.app/hemocentro/' + hemocentroId,
      type: 'PUT',
      contentType: 'application/json',
      data: JSON.stringify({ nome: novoNome, municipio: novoMunicipio }),
      success: function(response) {
        console.log('Hemocentro atualizado com sucesso:', response);
        $('#editarHemocentroModal').modal('hide');
        location.reload();
      },
      error: function(xhr, status, error) {
        console.error('Erro ao atualizar hemocentro:', error);
      }
    });
  });
</script>





<?php
  include './tabelaCarregar.php';
?>

<?php
  include '../../rules/verificarHemocentro.php';
?>
  
<?php
    include '../../partials/footer.php';
?>
</body>
</html>
