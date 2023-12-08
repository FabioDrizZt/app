<?php
require_once('../../bd.php');
$sentencia = $conexion->prepare('SELECT * FROM `tbl_puestos`');
// Si la consulta necesita datos iran aquí
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
  // Inser un registro de la tabla tbl_puestos
  $primernombre = isset($_POST["primernombre"]) ? $_POST["primernombre"] : "";
  $segundonombre = isset($_POST["segundonombre"]) ? $_POST["segundonombre"] : "";
  $primerapellido = isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "";
  $segundoapellido = isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "";
  $idpuesto = isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "";

  $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";
  $cv = isset($_FILES["cv"]["name"]) ? $_FILES["cv"]["name"] : "";

  $sentencia = $conexion->prepare("INSERT
  INTO tbl_empleados(primernombre, segundonombre, primerapellido, segundoapellido, foto, cv, idpuesto)
  VALUES (:primernombre, :segundonombre, :primerapellido, :segundoapellido, :foto, :cv, :idpuesto)");
  // Si la consulta necesita datos iran aquí
  $sentencia->bindParam(":primernombre", $primernombre);
  $sentencia->bindParam(":segundonombre", $segundonombre);
  $sentencia->bindParam(":primerapellido", $primerapellido);
  $sentencia->bindParam(":segundoapellido", $segundoapellido);
  $sentencia->bindParam(":idpuesto", $idpuesto);

  $fecha = new DateTime();
  $foto = ($foto != '') ? $fecha->getTimestamp() . "_" . $foto : '';
  $cv = ($cv != '') ? $fecha->getTimestamp() . "_" . $cv : '';
  if ($foto != '') {
    move_uploaded_file($_FILES["foto"]["tmp_name"],"./images/".$foto);
  }
  if ($cv != '') {
    move_uploaded_file($_FILES["cv"]["tmp_name"],"./documents/".$cv);
  }
  $sentencia->bindParam(":foto", $foto);
  $sentencia->bindParam(":cv", $cv);

  $sentencia->execute();
  header("Location:index.php");
}
?>
<?php require_once('../../templates/head.php') ?>
<?php require_once('../../templates/header.php') ?><div class="card container">
  <div class="card-header">
    Agregar empleado
  </div>
  <div class="card-body">
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="primernombre" class="form-label">Primer Nombre</label>
        <input type="text" class="form-control" name="primernombre" id="primernombre">
      </div>
      <div class="mb-3">
        <label for="segundonombre" class="form-label">Segungo Nombre</label>
        <input type="text" class="form-control" name="segundonombre" id="segundonombre">
      </div>
      <div class="mb-3">
        <label for="primerapellido" class="form-label">Primer Apellido</label>
        <input type="text" class="form-control" name="primerapellido" id="primerapellido">
      </div>
      <div class="mb-3">
        <label for="segundoapellido" class="form-label">Segungo Apellido</label>
        <input type="text" class="form-control" name="segundoapellido" id="segundoapellido">
      </div>
      <div class="mb-3">
        <label for="cv" class="form-label">CV</label>
        <input type="file" class="form-control" name="cv" id="cv" accept="application/pdf">
      </div>
      <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" name="foto" id="foto" accept="image/jpeg">
      </div>
      <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto</label>
        <select class="form-select form-select-lg" name="idpuesto" id="idpuesto">
          <option hidden selected>Seleccione su puesto</option>
          <?php foreach ($lista_tbl_puestos as $puesto) : ?>
            <option value=<?= $puesto['id'] ?>>
              <?= $puesto['nombredelpuesto'] ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
      <button type="submit" class="btn btn-primary">Crear Empleado</button>
    </form>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>