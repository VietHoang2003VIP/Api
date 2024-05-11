<?php
    include '../DBConfig.php';
    class categoryModel extends Database
    {
        public $cid;
        public $cname;
        public $cdesc;
        public $cimage;
        public function __construct()
        {
            $this->connect();
        }
        public function read(){
            $result=array();
            $datas=$this->getAllData("categories");
            if($datas!=0){
                foreach($datas as $data){
                    $category_item=array(
                        'cid'=>$data['cid'],
                        'cname'=>$data['cname'],
                        'cdesc'=>$data['cdesc'],
                        'cimage'=>$data['cimage']
                    );
                    array_push($result,$category_item);
                }
                return $result;
            }
            return 0;
        
        }
        public function insert(){
            if($this->isDuplicate()){
            }else{
                $query="INSERT INTO categories(cid,cname,cimage,cdesc) VALUES(null,'$this->cname',$this->cimage,$this->cdesc)";
                $this->execute($query);
                //tra ve id cua san pham vua them vao
                $query="SELECT MAX(cid) AS cid FROM categories";
                $this->execute($query);
                return $this->getData();
            }
        }
        public function delete(){
            $query="DELETE FROM categories WHERE cid=$this->cid";
            return $this->execute($query);
        }
        public function update(){
            if($this->isDuplicate2()){
                return false;
            }else{
                $query="UPDATE categories SET cname='$this->cname', cimage=$this->cimage, cdesc='$this->cdesc' WHERE cid=$this->cid";
                return $this->execute($query);
            }
        }
        public function isDuplicate(){
            $query="SELECT * FROM categories WHERE cname='$this->cname'";
            $result=$this->execute($query);
            if($this->getData()!=0){
                return true;
            }
            return false;
        }
        public function isDuplicate2(){
            $query="SELECT * FROM categories WHERE cname='$this->cname' and cid <> $this->cid";
            $result=$this->execute($query);
            if($this->getData()!=0){
                return true;
            }
            return false;
        }
    }
    
?>