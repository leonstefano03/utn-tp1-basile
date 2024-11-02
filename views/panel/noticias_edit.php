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

  require_once('../../db/db.php');

  include_once('/xampp/htdocs/tp1/controllers/categorias.php');
  $categorias = $nuestroResultado;

  include_once('../../controllers/noticias.php');
  @session_start();
  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;
  ?>
  <?php if ($error) { ?>
    <div class="alert alert-danger" role="alert">
      Error loading data, please try again.
    </div>
  <?php } ?>

  <?php include_once('/xampp/htdocs/tp1/views/common/menu.php') ?>

  <div id="table" class="container mt-5" style="width: 80%;">
    <?php if ($id != 0) { ?>
      <h2 class="text-center mb-4">EDIT NEWS</h2>
    <?php } else { ?>
      <h2 class="text-center mb-4">ENTER A NEWS</h2>
    <?php } ?>
    <div id="cont-info-table" class="d-flex justify-content-center">
      <div id="info-table" class="p-4 rounded shadow bg-white" style="width: 75%;">

        <form action="../../controllers/noticias.php" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="title" class="form-label">News Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter the news title" value="<?php echo $title ?>" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Enter the description" value="<?php echo $description ?>" required>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" value="<?php echo $image; ?>" required>
          </div>

          <div class="mb-3">
            <label for="text" class="form-label">News Text</label>
            <textarea name="text" id="text" class="form-control" rows="5" placeholder="Write the text here..." required><?php echo $text ?></textarea>
          </div>

          <div class="mb-3">
            <label for="id_categoria" class="form-label">Category</label>
            <select name="id_categoria" id="id_categoria" class="form-select">
              <?php if (!empty($categorias)) : ?>
                <?php foreach ($categorias as $categoria) : ?>
                  <option value="<?= $categoria->id; ?>" <?= ($categoria->id == $id_categoria) ? 'selected' : ''; ?>>
                    <?= $categoria->nombre; ?>
                  </option>
                <?php endforeach; ?>
              <?php else : ?>
                <option value="">No categories available</option>
              <?php endif; ?>
            </select>
          </div>

          <?php if ($id != 0) { ?>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
            <input type="hidden" name="method" value="EDIT">
            <button type="submit" class="btn w-100 text-white bg-teal">Edit News</button>
          <?php } else { ?>
            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id'] ?>">
            <input type="hidden" name="method" value="NEW">
            <button type="submit" class="btn w-100 text-white bg-teal">Create News</button>
          <?php } ?>
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