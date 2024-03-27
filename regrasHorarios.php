


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