<?php 
require_once __DIR__ . '/../../config.php';
require_once CONTROLLERS_PATH . '/EventController.php';
require_once VIEWS_PATH . '/layout/header.php';

// Récupérer la liste des événements
$eventController = new EventController();
$events = $eventController->getAllEvents();

// Récupérer l'ID de l'événement s'il est passé en paramètre
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : '';
?>

<div class="container">
    <h2>Inscrire un participant à un événement</h2>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-<?= strpos($_GET['message'], 'réussie') !== false ? 'success' : 'danger' ?>">
            <?= htmlspecialchars($_GET['message']) ?>
        </div>
    <?php endif; ?>

    <form action="index.php?entity=inscription&action=register" method="POST">
        <div class="form-group">
            <label for="event_id">Événement</label>
            <select class="form-control" id="event_id" name="event_id" required>
                <option value="">Sélectionner un événement</option>
                <?php foreach ($events as $event): ?>
                    <option value="<?= $event['id'] ?>" <?= ($event_id == $event['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($event['titre']) ?> (<?= date('d/m/Y', strtotime($event['date_evenement'])) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="nom">Nom complet</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Inscrire</button>
        <a href="index.php?entity=inscription&action=list" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php require_once VIEWS_PATH . '/layout/footer.php'; ?>