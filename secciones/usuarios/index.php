<?php require_once('../../templates/header.php') ?>
<div class="container card">
  <h2>Index de usuarios</h2>
  <div class="card-header">
    <a class="btn btn-primary" href="crear.php">Agregar registro</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Usuario</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr class="">
            <td scope="row">1</td>
            <td>fabioarganaraz</td>
            <td>*********</td>
            <td>fabioarganaraz@soydigitalmind.com</td>
            <td>Editar|Eliminar</td>
          </tr>
          <tr class="">
            <td scope="row">2</td>
            <td>fabioarganaraz</td>
            <td>*********</td>
            <td>fabioarganaraz@soydigitalmind.com</td>
            <td>Editar|Eliminar</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>