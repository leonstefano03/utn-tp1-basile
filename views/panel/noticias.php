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

  include_once('/xampp/htdocs/tp1/controllers/noticias.php');
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


    <div id="cont-button-table-new" class="mb-4 d-flex justify-content-end">
      <form action="noticias_edit.php">
        <button id="button-table-new" type="submit" class="btn text-white bg-teal">Agregar una noticia</button>
      </form>
    </div>

    <div id="cont-info-table" class="d-flex justify-content-center">

      <div id="info-table" class="p-4 rounded shadow bg-white" style="width: 900px;">
        <h2 class="text-center mb-4">Noticias</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Título</th>
              <th>Texto</th>
              <th>Fecha de creación</th>
              <th>Imagen</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($nuestroResultado as $fila) { ?>
              <tr>
                <td><?php echo $fila->id ?></td>
                <td><?php echo $fila->title ?></td>
                <td><?php echo $fila->text ?></td>
                <td><?php echo $fila->creation_date ?></td>
                <td><?php echo $fila->image ?></td>
                <td><?php echo $fila->description ?></td>
                <td><?php echo $fila->nombre_categoria ?></td>
                <td><?php echo $fila->nombre_usuario ?></td>
                <td>
                  <a href="noticias_edit.php?id=<?php echo $fila->id ?>" class="text-decoration-none text-teal">editar</a>
                  <a href="../../controllers/noticias.php?method=DELETE&id=<?php echo $fila->id ?>" class="text-decoration-none text-danger">eliminar</a>
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