<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet" href="/todolist-mvc/assets/css/style.css">

</head>

<body>

    <div class="auth-container">

        <div class="card auth-card">

            <h1 class="auth-title">
                Bem-vindo
            </h1>

            <p class="auth-subtitle">
                Entre para acessar suas tarefas.
            </p>

            <?php if (!empty($_SESSION['success'])): ?>

    <div class="alert-success">

        <?= $_SESSION['success']; ?>

    </div>

    <?php unset($_SESSION['success']); ?>

<?php endif; ?>

            <?php if (!empty($error)): ?>

                <div class="alert-error">

                    <?= $error ?>

                </div>

            <?php endif; ?>

            <form method="POST">

                <div class="form-group">

                    <label>Email</label>

                    <input class="input" type="email" name="email" required>

                </div>

                <div class="form-group">

                    <label>Senha</label>

                    <input class="input" type="password" name="password" required>

                </div>

                <button class="btn btn-primary" type="submit">

                    Entrar

                </button>

            </form>

            <p class="auth-link">

                Não possui conta?

                <a href="?page=register">
                    Cadastre-se
                </a>

            </p>

        </div>

    </div>

</body>

</html>