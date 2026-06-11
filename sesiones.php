<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones</title>
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <!-- Tu CSS -->
    <link rel="stylesheet" href="assets/css/estilos?v=<?php echo filemtime(__DIR__ . '/assets/css/e'); ?>">
</head>


<style>
    body {
        /* background-image: url(assets/images/bg24.jpg);  */
        background-color: #181818;
        color: white;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;

        font-family: 'Barlow', sans-serif;
    }



    /*.dashboard-card-1, .dashboard-card-2{

        

        background: rgba(20, 20, 20, 0.7);
        text-align: center;
        align-self: start;
        border-radius: 15px;
        transition: 0.3s ease;
        cursor: pointer;
        border: 1px solid rgba(255,255,255,0.05);
        margin: auto;
        width: 100%;
        height: 120%;
        color: white;
        transform: translateY(30px);
        animation: fadeIn 1.5s ease-in-out forwards;
        opacity: 0;
        transition: all 0.6s ease;
    } */


    /*.dashboard-card-1:hover{
        transform: translateY(-10px);
        box-shadow: 0 0 20px hsla(182, 75%, 49%, 0.502);
        color:  hsla(182, 75%, 49%, 0.671);
        background-color: #0a0a0a73;
        
    } */

    /*.dashboard-card-2:hover{
        transform: translateY(-10px);
        box-shadow: 0 0 20px hsla(209, 100%, 57%, 0.502);
        background-color: #0a0a0a73;
             color: hsla(209, 100%, 57%, 0.671);

        /* box-shadow: 0 0 20px hsla(209, 100%, 57%, 0.502);  BOX SHADOW ORIGINAL*/
            /* color: hsla(209, 100%, 57%, 0.671); COLOR ORIGINAL
    }*/

    .pagob {
    position: absolute;
    top: -1px;
    left: -1px;
    background-color: rgb(255, 174, 0);
    color: rgb(0, 0, 0);
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    padding: 0.15rem 0.5rem;
    /*    border-radius: 0 0 10px 0; */
    border-radius: 10px;
    }

    .suscrip {
    position: absolute;
    top: -1px;
    left: -1px;
    background-color: rgb(255, 174, 0);
    color: rgb(0, 0, 0);
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    padding: 0.15rem 0.5rem;
    /*    border-radius: 0 0 10px 0; */
    border-radius: 10px;
    }

    .card-img-top {
        border-radius: 15px 15px 0 0;
        height: 200px;
        width: 100%;
        object-fit: cover;
    }
    main {
        flex: 1;
    }
    .navbar {
        background-color: #0f0f0fa9 !important;
        backdrop-filter: blur(8px);
        color:  #ffffff;
    }
    .back:hover {
        background: #ff6811f5;
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(255, 94, 0, 0.5);

    }
        /* ── SPEED DIAL (iconos tipo navegador) ── */
    .speed-dial-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 28px;
        padding: 10px 0 20px;
    }

    .speed-dial-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        cursor: pointer;
        animation: fadeIn 0.6s ease forwards;
        opacity: 0;
    }
    .speed-dial-item:nth-child(1) { animation-delay: 0.1s; }
    .speed-dial-item:nth-child(2) { animation-delay: 0.2s; }
    .speed-dial-item:nth-child(3) { animation-delay: 0.3s; }

    .speed-dial-icon {
        width: 170px;
        height: 100px;
        border-radius: 18px;
        background: rgba(30, 30, 32, 0.85);
        border: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        transition: all 0.22s ease;
        box-shadow: 0 4px 18px rgba(0,0,0,0.4);
        backdrop-filter: blur(6px);
    }

    .speed-dial-item:hover .speed-dial-icon {
        transform: translateY(-6px) scale(1.08);
        border-color: rgba(240, 180, 41, 0.5);
        box-shadow: 0 8px 28px rgba(240, 180, 41, 0.25);
        background: rgba(240, 180, 41, 0.08);
    }

    .speed-dial-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: rgba(255,255,255,0.75);
        text-align: center;
        max-width: 150px;

        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.2s;
    }
    .speed-dial-item:hover .speed-dial-label {
        color: #f0b429;
    }

    @keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px); /* opcional: pequeño movimiento */
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>


<body class="d-flex flex-column min-vh-100">
        <?php
            $nav_back_url  = "home.php";
            $nav_back_text = "Atras";
            $nav_base      = "./";
            require_once 'php/navbar.php';
        ?>

        <div class="container text-center" >
            <h3 class="display-4 fw-bold mb-3" >Sesiones</h3>
            <p class="lead mb-4">Elije la sesión que vas a usar.</p>
        </div>

        <!-- Speed Dial tipo navegador  -->
        <div class="speed-dial-grid">

            <a href="games/juegos.php" class="speed-dial-item" title="Juegos Mobiles">
                <div class="speed-dial-icon">
                    <i class="fa-solid fa-gamepad fs-3" style="color: #f0b429;"></i>
                </div>
                <span class="speed-dial-label">Juegos Mobiles</span>
            </a>

            <a href="plataformas/suscripciones.php" class="speed-dial-item" title="Plataformas Digitales">
                <div class="speed-dial-icon">
                    <i class="bi bi-google-play" style="color:  #f0b429;"></i>
                </div>
                <span class="speed-dial-label">Plataformas Digitales</span>
            </a>

            <a href="textil/textiles.php" class="speed-dial-item" title="Ropa">
                <div class="speed-dial-icon">
                    <i class="fa-solid fa-tshirt fs-3" style="color: #f0b429;"></i>
                </div>
                <span class="speed-dial-label">Ropa</span>
            </a>

        </div>
    </div>


        <!-- <section>
            <div class="row g-4 justify-content-center text-center">
                <div class= "col-md-3 "> 
                    <a href="games/juegos.php" style="text-decoration: none;">
                            <div class="dashboard-card-1 p-1" >
                            <i class="fa-solid fa-gamepad fs-3 text-warning"></i>
                            
                            <h5 class="">Juegos</h4>
                            <small class="text" style="color: rgb(255, 196, 0);">Compra recargas y productos en linea </small>
                        </div>
                    </a>
                </div>       
                <div class="col-md-3">
                    <a href="plataformas/suscripciones.php" style="text-decoration: none;">
                        <div class="dashboard-card-2 p-1">
                            <i class="bi bi-google-play fs-3 text-warning"></i>
                            <h6 class="">Plataformas Digitales</h6>
                            <small class="text" style="color: rgb(255, 196, 0);" >Paga tus plataformas de streaming</small>
                        </div>
                    </a>
                </div>
            </div>
    </section> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>
</html>