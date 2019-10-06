<?php
    class Quote{
        private $conn;
        private $table = "quotes";

        public $id;
        public $body;
        public $author_name;
        public $author_id;

        public function __construct($db){
            $this->conn = $db;
        }

        public function randomQuotes(){
            $query = 'SELECT 
                    a.name as author_name,
                    q.id,
                    q.body,
                    q.author_id
                FROM
                    '.$this->table.' q
                LEFT JOIN
                    authors as a ON q.author_id = a.id
                ORDER BY RAND()
                LIMIT 10';

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $quotes = $stmt->fetchAll(); 

            return $quotes;
        }

        
    }
?>