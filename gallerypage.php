<?php

require 'config.php';

require 'functions.php';

// princiapply this one needs to parameters in the GET. We need to recieve what page we are on 
// as well as the location

$current_page = getPage();
$current_page = sanitize($current_page);

// first thing is first, we need to recieve exactly what location's photos we are bringing up.

$id_location = (isset($_GET['id_location'])) ? $_GET['id_location'] : false;
$id_location = sanitize($id_location);

if($id_location === false){ // lil bit o validation
    header('location: ' . RUTA . 'error.php');
    die();
}

// Now that we have thsi crucial information, connect to db, and run a query
// for this page's three pictures.

$connection = createConnection($database_info);

// validate the connection
if(!$connection){
    header('location: ' . RUTA . 'error.php');
    die();
}

// connection has been made and validated, go ahead and run the query

// first up we decide max number of pages, so get amount of rows
// this symbolizes the amount of posts under that location

$total_posts = get_specificLocationQuant($connection, $id_location);

// a lil validation

// echo $id_location;
// echo '<br>';
// echo $total_posts;

// now with total posts we can get max number of pages

$total_pages = $total_posts / posts_per_page;
$total_pages = ceil($total_pages);

// echo $total_pages; // a lil validation

// run a query to return the posts for this specific page

$photos = getPhotos($connection, $id_location, $current_page);

// print_r($photos); a lil validation

$index = getLocationIndex($connection, $id_location);
// var_dump($index); // a lil validation

if(!$index){
    header('location: ' . RUTA . 'error.php');
    die();
}

$returnpage = $index / posts_per_page;
$returnpage = ceil($returnpage);






require 'views/gallerypage.view.php';

?>