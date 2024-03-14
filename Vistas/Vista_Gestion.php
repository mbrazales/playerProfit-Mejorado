<?php 
    include '../Layout/header.php'; 
    include '../Config/conexionPDO.php';

    // Definir una consulta SQL base para obtener todos los jugadores
    $sql = "SELECT * FROM jugadores";

    // Inicializar el arreglo de parámetros para la consulta preparada
    $params = array();

    // Verificar si se ha enviado un término de búsqueda por nombre
    if(isset($_GET["nombre"]) && !empty($_GET["nombre"])) {
        $sql .= " WHERE nombre LIKE ?";
        $params[] = "%" . $_GET["nombre"] . "%"; // Agregar el término de búsqueda al arreglo de parámetros
    }


    // Preparar la consulta SQL con la concatenación dinámica de condiciones
    $stmt = $miPDO->prepare($sql);

    // Ejecutar la consulta preparada con los parámetros correspondientes
    $stmt->execute($params);

    // Obtener los resultados de la consulta
    $jugadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Resto del código HTML -->



<!doctype html>
<html lang="es">

<head>
    <title>Buscar Jugadores</title>

    <!-- CSS personalizado -->
    <style>
        

        .buscador {
            margin: auto;
        }

        @media (min-width: 1400px) {
            .container {
                max-width: 1020px;
            }
        }

        @media (max-width: 1400px) {
            .container {
                max-width: 800px; /* Cambiar el ancho máximo del contenedor */
            }
        }
    </style>
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
                        <a class="nav-link" href="../Vistas/Vista_TodosJugadores.php">JUGADORES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../Vistas/Vista_Favoritos.php">FAVORITOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../Vistas/Vista_Galeria.php">ESPECIALES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../Vistas/Vista_ObrasMaestras.php">VIDEOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="../Vistas/Vista_Gestion.php">GESTIÓN</a>
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
                    <a class="nav-link " href="Vista_Carro.php">
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

<div class="container buscador text-center"> <!-- Añade la clase text-center para centrar horizontalmente -->
    <h1>Buscar Jugadores</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" class="row g-3 justify-content-center"> <!-- Añade la clase justify-content-center para centrar horizontalmente los elementos -->
        <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        </div>
        
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>
</div>

        <div class="container-fluid row justify-content-center">

            <!-- Boton para agregar un nuevo jugador -->
            <a href="Vista_NuevoJugador.php" class="btn btn-dark" id="boton-agregar">Nuevo jugador</a>
        </div>
        <hr>
        <hr>

        <div class="container">
            <!--Creación de la tabla de los jugadores, con sus respectivas columnas -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">JUGADOR</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">EQUIPO</th>
                        <th scope="col">CALIDAD</th>
                        <th scope="col">VALOR</th>
                        <th scope="col">ID</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>

                <?php

            //ESTE APARTADO ES PARA LA BUSQUEDA DE JUGADORES POR GET Y NO POR POST

            //incluimos la conexión esta vez por PDO
            include "../Config/conexionPDO.php";

            // Si se envió un nombre para buscar, realizar la búsqueda
            if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {

                // Almacenamos el nombre buscado
                $nombre_buscado = $_GET['nombre'];

                try {

                    // Preparamos la consulta SQL para buscar jugadores por nombre
                    $sql = "SELECT * FROM jugadores WHERE nombre LIKE :nombre";
                    $statement = $miPDO->prepare($sql);

                    // Se usa bindValue para evitar SQL injection
                    $statement->bindValue(':nombre', '%' . $nombre_buscado . '%');

                    // Ejecutamos la consulta
                    $statement->execute();

                    // Obtenemos todos los jugadores que coinciden con la búsqueda
                    $jugadores = $statement->fetchAll(PDO::FETCH_ASSOC);

                    // Si se encontraron jugadores, mostrar información
                    if ($jugadores) {

                        //El bucle foreach se utiliza para recorrer arrays en PHP. La estructura básica es foreach ($array as $valor)
                        foreach ($jugadores as $fila) {

                            // Mostrar los detalles de los jugadores en una tabla 
                            echo "<tr>";
                            // Esto es para cargar la foto.
                            echo "<td><img width='150' height='200' src='data:image/jpg;base64," . base64_encode($fila['imagen']) . "' alt=''></td>";
                            echo "<td>" . $fila['nombre'] . "</td>";
                            echo "<td>" . $fila['equipo'] . "</td>";
                            echo "<td>" . $fila['calidad'] . "</td>";
                            echo "<td>" . $fila['valor'] . "</td>";
                            echo "<td>" . $fila['id'] . "</td>";
                            echo "<td>";

                            // Botones de acción para editar, eliminar y marcar como favorito
                            echo "<a href='Vista_Editar_Jugador.php?id=" . $fila["id"] . "' class='btn btn-warning'>Editar</a>";
                            echo "<a href='../Modelos/Modelo_Eliminar_Jugador.php?id=" . $fila["id"] . "' class='btn btn-danger'>Eliminar</a>";

                            // El boton de favorito agrega los jugadores en una lista de favoritos por medio de una cookie para cada uno de los 
                            // distintos usuarios.
                            echo "<a href='../Controladores/Controlador_Favoritos.php?id=" . $fila["id"] . "' class='btn btn-info'>Añadir al Carro</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Mostrar un mensaje si no se encontraron jugadores con el nombre buscado
                        echo "<tr><td colspan='5'>No se encontraron jugadores con ese nombre.</td></tr>";
                    }
                } catch (PDOException $e) {

                    // Capturar y mostrar errores de PDO
                    echo "Error: " . $e->getMessage();
                }
            } else {

                //Siempre que vamos a index.php se muestras todos los jugadores.

                ///*******EN ESTE TRAMO NO COMENTO NADA PORQUE ES LO MISMO QUE EL CODIGO DE ARRIBA PERO ESTA VEZ MUESTRA SIEMPRE 
                ///*******LA LISTA COMPLETA DE JUGADORES ********/

                // Si no se realizó una búsqueda, mostrar todos los jugadores
                try {
                    $sql = "SELECT * FROM jugadores";
                    $statement = $miPDO->prepare($sql);
                    $statement->execute();
                    $jugadores = $statement->fetchAll(PDO::FETCH_ASSOC);

                    if ($jugadores) {
                        foreach ($jugadores as $fila) {
                            echo "<tr>";
                            echo "<td><img width='150' height='200' src='data:image/jpg;base64," . base64_encode($fila['imagen']) . "' alt=''></td>";
                            echo "<td>" . $fila['nombre'] . "</td>";
                            echo "<td>" . $fila['equipo'] . "</td>";
                            echo "<td>" . $fila['calidad'] . "</td>";
                            echo "<td>" . $fila['valor'] . "</td>";
                            echo "<td>" . $fila['id'] . "</td>";
                            echo "<td>";
                            echo "<a href='Vista_Editar_Jugador.php?id=" . $fila["id"] . "' class='btn btn-warning'>Editar</a>";
                            echo "<a href='../Modelos/Modelo_Eliminar_Jugador.php?id=" . $fila["id"] . "' class='btn btn-danger'>Eliminar</a>";
                            echo "<a href='../Controladores/Controlador_Favoritos.php?id=" . $fila["id"] . "' class='btn btn-info'>Añadir al Carro</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay jugadores</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
            ?>

        </table>
        </div>
        

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



