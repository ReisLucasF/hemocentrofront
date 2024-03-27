<?php
include './partials/header.php';

function obterDadosDaAPI($url) {
    $ch = curl_init($url);
    
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json',
        ],
    ]);
    $resposta = curl_exec($ch);
    $statusHttp = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        throw new Exception("Erro de cURL: " . curl_error($ch));
    }
    if ($statusHttp != 200) {
        throw new Exception("Erro HTTP: $statusHttp");
    }
    curl_close($ch);
    return $resposta;
}

function transformarEventos($dadosApi) {
    $eventos = [];
    foreach ($dadosApi as $agendamento) {
        $eventos[] = [
            'id' => $agendamento['id'],
            'title' => $agendamento['nome'],
            'start' => $agendamento['dataAgendamento'],
            'end' => $agendamento['dataFim'],
            'color' => '#257e4a',
            'extendedProps' => [
                'nome' => $agendamento['nome'],
                'email' => $agendamento['eMail'],
            ],
        ];
    }
    return $eventos;
}

try {
    $config_file = './config/config.json';
    $config_content = file_get_contents($config_file);
    $config = json_decode($config_content, true);

    $api_url = rtrim($config['linkapi'], '/') . '/agendamentos';
    
    $resposta = obterDadosDaAPI($api_url);
    $dadosApi = json_decode($resposta, true);
    
    $eventos = transformarEventos($dadosApi);
    
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='fullcalendar/packages/core/pt-br.global.js'></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Inclusão do CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Inclusão do JS do Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-4.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <link rel="stylesheet" href="style.css">
    <script src='fullcalendar/dist/index.global.js'></script>

  </head>



  <?php
    include './models/style.php'
  ?>

  <body>
    <div id="calendar"></div>

    <script>
      var eventId;

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        
        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale: 'pt-br',
          monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
          buttonText: {
            today: "Hoje",
            month: "Mês",
            week: "Semana",
            day: "Dia",
          },
          allDayText: 'dia inteiro',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          navLinks: true,
          selectable: true,
          selectMirror: true,
          
          dateClick: function(info) {
            $('#criarAgendamentoModal').modal('show');
            
            $('#dataInicio').val(info.dateStr);
          },
          eventClick: function(arg) {
            // Preencher campos com valores do evento
            $('#edit_nome').val(arg.event.extendedProps.nome);
            $('#edit_email').val(arg.event.extendedProps.email);
            // Continue preenchendo outros campos conforme necessário

            // Data de início (start)
            var start = new Date(arg.event.start.getTime() - (3 * 60 * 60 * 1000)); // Ajusta o fuso horário, se necessário
            var startISO = start.toISOString().slice(0, -8);
            $('#edit_dataInicio').val(startISO);

            // Data de fim (end) - Tratamento para quando a dataFim é nula
            if (arg.event.end) {
              console.log(arg.event);
              var end = new Date(arg.event.end.getTime() - (3 * 60 * 60 * 1000)); // Ajusta o fuso horário, se necessário
              var endISO = end.toISOString().slice(0, -8);
              $('#edit_dataFim').val(endISO);
            } else {
              // Se não houver data de fim, pode optar por limpar o campo ou definir um valor padrão
              $('#edit_dataFim').val(''); // Limpa o campo dataFim
            }

            // Exibir a modal de edição
            $('#editarAgendamentoModal').modal('show');
          },


          editable: false,
          dayMaxEvents: true,
          events: <?php echo json_encode($eventos); ?> 
            });

        calendar.render();
      });
    </script>

    <!-- <script>
      function verificarUsuarioLogado() {
          var usuarioLogado = sessionStorage.getItem('usuarioLogado');
          if (!usuarioLogado) {
              window.location.href = 'login.php';
              return;
          }

          if (usuarioLogado) {
              var usuario = JSON.parse(usuarioLogado);
              console.log(usuario)
              if (usuario.usuario.tipoUsuario === 'hemocentro') {
              }else{
                  window.location.href = 'login.php';

              }
          }
      }

      window.onload = function() {
          verificarUsuarioLogado();
      };
  </script> -->





    <!-- Modal de Criação de Agendamento -->
    <?php
      include './models/editarAgendamento.php'
    ?>

    <?php
      include './models/criacaoAgendamento.php'
    ?>


    <script src="index.js"></script>

    <?php
        include './partials/footer.php';
    ?>

  </body>
</html>