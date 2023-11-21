<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user input
    if (empty($username) || empty($password)) {
        echo 'Please enter both username and password.';
    } else {
        //deserializer
        $users = json_decode(file_get_contents('users.json'), true);

        $foundUser = null;
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $foundUser = $user;
                var_dump($foundUser);
                break;
            }
        }

        
        if ($foundUser !== null && password_verify($password, $foundUser['password'])) {
            
            $_SESSION['username'] = $username;
            header('Location: dashboard.html');
            exit();
        } else {
            echo 'Invalid username or password.';
        }
    }
}
?>
