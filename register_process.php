<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    // Baca data pengguna dari file JSON
    $users = json_decode(file_get_contents('users.json'), true);

    // Periksa apakah username sudah digunakan
    if (isset($users[$new_username])) {
        echo 'Username already exists. Please choose another username.';
    } else {
        // Tambahkan pengguna baru ke file JSON
        $users[$new_username] = [
            'password' => $new_password
        ];

        // Simpan data baru ke file JSON
        file_put_contents('users.json', json_encode($users));

        echo 'Registration successful. <a href="index.php">Login</a>';
    }
}
?>
