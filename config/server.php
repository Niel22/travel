<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    
    header("location:../404.php");
    die;
}


$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'wooxtravel';

try{
    $conn = new PDO("mysql: host=$host; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    echo "Error connecting" . $e->getMessage();
}

?>