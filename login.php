<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Baca data pengguna dari file JSON
    $users = json_decode(file_get_contents('user.json'), true);

    // Periksa keberadaan pengguna
    if (isset($users[$username]) && $users[$username]['password'] == $password) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        echo 'Invalid username or password';
    }
}
?>
