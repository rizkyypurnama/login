<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Load user data from JSON file
    $userData = json_decode(file_get_contents("data.json"), true);

    // Check if the provided credentials match any user in the JSON data
    $authenticated = false;
    foreach ($userData as $user) {
        if ($user["username"] == $username && $user["password"] == $password) {
            $authenticated = true;
            break;
        }
    }

    if ($authenticated) {
        // Redirect to a success page
        header("Location: success.php");
        exit(); // Ensure that no other code is executed after the header
    } else {
        // Redirect to a failure page
        header("Location: failure.php");
        exit(); // Ensure that no other code is executed after the header
    }
}
?>
