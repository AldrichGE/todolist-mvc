<?php

require_once __DIR__ . '/../factories/ModelFactory.php';
require_once __DIR__ .
    '/../Models/User.php';

class AuthController
{
    public function showRegister()
    {
        $error = $this->register();

        require_once __DIR__ .
            '/../views/auth/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = trim($_POST['name']);

            $email = trim($_POST['email']);

            $password = $_POST['password'];

            $user = ModelFactory::make('User');

            $existingUser =
                $user->findByEmail($email);

            if ($existingUser) {

                return "Este email já está cadastrado.";
            }

            $hashedPassword =
                password_hash(
                    $password,
                    PASSWORD_BCRYPT
                );

            $user->create(
                $name,
                $email,
                $hashedPassword
            );

            $_SESSION['success'] =
                "Conta criada com sucesso!";

            header('Location: ?page=login');
            exit;
        }

        return null;
    }

    public function showLogin()
    {
        $error = $this->login();

        require_once __DIR__ .
            '/../views/auth/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $userModel = ModelFactory::make('User');

            $user = $userModel->findByEmail($email);

            if (
                $user &&
                password_verify(
                    $password,
                    $user['password']
                )
            ) {

                $_SESSION['user_id'] = $user['id'];

                $_SESSION['user_name'] = $user['name'];

                header('Location: ?page=dashboard');
                exit;
            }

            $error = "Email ou senha inválidos.";
        }

        return $error ?? null;
    }

    public function logout()
    {
        session_destroy();

        header('Location: ?page=login');

        exit;
    }

}