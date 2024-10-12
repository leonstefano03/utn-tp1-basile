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
    <h1>Error al cargar los datos, inténtelo nuevamente.</h1>
  <?php } ?>

  <div id="menu">
    <div id="cont-title">
      <h1>Panel UTN</h1>
    </div>
    <div id="lista-acciones">
      <ul>
        <li><a href="noticias.php" id="link-noticias">Noticias</a></li>
        <li><a href="categorias.php" id="link-categorias">Categorías</a></li>
        <li><a href="usuarios.php" id="link-usuarios">Usuarios</a></li>
      </ul>
    </div>
  </div>
  <div id="table">
    <h2>noticias</h2>

    <div id="cont-button-table-new">
      <form action="noticias_edit.php">
        <input id="button-table-new" type="submit" value="Agregar una noticia">
      </form>
    </div>
    <br>

    <div id="cont-info-table">
      <div id="info-table">

        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Titulo</th>
              <th>Texto</th>
              <th>Fecha de creacion</th>
              <th>Imagen</th>
              <th>Descripcion</th>
              <th>categoria</th>
              <th>usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($nuestroResultado as $fila) { ?>
              <tr>
                <td> <?php echo $fila->id ?></td>
                <td><?php echo $fila->title ?></td>
                <td><?php echo $fila->text  ?></td>
                <td><?php echo $fila->creation_date ?></td>
                <td><?php echo $fila->image ?></td>
                <td><?php echo $fila->description ?></td>
                <td><?php echo $fila->nombre_categoria ?></td>
                <td><?php echo $fila->nombre_usuario ?></td>
                <td>
                  <a href="noticias_edit.php?id=<?php echo $fila->id ?>">editar
                  </a>
                  <a href="../../controllers/noticias.php?method=DELETE&id=<?php echo $fila->id ?>">eliminar
                  </a>
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
    background-color: antiquewhite;
    display: flex
  }

  #menu {
    width: 20%;
    height: 100%;
    background-color: gray;
  }

  #cont-title {
    width: 100%;
    height: 20%;
    background-color: teal;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .btn2 {
    background-color: red;
  }

  #cont-title h1 {
    font-size: 30px;
  }

  #table {
    width: 80%;
    height: 100%;
    background-color: burlywood;
    display: flex;
    flex-direction: column;
  }

  #cont-button-table-new {
    width: 100%;
    height: 15%;
    display: flex;
    justify-content: flex-end;
    align-items: center;
  }

  #button-table-new {
    width: 150px;
    height: 40px;
    margin-right: 50px;
    border-radius: 5px;
    border: 1px solid white;
  }

  #cont-info-table {
    width: 100%;
    height: 85%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #info-table {
    width: 700px;
    height: 500px;
    background-color: azure;
  }
</style>

</html>