<?php require_once('../../templates/head.php') ?>

<?php require_once('../../bd.php');
$sentencia = $conexion->prepare('SELECT * FROM `tbl_puestos`');
// Si la consulta necesita datos iran aquí
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
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
if ((isset($_GET['mensaje']) )) :
  echo $_GET['mensaje'];
  ?>
  <script>
     Swal.fire({
       title: "¡<?= $_GET['mensaje'] ?>!",
       text: "El empleado ha sido <?= $_GET['mensaje'] ?> exitosamente.",
       icon: "success"
     });
   </script>
<?php endif;
if (isset($_GET['txtID'])) {
  // Eliminar un registro de la tabla tbl_puestos
  $id = $_GET["txtID"];

  $sentencia = $conexion->prepare('DELETE FROM `tbl_puestos` WHERE id=:id');
  // Si la consulta necesita datos iran aquí
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  $mensaje='borrado';
  header("Location:index.php?mensaje=$mensaje");}

?>

<?php require_once('../../templates/header.php') ?><div class="container card">
  <h2>Index de puestos</h2>
  <div class="card-header">
    <a class="btn btn-primary" href="crear.php">Agregar registro</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="tabla_id" class="table table-striped">
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
                <a class="btn btn-info" href="editar.php?txtID=<?= $puesto['id']; ?>">Editar</a>
                <a class="btn btn-danger" href="javascript:borrar(<?= $puesto['id']; ?>)">Eliminar</a>
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
          text: "El puesto esta a salvo",
          icon: "error"
        });
      }
    });
  }
</script>
<?php require_once('../../templates/footer.php') ?>