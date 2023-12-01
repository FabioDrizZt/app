<?php
require_once('../../bd.php');
$id = $_GET["txtID"];
if ($_POST) {
  // Inser un registro de la tabla tbl_puestos
  $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
  $password = isset($_POST["password"]) ? $_POST["password"] : "";
  $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";

  $sentencia = $conexion->prepare("UPDATE tbl_usuarios 
  SET usuario=:usuario,password=:password,correo=:correo 
  WHERE id=:id");
  // Si la consulta necesita datos iran aquí
  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":password", $password);
  $sentencia->bindParam(":correo", $correo);
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  header("Location:index.php");
}
if (isset($_GET['txtID'])) {
  // Buscamos los datos del puesto a modificar en la BD 
  $sentencia = $conexion->prepare('SELECT * FROM `tbl_usuarios` WHERE `id`=:id');
  $sentencia->bindParam(":id", $id);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
}
?>
<?php require_once('../../templates/header.php') ?>
<div class="card container">
  <div class="card-header">
    Modificación usuario
  </div>
  <div class="card-body">
    <form method="post">
      <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario" value="<?= $registro['usuario']; ?>">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password" id="password" value="<?= $registro['password']; ?>">
      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" class="form-control" name="correo" id="correo" value="<?= $registro['correo']; ?>">
      </div>
      <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
      <button type="submit" class="btn btn-primary">Modificar usuario</button>
    </form>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>