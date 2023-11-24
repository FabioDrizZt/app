<?php require_once('../../bd.php');
$sentencia = $conexion->prepare('SELECT * FROM `tbl_usuarios`');
// Si la consulta necesita datos iran aquí
$sentencia->execute();
$lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once('../../templates/header.php') ?>
<div class="container card">
  <h2>Index de usuarios</h2>
  <div class="card-header">
    <a class="btn btn-primary" href="crear.php">Agregar registro</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Usuario</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($lista_tbl_usuarios as $usuario) : ?>
            <tr>
              <td scope="row"><?= $usuario['id']; ?></td>
              <td><?= $usuario['usuario']; ?></td>
              <td><?= '*********'; ?></td>
              <td><?= $usuario['correo']; ?></td>
              <td>
                <a class="btn btn-info" href="editar.php?id=<?= $usuario['id']; ?>">Editar</a>
                <a class="btn btn-danger" href="index.php?id=<?= $usuario['id']; ?>">Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require_once('../../templates/footer.php') ?>