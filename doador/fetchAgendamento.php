<script>
fetch('../config/config.json')
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao carregar config.json');
        }
        return response.json();
    })
    .then(config => {
        document.getElementById('criarAgendamentoForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            if (!this.checkValidity()) {
                alert('Por favor, preencha todos os campos obrigatórios.');
                return;
            }
            
            var formData = new FormData(this);
            var object = {};
            formData.forEach((value, key) => { object[key] = value; });
            var json = JSON.stringify(object);
        
            console.log('JSON enviado para o backend:', json);
        
            fetch(`${config.linkapi}/agendamentos`, {
                method: 'POST',
                body: json,
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('A resposta da rede não foi ok.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                alert('Agendamento criado com sucesso!');
                // Redirecionar para outra página após criar o agendamento, se necessário
                window.location.href = '<?php echo $domain; ?>';
            })
            .catch(error => {
                console.error('Erro ao criar agendamento:', error);
                alert('Erro ao criar agendamento. Verifique o console para mais detalhes.');
            });
        });
    })
    .catch(error => {
        console.error(error);
        alert('Erro ao carregar config.json. Verifique o console para mais detalhes.');
    });
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
        console.log(municipioSelecionado)

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