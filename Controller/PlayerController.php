<?php

namespace Controller;

use Model\Player;

class PlayerController {
    public function getPlayers() {
        $player = new Player();
        $players = $player->getPlayers();

        if ($players) {
            header("Content-Type: application/json", true, 200);
            echo json_encode($players);
        } else {
            header("Content-Type: application/json", true, 404);
            echo json_encode(["message"=> "No players found"]);
        }
    }

    public function addPlayer() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->name) && isset($data->idade) && isset($data->altura) && isset($data->nacionalidade) && isset($data->posicao) && isset($data->pe) && isset($data->num_camisa)) {
            $player = new Player();
            $player->name = $data->name;
            $player->idade = $data->idade;
            $player->altura = $data->altura;
            $player->nacionalidade = $data->nacionalidade;
            $player->posicao = $data->posicao;
            $player->pe = $data->pe;
            $player->num_camisa = $data->num_camisa;

            if ($player->addPlayer()) {
                header("Content-Type: application/json", true, 201);
                echo json_encode(["message"=> "Player added sucessfully"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message"=> "Failed to add player"]);
            }

        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message"=> "Invalid input"]);
        }
    }

    public function updatePlayer() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id) && isset($data->name) && isset($data->idade) && isset($data->altura) && isset($data->nacionalidade) && isset($data->posicao) && isset($data->pe) && isset($data->num_camisa)) {
            $player = new Player();
            $player->id = $data->id;
            $player->name = $data->name;
            $player->idade = $data->idade;
            $player->altura = $data->altura;
            $player->nacionalidade = $data->nacionalidade;
            $player->posicao = $data->posicao;
            $player->pe = $data->pe;
            $player->num_camisa = $data->num_camisa;

            if ($player->updatePlayer()) {
                header("Content-Type: application/json", true, 200);
                echo json_encode(["message"=> "Player updated sucessfully"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message"=> "Failed to update player"]);
            }

        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message"=> "Invalid input"]);
        }
    }

    public function deletePlayer() {
        $id = $_GET["id"] ?? null;

        if ($id) {
            $player = new Player();
            $player->id = $id;

            if ($player->deletePlayer()) {
                header("Content-Type: application/json", true, 200);
                echo json_encode(["message"=> "Player deleted successfully"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message"=> "Failed to delete player"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message"=> "Invalid ID"]);
        }
    }
}

?>