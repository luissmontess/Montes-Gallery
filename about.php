<?php

require 'config.php';
require 'functions.php';

$connection = createConnection($database_info);


// validate connection
if(!$connection){
    header('location: ' . RUTA . 'error.php');
    die();
}else{
    // retrieve titel and text
    // available types = 'about' and 'philosophy'
    $article_array = getArticle($connection, 'about');
    $article_array = $article_array[0];
}

// print_r($article_array);




require 'views/about.view.php';

?>