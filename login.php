<?php
session_start();
if($_POST){
require_once('./bd.php');
$sentencia = $conexion->prepare('SELECT * FROM `tbl_usuarios` WHERE usuario=:usuario AND password=:password');
$sentencia->bindParam(":usuario", $_POST['usuario']);
$sentencia->bindParam(":password", $_POST['password']);
$sentencia->execute();
$registro = $sentencia->fetch(PDO::FETCH_LAZY);
echo "<pre>";
print_r($registro);
echo "</pre>";
if ($registro) {
  $_SESSION['usuario'] = $registro['usuario'];
  $_SESSION['logueado'] = true;
  header("Location:index.php");
} else {
  $mensaje = "Usuario o contraseña incorrectos";
}
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Inicio de Sesión</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <div class="card container">
      <div class="card-header">Inicio de Sesión</div>
      <div class="card-body">
        <?php if (isset($mensaje)) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Datos Incorrectos:</strong> Usuario o contraseña incorrectos
          </div>
        <?php endif; ?>

        <form method="POST">
          <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Ingrese su usuario" />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese contraseña" />
          </div>
          <button type="submit" class="btn btn-primary">
            Iniciar Sesión
          </button>

        </form>
      </div>
    </div>


  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>