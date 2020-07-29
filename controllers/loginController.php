<?php

require_once "models/User.php";

class LoginController
{
    public function login($username, $password)
    {
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        $user = new User();
        $stmt = User::get("*", "username", $username);

        if ($stmt->rowCount() == 1) {
            $userData = $stmt->fetch();
            if (password_verify($password, $userData['password'])) {
                session_start();
                $_SESSION['user_data'] = $userData;
                return true;
            } else return false;
        }

        return false;
    }
}
