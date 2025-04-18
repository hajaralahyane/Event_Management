<?php 
require_once __DIR__ . '/../../config.php';
require_once VIEWS_PATH . '/layout/header.php'; 
?>

<div class="container">
    <h1>Créer un nouvel événement</h1>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="alert <?= strpos($_GET['message'], 'succès') !== false ? 'alert-success' : 'alert-danger' ?>">
            <?= htmlspecialchars($_GET['message']) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="index.php?entity=event&action=create" method="POST">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                
                <div class="form-group">
                    <label for="date_evenement">Date de l'événement</label>
                    <input type="date" class="form-control" id="date_evenement" name="date_evenement" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-gold">Créer l'événement</button>
                    <a href="index.php?entity=event&action=list" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="index.php" class="btn btn-info">
            Retour à l'accueil
        </a>
    </div>
</div>

<?php require_once VIEWS_PATH . '/layout/footer.php'; ?>