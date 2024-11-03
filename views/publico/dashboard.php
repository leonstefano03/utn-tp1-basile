<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include_once('/xampp/htdocs/tp1/controllers/categorias.php');
  $categorias = $nuestroResultado;

  include_once('/xampp/htdocs/tp1/controllers/noticias.php');

  $categoriaSeleccionada = isset($_GET['id_categoria']) ? intval($_GET['id_categoria']) : 0;
  $searchInput = isset($_GET['searchInput']) ? $_GET['searchInput'] : '';

  $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
  $limit = 6;
  $offset = ($pagina_actual - 1) * $limit;

  if ($categoriaSeleccionada > 0) {
    $allNoticias = obtenerNoticias($conx, $limit, $offset, $categoriaSeleccionada, '');
    $total_noticias = obtenerTotalNoticias($conx, $categoriaSeleccionada, '');
  } else {
    $allNoticias = obtenerNoticias($conx, $limit, $offset, 0, '');
    $total_noticias = obtenerTotalNoticias($conx, 0, '');
  }

  if ($searchInput != '') {
    $allNoticias = obtenerNoticias($conx, $limit, $offset, $categoriaSeleccionada, $searchInput);
    $total_noticias = obtenerTotalNoticias($conx, 0,  $searchInput);
  }

  $total_paginas = ceil($total_noticias / $limit);
  ?>


  <div class="container mt-5">
    <div class="contain-title">
      <h1 class="text-center mb-1">News UTN</h1>
      <div class="selections d-flex justify-content-around">
        <form id="cont-button-table-new" class=" d-flex" role="search">
          <input class="form-control me-2" type="search" name="searchInput" placeholder="Search New" aria-label="Search" onchange="this.form.submit()">
          <input type="hidden" name="id_categoria" value="<?php echo $categoriaSeleccionada; ?>">
        </form>
        <div id="cont-button-table-new" class=" d-flex justify-content-end">
          <form action="" method="GET" class="category-select ">
            <div class="form-group d-flex ">

              <label for="categoria" class="form-label text-black">Select Category:</label>
              <select name="id_categoria" id="categoria" class="form-select" onchange="this.form.submit()">
                <option value="0">All Categories</option>
                <?php foreach ($categorias as $categoria) { ?>
                  <option value="<?php echo $categoria->id; ?>" <?php echo ($categoria->id == $categoriaSeleccionada) ? 'selected' : ''; ?>>
                    <?php echo $categoria->nombre; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="contain-cards">

      <div class="row">
        <?php if (!empty($allNoticias)) { ?>
          <?php foreach ($allNoticias as $noticia) { ?>
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <img src="../../<?php echo $noticia->image; ?>" class="card-img-top mb-2" alt="<?php echo $noticia->title; ?>">

                  <h5 class="card-title"><?php echo $noticia->title; ?></h5>
                  <p class="card-text"><?php echo $noticia->description; ?></p>
                  <p class="card-text"><small class="text-muted">Category: <?php echo $noticia->nombre_categoria; ?></small></p>
                  <p class="card-text"><small class="text-muted">Date: <?php echo $noticia->creation_date; ?></small></p>

                  <form action="noticia_detalle.php" method="POST" style="display:flex; justify-content: flex-end;">
                    <input type="hidden" name="id" value="<?php echo $noticia->id ?>">
                    <input type="hidden" name="searchInput" value="<?php echo $searchInput; ?>">
                    <input type="hidden" name="pagina" value="<?php echo $pagina_actual; ?>">
                    <input type="hidden" name="id_categoria" value="<?php echo $categoriaSeleccionada; ?>">
                    <button type="submit" class="btn ">Read More</button>
                  </form>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>
          <p>No news available for the selected category.</p>
        <?php } ?>
      </div>
      <!-- Paginación -->
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <!-- Botón de Anterior -->
          <?php if ($pagina_actual > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?pagina=<?php echo $pagina_actual - 1 ?>&id_categoria=<?php echo $categoriaSeleccionada; ?>&searchInput=<?php echo $searchInput; ?>">Anterior</a>
            </li>
          <?php endif; ?>

          <!-- Botones de número de página -->
          <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <li class="page-item <?php if ($pagina_actual == $i) echo 'active'; ?>">
              <a class="page-link" href="?pagina=<?php echo $i; ?>&id_categoria=<?php echo $categoriaSeleccionada; ?>&searchInput=<?php echo $searchInput; ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>

          <!-- Botón de Siguiente -->
          <?php if ($pagina_actual < $total_paginas): ?>
            <li class="page-item">
              <a class="page-link" href="?pagina=<?php echo $pagina_actual + 1; ?>&id_categoria=<?php echo $categoriaSeleccionada; ?>&searchInput=<?php echo $searchInput; ?>">Siguiente</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>

    </div>
  </div>
</body>

</html>
<style>
  body {
    background-color: #606c38;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    height: 100vh;
  }

  .container {
    background-color: #a3b18a;
    border-radius: 5px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    padding-left: 10px;
    padding-right: 10px;
    padding-bottom: 20px;
  }

  .contain-title {
    position: sticky;
    top: 0;
    z-index: 1;
    padding-top: 20px;
  }

  .contain-cards {
    padding-top: 10px;
    height: 80vh;
    flex-grow: 1;
    padding-left: 10px;
    padding-right: 10px;
    overflow: auto;
  }

  .card {
    border: none;
    transition: transform 0.2s;
    width: 100%;
    height: 530px;
    margin-bottom: 20px;
    background-color: hite;
  }

  img {
    width: 200px;
    height: 300px;
    object-fit: cover;
  }

  .card:hover {
    transform: scale(1.02);
  }

  .category-select {
    float: right;
  }

  .form-label {
    margin: auto;
    padding-right: 10px;
    color: black;
    font-weight: 550;
  }

  .btn {
    text-decoration: none;
    color: white;
    background-color: darkslategray;
  }

  .btn:hover {
    background-color: #588157;
    color: white;

  }

  #categoria {
    color: white;
    background-color: darkslategray;
    border: 0;
    width: 150px;
  }

  #categoria:hover {
    background-color: #588157;
  }

  #cont-button-table-new {
    height: 40px;
  }
</style>