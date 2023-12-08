<?php
require_once('../../bd.php');
$id = $_GET["txtID"];
if ($_POST) {
  // Inser un registro de la tabla tbl_puestos
  $primernombre = isset($_POST["primernombre"]) ? $_POST["primernombre"] : "";
  $segundonombre = isset($_POST["segundonombre"]) ? $_POST["segundonombre"] : "";
  $primerapellido = isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "";
  $segundoapellido = isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "";
  $idpuesto = isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "";

  $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";
  $cv = isset($_FILES["cv"]["name"]) ? $_FILES["cv"]["name"] : "";

  $sentencia = $conexion->prepare('SELECT `foto`, `cv` FROM `tbl_empleados` WHERE id=:id');
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);

  $sentencia2 = $conexion->prepare("UPDATE `tbl_empleados`
  SET `primernombre`=:primernombre,`segundonombre`=:segundonombre,
  `primerapellido`=:primerapellido,`segundoapellido`=:segundoapellido,`foto`=:foto,
  `cv`=:cv,`idpuesto`=:idpuesto WHERE id=:id");
  // Si la consulta necesita datos iran aquí
  $sentencia2->bindParam(":primernombre", $primernombre);
  $sentencia2->bindParam(":segundonombre", $segundonombre);
  $sentencia2->bindParam(":primerapellido", $primerapellido);
  $sentencia2->bindParam(":segundoapellido", $segundoapellido);
  $sentencia2->bindParam(":idpuesto", $idpuesto);

  $fecha = new DateTime();
  $foto = ($foto != '') ? $fecha->getTimestamp() . "_" . $foto : '';
  $cv = ($cv != '') ? $fecha->getTimestamp() . "_" . $cv : '';
  if ($foto != '') {
    move_uploaded_file($_FILES["foto"]["tmp_name"], "./images/" . $foto);
    if (file_exists("./images/" . $registro['foto'])) {
      unlink("./images/" . $registro['foto']);
    }
  }
  if ($cv != '') {
    move_uploaded_file($_FILES["cv"]["tmp_name"], "./documents/" . $cv);
    if (file_exists("./documents/" . $registro['cv'])) {
      unlink("./documents/" . $registro['cv']);
    }
  }

  $sentencia2->bindParam(":foto", $foto);
  $sentencia2->bindParam(":cv", $cv);
  $sentencia2->bindParam(":id", $id);

  $sentencia2->execute();
  $mensaje = "Editado";
  header("Location:index.php?mensaje=$mensaje");
}
if (isset($_GET['txtID'])) {
  $sentencia = $conexion->prepare('SELECT * FROM `tbl_puestos`');
  // Si la consulta necesita datos iran aquí
  $sentencia->execute();
  $lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

  // Buscamos los datos del puesto a modificar en la BD
  $sentencia = $conexion->prepare('SELECT * FROM `tbl_empleados` WHERE `id`=:id');
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
}
?>
<?php require_once('../../templates/head.php') ?>
<?php require_once('../../templates/header.php') ?><div class="card container">
  <div class="card-header">
    Edición de empleado
  </div>
  <div class="card-body">
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="primernombre" class="form-label">Primer Nombre</label>
        <input type="text" class="form-control" name="primernombre" id="primernombre" value="<?= $registro['primernombre'] ?>">
      </div>
      <div class="mb-3">
        <label for="segundonombre" class="form-label">Segungo Nombre</label>
        <input type="text" class="form-control" name="segundonombre" id="segundonombre" value="<?= $registro['segundonombre'] ?>">
      </div>
      <div class="mb-3">
        <label for="primerapellido" class="form-label">Primer Apellido</label>
        <input type="text" class="form-control" name="primerapellido" id="primerapellido" value="<?= $registro['primerapellido'] ?>">
      </div>
      <div class="mb-3">
        <label for="segundoapellido" class="form-label">Segungo Apellido</label>
        <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" value="<?= $registro['segundoapellido'] ?>">
      </div>
      <div class="mb-3">
        <a class="mb-2 btn btn-secondary" target="_blank" href="./documents/<?= $registro['cv'] ?>">CV actual</a>
        <label for="cv" class="form-label">
          Cambiar CV 👇
        </label>
        <input type="file" class="form-control" name="cv" id="cv" accept="application/pdf">
      </div>
      <div class="mb-3">

        <label for="foto" class="form-label">
          <img src="./images/<?= $registro['foto'] ?>" width="150px" class="bd-placeholder-img bd-placeholder-img-lg img-fluid rounded" alt="Foto del empleado">
        </label>
        <input type="file" class="form-control" name="foto" id="foto" accept="image/jpeg">
      </div>
      <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto</label>
        <select class="form-select form-select-lg" name="idpuesto" id="idpuesto">
          <?php foreach ($lista_tbl_puestos as $puesto) : ?>

            <option value="<?= $puesto['id'] ?>" <?= ($puesto['id'] == $registro['idpuesto']) ? "selected" : "" ?>>
              <?= $puesto['nombredelpuesto'] ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
      <button type="submit" class="btn btn-primary">Editar Empleado</button>
    </form>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>