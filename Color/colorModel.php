<?php
    include '../DBConfig.php';
    class colorModel extends Database
    {
        public $colorid;
        public $colorname;
        public $colorstatus;
        public function __construct()
        {
            $this->connect();
        }
        public function read(){
            $result=array();
            $datas=$this->getAllData("color");
            if($datas!=0){
                foreach($datas as $data){
                    $color_item=array(
                        'colorid'=>$data['colorid'],
                        'colorname'=>$data['colorname'],
                        'colorstatus'=>$data['colorstatus']
                    );
                    array_push($result,$color_item);
                }
                return $result;
            }
            return 0;
        
        }
        public function insert(){
            if($this->isDuplicate()){
            }else{
                $colorname=$this->colorname;
                $query="INSERT INTO color(colorid,colorname,colorstatus) VALUES(null,'$colorname',$this->colorstatus)";
                $this->execute($query);
                //tra ve id cua san pham vua them vao
                $query="SELECT MAX(colorid) AS colorid FROM color";
                $this->execute($query);
                return $this->getData();
            }
        }
        public function delete(){
            $query="DELETE FROM color WHERE colorid=$this->colorid";
            return $this->execute($query);
        }
        public function update(){
            if($this->isDuplicate2()){
                return false;
            }else{
                $query="UPDATE color SET colorname='$this->colorname', colorstatus=$this->colorstatus WHERE colorid=$this->colorid";
                return $this->execute($query);
            }
        }
        public function isDuplicate(){
            $query="SELECT * FROM color WHERE colorname='$this->colorname'";
            $result=$this->execute($query);
            if($this->getData()!=0){
                return true;
            }
            return false;
        }
        public function isDuplicate2(){
            $query="SELECT * FROM color WHERE colorname='$this->colorname' and colorid <> $this->colorid";
            $result=$this->execute($query);
            if($this->getData()!=0){
                return true;
            }
            return false;
        }
    }
    
?>