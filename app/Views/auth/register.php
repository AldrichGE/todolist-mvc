<!DOCTYPE html>
<html>

<head>

    <title>Cadastro</title>

    <link rel="stylesheet" href="/todolist-mvc/assets/css/style.css">

</head>

<body>

    <div class="auth-container">

        <div class="card auth-card">

            <h1 class="auth-title">
                Criar Conta
            </h1>

            <p class="auth-subtitle">
                Gerencie suas tarefas de forma simples.
            </p>

            <?php if (!empty($error)): ?>

                <div class="alert-error">

                    <?= $error ?>

                </div>

            <?php endif; ?>

            <form method="POST">

                <div class="form-group">

                    <label>Nome</label>

                    <input name="name" class="input" type="text" required>

                </div>

                <div class="form-group">

                    <label>Email</label>

                    <input name="email" class="input" type="email" required>

                </div>

                <div class="form-group">

                    <label>Senha</label>

                    <input name="password" class="input" type="password" required>

                </div>

                <button class="btn btn-primary" type="submit">

                    Cadastrar

                </button>

            </form>

            <p class="auth-link">
                Já possui conta?
                <a href="?page=login">
                    Entrar
                </a>

            </p>

        </div>
    </div>

</body>

</html>