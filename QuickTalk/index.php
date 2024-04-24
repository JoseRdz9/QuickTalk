<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: QuickTalk.php");
}
?>

<?php include_once "header.php"; ?>
<?php include 'navbar.html'?>

<body>
  <div class="container" id="container">
    <section class="form signup">
      <div class="form-container sign-up">
        <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="error-text"></div>
          <h1>Crea una cuenta</h1>
          <div class="social-icons"></div>
          <span>O utilice su correo electrónico para registrarse</span>
          <input type="text" name="fname" placeholder="Nombre" required>
          <input type="text" name="lname" placeholder="Apellido" required>
          <input type="email" name="email" placeholder="Correo electronico" required>
          <input type="password" name="password" placeholder="Contraseña" required>
          <div class="field image">
            <span>Tu Avatar</span>
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
          </div>
          <div class="field button">
            <button id="signup" type="submit" name="submit">Registrarse</buton>
          </div>
        </form>
      </div>
  
    <section class="form login">
      <div class="form-container sign-in">
        <form action="../QuickTalk.php" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="error-text"></div>
            <h1>Iniciar sesion</h1>
            <div class="social-icons"></div>
            <span>Inicia con tu correo y contraseña:</span>
            <input type="text" name="email" placeholder="Correo electronico">
            <input type="password" name="password" placeholder="Contraseña">
            <a href="#">¿Olvidaste tu contraseña?</a>
            <div class="field button">
              <button id="signin" type="submit" name="submit">Iniciar</button>
            </div>
        </form>
      </div>
    </section>
    <div class="toggle-container">
       <div class="toggle">
        <div class="toggle-panel toggle-left">
          <h1>¡Bienvenido de nuevo!</h1>
          <p>Ingrese sus datos personales para utilizar las funciones del sitio:</p>
          <button class="hidden" id="login">Iniciar sesion</button>
        </div>
        <div class="toggle-panel toggle-right">
           <h1>Hola! Bienvenido a QuickTalk</h1>
            <p>La solución definitiva para la comunicación segura en empresas de alto calibre! Con QuickTalk </p>
        </div>
      </div>
    </div>
  </div>

  <script src="js/loginchido.js"></script>
  <script src="js/login.js"></script>

</body>

</html>