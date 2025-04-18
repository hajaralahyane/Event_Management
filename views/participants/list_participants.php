<?php 
require_once __DIR__ . '/../../config.php';
require_once VIEWS_PATH . '/layout/header.php'; 
?>

<div class="container">
    <h1>Liste des participants</h1>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-<?= strpos($_GET['message'], 'succès') !== false ? 'success' : 'danger' ?>">
            <?= htmlspecialchars($_GET['message']) ?>
        </div>
    <?php endif; ?>
    
    <div class="mb-3">
        <a href="index.php?entity=participant&action=create" class="btn btn-gold">Ajouter un participant</a>
        <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
    
    <?php if (isset($participants) && is_array($participants) && !empty($participants) && !isset($participants['error'])): ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($participants as $participant): ?>
                                <tr>
                                    <td><?= htmlspecialchars($participant['nom']) ?></td>
                                    <td><?= htmlspecialchars($participant['email']) ?></td>
                                    <td>
                                        <a href="index.php?entity=inscription&action=register&participant_id=<?= $participant['id'] ?>" 
                                           class="btn btn-sm btn-info">
                                            Inscrire à un événement
                                        </a>
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
            <p>Aucun participant trouvé.</p>
            <p class="mt-2">Utilisez le bouton "Ajouter un participant" pour enregistrer votre premier participant.</p>
        </div>
    <?php endif; ?>
    
    <div class="mt-5">
        <h2>Gestion des participants</h2>
        <p>Cette section vous permet de consulter la liste complète des participants enregistrés dans le système.</p>
        <p>Pour inscrire un participant à un événement spécifique, cliquez sur le bouton "Inscrire à un événement".</p>
    </div>
</div>

<?php require_once VIEWS_PATH . '/layout/footer.php'; ?>