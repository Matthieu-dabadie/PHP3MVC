<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/cff33ecd93.js" crossorigin="anonymous"></script>

</head>

<body class="bg-primary-subtle">
    <div class="container bg-secondary-subtle">
        <header class="text-center">
            <h1 class="m-4 py-3">MON PORTFOLIO</h1>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-lignht">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Mon Portfolio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle nagigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=creation&action=index">Mes créations</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <?= $content ?>
        </main>
        <footer>
            <hr class="mt-5 bg-light mx-auto" style="width: 50%;">
            <div class="bg-white bg-opacity-75 col-5 rounded">
                <p class="text-dark text-center">Matthieu Dabadie-courtin | PortFolio | &copy;Copyright 2023 </p>
            </div>
        </footer>
    </div>
</body>

</html>