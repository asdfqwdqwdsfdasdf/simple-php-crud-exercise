<?php
// Obtener el Pokémon desde GET o POST, por defecto 'pikachu'
$pokemon = 'pikachu';
if (!empty($_REQUEST['pokemon'])) {
    $pokemon = strtolower(trim($_REQUEST['pokemon']));
}

// URL de la API para obtener datos del Pokémon
$url = "https://pokeapi.co/api/v2/pokemon/$pokemon";

// Llamar la API
$response = @file_get_contents($url);

if ($response === FALSE) {
    $error = "No se encontró información para el Pokémon: <strong>" . htmlspecialchars($pokemon) . "</strong>";
    $data = null;
} else {
    $data = json_decode($response, true);
    if (!$data) {
        $error = "Error al procesar los datos del Pokémon.";
    }
}

if ($data) {
    $nombre = ucfirst($data['name']);
    $imagen = $data['sprites']['front_default'];
    $tipos = array_map(fn($t) => ucfirst($t['type']['name']), $data['types']);
    $altura = $data['height'] / 10; // metros
    $peso = $data['weight'] / 10;   // kg
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Pokémon API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 20px auto;
            text-align: center;
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
        }
        img {
            width: 150px;
            height: 150px;
        }
        .info {
            margin-top: 15px;
            font-size: 18px;
        }
        .tipos span {
            display: inline-block;
            background-color: #ddd;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 3px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type=text] {
            padding: 8px;
            font-size: 16px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }
        button {
            padding: 8px 15px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <h1>Buscar Pokémon</h1>

    <form method="GET" action="">
        <input type="text" name="pokemon" placeholder="Nombre o ID" required 
               value="<?= isset($_REQUEST['pokemon']) ? htmlspecialchars($_REQUEST['pokemon']) : '' ?>">
        <button type="submit">Buscar</button>
    </form>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($data): ?>
        <h2><?= $nombre ?></h2>
        <img src="<?= $imagen ?>" alt="Imagen de <?= $nombre ?>" />
        <div class="info">
            <p><strong>Altura:</strong> <?= $altura ?> m</p>
            <p><strong>Peso:</strong> <?= $peso ?> kg</p>
            <p><strong>Tipos:</strong></p>
            <div class="tipos">
                <?php foreach ($tipos as $tipo): ?>
                    <span><?= $tipo ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>
