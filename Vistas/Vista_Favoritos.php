<?php 
    include '../Layout/header.php'; 
?>

<!doctype html>
<html lang="es">

<head>
    <title>Proyecto</title>
</head>

<!--Header-->
<header class="bg-secondary">

    <!-- Inicio del menu -->

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- icono-->

            <a class="navbar-brand" href="../index.php">
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
                        <a class="nav-link  text-decoration-none" aria-current="page" href="../index.php">HOME</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="../Vistas/Vista_TodosJugadores.php">JUGADORES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="../Vistas/Vista_Favoritos.php">FAVORITOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../Vistas/Vista_Galeria.php">ESPECIALES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../Vistas/Vista_ObrasMaestras.php">VIDEOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../Vistas/Vista_Gestion.php">GESTIÓN</a>
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
                        <a class="nav-link" href="../Vistas/carro.php">
                            <i class="bi bi-person"></i>
                            <small class="d-md-none ms-2">Carro</small>
                        </a>
                    </li>

                    <li class="nav-item col-6 col-md-auto p-3 position-relative">
                    <a class="nav-link " href="../Vistas/Vista_Carro.php">
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
<?php
    // Incluye el archivo de conexión a la base de datos mediante PDO
    include '../Config/conexionPDO.php';

    // Obtiene el nombre de usuario de la sesión
    $nombre_usuario = $_SESSION['nombre_usuario'];

    // Verifica si existe una lista de jugadores favoritos en la sesión o en una cookie
    if (!empty($_SESSION['favoritos'])) {

        // Si existe en la sesión, asigna los jugadores favoritos a la variable correspondiente
        $jugadores_favoritos = $_SESSION['favoritos'];

    } elseif (isset($_COOKIE['favoritos' . $nombre_usuario])) {

        // Si no existe en la sesión pero sí en una cookie, deserializa y asigna los jugadores favoritos a la variable correspondiente
        $jugadores_favoritos = unserialize($_COOKIE['favoritos' . $nombre_usuario]);
    }



// Verificar si la cookie de favoritos existe
if (isset($_COOKIE['favoritos'])) {

    $favoritos = unserialize($_COOKIE['favoritos']); // Obtener la lista de favoritos desde la cookie

    if (!empty($favoritos)) {

        try {
            // Consultar la base de datos para obtener la información de los jugadores favoritos

            $in = str_repeat('?,', count($favoritos) - 1) . '?'; // Crear una cadena de comodines para la consulta SQL

            $sql = "SELECT * FROM jugadores WHERE id IN ($in)"; // Consulta SQL para obtener los jugadores por sus IDs

            $statement = $miPDO->prepare($sql); // Preparar la consulta

            $statement->execute($favoritos); // Ejecutar la consulta con los IDs de los jugadores

            $jugadores_favoritos = $statement->fetchAll(PDO::FETCH_ASSOC); // Obtener los jugadores como un array asociativo

            if ($jugadores_favoritos) {
                
                // Mostrar la información de los jugadores favoritos
                echo "<h1>Jugadores Favoritos</h1>";
                echo "<table class='table'>";
                echo "<thead>
                        <tr>
                            <th scope='col'>JUGADOR</th>
                        </tr>
                    </thead>";
                echo "<tbody>";

                foreach ($jugadores_favoritos as $jugador) {

                    // Mostrar la información de cada jugador
                    echo "<tr>";
                    echo "<td><img width='150' height='200' src='data:image/jpg;base64," . base64_encode($jugador['imagen']) . "' alt=''></td>"; // Mostrar la imagen del jugador
                    echo "<td>" . $jugador['nombre'] . "</td>"; // Mostrar el nombre del jugador
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No se encontraron jugadores favoritos"; // Mensaje si no se encuentran jugadores favoritos
            }
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage(); // Manejar errores de consulta
        }
    } else {
        echo "No hay jugadores marcados como favoritos"; // Mensaje si no hay jugadores marcados como favoritos
    }
} else {
    echo "No hay jugadores marcados como favoritos"; // Mensaje si la cookie de favoritos no existe
}



    // ... Tu código para mostrar la lista de favoritos ...

    echo "<form method='post' action='../Controladores/Controlador_EliminarFavoritos.php'>";
    echo "<input type='submit' name='eliminar_favoritos' value='Eliminar Todos los Favoritos' class='btn btn-danger'>";

    echo "</form>";
    ?>
    <a href="../index.php" class="btn btn-Warning">Volver</a>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php 
    include '../Layout/footer.php'; 
    ?>
</body>


</html>