<?php
    require_once dirname(__DIR__) . "/inc/bddConfig.php"; 
    
    class Player {
        private $pdo;

        function __construct() {
            $this->pdo = $GLOBALS['dbTyping'];
        }

        public function getAll() {
            $allPlayer = array();
            $req = $this->pdo->prepare("SELECT * FROM Player");
            $req->execute();
            while($row = $req->fetch(PDO::FETCH_OBJ))
                array_push($allPlayer, $row);

            return $allPlayer;
        }

        public function getAllScore($game) {
            $allScore = array();
            $req = $this->pdo->prepare("SELECT * FROM Highscore WHERE idGame = $game ORDER BY time LIMIT 5");
            $req->execute();
            while($row = $req->fetch(PDO::FETCH_OBJ))
                array_push($allScore, $row);

            return $allScore;
        }

        public function save($name) {
            $ins = $this->pdo->prepare("INSERT INTO  Player(name) VALUES(".$this->pdo->quote($name).")");
            $ins->execute();
            return $this->pdo->lastInsertId();
        }

        public function getPlayer($id) {
            $player = null;
            $req = $this->pdo->prepare("SELECT * FROM Player WHERE id = $id");
            $req->execute();
            if($row = $req->fetch(PDO::FETCH_OBJ))
                $player = $row;

            return $player;
        }

        public function getPlayerByName($name) {
            $player = null;
            $req = $this->pdo->prepare("SELECT * FROM Player WHERE name = ".$this->pdo->quote($name));
            $req->execute();
            if($row = $req->fetch(PDO::FETCH_OBJ))
                $player = $row;

            return $player;
        }

        public function getScore($id, $game) {
            $score = null;
            $req = $this->pdo->prepare("SELECT * FROM Highscore WHERE idGame = $game AND idPlayer = $id");
            $req->execute();
            if($row = $req->fetch(PDO::FETCH_OBJ))
                $score = $row;

            return $score;
        }

        public function saveScore($id, $time) {
            $record = $this->getScore($id, 1);
            if($record != null) {
                if($record->time >= $time)
                    $req = $this->pdo->prepare("UPDATE Highscore SET time = ".$this->pdo->quote($time)." WHERE idGame = 1 AND idPlayer = $id");
                else
                    return false;
            } else
                $req = $this->pdo->prepare("INSERT INTO Highscore(idGame, idPlayer, time) VALUES (1, $id, ".$this->pdo->quote($time).")");

            $req->execute();
        }
    }
?>