<?php require_once('../../templates/header.php') ?>
<div class="container card">
  <h2>Index de puestos</h2>
  <div class="card-header">
    <a class="btn btn-primary" href="crear.php">Agregar registro</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del puesto</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr class="">
            <td scope="row">1</td>
            <td>Frontend</td>
            <td>Editar|Eliminar</td>
          </tr>
          <tr class="">
            <td scope="row">2</td>
            <td>Backend</td>
            <td>Editar|Eliminar</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

</div>
<?php require_once('../../templates/footer.php') ?>