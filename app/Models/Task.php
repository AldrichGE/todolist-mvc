<?php

require_once __DIR__ .
    '/../../config/Database.php';

class Task
{
    private $conn;

    public function __construct()
    {
        $this->conn =
            Database::getConnection();
    }

    public function create(
        $title,
        $description,
        $category,
        $priority,
        $dueDate,
        $userId
    ) {

        $sql = "
        INSERT INTO tasks
        (
            title,
            description,
            category,
            priority,
            due_date,
            user_id
        )
        VALUES
        (
            :title,
            :description,
            :category,
            :priority,
            :due_date,
            :user_id
        )";

        $stmt =
            $this->conn->prepare($sql);

        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':category' => $category,
            ':priority' => $priority,
            ':due_date' => $dueDate,
            ':user_id' => $userId
        ]);
    }

    public function getByUserId(
        $userId,
        $category = null,
        $priority = null,
        $search = null,
        $dueDate = null
    ) {
        $sql = "
        SELECT *
        FROM tasks
        WHERE user_id = :user_id
    ";

        $params = [
            ':user_id' => $userId
        ];

        if (!empty($category)) {

            $sql .= " AND category = :category";

            $params[':category'] = $category;
        }

        if (!empty($priority)) {

            $sql .= " AND priority = :priority";

            $params[':priority'] = $priority;
        }

        if (!empty($search)) {

            $sql .= "
            AND (
                title LIKE :search
                OR description LIKE :search
            )
        ";

            $params[':search'] = "%{$search}%";
        }

        if (!empty($dueDate)) {

            $sql .= "
            AND due_date = :due_date
        ";

            $params[':due_date'] = $dueDate;
        }

        $sql .= "
        ORDER BY

CASE

    WHEN status = 'Pendente'
    THEN 0

    ELSE 1
    
END,
due_date ASC,
        created_at DESC
    ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "
        SELECT *
        FROM tasks
        WHERE id = :id
    ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(
        $id,
        $title,
        $description,
        $category,
        $priority,
        $dueDate,
        $status
    ) {
        $sql = "
        UPDATE tasks
        SET

        title = :title,
        description = :description,
        category = :category,
        priority = :priority,
        due_date = :due_date,
        status = :status

        WHERE id = :id
    ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([

            ':title' => $title,

            ':description' => $description,

            ':category' => $category,

            ':priority' => $priority,

            ':due_date' => $dueDate,

            ':status' => $status,

            ':id' => $id
        ]);
    }

    public function toggleStatus($id)
    {
        $task = $this->find($id);

        $newStatus =

            $task['status']
            === 'Concluída'

            ? 'Pendente'

            : 'Concluída';

        $sql = "
        UPDATE tasks
        SET status = :status
        WHERE id = :id
    ";

        $stmt =
            $this->conn->prepare($sql);

        return $stmt->execute([

            ':status' => $newStatus,

            ':id' => $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tasks WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

}