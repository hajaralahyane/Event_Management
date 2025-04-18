<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Événements</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">Gestion des Événements</a>
            <button class="navbar-toggler" type="button">
                <span>&#9776;</span>
            </button>
            <div class="navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?entity=event&action=list">Événements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?entity=inscription&action=list">Inscriptions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?entity=participant&action=list">Participants</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>