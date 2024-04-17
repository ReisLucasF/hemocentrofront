
<?php
    require_once '../auth.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Estoque</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="./grid.css">
  <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
</head>
<body>

    <?php
        include './partials/header.php';
    ?>

<div class="container">

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
            let usuarioLogado = JSON.parse(sessionStorage.getItem('usuarioLogado'));
            let hemocentroId = usuarioLogado ? usuarioLogado.hemocentro_id : null;

            function obterBancoDeSangue() {
                if (!hemocentroId) return;
                fetch(`https://hemocentro-pi.vercel.app/banco/${hemocentroId}`)
                    .then(response => response.json())
                    .then(data => {
                        $('#valorIdeal').val(data.valorIdeal || '');
                        $('#valorMin').val(data.valorMin || '');
                        $('#valorMax').val(data.valorMax || '');
                        $('#tipoA\\+').val(data.tiposSanguineos['A+'] || 0); // Use '\\+' para escapar o caractere '+' no seletor
                        $('#tipoA-').val(data.tiposSanguineos['A-'] || 0);
                        $('#tipoB\\+').val(data.tiposSanguineos['B+'] || 0);
                        $('#tipoB-').val(data.tiposSanguineos['B-'] || 0);
                        $('#tipoAB\\+').val(data.tiposSanguineos['AB+'] || 0);
                        $('#tipoAB-').val(data.tiposSanguineos['AB-'] || 0);
                        $('#tipoO\\+').val(data.tiposSanguineos['O+'] || 0);
                        $('#tipoO-').val(data.tiposSanguineos['O-'] || 0);
                    })
                    .catch(error => console.error('Erro ao obter dados do banco:', error));
            }

            $('#editarEstoqueForm').submit(function(event) {
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

                $.ajax({
                    url: `https://hemocentro-pi.vercel.app/banco/${hemocentroId}`,
                    type: "PUT",
                    contentType: "application/json",
                    data: JSON.stringify(formData),
                    success: function() {
                        alert("Estoque atualizado com sucesso!");
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro ao atualizar o estoque:", error);
                        alert("Erro ao atualizar o estoque. Verifique o console para mais detalhes.");
                    }
                });
            }

            obterBancoDeSangue();
        });
</script>


<?php
    include '../partials/footer.php';
?>

</body>
</html>
