<?php
include './partials/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='fullcalendar/packages/core/pt-br.global.js'></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Inclusão do CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Criar conta</title>
    <!-- Inclusão do JS do Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-4.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src='fullcalendar/dist/index.global.js'></script>
    <link rel="stylesheet" href="style.css">

  </head>

  <body>
    <!-- Conteúdo do Corpo -->
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title text-center">Cadastro</h5>
            </div>
            <div class="card-body">
              <form id="CadastroForm">
                <div class="limitf">
                    <div class="form-group">
                        <label form="nome">Nome:</label>
                        <input class="form-control" type="text" id="nome" placeholder="Nome" required>
                    </div>
                    
                    <!-- Nasciemento -->
                    <div class="form-group">
                        <label from="data">Data de nascimento</label>
                        <input class="form-control data" name="data" type="date">
                    </div>

                    <!-- CPF -->
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input class="form-control mt-2" name="cpf" type="text" placeholder="CPF" minlength="11" maxlength="11" required>
                    </div>

                    <div class="form-group">
                        <label for="email"></label>
                        <input class="form-control" type="text" name="email" id="email" placeholder="E-mail" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="senha"></label>
                        <input class="form-control" name="senha" type="password" id="senha" placeholder="Senha" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmSenha"></label>
                        <input class="form-control" type="password" name="confirmSenha" id="confirmSenha" placeholder="Confirmar senha" required>
                    </div>
                    
                    <div class="mb-2">
                        <p class="check">Use oito ou mais caracteres com uma combinação de letras, números e símbolos</p>
                        
                        <div class="check">
                            <input type="checkbox" required>
                            <a>Concordo com os termos e condições de uso da aplicação.</a>
                        </div>
                    </div>

                    <div>
                        <button class="btn" id="btnCadastro">Cadastrar</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
        include './partials/footer.php';
    ?>
</body>
<!-- https://hemocentro-pi.vercel.app -->

<script>
  document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('CadastroForm');

  form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const nome = document.getElementById('nome').value;
    const dataNascimento = document.querySelector('.data').value;
    const cpf = document.querySelector('input[name="cpf"]').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const confirmSenha = document.getElementById('confirmSenha').value;
    const concordaTermos = document.querySelector('input[type="checkbox"]').checked;

    // Verifica se as senhas coincidem
    if (senha !== confirmSenha) {
      alert('As senhas não coincidem.');
      return;
    }

    // Verifica se os termos foram aceitos
    if (!concordaTermos) {
      alert('É necessário aceitar os termos e condições.');
      return;
    }

    const requestBody = {
      nome,
      dataNascimento,
      cpf,
      email,
      senha,
      tipoUsuario: 'doador' // Definindo explicitamente como doador
    };

    try {
      const response = await fetch('https://hemocentro-pi.vercel.app/usuarios', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestBody)
      });

      const data = await response.json();

      if (response.ok) {
        alert('Usuário cadastrado com sucesso! ID: ' + data.id);
        window.location.href = '<?php echo $domain; ?>/login.php';
      } else {
        throw new Error(data.error || 'Erro ao cadastrar usuário');
      }
    } catch (error) {
      console.error('Erro ao cadastrar usuário:', error.message);
      alert('Erro ao cadastrar usuário. Tente novamente mais tarde.');
    }
  });
});

</script>