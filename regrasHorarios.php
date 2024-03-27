<script>
    function habilitarHorarios() {
        const dataAgendamento = document.getElementById('dataAgendamento').value;
        const horaAgendamento = document.getElementById('horaAgendamento');
        
        if (dataAgendamento) {
            horaAgendamento.disabled = false;
        } else {
            horaAgendamento.disabled = true;
            horaAgendamento.value = ''; // Resetar o valor do campo de hora
        }
    }

// Função para obter e atualizar as opções do select com base na data selecionada
function atualizarHorariosDisponiveis(dataSelecionada) {
    fetch(`https://hemocentro.vercel.app/disponibilidade/${dataSelecionada}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao obter os horários disponíveis');
            }
            return response.json();
        })
        .then(data => {
            // Limpar as opções existentes do select
            const selectHoras = document.getElementById('horaAgendamento');
            selectHoras.innerHTML = '';

            // Adicionar as novas opções ao select
            data.horariosDisponiveis.forEach(horario => {
                const option = document.createElement('option');
                option.value = horario;
                option.textContent = horario;
                selectHoras.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erro:', error);
        });
}

// Ouvinte de evento para quando a data é alterada
document.getElementById('dataAgendamento').addEventListener('change', function() {
    habilitarHorarios()
    const dataSelecionada = this.value;
    atualizarHorariosDisponiveis(dataSelecionada);
});

// Chamando a função para atualizar as opções do select quando a página carrega
window.onload = function() {
    const dataAtual = new Date().toISOString().split('T')[0];
    atualizarHorariosDisponiveis(dataAtual);
};

</script>


<script>
    var municipios = [
        "João Pessoa",
        "Campina Grande",
    ];

    function preencherMunicipios() {
        var selectMunicipio = document.getElementById("municipio");

        selectMunicipio.innerHTML = '<option value="">Selecione um município</option>';

        municipios.forEach(function(municipio) {
            var option = document.createElement("option");
            option.text = municipio;
            option.value = municipio;
            selectMunicipio.add(option);
        });
    }

    preencherMunicipios();
</script>