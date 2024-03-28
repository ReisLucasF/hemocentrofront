
<?php
    include '../partials/header.php';
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
  <?php echo $favicon; ?>
</head>
<body>

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
    $.get("https://hemocentro-pi.vercel.app/banco", function(data) {
        var estoque = data[0];
        
        $("#valorIdeal").val(estoque.valorIdeal);
        $("#valorMin").val(estoque.valorMin);
        $("#valorMax").val(estoque.valorMax);
        $("#tipoA\\+").val(estoque.tiposSanguineos["A+"]);
        $("#tipoA\\-").val(estoque.tiposSanguineos["A-"]);
        $("#tipoB\\+").val(estoque.tiposSanguineos["B+"]);
        $("#tipoB\\-").val(estoque.tiposSanguineos["B-"]);
        $("#tipoAB\\+").val(estoque.tiposSanguineos["AB+"]);
        $("#tipoAB\\-").val(estoque.tiposSanguineos["AB-"]);
        $("#tipoO\\+").val(estoque.tiposSanguineos["O+"]);
        $("#tipoO\\-").val(estoque.tiposSanguineos["O-"]);
    });

    $("#editarEstoqueForm").submit(function(event) {
        event.preventDefault();
        var formData = {
            valorIdeal: $("#valorIdeal").val(),
            valorMin: $("#valorMin").val(),
            valorMax: $("#valorMax").val(),
            tiposSanguineos: {
                "A+": $("#tipoA\\+").val(),
                "A-": $("#tipoA\\-").val(),
                "B+": $("#tipoB\\+").val(),
                "B-": $("#tipoB\\-").val(),
                "AB+": $("#tipoAB\\+").val(),
                "AB-": $("#tipoAB\\-").val(),
                "O+": $("#tipoO\\+").val(),
                "O-": $("#tipoO\\-").val(),
            }
        };

        $.ajax({
            url: "https://hemocentro-pi.vercel.app/banco/1",
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
    });
});
</script>

</body>
</html>
