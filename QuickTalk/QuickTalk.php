<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: index.php");
  exit(); // Asegura que el script se detenga después de redirigir
}
?>

<?php include_once "header2.php"; ?>

<body data-bs-theme="light">
  <div class="grid-container">
  <div class="sidebar" data-bs-theme="light">
  <?php
  include 'php/conn-vistas.php';

  // Asegúrate de que el usuario esté autenticado y obtén su rol
  if (isset($_SESSION['unique_id'])) {
      $user_id = $_SESSION['unique_id'];
      $sql = "SELECT * FROM users WHERE unique_id = '$user_id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      // Verifica el rol del usuario y muestra elementos según el rol
      if ($row["rol"] == '0') {
          // Código para usuarios normales
          echo "<a href=\"#messages\"><i class=\"fa-regular fa-message\"></i></a>";
          echo "<a href=\"#Configuracion\"><i class=\"fi fi-rs-admin-alt\"></i></a>";
      } elseif ($row["rol"] == '1') {
          // Código para administradores
          echo "<a href=\"#messages\"><i class=\"fa-regular fa-message\"></i></a>";
          echo "<a href=\"vista-admn.php\"><i class=\"fi fi-rs-users-alt\"></i></a>";
          echo "<a href=\"#Configuracion\"><i class=\"fi fi-rs-admin-alt\"></i></a>";
      }
      echo "<button onclick=\"cambiarmodo()\" class=\"btn rounded-fill\"><i id=\"darkmode\" class=\"fi fi-rs-moon-stars\" style=\"color: white;\"></i></button>";
  } else {
      // Redirige a la página de inicio de sesión si el usuario no está autenticado
      header("Location: login.php");
      exit();
  }
  ?>
</div>

    <div class="content" data-bs-theme="light">
      <div id="messages">
        <div class="wrapper">
          <section class="users">
            <div class="search">
              <span class="text">Selecciona un usuario para iniciar el chat</span>
              <input type="text" placeholder="Enter name to search...">
              <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
              <?php
              // Asumiendo que $_SESSION['unique_id'] contiene el ID del usuario en sesión
              $currentUser = $_SESSION['unique_id'];
              // Obtener todos los usuarios excepto el usuario en sesión
              $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id != '$currentUser'");
              if(mysqli_num_rows($sql2) > 0){
                while($row = mysqli_fetch_assoc($sql2)){
                  // Mostrar los detalles de cada usuario
                  echo '
                  <div class="overflow-auto h-4/5 user-card" data-user-id="'.$row['unique_id'].'">
                    <div class="flex  mb-4 p-4 rounded">
                        <img src="php/images/'.$row['img'].'" class="self-start rounded-full w-12 mr-4">
                        <div class="w-full overflow-hidden">
                            <div class="flex mb-1">
                                <p class="font-medium flex-grow">'.$row['fname'].' '.$row['lname'].'</p>
                                <small class="text-gray-500">09:55 am</small>
                            </div>
                            <small class="overflow-ellipsis overflow-hidden block whitespace-nowrap text-gray-500"> '.$row['status'].'</small>
                        </div>
                    </div>
                  </div>
              ';
                }

              } else {
                echo '<p>No hay usuarios disponibles.</p>';
              }
              ?>
            </div>
          </section>
        </div>
      </div>
      <div id="Configuracion" style="display: none;">
        <h2>Mi cuenta</h2>
        <div class="usuario-info">
          <?php
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql) > 0) {
              $row = mysqli_fetch_assoc($sql);
            }
            ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <h2><?php echo $row['fname'] . " " . $row['lname'] ?></h2>
          <p>Correo: <?php echo $row['email']; ?></p>
          <p>Contraseña: <?php echo $row['password']; ?></p>
          <button class="cerrar-sesion" onclick="cerrarSesion('<?php echo $row['unique_id']; ?>')">Cerrar Sesión</button>
        </div>
      </div>
    </div>

      <div id="chatcont" class="wrapper" style="display: none;">
      <section  class="chat-area">
        <header class="border-b">
          <?php
            if (isset($_GET['user_id'])) {
              $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
              $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
              if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
              } else {
                header("location: QuickTalk.php");
                exit(); // Asegura que el script se detenga después de redirigir
              }
            }
          ?>
          <a href="" class="back-icon"><i class="fas fa-arrow-left"></i></a>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </header>
        <div class="chat-box">

        </div>
        <form action="#" class="typing-area">
          <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
          <input type="text" name="message" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off">
          <button><i class="fab fa-telegram-plane"></i></button>
        </form>
      </section>
    </div>
  </div>
  
  <script src="js/users.js"></script>
  <script src="js/scriptquick.js"></script>
  <script src="js/logout.js"></script>
  <script src="js/chat.js"></script>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
