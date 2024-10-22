<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="librerias/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">

    <link rel="icon" href="img/a2.ico" type="image/x-icon">

    <title>Portal de Supervisión y Seguimiento</title>
</head>
<body style="background: url('img/fondoaguila.png') no-repeat center center fixed; background-size: cover;">
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="img/a.jpg" id="icon" alt="User Icon" />
      <h3 >Portal de Supervisión y Seguimiento a Distancia</h3>
    </div>

    <!-- Login Form -->
    <form action="validar.php" method="post" onsubmit="return validarForm()">
      <input type="text" id="usuario" class="fadeIn second" name="usuario" placeholder="Nombre de Usuario" required>
      <input type="password" id="contraseña" class="fadeIn third" name="contraseña" placeholder="contraseña" required>
      <input type="submit" class="fadeIn fourth" value="Ingresar">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="informacionPortal.php">Información sobre este sistema</a>
    </div>

  </div>

    <script src="librerias/sweetalert.min.js"></script>
    <script>
      
      </script>
</body>

</html>