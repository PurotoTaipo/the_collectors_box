<main class="auth-wrap">
    <div class="auth-card">
        <h1><?= APP_NAME ?></h1>

        <?php if ($error): ?>
            <p class="alert"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="<?= linkTo('auth', 'handle') ?>" novalidate>
            <div class="field">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" autocomplete="username" required autofocus>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
            </div>
            <button type="submit">Sign in</button>
        </form>
    </div>
</main>
