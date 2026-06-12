<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <title>Editar Tarefa</title>

    <link rel="stylesheet"
        href="/todolist-mvc/assets/css/style.css">
</head>

<body>
<div class="container">
    <div class="page-header">
        <h1>Editar Tarefa</h1>
    </div>

    <div class="card">
        <form method="POST">
            <div class="form-group">
                <label>Título</label>
                <input
                    type="text"
                    name="title"
                    class="input"
                    value="<?= htmlspecialchars($task['title']) ?>"
                    required>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Categoria</label>

                    <select
                        name="category"
                        class="input">

                        <option value="Acadêmica"
                            <?= $task['category'] === 'Acadêmica' ? 'selected' : '' ?>>
                            Acadêmica
                        </option>

                        <option value="Financeira"
                            <?= $task['category'] === 'Financeira' ? 'selected' : '' ?>>
                            Financeira
                        </option>

                        <option value="Trabalho"
                            <?= $task['category'] === 'Trabalho' ? 'selected' : '' ?>>
                            Trabalho
                        </option>

                        <option value="Bem-Estar"
                            <?= $task['category'] === 'Bem-Estar' ? 'selected' : '' ?>>
                            Bem-Estar
                        </option>

                        <option value="Pessoal"
                            <?= $task['category'] === 'Pessoal' ? 'selected' : '' ?>>
                            Pessoal
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Prioridade</label>
                    <select
                        name="priority"
                        class="input">

                        <option value="Baixa"
                            <?= $task['priority'] === 'Baixa' ? 'selected' : '' ?>>
                            Baixa
                        </option>

                        <option value="Média"
                            <?= $task['priority'] === 'Média' ? 'selected' : '' ?>>
                            Média
                        </option>

                        <option value="Alta"
                            <?= $task['priority'] === 'Alta' ? 'selected' : '' ?>>
                            Alta
                        </option>
                    </select>
                </div>

                <div class="form-group">

                    <label>Prazo</label>

                    <input
                        type="date"
                        name="due_date"
                        class="input"
                        value="<?= $task['due_date'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <textarea
                    name="description"
                    class="input"
                    rows="5"><?= htmlspecialchars($task['description']) ?></textarea>
            </div>

            <div class="form-actions">
                
                <button
                    type="submit"
                    class="btn btn-primary">
                    Salvar Alterações
                </button>

                <a
                    href="?page=dashboard"
                    class="btn">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>