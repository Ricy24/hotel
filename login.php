<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>Iniciar sesión</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="gallery.html">Galería</a></li>
                <li><a href="servicios.html">Servicios</a></li>
                <li><a href="reservation.php">Reservas</a></li>
                <li><a href="contact.html">Contacto</a></li> 
                <?php
                session_start(); // Iniciar la sesión
                if (isset($_SESSION['email'])) {
                    echo '<li><a href="php/logout.php">Cerrar sesión</a></li>';
                } else {
                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
        <div class="contenedor_todo">
            <div class="caja_trasera">
                <div class="caja_trasera-login">
                    <h2>¿Ya tienes una cuenta?</h2>
                    <p>Inicia sesión para entrar en la página del Resort</p>
                    <button><a href="admin/panel_reservas.php">Administrador</a></button>
                    <button id="btn_iniciar-sesion">Iniciar Sesión</button>
                </div>

                <div class="caja_trasera-register">
                    <h2>¿Aún no tienes una cuenta?</h2>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn_registrarse">Regístrate</button>
                </div>
            </div>

            <!-- Formularios -->
            <div class="contenedor_login-register">
                <!-- Formulario de login -->
                <form action="php/login.php" method="POST" class="formulario_login">
                    <h1>Iniciar Sesión</h1>
                    <input type="email" placeholder="Correo electrónico" name="email" required>
                    <input type="password" placeholder="Contraseña" name="password" required>
                    <button type="submit">Entrar</button>
                </form>

                <!-- Formulario de registro -->
                <form action="php/register.php" method="POST" class="formulario_register">
                    <h1>Registrarse</h1>
                    <input type="text" placeholder="Nombre completo" name="name" required>
                    <input type="email" placeholder="Correo electrónico" name="email" required>
                    <input type="text" placeholder="Usuario" name="usuario" required>
                    <input type="password" placeholder="Contraseña" name="password" required>
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; Resort la isla encantada</p>
    </footer>
    <script src="js/script2.js"></script>
</body>
</html>
