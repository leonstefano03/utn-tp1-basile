<div id="menu">
  <div id="cont-title">
    <h1>UTN Panel</h1>
  </div>
  <div id="lista-acciones">
    <ul>
      <li><a href="noticias.php" id="link-noticias">News</a></li>
      <li><a href="categorias.php" id="link-categorias">Categories</a></li>
      <?php if ($admin) { ?>
        <li><a href="usuarios.php" id="link-usuarios">Users</a></li>
      <?php } ?>
      <li><a href="../../controllers/cerrarSesion.php" id="link-categorias" class="sesion">Log Out</a></li>
    </ul>
  </div>
</div>

<style>
  #menu {
    width: 20%;
    height: 100%;
    background-color: #588157;
    border-right: 2px solid rgba(0, 0, 0, 0.2);
  }

  #cont-title {
    width: 100%;
    height: 20%;
    background-color: #606c38;
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom: 2px solid rgba(0, 0, 0, 0.2);
  }

  #cont-title h1 {
    color: white;
    font-size: 30px;
  }

  #lista-acciones ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  #lista-acciones li {
    margin: 10px 0;
  }

  #lista-acciones a {
    text-decoration: none;
    color: white;
    background-color: darkslategray;
    padding: 10px 15px;
    display: block;
    transition: background-color 0.3s ease;
  }

  #lista-acciones a:hover {
    background-color: #a3b18a;
  }

  #lista-acciones .sesion:hover {
    background-color: #780000;
  }
</style>