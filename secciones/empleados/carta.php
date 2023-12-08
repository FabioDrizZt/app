<?php
require_once('../../bd.php');
$id = $_GET["txtID"];
$sentencia = $conexion->prepare('SELECT *, (SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto) as puesto FROM `tbl_empleados` WHERE id=:id');
$sentencia->bindParam(":id", $id);
$sentencia->execute();
$registro = $sentencia->fetch(PDO::FETCH_LAZY);
$nombrecompleto = $registro['primernombre'] . ' ' . $registro['segundonombre'] . ' '
  . $registro['primerapellido'] . ' ' . $registro['segundoapellido'];
$fechaActual = new DateTime(date('Y-m-d'));
$fechaInicio = new DateTime($registro['fechadeingreso']);
$intervalo = date_diff($fechaInicio, $fechaActual);
ob_start()
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carta de recomendación</title>
</head>

<body>
  <h1>Carta de recomendación laboral</h1>
  <p><strong>Nombre del trabajador: </strong><?= $nombrecompleto ?></p>
  <p>Buenos Aires, Argentina. <strong><?= date('d/m/Y') ?></strong></p>
  <br />
  <p>Reciba un cordial y respetuoso saludo</p>
  <p>
    Por medio de la presente, me dirijo a usted en calidad de representante legal y responsable de mi empresa.
  </p>
  <p>A traves de estas lineas deseo hacer de su conocimiento que el/la Sr(a) <strong><?= $nombrecompleto ?></strong></p>
  <p>Quien laboró en mi organización durante <strong><?= $intervalo->y ?> años</strong></p>
  <p>quien es un ciudadano con una conducta intachable. Ha demostrado ser un gran trabajador, comprometido, responsable y fiel cumplidor de sus tareas.</p>
  <p>Durante estos años se ha desempeñado como <strong><?= $registro['puesto'] ?></strong></p>
  <p>Es por ello le sugiero considere esta recomendación, con la confianza de que estará siempre a la altura de las circunstancias.</p>
  <p>y su compromiso con el trabajo es incuestionable.</p>
  <p>Sin mas nada a que referirme y, esperando que esta misiva sea tomada en cuenta, dejo mi nro de contacto: +541132145697</p>
  <br>
  <p align="right">Atentamente, </p>
  <br>
  <p align="right"> Ing. Manuel Perez.</p>
</body>

</html>
<?php
$HTML = ob_get_clean();
require_once '../../libs/dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($HTML);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('carta_recomendacion.pdf', array("Attachment"=>false));