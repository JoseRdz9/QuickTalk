<?php
session_start();
include_once "php/conn-vistas.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: index.php");
  exit(); // Asegura que el script se detenga después de redirigir
}
?>

<?php include_once "header3.php"; ?>




<body>

	<div class="row">
		<div class="sidebar" data-bs-theme="light">
			<a href="QuickTalk.php"><i class="fa-regular fa-message"></i></a>
			<a href="#Configuracion" id="mostrarContenido" ><i class="fi fi-rs-admin-alt"></i></a>
			<button onclick="cambiarmodo()" class="btn rounded-fill"><i id="darkmode" class="fi fi-rs-moon-stars" style="color: white;"></i></button>
		</div>
		<div class="content" data-bs-theme="light">
		<div id="messages">
			<div class="wrapper"></div>
			
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
		<section class="chat-area">
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

	<?php
		
		include_once "php/conn-vistas.php";

		// Asegúrate de que el usuario esté autenticado y obtén su rol
		if (isset($_SESSION['unique_id'])) {
			$user_id = $_SESSION['unique_id'];
			$sql = "SELECT * FROM users WHERE unique_id = '$user_id'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);

			// Verifica si el usuario tiene un rol de administrador (rol 1)
			$rol = $row['rol']; // Suponiendo que el campo de la tabla que almacena el rol se llama 'rol'
		} else {
			// Si el usuario no está autenticado, redirige a la página de inicio de sesión
			header("Location: index.php");
			exit(); // Asegura que el script se detenga después de redirigir
		}
	?>

		<!-- Aquí comienza la parte del div #usuarios -->
		<?php if ($rol == 1): ?>
		<div id="usuarios" class=" " >

			<div class="row">

				<div class="col">
					
					<!-- MENSAJE DE ALERTA DE OPERACION-->
					<?php if(isset($_SESSION['mensaje'])){?>
						<div  id="alerta" class="alert alert-<?= $_SESSION['mensaje_tipo'];?> alert-dismissible fade show" role="alert">
							<?= $_SESSION['mensaje']?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						
					<?php // Eliminar el mensaje de la sesión después de mostrarlo
							unset($_SESSION['mensaje']);
							unset($_SESSION['mensaje_tipo']);} ?>
				</div>

			</div>

			<div id="crud" class="row" style="margin-top: 25px; margin-right: 10px;">

				<div class="col-12">
					<h1>Circulo de influencias</h1>
					<div class="d-flex">
						<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#FormularioContacto">Agregar</button>

						<!-- Modal -->
						<div class="modal fade" id="FormularioContacto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar contacto</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<section class="form signup">
										<div class="modal-body form sign-up">
											<form action="../php/signup.php" method="POST" enctype="multipart/form-data" autocomplete="off">
												<input name="fname" class="form-control mb-3" type="text" placeholder="Nombre">
												<input name="lname" class="form-control mb-3" type="text" placeholder="Apellido">
												<input name="email" class="form-control mb-3" type="email" placeholder="Correo">
												<input name="password" class="form-control mb-3" type="password" placeholder="Password">
												<input name="rol" class="form-control mb-3" type="rol" placeholder="Puesto">
												<div class="field image">
													<span>Tu Avatar</span>
													<input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
												</div>
												<hr>
												<div class="field button">
													<button id="signup" type="submit" name="submit">Registrarse</buton>
												</div>
											</form>
										</div>
									</section>
								</div>
							</div>
						</div>

						<!-- filtrado y búsqueda -->
						<form action="vista-admn.php" method="POST">
							<div class="d-flex">

								<input class="form-control inputBuscar" name="inputBuscar" type="search" placeholder="Buscar">
								<button class="btn form-control btnBuscar" type="submit" name="btnBuscar">Buscar</button>

								<div class="dropdown">
									<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filtros</button>
									<ul class="dropdown-menu">
										<li>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" value="0" name="filtroOrden" id="orden_0">
												<label class="form-check-label" for="orden_0">Puesto 1</label>
											</div>
										</li>
										<li>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" value="0" name="filtroContestado" id="contestado_0">
												<label class="form-check-label" for="contestado_0">Puesto 2</label>
											</div>
										</li>
										<li>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" value="0" name="filtroInteresado" id="interesado_0">
												<label class="form-check-label" for="interesado_0">Puesto 3</label>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</form>

					</div>
					
				</div>

			</div>


			<div class="row">

				<div class="col">
					
					<div class="card card-body">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">Nombre</th>
									<th scope="col">Email</th>
									<th scope="col">Password</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php						
								
								$query = "SELECT * FROM users";

								if(isset($_POST['btnBuscar'])){
									$buscar = $_POST['inputBuscar'];
									$filtroOrden = isset($_POST['filtroOrden']) ? intval($_POST['filtroOrden']) : -1;

									// Verificar si el valor ingresado parece ser un correo electrónico
									if(filter_var($buscar, FILTER_VALIDATE_EMAIL)){
										// Buscar por correo electrónico
										$query = "SELECT * FROM users WHERE email LIKE '%$buscar%'";
									}else{
										// Buscar por nombre o apellido
										$query = "SELECT * FROM users WHERE fname LIKE '%$buscar%' OR lname LIKE '%$buscar%'";
									}

									if($filtroOrden == 0){
										$query .= " ORDER BY fname, lname ASC";
									}else if($filtroOrden == 1){
										$query .= " ORDER BY fname DESC, lname DESC";
									}
								}
								
									
									$resultado = mysqli_query($conn, $query);
									while($row = mysqli_fetch_assoc($resultado)) {
											$id = $row['unique_id'];
										?>
										<tr data-id="fila_<?php echo $id; ?>">
											<form action="php/editar.php?id=<?php echo $id; ?>" method="POST">
												<td>
													<input type="checkbox">
												</td>
												<td>
													<label class="label_nombres"><?php echo $row['fname']." ".$row['lname']?></label>
													<div class="d-flex">
														<input class="form-control input_nombre hidden" type="text" class="form-control" name="Enombre" value="<?php echo $row['fname']; ?>" placeholder="Nombres">
														<input class="form-control input_apellido1 hidden" type="text" class="form-control" name="Eapellido_1" value="<?php echo $row['lname']; ?>" placeholder="1° Apellido">
													</div>
												</td>
			<!--Actualizacion-------------------------------------------------------->
												<td>
													<label class="label_telefono"><?php echo $row['email']; ?></label>
													<input class="form-control input_telefono hidden" type="email" class="form-control" name="Etelefono" value="<?php echo $row['email']; ?>">
												</td>
												<td>
													<label class="label_correo"><?php echo $row['password']; ?></label>
													<input class="form-control input_correo hidden" type="password" class="form-control" name="Ecorreo" value="<?php echo $row['password']; ?>">
												</td>

			<!--Actualizacion------------------------------------------------------------->
												<td>
													<div class="d-flex">
														<input class="btn btn-secondary editar" name="editar" type="button" value="Editar">
														<input class="btn btn-primary guardar hidden" name="guardar" type="submit" value="Guardar">
														<input class="btn btn-danger cancelarEditar hidden" name="cancelarEditar" type="button" value="Cancelar">
														<button type="button" class="btn btn-primary eliminar" data-bs-toggle="modal" data-bs-target="#modalEliminar_<?php echo $id; ?>">Eliminar</button>
													</div>
													

													<!-- Modal -->
													<div class="modal fade" id="modalEliminar_<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar registro</h1>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">
																	<p>¿Esta seguro que desea eliminar el registro?</p>
																</div>
																<div class="modal-footer">
																	<a class="btn btn-success confirmarEliminar" name="confirmar" type="button" value="Confirmar" href="php/eliminar.php?id=<?php echo $id; ?>">Confirmar</a>
																	<input class="btn btn-danger cancelarEliminar" data-bs-dismiss="modal" aria-label="Close" name="cancelarEliminar" type="button" value="Cancelar">
																</div>
															</div>
														</div>
													</div>
												</td>
			<!---------------------------------------------------------------------------->
											</form>
										</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>

				</div>

			</div>

		</div>
		<?php endif; ?>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="js/opciones.js"></script>
	<script src="js/login.js"></script>
	<script src="js/users.js"></script>
	<script src="js/scriptquick.js"></script>
	<script src="js/logout.js"></script>
	<script src="js/chat.js"></script>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../controllers/js/estado.js"></script>

</body>


</html>
