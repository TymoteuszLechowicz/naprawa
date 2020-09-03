<?php
include("includes/config.php");
include("includes/classes/FormSanitizer.php");
include("includes/classes/Constants.php");
include("includes/classes/Account.php");

$account = new Account($con);

if(isset($_POST["submitButton"])) {

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    $success = $account->register($username, $password, $password2, $email, $firstName, $lastName);

    if($success) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Witamy ponownie!</title>
        <link rel="stylesheet" type="text/css" href="assets/style/register.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    </head>

    <body>

        <div class="signInContainer">

            <div class="column">

                <div class="header">
<!--                    TODO dodac logo    -->
                    <h3>Zarejestruj się</h3>
                    <span>aby przejść dalej na strone</span>
                </div>

                <form method="POST">

                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <input type="text" name="firstName" placeholder="Imię" value="<?php getInputValue("firstName");?>" required>

                    <?php echo $account->getError(Constants::$lastNameCharacters) ?>
                    <input type="text" name="lastName" placeholder="Nazwisko" value="<?php getInputValue("lastName");?>"  required>

                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$checkUsernameQuery); ?>
                    <input type="text" name="username" placeholder="Nazwa użytkownika" value="<?php getInputValue("username");?>" required>

                    <?php echo $account->getError(Constants::$checkEmailQuery) ?>
                    <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email");?>"  required>

                    <?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordCharacters); ?>
                    <input type="password" name="password" placeholder="Hasło" value="<?php getInputValue("password");?>"  required>

                    <input type="password" name="password2" placeholder="Potwierdź hasło" value="<?php getInputValue("password2");?>" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                </form>

                <a href="login.php" class="signInMessage">Posiadasz już konto? Zaloguj się tutaj!</a>

            </div>

        </div>

    </body>

</html>
