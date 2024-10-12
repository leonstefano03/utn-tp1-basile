<?php
require_once("../db/db.php");
include_once('/xampp/htdocs/tp1/controllers/sessionValidate.php');

$stmt = $conx->prepare("SELECT * FROM usuarios");

$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$nuestroResultado = [];

while ($fila  = $resultadoSTMT->fetch_object()) {
  $nuestroResultado[] = $fila;
}

$stmt->close();
