<?php
    class Schedule{
        public function __construct($table){
            $this->table = $table;
        }

        public function write($mysqli, $author, $title, $content, $start_date, $end_date, $m, $id){
            if($m == 'u'){
                $sql = "UPDATE $this->table SET author = ?, title = ?, content = ?, start_date = ?, end_date = ? WHERE id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('sssssi', $author, $title, $content, $start_date, $end_date, $id);
                $stmt->execute();
                $stmt->close();
                $this->insert_id = $id;
                return false;
            }

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
            $stmt->bind_result($id, $author, $title, $content, $start_date, $end_date);
            $stmt->fetch();
            $stmt->close();

            if(!$id){
                die('게시글이 없습니다.');
            }

            $this->id = $id;
            $this->title = $title;
            $this->author = $author;
            $this->content = $content;
            $this->start_date = $start_date;
            $this->end_date = $end_date;
        }

        public function getList($mysqli){
            if(!empty($_GET['select']) && !empty($_GET['keyword'])){ // 검색일 경우
                if($_GET['select'] != 'all'){
                    $select = $mysqli->real_escape_string($_GET['select']);
                    $keyword = '%'.$_GET['keyword'].'%';
                    $sql = "SELECT count(*) AS cnt FROM $this->table WHERE $select LiKE ?";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param('s', $keyword);
                }
            } else { //전체 리스트
                $sql = "SELECT count(*) AS cnt FROM $this->table";
                $stmt = $mysqli->prepare($sql);
            }

            $stmt->execute();
            $stmt->bind_result($cnt);
            $result = $stmt->fetch();
            $stmt->close();


            $data = [];
            $total = $cnt; //전체 행의수
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


            if(!empty($_GET['select']) && !empty($_GET['keyword'])){
                $select = $mysqli->real_escape_string($_GET['select']);
                $keyword = '%'.$_GET['keyword'].'%';
                $sql = "SELECT * FROM $this->table WHERE author LIKE ? ORDER BY start_date DESC LIMIT $s_limit, $list";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('s', $keyword);

            } else {
                $sql = "SELECT * FROM $this->table ORDER BY start_date DESC LIMIT $s_limit, $list";
                $stmt = $mysqli->prepare($sql);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            for ($i=0; $row = $result->fetch_array(MYSQLI_ASSOC); $i++) {
                $data[$i] = $row;
            }
            $stmt->close();

            $select = (empty($_GET['select']) == false) ? $_GET['select'] : false;
            $keyword = (empty($_GET['keyword']) == false) ? $_GET['keyword'] : false;

            $paging = $this->getPaging($s_page, $e_page, $pageNum, $page, $select, $keyword);

            return [$data, $paging];
        }

        function getPaging($s_page, $e_page, $pageNum, $page, $select, $keyword){
            if($select && $keyword){
                $qsting = "&select=".$select."&keyword=".$keyword;
            } else {
                $qsting = "";
            }
            $paging = "<nav><ul class='pagination'>";
            if($s_page-1 >= 1){
                $paging .= "<li><a href='list.php?page=1".$qsting."'>first</a></li>";
                $paging .= "<li><a href='list.php?page=".($s_page-1).$qsting."'>prev</a></li>";
            }

            for ($i=$s_page; $i <= $e_page; $i++) {
                $active = ($page == $i)? "active" : "";
                $paging .= "<li class='".$active."'><a href='./list.php?page=".$i.$qsting."'>".$i."</a></li>";
            }

            if($e_page+1 <= $pageNum){
                $paging .= "<li><a href='list.php?page=".($e_page+1).$qsting."'>next</a></li>";
                $paging .= "<li><a href='list.php?page=".$pageNum.$qsting."'>last</a></li>";
            }

            $paging .= "</ul></nav>";

            return $paging;
        }
    }


 ?>
