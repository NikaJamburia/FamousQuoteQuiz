<?php
    class Author{
        private $conn;
        private $table = "authors";

        public $id;
        public $name;

        public function __construct($db){
            $this->conn = $db;
        }

        public function binary_IncorrectAnswer($correct_answer){
            $query = 'SELECT * FROM '.$this->table.' WHERE NOT id = ?
                ORDER BY RAND()
                LIMIT 1';

            $stmt = $this->conn->prepare($query);

            $stmt->execute([$correct_answer]);

            $authors = $stmt->fetch(); 

            return $authors;
        }

        public function multiple_IncorrectAnswers($correct_answer){
            $query = 'SELECT * FROM '.$this->table.' WHERE NOT id = ?
                ORDER BY RAND()
                LIMIT 2';

            $stmt = $this->conn->prepare($query);

            $stmt->execute([$correct_answer]);

            $authors = $stmt->fetchAll(); 

            return $authors;
        }

        
    }
?>