<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
    include "colorModel.php";
    $color=new colorModel;
    $action=$_REQUEST['action'];
    switch ($action) {
        case 'read':
            header("Access-Control-Allow-Methods:GET");
            $result=$color->read();        
            echo json_encode($result);
            break;
        case 'insert':
            header("Access-Control-Allow-Methods:POST");
            $data=json_decode(file_get_contents("php://input"));
            $color->colorname=$data->colorname;
            $color->colorstatus=$data->colorstatus;
            $id=$color->insert()['colorid'];
            if($id>0){
                $color->colorid=$id;
                echo json_encode($color);
            }else{
                echo json_encode(null);
            }
            break;
        case 'update':
            header("Access-Control-Allow-Methods:POST");
            $data=json_decode(file_get_contents("php://input"));//lấy dữ liệu về
            $color->colorid=$data->colorid;
            $color->colorname=$data->colorname;
            $color->colorstatus=$data->colorstatus;
            if($color->update()){
                echo json_encode($color);
            }else{
                echo json_encode(null);
            }
            break;
        case 'delete':
            header("Access-Control-Allow-Methods:POST");
            $data=json_decode(file_get_contents("php://input"));//lấy dữ liệu về
            //$color->colorid=$data->colorid;
            $color->colorid=$_REQUEST['colorid'];
            if($color->delete()){
                echo json_encode(true);
            }else{
                echo json_decode(false);
            }
            break;
        default:
            # code...
            break;
    }
?>