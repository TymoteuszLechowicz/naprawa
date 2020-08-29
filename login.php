<?php
if(isset($_POST['submitButton']))
    echo "Zadziałało logowanie";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Zaloguj się</title>
        <link rel="stylesheet" type="text/css" href="assets/style/login.css"
    </head>

    <body>

    <div class="signInContainer">

        <div class="column">

            <div class="header">
<!--                TODO logo-->
                <h3>Zaloguj się</h3>
                <span>aby kontunuować</span>
            </div>

            <form method="post">

                <input type="text" name="username" placeholder="Nazwa użytkownika" required>

                <input type="password" name="password" placeholder="Hasło" required>

                <input type="submit" name="submitButton" value="SUBMIT">

            </form>

            <a href="register.php" class="signInMessage">Nie posiadasz jeszcze konta? Zarejestruj się!</a>

        </div>
    </div>
    </body>
</html>
