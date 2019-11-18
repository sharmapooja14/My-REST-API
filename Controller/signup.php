<?php
 
// get database connection
include_once '../Model/dbConnect.php';
;
// instantiate user object
include_once '../Model/queriesCrud.php';
// get database connection
$DBConnect = new dbConnect();
$db = $DBConnect->getConnection();
 
$queriesCurd = new QueriesCurd($db);
 
// set user property values

$queriesCurd->username = $_POST['username'];
$queriesCurd->password = $_POST['password'];
 
// create the user
if($queriesCurd->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $queriesCurd->id,
        "username" => $queriesCurd->username
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!",
        "id" => $queriesCurd->id,
        "username" => $queriesCurd->username
    );
}
print_r(json_encode($user_arr));
?>