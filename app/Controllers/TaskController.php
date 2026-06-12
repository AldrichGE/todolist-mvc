<?php

require_once __DIR__ . '/../factories/ModelFactory.php';
require_once __DIR__ .
    '/../models/Task.php';

class TaskController
{
    public function dashboard()
    {
        if (!isset($_SESSION['user_id'])) {

            header('Location: ?page=login');
            exit;
        }

        $category = $_GET['category'] ?? '';
        $priority = $_GET['priority'] ?? '';
        $search = $_GET['search'] ?? '';
        $dueDate = $_GET['due_date'] ?? '';

        $taskModel = ModelFactory::make('Task');

        $tasks =
            $taskModel->getByUserId(
                $_SESSION['user_id'],
                $category,
                $priority,
                $search,
                $dueDate
            );

        $totalTasks = count($tasks);

        $pendingTasks = count(
            array_filter(
                $tasks,
                fn($task) => $task['status'] === 'Pendente'
            )
        );

        $completedTasks = count(
            array_filter(
                $tasks,
                fn($task) => $task['status'] === 'Concluída'
            )
        );

        require_once __DIR__ .
            '/../views/tasks/dashboard.php';
    }

    public function create()
    {
        if (
            !isset($_SESSION['user_id'])
        ) {
            header(
                'Location: ?page=login'
            );

            exit;
        }

        if (
            $_SERVER['REQUEST_METHOD']
            === 'POST'
        ) {

            $task = ModelFactory::make('Task');

            $task->create(

                $_POST['title'],

                $_POST['description'],

                $_POST['category'],

                $_POST['priority'],

                $_POST['due_date'],

                $_SESSION['user_id']

            );

            header(
                'Location: ?page=dashboard'
            );

            exit;
        }

        require_once __DIR__ .
            '/../views/tasks/create.php';
    }

    public function edit()
    {
        $taskModel = ModelFactory::make('Task');

        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $taskModel->update(

                $id,

                $_POST['title'],

                $_POST['description'],

                $_POST['category'],

                $_POST['priority'],

                $_POST['due_date'],

                $_POST['status']
            );

            header(
                'Location: ?page=dashboard'
            );

            exit;
        }

        $task = $taskModel->find($id);

        require_once __DIR__ .
            '/../views/tasks/edit.php';
    }

    public function toggle()
    {
        $taskModel = ModelFactory::make('Task');

        $taskModel->toggleStatus(
            $_GET['id']
        );

        header(
            'Location: ?page=dashboard'
        );

        exit;
    }

    public function delete()
    {
        $taskModel = ModelFactory::make('Task');

        $task = $taskModel->find($_GET['id']);

        if (!$task) {

            header('Location: ?page=dashboard');

            exit;
        }

        if ($task['user_id'] != $_SESSION['user_id']) {

            exit('Acesso negado');
        }

        $taskModel->delete($_GET['id']);

        $_SESSION['success'] =
            'Tarefa removida com sucesso.';

        header('Location: ?page=dashboard');

        exit;
    }
}