<?php

class Router
{
    public function route()
    {
        $page = $_GET['page'] ?? 'register';

        switch ($page) {

            case 'register':

                require_once __DIR__ .
                    '/../Controllers/AuthController.php';

                $controller = new AuthController();
                $controller->showRegister();

                break;

            case 'login':

                require_once __DIR__ .
                    '/../controllers/AuthController.php';

                $controller = new AuthController();

                $controller->showLogin();

                break;

            case 'dashboard':

                require_once __DIR__ .
                    '/../controllers/TaskController.php';

                $controller =
                    new TaskController();

                $controller->dashboard();

                break;

            case 'logout':

                require_once __DIR__ .
                    '/../controllers/AuthController.php';

                $controller =
                    new AuthController();

                $controller->logout();

                break;

            case 'create-task':

                require_once __DIR__ .
                    '/../controllers/TaskController.php';

                $controller =
                    new TaskController();

                $controller->create();

                break;

            case 'edit-task':

                require_once __DIR__ .
                    '/../controllers/TaskController.php';

                $controller =
                    new TaskController();

                $controller->edit();

                break;

            case 'toggle-task':

                require_once __DIR__ .
                    '/../controllers/TaskController.php';

                $controller = new TaskController();

                $controller->toggle();

                break;

            case 'delete-task':

                require_once __DIR__ .
                    '/../controllers/TaskController.php';

                $controller = new TaskController();

                $controller->delete();

                break;

            default:

                echo "Página não encontrada.";
        }
    }

}