<?php
if(isset($_POST['submitButton']))
    echo "Zadziałało rejestracja";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Witamy ponownie!</title>
        <link rel="stylesheet" type="text/css" href="assets/style/register.css">
    </head>

    <body>

        <div class="signInContainer">

            <div class="column">

                <div class="header">
<!--                    TODO dodac logo    -->
                    <h3>Zarejestruj się</h3>
                    <span>aby przejść dalej na strone</span>
                </div>

                <form method="post">

                    <input type="text" name="firstName" placeholder="Imię" required>

                    <input type="text" name="lastName" placeholder="Nazwisko" required>

                    <input type="text" name="username" placeholder="Nazwa użytkownika" required>

                    <input type="email" name="email" placeholder="Email" required>

                    <input type="password" name="password" placeholder="Hasło" required>

                    <input type="password" name="password2" placeholder="Potwierdź hasło" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                </form>

                <a href="login.php" class="signInMessage">Posiadasz już konto? Zaloguj się tutaj!</a>

            </div>

        </div>

    </body>

</html>
