<?php
require_once __DIR__ . '/../config.php';
require_once MODELS_PATH . '/InscriptionModel.php';
require_once MODELS_PATH . '/EventModel.php';
require_once MODELS_PATH . '/ParticipantModel.php';

class InscriptionController {
    private $inscriptionModel;
    private $eventModel;
    private $participantModel;

    public function __construct() {
        $this->inscriptionModel = new InscriptionModel();
        $this->eventModel = new EventModel();
        $this->participantModel = new ParticipantModel();
    }

    public function registerParticipant($event_id, $nom, $email) {
        // Vérifier si l'événement existe
        $event = $this->eventModel->readById($event_id);
        if (!$event) {
            return ['success' => false, 'message' => 'Événement non trouvé'];
        }

        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Adresse email invalide'];
        }

        // Vérifier si le participant existe déjà
        $participant = $this->participantModel->findByEmail($email);
        
        if (!$participant) {
            // Créer le participant s'il n'existe pas
            $result = $this->participantModel->create($nom, $email);
            if (!$result) {
                return ['success' => false, 'message' => 'Erreur lors de la création du participant'];
            }
            $participant_id = $this->participantModel->getLastInsertId();
        } else {
            $participant_id = $participant['id'];
        }

        // Créer l'inscription
        try {
            $result = $this->inscriptionModel->create($event_id, $participant_id);
            return [
                'success' => $result,
                'message' => $result ? 'Inscription réussie' : 'Erreur lors de l\'inscription'
            ];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function getAllInscriptions() {
        try {
            return $this->inscriptionModel->readAll();
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function getEventInscriptions($event_id) {
        try {
            return $this->inscriptionModel->getInscriptionsByEvent($event_id);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
}
?>