<?php  
    class Database{
        private $user="root";
        private $host="localhost";
        private $pass="";
        private $name="Database";
        private $conn=null;
        private $result=null;
        function connect() {
            $this->conn=new mysqli($this->host,$this->user,$this->pass,$this->name);
        
            if($this->conn){
                mysqli_query($this->conn,"SET NAMES 'utf8'");
            }   
            else{
                echo "kết nối thất bại".mysqli_connect_error();
                exit();
            }
            return $this->conn;
        }
        public function disconnect(){
            $this->conn->close();
        }
        
        //thực thi câu truy vấn
        public function execute($sql){
            $this->result =$this->conn->query($sql) or die($this->conn->mysqli_connect_error);
            return $this->result ;          
        }

        //phương thức lấy dữ liệu
        public function getData(){
            if($this->result){//kiểm tra xem đã chạy câu lệnh truy vấn hay chưa(câu lệnh truy vấn có tồn tại hay không)
                $data=mysqli_fetch_array($this->result);//mysqli_fetch_array là 1 mảng lưu trữ các dữ liệu của 1 bản ghi khi chạy câu truy vấn
            }
            else{
                $data=0;
            }
            return $data;
        }

        //phương thức lấy toàn bộ dữ liệu cua
        public function getAllData($table){
            $sql="select*from $table";
            $this->execute($sql);
            if($this->num_rows()==0){
                $data=0;
            }
            else{//kiểm tra xem đã chạy câu truy vấn hay chưa 
                while($datas=$this->getData()){//trong khi $this->getData() còn dữ liệu
                    $data[]=$datas;
                }
            }
            return $data;
        }
        public function getDataByQuery($sql){
            $this->execute($sql);
            if($this->num_rows()==0){
                $data=0;
            }
            else{
                while($datas=$this->getData()){
                    $data[]=$datas;
                }
            }
            return $data;
        }

        //phương thức đếm số bản ghi
        public function num_rows(){
            if($this->result){
                $num=mysqli_num_rows($this->result);
            }
            else{
                $num=0;
            }
            return $num;
        }
    }

?>