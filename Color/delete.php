<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
    include "colorModel.php";
    $color=new colorModel;
    header("Access-Control-Allow-Methods:POST");
    $color->colorid=isset($_REQUEST['colorid'])?$_REQUEST['colorid']:"";
    $color->delete();
?>