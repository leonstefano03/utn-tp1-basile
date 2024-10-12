<?php
require_once('/xampp/htdocs/tp1/db/db.php');

$method = isset($_POST['method']) ? $_POST['method'] : '';
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$age = isset($_POST['age']) ? intval($_POST['age']) : 0;
$creation_date = '';

if ($method == 'NEW') {

  $creation_date = isset($_POST['creation_date']) && !empty($_POST['creation_date']) ? $_POST['creation_date'] : date('Y-m-d H:i:s');

  $stmt = $conx->prepare('INSERT INTO usuarios (user_name, password, age, creation_date) VALUES (?,?,?,?)');

  $stmt->bind_param('ssis', $user_name, $password, $age, $creation_date);

  if ($stmt->execute()) {
    header('Location: ../views/panel/usuarios.php');
    exit;
  } else {
    echo 'Error al insertar el registro: ' . $stmt->error;
    header('Location: ../views/panel/usuario_edit.php?error=1');
  }

  $stmt->close();
};

if ($method == 'DELETE') {
  $stmt = $conx->prepare('DELETE FROM usuarios WHERE id = ?');

  $stmt->bind_param('i', $id);

  if ($stmt->execute()) {
    header('Location: ../views/panel/usuarios.php');
    exit;
  } else {
    echo 'Error al eliminar el registro: ' . $stmt->error;
  }

  $stmt->close();  // Cerramos la declaración preparada
}

if ($method == 'EDIT') {
  $creation_date = isset($_POST['creation_date']) && !empty($_POST['creation_date']) ? $_POST['creation_date'] : date('Y-m-d H:i:s');

  $stmt = $conx->prepare('UPDATE usuarios SET user_name = ?, age = ?, creation_date = ? WHERE id = ?');

  $stmt->bind_param('sisi', $name, $age, $creation_date, $id);
  if ($stmt->execute()) {
    header('Location: ../views/panel/usuarios.php');

    exit;
  } else {
    echo 'Error al editar el registro: ' . $stmt->error;
  }

  $stmt->close();  // Cerramos la declaración preparada
}

if ($id != 0) {

  $sql = "SELECT * FROM usuarios WHERE id = ? ";

  $stmt = $conx->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $resultado = $stmt->get_result();

  $usuario = $resultado->fetch_object();

  $stmt->close();
}
