<?php require_once('../../templates/head.php') ?>
<?php require_once('../../bd.php');
$sentencia = $conexion->prepare('SELECT *,
(SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto) as puesto
 FROM `tbl_empleados`');
// Si la consulta necesita datos iran aquí
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<script>
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
  });
</script>
<?php
echo $_GET['mensaje'];
if ((isset($_GET['mensaje']) )) : ?>
  <script>
     Swal.fire({
       title: "¡<?= $_GET['mensaje'] ?>!",
       text: "El empleado ha sido <?= $_GET['mensaje'] ?> exitosamente.",
       icon: "success"
     });
   </script>
<?php endif;
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
  $mensaje='borrado';
  header("Location:index.php?mensaje=$mensaje");
}
?>
<?php require_once('../../templates/head.php') ?>
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
              <td><?= $empleado['puesto'] ?></td>
              <td><?= $empleado['fechadeingreso'] ?></td>
              <td>
                <a target="_blank" class="btn btn-success" href="carta.php?txtID=<?= $empleado['id']; ?>">Carta</a>
                <a class="btn btn-info" href="editar.php?txtID=<?= $empleado['id']; ?>">Editar</a>
                <a class="btn btn-danger" href="javascript:borrar(<?= $empleado['id']; ?>)">Eliminar</a>

              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  function borrar(id) {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "¡No podrás revertirlo!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Sí, bórralo!",
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = `index.php?txtID=${id}`;
      } else {
        swalWithBootstrapButtons.fire({
          title: "Cancelado",
          text: "El empleado esta a salvo",
          icon: "error"
        });
      }
    });
  }
</script>
<?php require_once('../../templates/footer.php') ?>