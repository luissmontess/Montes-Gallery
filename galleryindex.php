<?php

require 'config.php';
require 'functions.php';


// we get the amount of posts per page
$posts_per_page = posts_per_page;

// get the page the user is currently on
$current_page = getPage();
$current_page = sanitize($current_page);

// echo $current_page;

// establish a connection to the database
$connection = createConnection($database_info);

// validate the connection
if(!$connection){
    header('location: ' . RUTA . 'error.php');
    die();
}

// once we have the connection, One hting I have thought of is to have nother tale that just stores a number
// but thats a hassle, so we'll just run COUNT
// get total posts

$total_posts = getRowAmount($connection, "locations");

$total_pages = $total_posts / posts_per_page;

$total_pages = ceil($total_pages);


// print_r($amount); //quick validation
// returns an array of arrays with all the info of each location

$locations = getLocationArray($connection, $current_page);

// foreach($locations as $location){
//     echo $location['location'] . '<br>';  // a lil bit of validation
// }

// next up we need to run a query for each location and return the name of only one image.
// Then all the names, we round them up in one array, and in the view, we display them with a foreach.
// For reusability purposes, its best if it returns the image along with all its other information.

$location_pics = getImages_per_Location($connection, $locations);

//print_r($location_pics);  // simple validation

$cover_photos = array();

foreach($location_pics as $location_pic){
    $location_pic = $location_pic[0];

    // echo $location_pic['id_location'] . '<br>';  // a lil bit of validation
    // functions.php, line 54

    array_push($cover_photos, $location_pic);
}

// print_r($cover_photos); // a lil validation




require 'views/galleryindex.view.php';

?>