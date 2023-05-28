<?php
session_start();
if (!isset($_SESSION['usuario_info']) or empty($_SESSION['usuario_info'])) {
  header('Location: ../index.php');
}
require '../../vendor/autoload.php';
if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
  $id = $_GET['ID'];
  $productos = new bompzz\producto;
  $result_prod = $productos->Mostrar_id($id);

  if (!$result_prod)
    header('Location: index.php');
} else {
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
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/estilos.css">
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
        <a class="navbar-brand" href="../dashboard.php"><img src="../../assets/imagenes/proyecto4.png"></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
          <li>
            <a href="../pedidos/index.php" class="btn">Pedidos</a>
          </li>
          <li class="active">
            <a href="index.php" class="btn">Productos</a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['usuario_info']['USUARIO'] ?><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../cerrar_sesion.php">Salir</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>
  <div class="container" id="main">
    <div class=" row">
      <div class="col-md-12">
        <fieldset>
          <legend>Datos del prodcuto</legend>
          <form method="POST" action="../acciones.php" enctype="multipart/form-data">
            <input type="hidden" name="ID" value="<?php print $result_prod['ID'] ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nombre</label>
                  <input value="<?php print $result_prod['TITULO'] ?>" type="text" class="form-control" name="titulo" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Descripcion</label>
                  <textarea class="form-control" name="descripcion" cols="3" required><?php print $result_prod['DESCRIPCION'] ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Categorias</label>
                  <select class="form-control" name="categoria_id" required>
                    <option value="">--SELECCIONE--</option>
                    <?php
                    require '../../vendor/autoload.php';
                    $categorias = new bompzz\Categoria;
                    $info_cat = $categorias->Mostrar();
                    $cantidad = count($info_cat);
                    for ($x = 0; $x < $cantidad; $x++) {
                      $item = $info_cat[$x];

                    ?>
                      <option value="<?php print $item['ID'] ?>" <?php print $result_prod['CATEGORIA_ID'] == $item['ID'] ? 'SELECTED' : ''  ?>><?php print $item['CATEGORIA'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Foto</label>
                  <input type="file" class="form-control" name="foto">
                  <input type="hidden" name="foto_temp" value=" <?php print $result_prod['FOTO'] ?>">
                </div>
              </div>
            </div>
            <div class=" row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Precio</label>
                  <input value="<?php print $result_prod['PRECIO'] ?>" type="text" class="form-control" name="precio" placeholder="0.00" required>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" value="Actualizar" name="accion">Actualizar</button>
            <a href="index.php" class="" btn btn-default">Cancelar</a>
          </form>
        </fieldset>
      </div>
    </div>

  </div>



  </div> <!-- /container -->


  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>

</body>

</html>