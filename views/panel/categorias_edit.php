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


  $admin = isset($_SESSION["is_admin"]) ? intval($_SESSION["is_admin"]) : 0;
  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;
  $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

  if ($id) {
    include_once('../../db/db.php');

    $stmt = $conx->prepare("SELECT * FROM categorias WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultadoSTMT = $stmt->get_result();
    $fila  = $resultadoSTMT->fetch_object();
    $stmt->close();
  }

  $nombre = isset($fila->nombre) ? $fila->nombre : '';
  ?>

  <?php if ($error) { ?>
    <div class="alert alert-danger" role="alert">
      Error loading data, please try again.
    </div>
  <?php } ?>

  <?php include_once('/xampp/htdocs/tp1/views/common/menu.php') ?>

  <div id="table" class="container mt-5" style="width: 80%;">
    <h2 class="text-center mb-4"><?= $id ? 'EDIT CATEGORY' : 'ADD CATEGORY' ?></h2>
    <div id="cont-info-table" class="d-flex justify-content-center">
      <div id="info-table" class="p-4 rounded shadow bg-white" style="width: 55%;">
        <form action="../../controllers/categorias.php" method="GET">
          <input type="hidden" name="id" value="<?php echo $id; ?>">

          <div class="mb-3">
            <label for="nombre" class="form-label">Category Name</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Enter the category name" value="<?php echo $nombre; ?>" required>
          </div>

          <input type="hidden" name="hidden" value="1">
          <input type="hidden" name="method" value="<?= $id ? 'EDIT' : 'NEW' ?>">

          <button type="submit" class="btn w-100 text-white bg-teal">
            <?= $id ? 'Edit Category' : 'Create Category' ?>
          </button>
        </form>
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
</style>

</html>