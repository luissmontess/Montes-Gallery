<?php

require 'config.php';
require 'functions.php';

$id_photo = (isset($_GET['id_photo'])) ? $_GET['id_photo'] : false;

if(!$id_photo){
    header('location: ' . RUTA . 'error.php');
    die();
}

// echo $id_photo;

// create connection and validate
$connection = createConnection($database_info);
if(!$connection){
    header('location: ' . RUTA . 'error.php');
    die();
}

// actually get photo info in an array
$photo = getPhoto($connection, $id_photo);

// echo $id_photo;
// echo '<br>';
// echo $id_location;
// var_dump($photo); //  a lil validation

// runs a query to get all photos of the location then a while loop that counts till
// it finds the position of the array where it is.
$index = getIndexPhoto($connection, $photo['id_photo'], $photo['id_location']); 
// var_dump($index);

if(!$index){
    header('location: ' . RUTA . 'error.php');
    die();
}

$return_page = $index / posts_per_page;
$return_page = ceil($return_page);
// echo $return_page; // a lil validation
require 'views/photo.view.php';

?>