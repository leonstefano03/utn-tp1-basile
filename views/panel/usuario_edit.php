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
  include_once('../../controllers/user.php');
  @session_start();
  $admin = isset($_SESSION["is_admin"]) ? intval($_SESSION["is_admin"]) : 0;

  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;

  ?>


  <div id="menu">
    <div id="cont-title">
      <h1>Panel UTN</h1>
    </div>
    <div id="lista-acciones">
      <ul>
        <li><a href="noticias.php" id="link-noticias">Noticias</a></li>
        <li><a href="categorias.php" id="link-categorias">Categorías</a></li>
        <?php if ($admin) { ?>
          <li><a href="usuarios.php" id="link-usuarios">Usuarios</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div id="table">
    <h2>usuarios</h2>

    <br>


    <div id="cont-info-table">
      <div id="info-table">
        <form action="../../controllers/user.php">

          <input type="text" name='user_name' placeholder="Ingrese el user name" value="<?php echo $user_name; ?>" required> <br>
          <input type="number" name="age" placeholder="Ingrese la age" value="<?php echo $age; ?>" required> <br>
          <input type="password" name="password" placeholder="ingrese su contraseña" value="<?php echo $password; ?>" required> <br>
          <input type="number" name='admin' placeholder="Es admin" value="<?php echo $adminUser; ?>" required> <br>
          <?php if ($id == 0) { ?>
            <input type="datetime-local" name="creation_date"> <br>
          <?php } else { ?>
            <input type="hidden" name="creation_date" value="<?php echo $creation_date ?>"> <br>
          <?php } ?>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="hidden" value="1">
          <?php if ($id == 0) { ?>
            <input type="hidden" name="method" value="NEW">
          <?php } else { ?>
            <input type="hidden" name="method" value="EDIT">
          <?php } ?>

          <input type="submit"> <br>
        </form>

        <?php
        if ($error) { ?>
          <h1>Error al cargar los datos, inténtelo nuevamente.</h1>
        <?php } ?>
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