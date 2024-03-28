<script>
  function preencherTabelaHemocentros(hemocentros) {
    var tabelaBody = $('#hemocentros-table-body');

    tabelaBody.empty();

    hemocentros.forEach(function(hemocentro) {
      var linha = $('<tr>');
      linha.append($('<td>').text(hemocentro.nome));
      linha.append($('<td>').text(hemocentro.municipio));
      var colunaAcoes = $('<td>');
      colunaAcoes.append($('<button>').addClass('btn btn-primary btn-sm mr-2').text('Editar').on('click', function() {
        console.log('Editar: ' + hemocentro.nome);
        preencherModalEditarHemocentro(hemocentro);
        $('#editarHemocentroModal').modal('show');
      }));
      colunaAcoes.append($('<button>').addClass('btn btn-danger btn-sm').text('Excluir').on('click', function() {
        console.log('Excluir: ' + hemocentro.nome);
      }));
      linha.append(colunaAcoes);
      tabelaBody.append(linha);
    });
  }

  function carregarHemocentros() {
    fetch('https://hemocentro-pi.vercel.app/hemocentro')
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro ao obter dados dos hemocentros');
        }
        return response.json();
      })
      .then(data => {
        preencherTabelaHemocentros(data);
      })
      .catch(error => {
        console.error('Erro ao obter dados dos hemocentros:', error);
      });
  }

  $(document).ready(function() {
    carregarHemocentros();
  });
</script>
