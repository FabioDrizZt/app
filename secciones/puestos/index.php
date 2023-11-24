<?php require_once('../../bd.php');
$sentencia = $conexion->prepare('SELECT * FROM `tbl_puestos`');
// Si la consulta necesita datos iran aquí
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['txtID'])) {
  // Eliminar un registro de la tabla tbl_puestos
  $id = $_GET["txtID"];

  $sentencia = $conexion->prepare('DELETE FROM `tbl_puestos` WHERE id=:id');
  // Si la consulta necesita datos iran aquí
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  header("Location: index.php");
}

?>

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
          <?php foreach ($lista_tbl_puestos as $puesto) { ?>
            <tr class="">
              <td scope="row"><?= $puesto['id'] ?></td>
              <td><?= $puesto['nombredelpuesto'] ?></td>
              <td>
                <a class="btn btn-info" href="editar.php">Editar</a>
                <a class="btn btn-danger" href="index.php?txtID=<?= $puesto['id']; ?>">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>

</div>
<?php require_once('../../templates/footer.php') ?>