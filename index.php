<?php

require_once __DIR__ ."/vendor/autoload.php";

use Controller\PlayerController;
$playerController = new PlayerController();

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        $playerController->getPlayers();
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