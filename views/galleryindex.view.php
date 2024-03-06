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
        <div class="back__secondary">
            <a class="back-button__secondary" href="<?php echo RUTA . 'index.php'; ?>"><p>BACK</p></a>
        </div>
    </div>
    <main class="container">
        <div class="grid">
            <?php foreach($cover_photos as $cover_photo): ?>
                <div class="location">
                    <a href="gallerypage.php?id_location=<?php echo $cover_photo['id_location']; ?>">
                        <img src="<?php echo RUTA . 'dbimages/' . $cover_photo['name']; ?>" alt="locationImage" class="location__image">
                        <div class="location__info">
                            <h3 class="location__title"><?php echo $cover_photo['location']; ?></h3>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

            <!-- <div class="location">
                <a href="gallerypage.php">
                    <img class="location__image" src="<?php //echo RUTA . 'decorationimages/' . 'cdmxstat.jpg'; ?>" alt="location image">
                    <div class="location__info">
                        <p class="location__title">Lorem Ipsum</p>
                    </div>
                </a>
            </div> -->
        </div>
            
        <div class="paginacion">
            <div class="paginacion__left">
                <?php if($current_page != 1): ?>                   
                        <a href="<?php echo RUTA . 'galleryindex.php?page=' . $current_page - 1; ?>">PREVIOUS</a>
                <?php endif; ?>
            </div>

            <div class="paginacion__right">
                <?php if($current_page != $total_pages): ?>
                        <a href="<?php echo RUTA . 'galleryindex.php?page=' . $current_page + 1; ?>">NEXT</a>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>