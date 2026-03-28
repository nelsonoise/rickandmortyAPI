<?php

class RickAndMortyService
{
    private $baseUrl = "https://rickandmortyapi.com/api/";

    /**
     * Obtiene personajes con tipado de PHP 7
     * @param int $page
     * @return array
     */
    public function getCharacters(int $page = 1): array
    {
        $url = $this->baseUrl . "character/?page=" . $page;
        return $this->fetchData($url);
    }

    /**
     * Obtiene un personaje por ID
     * @param int $id
     * @return array
     */
    public function getCharacterById(int $id): array
    {
        $url = $this->baseUrl . "character/" . $id;
        return $this->fetchData($url);
    }

    private function fetchData(string $url): array
    {
        // Usamos el operador @ para manejar el error de forma controlada
        $response = @file_get_contents($url);

        if ($response === false) {
            return [
                "error" => "No se pudo conectar con el servidor",
                "results" => []
            ];
        }

        // En PHP 7 ya es estándar el uso de json_decode
        $decoded = json_decode($response, true);

        // Retornamos el arreglo o un arreglo vacío si el JSON es inválido
        return $decoded ?? [];
    }
}
