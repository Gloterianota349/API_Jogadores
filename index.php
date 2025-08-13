<?php

require_once __DIR__ ."/vendor/autoload.php";

use Controller\PlayerController;
$playerController = new PlayerController();

$method = $_SERVER["REQUEST_METHOD"];

// Pega o caminho da URL e separa as partes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');
$parts = explode('/', $uri);

// Ajusta o índice da rota considerando que a pasta do projeto pode ser /Jogadores
$baseIndex = array_search('Jogadores', $parts); // encontra a posição da pasta base

switch ($method) {
    case "GET":
        // Se a rota for /Jogadores/{id}
        if (isset($parts[$baseIndex + 1]) && is_numeric($parts[$baseIndex + 1])) {
            $id = (int)$parts[$baseIndex + 1];
            $playerController->getPlayerById($id);
        } else {
            // Mantém o comportamento atual de listar todos
            $playerController->getPlayers();
        }
        break;
    case "POST":
        $playerController->addPlayer();
        break;
    case "PUT":
        $playerController->updatePlayer();
        break;
    case "DELETE":
        $playerController->deletePlayer();
        break;
    default:
        echo json_encode(["message"=> "Method not allowed"]);
        break;
}

?>