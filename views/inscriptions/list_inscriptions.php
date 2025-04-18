<?php 
require_once __DIR__ . '/../../config.php';
require_once VIEWS_PATH . '/layout/header.php'; 
?>

<div class="container">
    <h2>Liste des participants</h2>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-<?= strpos($_GET['message'], 'succès') !== false ? 'success' : 'danger' ?>">
            <?= htmlspecialchars($_GET['message']) ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($participants) && is_array($participants) && !empty($participants)): ?>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participants as $participant): ?>
                    <tr>
                        <td><?= htmlspecialchars($participant['nom']) ?></td>
                        <td><?= htmlspecialchars($participant['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Aucun participant trouvé.</div>
    <?php endif; ?>
</div>

<?php require_once VIEWS_PATH . '/layout/footer.php'; ?>