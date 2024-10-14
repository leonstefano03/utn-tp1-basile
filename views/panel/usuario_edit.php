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
  include_once('/xampp/htdocs/tp1/controllers/sessionValidate.php');

  $admin = isset($_SESSION["is_admin"]) ? intval($_SESSION["is_admin"]) : 0;
  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;
  ?>

  <?php include_once('/xampp/htdocs/tp1/views/common/menu.php') ?>

  <div id="table" class="container mt-5" style="width: 80%;">
    <h2 class="text-center mb-4"><?= $id == 0 ? 'ADD USER' : 'EDIT USER' ?></h2>

    <div id="cont-info-table" class="d-flex justify-content-center">
      <div id="info-table" class="p-4 rounded shadow bg-white" style="width: 70%;">
        <form action="../../controllers/user.php" method="GET">
          <div class="mb-3">
            <label for="user_name" class="form-label">Username</label>
            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter the username" value="<?php echo $user_name; ?>" required>
          </div>

          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" name="age" id="age" class="form-control" placeholder="Enter age" value="<?php echo $age; ?>" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" value="<?php echo $password; ?>" required>
          </div>

          <div class="mb-3">
            <label for="admin" class="form-label">Admin</label>
            <input type="number" name="admin" id="admin" class="form-control" placeholder="Is admin (1 or 0)" value="<?php echo $adminUser; ?>" required>
          </div>

          <?php if ($id == 0) { ?>
            <div class="mb-3">
              <label for="creation_date" class="form-label">Creation Date</label>
              <input type="datetime-local" name="creation_date" id="creation_date" class="form-control">
            </div>
          <?php } else { ?>
            <input type="hidden" name="creation_date" value="<?php echo $creation_date; ?>">
          <?php } ?>

          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="hidden" value="1">
          <input type="hidden" name="method" value="<?= $id == 0 ? 'NEW' : 'EDIT' ?>">

          <button type="submit" class="btn w-100 text-white bg-teal">
            <?= $id == 0 ? 'Create User' : 'Edit User' ?>
          </button>
        </form>

        <?php if ($error) { ?>
          <div class="alert alert-danger mt-3" role="alert">
            Error loading data, please try again.
          </div>
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