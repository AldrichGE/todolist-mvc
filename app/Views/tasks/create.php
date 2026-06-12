<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Nova Tarefa</title>
    <link rel="stylesheet" href="/todolist-mvc/assets/css/style.css">
</head>

<body>
    <div class="container">

        <div class="page-header">
            <h1>Nova Tarefa</h1>
        </div>

        <div class="card">
            <form method="POST">

                <div class="form-group">
                    <label>Título</label>
                    <input type="text" name="title" class="input" required>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Categoria</label>

                        <select name="category" class="input">
                            <option value="Acadêmica">
                                Acadêmica
                            </option>

                            <option value="Financeira">
                                Financeira
                            </option>

                            <option value="Trabalho">
                                Trabalho
                            </option>

                            <option value="Bem-Estar">
                                Bem-Estar
                            </option>

                            <option value="Pessoal">
                                Pessoal
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Prioridade</label>

                        <select name="priority" class="input">

                            <option value="Baixa">
                                Baixa
                            </option>

                            <option value="Média">
                                Média
                            </option>

                            <option value="Alta">
                                Alta
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Prazo</label>
                        <input type="date" name="due_date" class="input">
                    </div>
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <textarea name="description" class="input" rows="5"></textarea>
                </div>

                <div class="form-actions">

                    <button type="submit" class="btn btn-primary">
                        Salvar Tarefa
                    </button>

                    <a href="?page=dashboard" class="btn">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>