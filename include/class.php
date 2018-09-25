<?php
    class Schedule{
        public function __construct($table, $id=false){
            $this->table = $table;
            $this->id = $id;
        }

        public function write($mysqli, $author, $title, $content, $start_date, $end_date){
            $sql = "INSERT INTO $this->table (author, title, content, start_date, end_date) VALUES (?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('sssss', $author, $title, $content, $start_date, $end_date);
            $stmt->execute();
            $stmt->close();

            // $sql = "INSERT INTO $this->table (author, title, content, start_date, end_date) VALUES ('$author', '$title', '$content', '$start_date', '$end_date')";
            // $mysqli->query($sql);
        }
    }


 ?>
