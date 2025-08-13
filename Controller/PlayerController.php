<?php

namespace Controller;

use Model\Player;

class PlayerController {
    public function getPlayers() {
        $player = new Player();
        $players = $player->getPlayers();

        if ($players) {
            header("Content-Type: application/json; charset=utf-8", true, 200);
            echo json_encode($players, JSON_UNESCAPED_UNICODE);
        } else {
            header("Content-Type: application/json; charset=utf-8", true, 404);
            echo json_encode(["message"=> "No players found"], JSON_UNESCAPED_UNICODE);
        }
    }

    public function getPlayerById($id) {
        if ($id) {
            $player = new Player();
            $playerData = $player->getPlayerById($id);

            if ($playerData) {
                header("Content-Type: application/json; charset=utf-8", true, 200);
                echo json_encode($playerData, JSON_UNESCAPED_UNICODE);
            } else {
                header("Content-Type: application/json; charset=utf-8", true, 404);
                echo json_encode(["message" => "Player not found"], JSON_UNESCAPED_UNICODE);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8", true, 400);
            echo json_encode(["message" => "Invalid ID"], JSON_UNESCAPED_UNICODE);
        }
    }

    public function addPlayer() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->name) && isset($data->idade) && isset($data->altura) && isset($data->nacionalidade) && isset($data->posicao) && isset($data->pe) && isset($data->num_camisa)) {
            $player = new Player();
            // Sanitização de strings (previne XSS)
            $player->name = htmlspecialchars(trim($data->name), ENT_QUOTES, 'UTF-8');
            $player->nacionalidade = htmlspecialchars(trim($data->nacionalidade), ENT_QUOTES, 'UTF-8');
            $player->posicao = htmlspecialchars(trim($data->posicao), ENT_QUOTES, 'UTF-8');
            $player->pe = htmlspecialchars(trim($data->pe), ENT_QUOTES, 'UTF-8');

            // Validação de números
            $player->idade = filter_var($data->idade, FILTER_VALIDATE_INT);
            $player->altura = filter_var($data->altura, FILTER_VALIDATE_FLOAT);
            $player->num_camisa = filter_var($data->num_camisa, FILTER_VALIDATE_INT);

            if ($player->idade > 0 || $player->idade < 100) {
                if ($player->altura > 0 || $player->altura < 100) {
                    if(in_array($player->posicao, ["Goleiro", "Zagueiro", "Lateral Direito", "Lateral Esquerdo", "Volante", "Meia Atacante", "Meia Armador", "Ponta Esquerda", "Centroavante", "Ponta Direita"])) {
                        if(in_array($player->pe, ["Canhoto", "Esquerdo", "Destro", "Direito", "Ambos", "Ambidestro"])) {
                            if($player->num_camisa > 0 || $player->num_camisa < 100) {
                                if ($player->addPlayer()) {
                                    header("Content-Type: application/json; charset=utf-8", true, 201);
                                    echo json_encode(["message"=> "Player added sucessfully"], JSON_UNESCAPED_UNICODE);
                                } else {
                                    header("Content-Type: application/json; charset=utf-8", true, 500);
                                    echo json_encode(["message"=> "Failed to add player"], JSON_UNESCAPED_UNICODE);
                                }
                            } else {
                                header("Content-Type: application/json; charset=utf-8", true, 500);
                                echo json_encode(["message"=> "Número da Camisa Inválido"], JSON_UNESCAPED_UNICODE);
                            }
                        } else {
                            header("Content-Type: application/json; charset=utf-8", true, 500);
                            echo json_encode(["message"=> "Pé Dominante Inválido"], JSON_UNESCAPED_UNICODE);
                        }
                    } else {
                        header("Content-Type: application/json; charset=utf-8", true, 500);
                        echo json_encode(["message"=> "Posição Inválida"], JSON_UNESCAPED_UNICODE);
                    }
                } else {
                    header("Content-Type: application/json; charset=utf-8", true, 500);
                    echo json_encode(["message"=> "Altura Inválida"], JSON_UNESCAPED_UNICODE);
                }
            } else {
                header("Content-Type: application/json; charset=utf-8", true, 500);
                echo json_encode(["message"=> "Idade Inválida"], JSON_UNESCAPED_UNICODE);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8", true, 400);
            echo json_encode(["message"=> "Invalid input"], JSON_UNESCAPED_UNICODE);
        }
    }

    public function updatePlayer() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id) && isset($data->name) && isset($data->idade) && isset($data->altura) && isset($data->nacionalidade) && isset($data->posicao) && isset($data->pe) && isset($data->num_camisa)) {
            $player = new Player();
            $player->id = filter_var($data->id, FILTER_VALIDATE_INT);
            $player->name = htmlspecialchars(trim($data->name), ENT_QUOTES, 'UTF-8');
            $player->nacionalidade = htmlspecialchars(trim($data->nacionalidade), ENT_QUOTES, 'UTF-8');
            $player->posicao = htmlspecialchars(trim($data->posicao), ENT_QUOTES, 'UTF-8');
            $player->pe = htmlspecialchars(trim($data->pe), ENT_QUOTES, 'UTF-8');

            $player->idade = filter_var($data->idade, FILTER_VALIDATE_INT);
            $player->altura = filter_var($data->altura, FILTER_VALIDATE_FLOAT);
            $player->num_camisa = filter_var($data->num_camisa, FILTER_VALIDATE_INT);

            if ($player->idade > 0 || $player->idade < 100) {
                if ($player->altura > 0 || $player->altura < 100) {
                    if(in_array($player->posicao, ["Goleiro", "Zagueiro", "Lateral Direito", "Lateral Esquerdo", "Volante", "Meia Atacante", "Meia Armador", "Ponta Esquerda", "Centroavante", "Ponta Direita"])) {
                        if(in_array($player->pe, ["Canhoto", "Esquerdo", "Destro", "Direito", "Ambos", "Ambidestro"])) {
                            if($player->num_camisa > 0 || $player->num_camisa < 100) {
                                if ($player->updatePlayer()) {
                                    header("Content-Type: application/json; charset=utf-8", true, 200);
                                    echo json_encode(["message"=> "Player updated sucessfully"], JSON_UNESCAPED_UNICODE);
                                } else {
                                    header("Content-Type: application/json; charset=utf-8", true, 500);
                                    echo json_encode(["message"=> "Failed to update player"], JSON_UNESCAPED_UNICODE);
                                }
                            } else {
                                header("Content-Type: application/json; charset=utf-8", true, 500);
                                echo json_encode(["message"=> "Número da Camisa Inválido"], JSON_UNESCAPED_UNICODE);
                            }
                        } else {
                            header("Content-Type: application/json; charset=utf-8", true, 500);
                            echo json_encode(["message"=> "Pé Dominante Inválido"], JSON_UNESCAPED_UNICODE);
                        }
                    } else {
                        header("Content-Type: application/json; charset=utf-8", true, 500);
                        echo json_encode(["message"=> "Posição Inválida"], JSON_UNESCAPED_UNICODE);
                    }
                } else {
                    header("Content-Type: application/json; charset=utf-8", true, 500);
                    echo json_encode(["message"=> "Altura Inválida"], JSON_UNESCAPED_UNICODE);
                }
            } else {
                header("Content-Type: application/json; charset=utf-8", true, 500);
                echo json_encode(["message"=> "Idade Inválida"], JSON_UNESCAPED_UNICODE);
            }

        } else {
            header("Content-Type: application/json; charset=utf-8", true, 400);
            echo json_encode(["message"=> "Invalid input"], JSON_UNESCAPED_UNICODE);
        }
    }

    public function deletePlayer() {
        $id = filter_var($_GET["id"] ?? null, FILTER_VALIDATE_INT);

        if ($id) {
            $player = new Player();
            $player->id = $id;

            if ($player->deletePlayer()) {
                header("Content-Type: application/json; charset=utf-8", true, 200);
                echo json_encode(["message"=> "Player deleted successfully"], JSON_UNESCAPED_UNICODE);
            } else {
                header("Content-Type: application/json; charset=utf-8", true, 500);
                echo json_encode(["message"=> "Failed to delete player"], JSON_UNESCAPED_UNICODE);
            }
        } else {
            header("Content-Type: application/json; charset=utf-8", true, 400);
            echo json_encode(["message"=> "Invalid ID"], JSON_UNESCAPED_UNICODE);
        }
    }
}

?>