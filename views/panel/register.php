<?php
@session_start(); //el @ es para que si algo te va a tirar error que no importa en nada, simplemetne no lo muestra
require_once('../db/db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<form action="" method="post">
  <input type="text" name='name' placeholder="ingrese su nombre"> <br>
  <input type="password" name="password" placeholder="ingrese su contraseña"> <br>
  <input type="number" name="age" placeholder="ingrese su edad"> <br>
  <!-- <input type="datetime-local" name="creation_date"> <br> -->
  <textarea name="description" placeholder="ingrese su descripcion"></textarea> <br>
  <input type="hidden" name="hidden" value="1">
  <input type="submit"> <br>
</form>

<?php
$submitForm = isset($_POST['hidden']) ? intval($_POST['hidden']) : 0;
if ($submitForm) {

  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $age = isset($_POST['age']) ? $_POST['age'] : 0;
  $description = isset($_POST['description']) ? $_POST['description'] : '';
  // $creation_date = isset($_POST['creation_date']) && !empty($_POST['creation_date']) ? $_POST['creation_date'] : date('Y-m-d H:i:s');

  if ($name == '' || $password == '') {
    echo 'error, complete todos los datos';
    exit;
  }

  $stmt = $conx->prepare('INSERT INTO usuarios (user_name, password, age, description) VALUES (?,?,?,?)');

  $stmt->bind_param('ssis', $name, $password, $age, $description);

  if ($stmt->execute()) {
    $_SESSION['name'] = $name;
    $_SESSION['age'] = $age;
    $_SESSION['description'] = $description;

    header('Location: private.php');
    exit;
  } else {
    echo 'Error al insertar el registro: ' . $stmt->error;
    // header('Location: register.php?error=1');
  }
}
?>