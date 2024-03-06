<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Document</title>         
</head>
<body>
    
    <?php require 'header.php'; ?>
    
    <div class="container">
        <div class="photocontainer">
            <img class="photocontainer__image" src="<?php echo RUTA . 'dbimages/' . $photo['name']; ?>">
            <div class="photocontainer__info">
                <p class="photocontainer__title"><?php echo $photo['title']; ?></p>
                <p class="photocontainer__text"><?php echo $photo['text']; ?></p>
            </div>
        </div>
    </div>

    
    <div class="back">
        <a class="back-button" href="<?php echo RUTA . 'gallerypage.php?id_location=' . $photo['id_location'] . '&page=' . $return_page; ?>"><h3>BACK</h3></a>
    </div>
</body>
</html>