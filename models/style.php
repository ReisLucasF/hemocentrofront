  <style>

    :root {
      --fc-daygrid-event-dot-width: 10px;
    }

    .fc .fc-scrollgrid-section-liquid > td {
    border-radius: 15px 0 15px 15px;
    }
    .fc .fc-scrollgrid-section-footer > *, .fc .fc-scrollgrid-section-header > * {
      border-bottom-width: 0px;
      border-radius: 15px 15px 0 0;
    }
    .fc-scrollgrid {
        border-radius: 15px;
    }

    body {
      height: 100vh;
    }
    section {
      display: grid;
      grid-template-rows: repeat(2, 1fr);
      grid-template-columns: repeat(2, 1fr);
      height: 80vh;
      margin: 0;
      gap: 15px;
    }

    main {
      margin: 20px 5%;
    }

    nav {
      margin-bottom: 25px;
      top: 0;
    }

    #calendar{
      margin: 20px 50px;
      height: 70%;
    }

    tbody tr{
      height: 25px;
    }

    .fc .fc-scrollgrid-liquid {
    background-color: #ffffff;
    /* height: 100%; */
}

.fc .fc-button-group > .fc-button {
    background-color: #ffffff;
    color: #000000;
}

.fc-direction-ltr .fc-toolbar > * > :not(:first-child){
  background-color: #ffffff;
    color: #000000;
}

.fc .fc-button-group > .fc-button.fc-button-active, .fc .fc-button-group > .fc-button:active, .fc .fc-button-group > .fc-button:focus, .fc .fc-button-group > .fc-button:hover {
    z-index: 1;
    background-color: #b5b5b5;
    color: #000000;
}
  </style>