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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Welcome to Slotify!</title>
</head>
<body>
    <?php if(isset($_POST['loginButton'])) {
        echo '<script>
        $(document).ready(function() {
            $("#loginForm").show();
            $("#registerForm").hide();
        });
        </script>';
    } else {
        '<script>
        $(document).ready(function() {
            $("#loginForm").hide();
            $("#registerForm").show();
        });
        </script>';
    }?>
<div id="background">
<div id="loginContainer">
    <div id="inputContainer">
        <form action="register.php" id="loginForm" method="POST">
            <h2>Login to your account</h2>
            <p>
                <?php echo $account->getError(Constants::$loginFailed); ?>
                <label for="loginUsername">Username</label>
                <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. Bart Simpson" value="<?php getInputValue('loginUsername') ?>" required>            
            </p>
            <p>
                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name="loginPassword" placeholder="Your password" required>
            </p>

            <button type="submit" name="loginButton">Log in</button>
            <div id="hasAccountText">
                <span class="hideLogin">Don't have account yet? Sign up here.</span>
            </div>
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
            <div class="hasAccountText">
                <span class="hideRegister">Already have an account? Log in here.</span>
            </div>
        </form>

    </div>
    <div id="loginText">
            <h1>All free!</h1>
            <h2>Listen to your favourite music non-stop!</h2>
            <ul>
                <li>Some feature</li>
                <li>Some feature</li>
                <li>Some feature</li>
                <li>Some feature</li>
            </ul>
    </div>
</div>
</body>
</html>