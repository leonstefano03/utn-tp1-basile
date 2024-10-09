<?php
//require_once('../controllers/sessionValidate.php');
require_once('../../db/db.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$error = isset($_GET['error']) ? intval($_GET['error']) : 0;
$user_name = '';
$creation_date = '';
$age = '';
$password = '';
if ($id !== 0) {

  $sql = "SELECT * FROM usuarios WHERE id = ? ";

  $stmt = $conx->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $resultado = $stmt->get_result();

  $usuario = $resultado->fetch_object();

  $stmt->close();

  $id = $usuario->id;
  $user_name = $usuario->user_name;
  $creation_date = $usuario->creation_date;
  $age = $usuario->age;
  $password = $usuario->password;
}

?>


<form action="../../controllers/userRegister_controllers.php" method="POST">


  <input type="text" name='user_name' placeholder="Ingrese el user name" value="<?php echo $user_name; ?>" required> <br>
  <input type="number" name="age" placeholder="Ingrese la age" value="<?php echo $age; ?>" required> <br>
  <input type="password" name="password" placeholder="ingrese su contraseña" value="<?php echo $password; ?>" required> <br>
  <?php if ($id == 0) { ?>
    <input type="datetime-local" name="creation_date"> <br>
  <?php } else { ?>
    <input type="hidden" name="creation_date" value="<?php echo $creation_date ?>"> <br>
  <?php } ?>
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <input type="hidden" name="hidden" value="1">
  <input type="submit"> <br>
</form>

<?php
if ($error) { ?>
  <h1>Error al cargar los datos, inténtelo nuevamente.</h1>
<?php } ?>