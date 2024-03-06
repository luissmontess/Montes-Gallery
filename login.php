<?php session_start();

// load function
require 'config.php';
require 'functions.php';

// check if session is set, if so, go ahead and let him in to the administration panel
if(isset($_SESSION['admin'])){
    header('location: ' . RUTA . 'admin/indexadmin.php');
}

//empty errormsg which is also part of the validation
$errormsg = '';

// check the POST for the user's input credentials
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    $password = hash('sha512', $password);

    // once we recieved the username nad hashed the password, create connection
    $connection = createConnection($database_info);

    // check if the username is correct 
    $checkuser = checkUser($connection, $username);

    if($checkuser!==false){

        // check if the password is correct 
        $checkuserpassword = checkUserPassword($connection, $username, $password);

        if($checkuserpassword!==false){

            // once everything is correct start session and redirect to the admin index 
            $_SESSION['admin'] = $username;
            header('location: ' . RUTA . 'admin/indexadmin.php');
        }else{
            $errormsg.='<li>Wrong Password</li>';
        }
    }else{
        $errormsg.= '<li>Wrong Username</li>';
    }
}




require 'views/login.view.php';

?>