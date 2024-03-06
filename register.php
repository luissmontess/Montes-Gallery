<?php session_start();

// load functions
require 'config.php';
require 'functions.php';


if(isset($_SESSION['admin'])){
    header('location: ' . RUTA . 'admin/indexadmin.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = sanitize($_POST['username']);   
    $password = $_POST['password'];
    $password2 = $_POST['password2']; 
    
    $errormsg = '';
    
    if(empty($username) || empty($password) || empty($password2)){
        $errormsg.= '<li>All fields are required</li>';
    }else{

        //create and validate connection
        $connection = createConnection($database_info);

        if(!$connection){
            header('location: ' . RUTA . 'error.php');
            die();
        }

        // check if the user already exists
        $check = checkUser($connection, $username);

        if($check!=false){
            $errormsg.='<li>User already exists. </li>';
        }

        $password = hash('sha512', $password);
        $password2 = hash('sha512', $password2);
        // echo $username . '<br>' . $password . '<br>' . $password2;

        // check if the passwords are actually the same
        if($password!=$password2){
            $errormsg.='<li>Paswords are not equal. </li>';
        }
    }

    if(empty($errormsg)){
        // if no errors go ahead and insert into database
        $statement = $connection->prepare("INSERT INTO users (id_user, username, password) VALUES (NULL, :username, :password)");
        $statement->execute(array(':username' => $username, ':password' => $password));
        header('location: login.php');
    }
    
}

require 'views/register.view.php';

?>