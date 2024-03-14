<?php 
    include '../Layout/header.php'; 
?>

<!--*******************************************************************-->

<!doctype html>
<html lang="es">
<!--Head con enlaces a CSS, BOOTSTRAP Y JAVASCRIPT  -->

<head>
    <script src="JS/galeria.js"></script>
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
                        <a class="nav-link" href="../Vistas/Vista_TodosJugadores.php">JUGADORES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../Vistas/Vista_Favoritos.php">FAVORITOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../Vistas/Vista_Galeria.php">ESPECIALES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="../Vistas/Vista_ObrasMaestras.php">VIDEOS</a>
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
                    <a class="nav-link " href="../Vistas/Vista_carro.php">
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
        
        <!-- Buscador-->
        <nav" class="navbar navbar-light bg-light ">
            <div class="container-fluid row justify-content-center">
                <form class="d-flex col-7 col-md-5">
                    <input class="form-control me-3" type="search" placeholder="Buscar Jugador" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
        </nav>
    
      <hr>
        <h1>OBRAS DE ARTE DEL FÚTBOL</h1>
          <div class="card-group ">
            <div class="card">
              <video id="videoZidane" width="500" height="300" controls poster="../IMG/zidane01.jpg"><source src="../VIDEOS/videoZidane.mp4" type="video/mp4"></video>
              <div class="card-body">
                <h5 class="card-title">LA OCTAVA MARAVILLA</h5>
                <p class="card-text">Cuando le preguntaron a Zidane por este gol con la zurda, el respondió que es diestro.</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Menos mal que la zurda no es su pierna buena.</small>
              </div>
            </div>
            <div class="card">
              <video id="videoRony" width="500" height="300" controls poster="../IMG/rony.jpg"><source src="../VIDEOS/ronaldinho.mp4" type="video/mp4"></video>
              <div class="card-body">
                <h5 class="card-title">EL PRIMER DISPARO DEL GAUCHO</h5>
                <p class="card-text">Es el jugador con más fantasia que han visto mis ojos, este video representa su llegada a la Liga.</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Se te ponen los pelos de punta al rememorarlo.</small>
              </div>
            </div>
            <div class="card">
              <video id="videoFifa" width="500" height="300" controls poster="../IMG/fifa01.jpg"><source src="../VIDEOS/adefifa.mp4" type="video/mp4"></video>
              <div class="card-body">
                <h5 class="card-title">BRAZALES EN FIFA</h5>
                <p class="card-text">Tras 15 años jugando sigo siendo un poco manco, pero me sigue flipando este juego.</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">A veces me quito los guantes del horno y hago cositas.</small>
              </div>
            </div>
          
          <script>
              document.addEventListener("DOMContentLoaded", function() {
                var video1 = document.getElementById("videoZidane");
                var video2 = document.getElementById("videoRony");
                
                video1.volume = 0.5; // Establece el volumen del primer video al 50%
                video2.volume = 0.2; // Establece el volumen del segundo video al 50%
              });
            </script>
      



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php 
    include '../Layout/footer.php'; 
    ?>
    </body> 
</html>