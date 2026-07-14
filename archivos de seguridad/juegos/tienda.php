/
<?php
session_start();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-base: #0f1319;
            --surface: #1E212C;
            --border: #4C5F71;
            --primary: #FF6C0C;
            --secondary: #00CFB4;
            --info: #0062A8;
            --text-secondary: #7D868C;
        }

        body {
            background: linear-gradient(#0f1319 0%, #1E212C 100%);
            color: #f0f1f3;
            font-family: 'Barlow', sans-serif;
            padding: 1.5rem;
        }

        h1,
        h2 {
            color: var(--primary);
        }

        ul {
            color: var(--text-secondary);
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            color: #f0f1f3;
            border-radius: 12px;
        }

        .form-control {
            background: var(--surface);
            border: 1px solid var(--border);
            color: #f0f1f3;
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .form-control:focus {
            border-color: var(--info);
            box-shadow: 0 0 0 2px rgba(0, 98, 168, 0.2);
            background: var(--surface);
            color: #f0f1f3;
        }

        .btn-dark {
            background: var(--primary);
            border-color: var(--primary);
            color: #0d0e10;
            font-weight: 700;
        }

        .btn-dark:hover {
            background: #e45f09;
            border-color: #e45f09;
            color: #0d0e10;
        }
    </style>
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
            <input type="text" name="jugador_id" class="form-control w-50 mx-auto" placeholder="ID del jugador"
                required>
        </div>

        <div class="row">

            <?php foreach ($productos as $p): ?>
                <div class="col-md-4 mb-4">
                    <div class="card text-center p-3">
                        <h5><?php echo $p['nombre']; ?></h5>
                        <p>$<?php echo number_format($p['precio']); ?></p>

                        <button type="submit" name="producto" value="<?php echo $p['nombre']; ?>" class="btn btn-dark"
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

</html>