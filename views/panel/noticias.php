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
  include_once('/xampp/htdocs/tp1/controllers/sessionValidate.php');

  include_once('/xampp/htdocs/tp1/controllers/noticias.php');
  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;
  $noticias = obtenerNoticias($conx, 0, 0, 0, '');

  ?>
  <?php
  if ($error) { ?>
    <div class="alert alert-danger" role="alert">
      Error loading the data, please try again.
    </div>
  <?php } ?>

  <?php include_once('/xampp/htdocs/tp1/views/common/menu.php') ?>

  <div id="table" class="container mt-5" style="width: 80%;">

    <h2 class="text-center mb-4">NEWS</h2>

    <div id="cont-button-table-new" class="mb-4 d-flex justify-content-end">
      <form action="noticias_edit.php">
        <button id="button-table-new" type="submit" class="btn text-white bg-teal">Add a news item</button>
      </form>
    </div>

    <div id="cont-info-table" class="d-flex justify-content-center">

      <div id="info-table" class="p-4 rounded shadow bg-white" style="max-width:85%;  max-height: 75vh;
    flex-grow: 1;overflow: auto;">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Text</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">User</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody style="width: 100%;">
              <?php
              foreach ($noticias as $fila) { ?>
                <tr>
                  <td><?php echo $fila->id ?></td>
                  <td><?php echo $fila->title ?></td>
                  <td class="truncate"><?php echo $fila->text ?></td>
                  <td class="truncate"><?php echo $fila->creation_date ?></td>
                  <td class="truncate">
                    <img style="width: 40px; object-fit: cover;" src="../../<?php echo $fila->image ?>" alt="<?php echo $fila->title ?>">
                  </td>
                  <td class="truncate"><?php echo $fila->description ?></td>
                  <td><?php echo $fila->nombre_categoria ?></td>
                  <td><?php echo $fila->nombre_usuario ?></td>

                  <td>
                    <form action="noticias_edit.php" method="POST" style="display:inline;">
                      <input type="hidden" name="id" value="<?php echo $fila->id ?>">
                      <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                    <form action="../../controllers/noticias.php" method="POST" style="display:inline;">
                      <input type="hidden" name="method" value="DELETE">
                      <input type="hidden" name="id" value="<?php echo $fila->id ?>">
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
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
    background-color: #a3b18a;
    display: flex;
  }

  .bg-teal {
    background-color: darkslategray;
  }

  .bg-teal:hover {
    background-color: #588157;
  }

  #button-table-new {
    width: 150px;
    height: 50px;
    margin-right: 50px;
    border-radius: 5px;
  }

  #info-table {
    background-color: azure;
  }

  .table a {
    flex-wrap: wrap;
  }

  .truncate {
    max-width: 150px;
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }
</style>

</html>