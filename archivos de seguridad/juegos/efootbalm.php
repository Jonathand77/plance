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
    <title>Efootball Products</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tu CSS -->
    <link rel="stylesheet" href="assets/css/">
</head>


<style>
    body{

        /* background-image: url(../assets/images/bg12.jpg); */
        background: linear-gradient( rgb(255, 255, 255) 0%, hsl(0, 0%, 91%));

        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
    } 
    .navbar {
        background-color: #000000a9 !important;
        backdrop-filter: blur(8px);
        color:  #ffffff;
    }

    .card {
        background-color: #ffffff;
        color: #000000;
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        align-items: center
    }
    .back:hover {
        background: #000000f5;
        color: black;
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(255, 94, 0, 0.5);

    }
</style>    

<body>
        <nav class="navbar navbar-dark navbar-expand-lg px-2">
        <a class="navbar-brand fw-bold text-gradient" href="welcome.php" style="color: orange;"> 
            <img src="https://companieslogo.com/img/orig/EVTC_BIG.D-f2992a32.png?t=1742789418" class="img-logo" alt="Logo de EV" style="width: 120px; height: 25px;">
        </a>
        <div class="ms-auto text-white">
                <span style="background-color: hsla(120, 2%, 10%, 0.84); padding: 5px 10px; border-radius: 5px; font-weight: bold;">
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo "Hola, " . $_SESSION['usuario'];
                } else {
                    echo "Invitado";
                }
                ?>
               <i class="bi bi-circle-fill" style="color: #51ff00 ;"></i></span> 
        </div>
    </nav>
    </nav><br>
    <a href="juegos.php" class="btn" style="background: #ff5e00f5; width: 130px; color: white;"><i class="bi bi-backspace-fill"></i> Volver</a>   
        <div class="container mt-5">
        <h2 class="text-center mb-4">Recargas Efootball</h2>

            <form action="../php/crear_pago.php" method="POST">
                
                <!-- ID jugador -->
                <div class="mb-4 text-center">
                    <input type="text" name="jugador_id" class="form-control w-50 mx-auto" placeholder="ID del jugador" required>
                </div>

                <div class="row">

                    <!-- CARD 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-3">
                            <img src="https://assetsdelivery.eldorado.gg/v7/_assets_/predefined-offers/v8/183/eFootball%2012000.png" style="height: 50px; width: 50px" alt="">
                            <h5>150 monedas</h5>
                            <p>$5.000</p>
                        

                            <button type="submit" name="producto" value="150 Monedas" class="btn btn-dark"
                                onclick="setPrecio(5000)">
                                Comprar
                            </button>
                        </div>
                    </div>

                    <!-- CARD 2 -->
                    <div class="col-md-4 mb-4">

                        <div class="card text-center p-3">
                            <img src="https://assetsdelivery.eldorado.gg/v7/_assets_/predefined-offers/v8/183/eFootball%2012000.png" style="height: 50px; width: 50px" alt="">
                            <h5>300 monedas</h5>
                            <p>$10.000</p>

                            <button type="submit" name="producto" value="300 Monedas" class="btn btn-dark"
                                onclick="setPrecio(10000)">
                                Comprar
                            </button>
                        </div>
                    </div>

                    <!-- CARD 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-3">
                            <img src="https://assetsdelivery.eldorado.gg/v7/_assets_/predefined-offers/v8/183/eFootball%2012000.png" style="height: 50px; width: 50px"  alt="">
                            <h5>550 Monedas</h5>
                            <p>$19.000</p>

                            <button type="submit" name="producto" value="550 Monedas" class="btn btn-dark"
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
                            <img src="https://assetsdelivery.eldorado.gg/v7/_assets_/predefined-offers/v8/183/eFootball%2012000.png" style="height: 50px; width: 50px" alt="">
                            <h5>700 Monedas</h5>
                            <p>$30.000</p>

                            <button type="submit" name="producto" value="700 Monedas" class="btn btn-dark"
                                onclick="setPrecio(30000)">
                                Comprar
                            </button>
                        </div>
                    </div>
                    <!-- CARD 5 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-3">
                            <img src="https://assetsdelivery.eldorado.gg/v7/_assets_/predefined-offers/v8/183/eFootball%2012000.png" style="height: 50px; width: 50px" alt="">
                            <h5>950 Monedas</h5>
                            <p>$41.000</p>

                            <button type="submit" name="producto" value="950 Monedas" class="btn btn-dark"
                                onclick="setPrecio(41000)">
                                Comprar
                            </button>
                        </div>
                    </div>
                    <!-- CARD 6 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-3">
                            <img src="https://assetsdelivery.eldorado.gg/v7/_assets_/predefined-offers/v8/183/eFootball%2012000.png" style="height: 50px; width: 50px" alt="">
                            <h5>1200 Monedas</h5>
                            <p>$52.000</p>

                            <button type="submit" name="producto" value="1200 Monedas" class="btn btn-dark"
                                onclick="setPrecio(52000)">
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
</body>
<!-- js scripts -->
<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/validaciones.js"></script>
</html>