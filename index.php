
<?php

// Session_start() para el inicio de sesión, de lo contrario si no lo hizo se le envia a la página de Vista_Registro.php, aquí nadie se cuela jajajaja.

session_start();

include "Config/conexion.php";

if (!empty($_SESSION['email']) && !empty($_SESSION['pass'])) {

    // Si hay una sesión activa, mostrar la bienvenida y el nombre de usuario y el email, realmente es para un control de las sesiones
    if (isset($_SESSION['nombre_usuario'])) {
        
        $nombreUsuario = $_SESSION['nombre_usuario'];
        $email = $_SESSION['email'];
        
    } else {
        // de lo contrario mensaje de Bienvenido sin mas, aunque si nos muestra este mensaje algo está mal
        echo '<div><p>¡Bienvenido!, pero tenemos un error en algún lado</p></div>';
    }
} else {
    // Si no hay sesión activa, redirigir a la página de inicio de sesión
    header('location:login.php');
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // El usuario ha iniciado sesión
    //echo 'El usuario ha iniciado sesión.';
} else {
    // El usuario no ha iniciado sesión
    echo 'El usuario no ha iniciado sesión.';
}





//Si se envía el formulario de cerrar sesión de usuario
//Se destruye la sesión y se redirige a la página de login.php

// Cierre de sesión y eliminación de la cookie de favoritos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logout'])) {
        // Eliminar la cookie de jugadores favoritos
        setcookie('favoritos', '', time() - 3600, '/'); // Caducar la cookie

        // Mensaje de depuración (Realmente este mensaje nunca lo veo, en un futuro cuando aprenda hacer ventanas emergentes o algo parecido
        // daré más información a los usuarios de mi aplicación.)
        echo "Cookie 'favoritos' eliminada.";

        session_destroy();
        header('location: login.php');
        exit();
    }
}

?>

<!--*******************************************************************-->

<!doctype html>
<html lang="es">
<!--Head con enlaces a CSS, BOOTSTRAP Y JAVASCRIPT  -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
</head>


<!--Header-->
<header class="bg-secondary">

    <!-- Inicio del menu -->

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- icono-->

            <a class="navbar-brand" href="index.php">
                <i class="bi bi-suit-spade-fill"></i>
                <span class="text-success">PLAYER PROFIT</span>
            </a>

            <!-- boton del menu -->

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- elementos del menu colapsable -->

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav mx-auto">

                    <li class="nav-item ">
                        <a class="nav-link active text-decoration-none" aria-current="page" href="index.php">HOME</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Vistas/Vista_TodosJugadores.php">JUGADORES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Vistas/Vista_Favoritos.php">FAVORITOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Vistas/Vista_Galeria.php">ESPECIALES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Vistas/Vista_ObrasMaestras.php">VIDEOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Vistas/Vista_Gestion.php">GESTIÓN</a>
                    </li>
                    
                </ul>

                <hr class="d-md-none text-white-50">

                <!-- enlaces redes sociales PARA UN FUTURO Y SEGUIR ESCALANDO EN EL PROYECTO-->

                <ul class="navbar-nav  flex-row flex-wrap text-light">
                
                    <li class="nav-item dropstart">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo '<div><p> ' . $nombreUsuario . '</p></div>'; ?>
                        </a>
                        <ul class="dropdown-menu transparent-bg">
                            <form method="post">
                                <input type="submit" name="logout" value="CERRAR SESIÓN" class="btn btn-outline-success">
                            </form>
                        </ul>
                    </li>

                    <li class="nav-item col-6 col-md-auto p-3">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person"></i>
                            <small class="d-md-none ms-2">Carro</small>
                        </a>
                    </li>

                    <li class="nav-item col-6 col-md-auto p-3 position-relative">
                    <a class="nav-link " href="Vistas/Vista_Carro.php">
                            <i class="bi bi-cart "></i>
                            <small class="d-md-none ms-2"></small>
                        </a>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </li>

                    

                    
                    

                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
    <h1 align="center">COMPRA LAS MEJORES CARTAS</h1>

    
        

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

<footer>
    <header class="bg-secondary">

        <!-- Inicio del menu -->

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- icono o nombre -->

                <a class="navbar-brand" href="index.php">
                    <i class="bi bi-suit-spade-fill"></i>
                    <span class="">@BRAZALES TEAM</span><i class="bi bi-suit-spade-fill"></i>
                </a>
                <i class="bi bi-suit-spade-fill"></i>
                <a class="navbar-brand" href="index.php">
                    <i class="cookies"></i>
                    <span class="text-success">PLAYER PROFIT</span>
                </a>



                <!-- enlaces redes sociales -->

                <ul class="navbar-nav  flex-row flex-wrap text-light">

                    <li class="nav-item col-6 col-md-auto p-3">
                        <i class="bi bi-twitter"></i>
                        <small class="d-md-none ms-2">Twitter</small>
                    </li>

                    <li class="nav-item col-6 col-md-auto p-3">
                        <i class="bi bi-github"></i>
                        <small class="d-md-none ms-2">GitHub</small>
                    </li>

                    <li class="nav-item col-6 col-md-auto p-3">
                        <i class="bi bi-whatsapp"></i>
                        <small class="d-md-none ms-2">WhatsApp</small>
                    </li>

                    <li class="nav-item col-6 col-md-auto p-3">
                        <i class="bi bi-facebook"></i>
                        <small class="d-md-none ms-2">Facebook</small>
                    </li>

                </ul>

                <!--boton Informacion -->

                <form class="d-flex">
                    <a href="Vistas/Vista_Contacto.php">
                        <button type="button" class="btn btn-outline-info">CONTACTO</button>
                    </a>
                </form>


            </div>

            </div>
        </nav>
</footer>
</html>



