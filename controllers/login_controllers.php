<?php
require_once('../db/db.php');

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


$stmt = $conx->prepare('SELECT * from admin WHERE email = ? AND password = ?');

$stmt->bind_param('ss', $email, $password);

$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$nuestroResultado = $resultadoSTMT->fetch_object();

$stmt->close();

if ($resultadoSTMT->num_rows > 0) {
  @session_start();
  $_SESSION["id"] = $nuestroResultado->id;
  header('Location: ../views/panel/listado.php');
  exit;
} else {
  header('Location: ../views/panel/login.php?error=1');
  exit;
}
