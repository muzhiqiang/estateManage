<?php
require_once('../model/uploadModel.php');
    $uploadModel = new uploadModel();
    // print_r($_FILES);
    // $name = $_FILES['fileDataFileName']['name'];
    // $filePath = $_FILES['fileDataFileName']['tmp_name'];
    // $type = $_FILES['fileDataFileName']['type'];
    // $uploadModel->postDoupload($name,$filePath,$type);
    echo json_encode(array('success'=>true,'file_path'=>"http://localhost/estateManagement/images/image.png"));
?>