let hemocentros = [];
let bancoDeSangue; // Definindo a variável globalmente

function obterHemocentros() {
    return fetch('https://hemocentro-pi.vercel.app/hemocentro')
        .then(response => response.json())
        .then(data => {
            hemocentros = data;
            // Defina o hemocentro padrão a ser exibido
            const hemocentroPadrao = hemocentros[0]; // Por exemplo, o primeiro hemocentro da lista
            return obterBancoDeSangue(hemocentroPadrao.id);
        })
        .catch(error => console.error('Erro ao obter hemocentros:', error));
}

function obterBancoDeSangue(hemocentroId) {
    fetch(`./config/config.json`)
        .then(response => response.json())
        .then(config => {
            const apiUrl = `${config.linkapi}/banco/${hemocentroId}`;
            return fetch(apiUrl);
        })
        .then(response => response.json())
        .then(data => {
            // Adiciona o nome do hemocentro ao objeto bancoDeSangue
            data.hemocentro = hemocentros.find(hemocentro => hemocentro.id === hemocentroId);
            bancoDeSangue = data; // Atribuindo o valor a variável global
            atualizarImagensEstoque(data);
        })
        .catch(error => console.error('Erro ao obter banco de sangue:', error));
}

function atualizarImagensEstoque(bancoDeSangue) {
    for (var tipo in bancoDeSangue.tiposSanguineos) {
        var quantidade = bancoDeSangue.tiposSanguineos[tipo];
        var idImagem = 'blood-' + tipo.replace('+', 'pos').replace('-', 'neg');
        var imagem = document.getElementById(idImagem);

        if (quantidade <= bancoDeSangue.valorMin) {
            imagem.src = './img/bloodlevel/bloodlevel-3.png';
        } else if (quantidade >= bancoDeSangue.valorIdeal) {
            imagem.src = './img/bloodlevel/bloodlevel-1.png';
        } else {
            imagem.src = './img/bloodlevel/bloodlevel-2.png';
        }
    }

    // Atualize o nome do hemocentro exibido
    const nomeHemocentro = document.getElementById('nome-hemocentro');
    nomeHemocentro.textContent = bancoDeSangue.hemocentro.nome;
}

window.onload = function() {
    obterHemocentros();

    // Adiciona eventos de clique para os botões
    document.getElementById('botao-anterior').addEventListener('click', function() {
        const indexAtual = hemocentros.findIndex(hemocentro => hemocentro.id === bancoDeSangue.hemocentro.id);
        const novoIndex = (indexAtual === 0) ? hemocentros.length - 1 : indexAtual - 1;
        const novoHemocentro = hemocentros[novoIndex];
        obterBancoDeSangue(novoHemocentro.id);
    });

    document.getElementById('botao-proximo').addEventListener('click', function() {
        const indexAtual = hemocentros.findIndex(hemocentro => hemocentro.id === bancoDeSangue.hemocentro.id);
        const novoIndex = (indexAtual === hemocentros.length - 1) ? 0 : indexAtual + 1;
        const novoHemocentro = hemocentros[novoIndex];
        obterBancoDeSangue(novoHemocentro.id);
    });
};
