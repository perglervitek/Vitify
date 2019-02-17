<?php
function upravaVstupu($input) {
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    return $input;
}
function upravaVstupuString($input) {
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    $input = ucfirst(strtolower($input));
    return $input;
}
function upravaVstupuHeslo($input) {
    $input = strip_tags($input);
    return $input;
}

if(isset($_POST['registerButton'])){
    $username = upravaVstupu($_POST["username"]);
    $firstName = upravaVstupuString($_POST["firstName"]);
    $lastName = upravaVstupuString($_POST["lastName"]);
    $email = upravaVstupuString($_POST["email"]);
    $email2 = upravaVstupuString($_POST["email2"]);
    $password = upravaVstupuHeslo($_POST["password"]);
    $password2 = upravaVstupuHeslo($_POST["password2"]);

    $success = $account->register($username, $firstName, $lastName, $email, $email2, $password, $password2);

    if($success){
        header("Location: index.php");
    }

}
?>