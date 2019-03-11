username=johnnyboy&email=boyjohnny@gmail.com&password=kjs9sg8&password=kjs9sg8
Receiving the Form Data
Our register.php file will look like this

<?php

// Used to display an error message below the form
$errorMessage = '';
$username = '';
$email = '';
$passwords = '';

$isPostback = 'POST' === $_SERVER['REQUEST_METHOD'];

if ($isPostback) {
    $errorMessage = processForm();
}

function processForm()
{
    global $username, $email, $passwords;

    $username = $_POST['username'];
    $email = $_POST['email'];
    // The array of 2 passwords
    $passwords = $_POST['password'];
    // var_dump($passwords);

    // Validate the form
    if (empty($username)) {
        return 'Username is required';
    } elseif (empty($email)) {
        return 'Email is required';
    } elseif (2 != count($passwords)) {
        return 'Password and Repeat Password are required';
    } elseif ($passwords[0] != $passwords[1]) {
        return 'Password must match Repeat Password';
    } elseif (empty($passwords[0])) {
        return 'Password cannot be empty';
    }

    // TODO: process the registration
}

?>