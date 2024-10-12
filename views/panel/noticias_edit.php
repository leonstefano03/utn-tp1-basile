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
  require_once('../../db/db.php');

  include_once('/xampp/htdocs/tp1/controllers/categorias.php');
  $categorias = $nuestroResultado;

  include_once('../../controllers/noticias.php');
  @session_start();

  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;
  ?>
  <?php if ($error) { ?>
    <div class="alert alert-danger" role="alert">
      Error al cargar los datos, inténtelo nuevamente.
    </div>
  <?php } ?>

  <?php include_once('/xampp/htdocs/tp1/views/common/menu.php') ?>

  <div id="table" class="container mt-5" style="width: 80%;">
    <div id="cont-info-table" class="d-flex justify-content-center">
      <div id="info-table" class="p-4 rounded shadow bg-white" style="width: 700px;">
        <?php if ($id != 0) { ?>
          <h2 class="text-center mb-4">EDITAR NOTICIA</h2>
        <?php } else { ?>
          <h2 class="text-center mb-4">INGRESE UNA NOTICIA</h2>
        <?php } ?>
        <form action="../../controllers/noticias.php" method="GET">

          <div class="mb-3">
            <label for="title" class="form-label">Título de la noticia</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Ingrese el título de la noticia" value="<?php echo $title ?>" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Ingrese la descripción" value="<?php echo $description ?>" required>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="text" name="image" id="image" class="form-control" placeholder="Ingrese la URL de la imagen" value="<?php echo $image ?>" required>
          </div>

          <div class="mb-3">
            <label for="text" class="form-label">Texto de la noticia</label>
            <textarea name="text" id="text" class="form-control" rows="5" placeholder="Escriba el texto aquí..." required><?php echo $text ?></textarea>
          </div>

          <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select name="id_categoria" id="id_categoria" class="form-select">
              <?php if (!empty($categorias)) : ?>
                <?php foreach ($categorias as $categoria) : ?>
                  <option value="<?= $categoria->id; ?>" <?= ($categoria->id == $id_categoria) ? 'selected' : ''; ?>>
                    <?= $categoria->nombre; ?>
                  </option>
                <?php endforeach; ?>
              <?php else : ?>
                <option value="">No hay categorías disponibles</option>
              <?php endif; ?>
            </select>
          </div>

          <?php if ($id != 0) { ?>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
            <input type="hidden" name="method" value="EDIT">
            <button type="submit" class="btn w-100 text-white bg-teal">Editar Noticia</button>
          <?php } else { ?>
            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id'] ?>">
            <input type="hidden" name="method" value="NEW">
            <button type="submit" class="btn w-100 text-white bg-teal">Crear Noticia</button>
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
    background-color: burlywood;
    display: flex;
  }

  .bg-teal {
    background-color: darkslategray;
  }

  .bg-teal:hover {
    background-color: darkcyan;
  }
</style>

</html>