<?php 
    include '../Layout/header.php'; 
?>



<!--*******************************************************************-->

<!doctype html>
<html lang="es">
<!--Head con enlaces a CSS, BOOTSTRAP Y JAVASCRIPT  -->

<head>
    <script src="../JS/galeria.js"></script>
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
                        <a class="nav-link" href="../Vistas/Vista_Favoritos.php">FAVORITOS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="../Vistas/Vista_Galeria.php">ESPECIALES</a>
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
          <div>
            <h1  id="tituloSemana">GALERIA</h1>
          </div>
                <div id="contenedorSemana"  class="container-fluid row justify-content-center">
                    <div id="portada">
                        <img src="../IMG/Alexia_Putellas.png" alt="alexia" width="300" height="400">
                    </div>
                    <div class="galeria">
                        <a href="#" id="alexia"><img src="../IMG/Alexia_Putellas.png" alt="alexia" width="150" height="200"></a>
                        <a href="#" id="mbape"><img src="../IMG/mbape.png" alt="mbape" width="150" height="200"></a>
                        <a href="#" id="modric"><img src="../IMG/Modrić.png" alt="modric" width="150" height="200"></a>
                        <a href="#" id="van"><img src="../IMG/van_Dijk.png" alt="van" width="150" height="200"></a>
                        <a href="#" id="zico"><img src="../IMG/Zico.png" alt="zico" width="150" height="200"></a>
                    </div>
                </div>
            
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php 
    include '../Layout/footer.php'; 
    ?>
    </body> 
</html>

