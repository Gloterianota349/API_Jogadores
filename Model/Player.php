<?php

namespace Model;

use PDO;
use Model\Connection;

class Player {
    private $conn;

    public $id;
    public $name;
    public $idade;
    public $altura;
    public $nacionalidade;
    public $posicao;
    public $pe;
    public $num_camisa;

    public function __construct() {
        $this->conn = Connection::getConnection();
    }

    public function getPlayers() {
        $sql = "SELECT * FROM jogadores";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPlayer() {
        $sql = "INSERT INTO jogadores (name, idade, altura, nacionalidade, posicao, pe, num_camisa) VALUES (:name, :idade, :altura, :nacionalidade, :posicao, :pe, :num_camisa)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":idade", $this->idade, PDO::PARAM_INT);
        $stmt->bindParam(":altura", $this->altura, PDO::PARAM_STR);
        $stmt->bindParam(":nacionalidade", $this->nacionalidade, PDO::PARAM_STR);
        $stmt->bindParam(":posicao", $this->posicao, PDO::PARAM_STR);
        $stmt->bindParam(":pe", $this->pe, PDO::PARAM_STR);
        $stmt->bindParam(":num_camisa", $this->num_camisa, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function updatePlayer() {
        $sql = "UPDATE jogadores SET name = :name, idade = :idade, altura = :altura, nacionalidade = :nacionalidade, posicao = :posicao, pe = :pe, num_camisa = :num_camisa WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":idade", $this->idade, PDO::PARAM_INT);
        $stmt->bindParam(":altura", $this->altura, PDO::PARAM_STR);
        $stmt->bindParam(":nacionalidade", $this->nacionalidade, PDO::PARAM_STR);
        $stmt->bindParam(":posicao", $this->posicao, PDO::PARAM_STR);
        $stmt->bindParam(":pe", $this->pe, PDO::PARAM_STR);
        $stmt->bindParam(":num_camisa", $this->num_camisa, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deletePlayer() {
        $sql = "DELETE FROM jogadores WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>