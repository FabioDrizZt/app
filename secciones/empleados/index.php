<?php require_once('../../bd.php');
$sentencia = $conexion->prepare('SELECT * FROM `tbl_empleados`');
// Si la consulta necesita datos iran aquí
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['txtID'])) {
  // Eliminar un registro de la tabla tbl_empleados
  $id = $_GET["txtID"];

  $sentencia = $conexion->prepare('DELETE FROM `tbl_empleados` WHERE id=:id');
  // Si la consulta necesita datos iran aquí
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  header("Location: index.php");
}
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
          <?php foreach ($lista_tbl_empleados as $empleado) { ?>
            <tr class="">
              <td scope="row"><?= $empleado['id'] ?></td>
              <td><?= $empleado['primernombre'] . " " . $empleado['segundonombre'] . " " . $empleado['primerapellido'] . " " . $empleado['segundoapellido'] ?></td>
              <td><?= $empleado['foto'] ?></td>
              <td><?= $empleado['cv'] ?></td>
              <td><?= $empleado['idpuesto'] ?></td>
              <td><?= $empleado['fechadeingreso'] ?></td>
              <td>
                <a class="btn btn-success" href="carta.php">Carta</a>
                <a class="btn btn-info" href="editar.php">Editar</a>
                <a class="btn btn-danger" href="index.php?txtID=<?= $empleado['id']; ?>">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>