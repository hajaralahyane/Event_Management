<?php 
require_once __DIR__ . '/../config.php';
require_once VIEWS_PATH . '/layout/header.php'; 
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Bienvenue dans l'application de Gestion des Événements</h1>
        <p class="lead">Cette application vous permet de gérer facilement vos événements et inscriptions.</p>
        <hr class="my-4">
        <p>Utilisez les options ci-dessous pour accéder aux différentes fonctionnalités.</p>
        <a href="index.php?entity=event&action=create" class="btn btn-gold">Créer un événement</a>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Événements</h5>
                    <p class="card-text">Gérez vos événements (création, modification, suppression).</p>
                    <div>
                        <a href="index.php?entity=event&action=list" class="btn btn-primary">Liste des événements</a>
                        <a href="index.php?entity=event&action=create" class="btn btn-success mt-2">Créer un événement</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Inscriptions</h5>
                    <p class="card-text">Gérez les inscriptions aux événements.</p>
                    <div>
                        <a href="index.php?entity=inscription&action=list" class="btn btn-primary">Liste des inscriptions</a>
                        <a href="index.php?entity=inscription&action=register" class="btn btn-success mt-2">Nouvelle inscription</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Participants</h5>
                    <p class="card-text">Consultez la liste des participants.</p>
                    <a href="index.php?entity=participant&action=list" class="btn btn-primary">Liste des participants</a>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($events) && is_array($events) && !empty($events)): ?>
    <div class="mt-5">
        <h2>Événements à venir</h2>
        <div class="row">
            <?php foreach (array_slice($events, 0, 3) as $event): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($event['titre']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= date('d/m/Y', strtotime($event['date_evenement'])) ?></h6>
                            <p class="card-text"><?= htmlspecialchars(substr($event['description'], 0, 100)) . (strlen($event['description']) > 100 ? '...' : '') ?></p>
                            <a href="index.php?entity=inscription&action=register&event_id=<?= $event['id'] ?>" class="btn btn-gold">S'inscrire</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once VIEWS_PATH . '/layout/footer.php'; ?>