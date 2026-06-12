<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="/todolist-mvc/assets/css/style.css">
</head>

<body>

    <div class="container">

        <div class="dashboard-header">
            <div>
                <h1 class="user-greeting">
                    Olá, <?= $_SESSION['user_name'] ?>

                    <a href="?page=logout" class="icon-logout" title="Sair do sistema">                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </a>
                </h1>
                <p>Organize suas tarefas.</p>
            </div>
        </div>

        <div class="actions-bar">
            <a href="?page=create-task" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="margin-right: 6px;">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nova Tarefa
            </a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">

                <span class="stat-number">
                    <?= $totalTasks ?>
                </span>

                <span class="stat-label">
                    Total
                </span>

            </div>

            <div class="stat-card">

                <span class="stat-number">
                    <?= $pendingTasks ?>
                </span>

                <span class="stat-label">
                    Pendentes
                </span>

            </div>

            <div class="stat-card">

                <span class="stat-number">
                    <?= $completedTasks ?>
                </span>

                <span class="stat-label">
                    Concluídas
                </span>
            </div>
        </div>

        <div class="filters-card">

            <form method="GET" class="filters-form">

                <input type="hidden" name="page" value="dashboard">

                <input type="text" name="search" class="input" placeholder="Pesquisar tarefa..."
                    value="<?= htmlspecialchars($search ?? '') ?>">

                <select name="category" class="input">
                    <option value="">Todas Categorias</option>
                    <option value="Acadêmica">Acadêmica</option>
                    <option value="Financeira">Financeira</option>
                    <option value="Trabalho">Trabalho</option>
                    <option value="Bem-Estar">Bem-Estar</option>
                    <option value="Pessoal">Pessoal</option>
                </select>

                <select name="priority" class="input">

                    <option value="">Todas Prioridades</option>
                    <option value="Baixa">Baixa</option>
                    <option value="Média">Média</option>
                    <option value="Alta">Alta</option>
                </select>

                <input type="date" name="due_date" class="input" value="<?= $dueDate ?? '' ?>">

                <button class="btn btn-primary">
                    Filtrar
                </button>
            </form>
        </div>

        <div class="tasks-grid">

            <?php foreach ($tasks as $task): ?>

                <?php

                $categoryClass = match ($task['category']) {
                    'Acadêmica' => 'category-academica',
                    'Financeira' => 'category-financeira',
                    'Trabalho' => 'category-trabalho',
                    'Bem-Estar' => 'category-bemestar',
                    'Pessoal' => 'category-pessoal',
                    default => 'category-default'
                };

                $priorityClass = match ($task['priority']) {
                    'Alta' => 'priority-alta',
                    'Média' => 'priority-media',
                    'Baixa' => 'priority-baixa',
                    default => 'priority-default'
                };

                $statusClass = match ($task['status']) {
                    'Concluída' => 'status-concluida',
                    'Pendente' => 'status-pendente',
                    default => ''
                };

                $hasDueDate =
                    !empty($task['due_date']) &&
                    $task['due_date'] !== '0000-00-00';

                ?>

                <div class="task-card <?= $task['status'] === 'Concluída' ? 'completed' : '' ?>">

                    <div class="task-header">

                        <h3>
                            <?= htmlspecialchars($task['title']) ?>
                        </h3>

                        <div class="task-status-toggle">

                            <a href="?page=toggle-task&id=<?= $task['id'] ?>"
                                class="task-check <?= $task['status'] === 'Concluída' ? 'checked' : '' ?>">
                                ✓
                            </a>
                        </div>
                    </div>

                    <div class="task-content">

                        <p class="task-description">
                            <?= !empty($task['description'])
                                ? htmlspecialchars($task['description'])
                                : '' ?>
                        </p>

                        <div class="task-meta">

                            <span class="badge <?= $categoryClass ?>">
                                <?= htmlspecialchars($task['category']) ?>
                            </span>

                            <span class="badge <?= $priorityClass ?>">
                                <?= htmlspecialchars($task['priority']) ?>
                            </span>

                            <span class="badge <?= $statusClass ?>">
                                <?= htmlspecialchars($task['status']) ?>
                            </span>
                        </div>
                    </div>

                    <div class="task-footer">
                        <div class="task-date">

                            <?php if ($hasDueDate): ?>
                                <?= date('d/m/Y', strtotime($task['due_date'])) ?>
                            <?php endif; ?>
                        </div>

                        <div class="task-actions">

                            <a href="?page=edit-task&id=<?= $task['id'] ?>" class="action-icon edit-icon"
                                title="Editar tarefa">

                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="M12 20h9" />
                                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                </svg>
                            </a>

                            <a href="#" class="action-icon delete-icon" onclick="openDeleteModal(<?= $task['id'] ?>)">

                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <polyline points="3 6 5 6 21 6" />
                                    <path d="M19 6L18.11 18.45A2 2 0 0 1 16.12 20H7.88A2 2 0 0 1 5.89 18.45L5 6" />
                                    <path d="M10 11V17" />
                                    <path d="M14 11V17" />
                                    <path d="M9 6V4A1 1 0 0 1 10 3H14A1 1 0 0 1 15 4V6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modais -->

    <div id="deleteModal" class="modal-overlay">

        <div class="modal">

            <h3>Excluir tarefa</h3>
            <p>
                Tem certeza que deseja excluir esta tarefa?
            </p>

            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="closeDeleteModal()">
                    Cancelar
                </button>

                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">
                    Excluir
                </a>

            </div>
        </div>
    </div>

    <!-- Script Modal -->
    <script>

        function openDeleteModal(taskId) {
            document
                .getElementById('deleteModal')
                .classList
                .add('show');

            document
                .getElementById('confirmDeleteBtn')
                .href =
                '?page=delete-task&id=' + taskId;
        }

        function closeDeleteModal() {
            document
                .getElementById('deleteModal')
                .classList
                .remove('show');
        }
    </script>

</body>
</html>