<?php
require_once('/xampp/htdocs/tp1/db/db.php');
@session_start();

$admin = isset($_SESSION["is_admin"]) ? intval($_SESSION["is_admin"]) : 0;
$submitForm = isset($_GET['hidden']) ? intval($_GET['hidden']) : 0;
$method = isset($_GET['method']) ? $_GET['method'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$title = isset($_GET['title']) ? $_GET['title'] : '';
$id_noticia = isset($_GET['id_noticia']) ? $_GET['id_noticia'] : '';

$description = isset($_GET['description']) ? $_GET['description'] : '';
$text = isset($_GET['text']) ? $_GET['text'] : '';
$image = isset($_GET['image']) ? $_GET['image'] : '';
$id_usuario = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$id_categoria = isset($_GET['id_categoria']) ? intval($_GET['id_categoria']) : 0;
$creation_date = '';

if ($id == 0) {
  $stmt = $conx->prepare("
  SELECT n.*, c.nombre AS nombre_categoria, u.user_name AS nombre_usuario
  FROM noticias n
  INNER JOIN categorias c ON n.id_categoria = c.id
  INNER JOIN usuarios u ON n.id_usuario = u.id
");

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

  $stmt = $conx->prepare('INSERT INTO noticias (title, description, image, creation_date, id_usuario, id_categoria, text) VALUES (?,?,?,?,?,?, ?)');

  $stmt->bind_param('ssssiis', $title, $description, $image, $creation_date, $id_usuario, $id_categoria, $text);

  if ($stmt->execute()) {
    header('Location: ../views/panel/noticias.php');
    exit;
  } else {
    echo 'Error al insertar el registro: ' . $stmt->error;
    header('Location: ../views/panel/noticias_edit.php?error=1');
  }

  $stmt->close();
};

if ($method == 'DELETE') {
  $stmt = $conx->prepare('DELETE FROM noticias WHERE id = ?');

  $stmt->bind_param('i', $id);

  if ($stmt->execute()) {
    header('Location: ../views/panel/noticias.php');
    exit;
  } else {
    echo 'Error al eliminar el registro: ' . $stmt->error;
  }

  $stmt->close();
}
if ($method == 'EDIT') {
  $creation_date = isset($_GET['creation_date']) && !empty($_GET['creation_date']) ? $_GET['creation_date'] : date('Y-m-d H:i:s');

  $stmt = $conx->prepare('UPDATE noticias SET title = ?, description = ?, image = ?, creation_date = ?, text = ?, id_usuario = ?, id_categoria = ? WHERE id = ?');

  // Asegurarse de que bind_param tiene el formato correcto para 7 parámetros
  $stmt->bind_param('sssssiii', $title, $description, $image, $creation_date, $text, $id_usuario, $id_categoria, $id);

  if ($stmt->execute()) {
    header('Location: ../views/panel/noticias.php');
    exit;
  } else {
    echo 'Error al editar el registro: ' . $stmt->error;
    header('Location: ../panel/noticias.php?error=1');
    exit();
  }

  $stmt->close();  // Cerramos la declaración preparada
}


if ($id != 0) {
  echo $id;

  $sql = "SELECT n.*, c.nombre as nombre_categoria, u.user_name as nombre_usuario 
  FROM noticias n 
  INNER JOIN categorias c ON n.id_categoria = c.id 
  INNER JOIN usuarios u ON n.id_usuario = u.id 
  WHERE n.id = ?";

  $stmt = $conx->prepare($sql);
  $stmt->bind_param("i", $id);


  if ($stmt->execute()) {
    $resultado = $stmt->get_result();
    $noticia = $resultado->fetch_object();
    $stmt->close();
    $id = $noticia->id;
    $title = $noticia->title;
    $creation_date = $noticia->creation_date;
    $image = $noticia->image;
    $text = $noticia->text;
    $description = $noticia->description;
    $categoria = $noticia->nombre_categoria;
    $id_categoria = $noticia->id_categoria;
    $usuario = $noticia->nombre_usuario;
    $id_usuario = $noticia->id_usuario;
  }
}
