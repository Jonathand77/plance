<?php
    //necesito que el usuario no pueda acceder a la página de juegos sin iniciar sesión, y luego redirigir al usuario a la página de inicio de sesión

    //no se si es posible (de hehco no me lo enseñaron en el sena) pero necesito que la sesión del usuario se mantenga activa mientras el usuario navega por la página de juegos, para que así el usuario no tenga que iniciar sesión cada vez que quiera acceder a la página de juegos
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
    <title>COD Products</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tu CSS -->
    <link rel="stylesheet" href="assets/css/">
</head>
<style>
    body{

        /* background-image: url(../assets/images/bg12.jpg); */
        background: linear-gradient( rgb(40, 43, 53) 0%, hsl(0, 0%, 13%));
        color: white;

        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
    }


    .navbar {
        background-color: #1f1e1ea9 !important;
        backdrop-filter: blur(8px);
        color:  #ffffff;


    }

    .card {
        background: linear-gradient( hsla(56, 100%, 50%, 0.80) 0%, hsla(59, 100%, 49%, 0.99));
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
        <a href="juegos.php" class="btn" style="color: orangered;"><i class="bi bi-backspace-fill"></i> Volver</a>
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
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Recargas COD Mobile</h2>

            <form action="../php/crear_pago.php" method="POST">
                
                <!-- ID jugador -->
                <div class="mb-4 text-center bg-dark p-3 rounded">
                    <input type="text" name="jugador_id" class="form-control w-50 mx-auto "  placeholder="ID del jugador" required>
                </div>

                <div class="row">

                    <!-- CARD 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-3">
                            <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441" style="height: 50px; width: 50px" alt="">
                            <h5>90 CP</h5>
                            <p>$7.000</p>
                        

                            <button type="submit" name="producto" value="90 CP" class="btn btn-dark"
                                onclick="setPrecio(7000)">
                                Comprar
                            </button>
                        </div>
                    </div>

                    <!-- CARD 2 -->
                    <div class="col-md-4 mb-4">

                        <div class="card text-center p-3">
                            <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441" style="height: 50px; width: 50px" alt="">
                            <h5>460 CP</h5>
                            <p>$22.000</p>

                            <button type="submit" name="producto" value="460 CP" class="btn btn-dark"
                                onclick="setPrecio(22000)">
                                Comprar
                            </button>
                        </div>
                    </div>

                    <!-- CARD 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-3">
                            <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441" style="height: 50px; width: 50px"  alt="">
                            <h5>1200 CP</h5>
                            <p>$49.000</p>

                            <button type="submit" name="producto" value="1200 CP" class="btn btn-dark"
                                onclick="setPrecio(49000)">
                                Comprar
                            </button>
                        </div>
                    </div>

                </div>

                <!-- CARD 4 -->
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-3">
                            <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441" style="height: 50px; width: 50px" alt="">
                            <h5>2250 CP</h5>
                            <p>$92.000</p>

                            <button type="submit" name="producto" value="2250 CP" class="btn btn-dark"
                                onclick="setPrecio(92000)">
                                Comprar
                            </button>
                        </div>
                    </div>
                    <!-- CARD 5 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-3">
                            <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441" style="height: 50px; width: 50px" alt="">
                            <h5>4500 CP</h5>
                            <p>$150.000</p>

                            <button type="submit" name="producto" value="4500 CP" class="btn btn-dark"
                                onclick="setPrecio(150000)">
                                Comprar
                            </button>
                        </div>
                    </div>
                    <!-- CARD 6 -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-3">
                            <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441" style="height: 50px; width: 50px" alt="">
                            <h5>7500 CP</h5>
                            <p>$220.000</p>

                            <button type="submit" name="producto" value="7500 CP" class="btn btn-dark"
                                onclick="setPrecio(220000)">
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