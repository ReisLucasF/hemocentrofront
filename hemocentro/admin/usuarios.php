
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layout de Grid com Bootstrap</title>
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
  <h2>Usuários</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody id="usuario-table-body">
      <!-- Aqui os dados serão preenchidos dinamicamente -->
    </tbody>
  </table>
</div>

<!-- Modal para editar usuario -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarUsuario">
          <input type="hidden" id="usuarioId">
          <div class="form-group">
            <label for="editarNome">Nome:</label>
            <input type="text" class="form-control" id="editarNome" required>
          </div>
          <div class="form-group">
            <label for="editarCPF">CPF:</label>
            <input type="text" class="form-control" id="editarCPF" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="salvarEdicaoUsuario">Salvar</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS e jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
  function preencherTabelaUsuarios(usuarios) {
    var tabelaBody = $('#usuario-table-body');

    tabelaBody.empty();

    usuarios.forEach(function(usuario) {
      var linha = $('<tr>');
      linha.append($('<td>').text(usuario.nome));
      linha.append($('<td>').text(usuario.cpf));
      var colunaAcoes = $('<td>');
      colunaAcoes.append($('<button>').addClass('btn btn-primary btn-sm mr-2').text('Editar').on('click', function() {
        console.log('Editar: ' + usuario.nome);
        preencherModalEditarUsuario(usuario);
        $('#editarUsuarioModal').modal('show');
      }));
      colunaAcoes.append($('<button>').addClass('btn btn-danger btn-sm').text('Excluir').on('click', function() {
      ...
        console.log('Excluir: ' + usuario.nome);
      }));
      linha.append(colunaAcoes);
      tabelaBody.append(linha);
    });
  }

  function carregarUsuarios() {
    fetch('https://hemocentro-pi.vercel.app/usuarios')
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro ao obter dados dos usuários');
        }
        return response.json();
      })
      .then(data => {
        preencherTabelaUsuarios(data);
      })
      .catch(error => {
        console.error('Erro ao obter dados dos usuários:', error);
      });
  }

  $(document).ready(function() {
    carregarUsuarios();
  });
</script>

<?php
  include './tabelaUsuarioCarregar.php';
?>

<?php
    include '../../partials/footer.php';
?>
</body>
</html>
