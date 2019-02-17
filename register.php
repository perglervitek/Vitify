<?php
    include ("includes/config.php");
    include ("includes/classes/Constants.php");
    include ("includes/classes/Account.php");
    $account = new Account($con);

    include ("includes/handlers/register-handler.php");
    include ("includes/handlers/login-handler.php");


    function inputValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Vitify</title>
</head>
<body>
<div id="inputContainer">
    <form id="loginForm" action="register.php" method="post">
        <h2>Login to your account</h2>
        <p>
            <label for="loginUsername">Username</label>
            <input type="text" id="loginUsername" name="loginUsername" placeholder="e. g. Vít Pergler" required>
        </p>
        <p>
            <label for="loginPassword">Password</label>
            <input type="password" id="loginPassword" name="loginPassword" placeholder="" required>
        </p>

        <button type="submit" name="loginButton">
            Login
        </button>
    </form>

    <form id="registerForm" action="register.php" method="post">
        <h2>Create your account</h2>
        <p>
            <?php echo $account->getError(Constants::$usernameLength); ?>
            <?php echo $account->getError(Constants::$usernameTaken); ?>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="e. g. Vít Pergler" value="<?php inputValue('username');?>" required>
        </p>
        <p>
            <?php echo $account->getError(Constants::$firstLength); ?>
            <label for="firstName">First name</label>
            <input type="text" id="firstName" name="firstName" placeholder="e. g. Vít" value="<?php inputValue('firsName');?>" required>
        </p>
        <p>
            <?php echo $account->getError(Constants::$lastLength); ?>
            <label for="lastName">Last name</label>
            <input type="text" id="lastName" name="lastName" placeholder="e. g. Pergler" value="<?php inputValue('lastName');?>" required>
        </p>
        <p>
            <?php echo $account->getError(Constants::$eamilInvalid); ?>
            <?php echo $account->getError(Constants::$emailsNotMatch); ?>
            <?php echo $account->getError(Constants::$emailUsed); ?>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="e. g. vitpergler@gmail.com" value="<?php inputValue('email');?>" required>
        </p>
        <p>
            <label for="email2">Email confirm</label>
            <input type="email" id="email2" name="email2" placeholder="e. g. vitpergler@gmail.com"  value="<?php inputValue('email2');?>" required>
        </p>
        <p>
            <?php echo $account->getError(Constants::$passwordsNotMatch); ?>
            <?php echo $account->getError(Constants::$passwordOnlyLetters); ?>
            <?php echo $account->getError(Constants::$passwordLength); ?>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Your password" required>
        </p>
        <p>
            <label for="password2">Password confirm</label>
            <input type="password" id="password2" name="password2" placeholder="Confirm your password" required>
        </p>
        <button type="submit" name="registerButton">
            Register
        </button>
    </form>
</div>
</body>
</html>