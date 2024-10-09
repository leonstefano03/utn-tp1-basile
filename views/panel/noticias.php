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

  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;

  $submitForm = isset($_POST['hidden']) ? intval($_POST['hidden']) : 0;

  if ($submitForm) {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $text = isset($_POST['text']) ? $_POST['text'] : '';
    $image = isset($_POST['image']) ? $_POST['image'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $creation_date = isset($_POST['creation_date']) && !empty($_POST['creation_date']) ? $_POST['creation_date'] : date('Y-m-d H:i:s');

    $stmt = $conx->prepare('INSERT INTO noticias (title, description, creation_date, text, image, id_usuario) VALUES (?,?,?,?,?,?)');
    $stmt->bind_param('sssssi', $title, $description, $creation_date, $text, $image, $_SESSION['id']);

    if ($stmt->execute()) {
      header('Location: noticias.php');
      exit;
    } else {
      echo 'Error al insertar el registro: ' . $stmt->error;
      header('Location: ../panel/noticias.php?error=1');
      exit();
    }

    $stmt->close();
  };
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
    <h2>Ingrese una noticia</h2>
    <div id="cont-info-table">
      <div id="info-table">
        <form action="" method="POST">
          <input type="text" name='title' placeholder="Ingrese el titulo de la noticia" required> <br>
          <input type="text" name='description' placeholder="Ingrese la descripcion de la noticia" required> <br>
          <input type="text" name='image' placeholder="Ingrese la imagen de la noticia" required> <br>
          <textarea name="text" id="text" required></textarea><br>
          <input type="hidden" name="hidden" value="1">
          <input type="submit" value="crear noticia"> <br>
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