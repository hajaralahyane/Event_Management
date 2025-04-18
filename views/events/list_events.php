<?php 
require_once __DIR__ . '/../../config.php';
require_once VIEWS_PATH . '/layout/header.php'; 
?>

<div class="container">
    <h1>Liste des événements</h1>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-<?= strpos($_GET['message'], 'succès') !== false ? 'success' : 'danger' ?>">
            <?= htmlspecialchars($_GET['message']) ?>
        </div>
    <?php endif; ?>
    
    <div class="mb-3">
        <a href="index.php?entity=event&action=create" class="btn btn-gold">Créer un nouvel événement</a>
        <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
    
    <?php if (isset($events) && is_array($events) && !empty($events) && !isset($events['error'])): ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Titre</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $event): ?>
                                <tr>
                                    <td><?= htmlspecialchars($event['titre']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($event['date_evenement'])) ?></td>
                                    <td><?= htmlspecialchars(substr($event['description'], 0, 50)) . (strlen($event['description']) > 50 ? '...' : '') ?></td>
                                    <td>
                                        <a href="index.php?entity=event&action=edit&id=<?= $event['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                        <a href="index.php?entity=event&action=delete&id=<?= $event['id'] ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">
                                            Supprimer
                                        </a>
                                        <a href="index.php?entity=inscription&action=register&event_id=<?= $event['id'] ?>" class="btn btn-sm btn-info">Inscrire</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <p>Aucun événement trouvé.</p>
            <p class="mt-2">Utilisez le bouton "Créer un nouvel événement" pour ajouter votre premier événement.</p>
        </div>
    <?php endif; ?>
    
    <div class="mt-5">
        <h2>Gestion des événements</h2>
        <p>Cette section vous permet de gérer l'ensemble des événements de votre organisation. Vous pouvez créer, modifier et supprimer des événements selon vos besoins.</p>
        <p>Pour inscrire des participants à un événement, cliquez sur le bouton "Inscrire" correspondant à l'événement souhaité.</p>
    </div>
</div>

<?php require_once VIEWS_PATH . '/layout/footer.php'; ?>