<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  @session_start();

  include_once('/xampp/htdocs/tp1/controllers/categorias.php');

  $admin = isset($_SESSION["is_admin"]) ? intval($_SESSION["is_admin"]) : 0;
  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;

  ?>
  <?php
  if ($error) { ?>
    <div class="alert alert-danger" role="alert">
      Error al cargar los datos, inténtelo nuevamente.
    </div>
  <?php } ?>

  <?php include_once('/xampp/htdocs/tp1/views/common/menu.php') ?>

  <div id="table" class="container mt-5" style="width: 80%;">
    <h2 class="text-center mb-4">CATEGORÍAS</h2>

    <div id="cont-button-table-new" class="mb-4 d-flex justify-content-end">
      <form action="categorias_edit.php?method=NEW">
        <button id="button-table-new" type="submit" class="btn text-white bg-teal">Agregar categoría</button>
      </form>
    </div>

    <div id="cont-info-table" class="d-flex justify-content-center">
      <div id="info-table" class="p-4 rounded shadow bg-white" style="width: 700px;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($nuestroResultado as $fila) { ?>
              <tr>
                <td><?php echo $fila->nombre ?></td>
                <td>
                  <a href="categorias_edit.php?id=<?php echo $fila->id ?>" class="text-decoration-none text-teal">editar</a>
                  <a href="../../controllers/categorias.php?method=DELETE&id=<?php echo $fila->id ?>" class="text-decoration-none text-danger">eliminar</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
<style>
  body {
    width: 100vw;
    height: 100vh;
    margin: 0;
    padding: 0;
    background-color: burlywood;
    display: flex;
  }

  .bg-teal {
    background-color: darkslategray;
  }

  .bg-teal:hover {
    background-color: darkcyan;
  }

  #button-table-new {
    width: 200px;
    height: 50px;
    margin-right: 50px;
    border-radius: 5px;
  }

  #info-table {
    background-color: azure;
  }
</style>

</html>