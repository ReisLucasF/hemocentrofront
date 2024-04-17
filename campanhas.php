
<?php
    include './partials/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layout de Grid com Bootstrap</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
<!-- Bootstrap JS e jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="style.css">
  <?php echo $favicon; ?>
</head>
<style>

</style>
<body>
  <div class="container">
      <h2>Últimas solicitações</h2>

      <section class="filtros">
        <h3>Filtrar por:</h3>
        <select
          class="filtro"
          name="filtro"
          id="filtro_tiposan"
          placeholder="Selecione o Tipo Sanguíneo"
          onchange="FiltroCadastro()"
        >
          <option value="">Selecione o Tipo Sanguíneo</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
        </select>

        <select
          class="filtro"
          name="filtro"
          id="filtro_cidade"
          onchange="FiltroCadastro()"
        >
          <option value="">Selecione a Cidade</option>
          <option value="João Pessoa">João Pessoa</option>
          <option value="Manaíra">Manaíra</option>
        </select>
      </section>
      <div id="filtro" class="solicitacoes"></div>
  </div>

      <script>
      function FiltroCadastro() {
        // Obtem os tipos sanguíneos informados pelo usuário nos filtros
        let ft = document.getElementById("filtro_tiposan").value;
        let fc = document.getElementById("filtro_cidade").value;

        // limpa a lista de tipos sanguíneos apresentados
        $("#filtro").empty();

        // URL da API
        const apiUrl = "https://hemocentro-pi.vercel.app/campanhas";

        function formatDate(dateString) {
          const options = { year: "numeric", month: "2-digit", day: "2-digit" };
          return new Date(dateString).toLocaleDateString("pt-BR", options);
        }

        // Faz a chamada à API
        fetch(apiUrl)
          .then((response) => {
            if (!response.ok) {
              throw new Error("Erro ao obter os dados da API.");
            }
            return response.json();
          })
          .then((data) => {
            // Popula a tabela com os registros retornados pela API
            data.forEach((usuario) => {
              // Verifica se os dados dos hemocentros batem com os filtros
              if (
                (usuario.tiposan == ft || ft == "") &&
                (usuario.cidade == fc || fc == "")
              ) {
                const dataFormatada = formatDate(usuario.solicitado);

                $("#filtro").append(
                  `<div class="solicitacao">
                            <aside><b>Solicitante: </b>${usuario.solicitante}</aside>
                            <aside><b>Tipo sanguíneo:</b> ${usuario.tiposan}</aside>
                            <aside><b>Cidade:</b> ${usuario.cidade}</aside>
                            <aside><b>Solicitado em:</b> ${dataFormatada}</aside>
                            <aside><b>Contato:</b> ${usuario.contato}</aside>
                        </div>`
                );
              }
            });
          })
          .catch((error) => {
            console.error("Erro:", error);
            $("#filtro").append(
              '<div class="error">Erro ao buscar os dados da API.</div>'
            );
          });
      }

      FiltroCadastro();
    </script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  
<?php
    include './partials/footer.php';
?>
</body>
</html>
