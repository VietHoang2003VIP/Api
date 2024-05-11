<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
    include "colorModel.php";
    $color=new colorModel;
    $result=$color->read();        
    echo json_encode($result);
           
?>