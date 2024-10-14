<?php
require_once('../db/db.php');

$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$method = isset($_POST['method']) ? $_POST['method'] : '';
$adminUser = isset($_POST['adminUser']) ? $_POST['adminUser'] : 0;
$age = isset($_POST['age']) ? intval($_POST['age']) : 0;
$creation_date = isset($_POST['creation_date']) && !empty($_POST['creation_date']) ? $_POST['creation_date'] : date('Y-m-d H:i:s');


if ($method == 'NEW') {

  $stmt = $conx->prepare('INSERT INTO usuarios (user_name, password, age, creation_date, admin) VALUES (?,?,?,?,?)');

  $stmt->bind_param('ssiss', $user_name, $password, $age, $creation_date, $adminUser);

  if ($stmt->execute()) {
    @session_start();
    $_SESSION["id"] = $nuestroResultado->id;
    $_SESSION["is_admin"] = $nuestroResultado->admin;
    header('Location: ../views/panel/noticias.php');
    exit;
  } else {
    echo 'Error al insertar el registro: ' . $stmt->error;
    header('Location: ../views/panel/login.php?error=1');
  }

  $stmt->close();
};


$stmt = $conx->prepare('SELECT * from usuarios WHERE user_name = ? AND password = ?');

$stmt->bind_param('ss', $user_name, $password);

$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$nuestroResultado = $resultadoSTMT->fetch_object();

$stmt->close();

if ($resultadoSTMT->num_rows > 0) {
  @session_start();
  $_SESSION["id"] = $nuestroResultado->id;
  $_SESSION["is_admin"] = $nuestroResultado->admin;
  header('Location: ../views/panel/noticias.php');
  exit;
} else {
  header('Location: ../views/panel/login.php?error=1');
  exit;
}
