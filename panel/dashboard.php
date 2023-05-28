<?php
session_start();
if (!isset($_SESSION['usuario_info']) or empty($_SESSION['usuario_info'])) {
  header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BOMPZZ</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/estilos.css">
</head>

<body>

  <!-- Fixed navbar -->
  <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #3CAFD9
!important;">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php"><img src="../assets/imagenes/proyecto4.png"></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
          <li>
            <a href="pedidos/index.php" class="btn">Pedidos</a>
          </li>
          <li>
            <a href="Productos/index.php" class="btn">Productos</a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['usuario_info']['USUARIO'] ?><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="cerrar_sesion.php">Salir</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container" id="main">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>Listado de Pedidos Recientes</legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>N°. Pedido</th>
                <th>Total</th>
                <th>Fecha</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              require '../vendor/autoload.php';
              $pedido = new bompzz\Pedido;
              $info_ped = $pedido->MostrarPedidos();

              $cantidad = count($info_ped);
              if ($cantidad > 0) {
                $c = 0;
                for ($x = 0; $x < $cantidad; $x++) {
                  $c++;
                  $item = $info_ped[$x];

              ?>
                  <tr>
                    <td><?php print $c ?></td>
                    <td><?php print $item['CLIENTE'] ?></td>
                    <td><?php print $item['ID'] ?></td>
                    <td>$<?php print $item['TOTAL'] ?>MXN</td>
                    <td><?php print $item['FECHA'] ?></td>
                    <td class="text-center">
                      <a href="pedidos/ver.php?ID=<?php print $item['ID'] ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>
                    </td>
                  </tr>
                <?php
                }
              } else {
                ?>
                <tr>
                  <td colspan="6">NO HAY REGISTROS</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </fieldset>
      </div>
    </div>
  </div>


  </div> <!-- /container -->


  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>

</body>

</html>