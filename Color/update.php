<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
    include "colorModel.php";
    $color=new colorModel;
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
?>