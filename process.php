<?php
include "config/db.php";

if(!empty($_FILES['files']['name'][0])){



    //declare variables
    $indexes_with_ext_error = array();
    $indexes_with_php_error = array();
    $i = 0;
    $ext_error = false;
    $query = "INSERT INTO album_one (name, path) VALUES ('pic','/path')";
    $names_array = $_FILES['files']['name'];
    $errors_array = $_FILES['files']['error'];
    $tmp_name_array = $_FILES['files']['tmp_name'];
    //ext errors
    $extentions = array('jpg','jpeg','gif','png');
    
    //check for php and ext errors
    for($i = 0; $i < count($names_array); $i++){
        //isolate file extention 
        $exploded_array = explode('.', $names_array[$i] );
        $file_extention = end($exploded_array);
        //if file ext doesn't match array, add index to $indexes_with_ext_error
        if(!in_array($file_extention, $extentions)){
            array_push($indexes_with_ext_error, $i);
        }
        //if theres a php error, put the index and code in associative array: $indexes_with_php_error_and_code
        if($errors_array[$i]){
            array_push($indexes_with_php_error_and_code, array('index'=> $i,'code'=> $errors_array[$i]));
        }
    }

    function create_query($pic, $path){
        return "INSERT INTO album_one (name, path) VALUES ('".$pic . "','" . $path . "')";
    }

    //if there are any ext error, set ext_err to true
    if(!empty($indexes_with_ext_error)){
        $ext_error = true;
    }

    

    //upload if no errors
    if(!empty($indexes_with_php_error_and_code)){

        echo "php error";
    }
    else if($ext_error){
        echo "invalid extention";
    }
    else{
        for($i = 0; $i < count($names_array); $i++)

            if(move_uploaded_file($tmp_name_array[$i], "img/album-one/".$names_array[$i]) &&
             mysqli_query($connect, create_query($names_array[$i], "img/album-one/".$names_array[$i]))){
            
                echo "upload success!"."<br>";
            }
        else{
            echo "upload failed";
        }
    }

    function add_pre($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    
    
    add_pre($_FILES);
    echo "to null";
    $_FILES = null;
    add_pre($_FILES);
    echo !isset($_FILES);

    
}   

?>

<a href="upload.php">upload more pics</a>