<?php
require_once 'RickAndMortyService.php';
$service = new RickAndMortyService();

// Capturamos la página de la URL: index.php?page=2
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Obtenemos los datos de esa página específica
$data = $service->getCharacters($currentPage);

// Calculamos páginas sig/prev (la API nos da info['pages'] para el límite)
$totalPages = $data['info']['pages'] ?? 1;
$nextPage = $currentPage < $totalPages ? $currentPage + 1 : null;
$prevPage = $currentPage > 1 ? $currentPage - 1 : null;
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
    <div class="pagination">
        <?php if ($prevPage): ?>
            <a href="?page=<?= $prevPage ?>" class="btn">« Anterior</a>
        <?php else: ?>
            <span class="btn disabled">« Anterior</span>
        <?php endif; ?>

        <span class="page-info">Página <?= $currentPage ?> de <?= $totalPages ?></span>

        <?php if ($nextPage): ?>
            <a href="?page=<?= $nextPage ?>" class="btn">Siguiente »</a>
        <?php else: ?>
            <span class="btn disabled">Siguiente »</span>
        <?php endif; ?>
    </div>

</body>

</html>