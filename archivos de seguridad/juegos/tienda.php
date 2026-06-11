/
<?php
session_start();

//hagamos una tienda dinamica :) en este caso hagamos que codm, freefire y efootball compartan la misma plantilla pero con diferente contenido dependiendo del juego seleccionado, esto lo haremos con un switch case y un array de productos para cada juego
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$game = $_GET['game'] ?? 'codm';

$productos = [];

switch ($game) {
    case 'codm':
        $titulo = "Call of Duty Mobile";
        $productos = [
            ["nombre" => "80 CP", "precio" => 8000],
            ["nombre" => "450 CP", "precio" => 22000],
            ["nombre" => "1000 CP", "precio" => 55000]
        ];
        break;

    case 'freefire':
        $titulo = "Free Fire";
        $productos = [
            ["nombre" => "100 Diamantes", "precio" => 5000],
            ["nombre" => "310 Diamantes", "precio" => 15000],
            ["nombre" => "520 Diamantes", "precio" => 25000]
        ];
        break;

    case 'efootball':
        $titulo = "eFootball";
        $productos = [
            ["nombre" => "100 Coins", "precio" => 4000],
            ["nombre" => "550 Coins", "precio" => 20000],
            ["nombre" => "1200 Coins", "precio" => 40000]
        ];
        break;

    default:
        $titulo = "Tienda";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Dinamica</title>
</head>
<body>
    <h1><?php echo $titulo; ?></h1>
    <ul>
        <?php foreach ($productos as $producto): ?>
            <li><?php echo $producto['nombre']; ?> - $<?php echo $producto['precio']; ?></li>
        <?php endforeach; ?>
    </ul>
    <h2 class="text-center mb-4"><?php echo $titulo; ?></h2>

<form action="php/crear_pago.php" method="POST">

    <input type="hidden" name="game" value="<?php echo $game; ?>">

    <div class="mb-4 text-center">
        <input type="text" name="jugador_id" class="form-control w-50 mx-auto" placeholder="ID del jugador" required>
    </div>

    <div class="row">

        <?php foreach ($productos as $p): ?>
            <div class="col-md-4 mb-4">
                <div class="card text-center p-3">
                    <h5><?php echo $p['nombre']; ?></h5>
                    <p>$<?php echo number_format($p['precio']); ?></p>

                    <button type="submit"
                        name="producto"
                        value="<?php echo $p['nombre']; ?>"
                        class="btn btn-dark"
                        onclick="setPrecio(<?php echo $p['precio']; ?>)">
                        Comprar
                    </button>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <input type="hidden" name="precio" id="precio">

</form>

<script>
function setPrecio(valor) {
    document.getElementById('precio').value = valor;
}
</script>




</body>
<!-- Aquí agrgare mis scripts de JS -->
 


</html>

