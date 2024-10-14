<?php
require_once('/xampp/htdocs/tp1/db/db.php');

$admin = isset($_SESSION["is_admin"]) ? intval($_SESSION["is_admin"]) : 0;
$submitForm = isset($_GET['hidden']) ? intval($_GET['hidden']) : 0;
$method = isset($_GET['method']) ? $_GET['method'] : '';
$id = isset($_GET['id']) ? ($_GET['id']) : 0;
$user_name = isset($_GET['user_name']) ? $_GET['user_name'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';
$adminUser = isset($_GET['adminUser']) ? $_GET['adminUser'] : 0;
$age = isset($_GET['age']) ? intval($_GET['age']) : 0;
$creation_date = '';


if ($id == 0) {
  $stmt = $conx->prepare("SELECT * FROM usuarios");

  $stmt->execute();

  $resultadoSTMT = $stmt->get_result();

  $nuestroResultado = [];

  while ($fila  = $resultadoSTMT->fetch_object()) {
    $nuestroResultado[] = $fila;
  }

  $stmt->close();
}




if ($method == 'NEW') {


  $creation_date = isset($_GET['creation_date']) && !empty($_GET['creation_date']) ? $_GET['creation_date'] : date('Y-m-d H:i:s');

  $stmt = $conx->prepare('INSERT INTO usuarios (user_name, password, age, creation_date, admin) VALUES (?,?,?,?,?)');

  $stmt->bind_param('ssiss', $user_name, $password, $age, $creation_date, $adminUser);

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

  $creation_date = isset($_GET['creation_date']) && !empty($_GET['creation_date']) ? $_GET['creation_date'] : date('Y-m-d H:i:s');

  $stmt = $conx->prepare('UPDATE usuarios SET user_name = ?, age = ?, creation_date = ?, password = ?, admin = ? WHERE id = ?');

  $stmt->bind_param('sissi', $user_name, $age, $creation_date, $password, $adminUser, $id,);
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


  if ($stmt->execute()) {
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_object();
    $stmt->close();
    $id = $usuario->id;
    $user_name = $usuario->user_name;
    $creation_date = $usuario->creation_date;
    $age = $usuario->age;
    $password = $usuario->password;
    $adminUser = $usuario->admin;
  }
}
