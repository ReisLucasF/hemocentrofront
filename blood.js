
function obterBancoDeSangue() {
    fetch('./config/config.json')
        .then(response => {
            return response.json();
        })
        .then(config => {
            const apiUrl = config.linkapi + '/banco'; 
            return fetch(apiUrl);
        })
        .then(response => {
            return response.json();
        })
        .then(data => {
            bancoDeSangue = data[0];
            atualizarImagensEstoque();
        })
}


function atualizarImagensEstoque() {
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
}

window.onload = function() {
    obterBancoDeSangue();
};
