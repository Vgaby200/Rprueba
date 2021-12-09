<?php
  include("conexion.php");

  $conn = conectar();

  session_start();

  if (!empty($_POST['CORREO']) && !empty($_POST['CONTRA'])) {
    $sql = "SELECT ID, CORREO, CONTRA FROM registro WHERE CORREO = :CORREO";
    $records = $conn->prepare($sql);
    $records->bindParam(':CORREO', $_POST['CORREO']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 1 && password_verify($_POST['CONTRA'], $results['CONTRA'])) {
      $_SESSION['user_id'] = $results['ID'];
      header('Location:index.php');
    } else {
      $message = 'Sorry, those credentials do not match';
    }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1 align=center>Inicia sesion o <a href="registrar.php">Crear cuanta</a> </h1>

    <form action="ingresar.php" method="POST" align=center>
      <input name="CORREO" type="text" placeholder="Ingresa email"> <br>
      <input name="CONTRA" type="password" placeholder="Ingresa Password"> <br>
      <input type="submit" value="Submit">
    </form>
</body>
</html>