
<?php
    include '../../partials/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Estoque</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="../grid.css">
  <?php echo $favicon; ?>
</head>
<body>

<div class="container">
    <header class="row align-items-center">
        <div class="col-auto">
            <button class="btn btn-secondary seta-anterior" id="botao-anterior">&lt;</button>
        </div>
        <div class="col">
            <h2 class="text-center" id="nome-hemocentro">Nome do Hemocentro</h2>
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary seta-proxima" id="botao-proximo">&gt;</button>
        </div>
    </header>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Estoque</div>

                <div class="card-body">
                    <form id="editarEstoqueForm">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="valorIdeal">Valor Ideal:</label>
                                    <input type="number" id="valorIdeal" name="valorIdeal" class="form-control" required>
                                </div>
                            </div>
                            

                            <div class="col">
                                <div class="form-group">
                                    <label for="valorMin">Valor Mínimo:</label>
                                    <input type="number" id="valorMin" name="valorMin" class="form-control" required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="valorMax">Valor Máximo:</label>
                                    <input type="number" id="valorMax" name="valorMax" class="form-control" required>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tipoA+">Tipo A+:</label>
                                    <input type="number" id="tipoA+" name="tipoA+" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tipoA-">Tipo A-:</label>
                                    <input type="number" id="tipoA-" name="tipoA-" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tipoB+">Tipo B+:</label>
                                    <input type="number" id="tipoB+" name="tipoB+" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tipoB-">Tipo B-:</label>
                                    <input type="number" id="tipoB-" name="tipoB-" class="form-control">
                                </div>
                            </div>
    
                            <div class="col">
                                <div class="form-group">
                                    <label for="tipoAB+">Tipo AB+:</label>
                                    <input type="number" id="tipoAB+" name="tipoAB+" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tipoAB-">Tipo AB-:</label>
                                    <input type="number" id="tipoAB-" name="tipoAB-" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tipoO+">Tipo O+:</label>
                                    <input type="number" id="tipoO+" name="tipoO+" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tipoO-">Tipo O-:</label>
                                    <input type="number" id="tipoO-" name="tipoO-" class="form-control">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KXQo5qByhwpDS6Zk+AH9C7wE/R5K9aDjEGI1fL5VozM=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            let hemocentros = [];
            let hemocentro;
            let bancoDeSangue;
            let idHemocentro;

            function obterHemocentros() {
                return fetch('https://hemocentro-pi.vercel.app/hemocentro')
                    .then(response => response.json())
                    .then(data => {
                        hemocentros = data;
                        const hemocentroPadrao = hemocentros[0];
                        return obterBancoDeSangue(hemocentroPadrao.id);
                    })
                    .catch(error => console.error('Erro ao obter hemocentros:', error));
            }

            function obterBancoDeSangue(hemocentroId) {
                return fetch(`https://hemocentro-pi.vercel.app/banco/${hemocentroId}`)
                    .then(response => response.json())
                    .then(data => {
                        bancoDeSangue = data;
                        return fetch(`https://hemocentro-pi.vercel.app/hemocentro/${bancoDeSangue.hemocentro_id}`);
                    })
                    .then(response => response.json())
                    .then(hemocentro => {
                        bancoDeSangue.hemocentro = hemocentro;
                        document.getElementById('nome-hemocentro').textContent = hemocentro[0].nome;

                        console.log('mensagem', bancoDeSangue)

                        // Preencher os campos de entrada com os dados do banco de sangue
                        document.getElementById('valorIdeal').value = bancoDeSangue.valorIdeal || '';
                        document.getElementById('valorMin').value = bancoDeSangue.valorMin || '';
                        document.getElementById('valorMax').value = bancoDeSangue.valorMax || '';
                        document.getElementById('tipoA+').value = bancoDeSangue.tiposSanguineos['A+'] || '';
                        document.getElementById('tipoA-').value = bancoDeSangue.tiposSanguineos['A-'] || '';
                        document.getElementById('tipoB+').value = bancoDeSangue.tiposSanguineos['B+'] || '';
                        document.getElementById('tipoB-').value = bancoDeSangue.tiposSanguineos['B-'] || '';
                        document.getElementById('tipoAB+').value = bancoDeSangue.tiposSanguineos['AB+'] || '';
                        document.getElementById('tipoAB-').value = bancoDeSangue.tiposSanguineos['AB-'] || '';
                        document.getElementById('tipoO+').value = bancoDeSangue.tiposSanguineos['O+'] || '';
                        document.getElementById('tipoO-').value = bancoDeSangue.tiposSanguineos['O-'] || '';
                    })
                    .catch(error => console.error('Erro ao obter banco de sangue:', error));
            }

            $('#editarEstoqueForm').on('submit', function(event) {
                event.preventDefault();
                atualizarEstoque(); 
            });


            function atualizarEstoque() {
                const formData = {
                    valorIdeal: $('#valorIdeal').val(),
                    valorMin: $('#valorMin').val(),
                    valorMax: $('#valorMax').val(),
                    tiposSanguineos: {
                        'A+': $('#tipoA\\+').val(),
                        'A-': $('#tipoA-').val(),
                        'B+': $('#tipoB\\+').val(),
                        'B-': $('#tipoB-').val(),
                        'AB+': $('#tipoAB\\+').val(),
                        'AB-': $('#tipoAB-').val(),
                        'O+': $('#tipoO\\+').val(),
                        'O-': $('#tipoO-').val()
                    }
                };

                console.log('Dados do formulário:', formData);

                // Realizar a requisição AJAX para atualizar o estoque
                $.ajax({
                    url: `https://hemocentro-pi.vercel.app/banco/${bancoDeSangue.hemocentro_id}`,
                    type: "PUT",
                    contentType: "application/json",
                    data: JSON.stringify(formData),
                    success: function(response) {
                        alert("Estoque atualizado com sucesso!");
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro ao atualizar o estoque:", error);
                        alert("Erro ao atualizar o estoque. Verifique o console para mais detalhes.");
                    }
                });
            }

            // Adiciona eventos de clique para os botões
            $('#botao-anterior').on('click', function() {
                const indexAtual = hemocentros.findIndex(hemocentro => hemocentro.id === bancoDeSangue.hemocentro_id);
                const novoIndex = (indexAtual === 0) ? hemocentros.length - 1 : indexAtual - 1;
                const novoHemocentro = hemocentros[novoIndex];
                obterBancoDeSangue(novoHemocentro.id);
            });

            $('#botao-proximo').on('click', function() {
                const indexAtual = hemocentros.findIndex(hemocentro => hemocentro.id === bancoDeSangue.hemocentro_id);
                const novoIndex = (indexAtual === hemocentros.length - 1) ? 0 : indexAtual + 1;
                const novoHemocentro = hemocentros[novoIndex];
                obterBancoDeSangue(novoHemocentro.id);
            });

            obterHemocentros();
        });
    </script>

    
<?php
    include '../../partials/footer.php';
?>

</body>
</html>
