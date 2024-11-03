<?php
require_once('/xampp/htdocs/tp1/db/db.php');
@session_start();
$admin = isset($_SESSION["is_admin"]) ? intval($_SESSION["is_admin"]) : 0;
$submitForm = isset($_POST['hidden']) ? intval($_POST['hidden']) : 0;
$method = isset($_POST['method']) ? $_POST['method'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : 0;
$title = isset($_POST['title']) ? $_POST['title'] : '';
$image = isset($_POST['image']) ? $_POST['image'] : '';
$id_noticia = isset($_POST['id_noticia']) ? $_POST['id_noticia'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$text = isset($_POST['text']) ? $_POST['text'] : '';
$id_usuario = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$id_categoria = isset($_POST['id_categoria']) ? intval($_POST['id_categoria']) : 0;
$creation_date = '';


if ($method == 'NEW') {

  if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

    $uploadDir = '../uploads/';

    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $rutaFinal = $uploadDir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $rutaFinal)) {
      $image = 'uploads/' . basename($_FILES['image']['name']);
    } else {
      echo 'Error al subir la imagen.';
      exit;
    }
  } else {
    echo 'No se ha subido ninguna imagen o ha ocurrido un error.';
    exit;
  }

  $creation_date = isset($_POST['creation_date']) && !empty($_POST['creation_date']) ? $_POST['creation_date'] : date('Y-m-d H:i:s');

  $stmt = $conx->prepare('INSERT INTO noticias (title, description, image, creation_date, id_usuario, id_categoria, text) VALUES (?, ?, ?, ?, ?, ?, ?)');
  $stmt->bind_param('ssssiis', $title, $description, $image, $creation_date, $id_usuario, $id_categoria, $text);

  if ($stmt->execute()) {
    header('Location: ../views/panel/noticias.php');
    exit;
  } else {
    echo 'Error al insertar el registro: ' . $stmt->error;
    header('Location: ../views/panel/noticias_edit.php?error=1');
  }

  $stmt->close();
}



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
  if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

    $uploadDir = '../uploads/';

    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $rutaFinal = $uploadDir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $rutaFinal)) {
      $image = 'uploads/' . basename($_FILES['image']['name']);
    } else {
      echo 'Error al subir la imagen.';
      exit;
    }
  } else {
    echo 'No se ha subido ninguna imagen o ha ocurrido un error.';
    exit;
  }

  $creation_date = isset($_POST['creation_date']) && !empty($_POST['creation_date']) ? $_POST['creation_date'] : date('Y-m-d H:i:s');

  $stmt = $conx->prepare('UPDATE noticias SET title = ?, description = ?, image = ?, creation_date = ?, text = ?, id_usuario = ?, id_categoria = ? WHERE id = ?');

  $stmt->bind_param('sssssiii', $title, $description, $image, $creation_date, $text, $id_usuario, $id_categoria, $id);

  if ($stmt->execute()) {
    header('Location: ../views/panel/noticias.php');
    exit;
  } else {
    echo 'Error al editar el registro: ' . $stmt->error;
    header('Location: ../panel/noticias.php?error=1');
    exit();
  }

  $stmt->close();
}


if ($id != 0) {
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
function obtenerNoticias($conx, $limit, $offset, $idCategoria, $searchInput)
{
  $sql = "
        SELECT n.*, c.nombre AS nombre_categoria, u.user_name AS nombre_usuario
        FROM noticias n
        INNER JOIN categorias c ON n.id_categoria = c.id
        INNER JOIN usuarios u ON n.id_usuario = u.id
        WHERE 1 = 1
    ";

  $params = [];
  $types = '';

  // Añadir condiciones dinámicamente
  if ($idCategoria > 0) {
    $sql .= " AND n.id_categoria = ?";
    $params[] = $idCategoria;
    $types .= 'i';
  }

  if (!empty($searchInput)) {
    $sql .= " AND n.title LIKE ?";
    $params[] = '%' . $searchInput . '%';
    $types .= 's';
  }

  $sql .= " ORDER BY n.creation_date DESC";

  if ($limit > 0) {
    $sql .= " LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $types .= 'ii';
  }

  $stmt = $conx->prepare($sql);

  // Verifica si hay parámetros antes de enlazar
  if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
  }

  $stmt->execute();
  $resultadoSTMT = $stmt->get_result();
  $nuestroResultado = [];

  while ($fila = $resultadoSTMT->fetch_object()) {
    $nuestroResultado[] = $fila;
  }

  $stmt->close();
  return $nuestroResultado;
}

function obtenerTotalNoticias($conx, $idCategoria, $searchInput)
{
  $sql = "SELECT COUNT(*) AS total FROM noticias WHERE 1 = 1";
  $params = [];
  $types = '';

  if ($idCategoria > 0) {
    $sql .= " AND id_categoria = ?";
    $params[] = $idCategoria;
    $types .= 'i';
  }
  if ($searchInput != '') {
    $sql .= " AND title LIKE ?";
    $params[] = '%' . $searchInput . '%';
    $types .= 's';
  }

  $stmt = $conx->prepare($sql);

  if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
  }

  $stmt->execute();
  $resultadoSTMT = $stmt->get_result();
  $total = $resultadoSTMT->fetch_object()->total;
  $stmt->close();
  return $total;
}
