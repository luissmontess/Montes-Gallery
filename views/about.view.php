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
        <div class="dispbox">
            <div class="dispbox__container">
                <p class="dispbox__title"><?php echo $article_array['title']; ?></p>
                <p class="dispbox__text"><?php echo $article_array['text']; ?></p>
            </div>
        </div>
    </div>
</body>
</html>