<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Progetto esame Cybersecurity: Piattaforma video corsi">
    <meta name="author" content="Zof Emanuele">
    <title><?php 
        if (isset($_SESSION['currentPage'])) {
            echo $pages[$_SESSION['currentPage']]['title'];
        } else {
            echo 'Piattaforma di video corsi';
        }
    ?></title>
    <!--TODO: 
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/product/">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
        <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/product.css" rel="stylesheet">
</head>