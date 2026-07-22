<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> — <?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.css?v=<?= filemtime(APP_ROOT . '/public/css/app.css') ?>">
</head>
<body>
    <?= $content ?>
    <?php partial('cookie_consent') ?>
</body>
</html>
