<?php require_once('../../bd.php');
$sentencia = $conexion->prepare('SELECT * FROM `tbl_empleados`');
// Si la consulta necesita datos iran aquí
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['txtID'])) {
  // Eliminar un registro de la tabla tbl_empleados
  $id = $_GET["txtID"];
  // Borrado de la imagen fisica en el servidor
  $sentencia = $conexion->prepare('SELECT `foto`, `cv` FROM `tbl_empleados` WHERE id=:id');
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  if (isset($registro['foto'])) {
    if (file_exists("./images/" . $registro['foto'])) {
      unlink("./images/" . $registro['foto']);
    }
  }
  if (isset($registro['cv'])) {
    if (file_exists("./documents/" . $registro['cv'])) {
      unlink("./documents/" . $registro['cv']);
    }
  }
  // Borrar de la base de Datos
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
      <table id="tabla_id" class="table table-striped">
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
              <td>
                <img src="./images/<?= $empleado['foto'] ?>" width="150px" class="bd-placeholder-img bd-placeholder-img-lg img-fluid rounded" alt="Foto del empleado">
              </td>
              <td>
                <a class="btn btn-secondary" target="_blank" href="./documents/<?= $empleado['cv'] ?>">CV</a>
              </td>
              <td><?= $empleado['idpuesto'] ?></td>
              <td><?= $empleado['fechadeingreso'] ?></td>
              <td>
                <a class="btn btn-success" href="carta.php">Carta</a>
                <a class="btn btn-info" href="editar.php?txtID=<?= $empleado['id']; ?>">Editar</a>
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