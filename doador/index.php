
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Doador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./grid.css">
    <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
</head>
<body>
    <?php
        include '../partials/header.php';
    ?>
    <div class="container">
        <div class="principal">
            <div class="grid-container">
                <!-- primeira linha -->
                <a class="grid-item" id="btnEditarPerfil" data-target="#modalEditarPerfil">
                    <span class="material-symbols-outlined"> contacts </span><br />
                    Dados Cadastrais
                </a>
            </div>
        </div>
    </div>

    <!-- Modal para Edição de Perfil -->
    <div class="modal fade" id="modalEditarPerfil" tabindex="-1" role="dialog" aria-labelledby="modalEditarPerfilLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarPerfilLabel">Atualizar dados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarPerfil">
                        <input type="hidden" id="editId">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="mail" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="tipoSanguineo">Tipo Sanguíneo:</label>
                            <input type="text" class="form-control" id="tipoSanguineo" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF:</label>
                            <input type="text" class="form-control readonly" id="cpf" readonly>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" class="form-control" id="senha" required>
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

    <!-- jQuery e JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
       function editarCampanha() {
            const sessionUser = JSON.parse(sessionStorage.getItem('usuarioLogado'));
            if (!sessionUser) {
                console.error('Usuário não encontrado no session.');
                alert('Erro ao carregar dados para edição.');
                return;
            }

            // Preenche os campos da modal com os dados do session
            document.getElementById('editId').value = sessionUser.id;
            document.getElementById('nome').value = sessionUser.nome;
            document.getElementById('email').value = sessionUser.email;
            document.getElementById('tipoSanguineo').value = sessionUser.tipoSanguineo;
            document.getElementById('cpf').value = sessionUser.cpf;
            document.getElementById('senha').value = '';

            // Abre a modal
            $('#modalEditarPerfil').modal('show');
        }

        // Adiciona evento de clique à âncora
        document.getElementById('btnEditarPerfil').addEventListener('click', editarCampanha);
    </script>

    <?php
        include '../rules/verificarHemocentro.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
        include '../partials/footer.php';
    ?>

</body>
</html>
