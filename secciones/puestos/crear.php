<?php
if ($_POST) {
  require_once('../../bd.php');
  // Inser un registro de la tabla tbl_puestos
  $nombredelpuesto = isset($_POST["nombredelpuesto"]) ? $_POST["nombredelpuesto"] : "";

  $sentencia = $conexion->prepare("INSERT INTO tbl_puestos(nombredelpuesto) VALUES (:nombredelpuesto)");
  // Si la consulta necesita datos iran aquí
  $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
  $sentencia->execute();
  header("Location:index.php");
}
?>
<?php require_once('../../templates/header.php') ?>
<div class="card container">
  <div class="card-header">
    Agregar puesto
  </div>
  <div class="card-body">
    <form method="post">
      <div class="mb-3">
        <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
        <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" placeholder="Desarrollador Full Stack">
      </div>
      <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
      <button type="submit" class="btn btn-primary">Crear Puesto</button>
    </form>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>