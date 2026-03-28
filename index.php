<?php
require_once 'RickAndMortyService.php';

$service = new RickAndMortyService();

// Intentamos obtener la primera página de personajes
$data = $service->getCharacters(1);

if (isset($data['error'])) {
    echo "Hubo un problema: " . $data['error'];
} else {
    echo "<h2>Personajes encontrados:</h2>";
    foreach ($data['results'] as $character) {
        echo "<div>";
        echo "<strong>Nombre:</strong> " . $character['name'] . "<br>";
        echo "<strong>Especie:</strong> " . $character['species'] . "<br>";
        echo "<hr>";
        echo "</div>";
    }
}
