<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=[device-width], initial-scale=1.0">
  <title>Document</title>
  <script>
    function validateForm() {
      var user_name = document.querySelector('#user_name').value
      var password = document.querySelector('#password').value

      if (user_name == '' || password == '') {
        alert('Ingrese todos los datos')
        return false
      } else {
        return true
      }
    }
  </script>
</head>

<body>

  <?php
  @session_start();
  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;
  ?>


  <h1>Login</h1>
  <form action="../../controllers/login_controllers.php" method="POST" onsubmit="return validateForm()">
    <label for="user_name">user name:</label>
    <input type="user_name" name="user_name" id="user_name">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <input type="submit" id="submit">
  </form>
  <a href="usuario_edit.php">
    registrarse
  </a>
  <?php
  if ($error) { ?>
    <h1>Datos incorrectos, intentelo nuevamente.</h1>
  <?php  } ?>

</body>

</html>