<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Centro medico</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/final-db/panel.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/medicos/listaMedicos.php">Medicos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/pacientes/listaPacientes.php">Pacientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/empleados/listaEmpleados.php">Empleados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/especialidades/listaEspecialidades.php">Especialidades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Consultas</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill"></i>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item">Usuario: <span class="badge text-bg-info"><?php echo $_SESSION['email']; ?></span></a></li>
            <li><a class="dropdown-item" href="assets/server/salir.php" style="color: red;"><i class="bi bi-box-arrow-right"></i></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>