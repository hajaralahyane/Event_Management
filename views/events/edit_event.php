<?php
require_once __DIR__ . '/../../config.php';
require_once CONTROLLERS_PATH . '/EventController.php';
require_once VIEWS_PATH . '/layout/header.php';

$eventController = new EventController();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php?entity=event&action=list');
    exit;
}

$event = $eventController->getEventById($_GET['id']);
if (!$event || isset($event['error'])) {
    echo '<div class="alert alert-danger">Événement non trouvé ou erreur de chargement.</div>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $eventController->updateEvent(
        $_GET['id'],
        $_POST['titre'],
        $_POST['date_evenement'],
        $_POST['description']
    );
    
    if ($result['success']) {
        header('Location: index.php?entity=event&action=list&message=' . urlencode('Événement mis à jour avec succès'));
        exit;
    } else {
        echo '<div class="alert alert-danger">' . $result['message'] . '</div>';
    }
}
?>

<div class="container">
    <h2>Modifier l'événement</h2>
    
    <form method="POST">
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?= htmlspecialchars($event['titre']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="date_evenement">Date de l'événement</label>
            <input type="date" class="form-control" id="date_evenement" name="date_evenement" 
                   value="<?= date('Y-m-d', strtotime($event['date_evenement'])) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($event['description']) ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="index.php?entity=event&action=list" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php require_once VIEWS_PATH . '/layout/footer.php'; ?>