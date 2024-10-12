<?php
@session_start();
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
  header('Location: /tp1/views/panel/login.php');
  exit;
}
