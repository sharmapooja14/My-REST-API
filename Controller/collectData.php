<?php
// include database and object files
include_once '../Model/dbConnect.php';
include_once '../Model/queriesCrud.php';

// get database connection
$DBConnect = new dbConnect();
$db = $DBConnect->getConnection();
 
// prepare user object
$queriesCurd = new QueriesCurd($db);
// set ID property of user to be edited

$queriesCurd->username = isset($_GET['username']);
$queriesCurd->password = base64_encode(isset($_GET['password']));
// read the details of user to be edited
$stmt = $queriesCurd->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "id" => $row['id'],
        "username" => $row['username']
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}
// make it json format
print_r(json_encode($user_arr));
?>