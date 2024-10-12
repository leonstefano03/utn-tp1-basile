<div id="menu">
  <div id="cont-title">
    <h1>Panel UTN</h1>
  </div>
  <div id="lista-acciones">
    <ul>
      <li><a href="noticias.php" id="link-noticias">Noticias</a></li>
      <li><a href="categorias.php" id="link-categorias">Categorías</a></li>
      <?php if ($admin) { ?>
        <li><a href="usuarios.php" id="link-usuarios">Usuarios</a></li>
      <?php } ?>
    </ul>
  </div>
</div>

<style>
  #menu {
    width: 20%;
    height: 100%;
    background-color: gray;
    border-right: 2px solid rgba(0, 0, 0, 0.2);


  }

  #cont-title {
    width: 100%;
    height: 20%;
    background-color: teal;
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom: 2px solid rgba(0, 0, 0, 0.2);
  }

  #cont-title h1 {
    font-size: 30px;
  }

  #lista-acciones ul {
    list-style: none;
    /* Eliminar viñetas */
    padding: 0;
    margin: 0;
  }

  #lista-acciones li {
    margin: 10px 0;
    /* Espaciado entre los enlaces */
  }

  #lista-acciones a {
    text-decoration: none;
    /* Eliminar subrayado */
    color: white;
    /* Cambiar el color del texto */
    background-color: darkslategray;
    /* Color de fondo para los enlaces */
    padding: 10px 15px;
    /* Añadir espacio alrededor del texto */
    display: block;
    transition: background-color 0.3s ease;
    /* Efecto suave al cambiar el color */
  }

  #lista-acciones a:hover {
    background-color: darkcyan;
    /* Cambiar color de fondo al pasar el ratón */
  }
</style>