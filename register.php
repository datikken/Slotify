<?php
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");

    $account = new Account($con);

    include("includes/handlers/login-handler.php");
    include("includes/handlers/register-handler.php");

    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to slotify</title>
</head>
<body>
    <div id="inputContainer">
        <form action="register.php" id="loginForm" method="POST">
            <h2>Login to your account</h2>
            <p>
                <?php echo $account->getError(Constants::$loginFailed); ?>
                <label for="loginUsername">Username</label>
                <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. Bart Simpson" required>            
            </p>
            <p>
                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name="loginPassword" placeholder="Your password" required>
            </p>

            <button type="submit" name="loginButton">Log in</button>
        </form>

        <form action="register.php" id="registerForm" method="POST">
            <h2>Create your account</h2>
            <p>
                <?php echo $account->getError(Constants::$userNameCharacters); ?>
                <?php echo $account->getError(Constants::$userNameTaken); ?>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="e.g. Bart Simpson" value="<?php getInputValue('username') ?>" required>            
            </p>
            <p>
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <label for="firstname">First name</label>
                <input type="text" id="firstname" name="firstname" placeholder="e.g. Bart" value="<?php getInputValue('firstname') ?>" required>            
            </p>
            <p>
                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <label for="lastname">Last name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Simpson" value="<?php getInputValue('lastname') ?>" required>            
            </p>
            <p>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="e.g. Bart@gmail.com" value="<?php getInputValue('email') ?>" required>            
            </p>
            <p>
                <?php echo $account->getError(Constants::$passwordNotAlphaNumeric); ?>
                <?php echo $account->getError(Constants::$passwordCharachters); ?>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" required>
            </p>

            <button type="submit" name="registerButton">Sign up</button>
        </form>
    </div>

</body>
</html>