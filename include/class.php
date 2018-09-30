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

        public function getList($mysqli){
            $sql = "SELECT * FROM $this->table";
            $result =  $mysqli->query($sql);
            $data = [];

            $total = $result->num_rows; //전체 행의수
            $list = 10; // 한페이지에 보이는 게시글의 수
            $block = 3; // 블록당 페이지의 수
            $pageNum = ceil($total/10); // 전체 페이지의 수
            $blockNum = ceil($pageNum/$block); // 블록의 수
            $page = (isset($_GET['page']) == true) ? $_GET['page'] : 1; //현재 페이지
            $nowBlock = ceil($page/$block);
            $s_page = ($nowBlock*$block) - ($block - 1);
            if($s_page <= 1){
                $s_page = 1;
            }
            $e_page = $nowBlock*$block;
            if($e_page >= $pageNum){
                $e_page = $pageNum;
            }
            $s_limit = ($page-1)* $list;


            $sql = "SELECT * FROM $this->table ORDER BY start_date ASC LIMIT $s_limit, $list";
            $result = $mysqli->query($sql);
            for ($i=0; $row = $result->fetch_array(MYSQLI_ASSOC); $i++) {
                $data[$i] = $row;
            }

            $paging = $this->getPaging($s_page, $e_page, $pageNum, $page);

            return [$data, $paging];
        }

        function getPaging($s_page, $e_page, $pageNum, $page){
            $paging = "<nav><ul class='pagination'>";
            if($s_page-1 >= 1){
                $paging .= "<li><a href='list.php?page=1'>first</a></li>";
                $paging .= "<li><a href='list.php?page=".($s_page-1)."'>prev</a></li>";
            }

            for ($i=$s_page; $i <= $e_page; $i++) {
                $active = ($page == $i)? "active" : "";
                $paging .= "<li class='".$active."'><a href='./list.php?page=".$i."'>".$i."</a></li>";
            }

            if($e_page+1 <= $pageNum){
                $paging .= "<li><a href='list.php?page=".($e_page+1)."'>next</a></li>";
                $paging .= "<li><a href='list.php?page=".$pageNum."'>last</a></li>";
            }

            $paging .= "</ul></nav>";

            return $paging;
        }
    }


 ?>
