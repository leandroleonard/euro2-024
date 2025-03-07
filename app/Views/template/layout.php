<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Euro 2024</title>

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://iconsax.gitlab.io/i/icons.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Euro 2024</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= site_url('team') ?>">Team</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('player') ?>">Player</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('coach') ?>">Coach</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('groups') ?>">Groups</a></li>
                            
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>




    <script src="<?= base_url('js/bootstrap.bundle.js') ?>"></script>
    <script src="<?= base_url('js/jquery.js') ?>"></script>

    <?= $this->renderSection('script') ?>
</body>

</html>