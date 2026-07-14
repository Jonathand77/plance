<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Fire Products</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tu CSS -->
    <link rel="stylesheet" href="assets/css/">
</head>

<style>
    :root {
        --bg-base: #0f1319;
        --surface: #1E212C;
        --border: #4C5F71;
        --primary: #FF6C0C;
        --secondary: #00CFB4;
    }

    body {

        /* background-image: url(../assets/images/bg12.jpg); */
        background-color: #0f1319;
        color: white;

        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
    }

    .navbar {
        background-color: #1E212Ca9 !important;
        backdrop-filter: blur(8px);
        color: #ffffff;


    }

    .card {
        background-color: #1E212C;
        color: #ffffff;
        border: 1px solid var(--border);
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        align-items: center
    }

    .back:hover {
        background: var(--primary);
        color: #0d0e10;
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(255, 108, 12, 0.35);

    }
</style>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg px-2">
        <a class="navbar-brand fw-bold text-gradient" href="welcome.php" style="color: #FF6C0C;">
            <img src="https://companieslogo.com/img/orig/EVTC_BIG.D-f2992a32.png?t=1742789418" class="img-logo"
                alt="Logo de EV" style="width: 120px; height: 25px;">
        </a>
        <div class="ms-auto text-white">
            <span
                style="background-color: #1E212C; border:1px solid #4C5F71; padding: 5px 10px; border-radius: 5px; font-weight: bold;">
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo "Hola, " . $_SESSION['usuario'];
                } else {
                    echo "Invitado";
                }
                ?>
                <i class="bi bi-circle-fill" style="color: #00CFB4;"></i></span>
        </div>
    </nav>
    </nav><br>
    <a href="juegos.php" class="btn" style="background: #FF6C0C; width: 130px; color: #0d0e10;"><i
            class="bi bi-backspace-fill"></i> Volver</a>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Recargas Free Fire</h2>

        <form action="../php/crear_pago.php" method="POST">

            <!-- ID jugador -->
            <div class="mb-4 text-center">
                <input type="text" name="jugador_id" class="form-control w-50 mx-auto" placeholder="ID del jugador"
                    required>
            </div>

            <div class="row">

                <!-- CARD 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center p-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/1664/1664513.png"
                            style="height: 50px; width: 50px" alt="">
                        <h5>100 Diamantes</h5>
                        <p>$4.000</p>


                        <button type="submit" name="producto" value="100 Diamantes" class="btn btn-dark"
                            onclick="setPrecio(4000)">
                            Comprar
                        </button>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="col-md-4 mb-4">

                    <div class="card text-center p-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/1664/1664513.png"
                            style="height: 50px; width: 50px" alt="">
                        <h5>350 Diamantes</h5>
                        <p>$9.000</p>

                        <button type="submit" name="producto" value="350 Diamantes" class="btn btn-dark"
                            onclick="setPrecio(9000)">
                            Comprar
                        </button>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center p-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/1664/1664513.png"
                            style="height: 50px; width: 50px" alt="">
                        <h5>500 Diamantes</h5>
                        <p>$15.000</p>

                        <button type="submit" name="producto" value="500 Diamantes" class="btn btn-dark"
                            onclick="setPrecio(15000)">
                            Comprar
                        </button>
                    </div>
                </div>

            </div>

            <!-- CARD 4 -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card text-center p-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/1664/1664513.png"
                            style="height: 50px; width: 50px" alt="">
                        <h5>850 Diamantes</h5>
                        <p>$20.000</p>

                        <button type="submit" name="producto" value="850 Diamantes" class="btn btn-dark"
                            onclick="setPrecio(20000)">
                            Comprar
                        </button>
                    </div>
                </div>
                <!-- CARD 5 -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center p-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/1664/1664513.png"
                            style="height: 50px; width: 50px" alt="">
                        <h5>1220 Diamantes</h5>
                        <p>$30.000</p>

                        <button type="submit" name="producto" value="1220 Diamantes" class="btn btn-dark"
                            onclick="setPrecio(30000)">
                            Comprar
                        </button>
                    </div>
                </div>
                <!-- CARD 6 -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center p-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/1664/1664513.png"
                            style="height: 50px; width: 50px" alt="">
                        <h5>2400 Diamantes</h5>
                        <p>$50.000</p>

                        <button type="submit" name="producto" value="2400 Diamantes" class="btn btn-dark"
                            onclick="setPrecio(50000)">
                            Comprar
                        </button>
                    </div>





                </div>

                <!-- Precio oculto -->
                <input type="hidden" name="precio" id="precio">

        </form>
    </div>

    <script>
        function setPrecio(valor) {
            document.getElementById('precio').value = valor;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>