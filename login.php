
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <!-- Inclusão do CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Inclusão do JS do Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-4.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
  </head>
  
  <body>
    <?php
      include './partials/header.php';
    ?>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title text-center">Login</h5>
            </div>
            <div class="card-body">
              <form id="loginForm">
                <div class="form-group">
                  <label for="tipoUsuario">Tipo de Usuário:</label>
                  <select id="tipoUsuario" name="tipoUsuario" class="form-control">
                    <option value="doador">Doador</option>
                    <option value="hemocentro">Hemocentro</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="cpf">CPF:</label>
                  <input type="number" id="cpf" name="cpf" class="form-control" oninput="limitarComprimento(this, 11)" placeholder="Digite seu cpf" required>
                </div>
                <div class="form-group">
                  <label for="senha">Senha:</label>
                  <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                <a href="./criar-conta.php">Criar conta</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
  function limitarComprimento(input, maxLength) {
      if (input.value.length > maxLength) {
          input.value = input.value.slice(0, maxLength);
      }
  }
</script>


 <script>
    $(document).ready(function () {
      $('#loginForm').submit(function (event) {
          event.preventDefault();
          var formData = {
              tipoUsuario: $('#tipoUsuario').val(),
              cpf: $('#cpf').val(),
              senha: $('#senha').val()
          };

          $.ajax({
              url: './config/config.json',
              type: 'GET',
              dataType: 'json',
              success: function(config) {
                  var apiUrl = config.linkapi + '/usuarios/login';
                  $.ajax({
                      type: 'POST',
                      url: apiUrl,
                      data: JSON.stringify(formData),
                      contentType: 'application/json',
                      success: function(response) {
                          if (response.error) {
                              alert(response.error);
                              return;
                          }
                          // Salvando no sessionStorage
                          sessionStorage.setItem('usuarioLogado', JSON.stringify(response.usuario));
                          // Chamada para configurar a sessão no PHP
                          configurarSessaoPHP(response.usuario);
                      },
                      error: function(xhr) {
                          console.error('Erro de autenticação:', xhr.responseText);
                          alert('CPF, senha ou tipo de usuário incorretos. Por favor, tente novamente.');
                      }
                  });
              },
              error: function(xhr) {
                  alert('Erro ao obter configuração: ' + xhr.responseText);
              }
          });
      });
  });

  function configurarSessaoPHP(usuario) {
      $.ajax({
          type: 'POST',
          url: 'set_session.php',
          data: {usuarioLogado: JSON.stringify(usuario)},
          success: function() {
              // Redirecionamento baseado no tipo do usuário
              if (usuario.tipoUsuario === 'hemocentro') {
                  window.location.href = 'hemocentro/index.php';
              } else if (usuario.tipoUsuario === 'doador') {
                  window.location.href = 'index.php';
              }
          },
          error: function(xhr) {
              console.error('Erro ao salvar dados da sessão no servidor:', xhr.responseText);
          }
      });
  }
</script>



<!-- Bootstrap JS e jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<?php
  include './partials/footer.php';
?>
  </body>
</html>