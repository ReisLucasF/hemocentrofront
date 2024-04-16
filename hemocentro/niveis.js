// niveis de sangue ####################################################
// Função para atualizar o estoque
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


$('#editarEstoqueForm').on('submit', function(event) {
    event.preventDefault(); // Evita o comportamento padrão de envio do formulário
    atualizarEstoque(); // Chama a função para atualizar o estoque
});