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
        $users = json_decode(file_get_contents('data/users.json'), true);

        $foundUser = null;
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $foundUser = $user;
                //var_dump($foundUser);
                break;
            }
        }

        
        //if ($foundUser !== null && password_verify($password, $foundUser['password'])) {
        if ($foundUser !== null && $password == $foundUser['password']) {
            
            
            $_SESSION['username'] = $username;
            header('Location: /html/dashboard.html');
            //var_dump($username); debug
            exit();
        } else {
            echo 'Invalid username or password. no';
        }
    }
}
?>
