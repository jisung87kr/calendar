<?php
    class Schedule{
        public function __construct($table){
            $this->table = $table;
        }

        public function write($mysqli, $author, $title, $content, $start_date, $end_date){
            $sql = "INSERT INTO $this->table (author, title, content, start_date, end_date) VALUES (?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('sssss', $author, $title, $content, $start_date, $end_date);
            $stmt->execute();
            $stmt->close();
            $this->insert_id = $mysqli->insert_id;
        }

        public function getPost($mysqli, $id){
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($id, $title, $author, $content, $start_date, $end_date);
            $stmt->fetch();
            $stmt->close();

            $this->id = $id;
            $this->title = $title;
            $this->author = $author;
            $this->content = $content;
            $this->start_date = $start_date;
            $this->end_date = $end_date;
        }

        public function getList($mysqli, $page, $row_num, $block_num){
            $sql = "SELECT * FROM $this->table";
            $mysqli->query($sql);
        }
    }


 ?>
