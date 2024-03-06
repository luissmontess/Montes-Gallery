<?php 

// UNIVERSAL FUNCTIONS

// clean data
function sanitize($old_input) {
    $input = filter_var($old_input, FILTER_SANITIZE_STRING);
    $input = htmlspecialchars($input);
    $input = strip_tags($input);
    $input = stripslashes($input);
    return $input;
}

// get the current page that the user is on
function getPage() {
    $page = 1;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    return $page;
}

// Create a new connection to the photo database
function createConnection($db_array){
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=' . $db_array['dbname'], $db_array['username'], $db_array['password']);
        return $dbh;
    } catch (PDOException $e) {
        return false;
    }
}

// return amount of rows in location table

function getRowAmount($connection, $table_name) {
    $stmt = $connection->prepare("SELECT COUNT(*) AS row_count FROM $table_name"); // can't pass table name as ph
    $stmt->execute();
    $row_count = $stmt->fetch()['row_count'];
    return $row_count;
}

// ABOUT.PHP PHILOSOPHY.PHP ///////////////////////////////

function getArticle($connection, $type) {
    $stmt = $connection->prepare("SELECT * FROM luisarticles WHERE type = :type");
    $stmt->execute(array(
        ":type" => $type
    ));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// GALLERYINDEX.PHP ///////////////////////////////////////

// return an array with all the possible locations

function getLocationArray($connection, $current_page) {
    $posts = posts_per_page;
    $start = ($current_page == 1) ? 0 : ($current_page * posts_per_page) - posts_per_page;
    $stmt = $connection->prepare("SELECT * FROM locations LIMIT $start, $posts");
    $stmt->execute();
    $return_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $return_array;
}


// return an array with one image for each location. Fro reusan=bility, even though it might be a longshot
// it will return all info.

function getImages_per_Location($connection, $locations){
    $return_array = array();

    foreach ($locations as $location) {
        $stmt = $connection->prepare("SELECT photos.id_photo, photos.name, photos.title, photos.text, photos.id_location, locations.location
                                        FROM photos	
                                        JOIN locations ON photos.id_location = locations.id_location
                                        WHERE photos.id_location = :id_location
                                        LIMIT 1");
        $stmt->execute(array(
            ':id_location' => $location['id_location']
        ));

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        array_push($return_array, $result);
    }

    return $return_array;
}

// GALLERYPAGE.PHP ////////////////////////////////////////

// returns the amount of rows of a specific location id
// weird name, I know. If I could name this function Jerry, I would; that's even worse practice though. :(

function get_specificLocationQuant($connection, $id_location){
    $stmt = $connection->prepare("SELECT COUNT(*) AS row_count FROM photos 
                                    WHERE id_location = :id_location"); // can't pass table name as ph
    $stmt->execute(array(
        ':id_location' => $id_location
    ));
    $row_count = $stmt->fetch()['row_count'];
    return $row_count;
}

// returns array with the photos of a specific location

function getPhotos($connection, $id_location, $current_page){
    $posts = posts_per_page;
    $start = ($current_page == 1) ? 0 : ($current_page * posts_per_page) - posts_per_page;
    $stmt = $connection->prepare("SELECT * FROM photos WHERE id_location = :id_location LIMIT $start, $posts");
    $stmt->execute(array(
        ':id_location' => $id_location
    ));
    $return_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $return_array;
}

// returns the ordered position of the location

function getLocationIndex($connection, $id_location){
    $stmt = $connection->prepare("SELECT * FROM locations");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $counter = 0;
    $flag = false;
    foreach ($result as $row) {
        $counter++;
        if($row['id_location'] == $id_location){
            $flag = $counter;
        }
    }

    return $flag;
}


/// PHOTO>PHP ///////////////////////////////

function getLocation($connection, $id_photo){
    $stmt = $connection->prepare("SELECT * FROM photos WHERE id_photo = :id_photo LIMIT 1");
    $stmt->execute(array(
        ':id_photo' => $id_photo
    ));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['id_location'];
}


function getPhoto($connection, $id_photo){
    $stmt = $connection->prepare("SELECT * FROM photos WHERE id_photo = :id_photo");
    $stmt->execute(array(
        ':id_photo' => $id_photo
    ));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result[0];
}

// a function that will return the ordered spot of a photo between all the other photos 
// that share the same location

function getIndexPhoto($connection, $id_photo, $id_location){
    $stmt = $connection->prepare("SELECT * FROM photos WHERE id_location = :id_location");
    $stmt->execute(array(
        'id_location' => $id_location
    ));
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $counter = 0;
    $flag = false;
    foreach ($results as $row) {
        $counter++;
        if($row['id_photo'] == $id_photo){
            $flag = $counter;
        }
    }

    return $flag;
}


/// LOGIN.PHP and REGISTER.PHP

// function that evaluates session start

function validateSession(){
    if(!isset($_SESSION['admin'])){
        header('location: ' . RUTA);
    }
}

// function that checks if a user already exists within the database of users

function checkUser($connection, $username){
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->execute(array(
        ":username" => $username
    ));
    $result = $stmt->fetch();
    return $result;
}

function checkUserPassword($connection, $username, $password){
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->execute(array(
        ":username" => $username,
        ":password" => $password
    ));
    $result = $stmt->fetch();
    return $result;
}
?>