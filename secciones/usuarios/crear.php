<?php
if ($_POST) {
  require_once('../../bd.php');
  // Inser un registro de la tabla tbl_puestos
  $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
  $password = isset($_POST["password"]) ? $_POST["password"] : "";
  $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";

  $sentencia = $conexion->prepare("INSERT 
  INTO tbl_usuarios(usuario, password, correo) 
  VALUES (:usuario, :password, :correo)");
  // Si la consulta necesita datos iran aquí
  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":password", $password);
  $sentencia->bindParam(":correo", $correo);
  $sentencia->execute();
  header("Location:index.php");
}
?>
<?php require_once('../../templates/header.php') ?>
<div class="card container">
  <div class="card-header">
    Agregar usuario
  </div>
  <div class="card-body">
    <form method="post">
      <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Pedro1607">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="My$uP3|2P4$$w0rD">
      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" class="form-control" name="correo" id="correo" placeholder="pedro@mail.com">
      </div>
      <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
      <button type="submit" class="btn btn-primary">Crear usuario</button>
    </form>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>