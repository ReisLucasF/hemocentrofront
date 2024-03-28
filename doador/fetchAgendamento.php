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