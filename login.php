<?php
include './partials/header.php';


?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Inclusão do CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Inclusão do JS do Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-4.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
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
                <input type="text" id="cpf" name="cpf" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


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
                type: 'POST',
                url: 'https://hemocentro.vercel.app/usuarios/login',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function (response) {
                    if (response.error) {
                        alert(response.error);
                        return;
                    }

                    // Armazena os dados do usuário na sessão
                    sessionStorage.setItem('usuarioLogado', JSON.stringify(response));

                    // Redireciona com base no tipo de usuário
                    if (response.usuario.tipoUsuario === 'hemocentro') {
                        window.location.href = 'agenda.php';
                    } else if (response.usuario.tipoUsuario === 'doador') {
                        window.location.href = 'criar_agendamento.php';
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Erro de autenticação:', xhr.responseText);
                    alert('CPF, senha ou tipo de usuário incorretos. Por favor, tente novamente.');
                }
            });
        });
    });
</script>
<?php
  include './partials/footer.php';
?>
  </body>
</html>