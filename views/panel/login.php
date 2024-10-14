<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script>
    function validateForm() {
      var user_name = document.querySelector('#user_name').value;
      var password = document.querySelector('#password').value;

      if (user_name == '' || password == '') {
        alert('Please enter all the data');
        return false;
      } else {
        return true;
      }
    }

    function validateRegisterForm() {
      var user_name = document.querySelector('#register_user_name').value;
      var password = document.querySelector('#register_password').value;
      var confirm_password = document.querySelector('#confirm_password').value;

      if (user_name == '' || password == '' || confirm_password == '') {
        alert('Please enter all the data');
        return false;
      }

      if (password !== confirm_password) {
        alert('Passwords do not match');
        return false;
      }

      return true;
    }
  </script>
</head>

<body>

  <?php
  @session_start();
  $error = isset($_GET['error']) ? intval($_GET['error']) : 0;
  $action = isset($_GET['action']) && $_GET['action'] == 'register' ? 'register' : 'login';
  ?>

  <div id="login-form">
    <?php if ($action == 'login') { ?>
      <h1>Login</h1>
      <form action="../../controllers/login_controllers.php" method="POST" onsubmit="return validateForm()">
        <div class="mb-3">
          <label for="user_name" class="form-label">UserName</label>
          <input type="text" name="user_name" id="user_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <input type="submit" id="submit" class="btn btn-primary" value="Login">
      </form>
      <a href="?action=register" id="login-link">Don't have an account? Sign up</a>
    <?php } else { ?>
      <h1>Register</h1>
      <form action="../../controllers/login_controllers.php" method="POST" onsubmit="return validateRegisterForm()">
        <div class="mb-3">
          <label for="register_user_name" class="form-label">UserName</label>
          <input type="text" name="user_name" id="register_user_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="register_age" class="form-label">Age</label>
          <input type="number" name="age" id="register_age" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="register_password" class="form-label">Password</label>
          <input type="password" name="password" id="register_password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
        </div>
        <input type="hidden" name="method" value="NEW">
        <input type="submit" id="submit" class="btn btn-success" value="Registrarse">
      </form>
      <a href="?action=login" id="login-link">Already have an account? Login</a>
    <?php } ?>

    <?php if ($error) { ?>
      <div class="alert alert-danger" role="alert">
        Incorrect data, please try again.
      </div>
    <?php } ?>
  </div>

</body>

</html>

<style>
  body {
    background-color: #a3b18a;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  #login-form {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
  }

  #login-form h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  .form-label {
    font-weight: bold;
    color: #555;
  }

  .form-control {
    border-radius: 5px;
    margin-bottom: 15px;
  }

  #submit {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    background-color: darkslategray;
    color: white;
    font-weight: bold;
    border: none;
    cursor: pointer;
  }

  #submit:hover {
    background-color: darkcyan;
  }

  #login-link {
    display: block;
    text-align: center;
    margin-top: 10px;
    color: darkslateblue;
  }

  #login-link:hover {
    text-decoration: underline;
  }

  .alert {
    margin-top: 10px;
    text-align: center;
  }
</style>