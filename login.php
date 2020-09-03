<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");
include("includes/classes/FormSanitizer.php");

$account = new Account($con);

if(isset($_POST["submitButton"])) {

    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $success = $account->login($username, $password);

    if($success) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }

    $successAdmin = $account->loginAdmin($username, $password);
    if($successAdmin){
        $_SESSION["adminLoggedIn"] = $username;
        header("Location: indexAdmin.php");
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

            <form method="POST">

                <?php echo $account->getError(Constants::$incorrectCredits) ?>
                <input type="text" name="username" placeholder="Nazwa użytkownika" value="<?php getInputValue("username");?>" required>

                <input type="password" name="password" placeholder="Hasło" required>

                <input type="submit" name="submitButton" value="SUBMIT">

            </form>

            <a href="register.php" class="signInMessage">Nie posiadasz jeszcze konta? Zarejestruj się!</a>

        </div>
    </div>
    </body>
</html>
