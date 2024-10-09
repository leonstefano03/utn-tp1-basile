<?php
require_once('../db/db.php');

$submitForm = isset($_POST['hidden']) ? intval($_POST['hidden']) : 0;
$edit = isset($_GET['edit']) ? intval($_GET['edit']) : 0;
$delete = isset($_GET['delete']) ? intval($_GET['delete']) : 0;
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$age = isset($_POST['age']) ? intval($_POST['age']) : 0;
$creation_date = isset($_POST['creation_date']) && !empty($_POST['creation_date']) ? $_POST['creation_date'] : date('Y-m-d H:i:s');

if ($submitForm && $edit == 0) {

  $stmt = $conx->prepare('INSERT INTO usuarios (user_name, password, age, creation_date) VALUES (?,?,?,?)');

  $stmt->bind_param('ssis', $name, $password, $age, $creation_date);

  if ($stmt->execute()) {
    header('Location: ../views/panel/noticias.php');
    exit;
  } else {
    echo 'Error al insertar el registro: ' . $stmt->error;
    header('Location: ../views/panel/userRegister.php?error=1');
  }

  $stmt->close();
};

if ($delete) {
  $stmt = $conx->prepare('DELETE FROM usuarios WHERE id = ?');

  $stmt->bind_param('i', $id);

  if ($stmt->execute()) {
    header('Location: ../views/panel/listado.php');
    exit;
  } else {
    echo 'Error al eliminar el registro: ' . $stmt->error;
  }

  $stmt->close();  // Cerramos la declaración preparada
}

if ($submitForm && $edit) {

  $stmt = $conx->prepare('UPDATE usuarios SET user_name = ?, age = ?, creation_date = ? WHERE id = ?');

  $stmt->bind_param('sisi', $name, $age, $creation_date, $id);
  if ($stmt->execute()) {
    header('Location: ../views/panel/listado.php');

    exit;
  } else {
    echo 'Error al editar el registro: ' . $stmt->error;
  }

  $stmt->close();  // Cerramos la declaración preparada
}
