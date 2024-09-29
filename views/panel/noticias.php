<?php
//require_once('../controllers/sessionValidate.php');
require_once('../../db/db.php');

$error = isset($_GET['error']) ? intval($_GET['error']) : 0;

$submitForm = isset($_POST['hidden']) ? intval($_POST['hidden']) : 0;

if ($submitForm) {
  $title = isset($_POST['title']) ? $_POST['title'] : '';
  $text = isset($_POST['text']) ? $_POST['text'] : '';
  $image = isset($_POST['image']) ? $_POST['image'] : '';
  $description = isset($_POST['description']) ? $_POST['description'] : '';
  $creation_date = isset($_POST['creation_date']) && !empty($_POST['creation_date']) ? $_POST['creation_date'] : date('Y-m-d H:i:s');

  $stmt = $conx->prepare('INSERT INTO noticias (title, descriptions, creation_date, text, image) VALUES (?,?,?,?,?)');
  $stmt->bind_param('sssss', $title, $description, $creation_date, $text, $image);

  if ($stmt->execute()) {
    header('Location: ../panel');
    exit;
  } else {
    echo 'Error al insertar el registro: ' . $stmt->error;
    header('Location: ../panel/noticias.php?error=1');
    exit();
  }

  $stmt->close();
};
?>
<script>
  console.log($submitForm)
</script>

<?php
if ($error) { ?>
  <h1>Error al cargar los datos, inténtelo nuevamente.</h1>
<?php } ?>


<div id="cont-button-table-new">
  <button id="button-table-new">Add New</button>
</div>
<div id="cont-info-table">
  <div id="info-table">
    <form action="../panel/noticias.php" method="POST">
      <input type="text" name='title' placeholder="Ingrese el titulo de la noticia" required> <br>
      <input type="text" name='description' placeholder="Ingrese la descripcion de la noticia" required> <br>
      <textarea name="text" id="text" required></textarea>
      <input type="text" name='image' placeholder="Ingrese la imagen de la noticia" required> <br>
      <input type="hidden" name="hidden" value="1">
      <input type="submit" value="crear noticia"> <br>
    </form>
  </div>
</div>