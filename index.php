<?php
// Inclusion de la configuration
require_once __DIR__ . '/config.php';

// Inclure tous les contrôleurs
require_once CONTROLLERS_PATH . '/EventController.php';
require_once CONTROLLERS_PATH . '/ParticipantController.php';
require_once CONTROLLERS_PATH . '/InscriptionController.php';

// Initialiser les contrôleurs
$eventController = new EventController();
$participantController = new ParticipantController();
$inscriptionController = new InscriptionController();

// Récupérer l'action demandée
$action = $_GET['action'] ?? 'home';
$entity = $_GET['entity'] ?? '';

// Router les requêtes
switch ($entity) {
    case 'event':
        handleEventActions($eventController);
        break;
    case 'participant':
        handleParticipantActions($participantController);
        break;
    case 'inscription':
        handleInscriptionActions($inscriptionController, $eventController);
        break;
    default:
        // Page d'accueil
        $events = $eventController->getAllEvents();
        $inscriptions = $inscriptionController->getAllInscriptions();
        include VIEWS_PATH . '/home.php';
}

function handleEventActions($controller) {
    $action = $_GET['action'] ?? 'list';
    
    switch ($action) {
        case 'create':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $controller->createEvent(
                    $_POST['titre'],
                    $_POST['date_evenement'],
                    $_POST['description']
                );
                header('Location: index.php?entity=event&action=list&message=' . urlencode($result['message']));
                exit;
            }
            include VIEWS_PATH . '/events/create_event.php';
            break;
            
        case 'edit':
            if (!isset($_GET['id'])) {
                header('Location: index.php?entity=event&action=list');
                exit;
            }
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $controller->updateEvent(
                    $_GET['id'],
                    $_POST['titre'],
                    $_POST['date_evenement'],
                    $_POST['description']
                );
                header('Location: index.php?entity=event&action=list&message=' . urlencode($result['message']));
                exit;
            }
            
            include VIEWS_PATH . '/events/edit_event.php';
            break;
            
        case 'delete':
            if (isset($_GET['id'])) {
                $result = $controller->deleteEvent($_GET['id']);
                header('Location: index.php?entity=event&action=list&message=' . urlencode($result['message']));
                exit;
            }
            header('Location: index.php?entity=event&action=list');
            break;
            
        case 'list':
            $events = $controller->getAllEvents();
            include VIEWS_PATH . '/events/list_events.php';
            break;
            
        default:
            header('Location: index.php?entity=event&action=list');
            exit;
    }
}

function handleParticipantActions($controller) {
    $action = $_GET['action'] ?? 'list';
    
    switch ($action) {
        case 'create':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $controller->createParticipant(
                    $_POST['nom'],
                    $_POST['email']
                );
                header('Location: index.php?entity=participant&action=list&message=' . urlencode($result['message']));
                exit;
            }
            include VIEWS_PATH . '/participants/create_participant.php';
            break;
            
        case 'list':
            $participants = $controller->getAllParticipants();
            include VIEWS_PATH . '/participants/list_participants.php';
            break;
            
        default:
            header('Location: index.php?entity=participant&action=list');
            exit;
    }
}

function handleInscriptionActions($controller, $eventController) {
    $action = $_GET['action'] ?? 'list';
    
    switch ($action) {
        case 'register':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $controller->registerParticipant(
                    $_POST['event_id'],
                    $_POST['nom'],
                    $_POST['email']
                );
                header('Location: index.php?entity=inscription&action=list&message=' . urlencode($result['message']));
                exit;
            }
            include VIEWS_PATH . '/participants/register_participant.php';
            break;
            
        case 'list':
            $inscriptions = $controller->getAllInscriptions();
            include VIEWS_PATH . '/inscriptions/list_inscriptions.php';
            break;
            
        default:
            header('Location: index.php?entity=inscription&action=list');
            exit;
    }
}