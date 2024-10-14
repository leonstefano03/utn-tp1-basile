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

  include_once('/xampp/htdocs/tp1/controllers/user.php');
  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;

  ?>
  <?php
  if ($error) { ?>
    <div class="alert alert-danger" role="alert">
      Error loading data, please try again.
    </div>
  <?php } ?>

  <?php include_once('/xampp/htdocs/tp1/views/common/menu.php') ?>

  <div id="table" class="container mt-5" style="width: 80%;">
    <h2 class="text-center mb-4">USERS</h2>

    <div id="cont-button-table-new" class="mb-4 d-flex justify-content-end">
      <form action="usuario_edit.php">
        <button id="button-table-new" type="submit" class="btn text-white bg-teal">Add User</button>
      </form>
    </div>

    <div id="cont-info-table" class="d-flex justify-content-center">
      <div id="info-table" class="p-4 rounded shadow bg-white" style="width: 70%;">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Creation Date</th>
                <th>Password</th>
                <th>Admin</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($nuestroResultado as $fila) { ?>
                <tr>
                  <td><?php echo $fila->id ?></td>
                  <td><?php echo $fila->user_name ?></td>
                  <td><?php echo $fila->age ?></td>
                  <td><?php echo $fila->creation_date ?></td>
                  <td><?php echo $fila->password ?></td>
                  <td><?php echo $fila->admin ?></td>
                  <td>
                    <a href="usuario_edit.php?id=<?php echo $fila->id ?>" class="text-decoration-none text-teal">edit</a>
                    <a href="../../controllers/user.php?method=DELETE&id=<?php echo $fila->id ?>" class="text-decoration-none text-danger">delete</a>
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