<?php
require_once('/xampp/htdocs/tp1/db/db.php');

$submitForm = isset($_POST['hidden']) ? intval($_POST['hidden']) : 0;
$method = isset($_GET['method']) ? $_GET['method'] : '';
$id = isset($_GET['id']) ? ($_GET['id']) : 0;
$name = isset($_GET['nombre']) ? $_GET['nombre'] : '';


$stmt = $conx->prepare("SELECT * FROM categorias");

$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$nuestroResultado = [];

while ($fila  = $resultadoSTMT->fetch_object()) {
  $nuestroResultado[] = $fila;
}

$stmt->close();


if ($method == 'NEW') {

  $stmt = $conx->prepare('INSERT INTO categorias (nombre) VALUES (?)');

  $stmt->bind_param('s', $name);

  if ($stmt->execute()) {
    header('Location: ../views/panel/categorias.php');
    exit;
  } else {
    echo 'Error al insertar el registro: ' . $stmt->error;
    header('Location: ../views/panel/categorias_edit.php?error=1');
  }

  $stmt->close();
};

if ($method == 'DELETE') {

  $stmt = $conx->prepare('DELETE FROM categorias WHERE id = ?');

  $stmt->bind_param('i', $id);

  if ($stmt->execute()) {
    header('Location: ../views/panel/categorias.php');
    exit;
  } else {
    echo 'Error al eliminar el registro: ' . $stmt->error;
    header('Location: ../views/panel/categorias.php?error=1');
    exit;
  }

  $stmt->close();  // Cerramos la declaración preparada
}

if ($method == 'EDIT') {

  $stmt = $conx->prepare('UPDATE categorias SET nombre = ? WHERE id = ?');

  $stmt->bind_param('si', $name, $id);
  if ($stmt->execute()) {
    header('Location: ../views/panel/categorias.php');

    exit;
  } else {
    echo 'Error al editar el registro: ' . $stmt->error;
    header('Location: ../views/panel/categorias.php?error=1');
    exit;
  }

  $stmt->close();  // Cerramos la declaración preparada
}
