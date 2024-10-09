<?php
require_once('../db/db.php');

$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


$stmt = $conx->prepare('SELECT * from usuarios WHERE user_name = ? AND password = ?');

$stmt->bind_param('ss', $user_name, $password);

$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$nuestroResultado = $resultadoSTMT->fetch_object();

$stmt->close();

if ($resultadoSTMT->num_rows > 0) {
  @session_start();
  $_SESSION["id"] = $nuestroResultado->id;
  header('Location: ../views/panel/noticias.php');
  exit;
} else {
  header('Location: ../views/panel/login.php?error=1');
  exit;
}
