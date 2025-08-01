<div id="nav-bar">
  <input id="nav-toggle" type="checkbox" />
  <div id="nav-header">
    <img src="img/aguamerca_logo.png" alt="Logo" class="nav-logo">
    <h4 id="nav-title">Control de Asistencia</h4>
    <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
    <hr />
  </div>
  <div id="nav-content">
    <a href="reporteEmp.php" class="nav-button"><i class="fas fa-users"></i><span>Lista de Empleados</span></a>
    <a href="form_agregar.php" class="nav-button"><i class="fas fa-user-plus"></i><span>Agregar Datos</span></a>
    <a href="asistencia.php" class="nav-button"><i class="fas fa-user-check"></i><span>Empleados Activos</span></a>
    <a href="reporteDiario.php" class="nav-button"><i class="fas fa-calendar-day"></i><span>Reporte diario</span></a>
    <a href="reporteAnual.php" class="nav-button"><i class="fas fa-calendar-alt"></i><span>Reporte por fecha</span></a>
    <a href="config_horario.php" class="nav-button"><i class="fas fa-clock"></i><span>Configurar Horario</span></a>
    <div id="nav-content-highlight"></div>
  </div>

</div>

<style>
  :root {
    --background: rgb(17, 61, 236);
    --navbar-width: 256px;
    --navbar-width-min: 80px;
    --navbar-dark-primary: #18283b;
    --navbar-dark-secondary: #2c3e50;
    --navbar-light-primary: #f5f6fa;
    --navbar-light-secondary: #8392a5;
  }

  .nav-logo {
    width: 30px;
    height: 30px;
    margin: 10px;
  }

  html {
    margin: 0;
  }

  body {
    margin: 0;
    background: var(--background);
    transition: padding-left 0.2s;
  }

  #nav-toggle:checked~#nav-bar {
    width: var(--navbar-width-min);
    left: 0;
  }

  #nav-toggle:checked~#nav-header {
    width: calc(var(--navbar-width-min) - 16px);
  }

  #nav-toggle:checked~#nav-content,
  #nav-toggle:checked~#nav-footer {
    width: var(--navbar-width-min);
  }

  #nav-toggle:checked~#nav-header #nav-title {
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.1s;
  }

  #nav-toggle:checked~#nav-header label[for=nav-toggle] {
    left: calc(50% - 8px);
    transform: translate(-50%);
  }

  #nav-toggle:checked~#nav-header #nav-toggle-burger {
    background: var(--navbar-light-primary);
  }

  #nav-toggle:checked~#nav-header #nav-toggle-burger:before,
  #nav-toggle:checked~#nav-header #nav-toggle-burger::after {
    width: 16px;
    background: var(--navbar-light-secondary);
    transform: translate(0, 0) rotate(0deg);
  }

  #nav-toggle:checked~#nav-content .nav-button span {
    opacity: 0;
    transition: opacity 0.1s;
  }

  #nav-toggle:checked~#nav-content .nav-button .fas {
    min-width: calc(100% - 16px);
  }

  #nav-toggle:checked~#nav-footer #nav-footer-avatar {
    margin-left: 0;
    left: 50%;
    transform: translate(-50%);
  }

  #nav-toggle:checked~#nav-footer #nav-footer-titlebox,
  #nav-toggle:checked~#nav-footer label[for=nav-footer-toggle] {
    opacity: 0;
    transition: opacity 0.1s;
    pointer-events: none;
  }

  #nav-bar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    background: var(--navbar-dark-primary);
    border-radius: 0 16px 16px 0;
    display: flex;
    flex-direction: column;
    color: var(--navbar-light-primary);
    font-family: "Noto Sans", sans-serif;
    font-weight: 300;
    font-style: normal;
    font-variation-settings:
      "wdth" 100;
    overflow: hidden;
    user-select: none;
    z-index: 9999;
    transition: width 0.2s, left 0.2s;
  }

  #nav-toggle:checked~#nav-bar {
    width: 56px;
    min-width: 56px;
    max-width: 56px;
    background: var(--navbar-dark-primary);
  }

  #nav-bar hr {
    margin: 0;
    position: relative;
    left: 16px;
    width: calc(100% - 32px);
    border: none;
    border-top: solid 1px var(--navbar-dark-secondary);
  }

  #nav-bar a {
    color: inherit;
    text-decoration: inherit;
  }

  #nav-bar input[type=checkbox] {
    display: none;
  }

  /* Ocultar el sidebar cuando el toggle está activo */
  #nav-toggle:checked~#nav-header,
  #nav-toggle:checked~#nav-content,
  #nav-toggle:checked~#nav-footer {
    overflow: hidden;
  }

  #nav-toggle:checked~#nav-bar {
    width: var(--navbar-width-min);
    min-width: var(--navbar-width-min);
    max-width: var(--navbar-width-min);
    overflow: visible;
  }

  #nav-toggle:checked~#nav-bar #nav-header hr,
  #nav-toggle:checked~#nav-bar #nav-content,
  #nav-toggle:checked~#nav-bar #nav-footer,
  #nav-toggle:checked~#nav-bar #nav-footer-heading,
  #nav-toggle:checked~#nav-bar #nav-footer-content,
  #nav-toggle:checked~#nav-bar #nav-title {
    opacity: 0 !important;
    pointer-events: none !important;
    width: 0 !important;
    min-width: 0 !important;
    max-width: 0 !important;
    height: 0 !important;
    padding: 0 !important;
    margin: 0 !important;
    border: none !important;
    transition: opacity 0.2s, width 0.2s, height 0.2s;
  }

  #nav-toggle:checked~#nav-bar #nav-header {
    width: 56px;
    min-width: 56px;
    max-width: 56px;
    padding: 0;
    margin: 0;
    background: transparent;
  }

  #nav-toggle:checked~#nav-bar #nav-header label[for=nav-toggle],
  #nav-toggle:checked~#nav-bar #nav-toggle-burger {
    opacity: 1 !important;
    pointer-events: auto !important;
    position: absolute;
    left: 50%;
    top: 32px;
    transform: translate(-50%, -50%);
    z-index: 10000;
  }

  #nav-toggle:not(:checked)~#nav-bar {
    width: var(--navbar-width);
    min-width: var(--navbar-width);
    max-width: var(--navbar-width);
  }

  #nav-header {
    position: relative;
    width: var(--navbar-width);
    left: 16px;
    width: calc(var(--navbar-width) - 16px);
    min-height: 80px;
    background: var(--navbar-dark-primary);
    border-radius: 16px;
    z-index: 2;
    display: flex;
    align-items: center;
    transition: width 0.2s;
  }

  #nav-header hr {
    position: absolute;
    bottom: 0;
  }

  #nav-title {
    font-size: 1.5rem;
    transition: opacity 1s;
  }

  label[for=nav-toggle] {
    position: absolute;
    right: 0;
    width: 3rem;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
  }

  #nav-toggle-burger {
    position: relative;
    width: 16px;
    height: 2px;
    background: var(--navbar-dark-primary);
    border-radius: 99px;
    transition: background 0.2s;
  }

  #nav-toggle-burger:before,
  #nav-toggle-burger:after {
    content: "";
    position: absolute;
    top: -6px;
    width: 10px;
    height: 2px;
    background: var(--navbar-light-primary);
    border-radius: 99px;
    transform: translate(2px, 8px) rotate(30deg);
    transition: 0.2s;
  }

  #nav-toggle-burger:after {
    top: 6px;
    transform: translate(2px, -8px) rotate(-30deg);
  }

  #nav-content {
    margin: -16px 0;
    padding: 16px 0;
    position: relative;
    flex: 1;
    width: var(--navbar-width);
    background: var(--navbar-dark-primary);
    box-shadow: 0 0 0 16px var(--navbar-dark-primary);
    direction: rtl;
    overflow-x: hidden;
    transition: width 0.2s;
  }

  #nav-content::-webkit-scrollbar {
    width: 8px;
    height: 8px;
  }

  #nav-content::-webkit-scrollbar-thumb {
    border-radius: 99px;
    background-color: #D62929;
  }

  #nav-content::-webkit-scrollbar-button {
    height: 16px;
  }

  #nav-content-highlight {
    position: absolute;
    left: 16px;
    top: -70px;
    width: calc(100% - 16px);
    height: 54px;
    background: var(--background);
    background-attachment: fixed;
    border-radius: 16px 0 0 16px;
    transition: top 0.2s;
  }

  #nav-content-highlight:before,
  #nav-content-highlight:after {
    content: "";
    position: absolute;
    right: 0;
    bottom: 100%;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    box-shadow: 16px 16px var(--background);
  }

  #nav-content-highlight:after {
    top: 100%;
    box-shadow: 16px -16px var(--background);
  }

  .nav-button {
    position: relative;
    margin-left: 16px;
    height: 54px;
    display: flex;
    align-items: center;
    color: var(--navbar-light-secondary);
    direction: ltr;
    cursor: pointer;
    z-index: 1;
    transition: color 0.2s;
  }

  .nav-button span {
    transition: opacity 1s;
  }

  .nav-button .fas {
    transition: min-width 0.2s;
  }

  .nav-button:nth-of-type(1):hover {
    color: var(--navbar-dark-primary);
  }

  .nav-button:nth-of-type(1):hover~#nav-content-highlight {
    top: 16px;
  }

  .nav-button:nth-of-type(2):hover {
    color: var(--navbar-dark-primary);
  }

  .nav-button:nth-of-type(2):hover~#nav-content-highlight {
    top: 70px;
  }

  .nav-button:nth-of-type(3):hover {
    color: var(--navbar-dark-primary);
  }

  .nav-button:nth-of-type(3):hover~#nav-content-highlight {
    top: 124px;
  }

  .nav-button:nth-of-type(4):hover {
    color: var(--navbar-dark-primary);
  }

  .nav-button:nth-of-type(4):hover~#nav-content-highlight {
    top: 178px;
  }

  .nav-button:nth-of-type(5):hover {
    color: var(--navbar-dark-primary);
  }

  .nav-button:nth-of-type(5):hover~#nav-content-highlight {
    top: 232px;
  }

  .nav-button:nth-of-type(6):hover {
    color: var(--navbar-dark-primary);
  }

  .nav-button:nth-of-type(6):hover~#nav-content-highlight {
    top: 286px;
  }

  .nav-button:nth-of-type(7):hover {
    color: var(--navbar-dark-primary);
  }

  .nav-button:nth-of-type(7):hover~#nav-content-highlight {
    top: 340px;
  }

  .nav-button:nth-of-type(8):hover {
    color: var(--navbar-dark-primary);
  }

  .nav-button:nth-of-type(8):hover~#nav-content-highlight {
    top: 394px;
  }

  #nav-bar .fas {
    min-width: 3rem;
    text-align: center;
  }

  #nav-footer {
    position: relative;
    width: var(--navbar-width);
    height: 54px;
    background: var(--navbar-dark-secondary);
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    z-index: 2;
    transition: width 0.2s, height 0.2s;
  }

  #nav-footer-heading {
    position: relative;
    width: 100%;
    height: 54px;
    display: flex;
    align-items: center;
  }

  #nav-footer-avatar {
    position: relative;
    margin: 11px 0 11px 16px;
    left: 0;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    overflow: hidden;
    transform: translate(0);
    transition: 0.2s;
  }

  #nav-footer-avatar img {
    height: 100%;
  }

  #nav-footer-titlebox {
    position: relative;
    margin-left: 16px;
    width: 10px;
    display: flex;
    flex-direction: column;
    transition: opacity 1s;
  }

  #nav-footer-subtitle {
    color: var(--navbar-light-secondary);
    font-size: 0.6rem;
  }

  #nav-toggle:not(:checked)~#nav-footer-toggle:checked+#nav-footer {
    height: 30%;
    min-height: 54px;
  }

  #nav-toggle:not(:checked)~#nav-footer-toggle:checked+#nav-footer label[for=nav-footer-toggle] {
    transform: rotate(180deg);
  }

  label[for=nav-footer-toggle] {
    position: absolute;
    right: 0;
    width: 3rem;
    height: 100%;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: transform 0.2s, opacity 0.2s;
  }

  #nav-footer-content {
    margin: 0 16px 16px 16px;
    border-top: solid 1px var(--navbar-light-secondary);
    padding: 16px 0;
    color: var(--navbar-light-secondary);
    font-size: 0.8rem;
    overflow: auto;
  }

  #nav-footer-content::-webkit-scrollbar {
    width: 8px;
    height: 8px;
  }

  #nav-footer-content::-webkit-scrollbar-thumb {
    border-radius: 99px;
    background-color: #D62929;
  }
</style>