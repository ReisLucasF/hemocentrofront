<script>
  function preencherTabelaUsuarios(usuarios) {
    var tabelaBody = $('#usuarios-table-body');

    tabelaBody.empty();

    usuarios.forEach(function(usuario) {
      var linha = $('<tr>');
      linha.append($('<td>').text(usuario.nome));
      linha.append($('<td>').text(usuario.municipio));
      var colunaAcoes = $('<td>');
      colunaAcoes.append($('<button>').addClass('btn btn-primary btn-sm mr-2').text('Editar').on('click', function() {
        console.log('Editar: ' + usuario.nome);
        preencherModalEditarUsuario(usuario);
        $('#editarUsuarioModal').modal('show');
      }));
      colunaAcoes.append($('<button>').addClass('btn btn-danger btn-sm').text('Excluir').on('click', function() {
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
          throw new Error('Erro ao obter dados dos usuarios');
        }
        return response.json();
      })
      .then(data => {
        preencherTabelaUsuarios(data);
      })
      .catch(error => {
        console.error('Erro ao obter dados dos usuarios:', error);
      });
  }

  $(document).ready(function() {
    carregarUsuarios();
  });
</script>
