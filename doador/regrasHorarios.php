
<script>
$(document).ready(function() {
    $('#dataAgendamento').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: new Date(),
        daysOfWeekDisabled: '0,6',
        language: 'pt-BR'
    }).on('changeDate', function(e) {
        // A data está no formato dd/mm/yyyy, precisa ser convertida para yyyy-mm-dd
        const dataFormatada = e.format('yyyy-mm-dd');
        console.log(dataFormatada); // Deve mostrar a data no console
        habilitarHorarios(dataFormatada);
        atualizarHorariosDisponiveis(dataFormatada);
    });

    function habilitarHorarios(data) {
        const horaAgendamento = $('#horaAgendamento');
        horaAgendamento.prop('disabled', !data);
        if (!data) {
            horaAgendamento.val('');
        }
    }

    function atualizarHorariosDisponiveis(dataSelecionada) {
        // Assegure-se de que dataSelecionada está no formato correto esperado pela API
        fetch(`https://hemocentro.vercel.app/disponibilidade/${dataSelecionada}`)
            .then(response => response.json())
            .then(data => {
                const selectHoras = $('#horaAgendamento');
                selectHoras.empty();
                if (data.horariosDisponiveis && data.horariosDisponiveis.length) {
                    data.horariosDisponiveis.forEach(horario => {
                        selectHoras.append(new Option(horario, horario));
                    });
                } else {
                    selectHoras.append(new Option('Não há horários disponíveis', ''));
                }
            })
            .catch(error => {
                console.error('Erro:', error);
            });
    }

    // Defina a data atual como valor padrão e atualize os horários disponíveis
    const dataAtual = new Date().toISOString().split('T')[0];
    $('#dataAgendamento').datepicker('update', dataAtual);
    atualizarHorariosDisponiveis(dataAtual);
});

</script>

<script>
    var usuarioLogado = JSON.parse(sessionStorage.getItem('usuarioLogado'));

    if (usuarioLogado && usuarioLogado.usuario) {
        var usuario = usuarioLogado.usuario;

        document.getElementById('nome').value = usuario.nome;
        document.getElementById('email').value = usuario.email;
        document.getElementById('cpf').value = usuario.cpf;
        document.getElementById('dataNascimento').value = usuario.dataNascimento ? new Date(usuario.dataNascimento).toISOString().split('T')[0] : '';
    }
</script>

<script>
    function preencherMunicipios() {
        fetch('https://hemocentro-pi.vercel.app/hemocentro/cidades')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao obter lista de municípios');
                }
                return response.json();
            })
            .then(data => {
                var selectMunicipio = document.getElementById("municipio");
                selectMunicipio.innerHTML = '<option value="">Selecione um município</option>';

                data.forEach(function(municipio) {
                    var option = document.createElement("option");
                    option.text = municipio;
                    option.value = municipio;
                    selectMunicipio.add(option);
                });
            })
            .catch(error => {
                console.error('Erro:', error);
            });
    }

    preencherMunicipios();

    function preencherHemocentros() {
        var municipioSelecionado = document.getElementById("municipio").value;

        fetch(`https://hemocentro-pi.vercel.app/hemocentro/${municipioSelecionado}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao obter lista de hemocentros');
                }
                return response.json();
            })
            .then(data => {
                var selectHemocentro = document.getElementById("hemocentro");
                selectHemocentro.innerHTML = '<option value="">Selecione o hemocentro</option>';

                data.forEach(function(hemocentro) {
                    var option = document.createElement("option");
                    option.text = hemocentro.nome;
                    option.value = hemocentro.id; // Se o ID for usado como valor
                    selectHemocentro.add(option);
                });
            })
            .catch(error => {
                console.error('Erro:', error);
            });
    }

    document.getElementById("municipio").addEventListener("change", preencherHemocentros);
</script>
