<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <?php
    require_once('../controllers/sessionValidate.php');
    require_once('../controllers/listado_controllers.php')
    ?>
    <form action="../controllers/cerrarSesion.php">
        <input type="submit" value="cerrar sesion">
    </form>

    <form action="userRegister.php">
        <input type="submit" value="Agregar usuario">
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Fecha de creacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($nuestroResultado as $fila) { ?>
                <tr>
                    <td> <?php echo $fila->id ?></td>
                    <td><?php echo $fila->user_name ?></td>
                    <td><?php echo $fila->age  ?></td>
                    <td><?php echo $fila->creation_date ?></td>
                    <td>
                        <form action="userRegister.php?edit=1" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fila->id ?>">
                            <input type="submit" value="editar">
                        </form>
                        <form action="../controllers/userRegister_controllers.php?delete=1" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fila->id ?>">
                            <input type="submit" value="eliminar">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


</body>

</html>