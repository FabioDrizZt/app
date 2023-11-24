<?php require_once('../../bd.php');
$sentencia = $conexion->prepare('SELECT * FROM `tbl_empleados`');
// Si la consulta necesita datos iran aquí
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once('../../templates/header.php') ?>
<div class="container card">
  <h2>Index de empleados</h2>
  <div class="card-header">
    <a class="btn btn-primary" href="crear.php">Agregar registro</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Foto</th>
            <th scope="col">CV</th>
            <th scope="col">Puesto</th>
            <th scope="col">Fecha de ingreso</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($lista_tbl_empleados as $registro) { ?>
            <tr class="">
              <td scope="row"><?= $registro['id'] ?></td>
              <td><?= $registro['primernombre'] ." ". $registro['segundonombre'] ." ". $registro['primerapellido'] ." ". $registro['segundoapellido'] ?></td>
              <td><?= $registro['foto'] ?></td>
              <td><?= $registro['cv'] ?></td>
              <td><?= $registro['idpuesto'] ?></td>
              <td><?= $registro['fechadeingreso'] ?></td>
              <td>
                <a class="btn btn-success" href="carta.php">Editar</a>
                <a class="btn btn-info" href="editar.php">Editar</a>
                <a class="btn btn-danger" href="index.php">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>