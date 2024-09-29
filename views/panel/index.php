<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  ?>
  <div id="menu">
    <div id="cont-title">
      <h1>Panel UTN</h1>
    </div>
    <div id="lista-acciones">
      <ul>
        <li><a href="#" id="link-noticias">Noticias</a></li>
        <li><a href="#" id="link-categorias">Categorías</a></li>
        <li><a href="#" id="link-usuarios">Usuarios</a></li>
      </ul>
    </div>
  </div>
  <div id="table">
  </div>

  <style>
    body {
      width: 100vw;
      height: 100vh;
      margin: 0;
      padding: 0;
      background-color: antiquewhite;
      display: flex
    }

    #menu {
      width: 20%;
      height: 100%;
      background-color: gray;
    }

    #cont-title {
      width: 100%;
      height: 20%;
      background-color: teal;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #cont-title h1 {
      font-size: 30px;
    }

    #table {
      width: 80%;
      height: 100%;
      background-color: burlywood;
      display: flex;
      flex-direction: column;
    }

    #cont-button-table-new {
      width: 100%;
      height: 15%;
      display: flex;
      justify-content: flex-end;
      align-items: center;
    }

    #button-table-new {
      width: 150px;
      height: 40px;
      margin-right: 50px;
      border-radius: 5px;
      border: 1px solid white;
    }

    #cont-info-table {
      width: 100%;
      height: 85%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #info-table {
      width: 700px;
      height: 500px;
      background-color: azure;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const infoTable = document.getElementById('table');

      function loadContent(url) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.onload = function() {
          if (xhr.status === 200) {
            infoTable.innerHTML = xhr.responseText;
          } else {
            infoTable.innerHTML = '<p>Error al cargar el contenido.</p>';
          }
        };
        xhr.send();
      }

      document.getElementById('link-noticias').addEventListener('click', function(e) {
        e.preventDefault();
        loadContent('noticias.php'); // Cargar archivo noticias.php
      });

      document.getElementById('link-categorias').addEventListener('click', function(e) {
        e.preventDefault();
        loadContent('categorias.php'); // Cargar archivo categorias.php
      });

      document.getElementById('link-usuarios').addEventListener('click', function(e) {
        e.preventDefault();
        loadContent('usuarios.php'); // Cargar archivo usuarios.php
      });
    });
  </script>

</body>

</html>