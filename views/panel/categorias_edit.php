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
  <?php
  if ($error) { ?>
    <h1>Error al cargar los datos, inténtelo nuevamente.</h1>
  <?php } ?>


  <?php include_once('/xampp/htdocs/tp1/views/common/menu.php') ?>

  <div id="table">
    <h2>AGREGAR CATEGORIA</h2>
    <br>
    <div id="cont-info-table">
      <div id="info-table">

        <form action="../../controllers/categorias.php">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="text" name='nombre' placeholder="Ingrese el nombre de la categoria" value="<?php echo $nombre; ?>" required> <br>
          <input type="hidden" name="hidden" value="1">
          <?php if ($id) { ?>

            <input type="hidden" name="method" value="EDIT">


          <?php   } else { ?>


            <input type="hidden" name="method" value="NEW">

          <?php   } ?>

          <input type="submit"> <br>
        </form>
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


  .btn2 {
    background-color: red;
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