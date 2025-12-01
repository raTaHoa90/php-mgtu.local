<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $caption ?? '404' ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">
</head>
<body>
    <header>
        <a href="/"><img id="logo" src="/imgs/logo.webp"></a>
    </header>
    <div>
        <div>
            {{CONTENT}}
        </div>
    </div>

    <footer>&copy; 2025 Все права защищены</footer>
</body>
</html>