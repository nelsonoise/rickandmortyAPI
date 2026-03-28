<?php
require_once 'RickAndMortyService.php';

$service = new RickAndMortyService();
$data = $service->getCharacters(1);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rick and Morty Cast</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <h1>Rick and Morty API</h1>

    <div class="container">
        <?php if (isset($data['results'])): ?>
            <?php foreach ($data['results'] as $char): ?>
                <div class="card">
                    <img src="<?= $char['image'] ?>" alt="<?= $char['name'] ?>">
                    <div class="card-info">
                        <div class="section">
                            <h2><?= $char['name'] ?></h2>
                            <span class="status">
                                <span class="status-dot <?= strtolower($char['status']) ?>"></span>
                                <?= $char['status'] ?> - <?= $char['species'] ?>
                            </span>
                        </div>

                        <div class="section">
                            <span class="label">Última ubicación conocida:</span><br>
                            <span class="value"><?= $char['location']['name'] ?></span>
                        </div>

                        <div class="section">
                            <span class="label">Primera vez visto en:</span><br>
                            <span class="value"><?= $char['origin']['name'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay datos disponibles.</p>
        <?php endif; ?>
    </div>

</body>

</html>