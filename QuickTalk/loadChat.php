<?php
include_once "php/config.php"; // Asegúrate de tener tu conexión a la base de datos aquí


// Usa el operador null coalescente para manejar el caso en que "user_id" no esté definido
$user_id = isset($_POST['user_id']) ? mysqli_real_escape_string($conn, $_POST['user_id']) : null;

// Comprueba si $user_id es null antes de proceder
if($user_id !== null) {
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$user_id}'"); // Asegúrate de que las variables estén correctamente encapsuladas en la consulta
  if(mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    // El resto de tu código sigue aquí
    ?>
    <?php include_once "header.php"; ?>
    <div class="wrapper">
      <!-- Tu estructura de chat aquí -->
      <section class="chat-area">
      <header>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
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
    <?php
  } else {
    echo "El usuario no existe.";
  }
} else {
  echo "No se proporcionó ID de usuario.";
}
?>
