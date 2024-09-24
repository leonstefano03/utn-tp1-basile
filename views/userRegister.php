<?php
require_once('../controllers/sessionValidate.php');
require_once('../db/db.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$error = isset($_GET['error']) ? intval($_GET['error']) : 0;
$nombre = '';
$fecha_creacion = '';
$edad = '';

if ($id !== 0) {

  $sql = "SELECT * FROM usuarios WHERE id = ? ";

  $stmt = $conx->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $resultado = $stmt->get_result();

  $usuario = $resultado->fetch_object();

  $stmt->close();

  $id = $usuario->id;
  $nombre = $usuario->user_name;
  $fecha_creacion = $usuario->creation_date;
  $edad = $usuario->age;
}
?>

<?php if ($id) { ?>
  <form action="../controllers/userRegister_controllers.php?edit=1" method="POST">
  <?php } else { ?>
    <form action="../controllers/userRegister_controllers.php" method="POST">
    <?php } ?>

    <input type="text" name='user_name' placeholder="Ingrese el nombre" value="<?php echo $nombre; ?>" required> <br>
    <input type="number" name="age" placeholder="Ingrese la edad" value="<?php echo $edad; ?>" required> <br>
    <?php if ($id == 0) { ?>
      <input type="datetime-local" name="creation_date"> <br>
    <?php } else { ?>
      <input type="hidden" name="creation_date" value="<?php echo $fecha_creacion ?>"> <br>
    <?php } ?>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="hidden" value="1">
    <input type="submit"> <br>
    </form>

    <?php
    if ($error) { ?>
      <h1>Error al cargar los datos, inténtelo nuevamente.</h1>
    <?php } ?>