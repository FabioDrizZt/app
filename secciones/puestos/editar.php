<?php
require_once('../../bd.php');
$id = $_GET["txtID"];
if ($_POST) {
  // Inser un registro de la tabla tbl_puestos
  $nombredelpuesto = isset($_POST["nombredelpuesto"]) ? $_POST["nombredelpuesto"] : "";

  $sentencia = $conexion->prepare("UPDATE `tbl_puestos` SET `nombredelpuesto`=:nombredelpuesto WHERE `id`=:id");
  // Si la consulta necesita datos iran aquí
  $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  $mensaje="Editado";
  header("Location:index.php?mensaje=$mensaje");
}
if (isset($_GET['txtID'])) {
  // Buscamos los datos del puesto a modificar en la BD
  $sentencia = $conexion->prepare('SELECT `nombredelpuesto` FROM `tbl_puestos` WHERE `id`=:id');
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
}
?>
<?php require_once('../../templates/head.php') ?>
<?php require_once('../../templates/header.php') ?><div class="card container">
  <div class="card-header">
    Modificar puesto
  </div>
  <div class="card-body">
    <form method="post">
      <div class="mb-3">
        <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
        <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" value="<?= $registro['nombredelpuesto']; ?>">
      </div>
      <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
      <button type="submit" class="btn btn-primary">Modificar Puesto</button>
    </form>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>