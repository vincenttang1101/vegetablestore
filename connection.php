<?php
class DBConnection{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "vegetablestore";
    
    protected $connection;

    // Phương thức kết nối
    public function connect(){
        if(!isset($this->connetion)){
            $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
            mysqli_set_charset($this->connection,'utf8'); //khắc phục lỗi Font Tiếng Việt
            if(!$this->connection){
                echo "Kết nối thất bại";
                
            }
        }
        return $this->connection;
    }

    // Phương thức thực thi lệnh truy vấn (insert,delete,update)
    public function execute($query){
        $result = $this->connection->query($query);
        if($result == false){
            return false;
        } else return true;

    }

    // Phương thức (dành cho select)
    public function executeResult($sql){
        $result = $this->connection->query($sql);
        if($result == false){
            return false;
        }
        $row = array();

        while($row = $result->fetch_array()){
            $rows[] = $row;  

        }
        if(!isset($rows)){
            return false;
        }
        else {   
            return $rows;
        }
    }

    // Phương thức tự đông thêm theo khoá chính
    public function execute_lastid($sql){
        $result = $this->connection->query($sql);
        if ($result == true){
            $last_id = $this->connection->insert_id;
            return $last_id;
        } else {
            echo $this->connection->error;
        }
    }


    // Phương thức lấy ID cuối cùng khi execute_query
    public function insert_id(){
        $result = $this->connection->insert_id;
        if($result == false){
            return false;
        } else return true;
    }

   
}
?>