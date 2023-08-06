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
        <?php if($rolUsuario == 1 || $rolUsuario == 2): ?>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/medicos/listaMedicos.php">Medicos</a>
        </li>
        <?php endif; ?>
        <?php if($rolUsuario == 1 || $rolUsuario == 2): ?>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/pacientes/listaPacientes.php">Pacientes</a>
        </li>
        <?php endif; ?>
        <?php if($rolUsuario == 1 || $rolUsuario == 3): ?>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/empleados/listaEmpleados.php">Empleados</a>
        </li>
        <?php endif; ?>
        <?php if($rolUsuario == 1): ?>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/especialidades/listaEspecialidades.php">Especialidades</a>
        </li>
        <?php endif; ?>
        <?php if($rolUsuario == 1): ?>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/paises/listaPaises.php">Paises</a>
        </li>
        <?php endif; ?>
        <?php if($rolUsuario == 1): ?>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/provincias/listaProvincias.php">Provincias</a>
        </li>
        <?php endif; ?>
        <?php if($rolUsuario == 1): ?>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/localidades/listaLocalidades.php">Localidades</a>
        </li>
        <?php endif; ?>
        <?php if($rolUsuario == 1): ?>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/calles/listaCalles.php">Calles</a>
        </li>
        <?php endif; ?>
        <?php if($rolUsuario == 1): ?>
        <li class="nav-item">
          <a class="nav-link" href="/final-db/modulos/barrios/listaBarrios.php">Barrios</a>
        </li>
        <?php endif; ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill"></i>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item">Usuario: <span class="badge text-bg-info"><?php echo $_SESSION['email']; ?></span></a></li>
            <li><a class="dropdown-item" href="/final-db/assets/server/salir.php" style="color: red;"><i class="bi bi-box-arrow-right"></i></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>