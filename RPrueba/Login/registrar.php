<?php

include("conexion.php");
  $conn = conectar();
  $message = '';

  if (!empty($_POST['CORREO']) && !empty($_POST['CONTRA'])) {
    $sql = "INSERT INTO registro (CORREO, CONTRA) VALUES (:CORREO, :CONTRA)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CORREO', $_POST['CORREO']);

    $password = password_hash($_POST['CONTRA'],PASSWORD_BCRYPT);
    $stmt->bindParam(':CONTRA', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
<?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="ingresar.php">Login</a></span>

<form action="registrar.php" method="POST">
      <input name="CORREO" type="text" placeholder="Ingresa email:">
      <input name="CONTRA" type="password" placeholder="Ingresa contraseña:">
      <input type="submit" value="Submit">
    </form>

</body>
</html>