<?php
  session_start();

  include("conexion.php");
  $conn = conectar();

  if (isset($_SESSION['user_id'])) {

    $records = $conn->prepare('SELECT ID, CORREO, CONTRA FROM registro WHERE ID = :ID');
    $records->bindParam(':ID', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
    }
?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <title>Bienvenido</title>
     <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php if(!empty($user)): ?>
      <div align=right> Bienvenido <?= $user['CORREO']; ?>
      <a href="salir.php">SALIR</a>
<?php else: 
        require 'cabecera.php';
        endif; ?>
</body>
</html>