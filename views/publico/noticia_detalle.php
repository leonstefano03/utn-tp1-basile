<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['id'])) {
  $id_noticia = intval($_POST['id']);

  include_once('/xampp/htdocs/tp1/controllers/noticias.php');

  if (!$noticia) {
    echo "News not found.";
    exit;
  }
} else {
  echo "News ID not specified.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($noticia->title); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


  <div class="container mt-5">
    <div class="contain-title">
      <h1 class="text-center mb-1">News UTN</h1>


    </div>
    <div class="contain-cards d-flex">


      <div class="cont-img">
        <img src="../../<?php echo $noticia->image; ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($noticia->title); ?>">
      </div>
      <div class="cont-info">
        <h2 class="text-center"><?php echo htmlspecialchars($noticia->title); ?></h2>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($noticia->description); ?></p>
        <p><strong>Text:</strong> <?php echo htmlspecialchars($noticia->text); ?></p>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($noticia->nombre_categoria); ?></p>
        <p><strong>Publication Date:</strong> <?php echo htmlspecialchars($noticia->creation_date); ?></p>

        <a href="./dashboard.php" class="btn">Back to News</a>
      </div>


    </div>
</body>





<style>
  body {
    background-color: #606c38;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    height: 100vh;
  }

  .container {
    background-color: #a3b18a;
    border-radius: 5px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    padding-left: 10px;
    padding-right: 10px;
    padding-bottom: 20px;
  }

  .contain-title {
    position: sticky;
    top: 0;
    z-index: 1;
    padding-top: 20px;
  }

  .contain-cards {
    padding-top: 10px;
    height: 75vh;
    flex-grow: 1;
    margin: 30px;
    padding-left: 10px;
    padding-right: 10px;
    background-color: white;
    border: 1px solid white;
    border-radius: 10px;

  }

  .card {
    border: none;
    transition: transform 0.2s;
    width: 100%;
    height: 530px;
    margin-bottom: 20px;
    background-color: white;
    border: 1px solid white;

    border-radius: 5px;
  }

  .cont-img {
    width: 50%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .cont-info {
    width: 50%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
  }

  .cont-info h2 {
    margin-bottom: 40px;
  }

  .cont-info a {
    margin-top: 40px;
  }

  img {
    width: 450px;
    height: 700px;
    object-fit: cover;
    border-radius: 10px;

  }

  .card:hover {
    transform: scale(1.02);
  }

  .category-select {
    float: right;
  }

  .form-label {
    margin: auto;
    padding-right: 10px;
    color: black;
    font-weight: 550;
  }

  .btn {
    text-decoration: none;
    color: white;
    background-color: darkslategray;
  }

  .btn:hover {
    background-color: #588157;
    color: white;

  }

  #categoria {
    color: white;
    background-color: darkslategray;
    border: 0;
    width: 150px;
  }

  #categoria:hover {
    background-color: #588157;
  }

  #cont-button-table-new {
    height: 40px;
  }
</style>












<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>