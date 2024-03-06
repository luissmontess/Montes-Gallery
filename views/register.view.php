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
    <title>Register</title>         
</head>
<body>
    <div class="container">
        <div class="logback__secondary">
            <a class="logback-button__secondary" href="index.php"><p>BACK</p></a>
        </div>
    </div>

    <main class="container">
        <div class="register__title">
            <h2>Sign Up</h2>
        </div>

        <div class="form">
            <form class="register__form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="register__form--group">
                    <input type="text" name="username" placeholder="username">
                </div>

                <div class="register__form--group">
                    <input type="password" name="password" placeholder="password">
                </div>

                <div class="register__form--group">
                    <input type="password" name="password2" placeholder="repeat password">
                </div>

                <div class="register__form--group">
                    <input class="register__form--button" type="submit" value="submit" name="submit">
                </div>

                <div class="register__form--group">
                    <p class="register__text">
                        Already have an account?
                        <a href="login.php">Log In</a>
                    </p>
                </div>

                <?php if(!empty($errormsg)): ?>
                <div class="error">
                    <ul>
                        <?php echo $errormsg; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </main>
</body>
</html>